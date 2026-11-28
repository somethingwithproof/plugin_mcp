<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus mai garkuwa. Gano. Ba da izini. Aiwatar.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lasisi: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP wani plugin ne na Cacti wanda ke ba wa abokan hulɗar AI damar karanta bayanan Cacti ɗinku ta hanyar ayyuka masu suna da aka tace da izini da ake kira abilities. Yana ba da su ta hanyoyi biyu daga cikin plugin ɗin da kansa: ƙofar MCP (`mcp.php`, Streamable HTTP) da kuma HTTP API mai salon AIP (`api.php`). Cacti ne ke ci gaba da kula da ba da izini da aiwatarwa. Abokin hulɗa ba ya taɓa yin tambaya kai tsaye zuwa ma'ajin bayanai; zai iya kiran ability ne kawai wanda mai gudanarwa ya bayyana kuma wanda Cacti realms na mai mallakar token ɗin suka ba da dama.

Masu rubuta plugin za su iya yin rajistar nasu abilities na karatu kawai ta hanyar ƙugiyar `abilities_register`, kuma za su bayyana ga abokan hulɗar MCP a matsayin kayan aiki ba tare da wata lambar ƙa'ida ba.

**Matsayi: gabanin fitarwa, sigar 0.1.0.** Babu fitowar da aka yi wa alama tukuna.

Abubuwan da ake samu a yau:

- Built-in abilities guda tara na karatu kawai da suka shafi nau'ikan tsari, na'urori, shafukan wurare (sites), pollers, itatuwan jadawali (graph trees), jadawalai (graphs), tushen bayanai (data sources), da iyakantaccen ƙarshen rajistar Cacti da aka rufe sirri.
- Alamomin samun dama na sirri (`cmcp_pat_...`) a matsayin shaidar shiga kaɗai.
- Shafin gudanarwa na Management > MCP: bayyana ko ɓoye abilities, ƙirƙira da soke alamomi, karanta rajistar bincike.
- Management > My MCP Tokens: masu amfani suna sarrafa nasu alamomin, suna ganin ayyukansu, kuma suna ganin waɗanne kayan aiki alamominsu za su iya amfani da su.
- MCP ta hanyar Streamable HTTP, gyare-gyaren ƙa'ida `2026-07-28` da `2025-11-25`, kayan aiki kawai.

Abubuwan da ba su samuwa tukuna:

- Shiga ta OAuth 2.1. Masu haɗawa da ke kan intanet waɗanda ba za su iya aika alamar sirri ba, kamar custom connectors na ChatGPT da claude.ai, ba za su iya haɗawa ba har sai an samar da shi. An tsara shi a matsayin Plan 2; ba a rubuta wannan tsarin tukuna ba.
- Ayyukan rubutu (write abilities). Abilities na karatu kawai ne za su iya yin rajista.

Tsarin yana cikin
[takardar ƙirar ƙofa](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
kuma jerin gina shi yana cikin [docs/plan.md](../../plan.md).

## Abilities da ke ciki

| ID | Rukunin | Muhawara | Cacti realm da ake buƙata |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | babu | 15 |
| `cacti-list-devices` | `inventory` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | na dole `name`, kamar `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 7 ko 4 |
| `cacti-list-graphs` | `inventory` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 7 ko 5 |
| `cacti-list-data-sources` | `inventory` | na zaɓi `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | na zaɓi `lines` (1 zuwa 200, tsoho 50), `severity`, `search` | 19 ko 18 |

Kowane kira yana buƙatar realm na **MCP and Abilities API** ga mai mallakar token, iyakar `abilities:read` (kowane personal token yana da shi), da kuma ability da aka bayyana. Shafin Abilities na console yana nuna babban realm ɗin da kowane built-in ke buƙata.

Dukkan `cacti-list-*` abilities guda shida suna dawo da shafuka na har zuwa abubuwa 100 (tsoho 50) da kuma `nextPageToken`. Token na shafi yana aiki ne kawai don `filter` da `orderBy` iri ɗaya. `filter` wani furucin AIP-160 ne na kwatance (`=`, `!=`, `<`, `<=`, `>`, `>=`) da aka haɗa da `AND`, misali `state = "DOWN" AND disabled = false`. `orderBy` yana karɓar jerin filayen da za a iya tsarawa waɗanda aka raba da waƙafi, kowanne na iya samun `asc` ko `desc` a baya idan an so.

| Ability | Filayen tacewa | Filayen tsarawa |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Iyakar izini da cire bayanan sirri:

- `cacti-list-devices` da `cacti-get-device` suna yin tambaya ta hanyar `get_allowed_devices()` na Cacti kuma ba sa haɗa da SNMP community strings, passphrases, da sauran shaidun sirri.
- `cacti-list-trees` yana yin tambaya ta hanyar `get_allowed_trees()` (kuma yana tacewa da `is_tree_allowed()` idan akwai); `cacti-list-graphs` yana yin tambaya ta hanyar `get_allowed_graphs()` (kuma yana tacewa da `is_graph_allowed()` idan akwai).
- `cacti-list-data-sources` yana iyakance layuka zuwa na'urorin da aka ba mai kiran izini daga `get_allowed_devices()` (da `is_device_allowed()` idan akwai) kuma yana dawo da metadata kaɗai ba tare da tambayar `data_input_data` ko bayyana ƙimomin shigarwa na sirri ba.
- `cacti-list-pollers` yana cire shaidun shiga ma'ajin bayanai (`dbpass`, `dbuser`) da ginshiƙan mabuɗan TLS da takaddun shaida (`dbsslkey`, `dbsslcert`, `dbsslca`).
- `cacti-get-clog` yana karanta har zuwa 1 MiB na ƙarshe na rajistar Cacti da aka saita (yana rage kowane layi da ya wuce baiti 2048), yana tacewa ta `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`; tsoho `ALL`) da `search` wanda ba ya bambanta babba da ƙaramin harafi (har zuwa haruffa 256), sannan yana dawo da `lines`, `count`, da `truncated`. Ana rufe bayanan sirri a kowane layi don alamomin sirri (personal tokens), kanun bearer/basic, kalmomin sirri, sirrika, SNMP communities, mabuɗai, `dbpass`, `dbsslkey`, da bayanin mai amfani na URL kafin a gudanar da matattarun `severity` da `search` domin `search` kada ya zama hanyar gano sirri. Rufe bayanin sirri yana gazawa a rufe tare da `[redacted]`, kuma rajistar da ba za a iya karantawa ba tana dawo da `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Shigarwa

Yana buƙatar Cacti 1.2.31 ko sama da haka, PHP 8.2 ko sama da haka, da kuma main poller. Dole ne a kunna tantancewar Cacti; plugin ɗin yana ƙin tantancewa idan yana kashe.

Dole ne a sanya wa kundin plugin ɗin suna `mcp`, ba `plugin_mcp` ba. Sunan gajere na plugin, sunayen realm, yankin fassara, da URLs duk suna amfani da `mcp`.

Daga kwafin lambar tushe:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Har zuwa lokacin da aka sami fitowa mai alama, za ka iya sauke kayan `mcp-plugin` a madadin haka daga
[gudanarwar CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) mai nasara.
Yana ƙunshe da `mcp.tar.gz` da `SHA256SUMS`. Tabbatar da checksum ɗin, sannan ka cire `mcp.tar.gz` a cikin kundin `plugins/` na Cacti domin sakamakon ya zama `plugins/mcp/`. Rumbun tushe na atomatik na GitHub suna amfani da wani sunan kundin saman daban. Rumbun ba ya haɗa da `docs/` (gami da hotunan allo da ke ƙasa), `tests/`, da `.github/`, don haka hanyoyin haɗi na README zuwa `docs/` suna aiki a GitHub amma ba a cikin kwafin da aka shigar ba.

Sa'an nan:

1. A cikin Plugin Management, shigar sannan ka kunna **Cacti MCP**. Mai gudanarwar da ya shigar yana karɓar realm na **MCP Administration** kai tsaye.
2. A ƙarƙashin Settings > MCP, saita **Public Cacti URL** zuwa adireshin da abokan hulɗa ke amfani da shi, misali `https://cacti.example.com/cacti`. Ana buƙatar HTTPS banda `localhost`, `127.0.0.1`, da `[::1]`. Har sai an saita wannan, `mcp.php` yana amsawa da HTTP 400 tare da kuskuren JSON-RPC wanda `data` ɗinsa shine `FAILED_PRECONDITION` da `PUBLIC_URL_REQUIRED`. `api.php` ba ya karanta shi.

   ![Settings > MCP yana nuna filin Public Cacti URL](../../images/settings-public-url.png)

3. Ba da realm na **MCP and Abilities API** ga kowane mai amfani da zai mallaki token. Babu wani mai amfani da ke karɓar sa kai tsaye.
4. Tabbatar cewa sabar yanar gizo tana miƙa kanun `Authorization` da bayanin hanya zuwa PHP (duba ƙasa).
5. Buɗe Management > MCP sannan ka bayyana abilities ɗin da kake son abokan hulɗa su gani.

**Haɓakawa daga ginin haɓakawa.** Plugin ɗin gabanin fitarwa ne, kuma teburansa sun canza yayin haɓakawa ba tare da migrations ba. Idan ka shigar da wani gini na baya, cire shi sannan ka sake shigarwa. Sake shigarwa yana riƙe teburan da suka riga sun wanzu, don haka ka goge tsoffin teburan `plugin_mcp_token`, `plugin_mcp_audit`, da `plugin_mcp_ability` da farko (da kuma teburan makamantansu daga ginin da aka yi kafin canza sunan). Yi ajiyar su idan kana buƙatar tarihinsu; ana soke alamomin daga waɗancan ginukan yayin cirewa kuma ba sa cigaba.

### Sabar yanar gizo

Saitunan Apache da ke cire `Authorization` kafin PHP suna buƙatar wannan a cikin virtual host ko kundin da ya dace, sai a sake lodawa:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache tare da `mod_php` ya yi aiki da hanyoyin `api.php` ba tare da ƙarin saitin hanya ba.

Hanyoyin `api.php` suna zaune ne a cikin hanyar da ke bayan sunan rubutun (`/plugins/mcp/api.php/v1/abilities`), don haka dole ne nginx ta dace da URIs inda `.php` ke biye da ƙarin hanya, ta raba bayanin hanyar, kuma ta miƙa shi zuwa PHP. Toshe na `location ~ \.php$` ba ya taɓa dacewa da waɗannan URLs; nginx yana amsawa da nasa HTML 404. An tabbatar da tsarin wurin da layukan path-info guda biyu da ke ƙasa tare da PHP-FPM; sauran layukan daidaitaccen tsari ne:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Daidaita layukan `include` da `fastcgi_pass` don su dace da toshe da ya riga yake hidimar Cacti. Kada ka ƙara `try_files $fastcgi_script_name =404;` zuwa wannan toshe: yana share `$fastcgi_path_info`, kuma `api.php` zai amsa da 404 `UNKNOWN_PATH`. Idan tsarinka yana buƙatar `try_files`, adana ƙimar da farko tare da `set $path_info $fastcgi_path_info;` sannan ka miƙa `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` ba shi da hanyoyin path routes kuma ba ya buƙatar su.

## Console

Management > MCP yana da shafuka uku. Kana buƙatar realm na **MCP Administration**. Hotunan allo a nan da ƙasa sun fito ne daga ginin haɓakawa na Cacti tare da bayanan misali.

- **Abilities** yana jera kowane ability da aka yi wa rajista tare da plugin ɗinsa, nau'insa, realm ɗin da yake buƙata, da kuma ko an bayyana shi. Zaɓi layuka sannan ka zaɓi Expose ko Hide; za ka tabbatar kafin canjin ya yi aiki. Built-in `cacti-*` abilities suna bayyane ta tsoho. Abilities daga sauran plugins suna farawa a ɓoye, don haka shigar da plugin ba ya taɓa wallafa komai har sai mai gudanarwa ya yanke shawara. Bayyanawa tana rage damar shiga ne kawai: mai amfani yana buƙatar realm ɗin ability ɗin har yanzu.

  ![Shafin Abilities yana jera built-in abilities tare da realms ɗinsu da yanayin bayyanawa](../../images/console-abilities.png)
- **Tokens** yana jera alamomi tare da mai mallaka, mai ƙirƙira, lokacin ƙirƙira, lokacin ƙarewa, amfani na ƙarshe, da yanayi (Active, Expired, Revoked). Zaɓi layuka sannan ka zaɓi Revoke don soke su. Alamomin da aka soke ba za a iya sake amfani da su ba. Create Token yana ƙirƙirar sabo.

  ![Shafin Tokens yana jera alamomi tare da mai mallaka, ƙarewa, amfani na ƙarshe, da yanayi, a saman fom ɗin Create Token](../../images/console-tokens.png)
- **Audit** yana jera layukan bincike, sabo a farko, kuma yana tacewa ta mai amfani, ability, da sakamako.

  ![Shafin Audit yana jera kiraye-kiraye tare da mai amfani, token, ability, da sakamako, tare da matattara](../../images/console-audit.png)

## Alamomi

Personal token yana karanta Cacti a matsayin mai mallakarsa. Yana da tsarin `cmcp_pat_` sai ƙananan haruffan hex guda 64 ke biye da shi kuma yana ɗauke da iyaka guda ɗaya `abilities:read`. Abin da zai iya gani ana yanke shawara ne ta hanyar Cacti realms na mai mallakarsa da izinin na'ura, ba ta token ɗin ba. Dole ne mai mallakar ya zama mai amfani mai aiki wanda ke riƙe da realm na **MCP and Abilities API**.

Ana ƙirƙirar alamomi koyaushe don mai amfani, suna ƙarewa, kuma ana iya soke su:

- **Console.** Management > MCP > Tokens > Create Token. Tsawon rayuwa shine kwanaki 1 zuwa 365 kuma tsoho shine 90. Uwar garken ce ke samar da token ɗin kuma ana nuna shi sau ɗaya a shafin amsa, don haka ka kwafe shi zuwa manajan sirrinka nan take. Za ka iya ƙirƙirar token don kanka. Ƙirƙirar ɗaya don wani mai amfani yana buƙatar realm na Users/Groups kuma, saboda token ɗin yana karanta Cacti a matsayin wannan mai amfani.
- **My MCP Tokens.** Kowane mai amfani mai realm na MCP and Abilities API zai iya sarrafa nasa alamomin; duba ƙasa.
- **Command line.** `tokens.php` yana aiki ne kawai daga CLI, a matsayin asusun OS da zai iya gudanar da Cacti. Yana karɓar token ɗin daga environment domin ƙimar kada ta taɓa bayyana a layin umarni ko a jerin matakai. Tsawon rayuwa shine kwanaki 1 zuwa 365 kuma tsoho shine 30. Ana bincika ƙirƙira da soke token ta hanyar CLI kamar console, tare da mai mallakar token ɗin a matsayin mai aiwatarwa domin CLI ba shi da mai amfani na Cacti, don haka layin audit ba ya nuna cewa aikin ya fito ne daga CLI. `--list` yana buga kowane token a matsayin JSON (ID, mai mallaka, iyakoki, tambarin lokaci, alamar sokewa) kuma ba ya taɓa buga ƙimar token ɗin; `--help` yana nuna yadda ake amfani da shi.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Ba za a iya ƙirƙirar alamomi don asusun baƙo, don masu amfani da aka kashe, ko don masu amfani ba tare da realm na **MCP and Abilities API** ba, daga console, command line, ko My MCP Tokens. Cacti yana adana saitin baƙo a matsayin sunan mai amfani ko ID na mai amfani, kuma plugin ɗin yana warware duka biyun. Token ɗin da mai mallakarsa ya zama asusun baƙo zai daina aiki a kiransa na gaba.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ba ya buƙatar realm na gudanarwa: yana ƙarƙashin realm na **MCP and Abilities API**, kuma shigarwar menu tana bayyana ne kawai ga masu amfani da ke riƙe da shi. Shafin koyaushe yana aiki akan mai amfani da ya shiga. Menu na Cacti wani ɓangare ne na console, don haka mai amfani ba tare da damar shiga console ba zai iya zuwa shafin ta adireshinsa.

![Shafin My Tokens yana jera alamomin mai amfani da ya shiga da fom ɗin ƙirƙira](../../images/my-tokens.png)

- **Tokens** yana jera alamominka, yana ƙirƙirar guda ɗaya (kwanaki 1 zuwa 365, tsoho 90, ana nunawa sau ɗaya a cikin amsa), kuma yana soke naka. Ba za ka iya gani ko soke na wani ba.
- **Activity** yana jera ayyukan da ka yi, sabo a farko: kiraye-kirayen da aka yi da alamominka da canje-canjen token da ka yi.
- **Available Tools** yana jera abilities ɗin da token ɗinka zai iya amfani da su a halin yanzu, tare da ID, suna, da bayanin kowane ability. Yana bin izinin Cacti ɗinka da saitunan bayyanawa da mai gudanarwa ya zaɓa.

  ![Jerin Available Tools yana nuna ID, suna, da bayanin kowane ability](../../images/my-tools.png)

Shigarwar da aka yi kafin wannan shafin ya wanzu tana da jerin fayilolin realm ba tare da `mcp_tokens.php` ba. Shigarwa tana yin rajistar jerin; ba a sabunta ta ta hanyar kunnawa ko kashe plugin ɗin. Cire kuma ka sake shigar da plugin ɗin, sannan ka sake ba da realms, domin Cacti yana cire bayar da realm lokacin da aka cire plugin.

Ma'ajin bayanai yana adana hash ɗin SHA-256 na token ɗin ne kawai, don haka token ɗin da ya ɓace ba za a iya dawo da shi ba; soke shi sannan ka ƙirƙiri wani. Juyawa iri ɗaya ne: ƙirƙiri sabon token, canza abokin hulɗa, sannan ka soke tsohon. Token da ya ƙare, token da aka soke, mai mallaka da aka kashe, ko realm da ya ɓace kowannensu zai gaza a buƙata ta gaba. Ana karɓar alamomi ne kawai a cikin kanun `Authorization: Bearer`; ba a karɓar token a cikin query string ko body.

## Haɗa abokin ciniki

Yi amfani da mahaɗin MCP na `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, tare da
alamar sirri (token) a cikin kanun `Authorization: Bearer`. Ajiye alamar sirrin a cikin
mabuɗin yanayi (environment variable) ko manajan sirri sannan ka yi nuni zuwa gare shi daga
tsarin abokin ciniki maimakon rubuta ƙimarsa kai tsaye a cikin fayil.

### Claude Code

Sanya mahaɗin a cikin fayil ɗin `.mcp.json` na aiki wanda ke yin nuni ga alamar sirrin da sunanta.
Claude Code yana faɗaɗa `${VAR}` a cikin `url` da `headers`, don haka fayil ɗin ba ya ƙunshe da wani sirri kuma
yana da aminci a tura shi a cikin ma'ajiyar lamba (commit). Fitar da `CACTI_MCP_TOKEN` a cikin yanayin da ke kunna Claude Code.

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

Haka kuma za ka iya ƙara shi ta layin umarni:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Tare da alamomin zance biyu, harsashinka (shell) yana fara faɗaɗa `$CACTI_MCP_TOKEN`, don haka ana rubuta
ƙimar alamar sirrin a cikin fayil ɗin saiti don `--scope` da aka zaɓa (`local`, `user`, ko
`project`; na asali shi ne `local`). Kada ka yi amfani da wannan tsarin tare da `--scope project`, kuma ka nisanta
fayil ɗin daga tsarin kula da sigar lamba (version control). Fi amfani da nunin `.mcp.json` da ke sama. Claude Code
yana karanta wasu mabuɗan shaidar sirri (kamar `ANTHROPIC_AUTH_TOKEN`) a matsayin fanko a cikin `url` na nesa
da `headers`; amma `CACTI_MCP_TOKEN` ba ya cikinsu. Tushe:
[Takardun bayanan MCP na Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot a cikin VS Code

Yi amfani da fayil ɗin `.mcp.json` na tushen wurin aiki (ko fayil ɗin mai amfani `~/.copilot/mcp-config.json`).
Waɗannan fayilolin asali na Copilot suna amfani da abun `mcpServers` na matakin sama da kuma nuni ga
mabuɗin yanayi na `${NAME}` a cikin ƙimomin kanu:

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

Fitar da `CACTI_MCP_TOKEN` a cikin yanayin da ke kunna VS Code. Fayilolin asali na Copilot
ba sa goyon bayan tambayoyin shigarwa na `inputs`. Tsarin saiti mai jagora na VS Code yana ƙin ƙimomin `${...}`,
don haka ƙara kanun `Authorization` ta hanyar gyara fayil ɗin kai tsaye, ba ta hanyar
tsarin jagora ba. Tsarin saiti mai jagora yana ba da zaɓin fayil ɗin tushen wurin aiki
ne kawai lokacin da aka kunna saitin gwaji na `chat.mcp.workspaceRootConfig.enabled`. Duba
[Jagorar saitin MCP na VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Tsohon tsari: `.vscode/mcp.json`.** VS Code ya ce sababbin saitunan Copilot kada su
yi amfani da `.vscode/mcp.json` ko `mcp.json` na bayanin martaba (profile); suna cikin tsohon tsarin
Local harness wanda aka daina amfani da shi, kuma za a cire shi a watan Fabrairu 2027. Idan har yanzu kana amfani da shi,
tsarin da editan ke sarrafawa yana ɗaukar mabuɗin `servers` na matakin sama kuma yana iya neman shigar da alamar sirrin:

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

### Abokan ciniki da ke amfani da stdio kawai

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) na'ura ce ta daidaitawa ta zaɓi
wadda ke aiki a matsayin sabar MCP ta stdio ta gida kuma tana kiran HTTP API na ƙarin manhajar (plugin). Yi amfani da ita don
abokin ciniki wanda ba zai iya haɗawa da sabar HTTP ta nesa ba. Tana buƙatar wannan alamar sirri ta mutum ɗaya
kuma tana sadarwa da `api.php`.

### Halayyar MCP

Mahaɗin yana ba da kayan aiki (tools) ne kawai: kowace iyawa da aka bayyana kuma aka ba da izini kayan aiki ce mai sunan
lambar shaidarta (ID), tare da tsarin shigarwa da fitarwa (schemas) da bayanan karatu-kawai
(`openWorldHint` yana da ƙimar `false`). Yana sarrafa `initialize`, `server/discover`, `ping`,
`tools/list`, da `tools/call`. Ba ya riƙe zama (session), ba ya aika `Mcp-Session-Id`
(kuma yana watsi da duk wanda ya karɓa), kuma ba ya karɓar rukunin buƙatun JSON-RPC. Saƙon da
ba shi da `id` sanarwa ne kuma yana samun HTTP 202 ba tare da jiki ba. `POST` ne kawai
aka yarda da shi.

- **Bita-bita (Revisions).** Buƙatar da ke ɗauke da `io.modelcontextprotocol/protocolVersion` a cikin
  `params._meta` dole ne ta ambaci `2026-07-28`; duk wani abu dabam yana samun kuskuren `-32022`. Irin
  waɗannan buƙatun dole ne su kuma kasance suna ɗauke da kanun `Mcp-Protocol-Version`, `Mcp-Method`, da (don
  `tools/call`) `Mcp-Name` masu dacewa, ko kuma amsar za ta zama kuskuren `-32020`. Sauran buƙatun
  ana ɗaukarsu a matsayin `2025-11-25`: `initialize` yana amsawa da wannan bitar, kuma a kan kowace
  wata hanya kanun `Mcp-Protocol-Version`, idan an aika, dole ne ya zama `2025-11-25`,
  `2025-06-18`, ko `2025-03-26`.
- **Kurakuran kayan aiki.** Kuskuren iyawa, gami da muhawarorin (arguments) da ba su dace da
  tsarin schema ba ko ƙimar `arguments` wadda ba abun JSON (JSON object) ba ce, yana dawowa a matsayin sakamakon kayan aiki
  tare da `isError: true` da kuskuren AIP-193 a cikin `structuredContent`, ba a matsayin
  kuskuren ƙa'ida (protocol error) ba.
- **Kurakuran ƙa'ida (Protocol errors).** Gazawar da ba kurakuran kayan aiki ba ne abubuwan kuskuren JSON-RPC ne
  (lambar `-32000` tare da matsayi da dalili a cikin `data`, ko lambobin daidaitattu): rashin
  Public Cacti URL, `Origin` da aka ƙi, buƙata yayin da aka kashe ƙarin manhajar
  ko a kan na'urar tattara bayanai ta nesa (remote poller), da kurakuran sabar da ba a zata ba (`-32603`, tare da rubuta cikakken bayanin
  zuwa rajistar Cacti, ba a cikin amsar ba). Binciken buƙatu da ke fara gudana (405,
  413, 415) da gazawar tantancewa (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  suna riƙe jikin AIP-193 da aka bayyana a ƙarƙashin HTTP API.

## HTTP API

URL na tushe: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Yarjejeniyar tana
cikin [openapi.json](../../../openapi.json).

| Hanya da adireshi | Manufa |
| --- | --- |
| `GET /v1/abilities` | Jero iyawar da aka ba da izini. Tambaya (Query): `pageSize`, `pageToken`, da `filter` mai tsarin `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Karanta iyawa guda. |
| `POST /v1/abilities/{id}:execute` | Gudanar da ita. Jikin buƙatar shi ne daidai `{"arguments": {...}}`. Amsar ita ce `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Kurakurai suna bin AIP-193: abun `error` mai ɗauke da `code`, `message`, `status`, da
`details` wanda ke ɗauke da `ErrorInfo` mai yankin `cacti.net` da tabbataccen `reason`.
Matsalolin muhawara suna ƙara bayanin `BadRequest` mai sunan filin. Girman jikin buƙatu
an iyakance shi zuwa 64 KB, kuma sakamako zuwa 1 MB. Duka mahaɗan biyu suna amsawa ne kawai a kan babbar
na'urar tattara bayanai (main poller) kuma suna mayar da `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) idan an kashe ƙarin manhajar
ko sabar ba ita ce babbar na'urar tattara bayanai ba.

| HTTP | Ƙimomin `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (kuma yana aika `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (yana aika `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Rubuta iyawa (marubutan ƙarin manhaja)

Ƙarin manhajar Cacti da aka kunna tana yin rijistar iyawowi daga aikin (function) da ta haɗa zuwa
ƙugiyar `abilities_register`, yawanci a cikin `plugin_<slug>_install()` nata:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Aikin yana karɓar `AbilitiesRegistrar` da aka iyakance ga ƙarin manhajar. Ana watsi da
ƙimar da ya mayar.

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

Ƙa'idojin, waɗanda ake aiwatar da su duka a lokacin rijista:

- **Lambobin shaida (IDs).** Lambar shaida tana dacewa da `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ba ta wuce haruffa 64 ba,
  kuma dole ne ta fara da slug ɗin ƙarin manhajar da alamar haɗi (hyphen): `acme-` a sama.
  Slug ɗin shi ne sunan kundin (directory) ƙarin manhajar, don haka kundi kamar `my_plugin` ba zai iya
  yin rijistar komai ba. Ana ƙin kundin ƙarin manhaja mai suna `cacti`; wannan
  sararin sunan na asalin tsarin ne.
- **Ma'ana (Definition).** Waɗannan mabuɗan ne kaɗai daidai: `label`, `description` (har zuwa baiti 4096),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Dole ne rukunin ya riga ya wanzu: yi amfani da na asali (`inventory`,
  `system`) ko ka yi rijistar naka da `registerCategory()`, wanda lambar shaidarsa ta keɓanta a duk
  ƙarin manhajojin kuma tana dacewa da `^[a-z][a-z0-9-]{0,31}$`.
- **Karatu-kawai kaɗai.** Dole ne `annotations` su kasance daidai `readOnly: true`,
  `destructive: false`, `idempotent: true`. Duk wani abu dabam yana jefa kuskure.
- **Tsarukan Schemas.** Dole ne kowanne daga `input_schema` da `output_schema` ya kasance yana da
  `type` `object` a matakin sama. Tsarin ƙarami ne kuma yana gaza a rufe (fails closed). Dole ne abubuwa (objects) su kasance a rufe
  (`additionalProperties: false`, tare da `properties` a wurin); sauran nau'ikan su ne
  `integer` da `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, da `array` (wanda ke buƙatar `items` da
  `maxItems`). Za a iya mayar da nau'i
  ya karɓi null kamar `['string', 'null']`. Jimlolin muhawara (argument strings) na asali suna iyakance a haruffa
  4096 a mafi yawa; jimlolin sakamako ana iyakance su ne kawai da `maxLength` da aka ayyana
  da kuma iyakar girman sakamako. Iyawowi 256 ne kawai a mafi yawa za su iya yin rijista.
- **`permission(int $userId): bool`.** Dole ne ya mayar da `true` daidai don bayar da izini.
  Lambar shaidar mai amfani ta mai alamar sirrin ce; kada a taɓa karanta yanayin zama (session state).
- **`execute(int $userId, stdClass $args): array`.** An riga an tantance `$args`
  bisa ga `input_schema`. Ka aiwatar da izinin matakin abu da kanka. Mayar da
  associative array wanda ya dace da `output_schema` daidai; jeri (list), ƙarin fili,
  ko fiye da 1 MB na JSON zai zama kuskuren `INVALID_RESULT`. Jefa
  `AbilitiesError` don gazawar da abokin ciniki zai gani, kamar `NOT_FOUND`.
- **Fankon abubuwa (Empty objects).** PHP yana ɓoye `[]` a matsayin jerin JSON. Duk inda tsarin fitarwa
  ya ayyana `object`, a kowane zurfi, rajistar tana ɗaukar `[]` a matsayin fankon abu
  kuma tana aika `{}`; `new stdClass()` ma yana aiki. Jeri mara fanko ba ya taɓa zama
  abu kuma yana gazawa da `INVALID_RESULT`. Taswirar `properties` marar komai a cikin schema
  za ta iya zama `[]` ko `new stdClass()`; ana wallafa su duka a matsayin `{}`.
- **Keɓewar gazawa.** Kowane ƙarin manhaja yana yin rijista a cikin kwafin gwaji wanda ake ajiyewa
  kawai idan aikinka ya dawo ba tare da matsala ba. Idan ya jefa kuskure, babu ko ɗaya daga cikin iyawowinka da
  za a yi wa rijista, kuma ana rubuta gazawar a cikin rajista (log).

Iyawowi daga ƙarin manhajojin suna farawa a ɓoye. Mai gudanarwa yana bayyana su a kan
shafin Abilities na na'urar sarrafawa (console), kuma shafin Required Realm yana nuna "Set by the plugin"
don su.

## Tsarin tsaro

- **Bearer kawai.** `api.php` da `mcp.php` suna karɓar alamar sirri ta mutum a cikin kanun
  `Authorization` ne kawai kuma ba komai bayan haka. Suna watsar da cookies, `$_POST`, da
  `$_REQUEST` kafin Cacti ya loda kuma suna rushe zaman da Cacti ya fara, don haka shiga ta
  burauza ba ya taɓa ba da damar shiga API.
- **Hanyar kauce wa CSRF.** Mai kare CSRF na Cacti yana ƙin JSON POST wanda ba shi da
  alamar CSRF ta Cacti, abin da babu wani abokin ciniki na MCP da zai iya aikawa. Ga
  waɗannan iyakoki biyu kawai, ƙarin (plugin) yana sake sunan hanyar buƙata kafin Cacti ya
  loda sannan ya mayar da ita bayan haka, don haka mai tsaron ya tsallake su. Wannan yana da
  aminci saboda CSRF yana kare buƙatun da burauza ke tabbatarwa da cookies, kuma waɗannan
  iyakoki ba sa karɓar kowace shaida ta cookie: shafin da ke tsakanin rukunoni ba zai iya
  haɗa alamar bearer ba. Shafukan console suna riƙe cikakkiyar kariyar CSRF. Wannan hanyar
  wucin gadi ce, har sai Cacti ya bayar da keɓewar da aka goyi baya; duba
  `lib/bootstrap.php`.
- **Binciken Origin.** A kan `mcp.php`, idan buƙatar tana da kanun `Origin`, dole ne ta zama
  daidai da tsarin (scheme), uwar garke (host), da tashar jiragen ruwa (port) na Public
  Cacti URL, ko kuma a ƙi buƙatar da `ORIGIN_NOT_ALLOWED`. Buƙatar da ba ta da kanun
  `Origin`, wanda shi ne yadda abokan cinikin da ba na burauza ba ke haɗawa, ana barin ta.
  Wannan yana hana shafin yanar gizo sarrafa iyakar daga burauzar baƙo. `api.php` ba ya
  amfani da wannan binciken.
- **Karatu kawai.** Rajista tana ƙin duk wata ƙwarewa da ba ta karatu kawai ba ce, marar
  lalatawa, kuma mai maimaituwa ba tare da sauya sakamako ba (idempotent).
- **Bayyanawa da yankuna (realms) duk suna aiki.** Dole ne a bayyana ƙwarewa kuma mai
  mallakar alamar ya riƙe yankinta (realm). Idan ba za a iya karanta teburin bayyanawa ba,
  kowace ƙwarewa tana ɓuya maimakon komawa ga tsoffin saituna.
- **Ɓoyayyu, waɗanda ba a sani ba, da marasa izini suna kama da juna.** Abokin ciniki ba
  zai iya bambance ƙwarewar da ba ta wanzu ba da wadda take ɓoye ko wadda mai amfani da
  ita ba shi da izinin amfani da ita: bincike yana tsallake ta kuma aiwatarwa tana dawo da
  `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Alamomi (Tokens).** Ana adana su a matsayin SHA-256 hashes, ana nuna su sau ɗaya,
  koyaushe suna ƙarewa, ana iya soke su, kuma ana ƙin su lokacin da aka kashe mai su ko ya
  rasa yankin (realm).
- **Binciken lissafi (Audit).** `plugin_mcp_audit` yana rubuta lambar buƙata (request ID),
  lambar alama (token ID), lambar mai amfani (user ID), ƙwarewa, sakamako (`started`,
  `succeeded`, `failed`, `denied`, `rejected`), da lokutan aiki. Ba ya taɓa rubuta
  hujjoji (arguments), sakamako, ko ƙimar alama. Ƙwarewa tana gudana ne kawai bayan an
  rubuta layinta na `started`; idan teburin audit ba ya samuwa, kiran yana gazawa da
  `UNAVAILABLE` kuma ba ya gudana. Kiran da aka ƙi kafin ya gudana layi ɗaya ne: `denied`
  ga ƙwarewar da ba a sani ba, ɓoyayyiya, ko marar izini, `rejected` ga hujjojin da suka
  gaza bin tsarin (schema). Ƙirƙirar alama da soke ta daga console, My MCP Tokens, da CLI
  ana rubuta su a matsayin `mcp-token-create` da `mcp-token-revoke` tare da sakamakon
  `succeeded`, kuma ana rubuta sokewa ne kawai ga alamar da take aiki. Bincike (discovery),
  da kiran da `arguments` ɗinsa ba JSON object ba ne, ba a rubuta su a log.
- **Log na gazawa.** Gazawar da ba a zata ba, `INVALID_RESULT`, ko teburin audit da ba ya
  samuwa suna rubuta layi ɗaya zuwa log na Cacti tare da facility `MCP`: lambar ƙwarewa,
  ƙayyadadden dalili, da ajin keɓewa (exception class). Ba a taɓa rubuta saƙonni, hujjoji,
  da alamomi a log.
- **Babban poller kawai.** Dukkan iyakokin biyu, dukkan shafukan console biyu, da
  `tokens.php` suna ƙin yin aiki a wani wuri daban.

## Tsarin rayuwa

Kashe ƙarin (plugin) yana toshe dukkan iyakokin biyu. Cire shi (uninstalling) yana soke
kowace alama kuma yana adana teburori ukun (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) don ajiya; sake shigar da shi ba ya sake kunna alamar da aka soke.
Yi ajiyar (backup) teburorin tare da rumbun adana bayanai na Cacti kuma ka yi amfani da
tsarin riƙe bayanan audit a wajen ƙarin.

## Haɓakawa da gwaje-gwaje

Jerin gwaje-gwajen ya ƙunshi rubutun PHP na yau da kullun a cikin `tests/` tare da gwaje-gwajen raka'a na PHPUnit a cikin `tests/Unit/` da nazarin tsaye na PHPStan (mataki na 6), dukkansu suna gudana ba tare da shigar da Cacti ba:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI yana gudana akan PHP 8.2 zuwa 8.5: aikin `test` wanda ke duba ingancin PHP (`php -l`) kuma yana gudanar da rubutun gwajin PHP guda 13 da ke jere a cikin `.github/workflows/ci.yml`, aikin `quality` wanda ke gudanar da `composer phpstan` da `composer test`, da kuma aikin `package` wanda ke gina rumbun adanawa na `mcp/` mai shigarwa (banda fayilolin haɓakawa da gwaji da ke jere a cikin `.gitattributes`) da `SHA256SUMS` ɗinsa. Gwaje-gwajen da suka shafi Cacti suna amfani da fixtures a iyakar mataimakin Cacti; ba sa gwada cikakken shigarwar Cacti.

### Gwaje-gwajen haɗin kai

`tests/integration/run.sh 1.2.31` ko `tests/integration/run.sh develop` yana shigar da ƙarin
cikin ainihin Cacti a cikin containers kuma yana gudanar da gwaje-gwaje kai tsaye akansa.
Yana buƙatar Docker tare da Compose v2.23.1 ko na baya, git da openssl. `KEEP=1` yana barin
tarin yana gudana don gyaran kuskure (debugging). CI yana gudanar da shi kowane dare da
kuma idan an buƙata, ba akan pull requests ba.

## Daidaita harshe (Localization)

Cacti MCP yana zuwa da kundin GNU gettext da aka haɗa a ƙarƙashin `locales/po/` da
`locales/LC_MESSAGES/` da kuma READMEs da aka daidaita zuwa harsuna daban-daban a
ƙarƙashin `docs/i18n/` don Turanci tare da harsuna 47 (19 Broad Tier 1, 15 na Afirka, 10 na Asiya, da kuma Bosnian, Croatian, da Serbian), ta amfani da yankin rubutu na `mcp` (`locales/po/mcp.pot`). Cacti yana loda
kundin da ya dace ta atomatik lokacin da aka kunna tallafin harshe.

## Gudummawa

Pull requests suna zuwa ga `develop`. Kiyaye lambar samarwa ta dace da PHP 8.2 kuma yi
amfani da salon Cacti: tabs, kirtani masu alamar faɗin magana guda ɗaya (single-quoted
strings), da mataimakan rumbun adana bayanai da izini na Cacti. Ƙara gwaje-gwaje don canjin
tantancewa, ba da izini, ko halayyar ƙa'idar sadarwa (protocol), kuma ka sanya hannu kan
commits tare da `git commit -s`. Daidaita canje-canje zuwa HTTP API tare da
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Lasisi

Haƙƙin mallaka (C) 2026 Thomas Vincent. An sake shi a ƙarƙashin GNU General Public License,
sigar 2 ko na baya. Duba [LICENSE](../../../LICENSE).
