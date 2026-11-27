<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: 방패를 든 선인장. 탐색. 인가. 실행.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="라이선스: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP는 AI 클라이언트가 어빌리티(ability)라는 이름 기반의 권한 필터링 작업을 통해
Cacti 데이터를 읽을 수 있게 해주는 Cacti 플러그인입니다. 플러그인 자체에서 MCP
엔드포인트(`mcp.php`, Streamable HTTP)와 AIP 스타일 HTTP API(`api.php`)의 두 가지
방식으로 제공합니다. 인가와 실행 제어는 계속 Cacti가 담당합니다. 클라이언트는
데이터베이스에 직접 쿼리하지 않으며, 관리자가 공개했고 토큰 소유자의 Cacti 영역(realm)이
허용하는 어빌리티만 호출할 수 있습니다.

플러그인 작성자는 `abilities_register` 훅을 통해 자체 읽기 전용 어빌리티를
등록할 수 있으며, 별도의 프로토콜 코드 없이도 MCP 클라이언트에 도구로 표시됩니다.

**상태: 사전 릴리스(pre-release), 버전 0.1.0.** 아직 태그가 지정된 릴리스는 없습니다.

현재 사용 가능한 기능:

- 시스템 버전, 장치, 사이트, 폴러, 그래프 트리, 그래프, 데이터 소스 및
  제한되고 마스킹된 Cacti 로그 끝부분(tail)을 다루는 9개의 읽기 전용 내장 어빌리티
- 유일한 인증 수단으로서의 개인 액세스 토큰(`cmcp_pat_...`)
- Management > MCP 콘솔: 어빌리티 공개 또는 숨김, 토큰 생성 및 폐기,
  감사 로그 조회
- Management > My MCP Tokens: 사용자가 자신의 토큰을 관리하고, 활동 내역을
  확인하며, 토큰으로 사용할 수 있는 도구를 조회
- Streamable HTTP 기반 MCP(프로토콜 리비전 `2026-07-28` 및 `2025-11-25`,
  도구 기능만 지원)

아직 지원되지 않는 기능:

- OAuth 2.1 로그인. ChatGPT 및 claude.ai 커스텀 커넥터처럼 개인 토큰을 전송할 수
  없는 호스팅 커넥터는 이 기능이 구현되기 전까지 연결할 수 없습니다. 이는 Plan 2로
  예정되어 있으며, 해당 계획 문서는 아직 작성되지 않았습니다.
- 쓰기 어빌리티. 읽기 전용 어빌리티만 등록할 수 있습니다.

설계 문서는
[엔드포인트 설계 사양](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)에서,
구현 순서는 [docs/plan.md](../../plan.md)에서 확인할 수 있습니다.

## 내장 어빌리티

| ID | 카테고리 | 인수 | 필요한 Cacti 영역 |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | 없음 | 15 |
| `cacti-list-devices` | `inventory` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | 필수: `name` (예: `devices/12`) | 3 |
| `cacti-list-sites` | `inventory` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 7 또는 4 |
| `cacti-list-graphs` | `inventory` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 7 또는 5 |
| `cacti-list-data-sources` | `inventory` | 선택 사항: `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | 선택 사항: `lines` (1~200, 기본값 50), `severity`, `search` | 19 또는 18 |

모든 호출에는 토큰 소유자의 **MCP and Abilities API** 영역, `abilities:read`
스코프(모든 개인 토큰에 기본 포함), 그리고 공개된 어빌리티가 추가로 필요합니다.
각 내장 어빌리티에 필요한 기본 영역은 콘솔의 Abilities 탭에서 확인할 수 있습니다.

6개의 `cacti-list-*` 어빌리티는 모두 최대 100개 항목(기본값 50개)과
`nextPageToken`을 페이지 단위로 반환합니다. 페이지 토큰은 동일한 `filter` 및
`orderBy` 조건에서만 유효합니다. `filter`는 `AND`로 연결된 비교식(`=`, `!=`,
`<`, `<=`, `>`, `>=`)의 AIP-160 표현식입니다(예:
`state = "DOWN" AND disabled = false`). `orderBy`는 쉼표로 구분된 정렬 가능
필드 목록을 허용하며, 각 필드 뒤에 선택적으로 `asc` 또는 `desc`를 붙일 수
있습니다.

| 어빌리티 | 필터 필드 | 정렬 필드 |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

권한 범위 제한 및 비밀 정보 제외:

- `cacti-list-devices`와 `cacti-get-device`는 Cacti의 `get_allowed_devices()`를
  통해 조회하며 SNMP 커뮤니티 문자열, 패스프레이즈 및 기타 자격 증명을 제외합니다.
- `cacti-list-trees`는 `get_allowed_trees()`를 통해 조회하고(가능한 경우
  `is_tree_allowed()`로 필터링), `cacti-list-graphs`는 `get_allowed_graphs()`를
  통해 조회합니다(가능한 경우 `is_graph_allowed()`로 필터링).
- `cacti-list-data-sources`는 `get_allowed_devices()`(및 가능한 경우
  `is_device_allowed()`)에서 얻은 호출자의 허용 장치로 행을 제한하며,
  `data_input_data`를 조회하거나 비밀 입력값을 노출하지 않고 메타데이터만 반환합니다.
- `cacti-list-pollers`는 데이터베이스 자격 증명(`dbpass`, `dbuser`)과 TLS 키 및
  인증서 열(`dbsslkey`, `dbsslcert`, `dbsslca`)을 제외합니다.
- `cacti-get-clog`는 구성된 Cacti 로그의 마지막 최대 1 MiB를 읽고(2048바이트를
  초과하는 개별 줄은 자름), `severity`(`ALL`, `DEBUG`, `INFO`, `NOTICE`,
  `WARNING`, `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`, `STATS`,
  `POLLER`, `SYSTEM`; 기본값 `ALL`)와 대소문자를 구분하지 않는 `search`(최대
  256자)로 필터링하여 `lines`, `count`, `truncated`를 반환합니다. `search`가
  비밀 정보 추측 수단(secret oracle)으로 악용되지 않도록 `severity`와 `search`
  필터를 실행하기 전에 각 줄에서 개인 토큰, Bearer/Basic 헤더, 비밀번호, 비밀값,
  SNMP 커뮤니티, 키, `dbpass`, `dbsslkey` 및 URL 사용자 정보를 마스킹합니다.
  마스킹은 `[redacted]`로 fail-closed 동작하며, 읽을 수 없는 로그는
  `FAILED_PRECONDITION`(`LOG_UNAVAILABLE`)을 반환합니다.

## 설치

Cacti 1.2.31 이상, PHP 8.2 이상 및 메인 폴러(main poller)가 필요합니다. Cacti
인증이 활성화되어 있어야 하며, 인증이 꺼져 있으면 플러그인이 인증 요청을 거부합니다.

플러그인 디렉터리 이름은 `plugin_mcp`가 아니라 반드시 `mcp`여야 합니다. 플러그인
슬러그, 영역 이름, 번역 도메인 및 URL 모두 `mcp`를 사용합니다.

소스 체크아웃에서 설치하는 경우:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

태그된 릴리스가 제공되기 전까지는 성공한
[CI 실행](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)에서
`mcp-plugin` 아티팩트를 대신 다운로드할 수 있습니다. 이 아티팩트에는
`mcp.tar.gz`와 `SHA256SUMS`가 포함되어 있습니다. 체크섬을 검증한 뒤 Cacti의
`plugins/` 디렉터리 안에 `mcp.tar.gz`의 압축을 풀어 최종 경로가
`plugins/mcp/`가 되도록 하세요. GitHub의 자동 소스 아카이브는 최상위 디렉터리 이름이
다릅니다. 또한 이 아카이브에는 `docs/`(아래 스크린샷 포함), `tests/`,
`.github/`가 빠져 있으므로 README에서 `docs/`를 가리키는 링크는 GitHub에서는
동작하지만 설치된 사본에서는 동작하지 않습니다.

그런 다음:

1. Plugin Management에서 **Cacti MCP**를 설치하고 활성화합니다. 설치를 수행한
   관리자에게는 **MCP Administration** 영역이 자동으로 부여됩니다.
2. Settings > MCP에서 **Public Cacti URL**을 클라이언트가 접속하는 주소(예:
   `https://cacti.example.com/cacti`)로 설정합니다. `localhost`, `127.0.0.1`,
   `[::1]`을 제외하면 HTTPS가 필수입니다. 이 값이 설정될 때까지 `mcp.php`는
   `data`에 `FAILED_PRECONDITION`과 `PUBLIC_URL_REQUIRED`를 담은 JSON-RPC
   오류와 함께 HTTP 400을 반환합니다. `api.php`는 이 설정을 읽지 않습니다.

   ![Public Cacti URL 필드가 표시된 Settings > MCP 화면](../../images/settings-public-url.png)

3. 토큰을 소유할 각 사용자에게 **MCP and Abilities API** 영역을 부여합니다. 이 영역은
   어떤 사용자에게도 자동으로 부여되지 않습니다.
4. 웹 서버가 `Authorization` 헤더와 경로 정보(path info)를 PHP에 전달하도록
   설정합니다(아래 참조).
5. Management > MCP를 열어 클라이언트에 공개할 어빌리티를 노출합니다.

**개발 빌드에서 업그레이드하기.** 이 플러그인은 사전 릴리스 상태이며, 개발 과정에서
마이그레이션 없이 테이블 구조가 변경되었습니다. 이전 빌드를 설치한 적이 있다면
제거(uninstall)한 뒤 다시 설치하세요. 재설치 시 기존 테이블이 그대로 유지되므로,
먼저 기존 `plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`
테이블(및 이름 변경 이전 빌드에서 생성된 해당 테이블)을 삭제해야 합니다. 이력이
필요하다면 미리 백업하세요. 해당 빌드의 토큰은 제거 시 폐기되며 새 설치로 이어지지
않습니다.

### 웹 서버

PHP로 전달되기 전에 `Authorization` 헤더를 제거하는 Apache 구성에서는 해당 가상
호스트 또는 디렉터리 설정에 다음을 추가한 뒤 설정을 다시 로드해야 합니다:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php`를 사용하는 Apache에서는 별도의 경로 설정 없이 `api.php` 라우트가 정상
동작했습니다.

`api.php` 라우트는 스크립트 이름 뒤의 경로(`/plugins/mcp/api.php/v1/abilities`)에
위치하므로, nginx에서 `.php` 뒤에 추가 경로가 붙은 URI를 일치시켜 path info를
분리한 뒤 PHP로 전달해야 합니다. `location ~ \.php$` 블록은 이러한 URL과 일치하지
않으며, nginx가 자체 HTML 404 응답을 반환합니다. 아래의 location 패턴과 두 줄의
path-info 설정은 PHP-FPM 환경에서 검증되었으며, 나머지 줄은 표준 기본 설정입니다:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

이미 Cacti를 서비스하는 블록에 맞추어 `include`와 `fastcgi_pass` 줄을 조정하세요.
이 블록에 `try_files $fastcgi_script_name =404;`를 추가하지 마세요. 해당 지시어는
`$fastcgi_path_info`를 비워 버려 `api.php`가 404 `UNKNOWN_PATH`를 반환하게
만듭니다. 구성상 `try_files`가 꼭 필요하다면 먼저
`set $path_info $fastcgi_path_info;`로 값을 저장한 뒤
`fastcgi_param PATH_INFO $path_info;`를 전달하세요.

`mcp.php`는 경로 라우트를 사용하지 않으므로 이 설정이 필요하지 않습니다.

## 콘솔

Management > MCP에는 세 개의 탭이 있습니다. 이를 사용하려면
**MCP Administration** 영역이 필요합니다. 여기와 아래에 포함된 스크린샷은 예제
데이터가 들어 있는 Cacti 개발 빌드에서 촬영되었습니다.

- **Abilities** 탭에는 등록된 모든 어빌리티와 해당 플러그인, 카테고리, 필요한
  영역 및 공개 여부가 표시됩니다. 행을 선택하고 Expose 또는 Hide를 선택한 뒤
  확인하면 변경 사항이 적용됩니다. 내장 `cacti-*` 어빌리티는 기본적으로 공개되어
  있습니다. 다른 플러그인의 어빌리티는 숨김 상태로 시작하므로, 관리자가 결정하기
  전까지는 플러그인을 설치해도 아무것도 외부에 공개되지 않습니다. 공개 설정은 접근
  범위를 좁히는 역할만 하므로, 사용자는 여전히 해당 어빌리티의 영역 권한을 가지고
  있어야 합니다.

  ![내장 어빌리티와 각 영역 및 공개 상태를 나열한 Abilities 탭](../../images/console-abilities.png)
- **Tokens** 탭에는 토큰의 소유자, 생성자, 생성일, 만료일, 마지막 사용일 및
  상태(Active, Expired, Revoked)가 나열됩니다. 행을 선택하고 Revoke를 선택하면
  토큰을 폐기할 수 있습니다. 폐기된 토큰은 다시 사용할 수 없습니다. Create Token으로
  새 토큰을 생성합니다.

  ![소유자, 만료일, 마지막 사용일, 상태가 표시된 토큰 목록과 그 아래의 Create Token 양식이 보이는 Tokens 탭](../../images/console-tokens.png)
- **Audit** 탭에는 감사 기록이 최신순으로 나열되며, 사용자, 어빌리티 및 결과별로
  필터링할 수 있습니다.

  ![사용자, 토큰, 어빌리티, 결과별 호출 내역과 필터가 표시된 Audit 탭](../../images/console-audit.png)

## 토큰

개인 토큰은 소유자의 권한으로 Cacti 데이터를 읽습니다. 형식은 `cmcp_pat_` 뒤에
소문자 16진수 64자가 이어지며, 단일 스코프 `abilities:read`만 가집니다. 토큰이
조회할 수 있는 대상은 토큰 자체가 아니라 소유자의 Cacti 영역과 장치 권한에 의해
결정됩니다. 소유자는 **MCP and Abilities API** 영역을 보유한 활성 상태의 사용자여야
합니다.

토큰은 항상 특정 사용자에게 귀속되어 생성되며, 만료 기간이 있고, 폐기할 수 있습니다:

- **콘솔.** Management > MCP > Tokens > Create Token 경로에서 생성합니다.
  유효 기간은 1~365일이며 기본값은 90일입니다. 토큰은 서버에서 생성되어 응답
  페이지에 단 한 번만 표시되므로, 즉시 시크릿 매니저에 복사해 두세요. 본인용
  토큰을 생성할 수 있으며, 다른 사용자의 토큰을 생성하려면 해당 사용자의 권한으로
  Cacti를 읽게 되므로 Users/Groups 영역도 필요합니다.
- **My MCP Tokens.** MCP and Abilities API 영역을 가진 사용자는 누구나 자신의
  토큰을 관리할 수 있습니다(아래 참조).
- **명령줄.** `tokens.php`는 CLI 환경에서만 Cacti를 관리할 수 있는 OS 계정으로
  실행됩니다. 명령줄이나 프로세스 목록에 토큰 값이 노출되지 않도록 환경 변수에서
  토큰을 입력받습니다. 유효 기간은 1~365일이며 기본값은 30일입니다. CLI를 통한
  토큰 생성 및 폐기도 콘솔과 동일하게 감사 로그에 기록되지만, CLI에는 Cacti
  사용자 세션이 없으므로 토큰 소유자가 행위자로 기록되며 감사 행에 CLI에서 실행된
  작업이라는 별도 표시는 남지 않습니다. `--list`는 모든 토큰을 JSON(ID, 소유자,
  스코프, 타임스탬프, 폐기 플래그)으로 출력하며 토큰 값은 절대 출력하지 않습니다.
  `--help`는 사용법을 보여줍니다.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

게스트 계정, 비활성화된 사용자, 또는 **MCP and Abilities API** 영역이 없는 사용자에
대해서는 콘솔, 명령줄, My MCP Tokens 어느 경로로도 토큰을 생성할 수 없습니다.
Cacti는 게스트 설정을 사용자 이름 또는 사용자 ID로 저장하며, 플러그인은 두 형식
모두를 확인합니다. 소유자가 게스트 계정으로 변경된 토큰은 다음 요청부터 동작을
중지합니다.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`)에는 관리 영역이 필요하지
않습니다. **MCP and Abilities API** 영역으로 접근이 허용되며, 해당 영역을 보유한
사용자에게만 메뉴 항목이 표시됩니다. 이 페이지는 항상 현재 로그인한 사용자를
대상으로 동작합니다. Cacti의 메뉴는 콘솔의 일부이므로 콘솔 접근 권한이 없는
사용자는 페이지 주소로 직접 접속해야 합니다.

![로그인한 사용자의 토큰 목록과 생성 양식이 표시된 My Tokens 탭](../../images/my-tokens.png)

- **Tokens**는 본인의 토큰 목록을 보여주고, 새 토큰을 생성하며(1~365일, 기본값
  90일, 응답에 1회만 표시), 본인의 토큰을 폐기합니다. 다른 사용자의 토큰은 조회하거나
  폐기할 수 없습니다.
- **Activity**는 본인의 토큰으로 이루어진 호출과 본인이 수행한 토큰 변경 등 수행한
  작업을 최신순으로 나열합니다.
- **Available Tools**는 현재 본인의 토큰으로 사용할 수 있는 어빌리티를 각
  어빌리티의 ID, 이름, 설명과 함께 나열합니다. 이 목록은 본인의 Cacti 권한과
  관리자가 선택한 공개 설정을 따릅니다.

  ![각 어빌리티의 ID, 이름, 설명이 표시된 Available Tools 목록](../../images/my-tools.png)

이 페이지가 추가되기 전에 설치된 환경에는 영역 파일 목록에 `mcp_tokens.php`가
빠져 있습니다. 파일 목록은 설치 시 등록되며, 플러그인을 활성화하거나 비활성화해도
갱신되지 않습니다. 플러그인을 제거(uninstall)하고 다시 설치한 다음, 플러그인
제거 시 Cacti가 영역 권한 부여 내역을 삭제하므로 영역을 다시 부여하세요.

데이터베이스에는 토큰의 SHA-256 해시만 저장되므로 분실한 토큰은 복구할 수 없습니다.
폐기한 뒤 새 토큰을 생성하세요. 토큰 교체(rotation)도 마찬가지입니다. 새 토큰을
생성해 클라이언트를 전환한 다음 기존 토큰을 폐기하면 됩니다. 만료된 토큰, 폐기된
토큰, 비활성화된 소유자, 또는 영역 권한 상실은 모두 다음 요청 시 실패합니다. 토큰은
`Authorization: Bearer` 헤더에서만 허용되며, 쿼리 문자열이나 요청 본문에 담긴 토큰은
허용되지 않습니다.

## 클라이언트 연결

`Authorization: Bearer` 헤더에 토큰을 담아 MCP 엔드포인트 `https://cacti.example.com/cacti/plugins/mcp/mcp.php`를 사용하세요. 토큰 값을 파일에 직접 기록하지 말고 환경 변수나 시크릿 관리자에 보관한 뒤 클라이언트 구성에서 참조하세요.

### Claude Code

토큰을 이름으로 참조하는 프로젝트 `.mcp.json`에 엔드포인트를 추가하세요.
Claude Code는 `url` 및 `headers`에서 `${VAR}`를 확장하므로 파일에 비밀 정보가 포함되지 않아 커밋해도 안전합니다. Claude Code를 시작하는 환경에서 `CACTI_MCP_TOKEN`을 내보내세요(export).

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

명령줄에서 추가할 수도 있습니다:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

큰따옴표를 사용하면 셸이 `$CACTI_MCP_TOKEN`을 먼저 확장하므로 선택한 `--scope`(`local`, `user` 또는 `project`; 기본값 `local`)의 구성 파일에 토큰 값이 직접 기록됩니다. `--scope project`에는 이 형식을 사용하지 말고 해당 파일을 버전 관리에 포함하지 마세요. 가급적 위의 `.mcp.json` 참조 방식을 사용하세요. Claude Code는 원격 `url` 및 `headers`에서 일부 자격 증명 변수(예: `ANTHROPIC_AUTH_TOKEN`)를 빈 값으로 읽지만, `CACTI_MCP_TOKEN`은 이에 해당하지 않습니다. 출처: [Claude Code MCP 문서](https://code.claude.com/docs/en/mcp).

### VS Code의 GitHub Copilot

워크스페이스 루트 `.mcp.json`(또는 사용자 파일 `~/.copilot/mcp-config.json`)을 사용하세요. 이러한 Copilot 기본 파일은 최상위 `mcpServers` 객체와 헤더 값의 `${NAME}` 환경 변수 참조를 사용합니다:

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

VS Code를 시작하는 환경에서 `CACTI_MCP_TOKEN`을 내보내세요. 기본 Copilot 파일은 `inputs` 프롬프트를 지원하지 않습니다. VS Code의 안내 설정(guided setup)은 `${...}` 값을 거부하므로, 안내 흐름을 통하지 말고 파일을 직접 편집하여 `Authorization` 헤더를 추가하세요. 안내 설정에서는 실험적 설정인 `chat.mcp.workspaceRootConfig.enabled`가 켜져 있을 때만 워크스페이스 루트 파일을 제공합니다. [VS Code MCP 구성 참조](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)를 확인하세요.

**레거시: `.vscode/mcp.json`.** VS Code에 따르면 새로운 Copilot 구성에는 `.vscode/mcp.json`이나 프로필 `mcp.json`을 사용하지 않아야 합니다. 이는 2027년 2월에 제거될 예정인 지원 중단된 Local 하네스에 속합니다. 여전히 이 방식을 사용하는 경우, 편집기에서 관리하는 형식은 최상위 `servers` 키를 사용하며 토큰 입력을 요청할 수 있습니다:

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

### stdio만 지원하는 클라이언트

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp)는 로컬 stdio MCP 서버로 실행되어 플러그인의 HTTP API를 호출하는 선택적 어댑터입니다. 원격 HTTP 서버에 연결할 수 없는 클라이언트에서 사용하세요. 동일한 개인 토큰이 필요하며 `api.php`와 통신합니다.

### MCP 동작

엔드포인트는 도구(tools)만 제공합니다. 노출되고 허용된 각 어빌리티(ability)는 해당 ID를 이름으로 하는 도구가 되며, 입력 및 출력 스키마와 읽기 전용 어노테이션(`openWorldHint`는 `false`)을 가집니다. `initialize`, `server/discover`, `ping`, `tools/list` 및 `tools/call`을 처리합니다. 세션을 유지하지 않고 `Mcp-Session-Id`를 전송하지 않으며(수신해도 무시함), JSON-RPC 배치를 허용하지 않습니다. `id`가 없는 메시지는 알림(notification)으로 간주되어 본문 없이 HTTP 202를 반환합니다. `POST`만 허용됩니다.

- **리비전(Revisions).** `params._meta`에 `io.modelcontextprotocol/protocolVersion`을 포함하는 요청은 반드시 `2026-07-28`을 지정해야 하며, 그 외의 값은 `-32022` 오류를 반환합니다. 이러한 요청은 일치하는 `Mcp-Protocol-Version`, `Mcp-Method` 및 (`tools/call`의 경우) `Mcp-Name` 헤더도 함께 보내야 하며, 그렇지 않으면 `-32020` 오류로 응답합니다. 그 밖의 요청은 `2025-11-25`로 처리됩니다. `initialize`는 해당 리비전으로 응답하며, 다른 메서드에서 `Mcp-Protocol-Version` 헤더를 보낸 경우 반드시 `2025-11-25`, `2025-06-18` 또는 `2025-03-26`이어야 합니다.
- **도구 오류(Tool errors).** 스키마와 일치하지 않는 인수나 JSON 객체가 아닌 `arguments` 값을 포함한 어빌리티 오류는 프로토콜 오류가 아니라 `isError: true` 및 `structuredContent` 내의 AIP-193 오류가 포함된 도구 결과로 반환됩니다.
- **프로토콜 오류(Protocol errors).** 도구 오류가 아닌 실패는 JSON-RPC 오류 객체입니다(`data`에 상태와 사유가 포함된 코드 `-32000` 또는 표준 코드). 여기에는 Public Cacti URL 누락, 거부된 `Origin`, 플러그인이 비활성화된 상태 또는 원격 폴러에서의 요청, 예기치 않은 서버 오류(`-32603`, 세부 정보는 응답이 아닌 Cacti 로그에 기록됨)가 포함됩니다. 먼저 실행되는 요청 검사(405, 413, 415)와 인증 실패(401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)는 HTTP API에 설명된 AIP-193 본문 형식을 유지합니다.

## HTTP API

기본 URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. API 계약은 [openapi.json](../../../openapi.json)에 정의되어 있습니다.

| 메서드 및 경로 | 용도 |
| --- | --- |
| `GET /v1/abilities` | 허용된 어빌리티 목록을 조회합니다. 쿼리: `pageSize`, `pageToken`, 및 `category = "inventory"` 형식의 `filter`. |
| `GET /v1/abilities/{id}` | 단일 어빌리티를 조회합니다. |
| `POST /v1/abilities/{id}:execute` | 어빌리티를 실행합니다. 요청 본문은 정확히 `{"arguments": {...}}`입니다. 응답은 `{"requestId": "...", "result": {...}}`입니다. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

오류는 AIP-193을 따릅니다. `code`, `message`, `status`, 그리고 도메인 `cacti.net`과 안정적인 `reason`을 갖는 `ErrorInfo`가 포함된 `details`로 구성된 `error` 객체를 반환합니다. 인수 문제는 필드 이름을 명시하는 `BadRequest` 세부 정보를 추가합니다. 요청 본문은 64 KB로, 결과는 1 MB로 제한됩니다. 두 엔드포인트 모두 메인 폴러에서만 응답하며, 플러그인이 비활성화되었거나 서버가 메인 폴러가 아닌 경우 `UNAVAILABLE`(`PLUGIN_UNAVAILABLE`)을 반환합니다.

| HTTP | `reason` 값 |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer`도 함께 전송) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` 전송) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## 어빌리티 작성 (플러그인 작성자용)

활성화된 Cacti 플러그인은 보통 `plugin_<slug>_install()` 내에서 `abilities_register` 훅에 연결한 함수를 통해 어빌리티를 등록합니다:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

이 함수는 해당 플러그인 범위로 지정된 `AbilitiesRegistrar`를 전달받습니다. 반환값은 무시됩니다.

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

등록 시 모두 적용되는 규칙은 다음과 같습니다:

- **ID.** ID는 `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` 패턴과 일치해야 하고 최대 64자이며, 위의 `acme-`처럼 플러그인의 슬러그와 하이픈으로 시작해야 합니다. 슬러그는 플러그인 디렉터리 이름이므로 `my_plugin`과 같은 디렉터리는 아무것도 등록할 수 없습니다. `cacti`라는 이름의 플러그인 디렉터리는 거부됩니다. 해당 네임스페이스는 내장 기능 전용입니다.
- **정의.** 정확히 다음 키만 허용됩니다: `label`, `description`(최대 4096바이트), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. 카테고리는 이미 존재해야 합니다. 내장 카테고리(`inventory`, `system`)를 사용하거나 모든 플러그인에서 고유하고 `^[a-z][a-z0-9-]{0,31}$`와 일치하는 ID로 `registerCategory()`를 통해 직접 등록하세요.
- **읽기 전용만 허용.** `annotations`는 정확히 `readOnly: true`, `destructive: false`, `idempotent: true`여야 합니다. 그 외의 값은 예외를 발생시킵니다.
- **스키마.** `input_schema`와 `output_schema`는 각각 최상위 `type`이 `object`여야 합니다. 스키마 방언은 제한적이며 fail-closed 방식으로 동작합니다. 객체는 닫혀 있어야 합니다(`additionalProperties: false` 및 `properties` 존재 필수). 그 외 지원 타입은 `integer` 및 `number`(`minimum`, `maximum`), `string`(`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, 그리고 `array`(`items` 및 `maxItems` 필수)입니다. 타입은 `['string', 'null']`처럼 nullable로 지정할 수 있습니다. 인수 문자열은 기본적으로 최대 4096자로 제한되며, 결과 문자열은 선언된 `maxLength`와 결과 크기 제한으로만 제한됩니다. 최대 256개의 어빌리티를 등록할 수 있습니다.
- **`permission(int $userId): bool`.** 허용하려면 정확히 `true`를 반환해야 합니다. 사용자 ID는 토큰 소유자의 ID이며, 세션 상태를 절대 읽지 마세요.
- **`execute(int $userId, stdClass $args): array`.** `$args`는 이미 `input_schema`에 따라 검증된 상태입니다. 객체 수준 권한은 직접 적용하세요. `output_schema`와 정확히 일치하는 연관 배열을 반환하세요. 리스트, 추가 필드 또는 1 MB를 초과하는 JSON은 `INVALID_RESULT` 오류가 됩니다. `NOT_FOUND`처럼 클라이언트에 표시할 실패의 경우 `AbilitiesError`를 throw하세요.
- **빈 객체.** PHP는 `[]`를 JSON 배열로 인코딩합니다. 출력 스키마가 `object`를 선언한 위치에서는 어떤 깊이에서든 레지스트리가 `[]`를 빈 객체로 처리하여 `{}`를 전송하며, `new stdClass()`도 동일하게 작동합니다. 비어 있지 않은 리스트는 객체로 간주되지 않으며 `INVALID_RESULT`로 실패합니다. 스키마의 빈 `properties` 맵은 `[]` 또는 `new stdClass()`일 수 있으며, 둘 다 `{}`로 게시됩니다.
- **실패 격리.** 각 플러그인은 스크래치 복사본에 등록하며, 함수가 정상적으로 반환될 때만 유지됩니다. 예외가 발생하면 해당 플러그인의 어빌리티는 전혀 등록되지 않으며 실패 내용이 로그에 기록됩니다.

플러그인에서 등록된 어빌리티는 처음에 숨김 상태입니다. 관리자가 콘솔의 Abilities 탭에서 이를 노출할 수 있으며, 해당 항목의 Required Realm 열에는 "Set by the plugin"이 표시됩니다.

## 보안 모델

- **베어러 토큰 전용.** `api.php`와 `mcp.php`는 `Authorization` 헤더의 개인 토큰만
  허용하며 그 외의 방식은 받지 않습니다. Cacti가 로드되기 전에 쿠키, `$_POST`,
  `$_REQUEST`를 제거하고 Cacti가 시작하는 세션을 파기하므로 브라우저 로그인으로
  API 접근 권한이 부여되는 일은 없습니다.
- **CSRF 우회 처리.** Cacti의 CSRF 보호 기능은 Cacti CSRF 토큰이 없는 JSON POST
  요청을 거부하지만, MCP 클라이언트는 이 토큰을 전송할 수 없습니다. 이 두 엔드포인트에
  한해서만 플러그인이 Cacti 로드 전에 요청 메서드를 변경했다가 로드 후에 복원하여
  보호 검사를 건너뛰도록 합니다. CSRF는 브라우저가 쿠키로 인증하는 요청을 보호하기
  위한 것이며, 이 엔드포인트들은 쿠키 기반 신원을 전혀 허용하지 않으므로 교차 사이트
  페이지가 베어러 토큰을 첨부할 수 없어 안전합니다. 콘솔 페이지는 전체 CSRF 보호를
  그대로 유지합니다. 이 우회 처리는 Cacti가 공식적인 예외 기능을 제공할 때까지의
  임시 조치이며, 자세한 내용은 `lib/bootstrap.php`를 참조하세요.
- **Origin 검사.** `mcp.php`에서는 요청에 `Origin` 헤더가 포함된 경우 해당 값이
  Public Cacti URL의 스킴, 호스트, 포트와 정확히 일치해야 하며, 그렇지 않으면
  `ORIGIN_NOT_ALLOWED` 오류와 함께 요청이 거부됩니다. 비브라우저 클라이언트가
  연결하는 방식인 `Origin` 헤더가 없는 요청은 허용됩니다. 이를 통해 웹 페이지가
  방문자의 브라우저에서 엔드포인트를 호출하는 것을 차단합니다. `api.php`에는 이
  검사가 적용되지 않습니다.
- **읽기 전용만 허용.** 등록 시 읽기 전용이고 비파괴적이며 멱등성이 보장되지 않는
  모든 기능은 거부됩니다.
- **노출 설정과 영역(realm) 모두 적용.** 기능은 노출 상태여야 하며 토큰 소유자가 해당
  영역을 보유하고 있어야 합니다. 노출 테이블을 읽을 수 없는 경우 기본값으로 대체하지
  않고 모든 기능을 숨깁니다.
- **숨김, 알 수 없음, 권한 없음의 동일한 응답.** 클라이언트는 존재하지 않는 기능과
  숨겨진 기능, 또는 사용자에게 권한이 없는 기능을 구분할 수 없습니다. 검색에서는
  제외되며 실행 시 `NOT_FOUND`(`ABILITY_NOT_FOUND`)를 반환합니다.
- **토큰.** SHA-256 해시로 저장되며 최초 한 번만 표시되고, 항상 만료 기한이 있으며
  폐기 가능하고, 소유자가 비활성화되거나 영역 권한을 잃으면 거부됩니다.
- **감사.** `plugin_mcp_audit`는 요청 ID, 토큰 ID, 사용자 ID, 기능, 결과(`started`,
  `succeeded`, `failed`, `denied`, `rejected`) 및 타임스탬프를 기록합니다. 인수,
  결과값 또는 토큰 값은 절대 기록하지 않습니다. 기능은 `started` 행이 기록된 후에만
  실행되며, 감사 테이블을 사용할 수 없는 경우 호출은 `UNAVAILABLE`로 실패하고
  실행되지 않습니다. 실행 전에 거부된 호출은 하나의 행으로 기록됩니다. 알 수 없거나
  숨겨졌거나 권한이 없는 기능은 `denied`로, 스키마 검증에 실패한 인수는 `rejected`로
  기록됩니다. 콘솔, My MCP Tokens 및 CLI에서의 토큰 생성과 폐기는 `mcp-token-create`
  및 `mcp-token-revoke`로, 결과는 `succeeded`로 기록되며, 폐기는 활성 상태였던 토큰에
  대해서만 기록됩니다. 검색 요청 및 `arguments`가 JSON 객체가 아닌 호출은 기록되지
  않습니다.
- **실패 로그.** 예기치 않은 실패, `INVALID_RESULT`, 또는 감사 테이블을 사용할 수 없는
  상황에서는 `MCP` 기능(facility)으로 Cacti 로그에 기능 ID, 고정된 사유, 예외
  클래스를 한 줄로 기록합니다. 메시지, 인수 및 토큰은 절대 기록되지 않습니다.
- **메인 폴러 전용.** 두 엔드포인트, 두 콘솔 페이지 및 `tokens.php`는 다른 곳에서
  동작하는 것을 거부합니다.

## 수명 주기

플러그인을 비활성화하면 두 엔드포인트가 모두 차단됩니다. 제거(uninstall)하면 모든
토큰이 폐기되지만 데이터 보존을 위해 세 테이블(`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`)은 유지되며, 다시 설치해도 폐기된 토큰은
재활성화되지 않습니다. Cacti 데이터베이스와 함께 테이블을 백업하고 플러그인 외부에서
감사 데이터 보존 정책을 적용하세요.

## 개발 및 테스트

테스트 모음에는 `tests/`의 일반 PHP 스크립트와 함께 `tests/Unit/`의 PHPUnit 단위
테스트 및 PHPStan 정적 분석(레벨 6)이 포함되어 있으며, 모두 Cacti 설치 없이
실행됩니다:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI는 PHP 8.2부터 8.5 환경에서 실행됩니다. PHP 구문 검사(`php -l`)와
`.github/workflows/ci.yml`에 나열된 13개의 일반 PHP 테스트 스크립트를 실행하는
`test` 작업, `composer phpstan`과 `composer test`를 실행하는 `quality` 작업,
그리고 설치 가능한 `mcp/` 아카이브(`.gitattributes`에 나열된 개발 및 테스트 파일
제외)와 `SHA256SUMS`를 빌드하는 `package` 작업으로 구성됩니다. Cacti와 연동되는
테스트는 Cacti 헬퍼 경계에서 픽스처를 사용하며 전체 Cacti 설치 환경을 실행하지는
않습니다.

### 통합 테스트

`tests/integration/run.sh 1.2.31` 또는 `tests/integration/run.sh develop`을 실행하면
컨테이너 내 실제 Cacti 환경에 플러그인을 설치하고 실시간 검증을 수행합니다. 이를
위해 Compose v2.23.1 이상이 포함된 Docker, git 및 openssl이 필요합니다. `KEEP=1`을
설정하면 디버깅을 위해 스택을 실행 상태로 유지합니다. CI는 풀 리퀘스트가 아닌 야간
스케줄 및 수동 요청 시에 이 테스트를 실행합니다.

## 현지화

Cacti MCP는 `mcp` 텍스트 도메인(`locales/po/mcp.pot`)을 사용하여 영어 및 47개 로케일(광범위 티어 1 19개, 아프리카 15개, 아시아 10개, 그리고 보스니아어, 크로아티아어, 세르비아어 로케일)에 대해 컴파일된
GNU gettext 카탈로그를 `locales/po/` 및 `locales/LC_MESSAGES/`에, 현지화된
README를 `docs/i18n/`에 포함하여 배포합니다. 언어 지원이 활성화되면 Cacti가 일치하는
카탈로그를 자동으로 로드합니다.

## 기여

풀 리퀘스트는 `develop` 브랜치로 보냅니다. 프로덕션 코드는 PHP 8.2와 호환되도록
유지하고 탭, 작은따옴표 문자열, Cacti의 데이터베이스 및 권한 헬퍼 등 Cacti 스타일을
따르세요. 검증, 권한 부여 또는 프로토콜 동작이 변경된 경우 테스트를 추가하고
`git commit -s`로 커밋에 서명(sign-off)하세요. HTTP API 변경 사항은
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp)와 조율하시기 바랍니다.

## 라이선스

Copyright (C) 2026 Thomas Vincent. GNU General Public License 버전 2 이상에 따라
배포됩니다. 자세한 내용은 [LICENSE](../../../LICENSE)를 참조하세요.
