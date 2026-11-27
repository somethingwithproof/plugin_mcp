<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Request bootstrap for the token-only endpoints (api.php, mcp.php, and the
 * OAuth token and register endpoints). Endpoints load lib/bootstrap_cacti.php,
 * which calls these functions around the include of Cacti's global.php. */

require_once __DIR__ . '/registry.php';
require_once __DIR__ . '/aip.php';

const MCP_BOOTSTRAP_DEFAULTS = [
	'methods'      => ['POST'],
	'content_type' => 'application/json',
	'max_bytes'    => 65536,
	'bearer'       => true,
	'error_format' => 'aip',
];

/**
 * Emit standard security and JSON content-type response headers.
 *
 * @return void
 */
function mcp_security_headers() : void {
	header('Cache-Control: no-store');
	header('X-Content-Type-Options: nosniff');
	header('Content-Type: application/json; charset=utf-8');
}

/**
 * The JSON-RPC error body for an AbilitiesError, in the shape mcp.php uses for its other failures.
 *
 * @param AbilitiesError $error Domain error to format.
 * @return array<string, mixed> JSON-RPC 2.0 error payload.
 */
function mcp_bootstrap_rpc_body(AbilitiesError $error) : array {
	$message = $error->getMessage() !== '' ? $error->getMessage() : (MCP_ERROR_MESSAGES[$error->reason] ?? 'The request failed.');

	return ['jsonrpc' => '2.0', 'error' => [
		'code'    => -32000,
		'message' => $message,
		'data'    => ['status' => $error->status, 'reason' => $error->reason],
	]];
}

/**
 * Send an error, as an AIP-193 body or for $format 'jsonrpc' a JSON-RPC one, and stop.
 *
 * @param AbilitiesError $error   Error to transmit.
 * @param list<string>   $methods Allowed HTTP methods for 405 responses.
 * @param string         $format  Response body format ('aip' or 'jsonrpc').
 * @return never
 */
function mcp_bootstrap_reject(AbilitiesError $error, array $methods = [], string $format = 'aip') : never {
	$status = $error->httpStatus();
	http_response_code($status);

	if ($status === 401) {
		header('WWW-Authenticate: Bearer');
	} elseif ($status === 405) {
		header('Allow: ' . implode(', ', $methods));
	}
	print json_encode($format === 'jsonrpc' ? mcp_bootstrap_rpc_body($error) : mcp_error_body($error), JSON_UNESCAPED_SLASHES);

	exit;
}

/**
 * Return the Authorization request header, or an empty string.
 *
 * Apache with PHP-FPM or CGI often drops HTTP_AUTHORIZATION, so fall back to
 * the REDIRECT_ copy that mod_rewrite leaves and then to the raw request
 * headers. The value is never taken from the query string, body, or cookies.
 *
 * @param array<string, mixed>  $server        Server superglobal array.
 * @param ?array<string, mixed> $apacheHeaders Optional result of apache_request_headers().
 * @return string Authorization header value or empty string.
 */
function mcp_authorization_header(array $server, ?array $apacheHeaders) : string {
	foreach (['HTTP_AUTHORIZATION', 'REDIRECT_HTTP_AUTHORIZATION'] as $key) {
		if (is_string($server[$key] ?? null) && $server[$key] !== '') {
			return $server[$key];
		}
	}

	foreach ($apacheHeaders ?? [] as $name => $value) {
		if (is_string($name) && strcasecmp($name, 'Authorization') === 0 && is_string($value)) {
			return $value;
		}
	}

	return '';
}

/**
 * Check method, content type, declared size, and bearer token shape. Throws AbilitiesError.
 *
 * @param array<string, mixed> $options       Endpoint bootstrap options.
 * @param array<string, mixed> $server        Server superglobal array.
 * @param string               $authorization Extracted Authorization header value.
 * @return void
 */
function mcp_bootstrap_validate(array $options, array $server, string $authorization) : void {
	$options = $options + MCP_BOOTSTRAP_DEFAULTS;
	$method  = $server['REQUEST_METHOD'] ?? '';

	if (!in_array($method, $options['methods'], true)) {
		throw new AbilitiesError('UNIMPLEMENTED', 'METHOD_NOT_ALLOWED', '', [], 405);
	}

	if ($method === 'POST') {
		$contentType = strtolower(trim(explode(';', (string) ($server['CONTENT_TYPE'] ?? ''))[0]));

		if ($contentType !== $options['content_type']) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'UNSUPPORTED_MEDIA_TYPE', '', [], 415);
		}

		// An early refusal for honest clients; the cap that holds is mcp_read_body(), which counts the bytes it reads.
		if ((int) ($server['CONTENT_LENGTH'] ?? 0) > $options['max_bytes']) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'REQUEST_TOO_LARGE', '', [], 413);
		}
	}

	if ($options['bearer'] && !preg_match('/^Bearer cmcp_pat_[a-f0-9]{64}$/D', $authorization)) {
		throw new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN');
	}
}

/**
 * Read at most $maxBytes from $stream. A longer body is rejected, whatever CONTENT_LENGTH said.
 *
 * @param string $stream   Stream URI or file path to read.
 * @param int    $maxBytes Maximum allowed payload length in bytes.
 * @return string Raw request body bytes.
 */
function mcp_read_body(string $stream, int $maxBytes) : string {
	$body = (string) file_get_contents($stream, false, null, 0, $maxBytes + 1);

	if (strlen($body) > $maxBytes) {
		throw new AbilitiesError('INVALID_ARGUMENT', 'REQUEST_TOO_LARGE', '', [], 413);
	}

	return $body;
}

/**
 * Remove browser identity before Cacti loads. $_GET is left intact for query parameters.
 *
 * @param array<string, mixed> $post    POST superglobal passed by reference.
 * @param array<string, mixed> $request REQUEST superglobal passed by reference.
 * @param array<string, mixed> $cookie  COOKIE superglobal passed by reference.
 * @return void
 */
function mcp_strip_identity(array &$post, array &$request, array &$cookie) : void {
	$post    = [];
	$request = [];
	$cookie  = [];
}

/**
 * Hide a POST from Cacti's CSRF guard. mcp_bootstrap_finish() restores the method.
 *
 * @param array<string, mixed> $server Server superglobal passed by reference.
 * @return void
 */
function mcp_hide_post_method(array &$server) : void {
	$server['MCP_ORIGINAL_METHOD'] = $server['REQUEST_METHOD'];
	$server['REQUEST_METHOD']      = 'MCP_POST';
}

/**
 * Validate the request and prepare it for the include of Cacti's global.php.
 *
 * CSRF workaround (temporary). Cacti's CSRF guard checks every web POST once
 * global.php loads: csrf_check() in csrf-magic on 1.2.x and include/csrf.php
 * on develop. Hosted MCP and OAuth clients send JSON with a bearer token and
 * cannot send a Cacti CSRF token, and neither supported Cacti version offers
 * a supported way to exempt a web request. Both guards act only when
 * REQUEST_METHOD is exactly 'POST', so for a POST this function renames the
 * method to MCP_POST before global.php loads, and the guard skips the request.
 * mcp_bootstrap_finish() restores the method.
 *
 * For every method, including GET, this function also empties $_POST,
 * $_REQUEST, and $_COOKIE before global.php loads, so Cacti finds no browser
 * session to resume and sees no form input. $_GET is kept for query
 * parameters. mcp_bootstrap_finish() clears and destroys the fresh session
 * that global.php starts.
 *
 * This is safe because CSRF protects requests that a browser authenticates
 * with cookies, and these endpoints never accept a cookie or session as
 * identity: the caller authenticates with the bearer token only, which a
 * cross-site page cannot attach. The workaround applies only to the endpoints
 * that load lib/bootstrap_cacti.php. Console pages, including the OAuth
 * consent page, are normal Cacti pages and keep full CSRF protection.
 *
 * Replace this with a supported core exemption once Cacti provides one,
 * keeping the workaround only for Cacti versions without it.
 *
 * @param array<string, mixed> $options Endpoint bootstrap options.
 * @return array{method: string, body: string, authorization: string}
 */
function mcp_bootstrap_preflight(array $options) : array {
	$options = $options + MCP_BOOTSTRAP_DEFAULTS;
	mcp_security_headers();

	$apacheHeaders = function_exists('apache_request_headers') ? apache_request_headers() : null;
	$authorization = mcp_authorization_header($_SERVER, is_array($apacheHeaders) ? $apacheHeaders : null);
	$method        = $_SERVER['REQUEST_METHOD'] ?? '';

	try {
		mcp_bootstrap_validate($options, $_SERVER, $authorization);
		$body = mcp_read_body('php://input', $options['max_bytes']);
	} catch (AbilitiesError $error) {
		mcp_bootstrap_reject($error, $options['methods']);
	}

	mcp_strip_identity($_POST, $_REQUEST, $_COOKIE);

	if ($method === 'POST') {
		mcp_hide_post_method($_SERVER);
	}

	return ['method' => $method, 'body' => $body, 'authorization' => $authorization];
}

/**
 * True once mcp_bootstrap_finish() has started; until then Cacti's output is discarded.
 *
 * @param ?bool $complete Optional new completion state.
 * @return bool Current bootstrap completion flag.
 */
function mcp_bootstrap_complete(?bool $complete = null) : bool {
	static $state = false;

	if ($complete !== null) {
		$state = $complete;
	}

	return $state;
}

/**
 * Output buffer callback around the include of global.php.
 *
 * @param string $buffer Buffered output bytes.
 * @param int    $phase  PHP output buffer phase bitmask.
 * @return string Original buffer after bootstrap completes, empty string before.
 */
function mcp_bootstrap_buffer(string $buffer, int $phase) : string {
	return mcp_bootstrap_complete() ? $buffer : '';
}

/**
 * The body sent when global.php exits or fails before returning.
 *
 * @param string $format Response body format ('aip' or 'jsonrpc').
 * @return array<string, mixed> Error payload.
 */
function mcp_bootstrap_unavailable_body(string $format) : array {
	$error = new AbilitiesError('UNAVAILABLE', 'CACTI_UNAVAILABLE', 'Cacti is not available.', [], 503);

	return $format === 'jsonrpc' ? mcp_bootstrap_rpc_body($error) : mcp_error_body($error);
}

/**
 * Shutdown function registered before the include of global.php. global.php
 * prints a page and exits on some failures, such as a database that is down.
 * Shutdown functions run before PHP flushes output buffers, so this replaces
 * that page with a JSON 503. It does nothing once the bootstrap completed.
 *
 * @param string $format      Response body format ('aip' or 'jsonrpc').
 * @param int    $bufferLevel Output buffer nesting depth recorded before include.
 * @return void
 */
function mcp_bootstrap_shutdown(string $format, int $bufferLevel) : void {
	if (mcp_bootstrap_complete()) {
		return;
	}

	while (ob_get_level() > $bufferLevel && ob_end_clean()) {
	}
	mcp_bootstrap_end_session();
	// global.php may have queued headers of its own, such as the Location of its force_https redirect.
	header_remove();
	http_response_code(503);
	mcp_security_headers();
	print json_encode(mcp_bootstrap_unavailable_body($format), JSON_UNESCAPED_SLASHES);
}

/**
 * Destroy the empty session that global.php starts for every web request.
 *
 * @return void
 */
function mcp_bootstrap_end_session() : void {
	if (session_status() === PHP_SESSION_ACTIVE) {
		session_unset();
		$_SESSION = [];
		session_destroy();
	}
}

/**
 * Undo the request preparation once global.php has loaded, then require the plugin to be serving.
 *
 * @param array{method: string, body: string, authorization: string} $request Preflight request state.
 * @param string                                                     $format  Error response format ('aip' or 'jsonrpc').
 * @return void
 */
function mcp_bootstrap_finish(array $request, string $format = 'aip') : void {
	global $config;

	mcp_bootstrap_complete(true);
	mcp_bootstrap_end_session();
	header_remove('Set-Cookie');
	mcp_security_headers();

	$_SERVER['REQUEST_METHOD'] = $_SERVER['MCP_ORIGINAL_METHOD'] ?? $request['method'];
	unset($_SERVER['MCP_ORIGINAL_METHOD']);

	if (!api_plugin_is_enabled('mcp') || (int) ($config['poller_id'] ?? 0) !== 1) {
		mcp_bootstrap_reject(new AbilitiesError('UNAVAILABLE', 'PLUGIN_UNAVAILABLE'), [], $format);
	}
}
