<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP：带盾牌的仙人掌。发现、授权、执行。">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="许可证：GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP 是一个 Cacti 插件，可让 AI 客户端通过称为“能力”（abilities）的具名、按权限过滤的操作来读取你的 Cacti 数据。它直接由插件本身通过两种方式提供这些能力：MCP 端点（`mcp.php`，Streamable HTTP）和 AIP 风格 HTTP API（`api.php`）。授权与执行始终由 Cacti 掌控。客户端永远不会直接查询数据库；它只能调用管理员已暴露且令牌所有者拥有的 Cacti 权限域（realms）所允许的能力。

插件作者可以通过 `abilities_register` 钩子注册自己的只读能力，这些能力无需编写任何协议代码即可作为工具呈现给 MCP 客户端。

**状态：预发布版本，0.1.0。** 目前尚无带标签的正式发布版本。

目前已提供：

- 用于获取系统版本和设备清单的只读内置能力。
- 个人访问令牌（`cmcp_pat_...`）作为唯一凭据。
- Management > MCP 控制台：暴露或隐藏能力、创建和吊销令牌、查看审计日志。
- Management > My MCP Tokens：用户可管理自己的令牌、查看自身活动记录，以及查看其令牌可用的工具。
- 基于 Streamable HTTP 的 MCP，支持协议修订版 `2026-07-28` 和 `2025-11-25`，仅限工具（tools）。

暂未提供：

- OAuth 2.1 登录。在实现之前，无法发送个人令牌的托管连接器（例如 ChatGPT 和 claude.ai 自定义连接器）无法连接。该功能已规划为第 2 阶段计划（Plan 2），该计划尚未编写。
- 写入能力。目前仅支持注册只读能力。

设计方案见[端点设计规范](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)，构建顺序见 [docs/plan.md](../../plan.md)。

## 内置能力

| ID | 参数 | 所需的 Cacti 权限域 |
| --- | --- | --- |
| `cacti-get-system-info` | 无 | 15 |
| `cacti-list-devices` | 可选 `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-get-device` | 必需 `name`，例如 `devices/12` | 3 |

每次调用还需要令牌所有者拥有 **MCP and Abilities API** 权限域、`abilities:read` 作用域（每个个人令牌均默认包含），以及对应能力处于已暴露状态。控制台的 Abilities 选项卡会显示每个内置能力所需的权限域。

- `cacti-list-devices` 每次分页最多返回 100 台设备（默认 50 台）以及一个 `nextPageToken`。分页令牌仅对相同的 `filter` 和 `orderBy` 有效。`filter` 是由 `AND` 连接的比较条件组成的 AIP-160 表达式，例如 `state = "DOWN" AND disabled = false`。可过滤字段包括 `displayName`、`hostname`、`disabled`、`site`、`poller`、`deviceTemplate`、`externalId` 和 `state`。`orderBy` 接受 `displayName`、`hostname` 或 `name`，每项后均可选择性地附加 `desc`。
- 设备查询通过 Cacti 的 `get_allowed_devices()` 执行，因此用户只能看到 Cacti 允许其查看的设备。
- 设备字段排除了 SNMP 团体字符串、密码短语及其他凭据信息。

## 安装

需要 Cacti 1.2.31 或更高版本、PHP 8.2 或更高版本，以及主轮询器（main poller）。必须启用 Cacti 身份验证；关闭时插件将拒绝进行身份验证。

插件目录必须命名为 `mcp`，而不是 `plugin_mcp`。插件短名称（slug）、权限域名称、翻译域及 URL 均使用 `mcp`。

从源码检出安装：

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

在出现带标签的正式发布版本之前，你可以改为从成功的 [CI 运行](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)中下载 `mcp-plugin` 构建产物。其中包含 `mcp.tar.gz` 和 `SHA256SUMS`。验证校验和后，将 `mcp.tar.gz` 解压到 Cacti 的 `plugins/` 目录中，使最终路径为 `plugins/mcp/`。GitHub 自动生成的源码归档包会使用不同的顶层目录名。此外，该归档包省略了 `docs/`（包括下面的截图）、`tests/` 和 `.github/`，因此 README 中指向 `docs/` 的链接在 GitHub 上有效，但在已安装的副本中无效。

然后：

1. 在 Plugin Management（插件管理）中，安装并启用 **Cacti MCP**。执行安装的管理员会自动获得 **MCP Administration** 权限域。
2. 在 Settings > MCP 下，将 **Public Cacti URL** 设置为客户端使用的地址，例如 `https://cacti.example.com/cacti`。除 `localhost`、`127.0.0.1` 和 `[::1]` 外，必须使用 HTTPS。在完成此设置之前，`mcp.php` 会返回 HTTP 400 及 JSON-RPC 错误，其 `data` 为 `FAILED_PRECONDITION` 和 `PUBLIC_URL_REQUIRED`。`api.php` 不读取此项设置。

   ![Settings > MCP 显示 Public Cacti URL 字段](../../images/settings-public-url.png)

3. 向每位需要持有令牌的用户授予 **MCP and Abilities API** 权限域。没有任何用户会自动获得该权限域。
4. 确保 Web 服务器将 `Authorization` 请求头和路径信息传递给 PHP（见下文）。
5. 打开 Management > MCP，并暴露你希望客户端可见的能力。

**从开发版本升级。** 本插件处于预发布阶段，开发期间其数据表发生过变更且未提供迁移脚本。如果你安装过早期版本，请先卸载后再重新安装。由于重新安装会保留已存在的数据表，因此请先删除旧的 `plugin_mcp_token`、`plugin_mcp_audit` 和 `plugin_mcp_ability` 表（以及更名前构建版本中的对应数据表）。如需保留历史记录请先备份；来自这些构建版本的令牌会在卸载时被吊销，不会沿用。

### Web 服务器

如果在 PHP 接收请求前会剥离 `Authorization` 请求头，Apache 需要在对应的虚拟主机或目录配置中添加以下内容，然后重新加载配置：

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

使用 `mod_php` 的 Apache 无需额外路径配置即可直接处理 `api.php` 路由。

`api.php` 路由位于脚本名称之后的路径中（`/plugins/mcp/api.php/v1/abilities`），因此 nginx 必须匹配 `.php` 后接额外路径的 URI，拆分出路径信息并传递给 PHP。`location ~ \.php$` 块永远无法匹配这类 URL，nginx 会直接返回自带的 HTML 404 页面。以下 location 匹配模式及两行路径信息配置已通过 PHP-FPM 验证，其余各行为标准样板配置：

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

请根据当前用于服务 Cacti 的配置块调整 `include` 和 `fastcgi_pass` 行。切勿向此配置块添加 `try_files $fastcgi_script_name =404;`：它会清空 `$fastcgi_path_info`，进而导致 `api.php` 返回 404 `UNKNOWN_PATH`。如果你的配置必须使用 `try_files`，请先通过 `set $path_info $fastcgi_path_info;` 保存该值，再传入 `fastcgi_param PATH_INFO $path_info;`。

`mcp.php` 没有路径路由，不需要上述配置。

## 控制台

Management > MCP 包含三个选项卡。你需要拥有 **MCP Administration** 权限域。此处及下方的截图均来自包含示例数据的 Cacti 开发版本。

- **Abilities** 列出每个已注册的能力及其所属插件、分类、所需权限域以及当前是否已暴露。选中行并选择 Expose（暴露）或 Hide（隐藏）；变更会在你确认后生效。内置的 `cacti-*` 能力默认处于已暴露状态。来自其他插件的能力初始为隐藏状态，因此安装新插件不会在管理员决定之前对外发布任何内容。暴露设置仅能进一步收窄访问范围：用户仍需拥有该能力对应的权限域。

  ![Abilities 选项卡列出内置能力及其权限域和暴露状态](../../images/console-abilities.png)
- **Tokens** 列出令牌的所有者、创建者、创建时间、过期时间、最后使用时间以及状态（Active、Expired、Revoked）。选中行并选择 Revoke（吊销）即可将其吊销。已吊销的令牌无法再次使用。Create Token（创建令牌）用于生成新令牌。

  ![Tokens 选项卡在 Create Token 表单上方列出令牌的所有者、过期时间、最后使用时间和状态](../../images/console-tokens.png)
- **Audit** 按时间倒序列出审计记录，并支持按用户、能力和结果进行筛选。

  ![Audit 选项卡列出调用记录中的用户、令牌、能力和结果，并附带筛选条件](../../images/console-audit.png)

## 令牌

个人令牌以其所有者的身份读取 Cacti。其格式为 `cmcp_pat_` 后接 64 个小写十六进制字符，并仅携带单一作用域 `abilities:read`。它能够访问哪些数据由其所有者的 Cacti 权限域和设备权限决定，而非由令牌本身决定。令牌所有者必须是已启用且持有 **MCP and Abilities API** 权限域的用户。

令牌始终面向特定用户创建，具有有效期且可被吊销：

- **控制台。** Management > MCP > Tokens > Create Token。有效期为 1 至 365 天，默认 90 天。令牌由服务端生成并在响应页面上仅显示一次，因此请立即将其复制到你的凭据管理器中。你可以为自己创建令牌；为其他用户创建令牌还需要拥有 Users/Groups 权限域，因为该令牌将以该用户的身份读取 Cacti。
- **My MCP Tokens。** 任何拥有 MCP and Abilities API 权限域的用户均可管理自己的令牌；见下文。
- **命令行。** `tokens.php` 只能从 CLI 以可管理 Cacti 的操作系统账户身份运行。它从环境变量读取令牌值，因此令牌值不会出现在命令行或进程列表中。有效期为 1 至 365 天，默认 30 天。通过 CLI 创建和吊销令牌同样会像在控制台中一样记入审计日志；由于 CLI 没有关联的 Cacti 用户，审计记录会将令牌所有者作为操作者，而不会将该操作标记为来自 CLI。`--list` 会以 JSON 格式输出所有令牌（ID、所有者、作用域、时间戳、吊销标记），但绝不输出令牌值；`--help` 可查看用法。

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

无论是通过控制台、命令行还是 My MCP Tokens，均不能为访客账户（guest account）、已禁用用户或未持有 **MCP and Abilities API** 权限域的用户创建令牌。Cacti 可能将访客设置保存为用户名或用户 ID，本插件对两者均可解析。如果某令牌的所有者日后变更为访客账户，该令牌将在下一次请求时失效。

### My MCP Tokens

Management > My MCP Tokens（`plugins/mcp/mcp_tokens.php`）无需管理权限域：它由 **MCP and Abilities API** 权限域覆盖，且仅向持有该权限域的用户显示菜单项。该页面始终针对当前登录用户执行操作。由于 Cacti 菜单属于控制台的一部分，没有控制台访问权限的用户可通过其地址直接访问该页面。

![My Tokens 选项卡列出当前登录用户的令牌及创建表单](../../images/my-tokens.png)

- **Tokens** 列出你的令牌、创建新令牌（有效期 1 至 365 天，默认 90 天，仅在响应中显示一次），以及吊销你自己的令牌。你无法查看或吊销他人的令牌。
- **Activity** 按时间倒序列出你执行过的操作：使用你的令牌发起的调用以及你对令牌所做的变更。
- **Available Tools** 列出你的令牌当前可以使用的能力，包含每项能力的 ID、名称和描述。它遵循你的 Cacti 权限以及管理员选择的暴露设置。

  ![Available Tools 列表显示每项能力的 ID、名称和描述](../../images/my-tools.png)

在本页面存在之前安装的实例，其权限域文件列表中不会包含 `mcp_tokens.php`。该列表是在安装插件时注册的，启用或禁用插件不会更新它。请先卸载再重新安装插件，然后重新授予相应权限域，因为 Cacti 会在卸载插件时移除已授予的权限域。

数据库仅存储令牌的 SHA-256 哈希值，因此丢失的令牌无法找回；请将其吊销并重新创建一个。轮换令牌的方式相同：先创建新令牌、切换客户端配置，再吊销旧令牌。过期令牌、已吊销令牌、所有者被禁用或权限域被收回，均会在下一次请求时失败。系统仅接受通过 `Authorization: Bearer` 请求头传递的令牌；查询字符串或请求体中的令牌均不被接受。

## 连接客户端

请使用 MCP 端点 `https://cacti.example.com/cacti/plugins/mcp/mcp.php`，并在 `Authorization: Bearer` 请求头中携带令牌。请将令牌保存在环境变量或密钥管理器中，并在客户端配置中引用该变量，而不要将令牌值直接写入文件。

### Claude Code

将端点配置在项目的 `.mcp.json` 文件中，并通过名称引用令牌。Claude Code 会展开 `url` 和 `headers` 中的 `${VAR}`，因此该文件不包含任何密钥，可以安全提交到版本库。请在启动 Claude Code 的环境中导出 `CACTI_MCP_TOKEN`。

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

也可以通过命令行添加：

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

使用双引号时，Shell 会先展开 `$CACTI_MCP_TOKEN`，从而将令牌值写入所选 `--scope`（`local`、`user` 或 `project`；默认为 `local`）对应的配置文件中。请勿将该写法与 `--scope project` 一起使用，并避免将配置文件纳入版本控制。建议优先采用上述 `.mcp.json` 引用方式。Claude Code 在处理远程 `url` 和 `headers` 时会将某些凭据变量（例如 `ANTHROPIC_AUTH_TOKEN`）读取为空值，但 `CACTI_MCP_TOKEN` 不在此列。参考来源：[Claude Code MCP 文档](https://code.claude.com/docs/en/mcp)。

### VS Code 中的 GitHub Copilot

请使用工作区根目录下的 `.mcp.json`（或用户级文件 `~/.copilot/mcp-config.json`）。这些 Copilot 原生配置文件使用顶层 `mcpServers` 对象，并在请求头值中使用 `${NAME}` 环境变量引用：

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

请在启动 VS Code 的环境中导出 `CACTI_MCP_TOKEN`。原生 Copilot 文件不支持 `inputs` 提示输入。VS Code 的引导式配置流程会拒绝 `${...}` 值，因此请直接编辑文件来添加 `Authorization` 请求头，而不要通过引导流程。仅当启用实验性设置 `chat.mcp.workspaceRootConfig.enabled` 时，引导式配置才会提供工作区根目录文件选项。参阅 [VS Code MCP 配置参考](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)。

**旧版配置：`.vscode/mcp.json`。** VS Code 指出，新的 Copilot 配置不应再使用 `.vscode/mcp.json` 或配置文件中的 `mcp.json`；它们属于已弃用的 Local harness，将于 2027 年 2 月移除。如果您仍在使用该方式，这种由编辑器管理的格式使用顶层 `servers` 键，并支持提示输入令牌：

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

### 仅支持 stdio 的客户端

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) 是一个可选适配器，它作为本地 stdio MCP 服务器运行并调用该插件的 HTTP API。如果客户端无法连接到远程 HTTP 服务器，可以使用该适配器。它需要相同的个人令牌，并与 `api.php` 通信。

### MCP 行为

该端点仅提供工具能力：每个已公开且有权限的能力都对应一个以其 ID 命名的工具，附带输入输出模式（schema）及只读注解（`openWorldHint` 为 `false`）。该端点处理 `initialize`、`server/discover`、`ping`、`tools/list` 和 `tools/call` 方法。它不维护会话状态，不会发送 `Mcp-Session-Id`（且会忽略收到的该请求头），也不接受 JSON-RPC 批处理请求。不含 `id` 的消息视为通知，返回 HTTP 202 且无响应体。仅允许使用 `POST` 方法。

- **协议版本。** 若请求在 `params._meta` 中携带了 `io.modelcontextprotocol/protocolVersion`，则其值必须为 `2026-07-28`；其他任何值都将返回错误 `-32022`。此类请求还必须携带相匹配的 `Mcp-Protocol-Version`、`Mcp-Method` 请求头，以及（针对 `tools/call` 的）`Mcp-Name` 请求头，否则将返回错误 `-32020`。其他请求按 `2025-11-25` 处理：`initialize` 将以该修订版本响应；对于其他任何方法，若发送了 `Mcp-Protocol-Version` 请求头，其值必须为 `2025-11-25`、`2025-06-18` 或 `2025-03-26`。
- **工具错误。** 能力执行错误（包括参数不符合模式或 `arguments` 值不是 JSON 对象）会作为工具结果返回，其中 `isError: true`，且在 `structuredContent` 中包含 AIP-193 错误信息，而不是作为协议错误返回。
- **协议错误。** 非工具错误导致的失败会返回 JSON-RPC 错误对象（错误码 `-32000` 并在 `data` 中附带状态和原因，或使用标准错误码），包括：缺少 Public Cacti URL、被拒绝的 `Origin`、插件被禁用或在远程轮询器上发起的请求，以及意外的服务端错误（`-32603`，详细信息写入 Cacti 日志而不放入响应）。优先执行的请求检查（405、413、415）和身份验证失败（401 `INVALID_TOKEN`、403 `REALM_REQUIRED`）仍保留 HTTP API 部分所述的 AIP-193 响应体格式。

## HTTP API

基础 URL：`https://cacti.example.com/cacti/plugins/mcp/api.php`。接口契约定义在 [openapi.json](../../../openapi.json) 中。

| 方法与路径 | 用途 |
| --- | --- |
| `GET /v1/abilities` | 列出有权限访问的能力。查询参数：`pageSize`、`pageToken` 以及形如 `category = "inventory"` 的 `filter`。 |
| `GET /v1/abilities/{id}` | 读取单个能力的详情。 |
| `POST /v1/abilities/{id}:execute` | 执行该能力。请求体格式严格为 `{"arguments": {...}}`，响应体为 `{"requestId": "...", "result": {...}}`。 |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

错误遵循 AIP-193 规范：包含 `code`、`message`、`status` 和 `details` 的 `error` 对象，其中 `details` 携带域为 `cacti.net` 且具有稳定 `reason` 的 `ErrorInfo`。参数问题会额外附加一个指明字段名称的 `BadRequest` 详情。请求体上限为 64 KB，返回结果上限为 1 MB。两个端点均仅在主轮询器上响应，当插件被禁用或服务器不是主轮询器时，返回 `UNAVAILABLE`（`PLUGIN_UNAVAILABLE`）。

| HTTP | `reason` 值 |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN`（同时发送 `WWW-Authenticate: Bearer`） |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED`（同时发送 `Allow`） |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## 编写能力（插件开发者）

已启用的 Cacti 插件通过挂载到 `abilities_register` 钩子的函数来注册能力，通常在 `plugin_<slug>_install()` 中完成挂载：

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

该函数接收一个作用域限定于该插件的 `AbilitiesRegistrar` 实例，其返回值会被忽略。

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

以下规则均在注册时强制校验：

- **ID 规范。** ID 必须匹配 `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`，长度不超过 64 个字符，且必须以插件的 slug 和连字符开头（如上例中的 `acme-`）。slug 即为插件目录名称，因此诸如 `my_plugin` 这样的目录无法注册任何能力。名为 `cacti` 的插件目录会被拒绝；该命名空间保留给内置能力使用。
- **定义结构。** 必须且只能包含以下键：`label`、`description`（最多 4096 字节）、`category`、`input_schema`、`output_schema`、`annotations`、`permission`、`execute`。所属分类必须已存在：可以使用内置分类（`inventory`、`system`），或通过 `registerCategory()` 注册自定义分类，其 ID 在所有插件中必须唯一且匹配 `^[a-z][a-z0-9-]{0,31}$`。
- **仅限只读。** `annotations` 必须严格为 `readOnly: true`、`destructive: false`、`idempotent: true`。任何其他值都会抛出异常。
- **模式（Schema）。** `input_schema` 和 `output_schema` 的顶层 `type` 都必须为 `object`。所支持的 Schema 语法子集较小且采用失效关闭策略。对象必须为封闭结构（`additionalProperties: false` 且包含 `properties`）；其他支持的类型包括 `integer` 与 `number`（支持 `minimum`、`maximum`）、`string`（支持 `minLength`、`maxLength`、`enum`、`pattern`）、`boolean` 以及 `array`（需要 `items` 和 `maxItems`）。类型可通过 `['string', 'null']` 的形式设为可空。参数字符串默认最长为 4096 个字符；返回结果中的字符串仅受声明的 `maxLength` 和结果总大小限制约束。最多可注册 256 个能力。
- **`permission(int $userId): bool`。** 必须严格返回 `true` 才允许访问。传入的用户 ID 为令牌所有者的 ID；切勿读取会话状态。
- **`execute(int $userId, stdClass $args): array`。** `$args` 已按 `input_schema` 完成校验。请在函数内部自行执行对象级权限检查。返回值必须是与 `output_schema` 完全匹配的关联数组；若返回索引列表、多余字段或序列化后超过 1 MB 的 JSON，均会产生 `INVALID_RESULT` 错误。对于需要向客户端展示的失败情况（例如 `NOT_FOUND`），请抛出 `AbilitiesError`。
- **空对象。** PHP 会将 `[]` 编码为 JSON 数组。只要输出模式在任意层级声明了 `object` 类型，注册表就会将 `[]` 视为空对象并输出 `{}`；使用 `new stdClass()` 同样有效。非空列表绝不会被视为对象，并将导致 `INVALID_RESULT` 错误。Schema 中的空 `properties` 映射可以是 `[]` 或 `new stdClass()`，两者都会被发布为 `{}`。
- **故障隔离。** 每个插件都会先向临时副本进行注册，仅当注册函数正常返回时才会保留结果。如果函数抛出异常，该插件的任何能力都不会被注册，且失败信息会被记录到日志中。

来自插件的能力默认处于隐藏状态。管理员可在控制台的 Abilities 选项卡中将其公开，此时这些能力在 Required Realm 列中会显示为“Set by the plugin”。

## 安全模型

- **仅限 Bearer 令牌。**`api.php` 和 `mcp.php` 仅接受 `Authorization` 请求头中的个人令牌，不接受其他任何凭据。它们会在 Cacti 加载之前丢弃 Cookie、`$_POST` 和 `$_REQUEST`，并销毁 Cacti 启动的会话，因此浏览器登录绝不会授予 API 访问权限。
- **CSRF 临时变通方案。**Cacti 的 CSRF 防护会拒绝不包含 Cacti CSRF 令牌的 JSON POST 请求，而任何 MCP 客户端都无法发送该令牌。仅针对这两个端点，插件会在 Cacti 加载前重命名请求方法并在之后恢复，从而使防护跳过它们。这样做是安全的，因为 CSRF 防护的是浏览器通过 Cookie 进行身份验证的请求，而这两个端点不接受任何 Cookie 身份：跨站页面无法附带 Bearer 令牌。控制台页面仍保留完整的 CSRF 防护。该变通方案为临时措施，待 Cacti 提供受支持的豁免机制后将移除；详见 `lib/bootstrap.php`。
- **Origin 检查。**在 `mcp.php` 上，如果请求包含 `Origin` 请求头，则其必须与公共 Cacti URL 的协议、主机名和端口完全一致，否则请求将被拒绝并返回 `ORIGIN_NOT_ALLOWED`。不包含 `Origin` 请求头的请求（非浏览器客户端的常规连接方式）会被允许。这可防止网页从访客的浏览器中驱动该端点。`api.php` 不应用此检查。
- **仅限只读操作。**注册过程会拒绝任何非只读、具有破坏性或非幂等的能力。
- **暴露状态与权限域同时生效。**某项能力必须处于已暴露状态，且令牌所有者必须拥有其对应的权限域。如果无法读取暴露表，所有能力均会被隐藏，而不会回退到默认值。
- **隐藏、未知和无权限的表现完全一致。**客户端无法区分不存在的能力、已隐藏的能力或其用户无权使用的能力：发现接口会将其省略，执行接口则会返回 `NOT_FOUND`（`ABILITY_NOT_FOUND`）。
- **令牌。**以 SHA-256 哈希形式存储，仅在创建时显示一次，始终设有过期时间，可随时撤销，且当所有者被禁用或失去对应权限域时会被拒绝。
- **审计。**`plugin_mcp_audit` 记录请求 ID、令牌 ID、用户 ID、能力、结果（`started`、`succeeded`、`failed`、`denied`、`rejected`）以及时间戳。它绝不记录参数、结果内容或令牌值。能力仅在写入 `started` 行之后才会运行；如果审计表不可用，调用将返回 `UNAVAILABLE` 失败且不会执行。在运行前被拒绝的调用仅记录一行：未知、隐藏或无权限的能力记录为 `denied`，未通过模式校验的参数记录为 `rejected`。通过控制台、“我的 MCP 令牌”和 CLI 创建及撤销令牌时，会分别以 `mcp-token-create` 和 `mcp-token-revoke` 记录，结果为 `succeeded`；且仅针对处于活跃状态的令牌记录撤销操作。发现请求以及 `arguments` 不是 JSON 对象的调用不会被记录。
- **故障日志。**意外故障、`INVALID_RESULT` 或审计表不可用时，会向 Cacti 日志写入一行，日志设施为 `MCP`：包含能力 ID、固定原因和异常类。消息内容、参数和令牌绝不会被记录。
- **仅限主轮询器。**两个端点、两个控制台页面以及 `tokens.php` 均拒绝在主轮询器以外的任何位置执行操作。

## 生命周期

禁用插件会阻塞这两个端点。卸载插件会撤销所有令牌，并保留三张表（`plugin_mcp_token`、`plugin_mcp_audit`、`plugin_mcp_ability`）用于数据留存；重新安装不会重新激活已撤销的令牌。请随 Cacti 数据库一同备份这些表，并在插件外部实施审计保留策略。

## 开发与测试

测试是不依赖 Cacti 即可运行的纯 PHP 脚本：

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI 会在 PHP 8.2 至 8.5 上对 PHP 代码进行 lint 检查并运行 `tests/` 中的脚本（各项均列于 `.github/workflows/ci.yml` 中），随后构建可安装的 `mcp/` 归档包及其校验和。涉及 Cacti 的测试在 Cacti 辅助函数边界处使用测试夹具，不会演练完整的 Cacti 安装环境。

### 集成测试

`tests/integration/run.sh 1.2.31` 或 `tests/integration/run.sh develop` 会在容器中将插件安装到真实的 Cacti 实例中并对其运行实时检查。它需要 Docker（附带 Compose v2.23.1 或更高版本）、git 和 openssl。`KEEP=1` 可保留容器栈运行以便调试。CI 仅在夜间和按需运行集成测试，不在拉取请求中运行。

## 本地化

Cacti MCP 在 `locales/po/` 和 `locales/LC_MESSAGES/` 下随附已编译的 GNU gettext 消息目录，并在 `docs/i18n/` 下提供英语及另外 47 个区域设置（19 个广泛使用的第一梯队区域设置、15 个非洲区域设置、10 个亚洲区域设置，以及波斯尼亚语、克罗地亚语和塞尔维亚语区域设置）的本地化 README，使用 `mcp` 文本域（`locales/po/mcp.pot`）。当启用语言支持时，Cacti 会自动加载对应的目录。

## 贡献

请向 `develop` 分支提交拉取请求。请保持生产代码与 PHP 8.2 兼容，并遵循 Cacti 的代码风格：使用制表符缩进、单引号字符串以及 Cacti 的数据库和权限辅助函数。更改校验、授权或协议行为时请补充测试，并使用 `git commit -s` 对提交进行签名确认。对 HTTP API 的更改请与 [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) 协调。

## 许可证

Copyright (C) 2026 Thomas Vincent。根据 GNU 通用公共许可证（GNU General Public License）第 2 版或更高版本发布。详见 [LICENSE](../../../LICENSE)。
