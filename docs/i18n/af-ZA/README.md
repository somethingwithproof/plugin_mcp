<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: 'n kaktus met 'n skild. Ontdek. Magtig. Voer uit.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lisensie: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP is 'n Cacti-inprop wat KI-kliënte toelaat om jou Cacti-data te lees deur
benoemde, toestemming-gefiltreerde bewerkings genaamd vermoëns (*abilities*). Dit bedien hulle
op twee maniere vanuit die inprop self: 'n MCP-eindpunt (`mcp.php`, Streamable HTTP) en 'n
AIP-styl HTTP-API (`api.php`). Cacti bly in beheer van magtiging en uitvoering.
'n Kliënt doen nooit navrae direk teen die databasis nie; dit kan slegs 'n vermoë oproep wat
'n administrateur blootgestel het en wat die kentekeneienaar se Cacti-gebiede toelaat.

Inpropouteurs kan hul eie leesalleen-vermoëns registreer deur die
`abilities_register`-haak, en hulle verskyn aan MCP-kliënte as nutsmiddels sonder enige
protokolkode.

**Status: voorvrystelling, weergawe 0.1.0.** Daar is nog geen gemerkte vrystelling nie.

Vandag beskikbaar:

- Leesalleen ingeboude vermoëns vir stelselweergawes en toestelvoorraad.
- Persoonlike toegangskentekens (`cmcp_pat_...`) as die enigste geloofsbrief.
- Die Bestuur > MCP-konsole: stel vermoëns bloot of versteek hulle, skep en herroep
  kentekens, en lees die ouditlogboek.
- Bestuur > My MCP-kentekens: gebruikers bestuur hul eie kentekens, sien hul aktiwiteit,
  en sien watter nutsmiddels hul kentekens kan gebruik.
- MCP oor Streamable HTTP, protokolhersienings `2026-07-28` en `2025-11-25`,
  slegs nutsmiddels.

Nog nie beskikbaar nie:

- OAuth 2.1-aanmelding. Gehuisveste koppelstukke wat nie 'n persoonlike kenteken kan stuur nie, soos
  ChatGPT en claude.ai se pasgemaakte koppelstukke, kan nie koppel voordat dit bestaan nie. Dit word
  as Plan 2 beplan; daardie plan is nog nie geskryf nie.
- Skryfvermoëns. Slegs leesalleen-vermoëns kan registreer.

Die ontwerp is in die
[eindpunt-ontwerpspesifikasie](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
en die bouvolgorde is in [docs/plan.md](../../plan.md).

## Ingeboude vermoëns

| ID | Argumente | Vereiste Cacti-gebied |
| --- | --- | --- |
| `cacti-get-system-info` | geen | 15 |
| `cacti-list-devices` | opsionele `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | vereiste `name`, soos `devices/12` | 3 |

Elke oproep benodig ook die **MCP- en Vermoëns-API**-gebied vir die kentekeneienaar,
die `abilities:read`-bestek (elke persoonlike kenteken het dit), en 'n blootgestelde
vermoë. Die Vermoëns-oortjie van die konsole wys watter gebied elke ingeboude vermoë benodig.

- `cacti-list-devices` gee bladsye van tot 100 toestelle terug (verstek 50) en 'n
  `nextPageToken`. 'n Bladsykenteken is slegs geldig vir dieselfde `filter` en
  `orderBy`. `filter` is 'n AIP-160-uitdrukking van vergelykings wat deur `AND` verbind word,
  byvoorbeeld `state = "DOWN" AND disabled = false`. Filtervelde is
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, en `state`. `orderBy` aanvaar `displayName`, `hostname`, of `name`,
  elk opsioneel gevolg deur `desc`.
- Toestelnavrae gaan deur Cacti se `get_allowed_devices()`, sodat 'n gebruiker slegs
  die toestelle sien wat Cacti aan hulle sou wys.
- Toestelvelde sluit SNMP-gemeenskapstringe, wagfrases en ander
  geloofsbriewe uit.

## Installeer

Vereis Cacti 1.2.31 of later, PHP 8.2 of later, en die hoof-poller. Cacti-verifikasie
moet geaktiveer wees; die inprop weier om te verifieer wanneer dit af is.

Die inpropgids moet `mcp` heet, nie `plugin_mcp` nie. Die inprop-slug, gebiedname,
vertalingsdomein en URL's gebruik almal `mcp`.

Vanuit 'n bronkode-uitcheck:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Totdat gemerkte vrystellings bestaan, kan jy eerder die `mcp-plugin`-artefak
aflaai vanaf 'n suksesvolle
[CI-lopie](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Dit bevat `mcp.tar.gz` en `SHA256SUMS`. Verifieer die kontrolesom en pak dan
`mcp.tar.gz` uit binne Cacti se `plugins/`-gids sodat die resultaat `plugins/mcp/` is.
GitHub se outomatiese bronargiewe gebruik 'n ander topvlak-gidsnaam. Die
argief laat `docs/` (insluitend die skermkiekies hieronder), `tests/`, en
`.github/` uit, sodat die README-skakels na `docs/` op GitHub werk maar nie in 'n geïnstalleerde
kopie nie.

Daarna:

1. In Inpropbestuur, installeer en aktiveer **Cacti MCP**. Die installerende
   administrateur ontvang outomaties die **MCP-administrasie**-gebied.
2. Onder Instellings > MCP, stel **Openbare Cacti-URL** op die adres wat kliënte gebruik,
   byvoorbeeld `https://cacti.example.com/cacti`. HTTPS word vereis behalwe vir
   `localhost`, `127.0.0.1`, en `[::1]`. Totdat dit gestel is, antwoord `mcp.php` met HTTP 400
   en 'n JSON-RPC-fout waarvan die `data` `FAILED_PRECONDITION` en
   `PUBLIC_URL_REQUIRED` is. `api.php` lees dit nie.

   ![Instellings > MCP wat die Openbare Cacti-URL-veld wys](../../images/settings-public-url.png)

3. Ken die **MCP- en Vermoëns-API**-gebied toe aan elke gebruiker wat 'n kenteken sal besit.
   Geen gebruiker ontvang dit outomaties nie.
4. Maak seker dat die webbediener die `Authorization`-kopskrif en padinligting aan PHP
   deurgee (sien hieronder).
5. Maak Bestuur > MCP oop en stel die vermoëns bloot wat jy wil hê kliënte moet sien.

**Opgradering vanaf 'n ontwikkelingsbou.** Die inprop is 'n voorvrystelling, en sy tabelle
het tydens ontwikkeling sonder migrasies verander. As jy 'n vroeëre bou geïnstalleer
het, deïnstalleer dit en installeer dit weer. Herinstallasie behou tabelle wat reeds
bestaan, so verwyder eers die ou `plugin_mcp_token`, `plugin_mcp_audit`, en
`plugin_mcp_ability`-tabelle (en die ekwivalente tabelle van
boue wat voor die herbenaming gemaak is). Maak 'n rugsteun daarvan as jy hul geskiedenis benodig; kentekens van
daardie boue word by deïnstallasie herroep en word nie oorgedra nie.

### Webbediener

Apache-opstellings wat `Authorization` voor PHP stroop, benodig dit in die betrokke
virtuele gasheer of gids, gevolg deur 'n herlaai:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache met `mod_php` het `api.php`-roetes bedien sonder enige ekstra padkonfigurasie.

`api.php`-roetes leef in die pad ná die skripnaam
(`/plugins/mcp/api.php/v1/abilities`), so nginx moet URI's pas waar `.php`
gevolg word deur verdere pad, die padinligting afsplits, en dit aan PHP deurgee. 'n
`location ~ \.php$`-blok pas nooit by hierdie URL's nie; nginx antwoord met sy eie
HTML 404. Die liggingspatroon en die twee padinligting-lyne hieronder is geverifieer met
PHP-FPM; die ander lyne is standaard-sjabloonkodes:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Pas die `include`- en `fastcgi_pass`-lyne aan om by die blok te pas wat reeds
Cacti bedien. Moenie `try_files $fastcgi_script_name =404;` by hierdie blok voeg nie: dit maak
`$fastcgi_path_info` leeg, en `api.php` antwoord dan met 404 `UNKNOWN_PATH`. As jou
konfigurasie `try_files` benodig, stoor eers die waarde met
`set $path_info $fastcgi_path_info;` en gee `fastcgi_param PATH_INFO $path_info;` deur.

`mcp.php` het geen padroetes nie en benodig dit nie.

## Konsole

Bestuur > MCP het drie oortjies. Jy benodig die **MCP-administrasie**-gebied.
Skermkiekies hier en hieronder is van 'n Cacti-ontwikkelingsbou met voorbeelddata.

- **Vermoëns** lys elke geregistreerde vermoë met sy inprop, kategorie, die
  gebied wat dit benodig, en of dit blootgestel is. Kies rye en kies Stel bloot of
  Versteek; jy bevestig voordat die verandering toegepas word. Ingeboude `cacti-*`-vermoëns is
  by verstek blootgestel. Vermoëns van ander inproppe begin versteek, sodat die installering van 'n
  inprop nooit iets publiseer totdat 'n administrateur so besluit nie. Blootstelling
  beperk slegs toegang: 'n gebruiker benodig steeds die vermoë se gebied.

  ![Vermoëns-oortjie wat die ingeboude vermoëns lys met hul gebiede en blootstellingstatus](../../images/console-abilities.png)
- **Kentekens** lys kentekens met eienaar, skepper, skepping, vervaldatum, laaste gebruik en
  status (Aktief, Verval, Herroep). Kies rye en kies Herroep om hulle te herroep.
  Herroepte kentekens kan nie weer gebruik word nie. Skep kenteken maak 'n nuwe een.

  ![Kentekens-oortjie wat kentekens lys met eienaar, vervaldatum, laaste gebruik en status, bokant die Skep kenteken-vorm](../../images/console-tokens.png)
- **Oudit** lys ouditrye, nuutste eerste, en filtreer volgens gebruiker, vermoë en
  uitkoms.

  ![Oudit-oortjie wat oproepe lys met gebruiker, kenteken, vermoë en uitkoms, met filters](../../images/console-audit.png)

## Kentekens

'n Persoonlike kenteken lees Cacti as sy eienaar. Dit het die vorm `cmcp_pat_` gevolg deur
64 kleinletter heksadesimale karakters en dra die enkele bestek `abilities:read`. Wat dit
kan sien, word bepaal deur sy eienaar se Cacti-gebiede en toesteltoestemmings, nie deur die
kenteken nie. Die eienaar moet 'n geaktiveerde gebruiker wees wat die **MCP- en Vermoëns-API**-gebied
hou.

Kentekens word altyd vir 'n gebruiker geskep, verval, en kan herroep word:

- **Konsole.** Bestuur > MCP > Kentekens > Skep kenteken. Lewensduur is 1 tot 365 dae
  en die verstek is 90. Die kenteken word deur die bediener gegenereer en een keer op die
  antwoordbladsy gewys, so kopieer dit onmiddellik na jou geheimebestuurder. Jy kan 'n
  kenteken vir jouself skep. Om een vir 'n ander gebruiker te skep, vereis ook die Gebruikers/Groepe-gebied,
  omdat die kenteken Cacti as daardie gebruiker lees.
- **My MCP-kentekens.** Enige gebruiker met die MCP- en Vermoëns-API-gebied kan hul eie
  kentekens bestuur; sien hieronder.
- **Opdragreël.** `tokens.php` loop slegs vanaf die CLI, as 'n bedryfstelselrekening wat
  Cacti kan administreer. Dit neem die kenteken uit die omgewing sodat die waarde nooit
  op 'n opdragreël of in die proseslys verskyn nie. Lewensduur is 1 tot 365 dae en
  die verstek is 30. Die skep en herroep van 'n kenteken deur die CLI word geouditeer soos die
  konsole, met die kenteken se eienaar as die akteur omdat die CLI geen Cacti-gebruiker het nie, sodat
  die ouditry nie die aksie as afkomstig van die CLI merk nie. `--list` druk
  elke kenteken as JSON (ID, eienaar, bestekke, tydstempels, herroepe vlag) en nooit die
  kentekenwaarde nie; `--help` wys gebruiksinligting.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Kentekens kan nie geskep word vir die gasrekening, vir gedeaktiveerde gebruikers, of vir gebruikers
sonder die **MCP- en Vermoëns-API**-gebied nie, nie vanaf die konsole, die opdragreël, of
My MCP-kentekens nie. Cacti stoor die gasinstelling as 'n gebruikersnaam of 'n gebruikers-ID, en die
inprop los albei op. 'n Kenteken waarvan die eienaar die gasrekening word, hou op werk by
sy volgende versoek.

### My MCP-kentekens

Bestuur > My MCP-kentekens (`plugins/mcp/mcp_tokens.php`) benodig geen administrasiegebied
nie: dit word gedek deur die **MCP- en Vermoëns-API**-gebied, en die kieslys-inskrywing
verskyn slegs vir gebruikers wat dit hou. Die bladsy tree altyd op vir die aangemelde gebruiker.
Cacti se kieslys is deel van die konsole, so 'n gebruiker sonder konsoletoegang bereik die
bladsy via sy adres.

![My Kentekens-oortjie wat die aangemelde gebruiker se kentekens en die skepvorm lys](../../images/my-tokens.png)

- **Kentekens** lys jou kentekens, skep een (1 tot 365 dae, verstek 90, een keer gewys
  in die antwoord), en herroep jou eie. Jy kan nie iemand anders s'n sien of herroep nie.
- **Aktiwiteit** lys die aksies wat jy uitgevoer het, nuutste eerste: oproepe wat met jou
  kentekens gemaak is en kentekenveranderinge wat jy aangebring het.
- **Beskikbare nutsmiddels** lys die vermoëns wat 'n kenteken van jou nou dadelik kan gebruik, met
  elke vermoë se ID, naam en beskrywing. Dit volg jou Cacti-toestemmings en
  die blootstellingstellings wat 'n administrateur gekies het.

  ![Beskikbare nutsmiddels-lys wat elke vermoë se ID, naam en beskrywing wys](../../images/my-tools.png)

'n Installasie wat gemaak is voordat hierdie bladsy bestaan het, het 'n gebiedlêerlys sonder
`mcp_tokens.php`. Installasie registreer die lys; dit word nie bygewerk deur die inprop te aktiveer of
te deaktiveer nie. Deïnstalleer en installeer die inprop weer, en ken dan die gebiede
weer toe, omdat Cacti gebiedtoekennings verwyder wanneer 'n inprop gedeïnstalleer word.

Die databasis stoor slegs die SHA-256-huts van die kenteken, sodat 'n verlore kenteken nie
herstel kan word nie; herroep dit en skep 'n ander een. Rotasie is dieselfde: skep 'n nuwe kenteken,
skakel die kliënt oor, en herroep dan die ou een. 'n Vervalle kenteken, 'n herroepte kenteken, 'n
gedeaktiveerde eienaar, of 'n verlore gebied misluk elk by die volgende versoek. Kentekens word aanvaar
slegs in die `Authorization: Bearer`-kopskrif; 'n kenteken in die navraagstring of liggaam word
nie aanvaar nie.

## Koppel 'n kliënt

Gebruik die MCP-eindpunt `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, met die
token in 'n `Authorization: Bearer`-kopskrif. Hou die token in 'n omgewingsveranderlike
of geheimbestuurder en verwys daarna vanuit die kliëntkonfigurasie in plaas daarvan om
die waarde daarvan in 'n lêer te skryf.

### Claude Code

Plaas die eindpunt in 'n projek-`.mcp.json` wat op naam na die token verwys.
Claude Code brei `${VAR}` in `url` en `headers` uit, dus bevat die lêer geen geheim nie en
is dit veilig om te commit. Voer `CACTI_MCP_TOKEN` uit in die omgewing wat Claude Code begin.

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

Jy kan dit ook vanaf die opdragreël byvoeg:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Met dubbele aanhalingstekens brei jou dop `$CACTI_MCP_TOKEN` eerste uit, sodat die tokenwaarde
in die konfigurasielêer geskryf word vir die gekose `--scope` (`local`, `user`, of
`project`; verstek `local`). Moenie daardie vorm met `--scope project` gebruik nie, en hou
die lêer uit weergawebeheer. Verkies die `.mcp.json`-verwysing hierbo. Claude Code
lees sommige geloofsbriefveranderlikes (soos `ANTHROPIC_AUTH_TOKEN`) as leeg in afgeleë
`url` en `headers`; `CACTI_MCP_TOKEN` is nie een van hulle nie. Bron:
[Claude Code MCP-dokumentasie](https://code.claude.com/docs/en/mcp).

### GitHub Copilot in VS Code

Gebruik 'n `.mcp.json` in die werkruimte-wortelgids (of die gebruikerslêer `~/.copilot/mcp-config.json`).
Hierdie Copilot-inheemse lêers gebruik 'n topvlak-`mcpServers`-objek en `${NAME}`-omgewingsveranderlikeverwysings in kopskrifwaardes:

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

Voer `CACTI_MCP_TOKEN` uit in die omgewing wat VS Code begin. Inheemse Copilot-lêers
ondersteun nie `inputs`-aansporings nie. VS Code se begeleide opstelling verwerp `${...}`-waardes,
dus voeg die `Authorization`-kopskrif by deur die lêer te wysig, nie deur die
begeleide vloei nie. Begeleide opstelling bied die lêer in die werkruimte-wortelgids
slegs aan wanneer die eksperimentele `chat.mcp.workspaceRootConfig.enabled`-instelling aan is. Sien die
[VS Code MCP-konfigurasieverwysing](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Verouderd: `.vscode/mcp.json`.** VS Code meld dat nuwe Copilot-konfigurasies nie
`.vscode/mcp.json` of die profiel se `mcp.json` moet gebruik nie; hulle behoort aan die verouderde
Local-harnas, wat in Februarie 2027 verwyder sal word. As jy dit steeds gebruik, neem die
redigeerderbestuurde formaat 'n topvlak-`servers`-sleutel en kan dit vir die token vra:

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

### Kliënte wat slegs stdio praat

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) is 'n opsionele aanpasser
wat as 'n plaaslike stdio-MCP-bediener loop en die inprop se HTTP API roep. Gebruik dit vir 'n
kliënt wat nie aan 'n afgeleë HTTP-bediener kan koppel nie. Dit benodig dieselfde persoonlike
token en praat met `api.php`.

### MCP-gedrag

Die eindpunt bedien slegs nutsmiddels: elke blootgestelde, toegelate vermoë is 'n nutsmiddel vernoem na
sy ID, met sy toevoer- en afvoerskemas en leesalleen-annotasies
(`openWorldHint` is `false`). Dit hanteer `initialize`, `server/discover`, `ping`,
`tools/list`, en `tools/call`. Dit behou geen sessie nie, stuur nie `Mcp-Session-Id` nie
(en ignoreer een wat dit ontvang), en aanvaar nie JSON-RPC-bondels nie. 'n Boodskap
sonder 'n `id` is 'n kennisgewing en kry HTTP 202 sonder inhoudsliggaam. Slegs `POST` word
toegelaat.

- **Hersienings.** 'n Versoek wat `io.modelcontextprotocol/protocolVersion` in
  `params._meta` dra, moet `2026-07-28` noem; enigiets anders kry fout `-32022`. Sulke
  versoeke moet ook bypassende `Mcp-Protocol-Version`, `Mcp-Method`, en (vir
  `tools/call`) `Mcp-Name`-kopskrifte dra, anders is die antwoord fout `-32020`. Ander versoeke
  word hanteer as `2025-11-25`: `initialize` antwoord met daardie hersiening, en op enige
  ander metode moet 'n `Mcp-Protocol-Version`-kopskrif, indien gestuur, `2025-11-25`,
  `2025-06-18`, of `2025-03-26` wees.
- **Nutsmiddelfoute.** 'n Vermoënsfout, insluitend argumente wat nie by die
  skema pas nie of 'n `arguments`-waarde wat nie 'n JSON-objek is nie, kom terug as 'n nutsmiddelresultaat
  met `isError: true` en die AIP-193-fout in `structuredContent`, nie as 'n
  protokolfout nie.
- **Protokolfoute.** Mislukkings wat nie nutsmiddelfoute is nie, is JSON-RPC-foutobjekte
  (kode `-32000` met die status en rede in `data`, of die standaardkodes): die
  ontbrekende Public Cacti URL, 'n geweierde `Origin`, 'n versoek met die inprop gedeaktiveer
  of op 'n afgeleë peiler, en onverwagte bedienerfoute (`-32603`, met die besonderhede
  geskryf na die Cacti-logboek, nie die antwoord nie). Versoekkontroles wat eerste loop (405,
  413, 415) en verifikasiemislukkings (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  behou die AIP-193-inhoudsliggaam wat onder HTTP API beskryf word.

## HTTP API

Basis-URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Die kontrak is
in [openapi.json](../../../openapi.json).

| Metode en pad | Doel |
| --- | --- |
| `GET /v1/abilities` | Lys toegelate vermoëns. Navraag: `pageSize`, `pageToken`, en `filter` van die vorm `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Lees een vermoë. |
| `POST /v1/abilities/{id}:execute` | Voer dit uit. Die liggaam is presies `{"arguments": {...}}`. Die antwoord is `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Foute volg AIP-193: 'n `error`-objek met `code`, `message`, `status`, en
`details` wat 'n `ErrorInfo` met domein `cacti.net` en 'n stabiele `reason` dra.
Argumentprobleme voeg 'n `BadRequest`-detail by wat die veld benoem. Versoekliggame is
beperk tot 64 KB, en resultate tot 1 MB. Beide eindpunte antwoord slegs op die hoofpeiler
en gee `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) terug wanneer die inprop gedeaktiveer is
of die bediener nie die hoofpeiler is nie.

| HTTP | `reason`-waardes |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (stuur ook `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (stuur `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Skryf 'n vermoë (inprop-outeurs)

'n Geaktiveerde Cacti-inprop registreer vermoëns vanuit 'n funksie wat dit aan die
`abilities_register`-haak koppel, gewoonlik in sy `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Die funksie ontvang 'n `AbilitiesRegistrar` wat tot die inprop beperk is. Die terugkeerwaarde
daarvan word geïgnoreer.

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

Die reëls, wat almal by registrasie afgedwing word:

- **ID's.** 'n ID pas by `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, is hoogstens 64
  karakters lank, en moet begin met die inprop se kortnaam (slug) en 'n koppelteken: `acme-` hierbo.
  Die kortnaam is die inprop-gidsnaam, dus kan 'n gids soos `my_plugin` niks
  registreer nie. 'n Inprop-gids genaamd `cacti` word geweier; daardie
  naamruimte behoort aan die ingeboude vermoëns.
- **Definisie.** Presies hierdie sleutels: `label`, `description` (tot 4096 grepe),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Die kategorie moet reeds bestaan: gebruik 'n ingeboude een (`inventory`,
  `system`) of registreer jou eie met `registerCategory()`, waarvan die ID uniek is oor
  alle inproppe en by `^[a-z][a-z0-9-]{0,31}$` pas.
- **Slegs leesalleen.** `annotations` moet presies `readOnly: true`,
  `destructive: false`, `idempotent: true` wees. Enigiets anders gooi 'n uitsondering.
- **Skemas.** `input_schema` en `output_schema` moet elk 'n topvlak-`type`
  `object` hê. Die dialek is klein en faal geslote. Objekte moet geslote wees
  (`additionalProperties: false`, met `properties` teenwoordig); ander tipes is
  `integer` en `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, en `array` (wat `items` en
  `maxItems` benodig). 'n Tipe kan
  nulbaar gemaak word as `['string', 'null']`. Argumentstringe is by verstek hoogstens
  4096 karakters lank; resultaatstringe word slegs beperk deur 'n verklaarde `maxLength`
  en die resultaatgroottebeperking. Hoogstens 256 vermoëns kan registreer.
- **`permission(int $userId): bool`.** Moet presies `true` teruggee om toe te laat. Die
  gebruiker-ID is dié van die tokeneienaar; moet nooit sessietoestand lees nie.
- **`execute(int $userId, stdClass $args): array`.** `$args` is reeds teen
  `input_schema` gevalideer. Dwing self objekvlak-toestemmings af. Gee 'n
  assosiatiewe skikking terug wat presies by `output_schema` pas; 'n lys, 'n ekstra veld,
  of meer as 1 MB JSON word 'n `INVALID_RESULT`-fout. Gooi
  `AbilitiesError` vir 'n kliëntsigbare mislukking, soos `NOT_FOUND`.
- **Leë objekte.** PHP enkodeer `[]` as 'n JSON-skikking. Waar die afvoerskema ook al
  'n `object` verklaar, op enige diepte, hanteer die register `[]` as die leë objek
  en stuur `{}`; `new stdClass()` werk ook. 'n Nie-leë lys tel nooit as 'n
  objek nie en faal met `INVALID_RESULT`. 'n Leë `properties`-kaart in 'n skema
  mag `[]` of `new stdClass()` wees; albei word as `{}` gepubliseer.
- **Mislukkingsisolasie.** Elke inprop registreer in 'n kladkopie wat slegs
  behou word as jou funksie normaalweg terugkeer. As dit 'n uitsondering gooi, word geeneen van jou vermoëns
  geregistreer nie, en die mislukking word aangeteken.

Vermoëns vanaf inproppe begin versteek. Die administrateur stel hulle bloot op die
konsole se Abilities-oortjie, en die Required Realm-kolom lees "Set by the plugin"
vir hulle.

## Sekuriteitsmodel

- **Slegs Bearer.** `api.php` en `mcp.php` aanvaar 'n persoonlike token in die
  `Authorization`-opskrif en niks anders nie. Hulle verwerp koekies, `$_POST` en
  `$_REQUEST` voordat Cacti laai en vernietig die sessie wat Cacti begin, sodat 'n
  blaaieraanmelding nooit API-toegang verleen nie.
- **CSRF-omseiling.** Cacti se CSRF-beskerming verwerp 'n JSON-POST wat geen
  Cacti-CSRF-token het nie, wat geen MCP-kliënt kan stuur nie. Slegs vir hierdie
  twee eindpunte hernoem die inprop die versoekmetode voordat Cacti laai en herstel
  dit daarna, sodat die beskerming hulle oorslaan. Dit is veilig omdat CSRF versoeke
  beskerm wat 'n blaaier met koekies staaf, en hierdie eindpunte aanvaar geen
  koekie-identiteit nie: 'n kruiswerfbladsy kan nie die Bearer-token aanheg nie.
  Konsolebladsye behou volle CSRF-beskerming. Hierdie tydelike oplossing bly van
  krag totdat Cacti 'n ondersteunde vrystelling bied; sien `lib/bootstrap.php`.
- **Oorsprongkontrole.** Op `mcp.php`, as die versoek 'n `Origin`-opskrif het, moet
  dit presies ooreenstem met die skema, gasheer en poort van die Openbare Cacti-URL,
  anders word die versoek geweier met `ORIGIN_NOT_ALLOWED`. 'n Versoek sonder 'n
  `Origin`-opskrif, wat is hoe nie-blaaierkliënte koppel, word toegelaat. Dit verhoed
  dat 'n webbladsy die eindpunt vanuit 'n besoeker se blaaier aandryf. `api.php` pas
  nie hierdie kontrole toe nie.
- **Slegs leesalleen.** Registrasie verwerp enige vermoë wat nie leesalleen,
  nie-vernietigend en idempotent is nie.
- **Blootstelling en realms geld albei.** 'n Vermoë moet blootgestel wees en die
  tokeneienaar moet die betrokke realm besit. As die blootstellingstabel nie gelees
  kan word nie, word elke vermoë versteek eerder as om na verstekwaardes terug te val.
- **Versteek, onbekend en ontoegelaat lyk dieselfde.** 'n Kliënt kan nie 'n vermoë
  wat nie bestaan nie onderskei van een wat versteek is of wat sy gebruiker nie mag
  gebruik nie: ontdekking laat dit uit en uitvoering gee `NOT_FOUND`
  (`ABILITY_NOT_FOUND`) terug.
- **Tokens.** Word as SHA-256-hutswaardes gestoor, een keer gewys, verval altyd,
  is herroepbaar en word verwerp wanneer die eienaar gedeaktiveer word of die realm
  verloor.
- **Oudit.** `plugin_mcp_audit` teken versoek-ID, token-ID, gebruiker-ID, vermoë,
  uitkoms (`started`, `succeeded`, `failed`, `denied`, `rejected`) en tydstempels
  aan. Dit teken nooit argumente, resultate of tokenwaardes aan nie. 'n Vermoë loop
  slegs nadat sy `started`-ry geskryf is; as die oudittabel onbeskikbaar is, misluk
  die roep met `UNAVAILABLE` en loop dit nie. 'n Roep wat geweier word voordat dit
  loop, is een ry: `denied` vir 'n onbekende, versteekte of ontoegelate vermoë,
  `rejected` vir argumente wat nie aan die skema voldoen nie. Tokenskepping en
  -herroeping vanaf die konsole, My MCP Tokens en die CLI word aangeteken as
  `mcp-token-create` en `mcp-token-revoke` met uitkoms `succeeded`, en 'n herroeping
  word slegs aangeteken vir 'n token wat aktief was. Ontdekking, en 'n roep waarvan
  `arguments` nie 'n JSON-objek is nie, word nie gelog nie.
- **Foutlog.** 'n Onverwagte mislukking, `INVALID_RESULT`, of 'n onbeskikbare
  oudittabel skryf een reël na die Cacti-log met fasiliteit `MCP`: die vermoë-ID, 'n
  vaste rede en die uitsonderingsklas. Boodskappe, argumente en tokens word nooit
  gelog nie.
- **Slegs hoofpoller.** Albei eindpunte, albei konsolebladsye en `tokens.php` weier
  om enige ander plek op te tree.

## Lewensiklus

Die deaktivering van die inprop blokkeer albei eindpunte. Die verwydering van die
installasie herroep elke token en behou die drie tabelle (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) vir bewaring; herinstallering
heraktiveer nie 'n herroepe token nie. Rugsteun die tabelle saam met die
Cacti-databasis en pas 'n ouditbewaringsbeleid buite die inprop toe.

## Ontwikkeling en toetse

Toetse is gewone PHP-skripte wat sonder Cacti loop:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI doen PHP-linting en loop die skripte in `tests/` (elkeen is gelys in
`.github/workflows/ci.yml`) op PHP 8.2 tot 8.5, en bou dan die installeerbare `mcp/`-argief
en sy kontrolesom. Toetse wat aan Cacti raak, gebruik toetsdata (fixtures) by die
Cacti-hulpgrens; hulle toets nie 'n volledige Cacti-installasie nie.

### Integrasietoetse

`tests/integration/run.sh 1.2.31` of `tests/integration/run.sh develop` installeer
die inprop in 'n regte Cacti in houers en loop lewendige kontroles daarteen. Dit
benodig Docker met Compose v2.23.1 of nuwer, git en openssl. `KEEP=1` laat die
stapel aan die gang vir ontfouting. CI loop dit nagteliks en op aanvraag, nie op
trekversoeke nie.

## Lokalisering

Cacti MCP verskeep gekompileerde GNU gettext-katalogusse onder `locales/po/` en
`locales/LC_MESSAGES/` en gelokaliseerde README-lêers onder `docs/i18n/` vir Engels
plus 47 lokale (19 Broad Tier 1-, 15 Afrika-, 10 Asiatiese, plus Bosniese, Kroatiese en Serwiese lokale), deur die `mcp`-teksdomein
(`locales/po/mcp.pot`) te gebruik. Cacti laai die bypassende katalogus outomaties
wanneer taalondersteuning geaktiveer is.

## Bydraes

Trekversoeke gaan na `develop`. Hou produksiekode versoenbaar met PHP 8.2 en
gebruik Cacti se styl: oortjies (tabs), enkelaanhalingstekens vir stringe, en
Cacti se databasis- en toestemmingshulpfunksies. Voeg toetse by vir gewysigde
validerings-, magtigings- of protokolgedrag, en teken commits af met `git commit -s`.
Koördineer veranderinge aan die HTTP-API met [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Lisensie

Kopiereg (C) 2026 Thomas Vincent. Vrygestel onder die GNU General Public
License, weergawe 2 of nuwer. Sien [LICENSE](../../../LICENSE).
