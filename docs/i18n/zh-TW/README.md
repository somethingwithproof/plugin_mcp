<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP：一株帶著盾牌的仙人掌。探索、授權、執行。">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="授權條款：GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP 是一款 Cacti 外掛程式，可讓 AI 用戶端透過具名且經權限過濾的操作（稱為「能力（abilities）」）來讀取您的 Cacti 資料。它直接從外掛程式本身以兩種方式提供服務：MCP 端點（`mcp.php`，Streamable HTTP）以及 AIP 風格的 HTTP API（`api.php`）。授權與執行仍由 Cacti 全權負責。用戶端永遠不會直接查詢資料庫；它只能呼叫管理員已公開且權杖擁有者的 Cacti 權限領域所允許的能力。

外掛程式作者可透過 `abilities_register` 掛鉤註冊自己的唯讀能力，這些能力無需任何通訊協定程式碼，即可在 MCP 用戶端中顯示為工具。

**狀態：預先發行版，版本 0.1.0。** 目前尚無正式標記的發行版本。

目前已提供：

- 九項內建唯讀能力，涵蓋系統版本、裝置、站台、輪詢器、圖形樹、圖形、資料來源，以及受限且經過遮罩處理的 Cacti 日誌尾端內容。
- 以個人存取權杖（`cmcp_pat_...`）作為唯一的驗證憑證。
- Management > MCP 主控台：公開或隱藏能力、建立與撤銷權杖，以及檢視稽核日誌。
- Management > My MCP Tokens：使用者可管理自己的權杖、檢視活動紀錄，以及查看其權杖可使用的工具。
- 透過 Streamable HTTP 提供 MCP 服務，支援通訊協定修訂版 `2026-07-28` 與 `2025-11-25`，僅支援工具。

尚未提供：

- OAuth 2.1 登入。無法傳送個人權杖的託管式連接器（例如 ChatGPT 與 claude.ai 自訂連接器）在實作完成前尚無法連線。此功能規劃為 Plan 2；該計畫尚未撰寫。
- 寫入能力。目前僅能註冊唯讀能力。

設計細節請參閱[端點設計規格](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)，建置順序請參閱 [docs/plan.md](../../plan.md)。

## 內建能力

| ID | 分類 | 參數 | 所需的 Cacti 權限領域 |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | 無 | 15 |
| `cacti-list-devices` | `inventory` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-get-device` | `inventory` | 必填 `name`，例如 `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-list-pollers` | `system` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 15 |
| `cacti-list-trees` | `inventory` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 7 或 4 |
| `cacti-list-graphs` | `inventory` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 7 或 5 |
| `cacti-list-data-sources` | `inventory` | 選填 `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-get-clog` | `system` | 選填 `lines`（1 至 200，預設為 50）、`severity`、`search` | 19 或 18 |

每次呼叫也必須符合以下條件：權杖擁有者具備 **MCP and Abilities API** 權限領域、權杖具有 `abilities:read` 範圍（所有個人權杖皆具備此範圍），且該能力已設為公開。主控台的 Abilities 分頁會顯示每個內建能力所需的主要權限領域。

所有六項 `cacti-list-*` 能力每次分頁最多回傳 100 筆項目（預設為 50 筆）以及一個 `nextPageToken`。分頁權杖僅在相同的 `filter` 與 `orderBy` 條件下有效。`filter` 是由 `AND` 連接的比較運算（`=`、`!=`、`<`、`<=`、`>`、`>=`）組成的 AIP-160 運算式，例如 `state = "DOWN" AND disabled = false`。`orderBy` 可接受以逗號分隔的可排序欄位清單，每個欄位後方皆可選擇性地加上 `asc` 或 `desc`。

| 能力 | 篩選欄位 | 排序欄位 |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`、`hostname`、`disabled`、`site`、`poller`、`deviceTemplate`、`externalId`、`state`（`UNKNOWN`、`DOWN`、`RECOVERING`、`UP`、`ERROR`） | `displayName`、`hostname`、`name` |
| `cacti-list-sites` | `displayName`、`city`、`state`、`country`、`timezone`、`alternateId` | `displayName`、`city`、`state`、`country`、`name` |
| `cacti-list-pollers` | `displayName`、`hostname`、`disabled`、`state`（`NEW`、`RUNNING`、`IDLE`、`UNKNOWN`、`DISABLED`、`RECOVERING`、`ERROR`） | `displayName`、`hostname`、`name` |
| `cacti-list-trees` | `displayName`、`enabled` | `displayName`、`name` |
| `cacti-list-graphs` | `title`、`device`、`graphTemplate`、`templateName` | `title`、`templateName`、`name` |
| `cacti-list-data-sources` | `displayName`、`device`、`dataTemplate`、`active` | `displayName`、`name` |

權限範圍限制與機密資訊排除：

- `cacti-list-devices` 與 `cacti-get-device` 會透過 Cacti 的 `get_allowed_devices()` 進行查詢，並排除 SNMP 社群字串、密碼片語及其他憑證資訊。
- `cacti-list-trees` 透過 `get_allowed_trees()` 查詢（並在可用時以 `is_tree_allowed()` 過濾）；`cacti-list-graphs` 透過 `get_allowed_graphs()` 查詢（並在可用時以 `is_graph_allowed()` 過濾）。
- `cacti-list-data-sources` 會將資料列限縮為呼叫端透過 `get_allowed_devices()`（以及可用時的 `is_device_allowed()`）獲准存取的裝置，且僅回傳中繼資料，不會查詢 `data_input_data` 或暴露機密輸入值。
- `cacti-list-pollers` 會排除資料庫憑證（`dbpass`、`dbuser`）以及 TLS 金鑰與憑證欄位（`dbsslkey`、`dbsslcert`、`dbsslca`）。
- `cacti-get-clog` 會讀取已設定之 Cacti 日誌最後最多 1 MiB 的內容（截斷超過 2048 位元組的單一資料列），依 `severity`（`ALL`、`DEBUG`、`INFO`、`NOTICE`、`WARNING`、`ERROR`、`CRITICAL`、`ALERT`、`EMERGENCY`、`FATAL`、`STATS`、`POLLER`、`SYSTEM`；預設為 `ALL`）及不分大小寫的 `search`（最多 256 個字元）進行過濾，並回傳 `lines`、`count` 與 `truncated`。在執行 `severity` 與 `search` 過濾器之前，每一列都會針對個人權杖、bearer/basic 標頭、密碼、機密資訊、SNMP 社群字串、金鑰、`dbpass`、`dbsslkey` 與 URL 使用者資訊進行遮罩處理，使 `search` 無法作為探測機密資訊的預言機（oracle）。遮罩處理在失敗時採失效關閉策略並以 `[redacted]` 取代，而無法讀取的日誌會回傳 `FAILED_PRECONDITION`（`LOG_UNAVAILABLE`）。

## 安裝

需要 Cacti 1.2.31 或更新版本、PHP 8.2 或更新版本，以及主要輪詢器。必須啟用 Cacti 驗證功能；當驗證關閉時，外掛程式將拒絕進行驗證。

外掛程式目錄必須命名為 `mcp`，而非 `plugin_mcp`。外掛程式識別名稱、權限領域名稱、翻譯網域及 URL 皆使用 `mcp`。

從原始碼簽出安裝：

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

在有正式標記的發行版本之前，您也可以從成功的 [CI 執行紀錄](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)下載 `mcp-plugin` 成品。其中包含 `mcp.tar.gz` 與 `SHA256SUMS`。請先驗證校驗碼，再將 `mcp.tar.gz` 解壓縮至 Cacti 的 `plugins/` 目錄內，使最終路徑為 `plugins/mcp/`。GitHub 自動產生的原始碼封存檔會使用不同的頂層目錄名稱。該封存檔不包含 `docs/`（包括下方的螢幕擷取畫面）、`tests/` 與 `.github/`，因此 README 中指向 `docs/` 的連結在 GitHub 上可正常運作，但在已安裝的複本中則無法使用。

接著執行以下步驟：

1. 在外掛程式管理中安裝並啟用 **Cacti MCP**。執行安裝的管理員會自動取得 **MCP Administration** 權限領域。
2. 在 Settings > MCP 中，將 **Public Cacti URL** 設定為用戶端所使用的位址，例如 `https://cacti.example.com/cacti`。除了 `localhost`、`127.0.0.1` 與 `[::1]` 之外，其餘皆必須使用 HTTPS。在設定此欄位之前，`mcp.php` 會回應 HTTP 400 與 JSON-RPC 錯誤，其 `data` 為 `FAILED_PRECONDITION` 與 `PUBLIC_URL_REQUIRED`。`api.php` 不會讀取此設定。

   ![Settings > MCP 畫面，顯示 Public Cacti URL 欄位](../../images/settings-public-url.png)

3. 將 **MCP and Abilities API** 權限領域授予每位將擁有權杖的使用者。系統不會自動將此權限授予任何使用者。
4. 確認網頁伺服器會將 `Authorization` 標頭與路徑資訊傳遞給 PHP（請參閱下方說明）。
5. 開啟 Management > MCP 並公開您希望用戶端看見的能力。

**從開發建置版本升級。** 本外掛程式目前為預先發行版，其資料表結構在開發期間有所變更，且未提供遷移腳本。若您曾安裝過較早的建置版本，請先解除安裝再重新安裝。重新安裝會保留已存在的資料表，因此請先刪除舊的 `plugin_mcp_token`、`plugin_mcp_audit` 與 `plugin_mcp_ability` 資料表（以及更名之前建置版本所建立的對應資料表）。若您需要保留歷史紀錄，請先進行備份；來自這些舊建置版本的權杖在解除安裝時會被撤銷，且無法沿用。

### 網頁伺服器

若 Apache 設定會在交給 PHP 之前移除 `Authorization` 標頭，則需在對應的虛擬主機或目錄設定中加入以下內容，並重新載入設定：

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

搭配 `mod_php` 的 Apache 無需額外的路徑設定即可正確處理 `api.php` 路由。

`api.php` 的路由位於指令碼名稱之後的路徑中（`/plugins/mcp/api.php/v1/abilities`），因此 nginx 必須比對 `.php` 後方帶有額外路徑的 URI，切分出路徑資訊並傳遞給 PHP。`location ~ \.php$` 區塊永遠不會比對到這類 URL，nginx 會直接回應自身的 HTML 404 頁面。下方的 location 模式與兩行 path-info 設定已於 PHP-FPM 環境驗證過；其餘部分為標準範本設定：

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

請調整 `include` 與 `fastcgi_pass` 兩行，使其與目前已用於服務 Cacti 的區塊一致。請勿在此區塊中加入 `try_files $fastcgi_script_name =404;`：這會清除 `$fastcgi_path_info`，進而導致 `api.php` 回應 404 `UNKNOWN_PATH`。若您的設定必須使用 `try_files`，請先透過 `set $path_info $fastcgi_path_info;` 儲存其值，並傳遞 `fastcgi_param PATH_INFO $path_info;`。

`mcp.php` 不包含路徑路由，因此不需要此設定。

## 主控台

Management > MCP 包含三個分頁。您需要具備 **MCP Administration** 權限領域才能存取。此處與下方的螢幕擷取畫面皆擷取自帶有範例資料的 Cacti 開發建置版本。

- **Abilities** 會列出所有已註冊的能力及其所屬外掛程式、分類、所需權限領域以及是否已公開。勾選資料列並選擇 Expose 或 Hide；系統會在套用變更前要求確認。內建的 `cacti-*` 能力預設為公開。來自其他外掛程式的能力預設為隱藏，因此安裝外掛程式後，在管理員決定之前不會公開任何內容。公開設定僅用於限制存取範圍：使用者仍需具備該能力所需的權限領域。

  ![Abilities 分頁，列出內建能力及其所需權限領域與公開狀態](../../images/console-abilities.png)
- **Tokens** 會列出權杖及其擁有者、建立者、建立時間、到期時間、最後使用時間與狀態（Active、Expired、Revoked）。勾選資料列並選擇 Revoke 即可撤銷權杖。已撤銷的權杖無法再次使用。Create Token 可建立新的權杖。

  ![Tokens 分頁，列出權杖的擁有者、到期時間、最後使用時間與狀態，位於 Create Token 表單上方](../../images/console-tokens.png)
- **Audit** 會列出稽核紀錄，依最新順序排列，並支援依使用者、能力與結果進行篩選。

  ![Audit 分頁，列出包含使用者、權杖、能力與結果的呼叫紀錄，並附有篩選器](../../images/console-audit.png)

## 權杖

個人權杖會以其擁有者的身分讀取 Cacti 資料。其格式為 `cmcp_pat_` 後接 64 個小寫十六進位字元，並僅攜帶單一範圍 `abilities:read`。權杖能夠存取的資料取決於擁有者的 Cacti 權限領域與裝置權限，而非權杖本身。權杖擁有者必須是已啟用且具備 **MCP and Abilities API** 權限領域的使用者。

權杖一律針對特定使用者建立、具有有效期限，且可隨時撤銷：

- **主控台。** Management > MCP > Tokens > Create Token。有效期限為 1 至 365 天，預設為 90 天。權杖由伺服器產生，且僅會在回應頁面顯示一次，請立即將其複製並儲存至您的密碼管理工具。您可以為自己建立權杖。若要為其他使用者建立權杖，還必須具備 Users/Groups 權限領域，因為該權杖將以該使用者的身分讀取 Cacti。
- **My MCP Tokens。** 任何具備 MCP and Abilities API 權限領域的使用者皆可管理自己的權杖；請參閱下方說明。
- **命令列。** `tokens.php` 僅能從 CLI 執行，且必須以具備 Cacti 管理權限的作業系統帳號執行。它會從環境變數讀取權杖，因此權杖值永遠不會出現在命令列或行程清單中。有效期限為 1 至 365 天，預設為 30 天。透過 CLI 建立與撤銷權杖同樣會寫入稽核日誌，與透過主控台操作相同；由於 CLI 沒有對應的 Cacti 使用者，因此會以權杖擁有者作為操作者，稽核紀錄亦不會標註該操作來自 CLI。`--list` 會以 JSON 格式印出所有權杖（包含 ID、擁有者、範圍、時間戳記與撤銷旗標），但永遠不會印出權杖值；`--help` 會顯示使用說明。

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

無論是透過主控台、命令列或 My MCP Tokens，皆無法為訪客帳號、已停用的使用者，或未具備 **MCP and Abilities API** 權限領域的使用者建立權杖。Cacti 會以使用者名稱或使用者 ID 來儲存訪客設定，而本外掛程式兩者皆可解析。若權杖擁有者被設為訪客帳號，該權杖將在下一次請求時失效。

### My MCP Tokens

Management > My MCP Tokens（`plugins/mcp/mcp_tokens.php`）不需要管理員權限領域：只要具備 **MCP and Abilities API** 權限領域即可存取，且選單項目僅會顯示給具備該權限領域的使用者。此頁面一律對目前登入的使用者進行操作。由於 Cacti 的選單屬於主控台的一部分，不具主控台存取權限的使用者可透過網址直接開啟此頁面。

![My Tokens 分頁，列出目前登入使用者的權杖與建立表單](../../images/my-tokens.png)

- **Tokens** 會列出您的權杖、建立新權杖（1 至 365 天，預設為 90 天，僅於回應時顯示一次），以及撤銷您自己的權杖。您無法檢視或撤銷其他人的權杖。
- **Activity** 會依最新順序列出您執行的動作：使用您的權杖發出的呼叫，以及您進行的權杖變更。
- **Available Tools** 會列出您的權杖目前可使用的能力，並顯示每個能力的 ID、名稱與說明。其清單會依據您的 Cacti 權限以及管理員所選擇的公開設定動態決定。

  ![Available Tools 清單，顯示每個能力的 ID、名稱與說明](../../images/my-tools.png)

在此頁面推出前所建立的安裝環境，其權限領域檔案清單中不會包含 `mcp_tokens.php`。安裝外掛程式時才會註冊該清單；單純啟用或停用外掛程式並不會更新它。請先解除安裝並重新安裝外掛程式，然後再重新授予權限領域，因為 Cacti 會在解除安裝外掛程式時移除已授予的權限領域。

資料庫僅會儲存權杖的 SHA-256 雜湊值，因此遺失的權杖無法復原；請將其撤銷並建立新的權杖。權杖輪替方式亦同：先建立新權杖、切換用戶端設定，再撤銷舊權杖。權杖過期、權杖遭撤銷、擁有者帳號遭停用或失去權限領域時，皆會在下一次請求時驗證失敗。權杖僅能透過 `Authorization: Bearer` 標頭傳遞；不接受將權杖置於查詢字串或請求主體中。

## 連接用戶端

使用 MCP 端點 `https://cacti.example.com/cacti/plugins/mcp/mcp.php`，並在
`Authorization: Bearer` 標頭中附上權杖。請將權杖保存在環境變數或機密管理員中，
並從用戶端設定參照它，而不是將權杖的值直接寫入檔案。

### Claude Code

將端點放入專案的 `.mcp.json` 中，並以名稱參照權杖。Claude Code 會在 `url`
和 `headers` 中展開 `${VAR}`，因此該檔案不會包含任何機密，可以安全地提交至
版本控制。請在啟動 Claude Code 的環境中匯出 `CACTI_MCP_TOKEN`。

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

你也可以從命令列新增：

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

使用雙引號時，你的 Shell 會先展開 `$CACTI_MCP_TOKEN`，因此權杖的值會被寫入
所選 `--scope`（`local`、`user` 或 `project`；預設為 `local`）的設定檔中。
請勿將該格式與 `--scope project` 搭配使用，並避免將該檔案納入版本控制。建議
優先使用上方的 `.mcp.json` 參照方式。Claude Code 在遠端 `url` 和 `headers`
中會將部分憑證變數（例如 `ANTHROPIC_AUTH_TOKEN`）讀取為空值；`CACTI_MCP_TOKEN`
不在此列。來源：[Claude Code MCP 說明文件](https://code.claude.com/docs/en/mcp)。

### VS Code 中的 GitHub Copilot

請使用工作區根目錄的 `.mcp.json`（或使用者檔案 `~/.copilot/mcp-config.json`）。
這些 Copilot 原生檔案使用頂層 `mcpServers` 物件，並在標頭值中使用 `${NAME}`
環境變數參照：

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

請在啟動 VS Code 的環境中匯出 `CACTI_MCP_TOKEN`。Copilot 原生檔案不支援
`inputs` 提示。VS Code 的引導式設定會拒絕 `${...}` 值，因此請透過編輯檔案
來新增 `Authorization` 標頭，而非透過引導流程。引導式設定僅在開啟實驗性
`chat.mcp.workspaceRootConfig.enabled` 設定時，才會提供工作區根目錄檔案選項。
請參閱 [VS Code MCP 設定參考文件](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)。

**舊版：`.vscode/mcp.json`。** VS Code 表示新的 Copilot 設定不應使用
`.vscode/mcp.json` 或設定檔中的 `mcp.json`；它們屬於已棄用的 Local 架構，
該架構將於 2027 年 2 月移除。如果你仍在使用它，編輯器管理的格式會採用頂層
`servers` 鍵，且可以提示輸入權杖：

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

### 僅支援 stdio 的用戶端

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) 是一個選用的配接器，
它會作為本機 stdio MCP 伺服器執行並呼叫外掛程式的 HTTP API。當用戶端無法連接
遠端 HTTP 伺服器時，請使用此工具。它需要相同的個人權杖，並與 `api.php` 通訊。

### MCP 行為

此端點僅提供工具：每個已公開且獲得許可的能力都會成為一個以其 ID 命名的工具，
並帶有其輸入和輸出結構描述及唯讀註解（`openWorldHint` 為 `false`）。它會處理
`initialize`、`server/discover`、`ping`、`tools/list` 與 `tools/call`。
它不保留工作階段、不傳送 `Mcp-Session-Id`（並忽略收到的該標頭），也不接受
JSON-RPC 批次請求。沒有 `id` 的訊息屬於通知，會收到不含內文的 HTTP 202 回應。
僅允許使用 `POST` 方法。

- **修訂版本。** 若請求在 `params._meta` 中帶有 `io.modelcontextprotocol/protocolVersion`，
  則必須指定 `2026-07-28`；任何其他值都會回傳錯誤 `-32022`。此類請求也必須附上
  相符的 `Mcp-Protocol-Version`、`Mcp-Method`，以及（針對 `tools/call`）`Mcp-Name`
  標頭，否則將回傳錯誤 `-32020`。其他請求會視為 `2025-11-25`：`initialize`
  會以該修訂版本回應，而在其他任何方法上，若有傳送 `Mcp-Protocol-Version` 標頭，
  則必須為 `2025-11-25`、`2025-06-18` 或 `2025-03-26`。
- **工具錯誤。** 能力錯誤（包含不符合結構描述的引數，或非 JSON 物件的 `arguments`
  值）會以帶有 `isError: true` 且在 `structuredContent` 中包含 AIP-193 錯誤的
  工具結果回傳，而非協定錯誤。
- **協定錯誤。** 非工具錯誤的失敗皆為 JSON-RPC 錯誤物件（代碼 `-32000` 並在
  `data` 中包含狀態與原因，或標準代碼）：缺少 Public Cacti URL、被拒絕的 `Origin`、
  在外掛程式停用或遠端輪詢器上發出的請求，以及非預期的伺服器錯誤（`-32603`，
  詳細資訊會寫入 Cacti 日誌，而非回應中）。最先執行的請求檢查（405、413、415）
  與驗證失敗（401 `INVALID_TOKEN`、403 `REALM_REQUIRED`）會保留「HTTP API」一節
  所述的 AIP-193 回應主體。

## HTTP API

基底 URL：`https://cacti.example.com/cacti/plugins/mcp/api.php`。合約定義於
[openapi.json](../../../openapi.json)。

| 方法與路徑 | 用途 |
| --- | --- |
| `GET /v1/abilities` | 列出獲得許可的能力。查詢參數：`pageSize`、`pageToken`，以及形如 `category = "inventory"` 的 `filter`。 |
| `GET /v1/abilities/{id}` | 讀取單一能力。 |
| `POST /v1/abilities/{id}:execute` | 執行能力。請求主體必須恰好為 `{"arguments": {...}}`。回應為 `{"requestId": "...", "result": {...}}`。 |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

錯誤遵循 AIP-193 規範：一個包含 `code`、`message`、`status` 與 `details` 的
`error` 物件，其中 `details` 攜帶一個領域為 `cacti.net` 且具有穩定 `reason` 的
`ErrorInfo`。引數問題會附加一個指出欄位名稱的 `BadRequest` 詳細資訊。請求主體
限制為 64 KB，結果限制為 1 MB。兩個端點皆僅在主輪詢器上回應，當外掛程式停用或
伺服器並非主輪詢器時，會回傳 `UNAVAILABLE`（`PLUGIN_UNAVAILABLE`）。

| HTTP | `reason` 值 |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`、`INVALID_FILTER`、`INVALID_PAGE_TOKEN`、`LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN`（同時傳送 `WWW-Authenticate: Bearer`） |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`、`DEVICE_NOT_FOUND`、`UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED`（傳送 `Allow`） |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`、`INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`、`PLUGIN_UNAVAILABLE`、`CACTI_UNAVAILABLE` |

## 撰寫能力（外掛程式作者）

已啟用的 Cacti 外掛程式會透過附加至 `abilities_register` 掛鉤的函式來註冊能力，
通常是在其 `plugin_<slug>_install()` 中進行：

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

該函式會接收一個範圍限定於該外掛程式的 `AbilitiesRegistrar`。其回傳值會被忽略。

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

註冊時強制執行的規則如下：

- **ID。** ID 必須符合 `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`，最多 64 個字元，
  且必須以外掛程式的 slug 加上連字號開頭：即上述的 `acme-`。slug 即為外掛程式的
  目錄名稱，因此像是 `my_plugin` 這樣的目錄名稱無法註冊任何能力。名為 `cacti` 的
  外掛程式目錄會被拒絕；該命名空間專屬於內建能力。
- **定義。** 必須恰好包含以下鍵：`label`、`description`（最多 4096 位元組）、
  `category`、`input_schema`、`output_schema`、`annotations`、`permission`、
  `execute`。類別必須已經存在：可使用內建類別（`inventory`、`system`），或透過
  `registerCategory()` 註冊自訂類別，其 ID 在所有外掛程式中必須唯一，且符合
  `^[a-z][a-z0-9-]{0,31}$`。
- **僅限唯讀。** `annotations` 必須恰好為 `readOnly: true`、`destructive: false`、
  `idempotent: true`。任何其他設定都會擲回例外。
- **結構描述。** `input_schema` 與 `output_schema` 的頂層 `type` 都必須是
  `object`。此語法範圍較小且採失敗關閉原則。物件必須為封閉式
  （`additionalProperties: false`，且必須存在 `properties`）；其他型別包含
  `integer` 與 `number`（`minimum`、`maximum`）、`string`（`minLength`、
  `maxLength`、`enum`、`pattern`）、`boolean`，以及 `array`（需要 `items` 與
  `maxItems`）。型別可以設為可為空值，例如 `['string', 'null']`。引數字串預設
  最多 4096 個字元；結果字串僅受限於宣告的 `maxLength` 與結果大小上限。最多可
  註冊 256 個能力。
- **`permission(int $userId): bool`。** 必須恰好回傳 `true` 才會允許。使用者 ID
  為權杖擁有者的 ID；切勿讀取工作階段狀態。
- **`execute(int $userId, stdClass $args): array`。** `$args` 已根據 `input_schema`
  驗證完畢。請自行強制執行物件層級的權限檢查。請回傳完全符合 `output_schema` 的
  關聯陣列；若回傳清單、多餘欄位或超過 1 MB 的 JSON，將會產生 `INVALID_RESULT`
  錯誤。針對用戶端可見的失敗（例如 `NOT_FOUND`），請擲回 `AbilitiesError`。
- **空物件。** PHP 會將 `[]` 編碼為 JSON 陣列。無論在任何深度，只要輸出結構描述
  宣告為 `object`，註冊表就會將 `[]` 視為空物件並傳送 `{}`；使用 `new stdClass()`
  也可以。非空清單永遠不會被視為物件，並會以 `INVALID_RESULT` 失敗。結構描述中的
  空 `properties` 對應表可以是 `[]` 或 `new stdClass()`；兩者皆會發佈為 `{}`。
- **失敗隔離。** 每個外掛程式都會註冊到一個暫存複本中，僅當你的函式正常回傳時
  才會保留。如果函式擲回例外，則不會註冊任何能力，且失敗會記錄至日誌中。

來自外掛程式的能力預設為隱藏狀態。管理員可在主控台的 Abilities 分頁中公開它們，
而「Required Realm」欄會對這些能力顯示「Set by the plugin」。

## 安全性模型

- **僅限 Bearer 權杖。** `api.php` 與 `mcp.php` 僅接受 `Authorization` 標頭中的個人權杖，不接受其他任何驗證方式。它們會在 Cacti 載入前捨棄 Cookie、`$_POST` 與 `$_REQUEST`，並銷毀 Cacti 啟動的工作階段，因此透過瀏覽器登入永遠無法取得 API 存取權限。
- **CSRF 權宜之計。** Cacti 的 CSRF 防護會拒絕未附帶 Cacti CSRF 權杖的 JSON POST 請求，但任何 MCP 用戶端都無法傳送該權杖。因此僅針對這兩個端點，外掛會在 Cacti 載入前重新命名請求方法並於事後還原，讓防護機制略過這些請求。此作法之所以安全，是因為 CSRF 防護針對的是瀏覽器以 Cookie 驗證的請求，而這兩個端點不接受任何 Cookie 身分：跨站網頁無法附加 Bearer 權杖。主控台頁面仍保有完整的 CSRF 防護。此為暫時性的權宜之計，待 Cacti 提供受支援的豁免機制後即可移除；請參閱 `lib/bootstrap.php`。
- **來源檢查。** 在 `mcp.php` 上，若請求包含 `Origin` 標頭，其值必須與公開 Cacti URL 的通訊協定、主機與連接埠完全相符，否則請求將被拒絕並回傳 `ORIGIN_NOT_ALLOWED`。未附帶 `Origin` 標頭的請求（即非瀏覽器用戶端的連線方式）則予以允許。這可防止網頁從訪客的瀏覽器驅動該端點。`api.php` 不套用此檢查。
- **僅限唯讀。** 註冊時會拒絕任何並非同時為唯讀、非破壞性且具冪等性的能力。
- **公開設定與權限領域皆須符合。** 能力必須設為公開，且權杖擁有者必須持有其權限領域。若無法讀取公開設定資料表，所有能力都會被隱藏，而不會退回使用預設值。
- **隱藏、未知與無權限的表現一致。** 用戶端無法區分不存在的能力、被隱藏的能力，或是其使用者無權使用的能力：探索結果會省略該能力，且執行時會回傳 `NOT_FOUND`（`ABILITY_NOT_FOUND`）。
- **權杖。** 以 SHA-256 雜湊儲存、僅顯示一次、一律設有到期時間、可撤銷，且在擁有者停用或失去權限領域時予以拒絕。
- **稽核。** `plugin_mcp_audit` 會記錄請求 ID、權杖 ID、使用者 ID、能力、結果（`started`、`succeeded`、`failed`、`denied`、`rejected`）與時間戳記，絕不記錄參數、結果內容或權杖值。能力僅會在寫入 `started` 資料列後才執行；若稽核資料表無法使用，該次呼叫將失敗並回傳 `UNAVAILABLE`，且不會執行。在執行前即被拒絕的呼叫會寫入一筆資料列：未知、隱藏或無權限的能力記為 `denied`，未通過結構描述驗證的參數記為 `rejected`。透過主控台、「我的 MCP 權杖」與 CLI 建立及撤銷權杖時，會記錄為 `mcp-token-create` 與 `mcp-token-revoke`，結果為 `succeeded`，且僅針對原本為啟用狀態的權杖記錄撤銷事件。探索請求，以及 `arguments` 不是 JSON 物件的呼叫，皆不予記錄。
- **失敗日誌。** 發生未預期的失敗、`INVALID_RESULT` 或稽核資料表無法使用時，會以 `MCP` 設施向 Cacti 日誌寫入一行記錄，內容包含能力 ID、固定原因及例外類別。絕不記錄訊息內容、參數與權杖。
- **僅限主輪詢器。** 兩個端點、兩個主控台頁面以及 `tokens.php` 在其他任何位置都會拒絕執行。

## 生命週期

停用此外掛會封鎖兩個端點。解除安裝會撤銷所有權杖，並保留三個資料表（`plugin_mcp_token`、`plugin_mcp_audit`、`plugin_mcp_ability`）以供留存查核；重新安裝不會重新啟用已撤銷的權杖。請將這些資料表隨 Cacti 資料庫一同備份，並於外掛外部套用稽核資料保留政策。

## 開發與測試

測試套件包含 `tests/` 中的純 PHP 指令碼、`tests/Unit/` 中的 PHPUnit 單元測試以及 PHPStan 靜態分析（第 6 級），全部無須安裝 Cacti 即可執行：

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI 會在 PHP 8.2 至 8.5 上執行：`test` 作業會檢查 PHP 語法（`php -l`）並執行列於 `.github/workflows/ci.yml` 的 13 個純 PHP 測試指令碼；`quality` 作業會執行 `composer phpstan` 與 `composer test`；`package` 作業會建置可安裝的 `mcp/` 封存檔（排除列於 `.gitattributes` 的開發與測試檔案）及其 `SHA256SUMS`。涉及 Cacti 的測試會在 Cacti 輔助函式邊界使用測試夾具，並未針對完整的 Cacti 安裝環境進行測試。

### 整合測試

`tests/integration/run.sh 1.2.31` 或 `tests/integration/run.sh develop` 會在容器中將外掛安裝至真實的 Cacti 環境並執行即時檢查。此流程需要 Docker（含 Compose v2.23.1 或更新版本）、git 與 openssl。設定 `KEEP=1` 可保留容器堆疊以便除錯。CI 會在夜間及手動觸發時執行整合測試，而不在拉取請求（pull request）時執行。

## 在地化

Cacti MCP 在 `locales/po/` 與 `locales/LC_MESSAGES/` 下隨附編譯完成的 GNU gettext 翻譯目錄，並在 `docs/i18n/` 下提供英文及另外 47 種語系（19 種 Broad Tier 1 語系、15 種非洲語系、10 種亞洲語系，以及波士尼亞語、克羅埃西亞語與塞爾維亞語）的在地化 README，使用 `mcp` 文字網域（`locales/po/mcp.pot`）。啟用語言支援後，Cacti 會自動載入對應的翻譯目錄。

## 貢獻

請將拉取請求提交至 `develop` 分支。請保持正式環境程式碼與 PHP 8.2 相容，並遵循 Cacti 的程式碼風格：使用 Tab 縮排、單引號字串，以及 Cacti 的資料庫與權限輔助函式。若變更驗證、授權或通訊協定行為，請新增對應測試，並使用 `git commit -s` 簽署提交。對 HTTP API 的變更請與 [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) 協調同步。

## 授權條款

Copyright (C) 2026 Thomas Vincent. 依據 GNU General Public License 第 2 版或更新版本釋出。請參閱 [LICENSE](../../../LICENSE)。
