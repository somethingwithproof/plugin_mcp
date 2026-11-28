<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

require_once __DIR__ . '/../../setup.php';
require_once __DIR__ . '/../../lib/admin.php';
require_once __DIR__ . '/../../lib/aip.php';
require_once __DIR__ . '/../../lib/api_http.php';
require_once __DIR__ . '/../../lib/bootstrap.php';
require_once __DIR__ . '/../../lib/capability_guard.php';
require_once __DIR__ . '/../../lib/integrations.php';
require_once __DIR__ . '/../../lib/mcp_server.php';
require_once __DIR__ . '/../../lib/origin.php';
require_once __DIR__ . '/../../lib/providers.php';
require_once __DIR__ . '/../../lib/registry.php';
require_once __DIR__ . '/../../lib/storage.php';

/**
 * Reset shared PHPUnit Cacti stub state to clean defaults.
 *
 * @return void
 */
function mcp_unit_reset_state() : void {
	$GLOBALS['mcp_unit_state'] = [
		'realms'          => [],
		'sites'           => [],
		'pollers'         => [],
		'trees'           => [],
		'allowed_trees'   => [],
		'graphs'          => [],
		'allowed_graphs'  => [],
		'devices'         => [],
		'allowed_devices' => [],
		'data_sources'    => [],
		'settings'        => [],
		'queries'         => [],
		'logs'            => [],
		'tables'          => [],
		'columns'         => [],
		'hooks'           => [],
		'realms_written'  => [],
		'enabled_plugins' => ['mcp' => true],
		'affected_rows'   => 0,
		'callbacks'       => [],
	];
}

mcp_unit_reset_state();

if (!function_exists('__')) {
	function __(string $text, mixed ...$args) : string {
		return $text;
	}
}

if (!function_exists('db_qstr')) {
	function db_qstr(string $value) : string {
		return "'" . addslashes($value) . "'";
	}
}

if (!function_exists('read_config_option')) {
	function read_config_option(string $name, bool $force = false) : mixed {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['read_config_option'])) {
			return ($GLOBALS['mcp_unit_state']['callbacks']['read_config_option'])($name, $force);
		}

		return $GLOBALS['mcp_unit_state']['settings'][$name] ?? '';
	}
}

if (!function_exists('set_config_option')) {
	function set_config_option(string $name, mixed $value) : void {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['set_config_option'])) {
			($GLOBALS['mcp_unit_state']['callbacks']['set_config_option'])($name, $value);

			return;
		}
		$GLOBALS['mcp_unit_state']['settings'][$name] = $value;
	}
}

if (!function_exists('is_realm_allowed')) {
	function is_realm_allowed(int $realm, int|bool $check_user = false) : bool {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['is_realm_allowed'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['is_realm_allowed'])($realm, $check_user);
		}
		$user = is_int($check_user) ? $check_user : 0;

		return in_array($realm, $GLOBALS['mcp_unit_state']['realms'][$user] ?? [], true);
	}
}

if (!function_exists('api_plugin_is_enabled')) {
	function api_plugin_is_enabled(string $plugin) : bool {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['api_plugin_is_enabled'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['api_plugin_is_enabled'])($plugin);
		}

		return (bool) ($GLOBALS['mcp_unit_state']['enabled_plugins'][$plugin] ?? true);
	}
}

if (!function_exists('api_plugin_register_realm')) {
	function api_plugin_register_realm(string $plugin, string $file, string $display, bool $admin = true) : bool {
		$GLOBALS['mcp_unit_state']['realms_written'][] = [$plugin, $file, $display, $admin];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['api_plugin_register_realm'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['api_plugin_register_realm'])($plugin, $file, $display, $admin);
		}

		return true;
	}
}

if (!function_exists('api_plugin_register_hook')) {
	function api_plugin_register_hook(string $plugin, string $hook, string $function, string $file, bool $enable = false) : void {
		$GLOBALS['mcp_unit_state']['hooks'][] = [$plugin, $hook, $function, $file];
	}
}

if (!function_exists('cacti_log')) {
	function cacti_log(string $message, bool $output = false, string $facility = '') : bool {
		$GLOBALS['mcp_unit_state']['logs'][] = [$message, $output, $facility];

		return true;
	}
}

if (!function_exists('cacti_session_start')) {
	function cacti_session_start() : void {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'cacti_session_start'];
	}
}

if (!function_exists('cacti_session_close')) {
	function cacti_session_close() : void {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'cacti_session_close'];
	}
}

if (!function_exists('db_table_exists')) {
	function db_table_exists(string $table, bool $log = true, mixed $db_conn = false) : bool {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_table_exists'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['db_table_exists'])($table);
		}

		return (bool) ($GLOBALS['mcp_unit_state']['tables'][$table] ?? false);
	}
}

if (!function_exists('db_column_exists')) {
	function db_column_exists(string $table, string $column, bool $log = true, mixed $db_conn = false) : bool {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_column_exists'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['db_column_exists'])($table, $column);
		}

		return (bool) ($GLOBALS['mcp_unit_state']['columns'][$table][$column] ?? true);
	}
}

if (!function_exists('db_add_column')) {
	function db_add_column(string $table, array $column, bool $log = true, mixed $db_conn = false) : bool {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_add_column'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['db_add_column'])($table, $column);
		}
		$GLOBALS['mcp_unit_state']['columns'][$table][(string) ($column['name'] ?? '')] = true;

		return true;
	}
}

if (!function_exists('db_execute')) {
	function db_execute(string $sql, bool $log = true, mixed $db_conn = false) : bool {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'db_execute', 'sql' => $sql];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_execute'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['db_execute'])($sql);
		}

		if (preg_match('/^CREATE TABLE IF NOT EXISTS (\w+)/', $sql, $matches)) {
			$GLOBALS['mcp_unit_state']['tables'][$matches[1]] = true;
		}

		return true;
	}
}

if (!function_exists('db_execute_prepared')) {
	function db_execute_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : bool {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'db_execute_prepared', 'sql' => $sql, 'params' => $params];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_execute_prepared'])) {
			return (bool) ($GLOBALS['mcp_unit_state']['callbacks']['db_execute_prepared'])($sql, $params);
		}

		return true;
	}
}

if (!function_exists('db_affected_rows')) {
	function db_affected_rows(mixed $db_conn = false) : int {
		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_affected_rows'])) {
			return (int) ($GLOBALS['mcp_unit_state']['callbacks']['db_affected_rows'])();
		}

		return (int) ($GLOBALS['mcp_unit_state']['affected_rows'] ?? 0);
	}
}

if (!function_exists('db_fetch_cell_prepared')) {
	function db_fetch_cell_prepared(string $sql, array $params = [], string $col_name = '', bool $log = true, mixed $db_conn = false) : mixed {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'db_fetch_cell_prepared', 'sql' => $sql, 'params' => $params];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'])) {
			return ($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'])($sql, $params);
		}

		return false;
	}
}

if (!function_exists('db_fetch_row_prepared')) {
	function db_fetch_row_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : array|false {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'db_fetch_row_prepared', 'sql' => $sql, 'params' => $params];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'])) {
			return ($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'])($sql, $params);
		}

		return false;
	}
}

if (!function_exists('get_allowed_devices')) {
	function get_allowed_devices(string $sql_where = '', string $sql_order = 'description', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0, int $device_id = 0) : array {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'get_allowed_devices', 'where' => $sql_where, 'order' => $sql_order, 'limit' => $sql_limit, 'user' => $user_id];
		$rows       = $GLOBALS['mcp_unit_state']['devices'][$user_id] ?? [];
		$total_rows = count($rows);

		if ($device_id > 0) {
			return array_values(array_filter($rows, fn (array $r) => (int) $r['id'] === $device_id));
		}

		if ($sql_limit === '') {
			return $rows;
		}
		[$offset, $limit] = array_map('intval', explode(',', $sql_limit));

		return array_slice($rows, $offset, $limit);
	}
}

if (!function_exists('is_device_allowed')) {
	function is_device_allowed(int $device_id, int $user_id = 0) : bool {
		return in_array($device_id, $GLOBALS['mcp_unit_state']['allowed_devices'][$user_id] ?? [], true);
	}
}

if (!function_exists('get_allowed_trees')) {
	function get_allowed_trees(bool $edit = false, bool $return_sql = false, string $sql_where = '', string $sql_order = 'name', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0) : array {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'get_allowed_trees', 'where' => $sql_where, 'order' => $sql_order, 'limit' => $sql_limit, 'user' => $user_id];
		$rows       = $GLOBALS['mcp_unit_state']['trees'];
		$total_rows = count($rows);

		if ($sql_limit === '') {
			return $rows;
		}
		[$offset, $limit] = array_map('intval', explode(',', $sql_limit));

		return array_slice($rows, $offset, $limit);
	}
}

if (!function_exists('is_tree_allowed')) {
	function is_tree_allowed(int $tree_id, int $user_id = 0) : bool {
		return in_array($tree_id, $GLOBALS['mcp_unit_state']['allowed_trees'][$user_id] ?? [], true);
	}
}

if (!function_exists('get_allowed_graphs')) {
	function get_allowed_graphs(string $sql_where = '', string $sql_order = 'gtg.title_cache', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0, int $graph_id = 0) : array {
		$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'get_allowed_graphs', 'where' => $sql_where, 'order' => $sql_order, 'limit' => $sql_limit, 'user' => $user_id];
		$rows       = $GLOBALS['mcp_unit_state']['graphs'];
		$total_rows = count($rows);

		if ($sql_limit === '') {
			return $rows;
		}
		[$offset, $limit] = array_map('intval', explode(',', $sql_limit));

		return array_slice($rows, $offset, $limit);
	}
}

if (!function_exists('is_graph_allowed')) {
	function is_graph_allowed(int $local_graph_id, int $user_id = 0) : bool {
		return in_array($local_graph_id, $GLOBALS['mcp_unit_state']['allowed_graphs'][$user_id] ?? [], true);
	}
}

if (!function_exists('db_fetch_assoc_prepared')) {
	function db_fetch_assoc_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : array|false {
		$GLOBALS['mcp_unit_state']['queries'][] = ['sql' => $sql, 'params' => $params];

		if (isset($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'])) {
			return ($GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'])($sql, $params);
		}

		if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
			return [];
		}

		if (str_contains($sql, 'FROM plugin_hooks')) {
			return [];
		}

		$slice = function (array $rows, string $query) : array {
			if (preg_match('/LIMIT (\d+) OFFSET (\d+)/', $query, $m)) {
				return array_slice($rows, (int) $m[2], (int) $m[1]);
			}

			return $rows;
		};

		if (str_contains($sql, 'FROM sites AS s')) {
			return $slice($GLOBALS['mcp_unit_state']['sites'], $sql);
		}

		if (str_contains($sql, 'FROM poller AS p')) {
			return $slice($GLOBALS['mcp_unit_state']['pollers'], $sql);
		}

		if (str_contains($sql, 'FROM data_local AS dl')) {
			$filtered = array_values(array_filter(
				$GLOBALS['mcp_unit_state']['data_sources'],
				fn (array $row) => in_array((int) $row['host_id'], $params, true)
			));

			return $slice($filtered, $sql);
		}

		return [];
	}
}
