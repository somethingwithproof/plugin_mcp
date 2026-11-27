<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* AIP-193 errors, AIP-158 paging, AIP-160 filtering, and AIP-132 ordering.
 * The grammar mirrors the core REST API helpers (rest_filter() and friends). */

const MCP_ERROR_MESSAGES = [
	'INVALID_TOKEN'          => 'The token is missing, malformed, expired, or revoked.',
	'REALM_REQUIRED'         => 'The token owner lacks the realm required for this plugin.',
	'INVALID_ARGUMENTS'      => 'The arguments do not satisfy the ability schema.',
	'INVALID_RESULT'         => 'The ability returned a result that does not satisfy its schema.',
	'AUDIT_UNAVAILABLE'      => 'The audit log is unavailable, so the call was not executed.',
	'DEVICE_NOT_FOUND'       => 'The device does not exist or is not visible to this user.',
	'ABILITY_NOT_FOUND'     => 'The ability does not exist or is not available to this user.',
	'UNKNOWN_PATH'           => 'No route matches this path and method.',
	'INTERNAL_ERROR'         => 'The server failed to complete the request.',
	'INVALID_PAGE_TOKEN'     => 'pageToken is invalid or does not match this query.',
	'INVALID_FILTER'         => 'The filter expression is not valid.',
	'PLUGIN_UNAVAILABLE'     => 'The plugin is disabled or this server is not the main poller.',
	'METHOD_NOT_ALLOWED'     => 'The HTTP method is not allowed for this endpoint.',
	'UNSUPPORTED_MEDIA_TYPE' => 'The request content type is not supported.',
	'REQUEST_TOO_LARGE'      => 'The request body exceeds the size limit.',
	'CACTI_UNAVAILABLE'      => 'Cacti is not available.',
	'LOG_UNAVAILABLE'        => 'The Cacti log file is not readable.',
	'CAPABILITY_DENIED'      => 'The capability boundary denied this request.',
	'CONTROL_PLANE_VIOLATION'=> 'Untrusted data attempted to access or mutate control-plane fields.',
];

const MCP_PAGE_SIZE_DEFAULT = 50;
const MCP_PAGE_SIZE_MAX     = 100;

/**
 * Build the AIP-193 error body.
 *
 * @param AbilitiesError $e Error instance to serialize.
 * @return array<string, mixed> AIP-193 error envelope.
 */
function mcp_error_body(AbilitiesError $e) : array {
	$code    = $e->httpStatus();
	$details = [[
		'@type'  => 'type.googleapis.com/google.rpc.ErrorInfo',
		'reason' => $e->reason,
		'domain' => 'cacti.net',
	]];

	if ($e->violations) {
		$details[] = [
			'@type'           => 'type.googleapis.com/google.rpc.BadRequest',
			'fieldViolations' => array_map(
				fn ($v) => ['field' => $v['field'], 'description' => $v['description']],
				array_values($e->violations)
			),
		];
	}

	return ['error' => [
		'code'    => $code,
		'message' => $e->getMessage() !== '' ? $e->getMessage() : (MCP_ERROR_MESSAGES[$e->reason] ?? 'The request failed.'),
		'status'  => $e->status,
		'details' => $details,
	]];
}

/**
 * Make empty "properties" lists encode as JSON objects.
 *
 * @param array<string, mixed> $schema Ability JSON schema definition.
 * @return array<string, mixed> Normalized JSON schema ready for json_encode().
 */
function mcp_schema_json(array $schema) : array {
	if (isset($schema['properties']) && is_array($schema['properties'])) {
		$properties = array_map('mcp_schema_json', $schema['properties']);
		$schema['properties'] = $properties === [] ? new stdClass() : $properties;
	}

	if (isset($schema['items']) && is_array($schema['items'])) {
		$schema['items'] = mcp_schema_json($schema['items']);
	}

	return $schema;
}

/**
 * Read pageSize and pageToken. The token binds the offset to the query fingerprint.
 *
 * @param stdClass $args        Caller arguments object.
 * @param string   $fingerprint Query fingerprint binding pageToken to filter/order.
 * @param int      $default     Default page size when omitted or zero.
 * @param int      $max         Maximum allowed page size.
 * @return array{size: int, offset: int}
 */
function mcp_page(stdClass $args, string $fingerprint, int $default = MCP_PAGE_SIZE_DEFAULT, int $max = MCP_PAGE_SIZE_MAX) : array {
	$size = $default;

	if (isset($args->pageSize)) {
		if (!is_int($args->pageSize) || $args->pageSize < 0) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS', 'pageSize must be a non-negative integer.',
				[['field' => 'pageSize', 'description' => 'Must be a non-negative integer.']]);
		}

		// zero means the server default; larger values are coerced down
		$size = $args->pageSize === 0 ? $default : min($args->pageSize, $max);
	}

	$offset = 0;

	if (isset($args->pageToken) && $args->pageToken !== '') {
		$decoded = is_string($args->pageToken) ? base64_decode(strtr($args->pageToken, '-_', '+/'), true) : false;
		$state   = $decoded === false ? null : json_decode($decoded, true);

		if (!is_array($state) || !isset($state['o'], $state['f']) || !is_int($state['o']) || $state['o'] < 0 || $state['f'] !== $fingerprint) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_PAGE_TOKEN', '',
				[['field' => 'pageToken', 'description' => 'Invalid or issued for a different query.']]);
		}

		$offset = $state['o'];
	}

	return ['size' => $size, 'offset' => $offset];
}

/**
 * Issue the pageToken for the page that starts at $offset.
 *
 * @param int    $offset      Zero-based row offset for the next page.
 * @param string $fingerprint Query fingerprint bound into the token.
 * @return string URL-safe base64 page token.
 */
function mcp_page_token(int $offset, string $fingerprint) : string {
	return rtrim(strtr(base64_encode((string) json_encode(['o' => $offset, 'f' => $fingerprint])), '+/', '-_'), '=');
}

/**
 * Build an INVALID_FILTER error for the filter field.
 *
 * @param string $description Field violation explanation.
 * @return AbilitiesError Error ready to throw.
 */
function mcp_filter_error(string $description) : AbilitiesError {
	return new AbilitiesError('INVALID_ARGUMENT', 'INVALID_FILTER', '', [['field' => 'filter', 'description' => $description]]);
}

/**
 * Translate an AIP-160 filter into SQL escaped with db_qstr().
 *
 * Comparisons (= != < <= > >=) joined by AND; values are a double quoted
 * string, a number, true, or false. Only fields marked 'filter' are allowed.
 *
 * @param string                              $filter AIP-160 filter expression.
 * @param array<string, array<string, mixed>> $fields Allowed field specifications.
 * @return string SQL WHERE fragment or empty string when $filter is blank.
 */
function mcp_filter_sql(string $filter, array $fields) : string {
	$filter = trim($filter);

	if ($filter === '') {
		return '';
	}

	$term    = '/\G\s*([a-zA-Z][a-zA-Z0-9]*)\s*(!=|<=|>=|=|<|>)\s*("(?:[^"\\\\]|\\\\.)*"|-?[0-9]+(?:\.[0-9]+)?|true|false)\s*/';
	$and     = '/\GAND\b/';
	$clauses = [];
	$offset  = 0;
	$length  = strlen($filter);

	while (true) {
		if (!preg_match($term, $filter, $match, 0, $offset)) {
			throw mcp_filter_error('filter is not valid at position ' . ($offset + 1) . '.');
		}

		$offset += strlen($match[0]);

		[, $field, $operator, $literal] = $match;

		if (empty($fields[$field]['filter'])) {
			throw mcp_filter_error('filter does not support the field "' . $field . '".');
		}

		$spec = $fields[$field];

		if ($literal[0] === '"') {
			$value = stripcslashes(substr($literal, 1, -1));
		} elseif ($literal === 'true' || $literal === 'false') {
			if ($spec['type'] !== 'bool') {
				throw mcp_filter_error('filter compares "' . $field . '" with a boolean.');
			}

			$value = $literal === 'true';
		} else {
			$value = $literal;
		}

		if ($spec['type'] === 'bool' && $operator !== '=' && $operator !== '!=') {
			throw mcp_filter_error('filter can only test "' . $field . '" for equality.');
		}

		$stored = mcp_filter_value($spec, $value);

		if ($stored === null) {
			throw mcp_filter_error('filter has an invalid value for "' . $field . '".');
		}

		$clauses[] = $spec['column'] . ' ' . $operator . ' ' . (is_int($stored) ? (string) $stored : db_qstr($stored));

		if ($offset >= $length) {
			break;
		}

		if (!preg_match($and, $filter, $match, 0, $offset)) {
			throw mcp_filter_error('filter is not valid at position ' . ($offset + 1) . '.');
		}

		$offset += strlen($match[0]);
	}

	return implode(' AND ', $clauses);
}

/**
 * Convert a filter literal to the stored representation of a field; null when it does not fit.
 *
 * @param array<string, mixed> $spec  Field specification from the resource field map.
 * @param mixed                $value Parsed literal value.
 * @return int|string|null Stored database representation, or null if incompatible.
 */
function mcp_filter_value(array $spec, mixed $value) : int|string|null {
	switch ($spec['type']) {
		case 'bool':
			return is_bool($value) ? ($value ? 'on' : '') : null;
		case 'int':
			return is_string($value) && preg_match('/^-?[0-9]+$/', $value) ? (int) $value : null;
		case 'reference':
			if (is_string($value) && preg_match('#^' . preg_quote($spec['collection'], '#') . '/([0-9]+)$#', $value, $m)) {
				return (int) $m[1];
			}

			return null;
		case 'enum':
			$stored = array_search($value, $spec['values'], true);

			return $stored === false ? null : $stored;
		default:
			return is_string($value) ? $value : null;
	}
}

/**
 * Translate an AIP-132 orderBy into SQL using fields marked 'order'.
 *
 * @param string                              $orderBy AIP-132 orderBy clause.
 * @param array<string, array<string, mixed>> $fields  Allowed field specifications.
 * @param string                              $default SQL used when orderBy is empty.
 * @return string SQL ORDER BY fragment.
 */
function mcp_order_sql(string $orderBy, array $fields, string $default) : string {
	$orderBy = trim($orderBy);

	if ($orderBy === '') {
		return $default;
	}

	$parts = [];

	foreach (explode(',', $orderBy) as $item) {
		if (!preg_match('/^\s*([a-zA-Z][a-zA-Z0-9]*)(?:\s+(desc|asc))?\s*$/', $item, $m) || empty($fields[$m[1]]['order'])) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS', '',
				[['field' => 'orderBy', 'description' => 'orderBy is not valid: "' . trim($item) . '".']]);
		}

		$parts[] = $fields[$m[1]]['column'] . (isset($m[2]) && $m[2] === 'desc' ? ' DESC' : ' ASC');
	}

	return implode(', ', $parts);
}
