<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: 盾を持つサボテン。検出・認可・実行。">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="ライセンス: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP は、AI クライアントが「アビリティ（ability）」と呼ばれる名前付きかつ権限でフィルタリングされた操作を通じて Cacti データを読み取れるようにする Cacti プラグインです。プラグイン自体から 2 つの方法でアビリティを提供します：MCP エンドポイント（`mcp.php`、Streamable HTTP）と AIP スタイルの HTTP API（`api.php`）です。認可と実行は引き続き Cacti が管理します。クライアントがデータベースに直接クエリを実行することはなく、管理者が公開し、かつトークン所有者の Cacti レルムで許可されているアビリティのみを呼び出せます。

プラグイン作成者は `abilities_register` フックを通じて独自の読み取り専用アビリティを登録でき、プロトコルコードを記述することなく MCP クライアントにツールとして表示されます。

**ステータス: プレリリース、バージョン 0.1.0。** タグ付きのリリースはまだありません。

現在利用可能な機能:

- システムバージョン、デバイス、サイト、ポーラー、グラフツリー、グラフ、データソース、および上限付きで墨消し（リダクション）された Cacti ログ末尾を対象とする 9 つの読み取り専用組み込みアビリティ。
- 唯一の認証情報としてのパーソナルアクセストークン（`cmcp_pat_...`）。
- Management > MCP コンソール: アビリティの公開・非公開の切り替え、トークンの作成および失効、監査ログの閲覧。
- Management > My MCP Tokens: ユーザー自身のトークン管理、アクティビティの確認、および自分のトークンで使用可能なツールの確認。
- Streamable HTTP 上の MCP（プロトコルリビジョン `2026-07-28` および `2025-11-25`、ツールのみ対応）。

まだ利用できない機能:

- OAuth 2.1 サインイン。ChatGPT や claude.ai のカスタムコネクタなど、パーソナルトークンを送信できないホスト型コネクタは、これが実装されるまで接続できません。Plan 2 として計画されていますが、その計画はまだ作成されていません。
- 書き込み用アビリティ。登録できるのは読み取り専用のアビリティのみです。

設計は[エンドポイント設計仕様](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)に、構築手順は [docs/plan.md](../../plan.md) に記載されています。

## 組み込みアビリティ

| ID | カテゴリ | 引数 | 必要な Cacti レルム |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | なし | 15 |
| `cacti-list-devices` | `inventory` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-get-device` | `inventory` | 必須: `name`（例: `devices/12`） | 3 |
| `cacti-list-sites` | `inventory` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-list-pollers` | `system` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 15 |
| `cacti-list-trees` | `inventory` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 7 または 4 |
| `cacti-list-graphs` | `inventory` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 7 または 5 |
| `cacti-list-data-sources` | `inventory` | 任意: `pageSize`、`pageToken`、`filter`、`orderBy` | 3 |
| `cacti-get-clog` | `system` | 任意: `lines`（1〜200、デフォルト 50）、`severity`、`search` | 19 または 18 |

すべての呼び出しには、トークン所有者の **MCP and Abilities API** レルム、`abilities:read` スコープ（すべてのパーソナルトークンに付与されています）、および公開されたアビリティも必要です。コンソールの Abilities タブには、各組み込みアビリティが必要とする主要なレルムが表示されます。

6 つの `cacti-list-*` アビリティはすべて、最大 100 件（デフォルト 50 件）の項目を含むページと `nextPageToken` を返します。ページトークンは、同じ `filter` および `orderBy` に対してのみ有効です。`filter` は `AND` で結合された比較式（`=`、`!=`、`<`、`<=`、`>`、`>=`）からなる AIP-160 式です（例: `state = "DOWN" AND disabled = false`）。`orderBy` にはソート可能なフィールドをカンマ区切りで指定でき、各フィールドの末尾に任意で `asc` または `desc` を付けられます。

| アビリティ | フィルタフィールド | ソートフィールド |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

権限によるスコープ制限とシークレットの除外:

- `cacti-list-devices` および `cacti-get-device` は Cacti の `get_allowed_devices()` を経由してクエリを実行し、SNMP コミュニティ文字列、パスフレーズ、その他の認証情報を除外します。
- `cacti-list-trees` は `get_allowed_trees()` を経由してクエリを実行します（利用可能な場合は `is_tree_allowed()` でフィルタリングします）。`cacti-list-graphs` は `get_allowed_graphs()` を経由してクエリを実行します（利用可能な場合は `is_graph_allowed()` でフィルタリングします）。
- `cacti-list-data-sources` は `get_allowed_devices()`（および利用可能な場合は `is_device_allowed()`）から得られる呼び出し元の許可デバイスに行を限定し、`data_input_data` へのクエリやシークレット入力値の公開を行わずにメタデータのみを返します。
- `cacti-list-pollers` はデータベース認証情報（`dbpass`、`dbuser`）および TLS キーと証明書の列（`dbsslkey`、`dbsslcert`、`dbsslca`）を除外します。
- `cacti-get-clog` は設定された Cacti ログの末尾最大 1 MiB を読み込み（2048 バイトを超える個々の行は切り詰めます）、`severity`（`ALL`、`DEBUG`、`INFO`、`NOTICE`、`WARNING`、`ERROR`、`CRITICAL`、`ALERT`、`EMERGENCY`、`FATAL`、`STATS`、`POLLER`、`SYSTEM`、デフォルトは `ALL`）および大文字と小文字を区別しない `search`（最大 256 文字）でフィルタリングし、`lines`、`count`、`truncated` を返します。`search` がシークレット判別のオラクルとして悪用されるのを防ぐため、`severity` と `search` のフィルタを実行する前に、各行からパーソナルトークン、Bearer/Basic ヘッダー、パスワード、シークレット、SNMP コミュニティ、キー、`dbpass`、`dbsslkey`、および URL のユーザー情報が墨消しされます。墨消しは `[redacted]` でフェイルクローズドとなり、読み取れないログの場合は `FAILED_PRECONDITION`（`LOG_UNAVAILABLE`）を返します。

## インストール

Cacti 1.2.31 以降、PHP 8.2 以降、およびメインポーラーが必要です。Cacti の認証が有効になっている必要があり、無効になっている場合、プラグインは認証を拒否します。

プラグインディレクトリ名は `plugin_mcp` ではなく `mcp` にする必要があります。プラグインスラッグ、レルム名、翻訳ドメイン、URL はすべて `mcp` を使用します。

ソースチェックアウトからインストールする場合:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

タグ付きリリースが公開されるまでは、代わりに成功した[CI 実行](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)から `mcp-plugin` アーティファクトをダウンロードできます。これには `mcp.tar.gz` と `SHA256SUMS` が含まれています。チェックサムを検証してから、Cacti の `plugins/` ディレクトリ内に `mcp.tar.gz` を展開し、`plugins/mcp/` となるように配置してください。GitHub の自動生成ソースアーカイブでは異なるトップレベルディレクトリ名が使用されます。また、このアーカイブには `docs/`（以下のスクリーンショットを含む）、`tests/`、`.github/` が含まれていないため、README 内の `docs/` へのリンクは GitHub 上では機能しますが、インストール後のコピーでは機能しません。

その後、以下の手順を行います:

1. Plugin Management で **Cacti MCP** をインストールして有効化します。インストールを実行した管理者には **MCP Administration** レルムが自動的に付与されます。
2. Settings > MCP で **Public Cacti URL** にクライアントが使用するアドレス（例: `https://cacti.example.com/cacti`）を設定します。`localhost`、`127.0.0.1`、`[::1]` を除き HTTPS が必須です。これが設定されるまで、`mcp.php` は `data` に `FAILED_PRECONDITION` および `PUBLIC_URL_REQUIRED` を含む JSON-RPC エラーを伴う HTTP 400 を返します。`api.php` はこの設定を参照しません。

   ![Public Cacti URL フィールドを表示している Settings > MCP 画面](../../images/settings-public-url.png)

3. トークンを所有する各ユーザーに **MCP and Abilities API** レルムを付与します。このレルムが自動的に付与されるユーザーはいません。
4. Web サーバーが `Authorization` ヘッダーとパス情報を PHP に渡すように設定されていることを確認します（下記参照）。
5. Management > MCP を開き、クライアントに公開したいアビリティを公開状態にします。

**開発ビルドからのアップグレード。** このプラグインはプレリリース版であり、開発中にマイグレーションなしでテーブル構造が変更されています。以前のビルドをインストールしていた場合は、一度アンインストールしてから再インストールしてください。再インストール時は既存のテーブルが保持されるため、先に古い `plugin_mcp_token`、`plugin_mcp_audit`、`plugin_mcp_ability` テーブル（およびリネーム前のビルドの同等テーブル）を削除してください。履歴が必要な場合は事前にバックアップを取ってください。それらのビルドのトークンはアンインストール時に失効され、引き継がれません。

### Web サーバー

PHP の前段で `Authorization` ヘッダーを削除する Apache 環境では、該当するバーチャルホストまたはディレクトリに以下を設定し、リロードしてください:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` を使用する Apache では、追加のパス設定なしで `api.php` のルートが機能します。

`api.php` のルートはスクリプト名の後ろのパス（`/plugins/mcp/api.php/v1/abilities`）に配置されるため、nginx では `.php` の後にパスが続く URI に一致させ、パス情報を分割して PHP に渡す必要があります。`location ~ \.php$` ブロックはこれらの URL に一致しないため、nginx は独自の HTML 404 を返します。以下の location パターンと 2 行のパス情報設定は PHP-FPM で動作確認済みであり、その他の行は標準的な定型設定です:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

`include` 行と `fastcgi_pass` 行は、すでに Cacti を配信しているブロックに合わせて調整してください。このブロックには `try_files $fastcgi_script_name =404;` を追加しないでください。追加すると `$fastcgi_path_info` がクリアされ、`api.php` が 404 `UNKNOWN_PATH` を返すようになります。設定上 `try_files` が必要な場合は、先に `set $path_info $fastcgi_path_info;` で値を保存してから `fastcgi_param PATH_INFO $path_info;` を渡してください。

`mcp.php` にはパスルートがないため、これらの設定は不要です。

## コンソール

Management > MCP には 3 つのタブがあります。利用するには **MCP Administration** レルムが必要です。ここおよび以降のスクリーンショットは、サンプルデータを含む Cacti 開発ビルドのものです。

- **Abilities** には、登録されているすべてのアビリティについて、プラグイン、カテゴリ、必要なレルム、および公開状態が一覧表示されます。行を選択して Expose または Hide を選択すると、確認後に変更が適用されます。組み込みの `cacti-*` アビリティはデフォルトで公開されています。他のプラグインのアビリティは非公開で開始するため、管理者が決定するまでプラグインのインストールによって何かが公開されることはありません。公開設定はアクセスを制限する方向でのみ機能するため、ユーザーにはそのアビリティのレルムが引き続き必要です。

  ![組み込みアビリティとそのレルムおよび公開状態を一覧表示している Abilities タブ](../../images/console-abilities.png)
- **Tokens** には、所有者、作成者、作成日時、有効期限、最終使用日時、および状態（Active、Expired、Revoked）とともにトークンが一覧表示されます。行を選択して Revoke を選択すると失効できます。失効したトークンは再利用できません。Create Token で新しいトークンを作成します。

  ![所有者、有効期限、最終使用日時、状態を含むトークン一覧と、その下にある Create Token フォームを表示している Tokens タブ](../../images/console-tokens.png)
- **Audit** には監査ログの行が新しい順に表示され、ユーザー、アビリティ、および結果でフィルタリングできます。

  ![ユーザー、トークン、アビリティ、結果とフィルタを含む呼び出し一覧を表示している Audit タブ](../../images/console-audit.png)

## トークン

パーソナルトークンは、その所有者として Cacti を読み取ります。形式は `cmcp_pat_` の後に 64 文字の小文字 16 進数が続き、単一のスコープ `abilities:read` を持ちます。参照できる内容はトークンではなく、所有者の Cacti レルムおよびデバイス権限によって決まります。所有者は **MCP and Abilities API** レルムを保持する有効なユーザーである必要があります。

トークンは常にユーザーに対して作成され、有効期限があり、失効させることができます:

- **コンソール。** Management > MCP > Tokens > Create Token から作成します。有効期間は 1〜365 日で、デフォルトは 90 日です。トークンはサーバーによって生成され、応答ページに一度だけ表示されるため、直ちにシークレットマネージャーへコピーしてください。自分用のトークンを作成できます。別のユーザー用のトークンを作成するには、そのトークンがそのユーザーとして Cacti を読み取るため、Users/Groups レルムも必要です。
- **My MCP Tokens。** MCP and Abilities API レルムを持つすべてのユーザーが自身のトークンを管理できます。詳細は下記を参照してください。
- **コマンドライン。** `tokens.php` は CLI からのみ、Cacti を管理できる OS アカウントとして実行します。コマンドラインやプロセス一覧に値が残らないよう、トークンは環境変数から受け取ります。有効期間は 1〜365 日で、デフォルトは 30 日です。CLI からのトークンの作成と失効もコンソールと同様に監査ログに記録されますが、CLI には Cacti ユーザーが存在しないため、トークンの所有者が実行者として記録され、監査行に CLI からの操作であることは明記されません。`--list` はすべてのトークンを JSON（ID、所有者、スコープ、タイムスタンプ、失効フラグ）で出力し、トークン値自体は一切出力しません。`--help` は使用方法を表示します。

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

コンソール、コマンドライン、My MCP Tokens のいずれの方法でも、ゲストアカウント、無効化されたユーザー、または **MCP and Abilities API** レルムを持たないユーザーに対してはトークンを作成できません。Cacti はゲスト設定をユーザー名またはユーザー ID として保存しますが、プラグインは両方に対応して解決します。所有者がゲストアカウントになったトークンは、次のリクエスト時に動作を停止します。

### My MCP Tokens

Management > My MCP Tokens（`plugins/mcp/mcp_tokens.php`）には管理レルムは不要で、**MCP and Abilities API** レルムによって利用でき、メニュー項目はそれを保持するユーザーにのみ表示されます。このページは常にサインイン中のユーザーに対して動作します。Cacti のメニューはコンソールの一部であるため、コンソールへのアクセス権がないユーザーはアドレスを直接指定してページにアクセスします。

![サインイン中のユーザーのトークン一覧と作成フォームを表示している My Tokens タブ](../../images/my-tokens.png)

- **Tokens** では、自分のトークンの一覧表示、新規作成（1〜365 日、デフォルト 90 日、応答時に一度だけ表示）、および自身のトークンの失効を行えます。他のユーザーのトークンを表示したり失効させたりすることはできません。
- **Activity** では、自分が実行した操作（自分のトークンで行われた呼び出しおよび自分が行ったトークン変更）が新しい順に一覧表示されます。
- **Available Tools** では、自分のトークンが現在使用できるアビリティが、各アビリティの ID、名前、説明とともに一覧表示されます。これは自身の Cacti 権限と管理者が選択した公開設定に従います。

  ![各アビリティの ID、名前、説明を表示している Available Tools 一覧](../../images/my-tools.png)

このページが存在する前のインストール環境では、レルムファイル一覧に `mcp_tokens.php` が含まれていません。一覧はインストール時に登録されるため、プラグインの有効化や無効化では更新されません。Cacti はプラグインのアンインストール時にレルム付与を削除するため、一度プラグインをアンインストールしてから再インストールし、再度レルムを付与してください。

データベースにはトークンの SHA-256 ハッシュのみが保存されるため、紛失したトークンを復元することはできません。失効させて別のトークンを作成してください。ローテーションの手順も同様で、新しいトークンを作成し、クライアントを切り替えてから、古いトークンを失効させます。有効期限切れのトークン、失効済みのトークン、無効化された所有者、または失われたレルムは、いずれも次のリクエストで失敗します。トークンは `Authorization: Bearer` ヘッダーでのみ受け付けられ、クエリ文字列やリクエストボディ内のトークンは受け付けられません。

## クライアントの接続

MCP エンドポイントには `https://cacti.example.com/cacti/plugins/mcp/mcp.php` を使用し、トークンを `Authorization: Bearer` ヘッダーに含めます。トークンの値をファイルに直接記述するのではなく、環境変数またはシークレットマネージャーに保存し、クライアント設定から参照してください。

### Claude Code

トークンを名前で参照するプロジェクトの `.mcp.json` にエンドポイントを記述します。Claude Code は `url` および `headers` 内の `${VAR}` を展開するため、ファイルにシークレットが含まれず、安全にコミットできます。Claude Code を起動する環境で `CACTI_MCP_TOKEN` をエクスポートしてください。

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

コマンドラインから追加することもできます:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

ダブルクォートを使用するとシェルが先に `$CACTI_MCP_TOKEN` を展開するため、選択した `--scope`（`local`、`user`、または `project`。デフォルトは `local`）の設定ファイルにトークンの値が書き込まれます。`--scope project` ではこの形式を使用せず、そのファイルをバージョン管理の対象外にしてください。上記の `.mcp.json` での参照を推奨します。Claude Code は一部の認証情報変数（`ANTHROPIC_AUTH_TOKEN` など）をリモートの `url` および `headers` で空として読み取りますが、`CACTI_MCP_TOKEN` はそれに該当しません。出典: [Claude Code MCP ドキュメント](https://code.claude.com/docs/en/mcp)。

### VS Code の GitHub Copilot

ワークスペースルートの `.mcp.json`（またはユーザーファイル `~/.copilot/mcp-config.json`）を使用します。これらの Copilot ネイティブファイルでは、トップレベルの `mcpServers` オブジェクトと、ヘッダー値での `${NAME}` 環境変数参照を使用します:

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

VS Code を起動する環境で `CACTI_MCP_TOKEN` をエクスポートしてください。Copilot ネイティブファイルは `inputs` プロンプトをサポートしていません。VS Code のガイド付きセットアップでは `${...}` の値が拒否されるため、`Authorization` ヘッダーはガイド付きフローではなくファイルを直接編集して追加してください。ガイド付きセットアップでワークスペースルートファイルが提示されるのは、実験的設定 `chat.mcp.workspaceRootConfig.enabled` が有効な場合のみです。[VS Code MCP 設定リファレンス](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)を参照してください。

**レガシー: `.vscode/mcp.json`。** VS Code によると、新しい Copilot 設定では `.vscode/mcp.json` やプロファイルの `mcp.json` を使用すべきではありません。これらは非推奨となった Local ハーネスに属しており、2027年2月に削除される予定です。引き続き使用する場合は、エディター管理形式ではトップレベルの `servers` キーを使用し、トークンの入力を促すプロンプトを設定できます:

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

### stdio のみに対応するクライアント

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) は、ローカルの stdio MCP サーバーとして動作し、プラグインの HTTP API を呼び出すオプションのアダプターです。リモート HTTP サーバーに接続できないクライアントに使用してください。同じ個人用トークンが必要であり、`api.php` と通信します。

### MCP の動作

このエンドポイントはツールのみを提供します。公開され許可された各アビリティは、その ID を名前とするツールとして公開され、入出力スキーマと読み取り専用アノテーション（`openWorldHint` は `false`）を持ちます。`initialize`、`server/discover`、`ping`、`tools/list`、`tools/call` を処理します。セッションは保持せず、`Mcp-Session-Id` を送信しません（受信しても無視します）。また、JSON-RPC バッチは受け付けません。`id` のないメッセージは通知とみなされ、ボディなしの HTTP 202 が返されます。許可されるのは `POST` のみです。

- **リビジョン。** `params._meta` に `io.modelcontextprotocol/protocolVersion` を含むリクエストでは `2026-07-28` を指定する必要があります。それ以外の値にはエラー `-32022` が返されます。このようなリクエストには、一致する `Mcp-Protocol-Version`、`Mcp-Method`、および（`tools/call` の場合は）`Mcp-Name` ヘッダーも含める必要があり、そうでない場合はエラー `-32020` が返されます。その他のリクエストは `2025-11-25` として扱われます。`initialize` はこのリビジョンで応答し、他のメソッドで `Mcp-Protocol-Version` ヘッダーが送信された場合は、`2025-11-25`、`2025-06-18`、または `2025-03-26` である必要があります。
- **ツールエラー。** スキーマに一致しない引数や JSON オブジェクトではない `arguments` の値など、アビリティエラーはプロトコルエラーとしてではなく、`isError: true` と `structuredContent` 内の AIP-193 エラーを含むツール結果として返されます。
- **プロトコルエラー。** ツールエラー以外の失敗は JSON-RPC エラーオブジェクト（`data` にステータスと理由を含むコード `-32000`、または標準コード）として返されます。対象となるのは、Public Cacti URL が未設定の場合、拒否された `Origin`、プラグイン無効時やリモートポーラー上でのリクエスト、および予期しないサーバーエラー（`-32603`、詳細はレスポンスではなく Cacti ログに出力されます）です。最初に実行されるリクエストチェック（405、413、415）および認証エラー（401 `INVALID_TOKEN`、403 `REALM_REQUIRED`）では、HTTP API のセクションで説明されている AIP-193 ボディがそのまま返されます。

## HTTP API

ベース URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`。コントラクトは [openapi.json](../../../openapi.json) にあります。

| メソッドとパス | 用途 |
| --- | --- |
| `GET /v1/abilities` | 許可されたアビリティを一覧表示します。クエリ: `pageSize`、`pageToken`、および `category = "inventory"` 形式の `filter`。 |
| `GET /v1/abilities/{id}` | 1つのアビリティを取得します。 |
| `POST /v1/abilities/{id}:execute` | アビリティを実行します。リクエストボディは厳密に `{"arguments": {...}}` です。レスポンスは `{"requestId": "...", "result": {...}}` です。 |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

エラーは AIP-193 に従います。`code`、`message`、`status`、およびドメイン `cacti.net` と安定した `reason` を持つ `ErrorInfo` を格納する `details` を含んだ `error` オブジェクトが返されます。引数の問題では、フィールド名を示す `BadRequest` の詳細が追加されます。リクエストボディの上限は 64 KB、結果の上限は 1 MB です。どちらのエンドポイントもメインポーラー上でのみ応答し、プラグインが無効であるか、サーバーがメインポーラーでない場合は `UNAVAILABLE`（`PLUGIN_UNAVAILABLE`）を返します。

| HTTP | `reason` の値 |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN`（`WWW-Authenticate: Bearer` も送信されます） |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED`（`Allow` が送信されます） |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## アビリティの作成（プラグイン開発者向け）

有効化された Cacti プラグインは、通常 `plugin_<slug>_install()` 内で `abilities_register` フックにアタッチした関数からアビリティを登録します:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

この関数は、そのプラグインにスコープ設定された `AbilitiesRegistrar` を受け取ります。戻り値は無視されます。

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

登録時にすべて適用されるルールは次のとおりです:

- **ID。** ID は `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` に一致し、最大 64 文字で、プラグインのスラッグとハイフン（上記の例では `acme-`）で始まる必要があります。スラッグはプラグインのディレクトリ名であるため、`my_plugin` のようなディレクトリでは何も登録できません。`cacti` という名前のプラグインディレクトリは拒否されます。その名前空間は組み込みアビリティ用です。
- **定義。** 次のキーのみを厳密に含める必要があります: `label`、`description`（最大 4096 バイト）、`category`、`input_schema`、`output_schema`、`annotations`、`permission`、`execute`。カテゴリは既に存在している必要があります。組み込みカテゴリ（`inventory`、`system`）を使用するか、`registerCategory()` で独自のカテゴリを登録してください。独自カテゴリの ID はすべてのプラグイン間で一意であり、`^[a-z][a-z0-9-]{0,31}$` に一致する必要があります。
- **読み取り専用のみ。** `annotations` は厳密に `readOnly: true`、`destructive: false`、`idempotent: true` である必要があります。それ以外の場合は例外がスローされます。
- **スキーマ。** `input_schema` と `output_schema` は、それぞれトップレベルの `type` が `object` である必要があります。このスキーマ方言は小規模でフェイルクローズドです。オブジェクトは閉じている必要があります（`additionalProperties: false`、かつ `properties` が存在すること）。その他の型は `integer` および `number`（`minimum`、`maximum`）、`string`（`minLength`、`maxLength`、`enum`、`pattern`）、`boolean`、および `array`（`items` と `maxItems` が必要）です。型は `['string', 'null']` のように null 許容にすることができます。引数の文字列はデフォルトで最大 4096 文字です。結果の文字列は、宣言された `maxLength` と結果サイズの上限によってのみ制限されます。登録できるアビリティは最大 256 個です。
- **`permission(int $userId): bool`。** 許可するには厳密に `true` を返す必要があります。ユーザー ID はトークン所有者のものです。セッション状態は決して読み取らないでください。
- **`execute(int $userId, stdClass $args): array`。** `$args` はすでに `input_schema` に対して検証済みです。オブジェクトレベルの権限は各自で適用してください。`output_schema` に厳密に一致する連想配列を返してください。リスト、余分なフィールド、または 1 MB を超える JSON は `INVALID_RESULT` エラーになります。`NOT_FOUND` など、クライアントに表示される失敗には `AbilitiesError` をスローしてください。
- **空のオブジェクト。** PHP は `[]` を JSON 配列としてエンコードします。出力スキーマで `object` が宣言されている箇所では、どの階層であってもレジストリは `[]` を空のオブジェクトとして扱い `{}` を送信します。`new stdClass()` も同様に機能します。空でないリストはオブジェクトとはみなされず、`INVALID_RESULT` で失敗します。スキーマ内の空の `properties` マップは `[]` または `new stdClass()` のいずれでもよく、どちらも `{}` として公開されます。
- **障害の分離。** 各プラグインはスクラッチコピーに登録を行い、関数が正常に返った場合にのみその内容が保持されます。例外がスローされた場合、そのプラグインのアビリティはいずれも登録されず、失敗がログに記録されます。

プラグインからのアビリティは初期状態では非表示です。管理者がコンソールの Abilities タブでこれらを公開すると、Required Realm 列には「Set by the plugin」と表示されます。

## セキュリティモデル

- **Bearer トークンのみ。** `api.php` および `mcp.php` は、
  `Authorization` ヘッダー内の個人トークンのみを受け付け、それ以外は受け付けません。Cacti が読み込まれる前に Cookie、`$_POST`、および
  `$_REQUEST` を破棄し、Cacti が開始するセッションも破棄するため、ブラウザーでの
  ログインによって API アクセスが許可されることはありません。
- **CSRF 対策の回避処理。** Cacti の CSRF 保護機能は、Cacti の CSRF
  トークンを含まない JSON POST を拒否しますが、MCP クライアントはこのトークンを送信できません。これら 2 つのエンドポイントに限り、プラグインは
  Cacti の読み込み前にリクエストメソッド名を変更し、読み込み後に元のメソッド名へ復元することで、
  CSRF 保護をスキップさせています。CSRF 保護はブラウザーが Cookie を用いて認証するリクエストを保護するためのものであり、
  これらのエンドポイントは Cookie による認証情報を受け付けないため（クロスサイトページから
  Bearer トークンを付与できないため）、この処理は安全です。コンソールページでは完全な CSRF
  保護が維持されます。この回避処理は Cacti が公式に免除機能を提供するまでの一時的な措置です。
  詳細は `lib/bootstrap.php` を参照してください。
- **Origin チェック。** `mcp.php` では、リクエストに `Origin` ヘッダーが含まれている場合、その値が
  Public Cacti URL のスキーム、ホスト、およびポートと完全に一致している必要があり、一致しない場合は
  `ORIGIN_NOT_ALLOWED` で拒否されます。`Origin` ヘッダーのないリクエスト（ブラウザー以外の
  クライアントが接続する方法）は許可されます。これにより、Web ページが訪問者のブラウザーから
  エンドポイントを操作するのを防ぎます。`api.php` にはこのチェックは適用されません。
- **読み取り専用のみ。** 登録時には、読み取り専用、非破壊的、かつべき等でないアビリティはすべて拒否されます。
- **公開設定とレルムの両方が適用されます。** アビリティが公開されており、かつトークンの
  所有者がそのレルムを保持している必要があります。公開設定テーブルを読み取れない場合、デフォルト値にフォールバックするのではなく、
  すべてのアビリティが非表示になります。
- **非表示、不明、および未許可の扱いは同一です。** クライアントからは、
  存在しないアビリティ、非表示のアビリティ、およびユーザーに使用権限がないアビリティの区別はつきません。
  ディスカバリーでは除外され、実行時には `NOT_FOUND`
  （`ABILITY_NOT_FOUND`）が返されます。
- **トークン。** SHA-256 ハッシュとして保存され、作成時に一度だけ表示されます。常に有効期限が設定され、取り消しが可能であり、
  所有者が無効化された場合やレルムを失った場合は拒否されます。
- **監査。** `plugin_mcp_audit` は、リクエスト ID、トークン ID、ユーザー ID、アビリティ、
  結果（`started`、`succeeded`、`failed`、`denied`、`rejected`）、およびタイムスタンプを記録します。
  引数、実行結果、およびトークン値は一切記録されません。アビリティは `started` 行が書き込まれた後にのみ
  実行されます。監査テーブルが利用できない場合、呼び出しは `UNAVAILABLE` で失敗し、
  実行されません。実行前に拒否された呼び出しは 1 行として記録されます（不明、非表示、または未許可のアビリティの場合は `denied`、
  スキーマ検証に失敗した引数の場合は `rejected`）。コンソール、My MCP Tokens、および CLI からの
  トークン作成と取り消しは、それぞれ `mcp-token-create` と `mcp-token-revoke` として結果 `succeeded` で記録されます。
  なお、取り消しが記録されるのは有効だったトークンのみです。ディスカバリー、および
  `arguments` が JSON オブジェクトではない呼び出しはログに記録されません。
- **障害ログ。** 予期しない障害、`INVALID_RESULT`、または監査テーブルが利用できない場合は、
  ファシリティ `MCP` としてアビリティ ID、固定の理由、および例外クラスが Cacti ログに 1 行書き込まれます。
  メッセージ、引数、およびトークンは一切ログに記録されません。
- **メインポーラーのみ。** 両方のエンドポイント、両方のコンソールページ、および `tokens.php` は、
  メインポーラー以外での実行を拒否します。

## ライフサイクル

プラグインを無効化すると、両方のエンドポイントがブロックされます。アンインストールするとすべてのトークンが取り消され、
データ保持のために 3 つのテーブル（`plugin_mcp_token`、`plugin_mcp_audit`、
`plugin_mcp_ability`）が残されます。再インストールしても、取り消されたトークンが再度有効になることはありません。
これらのテーブルは Cacti データベースとあわせてバックアップし、プラグイン外で監査データの保持ポリシーを
適用してください。

## 開発とテスト

テストスイートには、`tests/` 内の通常の PHP スクリプトに加えて、`tests/Unit/` 内の PHPUnit ユニットテストおよび PHPStan 静的解析（レベル 6）が含まれており、いずれも Cacti をインストールせずに実行できます:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI は PHP 8.2 から 8.5 上で実行されます。PHP 構文の lint（`php -l`）と `.github/workflows/ci.yml` に記載された 13 個の通常 PHP テストスクリプトを実行する `test` ジョブ、`composer phpstan` と `composer test` を実行する `quality` ジョブ、およびインストール可能な `mcp/` アーカイブ（`.gitattributes` に記載された開発用およびテスト用ファイルを除く）とその `SHA256SUMS` をビルドする `package` ジョブで構成されています。Cacti に関わるテストでは Cacti ヘルパー境界のフィクスチャを使用しており、完全な Cacti 環境でのテストは行いません。

### 統合テスト

`tests/integration/run.sh 1.2.31` または `tests/integration/run.sh develop` は、
コンテナー内の実際の Cacti 環境にプラグインをインストールし、ライブチェックを実行します。これには Docker（Compose v2.23.1 以降）、
git、および openssl が必要です。`KEEP=1` を指定すると、デバッグ用にスタックを起動したままにできます。CI ではこれを
プルリクエスト時ではなく、夜間定期実行およびオンデマンドで実行します。

## ローカライズ

Cacti MCP には、`locales/po/` および `locales/LC_MESSAGES/` 配下にコンパイル済みの GNU gettext カタログが、
`docs/i18n/` 配下に英語および 47 ロケール（Broad Tier 1 が 19、アフリカが 15、アジアが 10、およびボスニア語・クロアチア語・セルビア語）向けのローカライズ済み README が含まれており、`mcp` テキストドメイン（`locales/po/mcp.pot`）を使用しています。
言語サポートが有効になっている場合、Cacti は一致するカタログを自動的に読み込みます。

## コントリビューション

プルリクエストは `develop` ブランチ宛てに送信してください。本番コードは PHP 8.2 との互換性を維持し、
Cacti のスタイル（タブインデント、シングルクォート文字列、Cacti のデータベースおよび
権限ヘルパー）に従ってください。検証、認可、またはプロトコルの動作を変更した場合はテストを追加し、
`git commit -s` でコミットに署名してください。HTTP API への変更は [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) と連携して調整してください。

## ライセンス

Copyright (C) 2026 Thomas Vincent. GNU General Public
License バージョン 2 以降の下で公開されています。詳細は [LICENSE](../../../LICENSE) を参照してください。
