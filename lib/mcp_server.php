<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Tools-only MCP server over Streamable HTTP (mcp.php). The handler takes the
 * request as plain values and returns the response as data, so tests run it
 * without Cacti. It keeps no session state: it never sends Mcp-Session-Id and
 * ignores one it receives. */

require_once __DIR__ . '/registry.php';
require_once __DIR__ . '/aip.php';
require_once __DIR__ . '/capability_guard.php';

const MCP_VERSION_MODERN = '2026-07-28';
const MCP_VERSION_LEGACY = '2025-11-25';
const MCP_VERSION_META   = 'io.modelcontextprotocol/protocolVersion';
const MCP_SERVER_META    = 'io.modelcontextprotocol/serverInfo';

/**
 * Lowercase header names mapped from the HTTP_* entries of $_SERVER.
 *
 * @param array<string, mixed> $server Server superglobal array.
 * @return array<string, string> Lowercased HTTP request headers.
 */
function mcp_request_headers(array $server) : array {
	$headers = [];

	foreach ($server as $key => $value) {
		if (is_string($key) && str_starts_with($key, 'HTTP_') && is_string($value)) {
			$headers[strtolower(str_replace('_', '-', substr($key, 5)))] = $value;
		}
	}

	return $headers;
}

/**
 * A JSON-RPC error response. $id is omitted when the request id is unknown.
 *
 * @param int             $status  HTTP status code.
 * @param int             $code    JSON-RPC error code.
 * @param string          $message Human-readable error message.
 * @param mixed           $data    Optional structured error data.
 * @param string|int|null $id      Request identifier when known.
 * @return array{status: int, headers: array<string, string>, body: array<string, mixed>}
 */
function mcp_rpc_error(int $status, int $code, string $message, mixed $data = null, string|int|null $id = null) : array {
	$error = ['code' => $code, 'message' => $message];

	if ($data !== null) {
		$error['data'] = $data;
	}
	$body = ['jsonrpc' => '2.0'];

	if ($id !== null) {
		$body['id'] = $id;
	}

	return ['status' => $status, 'headers' => [], 'body' => $body + ['error' => $error]];
}

/**
 * The MCP tool descriptor for a registry descriptor.
 *
 * @param array<string, mixed> $descriptor Registry ability descriptor.
 * @return array<string, mixed> MCP tool definition.
 */
function mcp_rpc_tool(array $descriptor) : array {
	return [
		'name'         => $descriptor['id'],
		'title'        => $descriptor['label'],
		'description'  => $descriptor['description'],
		'inputSchema'  => mcp_schema_json($descriptor['inputSchema']),
		'outputSchema' => mcp_schema_json($descriptor['outputSchema']),
		'annotations'  => ['readOnlyHint' => true, 'destructiveHint' => false, 'idempotentHint' => true, 'openWorldHint' => false],
	];
}

/**
 * Run an ability with capability-guard enforcement before and after execution.
 * An AbilitiesError is a tool result with isError, never a protocol error.
 *
 * @param stdClass          $params    JSON-RPC tools/call params object.
 * @param AbilitiesRegistry $registry  Ability registry instance.
 * @param array             $principal Authenticated request principal.
 * @param callable          $audit     Audit callback.
 * @return array<string, mixed> MCP tool call result payload.
 */
function mcp_rpc_call(stdClass $params, AbilitiesRegistry $registry, array $principal, callable $audit) : array {
	$arguments = $params->arguments ?? new stdClass();

	// Dropping a malformed value would run the ability unfiltered, so a double-encoded string is refused like api.php refuses it.
	// A missing or null value means no arguments.
	if (!$arguments instanceof stdClass) {
		return mcp_rpc_tool_error(new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS', '',
			[['field' => 'arguments', 'description' => 'Must be a JSON object.']]));
	}

	try {
		$descriptor = $registry->get($principal, (string) $params->name);

		if ($descriptor !== null) {
			mcp_capability_guard_before_execute(
				$principal,
				(string) $params->name,
				$descriptor['annotations'],
				$arguments
			);
		}

		$response   = $registry->execute($principal, $params->name, $arguments, $audit);
		$structured = $response['result'] ?: new stdClass();

		// structuredContent must be a JSON object; a non-empty list can only come from a misdeclared ability.
		if (is_array($structured) && array_is_list($structured)) {
			throw new AbilitiesError('INTERNAL', 'INVALID_RESULT');
		}

		if (is_array($structured)) {
			$structured = mcp_capability_guard_after_execute((string) $params->name, $structured);
		}

		return ['content' => [['type' => 'text', 'text' => json_encode($structured, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR)]],
			'structuredContent' => $structured];
	} catch (Throwable $error) {
		// Only the sanctioned error text leaves the server; anything unexpected is a generic failure.
		if (!$error instanceof AbilitiesError) {
			mcp_log_failure((string) $params->name, 'INTERNAL_ERROR', $error);
			$error = new AbilitiesError('INTERNAL', 'INTERNAL_ERROR');
		} elseif ($error->status === 'INTERNAL') {
			mcp_log_failure((string) $params->name, $error->reason, $error);
		}

		return mcp_rpc_tool_error($error);
	}
}

/**
 * A tool result that reports an error to the model.
 *
 * @param AbilitiesError $error Domain error to format.
 * @return array<string, mixed> MCP tool error envelope.
 */
function mcp_rpc_tool_error(AbilitiesError $error) : array {
	$body = mcp_error_body($error);

	return ['isError' => true, 'content' => [['type' => 'text', 'text' => $body['error']['message']]],
		'structuredContent' => $body];
}

/**
 * Decode the mcp-name header, which carries non-ASCII or unsafe values as =?base64?...?=.
 *
 * @param string $value Raw header value.
 * @return ?string Decoded tool name, or null when base64 decoding fails.
 */
function mcp_rpc_header_name(string $value) : ?string {
	if (preg_match('/^=\?base64\?([A-Za-z0-9+\/]*={0,2})\?=$/D', $value, $match)) {
		$decoded = base64_decode($match[1], true);

		return $decoded === false ? null : $decoded;
	}

	return $value;
}

/**
 * Handle one MCP HTTP request. Never throws.
 *
 * @param string                               $httpMethod HTTP request method.
 * @param array<string, string>                $headers    Request headers, lowercase names.
 * @param string                               $body       Raw JSON-RPC request body.
 * @param AbilitiesRegistry                    $registry   Ability registry instance.
 * @param array                                $principal  Authenticated request principal.
 * @param callable                             $audit      Audit callback.
 * @param array{name: string, version: string} $serverInfo Server identification metadata.
 * @return array{status: int, headers: array<string, string>, body: ?array}
 */
function mcp_rpc_handle(string $httpMethod, array $headers, string $body, AbilitiesRegistry $registry,
	array $principal, callable $audit, array $serverInfo) : array {
	if ($httpMethod !== 'POST') {
		return ['status' => 405, 'headers' => ['Allow' => 'POST'], 'body' => null];
	}

	try {
		$message = json_decode($body, false, 32, JSON_THROW_ON_ERROR);
	} catch (JsonException $error) {
		return mcp_rpc_error(400, -32700, 'The body is not valid JSON, or is nested more than 32 levels deep.');
	}

	// Batches are not supported: only a single request object is accepted.
	if (!$message instanceof stdClass || ($message->jsonrpc ?? null) !== '2.0' || !is_string($message->method ?? null)
		|| (property_exists($message, 'id') && !is_string($message->id) && !is_int($message->id))) {
		return mcp_rpc_error(400, -32600, 'The body must be one JSON-RPC 2.0 request object with a string or integer id.');
	}

	// A message without an id is a notification and gets no response body.
	if (!property_exists($message, 'id')) {
		return ['status' => 202, 'headers' => [], 'body' => null];
	}

	$id     = $message->id;
	$method = $message->method;
	$params = $message->params ?? new stdClass();

	if (!$params instanceof stdClass) {
		return mcp_rpc_error(200, -32602, 'params must be an object.', null, $id);
	}

	$meta   = $params->_meta ?? null;
	$modern = $meta instanceof stdClass && property_exists($meta, MCP_VERSION_META);
	$info   = ['name' => $serverInfo['name'], 'version' => $serverInfo['version']];

	if ($modern) {
		$version = $meta->{MCP_VERSION_META};

		if ($version !== MCP_VERSION_MODERN) {
			return mcp_rpc_error(400, -32022, 'Unsupported protocol version.',
				['supported' => [MCP_VERSION_MODERN, MCP_VERSION_LEGACY], 'requested' => is_scalar($version) ? (string) $version : ''], $id);
		}

		$mismatch = ($headers['mcp-protocol-version'] ?? null) !== $version || ($headers['mcp-method'] ?? null) !== $method;

		if (!$mismatch && $method === 'tools/call') {
			$name     = isset($headers['mcp-name']) ? mcp_rpc_header_name($headers['mcp-name']) : null;
			$mismatch = !is_string($params->name ?? null) || $name !== $params->name;
		}

		if ($mismatch) {
			return mcp_rpc_error(400, -32020, 'The MCP request headers do not match the request body.', null, $id);
		}
	}

	// Before negotiation a legacy client may send no version header; once it sends one, it must be a revision this server speaks.
	if (!$modern && $method !== 'initialize' && isset($headers['mcp-protocol-version'])
		&& !in_array($headers['mcp-protocol-version'], [MCP_VERSION_LEGACY, '2025-06-18', '2025-03-26'], true)) {
		return mcp_rpc_error(400, -32600, 'Unsupported protocol version.', null, $id);
	}

	// Modern results name their type, and cacheable ones declare how long and for whom.
	$wrap = fn (array|stdClass $result, bool $cacheable = false) => ['jsonrpc' => '2.0', 'id' => $id, 'result' => $modern
		? ['resultType' => 'complete'] + ($cacheable ? ['cacheScope' => 'private', 'ttlMs' => 0] : []) + (array) $result
			+ ['_meta' => [MCP_SERVER_META => $info]]
		: $result];
	$ok    = fn (array|stdClass $result, bool $cacheable = false) => ['status' => 200, 'headers' => [], 'body' => $wrap($result, $cacheable)];

	try {
		switch ($method) {
			case 'server/discover':
				if ($modern) {
					return $ok(['supportedVersions' => [MCP_VERSION_MODERN, MCP_VERSION_LEGACY], 'capabilities' => ['tools' => new stdClass()]], true);
				}
				break;
			case 'initialize':
				if (!$modern) {
					return $ok(['protocolVersion' => MCP_VERSION_LEGACY, 'capabilities' => ['tools' => new stdClass()], 'serverInfo' => $info]);
				}
				break;
			case 'ping':
				return $ok(new stdClass());
			case 'tools/list':
				return $ok(['tools' => array_map('mcp_rpc_tool', $registry->discover($principal))], true);
			case 'tools/call':
				if (!is_string($params->name ?? null)) {
					return mcp_rpc_error($modern ? 400 : 200, -32602, 'params.name must be a tool name.', null, $id);
				}

				return $ok(mcp_rpc_call($params, $registry, $principal, $audit));
		}
	} catch (Throwable $error) {
		// A plugin permission callback can throw during discovery; keep the detail out of the response.
		mcp_log_failure('', 'DISCOVERY_FAILED', $error);
		return mcp_rpc_error($modern ? 500 : 200, -32603, 'Internal error.', null, $id);
	}

	return mcp_rpc_error($modern ? 404 : 200, -32601, 'Method not found.', null, $id);
}
