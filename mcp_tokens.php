<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/* My MCP Tokens: every user with the MCP and Abilities API realm manages their own personal
 * tokens here. All three sections act on the signed-in user and nobody else: the owner is
 * read from the session, never from the request. Cacti's CSRF protection covers every POST;
 * state changes are accepted from POST only. */

include('../../include/auth.php');

require_once __DIR__ . '/lib/providers.php';
require_once __DIR__ . '/lib/admin.php';

/**
 * Cacti-relative URL of this page, for forms, links, and redirects.
 *
 * @param string $query Optional query string suffix starting with '?'.
 * @return string Relative self-service page URL.
 */
function mcp_self_url(string $query = '') : string {
	global $config;

	return $config['url_path'] . 'plugins/mcp/mcp_tokens.php' . $query;
}

/**
 * Return the signed-in user ID from the active Cacti session.
 *
 * @return int User ID or 0 when unauthenticated.
 */
function mcp_self_user() : int {
	return (int) ($_SESSION['sess_user_id'] ?? 0);
}

/**
 * Queue a Cacti error banner message for the self-service token page.
 *
 * @param string $text Localized error text.
 * @return void
 */
function mcp_self_error(string $text) : void {
	raise_message('mcp_error', $text, MESSAGE_LEVEL_ERROR);
}

/**
 * Queue a Cacti info banner message for the self-service token page.
 *
 * @param string $text Localized informational text.
 * @return void
 */
function mcp_self_info(string $text) : void {
	raise_message('mcp_info', $text, MESSAGE_LEVEL_INFO);
}

/**
 * Render an inline notice box on the self-service token page.
 *
 * @param string $text Localized notice text.
 * @return void
 */
function mcp_self_notice(string $text) : void {
	html_start_box('', '100%', '', '3', 'center', '');
	print "<tr class='odd'><td><span class='deviceDown'>" . html_escape($text) . '</span></td></tr>';
	html_end_box();
}

/**
 * Format a Unix timestamp for display in self-service tables.
 *
 * @param mixed $value Unix timestamp or empty/zero value.
 * @return string Formatted date string or '-'.
 */
function mcp_self_time(mixed $value) : string {
	return (int) $value > 0 ? date('Y-m-d H:i:s', (int) $value) : '-';
}

/**
 * Render the self-service tab bar for Tokens, Activity, and Available Tools.
 *
 * @param string $current Active tab slug.
 * @return void
 */
function mcp_self_tabs(string $current) : void {
	$labels = ['tokens' => __('Tokens', 'mcp'), 'activity' => __('Activity', 'mcp'), 'tools' => __('Available Tools', 'mcp')];

	print "<div class='tabs'><nav class='scrollable'><ul class='tabs'>";

	foreach ($labels as $tab => $label) {
		print "<li class='subTab'><a class='tab" . ($tab === $current ? ' selected' : '') . "' href='" . html_escape(mcp_self_url('?tab=' . $tab)) . "'>" . html_escape($label) . '</a></li>';
	}
	print '</ul></nav></div>';
}

/**
 * Rows per page from Cacti's setting or the filter, kept within what the storage helpers accept.
 *
 * @return int Bounded row count per page.
 */
function mcp_self_rows() : int {
	$rows = get_request_var('rows') == '-1' ? (int) read_config_option('num_rows_table') : (int) get_request_var('rows');

	return $rows >= 1 && $rows <= 500 ? $rows : 30;
}

/**
 * Build Cacti request-filter definitions for self-service table pagination.
 *
 * @return array<string, mixed> Pagination filter definitions.
 */
function mcp_self_paging_filters() : array {
	return [
		'rows' => ['filter' => FILTER_VALIDATE_INT, 'pageset' => true, 'default' => '-1'],
		'page' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['options' => ['min_range' => 1, 'max_range' => MCP_MAX_PAGE]], 'default' => '1']
	];
}

/**
 * Whether the signed-in user may hold a token, from the same rules the storage layer enforces.
 *
 * @return bool True when the signed-in user is eligible to create tokens.
 */
function mcp_self_eligible() : bool {
	try {
		mcp_token_assert_eligible(mcp_self_user());
	} catch (InvalidArgumentException $error) {
		return false;
	}

	return true;
}

/**
 * Create a token for the signed-in user. Returns it once, or null with a message raised.
 *
 * @return ?string Newly created token string or null on failure.
 */
function mcp_self_create_token() : ?string {
	$days = get_filter_request_var('days', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 365]]);

	if (!is_int($days)) {
		mcp_self_error(__('Choose an expiry of 1 to 365 days.', 'mcp'));

		return null;
	}

	// One submission per issued form, so reloading the response cannot mint a second token.
	$given = get_nfilter_request_var('mcp_nonce');

	if (!is_string($given) || !mcp_with_session(fn (array &$session) => mcp_admin_nonce_consume($session, $given))) {
		mcp_self_error(__('This form was already submitted.', 'mcp'));

		return null;
	}

	try {
		return mcp_token_create_audited(mcp_self_user(), $days, mcp_self_user());
	} catch (InvalidArgumentException $error) {
		mcp_self_error(mcp_token_ineligible_text());
	} catch (RuntimeException $error) {
		mcp_self_error(__('The token could not be created.', 'mcp'));
	}

	return null;
}

/**
 * Render the My Tokens self-service tab and token creation form.
 *
 * @param ?string $newToken Newly created token to display once, or null.
 * @return void
 */
function mcp_self_tokens_tab(?string $newToken) : void {
	validate_store_request_vars(mcp_self_paging_filters(), 'sess_mcp_mine_tokens');
	$rows = mcp_self_rows();
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
		$list = mcp_token_list(['user_id' => mcp_self_user()], $page, $rows);
	} catch (RuntimeException $error) {
		mcp_self_notice(__('The token list could not be read.', 'mcp'));
		$list = ['rows' => [], 'total' => 0];
	}
	$now = time();

	print html_nav_bar(mcp_self_url('?tab=tokens'), MAX_DISPLAY_PAGES, $page, $rows, $list['total'], 6, __('Tokens', 'mcp'), 'page', 'main');

	html_start_box(__('My Tokens', 'mcp'), '100%', '', '3', 'center', '');
	html_header([__('ID', 'mcp'), __('Created', 'mcp'), __('Expires', 'mcp'), __('Last Used', 'mcp'), __('State', 'mcp'), __('Revoke', 'mcp')]);

	if ($list['rows'] === []) {
		print "<tr class='tableRow'><td colspan='6'><em>" . html_escape(__('You have no tokens', 'mcp')) . '</em></td></tr>';
	}

	foreach ($list['rows'] as $i => $row) {
		$revoked = (int) $row['revoked'] === 1;
		$id      = (int) $row['id'];
		$active  = !$revoked && (int) $row['expires_at'] > $now;

		if ($revoked) {
			$state = __('Revoked', 'mcp');
		} elseif (!$active) {
			$state = __('Expired', 'mcp');
		} else {
			$state = __('Active', 'mcp');
		}
		form_alternate_row('line' . $i, false, $revoked);
		form_selectable_cell(html_escape((string) $id), $id);
		form_selectable_cell(html_escape(mcp_self_time($row['created_at'])), $id);
		form_selectable_cell(html_escape(mcp_self_time($row['expires_at'])), $id);
		form_selectable_cell(html_escape(mcp_self_time($row['last_used_at'])), $id);
		form_selectable_cell(html_escape($state), $id);
		form_selectable_cell($revoked ? '' : "<form action='" . html_escape(mcp_self_url()) . "' method='post'>"
			. "<input type='hidden' name='action' value='revoke'><input type='hidden' name='id' value='" . $id . "'>"
			. "<input type='submit' class='ui-button ui-corner-all ui-widget' value='" . html_escape(__('Revoke', 'mcp')) . "'></form>", $id);
		form_end_row();
	}
	html_end_box();

	if (!mcp_self_eligible()) {
		mcp_self_notice(mcp_token_ineligible_text());

		return;
	}
	$nonce = mcp_with_session(fn (array &$session) => mcp_admin_nonce_issue($session));

	html_start_box(__('Create Token', 'mcp'), '100%', '', '3', 'center', '');
	print "<tr class='odd'><td><form id='mcp_create_token' action='" . html_escape(mcp_self_url()) . "' method='post'><table class='filterTable'><tr><td>"
		. html_escape(__('Expires in days', 'mcp')) . "</td><td><input type='text' class='ui-state-default ui-corner-all' id='days' name='days' size='5' maxlength='3' value='90'></td>"
		. "<td><input type='hidden' name='action' value='create_token'><input type='hidden' name='mcp_nonce' value='" . html_escape($nonce) . "'><input type='submit' class='ui-button ui-corner-all ui-widget' value='" . html_escape(__('Create', 'mcp')) . "'></td></tr></table></form></td></tr>";
	html_end_box();
}

/**
 * Render the My Activity self-service audit log tab.
 *
 * @return void
 */
function mcp_self_activity_tab() : void {
	validate_store_request_vars(mcp_self_paging_filters(), 'sess_mcp_mine_activity');
	$rows = mcp_self_rows();
	$page = (int) get_request_var('page');

	try {
		// The user is forced to the session user; a user_id in the request is never read.
		$list = mcp_audit_list(['user_id' => mcp_self_user()], $page, $rows);
	} catch (InvalidArgumentException | RuntimeException $error) {
		mcp_self_notice(__('Your activity could not be read.', 'mcp'));
		$list = ['rows' => [], 'total' => 0];
	}

	print html_nav_bar(mcp_self_url('?tab=activity'), MAX_DISPLAY_PAGES, $page, $rows, $list['total'], 5, __('Entries', 'mcp'), 'page', 'main');

	html_start_box(__('My Activity', 'mcp'), '100%', '', '3', 'center', '');
	html_header([__('Started', 'mcp'), __('Token', 'mcp'), __('Ability', 'mcp'), __('Outcome', 'mcp'), __('Finished', 'mcp')]);

	if ($list['rows'] === []) {
		print "<tr class='tableRow'><td colspan='5'><em>" . html_escape(__('No activity found', 'mcp')) . '</em></td></tr>';
	}

	foreach ($list['rows'] as $i => $row) {
		form_alternate_row('line' . $i, false);
		form_selectable_cell(html_escape(mcp_self_time($row['started_at'])), $i);
		form_selectable_cell(html_escape('#' . $row['token_id']), $i);
		form_selectable_cell(html_escape((string) $row['ability']), $i);
		form_selectable_cell(html_escape((string) $row['outcome']), $i);
		form_selectable_cell(html_escape(mcp_self_time($row['finished_at'])), $i);
		form_end_row();
	}
	html_end_box();
}

/**
 * Render the Available Tools self-service discovery tab.
 *
 * @return void
 */
function mcp_self_tools_tab() : void {
	try {
		$tools = mcp_available_tools(mcp_registry(), mcp_self_user());
	} catch (Throwable $error) {
		// A plugin permission callback can throw; keep the detail off the page.
		mcp_self_notice(__('The available tools could not be listed.', 'mcp'));
		$tools = [];
	}

	html_start_box(__('Available Tools', 'mcp'), '100%', '', '3', 'center', '');
	print "<tr class='odd'><td>" . html_escape(__('These are the read-only abilities a token of yours can use today. Your Cacti permissions and the administrator\'s exposure settings decide the list.', 'mcp')) . '</td></tr>';
	html_end_box();

	html_start_box('', '100%', '', '3', 'center', '');
	html_header([__('Ability', 'mcp'), __('Name', 'mcp'), __('Description', 'mcp')]);

	if ($tools === []) {
		print "<tr class='tableRow'><td colspan='3'><em>" . html_escape(__('No abilities are available to you', 'mcp')) . '</em></td></tr>';
	}

	foreach ($tools as $i => $tool) {
		form_alternate_row('line' . $i, false);
		form_selectable_cell(html_escape($tool['id']), $i);
		form_selectable_cell(html_escape($tool['label']), $i);
		form_selectable_cell(html_escape($tool['description']), $i);
		form_end_row();
	}
	html_end_box();
}

/* ================= request handling ================= */

$mcp_tab = get_filter_request_var('tab', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(tokens|activity|tools)$/']]);
$mcp_tab = is_string($mcp_tab) && $mcp_tab !== '' ? $mcp_tab : 'tokens';

// Every section is scoped to the signed-in user. With Cacti authentication off there is no such
// user, so nothing here runs.
if ((int) read_config_option('auth_method', true) === 0 || mcp_self_user() < 1) {
	top_header();
	mcp_self_notice(__('MCP tokens need a signed-in Cacti user.', 'mcp'));
	bottom_footer();

	exit;
}

if ((int) $config['poller_id'] !== 1) {
	top_header();
	mcp_self_notice(__('MCP tokens are available on the main poller only.', 'mcp'));
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

if ($mcp_action === 'revoke') {
	$mcp_id = get_filter_request_var('id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

	if (!is_int($mcp_id)) {
		mcp_self_error(__('Choose a token to revoke.', 'mcp'));
	} else {
		try {
			// Only the signed-in user's own tokens change; any other ID is ignored.
			if (mcp_self_revoke(mcp_self_user(), [$mcp_id]) === 1) {
				mcp_self_info(__('The token was revoked.', 'mcp'));
			} else {
				mcp_self_error(__('That token is not one of your active tokens.', 'mcp'));
			}
		} catch (McpRevokeAuditError $error) {
			mcp_self_error(__('The tokens were revoked, but the audit entry could not be written.', 'mcp'));
		} catch (InvalidArgumentException | RuntimeException $error) {
			mcp_self_error(__('The token could not be revoked.', 'mcp'));
		}
	}
	header('Location: ' . mcp_self_url('?tab=tokens&header=false'));

	exit;
}

if ($mcp_action === 'create_token') {
	$mcp_tab = 'tokens';

	// The token appears only in this response: never in a URL, redirect, session, log, or message.
	$mcp_new_token = mcp_self_create_token();

	if ($mcp_new_token !== null) {
		header('Cache-Control: no-store');
	}
}

top_header();
mcp_self_tabs($mcp_tab);

if ($mcp_tab === 'activity') {
	mcp_self_activity_tab();
} elseif ($mcp_tab === 'tools') {
	mcp_self_tools_tab();
} else {
	mcp_self_tokens_tab($mcp_new_token);
}

bottom_footer();
