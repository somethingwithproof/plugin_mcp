<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* HTTP handler for the abilities API (api.php). It takes the request as plain
 * values and returns the response as data, so tests run it without Cacti. */

require_once __DIR__ . '/registry.php';
require_once __DIR__ . '/aip.php';

/**
 * The AIP-193 response for an error, with the headers the status calls for.
 *
 * @param Throwable $error   Thrown error or exception.
 * @param string    $ability Ability ID associated with the request, if any.
 * @return array{status: int, headers: array<string, string>, body: array}
 */
function mcp_api_error(Throwable $error, string $ability = '') : array {
	if (!$error instanceof AbilitiesError) {
		mcp_log_failure($ability, 'INTERNAL_ERROR', $error);
		$error = new AbilitiesError('INTERNAL', 'INTERNAL_ERROR');
	} elseif ($error->status === 'INTERNAL') {
		mcp_log_failure($ability, $error->reason, $error);
	}
	$headers = $error->httpStatus() === 401 ? ['WWW-Authenticate' => 'Bearer'] : [];

	return ['status' => $error->httpStatus(), 'headers' => $headers, 'body' => mcp_error_body($error)];
}

/**
 * Build the Ability resource payload for a registry descriptor.
 *
 * @param array<string, mixed> $descriptor Registry ability descriptor.
 * @return array<string, mixed> Ability REST resource array.
 */
function mcp_api_ability(array $descriptor) : array {
	return [
		'name'         => 'abilities/' . $descriptor['id'],
		'displayName'  => $descriptor['label'],
		'description'  => $descriptor['description'],
		'category'     => $descriptor['category'],
		'inputSchema'  => mcp_schema_json($descriptor['inputSchema']),
		'outputSchema' => mcp_schema_json($descriptor['outputSchema']),
		'annotations'  => $descriptor['annotations'],
	];
}

/**
 * Construct an INVALID_ARGUMENTS error for a specific request field.
 *
 * @param string $field       Offending field name.
 * @param string $description Human-readable validation violation.
 * @return AbilitiesError Error instance.
 */
function mcp_api_invalid(string $field, string $description) : AbilitiesError {
	return new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS', '', [['field' => $field, 'description' => $description]]);
}

/**
 * Read a query parameter that must be a string.
 *
 * @param array<string, mixed> $query Query string parameters.
 * @param string               $name  Parameter name.
 * @return ?string Parameter value, or null if absent.
 */
function mcp_api_query_string(array $query, string $name) : ?string {
	if (!isset($query[$name])) {
		return null;
	}

	if (!is_string($query[$name])) {
		throw mcp_api_invalid($name, 'Must be given once, as a string.');
	}

	return $query[$name];
}

/**
 * List abilities with pageSize, pageToken, and filter of the form category = "...".
 *
 * @param array<string, mixed> $query     Query parameters.
 * @param AbilitiesRegistry    $registry  Ability registry instance.
 * @param array                $principal Authenticated request principal.
 * @return array<string, mixed> Paginated list response.
 */
function mcp_api_list(array $query, AbilitiesRegistry $registry, array $principal) : array {
	$filter   = mcp_api_query_string($query, 'filter') ?? '';
	$category = null;

	if (trim($filter) !== '') {
		if (!preg_match('/^\s*category\s*=\s*"((?:[^"\\\\]|\\\\.)*)"\s*$/D', $filter, $match)) {
			throw mcp_filter_error('filter supports only: category = "<category>".');
		}
		$category = stripcslashes($match[1]);
	}

	$args     = new stdClass();
	$pageSize = mcp_api_query_string($query, 'pageSize');

	if ($pageSize !== null) {
		if (!preg_match('/^[0-9]+$/D', $pageSize)) {
			throw mcp_api_invalid('pageSize', 'Must be a non-negative integer.');
		}
		$args->pageSize = (int) $pageSize;
	}
	$args->pageToken = mcp_api_query_string($query, 'pageToken') ?? '';
	$print           = hash('sha256', 'abilities|' . ($category ?? ''));
	$page            = mcp_page($args, $print);

	$items = array_values(array_filter($registry->discover($principal),
		fn ($descriptor) => $category === null || $descriptor['category'] === $category));
	$slice = array_slice($items, $page['offset'], $page['size']);
	$next  = $page['offset'] + $page['size'];

	return ['abilities' => array_map('mcp_api_ability', $slice),
		'nextPageToken'    => $next < count($items) ? mcp_page_token($next, $print) : null];
}

/**
 * Execute an ability; the JSON request body must be exactly {"arguments": {...}}.
 *
 * @param string            $id        Ability identifier.
 * @param string            $body      Raw JSON request body.
 * @param AbilitiesRegistry $registry  Ability registry instance.
 * @param array             $principal Authenticated request principal.
 * @param callable          $audit     Audit callback.
 * @return array<string, mixed> Execution response with requestId and result.
 */
function mcp_api_execute(string $id, string $body, AbilitiesRegistry $registry, array $principal, callable $audit) : array {
	try {
		$request = json_decode($body, false, 32, JSON_THROW_ON_ERROR);
	} catch (JsonException $error) {
		throw mcp_api_invalid('body', 'Must be a JSON object.');
	}

	if (!$request instanceof stdClass) {
		throw mcp_api_invalid('body', 'Must be a JSON object.');
	}

	if (array_diff(array_keys(get_object_vars($request)), ['arguments'])) {
		throw mcp_api_invalid('body', 'Only "arguments" is allowed.');
	}

	if (!($request->arguments ?? null) instanceof stdClass) {
		throw mcp_api_invalid('arguments', 'Must be a JSON object.');
	}

	$response = $registry->execute($principal, $id, $request->arguments, $audit);

	// An empty result is still a JSON object, not a list.
	return ['requestId' => $response['requestId'], 'result' => $response['result'] ?: new stdClass()];
}

/**
 * Route one request. Never throws: failures come back as AIP-193 responses.
 *
 * @param string               $method    HTTP method.
 * @param string               $pathInfo  Request PATH_INFO route.
 * @param array<string, mixed> $query     Query parameters.
 * @param string               $body      Raw HTTP request body.
 * @param AbilitiesRegistry    $registry  Ability registry instance.
 * @param array                $principal Authenticated request principal.
 * @param callable             $audit     Audit callback.
 * @return array{status: int, headers: array<string, string>, body: array}
 */
function mcp_api_handle(string $method, string $pathInfo, array $query, string $body,
	AbilitiesRegistry $registry, array $principal, callable $audit) : array {
	$ability = '';

	try {
		if ($method === 'GET' && $pathInfo === '/v1/abilities') {
			$result = mcp_api_list($query, $registry, $principal);
		} elseif ($method === 'GET' && preg_match('#^/v1/abilities/([^/:]+)$#D', $pathInfo, $match)) {
			$ability    = $match[1];
			$descriptor = $registry->get($principal, $match[1]);

			if ($descriptor === null) {
				throw new AbilitiesError('NOT_FOUND', 'ABILITY_NOT_FOUND');
			}
			$result = mcp_api_ability($descriptor);
		} elseif ($method === 'POST' && preg_match('#^/v1/abilities/([^/:]+):execute$#D', $pathInfo, $match)) {
			$ability = $match[1];
			$result  = mcp_api_execute($match[1], $body, $registry, $principal, $audit);
		} else {
			// The path is caller-controlled: keep printable ASCII only, so a truncated or invalid UTF-8 sequence cannot break the JSON body.
			throw new AbilitiesError('NOT_FOUND', 'UNKNOWN_PATH', "No route matches '" . preg_replace('/[^\x20-\x7e]/', '?', substr($pathInfo, 0, 200)) . "'.");
		}

		return ['status' => 200, 'headers' => [], 'body' => $result];
	} catch (Throwable $error) {
		return mcp_api_error($error, $ability);
	}
}
