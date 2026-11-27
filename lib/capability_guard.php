<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Capability-boundary and untrusted-data provenance enforcement.
 *
 * Implements CaMeL-style data/control separation (Debenedetti et al., arXiv 2025 /
 * IEEE SaTML 2026) and Saltzer & Schroeder (Proc. IEEE 1975) least-privilege and
 * complete-mediation checks for Cacti MCP abilities. Untrusted Cacti telemetry
 * strings (SNMP sysDescr, device descriptions, graph titles, hostnames, notes,
 * and Cacti log lines) are sanitized and tagged with explicit provenance so
 * downstream consumers distinguish control metadata from untrusted telemetry. */

require_once __DIR__ . '/registry.php';

/** Provenance label applied to all Cacti-sourced telemetry values. */
const MCP_CAPABILITY_PROVENANCE_UNTRUSTED = 'untrusted_cacti_data';

/** Default maximum character length for sanitized untrusted telemetry strings. */
const MCP_CAPABILITY_MAX_STRING_LENGTH = 4096;

/** State-mutation verbs forbidden in read-only ability identifiers. */
const MCP_CAPABILITY_MUTATION_VERBS = [
	'create', 'delete', 'destroy', 'drop', 'edit', 'exec', 'execute', 'grant',
	'insert', 'modify', 'mutate', 'patch', 'post', 'purge', 'put', 'remove',
	'reset', 'revoke', 'save', 'set', 'truncate', 'update', 'upsert', 'write',
];

/** Control-plane and capability-escalation keys forbidden in untrusted payloads. */
const MCP_CAPABILITY_ESCALATION_KEYS = [
	'capabilitytoken', 'capability_token', '_capability', '_control',
	'bypassrealm', 'bypass_realm', 'grantscopes', 'grant_scopes',
	'escalate', 'escalateprivilege', 'escalate_privilege',
	'overridescope', 'override_scope', 'controlplane', 'control_plane',
	'forcewrite', 'force_write', 'mutate', 'write',
];

/** Field names carrying untrusted Cacti-sourced telemetry strings. */
const MCP_CAPABILITY_UNTRUSTED_FIELDS = [
	'sysDescr', 'sys_descr', 'description', 'displayName', 'hostname',
	'location', 'notes', 'lastError', 'status_last_error', 'title',
	'title_cache', 'deviceDisplayName', 'templateName', 'externalId',
	'alternateId', 'address1', 'address2', 'city', 'state', 'postalCode',
	'country', 'timezone', 'snmpIndex', 'lines', 'line', 'clog',
];

/**
 * Strip ANSI escape sequences, bidirectional Unicode overrides, zero-width
 * formatting characters, and unsafe C0/C1 control characters from a string.
 *
 * @param string $value Raw untrusted string value.
 * @return string Cleaned UTF-8 string without unsafe control or bidi sequences.
 */
function mcp_capability_strip_unsafe_chars(string $value) : string {
	if (preg_match('//u', $value) !== 1) {
		if (function_exists('mb_scrub')) {
			$value = mb_scrub($value, 'UTF-8');
		} else {
			$ascii = preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $value);
			$value = is_string($ascii) ? $ascii : '';
		}
	}

	// Remove ANSI CSI and OSC escape sequences before stripping bare ESC bytes.
	$ansiPatterns = [
		'/\x1B\[[0-9;?]*[ -\/]*[@-~]/',
		'/\x1B\][^\x07\x1B]*(?:\x07|\x1B\\\\)/',
	];

	foreach ($ansiPatterns as $pattern) {
		$cleaned = preg_replace($pattern, '', $value);
		$value   = is_string($cleaned) ? $cleaned : '';
	}

	// Strip Unicode bidi overrides/isolates, zero-width chars, BOM, and C0/C1 controls (keeping TAB, LF, CR).
	$unsafePattern = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F\x{0080}-\x{009F}\x{061C}\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2066}-\x{2069}\x{FEFF}]/u';
	$cleaned       = preg_replace($unsafePattern, '', $value);

	return is_string($cleaned) ? $cleaned : '';
}

/**
 * Neutralize prompt-injection boundary markers and control-plane delimiters
 * embedded inside untrusted telemetry strings.
 *
 * @param string $value Untrusted string value after control-character stripping.
 * @return string String with adversarial prompt boundary markers neutralized.
 */
function mcp_capability_neutralize_prompt_markers(string $value) : string {
	$patterns = [
		'/<\|[^|]{1,64}\|>/u'                                                          => '[filtered-boundary]',
		'/\[\/?INST\]/i'                                                               => '[filtered-boundary]',
		'/<<\/?SYS>>/i'                                                                => '[filtered-boundary]',
		'/<\/?(?:system|instructions|prompt|tool_call|function_call|developer|assistant)>/i' => '[filtered-boundary]',
		'/(?:^|\n)[ \t]*#{2,6}[ \t]*(?:system|instructions?|developer|assistant|override)[ \t]*:?/i' => "\n[filtered-boundary]",
		'/\b(?:BEGIN|END)[ \t]+(?:SYSTEM|OVERRIDE|HIDDEN)[ \t]+(?:PROMPT|INSTRUCTIONS?)\b/i' => '[filtered-boundary]',
		'/\bIGNORE[ \t]+(?:ALL[ \t]+)?(?:PREVIOUS|PRIOR|ABOVE)[ \t]+INSTRUCTIONS?\b/i' => '[filtered-boundary]',
	];

	$startedWithNewline = str_starts_with($value, "\n");

	foreach ($patterns as $pattern => $replacement) {
		$replaced = preg_replace($pattern, $replacement, $value);

		if (!is_string($replaced)) {
			return '[filtered-boundary]';
		}
		$value = $replaced;
	}

	if (!$startedWithNewline && str_starts_with($value, "\n[filtered-boundary]")) {
		$value = substr($value, 1);
	}

	return $value;
}

/**
 * Compute the UTF-8 character length of a string without requiring mbstring.
 *
 * @param string $value UTF-8 string to measure.
 * @return int Number of Unicode code points in $value.
 */
function mcp_capability_utf8_length(string $value) : int {
	if (function_exists('mb_strlen')) {
		return mb_strlen($value, 'UTF-8');
	}
	$count = preg_match_all('/./us', $value);

	return is_int($count) ? $count : strlen($value);
}

/**
 * Slice a UTF-8 string by character count without requiring mbstring.
 *
 * @param string $value  UTF-8 string to slice.
 * @param int    $length Maximum number of characters to retain.
 * @return string Prefix containing at most $length characters.
 */
function mcp_capability_utf8_slice(string $value, int $length) : string {
	if ($length <= 0) {
		return '';
	}

	if (function_exists('mb_substr')) {
		return mb_substr($value, 0, $length, 'UTF-8');
	}
	$chars = preg_split('//u', $value, $length + 1, PREG_SPLIT_NO_EMPTY);

	if (!is_array($chars)) {
		return substr($value, 0, $length);
	}

	return implode('', array_slice($chars, 0, $length));
}

/**
 * Sanitize an untrusted Cacti-sourced string by stripping control/bidi
 * characters, neutralizing prompt-injection boundary markers, and enforcing a
 * character length cap.
 *
 * @param string $value       Raw Cacti telemetry value (for example sysDescr, description, title, or log line).
 * @param string $sourceField Logical source field name for provenance tracking.
 * @param int    $maxLength   Maximum allowed character length after sanitization.
 * @return string Sanitized string bounded to $maxLength characters.
 */
function mcp_capability_sanitize_untrusted_string(
	string $value,
	string $sourceField = 'unknown',
	int $maxLength = MCP_CAPABILITY_MAX_STRING_LENGTH
) : string {
	if ($maxLength < 1) {
		throw new InvalidArgumentException('Maximum length must be at least 1');
	}

	$cleaned = mcp_capability_neutralize_prompt_markers(mcp_capability_strip_unsafe_chars($value));

	if (mcp_capability_utf8_length($cleaned) > $maxLength) {
		if ($maxLength <= 3) {
			return mcp_capability_utf8_slice($cleaned, $maxLength);
		}

		return mcp_capability_utf8_slice($cleaned, $maxLength - 3) . '...';
	}

	return $cleaned;
}

/**
 * Sanitize an untrusted Cacti-sourced value and wrap it with explicit
 * untrusted-data provenance metadata (CaMeL data/control boundary).
 *
 * @param string $value       Raw untrusted Cacti string.
 * @param string $sourceField Source field identifier (for example sysDescr, displayName, title, clog).
 * @param int    $maxLength   Maximum allowed character length.
 * @return array{provenance: string, sourceField: string, sanitized: bool, truncated: bool, value: string}
 */
function mcp_capability_tag_untrusted_value(
	string $value,
	string $sourceField,
	int $maxLength = MCP_CAPABILITY_MAX_STRING_LENGTH
) : array {
	if ($maxLength < 1) {
		throw new InvalidArgumentException('Maximum length must be at least 1');
	}

	$cleaned   = mcp_capability_neutralize_prompt_markers(mcp_capability_strip_unsafe_chars($value));
	$truncated = mcp_capability_utf8_length($cleaned) > $maxLength;
	$sanitized = mcp_capability_sanitize_untrusted_string($value, $sourceField, $maxLength);

	return [
		'provenance'  => MCP_CAPABILITY_PROVENANCE_UNTRUSTED,
		'sourceField' => $sourceField,
		'sanitized'   => true,
		'truncated'   => $truncated,
		'value'       => $sanitized,
	];
}

/**
 * Collect untrusted field paths present in an ability result payload.
 *
 * @param array<int|string, mixed> $payload Ability result array.
 * @param string                   $prefix  Dot-separated parent field path.
 * @param list<string>             $fields  Accumulator of discovered untrusted field paths.
 * @return void
 */
function mcp_capability_collect_untrusted_fields(array $payload, string $prefix, array &$fields) : void {
	foreach ($payload as $key => $value) {
		$segment = is_int($key) ? '[]' : (string) $key;
		$path    = $prefix === '' ? $segment : $prefix . '.' . $segment;

		if (is_string($key) && in_array($key, MCP_CAPABILITY_UNTRUSTED_FIELDS, true)) {
			$fields[] = $path;
		}

		if (is_array($value)) {
			mcp_capability_collect_untrusted_fields($value, $path, $fields);
		}
	}
}

/**
 * Produce an explicit provenance manifest describing which fields in an
 * ability response carry untrusted Cacti telemetry data.
 *
 * @param string               $abilityId Registered ability identifier.
 * @param array<string, mixed> $payload   Ability result payload.
 * @return array{provenance: string, ability: string, untrustedFields: list<string>, controlPlaneProtected: bool}
 */
function mcp_capability_provenance_manifest(string $abilityId, array $payload) : array {
	$fields = [];
	mcp_capability_collect_untrusted_fields($payload, '', $fields);

	return [
		'provenance'            => MCP_CAPABILITY_PROVENANCE_UNTRUSTED,
		'ability'               => $abilityId,
		'untrustedFields'       => array_values(array_unique($fields)),
		'controlPlaneProtected' => true,
	];
}

/**
 * Determine whether an ability identifier contains a state-mutation verb.
 *
 * @param string $abilityId Ability identifier to inspect.
 * @return bool True when any dash- or underscore-separated segment is a mutation verb.
 */
function mcp_capability_has_mutation_verb(string $abilityId) : bool {
	$segments = preg_split('/[-_]+/', strtolower($abilityId));

	if (!is_array($segments)) {
		return false;
	}

	foreach ($segments as $segment) {
		if ($segment !== '' && in_array($segment, MCP_CAPABILITY_MUTATION_VERBS, true)) {
			return true;
		}
	}

	return false;
}

/**
 * Validate that an ability's annotations and identifier satisfy the strict
 * read-only, non-destructive, idempotent capability boundary.
 *
 * @param array<string, mixed> $annotations Ability annotation map.
 * @param string               $abilityId   Optional ability identifier checked for forbidden mutation verbs.
 * @return void
 * @throws AbilitiesError When annotations or ability identifier violate the read-only boundary.
 */
function mcp_capability_validate_annotations(array $annotations, string $abilityId = '') : void {
	$hasReadOnly  = array_key_exists('readOnly', $annotations);
	$hasSnakeRead = array_key_exists('read_only', $annotations);

	if ($hasReadOnly && $hasSnakeRead) {
		throw new AbilitiesError('PERMISSION_DENIED', 'CAPABILITY_DENIED', 'Conflicting read-only annotations.');
	}

	$readFlag = $hasReadOnly ? $annotations['readOnly'] : ($hasSnakeRead ? $annotations['read_only'] : null);
	$allowed  = $hasSnakeRead
		? ['read_only', 'destructive', 'idempotent']
		: ['readOnly', 'destructive', 'idempotent'];

	if ($readFlag !== true
		|| ($annotations['destructive'] ?? null) !== false
		|| ($annotations['idempotent'] ?? null) !== true
		|| array_diff(array_keys($annotations), $allowed) !== []) {
		throw new AbilitiesError('PERMISSION_DENIED', 'CAPABILITY_DENIED', 'Ability violates read-only capability boundary.');
	}

	if ($abilityId !== '' && mcp_capability_has_mutation_verb($abilityId)) {
		throw new AbilitiesError(
			'PERMISSION_DENIED',
			'CAPABILITY_DENIED',
			'Read-only ability identifier must not declare a state-mutation verb.'
		);
	}
}

/**
 * Enforce least-privilege principal and explicit realm authorization checks
 * (Saltzer & Schroeder complete mediation).
 *
 * @param array<string, mixed>         $principal     Authenticated request principal.
 * @param ?int                         $requiredRealm Optional Cacti realm ID required for this capability.
 * @param ?callable(int, int): bool    $realmChecker  Optional custom realm authorization callback.
 * @return void
 * @throws AbilitiesError When the principal lacks least-privilege scope or required realm authorization.
 */
function mcp_capability_validate_principal(
	array $principal,
	?int $requiredRealm = null,
	?callable $realmChecker = null
) : void {
	$userId = $principal['user_id'] ?? null;
	$scopes = $principal['scopes'] ?? null;

	if (!is_int($userId) || $userId < 1 || !is_array($scopes) || $scopes === []) {
		throw new AbilitiesError('PERMISSION_DENIED', 'CAPABILITY_DENIED', 'Invalid or empty capability principal.');
	}

	foreach ($scopes as $scope) {
		if (!is_string($scope) || $scope !== 'abilities:read') {
			throw new AbilitiesError('PERMISSION_DENIED', 'CAPABILITY_DENIED', 'Principal carries disallowed or escalated scope.');
		}
	}

	if ($requiredRealm !== null) {
		if ($requiredRealm < 1) {
			throw new AbilitiesError('PERMISSION_DENIED', 'REALM_REQUIRED');
		}

		$authorized = $realmChecker !== null
			? $realmChecker($requiredRealm, $userId)
			: (function_exists('is_realm_allowed') && is_realm_allowed($requiredRealm, $userId));

		if ($authorized !== true) {
			throw new AbilitiesError('PERMISSION_DENIED', 'REALM_REQUIRED');
		}
	}
}

/**
 * Assert that an untrusted argument or telemetry payload carries no forbidden
 * control-plane or capability-escalation keys.
 *
 * @param mixed $value Payload value (array, stdClass, or scalar) to inspect.
 * @param int   $depth Current recursion depth (capped at 32).
 * @return void
 * @throws AbilitiesError When a control-plane escalation key or excessive nesting is detected.
 */
function mcp_capability_assert_no_control_escalation(mixed $value, int $depth = 0) : void {
	if ($depth > 32) {
		throw new AbilitiesError('PERMISSION_DENIED', 'CONTROL_PLANE_VIOLATION', 'Payload nesting exceeds capability guard limit.');
	}

	if ($value instanceof stdClass) {
		$value = get_object_vars($value);
	}

	if (!is_array($value)) {
		return;
	}

	foreach ($value as $key => $item) {
		if (is_string($key) && in_array(strtolower($key), MCP_CAPABILITY_ESCALATION_KEYS, true)) {
			throw new AbilitiesError(
				'PERMISSION_DENIED',
				'CONTROL_PLANE_VIOLATION',
				'Untrusted payload cannot carry control-plane capability fields.'
			);
		}
		mcp_capability_assert_no_control_escalation($item, $depth + 1);
	}
}

/**
 * Recursively sanitize untrusted Cacti strings in a structured result payload
 * while preserving the declared JSON schema shape, keys, and scalar types.
 *
 * @param array<int|string, mixed> $payload   Ability result payload.
 * @param int                      $maxLength Maximum character length for sanitized untrusted strings.
 * @param string                   $parentKey Parent field name for nested list/map context.
 * @return array<int|string, mixed> Sanitized result payload.
 */
function mcp_capability_sanitize_payload(
	array $payload,
	int $maxLength = MCP_CAPABILITY_MAX_STRING_LENGTH,
	string $parentKey = ''
) : array {
	$sanitized = [];

	foreach ($payload as $key => $value) {
		$fieldName = is_string($key) ? $key : $parentKey;

		if (is_string($value)) {
			if (in_array($fieldName, MCP_CAPABILITY_UNTRUSTED_FIELDS, true)) {
				$sanitized[$key] = mcp_capability_sanitize_untrusted_string($value, $fieldName, $maxLength);
			} else {
				$sanitized[$key] = mcp_capability_neutralize_prompt_markers(mcp_capability_strip_unsafe_chars($value));
			}
		} elseif (is_array($value)) {
			$sanitized[$key] = mcp_capability_sanitize_payload($value, $maxLength, $fieldName);
		} else {
			$sanitized[$key] = $value;
		}
	}

	return $sanitized;
}

/**
 * Pre-execution capability guard gate enforcing read-only annotations,
 * least-privilege principal scopes, optional realm checks, and control-plane
 * isolation on incoming arguments.
 *
 * @param array<string, mixed>      $principal     Authenticated principal.
 * @param string                    $abilityId     Ability identifier about to execute.
 * @param array<string, mixed>      $annotations   Declared ability annotations.
 * @param stdClass                  $args          Caller arguments object.
 * @param ?int                      $requiredRealm Optional Cacti realm ID required for this ability.
 * @param ?callable(int, int): bool $realmChecker  Optional realm checker callback.
 * @return void
 * @throws AbilitiesError When any capability or control-plane invariant fails.
 */
function mcp_capability_guard_before_execute(
	array $principal,
	string $abilityId,
	array $annotations,
	stdClass $args,
	?int $requiredRealm = null,
	?callable $realmChecker = null
) : void {
	mcp_capability_validate_annotations($annotations, $abilityId);
	mcp_capability_validate_principal($principal, $requiredRealm, $realmChecker);
	mcp_capability_assert_no_control_escalation($args);
}

/**
 * Post-execution capability guard gate enforcing that untrusted telemetry
 * responses cannot carry control-plane escalation keys and that all untrusted
 * Cacti strings are sanitized and length-bounded.
 *
 * @param string               $abilityId Executed ability identifier.
 * @param array<string, mixed> $result    Raw ability execution result.
 * @param int                  $maxLength Maximum character length for untrusted telemetry strings.
 * @return array<string, mixed> Sanitized result payload preserving schema structure.
 * @throws AbilitiesError When the payload attempts control-plane escalation.
 */
function mcp_capability_guard_after_execute(
	string $abilityId,
	array $result,
	int $maxLength = MCP_CAPABILITY_MAX_STRING_LENGTH
) : array {
	mcp_capability_assert_no_control_escalation($result);

	/** @var array<string, mixed> $cleaned */
	$cleaned = mcp_capability_sanitize_payload($result, $maxLength);

	return $cleaned;
}
