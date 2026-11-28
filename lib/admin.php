<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* Pure helpers behind the console page, kept apart from Cacti's page functions so they can be tested. */

require_once __DIR__ . '/storage.php';

/**
 * Display name of the realm an ability needs, from Cacti's realm names; blank when the registry cannot say.
 *
 * @param array<string, mixed>  $ability    Ability descriptor array.
 * @param array<int, string>    $realmNames Map of Cacti realm ID to display name.
 * @return string Realm display name or empty string.
 */
function mcp_admin_realm_name(array $ability, array $realmNames) : string {
	$realm = MCP_BUILTIN_REALMS[$ability['id']] ?? null;

	return $realm === null ? '' : (string) ($realmNames[$realm] ?? '');
}

/**
 * Rows for the abilities table.
 *
 * @param list<array>             $all         AbilitiesRegistry::all()
 * @param array<string, bool>     $exposureMap mcp_exposure_map()
 * @param callable(array): string $realmName   Display name of the realm an ability needs.
 * @return list<array{id: string, label: string, category: string, namespace: string, realm: string, annotations: array, exposed: bool}>
 */
function mcp_admin_ability_rows(array $all, array $exposureMap, callable $realmName) : array {
	$rows = [];

	foreach ($all as $ability) {
		$rows[] = [
			'id'          => $ability['id'],
			'label'       => $ability['label'],
			'category'    => $ability['category'],
			'namespace'   => $ability['namespace'],
			'realm'       => $realmName($ability),
			'annotations' => $ability['annotations'],
			'exposed'     => mcp_is_exposed($ability['id'], $ability['namespace'], $exposureMap)
		];
	}

	return $rows;
}

/**
 * Read a bulk action from a POST. Cacti's actions dropdown posts drp_action; the
 * rows are checkboxes named chk_<id>. Every ID is validated for the action.
 *
 * @param array<string, mixed> $post POST form data.
 * @return array{action: string, ids: list<string>|list<int>}
 * @throws InvalidArgumentException for an unknown action
 */
function mcp_admin_parse_action(array $post) : array {
	$action = $post['drp_action'] ?? $post['action'] ?? '';

	if (!is_string($action) || !in_array($action, ['expose', 'hide', 'revoke'], true)) {
		throw new InvalidArgumentException('Unknown action');
	}
	$ids = [];

	foreach (array_keys($post) as $key) {
		$key = (string) $key;

		if (!str_starts_with($key, 'chk_')) {
			continue;
		}
		$id = substr($key, 4);

		if ($action === 'revoke') {
			// Digits only, no leading zero, short enough to be a safe integer.
			if (preg_match('/^[1-9][0-9]{0,14}$/D', $id) === 1) {
				$ids[] = (int) $id;
			}
		} elseif (AbilitiesRegistry::isValidId($id)) {
			$ids[] = $id;
		}
	}

	return ['action' => $action, 'ids' => array_values(array_unique($ids))];
}

/**
 * Whether an admin may create a token for another user. A token lets its holder read Cacti
 * as that user, so creating one for someone else needs the User Management realm too.
 *
 * @param int  $actor        Signed-in admin user ID.
 * @param int  $target       Target token owner user ID.
 * @param bool $hasUserAdmin Whether the actor holds the Users/Groups realm.
 * @return bool True when token creation is authorized.
 */
function mcp_admin_may_create_for(int $actor, int $target, bool $hasUserAdmin) : bool {
	return $actor > 0 && $target > 0 && ($target === $actor || $hasUserAdmin);
}

/** Open create forms keep their nonces side by side, so a second tab does not invalidate the first. */
const MCP_ADMIN_NONCE_SLOTS = 5;

/**
 * Issue a one-time form nonce into $session (Cacti's session array). It is not the token.
 *
 * @param array<string, mixed> $session Session array passed by reference.
 * @return string Newly generated 32-character hex nonce.
 */
function mcp_admin_nonce_issue(array &$session) : string {
	$issued   = array_values(array_filter($session['mcp_create_nonces'] ?? [], 'is_string'));
	$nonce    = bin2hex(random_bytes(16));
	$issued[] = $nonce;

	$session['mcp_create_nonces'] = array_slice($issued, -MCP_ADMIN_NONCE_SLOTS);

	return $nonce;
}

/**
 * Consume the nonce: true once for an issued value, false for a reused, missing, or wrong one.
 *
 * @param array<string, mixed> $session Session array passed by reference.
 * @param string               $given   Submitted nonce string.
 * @return bool True if the nonce matched and was consumed.
 */
function mcp_admin_nonce_consume(array &$session, string $given) : bool {
	$issued = $session['mcp_create_nonces'] ?? [];
	$found  = false;

	foreach (is_array($issued) ? $issued : [] as $index => $nonce) {
		if ($given !== '' && is_string($nonce) && hash_equals($nonce, $given)) {
			unset($issued[$index]);
			$found = true;
		}
	}
	$session['mcp_create_nonces'] = array_values($issued);

	return $found;
}

/**
 * Shown by the console and the self-service page when a token is refused for its owner.
 *
 * @return string Localized refusal text.
 */
function mcp_token_ineligible_text() : string {
	return __('Tokens cannot be created for the guest account or disabled users.', 'mcp');
}

/**
 * Run $fn against the session array, opening and closing the session when Cacti has it closed.
 *
 * @param callable $fn Callback receiving the $_SESSION array by reference.
 * @return mixed Callback return value.
 */
function mcp_with_session(callable $fn) : mixed {
	$opened = session_status() === PHP_SESSION_NONE;

	if ($opened) {
		cacti_session_start();
	}

	try {
		return $fn($_SESSION);
	} finally {
		if ($opened) {
			cacti_session_close();
		}
	}
}

/**
 * Revoke some of a user's own tokens and audit each one actually revoked. Tokens owned by anyone
 * else, and tokens already revoked, are skipped without a trace.
 *
 * @param int       $userId Signed-in user ID owning the tokens.
 * @param list<int> $ids    Token IDs to revoke.
 * @return int Number of tokens revoked.
 * @throws McpRevokeAuditError when the tokens were revoked but not all audit rows were written
 */
function mcp_self_revoke(int $userId, array $ids) : int {
	return mcp_token_revoke_audited($userId, $ids, $userId);
}

/**
 * What a token of this user could list: the registry's discovery for the same principal
 * mcp_authenticate builds, so exposure and realm checks match.
 *
 * @param AbilitiesRegistry $registry Ability registry instance.
 * @param int               $userId   Cacti user ID.
 * @return list<array{id: string, label: string, description: string}>
 */
function mcp_available_tools(AbilitiesRegistry $registry, int $userId) : array {
	return array_map(fn (array $ability) => [
		'id'          => $ability['id'],
		'label'       => $ability['label'],
		'description' => $ability['description']
	], $registry->discover(mcp_user_principal($userId, 0)));
}
