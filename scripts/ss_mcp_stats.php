<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Cacti PHP Script Server telemetry for plugin_mcp.
 *
 * Emits safe, secret-free aggregate metrics in Cacti field:value format:
 *   abilities_total, abilities_enabled, active_tokens,
 *   audit_events_24h, capability_blocks
 *
 * Missing tables or failed queries emit RRDtool 'U' (unknown) rather than 0
 * so graphs record an honest gap instead of injecting false zero values. */

/** Ordered list of Cacti script-server telemetry keys emitted by MCP. */
const MCP_SCRIPT_SERVER_METRIC_KEYS = [
	'abilities_total',
	'abilities_enabled',
	'active_tokens',
	'audit_events_24h',
	'capability_blocks',
];

/**
 * Return an all-unknown ('U') metric map for error or unavailable-database paths.
 *
 * @return array<string, string>
 */
function mcp_script_server_unknown_metrics() : array {
	$metrics = [];

	foreach (MCP_SCRIPT_SERVER_METRIC_KEYS as $key) {
		$metrics[$key] = 'U';
	}

	return $metrics;
}

/**
 * Query a non-negative integer scalar counter, returning 'U' on missing tables or DB failure.
 *
 * @param string            $table  Required table name checked before querying.
 * @param string            $sql    Prepared SELECT COUNT(*) query.
 * @param array<int, mixed> $params Bound query parameters.
 * @return int|string Non-negative integer count, or 'U' on failure.
 */
function mcp_script_server_count(string $table, string $sql, array $params = []) : int|string {
	if (!function_exists('db_table_exists') || !function_exists('db_fetch_cell_prepared')) {
		return 'U';
	}

	if (!db_table_exists($table)) {
		return 'U';
	}

	$value = db_fetch_cell_prepared($sql, $params);

	if ($value === false || $value === null || !is_numeric($value)) {
		return 'U';
	}

	$intValue = (int) $value;

	return $intValue >= 0 ? $intValue : 'U';
}

/**
 * Collect safe, secret-free MCP plugin telemetry counters.
 *
 * `audit_events_24h` counts audit rows started in the last 86,400 seconds.
 * `capability_blocks` counts total recorded 'denied' and 'rejected' outcomes
 * in plugin_mcp_audit.
 *
 * @param ?int               $now      Optional Unix timestamp override for deterministic tests.
 * @param ?AbilitiesRegistry $registry Optional prebuilt registry override for testing.
 * @return array<string, int|string> Metric map keyed by MCP_SCRIPT_SERVER_METRIC_KEYS.
 */
function mcp_collect_stats(?int $now = null, ?AbilitiesRegistry $registry = null) : array {
	$now     = $now ?? time();
	$metrics = mcp_script_server_unknown_metrics();

	try {
		if (!function_exists('mcp_registry')) {
			require_once dirname(__DIR__) . '/lib/providers.php';
		}

		$reg         = $registry ?? mcp_registry();
		$all         = $reg->all();
		$exposureMap = mcp_exposure_map();

		if (($exposureMap['*'] ?? true) === false) {
			$metrics['abilities_total']   = count($all);
			$metrics['abilities_enabled'] = 'U';
		} else {
			$enabled = 0;

			foreach ($all as $ability) {
				$id        = (string) ($ability['id'] ?? '');
				$namespace = (string) ($ability['namespace'] ?? 'cacti');

				if ($id !== '' && mcp_is_exposed($id, $namespace, $exposureMap)) {
					$enabled++;
				}
			}

			$metrics['abilities_total']   = count($all);
			$metrics['abilities_enabled'] = $enabled;
		}
	} catch (Throwable $error) {
		$metrics['abilities_total']   = 'U';
		$metrics['abilities_enabled'] = 'U';
	}

	try {
		$metrics['active_tokens'] = mcp_script_server_count(
			'plugin_mcp_token',
			'SELECT COUNT(*) FROM plugin_mcp_token WHERE revoked = 0 AND expires_at > ?',
			[$now]
		);
		$metrics['audit_events_24h'] = mcp_script_server_count(
			'plugin_mcp_audit',
			'SELECT COUNT(*) FROM plugin_mcp_audit WHERE started_at >= ?',
			[$now - 86400]
		);
		$metrics['capability_blocks'] = mcp_script_server_count(
			'plugin_mcp_audit',
			"SELECT COUNT(*) FROM plugin_mcp_audit WHERE outcome IN ('denied', 'rejected')",
			[]
		);
	} catch (Throwable $error) {
		$metrics['active_tokens']     = 'U';
		$metrics['audit_events_24h']  = 'U';
		$metrics['capability_blocks'] = 'U';
	}

	return $metrics;
}

/**
 * Format MCP self-graphing counters as a Cacti script-server field:value line.
 *
 * @param array<string, int|string> $metrics Metric values keyed by MCP_SCRIPT_SERVER_METRIC_KEYS.
 * @return string Space-separated field:value string containing only integers or 'U'.
 */
function mcp_format_script_server_metrics(array $metrics) : string {
	$parts = [];

	foreach (MCP_SCRIPT_SERVER_METRIC_KEYS as $key) {
		$raw     = $metrics[$key] ?? 'U';
		$value   = (is_int($raw) && $raw >= 0) ? (string) $raw : 'U';
		$parts[] = $key . ':' . $value;
	}

	return implode(' ', $parts);
}

/**
 * Cacti PHP Script Server entry point emitting secret-free MCP plugin telemetry.
 *
 * @param ?int               $now      Optional Unix timestamp override for testing.
 * @param ?AbilitiesRegistry $registry Optional prebuilt registry override for testing.
 * @return string Cacti field:value telemetry line.
 */
function ss_mcp_stats(?int $now = null, ?AbilitiesRegistry $registry = null) : string {
	return mcp_format_script_server_metrics(mcp_collect_stats($now, $registry));
}

if (!isset($called_by_script_server)
	&& PHP_SAPI === 'cli'
	&& isset($_SERVER['SCRIPT_FILENAME'])
	&& realpath((string) $_SERVER['SCRIPT_FILENAME']) === realpath(__FILE__)) {
	$cactiBase = dirname(__DIR__, 3);

	if (is_file($cactiBase . '/include/cli_check.php')) {
		chdir($cactiBase);
		include_once './include/cli_check.php';
		include_once './plugins/mcp/lib/providers.php';
		print ss_mcp_stats() . PHP_EOL;
	} else {
		print mcp_format_script_server_metrics(mcp_script_server_unknown_metrics()) . PHP_EOL;
	}
}
