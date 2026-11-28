<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<!-- translations:start -->
[English](README.md) | [Afrikaans](docs/i18n/af-ZA/README.md) | [አማርኛ](docs/i18n/am-ET/README.md) | [العربية (مصر)](docs/i18n/ar-EG/README.md) | [العربية (المغرب)](docs/i18n/ar-MA/README.md) | [العربية (السعودية)](docs/i18n/ar-SA/README.md) | [বাংলা](docs/i18n/bn-BD/README.md) | [Bosanski](docs/i18n/bs-BA/README.md) | [Deutsch](docs/i18n/de-DE/README.md) | [Español (España)](docs/i18n/es-ES/README.md) | [فارسی](docs/i18n/fa-IR/README.md) | [Filipino](docs/i18n/fil-PH/README.md) | [Français](docs/i18n/fr-FR/README.md) | [Français (Maroc)](docs/i18n/fr-MA/README.md) | [Français (Sénégal)](docs/i18n/fr-SN/README.md) | [Hausa](docs/i18n/ha-NG/README.md) | [עברית](docs/i18n/he-IL/README.md) | [हिन्दी](docs/i18n/hi-IN/README.md) | [Hrvatski](docs/i18n/hr-HR/README.md) | [Bahasa Indonesia](docs/i18n/id-ID/README.md) | [Igbo](docs/i18n/ig-NG/README.md) | [Italiano](docs/i18n/it-IT/README.md) | [日本語](docs/i18n/ja-JP/README.md) | [한국어](docs/i18n/ko-KR/README.md) | [Malagasy](docs/i18n/mg-MG/README.md) | [मराठी](docs/i18n/mr-IN/README.md) | [Bahasa Melayu](docs/i18n/ms-MY/README.md) | [Nederlands](docs/i18n/nl-NL/README.md) | [Polski](docs/i18n/pl-PL/README.md) | [Português (Brasil)](docs/i18n/pt-BR/README.md) | [Русский](docs/i18n/ru-RU/README.md) | [Kinyarwanda](docs/i18n/rw-RW/README.md) | [Soomaali](docs/i18n/so-SO/README.md) | [Српски](docs/i18n/sr-RS/README.md) | [Svenska](docs/i18n/sv-SE/README.md) | [Kiswahili](docs/i18n/sw-KE/README.md) | [தமிழ்](docs/i18n/ta-IN/README.md) | [తెలుగు](docs/i18n/te-IN/README.md) | [ไทย](docs/i18n/th-TH/README.md) | [Türkçe](docs/i18n/tr-TR/README.md) | [Українська](docs/i18n/uk-UA/README.md) | [اردو](docs/i18n/ur-PK/README.md) | [Tiếng Việt](docs/i18n/vi-VN/README.md) | [isiXhosa](docs/i18n/xh-ZA/README.md) | [Yorùbá](docs/i18n/yo-NG/README.md) | [简体中文](docs/i18n/zh-CN/README.md) | [繁體中文](docs/i18n/zh-TW/README.md) | [isiZulu](docs/i18n/zu-ZA/README.md)
<!-- translations:end -->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="images/mcp_logo_dark.png">
		<img src="images/mcp_logo.png" width="360" alt="Cacti MCP: a cactus with a shield. Discover. Authorize. Execute.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="License: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP is a Cacti plugin that lets AI clients read your Cacti data through
named, permission-filtered operations called abilities. It serves them two ways
from the plugin itself: an MCP endpoint (`mcp.php`, Streamable HTTP) and an
AIP-style HTTP API (`api.php`). Cacti stays in charge of authorization and
execution. A client never queries the database; it can only call an ability that
an administrator exposed and that the token owner's Cacti realms allow.

Plugin authors can register their own read-only abilities through the
`abilities_register` hook, and they appear to MCP clients as tools with no
protocol code.

**Status: pre-release, version 0.1.0.** There is no tagged release.

Available today:

- Nine read-only built-in abilities covering system versions, devices, sites,
  pollers, graph trees, graphs, data sources, and a bounded, redacted Cacti log
  tail.
- Personal access tokens (`cmcp_pat_...`) as the only credential.
- The Management > MCP console: expose or hide abilities, create and revoke
  tokens, read the audit log.
- Management > My MCP Tokens: users manage their own tokens, see their activity,
  and see which tools their tokens can use.
- MCP over Streamable HTTP, protocol revisions `2026-07-28` and `2025-11-25`,
  tools only.

Not available yet:

- OAuth 2.1 sign-in. Hosted connectors that cannot send a personal token, such as
  ChatGPT and claude.ai custom connectors, cannot connect until it exists. It is
  planned as Plan 2; that plan is not written yet.
- Write abilities. Only read-only abilities can register.

The design is in the
[endpoint design spec](docs/superpowers/specs/2026-11-19-mcp-endpoint-design.md),
and the build sequence is in [docs/plan.md](docs/plan.md).

## Built-in abilities

| ID | Category | Arguments | Cacti realm needed |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | none | 15 |
| `cacti-list-devices` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | required `name`, such as `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 or 4 |
| `cacti-list-graphs` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 or 5 |
| `cacti-list-data-sources` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | optional `lines` (1 to 200, default 50), `severity`, `search` | 19 or 18 |

Every call also needs the **MCP and Abilities API** realm for the token owner,
the `abilities:read` scope (every personal token has it), and an exposed
ability. The Abilities tab of the console shows the primary realm each built-in
needs.

All six `cacti-list-*` abilities return pages of up to 100 items (default 50)
and a `nextPageToken`. A page token is valid only for the same `filter` and
`orderBy`. `filter` is an AIP-160 expression of comparisons (`=`, `!=`, `<`,
`<=`, `>`, `>=`) joined by `AND`, for example `state = "DOWN" AND disabled = false`.
`orderBy` accepts a comma-separated list of orderable fields, each optionally
followed by `asc` or `desc`.

| Ability | Filter fields | Order fields |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Permission scoping and secret exclusion:

- `cacti-list-devices` and `cacti-get-device` query through Cacti's
  `get_allowed_devices()` and exclude SNMP community strings, passphrases, and
  other credentials.
- `cacti-list-trees` queries through `get_allowed_trees()` (and filters with
  `is_tree_allowed()` when available); `cacti-list-graphs` queries through
  `get_allowed_graphs()` (and filters with `is_graph_allowed()` when available).
- `cacti-list-data-sources` scopes rows to the caller's allowed devices from
  `get_allowed_devices()` (and `is_device_allowed()` when available) and returns
  metadata only without querying `data_input_data` or exposing secret input
  values.
- `cacti-list-pollers` excludes database credentials (`dbpass`, `dbuser`) and
  TLS key and certificate columns (`dbsslkey`, `dbsslcert`, `dbsslca`).
- `cacti-get-clog` reads up to the final 1 MiB of the configured Cacti log
  (truncating individual lines over 2048 bytes), filters by `severity` (`ALL`,
  `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`,
  `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`; default `ALL`) and
  case-insensitive `search` (up to 256 characters), and returns `lines`,
  `count`, and `truncated`. Each line is redacted for personal tokens,
  bearer/basic headers, passwords, secrets, SNMP communities, keys, `dbpass`,
  `dbsslkey`, and URL userinfo before `severity` and `search` filters run so
  `search` cannot act as a secret oracle. Redaction fails closed with
  `[redacted]`, and an unreadable log returns `FAILED_PRECONDITION`
  (`LOG_UNAVAILABLE`).

## Install

Requires Cacti 1.2.31 or later, PHP 8.2 or later, and the main poller. Cacti
authentication must be enabled; the plugin refuses to authenticate when it is off.

The plugin directory must be named `mcp`, not `plugin_mcp`. The plugin slug, realm names,
translation domain, and URLs all use `mcp`.

From a source checkout:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Until tagged releases exist, you can instead download the `mcp-plugin`
artifact from a successful
[CI run](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
It contains `mcp.tar.gz` and `SHA256SUMS`. Verify the checksum, then extract
`mcp.tar.gz` inside Cacti's `plugins/` directory so the result is `plugins/mcp/`.
GitHub's automatic source archives use a different top-level directory name. The
archive leaves out `docs/` (including the screenshots below), `tests/`, and
`.github/`, so the README links into `docs/` work on GitHub but not in an installed
copy.

Then:

1. In Plugin Management, install and enable **Cacti MCP**. The installing
   administrator receives the **MCP Administration** realm automatically.
2. Under Settings > MCP, set **Public Cacti URL** to the address clients use, for
   example `https://cacti.example.com/cacti`. HTTPS is required except for
   `localhost`, `127.0.0.1`, and `[::1]`. Until this is set, `mcp.php` answers HTTP 400
   with a JSON-RPC error whose `data` is `FAILED_PRECONDITION` and
   `PUBLIC_URL_REQUIRED`. `api.php` does not read it.

   ![Settings > MCP showing the Public Cacti URL field](docs/images/settings-public-url.png)

3. Grant the **MCP and Abilities API** realm to each user who will own a token.
   No user receives it automatically.
4. Make sure the web server passes the `Authorization` header and path info to PHP
   (see below).
5. Open Management > MCP and expose the abilities you want clients to see.

**Upgrading from a development build.** The plugin is pre-release, and its tables
changed during development without migrations. If you installed an earlier
build, uninstall it and install again. Reinstalling keeps tables that already
exist, so drop the old `plugin_mcp_token`, `plugin_mcp_audit`, and
`plugin_mcp_ability` tables first (and the equivalent tables from
builds made before the rename). Back them up if you need their history; tokens from
those builds are revoked on uninstall and do not carry over.

### Web server

Apache setups that strip `Authorization` before PHP need this in the relevant
virtual host or directory, followed by a reload:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache with `mod_php` served `api.php` routes with no extra path configuration.

`api.php` routes live in the path after the script name
(`/plugins/mcp/api.php/v1/abilities`), so nginx must match URIs where `.php` is
followed by more path, split off the path info, and pass it to PHP. A
`location ~ \.php$` block never matches these URLs; nginx answers with its own
HTML 404. The location pattern and the two path-info lines below were verified with
PHP-FPM; the other lines are standard boilerplate:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Adjust the `include` and `fastcgi_pass` lines to match the block that already serves
Cacti. Do not add `try_files $fastcgi_script_name =404;` to this block: it clears
`$fastcgi_path_info`, and `api.php` then answers 404 `UNKNOWN_PATH`. If your
configuration needs `try_files`, save the value first with
`set $path_info $fastcgi_path_info;` and pass `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` has no path routes and does not need them.

## Console

Management > MCP has three tabs. You need the **MCP Administration** realm.
Screenshots here and below are from a Cacti development build with example data.

- **Abilities** lists every registered ability with its plugin, category, the
  realm it needs, and whether it is exposed. Select rows and choose Expose or
  Hide; you confirm before the change applies. Built-in `cacti-*` abilities are
  exposed by default. Abilities from other plugins start hidden, so installing a
  plugin never publishes anything until an administrator decides to. Exposure
  narrows access only: a user still needs the ability's realm.

  ![Abilities tab listing the built-in abilities with their realms and exposure state](docs/images/console-abilities.png)
- **Tokens** lists tokens with owner, creator, creation, expiry, last use, and
  state (Active, Expired, Revoked). Select rows and choose Revoke to revoke them.
  Revoked tokens cannot be used again. Create Token makes a new one.

  ![Tokens tab listing tokens with owner, expiry, last use, and state, above the Create Token form](docs/images/console-tokens.png)
- **Audit** lists audit rows, newest first, and filters by user, ability, and
  outcome.

  ![Audit tab listing calls with user, token, ability, and outcome, with filters](docs/images/console-audit.png)

## Tokens

A personal token reads Cacti as its owner. It has the form `cmcp_pat_` followed by
64 lowercase hex characters and carries the single scope `abilities:read`. What it
can see is decided by its owner's Cacti realms and device permissions, not by the
token. The owner must be an enabled user who holds the **MCP and Abilities API**
realm.

Tokens are always created for a user, expire, and can be revoked:

- **Console.** Management > MCP > Tokens > Create Token. Lifetime is 1 to 365 days
  and defaults to 90. The token is generated by the server and shown once on the
  response page, so copy it into your secret manager immediately. You can create a
  token for yourself. Creating one for another user also needs the Users/Groups
  realm, because the token reads Cacti as that user.
- **My MCP Tokens.** Any user with the MCP and Abilities API realm can manage their own
  tokens; see below.
- **Command line.** `tokens.php` runs only from the CLI, as an OS account that can
  administer Cacti. It takes the token from the environment so the value never
  appears on a command line or in the process list. Lifetime is 1 to 365 days and
  defaults to 30. Creating and revoking a token through the CLI is audited like the
  console, with the token's owner as the actor because the CLI has no Cacti user, so
  the audit row does not mark the action as coming from the CLI. `--list` prints
  every token as JSON (ID, owner, scopes, timestamps, revoked flag) and never the
  token value; `--help` shows usage.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokens cannot be created for the guest account, for disabled users, or for users
without the **MCP and Abilities API** realm, from the console, the command line, or
My MCP Tokens. Cacti stores the guest setting as a username or a user ID, and the
plugin resolves both. A token whose owner becomes the guest account stops working on
its next request.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) needs no administration
realm: it is covered by the **MCP and Abilities API** realm, and the menu entry
appears only for users who hold it. The page always acts on the signed-in user.
Cacti's menu is part of the console, so a user without console access reaches the
page by its address.

![My Tokens tab listing the signed-in user's tokens and the create form](docs/images/my-tokens.png)

- **Tokens** lists your tokens, creates one (1 to 365 days, default 90, shown once
  in the response), and revokes your own. You cannot see or revoke anyone else's.
- **Activity** lists the actions you performed, newest first: calls made with your
  tokens and token changes you made.
- **Available Tools** lists the abilities a token of yours can use right now, with
  each ability's ID, name, and description. It follows your Cacti permissions and
  the exposure settings an administrator chose.

  ![Available Tools list showing each ability's ID, name, and description](docs/images/my-tools.png)

An installation made before this page existed has a realm file list without
`mcp_tokens.php`. Install registers the list; it is not updated by enabling or
disabling the plugin. Uninstall and install the plugin again, then grant the realms
again, because Cacti removes realm grants when a plugin is uninstalled.

The database stores only the SHA-256 hash of the token, so a lost token cannot be
recovered; revoke it and create another. Rotation is the same: create a new token,
switch the client, then revoke the old one. An expired token, a revoked token, a
disabled owner, or a lost realm each fail on the next request. Tokens are accepted
only in the `Authorization: Bearer` header; a token in the query string or body is
not accepted.

## Connect a client

Use the MCP endpoint `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, with the
token in an `Authorization: Bearer` header. Keep the token in an environment
variable or secret manager and reference it from client configuration instead of
writing its value into a file.

### Claude Code

Put the endpoint in a project `.mcp.json` that references the token by name.
Claude Code expands `${VAR}` in `url` and `headers`, so the file holds no secret and
is safe to commit. Export `CACTI_MCP_TOKEN` in the environment that starts Claude Code.

```json
{
  "mcpServers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${CACTI_MCP_TOKEN}"
      }
    }
  }
}
```

You can also add it from the command line:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

With double quotes, your shell expands `$CACTI_MCP_TOKEN` first, so the token value
is written into the config file for the chosen `--scope` (`local`, `user`, or
`project`; default `local`). Do not use that form with `--scope project`, and keep
the file out of version control. Prefer the `.mcp.json` reference above. Claude Code
reads some credential variables (such as `ANTHROPIC_AUTH_TOKEN`) as empty in remote
`url` and `headers`; `CACTI_MCP_TOKEN` is not one of them. Source:
[Claude Code MCP documentation](https://code.claude.com/docs/en/mcp).

### GitHub Copilot in VS Code

Use a workspace-root `.mcp.json` (or the user file `~/.copilot/mcp-config.json`).
These Copilot-native files use a top-level `mcpServers` object and `${NAME}`
environment-variable references in header values:

```json
{
  "mcpServers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${CACTI_MCP_TOKEN}"
      }
    }
  }
}
```

Export `CACTI_MCP_TOKEN` in the environment that starts VS Code. Native Copilot
files do not support `inputs` prompts. VS Code's guided setup rejects `${...}`
values, so add the `Authorization` header by editing the file, not through the
guided flow. Guided setup offers the workspace-root file
only when the experimental `chat.mcp.workspaceRootConfig.enabled` setting is on. See the
[VS Code MCP configuration reference](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Legacy: `.vscode/mcp.json`.** VS Code says new Copilot configurations should not
use `.vscode/mcp.json` or the profile `mcp.json`; they belong to the deprecated
Local harness, which will be removed in February 2027. If you still use it, the
editor-managed format takes a top-level `servers` key and can prompt for the token:

```json
{
  "inputs": [
    {
      "type": "promptString",
      "id": "cacti-mcp-token",
      "description": "Cacti MCP token",
      "password": true
    }
  ],
  "servers": {
    "cacti": {
      "type": "http",
      "url": "https://cacti.example.com/cacti/plugins/mcp/mcp.php",
      "headers": {
        "Authorization": "Bearer ${input:cacti-mcp-token}"
      }
    }
  }
}
```

### Clients that only speak stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) is an optional adapter
that runs as a local stdio MCP server and calls the plugin's HTTP API. Use it for a
client that cannot connect to a remote HTTP server. It needs the same personal
token and talks to `api.php`.

### MCP behavior

The endpoint serves tools only: each exposed, permitted ability is a tool named by
its ID, with its input and output schemas and read-only annotations
(`openWorldHint` is `false`). It handles `initialize`, `server/discover`, `ping`,
`tools/list`, and `tools/call`. It keeps no session, does not send `Mcp-Session-Id`
(and ignores one it receives), and does not accept JSON-RPC batches. A message
without an `id` is a notification and gets HTTP 202 with no body. Only `POST` is
allowed.

- **Revisions.** A request that carries `io.modelcontextprotocol/protocolVersion` in
  `params._meta` must name `2026-07-28`; anything else gets error `-32022`. Such
  requests must also carry matching `Mcp-Protocol-Version`, `Mcp-Method`, and (for
  `tools/call`) `Mcp-Name` headers, or the answer is error `-32020`. Other requests
  are treated as `2025-11-25`: `initialize` answers with that revision, and on any
  other method an `Mcp-Protocol-Version` header, if sent, must be `2025-11-25`,
  `2025-06-18`, or `2025-03-26`.
- **Tool errors.** An ability error, including arguments that do not match the
  schema or an `arguments` value that is not a JSON object, comes back as a tool
  result with `isError: true` and the AIP-193 error in `structuredContent`, not as a
  protocol error.
- **Protocol errors.** Failures that are not tool errors are JSON-RPC error objects
  (code `-32000` with the status and reason in `data`, or the standard codes): the
  missing Public Cacti URL, a refused `Origin`, a request with the plugin disabled
  or on a remote poller, and unexpected server errors (`-32603`, with the detail
  written to the Cacti log, not the response). Request checks that run first (405,
  413, 415) and authentication failures (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  keep the AIP-193 body described under HTTP API.

## HTTP API

Base URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. The contract is
in [openapi.json](openapi.json).

| Method and path | Purpose |
| --- | --- |
| `GET /v1/abilities` | List permitted abilities. Query: `pageSize`, `pageToken`, and `filter` of the form `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Read one ability. |
| `POST /v1/abilities/{id}:execute` | Run it. The body is exactly `{"arguments": {...}}`. The response is `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Errors follow AIP-193: an `error` object with `code`, `message`, `status`, and
`details` that carries an `ErrorInfo` with domain `cacti.net` and a stable `reason`.
Argument problems add a `BadRequest` detail naming the field. Request bodies are
limited to 64 KB, and results to 1 MB. Both endpoints answer only on the main
poller and return `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) when the plugin is disabled
or the server is not the main poller.

| HTTP | `reason` values |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (also sends `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (sends `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Write an ability (plugin authors)

An enabled Cacti plugin registers abilities from a function it attaches to the
`abilities_register` hook, usually in its `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

The function receives an `AbilitiesRegistrar` scoped to the plugin. Its return
value is ignored.

```php
function acme_abilities_register(AbilitiesRegistrar $registrar) : void {
	$registrar->registerCategory('acme-widgets', 'Widgets');

	$registrar->register('acme-get-widget-count', [
		'label'         => 'Get widget count',
		'description'   => 'Count the widgets the caller may see.',
		'category'      => 'acme-widgets',
		'input_schema'  => ['type' => 'object', 'properties' => new stdClass(), 'additionalProperties' => false],
		'output_schema' => [
			'type'                 => 'object',
			'properties'           => ['count' => ['type' => 'integer', 'minimum' => 0]],
			'required'             => ['count'],
			'additionalProperties' => false
		],
		'annotations' => ['readOnly' => true, 'destructive' => false, 'idempotent' => true],
		'permission'  => fn (int $userId) => is_realm_allowed(ACME_REALM_ID, $userId),
		'execute'     => fn (int $userId, stdClass $args) => ['count' => acme_count_widgets($userId)]
	]);
}
```

The rules, all enforced at registration:

- **IDs.** An ID matches `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, is at most 64
  characters, and must start with the plugin's slug and a hyphen: `acme-` above.
  The slug is the plugin directory name, so a directory such as `my_plugin` cannot
  register anything. A plugin directory named `cacti` is refused; that
  namespace belongs to the built-ins.
- **Definition.** Exactly these keys: `label`, `description` (up to 4096 bytes),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. The category must already exist: use a built-in (`inventory`,
  `system`) or register your own with `registerCategory()`, whose ID is unique across
  all plugins and matches `^[a-z][a-z0-9-]{0,31}$`.
- **Read-only only.** `annotations` must be exactly `readOnly: true`,
  `destructive: false`, `idempotent: true`. Anything else throws.
- **Schemas.** `input_schema` and `output_schema` must each have top-level
  `type` `object`. The dialect is small and fails closed. Objects must be closed
  (`additionalProperties: false`, with `properties` present); other types are
  `integer` and `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, and `array` (which needs `items` and
  `maxItems`). A type may be
  made nullable as `['string', 'null']`. Argument strings default to at most
  4096 characters; result strings are limited only by a declared `maxLength`
  and the result size limit. At most 256 abilities can register.
- **`permission(int $userId): bool`.** Must return exactly `true` to allow. The
  user ID is the token owner's; never read session state.
- **`execute(int $userId, stdClass $args): array`.** `$args` is already validated
  against `input_schema`. Enforce object-level permissions yourself. Return an
  associative array that matches `output_schema` exactly; a list, an extra field,
  or more than 1 MB of JSON becomes an `INVALID_RESULT` error. Throw
  `AbilitiesError` for a client-visible failure, such as `NOT_FOUND`.
- **Empty objects.** PHP encodes `[]` as a JSON array. Wherever the output schema
  declares an `object`, at any depth, the registry treats `[]` as the empty object
  and sends `{}`; `new stdClass()` works too. A non-empty list never counts as an
  object and fails with `INVALID_RESULT`. An empty `properties` map in a schema
  may be `[]` or `new stdClass()`; both are published as `{}`.
- **Failure isolation.** Each plugin registers into a scratch copy that is kept
  only if your function returns normally. If it throws, none of your abilities
  register, and the failure is logged.

Abilities from plugins start hidden. The administrator exposes them on the
console Abilities tab, and the Required Realm column reads "Set by the plugin"
for them.

## Security model

- **Bearer only.** `api.php` and `mcp.php` accept a personal token in the
  `Authorization` header and nothing else. They drop cookies, `$_POST`, and
  `$_REQUEST` before Cacti loads and destroy the session Cacti starts, so a browser
  login never grants API access.
- **CSRF workaround.** Cacti's CSRF guard rejects a JSON POST that has no Cacti CSRF
  token, which no MCP client can send. For these two endpoints only, the plugin
  renames the request method before Cacti loads and restores it afterward, so the
  guard skips them. This is safe because CSRF protects requests a browser
  authenticates with cookies, and these endpoints accept no cookie identity: a
  cross-site page cannot attach the bearer token. Console pages keep full CSRF
  protection. The workaround is temporary, until Cacti offers a supported
  exemption; see `lib/bootstrap.php`.
- **Origin check.** On `mcp.php`, if the request has an `Origin` header it must be
  exactly the scheme, host, and port of the Public Cacti URL, or the request is
  refused with `ORIGIN_NOT_ALLOWED`. A request with no `Origin` header, which is how
  non-browser clients connect, is allowed. This stops a web page from driving the
  endpoint from a visitor's browser. `api.php` does not apply this check.
- **Read-only only.** Registration rejects any ability that is not read-only,
  non-destructive, and idempotent.
- **Exposure and realms both apply.** An ability must be exposed and the token
  owner must hold its realm. If the exposure table cannot be read, every ability is
  hidden rather than falling back to defaults.
- **Hidden, unknown, and unpermitted look the same.** A client cannot tell an
  ability that does not exist from one that is hidden or that its user may not
  use: discovery omits it and execution returns `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Tokens.** Stored as SHA-256 hashes, shown once, always expiring, revocable, and
  rejected when the owner is disabled or loses the realm.
- **Audit.** `plugin_mcp_audit` records request ID, token ID, user ID, ability,
  outcome (`started`, `succeeded`, `failed`, `denied`, `rejected`), and timestamps.
  It never records arguments, results, or token values. An ability runs only after
  its `started` row is written; if the audit table is unavailable the call fails
  with `UNAVAILABLE` and does not run. A call refused before it runs is one row: `denied`
  for an unknown, hidden, or unpermitted ability, `rejected` for arguments that fail the
  schema. Token creation and revocation from the console, My MCP Tokens, and the CLI are
  recorded as `mcp-token-create` and `mcp-token-revoke` with outcome `succeeded`, and a
  revocation is recorded only for a token that was active. Discovery, and a call whose
  `arguments` is not a JSON object, are not logged.
- **Failure log.** An unexpected failure, `INVALID_RESULT`, or an unavailable audit
  table writes one line to the Cacti log with facility `MCP`: the ability ID, a fixed
  reason, and the exception class. Messages, arguments, and tokens are never logged.
- **Main poller only.** Both endpoints, both console pages, and `tokens.php` refuse to
  act anywhere else.

## Lifecycle

Disabling the plugin blocks both endpoints. Uninstalling revokes every token and
keeps the three tables (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) for retention; reinstalling does not reactivate a revoked
token. Back up the tables with the Cacti database and apply an audit retention
policy outside the plugin.

## Development and tests

The test suite includes plain PHP scripts in `tests/` plus PHPUnit unit tests
in `tests/Unit/` and PHPStan static analysis (level 6), all running without a
Cacti installation:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI runs on PHP 8.2 through 8.5: a `test` job that lints PHP syntax (`php -l`)
and runs the 13 plain PHP test scripts listed in `.github/workflows/ci.yml`, a
`quality` job that runs `composer phpstan` and `composer test`, and a `package`
job that builds the installable `mcp/` archive (excluding development and test
files listed in `.gitattributes`) and its `SHA256SUMS`. Tests that touch Cacti
use fixtures at the Cacti helper boundary; they do not exercise a full Cacti
install.

### Integration tests

`tests/integration/run.sh 1.2.31` or `tests/integration/run.sh develop` installs the
plugin into a real Cacti in containers and runs live checks against it. It needs Docker
with Compose v2.23.1 or later, git and openssl. `KEEP=1` leaves the stack running for debugging. CI runs it
nightly and on demand, not on pull requests.

## Localization

Cacti MCP ships compiled GNU gettext catalogs under `locales/po/` and `locales/LC_MESSAGES/`
and localized READMEs under `docs/i18n/` for English plus 47 locales (19 Broad Tier 1,
15 African, 10 Asian, plus Bosnian, Croatian, and Serbian locales), using the `mcp` text domain (`locales/po/mcp.pot`).
Cacti loads the matching catalog automatically when language support is enabled.

## Contributing

Pull requests go to `develop`. Keep production code compatible with PHP 8.2 and
use Cacti's style: tabs, single-quoted strings, and Cacti's database and
permission helpers. Add tests for changed validation, authorization, or protocol
behavior, and sign off commits with `git commit -s`. Coordinate changes to the HTTP
API with [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## License

Copyright (C) 2026 Thomas Vincent. Released under the GNU General Public
License, version 2 or later. See [LICENSE](LICENSE).
