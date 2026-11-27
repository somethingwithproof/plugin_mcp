<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace {
	require_once __DIR__ . '/../../lib/providers.php';

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
	];

	if (!function_exists('db_qstr')) {
		function db_qstr(string $value) : string {
			return "'" . addslashes($value) . "'";
		}
	}

	if (!function_exists('read_config_option')) {
		function read_config_option(string $name, bool $force = false) : mixed {
			return $GLOBALS['mcp_unit_state']['settings'][$name] ?? '';
		}
	}

	if (!function_exists('is_realm_allowed')) {
		function is_realm_allowed(int $realm, int|bool $check_user = false) : bool {
			$user = is_int($check_user) ? $check_user : 0;

			return in_array($realm, $GLOBALS['mcp_unit_state']['realms'][$user] ?? [], true);
		}
	}

	if (!function_exists('api_plugin_is_enabled')) {
		function api_plugin_is_enabled(string $plugin) : bool {
			return true;
		}
	}

	if (!function_exists('cacti_log')) {
		function cacti_log(string $message, bool $output = false, string $facility = '') : bool {
			$GLOBALS['mcp_unit_state']['logs'][] = [$message, $output, $facility];

			return true;
		}
	}

	if (!function_exists('get_allowed_devices')) {
		function get_allowed_devices(string $sql_where = '', string $sql_order = 'description', string $sql_limit = '', int &$total_rows = 0, int $user_id = 0, int $device_id = 0) : array {
			$GLOBALS['mcp_unit_state']['queries'][] = ['fn' => 'get_allowed_devices', 'where' => $sql_where, 'order' => $sql_order, 'limit' => $sql_limit, 'user' => $user_id];
			$rows = $GLOBALS['mcp_unit_state']['devices'][$user_id] ?? [];
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
			$rows = $GLOBALS['mcp_unit_state']['trees'];
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
			$rows = $GLOBALS['mcp_unit_state']['graphs'];
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
}

namespace Tests\Unit {
	use AbilitiesError;
	use AbilitiesRegistry;
	use PHPUnit\Framework\TestCase;
	use stdClass;

	final class CoreAbilitiesTest extends TestCase {
		private AbilitiesRegistry $registry;
		/** @var callable */
		private $audit;
		private string $tempDir;

		protected function setUp() : void {
			date_default_timezone_set('UTC');
			$GLOBALS['config']         = ['cacti_version' => '1.2.31', 'base_path' => '/tmp'];
			$GLOBALS['mcp_unit_state'] = [
				'realms' => [
					7  => [3, 7, 15, 19],
					8  => [],
					9  => [18],
					10 => [4, 5],
				],
				'sites' => [
					[
						'id' => '1', 'name' => 'US West', 'address1' => '100 Main St', 'address2' => '',
						'city' => 'Seattle', 'state' => 'WA', 'postal_code' => '98101', 'country' => 'US',
						'timezone' => 'America/Los_Angeles', 'latitude' => '47.6062', 'longitude' => '-122.3321',
						'zoom' => '10', 'alternate_id' => 'sea-1', 'notes' => 'Primary DC',
					],
					[
						'id' => '2', 'name' => 'EU Central', 'address1' => '200 Ring', 'address2' => '',
						'city' => 'Frankfurt', 'state' => 'HE', 'postal_code' => '60311', 'country' => 'DE',
						'timezone' => 'Europe/Berlin', 'latitude' => '50.1109', 'longitude' => '8.6821',
						'zoom' => '10', 'alternate_id' => 'fra-1', 'notes' => 'Secondary DC',
					],
				],
				'pollers' => [
					[
						'id' => '1', 'disabled' => '', 'name' => 'Main Poller', 'notes' => 'Primary',
						'status' => '2', 'timezone' => 'UTC', 'hostname' => 'cacti-main.example',
						'total_time' => '12.5', 'max_time' => '25.0', 'min_time' => '5.0', 'avg_time' => '10.0',
						'total_polls' => '1000', 'processes' => '4', 'threads' => '8', 'sync_interval' => '7200',
						'snmp' => '450', 'script' => '12', 'server' => '5',
						'last_update' => '2026-11-26 00:00:00', 'last_status' => '2026-11-26 00:00:00',
						'last_sync' => '0000-00-00 00:00:00', 'requires_sync' => '',
						// Secret columns injected in fixture to verify they are never projected.
						'dbpass' => 'super-secret-db-pass', 'dbsslkey' => '/etc/ssl/private/poller-key.pem',
						'dbuser' => 'cacti_secret_user', 'dbsslcert' => '/etc/ssl/cert.pem', 'dbsslca' => '/etc/ssl/ca.pem',
					],
					[
						'id' => '2', 'disabled' => 'on', 'name' => 'Remote Edge', 'notes' => '',
						'status' => '4', 'timezone' => 'UTC', 'hostname' => 'poller2.example',
						'total_time' => '4.2', 'max_time' => '8.0', 'min_time' => '2.0', 'avg_time' => '4.0',
						'total_polls' => '50', 'processes' => '2', 'threads' => '4', 'sync_interval' => '7200',
						'snmp' => '80', 'script' => '1', 'server' => '0',
						'last_update' => '2026-11-25 12:00:00', 'last_status' => '2026-11-25 12:00:00',
						'last_sync' => '2026-11-25 11:00:00', 'requires_sync' => 'on',
						'dbpass' => 'remote-secret-pass', 'dbsslkey' => '/etc/ssl/private/remote.key',
					],
				],
				'trees' => [
					['id' => '10', 'name' => 'Core Network', 'enabled' => 'on', 'locked' => '0', 'sort_type' => '1', 'sequence' => '1', 'last_modified' => '2026-11-26 01:00:00'],
					['id' => '20', 'name' => 'Restricted Tree', 'enabled' => 'on', 'locked' => '1', 'sort_type' => '2', 'sequence' => '2', 'last_modified' => '2026-11-26 02:00:00'],
				],
				'allowed_trees' => [
					7  => [10],
					10 => [10, 20],
				],
				'graphs' => [
					['local_graph_id' => '101', 'title_cache' => 'Router1 - Traffic', 'host_id' => '1', 'description' => 'Router1', 'graph_template_id' => '5', 'template_name' => 'Interface - Traffic', 'width' => '600', 'height' => '200', 'snmp_query_id' => '1', 'snmp_index' => '10'],
					['local_graph_id' => '102', 'title_cache' => 'Secret Host - CPU', 'host_id' => '99', 'description' => 'Secret Host', 'graph_template_id' => '6', 'template_name' => 'CPU Usage', 'width' => '600', 'height' => '200', 'snmp_query_id' => '0', 'snmp_index' => ''],
				],
				'allowed_graphs' => [
					7  => [101],
					10 => [101, 102],
				],
				'devices' => [
					7 => [['id' => '1', 'description' => 'Router1', 'hostname' => 'r1.example']],
				],
				'allowed_devices' => [
					7 => [1],
				],
				'data_sources' => [
					[
						'id' => '501', 'host_id' => '1', 'data_template_id' => '41', 'snmp_query_id' => '1',
						'snmp_index' => '10', 'orphan' => '0', 'name_cache' => 'Router1 - Traffic - Gi0/1',
						'active' => 'on', 'rrd_step' => '300', 'data_source_profile_id' => '1',
						'template_name' => 'Interface - Traffic', 'host_description' => 'Router1',
						// Secret input field value injected in fixture to prove it never reaches output.
						'input_value' => 'secret-snmp-community-value',
					],
					[
						'id' => '502', 'host_id' => '99', 'data_template_id' => '42', 'snmp_query_id' => '0',
						'snmp_index' => '', 'orphan' => '0', 'name_cache' => 'Unauthorized Host - Load',
						'active' => 'on', 'rrd_step' => '300', 'data_source_profile_id' => '1',
						'template_name' => 'Load Average', 'host_description' => 'Unauthorized Host',
					],
				],
				'settings' => [],
				'queries'  => [],
				'logs'     => [],
			];
			mcp_exposure_map(true);
			$this->registry = mcp_registry();
			$this->audit    = function (string $id, string $name, string $outcome) : void {};
			$this->tempDir  = sys_get_temp_dir() . '/mcp-unit-' . bin2hex(random_bytes(6));
			mkdir($this->tempDir, 0700, true);
		}

		protected function tearDown() : void {
			if (is_dir($this->tempDir)) {
				foreach (glob($this->tempDir . '/*') ?: [] as $file) {
					@unlink($file);
				}
				@rmdir($this->tempDir);
			}
		}

		/** @return array{token_id: int, token_kind: string, user_id: int, scopes: list<string>} */
		private function principal(int $userId) : array {
			return ['token_id' => 1, 'token_kind' => 'pat', 'user_id' => $userId, 'scopes' => ['abilities:read']];
		}

		public function testAllNineBuiltinsAreReadOnlyNonDestructiveAndIdempotent() : void {
			$all = $this->registry->all();
			$ids = array_column($all, 'id');

			$this->assertCount(9, $all);
			foreach ([
				'cacti-get-system-info',
				'cacti-list-devices',
				'cacti-get-device',
				'cacti-list-sites',
				'cacti-list-pollers',
				'cacti-list-trees',
				'cacti-list-graphs',
				'cacti-list-data-sources',
				'cacti-get-clog',
			] as $expected) {
				$this->assertContains($expected, $ids);
			}

			foreach ($all as $ability) {
				$this->assertSame(['readOnly' => true, 'destructive' => false, 'idempotent' => true], $ability['annotations']);
			}
		}

		public function testListSitesSupportsPaginationFilteringAndRealmEnforcement() : void {
			$first = $this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['pageSize' => 1, 'orderBy' => 'displayName desc'], $this->audit)['result'];
			$this->assertCount(1, $first['sites']);
			$this->assertSame('sites/1', $first['sites'][0]['name']);
			$this->assertSame('US West', $first['sites'][0]['displayName']);
			$this->assertIsString($first['nextPageToken']);

			$second = $this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['pageSize' => 1, 'pageToken' => $first['nextPageToken'], 'orderBy' => 'displayName desc'], $this->audit)['result'];
			$this->assertCount(1, $second['sites']);
			$this->assertSame('sites/2', $second['sites'][0]['name']);
			$this->assertNull($second['nextPageToken']);

			$this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['filter' => 'country = "US" AND city = "Seattle"'], $this->audit);
			$lastQuery = end($GLOBALS['mcp_unit_state']['queries']);
			$this->assertStringContainsString("s.country = 'US' AND s.city = 'Seattle'", $lastQuery['sql']);

			// Invalid filter field rejected
			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['filter' => 'secret = "x"'], $this->audit);
		}

		public function testListSitesDeniedWithoutRealm() : void {
			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(8), 'cacti-list-sites', new stdClass(), $this->audit);
		}

		public function testListPollersStrictlyExcludesDatabaseAndTlsSecrets() : void {
			$result = $this->registry->execute($this->principal(7), 'cacti-list-pollers', (object) ['filter' => 'state = "IDLE" AND disabled = false'], $this->audit)['result'];
			$json   = (string) json_encode($result);

			$this->assertCount(2, $result['pollers']);
			$this->assertSame('pollers/1', $result['pollers'][0]['name']);
			$this->assertSame('IDLE', $result['pollers'][0]['state']);
			$this->assertSame(false, $result['pollers'][0]['disabled']);
			$this->assertSame(true, $result['pollers'][1]['disabled']);
			$this->assertSame(true, $result['pollers'][1]['requiresSync']);

			$this->assertStringNotContainsString('super-secret-db-pass', $json);
			$this->assertStringNotContainsString('remote-secret-pass', $json);
			$this->assertStringNotContainsString('poller-key.pem', $json);
			$this->assertStringNotContainsString('cacti_secret_user', $json);
			$this->assertStringNotContainsString('dbpass', $json);
			$this->assertStringNotContainsString('dbsslkey', $json);

			$lastQuery = end($GLOBALS['mcp_unit_state']['queries']);
			$this->assertStringNotContainsString('dbpass', $lastQuery['sql']);
			$this->assertStringNotContainsString('dbsslkey', $lastQuery['sql']);
			$this->assertStringContainsString("p.status = 2 AND p.disabled = ''", $lastQuery['sql']);

			// Filtering by credential column must be rejected
			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(7), 'cacti-list-pollers', (object) ['filter' => 'dbpass = "x"'], $this->audit);
		}

		public function testListTreesEnforcesRealmAndIsTreeAllowed() : void {
			$result = $this->registry->execute($this->principal(7), 'cacti-list-trees', new stdClass(), $this->audit)['result'];
			$this->assertCount(1, $result['trees']);
			$this->assertSame('trees/10', $result['trees'][0]['name']);
			$this->assertSame('Core Network', $result['trees'][0]['displayName']);

			// User 10 with realm 4 (Trees admin) and both trees allowed sees both.
			$adminResult = $this->registry->execute($this->principal(10), 'cacti-list-trees', new stdClass(), $this->audit)['result'];
			$this->assertCount(2, $adminResult['trees']);

			// User 8 without realm 7 or 4 is denied.
			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(8), 'cacti-list-trees', new stdClass(), $this->audit);
		}

		public function testListGraphsEnforcesRealmAndIsGraphAllowed() : void {
			$result = $this->registry->execute($this->principal(7), 'cacti-list-graphs', (object) ['filter' => 'device = "devices/1"'], $this->audit)['result'];
			$this->assertCount(1, $result['graphs']);
			$this->assertSame('graphs/101', $result['graphs'][0]['name']);
			$this->assertSame('devices/1', $result['graphs'][0]['device']);
			$this->assertSame('graphTemplates/5', $result['graphs'][0]['graphTemplate']);
			$this->assertStringNotContainsString('Secret Host', (string) json_encode($result));

			$lastQuery = end($GLOBALS['mcp_unit_state']['queries']);
			$this->assertSame('gl.host_id = 1', $lastQuery['where']);

			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(8), 'cacti-list-graphs', new stdClass(), $this->audit);
		}

		public function testListDataSourcesScopesToAllowedDevicesAndExcludesSecrets() : void {
			$result = $this->registry->execute($this->principal(7), 'cacti-list-data-sources', (object) ['filter' => 'active = true'], $this->audit)['result'];
			$json   = (string) json_encode($result);

			$this->assertCount(1, $result['dataSources']);
			$this->assertSame('dataSources/501', $result['dataSources'][0]['name']);
			$this->assertSame('devices/1', $result['dataSources'][0]['device']);
			$this->assertTrue($result['dataSources'][0]['active']);
			$this->assertStringNotContainsString('Unauthorized Host', $json);
			$this->assertStringNotContainsString('secret-snmp-community-value', $json);

			$lastQuery = end($GLOBALS['mcp_unit_state']['queries']);
			$this->assertStringNotContainsString('data_input_data', $lastQuery['sql']);
			$this->assertSame([1], $lastQuery['params']);

			// A user with realm 3 but zero permitted devices gets an empty page without querying data_local.
			$GLOBALS['mcp_unit_state']['devices'][7] = [];
			$GLOBALS['mcp_unit_state']['queries']    = [];
			$empty = $this->registry->execute($this->principal(7), 'cacti-list-data-sources', new stdClass(), $this->audit)['result'];
			$this->assertSame(['dataSources' => [], 'nextPageToken' => null], $empty);
			$sqlQueries = array_filter($GLOBALS['mcp_unit_state']['queries'], fn (array $q) => isset($q['sql']) && str_contains($q['sql'], 'data_local'));
			$this->assertSame([], $sqlQueries);
		}

		public function testGetClogFiltersRedactsSecretsAndEnforcesViewLogsRealm() : void {
			$logFile = $this->tempDir . '/cacti.log';
			file_put_contents($logFile, implode("\n", [
				'2026-11-26 10:00:00 - SYSTEM STATS: Time:1.2',
				'2026-11-26 10:01:00 - CMDPHP ERROR: Auth failed password="my-db-password" token=cmcp_pat_' . str_repeat('a', 64),
				'2026-11-26 10:02:00 - CMDPHP ERROR: Header Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.secret',
				'2026-11-26 10:03:00 - CMDPHP WARNING: Connecting mysql://cacti:urlsecret@db.internal/cacti community=public123',
				'2026-11-26 10:04:00 - CMDPHP ERROR: SNMP timeout on host 10.0.0.5',
			]) . "\n");
			$GLOBALS['mcp_unit_state']['settings']['path_cactilog'] = $logFile;

			// Severity + limit filtering + redaction
			$errors = $this->registry->execute($this->principal(7), 'cacti-get-clog', (object) ['severity' => 'ERROR', 'lines' => 2], $this->audit)['result'];
			$json   = (string) json_encode($errors);

			$this->assertSame(2, $errors['count']);
			$this->assertTrue($errors['truncated']);
			$this->assertStringContainsString('SNMP timeout', $errors['lines'][1]);
			$this->assertStringNotContainsString('eyJhbGciOiJIUzI1NiJ9', $json);
			$this->assertStringNotContainsString($logFile, $json);

			// Full tail redaction check across all secret patterns
			$all     = $this->registry->execute($this->principal(7), 'cacti-get-clog', (object) ['lines' => 10], $this->audit)['result'];
			$allText = implode("\n", $all['lines']);
			$this->assertSame(5, $all['count']);
			$this->assertFalse($all['truncated']);
			$this->assertStringNotContainsString('my-db-password', $allText);
			$this->assertStringNotContainsString('cmcp_pat_', $allText);
			$this->assertStringNotContainsString('eyJhbGciOiJIUzI1NiJ9', $allText);
			$this->assertStringNotContainsString('urlsecret', $allText);
			$this->assertStringNotContainsString('public123', $allText);
			$this->assertStringContainsString('[redacted]', $allText);

			// Search filter is case-insensitive plain substring and runs after redaction (no secret oracle)
			$searched = $this->registry->execute($this->principal(7), 'cacti-get-clog', (object) ['search' => 'snmp timeout'], $this->audit)['result'];
			$this->assertSame(1, $searched['count']);
			$secretOracle = $this->registry->execute($this->principal(7), 'cacti-get-clog', (object) ['search' => 'my-db-password'], $this->audit)['result'];
			$this->assertSame(0, $secretOracle['count']);

			// Whitespace-separated quoted secrets are redacted
			$this->assertStringNotContainsString('space secret', mcp_redact_log_line('DB_Pass "space secret" host=db'));

			// Whitespace-only orderBy falls back cleanly to default ordering
			$wsOrder = $this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['orderBy' => '   '], $this->audit)['result'];
			$this->assertCount(2, $wsOrder['sites']);

			// Realm 18 (Log Administration) also permitted
			$adminLog = $this->registry->execute($this->principal(9), 'cacti-get-clog', (object) ['lines' => 1], $this->audit)['result'];
			$this->assertSame(1, $adminLog['count']);

			// User without realm 18 or 19 is denied
			$this->expectException(AbilitiesError::class);
			$this->registry->execute($this->principal(8), 'cacti-get-clog', new stdClass(), $this->audit);
		}

		public function testGetClogReturnsLogUnavailableForMissingLogFile() : void {
			$GLOBALS['mcp_unit_state']['settings']['path_cactilog'] = $this->tempDir . '/does-not-exist.log';

			try {
				$this->registry->execute($this->principal(7), 'cacti-get-clog', new stdClass(), $this->audit);
				$this->fail('Expected AbilitiesError for missing log file');
			} catch (AbilitiesError $error) {
				$this->assertSame('FAILED_PRECONDITION', $error->status);
				$this->assertSame('LOG_UNAVAILABLE', $error->reason);
			}
		}

		public function testPageTokenRejectsMismatchedFilterAcrossNewListAbilities() : void {
			$first = $this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['pageSize' => 1], $this->audit)['result'];
			$this->assertIsString($first['nextPageToken']);

			try {
				$this->registry->execute($this->principal(7), 'cacti-list-sites', (object) ['pageSize' => 1, 'pageToken' => $first['nextPageToken'], 'filter' => 'country = "US"'], $this->audit);
				$this->fail('Expected INVALID_PAGE_TOKEN');
			} catch (AbilitiesError $error) {
				$this->assertSame('INVALID_PAGE_TOKEN', $error->reason);
			}
		}
	}
}
