<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: igiti cya cactus gifite ingabo. Vumbura. Emeza. Koresha.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Uruhushya: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP ni umugereka (plugin) wa Cacti wemerera abakiriya ba AI gusoma amakuru yawe ya Cacti binyuze mu
bikorwa byahawe amazina kandi byayunguruwe hakurikijwe uburenganzira byitwa ubushobozi (abilities). Uyu mugereka ubagezaho ibyo bikorwa mu buryo bubiri
uturutse muri wo ubwawo: ahantu h'ishyirwamikorere ha MCP (`mcp.php`, Streamable HTTP) na
API ya HTTP ikoze mu buryo bwa AIP (`api.php`). Cacti iguma ari yo igenzura iyemezwa ry'uburenganzira n'ishyirwa
mu bikorwa. Umukiriya ntabwo abaza ububiko bw'amakuru mu buryo butaziguye; ashobora gusa guhamagara ubushobozi
umuyobozi wa sisitemu yashyize ahagaragara kandi bwemerwa n'imbibi za Cacti (realms) za nyir'urufunguzo (token).

Abanditsi b'imigereka bashobora kwandikisha ubushobozi bwabo bwo gusoma gusa binyuze kuri hook ya
`abilities_register`, maze bukagaragarira abakiriya ba MCP nk'ibikoresho (tools) nta kode ya
porotokole basabwa kwandika.

**Imiterere: mbere y'isohoka, verisiyo 0.1.0.** Nta verisiyo yahawe ikirango (tagged release) irahari.

Ibiboneka ubu:

- Ubushobozi busanzwemo (built-in) bwo gusoma gusa bujyanye na verisiyo za sisitemu n'urutonde rw'ibikoresho.
- Impapuro z'uburenganzira zihariye (`cmcp_pat_...`) nk'uburyo bwonyine bwo kwemeza umwirondoro.
- Urubuga rw'ubuyobozi rwa Management > MCP: gushyira ahagaragara cyangwa guhisha ubushobozi, guhanga no gutesha agaciro
  impapuro z'uburenganzira, no gusoma inyandiko z'igenzura (audit log).
- Management > My MCP Tokens: abakoresha bacunga impapuro zabo z'uburenganzira, bakareba ibikorwa byabo,
  kandi bakareba ibikoresho impapuro zabo zishobora gukoresha.
- MCP kuri Streamable HTTP, amavugurura ya porotokole `2026-07-28` na `2025-11-25`,
  ibikoresho (tools) gusa.

Ibitaraboneka kugeza ubu:

- Kwinjira ukoresheje OAuth 2.1. Ibikoresho bihuza biri kuri serivisi zishyizwe ku rubuga bidashobora kohereza urufunguzo rwihariye, nk'ibihuza
  byihariye bya ChatGPT na claude.ai, ntibishobora kwihuza kugeza bibonetse. Biteganyijwe
  muri Plan 2; uwo mugambi nturandikwa.
- Ubushobozi bwo kwandika. Ubushobozi bwo gusoma gusa ni bwo bushobora kwandikishwa.

Imiterere y'igishushanyo mbonera iri muri
[inyandiko y'igishushanyo mbonera cy'aho bahurira](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
naho urukurikirane rw'iyubaka ruri muri [docs/plan.md](../../plan.md).

## Ubushobozi busanzwemo

| ID | Ibishingirwaho | Urubibi rwa Cacti rukenewe |
| --- | --- | --- |
| `cacti-get-system-info` | ntacyo | 15 |
| `cacti-list-devices` | bidategetswe `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | bitegetswe `name`, urugero `devices/12` | 3 |

Buri muhamagaro na wo ukenera urubibi rwa **MCP and Abilities API** kuri nyir'urufunguzo,
uburenganzira bwa `abilities:read` (buri rufunguzo rwihariye rurabufite), n'ubushobozi
bwashyizwe ahagaragara. Agashami ka Abilities mu rubuga rw'ubuyobozi kerekana urubibi buri bushobozi busanzwemo bukenera.

- `cacti-list-devices` isubiza amapaji agera ku bikoresho 100 (mu busanzwe 50) na
  `nextPageToken`. Urufunguzo rw'ipaji rukora gusa kuri `filter` na
  `orderBy` bimwe. `filter` ni imvugo ya AIP-160 y'ibigereranyo bihujwe na `AND`,
  urugero `state = "DOWN" AND disabled = false`. Ibice byo kuyungurura ni
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, na `state`. `orderBy` yakira `displayName`, `hostname`, cyangwa `name`,
  buri kimwe gishobora gukurikirwa na `desc`.
- Ibibazo by'ibikoresho binyura muri `get_allowed_devices()` ya Cacti, bityo umukoresha abona gusa
  ibikoresho Cacti yari kumwereka.
- Ibice by'igikoresho bikuramo imigozi y'imiryango ya SNMP, amagambo y'ibanga, n'ibindi
  byemezo by'umwirondoro.

## Kwinjiza

Bisaba Cacti 1.2.31 cyangwa iyisumbuyeho, PHP 8.2 cyangwa iyisumbuyeho, na poller nkuru. Kwemeza umwirondoro kwa Cacti
kugomba kuba gufunguye; umugereka wanga kwemeza umwirondoro iyo gufunzwe.

Ububiko bw'umugereka bugomba kwitwa `mcp`, atari `plugin_mcp`. Izina rigufi ry'umugereka, amazina y'imbibi,
urubuga rw'ubuhinduzi, n'ama-URL byose bikoresha `mcp`.

Kuva kuri kopi y'inkomoko:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Kugeza habonetse amasohoka yahawe ibirango, ushobora ahubwo gukuramo igice cya `mcp-plugin`
mu bikorwa byagenze neza bya
[CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Kirimo `mcp.tar.gz` na `SHA256SUMS`. Emeza umubare w'igenzura, hanyuma ukururemo
`mcp.tar.gz` mu bubiko bwa `plugins/` bwa Cacti kugira ngo ibivuyemo bibe `plugins/mcp/`.
Ubushyinguro bw'inkomoko bwikora bwa GitHub bukoresha irindi zina ry'ububiko bwo hejuru. Ubushyinguro
bukuramo `docs/` (harimo n'amafoto y'ibigaragara kuri ecran ari hasi aha), `tests/`, na
`.github/`, ku buryo imiyoboro yo muri README igana muri `docs/` ikora kuri GitHub ariko idakora muri kopi
yinjijwe muri sisitemu.

Hanyuma:

1. Muri Plugin Management, injiza kandi ufungure **Cacti MCP**. Umuyobozi wa sisitemu winjije umugereka
   ahabwa mu buryo bwikora urubibi rwa **MCP Administration**.
2. Munsi ya Settings > MCP, shyiraho **Public Cacti URL** ku cyerekezo abakiriya bakoresha,
   urugero `https://cacti.example.com/cacti`. HTTPS irasabwa uretse kuri
   `localhost`, `127.0.0.1`, na `[::1]`. Kugeza ibi bishyizweho, `mcp.php` isubiza HTTP 400
   n'ikosa rya JSON-RPC rifite `data` ya `FAILED_PRECONDITION` na
   `PUBLIC_URL_REQUIRED`. `api.php` ntirisoma.

   ![Settings > MCP yerekana umwanya wa Public Cacti URL](../../images/settings-public-url.png)

3. Ha urubibi rwa **MCP and Abilities API** buri mukoresha uzaba nyir'urufunguzo.
   Nta mukoresha uruhabwa mu buryo bwikora.
4. Emeza ko seriveri y'urubuga yohereza umutwe wa `Authorization` n'amakuru y'inzira kuri PHP
   (reba hasi aha).
5. Fungura Management > MCP maze ushyire ahagaragara ubushobozi ushaka ko abakiriya babona.

**Kuvugurura uvuye ku nyubako y'igerageza.** Umugereka uri mbere y'isohoka, kandi imbonerahamwe zawo
zahindutse mu gihe cy'iyubakwa nta mikorere yo kwimura amakuru. Niba warinjije inyubako ya mbere,
yikuremo maze wongere uyinjize. Kongera kwinjiza bigumishaho imbonerahamwe zisanzwe
zihari, bityo banza usibe imbonerahamwe za kera za `plugin_mcp_token`, `plugin_mcp_audit`, na
`plugin_mcp_ability` (n'imbonerahamwe zihwanye nazo zaturutse ku
nyubako zakozwe mbere y'ihindurwa ry'izina). Zibike mu bubiko bw'inyunganizi niba ukeneye amateka yazo; impapuro z'uburenganzira zaturutse kuri
izo nyubako ziteshwa agaciro mu gukuramo umugereka kandi ntizikomezanya.

### Seriveri y'urubuga

Imiterere ya Apache ikuraho `Authorization` mbere ya PHP ikenera ibi mu rugo rw'ikoranabuhanga rubikwiye
cyangwa mu bubiko, bigakurikirwa no kongera gutangiza buhoro:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache ikoresha `mod_php` yakiriye inzira za `api.php` nta bundi buryo bw'inzira bwongereweho.

Inzira za `api.php` ziba mu nzira iri nyuma y'izina rya script
(`/plugins/mcp/api.php/v1/abilities`), ku buryo nginx igomba guhuza ama-URI aho `.php`
ikurikirwa n'indi nzira, ikayikatamo amakuru y'inzira, kandi ikayohereza kuri PHP. Agace ka
`location ~ \.php$` ntikigera gahuza n'izi URL; nginx isubiza n'ikosa ryayo bwite rya
HTML 404. Uburyo bwo guhuza ahantu n'imirongo ibiri ya path-info iri hasi aha byagenzuwe hamwe na
PHP-FPM; indi mirongo ni imiterere isanzwe yandikwa:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Hindura imirongo ya `include` na `fastcgi_pass` kugira ngo ihuze n'agace gasanzwe gatanga serivisi za
Cacti. Ntiwongere `try_files $fastcgi_script_name =404;` muri aka gace: bisiba
`$fastcgi_path_info`, maze `api.php` igasubiza 404 `UNKNOWN_PATH`. Niba imiterere yawe
ikenera `try_files`, banza ubike agaciro ukoresheje
`set $path_info $fastcgi_path_info;` maze wohereze `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` nta nzira z'imiyoboro igira kandi ntizikenera.

## Urubuga rw'ubuyobozi

Management > MCP ifite amashami atatu. Ukeneye urubibi rwa **MCP Administration**.
Amafoto y'ibigaragara kuri ecran ari hano no hasi aha yavuye mu nyubako y'igerageza ya Cacti irimo amakuru y'urugero.

- **Abilities** yerekana buri bushobozi bwandikishijwe hamwe n'umugereka wabwo, icyiciro,
  urubibi bukenera, n'iba bwashyizwe ahagaragara. Hitamo imirongo maze uhitemo Expose cyangwa
  Hide; urabanza ukemeza mbere y'uko impinduka zishyirwa mu bikorwa. Ubushobozi busanzwemo bwa `cacti-*`
  bushyirwa ahagaragara mu buryo busanzwe. Ubushobozi buva mu yindi migereka butangira buhishe, bityo kwinjiza
  umugereka ntibigera bitangaza ikintu na kimwe kugeza igihe umuyobozi abifatiye icyemezo. Gushyira ahagaragara
  bigabanya gusa uburyo bwo kugera ku makuru: umukoresha agomba kuba afite n'urubibi rw'ubwo bushobozi.

  ![Agashami ka Abilities kerekana ubushobozi busanzwemo hamwe n'imbibi zabwo n'imiterere yo gushyirwa ahagaragara](../../images/console-abilities.png)
- **Tokens** yerekana impapuro z'uburenganzira hamwe na nyirazo, uwazihanze, igihe zahangiwe, igihe zizarangirira, igihe zaherukiye gukoreshwa,
  n'imiterere (Active, Expired, Revoked). Hitamo imirongo maze uhitemo Revoke kugira ngo uziteshe agaciro.
  Impapuro zateshejwe agaciro ntizishobora kongera gukoreshwa. Create Token ihanga urushya.

  ![Agashami ka Tokens kerekana impapuro z'uburenganzira hamwe na nyirazo, igihe zizarangirira, igihe zaherukiye gukoreshwa, n'imiterere, hejuru y'ifishi ya Create Token](../../images/console-tokens.png)
- **Audit** yerekana imirongo y'igenzura, uhereye ku iheruka, kandi ikayungurura hakurikijwe umukoresha, ubushobozi,
  n'ibyavuyemo.

  ![Agashami ka Audit kerekana imihamagaro hamwe n'umukoresha, urufunguzo, ubushobozi, n'ibyavuyemo, hamwe n'ibiyungurura](../../images/console-audit.png)

## Impapuro z'uburenganzira

Urufunguzo rwihariye rusoma Cacti nka nyirarwo. Rufite imiterere ya `cmcp_pat_` ikurikirwa
n'inyuguti n'imibare 64 mu nyuguti nto z'ikinyacumi na gatandatu kandi rufite uburenganzira bumwe bwa `abilities:read`. Ibyo rushobora
kubona bigenwa n'imbibi za Cacti za nyirarwo n'uburenganzira ku bikoresho, atari
urufunguzo. Nyirarwo agomba kuba umukoresha ufunguye ufite urubibi rwa **MCP and Abilities API**.

Impapuro z'uburenganzira buri gihe zihangirwa umukoresha, zifite igihe zirangirira, kandi zishobora guteshwa agaciro:

- **Console.** Management > MCP > Tokens > Create Token. Igihe cyo kubaho ni kuva ku munsi 1 kugeza kuri 365
  kandi mu buryo busanzwe ni iminsi 90. Urufunguzo rukorwa na seriveri kandi rukerekanwa inshuro imwe ku
  rupapuro rw'igisubizo, bityo rukopore mu bubiko bwawe bw'amabanga ako kanya. Ushobora kwihangira
  urufunguzo. Guhangira undi mukoresha na byo bisaba urubibi rwa Users/Groups,
  kuko urufunguzo rusoma Cacti nk'uwo mukoresha.
- **My MCP Tokens.** Umukoresha uwo ari we wese ufite urubibi rwa MCP and Abilities API ashobora gucunga
  impapuro ze bwite; reba hasi aha.
- **Umurongo w'amabwiriza.** `tokens.php` ikora gusa ivuye muri CLI, nka konti ya sisitemu ishobora
  kuyobora Cacti. Ifata urufunguzo ivuye mu mimerere y'ibidukikije bya sisitemu kugira ngo agaciro katarigera
  kagaragara ku murongo w'amabwiriza cyangwa mu rutonde rw'ibikorwa biri gukora. Igihe cyo kubaho ni kuva ku munsi 1 kugeza kuri 365 kandi
  mu buryo busanzwe ni iminsi 30. Guhanga no gutesha agaciro urufunguzo binyuze muri CLI bigenzurwa kimwe
  no mu rubuga rw'ubuyobozi, hamwe na nyir'urufunguzo nk'uwabikoze kuko CLI nta mukoresha wa Cacti igira, bityo
  umurongo w'igenzura ntiwandika igikorwa nk'ikivuye muri CLI. `--list` yerekana
  buri rufunguzo nka JSON (ID, nyirarwo, uburenganzira, ibimenyetso by'igihe, ikimenyetso cyo guteshwa agaciro) kandi ntiyigera yerekana
  agaciro k'urufunguzo; `--help` yerekana imikoreshereze.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Impapuro z'uburenganzira ntizishobora guhangirwa konti y'umushyitsi, abakoresha bafunze, cyangwa abakoresha
badafite urubibi rwa **MCP and Abilities API**, haba mu rubuga rw'ubuyobozi, ku murongo w'amabwiriza, cyangwa muri
My MCP Tokens. Cacti ibika igenamiterere ry'umushyitsi nk'izina ry'ukoresha cyangwa ID y'ukoresha, kandi
umugereka usobanura byombi. Urufunguzo rufite nyirarwo wabaye konti y'umushyitsi ruhagarara gukora ku
busabe bwarwo bukurikiraho.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ntikenera urubibi rw'ubuyobozi:
irebwa n'urubibi rwa **MCP and Abilities API**, kandi aho bahitamo kuri menu
hagaragarira gusa abakoresha barufite. Urupapuro buri gihe rukorera ku mukoresha winjiye.
Menu ya Cacti ni igice cy'urubuga rw'ubuyobozi, bityo umukoresha udafite uburenganzira bwo kugera kuri urwo rubuga agera ku
rupapuro akoresheje aderese yarwo.

![Agashami ka My Tokens kerekana impapuro z'uburenganzira z'umukoresha winjiye n'ifishi yo guhanga](../../images/my-tokens.png)

- **Tokens** yerekana impapuro zawe, igahanga rumwe (kuva ku munsi 1 kugeza kuri 365, mu busanzwe 90, rwerekanwa inshuro imwe
  mu gisubizo), kandi igatesha agaciro urwawe. Ntushobora kubona cyangwa gutesha agaciro urw'undi muntu.
- **Activity** yerekana ibikorwa wakoze, uhereye ku biheruka: imihamagaro yakozwe n'impapuro zawe
  n'impinduka wakoze ku mpapuro z'uburenganzira.
- **Available Tools** yerekana ubushobozi urufunguzo rwawe rushobora gukoresha ubu nyine, hamwe na
  ID, izina, n'ibisobanuro bya buri bushobozi. Bikurikiza uburenganzira bwawe muri Cacti
  n'igenamiterere ryo gushyira ahagaragara umuyobozi yahisemo.

  ![Urutonde rwa Available Tools rwerekana ID, izina, n'ibisobanuro bya buri bushobozi](../../images/my-tools.png)

Iyinjizwa ryakozwe mbere y'uko uru rupapuro rubaho riba rifite urutonde rw'amadosiye y'imbibi rudafite
`mcp_tokens.php`. Kwinjiza kwandikisha urutonde; ntiruvugururwa no gufungura cyangwa
gufunga umugereka. Kuramo maze wongere winjize umugereka, hanyuma wongere utange imbibi,
kuko Cacti ikuraho itangwa ry'imbibi iyo umugereka ukuwemo.

Ububiko bw'amakuru bubika gusa umubare w'umutekano wa SHA-256 w'urufunguzo, bityo urufunguzo rwabuze ntirushobora
kugarurwa; ruteshe agaciro maze uhange urundi. Guhinduranya impapuro na byo ni kimwe: hanga urufunguzo rushya,
uhindure umukiriya, hanyuma uteshe agaciro urwa kera. Urufunguzo rwarangije igihe, urwateshejwe agaciro,
nyirarwo wafunzwe, cyangwa urubibi rwatakaye byose biratsindwa ku busabe bukurikiraho. Impapuro z'uburenganzira zemerwa
gusa mu mutwe wa `Authorization: Bearer`; urufunguzo ruri mu murongo w'ibibazo cyangwa mu mubiri w'ubutumwa
ntirwemerwa.

## Guhuza umukiriya

Koresha aho serivisi ya MCP ibarizwa `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, ufite
ikimenyetso (token) mu mutwe w'ubutumwa wa `Authorization: Bearer`. Bika ikimenyetso mu rihinduka ry'ibidukikije (environment variable)
cyangwa muri serivisi icunga amabanga maze ucyerekezeho mu igenamiterere ry'umukiriya aho
kwandika agaciro kacyo mu idosiye.

### Claude Code

Shyira aho serivisi ibarizwa muri `.mcp.json` y'umushinga yerekeza ku kimenyetso ikoresheje izina ryacyo.
Claude Code ikuramo agaciro ka `${VAR}` muri `url` no muri `headers`, bityo idosiye ntibikamo ibanga na rimwe kandi
ntacyo bitwaye kuyishyira muri git (commit). Ohereza `CACTI_MCP_TOKEN` mu bidukikije bitangiza Claude Code.

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

Ushobora kandi kucyongeramo unyuze ku murongo w'amabwiriza:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Ukoresheje utwuguzo tubiri, shell yawe ibanza gusimbura `$CACTI_MCP_TOKEN`, bityo agaciro k'ikimenyetso
kandikwa mu idosiye y'igenamiterere y'icyiciro cya `--scope` wahisemo (`local`, `user`, cyangwa
`project`; ibisanzwe byihitamo `local`). Ntukoreshe ubwo buryo hamwe na `--scope project`, kandi wirinde
gushyira iyo dosiye mu bubiko bw'igenzura ry'amavugurura (version control). Hitamo uburyo bwo kwerekeza muri `.mcp.json` bwavuzwe haruguru. Claude Code
isoma amwe mu mahinduka y'ibyangombwa byo kwinjira (nka `ANTHROPIC_AUTH_TOKEN`) nk'aho ari ubusa muri
`url` na `headers` byo ku rundi ruhande; `CACTI_MCP_TOKEN` ntibarirwa muri yo. Inkomoko:
[Inyandiko za MCP za Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot muri VS Code

Koresha `.mcp.json` iri ku muzi w'aho ukorera (workspace-root) cyangwa idosiye y'ukoresha `~/.copilot/mcp-config.json`.
Izi dosiye z'umwimerere za Copilot zikoresha ikintu cyo ku rwego rwo hejuru cya `mcpServers` hamwe n'inyerekezo z'amahinduka y'ibidukikije ya `${NAME}`
mu gaciro k'imitwe y'ubutumwa (headers):

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

Ohereza `CACTI_MCP_TOKEN` mu bidukikije bitangiza VS Code. Dosiye z'umwimerere za Copilot
ntizishyigikira ibisabwa byo kwinjiza bya `inputs`. Igenamiterere riyobowe rya VS Code ryanga uducisho twa `${...}`,
bityo ongeramo umutwe w'ubutumwa wa `Authorization` uhindura idosiye ubwayo, aho kunyura mu nzira
iyobowe. Igenamiterere riyobowe ritanga idosiye yo ku muzi w'aho ukorera
gusa iyo igenamiterere ry'igerageza rya `chat.mcp.workspaceRootConfig.enabled` rifunguye. Reba
[inyandiko ngenderwaho y'igenamiterere rya MCP muri VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Ubushaje: `.vscode/mcp.json`.** VS Code ivuga ko igenamiterere rishya rya Copilot ritagomba
gukoresha `.vscode/mcp.json` cyangwa `mcp.json` y'umwirondoro (profile); bibarirwa muri
Local harness yacyuye igihe, izakurwaho muri Gashyantare 2027. Niba ugikoresha ubu buryo, imiterere
icungwa n'umwandikaji ifata urufunguzo rwo ku rwego rwo hejuru rwa `servers` kandi ishobora gusaba ikimenyetso:

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

### Abakiriya bakoresha stdio gusa

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ni umuhuza utari itegeko
ukora nka seriveri ya MCP ya stdio ikorera ku mashini yawe kandi igahamagara HTTP API y'umugereka. Yikoreshe ku
mukiriya udashobora kwihuza na seriveri ya HTTP yo ku rundi ruhande. Ikenera ikimenyetso cyawe bwite
kimwe kandi ikavugana na `api.php`.

### Imikorere ya MCP

Aho serivisi ibarizwa hatanga ibikoresho gusa: buri bushobozi bugaragajwe kandi bwemewe ni igikoresho gifite izina
rya ID yacyo, hamwe n'imiterere y'ibyo cyakira n'ibyo gitanga n'inyandiko zisobanura ko ari izo gusoma gusa
(`openWorldHint` ni `false`). Cyakira `initialize`, `server/discover`, `ping`,
`tools/list`, na `tools/call`. Ntikibika icyiciro cy'ikiganiro (session), ntikohereza `Mcp-Session-Id`
(kandi kikirengagiza icyo cyakiriye), kandi nticyakira ibyiciro by'ibyifuzo bya JSON-RPC biteranyije. Ubutumwa
budafite `id` ni imenyekanisha kandi buhabwa HTTP 202 nta mubiri w'ubutumwa. `POST` gusa ni yo
yemewe.

- **Amasubiramo (Revisions).** Icyifuzo gifite `io.modelcontextprotocol/protocolVersion` muri
  `params._meta` kigomba kuvuga `2026-07-28`; ikindi cyose gihabwa ikosa `-32022`. Bene ibyo
  byifuzo bigomba kandi kugira imitwe y'ubutumwa ihura ya `Mcp-Protocol-Version`, `Mcp-Method`, na (kuri
  `tools/call`) `Mcp-Name`, bitabaye ibyo igisubizo kiba ikosa `-32020`. Ibindi byifuzo
  bifatwa nka `2025-11-25`: `initialize` isubizanya iryo subiramwo, kandi ku bundi
  buryo bwose umutwe wa `Mcp-Protocol-Version`, niba woherejwe, ugomba kuba `2025-11-25`,
  `2025-06-18`, cyangwa `2025-03-26`.
- **Amakosa y'igikoresho.** Ikosa ry'ubushobozi, harimo ibisabwa bidahura n'imiterere yagenwe (schema)
  cyangwa agaciro ka `arguments` katari ikintu cya JSON (JSON object), bigaruka nk'igisubizo cy'igikoresho
  kiriho `isError: true` hamwe n'ikosa rya AIP-193 muri `structuredContent`, aho kuba
  ikosa rya porotokole.
- **Amakosa ya porotokole.** Ibice bitari amakosa y'igikoresho ni ibintu by'ikosa bya JSON-RPC
  (kode `-32000` ifite imiterere n'impamvu muri `data`, cyangwa kode zisanzwe):
  Public Cacti URL ibura, `Origin` yanzwe, icyifuzo cyoherejwe umugereka uhagaritswe
  cyangwa kuri poller yo ku rundi ruhande, n'amakosa ya seriveri atunguranye (`-32603`, aho ibisobanuro
  byandikwa muri log ya Cacti, atari mu gisubizo). Igenzura ry'icyifuzo ribanza gukorwa (405,
  413, 415) n'amakosa yo kwemeza umwirondoro (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  bigumana umubiri wa AIP-193 wasobanuwe munsi ya HTTP API.

## HTTP API

URL fatizo: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Amasezerano y'imikorere ari
muri [openapi.json](../../../openapi.json).

| Uburyo n'inzira | Intego |
| --- | --- |
| `GET /v1/abilities` | Kugaragaza urutonde rw'ubushobozi bwemewe. Ikibazo (Query): `pageSize`, `pageToken`, na `filter` ifite imiterere ya `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Gusoma ubushobozi bumwe. |
| `POST /v1/abilities/{id}:execute` | Kubukoresha. Umubiri w'icyifuzo ni `{"arguments": {...}}` neza. Igisubizo ni `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Amakosa akurikiza AIP-193: ikintu cya `error` gifite `code`, `message`, `status`, na
`details` gitwaye `ErrorInfo` ifite domain ya `cacti.net` hamwe na `reason` idahinduka.
Ibibazo ku bisabwa byongeraho igisobanuro cya `BadRequest` kivuga izina ry'umwanya. Umubiri w'icyifuzo
ntugomba kurenza 64 KB, naho ibisubizo ntibirenze 1 MB. Aho serivisi zombi zibarizwa zisubiza gusa kuri
poller nyamukuru kandi zisubiza `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) igihe umugereka uhagaritswe
cyangwa seriveri atari yo poller nyamukuru.

| HTTP | Uducisho twa `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (byohereza kandi `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (byohereza `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Kwandika ubushobozi (abanditsi b'imigereka)

Umugereka wa Cacti ukora wandikisha ubushobozi uvuye mu mumaro uhuza na
hook ya `abilities_register`, akenshi muri `plugin_<slug>_install()` yawo:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Uwo mumaro wakira `AbilitiesRegistrar` igenewe uwo mugereka. Agaciro
usubiza kirengagizwa.

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

Amategeko, yose agenzurwa mu gihe cyo kwandikisha:

- **Ama-ID.** ID ihura na `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ntirenza inyuguti 64,
  kandi igomba gutangirwa n'izina rigufi ry'umugereka (slug) n'akarongo kihuza: `acme-` hejuru.
  Slug ni izina ry'ububiko bw'umugereka, bityo ububiko nka `my_plugin` ntibushobora
  kwandikisha ikintu na kimwe. Ububiko bw'umugereka bwitwa `cacti` burangwa; iryo
  zina ryihariwe n'ibyubatswemo imbere.
- **Ibisobanuro by'imiterere.** Izi mfunguzo neza: `label`, `description` (kugeza kuri bayiti 4096),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Icyiciro kigomba kuba gisanzwe gihari: koresha ibisanzwe (`inventory`,
  `system`) cyangwa wandikishe icyawe ukoresheje `registerCategory()`, aho ID yacyo iba yihariye mu
  migereka yose kandi igahura na `^[a-z][a-z0-9-]{0,31}$`.
- **Gusoma gusa.** `annotations` igomba kuba neza `readOnly: true`,
  `destructive: false`, `idempotent: true`. Ikindi cyose gitera ikosa.
- **Imiterere (Schemas).** `input_schema` na `output_schema` bigomba kugira buri kimwe ku rwego rwo hejuru
  `type` `object`. Uburyo bw'imiterere buroroshye kandi bwangira aho bidahuye (fails closed). Ibintu (`object`) bigomba kuba bifunze
  (`additionalProperties: false`, hamwe na `properties` ihari); ubundi bwoko ni
  `integer` na `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, na `array` (ikenera `items` na
  `maxItems`). Ubwoko bushobora
  gushyirwa mu buryo bwakira null nka `['string', 'null']`. Inyandiko z'ibisabwa ubusanzwe zifite umubare ntarengwa
  w'inyuguti 4096; inyandiko z'ibisubizo zigarukirwa gusa na `maxLength` yavuzwe
  hamwe n'ingano ntarengwa y'igisubizo. Ubushobozi butarenze 256 ni bwo bushobora kwandikishwa.
- **`permission(int $userId): bool`.** Kigomba gusubiza `true` neza kugira ngo cyemerere.
  ID y'ukoresha ni iya nyir'ikimenyetso; ntukigere usoma imiterere ya session.
- **`execute(int $userId, stdClass $args): array`.** `$args` iba yamaze kugenzurwa
  hashingiwe kuri `input_schema`. Genzura uburenganzira ku rwego rwa buri kintu ubwawe. Subiza
  associative array ihura neza na `output_schema`; urutonde, umwanya w'inyongera,
  cyangwa JSON irenze 1 MB bihinduka ikosa rya `INVALID_RESULT`. Tanga ikosa rya
  `AbilitiesError` ku makosa agaragarira umukiriya, nka `NOT_FOUND`.
- **Ibintu birimo ubusa.** PHP ihindura `[]` mo umubare utondekanye wa JSON (JSON array). Aho imiterere y'igisubizo
  igaragaza `object`, ku rwego urwo ari rwo rwose, ububiko bw'iyandikisha bufata `[]` nk'ikintu kirimo ubusa
  bukohereza `{}`; `new stdClass()` na yo irakora. Urutonde rutarimo ubusa ntirwigera rufatwa
  nk'ikintu kandi rutsindwa n'ikosa rya `INVALID_RESULT`. Imiterere ya `properties` irimo ubusa mu miterere yagenwe (schema)
  ishobora kuba `[]` cyangwa `new stdClass()`; zombi zitangazwa nka `{}`.
- **Gukumira ikwirakwira ry'amakosa.** Buri mugereka wandikisha muri kopi y'agateganyo ibikwa
  gusa iyo umumaro wawe usubiye uko bisanzwe. Niba uteye ikosa, nta bushobozi bwawe na bumwe
  bwandikwa, kandi iryo kosa ryandikwa muri log.

Ubushobozi buvuye mu migereka butangira buhishe. Umuyobozi abugaragaza ku
isomero ry'Ubushobozi (Abilities tab) rya console, kandi inkingi ya Required Realm yanditseho ngo "Set by the plugin"
kuri bwo.

## Imiterere y'umutekano

- **Bearer gusa.** `api.php` na `mcp.php` byemera gusa urufunguzo rwihariye (personal token) mu mutwe wa `Authorization` nta kindi. Bireka ama-cookies, `$_POST`, na `$_REQUEST` mbere y'uko Cacti itangira kandi bigasenya session Cacti itangiza, ku buryo kwinjira ukoresheje mushakisha (browser) bitigera bitanga uburenganzira bwo kugera kuri API.
- **Umuti w'agateganyo wa CSRF.** Uburinzi bwa CSRF bwa Cacti bwanga JSON POST idafite urufunguzo rwa CSRF rwa Cacti, kandi nta mukiriya wa MCP ushobora kurwohereza. Kuri izi mpero (endpoints) ebyiri gusa, iyi mugereka ihindura izina ry'uburyo bw'isaba mbere y'uko Cacti itangira ikarisubizaho nyuma, kugira ngo uburinzi buzinyegeze. Ibi biratekanye kuko CSRF irinda amasaba mushakisha yemeza hakoreshejwe ama-cookie, kandi izi mpero ntizemera umwirondoro wa cookie: urupapuro rwo ku rundi rubuga ntirushobora gushyiraho urufunguzo rwa bearer. Amapaji ya konsole agumana uburinzi bwuzuye bwa CSRF. Ubu buryo ni ubw'agateganyo, kugeza igihe Cacti izatangira ubusonerwe bwemewe; reba `lib/bootstrap.php`.
- **Isuzuma rya Origin.** Kuri `mcp.php`, iyo isaba rifite umutwe wa `Origin` ugomba kuba uhura neza n'uburyo (scheme), host, na port bya Public Cacti URL, bitabaye ibyo isaba rirangwa na `ORIGIN_NOT_ALLOWED`. Isaba ridafite umutwe wa `Origin`, ari bwo buryo abakiriya batari abakoresha mushakisha bakoresha mu kwihuza, riremerwa. Ibi bibuza urupapuro rwa interineti gukoresha iyo mpero bivuye muri mushakisha y'umusomyi. `api.php` ntikoresha iri suzuma.
- **Gusoma gusa.** Iyandikisha ryanga ubushobozi ubwo ari bwo bwose butari ubwo gusoma gusa, butangiza, kandi budahindura ibisubizo iyo busubiwemo (idempotent).
- **Kugaragazwa n'ibyiciro by'uburenganzira (realms) byose birakurikizwa.** Ubushobozi bugomba kuba bugaragazwa kandi nyir'urufunguzo agomba kuba afite icyiciro cyabwo cy'uburenganzira (realm). Iyo imbonerahamwe yo kugaragaza idashobora gusomwa, ubushobozi bwose burahishwa aho gusubira ku miterere y'ibanze.
- **Ibihishwe, ibitazwi, n'ibitemerewe bigaragara kimwe.** Umukiriya ntashobora gutandukanya ubushobozi butabaho n'ubuhishwe cyangwa ubwo umukoresha atemerewe gukoresha: ishakisha rirabureka kandi ishyirwa mu bikorwa risubiza `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Imfunguzo.** Zibikwa nka SHA-256 hashes, zerekanwa rimwe, zihora zifite igihe zirangiriraho, zishobora guhagarikwa, kandi zikangwa iyo nyirazo ahagaritswe cyangwa atakaje icyiciro cy'uburenganzira (realm).
- **Igenzura (Audit).** `plugin_mcp_audit` ibika ID y'isaba, ID y'urufunguzo, ID y'umukoresha, ubushobozi, umusaruro (`started`, `succeeded`, `failed`, `denied`, `rejected`), n'ibihe byabereyeho. Ntiyigera ibika ibyatanzwe (arguments), ibisubizo, cyangwa agaciro k'imfunguzo. Ubushobozi bukora gusa nyuma y'uko umurongo wabwo wa `started` wanditswe; iyo imbonerahamwe y'igenzura itaboneka, ihamagara riraneshwa na `UNAVAILABLE` kandi ntirikore. Ihamagara ryanzwe mbere y'uko rikora riba umurongo umwe: `denied` ku bushobozi butazwi, buhishwe, cyangwa butemerewe, `rejected` ku byatanzwe bidahuje na schema. Gukora no guhagarika imfunguzo bivuye kuri konsole, My MCP Tokens, na CLI byandikwa nka `mcp-token-create` na `mcp-token-revoke` bifite umusaruro `succeeded`, kandi ihagarikwa ryandikwa gusa ku rufunguzo rwakoraga. Ishakisha, n'ihamagara rifite `arguments` itari igikoresho cya JSON, ntibyandikwa mu rutonde.
- **Inyandiko y'amakosa.** Ikosa ritari ryitezwe, `INVALID_RESULT`, cyangwa imbonerahamwe y'igenzura itaboneka byandika umurongo umwe mu nyandiko ya Cacti bifite facility `MCP`: ID y'ubushobozi, impamvu idahinduka, n'icyiciro cy'ikosa (exception class). Ubutumwa, ibyatanzwe, n'imfunguzo ntibigera byandikwa.
- **Poller nyamukuru gusa.** Impero zombi, amapaji yombi ya konsole, na `tokens.php` byanga gukorera ahandi hose.

## Icyiciro cy'ubuzima

Guhagarika iyi mugereka bifunga impero zombi. Kuyikuraho (uninstalling) bihagarika buri rufunguzo kandi bikagumisha ho imbonerahamwe eshatu (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) kugira ngo zibikwe; kongera kuyishyiraho ntibisubizaho urufunguzo rwahagaritswe. Kora kopi y'izi mbonerahamwe hamwe n'ububiko bw'amakuru bwa Cacti kandi ushyireho gahunda yo kubika amakuru y'igenzura hanze y'iyi mugereka.

## Iterambere n'isuzuma

Isuzuma ni inyandiko zisanzwe za PHP zikora nta Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI igenzura imyandikire ya PHP kandi igakoresha inyandiko ziri muri `tests/` (buri yose iranditse muri `.github/workflows/ci.yml`) kuri PHP 8.2 kugeza kuri 8.5, hanyuma ikubaka ububiko bwa `mcp/` bishoboka gushyirwaho na checksum yabwo. Isuzuma rikora kuri Cacti rikoresha fixtures ku mupaka w'ubufasha bwa Cacti; ntirigerageza iyishyirwaho ryuzuye rya Cacti.

### Isuzuma ry'imikoranire

`tests/integration/run.sh 1.2.31` cyangwa `tests/integration/run.sh develop` ishyira iyi mugereka muri Cacti nyayo iri muri containers kandi ikayikoraho isuzuma ry'ako kanya. Bisaba Docker ifite Compose v2.23.1 cyangwa iyisumbuyeho, git na openssl. `KEEP=1` isiga stack ikora kugira ngo hakorwe isuzuma ry'amakosa. CI ibikora buri joro kandi igihe bisabwe, ntabwo ari kuri pull requests.

## Guhindura mu ndimi

Cacti MCP itanga ibitabo bya GNU gettext byegeranyijwe munsi ya `locales/po/` na `locales/LC_MESSAGES/` hamwe na README zashyizwe mu ndimi zinyuranye munsi ya `docs/i18n/` ku Cyongereza hiyongereyeho indimi 44 (19 zo mu rwego rwa mbere rwagutse, 15 zo muri Afurika, na 10 zo muri Aziya), hakoreshejwe umuryango w'inyandiko wa `mcp` (`locales/po/mcp.pot`). Cacti yikoresha mu gupakira igitabo gihuye igihe ubufasha bw'ururimi bufunguwe.

## Uruhare mu iterambere

Pull requests zijya kuri `develop`. Guma kuringaniza kode y'umusaruro na PHP 8.2 kandi ukoreshe uburyo bwa Cacti: tabs, inyandiko ziri mu tugoma tumwe (single-quoted strings), n'abafasha ba Cacti b'ububiko bw'amakuru n'uburenganzira. Ongeraho isuzuma ku mpinduka z'iyemeza, uburenganzira, cyangwa imikorere ya porotokole, kandi usinyire commits na `git commit -s`. Huza impinduka za HTTP API na [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Uruhushya

Uburenganzira bw'umwanditsi (C) 2026 Thomas Vincent. Yasohowe munsi ya GNU General Public License, verisiyo ya 2 cyangwa iyisumbuyeho. Reba [LICENSE](../../../LICENSE).
