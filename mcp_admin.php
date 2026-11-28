<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* MCP administration console (MCP Administration realm): choose which abilities
 * are exposed, manage personal tokens, and read the audit log. Cacti's CSRF
 * protection covers every POST; state changes are accepted from POST only. */

include('../../include/auth.php');

require_once __DIR__ . '/lib/providers.php';
require_once __DIR__ . '/lib/admin.php';
require_once __DIR__ . '/lib/origin.php';

/**
 * Cacti-relative URL of this page, for forms, links, and redirects.
 *
 * @param string $query Optional query string suffix starting with '?'.
 * @return string Relative console URL.
 */
function mcp_admin_url(string $query = '') : string {
	global $config;

	return $config['url_path'] . 'plugins/mcp/mcp_admin.php' . $query;
}

/**
 * Queue a Cacti error banner message for the MCP console.
 *
 * @param string $text Localized error text.
 * @return void
 */
function mcp_admin_error(string $text) : void {
	raise_message('mcp_error', $text, MESSAGE_LEVEL_ERROR);
}

/**
 * Queue a Cacti info banner message for the MCP console.
 *
 * @param string $text Localized informational text.
 * @return void
 */
function mcp_admin_info(string $text) : void {
	raise_message('mcp_info', $text, MESSAGE_LEVEL_INFO);
}

/**
 * Render the administration tab bar for Abilities, Tokens, and Audit.
 *
 * @param string $current Active tab slug.
 * @return void
 */
function mcp_admin_tabs(string $current) : void {
	$labels = ['abilities' => __('Abilities', 'mcp'), 'tokens' => __('Tokens', 'mcp'), 'audit' => __('Audit', 'mcp')];

	print "<div class='tabs'><nav class='scrollable'><ul class='tabs'>";

	foreach ($labels as $tab => $label) {
		print "<li class='subTab'><a class='tab" . ($tab === $current ? ' selected' : '') . "' href='" . html_escape(mcp_admin_url('?tab=' . $tab)) . "'>" . html_escape($label) . '</a></li>';
	}
	print '</ul></nav></div>';
}

/**
 * Render an inline warning notice box on the administration page.
 *
 * @param string $text Localized notice text.
 * @return void
 */
function mcp_admin_notice(string $text) : void {
	html_start_box('', '100%', '', '3', 'center', '');
	print "<tr class='odd'><td><span class='deviceDown'>" . html_escape($text) . '</span></td></tr>';
	html_end_box();
}

/**
 * Format a Unix timestamp for display in admin tables.
 *
 * @param mixed $value Unix timestamp or empty/zero value.
 * @return string Formatted date string or '-'.
 */
function mcp_admin_time(mixed $value) : string {
	return (int) $value > 0 ? date('Y-m-d H:i:s', (int) $value) : '-';
}

/**
 * Rows per page from Cacti's setting or the filter, kept within what the storage helpers accept.
 *
 * @return int Bounded row count per page.
 */
function mcp_admin_rows() : int {
	$rows = get_request_var('rows') == '-1' ? (int) read_config_option('num_rows_table') : (int) get_request_var('rows');

	return $rows >= 1 && $rows <= 500 ? $rows : 30;
}

/**
 * Return Cacti's realm ID to display-name map.
 *
 * @return array<int, string>
 */
function mcp_admin_realm_names() : array {
	global $user_auth_realms;

	return is_array($user_auth_realms) ? $user_auth_realms : [];
}

/**
 * Resolve the abilities and apply a bulk expose or hide. Returns whether anything was saved.
 *
 * @param array{action: string, ids: list<string>|list<int>} $parsed Parsed bulk action payload.
 * @return bool True when exposure settings were saved.
 */
function mcp_admin_apply_exposure(array $parsed) : bool {
	$registered = array_column(mcp_registry()->all(), 'id');
	$ids        = array_values(array_intersect($parsed['ids'], $registered));

	if ($ids === []) {
		mcp_admin_error(__('None of the selected abilities is registered.', 'mcp'));

		return false;
	}

	try {
		mcp_set_exposure($ids, $parsed['action'] === 'expose');
	} catch (InvalidArgumentException $error) {
		mcp_admin_error(__('The selection contains an invalid ability. Nothing was changed.', 'mcp'));

		return false;
	} catch (RuntimeException $error) {
		mcp_admin_error(__('The exposure change could not be saved. Nothing was changed.', 'mcp'));

		return false;
	}

	return true;
}

/**
 * Confirmation step for a bulk action, in Cacti's form_actions layout.
 *
 * @param array{action: string, ids: list<string>|list<int>} $parsed Parsed bulk action payload.
 * @param string                                             $tab    Active console tab slug.
 * @return void
 */
function mcp_admin_confirm(array $parsed, string $tab) : void {
	top_header();

	$revoke = $parsed['action'] === 'revoke';
	$titles = ['expose' => __('Expose Abilities', 'mcp'), 'hide' => __('Hide Abilities', 'mcp'), 'revoke' => __('Revoke Tokens', 'mcp')];

	html_start_box($titles[$parsed['action']], '60%', '', '3', 'center', '');
	print "<form action='" . html_escape(mcp_admin_url()) . "' method='post'>";
	print "<tr><td class='textArea'><p>";

	if ($parsed['action'] === 'expose') {
		print html_escape(__('Click Continue to expose these abilities to AI clients. Users still need the realm each ability requires.', 'mcp'));
	} elseif ($parsed['action'] === 'hide') {
		print html_escape(__('Click Continue to hide these abilities from AI clients.', 'mcp'));
	} else {
		print html_escape(__('Click Continue to revoke these tokens. Revoked tokens cannot be used again.', 'mcp'));
	}
	print '</p><div class="itemlist"><ul>';

	foreach ($parsed['ids'] as $id) {
		print '<li>' . html_escape(($revoke ? __('Token', 'mcp') . ' ' : '') . $id) . '</li>';
		print "<input type='hidden' name='chk_" . html_escape((string) $id) . "' value='on'>";
	}
	print '</ul></div></td></tr>';
	print "<tr><td class='saveRow'><input type='hidden' name='action' value='apply'>"
		. "<input type='hidden' name='drp_action' value='" . html_escape($parsed['action']) . "'>"
		. "<a class='linkEditMain' href='" . html_escape(mcp_admin_url('?tab=' . $tab)) . "'>" . html_escape(__('Cancel', 'mcp')) . '</a>&nbsp;'
		. "<input type='submit' class='ui-button ui-corner-all ui-widget' value='" . html_escape(__('Continue', 'mcp')) . "'></td></tr>";
	print '</form>';
	html_end_box();

	bottom_footer();
}

/**
 * Return the signed-in admin user ID from the active Cacti session.
 *
 * @return int User ID or 0 when unauthenticated.
 */
function mcp_admin_actor() : int {
	return (int) ($_SESSION['sess_user_id'] ?? 0);
}

/**
 * Cacti's Users/Groups realm (user_admin.php, realm 1 on 1.2.31).
 *
 * @return bool True when the signed-in admin holds realm 1.
 */
function mcp_admin_has_user_admin() : bool {
	return is_realm_allowed(1);
}

/**
 * Create a token from the posted form. Returns the token once, or null with a message raised.
 *
 * @return ?string Newly created token string or null on validation/storage error.
 */
function mcp_admin_create_token() : ?string {
	$userId = get_filter_request_var('user_id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
	$days   = get_filter_request_var('days', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 365]]);

	if (!is_int($userId) || !is_int($days)) {
		mcp_admin_error(__('Choose a user and an expiry of 1 to 365 days.', 'mcp'));

		return null;
	}
	$actor = mcp_admin_actor();

	// A token reads Cacti as its owner, so minting one for someone else needs user management rights.
	if (!mcp_admin_may_create_for($actor, $userId, mcp_admin_has_user_admin())) {
		mcp_admin_error(__('You may only create tokens for yourself without the Users/Groups permission.', 'mcp'));

		return null;
	}

	// One submission per issued form, so reloading the response cannot mint a second token.
	$given = get_nfilter_request_var('mcp_nonce');

	if (!is_string($given) || !mcp_with_session(fn (array &$session) => mcp_admin_nonce_consume($session, $given))) {
		mcp_admin_error(__('This form was already submitted.', 'mcp'));

		return null;
	}

	try {
		mcp_token_assert_eligible($userId);
	} catch (InvalidArgumentException $error) {
		mcp_admin_error(mcp_token_ineligible_text());

		return null;
	}

	try {
		return mcp_token_create_audited($userId, $days, $actor);
	} catch (InvalidArgumentException $error) {
		// The checks above passed, so a refusal here means the owner changed under us.
		mcp_admin_error(mcp_token_ineligible_text());

		return null;
	} catch (RuntimeException $error) {
		mcp_admin_error(__('The token could not be created.', 'mcp'));

		return null;
	}
}

/**
 * Render the Abilities administration tab.
 *
 * @return void
 */
function mcp_admin_abilities_tab() : void {
	$rows  = mcp_admin_ability_rows(mcp_registry()->all(), mcp_exposure_map(true),
		fn (array $ability) => mcp_admin_realm_name($ability, mcp_admin_realm_names()));

	if (mcp_public_url() === null) {
		mcp_admin_notice(__('Set the Public Cacti URL in Settings > MCP before connecting AI clients.', 'mcp'));
	}

	if (isset(mcp_exposure_map()['*'])) {
		mcp_admin_notice(__('Exposure settings could not be read, so every ability is hidden from AI clients.', 'mcp'));
	}
	$labels = ['readOnly' => __('Read-only', 'mcp'), 'idempotent' => __('Idempotent', 'mcp'), 'destructive' => __('Destructive', 'mcp')];

	html_start_box(__('Abilities', 'mcp'), '100%', '', '3', 'center', '');
	html_header_checkbox([__('Ability', 'mcp'), __('Name', 'mcp'), __('Category', 'mcp'), __('Plugin', 'mcp'), __('Required Realm', 'mcp'), __('Annotations', 'mcp'), __('Exposed', 'mcp')], true, mcp_admin_url('?tab=abilities'));

	if ($rows === []) {
		print "<tr class='tableRow'><td colspan='8'><em>" . html_escape(__('No abilities are registered', 'mcp')) . '</em></td></tr>';
	}

	foreach ($rows as $i => $row) {
		$notes = [];

		foreach ($row['annotations'] as $key => $value) {
			if ($value === true && isset($labels[$key])) {
				$notes[] = $labels[$key];
			}
		}
		form_alternate_row('line' . $i, true);
		form_selectable_cell(html_escape($row['id']), $row['id']);
		form_selectable_cell(html_escape($row['label']), $row['id']);
		form_selectable_cell(html_escape($row['category']), $row['id']);
		form_selectable_cell(html_escape($row['namespace']), $row['id']);
		form_selectable_cell(html_escape($row['realm'] !== '' ? $row['realm'] : __('Set by the plugin', 'mcp')), $row['id']);
		form_selectable_cell(html_escape(implode(', ', $notes)), $row['id']);
		form_selectable_cell(html_escape($row['exposed'] ? __('Yes', 'mcp') : __('No', 'mcp')), $row['id']);
		form_checkbox_cell($row['id'], $row['id']);
		form_end_row();
	}
	html_end_box(false);

	draw_actions_dropdown(['expose' => __('Expose', 'mcp'), 'hide' => __('Hide', 'mcp')]);
	print '</form>';
}

/**
 * Build Cacti request-filter definitions for pagination plus extra filters.
 *
 * @param array<string, mixed> $extra Additional filter specifications.
 * @return array<string, mixed> Combined filter definitions.
 */
function mcp_admin_paging_filters(array $extra = []) : array {
	return [
		'rows' => ['filter' => FILTER_VALIDATE_INT, 'pageset' => true, 'default' => '-1'],
		'page' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['options' => ['min_range' => 1, 'max_range' => MCP_MAX_PAGE]], 'default' => '1']
	] + $extra;
}

/**
 * Render the Tokens administration tab and token creation form.
 *
 * @param ?string $newToken Newly created token to display once, or null.
 * @return void
 */
function mcp_admin_tokens_tab(?string $newToken) : void {
	validate_store_request_vars(mcp_admin_paging_filters(), 'sess_mcp_tokens');
	$rows = mcp_admin_rows();
	$page = (int) get_request_var('page');

	if ($newToken !== null) {
		html_start_box(__('New Token', 'mcp'), '100%', '', '3', 'center', '');
		print "<tr class='odd'><td><p>" . html_escape(__('Copy this token now. It is not shown again.', 'mcp')) . '</p>'
			. "<input type='text' id='mcp_new_token' class='ui-state-default ui-corner-all' readonly='readonly' autocomplete='off' size='80' value='" . html_escape($newToken) . "'></td></tr>";
		html_end_box();
		?>
		<script type='text/javascript' <?php print CactiSecureHeaders::getNonceAttribute();?>>
		$(function() {
			$('#mcp_new_token').on('focus click', function() {
				this.select();
			});
		});
		</script>
		<?php
	}

	try {
		$list = mcp_token_list([], $page, $rows);
	} catch (RuntimeException $error) {
		mcp_admin_notice(__('The token list could not be read.', 'mcp'));
		$list = ['rows' => [], 'total' => 0];
	}
	$now = time();

	print html_nav_bar(mcp_admin_url('?tab=tokens'), MAX_DISPLAY_PAGES, $page, $rows, $list['total'], 8, __('Tokens', 'mcp'), 'page', 'main');

	html_start_box(__('Tokens', 'mcp'), '100%', '', '3', 'center', '');
	html_header_checkbox([__('ID', 'mcp'), __('User', 'mcp'), __('Created By', 'mcp'), __('Created', 'mcp'), __('Expires', 'mcp'), __('Last Used', 'mcp'), __('State', 'mcp')], true, mcp_admin_url('?tab=tokens'));

	if ($list['rows'] === []) {
		print "<tr class='tableRow'><td colspan='8'><em>" . html_escape(__('No tokens found', 'mcp')) . '</em></td></tr>';
	}

	foreach ($list['rows'] as $i => $row) {
		$revoked = (int) $row['revoked'] === 1;
		$id      = (int) $row['id'];

		if ($revoked) {
			$state = __('Revoked', 'mcp');
		} elseif ((int) $row['expires_at'] <= $now) {
			$state = __('Expired', 'mcp');
		} else {
			$state = __('Active', 'mcp');
		}
		form_alternate_row('line' . $i, true, $revoked);
		form_selectable_cell(html_escape((string) $id), $id);
		form_selectable_cell(html_escape((string) ($row['username'] ?? __('(deleted user)', 'mcp'))), $id);
		form_selectable_cell(html_escape((string) ($row['created_by_name'] ?? '#' . $row['created_by'])), $id);
		form_selectable_cell(html_escape(mcp_admin_time($row['created_at'])), $id);
		form_selectable_cell(html_escape(mcp_admin_time($row['expires_at'])), $id);
		form_selectable_cell(html_escape(mcp_admin_time($row['last_used_at'])), $id);
		form_selectable_cell(html_escape($state), $id);
		form_checkbox_cell((string) $id, $id, $revoked);
		form_end_row();
	}
	html_end_box(false);

	draw_actions_dropdown(['revoke' => __('Revoke', 'mcp')]);
	print '</form>';

	// Without the Users/Groups permission an admin can only create a token for themselves.
	// Forced: a console session caches options, and a stale guest id would offer the guest account.
	try {
		$guestId = mcp_guest_user_id(true);
	} catch (RuntimeException $error) {
		// Offer nobody rather than possibly offer the guest account; creation re-checks eligibility anyway.
		$guestId = -1;
	}

	if ($guestId < 0) {
		$users = [];
	} elseif (mcp_admin_has_user_admin()) {
		$users = db_fetch_assoc_prepared('SELECT id, username FROM user_auth WHERE enabled = ? AND id <> ? ORDER BY username', ['on', $guestId]);
	} else {
		$users = db_fetch_assoc_prepared('SELECT id, username FROM user_auth WHERE enabled = ? AND id = ? AND id <> ?', ['on', mcp_admin_actor(), $guestId]);
	}

	$nonce = mcp_with_session(fn (array &$session) => mcp_admin_nonce_issue($session));

	html_start_box(__('Create Token', 'mcp'), '100%', '', '3', 'center', '');
	print "<tr class='odd'><td><form id='mcp_create_token' action='" . html_escape(mcp_admin_url()) . "' method='post'><table class='filterTable'><tr><td>"
		. html_escape(__('User', 'mcp')) . '</td><td>';
	form_dropdown('user_id', $users ?: [], 'username', 'id', '', '', '');
	print '</td><td>' . html_escape(__('Expires in days', 'mcp')) . "</td><td><input type='text' class='ui-state-default ui-corner-all' id='days' name='days' size='5' maxlength='3' value='90'></td>"
		. "<td><input type='hidden' name='action' value='create_token'><input type='hidden' name='mcp_nonce' value='" . html_escape($nonce) . "'><input type='submit' class='ui-button ui-corner-all ui-widget' value='" . html_escape(__('Create', 'mcp')) . "'></td></tr></table></form></td></tr>";
	html_end_box();
}

/**
 * Render the Audit administration tab with filter controls and log table.
 *
 * @return void
 */
function mcp_admin_audit_tab() : void {
	$filters = mcp_admin_paging_filters([
		'user_id' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['options' => ['min_range' => -1]], 'pageset' => true, 'default' => '-1'],
		'ability' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['options' => ['regexp' => AbilitiesRegistry::ID_PATTERN]], 'pageset' => true, 'default' => ''],
		'outcome' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['options' => ['regexp' => '/^(' . implode('|', MCP_AUDIT_OUTCOMES) . ')$/D']], 'pageset' => true, 'default' => '']
	]);
	validate_store_request_vars($filters, 'sess_mcp_audit');

	$rows    = mcp_admin_rows();
	$page    = (int) get_request_var('page');
	$userId  = (int) get_request_var('user_id') > 0 ? (int) get_request_var('user_id') : -1;
	$ability = (string) get_request_var('ability');
	$outcome = (string) get_request_var('outcome');
	$users   = db_fetch_assoc_prepared('SELECT id, username FROM user_auth ORDER BY username', []);

	?>
	<script type='text/javascript' <?php print CactiSecureHeaders::getNonceAttribute();?>>
	function applyFilter() {
		loadPageNoHeader(urlPath + 'plugins/mcp/mcp_admin.php?tab=audit&header=false'
			+ '&user_id=' + encodeURIComponent($('#user_id').val())
			+ '&ability=' + encodeURIComponent($('#ability').val())
			+ '&outcome=' + encodeURIComponent($('#outcome').val()));
	}

	$(function() {
		$('#user_id, #outcome').on('change', applyFilter);
		$('#refresh').on('click', applyFilter);
		$('#clear').on('click', function() {
			loadPageNoHeader(urlPath + 'plugins/mcp/mcp_admin.php?tab=audit&clear=1&header=false');
		});
		$('#form_mcp_audit').on('submit', function(event) {
			event.preventDefault();
			applyFilter();
		});
	});
	</script>
	<?php

	html_start_box(__('Audit', 'mcp'), '100%', '', '3', 'center', '');
	print "<tr class='even noprint'><td><form id='form_mcp_audit' action='" . html_escape(mcp_admin_url()) . "'><table class='filterTable'><tr><td>" . html_escape(__('User', 'mcp')) . "</td><td><select id='user_id'>";
	print "<option value='-1'" . ($userId === -1 ? ' selected' : '') . '>' . html_escape(__('All', 'mcp')) . '</option>';

	foreach ($users ?: [] as $user) {
		print "<option value='" . html_escape($user['id']) . "'" . ($userId === (int) $user['id'] ? ' selected' : '') . '>' . html_escape($user['username']) . '</option>';
	}
	print '</select></td><td>' . html_escape(__('Ability', 'mcp')) . "</td><td><input type='text' class='ui-state-default ui-corner-all' id='ability' size='28' maxlength='64' value='" . html_escape($ability) . "'></td>";
	print '<td>' . html_escape(__('Outcome', 'mcp')) . "</td><td><select id='outcome'><option value=''" . ($outcome === '' ? ' selected' : '') . '>' . html_escape(__('Any', 'mcp')) . '</option>';

	foreach (MCP_AUDIT_OUTCOMES as $name) {
		print "<option value='" . html_escape($name) . "'" . ($outcome === $name ? ' selected' : '') . '>' . html_escape($name) . '</option>';
	}
	print "</select></td><td><span><input type='submit' class='ui-button ui-corner-all ui-widget' id='refresh' value='" . html_escape(__('Go', 'mcp')) . "'>"
		. "<input type='button' class='ui-button ui-corner-all ui-widget' id='clear' value='" . html_escape(__('Clear', 'mcp')) . "'></span></td></tr></table></form></td></tr>";
	html_end_box();

	try {
		$list = mcp_audit_list(['user_id' => $userId, 'ability' => $ability, 'outcome' => $outcome], $page, $rows);
	} catch (InvalidArgumentException | RuntimeException $error) {
		mcp_admin_notice(__('The audit log could not be read.', 'mcp'));
		$list = ['rows' => [], 'total' => 0];
	}

	$base = mcp_admin_url('?tab=audit&user_id=' . $userId . '&ability=' . rawurlencode($ability) . '&outcome=' . rawurlencode($outcome));
	print html_nav_bar($base, MAX_DISPLAY_PAGES, $page, $rows, $list['total'], 7, __('Audit Entries', 'mcp'), 'page', 'main');

	html_start_box('', '100%', '', '3', 'center', '');
	html_header([__('Started', 'mcp'), __('User', 'mcp'), __('Token', 'mcp'), __('Ability', 'mcp'), __('Outcome', 'mcp'), __('Finished', 'mcp')]);

	if ($list['rows'] === []) {
		print "<tr class='tableRow'><td colspan='6'><em>" . html_escape(__('No audit entries found', 'mcp')) . '</em></td></tr>';
	}

	foreach ($list['rows'] as $i => $row) {
		form_alternate_row('line' . $i, false);
		form_selectable_cell(html_escape(mcp_admin_time($row['started_at'])), $i);
		form_selectable_cell(html_escape((string) ($row['username'] ?? '#' . $row['user_id'])), $i);
		form_selectable_cell(html_escape('#' . $row['token_id']), $i);
		form_selectable_cell(html_escape((string) $row['ability']), $i);
		form_selectable_cell(html_escape((string) $row['outcome']), $i);
		form_selectable_cell(html_escape(mcp_admin_time($row['finished_at'])), $i);
		form_end_row();
	}
	html_end_box();
}

/* ================= request handling ================= */

$mcp_tab = get_filter_request_var('tab', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(abilities|tokens|audit)$/']]);
$mcp_tab = is_string($mcp_tab) && $mcp_tab !== '' ? $mcp_tab : 'abilities';

if ((int) $config['poller_id'] !== 1) {
	top_header();
	mcp_admin_notice(__('MCP administration is available on the main poller only.', 'mcp'));
	bottom_footer();

	exit;
}

$mcp_new_token = null;
$mcp_action    = '';

// Changes are accepted from POST only; Cacti's CSRF check has already validated it.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$mcp_posted = get_nfilter_request_var('action');
	$mcp_action = is_string($mcp_posted) ? $mcp_posted : '';
}

if ($mcp_action === 'actions' || $mcp_action === 'apply') {
	try {
		// Cacti's own bulk forms read $_POST the same way; every key is validated by the parser.
		$mcp_parsed = mcp_admin_parse_action($_POST);
	} catch (InvalidArgumentException $error) {
		mcp_admin_error(__('Choose an action.', 'mcp'));
		header('Location: ' . mcp_admin_url('?tab=' . $mcp_tab . '&header=false'));

		exit;
	}
	$mcp_tab = $mcp_parsed['action'] === 'revoke' ? 'tokens' : 'abilities';

	if ($mcp_parsed['ids'] === []) {
		mcp_admin_error(__('Select at least one item.', 'mcp'));
		header('Location: ' . mcp_admin_url('?tab=' . $mcp_tab . '&header=false'));

		exit;
	}

	if ($mcp_action === 'actions') {
		mcp_admin_confirm($mcp_parsed, $mcp_tab);

		exit;
	}

	if ($mcp_parsed['action'] === 'revoke') {
		try {
			// An admin may revoke any token; only tokens that were active are counted and audited.
			$mcp_revoked = mcp_token_revoke_audited(mcp_admin_actor(), $mcp_parsed['ids']);

			if ($mcp_revoked > 0) {
				mcp_admin_info(sprintf(__n('%d token was revoked.', '%d tokens were revoked.', $mcp_revoked, 'mcp'), $mcp_revoked));
			} else {
				mcp_admin_error(__('None of the selected tokens are active.', 'mcp'));
			}
		} catch (McpRevokeAuditError $error) {
			mcp_admin_error(__('The tokens were revoked, but the audit entry could not be written.', 'mcp'));
		} catch (InvalidArgumentException | RuntimeException $error) {
			mcp_admin_error(__('The tokens could not be revoked.', 'mcp'));
		}
	} elseif (mcp_admin_apply_exposure($mcp_parsed)) {
		mcp_admin_info(__('The exposure settings were saved.', 'mcp'));
	}
	header('Location: ' . mcp_admin_url('?tab=' . $mcp_tab . '&header=false'));

	exit;
}

if ($mcp_action === 'create_token') {
	$mcp_tab = 'tokens';

	// The token appears only in this response: never in a URL, redirect, session, log, or message.
	$mcp_new_token = mcp_admin_create_token();

	if ($mcp_new_token !== null) {
		header('Cache-Control: no-store');
	}
}

top_header();
mcp_admin_tabs($mcp_tab);

if ($mcp_tab === 'tokens') {
	mcp_admin_tokens_tab($mcp_new_token);
} elseif ($mcp_tab === 'audit') {
	mcp_admin_audit_tab();
} else {
	mcp_admin_abilities_tab();
}

bottom_footer();
