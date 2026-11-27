<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Decoupled cross-plugin integration hooks for CasC, Doctor, and API resource
 * discovery. Uses plain-array descriptors only, with zero cross-plugin PHP
 * imports so this plugin operates independently when peer plugins are absent. */

require_once __DIR__ . '/origin.php';
require_once __DIR__ . '/storage.php';

/** Path to the static declarative schema relative to the plugin root. */
const MCP_SCHEMA_FILE = 'schema/mcp.schema.yaml';

/** Runtime tables belonging to MCP state (never reconciled by CasC). */
const MCP_RUNTIME_TABLES = [
	'plugin_mcp_token',
	'plugin_mcp_audit',
	'plugin_mcp_ability',
];

/**
 * Describe the declarative CasC configuration schema for plugin_mcp.
 *
 * Strictly separates config (mcp_public_url) from runtime state tables
 * (plugin_mcp_token, plugin_mcp_audit, plugin_mcp_ability).
 *
 * @return array<string, mixed> Plain-array schema descriptor.
 */
function mcp_casc_describe_schema() : array {
	return [
		'plugin'        => 'mcp',
		'schemaVersion' => '1.0',
		'schemaFile'    => MCP_SCHEMA_FILE,
		'config'        => [
			'mcp_public_url' => [
				'type'        => 'string',
				'format'      => 'uri',
				'nullable'    => true,
				'default'     => '',
				'maxLength'   => 255,
				'description' => 'Public HTTPS (or loopback HTTP) Cacti base URL used by MCP clients.',
			],
		],
		'state' => [
			'reconciled' => false,
			'tables'     => MCP_RUNTIME_TABLES,
		],
	];
}

/**
 * Export the current declarative MCP configuration for CasC.
 *
 * Only exports configuration keys (mcp_public_url). Never exports personal
 * tokens, token hashes, or audit records.
 *
 * @param array<string, mixed> $context Optional export context.
 * @return array{schemaVersion: string, config: array{mcp_public_url: string}}
 */
function mcp_casc_export(array $context = []) : array {
	$raw        = function_exists('read_config_option') ? read_config_option('mcp_public_url') : '';
	$normalized = is_string($raw) && trim($raw) !== '' ? mcp_normalize_public_url($raw) : null;

	return [
		'schemaVersion' => '1.0',
		'config'        => [
			'mcp_public_url' => $normalized ?? '',
		],
	];
}

/**
 * Validate a desired CasC configuration payload for plugin_mcp.
 *
 * Rejects unknown config keys, invalid or non-HTTPS public URLs (except
 * loopback), and any attempt to reconcile runtime state or tokens via CasC.
 *
 * @param array<string, mixed> $desired Desired declarative payload.
 * @return array{valid: bool, errors: list<string>}
 */
function mcp_casc_validate(array $desired) : array {
	$errors = [];

	if (array_key_exists('state', $desired) || array_key_exists('tokens', $desired) || array_key_exists('plugin_mcp_token', $desired)) {
		$errors[] = 'Runtime state and tokens cannot be managed through CasC.';
	}

	if (array_key_exists('schemaVersion', $desired) && $desired['schemaVersion'] !== '1.0') {
		$errors[] = 'Unsupported schemaVersion; expected 1.0.';
	}

	$config = array_key_exists('config', $desired) ? $desired['config'] : $desired;

	if (!is_array($config)) {
		return ['valid' => false, 'errors' => ['Configuration section must be an array.']];
	}

	$allowedConfigKeys = ['mcp_public_url'];
	$metaKeys          = ['schemaVersion'];

	foreach (array_keys($config) as $key) {
		if (!is_string($key)) {
			$errors[] = 'Configuration keys must be strings.';

			continue;
		}

		if (array_key_exists('config', $desired)) {
			if (!in_array($key, $allowedConfigKeys, true)) {
				$errors[] = 'Unsupported config key: ' . $key;
			}
		} elseif (!in_array($key, array_merge($allowedConfigKeys, $metaKeys), true)) {
			if (!in_array($key, ['state', 'tokens', 'plugin_mcp_token'], true)) {
				$errors[] = 'Unsupported config key: ' . $key;
			}
		}
	}

	if (array_key_exists('mcp_public_url', $config)) {
		$url = $config['mcp_public_url'];

		if ($url !== null && !is_string($url)) {
			$errors[] = 'mcp_public_url must be a string or null.';
		} elseif (is_string($url) && trim($url) !== '') {
			if (strlen($url) > 255) {
				$errors[] = 'mcp_public_url must not exceed 255 characters.';
			} elseif (mcp_normalize_public_url($url) === null) {
				$errors[] = 'mcp_public_url must be an absolute https URL (or loopback http URL).';
			}
		}
	}

	return [
		'valid'  => $errors === [],
		'errors' => $errors,
	];
}

/**
 * Compute a declarative change plan comparing desired MCP config against live settings.
 *
 * @param array<string, mixed> $desired Desired declarative payload.
 * @return array{valid: bool, errors: list<string>, changes: list<array{field: string, action: string, before: string, after: string}>}
 */
function mcp_casc_plan(array $desired) : array {
	$validation = mcp_casc_validate($desired);

	if (!$validation['valid']) {
		return [
			'valid'   => false,
			'errors'  => $validation['errors'],
			'changes' => [],
		];
	}

	$config  = is_array($desired['config'] ?? null) ? $desired['config'] : $desired;
	$current = mcp_casc_export()['config']['mcp_public_url'];
	$changes = [];

	if (array_key_exists('mcp_public_url', $config)) {
		$rawTarget = $config['mcp_public_url'];
		$target    = is_string($rawTarget) && trim($rawTarget) !== ''
			? (mcp_normalize_public_url($rawTarget) ?? '')
			: '';

		if ($target !== $current) {
			$changes[] = [
				'field'  => 'mcp_public_url',
				'action' => 'update',
				'before' => $current,
				'after'  => $target,
			];
		}
	}

	return [
		'valid'   => true,
		'errors'  => [],
		'changes' => $changes,
	];
}

/**
 * Apply a validated declarative MCP configuration update to Cacti settings.
 *
 * Never mutates runtime token, audit, or exposure tables.
 *
 * @param array<string, mixed> $desired Desired declarative payload.
 * @param bool                 $dryRun  When true, compute plan without writing settings.
 * @return array{applied: bool, dryRun: bool, errors: list<string>, changes: list<array{field: string, action: string, before: string, after: string}>}
 */
function mcp_casc_apply(array $desired, bool $dryRun = false) : array {
	$plan = mcp_casc_plan($desired);

	if (!$plan['valid']) {
		return [
			'applied' => false,
			'dryRun'  => $dryRun,
			'errors'  => $plan['errors'],
			'changes' => [],
		];
	}

	if ($dryRun || $plan['changes'] === []) {
		return [
			'applied' => !$dryRun,
			'dryRun'  => $dryRun,
			'errors'  => [],
			'changes' => $plan['changes'],
		];
	}

	foreach ($plan['changes'] as $change) {
		if ($change['field'] === 'mcp_public_url') {
			if (function_exists('set_config_option')) {
				set_config_option('mcp_public_url', $change['after']);
			} elseif (function_exists('db_execute_prepared')) {
				$saved = db_execute_prepared(
					'REPLACE INTO settings (name, value) VALUES (?, ?)',
					['mcp_public_url', $change['after']]
				);

				if (!$saved) {
					return [
						'applied' => false,
						'dryRun'  => false,
						'errors'  => ['Failed to persist mcp_public_url setting.'],
						'changes' => [],
					];
				}
			} else {
				return [
					'applied' => false,
					'dryRun'  => false,
					'errors'  => ['No Cacti settings persistence helper is available.'],
					'changes' => [],
				];
			}
		}
	}

	return [
		'applied' => true,
		'dryRun'  => false,
		'errors'  => [],
		'changes' => $plan['changes'],
	];
}

/**
 * Register the MCP CasC provider descriptor without importing plugin_casc.
 *
 * @param mixed $registrar Optional registrar object with a register() method.
 * @return array<string, mixed> Plain-array CasC provider descriptor.
 */
function mcp_casc_register_providers(mixed $registrar = null) : array {
	$descriptor = [
		'slug'           => 'mcp',
		'schemaVersion'  => '1.0',
		'schema'         => mcp_casc_describe_schema(),
		'export'         => 'mcp_casc_export',
		'validate'       => 'mcp_casc_validate',
		'plan'           => 'mcp_casc_plan',
		'apply'          => 'mcp_casc_apply',
		'describeSchema' => 'mcp_casc_describe_schema',
	];

	if (is_object($registrar) && method_exists($registrar, 'register')) {
		$registrar->register($descriptor);
	}

	return $descriptor;
}

/**
 * Register Doctor health checks for plugin_mcp using plain-array descriptors.
 *
 * Supports both mode=list (metadata discovery with status=info) and mode=run
 * (live evaluation returning ok, warn, fail, or info). Never exposes token
 * values or hashes.
 *
 * @param array<string, mixed> $context Doctor hook context, including optional 'mode' ('list'|'run').
 * @return list<array{id: string, plugin: string, category: string, title: string, status: string, message: string, details: array<string, mixed>, remediation: string}>
 */
function mcp_doctor_register_checks(array $context = []) : array {
	$mode = is_string($context['mode'] ?? null) ? $context['mode'] : 'run';

	if ($mode === 'list') {
		return [
			[
				'id'          => 'mcp.public_url',
				'plugin'      => 'mcp',
				'category'    => 'configuration',
				'title'       => 'MCP Public Cacti URL',
				'status'      => 'info',
				'message'     => 'Checks that mcp_public_url is configured with a valid HTTPS (or loopback HTTP) URL.',
				'details'     => [],
				'remediation' => 'Configure Public Cacti URL under Settings > MCP.',
			],
			[
				'id'          => 'mcp.schema_tables',
				'plugin'      => 'mcp',
				'category'    => 'database',
				'title'       => 'MCP Database Tables',
				'status'      => 'info',
				'message'     => 'Checks that required plugin_mcp_* database tables exist.',
				'details'     => [],
				'remediation' => 'Re-run plugin_mcp installation to create missing tables.',
			],
			[
				'id'          => 'mcp.tokens_health',
				'plugin'      => 'mcp',
				'category'    => 'security',
				'title'       => 'MCP Personal Tokens Health',
				'status'      => 'info',
				'message'     => 'Checks aggregate personal token counts for expired unrevoked tokens.',
				'details'     => [],
				'remediation' => 'Revoke expired personal access tokens from Management > MCP.',
			],
		];
	}

	// 1. Public URL check.
	$rawUrl    = function_exists('read_config_option') ? read_config_option('mcp_public_url') : '';
	$trimmed   = is_string($rawUrl) ? trim($rawUrl) : '';
	$publicUrl = $trimmed !== '' ? mcp_normalize_public_url($trimmed) : null;

	if ($publicUrl !== null) {
		$urlCheck = [
			'id'          => 'mcp.public_url',
			'plugin'      => 'mcp',
			'category'    => 'configuration',
			'title'       => 'MCP Public Cacti URL',
			'status'      => 'ok',
			'message'     => 'Public Cacti URL is configured and valid.',
			'details'     => ['configured' => true, 'public_url' => $publicUrl],
			'remediation' => '',
		];
	} elseif ($trimmed !== '') {
		$urlCheck = [
			'id'          => 'mcp.public_url',
			'plugin'      => 'mcp',
			'category'    => 'configuration',
			'title'       => 'MCP Public Cacti URL',
			'status'      => 'fail',
			'message'     => 'Public Cacti URL is configured but invalid; HTTPS is required for non-loopback hosts.',
			'details'     => ['configured' => false],
			'remediation' => 'Set an absolute https:// URL under Settings > MCP.',
		];
	} else {
		$urlCheck = [
			'id'          => 'mcp.public_url',
			'plugin'      => 'mcp',
			'category'    => 'configuration',
			'title'       => 'MCP Public Cacti URL',
			'status'      => 'warn',
			'message'     => 'Public Cacti URL is not configured; the MCP endpoint will refuse requests.',
			'details'     => ['configured' => false],
			'remediation' => 'Configure Public Cacti URL under Settings > MCP.',
		];
	}

	// 2. Schema tables check.
	$present = [];
	$missing = [];

	foreach (MCP_RUNTIME_TABLES as $table) {
		if (function_exists('db_table_exists') && db_table_exists($table)) {
			$present[] = $table;
		} else {
			$missing[] = $table;
		}
	}

	$schemaCheck = [
		'id'          => 'mcp.schema_tables',
		'plugin'      => 'mcp',
		'category'    => 'database',
		'title'       => 'MCP Database Tables',
		'status'      => $missing === [] ? 'ok' : 'fail',
		'message'     => $missing === []
			? 'All MCP database tables are present.'
			: 'Missing required MCP database tables: ' . implode(', ', $missing) . '.',
		'details'     => ['present' => $present, 'missing' => $missing],
		'remediation' => $missing === [] ? '' : 'Reinstall or repair the MCP plugin schema.',
	];

	// 3. Tokens health check (aggregate counts only, never token secrets or hashes).
	if (in_array('plugin_mcp_token', $missing, true) || !function_exists('db_fetch_row_prepared')) {
		$tokensCheck = [
			'id'          => 'mcp.tokens_health',
			'plugin'      => 'mcp',
			'category'    => 'security',
			'title'       => 'MCP Personal Tokens Health',
			'status'      => 'fail',
			'message'     => 'Unable to inspect token health because plugin_mcp_token is unavailable.',
			'details'     => ['table_available' => false],
			'remediation' => 'Ensure plugin_mcp_token exists and the database connection is healthy.',
		];
	} else {
		$now   = time();
		$stats = db_fetch_row_prepared(
			'SELECT COUNT(*) AS total_count, '
				. 'SUM(CASE WHEN revoked = 0 AND expires_at > ? THEN 1 ELSE 0 END) AS active_count, '
				. 'SUM(CASE WHEN revoked = 0 AND expires_at <= ? THEN 1 ELSE 0 END) AS expired_unrevoked_count, '
				. 'SUM(CASE WHEN revoked = 1 THEN 1 ELSE 0 END) AS revoked_count '
				. 'FROM plugin_mcp_token',
			[$now, $now]
		);

		if (!is_array($stats)) {
			$tokensCheck = [
				'id'          => 'mcp.tokens_health',
				'plugin'      => 'mcp',
				'category'    => 'security',
				'title'       => 'MCP Personal Tokens Health',
				'status'      => 'fail',
				'message'     => 'Token health query failed.',
				'details'     => ['query_failed' => true],
				'remediation' => 'Check database permissions and table integrity for plugin_mcp_token.',
			];
		} else {
			$total            = (int) ($stats['total_count'] ?? 0);
			$active           = (int) ($stats['active_count'] ?? 0);
			$expiredUnrevoked = (int) ($stats['expired_unrevoked_count'] ?? 0);
			$revoked          = (int) ($stats['revoked_count'] ?? 0);

			$tokensCheck = [
				'id'       => 'mcp.tokens_health',
				'plugin'   => 'mcp',
				'category' => 'security',
				'title'    => 'MCP Personal Tokens Health',
				'status'   => $expiredUnrevoked > 0 ? 'warn' : 'ok',
				'message'  => $expiredUnrevoked > 0
					? sprintf('%d expired personal token(s) are not yet marked revoked.', $expiredUnrevoked)
					: sprintf('%d active, %d revoked, 0 expired unrevoked personal token(s).', $active, $revoked),
				'details'  => [
					'total_count'             => $total,
					'active_count'            => $active,
					'expired_unrevoked_count' => $expiredUnrevoked,
					'revoked_count'           => $revoked,
				],
				'remediation' => $expiredUnrevoked > 0
					? 'Revoke expired personal tokens from Management > MCP.'
					: '',
			];
		}
	}

	return [$urlCheck, $schemaCheck, $tokensCheck];
}

/**
 * Return WordPress Site Health style debug information sections for plugin_mcp.
 *
 * Exposes non-secret runtime metadata only; never includes tokens or hashes.
 *
 * @param array<string, mixed> $context Optional Doctor debug-info context.
 * @return list<array{id: string, plugin: string, label: string, description: string, private: bool, fields: array<string, array{label: string, value: mixed}>}>
 */
function mcp_doctor_register_debug_info(array $context = []) : array {
	$info    = function_exists('plugin_mcp_version') ? plugin_mcp_version() : [];
	$version = is_array($info) && isset($info['version']) ? (string) $info['version'] : '0.0.0';

	$publicUrl     = function_exists('read_config_option') ? mcp_public_url() : null;
	$tablesPresent = true;

	foreach (MCP_RUNTIME_TABLES as $table) {
		if (!function_exists('db_table_exists') || !db_table_exists($table)) {
			$tablesPresent = false;

			break;
		}
	}

	$abilitiesCount = count(MCP_BUILTIN_REALMS);

	if (function_exists('mcp_registry') && function_exists('db_fetch_assoc_prepared')) {
		try {
			$abilitiesCount = count(mcp_registry()->all());
		} catch (Throwable $error) {
			$abilitiesCount = count(MCP_BUILTIN_REALMS);
		}
	}

	return [
		[
			'id'          => 'mcp.runtime',
			'plugin'      => 'mcp',
			'label'       => 'MCP Runtime',
			'description' => 'Runtime version, schema readiness, and registered ability count for Cacti MCP.',
			'private'     => false,
			'fields'      => [
				'version' => [
					'label' => 'Plugin Version',
					'value' => $version,
				],
				'php_version' => [
					'label' => 'PHP Version',
					'value' => PHP_VERSION,
				],
				'public_url_configured' => [
					'label' => 'Public URL Configured',
					'value' => $publicUrl !== null,
				],
				'schema_tables_present' => [
					'label' => 'Schema Tables Present',
					'value' => $tablesPresent,
				],
				'registered_abilities_count' => [
					'label' => 'Registered Abilities Count',
					'value' => $abilitiesCount,
				],
			],
		],
	];
}

/**
 * Append plain-array MCP resource descriptors for plugin_api discovery.
 *
 * @param array<int, array<string, mixed>> $resources Existing registered resource descriptors.
 * @return array<int, array<string, mixed>> Updated list including MCP resources.
 */
function mcp_api_register_resources(array $resources = []) : array {
	$mcpResources = [
		[
			'name'        => 'mcp/abilities',
			'plugin'      => 'mcp',
			'schema'      => MCP_SCHEMA_FILE,
			'readOnly'    => true,
			'methods'     => ['GET'],
			'description' => 'Registered read-only MCP abilities and exposure metadata.',
		],
		[
			'name'        => 'mcp/audit',
			'plugin'      => 'mcp',
			'schema'      => MCP_SCHEMA_FILE,
			'readOnly'    => true,
			'methods'     => ['GET'],
			'description' => 'Append-only MCP ability execution and token lifecycle audit records.',
		],
		[
			'name'                 => 'mcp/tokens',
			'plugin'               => 'mcp',
			'schema'               => MCP_SCHEMA_FILE,
			'readOnly'             => true,
			'methods'              => ['GET'],
			'description'          => 'Personal access token metadata excluding secret values and hashes.',
			'secretFieldsExcluded' => ['token_hash'],
		],
	];

	foreach ($mcpResources as $resource) {
		$resources[] = $resource;
	}

	return $resources;
}
