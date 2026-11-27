<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

require_once __DIR__ . '/registry.php';
require_once __DIR__ . '/storage.php';
require_once __DIR__ . '/aip.php';
require_once __DIR__ . '/capability_guard.php';
require_once __DIR__ . '/../setup.php';

/* Ported from the core REST API resources.php devices definition (HOST_* constants). */
const MCP_DEVICE_STATES = [0 => 'UNKNOWN', 1 => 'DOWN', 2 => 'RECOVERING', 3 => 'UP', 4 => 'ERROR'];

/* Cacti poller status codes (POLLER_STATUS_* constants). */
const MCP_POLLER_STATES = [
	0 => 'NEW', 1 => 'RUNNING', 2 => 'IDLE', 3 => 'UNKNOWN',
	4 => 'DISABLED', 5 => 'RECOVERING', 6 => 'ERROR',
];

const MCP_CLOG_MAX_LINES = 200;
const MCP_CLOG_DEFAULT_LINES = 50;
const MCP_CLOG_MAX_BYTES = 1048576;
const MCP_CLOG_MAX_LINE_LENGTH = 2048;
const MCP_CLOG_SEVERITIES = [
	'ALL', 'DEBUG', 'INFO', 'NOTICE', 'WARNING', 'ERROR',
	'CRITICAL', 'ALERT', 'EMERGENCY', 'FATAL', 'STATS', 'POLLER', 'SYSTEM',
];

/* Filter and order fields for devices, in the mcp_filter_sql() format. Columns
 * are written for the outer h1 alias; get_allowed_devices() applies the WHERE
 * fragment inside a subquery that aliases host as h, so filters swap the alias
 * (see mcp_device_filter_fields()). */
const MCP_DEVICE_FIELDS = [
	'displayName'    => ['column' => 'h1.description', 'type' => 'string', 'filter' => true, 'order' => true],
	'hostname'       => ['column' => 'h1.hostname', 'type' => 'string', 'filter' => true, 'order' => true],
	'disabled'       => ['column' => 'h1.disabled', 'type' => 'bool', 'filter' => true],
	'site'           => ['column' => 'h1.site_id', 'type' => 'reference', 'collection' => 'sites', 'filter' => true],
	'poller'         => ['column' => 'h1.poller_id', 'type' => 'reference', 'collection' => 'pollers', 'filter' => true],
	'deviceTemplate' => ['column' => 'h1.host_template_id', 'type' => 'reference', 'collection' => 'deviceTemplates', 'filter' => true],
	'externalId'     => ['column' => 'h1.external_id', 'type' => 'string', 'filter' => true],
	'state'          => ['column' => 'h1.status', 'type' => 'enum', 'values' => MCP_DEVICE_STATES, 'filter' => true],
	'name'           => ['column' => 'h1.id', 'type' => 'int', 'order' => true],
];

const MCP_SITE_FIELDS = [
	'displayName' => ['column' => 's.name', 'type' => 'string', 'filter' => true, 'order' => true],
	'city'        => ['column' => 's.city', 'type' => 'string', 'filter' => true, 'order' => true],
	'state'       => ['column' => 's.state', 'type' => 'string', 'filter' => true, 'order' => true],
	'country'     => ['column' => 's.country', 'type' => 'string', 'filter' => true, 'order' => true],
	'timezone'    => ['column' => 's.timezone', 'type' => 'string', 'filter' => true],
	'alternateId' => ['column' => 's.alternate_id', 'type' => 'string', 'filter' => true],
	'name'        => ['column' => 's.id', 'type' => 'int', 'order' => true],
];

const MCP_POLLER_FIELDS = [
	'displayName' => ['column' => 'p.name', 'type' => 'string', 'filter' => true, 'order' => true],
	'hostname'    => ['column' => 'p.hostname', 'type' => 'string', 'filter' => true, 'order' => true],
	'disabled'    => ['column' => 'p.disabled', 'type' => 'bool', 'filter' => true],
	'state'       => ['column' => 'p.status', 'type' => 'enum', 'values' => MCP_POLLER_STATES, 'filter' => true],
	'name'        => ['column' => 'p.id', 'type' => 'int', 'order' => true],
];

const MCP_TREE_FIELDS = [
	'displayName' => ['column' => 'gt.name', 'type' => 'string', 'filter' => true, 'order' => true],
	'enabled'     => ['column' => 'gt.enabled', 'type' => 'bool', 'filter' => true],
	'name'        => ['column' => 'gt.id', 'type' => 'int', 'order' => true],
];

const MCP_GRAPH_FIELDS = [
	'title'         => ['column' => 'gtg.title_cache', 'type' => 'string', 'filter' => true, 'order' => true],
	'device'        => ['column' => 'gl.host_id', 'type' => 'reference', 'collection' => 'devices', 'filter' => true],
	'graphTemplate' => [
		'column' => 'gl.graph_template_id', 'type' => 'reference',
		'collection' => 'graphTemplates', 'filter' => true,
	],
	'templateName'  => ['column' => 'gt.name', 'type' => 'string', 'filter' => true, 'order' => true],
	'name'          => ['column' => 'gtg.local_graph_id', 'type' => 'int', 'order' => true],
];

const MCP_DATA_SOURCE_FIELDS = [
	'displayName'  => ['column' => 'dtd.name_cache', 'type' => 'string', 'filter' => true, 'order' => true],
	'device'       => ['column' => 'dl.host_id', 'type' => 'reference', 'collection' => 'devices', 'filter' => true],
	'dataTemplate' => [
		'column' => 'dl.data_template_id', 'type' => 'reference',
		'collection' => 'dataTemplates', 'filter' => true,
	],
	'active'       => ['column' => 'dtd.active', 'type' => 'bool', 'filter' => true],
	'name'         => ['column' => 'dl.id', 'type' => 'int', 'order' => true],
];

/**
 * Build the ability registry populated with built-in Cacti abilities and plugin hooks.
 *
 * @return AbilitiesRegistry Configured registry instance.
 */
function mcp_registry() : AbilitiesRegistry {
	$registry = new AbilitiesRegistry();
	$registry->setExposure(fn (string $id, string $namespace) => mcp_is_exposed($id, $namespace, mcp_exposure_map()));

	$registry->registerCategory('inventory', 'Inventory');
	$registry->registerCategory('system', 'System');
	mcp_register_builtins($registry);
	mcp_dispatch_ability_hooks($registry);

	return $registry;
}

/**
 * Shared closed object schema builder for resource schemas.
 *
 * @param array<string, array<string, mixed>> $properties Map of property name to JSON schema.
 * @return array<string, mixed> Closed object JSON schema.
 */
function mcp_object_schema(array $properties) : array {
	return [
		'type'                 => 'object',
		'properties'           => $properties,
		'required'             => array_keys($properties),
		'additionalProperties' => false,
	];
}

/**
 * Shared input/output schema and paginated execution wrapper for AIP list abilities.
 *
 * @param AbilitiesRegistry                                                                       $registry          Target registry.
 * @param string                                                                                  $id                Ability identifier.
 * @param string                                                                                  $label             Human-readable ability title.
 * @param string                                                                                  $description       Ability description.
 * @param string                                                                                  $category          Registered ability category ID.
 * @param string                                                                                  $listKey           Response key holding resource rows.
 * @param array<string, mixed>                                                                    $itemSchema        JSON schema for each item in the list.
 * @param array<string, array<string, mixed>>                                                     $filterFields      Allowed AIP-160 filter fields.
 * @param array<string, array<string, mixed>>                                                     $orderFields       Allowed AIP-132 orderBy fields.
 * @param string                                                                                  $tieBreakerColumn  SQL column appended for stable offset paging.
 * @param string                                                                                  $fingerprintPrefix Prefix binding page tokens to this ability.
 * @param callable(int): bool                                                                     $permission        Permission callback checking user access.
 * @param callable(int, string, string, array{size: int, offset: int}): list<array<string, mixed>> $fetch            Row fetcher callback.
 * @param callable(array<string, mixed>): array<string, mixed>                                    $mapper            Row-to-resource mapper callback.
 * @return void
 */
function mcp_register_list_ability(
	AbilitiesRegistry $registry,
	string $id,
	string $label,
	string $description,
	string $category,
	string $listKey,
	array $itemSchema,
	array $filterFields,
	array $orderFields,
	string $tieBreakerColumn,
	string $fingerprintPrefix,
	callable $permission,
	callable $fetch,
	callable $mapper
) : void {
	$annotations = ['readOnly' => true, 'destructive' => false, 'idempotent' => true];
	mcp_capability_validate_annotations($annotations, $id);

	$registry->register($id, [
		'label'        => $label,
		'description'  => $description,
		'category'     => $category,
		'input_schema' => [
			'type'       => 'object',
			'properties' => [
				'pageSize'  => ['type' => 'integer', 'minimum' => 0, 'maximum' => 1000],
				'pageToken' => ['type' => 'string', 'maxLength' => 512],
				'filter'    => ['type' => 'string', 'maxLength' => 1024],
				'orderBy'   => ['type' => 'string', 'maxLength' => 128],
			],
			'additionalProperties' => false,
		],
		'output_schema' => mcp_object_schema([
			$listKey        => ['type' => 'array', 'items' => $itemSchema, 'maxItems' => MCP_PAGE_SIZE_MAX],
			'nextPageToken' => ['type' => ['string', 'null']],
		]),
		'annotations' => $annotations,
		'permission'  => $permission,
		'execute'     => function (int $user, stdClass $args) use (
			$id,
			$listKey,
			$filterFields,
			$orderFields,
			$tieBreakerColumn,
			$fingerprintPrefix,
			$fetch,
			$mapper
		) {
			mcp_capability_assert_no_control_escalation($args);

			$filter      = (string) ($args->filter ?? '');
			$orderBy     = trim((string) ($args->orderBy ?? ''));
			$fingerprint = sha1($fingerprintPrefix . $filter . "\0" . $orderBy);
			$page        = mcp_page($args, $fingerprint);
			$where       = mcp_filter_sql($filter, $filterFields);
			// The id tie-breaker keeps offset paging stable when the requested order has ties.
			$order = $orderBy === ''
				? $tieBreakerColumn . ' ASC'
				: mcp_order_sql($orderBy, $orderFields, '') . ', ' . $tieBreakerColumn . ' ASC';
			$rows = $fetch($user, $where, $order, $page);
			$more = count($rows) > $page['size'];

			return mcp_capability_guard_after_execute($id, [
				$listKey        => array_map($mapper, array_slice($rows, 0, $page['size'])),
				'nextPageToken' => $more ? mcp_page_token($page['offset'] + $page['size'], $fingerprint) : null,
			]);
		},
	]);
}

/**
 * Register all built-in read-only Cacti abilities on the given registry.
 *
 * @param AbilitiesRegistry $registry Target registry.
 * @return void
 */
function mcp_register_builtins(AbilitiesRegistry $registry) : void {
	$annotations = ['readOnly' => true, 'destructive' => false, 'idempotent' => true];
	$nullable    = fn (string $type) => ['type' => [$type, 'null']];

	$device = mcp_object_schema([
		'name'               => ['type' => 'string'],
		'displayName'        => ['type' => 'string'],
		'hostname'           => ['type' => 'string'],
		'deviceTemplate'     => $nullable('string'),
		'site'               => $nullable('string'),
		'poller'             => $nullable('string'),
		'externalId'         => $nullable('string'),
		'location'           => $nullable('string'),
		'notes'              => $nullable('string'),
		'disabled'           => ['type' => 'boolean'],
		'snmpVersion'        => $nullable('integer'),
		'snmpPort'           => $nullable('integer'),
		'snmpTimeout'        => $nullable('integer'),
		'snmpRetries'        => $nullable('integer'),
		'maxOids'            => $nullable('integer'),
		'bulkWalkSize'       => $nullable('integer'),
		'deviceThreads'      => $nullable('integer'),
		'availabilityMethod' => $nullable('integer'),
		'pingMethod'         => $nullable('integer'),
		'pingPort'           => $nullable('integer'),
		'pingTimeout'        => $nullable('integer'),
		'pingRetries'        => $nullable('integer'),
		'state'              => $nullable('string'),
		'availability'       => $nullable('number'),
		'lastError'          => $nullable('string'),
		'failTime'           => $nullable('string'),
		'recoveryTime'       => $nullable('string'),
		'createTime'         => $nullable('string'),
	]);

	$site = mcp_object_schema([
		'name'        => ['type' => 'string'],
		'displayName' => ['type' => 'string'],
		'address1'    => $nullable('string'),
		'address2'    => $nullable('string'),
		'city'        => $nullable('string'),
		'state'       => $nullable('string'),
		'postalCode'  => $nullable('string'),
		'country'     => $nullable('string'),
		'timezone'    => $nullable('string'),
		'latitude'    => $nullable('number'),
		'longitude'   => $nullable('number'),
		'zoom'        => $nullable('integer'),
		'alternateId' => $nullable('string'),
		'notes'       => $nullable('string'),
	]);

	$poller = mcp_object_schema([
		'name'           => ['type' => 'string'],
		'displayName'    => ['type' => 'string'],
		'hostname'       => ['type' => 'string'],
		'disabled'       => ['type' => 'boolean'],
		'state'          => $nullable('string'),
		'timezone'       => $nullable('string'),
		'notes'          => $nullable('string'),
		'processes'      => $nullable('integer'),
		'threads'        => $nullable('integer'),
		'totalPolls'     => $nullable('integer'),
		'syncInterval'   => $nullable('integer'),
		'snmpItems'      => $nullable('integer'),
		'scriptItems'    => $nullable('integer'),
		'serverItems'    => $nullable('integer'),
		'totalTime'      => $nullable('number'),
		'maxTime'        => $nullable('number'),
		'minTime'        => $nullable('number'),
		'avgTime'        => $nullable('number'),
		'requiresSync'   => ['type' => 'boolean'],
		'lastUpdateTime' => $nullable('string'),
		'lastStatusTime' => $nullable('string'),
		'lastSyncTime'   => $nullable('string'),
	]);

	$tree = mcp_object_schema([
		'name'             => ['type' => 'string'],
		'displayName'      => ['type' => 'string'],
		'enabled'          => ['type' => 'boolean'],
		'locked'           => $nullable('boolean'),
		'sortType'         => $nullable('integer'),
		'sequence'         => $nullable('integer'),
		'lastModifiedTime' => $nullable('string'),
	]);

	$graph = mcp_object_schema([
		'name'              => ['type' => 'string'],
		'title'             => ['type' => 'string'],
		'device'            => $nullable('string'),
		'deviceDisplayName' => $nullable('string'),
		'graphTemplate'     => $nullable('string'),
		'templateName'      => $nullable('string'),
		'width'             => $nullable('integer'),
		'height'            => $nullable('integer'),
		'snmpQuery'         => $nullable('string'),
		'snmpIndex'         => $nullable('string'),
	]);

	$dataSource = mcp_object_schema([
		'name'              => ['type' => 'string'],
		'displayName'       => ['type' => 'string'],
		'device'            => $nullable('string'),
		'deviceDisplayName' => $nullable('string'),
		'dataTemplate'      => $nullable('string'),
		'templateName'      => $nullable('string'),
		'dataSourceProfile' => $nullable('string'),
		'active'            => ['type' => 'boolean'],
		'rrdStep'           => $nullable('integer'),
		'snmpQuery'         => $nullable('string'),
		'snmpIndex'         => $nullable('string'),
		'orphan'            => $nullable('boolean'),
	]);

	$registry->register('cacti-get-system-info', [
		'label'         => 'Get system information',
		'description'   => 'Read the Cacti, plugin, and abilities API versions.',
		'category'      => 'system',
		'input_schema'  => ['type' => 'object', 'properties' => new stdClass(), 'additionalProperties' => false],
		'output_schema' => mcp_object_schema([
			'cactiVersion'        => ['type' => 'string'],
			'pluginVersion'       => ['type' => 'string'],
			'abilitiesApiVersion' => ['type' => 'string'],
		]),
		'annotations' => $annotations,
		'permission'  => fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-get-system-info'], $user),
		'execute'     => function () {
			global $config;
			$info = plugin_mcp_version();

			return [
				'cactiVersion'        => (string) ($config['cacti_version'] ?? ''),
				'pluginVersion'       => (string) ($info['version'] ?? ''),
				'abilitiesApiVersion' => '2',
			];
		},
	]);

	mcp_register_list_ability(
		$registry,
		'cacti-list-devices',
		'List devices',
		'List permitted devices, up to 100 per page, with AIP-160 filter and AIP-132 orderBy. Credentials are excluded.',
		'inventory',
		'devices',
		$device,
		mcp_device_filter_fields(),
		MCP_DEVICE_FIELDS,
		'h1.id',
		'',
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-devices'], $user),
		function (int $user, string $where, string $order, array $page) : array {
			$total   = -1;
			$fetched = get_allowed_devices($where, $order, $page['offset'] . ',' . ($page['size'] + 1), $total, $user);

			return is_array($fetched) ? array_values($fetched) : [];
		},
		'mcp_device_resource'
	);

	$registry->register('cacti-get-device', [
		'label'        => 'Get device',
		'description'  => 'Read one permitted device by resource name, for example devices/12. Credentials are excluded.',
		'category'     => 'inventory',
		'input_schema' => mcp_object_schema([
			'name' => ['type' => 'string', 'pattern' => '^devices/[1-9][0-9]{0,9}$', 'maxLength' => 32],
		]),
		'output_schema' => mcp_object_schema(['device' => $device]),
		'annotations'   => $annotations,
		'permission'    => fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-get-device'], $user),
		'execute'       => function (int $user, stdClass $args) {
			mcp_capability_assert_no_control_escalation($args);

			$total = -1;
			$id    = (int) substr((string) $args->name, strlen('devices/'));
			$rows  = get_allowed_devices('', 'h1.id ASC', '1', $total, $user, $id);

			if (!$rows) {
				throw new AbilitiesError('NOT_FOUND', 'DEVICE_NOT_FOUND');
			}

			return mcp_capability_guard_after_execute('cacti-get-device', ['device' => mcp_device_resource(reset($rows))]);
		},
	]);

	mcp_register_list_ability(
		$registry,
		'cacti-list-sites',
		'List sites',
		'List Cacti sites, up to 100 per page, with AIP-160 filter and AIP-132 orderBy.',
		'inventory',
		'sites',
		$site,
		MCP_SITE_FIELDS,
		MCP_SITE_FIELDS,
		's.id',
		"sites\0",
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-sites'], $user),
		fn (int $user, string $where, string $order, array $page) : array => mcp_query_page(
			's.id, s.name, s.address1, s.address2, s.city, s.state, s.postal_code, s.country, '
				. 's.timezone, s.latitude, s.longitude, s.zoom, s.alternate_id, s.notes',
			'sites AS s',
			$where,
			$order,
			$page,
			'Site query failed'
		),
		'mcp_site_resource'
	);

	mcp_register_list_ability(
		$registry,
		'cacti-list-pollers',
		'List pollers',
		'List Cacti data collectors, up to 100 per page, with AIP-160 filter and AIP-132 orderBy. '
			. 'Database credentials and TLS keys are excluded.',
		'system',
		'pollers',
		$poller,
		MCP_POLLER_FIELDS,
		MCP_POLLER_FIELDS,
		'p.id',
		"pollers\0",
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-pollers'], $user),
		// Never select dbpass, dbuser, dbsslkey, dbsslcert, or dbsslca.
		fn (int $user, string $where, string $order, array $page) : array => mcp_query_page(
			'p.id, p.disabled, p.name, p.notes, p.status, p.timezone, p.hostname, '
				. 'p.total_time, p.max_time, p.min_time, p.avg_time, p.total_polls, p.processes, '
				. 'p.threads, p.sync_interval, p.snmp, p.script, p.server, p.last_update, '
				. 'p.last_status, p.last_sync, p.requires_sync',
			'poller AS p',
			$where,
			$order,
			$page,
			'Poller query failed'
		),
		'mcp_poller_resource'
	);

	mcp_register_list_ability(
		$registry,
		'cacti-list-trees',
		'List graph trees',
		'List permitted graph trees, up to 100 per page, with AIP-160 filter and AIP-132 orderBy.',
		'inventory',
		'trees',
		$tree,
		MCP_TREE_FIELDS,
		MCP_TREE_FIELDS,
		'gt.id',
		"trees\0",
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-trees'], $user)
			|| is_realm_allowed(4, $user),
		function (int $user, string $where, string $order, array $page) : array {
			$total = -1;
			$limit = $page['offset'] . ',' . ($page['size'] + 1);
			$rows  = get_allowed_trees(false, false, $where, $order, $limit, $total, $user);
			$rows  = is_array($rows) ? array_values($rows) : [];

			if (function_exists('is_tree_allowed')) {
				$rows = array_values(array_filter(
					$rows,
					fn (array $row) => is_tree_allowed((int) ($row['id'] ?? 0), $user)
				));
			}

			return $rows;
		},
		'mcp_tree_resource'
	);

	mcp_register_list_ability(
		$registry,
		'cacti-list-graphs',
		'List graphs',
		'List permitted graphs, up to 100 per page, with AIP-160 filter and AIP-132 orderBy.',
		'inventory',
		'graphs',
		$graph,
		MCP_GRAPH_FIELDS,
		MCP_GRAPH_FIELDS,
		'gtg.local_graph_id',
		"graphs\0",
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-graphs'], $user)
			|| is_realm_allowed(5, $user),
		function (int $user, string $where, string $order, array $page) : array {
			$total = -1;
			$limit = $page['offset'] . ',' . ($page['size'] + 1);
			$rows  = get_allowed_graphs($where, $order, $limit, $total, $user);
			$rows  = is_array($rows) ? array_values($rows) : [];

			if (function_exists('is_graph_allowed')) {
				$rows = array_values(array_filter(
					$rows,
					fn (array $row) => is_graph_allowed((int) ($row['local_graph_id'] ?? 0), $user)
				));
			}

			return $rows;
		},
		'mcp_graph_resource'
	);

	mcp_register_list_ability(
		$registry,
		'cacti-list-data-sources',
		'List data sources',
		'List data sources belonging to permitted devices, up to 100 per page, with AIP-160 filter '
			. 'and AIP-132 orderBy. Secret input values are excluded.',
		'inventory',
		'dataSources',
		$dataSource,
		MCP_DATA_SOURCE_FIELDS,
		MCP_DATA_SOURCE_FIELDS,
		'dl.id',
		"dataSources\0",
		fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-list-data-sources'], $user),
		function (int $user, string $where, string $order, array $page) : array {
			$deviceIds = mcp_allowed_device_ids($user);

			if ($deviceIds === []) {
				return [];
			}

			$placeholders = implode(', ', array_fill(0, count($deviceIds), '?'));
			$scopedWhere  = 'dl.host_id IN (' . $placeholders . ')'
				. ($where !== '' ? ' AND (' . $where . ')' : '');
			// Query safe metadata only; never join data_input_data or expose secret input values.
			$rows = mcp_query_page(
				'dl.id, dl.host_id, dl.data_template_id, dl.snmp_query_id, dl.snmp_index, dl.orphan, '
					. 'dtd.name_cache, dtd.active, dtd.rrd_step, dtd.data_source_profile_id, '
					. 'dt.name AS template_name, h.description AS host_description',
				'data_local AS dl '
					. 'INNER JOIN data_template_data AS dtd ON dtd.local_data_id = dl.id '
					. 'LEFT JOIN data_template AS dt ON dt.id = dl.data_template_id '
					. 'LEFT JOIN host AS h ON h.id = dl.host_id',
				$scopedWhere,
				$order,
				$page,
				'Data source query failed',
				$deviceIds
			);

			if (function_exists('is_device_allowed')) {
				$rows = array_values(array_filter(
					$rows,
					fn (array $row) => is_device_allowed((int) ($row['host_id'] ?? 0), $user)
				));
			}

			return $rows;
		},
		'mcp_data_source_resource'
	);

	$registry->register('cacti-get-clog', [
		'label'        => 'Read Cacti log tail',
		'description'  => 'Read a bounded, redacted tail of the Cacti log with optional severity and substring filters.',
		'category'     => 'system',
		'input_schema' => [
			'type'       => 'object',
			'properties' => [
				'lines'    => ['type' => 'integer', 'minimum' => 1, 'maximum' => MCP_CLOG_MAX_LINES],
				'severity' => ['type' => 'string', 'enum' => MCP_CLOG_SEVERITIES],
				'search'   => ['type' => 'string', 'maxLength' => 256],
			],
			'additionalProperties' => false,
		],
		'output_schema' => mcp_object_schema([
			'lines'     => ['type' => 'array', 'items' => ['type' => 'string'], 'maxItems' => MCP_CLOG_MAX_LINES],
			'count'     => ['type' => 'integer', 'minimum' => 0],
			'truncated' => ['type' => 'boolean'],
		]),
		'annotations' => $annotations,
		'permission'  => fn (int $user) => is_realm_allowed(MCP_BUILTIN_REALMS['cacti-get-clog'], $user)
			|| is_realm_allowed(18, $user),
		'execute' => function (int $user, stdClass $args) {
			mcp_capability_assert_no_control_escalation($args);

			$limit    = isset($args->lines) ? (int) $args->lines : MCP_CLOG_DEFAULT_LINES;
			$severity = isset($args->severity) ? (string) $args->severity : 'ALL';
			$search   = isset($args->search) ? (string) $args->search : '';

			return mcp_capability_guard_after_execute(
				'cacti-get-clog',
				mcp_read_clog_tail(mcp_clog_path(), $limit, $severity, $search),
				MCP_CLOG_MAX_LINE_LENGTH
			);
		},
	]);
}

/**
 * Let enabled plugins register abilities through the abilities_register hook.
 *
 * Each plugin registers into a scratch copy that is adopted only when the hook
 * function returns, so a failing plugin leaves nothing behind.
 *
 * @param AbilitiesRegistry $registry Target ability registry.
 * @return void
 */
function mcp_dispatch_ability_hooks(AbilitiesRegistry $registry) : void {
	global $plugins_integrated;

	$hooks = db_fetch_assoc_prepared(
		'SELECT name, file, function FROM plugin_hooks WHERE hook = ? AND status = 1 ORDER BY name, function',
		['abilities_register']
	);

	foreach ($hooks ?: [] as $hook) {
		$name = (string) $hook['name'];

		if (in_array($name, $plugins_integrated ?? [], true) || !api_plugin_is_enabled($name)) {
			continue;
		}

		// The cacti namespace belongs to the built-ins, which are exposed by default.
		if ($name === 'cacti') {
			cacti_log('MCP: ability registration skipped for plugin cacti: reserved namespace', false, 'MCP');

			continue;
		}

		if (str_contains($hook['file'], '..') || str_contains($name, '..')) {
			cacti_log('MCP: ability registration skipped for plugin ' . $name . ': invalid hook file', false, 'MCP');

			continue;
		}
		$scratch = clone $registry;

		try {
			$file = mcp_plugin_file($name, $hook['file']);

			if ($file !== false && is_file($file)) {
				include_once $file;
			}

			if (!function_exists($hook['function'])) {
				continue;
			}
			($hook['function'])(new AbilitiesRegistrar($scratch, $name));
			$registry->adopt($scratch);
		} catch (Throwable $error) {
			cacti_log(
				'MCP: ability registration failed for plugin ' . $name . ' (' . mcp_exception_class($error) . ')',
				false,
				'MCP'
			);
		}
	}
}

/**
 * Resolve a hook file inside the plugin directory, as api_plugin_hook_function() does.
 *
 * @param string $plugin Plugin directory slug.
 * @param string $file   Relative file path inside the plugin directory.
 * @return string|false Resolved filesystem path, or false when unavailable.
 */
function mcp_plugin_file(string $plugin, string $file) : string|false {
	global $config;

	// 1.2.31 provides cacti_plugin_path(); develop uses CACTI_PATH_PLUGINS directly.
	if (function_exists('cacti_plugin_path')) {
		return cacti_plugin_path($plugin, $file);
	}

	return defined('CACTI_PATH_PLUGINS') ? CACTI_PATH_PLUGINS . '/' . $plugin . '/' . $file
		: $config['base_path'] . '/plugins/' . $plugin . '/' . $file;
}

/**
 * Run a paginated read-only SELECT query with optional WHERE clause and bound parameters.
 *
 * @param string                        $select SQL SELECT projection list.
 * @param string                        $from   SQL FROM clause and joins.
 * @param string                        $where  SQL WHERE predicate or empty string.
 * @param string                        $order  SQL ORDER BY clause.
 * @param array{size: int, offset: int} $page   Pagination window.
 * @param string                        $error  Error message thrown on DB failure.
 * @param list<mixed>                   $params Bound SQL parameters.
 * @return list<array<string, mixed>>
 */
function mcp_query_page(
	string $select,
	string $from,
	string $where,
	string $order,
	array $page,
	string $error,
	array $params = []
) : array {
	$sql = 'SELECT ' . $select
		. ' FROM ' . $from
		. ($where !== '' ? ' WHERE ' . $where : '')
		. ' ORDER BY ' . $order
		. ' LIMIT ' . ($page['size'] + 1) . ' OFFSET ' . $page['offset'];
	$rows = db_fetch_assoc_prepared($sql, $params);

	if ($rows === false) {
		throw new RuntimeException($error);
	}

	return array_values($rows);
}

/**
 * Collect allowed device IDs for $user through Cacti's device permission helper.
 *
 * @param int $user Cacti user ID.
 * @return list<int> Permitted device IDs.
 */
function mcp_allowed_device_ids(int $user) : array {
	$ids       = [];
	$offset    = 0;
	$batchSize = 1000;

	while (true) {
		$total = -1;
		$rows  = get_allowed_devices('', 'h1.id ASC', $offset . ',' . $batchSize, $total, $user);

		if (!is_array($rows) || $rows === []) {
			break;
		}

		foreach ($rows as $row) {
			$id = (int) ($row['id'] ?? 0);

			if ($id > 0) {
				$ids[$id] = $id;
			}
		}

		if (count($rows) < $batchSize) {
			break;
		}
		$offset += $batchSize;
	}

	return array_values($ids);
}

/**
 * Device filter fields with columns for the WHERE subquery, where host is aliased h.
 *
 * @return array<string, array<string, mixed>>
 */
function mcp_device_filter_fields() : array {
	return array_map(
		fn ($spec) => ['column' => preg_replace('/^h1\./', 'h.', $spec['column'])] + $spec,
		MCP_DEVICE_FIELDS
	);
}

/**
 * A resource name such as sites/3, or null when the reference is unset or the column is missing.
 *
 * @param array<string, mixed> $row        Database row.
 * @param string               $column     Foreign key column name.
 * @param string               $collection Target AIP collection name.
 * @return ?string Formatted resource name or null.
 */
function mcp_reference(array $row, string $column, string $collection) : ?string {
	return (int) ($row[$column] ?? 0) > 0 ? $collection . '/' . (int) $row[$column] : null;
}

/**
 * Format a timestamp as RFC 3339 UTC time, or null when unset; ported from core rest_time().
 *
 * @param mixed $value Database timestamp string or integer.
 * @return ?string RFC 3339 UTC string or null.
 */
function mcp_time(mixed $value) : ?string {
	if (empty($value) || str_starts_with((string) $value, '0000-00-00')) {
		return null;
	}
	$time = is_int($value) || ctype_digit((string) $value) ? (int) $value : strtotime((string) $value);

	return $time === false ? null : gmdate('Y-m-d\TH:i:s\Z', $time);
}

/**
 * The core Device read fields, without credentials. A column missing on this Cacti version gives null.
 * Untrusted Cacti telemetry strings are sanitized through the capability guard.
 *
 * @param array<string, mixed> $row Host database row.
 * @return array<string, mixed> Sanitized Device resource payload.
 */
function mcp_device_resource(array $row) : array {
	$int = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;
	$str = fn (string $column, string $field) => isset($row[$column])
		? mcp_capability_sanitize_untrusted_string((string) $row[$column], $field)
		: null;

	return [
		'name'               => 'devices/' . (int) $row['id'],
		'displayName'        => mcp_capability_sanitize_untrusted_string((string) $row['description'], 'displayName'),
		'hostname'           => mcp_capability_sanitize_untrusted_string((string) $row['hostname'], 'hostname'),
		'deviceTemplate'     => mcp_reference($row, 'host_template_id', 'deviceTemplates'),
		'site'               => mcp_reference($row, 'site_id', 'sites'),
		'poller'             => mcp_reference($row, 'poller_id', 'pollers'),
		'externalId'         => $str('external_id', 'externalId'),
		'location'           => $str('location', 'location'),
		'notes'              => $str('notes', 'notes'),
		'disabled'           => ($row['disabled'] ?? '') === 'on',
		'snmpVersion'        => $int('snmp_version'),
		'snmpPort'           => $int('snmp_port'),
		'snmpTimeout'        => $int('snmp_timeout'),
		'snmpRetries'        => $int('snmp_retries'),
		'maxOids'            => $int('max_oids'),
		'bulkWalkSize'       => $int('bulk_walk_size'),
		'deviceThreads'      => $int('device_threads'),
		'availabilityMethod' => $int('availability_method'),
		'pingMethod'         => $int('ping_method'),
		'pingPort'           => $int('ping_port'),
		'pingTimeout'        => $int('ping_timeout'),
		'pingRetries'        => $int('ping_retries'),
		'state'              => isset($row['status'])
			? (MCP_DEVICE_STATES[(int) $row['status']] ?? MCP_DEVICE_STATES[0])
			: null,
		'availability'       => isset($row['availability']) ? (float) $row['availability'] : null,
		'lastError'          => $str('status_last_error', 'lastError'),
		'failTime'           => mcp_time($row['status_fail_date'] ?? null),
		'recoveryTime'       => mcp_time($row['status_rec_date'] ?? null),
		'createTime'         => mcp_time($row['created'] ?? null),
	];
}

/**
 * Project a Cacti site row into a sanitized Site resource.
 *
 * @param array<string, mixed> $row Site database row.
 * @return array<string, mixed> Sanitized Site resource payload.
 */
function mcp_site_resource(array $row) : array {
	$str   = fn (string $column, string $field) => isset($row[$column])
		? mcp_capability_sanitize_untrusted_string((string) $row[$column], $field)
		: null;
	$int   = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;
	$float = fn (string $column) => isset($row[$column]) ? (float) $row[$column] : null;

	return [
		'name'        => 'sites/' . (int) ($row['id'] ?? 0),
		'displayName' => mcp_capability_sanitize_untrusted_string((string) ($row['name'] ?? ''), 'displayName'),
		'address1'    => $str('address1', 'address1'),
		'address2'    => $str('address2', 'address2'),
		'city'        => $str('city', 'city'),
		'state'       => $str('state', 'state'),
		'postalCode'  => $str('postal_code', 'postalCode'),
		'country'     => $str('country', 'country'),
		'timezone'    => $str('timezone', 'timezone'),
		'latitude'    => $float('latitude'),
		'longitude'   => $float('longitude'),
		'zoom'        => $int('zoom'),
		'alternateId' => $str('alternate_id', 'alternateId'),
		'notes'       => $str('notes', 'notes'),
	];
}

/**
 * Safe poller fields only; database credentials and TLS keys are never projected.
 *
 * @param array<string, mixed> $row Poller database row.
 * @return array<string, mixed> Sanitized Poller resource payload.
 */
function mcp_poller_resource(array $row) : array {
	$str   = fn (string $column, string $field) => isset($row[$column])
		? mcp_capability_sanitize_untrusted_string((string) $row[$column], $field)
		: null;
	$int   = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;
	$float = fn (string $column) => isset($row[$column]) ? (float) $row[$column] : null;

	return [
		'name'           => 'pollers/' . (int) ($row['id'] ?? 0),
		'displayName'    => mcp_capability_sanitize_untrusted_string((string) ($row['name'] ?? ''), 'displayName'),
		'hostname'       => mcp_capability_sanitize_untrusted_string((string) ($row['hostname'] ?? ''), 'hostname'),
		'disabled'       => ($row['disabled'] ?? '') === 'on',
		'state'          => isset($row['status']) ? (MCP_POLLER_STATES[(int) $row['status']] ?? 'UNKNOWN') : null,
		'timezone'       => $str('timezone', 'timezone'),
		'notes'          => $str('notes', 'notes'),
		'processes'      => $int('processes'),
		'threads'        => $int('threads'),
		'totalPolls'     => $int('total_polls'),
		'syncInterval'   => $int('sync_interval'),
		'snmpItems'      => $int('snmp'),
		'scriptItems'    => $int('script'),
		'serverItems'    => $int('server'),
		'totalTime'      => $float('total_time'),
		'maxTime'        => $float('max_time'),
		'minTime'        => $float('min_time'),
		'avgTime'        => $float('avg_time'),
		'requiresSync'   => ($row['requires_sync'] ?? '') === 'on',
		'lastUpdateTime' => mcp_time($row['last_update'] ?? null),
		'lastStatusTime' => mcp_time($row['last_status'] ?? null),
		'lastSyncTime'   => mcp_time($row['last_sync'] ?? null),
	];
}

/**
 * Project a Cacti graph tree row into a sanitized Tree resource.
 *
 * @param array<string, mixed> $row Graph tree database row.
 * @return array<string, mixed> Sanitized Tree resource payload.
 */
function mcp_tree_resource(array $row) : array {
	$int = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;

	return [
		'name'             => 'trees/' . (int) ($row['id'] ?? 0),
		'displayName'      => mcp_capability_sanitize_untrusted_string((string) ($row['name'] ?? ''), 'displayName'),
		'enabled'          => isset($row['enabled']) ? $row['enabled'] === 'on' : true,
		'locked'           => isset($row['locked']) ? (int) $row['locked'] === 1 : null,
		'sortType'         => $int('sort_type'),
		'sequence'         => $int('sequence'),
		'lastModifiedTime' => mcp_time($row['last_modified'] ?? null),
	];
}

/**
 * Project a Cacti graph row into a sanitized Graph resource.
 *
 * @param array<string, mixed> $row Graph database row.
 * @return array<string, mixed> Sanitized Graph resource payload.
 */
function mcp_graph_resource(array $row) : array {
	$str = fn (string $column, string $field) => isset($row[$column])
		? mcp_capability_sanitize_untrusted_string((string) $row[$column], $field)
		: null;
	$int = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;

	return [
		'name'              => 'graphs/' . (int) ($row['local_graph_id'] ?? $row['id'] ?? 0),
		'title'             => mcp_capability_sanitize_untrusted_string((string) ($row['title_cache'] ?? ''), 'title'),
		'device'            => mcp_reference($row, 'host_id', 'devices'),
		'deviceDisplayName' => $str('description', 'deviceDisplayName'),
		'graphTemplate'     => mcp_reference($row, 'graph_template_id', 'graphTemplates'),
		'templateName'      => $str('template_name', 'templateName'),
		'width'             => $int('width'),
		'height'            => $int('height'),
		'snmpQuery'         => mcp_reference($row, 'snmp_query_id', 'dataQueries'),
		'snmpIndex'         => $str('snmp_index', 'snmpIndex'),
	];
}

/**
 * Safe data source metadata; secret data_input_data values are never queried or returned.
 *
 * @param array<string, mixed> $row Data source database row.
 * @return array<string, mixed> Sanitized DataSource resource payload.
 */
function mcp_data_source_resource(array $row) : array {
	$str = fn (string $column, string $field) => isset($row[$column])
		? mcp_capability_sanitize_untrusted_string((string) $row[$column], $field)
		: null;
	$int = fn (string $column) => isset($row[$column]) ? (int) $row[$column] : null;

	return [
		'name'              => 'dataSources/' . (int) ($row['id'] ?? 0),
		'displayName'       => mcp_capability_sanitize_untrusted_string((string) ($row['name_cache'] ?? ''), 'displayName'),
		'device'            => mcp_reference($row, 'host_id', 'devices'),
		'deviceDisplayName' => $str('host_description', 'deviceDisplayName'),
		'dataTemplate'      => mcp_reference($row, 'data_template_id', 'dataTemplates'),
		'templateName'      => $str('template_name', 'templateName'),
		'dataSourceProfile' => mcp_reference($row, 'data_source_profile_id', 'dataSourceProfiles'),
		'active'            => ($row['active'] ?? '') === 'on',
		'rrdStep'           => $int('rrd_step'),
		'snmpQuery'         => mcp_reference($row, 'snmp_query_id', 'dataQueries'),
		'snmpIndex'         => $str('snmp_index', 'snmpIndex'),
		'orphan'            => isset($row['orphan']) ? (int) $row['orphan'] === 1 : null,
	];
}

/**
 * Resolve the Cacti log file path without exposing it in API responses.
 *
 * @return string Filesystem path to cacti.log or empty string when unresolvable.
 */
function mcp_clog_path() : string {
	global $config;

	$path = (string) read_config_option('path_cactilog', true);

	if ($path !== '') {
		return $path;
	}

	if (defined('CACTI_PATH_LOG')) {
		return CACTI_PATH_LOG . '/cacti.log';
	}

	$base = (string) ($config['base_path'] ?? '');

	return $base !== '' ? $base . '/log/cacti.log' : '';
}

/**
 * Redact bearer tokens, personal access tokens, passwords, secrets, SNMP
 * communities, API keys, and URL userinfo from a log line, and sanitize
 * control, bidi, and prompt-injection markers. Fails closed.
 *
 * @param string $line Raw Cacti log line.
 * @return string Redacted and sanitized log line.
 */
function mcp_redact_log_line(string $line) : string {
	static $keyPresencePattern = null;
	static $quotedPattern      = null;
	static $spaceQuotedPattern = null;
	static $sepUnquotedPattern = null;
	static $spaceUnquotedPattern = null;

	if ($keyPresencePattern === null) {
		$keys = 'authorization|password|passwd|passphrase|pass|secret|token|community|'
			. 'api[_-]?key|auth[_-]?key|priv(?:ate)?[_-]?key|dbpass|dbsslkey';
		$keyPresencePattern   = '/(?:' . $keys . ')\b/i';
		$quotedPattern        = '/(\b\w*(?:' . $keys . ')\b["\']?\s*[=:]\s*)(["\'])'
			. '(?:\\\\[^\r\n]|(?!\2)[^\\\\\r\n])*+(?:\2|\\\\?(?=\r?$))/im';
		$spaceQuotedPattern   = '/(\b\w*(?:' . $keys . ')\b\s+)(["\'])'
			. '(?:\\\\[^\r\n]|(?!\2)[^\\\\\r\n])*+(?:\2|\\\\?(?=\r?$))/im';
		$sepUnquotedPattern   = '/(\b\w*(?:' . $keys . ')\b["\']?\s*[=:]\s*)(?!["\'])[^\s;,"\'\r\n]+/i';
		$spaceUnquotedPattern = '/(\b\w*(?:' . $keys . ')\b\s+)(?!["\'])[^\s;,"\'\r\n]+/i';
	}

	// Strip unsafe control and zero-width chars first so obfuscation cannot bypass secret redaction.
	$line     = mcp_capability_strip_unsafe_chars($line);
	$patterns = [];

	if (stripos($line, 'cmcp_pat_') !== false) {
		$patterns[] = ['/\bcmcp_pat_[a-f0-9]+\b/i', '[redacted]'];
	}

	if (stripos($line, 'bearer') !== false || stripos($line, 'basic') !== false) {
		$patterns[] = ['/(\b(?:Bearer|Basic)[ \t]+)(?:\\\\[^\r\n]|[^\s;,"\'\\\\\r\n])+/i', '$1[redacted]'];
	}

	$hasKey = preg_match($keyPresencePattern, $line);

	if ($hasKey === false) {
		return '[redacted]';
	}

	if ($hasKey === 1) {
		$hasSep   = str_contains($line, '=') || str_contains($line, ':');
		$hasQuote = str_contains($line, '"') || str_contains($line, "'");

		if ($hasSep && $hasQuote) {
			$patterns[] = [$quotedPattern, '$1$2[redacted]$2'];
		}

		if ($hasQuote) {
			$patterns[] = [$spaceQuotedPattern, '$1$2[redacted]$2'];
		}

		if ($hasSep) {
			$patterns[] = [$sepUnquotedPattern, '$1[redacted]'];
		}
		$patterns[] = [$spaceUnquotedPattern, '$1[redacted]'];
	}

	if (str_contains($line, '://')) {
		$patterns[] = ['/(\b[a-z][a-z0-9+.\-]*:\/\/[^:\/@?#\s]+:)[^\/\s?#]+(@)/i', '$1[redacted]$2'];
	}

	foreach ($patterns as [$pattern, $replacement]) {
		$replaced = preg_replace($pattern, $replacement, $line);

		if ($replaced === null) {
			return '[redacted]';
		}
		$line = $replaced;
	}

	$line = mcp_capability_neutralize_prompt_markers($line);

	if (strlen($line) > MCP_CLOG_MAX_LINE_LENGTH) {
		$line = substr($line, 0, MCP_CLOG_MAX_LINE_LENGTH) . '...';
	}

	return $line;
}

/**
 * Read a bounded tail of the Cacti log, filter by severity/search, and redact secrets.
 *
 * Scans backwards from the newest line so requests return once $limit matching
 * lines (plus one lookahead match for accurate truncation reporting) are found,
 * while always redacting each inspected line before applying search filters so
 * search cannot act as a secret oracle.
 *
 * @param string $path     Filesystem path to the Cacti log file.
 * @param int    $limit    Maximum number of matching lines to return.
 * @param string $severity Severity filter token or 'ALL'.
 * @param string $search   Case-insensitive plain substring filter.
 * @param int    $maxBytes Maximum trailing byte window read from disk.
 * @return array{lines: list<string>, count: int, truncated: bool}
 */
function mcp_read_clog_tail(
	string $path,
	int $limit,
	string $severity = 'ALL',
	string $search = '',
	int $maxBytes = MCP_CLOG_MAX_BYTES
) : array {
	if ($path === '' || str_contains($path, '://') || !is_file($path) || !is_readable($path)) {
		throw new AbilitiesError('FAILED_PRECONDITION', 'LOG_UNAVAILABLE');
	}

	$size   = @filesize($path);
	$handle = $size !== false ? @fopen($path, 'rb') : false;

	if ($handle === false) {
		throw new AbilitiesError('FAILED_PRECONDITION', 'LOG_UNAVAILABLE');
	}

	$byteTruncated = $size > $maxBytes;
	$dropFirstLine = false;

	if ($byteTruncated) {
		fseek($handle, -($maxBytes + 1), SEEK_END);
		$preceding     = fread($handle, 1);
		$dropFirstLine = $preceding !== "\n";
	}
	$contents = stream_get_contents($handle);
	fclose($handle);

	if (!is_string($contents)) {
		throw new AbilitiesError('FAILED_PRECONDITION', 'LOG_UNAVAILABLE');
	}

	$trimmed  = trim($contents);
	$rawLines = $trimmed === '' ? [] : explode("\n", $trimmed);
	$startIdx = ($dropFirstLine && $rawLines !== []) ? 1 : 0;

	$severityPattern = $severity !== 'ALL' ? '/\b' . preg_quote($severity, '/') . '\b/i' : null;
	$matchedReverse  = [];
	$matchedCount    = 0;
	$moreMatches     = false;

	for ($i = count($rawLines) - 1; $i >= $startIdx; $i--) {
		$line = rtrim($rawLines[$i], "\r");

		if ($line === '') {
			continue;
		}

		// Redact before applying caller search filters so search cannot act as a secret oracle.
		$redacted = mcp_redact_log_line($line);

		if ($severityPattern !== null
			&& (stripos($redacted, $severity) === false || preg_match($severityPattern, $redacted) !== 1)) {
			continue;
		}

		if ($search !== '' && stripos($redacted, $search) === false) {
			continue;
		}

		if ($matchedCount >= $limit) {
			$moreMatches = true;

			break;
		}

		$matchedReverse[] = $redacted;
		$matchedCount++;
	}

	$tail = array_reverse($matchedReverse);

	return [
		'lines'     => $tail,
		'count'     => $matchedCount,
		'truncated' => $byteTruncated || $moreMatches,
	];
}
