<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

require_once __DIR__ . '/lib/integrations.php';

/**
 * Install the MCP plugin schema, realms, and Cacti hooks.
 *
 * @return void
 * @throws RuntimeException When the PHP floor, schema, or readiness checks fail.
 */
function plugin_mcp_install() {
	if (version_compare(PHP_VERSION, '8.2', '<')) {
		throw new RuntimeException('MCP requires PHP 8.2 or later');
	}
	require_once __DIR__ . '/lib/storage.php';
	mcp_install_schema();

	// One realm row covers the endpoints and the self-service page. Cacti matches an existing row by
	// file and updates its file list, so a reinstall keeps the users who already hold the realm.
	api_plugin_register_realm('mcp', MCP_REALM_FILES, __('MCP and Abilities API', 'mcp'), false);

	// The console page needs its own realm; the installing admin gets it.
	api_plugin_register_realm('mcp', 'mcp_admin.php', __('MCP Administration', 'mcp'), true);

	api_plugin_register_hook('mcp', 'config_settings', 'mcp_config_settings', 'setup.php');
	api_plugin_register_hook('mcp', 'config_arrays', 'mcp_config_arrays', 'setup.php');
	api_plugin_register_hook('mcp', 'draw_navigation_text', 'mcp_draw_navigation_text', 'setup.php');
	api_plugin_register_hook('mcp', 'casc_register_providers', 'mcp_casc_register_providers', 'setup.php');
	api_plugin_register_hook('mcp', 'doctor_register_checks', 'mcp_doctor_register_checks', 'setup.php');
	api_plugin_register_hook('mcp', 'doctor_register_debug_info', 'mcp_doctor_register_debug_info', 'setup.php');
	api_plugin_register_hook('mcp', 'api_register_resources', 'mcp_api_register_resources', 'setup.php');

	if (!plugin_mcp_check_config()) {
		throw new RuntimeException(__('MCP installation is incomplete', 'mcp'));
	}
}

/**
 * Register MCP settings tab and Public Cacti URL option.
 *
 * @return void
 */
function mcp_config_settings() {
	global $tabs, $settings;

	$tabs['mcp']     = __('MCP', 'mcp');
	$settings['mcp'] = [
		'mcp_public_url' => [
			'friendly_name' => __('Public Cacti URL', 'mcp'),
			'description'   => __('The address MCP clients use to reach this Cacti server, for example https://cacti.example.com/cacti. Required before the MCP endpoint answers.', 'mcp'),
			'method'        => 'textbox',
			'default'       => '',
			'max_length'    => 255,
			'size'          => 60
		]
	];
}

/**
 * Register MCP console and self-service menu entries under Management.
 *
 * @return void
 */
function mcp_config_arrays() {
	global $menu;

	$menu[__('Management')]['plugins/mcp/mcp_admin.php'] = __('MCP', 'mcp');

	// Cacti's menu hides an item unless the user holds the realm of its file, and the realm
	// row lists mcp_tokens.php, so only holders of the MCP and Abilities API realm see this.
	$menu[__('Management')]['plugins/mcp/mcp_tokens.php'] = __('My MCP Tokens', 'mcp');
}

/**
 * Add MCP console and self-service entries to Cacti navigation breadcrumbs.
 *
 * @param array<string, mixed> $nav Existing navigation map.
 * @return array<string, mixed> Updated navigation map.
 */
function mcp_draw_navigation_text($nav) {
	$nav['mcp_admin.php:']        = ['title' => __('MCP Administration', 'mcp'), 'mapping' => 'index.php:', 'url' => 'mcp_admin.php', 'level' => '1'];
	$nav['mcp_admin.php:actions'] = ['title' => __('Actions', 'mcp'), 'mapping' => 'index.php:,mcp_admin.php:', 'url' => '', 'level' => '2'];

	$nav['mcp_tokens.php:'] = ['title' => __('My MCP Tokens', 'mcp'), 'mapping' => 'index.php:', 'url' => 'mcp_tokens.php', 'level' => '1'];

	return $nav;
}

/**
 * Revoke all personal tokens on uninstall while retaining audit and exposure history.
 *
 * @return void
 * @throws RuntimeException When token revocation fails.
 */
function plugin_mcp_uninstall() {
	// Preserve audit history, but reinstalling must not reactivate old tokens.
	if (db_table_exists('plugin_mcp_token')
		&& !db_execute('UPDATE plugin_mcp_token SET revoked = 1')) {
		throw new RuntimeException('MCP token revocation failed');
	}
}

/**
 * Verify that the PHP runtime, database schema, and API realm are ready to enable MCP.
 *
 * @return bool True when all installation prerequisites are satisfied.
 */
function plugin_mcp_check_config() {
	require_once __DIR__ . '/lib/storage.php';

	return version_compare(PHP_VERSION, '8.2', '>=')
		&& db_table_exists('plugin_mcp_token')
		&& db_table_exists('plugin_mcp_audit')
		&& db_table_exists('plugin_mcp_ability')
		&& (int) db_fetch_cell_prepared(
			'SELECT id FROM plugin_realms WHERE plugin = ? AND file = ?',
			['mcp', MCP_REALM_FILES]
		) > 0;
}

/**
 * Handle plugin upgrade checks for Cacti's plugin lifecycle.
 *
 * @return bool Always false until an explicit upgrade path is added.
 */
function plugin_mcp_upgrade() {
	return false;
}

/**
 * Return plugin metadata parsed from the INFO file.
 *
 * @return array<string, mixed> Parsed [info] section or empty array on failure.
 */
function plugin_mcp_version() {
	$info = parse_ini_file(__DIR__ . '/INFO', true);

	return is_array($info) && isset($info['info']) ? $info['info'] : [];
}
