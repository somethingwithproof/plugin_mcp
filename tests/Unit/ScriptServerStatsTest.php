<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace Tests\Unit;

use AbilitiesError;
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
	}
}
