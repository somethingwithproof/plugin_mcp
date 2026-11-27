<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Live checks against a running Cacti with the plugin installed. run.sh starts
 * this in the checks container, which shares the web container's network so the
 * address http://localhost/cacti matches the Public Cacti URL.
 *
 * Usage: php checks.php --ref=<1.2.31|develop> --phase=<smoke|main|d3-open|d3-finish|db-down-prep|db-down|db-up>
 *
 * Every check prints PASS or FAIL and the script keeps going after a failure.
 * Reasons carry statuses and field names only, never a token or a header value
 * that could hold one. Exit status is 1 when any check failed. */

const BASE    = 'http://localhost/cacti';
const SECRETS = '/run/mcp-it';
const MCP_URL = BASE . '/plugins/mcp/mcp.php';
const MODERN  = '2026-07-28';
const VERSION_META = 'io.modelcontextprotocol/protocolVersion';

$failures = 0;

/** One entry per plugin endpoint response, for C8. @var array<int, array{label: string, cookie: bool}> */
$responses = [];

/** The raw value of a secret file, read at use. */
function secret(string $name) : string {
	$value = @file_get_contents(SECRETS . '/' . $name);

	if (!is_string($value) || $value === '') {
		throw new RuntimeException("secret file $name is missing or empty");
	}

	return trim($value);
}

/**
 * One HTTP request. Returns status, lowercase header names mapped to value lists, and the body.
 *
 * With $jar, cookies are sent from and saved to that file. Responses from the plugin
 * endpoints are recorded so C8 can assert none of them set a cookie.
 *
 * @param array<int, string> $headers
 * @return array{status: int, headers: array<string, array<int, string>>, body: string}
 */
function http(string $method, string $url, array $headers = [], ?string $body = null, ?string $jar = null) : array {
	global $responses;

	$responseHeaders = [];
	$curl            = curl_init($url);
	curl_setopt_array($curl, [
		CURLOPT_CUSTOMREQUEST  => $method,
		CURLOPT_HTTPHEADER     => $headers,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => false,
		CURLOPT_TIMEOUT        => 30,
		CURLOPT_HEADERFUNCTION => function ($curl, string $line) use (&$responseHeaders) {
			if (str_contains($line, ':')) {
				[$name, $value] = explode(':', $line, 2);
				$responseHeaders[strtolower(trim($name))][] = trim($value);
			}

			return strlen($line);
		},
	]);

	if ($body !== null) {
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
	}

	if ($jar !== null) {
		curl_setopt($curl, CURLOPT_COOKIEFILE, $jar);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $jar);
	}
	$response = curl_exec($curl);

	if ($response === false) {
		$error = curl_error($curl);
		curl_close($curl);
		throw new RuntimeException("$method request failed: $error");
	}
	$status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
	curl_close($curl);

	if (str_contains($url, '/plugins/mcp/')) {
		$responses[] = ['label' => "$method " . substr($url, strlen(BASE)) . " ($status)", 'cookie' => isset($responseHeaders['set-cookie'])];
	}

	return ['status' => $status, 'headers' => $responseHeaders, 'body' => $response];
}

/** A modern-revision (2026-07-28) MCP request with the headers and _meta the server requires. */
function mcp_modern(string $token, string $method, array $params = [], string|int $id = 1, array $extra = []) : array {
	$params['_meta'] = [VERSION_META => MODERN];
	$headers         = [
		'Authorization: Bearer ' . $token,
		'Content-Type: application/json',
		'Accept: application/json, text/event-stream',
		'Mcp-Protocol-Version: ' . MODERN,
		'Mcp-Method: ' . $method,
	];
	$headers = array_merge($headers, $extra);

	if ($method === 'tools/call') {
		$headers[] = 'Mcp-Name: ' . ($params['name'] ?? '');
	}

	return http('POST', MCP_URL, $headers, json_encode(['jsonrpc' => '2.0', 'id' => $id, 'method' => $method, 'params' => $params], JSON_THROW_ON_ERROR));
}

/** Run one check. The closure returns null for a pass or a reason string for a failure. */
function check(string $id, string $name, callable $test) : void {
	global $failures;

	try {
		$reason = $test();
	} catch (Throwable $error) {
		$reason = get_class($error) . ': ' . $error->getMessage();
	}

	if ($reason === null) {
		print "PASS $id $name\n";
	} else {
		$failures++;
		print "FAIL $id $name: $reason\n";
	}
}

function phase_smoke() : void {
	check('S1', 'tools/list', function () {
		$response = mcp_modern(secret('token-mcpuser'), 'tools/list');

		if ($response['status'] !== 200) {
			return 'status ' . $response['status'] . ', expected 200';
		}
		$json = json_decode($response['body'], true);
		$tools = $json['result']['tools'] ?? null;

		if (!is_array($tools)) {
			return 'response has no result.tools';
		}
		$names = array_column($tools, 'name');
		sort($names);
		$expected = [
			'cacti-get-device',
			'cacti-get-system-info',
			'cacti-list-data-sources',
			'cacti-list-devices',
			'cacti-list-pollers',
			'cacti-list-sites',
		];

		return $names === $expected ? null : 'tool names were [' . implode(', ', $names) . ']';
	});
}

const API_URL = BASE . '/plugins/mcp/api.php';

/** A legacy (2025-11-25) MCP request: no version header and no _meta revision. */
function mcp_legacy(string $token, string $method, array $params = [], string|int $id = 1) : array {
	$message = ['jsonrpc' => '2.0', 'id' => $id, 'method' => $method];

	if ($params) {
		$message['params'] = $params;
	}

	return http('POST', MCP_URL, [
		'Authorization: Bearer ' . $token,
		'Content-Type: application/json',
		'Accept: application/json, text/event-stream',
	], json_encode($message, JSON_THROW_ON_ERROR));
}

/** One request to api.php. $path starts with /v1. */
function api(string $token, string $method, string $path, ?string $body = null) : array {
	$headers = ['Authorization: Bearer ' . $token];

	if ($body !== null) {
		$headers[] = 'Content-Type: application/json';
	}

	return http($method, API_URL . $path, $headers, $body);
}

/** The decoded JSON body, or null when it is not JSON. */
function decode(array $response) : mixed {
	return json_decode($response['body'], true);
}

/** The error reason: AIP-193 bodies keep it in error.details[0], JSON-RPC ones in error.data. */
function error_reason(array $response) : ?string {
	$json = decode($response);

	return $json['error']['details'][0]['reason'] ?? $json['error']['data']['reason'] ?? null;
}

function error_status(array $response) : ?string {
	$json = decode($response);

	return $json['error']['status'] ?? $json['error']['data']['status'] ?? null;
}

/** A failure reason when the status differs, else null. */
function want_status(array $response, int $status) : ?string {
	return $response['status'] === $status ? null : 'status ' . $response['status'] . ', expected ' . $status;
}

/** The tool names of a tools/list response. @return array<int, string>|string A failure reason when the response is not a tool list. */
function tool_names(array $response) : array|string {
	$tools = decode($response)['result']['tools'] ?? null;

	if (!is_array($tools)) {
		return 'response has no result.tools';
	}
	$names = array_column($tools, 'name');
	sort($names);

	return $names;
}

/**
 * The value of one attribute in an HTML tag, or null. The name is anchored so that
 * `data-name=` or `xname=` is not mistaken for `name=`.
 */
function html_attr(string $tag, string $attribute) : ?string {
	if (!preg_match('/(?<![\w-])' . preg_quote($attribute, '/') . '\s*=\s*([\'"])(.*?)\1/is', $tag, $match)) {
		return null;
	}

	return html_entity_decode($match[2]);
}

/** Every hidden input of a page as [name, value] pairs, in document order. @return array<int, array{0: string, 1: string}> */
function hidden_inputs(string $html) : array {
	$found = [];

	if (preg_match_all('/<input\b[^>]*>/i', $html, $inputs)) {
		foreach ($inputs[0] as $input) {
			$name  = html_attr($input, 'name');
			$value = html_attr($input, 'value');

			if (strtolower((string) html_attr($input, 'type')) === 'hidden' && $name !== null && $value !== null) {
				$found[] = [$name, $value];
			}
		}
	}

	return $found;
}

/** The hidden CSRF input of a rendered form, found by what it is rather than by a fixed name. @return array{0: string, 1: string} name and value */
function csrf_field(string $html) : array {
	foreach (hidden_inputs($html) as [$name, $value]) {
		if (stripos($name, 'csrf') !== false) {
			return [$name, $value];
		}
	}

	throw new RuntimeException('no CSRF token on page');
}

/** Temporary cookie jars made by web_login(), removed when the script ends. @var array<int, string> */
$tempJars = [];

register_shutdown_function(function () use (&$tempJars) {
	foreach ($tempJars as $file) {
		@unlink($file);
	}
});

/**
 * Log in through the console login form and return the cookie jar path. Fails with a
 * clear reason when the form has no CSRF input or the login is refused. Without $jar the
 * jar is a temporary file removed when the script ends; with it the caller owns the file.
 */
function web_login(string $user, string $passwordFile, ?string $jar = null) : string {
	global $tempJars;

	if ($jar === null) {
		$jar = tempnam(sys_get_temp_dir(), 'jar');
		$tempJars[] = $jar;
	} else {
		file_put_contents($jar, '');
		chmod($jar, 0600);
	}
	$page = http('GET', BASE . '/index.php', [], null, $jar);
	[$csrfName, $csrfValue] = csrf_field($page['body']);

	$form = http_build_query(['action' => 'login', 'login_username' => $user, 'login_password' => secret($passwordFile),
		$csrfName => $csrfValue]);
	$login = http('POST', BASE . '/index.php', ['Content-Type: application/x-www-form-urlencoded'], $form, $jar);

	if ($login['status'] !== 302 && $login['status'] !== 200) {
		throw new RuntimeException("login as $user returned status " . $login['status']);
	}
	$after = http('GET', BASE . '/about.php', [], null, $jar);

	if ($after['status'] !== 200 || str_contains($after['body'], 'login_username')) {
		throw new RuntimeException("login as $user was not accepted");
	}

	return $jar;
}

function phase_main(string $ref) : void {
	global $responses;

	$user     = secret('token-mcpuser');
	$apionly  = secret('token-apionly');
	$norealm  = secret('token-norealm');
	$revoked  = secret('token-revoked');
	$builtin  = [
		'cacti-get-device',
		'cacti-get-system-info',
		'cacti-list-data-sources',
		'cacti-list-devices',
		'cacti-list-pollers',
		'cacti-list-sites',
	];

	check('C1', 'server/discover', function () use ($user) {
		$response = mcp_modern($user, 'server/discover');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$result = decode($response)['result'] ?? [];
		$versions = $result['supportedVersions'] ?? [];

		if (!in_array(MODERN, $versions, true) || !in_array('2025-11-25', $versions, true)) {
			return 'supportedVersions was [' . implode(', ', array_map('strval', $versions)) . ']';
		}

		return ($result['_meta']['io.modelcontextprotocol/serverInfo']['name'] ?? null) === 'cacti-mcp' ? null : 'result does not name the server';
	});

	check('C2', 'tools/list on 2026-07-28', function () use ($user, $builtin) {
		$response = mcp_modern($user, 'tools/list');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$names = tool_names($response);

		return $names === $builtin ? null : (is_string($names) ? $names : 'tool names were [' . implode(', ', $names) . ']');
	});

	check('C2', 'tools/list on legacy 2025-11-25', function () use ($user, $builtin) {
		$init = mcp_legacy($user, 'initialize', ['protocolVersion' => '2025-11-25', 'capabilities' => new stdClass(),
			'clientInfo' => ['name' => 'mcp-it', 'version' => '1']]);

		if ($reason = want_status($init, 200)) {
			return "initialize: $reason";
		}

		if ((decode($init)['result']['protocolVersion'] ?? null) !== '2025-11-25') {
			return 'initialize did not negotiate 2025-11-25';
		}
		$response = mcp_legacy($user, 'tools/list', [], 2);

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$names = tool_names($response);

		return $names === $builtin ? null : (is_string($names) ? $names : 'tool names were [' . implode(', ', $names) . ']');
	});

	$version_ok = fn (string $version) => $ref === '1.2.31' ? $version === '1.2.31' : str_starts_with($version, '1.3');
	$call       = [
		'2026-07-28' => fn (string $name, array $arguments) => mcp_modern($user, 'tools/call', ['name' => $name, 'arguments' => (object) $arguments]),
		'2025-11-25' => fn (string $name, array $arguments) => mcp_legacy($user, 'tools/call', ['name' => $name, 'arguments' => (object) $arguments]),
	];

	foreach ($call as $revision => $send) {
		check('C3', "cacti-get-system-info on $revision", function () use ($send, $version_ok) {
			$response = $send('cacti-get-system-info', []);

			if ($reason = want_status($response, 200)) {
				return $reason;
			}
			$result = decode($response)['result'] ?? [];

			if (!empty($result['isError'])) {
				return 'result.isError is set';
			}
			$version = $result['structuredContent']['cactiVersion'] ?? null;

			return is_string($version) && $version_ok($version) ? null : 'cactiVersion is not the version under test';
		});

		check('C3', "cacti-list-devices on $revision", function () use ($send) {
			$response = $send('cacti-list-devices', []);

			if ($reason = want_status($response, 200)) {
				return $reason;
			}
			$result = decode($response)['result'] ?? [];

			if (!empty($result['isError'])) {
				return 'result.isError is set';
			}
			$names = array_column($result['structuredContent']['devices'] ?? [], 'displayName');
			$missing = array_diff(['it-alpha', 'it-beta'], $names);

			return $missing ? 'missing devices: ' . implode(', ', $missing) : null;
		});
	}

	check('C4', 'GET /v1/abilities', function () use ($user) {
		$response = api($user, 'GET', '/v1/abilities');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$abilities = decode($response)['abilities'] ?? null;

		return is_array($abilities) && count($abilities) === 6 ? null : 'abilities does not hold 6 entries';
	});

	check('C4', 'GET /v1/abilities/cacti-get-device', function () use ($user) {
		$response = api($user, 'GET', '/v1/abilities/cacti-get-device');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}

		return (decode($response)['name'] ?? null) === 'abilities/cacti-get-device' ? null : 'name is not abilities/cacti-get-device';
	});

	check('C4', ':execute cacti-get-system-info', function () use ($user, $version_ok) {
		$response = api($user, 'POST', '/v1/abilities/cacti-get-system-info:execute', '{"arguments":{}}');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$json = decode($response);

		if (!preg_match('/^[0-9a-f]{32}$/D', (string) ($json['requestId'] ?? ''))) {
			return 'requestId is not 32 hex characters';
		}

		return is_string($json['result']['cactiVersion'] ?? null) && $version_ok($json['result']['cactiVersion']) ? null : 'result.cactiVersion is not the version under test';
	});

	// C5: the same four credentials on both endpoints.
	$jar = null;
	check('C5', 'login as mcpuser for the session-cookie case', function () use (&$jar) {
		$jar = web_login('mcpuser', 'mcpuser-password');

		return null;
	});

	$credentials = [
		'no Authorization'  => [[], null],
		'malformed bearer'  => [['Authorization: Bearer cmcp_pat_bad'], null],
		'revoked token'     => [['Authorization: Bearer ' . $revoked], null],
		'session cookie'    => [[], 'jar'],
	];

	foreach ($credentials as $label => [$headers, $useJar]) {
		foreach (['mcp.php' => 'POST', 'api.php' => 'GET'] as $endpoint => $method) {
			check('C5', "$label on $endpoint", function () use ($headers, $useJar, $endpoint, $method, &$jar) {
				if ($useJar !== null && $jar === null) {
					return 'no session: the login check failed';
				}
				$url  = BASE . '/plugins/mcp/' . $endpoint . ($endpoint === 'api.php' ? '/v1/abilities' : '');
				$body = null;

				if ($method === 'POST') {
					$headers[] = 'Content-Type: application/json';
					$body      = '{"jsonrpc":"2.0","id":1,"method":"tools/list"}';
				}
				$response = http($method, $url, $headers, $body, $useJar !== null ? $jar : null);

				if ($reason = want_status($response, 401)) {
					return $reason;
				}

				if (!in_array('Bearer', $response['headers']['www-authenticate'] ?? [], true)) {
					return 'WWW-Authenticate is not Bearer';
				}

				return is_array(decode($response)) ? null : 'body is not JSON';
			});
		}
	}

	foreach (['mcp.php' => fn () => mcp_modern($norealm, 'tools/list'), 'api.php' => fn () => api($norealm, 'GET', '/v1/abilities')] as $endpoint => $send) {
		check('C6', "norealm on $endpoint", function () use ($send) {
			$response = $send();

			if ($reason = want_status($response, 403)) {
				return $reason;
			}

			return error_status($response) === 'PERMISSION_DENIED' && error_reason($response) === 'REALM_REQUIRED' ? null : 'error is not PERMISSION_DENIED/REALM_REQUIRED';
		});
	}

	check('C6b', 'apionly tools/list is empty', function () use ($apionly) {
		$response = mcp_modern($apionly, 'tools/list');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}

		// Object mode: an empty JSON object decodes to stdClass, which is not a list; only [] is.
		$body = json_decode($response['body']);

		return ($body->result->tools ?? null) === [] ? null : 'result.tools is not an empty list';
	});

	check('C6b', 'apionly :execute is ABILITY_NOT_FOUND, same as an unknown id', function () use ($apionly) {
		$denied  = api($apionly, 'POST', '/v1/abilities/cacti-get-device:execute', '{"arguments":{"name":"devices/1"}}');
		$unknown = api($apionly, 'POST', '/v1/abilities/cacti-no-such-ability:execute', '{"arguments":{"name":"devices/1"}}');

		foreach ([$denied, $unknown] as $response) {
			if ($reason = want_status($response, 404)) {
				return $reason;
			}

			if (error_reason($response) !== 'ABILITY_NOT_FOUND') {
				return 'reason is not ABILITY_NOT_FOUND';
			}
		}

		// A per-request id may differ between two calls; everything else must match.
		$strip = function (mixed $value) use (&$strip) {
			if (!is_array($value)) {
				return $value;
			}
			unset($value['requestId'], $value['request_id']);

			return array_map($strip, $value);
		};

		return $strip(decode($denied)) === $strip(decode($unknown)) ? null : 'the two bodies differ';
	});

	check('C6b', 'apionly tools/call is an isError result', function () use ($apionly) {
		$response = mcp_modern($apionly, 'tools/call', ['name' => 'cacti-get-device', 'arguments' => ['name' => 'devices/1']]);

		if ($reason = want_status($response, 200)) {
			return $reason;
		}

		return (decode($response)['result']['isError'] ?? null) === true ? null : 'result.isError is not true';
	});

	$methods = [
		'GET mcp.php'            => ['GET', MCP_URL],
		'PUT mcp.php'            => ['PUT', MCP_URL],
		'PUT api.php/v1/abilities' => ['PUT', API_URL . '/v1/abilities'],
	];

	foreach ($methods as $label => [$method, $url]) {
		check('C7', $label, function () use ($method, $url, $user) {
			$response = http($method, $url, ['Authorization: Bearer ' . $user]);

			if ($reason = want_status($response, 405)) {
				return $reason;
			}

			if (!preg_match('/\bPOST\b/', implode(',', $response['headers']['allow'] ?? []))) {
				return 'Allow does not contain POST';
			}

			return $response['body'] === '' || is_array(decode($response)) ? null : 'body is neither empty nor JSON';
		});
	}

	// C1-C7 are done; C9 and D1 add more responses that the same rule covers, so C8 runs last of them.
	check('C9', 'no Origin', fn () => want_status(mcp_modern($user, 'tools/list'), 200));
	check('C9', 'Origin http://localhost', fn () => want_status(mcp_modern($user, 'tools/list', [], 1, ['Origin: http://localhost']), 200));
	check('C9', 'Origin https://evil.test', function () use ($user) {
		$response = mcp_modern($user, 'tools/list', [], 1, ['Origin: https://evil.test']);

		if ($reason = want_status($response, 403)) {
			return $reason;
		}

		return (decode($response)['error']['data']['reason'] ?? null) === 'ORIGIN_NOT_ALLOWED' ? null : 'error.data.reason is not ORIGIN_NOT_ALLOWED';
	});
	check('C9', 'Origin null', fn () => want_status(mcp_modern($user, 'tools/list', [], 1, ['Origin: null']), 403));

	if ($ref === 'develop') {
		check('D1', 'api.php/v1/abilities through the nginx block', function () use ($user) {
			$response = api($user, 'GET', '/v1/abilities');

			if ($reason = want_status($response, 200)) {
				return $reason;
			}

			if (!str_starts_with($response['headers']['content-type'][0] ?? '', 'application/json')) {
				return 'Content-Type is not application/json';
			}

			return str_contains($response['body'], '<html') || str_contains($response['body'], 'UNKNOWN_PATH') ? 'body is an HTML page or UNKNOWN_PATH' : null;
		});
	} else {
		print "SKIP D1 nginx only\n";
	}

	check('C8', 'no Set-Cookie on any mcp.php or api.php response', function () use (&$responses) {
		if (!$responses) {
			return 'no responses were recorded';
		}
		$bad = array_column(array_filter($responses, fn ($r) => $r['cookie']), 'label');

		return $bad ? 'Set-Cookie on: ' . implode('; ', array_slice($bad, 0, 5)) : null;
	});
}

const REFUSAL_TEXT = 'Tokens cannot be created for the guest account or disabled users.';
const D3_STATE     = SECRETS . '/d3-open.json';

/** guestu's user id, from the fixtures. */
function guestu_id() : int {
	$ids = json_decode(secret('ids.json'), true, 8, JSON_THROW_ON_ERROR);

	return (int) $ids['guestu'];
}

/** The value of one hidden input on a page, or null. */
function hidden_value(string $html, string $name) : ?string {
	foreach (hidden_inputs($html) as [$field, $value]) {
		if ($field === $name) {
			return $value;
		}
	}

	return null;
}

/** The user ids offered by the User dropdown of the admin token form. @return array<int, int>|null null when there is no such dropdown */
function user_dropdown_ids(string $html) : ?array {
	if (!preg_match('/<select\b[^>]*(?<![\w-])(?:id|name)\s*=\s*[\'"]user_id[\'"][^>]*>(.*?)<\/select>/is', $html, $select)) {
		return null;
	}
	preg_match_all('/<option\b[^>]*(?<![\w-])value\s*=\s*[\'"]?(\d+)/i', $select[1], $options);

	return array_map('intval', $options[1]);
}

const D3_PAGES = [
	'self'  => ['plugins/mcp/mcp_tokens.php', 'guestu', 'guestu-password', 'jar-guestu'],
	'admin' => ['plugins/mcp/mcp_admin.php?tab=tokens', 'admin', 'admin-password', 'jar-admin'],
];

/** D3, first half: sign in as guestu and admin, open each token page, keep the sessions. */
function phase_d3_open() : void {
	$state = [];

	foreach (D3_PAGES as $key => [$path, $user, $passwordFile, $jarName]) {
		check('D3', "open the token page as $user while guestu is not the guest", function () use ($key, $path, $user, $passwordFile, $jarName, &$state) {
			$jar  = web_login($user, $passwordFile, SECRETS . '/' . $jarName);
			$page = http('GET', BASE . '/' . $path, [], null, $jar);

			if ($page['status'] !== 200) {
				return 'status ' . $page['status'] . ', expected 200';
			}
			$nonce = hidden_value($page['body'], 'mcp_nonce');

			if ($nonce === null) {
				return 'the page has no create form';
			}

			if ($key === 'admin' && !in_array(guestu_id(), user_dropdown_ids($page['body']) ?? [], true)) {
				return 'the User dropdown does not list guestu before the change, so the later absence proves nothing';
			}
			// The create POST in d3-finish replays these from this session, as a tab left open would.
			$state[$key] = ['nonce' => $nonce, 'csrf' => csrf_field($page['body'])];

			return null;
		});
	}
	umask(0077);
	file_put_contents(D3_STATE, json_encode($state, JSON_THROW_ON_ERROR));
}

/*
 * Order matters for detection power. The create POST is sent from the session opened in d3-open,
 * with the nonce and CSRF token saved then, before anything reloads a page in that session: both
 * the admin form and the create path force a fresh guest_user read, so a reload would refresh the
 * session's cached value and hide a create path that went back to a cached read. The User dropdown
 * is checked afterwards in a new session.
 *
 * On 1.2.31 the session keeps the old guest_user, so the plugin's forced read is what stops the
 * token. On develop Cacti ends the session of an account that becomes the guest, so D3a there
 * only guards that no token is minted; the stale-read regression is detectable on 1.2.31 only.
 */

/**
 * Send the create POST for one D3 page from its d3-open session. A redirect is followed once with the
 * same session, as a browser would.
 */
function d3_create_post(string $key, string $path, string $jar, array $saved) : array {
	$fields = ['action' => 'create_token', 'days' => '1', 'mcp_nonce' => $saved['nonce'], $saved['csrf'][0] => $saved['csrf'][1]];

	if ($key === 'admin') {
		$fields['user_id'] = (string) guestu_id();
	}
	$post = http('POST', BASE . '/' . strtok($path, '?'), ['Content-Type: application/x-www-form-urlencoded'], http_build_query($fields), $jar);

	if ($post['status'] === 302 && ($post['headers']['location'][0] ?? '') !== '') {
		$location = $post['headers']['location'][0];
		$next     = str_starts_with($location, 'http') ? $location : 'http://localhost' . (str_starts_with($location, '/') ? '' : '/cacti/') . $location;
		$post     = http('GET', $next, [], null, $jar);
	}

	return $post;
}

/** D3, second half: try to create a token for guestu, then check what the admin form offers. */
function phase_d3_finish() : void {
	$state = json_decode((string) @file_get_contents(D3_STATE), true) ?: [];

	foreach (['self' => ['D3a', 'self-service create as guestu'], 'admin' => ['D3b', 'admin create for guestu']] as $key => [$id, $name]) {
		[$path, $user, , $jarName] = D3_PAGES[$key];

		check($id, $name, function () use ($key, $path, $user, $jarName, $state) {
			$jar = SECRETS . '/' . $jarName;

			if (!is_file($jar) || !isset($state[$key])) {
				return "no session from the d3-open phase for $user";
			}
			$post = d3_create_post($key, $path, $jar, $state[$key]);

			if (str_contains($post['body'], 'cmcp_pat_')) {
				return 'a token was created for guestu';
			}
			// The plugin's own message is a real refusal for both. Only the guest's own request may instead
			// meet the login page: Cacti ends the session of an account that is now the guest. The admin's
			// session stays valid, so a login page there means the POST was never authenticated.
			$refused = str_contains($post['body'], REFUSAL_TEXT) || ($key === 'self' && str_contains($post['body'], 'login_username'));

			return $post['status'] === 200 && $refused ? null : 'the POST (status ' . $post['status'] . ') was not refused by the plugin' . ($key === 'self' ? ' nor answered with the login page' : '');
		});
	}

	check('D3b', 'guestu is not offered in the admin User dropdown', function () {
		// A new session, so the reload cannot touch the one used for the POST above.
		$jar  = web_login('admin', 'admin-password', SECRETS . '/jar-admin-dropdown');
		$page = http('GET', BASE . '/' . D3_PAGES['admin'][0], [], null, $jar);

		if ($page['status'] !== 200 || str_contains($page['body'], 'login_username')) {
			return 'the admin token page did not load as admin (status ' . $page['status'] . ')';
		}

		if (hidden_value($page['body'], 'mcp_nonce') === null) {
			return 'no create form on the admin page';
		}
		// No dropdown on the page means it offers nobody, so guestu cannot be in it.
		return in_array(guestu_id(), user_dropdown_ids($page['body']) ?? [], true) ? 'guestu is still in the User dropdown' : null;
	});

	foreach (array_column(D3_PAGES, 3) as $jarName) {
		@unlink(SECRETS . '/' . $jarName);
	}
	@unlink(SECRETS . '/jar-admin-dropdown');
	@unlink(D3_STATE);
}

/** The session the db-down checks present as a cookie. It must be made while the database is up. */
function phase_db_down_prep() : void {
	check('D2', 'sign in as mcpuser before the database stops', function () {
		web_login('mcpuser', 'mcpuser-password', SECRETS . '/jar-mcpuser');

		return null;
	});
}

/**
 * The reason a response is not a clean 503 JSON error in the given format, or null. 'jsonrpc' is the
 * mcp.php shape (error.data), 'aip193' the api.php shape (error.status, error.details); the other
 * endpoint's shape is rejected.
 */
function unavailable_reason(array $response, string $format) : ?string {
	if ($reason = want_status($response, 503)) {
		return $reason;
	}

	if (!str_starts_with($response['headers']['content-type'][0] ?? '', 'application/json')) {
		return 'Content-Type is not application/json';
	}

	try {
		$json = json_decode($response['body'], true, 64, JSON_THROW_ON_ERROR);
	} catch (JsonException $error) {
		return 'body is not a single JSON document';
	}

	if (!is_array($json)) {
		return 'body is not a JSON object';
	}

	if (str_contains($response['body'], '<')) {
		return 'body contains "<"';
	}

	if (isset($response['headers']['set-cookie'])) {
		return 'response sets a cookie';
	}

	if ($format === 'jsonrpc') {
		$status = $json['error']['data']['status'] ?? null;
		$why    = $json['error']['data']['reason'] ?? null;
	} else {
		$status = $json['error']['status'] ?? null;
		$why    = $json['error']['details'][0]['reason'] ?? null;
	}

	return $status === 'UNAVAILABLE' && $why === 'CACTI_UNAVAILABLE' ? null : 'error is not UNAVAILABLE/CACTI_UNAVAILABLE';
}

/**
 * D2: with the database stopped, both endpoints answer 503 JSON for a bearer token alone and for
 * a bearer token sent together with a session cookie. A cookie without a token is answered 401 before
 * the database is read (C5), so it cannot reach the 503 path and is not tested here.
 */
function phase_db_down() : void {
	$token = secret('token-mcpuser');
	$jar   = SECRETS . '/jar-mcpuser';
	// The jar belongs to this phase from here on: remove it however the script ends.
	register_shutdown_function(static function () use ($jar) {
		@unlink($jar);
	});
	$modern = ['Content-Type: application/json', 'Accept: application/json, text/event-stream',
		'Mcp-Protocol-Version: ' . MODERN, 'Mcp-Method: tools/list'];
	$list = json_encode(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'tools/list', 'params' => ['_meta' => [VERSION_META => MODERN]]], JSON_THROW_ON_ERROR);
	$exec = '/v1/abilities/cacti-get-system-info:execute';

	$requests = [
		'mcp.php tools/list'    => ['jsonrpc', fn (bool $cookie) => http('POST', MCP_URL, array_merge($modern, ['Authorization: Bearer ' . $token]), $list, $cookie ? $jar : null)],
		'api.php abilities'     => ['aip193', fn (bool $cookie) => http('GET', API_URL . '/v1/abilities', ['Authorization: Bearer ' . $token], null, $cookie ? $jar : null)],
		'api.php :execute'      => ['aip193', fn (bool $cookie) => http('POST', API_URL . $exec, ['Content-Type: application/json', 'Authorization: Bearer ' . $token], '{"arguments":{}}', $cookie ? $jar : null)],
	];

	foreach ([false, true] as $cookie) {
		foreach ($requests as $label => [$format, $send]) {
			check('D2', ($cookie ? 'bearer token and session cookie' : 'bearer token') . " on $label", function () use ($send, $format, $cookie, $jar) {
				if ($cookie && !is_file($jar)) {
					return 'no session: the db-down-prep phase failed';
				}

				return unavailable_reason($send($cookie), $format);
			});
		}
	}
}

/** After the database is back, the C2 modern tools/list must work again. */
function phase_db_up() : void {
	// Backstop: db-down may not have run (or died before its shutdown hook was set).
	@unlink(SECRETS . '/jar-mcpuser');
	check('D2', 'tools/list works again after the database restarts', function () {
		$response = mcp_modern(secret('token-mcpuser'), 'tools/list');

		if ($reason = want_status($response, 200)) {
			return $reason;
		}
		$names = tool_names($response);

		return $names === ['cacti-get-device', 'cacti-get-system-info', 'cacti-list-devices'] ? null : (is_string($names) ? $names : 'tool names were [' . implode(', ', $names) . ']');
	});
}

$options = getopt('', ['ref:', 'phase:']);
$ref     = $options['ref'] ?? '';
$phase   = $options['phase'] ?? '';

if (!in_array($ref, ['1.2.31', 'develop'], true)) {
	fwrite(STDERR, "usage: checks.php --ref=<1.2.31|develop> --phase=<smoke|main|d3-open|d3-finish|db-down-prep|db-down|db-up>\n");
	exit(2);
}

switch ($phase) {
	case 'smoke':
		phase_smoke();
		break;
	case 'main':
		phase_main($ref);
		break;
	case 'd3-open':
		phase_d3_open();
		break;
	case 'd3-finish':
		phase_d3_finish();
		break;
	case 'db-down-prep':
		phase_db_down_prep();
		break;
	case 'db-down':
		phase_db_down();
		break;
	case 'db-up':
		phase_db_up();
		break;
	default:
		fwrite(STDERR, "unknown phase\n");
		exit(2);
}

exit($failures === 0 ? 0 : 1);
