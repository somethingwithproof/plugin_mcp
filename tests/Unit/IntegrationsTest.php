<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class IntegrationsTest extends TestCase {
	protected function setUp() : void {
		date_default_timezone_set('UTC');
		mcp_unit_reset_state();
		$GLOBALS['config'] = ['cacti_version' => '1.2.31', 'base_path' => '/tmp'];
	}

	public function testInstallRegistersAllFourDecoupledIntegrationHooks() : void {
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = fn (string $sql, array $params) => 9;

		plugin_mcp_install();
		$hooks = $GLOBALS['mcp_unit_state']['hooks'];

		$this->assertContains(['mcp', 'casc_register_providers', 'mcp_casc_register_providers', 'setup.php'], $hooks);
		$this->assertContains(['mcp', 'doctor_register_checks', 'mcp_doctor_register_checks', 'setup.php'], $hooks);
		$this->assertContains(['mcp', 'doctor_register_debug_info', 'mcp_doctor_register_debug_info', 'setup.php'], $hooks);
		$this->assertContains(['mcp', 'api_register_resources', 'mcp_api_register_resources', 'setup.php'], $hooks);
	}

	public function testStaticSchemaYamlSeparatesConfigFromRuntimeState() : void {
		$path = dirname(__DIR__, 2) . '/schema/mcp.schema.yaml';
		$this->assertFileExists($path);
		$content = (string) file_get_contents($path);

		$this->assertStringContainsString('SPDX-License-Identifier: GPL-2.0-or-later', $content);
		$this->assertStringContainsString('config:', $content);
		$this->assertStringContainsString('mcp_public_url:', $content);
		$this->assertStringContainsString('state:', $content);
		$this->assertStringContainsString('reconciledByCasc: false', $content);
		$this->assertStringContainsString('plugin_mcp_token:', $content);
		$this->assertStringContainsString('plugin_mcp_audit:', $content);
		$this->assertStringContainsString('plugin_mcp_ability:', $content);
	}

	public function testCascProviderDescriptorExportValidatePlanAndApply() : void {
		$recorded  = [];
		$registrar = new class($recorded) {
			/** @param array<int, array<string, mixed>> $recorded */
			public function __construct(public array &$recorded) {
			}

			/** @param array<string, mixed> $descriptor */
			public function register(array $descriptor) : void {
				$this->recorded[] = $descriptor;
			}
		};

		$descriptor = mcp_casc_register_providers($registrar);
		$this->assertSame('mcp', $descriptor['slug']);
		$this->assertSame('1.0', $descriptor['schemaVersion']);
		$this->assertSame('mcp_casc_export', $descriptor['export']);
		$this->assertSame('mcp_casc_validate', $descriptor['validate']);
		$this->assertSame('mcp_casc_plan', $descriptor['plan']);
		$this->assertSame('mcp_casc_apply', $descriptor['apply']);
		$this->assertSame('mcp_casc_describe_schema', $descriptor['describeSchema']);
		$this->assertIsArray($descriptor['schema']);
		$this->assertCount(1, $recorded);
		$this->assertFalse($descriptor['schema']['state']['reconciled']);

		// Export returns config only and never tokens or hashes.
		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = 'HTTPS://Cacti.Example.com/cacti/';
		$exported = mcp_casc_export();
		$this->assertSame([
			'schemaVersion' => '1.0',
			'config'        => ['mcp_public_url' => 'https://cacti.example.com/cacti'],
		], $exported);
		$this->assertStringNotContainsString('token', strtolower((string) json_encode($exported)));

		// Validate accepts valid HTTPS and loopback HTTP, rejects plain HTTP, state/tokens, unknown keys, and >255 chars.
		$this->assertTrue(mcp_casc_validate(['schemaVersion' => '1.0', 'config' => ['mcp_public_url' => 'https://cacti.example.com/cacti']])['valid']);
		$this->assertTrue(mcp_casc_validate(['config' => ['mcp_public_url' => 'http://localhost:8080/cacti']])['valid']);
		$this->assertTrue(mcp_casc_validate(['config' => ['mcp_public_url' => '']])['valid']);
		$this->assertFalse(mcp_casc_validate(['config' => ['mcp_public_url' => 'http://cacti.example.com']])['valid']);
		$this->assertFalse(mcp_casc_validate(['config' => ['mcp_public_url' => 'https://example.com/' . str_repeat('a', 250)]])['valid']);
		$this->assertFalse(mcp_casc_validate(['config' => ['mcp_public_url' => 123]])['valid']);
		$this->assertFalse(mcp_casc_validate(['config' => ['unknown_key' => 'x']])['valid']);
		$this->assertFalse(mcp_casc_validate(['schemaVersion' => '2.0', 'config' => []])['valid']);
		$this->assertFalse(mcp_casc_validate(['config' => 'not-an-array'])['valid']);
		$this->assertFalse(mcp_casc_validate(['state' => ['plugin_mcp_token' => []], 'config' => []])['valid']);
		$this->assertFalse(mcp_casc_validate(['tokens' => ['cmcp_pat_' . str_repeat('a', 64)]])['valid']);

		// Plan detects drift and dryRun does not write.
		$plan = mcp_casc_plan(['config' => ['mcp_public_url' => 'https://new.example.com/cacti/']]);
		$this->assertTrue($plan['valid']);
		$this->assertCount(1, $plan['changes']);
		$this->assertSame('https://cacti.example.com/cacti', $plan['changes'][0]['before']);
		$this->assertSame('https://new.example.com/cacti', $plan['changes'][0]['after']);

		$dry = mcp_casc_apply(['config' => ['mcp_public_url' => 'https://new.example.com/cacti/']], true);
		$this->assertFalse($dry['applied']);
		$this->assertTrue($dry['dryRun']);
		$this->assertSame('HTTPS://Cacti.Example.com/cacti/', $GLOBALS['mcp_unit_state']['settings']['mcp_public_url']);

		// Apply persists normalized URL.
		$applied = mcp_casc_apply(['config' => ['mcp_public_url' => 'https://new.example.com/cacti/']]);
		$this->assertTrue($applied['applied']);
		$this->assertSame('https://new.example.com/cacti', $GLOBALS['mcp_unit_state']['settings']['mcp_public_url']);

		// Re-applying same config is a clean no-op.
		$noop = mcp_casc_apply(['config' => ['mcp_public_url' => 'https://new.example.com/cacti']]);
		$this->assertTrue($noop['applied']);
		$this->assertSame([], $noop['changes']);

		// Invalid desired config fails plan and apply cleanly.
		$badPlan  = mcp_casc_plan(['config' => ['mcp_public_url' => 'http://insecure.example']]);
		$badApply = mcp_casc_apply(['config' => ['mcp_public_url' => 'http://insecure.example']]);
		$this->assertFalse($badPlan['valid']);
		$this->assertFalse($badApply['applied']);
		$this->assertNotEmpty($badApply['errors']);
	}

	public function testDoctorChecksSupportListAndRunModesWithZeroSecretLeakage() : void {
		$expectedKeys = ['id', 'plugin', 'category', 'title', 'status', 'message', 'details', 'remediation'];

		// mode=list returns info status for all checks.
		$listed = mcp_doctor_register_checks(['mode' => 'list']);
		$this->assertCount(3, $listed);

		foreach ($listed as $check) {
			$this->assertSame($expectedKeys, array_keys($check));
			$this->assertSame('mcp', $check['plugin']);
			$this->assertStringStartsWith('mcp.', $check['id']);
			$this->assertSame('info', $check['status']);
		}

		// mode=run healthy state.
		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = 'https://cacti.example.com/cacti';
		$GLOBALS['mcp_unit_state']['tables'] = [
			'plugin_mcp_token'   => true,
			'plugin_mcp_audit'   => true,
			'plugin_mcp_ability' => true,
		];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'] = fn (string $sql, array $params) => [
			'total_count'             => '3',
			'active_count'            => '2',
			'expired_unrevoked_count' => '0',
			'revoked_count'           => '1',
		];

		$okChecks = mcp_doctor_register_checks(['mode' => 'run']);
		$byId     = array_column($okChecks, null, 'id');
		$this->assertSame('ok', $byId['mcp.public_url']['status']);
		$this->assertSame('ok', $byId['mcp.schema_tables']['status']);
		$this->assertSame('ok', $byId['mcp.tokens_health']['status']);

		// Ensure no secret hashes or tokens appear anywhere in doctor check output.
		$encoded = (string) json_encode($okChecks);
		$this->assertStringNotContainsString('cmcp_pat_', $encoded);
		$this->assertStringNotContainsString('token_hash', $encoded);

		// mode=run warning states (unset URL + expired unrevoked tokens).
		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = '';
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'] = fn (string $sql, array $params) => [
			'total_count'             => '4',
			'active_count'            => '1',
			'expired_unrevoked_count' => '2',
			'revoked_count'           => '1',
		];
		$warnById = array_column(mcp_doctor_register_checks(['mode' => 'run']), null, 'id');
		$this->assertSame('warn', $warnById['mcp.public_url']['status']);
		$this->assertSame('warn', $warnById['mcp.tokens_health']['status']);

		// mode=run failure states (invalid non-HTTPS URL, missing tables, failed token query).
		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = 'http://public.example.com';
		$GLOBALS['mcp_unit_state']['tables'] = ['plugin_mcp_audit' => true];
		$failById = array_column(mcp_doctor_register_checks(['mode' => 'run']), null, 'id');
		$this->assertSame('fail', $failById['mcp.public_url']['status']);
		$this->assertSame('fail', $failById['mcp.schema_tables']['status']);
		$this->assertSame('fail', $failById['mcp.tokens_health']['status']);

		// Table present but query fails -> fail.
		$GLOBALS['mcp_unit_state']['tables']['plugin_mcp_token'] = true;
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_row_prepared'] = fn (string $sql, array $params) => false;
		$queryFailById = array_column(mcp_doctor_register_checks(['mode' => 'run']), null, 'id');
		$this->assertSame('fail', $queryFailById['mcp.tokens_health']['status']);
	}

	public function testDoctorDebugInfoReturnsSiteHealthSectionWithoutSecrets() : void {
		$GLOBALS['mcp_unit_state']['settings']['mcp_public_url'] = 'https://cacti.example.com/cacti';
		$GLOBALS['mcp_unit_state']['tables'] = [
			'plugin_mcp_token'   => true,
			'plugin_mcp_audit'   => true,
			'plugin_mcp_ability' => true,
		];

		$sections = mcp_doctor_register_debug_info();
		$this->assertCount(1, $sections);

		$section = $sections[0];
		$this->assertSame('mcp.runtime', $section['id']);
		$this->assertSame('mcp', $section['plugin']);
		$this->assertSame('MCP Runtime', $section['label']);
		$this->assertFalse($section['private']);

		$fields = $section['fields'];
		$this->assertSame(
			['version', 'php_version', 'public_url_configured', 'schema_tables_present', 'registered_abilities_count'],
			array_keys($fields)
		);
		$this->assertSame(plugin_mcp_version()['version'], $fields['version']['value']);
		$this->assertSame(PHP_VERSION, $fields['php_version']['value']);
		$this->assertTrue($fields['public_url_configured']['value']);
		$this->assertTrue($fields['schema_tables_present']['value']);
		$this->assertSame(9, $fields['registered_abilities_count']['value']);

		$encoded = (string) json_encode($sections);
		$this->assertStringNotContainsString('cmcp_pat_', $encoded);
		$this->assertStringNotContainsString('token_hash', $encoded);
	}

	public function testApiRegisterResourcesAppendsMcpDescriptorsReferencingSchema() : void {
		$existing = [['name' => 'other/items', 'plugin' => 'other']];
		$result   = mcp_api_register_resources($existing);

		$this->assertCount(4, $result);
		$this->assertSame('other/items', $result[0]['name']);

		$mcpNames = array_column(array_slice($result, 1), 'name');
		$this->assertSame(['mcp/abilities', 'mcp/audit', 'mcp/tokens'], $mcpNames);

		foreach (array_slice($result, 1) as $resource) {
			$this->assertSame('mcp', $resource['plugin']);
			$this->assertSame('schema/mcp.schema.yaml', $resource['schema']);
			$this->assertTrue($resource['readOnly']);
		}
		$this->assertContains('token_hash', $result[3]['secretFieldsExcluded']);
	}
}
