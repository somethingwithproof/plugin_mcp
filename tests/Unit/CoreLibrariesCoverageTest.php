<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace Tests\Unit;

use AbilitiesError;
use AbilitiesRegistrar;
use AbilitiesRegistry;
use InvalidArgumentException;
use LogicException;
use McpRevokeAuditError;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

final class CoreLibrariesCoverageTest extends TestCase {
	protected function setUp() : void {
		date_default_timezone_set('UTC');
		mcp_unit_reset_state();
		$GLOBALS['config'] = ['cacti_version' => '1.2.31', 'base_path' => '/tmp', 'poller_id' => 1];
	}

	/** @return array{token_id: int, token_kind: string, user_id: int, scopes: list<string>} */
	private function principal(int $userId = 7) : array {
		return ['token_id' => 1, 'token_kind' => 'pat', 'user_id' => $userId, 'scopes' => ['abilities:read']];
	}

	private function fixtureRegistry(bool $permitted = true) : AbilitiesRegistry {
		$registry = new AbilitiesRegistry();
		$registry->registerCategory('fixtures', 'Fixtures');
		$registry->registerCategory('other', 'Other');

		$input  = ['type' => 'object', 'properties' => ['id' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 100]], 'required' => [], 'additionalProperties' => false];
		$output = ['type' => 'object', 'properties' => ['id' => ['type' => 'integer']], 'required' => [], 'additionalProperties' => false];
		$empty  = ['type' => 'object', 'properties' => [], 'additionalProperties' => false];

		$base = [
			'label'         => 'Get thing',
			'description'   => 'Fixture ability',
			'category'      => 'fixtures',
			'input_schema'  => $input,
			'output_schema' => $output,
			'annotations'   => ['readOnly' => true, 'destructive' => false, 'idempotent' => true],
			'permission'    => fn (int $user) => $permitted,
			'execute'       => fn (int $user, stdClass $args) => ['id' => $args->id ?? 1],
		];

		$registry->register('fixture-get-thing', $base);
		$registry->register('fixture-other-thing', ['category' => 'other'] + $base);
		$registry->register('fixture-empty-thing', ['input_schema' => $empty, 'output_schema' => $empty, 'execute' => fn () => []] + $base);
		$registry->register('fixture-missing-thing', ['execute' => function () {
			throw new AbilitiesError('NOT_FOUND', 'DEVICE_NOT_FOUND');
		}] + $base);
		$registry->register('fixture-broken-thing', ['execute' => function () {
			throw new RuntimeException('secret detail');
		}] + $base);
		$registry->register('fixture-list-thing', [
			'output_schema' => ['type' => 'object', 'properties' => ['0' => ['type' => 'integer']], 'additionalProperties' => false],
			'execute'       => fn () => [5],
		] + $base);

		return $registry;
	}

	public function testSetupLifecycleCallbacksAndFailures() : void {
		$realm = 0;
		$GLOBALS['mcp_unit_state']['callbacks']['api_plugin_register_realm'] = function () use (&$realm) : bool {
			$realm = 9;

			return true;
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = function () use (&$realm) {
			return $realm;
		};

		$this->assertFalse(plugin_mcp_check_config());
		plugin_mcp_install();
		$this->assertTrue(plugin_mcp_check_config());
		$this->assertFalse(plugin_mcp_upgrade());
		$this->assertSame('mcp', plugin_mcp_version()['name']);

		global $tabs, $settings, $menu;
		$tabs     = [];
		$settings = [];
		mcp_config_settings();
		$this->assertSame('MCP', $tabs['mcp']);
		$this->assertSame('textbox', $settings['mcp']['mcp_public_url']['method']);

		$menu = [];
		mcp_config_arrays();
		$this->assertSame('MCP', $menu['Management']['plugins/mcp/mcp_admin.php']);
		$this->assertSame('My MCP Tokens', $menu['Management']['plugins/mcp/mcp_tokens.php']);

		$nav = mcp_draw_navigation_text(['existing:' => ['title' => 'Existing']]);
		$this->assertSame('MCP Administration', $nav['mcp_admin.php:']['title']);
		$this->assertSame('My MCP Tokens', $nav['mcp_tokens.php:']['title']);

		// Uninstall revokes tokens cleanly; failure throws.
		plugin_mcp_uninstall();
		$GLOBALS['mcp_unit_state']['callbacks']['db_execute'] = fn () => false;

		try {
			plugin_mcp_uninstall();
			$this->fail('Expected uninstall revocation failure');
		} catch (RuntimeException $error) {
			$this->assertSame('MCP token revocation failed', $error->getMessage());
		}

		// Install failure when realm not found throws.
		$realm = 0;
		$GLOBALS['mcp_unit_state']['callbacks']['db_execute'] = fn () => true;
		$GLOBALS['mcp_unit_state']['callbacks']['api_plugin_register_realm'] = fn () => true;

		try {
			plugin_mcp_install();
			$this->fail('Expected incomplete install exception');
		} catch (RuntimeException $error) {
			$this->assertSame('MCP installation is incomplete', $error->getMessage());
		}
	}

	public function testOriginNormalizationAndValidation() : void {
		$this->assertSame('https://cacti.example.com/cacti', mcp_normalize_public_url('HTTPS://Cacti.Example.com:443/cacti/?a=1#frag'));
		$this->assertSame('http://localhost:8080/cacti', mcp_normalize_public_url('http://localhost:8080/cacti/'));
		$this->assertSame('http://[0:0:0:0:0:0:0:1]:8443/cacti', mcp_normalize_public_url('http://[0:0:0:0:0:0:0:1]:8443/cacti'));
		$this->assertNull(mcp_normalize_public_url('http://cacti.example.com'));
		$this->assertNull(mcp_normalize_public_url('https://user@cacti.example.com'));
		$this->assertNull(mcp_normalize_public_url('https://[bad]/cacti'));
		$this->assertNull(mcp_normalize_public_url('https://bad host/cacti'));
		$this->assertNull(mcp_normalize_public_url('https://cacti.example.com:70000'));
		$this->assertNull(mcp_normalize_public_url('https://cacti.example.com/bad path'));

		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = 'https://cacti.example.com/cacti/';
		$public = mcp_public_url();
		$this->assertSame('https://cacti.example.com/cacti', $public);
		$this->assertSame('https://cacti.example.com/cacti/plugins/mcp/mcp.php', mcp_canonical_uri($public));

		$this->assertTrue(mcp_origin_allowed(null, $public));
		$this->assertTrue(mcp_origin_allowed('https://CACTI.example.com', $public));
		$this->assertFalse(mcp_origin_allowed('https://evil.example', $public));
		$this->assertFalse(mcp_origin_allowed('https://cacti.example.com:443', $public));
		$this->assertFalse(mcp_origin_allowed('https://cacti.example.com/cacti', $public));
	}

	public function testBootstrapHelpersValidateHeadersBodiesAndState() : void {
		$token = 'Bearer cmcp_pat_' . str_repeat('ab', 32);
		$opts  = ['methods' => ['POST'], 'content_type' => 'application/json', 'max_bytes' => 1024, 'bearer' => true];
		$srv   = ['REQUEST_METHOD' => 'POST', 'CONTENT_TYPE' => 'application/json; charset=utf-8', 'CONTENT_LENGTH' => '10'];

		$this->assertSame($token, mcp_authorization_header(['HTTP_AUTHORIZATION' => $token], null));
		$this->assertSame($token, mcp_authorization_header(['REDIRECT_HTTP_AUTHORIZATION' => $token], null));
		$this->assertSame($token, mcp_authorization_header([], ['aUtHoRiZaTiOn' => $token]));
		$this->assertSame('', mcp_authorization_header([], null));

		mcp_bootstrap_validate($opts, $srv, $token);

		foreach ([
			[['REQUEST_METHOD' => 'GET'] + $srv, $token, 'METHOD_NOT_ALLOWED'],
			[['CONTENT_TYPE' => 'text/plain'] + $srv, $token, 'UNSUPPORTED_MEDIA_TYPE'],
			[['CONTENT_LENGTH' => '2048'] + $srv, $token, 'REQUEST_TOO_LARGE'],
			[$srv, 'Bearer bad', 'INVALID_TOKEN'],
		] as [$badSrv, $badAuth, $expectedReason]) {
			try {
				mcp_bootstrap_validate($opts, $badSrv, $badAuth);
				$this->fail('Expected ' . $expectedReason);
			} catch (AbilitiesError $error) {
				$this->assertSame($expectedReason, $error->reason);
			}
		}

		$tmp = tempnam(sys_get_temp_dir(), 'mcp-body-');
		$this->assertIsString($tmp);
		file_put_contents($tmp, 'hello');
		$this->assertSame('hello', mcp_read_body($tmp, 10));

		try {
			mcp_read_body($tmp, 3);
			$this->fail('Expected REQUEST_TOO_LARGE');
		} catch (AbilitiesError $error) {
			$this->assertSame('REQUEST_TOO_LARGE', $error->reason);
		} finally {
			@unlink($tmp);
		}

		$post = ['a' => 1];
		$req  = ['b' => 2];
		$cook = ['c' => 3];
		mcp_strip_identity($post, $req, $cook);
		$this->assertSame([], $post);
		$this->assertSame([], $req);
		$this->assertSame([], $cook);

		$serverRef = ['REQUEST_METHOD' => 'POST'];
		mcp_hide_post_method($serverRef);
		$this->assertSame('MCP_POST', $serverRef['REQUEST_METHOD']);
		$this->assertSame('POST', $serverRef['MCP_ORIGINAL_METHOD']);

		$rpcErr = mcp_bootstrap_rpc_body(new AbilitiesError('UNAVAILABLE', 'CACTI_UNAVAILABLE'));
		$this->assertSame(-32000, $rpcErr['error']['code']);
		$this->assertSame('UNAVAILABLE', mcp_bootstrap_unavailable_body('aip')['error']['status']);
		$this->assertSame('CACTI_UNAVAILABLE', mcp_bootstrap_unavailable_body('jsonrpc')['error']['data']['reason']);

		mcp_bootstrap_complete(false);
		$this->assertSame('', mcp_bootstrap_buffer('html', 0));
		mcp_bootstrap_complete(true);
		$this->assertSame('ok', mcp_bootstrap_buffer('ok', 0));
		mcp_bootstrap_shutdown('aip', ob_get_level());
		mcp_bootstrap_end_session();
	}

	public function testApiHttpAndMcpServerHandlers() : void {
		$registry  = $this->fixtureRegistry(true);
		$principal = $this->principal(7);
		$audit     = function (string $id, string $name, string $outcome) : void {};
		$info      = ['name' => 'cacti-mcp', 'version' => '0.1.0'];

		// REST API list, filter, pagination, get, execute, errors.
		$list = mcp_api_handle('GET', '/v1/abilities', ['pageSize' => '2', 'filter' => 'category = "fixtures"'], '', $registry, $principal, $audit);
		$this->assertSame(200, $list['status']);
		$this->assertCount(2, $list['body']['abilities']);
		$this->assertIsString($list['body']['nextPageToken']);

		$get = mcp_api_handle('GET', '/v1/abilities/fixture-get-thing', [], '', $registry, $principal, $audit);
		$this->assertSame(200, $get['status']);
		$this->assertSame('abilities/fixture-get-thing', $get['body']['name']);

		$exec = mcp_api_handle('POST', '/v1/abilities/fixture-get-thing:execute', [], '{"arguments":{"id":5}}', $registry, $principal, $audit);
		$this->assertSame(200, $exec['status']);
		$this->assertSame(['id' => 5], $exec['body']['result']);

		$this->assertSame(404, mcp_api_handle('GET', '/v1/abilities/missing-one', [], '', $registry, $principal, $audit)['status']);
		$this->assertSame(404, mcp_api_handle('GET', '/v2/unknown', [], '', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('GET', '/v1/abilities', ['pageSize' => 'bad'], '', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('GET', '/v1/abilities', ['pageSize' => ['1']], '', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('GET', '/v1/abilities', ['filter' => 'bad'], '', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('POST', '/v1/abilities/fixture-get-thing:execute', [], '{bad', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('POST', '/v1/abilities/fixture-get-thing:execute', [], '[]', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('POST', '/v1/abilities/fixture-get-thing:execute', [], '{"arguments":{},"x":1}', $registry, $principal, $audit)['status']);
		$this->assertSame(400, mcp_api_handle('POST', '/v1/abilities/fixture-get-thing:execute', [], '{"arguments":[]}', $registry, $principal, $audit)['status']);
		$this->assertSame(500, mcp_api_handle('POST', '/v1/abilities/fixture-broken-thing:execute', [], '{"arguments":{}}', $registry, $principal, $audit)['status']);
		$this->assertSame(401, mcp_api_error(new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN'))['status']);

		// MCP Server modern + legacy protocol paths.
		$headers = mcp_request_headers(['HTTP_MCP_PROTOCOL_VERSION' => MCP_VERSION_MODERN, 'HTTP_MCP_METHOD' => 'server/discover']);
		$this->assertSame('server/discover', $headers['mcp-method']);
		$this->assertSame('fixture-get-thing', mcp_rpc_header_name('=?base64?' . base64_encode('fixture-get-thing') . '?='));
		$this->assertSame('=?base64?###?=', mcp_rpc_header_name('=?base64?###?='));
		$this->assertNull(mcp_rpc_header_name('=?base64?a?='));

		$this->assertSame(405, mcp_rpc_handle('GET', [], '', $registry, $principal, $audit, $info)['status']);
		$this->assertSame(400, mcp_rpc_handle('POST', [], '{bad', $registry, $principal, $audit, $info)['status']);
		$this->assertSame(400, mcp_rpc_handle('POST', [], '[]', $registry, $principal, $audit, $info)['status']);
		$this->assertSame(202, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","method":"notifications/initialized"}', $registry, $principal, $audit, $info)['status']);
		$this->assertSame(-32602, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"ping","params":[1]}', $registry, $principal, $audit, $info)['body']['error']['code']);

		$modernMeta = [MCP_VERSION_META => MCP_VERSION_MODERN];
		$discover   = mcp_rpc_handle('POST', ['mcp-protocol-version' => MCP_VERSION_MODERN, 'mcp-method' => 'server/discover'],
			(string) json_encode(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'server/discover', 'params' => ['_meta' => $modernMeta]]),
			$registry, $principal, $audit, $info);
		$this->assertSame(200, $discover['status']);

		$badVer = mcp_rpc_handle('POST', ['mcp-protocol-version' => '1999-01-01', 'mcp-method' => 'ping'],
			(string) json_encode(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'ping', 'params' => ['_meta' => [MCP_VERSION_META => '1999-01-01']]]),
			$registry, $principal, $audit, $info);
		$this->assertSame(-32022, $badVer['body']['error']['code']);

		$mismatch = mcp_rpc_handle('POST', ['mcp-protocol-version' => MCP_VERSION_MODERN, 'mcp-method' => 'other'],
			(string) json_encode(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'ping', 'params' => ['_meta' => $modernMeta]]),
			$registry, $principal, $audit, $info);
		$this->assertSame(-32020, $mismatch['body']['error']['code']);

		$badLegacyVer = mcp_rpc_handle('POST', ['mcp-protocol-version' => '2024-01-01'],
			'{"jsonrpc":"2.0","id":1,"method":"ping"}', $registry, $principal, $audit, $info);
		$this->assertSame(400, $badLegacyVer['status']);

		$init = mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"initialize"}', $registry, $principal, $audit, $info);
		$this->assertSame(MCP_VERSION_LEGACY, $init['body']['result']['protocolVersion']);
		$this->assertSame(200, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"ping"}', $registry, $principal, $audit, $info)['status']);
		$this->assertCount(6, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/list"}', $registry, $principal, $audit, $info)['body']['result']['tools']);
		$this->assertSame(-32602, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{}}', $registry, $principal, $audit, $info)['body']['error']['code']);
		$this->assertTrue(mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{"name":"fixture-get-thing","arguments":"bad"}}', $registry, $principal, $audit, $info)['body']['result']['isError']);
		$this->assertTrue(mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{"name":"fixture-missing-thing"}}', $registry, $principal, $audit, $info)['body']['result']['isError']);
		$this->assertTrue(mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{"name":"fixture-broken-thing"}}', $registry, $principal, $audit, $info)['body']['result']['isError']);
		$this->assertTrue(mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{"name":"fixture-list-thing"}}', $registry, $principal, $audit, $info)['body']['result']['isError']);
		$this->assertSame(-32601, mcp_rpc_handle('POST', [], '{"jsonrpc":"2.0","id":1,"method":"unknown/method"}', $registry, $principal, $audit, $info)['body']['error']['code']);
	}

	public function testStorageAndAdminHelpers() : void {
		$tokens   = [];
		$affected = 0;
		$GLOBALS['mcp_unit_state']['settings'] = ['auth_method' => 1, 'guest_user' => 50];
		$GLOBALS['mcp_unit_state']['realms']   = [7 => [109], 8 => [109]];

		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = function (string $sql, array $params) use (&$tokens) {
			if (str_contains($sql, 'FROM plugin_realms')) {
				return 9;
			}

			if (str_starts_with($sql, 'SELECT id FROM plugin_mcp_token WHERE token_hash')) {
				foreach ($tokens as $row) {
					if ($row['token_hash'] === $params[0]) {
						return $row['id'];
					}
				}

				return false;
			}

			if (str_contains($sql, 'COUNT(*)')) {
				return count($tokens);
			}

			return false;
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'] = function (string $sql, array $params) use (&$tokens) {
			if (str_contains($sql, 'FROM user_auth WHERE id = ?')) {
				return $params[0] === 99 ? false : ['id' => (string) $params[0], 'enabled' => $params[0] === 60 ? '' : 'on'];
			}

			foreach ($tokens as $row) {
				if ($row['token_hash'] === $params[0]) {
					return $row;
				}
			}

			return false;
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'] = function (string $sql, array $params) use (&$tokens) {
			if (str_starts_with($sql, 'SELECT id FROM user_auth')) {
				return $params[0] === 50 ? [['id' => '50']] : [];
			}

			if (str_starts_with($sql, 'SELECT id FROM plugin_mcp_token WHERE id IN (')) {
				return array_values(array_map(fn ($r) => ['id' => $r['id']], array_filter($tokens, fn ($r) => $r['revoked'] === '0')));
			}

			if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
				return [['id' => 'thold-list-thresholds', 'exposed' => '1']];
			}

			return $tokens;
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_execute_prepared'] = function (string $sql, array $params) use (&$tokens, &$affected) : bool {
			if (str_starts_with($sql, 'INSERT INTO plugin_mcp_token')) {
				$tokens[] = [
					'id'           => (string) (count($tokens) + 1),
					'user_id'      => (string) $params[0],
					'token_hash'   => $params[1],
					'scopes'       => $params[2],
					'expires_at'   => $params[3],
					'created_at'   => $params[4],
					'created_by'   => $params[5],
					'last_used_at' => null,
					'revoked'      => '0',
				];

				return true;
			}

			if (str_starts_with($sql, 'UPDATE plugin_mcp_token SET revoked = 1')) {
				$affected = count($tokens);

				foreach ($tokens as &$row) {
					$row['revoked'] = '1';
				}
				unset($row);

				return true;
			}

			return true;
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_affected_rows'] = function () use (&$affected) : int {
			return $affected;
		};

		// Schema upgrade path when columns are missing.
		$GLOBALS['mcp_unit_state']['columns']['plugin_mcp_token'] = ['created_at' => false, 'created_by' => false, 'last_used_at' => false];
		mcp_install_schema();
		$this->assertTrue($GLOBALS['mcp_unit_state']['columns']['plugin_mcp_token']['created_at']);

		// Token create, authenticate, list, audit, revoke, self-service helpers.
		$token     = mcp_token_create_audited(7, 30, 7);
		$principal = mcp_authenticate('Bearer ' . $token);
		$this->assertSame(7, $principal['user_id']);
		$this->assertSame(1, mcp_token_id($token));

		mcp_audit($principal, str_repeat('a', 32), 'cacti-list-devices', 'started');
		mcp_audit($principal, str_repeat('a', 32), 'cacti-list-devices', 'succeeded');
		mcp_audit($principal, str_repeat('b', 32), 'cacti-list-devices', 'denied');

		$this->assertSame(1, mcp_token_list(['user_id' => 7], 1, 20)['total']);
		$this->assertSame(1, mcp_audit_list(['user_id' => 7, 'ability' => 'cacti-list-devices', 'outcome' => 'denied'], 1, 20)['total']);

		$map = mcp_exposure_map(true);
		$this->assertTrue(mcp_is_exposed('thold-list-thresholds', 'thold', $map));
		$this->assertTrue(mcp_is_exposed('cacti-list-devices', 'cacti', $map));
		mcp_set_exposure(['thold-list-thresholds'], false);
		mcp_set_exposure([], true);

		$this->assertSame(1, mcp_self_revoke(7, [1]));
		$this->assertSame(0, mcp_token_revoke([]));

		// Admin helpers: realm names, ability rows, bulk action parser, nonces, session wrapper, available tools.
		$this->assertSame('Devices', mcp_admin_realm_name(['id' => 'cacti-list-devices'], [3 => 'Devices']));
		$this->assertSame('', mcp_admin_realm_name(['id' => 'custom-ability'], [3 => 'Devices']));
		$rows = mcp_admin_ability_rows(
			[['id' => 'cacti-list-devices', 'label' => 'List', 'category' => 'inventory', 'namespace' => 'cacti', 'annotations' => ['readOnly' => true]]],
			[],
			fn () => 'Devices'
		);
		$this->assertTrue($rows[0]['exposed']);
		$this->assertSame(['action' => 'expose', 'ids' => ['cacti-get-device']], mcp_admin_parse_action(['drp_action' => 'expose', 'chk_cacti-get-device' => 'on', 'chk_bad.id' => 'on']));
		$this->assertSame(['action' => 'revoke', 'ids' => [4]], mcp_admin_parse_action(['drp_action' => 'revoke', 'chk_4' => 'on', 'chk_0' => 'on']));
		$this->assertTrue(mcp_admin_may_create_for(2, 2, false));
		$this->assertFalse(mcp_admin_may_create_for(2, 5, false));
		$this->assertTrue(mcp_admin_may_create_for(2, 5, true));

		$session = [];
		$nonce   = mcp_admin_nonce_issue($session);
		$this->assertTrue(mcp_admin_nonce_consume($session, $nonce));
		$this->assertFalse(mcp_admin_nonce_consume($session, $nonce));
		$this->assertNotEmpty(mcp_token_ineligible_text());

		$_SESSION = [];
		$this->assertSame('ok', mcp_with_session(fn (array &$s) => 'ok'));
		$this->assertCount(6, mcp_available_tools($this->fixtureRegistry(true), 7));

		// Audit error wrapper coverage.
		$revokeErr = new McpRevokeAuditError(2);
		$this->assertSame(2, $revokeErr->revoked);

		// Failure paths for invalid inputs.
		foreach ([
			fn () => mcp_admin_parse_action(['action' => 'drop']),
			fn () => mcp_token_list(['user_id' => 0], 1, 10),
			fn () => mcp_token_create(0, 30),
			fn () => mcp_token_create(50, 30),
			fn () => mcp_audit_admin(1, 1, 'bad-action'),
			fn () => mcp_token_check_ids([0]),
			fn () => mcp_audit_list(['user_id' => 0], 1, 10),
			fn () => mcp_audit_list(['ability' => 'BAD'], 1, 10),
			fn () => mcp_audit_list(['outcome' => 'bogus'], 1, 10),
			fn () => mcp_audit_list([], 0, 10),
			fn () => mcp_set_exposure(['BAD ID'], true),
		] as $call) {
			try {
				$call();
				$this->fail('Expected InvalidArgumentException');
			} catch (InvalidArgumentException $expected) {
				$this->assertNotEmpty($expected->getMessage());
			}
		}

		// Auth disabled -> mcp_has_realm fails closed.
		$GLOBALS['mcp_unit_state']['settings']['auth_method'] = 0;
		$this->assertFalse(mcp_has_realm(7));
	}

	public function testRegistrySchemaValidationAndRegistrarIsolation() : void {
		$registry = new AbilitiesRegistry();
		$registry->registerCategory('fixtures', 'Fixtures');

		$registrar = new AbilitiesRegistrar($registry, 'thold');
		$registrar->registerCategory('thresholds', 'Thresholds');
		$registrar->register('thold-list-items', [
			'label'         => 'List thresholds',
			'description'   => 'Reads thresholds',
			'category'      => 'thresholds',
			'input_schema'  => ['type' => 'object', 'properties' => ['q' => ['type' => ['string', 'null'], 'minLength' => 1, 'maxLength' => 20, 'pattern' => '^[a-z]+$']], 'additionalProperties' => false],
			'output_schema' => ['type' => 'object', 'properties' => ['meta' => ['type' => 'object', 'properties' => [], 'additionalProperties' => false], 'items' => ['type' => 'array', 'maxItems' => 5, 'items' => ['type' => 'number', 'minimum' => 0, 'maximum' => 10]]], 'required' => ['meta', 'items'], 'additionalProperties' => false],
			'annotations'   => ['readOnly' => true, 'destructive' => false, 'idempotent' => true],
			'permission'    => fn (int $u) => true,
			'execute'       => fn (int $u, stdClass $a) => ['meta' => [], 'items' => [1, 2.5]],
		]);

		$res = $registry->execute($this->principal(7), 'thold-list-items', (object) ['q' => 'abc'], fn () => null);
		$this->assertInstanceOf(stdClass::class, $res['result']['meta']);
		$this->assertSame([1, 2.5], $res['result']['items']);

		// Adopt scratch copy and exception class formatting for anonymous exceptions.
		$scratch = clone $registry;
		$registry->adopt($scratch);
		$this->assertSame('RuntimeException@anonymous', mcp_exception_class(new class extends RuntimeException {}));

		// Invalid registrar namespace and schema definitions throw LogicException.
		foreach ([
			fn () => $registrar->register('other-list-items', []),
			fn () => $registry->registerCategory('Bad Cat', 'Bad'),
			fn () => abilities_check_schema(['type' => ['null', 'string']]),
			fn () => abilities_check_schema(['type' => 'string', 'pattern' => 'a~b']),
			fn () => abilities_check_schema(['type' => 'object', 'properties' => [], 'additionalProperties' => true]),
			fn () => abilities_check_schema(['type' => 'object', 'properties' => ['a' => 'bad'], 'additionalProperties' => false]),
			fn () => abilities_check_schema(['type' => 'object', 'properties' => [], 'required' => ['missing'], 'additionalProperties' => false]),
			fn () => abilities_check_schema(['type' => 'array', 'items' => ['type' => 'string']]),
		] as $badCall) {
			try {
				$badCall();
				$this->fail('Expected LogicException');
			} catch (LogicException $expected) {
				$this->assertNotEmpty($expected->getMessage());
			}
		}

		// AIP filter & order edge cases.
		$fields = [
			'name'   => ['column' => 't.name', 'type' => 'string', 'filter' => true, 'order' => true],
			'active' => ['column' => 't.active', 'type' => 'bool', 'filter' => true],
			'count'  => ['column' => 't.count', 'type' => 'int', 'filter' => true],
			'site'   => ['column' => 't.site_id', 'type' => 'reference', 'collection' => 'sites', 'filter' => true],
		];
		$this->assertSame("t.count >= 5 AND t.site_id = 3 AND t.active = 'on'", mcp_filter_sql('count >= 5 AND site = "sites/3" AND active = true', $fields));
		$this->assertSame('t.name DESC', mcp_order_sql('name desc', $fields, 't.id ASC'));
		$this->assertSame('t.id ASC', mcp_order_sql('', $fields, 't.id ASC'));

		// Additional providers coverage: mcp_plugin_file, mcp_clog_path fallback, byte-truncated clog, mcp_query_page failure, and plugin hook dispatch.
		$this->assertSame('/tmp/plugins/thold/setup.php', mcp_plugin_file('thold', 'setup.php'));
		$GLOBALS['mcp_unit_state']['settings']['path_cactilog'] = '';
		$this->assertSame('/tmp/log/cacti.log', mcp_clog_path());

		$bigLog = tempnam(sys_get_temp_dir(), 'mcp-clog-');
		$this->assertIsString($bigLog);
		file_put_contents($bigLog, "first-partial-line\n2026-11-26 10:00:00 - SYSTEM INFO: ok\n2026-11-26 10:01:00 - CMDPHP ERROR: fail\n");

		try {
			$tail = mcp_read_clog_tail($bigLog, 5, 'ALL', '', 60);
			$this->assertTrue($tail['truncated']);
			$this->assertGreaterThanOrEqual(1, $tail['count']);
		} finally {
			@unlink($bigLog);
		}

		// Plugin hook dispatch skips reserved cacti namespace, traversal paths, disabled plugins, and isolates throwing hooks.
		$GLOBALS['mcp_unit_state']['enabled_plugins'] = ['mcp' => true, 'cacti' => true, 'disabled' => false, 'traversal' => true, 'missing' => true];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'] = function (string $sql) {
			if (str_contains($sql, 'FROM plugin_hooks')) {
				return [
					['name' => 'cacti', 'file' => 'setup.php', 'function' => 'nope'],
					['name' => 'disabled', 'file' => 'setup.php', 'function' => 'nope'],
					['name' => 'traversal', 'file' => '../setup.php', 'function' => 'nope'],
					['name' => 'missing', 'file' => 'setup.php', 'function' => 'undefined_hook_fn'],
				];
			}

			if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
				return false;
			}

			return false;
		};
		$this->assertSame(['*' => false], mcp_exposure_map(true));
		$this->assertFalse(mcp_is_exposed('cacti-list-devices', 'cacti', ['*' => false]));
		mcp_dispatch_ability_hooks($registry);

		try {
			mcp_query_page('id', 'sites', '', 'id ASC', ['size' => 10, 'offset' => 0], 'Site fail');
			$this->fail('Expected RuntimeException on DB query failure');
		} catch (RuntimeException $error) {
			$this->assertSame('Site fail', $error->getMessage());
		}
	}
}
