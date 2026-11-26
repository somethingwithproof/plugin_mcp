<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: isang kaktus na may kalasag. Tuklasin. Pahintulutan. Isagawa.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lisensya: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Ang Cacti MCP ay isang plugin ng Cacti na nagbibigay-daan sa mga AI client na
magbasa ng iyong data sa Cacti sa pamamagitan ng mga pinangalanang operasyong
sinasala ayon sa pahintulot na tinatawag na mga ability. Inihahatid nito ang mga ito
sa dalawang paraan mula mismo sa plugin: isang endpoint ng MCP (`mcp.php`, Streamable HTTP)
at isang HTTP API na istilong AIP (`api.php`). Nananatiling tagapamahala ang Cacti sa
awtorisasyon at pagsasagawa. Hindi kailanman direktang nag-query ang isang client sa
database; makakatawag lamang ito ng ability na inilantad ng isang administrator at
pinapayagan ng mga realm sa Cacti ng may-ari ng token.

Maaaring magrehistro ang mga may-akda ng plugin ng kanilang sariling mga read-only na
ability sa pamamagitan ng hook na `abilities_register`, at lilitaw ang mga ito sa mga
MCP client bilang mga tool nang walang kinakailangang protocol code.

**Katayuan: pre-release, bersyon 0.1.0.** Wala pang naka-tag na release.

Magagamit na ngayon:

- Mga built-in na read-only na ability para sa mga bersyon ng sistema at imbentaryo ng mga device.
- Mga personal access token (`cmcp_pat_...`) bilang tanging kredensyal.
- Ang console na Management > MCP: ilantad o itago ang mga ability, gumawa at
  mag-revoke ng mga token, at basahin ang audit log.
- Management > My MCP Tokens: pinapamahalaan ng mga user ang kanilang sariling mga token,
  nakikita ang kanilang aktibidad, at nakikita kung aling mga tool ang magagamit ng kanilang mga token.
- MCP sa pamamagitan ng Streamable HTTP, mga rebisyon ng protocol na `2026-07-28` at
  `2025-11-25`, para sa mga tool lamang.

Hindi pa magagamit:

- Pag-sign in gamit ang OAuth 2.1. Ang mga hosted connector na hindi makapagpapadala ng
  personal token, tulad ng mga custom connector ng ChatGPT at claude.ai, ay hindi
  makakakonekta hangga't hindi pa ito umiiral. Nakaplano ito bilang Plan 2; hindi pa
  naisusulat ang planong iyon.
- Mga write ability. Mga read-only na ability lamang ang maaaring irehistro.

Ang disenyo ay nasa
[detalye ng disenyo ng endpoint](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
at ang pagkakasunod-sunod ng pagbuo ay nasa [docs/plan.md](../../plan.md).

## Mga built-in na ability

| ID | Mga Argumento | Kinakailangang Cacti realm |
| --- | --- | --- |
| `cacti-get-system-info` | wala | 15 |
| `cacti-list-devices` | opsyonal na `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | kinakailangang `name`, tulad ng `devices/12` | 3 |

Ang bawat tawag ay nangangailangan din ng realm na **MCP and Abilities API** para sa
may-ari ng token, ng saklaw na `abilities:read` (taglay ito ng bawat personal token),
at ng isang nakalantad na ability. Ipinapakita ng tab na Abilities sa console ang realm
na kailangan ng bawat built-in na ability.

- Nagbabalik ang `cacti-list-devices` ng mga pahina na may hanggang 100 device (default ay 50)
  at isang `nextPageToken`. Ang isang page token ay balido lamang para sa parehong `filter`
  at `orderBy`. Ang `filter` ay isang ekspresyong AIP-160 ng mga paghahambing na pinagdugtong
  ng `AND`, halimbawa `state = "DOWN" AND disabled = false`. Ang mga field ng filter ay
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, at `state`. Tumatanggap ang `orderBy` ng `displayName`, `hostname`, o `name`,
  na bawat isa ay maaaring sundan ng `desc`.
- Dumadaan ang mga query sa device sa `get_allowed_devices()` ng Cacti, kaya nakikita
  lamang ng user ang mga device na ipapakita sa kanya ng Cacti.
- Hindi isinasama sa mga field ng device ang mga SNMP community string, passphrase, at
  iba pang kredensyal.

## Pag-install

Nangangailangan ng Cacti 1.2.31 o mas bago, PHP 8.2 o mas bago, at ng pangunahing poller.
Dapat naka-enable ang pagpapatotoo ng Cacti; tumatangging magpatotoo ang plugin kapag
nakapatay ito.

Ang direktoryo ng plugin ay dapat pangalanang `mcp`, hindi `plugin_mcp`. Ang slug ng plugin,
mga pangalan ng realm, domain ng pagsasalin, at mga URL ay pawang gumagamit ng `mcp`.

Mula sa isang source checkout:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Hanggang sa magkaroon ng mga naka-tag na release, maaari mong i-download sa halip ang
artifact na `mcp-plugin` mula sa isang matagumpay na
[pagtakbo ng CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Naglalaman ito ng `mcp.tar.gz` at `SHA256SUMS`. I-verify ang checksum, pagkatapos ay
i-extract ang `mcp.tar.gz` sa loob ng direktoryong `plugins/` ng Cacti upang ang resulta ay
`plugins/mcp/`. Gumagamit ang mga awtomatikong source archive ng GitHub ng ibang pangalan
ng top-level na direktoryo. Hindi isinasama sa archive ang `docs/` (kabilang ang mga
screenshot sa ibaba), `tests/`, at `.github/`, kaya gumagamit ng GitHub ang mga link sa
README patungong `docs/` ngunit hindi sa naka-install na kopya.

Pagkatapos:

1. Sa Plugin Management, i-install at i-enable ang **Cacti MCP**. Awtomatikong
   matatanggap ng nag-install na administrator ang realm na **MCP Administration**.
2. Sa ilalim ng Settings > MCP, itakda ang **Public Cacti URL** sa address na ginagamit
   ng mga client, halimbawa `https://cacti.example.com/cacti`. Kinakailangan ang HTTPS
   maliban sa `localhost`, `127.0.0.1`, at `[::1]`. Hangga't hindi ito naitatakda,
   sumasagot ang `mcp.php` ng HTTP 400 na may JSON-RPC error na ang `data` ay
   `FAILED_PRECONDITION` at `PUBLIC_URL_REQUIRED`. Hindi ito binabasa ng `api.php`.

   ![Settings > MCP na nagpapakita ng field na Public Cacti URL](../../images/settings-public-url.png)

3. Ibigay ang realm na **MCP and Abilities API** sa bawat user na magmamay-ari ng token.
   Walang user na awtomatikong nakakatanggap nito.
4. Tiyaking ipinapasa ng web server ang header na `Authorization` at ang path info sa PHP
   (tingnan sa ibaba).
5. Buksan ang Management > MCP at ilantad ang mga ability na nais mong makita ng mga client.

**Pag-upgrade mula sa isang development build.** Pre-release pa ang plugin, at nagbago
ang mga table nito sa panahon ng development nang walang mga migration. Kung nag-install ka
ng mas naunang build, i-uninstall ito at i-install muli. Pinapanatili ng muling pag-install
ang mga table na umiiral na, kaya i-drop muna ang mga lumang table na `plugin_mcp_token`,
`plugin_mcp_audit`, at `plugin_mcp_ability` (at ang mga katumbas na table mula sa mga build
na ginawa bago ang pagpapalit ng pangalan). I-back up ang mga ito kung kailangan mo ang
kanilang kasaysayan; ang mga token mula sa mga build na iyon ay nire-revoke sa pag-uninstall
at hindi nadadala.

### Web server

Ang mga setup ng Apache na nag-aalis ng `Authorization` bago makarating sa PHP ay
nangangailangan nito sa kaukulang virtual host o direktoryo, na sinusundan ng pag-reload:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Naghatid ang Apache na may `mod_php` ng mga ruta ng `api.php` nang walang dagdag na
konfigurasyon sa path.

Nasa path pagkatapos ng pangalan ng script (`/plugins/mcp/api.php/v1/abilities`) ang
mga ruta ng `api.php`, kaya dapat itugma ng nginx ang mga URI kung saan ang `.php` ay
sinusundan ng higit pang path, ihiwalay ang path info, at ipasa ito sa PHP. Hindi kailanman
tinutugma ng block na `location ~ \.php$` ang mga URL na ito; sumasagot ang nginx ng sarili
nitong HTML 404. Ang pattern ng lokasyon at ang dalawang linya ng path-info sa ibaba ay
napatunayan gamit ang PHP-FPM; ang iba pang mga linya ay karaniwang boilerplate:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

I-adjust ang mga linyang `include` at `fastcgi_pass` upang tumugma sa block na naghahatid
na sa Cacti. Huwag idagdag ang `try_files $fastcgi_script_name =404;` sa block na ito:
binubura nito ang `$fastcgi_path_info`, at pagkatapos ay sumasagot ang `api.php` ng 404
`UNKNOWN_PATH`. Kung kailangan ng iyong konfigurasyon ang `try_files`, i-save muna ang
halaga gamit ang `set $path_info $fastcgi_path_info;` at ipasa ang
`fastcgi_param PATH_INFO $path_info;`.

Walang mga ruta ng path ang `mcp.php` at hindi nito kailangan ang mga ito.

## Console

May tatlong tab ang Management > MCP. Kailangan mo ang realm na **MCP Administration**.
Ang mga screenshot dito at sa ibaba ay mula sa isang development build ng Cacti na may
halimbawang data.

- Inililista ng **Abilities** ang bawat nakarehistrong ability kasama ang plugin nito,
  kategorya, ang realm na kailangan nito, at kung ito ay nakalantad. Pumili ng mga row
  at piliin ang Expose o Hide; kukumpirmahin mo muna bago mailapat ang pagbabago. Ang mga
  built-in na ability na `cacti-*` ay nakalantad bilang default. Nagsisimulang nakatago
  ang mga ability mula sa ibang mga plugin, kaya hindi kailanman naglalathala ng anuman
  ang pag-install ng plugin hangga't hindi nagpapasya ang isang administrator. Nililimitahan
  lamang ng pagkakalantad ang access: kailangan pa rin ng user ang realm ng ability.

  ![Tab na Abilities na naglilista ng mga built-in na ability kasama ang kanilang mga realm at katayuan ng pagkakalantad](../../images/console-abilities.png)
- Inililista ng **Tokens** ang mga token kasama ang may-ari, gumawa, pagkakagawa,
  pag-expire, huling paggamit, at katayuan (Active, Expired, Revoked). Pumili ng mga row
  at piliin ang Revoke upang i-revoke ang mga ito. Hindi na magagamit muli ang mga na-revoke
  na token. Gumagawa ng bago ang Create Token.

  ![Tab na Tokens na naglilista ng mga token kasama ang may-ari, pag-expire, huling paggamit, at katayuan, sa itaas ng form ng Create Token](../../images/console-tokens.png)
- Inililista ng **Audit** ang mga row ng audit, pinakabago muna, at sinasala ayon sa user,
  ability, at kinalabasan.

  ![Tab na Audit na naglilista ng mga tawag kasama ang user, token, ability, at kinalabasan, na may mga filter](../../images/console-audit.png)

## Mga Token

Nagbabasa ang isang personal token sa Cacti bilang ang may-ari nito. May anyo itong
`cmcp_pat_` na sinusundan ng 64 na maliliit na hex character at nagtataglay ng nag-iisang
saklaw na `abilities:read`. Ang maaari nitong makita ay pinagpapasyahan ng mga realm sa
Cacti at mga pahintulot sa device ng may-ari nito, hindi ng token. Dapat ay isang
naka-enable na user na nagtataglay ng realm na **MCP and Abilities API** ang may-ari.

Palaging ginagawa ang mga token para sa isang user, nag-e-expire, at maaaring i-revoke:

- **Console.** Management > MCP > Tokens > Create Token. Ang tagal ng bisa ay 1 hanggang
  365 araw at ang default ay 90. Binuo ng server ang token at ipinapakita nang isang beses sa
  pahina ng tugon, kaya kopyahin agad ito sa iyong secret manager. Maaari kang gumawa ng
  token para sa iyong sarili. Ang paggawa para sa ibang user ay nangangailangan din ng
  realm na Users/Groups, dahil nagbabasa ang token sa Cacti bilang ang user na iyon.
- **My MCP Tokens.** Sinumang user na may realm na MCP and Abilities API ay maaaring
  mamahala ng kanilang sariling mga token; tingnan sa ibaba.
- **Command line.** Tumatakbo lamang ang `tokens.php` mula sa CLI, bilang isang OS account
  na makakapag-administer ng Cacti. Kinukuha nito ang token mula sa environment upang hindi
  kailanman lumitaw ang halaga sa isang command line o sa listahan ng proseso. Ang tagal ng
  bisa ay 1 hanggang 365 araw at ang default ay 30. Ang paggawa at pag-revoke ng token sa
  pamamagitan ng CLI ay ino-audit tulad ng console, kung saan ang may-ari ng token ang
  tagapagsagawa dahil walang user ng Cacti ang CLI, kaya hindi minamarkahan ng audit row na
  nagmula ang aksyon sa CLI. Ipinapakita ng `--list` ang bawat token bilang JSON (ID,
  may-ari, mga saklaw, mga timestamp, flag ng pagkaka-revoke) at hindi kailanman ang halaga
  ng token; ipinapakita ng `--help` ang paggamit.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Hindi maaaring gawin ang mga token para sa guest account, para sa mga naka-disable na user,
o para sa mga user na walang realm na **MCP and Abilities API**, mula sa console, sa command
line, o sa My MCP Tokens. Iniimbak ng Cacti ang setting ng guest bilang username o user ID,
at nilulutas ng plugin ang pareho. Ang isang token na ang may-ari ay naging guest account ay
titigil sa paggana sa susunod nitong kahilingan.

### My MCP Tokens

Hindi nangangailangan ng realm ng pangangasiwa ang Management > My MCP Tokens
(`plugins/mcp/mcp_tokens.php`): saklaw ito ng realm na **MCP and Abilities API**, at
lilitaw lamang ang entry sa menu para sa mga user na nagtataglay nito. Palaging kumikilos
ang pahina para sa naka-sign in na user. Bahagi ng console ang menu ng Cacti, kaya maaabot
ng isang user na walang access sa console ang pahina sa pamamagitan ng address nito.

![Tab na My Tokens na naglilista ng mga token ng naka-sign in na user at ng form sa paggawa](../../images/my-tokens.png)

- Inililista ng **Tokens** ang iyong mga token, gumagawa ng isa (1 hanggang 365 araw,
  default ay 90, ipinapakita nang isang beses sa tugon), at nire-revoke ang sarili mong mga
  token. Hindi mo makikita o mare-revoke ang sa iba.
- Inililista ng **Activity** ang mga aksyong isinagawa mo, pinakabago muna: mga tawag na
  ginawa gamit ang iyong mga token at mga pagbabago sa token na ginawa mo.
- Inililista ng **Available Tools** ang mga ability na magagamit ng isa sa iyong mga token
  ngayon, kasama ang ID, pangalan, at paglalarawan ng bawat ability. Sinusunod nito ang
  iyong mga pahintulot sa Cacti at ang mga setting ng pagkakalantad na pinili ng isang
  administrator.

  ![Listahan ng Available Tools na nagpapakita ng ID, pangalan, at paglalarawan ng bawat ability](../../images/my-tools.png)

Ang isang pag-install na ginawa bago umiral ang pahinang ito ay may listahan ng realm file
na walang `mcp_tokens.php`. Inirerehistro ng pag-install ang listahan; hindi ito ina-update
ng pag-enable o pag-disable ng plugin. I-uninstall at i-install muli ang plugin,
pagkatapos ay ibigay muli ang mga realm, dahil tinatanggal ng Cacti ang mga ibinigay na
realm kapag na-uninstall ang isang plugin.

Ang SHA-256 hash lamang ng token ang iniimbak ng database, kaya hindi mababawi ang
nawalang token; i-revoke ito at gumawa ng iba. Gayundin ang pag-rotate: gumawa ng bagong
token, ilipat ang client, pagkatapos ay i-revoke ang luma. Ang nag-expire na token,
na-revoke na token, naka-disable na may-ari, o nawalang realm ay magreresulta sa pagkabigo
sa susunod na kahilingan. Tinatanggap lamang ang mga token sa header na
`Authorization: Bearer`; hindi tinatanggap ang isang token sa query string o body.

## Ikonekta ang isang kliyente

Gamitin ang MCP endpoint na `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, kasama ang
token sa isang `Authorization: Bearer` header. Panatilihin ang token sa isang environment
variable o secret manager at sangguniin ito mula sa konfigurasyon ng kliyente sa halip na
isulat ang halaga nito sa isang file.

### Claude Code

Ilagay ang endpoint sa isang `.mcp.json` ng proyekto na sumasangguni sa token ayon sa pangalan.
Pinapalawak ng Claude Code ang `${VAR}` sa `url` at `headers`, kaya walang lihim na nakaimbak sa file at
ligtas itong i-commit. I-export ang `CACTI_MCP_TOKEN` sa environment na magpapasimula sa Claude Code.

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

Maaari mo rin itong idagdag mula sa command line:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Sa paggamit ng double quotes, unang pinapalawak ng iyong shell ang `$CACTI_MCP_TOKEN`, kaya ang halaga ng token
ay naisusulat sa config file para sa napiling `--scope` (`local`, `user`, o
`project`; default ay `local`). Huwag gamitin ang anyong iyon kasama ang `--scope project`, at panatilihing
wala sa version control ang file. Mas mainam ang sanggunian sa `.mcp.json` sa itaas. Binabasa ng Claude Code
ang ilang mga credential variable (tulad ng `ANTHROPIC_AUTH_TOKEN`) bilang walang laman sa remote
`url` at `headers`; hindi kabilang dito ang `CACTI_MCP_TOKEN`. Sanggunian:
[Dokumentasyon ng Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot sa VS Code

Gumamit ng workspace-root na `.mcp.json` (o ng user file na `~/.copilot/mcp-config.json`).
Ang mga file na ito na katutubo sa Copilot ay gumagamit ng top-level na `mcpServers` object at `${NAME}`
na mga sanggunian sa environment-variable sa mga halaga ng header:

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

I-export ang `CACTI_MCP_TOKEN` sa environment na magpapasimula sa VS Code. Ang mga katutubong file ng Copilot
ay hindi sumusuporta sa mga prompt ng `inputs`. Tinatanggihan ng guided setup ng VS Code ang mga halagang `${...}`,
kaya idagdag ang `Authorization` header sa pamamagitan ng pag-edit sa file, hindi sa pamamagitan ng
guided flow. Iniaalok lamang ng guided setup ang workspace-root file
kapag naka-on ang eksperimental na setting na `chat.mcp.workspaceRootConfig.enabled`. Tingnan ang
[Sanggunian sa konfigurasyon ng VS Code MCP](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Legacy: `.vscode/mcp.json`.** Sinasabi ng VS Code na ang mga bagong konfigurasyon ng Copilot ay hindi dapat
gumamit ng `.vscode/mcp.json` o ng profile na `mcp.json`; kabilang ang mga ito sa hindi na sinusuportahang
Local harness, na aalisin sa Pebrero 2027. Kung ginagamit mo pa rin ito, ang
format na pinamamahalaan ng editor ay kumukuha ng top-level na `servers` key at maaaring magtanong para sa token:

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

### Mga kliyenteng stdio lamang ang sinusuportahan

Ang [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ay isang opsyonal na adapter
na tumatakbo bilang lokal na stdio MCP server at tumatawag sa HTTP API ng plugin. Gamitin ito para sa isang
kliyente na hindi makakonekta sa isang remote na HTTP server. Nangangailangan ito ng parehong personal na
token at nakikipag-usap sa `api.php`.

### Pag-uugali ng MCP

Naghahatid lamang ang endpoint ng mga tool: ang bawat nakalantad at pinahintulutang ability ay isang tool na pinangalanan ayon sa
ID nito, kasama ang mga input at output schema nito at mga read-only na anotasyon
(`false` ang `openWorldHint`). Pinangangasiwaan nito ang `initialize`, `server/discover`, `ping`,
`tools/list`, at `tools/call`. Hindi ito nagpapanatili ng session, hindi nagpapadala ng `Mcp-Session-Id`
(at binabalewala ang anumang natatanggap nito), at hindi tumatanggap ng mga JSON-RPC batch. Ang mensaheng
walang `id` ay isang notification at nakakakuha ng HTTP 202 na walang body. `POST` lamang ang
pinapayagan.

- **Mga rebisyon.** Ang isang request na may dalang `io.modelcontextprotocol/protocolVersion` sa
  `params._meta` ay dapat magbanggit ng `2026-07-28`; anumang iba pa ay makakakuha ng error na `-32022`. Ang gayong mga
  request ay dapat ding magdala ng tumutugmang `Mcp-Protocol-Version`, `Mcp-Method`, at (para sa
  `tools/call`) `Mcp-Name` na mga header, o kaya ang sagot ay error na `-32020`. Ang ibang mga request
  ay itinuturing na `2025-11-25`: sumasagot ang `initialize` gamit ang rebisyong iyon, at sa anumang
  ibang method, ang isang `Mcp-Protocol-Version` header, kung ipinadala, ay dapat `2025-11-25`,
  `2025-06-18`, o `2025-03-26`.
- **Mga tool error.** Ang isang ability error, kabilang ang mga argument na hindi tumutugma sa
  schema o isang halaga ng `arguments` na hindi isang JSON object, ay bumabalik bilang isang tool
  result na may `isError: true` at ang AIP-193 error sa `structuredContent`, hindi bilang isang
  protocol error.
- **Mga protocol error.** Ang mga pagkabigo na hindi mga tool error ay mga JSON-RPC error object
  (code `-32000` kasama ang status at reason sa `data`, o ang mga karaniwang code): ang
  nawawalang Public Cacti URL, isang tinanggihang `Origin`, isang request habang naka-disable ang plugin
  o nasa isang remote poller, at mga hindi inaasahang server error (`-32603`, kung saan ang detalye ay
  nakasulat sa Cacti log, hindi sa tugon). Ang mga request check na unang tumatakbo (405,
  413, 415) at mga pagkabigo sa authentication (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  ay nagpapanatili ng AIP-193 body na inilarawan sa ilalim ng HTTP API.

## HTTP API

Base URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Ang kontrata ay
nasa [openapi.json](../../../openapi.json).

| Method at path | Layunin |
| --- | --- |
| `GET /v1/abilities` | Ilista ang mga pinahintulutang ability. Query: `pageSize`, `pageToken`, at `filter` sa anyong `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Basahin ang isang ability. |
| `POST /v1/abilities/{id}:execute` | Patakbuhin ito. Ang body ay eksaktong `{"arguments": {...}}`. Ang tugon ay `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Sumusunod ang mga error sa AIP-193: isang `error` object na may `code`, `message`, `status`, at
`details` na nagdadala ng isang `ErrorInfo` na may domain na `cacti.net` at isang matatag na `reason`.
Ang mga problema sa argument ay nagdaragdag ng isang `BadRequest` detail na nagpapangalan sa field. Ang mga request body ay
limitado sa 64 KB, at ang mga resulta sa 1 MB. Ang parehong endpoint ay sumasagot lamang sa pangunahing
poller at nagbabalik ng `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) kapag naka-disable ang plugin
o ang server ay hindi ang pangunahing poller.

| HTTP | Mga halaga ng `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (nagpapadala rin ng `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (nagpapadala ng `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Sumulat ng isang ability (mga may-akda ng plugin)

Ang isang naka-enable na Cacti plugin ay nagrerehistro ng mga ability mula sa isang function na ikinakabit nito sa
`abilities_register` hook, karaniwan sa `plugin_<slug>_install()` nito:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Tumatanggap ang function ng isang `AbilitiesRegistrar` na naka-scope sa plugin. Ang return
value nito ay binabalewala.

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

Ang mga panuntunan, na lahat ay ipinapatupad sa pagpaparehistro:

- **Mga ID.** Ang isang ID ay tumutugma sa `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ay hanggang 64
  na karakter, at dapat magsimula sa slug ng plugin at isang gitling: `acme-` sa itaas.
  Ang slug ay ang pangalan ng direktoryo ng plugin, kaya ang isang direktoryo tulad ng `my_plugin` ay hindi
  makakapagrehistro ng anuman. Ang isang direktoryo ng plugin na pinangalanang `cacti` ay tinatanggihan; ang
  namespace na iyon ay pag-aari ng mga built-in.
- **Kahulugan.** Eksaktong mga key na ito: `label`, `description` (hanggang 4096 byte),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Ang kategorya ay dapat umiiral na: gumamit ng built-in (`inventory`,
  `system`) o irehistro ang sarili mo gamit ang `registerCategory()`, na ang ID ay natatangi sa
  lahat ng plugin at tumutugma sa `^[a-z][a-z0-9-]{0,31}$`.
- **Read-only lamang.** Ang `annotations` ay dapat na eksaktong `readOnly: true`,
  `destructive: false`, `idempotent: true`. Anumang iba pa ay nagtatapon ng error.
- **Mga Schema.** Ang `input_schema` at `output_schema` ay dapat bawat isa ay may top-level
  na `type` `object`. Ang dialect ay maliit at nag-fail closed. Ang mga object ay dapat sarado
  (`additionalProperties: false`, na may nakalagay na `properties`); ang iba pang mga uri ay
  `integer` at `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, at `array` (na nangangailangan ng `items` at
  `maxItems`). Ang isang uri ay maaaring
  gawing nullable bilang `['string', 'null']`. Ang mga argument string ay naka-default sa hindi hihigit sa
  4096 na karakter; ang mga result string ay limitado lamang ng isang idineklarang `maxLength`
  at ng limitasyon sa laki ng resulta. Hanggang 256 na ability lamang ang maaaring irehistro.
- **`permission(int $userId): bool`.** Dapat magbalik ng eksaktong `true` upang payagan. Ang
  user ID ay sa may-ari ng token; huwag kailanman magbasa ng session state.
- **`execute(int $userId, stdClass $args): array`.** Ang `$args` ay napatunayan na
  laban sa `input_schema`. Ipatupad ang mga pahintulot sa antas ng object nang mag-isa. Magbalik ng isang
  associative array na eksaktong tumutugma sa `output_schema`; ang isang listahan, isang dagdag na field,
  o higit sa 1 MB ng JSON ay nagiging error na `INVALID_RESULT`. Magtapon ng
  `AbilitiesError` para sa isang pagkabigo na nakikita ng kliyente, tulad ng `NOT_FOUND`.
- **Mga walang lamang object.** Ine-encode ng PHP ang `[]` bilang isang JSON array. Saanman nagdedeklara ang output schema
  ng isang `object`, sa anumang lalim, itinuturing ng registry ang `[]` bilang walang lamang object
  at nagpapadala ng `{}`; gumagana rin ang `new stdClass()`. Ang isang hindi walang lamang listahan ay hindi kailanman itinuturing bilang isang
  object at nabibigo na may `INVALID_RESULT`. Ang isang walang lamang `properties` map sa isang schema
  ay maaaring maging `[]` o `new stdClass()`; parehong inilalathala ang dalawa bilang `{}`.
- **Paghihiwalay ng pagkabigo.** Bawat plugin ay nagrerehistro sa isang scratch copy na pinapanatili
  lamang kung normal na bumalik ang iyong function. Kung magtapon ito ng error, wala sa iyong mga ability
  ang marerehistro, at ang pagkabigo ay itinatala sa log.

Ang mga ability mula sa mga plugin ay nagsisimulang nakatago. Inilalantad ang mga ito ng administrator sa
tab na Abilities ng console, at ang column na Required Realm ay nagbabasa ng "Set by the plugin"
para sa mga ito.

## Modelo ng seguridad

- **Bearer lamang.** Tumatanggap lamang ang `api.php` at `mcp.php` ng personal na token sa `Authorization` header at wala nang iba pa. Inaalis nito ang mga cookie, `$_POST`, at `$_REQUEST` bago mag-load ang Cacti at sinisira ang session na sinisimulan ng Cacti, kaya hindi kailanman nagbibigay ng access sa API ang pag-login sa browser.
- **Solusyon para sa CSRF.** Tinatanggihan ng CSRF guard ng Cacti ang JSON POST na walang Cacti CSRF token, na hindi maipapadala ng alinmang MCP client. Para sa dalawang endpoint na ito lamang, pinapalitan ng plugin ang pangalan ng request method bago mag-load ang Cacti at ibinabalik ito pagkatapos, kaya nilalampasan ito ng guard. Ligtas ito dahil pinoprotektahan ng CSRF ang mga kahilingan na pinapatunayan ng browser gamit ang mga cookie, at hindi tumatanggap ng pagkakakilanlang cookie ang mga endpoint na ito: hindi makapagkakabit ng bearer token ang isang cross-site na pahina. Pinapanatili ng mga console page ang buong proteksyon laban sa CSRF. Pansamantala ang solusyong ito hanggang sa mag-alok ang Cacti ng sinusuportahang exemption; tingnan ang `lib/bootstrap.php`.
- **Pagsusuri ng Origin.** Sa `mcp.php`, kung may `Origin` header ang kahilingan, dapat itong tumugma nang eksakto sa scheme, host, at port ng Public Cacti URL, kung hindi ay tatanggihan ang kahilingan na may `ORIGIN_NOT_ALLOWED`. Pinapayagan ang kahilingan na walang `Origin` header, na siyang paraan ng pagkonekta ng mga non-browser client. Pinipigilan nito ang isang web page na kontrolin ang endpoint mula sa browser ng isang bisita. Hindi inilalapat ng `api.php` ang pagsusuring ito.
- **Read-only lamang.** Tinatanggihan ng pagpaparehistro ang anumang kakayahan na hindi read-only, hindi mapanira, at idempotent.
- **Parehong umiiral ang pagkakalantad at mga realm.** Dapat nakalantad ang isang kakayahan at dapat hawak ng may-ari ng token ang realm nito. Kung hindi mabasa ang exposure table, itinatago ang bawat kakayahan sa halip na bumalik sa mga default.
- **Magkamukha ang nakatago, hindi kilala, at walang pahintulot.** Hindi matutukoy ng isang client ang pagkakaiba ng kakayahang hindi umiiral mula sa kakayahang nakatago o hindi maaaring gamitin ng user nito: inaalis ito sa pagtuklas at nagbabalik ng `NOT_FOUND` (`ABILITY_NOT_FOUND`) ang pagpapatupad.
- **Mga Token.** Nakaimbak bilang mga SHA-256 hash, ipinapakita nang isang beses, palaging nag-e-expire, maaaring bawiin, at tinatanggihan kapag na-disable ang may-ari o nawala ang realm.
- **Pag-audit.** Itinatala ng `plugin_mcp_audit` ang request ID, token ID, user ID, kakayahan, resulta (`started`, `succeeded`, `failed`, `denied`, `rejected`), at mga timestamp. Hindi nito kailanman itinatala ang mga argument, resulta, o halaga ng token. Tumatakbo lamang ang isang kakayahan pagkatapos maisulat ang `started` row nito; kung hindi available ang audit table, mabibigo ang tawag nang may `UNAVAILABLE` at hindi tatakbo. Isang row ang tinatanggihang tawag bago ito tumakbo: `denied` para sa hindi kilala, nakatago, o walang pahintulot na kakayahan, at `rejected` para sa mga argument na nabigo sa schema. Ang paggawa at pagbawi ng token mula sa console, My MCP Tokens, at CLI ay itinatala bilang `mcp-token-create` at `mcp-token-revoke` na may resultang `succeeded`, at itinatala lamang ang pagbawi para sa isang token na aktibo. Hindi nila-log ang pagtuklas, at ang isang tawag na ang `arguments` ay hindi isang JSON object.
- **Log ng pagkabigo.** Ang isang hindi inaasahang pagkabigo, `INVALID_RESULT`, o hindi available na audit table ay sumusulat ng isang linya sa log ng Cacti na may facility na `MCP`: ang ability ID, isang nakapirming dahilan, at ang exception class. Hindi kailanman nila-log ang mga mensahe, argument, at token.
- **Main poller lamang.** Parehong tumatangging kumilos kahit saan pa ang mga endpoint, parehong console page, at ang `tokens.php`.

## Siklo ng buhay

Hinaharangan ng pag-disable ng plugin ang parehong endpoint. Binabawi ng pag-uninstall ang bawat token at pinapanatili ang tatlong table (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) para sa retensyon; hindi muling ina-activate ng muling pag-install ang isang binawing token. I-back up ang mga table kasama ng database ng Cacti at maglapat ng patakaran sa retensyon ng audit sa labas ng plugin.

## Pag-develop at mga pagsusuri

Ang mga pagsusuri ay mga simpleng PHP script na tumatakbo nang walang Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

Sinusuri ng CI ang lint ng PHP at pinapatakbo ang mga script sa `tests/` (bawat isa ay nakalista sa `.github/workflows/ci.yml`) sa PHP 8.2 hanggang 8.5, pagkatapos ay binubuo ang mai-install na `mcp/` archive at ang checksum nito. Ang mga pagsusuring gumagamit ng Cacti ay gumagamit ng mga fixture sa hangganan ng Cacti helper; hindi nito sinusuri ang isang kumpletong pag-install ng Cacti.

### Mga pagsusuri sa integrasyon

Ini-install ng `tests/integration/run.sh 1.2.31` o `tests/integration/run.sh develop` ang plugin sa isang totoong Cacti sa mga container at nagpapatakbo ng mga live check laban dito. Nangangailangan ito ng Docker na may Compose v2.23.1 o mas bago, git, at openssl. Pinapanatili ng `KEEP=1` na tumatakbo ang stack para sa pag-debug. Pinapatakbo ito ng CI gabi-gabi at kapag hiniling, hindi sa mga pull request.

## Lokalisasyon

Nagpapadala ang Cacti MCP ng mga na-compile na GNU gettext catalog sa ilalim ng `locales/po/` at `locales/LC_MESSAGES/` at mga naka-localize na README sa ilalim ng `docs/i18n/` para sa Ingles at 47 na locale (19 Broad Tier 1, 15 Aprikano, 10 Asyano, at mga locale na Bosnian, Croatian, at Serbian), gamit ang `mcp` text domain (`locales/po/mcp.pot`). Awtomatikong nilo-load ng Cacti ang tumutugmang catalog kapag naka-enable ang suporta sa wika.

## Pag-aambag

Pumupunta sa `develop` ang mga pull request. Panatilihing tugma sa PHP 8.2 ang production code at gamitin ang estilo ng Cacti: mga tab, mga single-quoted string, at mga database at permission helper ng Cacti. Magdagdag ng mga pagsusuri para sa nabagong validation, authorization, o gawi ng protocol, at lagdaan ang mga commit gamit ang `git commit -s`. Makipag-ugnayan para sa mga pagbabago sa HTTP API sa [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Lisensya

Copyright (C) 2026 Thomas Vincent. Inilabas sa ilalim ng GNU General Public License, bersyon 2 o mas bago. Tingnan ang [LICENSE](../../../LICENSE).
