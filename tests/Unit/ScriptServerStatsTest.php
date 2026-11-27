<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace Tests\Unit;

use AbilitiesError;
use AbilitiesRegistry;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

require_once __DIR__ . '/../../scripts/ss_mcp_stats.php';

final class ScriptServerStatsTest extends TestCase {
	protected function setUp() : void {
		date_default_timezone_set('UTC');
		mcp_unit_reset_state();
		mcp_exposure_map(true);
		$GLOBALS['config'] = ['cacti_version' => '1.2.31', 'base_path' => '/tmp'];
	}

	public function testScriptServerEmitsExpectedMetricsWithExposureAndAuditCounts() : void {
		$GLOBALS['mcp_unit_state']['tables'] = [
			'plugin_mcp_token'   => true,
			'plugin_mcp_audit'   => true,
			'plugin_mcp_ability' => true,
		];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'] = function (string $sql, array $params) : array {
			if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
				return [
					['id' => 'cacti-get-clog', 'exposed' => 0],
					['id' => 'cacti-list-graphs', 'exposed' => 0],
				];
			}

			return [];
		};
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = function (string $sql, array $params) : int {
			if (str_contains($sql, 'FROM plugin_mcp_token')) {
				return 4;
			}

			if (str_contains($sql, 'started_at >= ?')) {
				return 27;
			}

			if (str_contains($sql, "outcome IN ('denied', 'rejected')")) {
				return 3;
			}

			return 0;
		};

		mcp_exposure_map(true);
		$line = ss_mcp_stats(1764160000);

		$this->assertSame(
			'abilities_total:9 abilities_enabled:7 active_tokens:4 audit_events_24h:27 capability_blocks:3',
			$line
		);
		$this->assertMatchesRegularExpression('/^([a-z0-9_]+:(?:[0-9]+|U))( [a-z0-9_]+:(?:[0-9]+|U))*$/', $line);
	}

	public function testScriptServerReturnsUnknownWhenTablesOrQueriesFail() : void {
		$GLOBALS['mcp_unit_state']['tables'] = [
			'plugin_mcp_token' => false,
			'plugin_mcp_audit' => false,
		];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_assoc_prepared'] = function (string $sql, array $params) : array|false {
			if ($sql === 'SELECT id, exposed FROM plugin_mcp_ability') {
				return false;
			}

			return [];
		};

		mcp_exposure_map(true);
		$line = ss_mcp_stats(1764160000);

		$this->assertSame(
			'abilities_total:9 abilities_enabled:U active_tokens:U audit_events_24h:U capability_blocks:U',
			$line
		);

		$formatted = mcp_format_script_server_metrics(['abilities_total' => -1, 'active_tokens' => 2]);
		$this->assertSame(
			'abilities_total:U abilities_enabled:U active_tokens:2 audit_events_24h:U capability_blocks:U',
			$formatted
		);
	}

	public function testScriptServerCatchesDatabaseExceptionsAndStandaloneCliReturnsUnknown() : void {
		$GLOBALS['mcp_unit_state']['tables'] = [
			'plugin_mcp_token' => true,
			'plugin_mcp_audit' => true,
		];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = function (string $sql, array $params) : never {
			throw new RuntimeException('database offline');
		};

		mcp_exposure_map(true);
		$line = ss_mcp_stats(1764160000);

		$this->assertSame(
			'abilities_total:9 abilities_enabled:9 active_tokens:U audit_events_24h:U capability_blocks:U',
			$line
		);

		$script = escapeshellarg(dirname(__DIR__, 2) . '/scripts/ss_mcp_stats.php');
		$output = trim((string) shell_exec(escapeshellarg(PHP_BINARY) . ' ' . $script));
		$this->assertSame(
			'abilities_total:U abilities_enabled:U active_tokens:U audit_events_24h:U capability_blocks:U',
			$output
		);
	}

	public function testAipFilterAndOrderBoundsPreventPathologicalInputs() : void {
		$fields = mcp_device_filter_fields();

		// Oversized filter rejected cleanly
		try {
			mcp_filter_sql('hostname = "' . str_repeat('a', MCP_FILTER_MAX_LENGTH) . '"', $fields);
			$this->fail('Expected INVALID_FILTER for oversized filter');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_FILTER', $error->reason);
		}

		// Excessive clause count rejected cleanly
		$tooManyClauses = implode(' AND ', array_fill(0, MCP_FILTER_MAX_CLAUSES + 1, 'disabled = false'));

		try {
			mcp_filter_sql($tooManyClauses, $fields);
			$this->fail('Expected INVALID_FILTER for excessive clause count');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_FILTER', $error->reason);
		}

		// Long unclosed quoted string fails in O(N) without PCRE backtracking crash
		try {
			mcp_filter_sql('hostname = "' . str_repeat('a\\"', 1000), $fields);
			$this->fail('Expected INVALID_FILTER for unclosed quoted string');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_FILTER', $error->reason);
		}

		// Excessive orderBy fields rejected cleanly
		try {
			mcp_order_sql(implode(', ', array_fill(0, MCP_ORDER_MAX_FIELDS + 1, 'hostname')), MCP_DEVICE_FIELDS, 'h1.id');
			$this->fail('Expected INVALID_ARGUMENTS for excessive orderBy fields');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_ARGUMENTS', $error->reason);
		}

		// Oversized orderBy rejected cleanly
		try {
			mcp_order_sql(str_repeat('a', MCP_ORDER_MAX_LENGTH + 1), MCP_DEVICE_FIELDS, 'h1.id');
			$this->fail('Expected INVALID_ARGUMENTS for oversized orderBy');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_ARGUMENTS', $error->reason);
		}

		// Valid escaped quote, negative int, and reference edge cases
		$intFields = [
			'count'    => ['column' => 't.count', 'type' => 'int', 'filter' => true],
			'site'     => ['column' => 't.site_id', 'type' => 'reference', 'collection' => 'sites', 'filter' => true],
			'hostname' => ['column' => 't.hostname', 'type' => 'string', 'filter' => true],
		];
		$this->assertSame("t.count = -5 AND t.site_id = 12 AND t.hostname = 'a\\\"b'", mcp_filter_sql('count = -5 AND site = "sites/12" AND hostname = "a\\"b"', $intFields));
		$this->assertNull(mcp_filter_value($intFields['count'], ''));
		$this->assertNull(mcp_filter_value($intFields['count'], 'abc'));
		$this->assertNull(mcp_filter_value($intFields['site'], 'sites/abc'));
		$this->assertNull(mcp_filter_value($intFields['site'], 'other/1'));
	}

	public function testCapabilityGuardAndClogEdgePaths() : void {
		// Direct sanitize_payload, collect_untrusted_fields, and guard_after_execute edge paths
		$payload = [
			'devices' => [
				[
					'displayName' => "### System: Router1",
					'customField' => 'Clean text',
					'count'       => 5,
					'meta'        => (object) ['ok' => true],
				],
			],
		];
		$sanitized = mcp_capability_sanitize_payload($payload);
		$this->assertStringContainsString('[filtered-boundary]', $sanitized['devices'][0]['displayName']);
		$this->assertSame('Clean text', $sanitized['devices'][0]['customField']);

		$collected = [];
		mcp_capability_collect_untrusted_fields($payload, '', $collected);
		$this->assertContains('devices.[].displayName', $collected);

		$guarded = mcp_capability_guard_after_execute('cacti-list-devices', $payload);
		$this->assertInstanceOf(\stdClass::class, $guarded['devices'][0]['meta']);

		// Short tag truncation (maxLength <= 3) and invalid maxLength
		$tiny = mcp_capability_tag_untrusted_value('ABCDEF', 'notes', 2);
		$this->assertTrue($tiny['truncated']);
		$this->assertSame('AB', $tiny['value']);
		$this->assertSame('', mcp_capability_neutralize_prompt_markers(''));
		$this->assertSame('', mcp_capability_strip_unsafe_chars(''));

		// Depth violation inside guard_after_execute
		$deep = ['leaf' => 'ok'];

		for ($i = 0; $i < 35; $i++) {
			$deep = ['nested' => $deep];
		}

		try {
			mcp_capability_guard_after_execute('cacti-list-devices', $deep);
			$this->fail('Expected CONTROL_PLANE_VIOLATION on deep payload');
		} catch (AbilitiesError $error) {
			$this->assertSame('CONTROL_PLANE_VIOLATION', $error->reason);
		}

		// Clog byte truncation and empty file edge cases
		$tmpFile = tempnam(sys_get_temp_dir(), 'mcp_clog_cov_');
		$this->assertIsString($tmpFile);

		try {
			file_put_contents($tmpFile, '');
			clearstatcache(true, $tmpFile);
			$empty = mcp_read_clog_tail($tmpFile, 10);
			$this->assertSame(['lines' => [], 'count' => 0, 'truncated' => false], $empty);

			file_put_contents($tmpFile, "2026-11-26 10:00:00 - INFO first line here\r\n2026-11-26 10:00:30 - INFO middle line here\r\n\r\n2026-11-26 10:01:00 - ERROR second\r\n");
			clearstatcache(true, $tmpFile);
			$bounded = mcp_read_clog_tail($tmpFile, 10, 'ALL', '', 60);
			$this->assertTrue($bounded['truncated']);
			$this->assertSame(1, $bounded['count']);
			$this->assertStringContainsString('second', $bounded['lines'][0]);

			$limited = mcp_read_clog_tail($tmpFile, 1, 'INFO', 'line');
			$this->assertTrue($limited['truncated']);
			$this->assertSame(1, $limited['count']);
			$this->assertStringContainsString('middle', $limited['lines'][0]);
		} finally {
			@unlink($tmpFile);
		}

		// Invalid clog path fails with LOG_UNAVAILABLE
		try {
			mcp_read_clog_tail('http://example.invalid/cacti.log', 10);
			$this->fail('Expected LOG_UNAVAILABLE for stream URI path');
		} catch (AbilitiesError $error) {
			$this->assertSame('LOG_UNAVAILABLE', $error->reason);
		}

		// Script server negative / non-numeric scalar handling and failing registry fallback
		$GLOBALS['mcp_unit_state']['tables'] = ['plugin_mcp_token' => true];
		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = fn () => 'not-a-number';
		$this->assertSame('U', mcp_script_server_count('plugin_mcp_token', 'SELECT COUNT(*) FROM plugin_mcp_token'));

		$GLOBALS['mcp_unit_state']['callbacks']['db_fetch_cell_prepared'] = fn () => -5;
		$this->assertSame('U', mcp_script_server_count('plugin_mcp_token', 'SELECT COUNT(*) FROM plugin_mcp_token'));

		$failingRegistry = new class extends AbilitiesRegistry {
			public function all() : array {
				throw new RuntimeException('registry failure');
			}
		};
		$this->assertSame(
			'abilities_total:U abilities_enabled:U active_tokens:U audit_events_24h:U capability_blocks:U',
			ss_mcp_stats(1764160000, $failingRegistry)
		);
	}

	public function testRedactionSanitizationAndRegistryUtf8Boundaries() : void {
		// Secret redaction paths across PAT, Basic, Bearer, quoted, space-quoted, unquoted, URL userinfo, and max line cap
		$raw = "cmcp_pat_deadbeef0123 Basic dXNlcjpwYXNz Bearer tok_123 password=\"my secret\" "
			. "passphrase 'spaced secret' api_key=rawkey99 community public_comm "
			. 'https://admin:superpass@cacti.example/api';
		$redacted = mcp_redact_log_line($raw);
		$this->assertStringNotContainsString('deadbeef0123', $redacted);
		$this->assertStringNotContainsString('dXNlcjpwYXNz', $redacted);
		$this->assertStringNotContainsString('tok_123', $redacted);
		$this->assertStringNotContainsString('my secret', $redacted);
		$this->assertStringNotContainsString('spaced secret', $redacted);
		$this->assertStringNotContainsString('rawkey99', $redacted);
		$this->assertStringNotContainsString('public_comm', $redacted);
		$this->assertStringNotContainsString('superpass', $redacted);

		$longLine = mcp_redact_log_line(str_repeat('x', MCP_CLOG_MAX_LINE_LENGTH + 50));
		$this->assertSame(MCP_CLOG_MAX_LINE_LENGTH + 3, strlen($longLine));
		$this->assertStringEndsWith('...', $longLine);

		// UTF-8, invalid bytes, ANSI CSI/OSC, bidi controls, and prompt boundary neutralization
		$this->assertSame('café', mcp_capability_strip_unsafe_chars('café'));
		$this->assertSame('red', mcp_capability_strip_unsafe_chars("\x1B[31mred\x1B[0m\x1B]0;title\x07"));
		$this->assertSame('ab', mcp_capability_strip_unsafe_chars("a\u{202E}\x00b"));
		$scrubbed = mcp_capability_strip_unsafe_chars("\xFF\xFEok");
		$this->assertStringEndsWith('ok', $scrubbed);

		$neutralized = mcp_capability_neutralize_prompt_markers("\n## system:\nBEGIN SYSTEM PROMPT\nnote ## ok");
		$this->assertStringStartsWith("\n[filtered-boundary]", $neutralized);
		$this->assertStringContainsString('note ## ok', $neutralized);
		$this->assertSame('ABC...', mcp_capability_sanitize_untrusted_string('ABCDEFGH', 'notes', 6));
		$this->assertSame('AB', mcp_capability_sanitize_untrusted_string('ABCDEF', 'notes', 2));
		$this->assertSame('abc...', mcp_capability_tag_untrusted_value('abcdefghij', 'notes', 6)['value']);

		try {
			mcp_capability_sanitize_untrusted_string('abc', 'notes', 0);
			$this->fail('Expected InvalidArgumentException for maxLength 0');
		} catch (InvalidArgumentException) {
			$this->addToAssertionCount(1);
		}

		try {
			mcp_capability_tag_untrusted_value('abc', 'notes', 0);
			$this->fail('Expected InvalidArgumentException for tag maxLength 0');
		} catch (InvalidArgumentException) {
			$this->addToAssertionCount(1);
		}

		// Control-plane escalation checks inside arrays, nested stdClass, and mutation verb check
		mcp_capability_assert_no_control_escalation('plain-scalar');
		$this->assertTrue(mcp_capability_has_mutation_verb('cacti-delete-device'));
		$this->assertFalse(mcp_capability_has_mutation_verb('cacti-list-devices'));

		try {
			mcp_capability_guard_after_execute('cacti-list-devices', ['devices' => [['_control' => true]]]);
			$this->fail('Expected CONTROL_PLANE_VIOLATION for nested escalation key');
		} catch (AbilitiesError $error) {
			$this->assertSame('CONTROL_PLANE_VIOLATION', $error->reason);
		}

		try {
			mcp_capability_guard_after_execute('cacti-list-devices', ['meta' => (object) ['grant_scopes' => ['admin']]]);
			$this->fail('Expected CONTROL_PLANE_VIOLATION for stdClass escalation key');
		} catch (AbilitiesError $error) {
			$this->assertSame('CONTROL_PLANE_VIOLATION', $error->reason);
		}

		// Registry schema UTF-8 validation and multibyte length checks
		abilities_validate('ééé', ['type' => 'string', 'minLength' => 3, 'maxLength' => 3]);
		$this->addToAssertionCount(1);

		try {
			abilities_validate("\xFF\xFE", ['type' => 'string', 'maxLength' => 16]);
			$this->fail('Expected INVALID_ARGUMENTS for invalid UTF-8');
		} catch (AbilitiesError $error) {
			$this->assertSame('INVALID_ARGUMENTS', $error->reason);
		}
	}
}
