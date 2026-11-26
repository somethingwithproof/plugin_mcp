<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: en kaktus med en sköld. Upptäck. Auktorisera. Kör.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licens: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP är ett Cacti-tillägg som låter AI-klienter läsa dina Cacti-data via
namngivna, behörighetsfiltrerade operationer som kallas förmågor (*abilities*).
Tillägget tillhandahåller dem på två sätt: en MCP-slutpunkt (`mcp.php`,
Streamable HTTP) och ett HTTP-API i AIP-stil (`api.php`). Cacti behåller
kontrollen över auktorisering och exekvering. En klient frågar aldrig
databasen direkt; den kan bara anropa en förmåga som en administratör har
exponerat och som tokenägarens Cacti-realms tillåter.

Tilläggsförfattare kan registrera egna skrivskyddade förmågor via hooken
`abilities_register`, så att de visas som verktyg för MCP-klienter utan att
protokollkod behöver skrivas.

**Status: förhandsversion, version 0.1.0.** Det finns ingen taggad utgåva.

Tillgängligt idag:

- Skrivskyddade inbyggda förmågor för systemversioner och enhetsinventering.
- Personliga åtkomsttoken (`cmcp_pat_...`) som enda autentiseringsuppgift.
- Konsolen under Management > MCP: exponera eller dölj förmågor, skapa och
  återkalla token, läs granskningsloggen.
- Management > My MCP Tokens: användare hanterar sina egna token, ser sin
  aktivitet och ser vilka verktyg deras token kan använda.
- MCP över Streamable HTTP, protokollrevisionerna `2026-07-28` och
  `2025-11-25`, endast verktyg.

Ännu inte tillgängligt:

- Inloggning med OAuth 2.1. Värdbaserade kopplingar som inte kan skicka ett
  personligt token, såsom anpassade kopplingar i ChatGPT och claude.ai, kan inte
  ansluta förrän detta finns. Det planeras som Plan 2; den planen är ännu inte
  skriven.
- Skrivförmågor. Endast skrivskyddade förmågor kan registreras.

Designen finns i
[designspecifikationen för slutpunkten](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
och byggordningen finns i [docs/plan.md](../../plan.md).

## Inbyggda förmågor

| ID | Argument | Nödvändig Cacti-realm |
| --- | --- | --- |
| `cacti-get-system-info` | inga | 15 |
| `cacti-list-devices` | valfria `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | obligatoriskt `name`, till exempel `devices/12` | 3 |

Varje anrop kräver dessutom realmen **MCP and Abilities API** för tokenägaren,
omfånget (scope) `abilities:read` (alla personliga token har det) samt att
förmågan är exponerad. Fliken Abilities i konsolen visar vilken realm varje
inbyggd förmåga kräver.

- `cacti-list-devices` returnerar sidor med upp till 100 enheter (standard 50)
  och en `nextPageToken`. En sidtoken är endast giltig för samma `filter` och
  `orderBy`. `filter` är ett AIP-160-uttryck av jämförelser förenade med
  `AND`, till exempel `state = "DOWN" AND disabled = false`. Filterfält är
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId` och `state`. `orderBy` tar `displayName`, `hostname` eller
  `name`, vart och ett valfritt följt av `desc`.
- Enhetsfrågor går via Cactis `get_allowed_devices()`, så en användare ser
  endast de enheter som Cacti normalt visar för den användaren.
- Enhetsfälten exkluderar SNMP-communitysträngar, lösenfraser och andra
  autentiseringsuppgifter.

## Installation

Kräver Cacti 1.2.31 eller senare, PHP 8.2 eller senare samt huvudpollern.
Cacti-autentisering måste vara aktiverad; tillägget vägrar att autentisera när
den är avstängd.

Tilläggskatalogen måste heta `mcp`, inte `plugin_mcp`. Tilläggets slug,
realmnamn, översättningsdomän och URL:er använder alla `mcp`.

Från en utcheckning av källkoden:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Tills taggade utgåvor finns kan du i stället ladda ner artefakten `mcp-plugin`
från en lyckad
[CI-körning](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Den innehåller `mcp.tar.gz` och `SHA256SUMS`. Verifiera kontrollsumman och
packa sedan upp `mcp.tar.gz` inuti Cactis katalog `plugins/` så att resultatet
blir `plugins/mcp/`. GitHubs automatiska källkodsarkiv använder ett annat namn på
toppkatalogen. Arkivet utelämnar `docs/` (inklusive skärmdumparna nedan),
`tests/` och `.github/`, så README-länkarna till `docs/` fungerar på GitHub men
inte i en installerad kopia.

Därefter:

1. I Plugin Management installerar och aktiverar du **Cacti MCP**. Den
   administratör som installerar tillägget får automatiskt realmen
   **MCP Administration**.
2. Under Settings > MCP anger du **Public Cacti URL** till den adress som
   klienterna använder, till exempel `https://cacti.example.com/cacti`. HTTPS
   krävs utom för `localhost`, `127.0.0.1` och `[::1]`. Tills detta har angetts
   svarar `mcp.php` med HTTP 400 och ett JSON-RPC-fel vars `data` är
   `FAILED_PRECONDITION` och `PUBLIC_URL_REQUIRED`. `api.php` läser inte denna
   inställning.

   ![Settings > MCP som visar fältet Public Cacti URL](../../images/settings-public-url.png)

3. Tilldela realmen **MCP and Abilities API** till varje användare som ska äga
   ett token. Ingen användare får den automatiskt.
4. Säkerställ att webbservern skickar vidare `Authorization`-headern och
   sökvägsinformation (path info) till PHP (se nedan).
5. Öppna Management > MCP och exponera de förmågor du vill att klienter ska se.

**Uppgradering från en utvecklingsversion.** Tillägget är en förhandsversion
och dess tabeller har ändrats under utvecklingen utan migreringar. Om du har
installerat en tidigare version bör du avinstallera den och installera på nytt.
En ominstallation behåller tabeller som redan finns, så ta bort de gamla
tabellerna `plugin_mcp_token`, `plugin_mcp_audit` och `plugin_mcp_ability`
först (samt motsvarande tabeller från versioner som byggdes före namnbytet).
Säkerhetskopiera dem om du behöver historiken; token från dessa versioner
återkallas vid avinstallation och förs inte över.

### Webbserver

Apache-konfigurationer som tar bort `Authorization` före PHP behöver följande i
den aktuella virtuella värden eller katalogen, följt av en omladdning:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache med `mod_php` hanterade `api.php`-rutter utan någon extra
sökvägskonfiguration.

Rutterna för `api.php` ligger i sökvägen efter skriptnamnet
(`/plugins/mcp/api.php/v1/abilities`), så nginx måste matcha URI:er där `.php`
följs av mer sökväg, dela upp sökvägsinformationen och skicka den till PHP. Ett
`location ~ \.php$`-block matchar aldrig dessa URL:er; nginx svarar då med sin
egen HTML 404. Platsmönstret och de två `path_info`-raderna nedan har
verifierats med PHP-FPM; övriga rader är standardmall:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Justera raderna `include` och `fastcgi_pass` så att de matchar det block som
redan betjänar Cacti. Lägg inte till `try_files $fastcgi_script_name =404;` i
det här blocket: det rensar `$fastcgi_path_info`, och `api.php` svarar då med
404 `UNKNOWN_PATH`. Om din konfiguration kräver `try_files` sparar du värdet
först med `set $path_info $fastcgi_path_info;` och skickar
`fastcgi_param PATH_INFO $path_info;`.

`mcp.php` har inga sökvägsrutter och behöver inte detta.

## Konsol

Management > MCP har tre flikar. Du behöver realmen **MCP Administration**.
Skärmdumparna här och nedan kommer från en utvecklingsversion av Cacti med
exempeldata.

- **Abilities** listar varje registrerad förmåga med tillägg, kategori, vilken
  realm den kräver och om den är exponerad. Markera rader och välj Expose eller
  Hide; du bekräftar innan ändringen tillämpas. Inbyggda `cacti-*`-förmågor är
  exponerade som standard. Förmågor från andra tillägg är dolda från början, så
  installation av ett tillägg publicerar aldrig något förrän en administratör
  beslutar det. Exponering kan endast begränsa åtkomsten: en användare behöver
  fortfarande förmågans realm.

  ![Fliken Abilities som listar de inbyggda förmågorna med deras realms och exponeringsstatus](../../images/console-abilities.png)
- **Tokens** listar token med ägare, skapare, tidpunkt för skapande,
  utgångstid, senaste användning och status (Active, Expired, Revoked). Markera
  rader och välj Revoke för att återkalla dem. Återkallade token kan inte
  användas igen. Create Token skapar ett nytt.

  ![Fliken Tokens som listar token med ägare, utgångstid, senaste användning och status, ovanför formuläret Create Token](../../images/console-tokens.png)
- **Audit** listar granskningsrader med nyast överst och filtrerar efter
  användare, förmåga och utfall.

  ![Fliken Audit som listar anrop med användare, token, förmåga och utfall, med filter](../../images/console-audit.png)

## Token

Ett personligt token läser Cacti i sin ägares namn. Det har formatet
`cmcp_pat_` följt av 64 gemena hexadecimala tecken och bär det enda omfånget
`abilities:read`. Vad det kan se avgörs av ägarens Cacti-realms och
enhetsbehörigheter, inte av själva tokenet. Ägaren måste vara en aktiverad
användare som innehar realmen **MCP and Abilities API**.

Token skapas alltid för en användare, löper ut och kan återkallas:

- **Konsolen.** Management > MCP > Tokens > Create Token. Livslängden är 1 till
  365 dagar och standardvärdet är 90. Tokenet genereras av servern och visas en
  enda gång på svarssidan, så kopiera det omedelbart till din hemlighetshanterare.
  Du kan skapa ett token för dig själv. Att skapa ett åt en annan användare
  kräver även realmen Users/Groups, eftersom tokenet läser Cacti som den
  användaren.
- **My MCP Tokens.** Alla användare med realmen MCP and Abilities API kan
  hantera sina egna token; se nedan.
- **Kommandoraden.** `tokens.php` körs endast från CLI, som ett OS-konto som
  kan administrera Cacti. Det hämtar tokenet från miljön så att värdet aldrig
  syns på en kommandorad eller i processlistan. Livslängden är 1 till 365 dagar
  och standardvärdet är 30. Att skapa och återkalla ett token via CLI
  granskningsloggas på samma sätt som i konsolen, med tokenets ägare som aktör
  eftersom CLI inte har någon Cacti-användare; granskningsraden markerar alltså
  inte att åtgärden kom från CLI. `--list` skriver ut varje token som JSON (ID,
  ägare, omfång, tidsstämplar, återkallningsflagga) och aldrig själva
  tokenvärdet; `--help` visar användningsinformation.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Token kan inte skapas för gästkontot, för inaktiverade användare eller för
användare utan realmen **MCP and Abilities API**, vare sig från konsolen,
kommandoraden eller My MCP Tokens. Cacti lagrar gästinställningen som ett
användarnamn eller ett användar-ID, och tillägget slår upp båda. Ett token vars
ägare blir gästkontot slutar fungera vid nästa begäran.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) kräver ingen
administrationsrealm: den täcks av realmen **MCP and Abilities API**, och
menyposten visas endast för användare som har den. Sidan agerar alltid för den
inloggade användaren. Cactis meny är en del av konsolen, så en användare utan
konsolåtkomst når sidan via dess adress.

![Fliken My Tokens som listar den inloggade användarens token och formuläret för att skapa nya](../../images/my-tokens.png)

- **Tokens** listar dina token, skapar ett nytt (1 till 365 dagar, standard 90,
  visas en gång i svaret) och återkallar dina egna. Du kan inte se eller
  återkalla någon annans.
- **Activity** listar de åtgärder du har utfört, nyast först: anrop som gjorts
  med dina token och tokenändringar du har gjort.
- **Available Tools** listar de förmågor som ett av dina token kan använda
  just nu, med varje förmågas ID, namn och beskrivning. Listan följer dina
  Cacti-behörigheter och de exponeringsinställningar som en administratör har
  valt.

  ![Listan Available Tools som visar varje förmågas ID, namn och beskrivning](../../images/my-tools.png)

En installation som gjordes innan den här sidan fanns har en fillista för
realmen utan `mcp_tokens.php`. Listan registreras vid installation; den
uppdateras inte genom att tillägget aktiveras eller inaktiveras. Avinstallera
och installera tillägget igen och tilldela sedan realmerna på nytt, eftersom
Cacti tar bort tilldelade realms när ett tillägg avinstalleras.

Databasen lagrar endast SHA-256-hashen av tokenet, så ett förlorat token kan
inte återställas; återkalla det och skapa ett nytt. Rotation fungerar på samma
sätt: skapa ett nytt token, byt i klienten och återkalla sedan det gamla. Ett
utgånget token, ett återkallat token, en inaktiverad ägare eller en förlorad
realm gör alla att nästa begäran misslyckas. Token accepteras endast i headern
`Authorization: Bearer`; ett token i frågesträngen eller meddelandekroppen
accepteras inte.

## Ansluta en klient

Använd MCP-slutpunkten `https://cacti.example.com/cacti/plugins/mcp/mcp.php` med
token i en `Authorization: Bearer`-header. Spara token i en miljövariabel
eller hemlighetshanterare och referera till den från klientkonfigurationen i stället
för att skriva in värdet i en fil.

### Claude Code

Lägg in slutpunkten i en `.mcp.json`-fil i projektet som refererar till token med namn.
Claude Code expanderar `${VAR}` i `url` och `headers`, så filen innehåller ingen hemlighet
och kan tryggt committas. Exportera `CACTI_MCP_TOKEN` i den miljö som startar Claude Code.

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

Du kan också lägga till den från kommandoraden:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Med dubbla citattecken expanderar ditt skal `$CACTI_MCP_TOKEN` först, så tokenvärdet
skrivs in i konfigurationsfilen för valt `--scope` (`local`, `user` eller
`project`; standard är `local`). Använd inte den formen med `--scope project`, och håll
filen utanför versionshanteringen. Föredra referensen via `.mcp.json` ovan. Claude Code
läser vissa autentiseringsvariabler (som `ANTHROPIC_AUTH_TOKEN`) som tomma i fjärr-`url`
och `headers`; `CACTI_MCP_TOKEN` är inte en av dem. Källa:
[Claude Code MCP-dokumentation](https://code.claude.com/docs/en/mcp).

### GitHub Copilot i VS Code

Använd en `.mcp.json` i arbetsytans rot (eller användarfilen `~/.copilot/mcp-config.json`).
Dessa inbyggda Copilot-filer använder ett toppnivåobjekt `mcpServers` och `${NAME}`-referenser
till miljövariabler i header-värden:

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

Exportera `CACTI_MCP_TOKEN` i den miljö som startar VS Code. Inbyggda Copilot-filer
stöder inte `inputs`-frågor. VS Codes guidade konfiguration avvisar `${...}`-värden,
så lägg till headern `Authorization` genom att redigera filen direkt och inte via det
guidade flödet. Den guidade konfigurationen erbjuder filen i arbetsytans rot
endast när den experimentella inställningen `chat.mcp.workspaceRootConfig.enabled` är aktiverad. Se
[VS Codes referens för MCP-konfiguration](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Föråldrat: `.vscode/mcp.json`.** VS Code anger att nya Copilot-konfigurationer inte bör
använda `.vscode/mcp.json` eller profilens `mcp.json`; de tillhör den utfasade
Local harness, som kommer att tas bort i februari 2027. Om du fortfarande använder den tar
det redigerarhanterade formatet en toppnivånyckel `servers` och kan fråga efter token:

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

### Klienter som bara talar stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) är en valfri adapter
som körs som en lokal stdio-MCP-server och anropar tilläggets HTTP-API. Använd den för en
klient som inte kan ansluta till en fjärransluten HTTP-server. Den behöver samma personliga
token och kommunicerar med `api.php`.

### MCP-beteende

Slutpunkten tillhandahåller endast verktyg: varje exponerad, tillåten förmåga är ett verktyg
som namnges efter sitt ID, med sina indata- och utdatascheman samt skrivskyddade annoteringar
(`openWorldHint` är `false`). Den hanterar `initialize`, `server/discover`, `ping`,
`tools/list` och `tools/call`. Den behåller ingen session, skickar inte `Mcp-Session-Id`
(och ignorerar en sådan om den tas emot) och accepterar inte JSON-RPC-batcher. Ett meddelande
utan `id` är en avisering och får HTTP 202 utan svarstext. Endast `POST` är
tillåtet.

- **Revisioner.** En begäran som innehåller `io.modelcontextprotocol/protocolVersion` i
  `params._meta` måste ange `2026-07-28`; allt annat ger felet `-32022`. Sådana
  begäranden måste även innehålla matchande headrar för `Mcp-Protocol-Version`, `Mcp-Method`
  och (för `tools/call`) `Mcp-Name`, annars blir svaret felet `-32020`. Övriga begäranden
  behandlas som `2025-11-25`: `initialize` svarar med den revisionen, och för alla
  andra metoder måste en eventuell `Mcp-Protocol-Version`-header vara `2025-11-25`,
  `2025-06-18` eller `2025-03-26`.
- **Verktygsfel.** Ett fel i en förmåga, inklusive argument som inte matchar
  schemat eller ett `arguments`-värde som inte är ett JSON-objekt, returneras som ett
  verktygsresultat med `isError: true` och AIP-193-felet i `structuredContent`, inte som ett
  protokollfel.
- **Protokollfel.** Fel som inte är verktygsfel är JSON-RPC-felobjekt
  (kod `-32000` med status och orsak i `data`, eller standardkoderna): en
  saknad Public Cacti URL, ett nekat `Origin`, en begäran när tillägget är inaktiverat
  eller på en fjärrpoller samt oväntade serverfel (`-32603`, där detaljerna
  skrivs till Cacti-loggen och inte i svaret). Begäranskontroller som körs först (405,
  413, 415) och autentiseringsfel (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  behåller den AIP-193-svarstext som beskrivs under HTTP-API.

## HTTP-API

Bas-URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Kontraktet finns
i [openapi.json](../../../openapi.json).

| Metod och sökväg | Syfte |
| --- | --- |
| `GET /v1/abilities` | Lista tillåtna förmågor. Frågeparametrar: `pageSize`, `pageToken` och `filter` på formen `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Läs en förmåga. |
| `POST /v1/abilities/{id}:execute` | Kör den. Begäranstexten är exakt `{"arguments": {...}}`. Svaret är `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Fel följer AIP-193: ett `error`-objekt med `code`, `message`, `status` och
`details` som innehåller en `ErrorInfo` med domänen `cacti.net` och en stabil `reason`.
Argumentproblem lägger till en `BadRequest`-detalj som anger fältet. Begäranstexter är
begränsade till 64 KB och resultat till 1 MB. Båda slutpunkterna svarar endast på
huvudpollern och returnerar `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) när tillägget är inaktiverat
eller servern inte är huvudpollern.

| HTTP | `reason`-värden |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (skickar även `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (skickar `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Skriva en förmåga (tilläggsförfattare)

Ett aktiverat Cacti-tillägg registrerar förmågor från en funktion som det kopplar till
hooken `abilities_register`, vanligtvis i sin `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Funktionen tar emot en `AbilitiesRegistrar` begränsad till tillägget. Dess returvärde
ignoreras.

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

Reglerna, som alla kontrolleras vid registrering:

- **ID:n.** Ett ID matchar `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, är högst 64
  tecken långt och måste börja med tilläggets slug och ett bindestreck: `acme-` ovan.
  Sluggen är tilläggets katalognamn, så en katalog som `my_plugin` kan inte
  registrera något. En tilläggskatalog med namnet `cacti` nekas; den
  namnrymden tillhör de inbyggda förmågorna.
- **Definition.** Exakt dessa nycklar: `label`, `description` (upp till 4096 byte),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Kategorin måste redan finnas: använd en inbyggd (`inventory`,
  `system`) eller registrera en egen med `registerCategory()`, vars ID är unikt över
  alla tillägg och matchar `^[a-z][a-z0-9-]{0,31}$`.
- **Endast skrivskyddade.** `annotations` måste vara exakt `readOnly: true`,
  `destructive: false`, `idempotent: true`. Allt annat kastar ett undantag.
- **Scheman.** `input_schema` och `output_schema` måste båda ha toppnivå-`type`
  `object`. Dialekten är liten och nekar som standard (fail closed). Objekt måste vara stängda
  (`additionalProperties: false`, med `properties` närvarande); övriga typer är
  `integer` och `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean` och `array` (som kräver `items` och
  `maxItems`). En typ kan
  göras nullbar som `['string', 'null']`. Argumentsträngar är som standard högst
  4096 tecken; resultatsträngar begränsas endast av en deklarerad `maxLength`
  och gränsen för resultatstorlek. Högst 256 förmågor kan registreras.
- **`permission(int $userId): bool`.** Måste returnera exakt `true` för att tillåta.
  Användar-ID:t tillhör tokenägaren; läs aldrig sessionstillstånd.
- **`execute(int $userId, stdClass $args): array`.** `$args` är redan validerat
  mot `input_schema`. Tillämpa behörigheter på objektnivå själv. Returnera en
  associativ array som matchar `output_schema` exakt; en lista, ett extra fält
  eller mer än 1 MB JSON blir ett `INVALID_RESULT`-fel. Kasta
  `AbilitiesError` vid ett fel som ska synas för klienten, såsom `NOT_FOUND`.
- **Tomma objekt.** PHP kodar `[]` som en JSON-array. Varhelst utdataschemat
  deklarerar ett `object`, på valfritt djup, behandlar registret `[]` som det tomma objektet
  och skickar `{}`; `new stdClass()` fungerar också. En icke-tom lista räknas aldrig som ett
  objekt och misslyckas med `INVALID_RESULT`. En tom `properties`-mappning i ett schema
  kan vara `[]` eller `new stdClass()`; båda publiceras som `{}`.
- **Felisolering.** Varje tillägg registrerar i en tillfällig kopia som behålls
  endast om din funktion returnerar normalt. Om den kastar ett undantag registreras inga av
  dina förmågor, och felet loggas.

Förmågor från tillägg är dolda från start. Administratören exponerar dem på
fliken Abilities i konsolen, och kolumnen Required Realm visar "Set by the plugin"
för dem.

## Säkerhetsmodell

- **Endast Bearer.** `api.php` och `mcp.php` accepterar endast en personlig token i
  headern `Authorization` och ingenting annat. De tar bort cookies, `$_POST` och
  `$_REQUEST` innan Cacti laddas och förstör den session som Cacti startar, så en
  webbläsarinloggning ger aldrig API-åtkomst.
- **Tillfällig lösning för CSRF.** Cactis CSRF-skydd avvisar en JSON POST som saknar
  en Cacti CSRF-token, vilket ingen MCP-klient kan skicka. Endast för dessa två
  slutpunkter byter insticksprogrammet namn på begärans metod innan Cacti laddas och
  återställer den efteråt, så att skyddet hoppar över dem. Detta är säkert eftersom
  CSRF skyddar förfrågningar som en webbläsare autentiserar med cookies, och dessa
  slutpunkter accepterar ingen cookie-identitet: en webbplatsöverskridande sida kan
  inte bifoga bearer-token. Konsolsidor behåller fullt CSRF-skydd. Denna lösning är
  tillfällig tills Cacti erbjuder ett officiellt undantag; se `lib/bootstrap.php`.
- **Kontroll av Origin.** På `mcp.php`, om begäran har en `Origin`-header måste den
  stämma exakt överens med schema, värd och port i den publika Cacti-URL:en, annars
  nekas begäran med `ORIGIN_NOT_ALLOWED`. En begäran utan `Origin`-header, vilket är
  så klienter utanför webbläsare ansluter, tillåts. Detta hindrar en webbsida från att
  styra slutpunkten från en besökares webbläsare. `api.php` tillämpar inte denna
  kontroll.
- **Endast läsning.** Registreringen avvisar varje förmåga som inte är avsedd enbart
  för läsning, icke-destruktiv och idempotent.
- **Både exponering och behörighetsområden (realms) gäller.** En förmåga måste vara
  exponerad och ägaren av token måste inneha dess behörighetsområde. Om
  exponeringstabellen inte kan läsas döljs alla förmågor i stället för att falla
  tillbaka till standardvärden.
- **Dolda, okända och otillåtna ser likadana ut.** En klient kan inte skilja en
  förmåga som inte finns från en som är dold eller som användaren inte får använda:
  upptäckt (discovery) utelämnar den och körning returnerar `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Tokens.** Lagras som SHA-256-hashar, visas en gång, löper alltid ut, kan
  återkallas och avvisas när ägaren inaktiveras eller förlorar behörighetsområdet.
- **Granskningslogg (Audit).** `plugin_mcp_audit` registrerar begärans-ID, token-ID,
  användar-ID, förmåga, utfall (`started`, `succeeded`, `failed`, `denied`,
  `rejected`) samt tidsstämplar. Den registrerar aldrig argument, resultat eller
  token-värden. En förmåga körs först efter att dess `started`-rad har skrivits; om
  granskningstabellen inte är tillgänglig misslyckas anropet med `UNAVAILABLE` och
  körs inte. Ett anrop som nekas innan det körs ger en rad: `denied` för en okänd,
  dold eller otillåten förmåga, `rejected` för argument som inte uppfyller schemat.
  Skapande och återkallande av tokens från konsolen, My MCP Tokens och CLI registreras
  som `mcp-token-create` och `mcp-token-revoke` med utfallet `succeeded`, och en
  återkallelse registreras endast för en token som var aktiv. Upptäckt (discovery),
  samt ett anrop vars `arguments` inte är ett JSON-objekt, loggas inte.
- **Fellogg.** Ett oväntat fel, `INVALID_RESULT` eller en otillgänglig
  granskningstabell skriver en rad till Cacti-loggen med faciliteten `MCP`: förmågans
  ID, en fast orsak och undantagsklassen. Meddelanden, argument och tokens loggas
  aldrig.
- **Endast huvudpollern (Main poller).** Båda slutpunkterna, båda konsolsidorna och
  `tokens.php` vägrar att agera någon annanstans.

## Livscykel

Att inaktivera insticksprogrammet blockerar båda slutpunkterna. Avinstallation
återkallar varje token och behåller de tre tabellerna (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) för lagring; ominstallation återaktiverar
inte en återkallad token. Säkerhetskopiera tabellerna tillsammans med Cacti-databasen
och tillämpa en lagringspolicy för granskningsloggen utanför insticksprogrammet.

## Utveckling och tester

Tester är vanliga PHP-skript som körs utan Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI lintar PHP och kör skripten i `tests/` (varje skript listas i
`.github/workflows/ci.yml`) på PHP 8.2 till och med 8.5, och bygger sedan det
installerbara `mcp/`-arkivet och dess kontrollsumma. Tester som berör Cacti använder
fixturer vid gränsen mot Cacti-hjälpfunktionerna; de testar inte en fullständig
Cacti-installation.

### Integrationstester

`tests/integration/run.sh 1.2.31` eller `tests/integration/run.sh develop` installerar
insticksprogrammet i en riktig Cacti-instans i containrar och kör kontroller direkt
mot den. Det kräver Docker med Compose v2.23.1 eller senare, git och openssl.
`KEEP=1` lämnar stacken körande för felsökning. CI kör det nattetid och på begäran,
inte vid pull requests.

## Lokalisering

Cacti MCP levereras med kompilerade GNU gettext-kataloger under `locales/po/` och
`locales/LC_MESSAGES/` samt lokaliserade README-filer under `docs/i18n/` för
engelska plus 47 språkvarianter (19 Broad Tier 1-, 15 afrikanska, 10 asiatiska samt bosniska, kroatiska och serbiska språkvarianter), med textdomänen `mcp` (`locales/po/mcp.pot`). Cacti laddar
matchande katalog automatiskt när språkstöd är aktiverat.

## Bidra

Pull requests skickas till `develop`. Håll produktionskoden kompatibel med PHP 8.2
och använd Cactis kodstil: tabbar, enkla citattecken för strängar samt Cactis
databas- och behörighetshjälpfunktioner. Lägg till tester för ändrat validerings-,
auktoriserings- eller protokollbeteende och signera commits med `git commit -s`.
Samordna ändringar av HTTP-API:et med [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licens

Copyright (C) 2026 Thomas Vincent. Släppt under GNU General Public License, version 2
eller senare. Se [LICENSE](../../../LICENSE).
