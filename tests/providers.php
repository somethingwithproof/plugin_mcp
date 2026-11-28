<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

require_once __DIR__ . '/../lib/providers.php';

// mcp_time() reads stored times in the PHP default zone, so the expected strings assume UTC.
date_default_timezone_set('UTC');

$config = ['cacti_version' => '1.2.31', 'base_path' => '/tmp'];
$realms = [7 => [3, 7, 15, 19], 8 => []];
$calls  = [];
$logs   = [];
$hooks  = [];
$rows   = [];
$exposureRows  = [];
$exposureReads = 0;

for ($id = 1; $id <= 3; $id++) {
	$rows[] = [
		'id' => (string) $id, 'description' => 'Device ' . $id, 'hostname' => 'host' . $id . '.example', 'disabled' => $id === 2 ? 'on' : '',
		'host_template_id' => '5', 'site_id' => '0', 'poller_id' => '1', 'external_id' => 'netbox:' . $id, 'location' => 'Rack 1', 'notes' => 'n',
		'snmp_version' => '2', 'snmp_port' => '161', 'snmp_timeout' => '500', 'snmp_retries' => '3', 'max_oids' => '10', 'bulk_walk_size' => '-1',
		'device_threads' => '1', 'availability_method' => '2', 'ping_method' => '3', 'ping_port' => '23', 'ping_timeout' => '400', 'ping_retries' => '1',
		'status' => '3', 'availability' => '99.5', 'status_last_error' => '', 'status_fail_date' => '0000-00-00 00:00:00',
		'status_rec_date' => '2026-01-02 03:04:05', 'created' => '2025-12-31 23:59:59',
		'snmp_community' => 'private-fixture', 'snmp_password' => 'pw-fixture', 'snmp_username' => 'user-fixture',
		'snmp_priv_passphrase' => 'priv-fixture', 'snmp_auth_protocol' => 'SHA', 'snmp_priv_protocol' => 'AES', 'snmp_context' => 'ctx', 'snmp_engine_id' => 'eng'
	];
}

function check(bool $ok, string $message) : void {
	if (!$ok) {
		throw new RuntimeException($message);
	}
}

function db_qstr(string $value) : string {
	return "'" . addslashes($value) . "'";
}

function is_realm_allowed($realm, $check_user = false) {
	global $realms;

	return in_array($realm, $realms[$check_user] ?? [], true);
}

function get_allowed_devices($sql_where = '', $sql_order = 'description', $sql_limit = '', &$total_rows = 0, $user_id = 0, $device_id = 0) {
	global $rows, $calls;
	check($user_id === 7, 'Device helper must receive the token owner explicitly');
	$calls[]    = ['where' => $sql_where, 'order' => $sql_order, 'limit' => $sql_limit, 'user' => $user_id, 'device' => $device_id];
	$total_rows = count($rows);

	if ($device_id) {
		return array_values(array_filter($rows, fn ($row) => (int) $row['id'] === $device_id));
	}

	if ($sql_limit === '') {
		return $rows;
	}
	[$offset, $limit] = array_map('intval', explode(',', $sql_limit));

	return array_slice($rows, $offset, $limit);
}

function get_allowed_trees($edit = false, $return_sql = false, $sql_where = '', $sql_order = 'name', $sql_limit = '', &$total_rows = 0, $user_id = 0) {
	return [];
}

function is_tree_allowed($tree_id, $user_id = 0) {
	return true;
}

function get_allowed_graphs($sql_where = '', $sql_order = 'gtg.title_cache', $sql_limit = '', &$total_rows = 0, $user_id = 0, $graph_id = 0) {
	return [];
}

function is_graph_allowed($local_graph_id, $user_id = 0) {
	return true;
}

function read_config_option($name, $force = false) {
	return '';
}

function db_fetch_assoc_prepared($sql, $params = []) {
	global $hooks, $exposureRows, $exposureReads;

	if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
		$exposureReads++;

		return $exposureRows;
	}
	check($sql === 'SELECT name, file, function FROM plugin_hooks WHERE hook = ? AND status = 1 ORDER BY name, function' && $params === ['abilities_register'], 'Hook query');

	return $hooks;
}

function api_plugin_is_enabled($plugin) {
	return $plugin !== 'disabled';
}

function cacti_plugin_path($plugin, $relative = '') {
	// the hook functions live in this script, which include_once treats as already loaded
	return __FILE__;
}

function cacti_log($message, $output = false, $facility = '') {
	global $logs;
	$logs[] = [$message, $output, $facility];
}

function fixture_register($registrar) {
	$registrar->register('fixture-ok-one', fixture_definition('ok'));
}

function fixture_spoof($registrar) {
	$registrar->register('cacti-spoofed-thing', fixture_definition('spoof'));
}

function fixture_fail($registrar) {
	$registrar->register('fixture-half-done', fixture_definition('half'));

	throw new RuntimeException('plugin failed');
}

function fixture_never($registrar) {
	throw new LogicException('Disabled plugins must not run');
}

function fixture_definition(string $value) : array {
	return [
		'label'         => 'Fixture',
		'description'   => 'Installed provider',
		'category'      => 'inventory',
		'input_schema'  => ['type' => 'object', 'properties' => new stdClass(), 'additionalProperties' => false],
		'output_schema' => ['type' => 'object', 'properties' => ['version' => ['type' => 'string']], 'required' => ['version'], 'additionalProperties' => false],
		'annotations'   => ['readOnly' => true, 'destructive' => false, 'idempotent' => true],
		'permission'    => fn ($user) => $user === 7,
		'execute'       => fn () => ['version' => $value]
	];
}

function rejects(callable $action, string $reason) : void {
	try {
		$action();
	} catch (AbilitiesError $error) {
		check($error->reason === $reason, 'Unexpected reason ' . $error->reason);

		return;
	}

	throw new RuntimeException('Expected rejection: ' . $reason);
}

$principal = ['token_id' => 1, 'token_kind' => 'pat', 'user_id' => 7, 'scopes' => ['abilities:read']];
$audit     = function ($id, $name, $outcome) {};

// built-ins only
$registry = mcp_registry();
check(count($registry->discover($principal)) === 9, 'Nine built-ins');
check($registry->discover(['user_id' => 8] + $principal) === [], 'Provider realm isolation');
$result = $registry->execute($principal, 'cacti-get-system-info', new stdClass(), $audit);
check($result['result'] === ['cactiVersion' => '1.2.31', 'pluginVersion' => plugin_mcp_version()['version'], 'abilitiesApiVersion' => '2'], 'System info');

// device_resource_fields
$allowed = ['name', 'displayName', 'hostname', 'deviceTemplate', 'site', 'poller', 'externalId', 'location', 'notes', 'disabled',
	'snmpVersion', 'snmpPort', 'snmpTimeout', 'snmpRetries', 'maxOids', 'bulkWalkSize', 'deviceThreads', 'availabilityMethod', 'pingMethod',
	'pingPort', 'pingTimeout', 'pingRetries', 'state', 'availability', 'lastError', 'failTime', 'recoveryTime', 'createTime'];
$result = $registry->execute($principal, 'cacti-list-devices', (object) ['pageSize' => 2], $audit);
$device = $result['result']['devices'][0];
check(array_keys($device) === $allowed, 'Device keys must equal the allowed list');
check(!str_contains(json_encode($result['result']), 'fixture'), 'No credential reaches output');
check($device['name'] === 'devices/1' && $device['state'] === 'UP' && $device['availability'] === 99.5, 'Device values');
check($device['failTime'] === null && $device['recoveryTime'] === '2026-01-02T03:04:05Z' && $device['createTime'] === '2025-12-31T23:59:59Z', 'Timestamps');
check($result['result']['devices'][1]['disabled'] === true, 'Disabled flag');
check(end($calls)['user'] === 7, 'Token owner reaches helper');

// device_zero_references_null
$resource = mcp_device_resource($rows[0]);
check($resource['site'] === null && $resource['deviceTemplate'] === 'deviceTemplates/5' && $resource['poller'] === 'pollers/1', 'References');
$sparse = mcp_device_resource(['id' => '9', 'description' => 'd', 'hostname' => 'h']);
check($sparse['externalId'] === null && $sparse['createTime'] === null && $sparse['state'] === null && $sparse['disabled'] === false, 'Missing columns are null');
check(mcp_device_resource(['status' => '99'] + $rows[0])['state'] === 'UNKNOWN', 'Unknown state falls back to UNKNOWN');

// get-device
$result = $registry->execute($principal, 'cacti-get-device', (object) ['name' => 'devices/2'], $audit);
check($result['result']['device']['name'] === 'devices/2' && end($calls)['device'] === 2, 'Single-device lookup');

try {
	$registry->execute($principal, 'cacti-get-device', (object) ['name' => 'devices/99'], $audit);

	throw new LogicException('An unavailable device must be rejected');
} catch (AbilitiesError $error) {
	check($error->reason === 'DEVICE_NOT_FOUND' && $error->status === 'NOT_FOUND', 'Unavailable device error');
}

foreach (['devices/0', 'devices/01', 'devices/12345678901', 'sites/1', 'devices/1/x', "devices/1\n"] as $badName) {
	rejects(fn () => $registry->execute($principal, 'cacti-get-device', (object) ['name' => $badName], $audit), 'INVALID_ARGUMENTS');
}

// filter_literal_escaped: the WHERE fragment runs inside the subquery that aliases host as h
$registry->execute($principal, 'cacti-list-devices', (object) ['filter' => 'displayName = "x\" OR 1=1"'], $audit);
check(end($calls)['where'] === "h.description = 'x\\\" OR 1=1'", 'Filter literal escaped: ' . end($calls)['where']);
$registry->execute($principal, 'cacti-list-devices', (object) ['filter' => 'state = "UP" AND site = "sites/3" AND disabled = false'], $audit);
check(end($calls)['where'] === "h.status = 3 AND h.site_id = 3 AND h.disabled = ''", 'Typed filter columns');
rejects(fn () => $registry->execute($principal, 'cacti-list-devices', (object) ['filter' => 'snmpCommunity = "x"'], $audit), 'INVALID_FILTER');

// stable ordering: the id tie-breaker always ends the ORDER BY
foreach ([[null, 'h1.id ASC'], ['displayName desc', 'h1.description DESC, h1.id ASC'], ['hostname, name desc', 'h1.hostname ASC, h1.id DESC, h1.id ASC']] as [$orderBy, $expected]) {
	$registry->execute($principal, 'cacti-list-devices', $orderBy === null ? new stdClass() : (object) ['orderBy' => $orderBy], $audit);
	check(end($calls)['order'] === $expected, 'ORDER BY ' . end($calls)['order']);
	check(str_ends_with(end($calls)['order'], 'h1.id ASC'), 'Order ends with id tie-breaker');
}
rejects(fn () => $registry->execute($principal, 'cacti-list-devices', (object) ['orderBy' => 'snmpVersion'], $audit), 'INVALID_ARGUMENTS');

// list_next_page_token
$result = $registry->execute($principal, 'cacti-list-devices', (object) ['pageSize' => 2], $audit)['result'];
check(count($result['devices']) === 2 && end($calls)['limit'] === '0,3', 'First page fetches one extra row');
$fingerprint = sha1("\0");
check(mcp_page((object) ['pageToken' => $result['nextPageToken']], $fingerprint)['offset'] === 2, 'Token offset is offset plus size');
$result = $registry->execute($principal, 'cacti-list-devices', (object) ['pageSize' => 2, 'pageToken' => $result['nextPageToken']], $audit)['result'];
check(count($result['devices']) === 1 && $result['devices'][0]['name'] === 'devices/3' && $result['nextPageToken'] === null, 'Last page has no token');
$result = $registry->execute($principal, 'cacti-list-devices', (object) ['pageSize' => 3], $audit)['result'];
check(count($result['devices']) === 3 && $result['nextPageToken'] === null, 'Exactly full final page has no token');
rejects(fn () => $registry->execute($principal, 'cacti-list-devices', (object) ['filter' => 'hostname = "a"', 'pageToken' => mcp_page_token(2, $fingerprint)], $audit), 'INVALID_PAGE_TOKEN');
check(count($registry->execute($principal, 'cacti-list-devices', (object) ['pageSize' => 1000], $audit)['result']['devices']) === 3, 'Large page size clamps');

// plugin_registration_isolated
$hooks = [
	['name' => 'fixture', 'file' => 'setup.php', 'function' => 'fixture_fail'],
	['name' => 'disabled', 'file' => 'setup.php', 'function' => 'fixture_never'],
	['name' => 'traversal', 'file' => '../setup.php', 'function' => 'fixture_never'],
	['name' => 'missing', 'file' => 'setup.php', 'function' => 'fixture_not_defined']
];
$logs     = [];
$registry = mcp_registry();
check(count($registry->discover($principal)) === 9, 'A failing plugin leaves only the built-ins');
check($registry->get($principal, 'fixture-half-done') === null, 'Partial registration discarded');
check(count(array_filter($logs, fn ($log) => str_contains($log[0], 'registration failed'))) === 1, 'Failure logged once');
check($logs[0] === ['MCP: ability registration failed for plugin fixture (RuntimeException)', false, 'MCP'], 'Failure log text');

// an anonymous exception from a plugin hook is logged without its generated class name
function fixture_anonymous($registrar) {
	throw new class('plugin failed') extends RuntimeException {};
}

$hooks = [['name' => 'fixture', 'file' => 'setup.php', 'function' => 'fixture_anonymous']];
$logs  = [];
mcp_registry();
check($logs === [['MCP: ability registration failed for plugin fixture (RuntimeException@anonymous)', false, 'MCP']], 'Anonymous exception logged by parent: ' . json_encode($logs));

// reserved_namespace: a plugin named cacti cannot register as a built-in
$hooks = [['name' => 'cacti', 'file' => 'setup.php', 'function' => 'fixture_register'], ['name' => 'cacti', 'file' => 'setup.php', 'function' => 'fixture_spoof']];
$logs  = [];
check(count(mcp_registry()->all()) === 9 && !array_intersect(['fixture-ok-one', 'cacti-spoofed-thing'], array_column(mcp_registry()->all(), 'id')), 'Plugin named cacti is skipped, even for a cacti-* id');
check($logs[0] === ['MCP: ability registration skipped for plugin cacti: reserved namespace', false, 'MCP'], 'Reserved namespace logged');

// a later healthy plugin still registers after a failing one
$hooks    = [$hooks[0], ['name' => 'fixture', 'file' => 'setup.php', 'function' => 'fixture_register']];
$registry = mcp_registry();
check(count($registry->discover($principal)) === 9, 'A plugin ability is hidden until an admin exposes it');
check($registry->get($principal, 'fixture-ok-one') === null, 'Hidden plugin ability is absent');
rejects(fn () => $registry->execute($principal, 'fixture-ok-one', new stdClass(), $audit), 'ABILITY_NOT_FOUND');
$exposureRows = [['id' => 'fixture-ok-one', 'exposed' => '1'], ['id' => 'cacti-get-device', 'exposed' => '0']];
mcp_exposure_map(true);
$ids = array_column($registry->discover($principal), 'id');
check(count($ids) === 9 && in_array('fixture-ok-one', $ids, true) && !in_array('cacti-get-device', $ids, true), 'Stored exposure overrides the defaults');
check($registry->execute($principal, 'fixture-ok-one', new stdClass(), $audit)['result']['version'] === 'ok', 'Plugin ability executes');
$reads = $exposureReads;
$registry->discover($principal);
$registry->get($principal, 'fixture-ok-one');
check($exposureReads === $reads, 'Exposure map is read once per request, not per ability');
print "Native provider permissions, paging, filtering, resource shape, and plugin isolation checks passed.\n";
