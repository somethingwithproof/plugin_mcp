<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

if (!defined('CACTI_PATH_PLUGINS')) {
	define('CACTI_PATH_PLUGINS', '');
}
if (!defined('CACTI_PATH_LOG')) {
	define('CACTI_PATH_LOG', '');
}

function __(string $text, mixed ...$args) : string {
	return $text;
}

function read_config_option(string $config_name, bool $force = false) : mixed {
	return null;
}

function is_realm_allowed(int $realm, int|bool $check_user = false) : bool {
	return false;
}

function api_plugin_is_enabled(string $plugin) : bool {
	return false;
}

function api_plugin_register_realm(string $plugin, string $file, string $display, bool $admin = false) : bool {
	return true;
}

function api_plugin_register_hook(string $plugin, string $hook, string $function, string $file, bool $enable = false) : void {
}

function cacti_plugin_path(string $plugin, string $relative = '') : string|false {
	return false;
}

function cacti_log(string $string, bool $output = false, string $environ = 'CMDPHP', int|string $level = '') : bool {
	return true;
}

function cacti_session_start() : void {
}

function cacti_session_close() : void {
}

function db_qstr(string $value) : string {
	return $value;
}

function db_execute(string $sql, bool $log = true, mixed $db_conn = false) : bool {
	return true;
}

/** @param array<int, mixed> $params */
function db_execute_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : bool {
	return true;
}

function db_affected_rows(mixed $db_conn = false) : int {
	return 0;
}

function db_table_exists(string $table, bool $log = true, mixed $db_conn = false) : bool {
	return true;
}

function db_column_exists(string $table, string $column, bool $log = true, mixed $db_conn = false) : bool {
	return true;
}

/** @param array<string, mixed> $data */
function db_add_column(string $table, array $data, bool $log = true, mixed $db_conn = false) : bool {
	return true;
}

/** @param array<int, mixed> $params */
function db_fetch_cell_prepared(string $sql, array $params = [], string $col_name = '', bool $log = true, mixed $db_conn = false) : mixed {
	return false;
}

/**
 * @param array<int, mixed> $params
 * @return array<string, mixed>|false
 */
function db_fetch_row_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : array|false {
	return false;
}

/**
 * @param array<int, mixed> $params
 * @return array<int, array<string, mixed>>|false
 */
function db_fetch_assoc_prepared(string $sql, array $params = [], bool $log = true, mixed $db_conn = false) : array|false {
	return [];
}

/** @return array<int, array<string, mixed>>|false */
function get_allowed_devices(string $sql_where = '', string $sql_order = 'description', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0, int $device_id = 0) : array|false {
	return [];
}

/** @return array<int, array<string, mixed>>|false */
function get_allowed_trees(bool $edit = false, bool $return_sql = false, string $sql_where = '', string $sql_order = 'name', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0) : array|false {
	return [];
}

function is_tree_allowed(int $tree_id, int $user_id = 0) : bool {
	return false;
}

/** @return array<int, array<string, mixed>>|false */
function get_allowed_graphs(string $sql_where = '', string $sql_order = 'gtg.title_cache', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0, int $graph_id = 0) : array|false {
	return [];
}

function is_graph_allowed(int $local_graph_id, int $user_id = 0) : bool {
	return false;
}

function is_device_allowed(int $device_id, int $user_id = 0) : bool {
	return false;
}
