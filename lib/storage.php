<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

require_once __DIR__ . '/registry.php';

/** Files the MCP and Abilities API realm covers; one realm row holds the whole list. */
const MCP_REALM_FILES = 'api.php,mcp.php,mcp_tokens.php';

/**
 * Create or upgrade the MCP plugin database tables idempotently.
 *
 * @return void
 */
function mcp_install_schema() : void {
	// Cacti's table registration also schedules tables for removal on uninstall.
	// These tables intentionally survive uninstall for token and audit retention.
	$queries = [
		'CREATE TABLE IF NOT EXISTS plugin_mcp_token (
			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_id INT UNSIGNED NOT NULL,
			token_hash CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL UNIQUE,
			scopes TEXT NOT NULL,
			expires_at BIGINT UNSIGNED NOT NULL,
			revoked TINYINT UNSIGNED NOT NULL DEFAULT 0,
			created_at BIGINT UNSIGNED NOT NULL DEFAULT 0,
			created_by INT UNSIGNED NOT NULL,
			last_used_at BIGINT UNSIGNED NULL
		) ENGINE=InnoDB',
		'CREATE TABLE IF NOT EXISTS plugin_mcp_audit (
			request_id CHAR(32) CHARACTER SET ascii NOT NULL PRIMARY KEY,
			token_id BIGINT UNSIGNED NOT NULL,
			user_id INT UNSIGNED NOT NULL,
			ability VARCHAR(64) NOT NULL,
			outcome VARCHAR(16) NOT NULL,
			started_at BIGINT UNSIGNED NOT NULL,
			finished_at BIGINT UNSIGNED NULL
		) ENGINE=InnoDB',
		'CREATE TABLE IF NOT EXISTS plugin_mcp_ability (
			id VARCHAR(64) CHARACTER SET ascii NOT NULL PRIMARY KEY,
			exposed TINYINT UNSIGNED NOT NULL,
			updated_at BIGINT UNSIGNED NOT NULL
		) ENGINE=InnoDB'
	];

	foreach ($queries as $query) {
		if (!db_execute($query)) {
			throw new RuntimeException('MCP schema creation failed');
		}
	}

	// The token table survives uninstall, and earlier development builds created it without these
	// columns. CREATE TABLE IF NOT EXISTS leaves such a table as it is, so add what is missing.
	$tokenColumns = [
		['name' => 'created_at', 'type' => 'BIGINT UNSIGNED', 'NULL' => false, 'default' => '0', 'after' => 'revoked'],
		['name' => 'created_by', 'type' => 'INT UNSIGNED', 'NULL' => false, 'default' => '0', 'after' => 'created_at'],
		['name' => 'last_used_at', 'type' => 'BIGINT UNSIGNED', 'NULL' => true, 'after' => 'created_by']
	];

	foreach ($tokenColumns as $column) {
		if (!db_column_exists('plugin_mcp_token', $column['name']) && !db_add_column('plugin_mcp_token', $column)) {
			throw new RuntimeException('MCP schema upgrade failed');
		}
	}
}

/**
 * Determine whether $userId holds the MCP and Abilities API realm while core auth is active.
 *
 * @param int $userId Cacti user ID.
 * @return bool True when the user holds the plugin API realm.
 */
function mcp_has_realm(int $userId) : bool {
	// Cacti's realm helper allows everything when core authentication is off.
	if ((int) read_config_option('auth_method', true) === 0) {
		return false;
	}
	// Refresh the mode used by Cacti's device helper, not a prior session copy.
	read_config_option('graph_auth_method', true);
	$id = db_fetch_cell_prepared('SELECT id FROM plugin_realms WHERE plugin = ? AND file = ?', ['mcp', MCP_REALM_FILES]);

	return $id !== false && (int) $id > 0 && is_realm_allowed((int) $id + 100, $userId);
}

/**
 * Validate personal access token syntax and return its SHA-256 hex digest.
 *
 * @param string $token Raw bearer token string.
 * @return ?string Lowercase 64-char SHA-256 hash, or null when malformed.
 */
function mcp_token_hash(string $token) : ?string {
	return preg_match('/^cmcp_pat_[a-f0-9]{64}$/D', $token) === 1 ? hash('sha256', $token) : null;
}

/**
 * The guest account's user ID, or 0 when none is configured. The setting holds a username or an ID
 * (get_guest_account() matches both, and no 1.2.x upgrade step converts old values), so it is resolved
 * the same way. get_guest_account() reads the cached option, so $fresh is for session-bearing console
 * paths, where a stale cache would still treat an account made the guest after sign-in as ordinary.
 * When a guest is configured but cannot be looked up, it throws RuntimeException so callers fail closed.
 *
 * @param bool $fresh Force a fresh config read bypassing session cache.
 * @return int Guest account user ID or 0 when unconfigured.
 */
function mcp_guest_user_id(bool $fresh = false) : int {
	$setting = read_config_option('guest_user', $fresh);

	if ($setting === '' || $setting === null || $setting === false || $setting === 0 || $setting === '0') {
		return 0;
	}
	// The assoc fetch returns [] for no match and false only when the query fails; a cell fetch cannot tell them apart.
	$rows = db_fetch_assoc_prepared('SELECT id FROM user_auth WHERE username = ? OR id = ? LIMIT 1', [$setting, $setting]);

	if ($rows === false) {
		throw new RuntimeException('MCP guest account lookup failed');
	}

	return $rows === [] ? 0 : (int) $rows[0]['id'];
}

/**
 * Authenticate an HTTP Authorization Bearer header against stored personal tokens.
 *
 * @param string $header Raw Authorization header value.
 * @return array<string, mixed> Authenticated principal array.
 */
function mcp_authenticate(string $header) : array {
	if (!preg_match('/^Bearer (cmcp_pat_[a-f0-9]{64})$/D', $header, $matches)) {
		throw new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN');
	}
	$hash = mcp_token_hash($matches[1]);
	$row  = db_fetch_row_prepared('SELECT t.id, t.user_id, t.token_hash, t.scopes
		FROM plugin_mcp_token AS t
		JOIN user_auth AS u ON u.id = t.user_id
		WHERE t.token_hash = ? AND t.revoked = 0 AND t.expires_at > ? AND u.enabled = ?',
		[$hash, time(), 'on']);

	if (!$row || !hash_equals($row['token_hash'], $hash)) {
		throw new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN');
	}
	$userId = (int) $row['user_id'];

	// A guest account never holds a personal token; one minted before the account became the guest stops working.
	try {
		$guestId = mcp_guest_user_id();
	} catch (RuntimeException $error) {
		// Without the guest ID the check cannot pass; refuse rather than let a guest token through.
		mcp_log_failure('', 'GUEST_LOOKUP_FAILED', $error);

		throw new AbilitiesError('UNAVAILABLE', 'INTERNAL_ERROR');
	}

	if ($guestId > 0 && $userId === $guestId) {
		throw new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN');
	}

	if (!mcp_has_realm($userId)) {
		throw new AbilitiesError('PERMISSION_DENIED', 'REALM_REQUIRED');
	}

	// Personal tokens carry exactly one scope; anything else is a corrupt or foreign row.
	if (json_decode($row['scopes'], true, 16) !== ['abilities:read']) {
		throw new AbilitiesError('UNAUTHENTICATED', 'INVALID_TOKEN');
	}

	mcp_touch_token((int) $row['id']);

	return mcp_user_principal($userId, (int) $row['id']);
}

/**
 * The principal a personal token of this user carries. The self-service page passes token 0 to preview it.
 *
 * @param int $userId  Cacti user ID.
 * @param int $tokenId Token row ID, or 0 for preview.
 * @return array{token_id: int, token_kind: string, user_id: int, scopes: list<string>}
 */
function mcp_user_principal(int $userId, int $tokenId) : array {
	return ['token_id' => $tokenId, 'token_kind' => 'pat', 'user_id' => $userId, 'scopes' => ['abilities:read']];
}

/**
 * Record use of a token at most once a minute. Bookkeeping only: a failure never fails authentication.
 *
 * @param int $id Token row ID.
 * @return void
 */
function mcp_touch_token(int $id) : void {
	$now = time();

	try {
		db_execute_prepared('UPDATE plugin_mcp_token SET last_used_at = ? WHERE id = ? AND (last_used_at IS NULL OR last_used_at < ?)',
			[$now, $id, $now - 60]);
	} catch (Throwable $error) {
		// The token was already verified; a missing timestamp is not a reason to refuse it.
	}
}

/**
 * Record an ability audit lifecycle row (started, succeeded, failed, denied, or rejected).
 *
 * @param array<string, mixed> $principal Authenticated principal.
 * @param string               $id        32-character hex request ID.
 * @param string               $name      Ability identifier or '(invalid)'.
 * @param string               $outcome   Audit outcome value.
 * @return void
 */
function mcp_audit(array $principal, string $id, string $name, string $outcome) : void {
	if ($outcome === 'started') {
		$ok = db_execute_prepared('INSERT INTO plugin_mcp_audit
			(request_id, token_id, user_id, ability, outcome, started_at) VALUES (?, ?, ?, ?, ?, ?)',
			[$id, $principal['token_id'], $principal['user_id'], $name, $outcome, time()]);
	} elseif ($outcome === 'denied' || $outcome === 'rejected') {
		// A refused attempt has no earlier 'started' row; it is one row, started and finished together.
		$now = time();
		$ok  = db_execute_prepared('INSERT INTO plugin_mcp_audit
			(request_id, token_id, user_id, ability, outcome, started_at, finished_at) VALUES (?, ?, ?, ?, ?, ?, ?)',
			[$id, $principal['token_id'], $principal['user_id'], $name, $outcome, $now, $now]);
	} else {
		$ok = db_execute_prepared('UPDATE plugin_mcp_audit SET outcome = ?, finished_at = ? WHERE request_id = ?',
			[$outcome, time(), $id]);
	}

	if (!$ok) {
		mcp_log_failure($name, 'AUDIT_UNAVAILABLE');

		throw new AbilitiesError('UNAVAILABLE', 'AUDIT_UNAVAILABLE');
	}
}

/**
 * Stored exposure flags by ability ID, read once per request.
 *
 * @param bool $refresh Force a fresh database query when true.
 * @return array<string, bool>
 */
function mcp_exposure_map(bool $refresh = false) : array {
	static $map = null;

	if ($map === null || $refresh) {
		$map  = [];
		$rows = db_fetch_assoc_prepared('SELECT id, exposed FROM plugin_mcp_ability', []);

		// A failed read must not fall back to defaults, which could re-expose abilities an admin hid.
		// '*' is not a valid ability ID, so it can only come from this sentinel.
		if ($rows === false) {
			return $map = ['*' => false];
		}

		foreach ($rows as $row) {
			$map[(string) $row['id']] = (int) $row['exposed'] === 1;
		}
	}

	return $map;
}

/**
 * A stored flag wins; otherwise built-in (cacti) abilities are exposed and plugin abilities are hidden.
 *
 * @param string              $id        Ability identifier.
 * @param string              $namespace Owning plugin namespace.
 * @param array<string, bool> $map       Exposure map returned by mcp_exposure_map().
 * @return bool True when the ability is exposed to clients.
 */
function mcp_is_exposed(string $id, string $namespace, array $map) : bool {
	if (($map['*'] ?? true) === false) {
		return false;
	}

	return $map[$id] ?? $namespace === 'cacti';
}

/**
 * Expose or hide abilities. Every ID is validated before anything is written.
 *
 * @param array<int, mixed> $ids     Ability identifiers to update.
 * @param bool              $exposed Desired exposure flag.
 * @return void
 */
function mcp_set_exposure(array $ids, bool $exposed) : void {
	foreach ($ids as $id) {
		if (!is_string($id) || !AbilitiesRegistry::isValidId($id)) {
			throw new InvalidArgumentException('Invalid ability ID');
		}
	}
	$ids = array_values(array_unique($ids));

	if ($ids === []) {
		return;
	}
	$now    = time();
	$params = [];

	foreach ($ids as $id) {
		array_push($params, $id, $exposed ? 1 : 0, $now);
	}

	// One statement, so a bulk change is applied whole or not at all.
	try {
		if (!db_execute_prepared('INSERT INTO plugin_mcp_ability (id, exposed, updated_at) VALUES '
			. implode(', ', array_fill(0, count($ids), '(?, ?, ?)'))
			. ' ON DUPLICATE KEY UPDATE exposed = VALUES(exposed), updated_at = VALUES(updated_at)', $params)) {
			throw new RuntimeException('MCP exposure update failed');
		}
	} finally {
		mcp_exposure_map(true);
	}
}

const MCP_MAX_PAGE = 1000000;
const MCP_AUDIT_OUTCOMES = ['started', 'succeeded', 'failed', 'denied', 'rejected'];

/**
 * One page of personal tokens, newest first. Never returns the hash.
 *
 * @param array{user_id?: int} $filter Optional filter map.
 * @param int                  $page   1-based page number.
 * @param int                  $rows   Number of rows per page.
 * @return array{rows: array, total: int}
 */
function mcp_token_list(array $filter, int $page, int $rows) : array {
	$where  = '';
	$params = [];

	// A supplied owner filter must name a real user; dropping it would list every owner's tokens.
	if (array_key_exists('user_id', $filter)) {
		if (!is_int($filter['user_id']) || $filter['user_id'] < 1) {
			throw new InvalidArgumentException('Invalid user filter');
		}
		$where    = ' WHERE t.user_id = ?';
		$params[] = $filter['user_id'];
	}

	return mcp_admin_page('SELECT COUNT(*) FROM plugin_mcp_token AS t' . $where,
		'SELECT t.id, u.username, c.username AS created_by_name, t.created_by, t.created_at, t.expires_at, t.last_used_at, t.revoked
		FROM plugin_mcp_token AS t LEFT JOIN user_auth AS u ON u.id = t.user_id
		LEFT JOIN user_auth AS c ON c.id = t.created_by' . $where . ' ORDER BY t.id DESC',
		$params, $page, $rows);
}

/**
 * Create a personal token for a user. The value is returned once; only its hash is stored.
 * $token is for the CLI, which takes the value from its environment instead of generating one.
 *
 * @param int     $userId    Target token owner user ID.
 * @param int     $days      Token lifetime in days (1 to 365).
 * @param ?int    $createdBy Optional creator user ID (defaults to $userId).
 * @param ?string $token     Optional caller-supplied token value (CLI path).
 * @return string Newly created personal access token string.
 * @throws InvalidArgumentException for a bad user ID or lifetime
 * @throws RuntimeException when the row cannot be stored
 */
function mcp_token_create(int $userId, int $days, ?int $createdBy = null, ?string $token = null) : string {
	$createdBy ??= $userId;

	if ($userId < 1 || $createdBy < 1 || $days < 1 || $days > 365) {
		throw new InvalidArgumentException('Invalid token owner or lifetime');
	}
	mcp_token_assert_eligible($userId);
	$token ??= 'cmcp_pat_' . bin2hex(random_bytes(32));

	if (mcp_token_hash($token) === null) {
		throw new InvalidArgumentException('Invalid token value');
	}
	$now = time();

	if (!db_execute_prepared('INSERT INTO plugin_mcp_token (user_id, token_hash, scopes, expires_at, created_at, created_by) VALUES (?, ?, ?, ?, ?, ?)',
		[$userId, mcp_token_hash($token), '["abilities:read"]', $now + $days * 86400, $now, $createdBy])) {
		throw new RuntimeException('MCP token creation failed');
	}

	return $token;
}

/**
 * Refuse an owner who could not use a token: unknown, disabled, the guest account, or without the realm.
 *
 * @param int $userId Cacti user ID to verify.
 * @return void
 * @throws InvalidArgumentException when the user is not eligible
 */
function mcp_token_assert_eligible(int $userId) : void {
	$user = db_fetch_row_prepared('SELECT id, enabled FROM user_auth WHERE id = ?', [$userId]);

	// Forced read: a console session caches options, so an account made the guest after sign-in
	// would otherwise still pass. The endpoints have no session and keep the cached read.
	try {
		$guestId = mcp_guest_user_id(true);
	} catch (RuntimeException $error) {
		throw new InvalidArgumentException('User is not eligible for a token');
	}

	if (!is_array($user) || !mcp_token_eligible($user, $guestId)) {
		throw new InvalidArgumentException('User is not eligible for a token');
	}
}

/**
 * Whether a user may hold a personal token: enabled, not the guest account, and holding the
 * MCP and Abilities API realm. A guest token would let anyone who knows the shared account read Cacti.
 *
 * @param array{id?: mixed, enabled?: mixed} $user        A user_auth row.
 * @param int                                $guestUserId Configured guest user ID, or 0 when none.
 * @return bool True when the user is eligible to hold a personal token.
 */
function mcp_token_eligible(array $user, int $guestUserId) : bool {
	$id = (int) ($user['id'] ?? 0);

	return $id > 0
		&& ($user['enabled'] ?? '') === 'on'
		&& !($guestUserId > 0 && $id === $guestUserId)
		&& mcp_has_realm($id);
}

/**
 * Create a token and audit its creation by $actor as one unit: a token whose audit row cannot be
 * written is revoked and not handed out. The value is returned once.
 *
 * @param int     $userId Target token owner user ID.
 * @param int     $days   Token lifetime in days (1 to 365).
 * @param int     $actor  Acting user ID attributed in the audit row.
 * @param ?string $token  Optional caller-supplied token value.
 * @return string Newly created personal access token string.
 * @throws InvalidArgumentException for an ineligible owner or a bad lifetime
 * @throws RuntimeException when the token or its audit row cannot be stored
 */
function mcp_token_create_audited(int $userId, int $days, int $actor, ?string $token = null) : string {
	$token = mcp_token_create($userId, $days, $actor, $token);
	$id    = mcp_token_id($token);

	try {
		if ($id < 1) {
			throw new RuntimeException('MCP token lookup failed');
		}
		mcp_audit_admin($actor, $id, 'token-create');
	} catch (RuntimeException $error) {
		// By value, not ID: the lookup that failed is the reason an ID may be missing.
		db_execute_prepared('UPDATE plugin_mcp_token SET revoked = 1 WHERE token_hash = ?', [mcp_token_hash($token)]);

		throw $error;
	}

	return $token;
}

/**
 * ID of the token with this value, for the audit row written when an admin creates it.
 *
 * @param string $token Personal access token string.
 * @return int Token row ID or 0 when malformed or not found.
 */
function mcp_token_id(string $token) : int {
	$hash = mcp_token_hash($token);

	return $hash === null ? 0 : (int) db_fetch_cell_prepared('SELECT id FROM plugin_mcp_token WHERE token_hash = ?', [$hash]);
}

/**
 * Audit a console token action: one complete row, attributed to the acting admin. The token
 * value never appears. $action is token-create or token-revoke, recorded as the ability name.
 *
 * @param int    $actor   Acting user ID.
 * @param int    $tokenId Target token row ID.
 * @param string $action  Action slug ('token-create' or 'token-revoke').
 * @return void
 * @throws RuntimeException when the row cannot be written
 */
function mcp_audit_admin(int $actor, int $tokenId, string $action) : void {
	if (!in_array($action, ['token-create', 'token-revoke'], true)) {
		throw new InvalidArgumentException('Invalid admin action');
	}
	$now = time();

	if (!db_execute_prepared('INSERT INTO plugin_mcp_audit
		(request_id, token_id, user_id, ability, outcome, started_at, finished_at) VALUES (?, ?, ?, ?, ?, ?, ?)',
		[bin2hex(random_bytes(16)), $tokenId, $actor, 'mcp-' . $action, 'succeeded', $now, $now])) {
		throw new RuntimeException('MCP audit write failed');
	}
}

/**
 * Revoke tokens. With $ownerId only that user's tokens change, so a forged ID cannot touch anyone else's.
 *
 * @param list<int> $ids     Token row IDs to revoke.
 * @param ?int      $ownerId Optional owning user ID scope.
 * @return int Tokens changed; already revoked tokens do not count.
 * @throws InvalidArgumentException for a malformed ID
 * @throws RuntimeException when the update fails
 */
function mcp_token_revoke(array $ids, ?int $ownerId = null) : int {
	mcp_token_check_ids($ids);

	if ($ids === []) {
		return 0;
	}
	$params = array_values($ids);
	$owner  = '';

	if ($ownerId !== null) {
		$owner    = ' AND user_id = ?';
		$params[] = $ownerId;
	}

	if (!db_execute_prepared('UPDATE plugin_mcp_token SET revoked = 1 WHERE id IN (' . implode(', ', array_fill(0, count($ids), '?')) . ')' . $owner, $params)) {
		throw new RuntimeException('MCP token revocation failed');
	}

	return (int) db_affected_rows();
}

/**
 * The tokens were revoked but at least one audit row could not be written.
 */
class McpRevokeAuditError extends RuntimeException {
	/**
	 * Construct the audit failure error carrying the revoked token count.
	 *
	 * @param int $revoked Number of tokens that were revoked before auditing failed.
	 */
	public function __construct(public int $revoked) {
		parent::__construct('MCP audit write failed after revocation');
	}
}

/**
 * Revoke the active tokens among $ids and audit each one actually revoked, attributed to $actor.
 * Unknown and already revoked IDs are skipped without a trace. With $ownerId only that user's tokens change.
 *
 * @param int       $actor   Acting user ID.
 * @param list<int> $ids     Candidate token row IDs.
 * @param ?int      $ownerId Optional owning user ID scope.
 * @return int Tokens revoked.
 * @throws McpRevokeAuditError when the tokens were revoked but an audit row could not be written
 * @throws InvalidArgumentException for a malformed ID
 * @throws RuntimeException when the lookup or update fails
 */
function mcp_token_revoke_audited(int $actor, array $ids, ?int $ownerId = null) : int {
	$ids = mcp_token_revocable($ids, $ownerId);

	if ($ids === []) {
		return 0;
	}
	$changed = mcp_token_revoke($ids, $ownerId);

	try {
		foreach ($ids as $id) {
			mcp_audit_admin($actor, $id, 'token-revoke');
		}
	} catch (RuntimeException $error) {
		throw new McpRevokeAuditError($changed);
	}

	return $changed;
}

/**
 * Validate that every entry in $ids is a positive integer token ID.
 *
 * @param list<int> $ids Token IDs to check.
 * @return void
 */
function mcp_token_check_ids(array $ids) : void {
	foreach ($ids as $id) {
		if (!is_int($id) || $id < 1) {
			throw new InvalidArgumentException('Invalid token ID');
		}
	}
}

/**
 * The given tokens that are active and, when $ownerId is set, owned by that user.
 *
 * @param list<int> $ids     Candidate token row IDs.
 * @param ?int      $ownerId Optional owning user ID scope.
 * @return list<int> Active revocable token IDs.
 */
function mcp_token_revocable(array $ids, ?int $ownerId = null) : array {
	mcp_token_check_ids($ids);

	if ($ids === []) {
		return [];
	}
	$params = array_values($ids);
	$owner  = '';

	if ($ownerId !== null) {
		$owner    = ' AND user_id = ?';
		$params[] = $ownerId;
	}
	$found = db_fetch_assoc_prepared('SELECT id FROM plugin_mcp_token WHERE id IN (' . implode(', ', array_fill(0, count($ids), '?')) . ') AND revoked = 0' . $owner, $params);

	if ($found === false) {
		throw new RuntimeException('MCP token lookup failed');
	}

	return array_map('intval', array_column($found, 'id'));
}

/**
 * One page of audit rows, newest first.
 *
 * @param array{user_id?: int, ability?: string, outcome?: string} $filter Empty or -1 values mean no condition.
 * @param int                                                      $page   1-based page number.
 * @param int                                                      $rows   Number of rows per page.
 * @return array{rows: array, total: int}
 */
function mcp_audit_list(array $filter, int $page, int $rows) : array {
	$conditions = [];
	$params     = [];
	$userId     = $filter['user_id'] ?? -1;

	if ($userId !== -1) {
		if (!is_int($userId) || $userId < 1) {
			throw new InvalidArgumentException('Invalid user filter');
		}
		$conditions[] = 'a.user_id = ?';
		$params[]     = $userId;
	}
	$ability = $filter['ability'] ?? '';

	if ($ability !== '') {
		if (!is_string($ability) || !AbilitiesRegistry::isValidId($ability)) {
			throw new InvalidArgumentException('Invalid ability filter');
		}
		$conditions[] = 'a.ability = ?';
		$params[]     = $ability;
	}
	$outcome = $filter['outcome'] ?? '';

	if ($outcome !== '') {
		if (!in_array($outcome, MCP_AUDIT_OUTCOMES, true)) {
			throw new InvalidArgumentException('Invalid outcome filter');
		}
		$conditions[] = 'a.outcome = ?';
		$params[]     = $outcome;
	}
	$where = $conditions ? ' WHERE ' . implode(' AND ', $conditions) : '';

	return mcp_admin_page('SELECT COUNT(*) FROM plugin_mcp_audit AS a' . $where,
		'SELECT a.request_id, a.token_id, a.user_id, u.username, a.ability, a.outcome, a.started_at, a.finished_at
		FROM plugin_mcp_audit AS a LEFT JOIN user_auth AS u ON u.id = a.user_id' . $where . ' ORDER BY a.started_at DESC, a.request_id',
		$params, $page, $rows);
}

/**
 * Count and fetch one page. LIMIT and OFFSET are cast to integers and written into the
 * statement, as Cacti core does, because a bound LIMIT value reaches MySQL as a string.
 *
 * @param string            $countSql SQL COUNT(*) query.
 * @param string            $listSql  SQL list query without LIMIT/OFFSET.
 * @param array<int, mixed> $params   Bound query parameters.
 * @param int               $page     1-based page number.
 * @param int               $rows     Number of rows per page.
 * @return array{rows: array, total: int}
 * @throws RuntimeException when the database read fails
 */
function mcp_admin_page(string $countSql, string $listSql, array $params, int $page, int $rows) : array {
	// The cap keeps (page - 1) * rows far inside the integer range.
	if ($page < 1 || $page > MCP_MAX_PAGE || $rows < 1 || $rows > 500) {
		throw new InvalidArgumentException('Invalid page');
	}
	$total = db_fetch_cell_prepared($countSql, $params);
	$found = db_fetch_assoc_prepared($listSql . ' LIMIT ' . $rows . ' OFFSET ' . (($page - 1) * $rows), $params);

	if ($total === false || $found === false) {
		throw new RuntimeException('MCP list query failed');
	}

	return ['rows' => $found, 'total' => (int) $total];
}
