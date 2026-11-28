<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: een cactus met een schild. Ontdekken. Autoriseren. Uitvoeren.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licentie: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP is een Cacti-plug-in waarmee AI-clients uw Cacti-gegevens kunnen lezen via
benoemde, op machtigingen gefilterde bewerkingen die *abilities* worden genoemd. De plug-in biedt ze op twee manieren aan
vanuit de plug-in zelf: een MCP-eindpunt (`mcp.php`, Streamable HTTP) en een
AIP-achtige HTTP-API (`api.php`). Cacti blijft verantwoordelijk voor autorisatie en
uitvoering. Een client bevraagt nooit rechtstreeks de database; deze kan alleen een ability aanroepen die
door een beheerder is vrijgegeven en die door de Cacti-realms van de tokeneigenaar is toegestaan.

Auteurs van plug-ins kunnen hun eigen alleen-lezen abilities registreren via de
hook `abilities_register`, waarna ze voor MCP-clients als tools verschijnen zonder enige
protocolcode.

**Status: pre-release, versie 0.1.0.** Er is geen getagde release.

Vandaag beschikbaar:

- Negen ingebouwde alleen-lezen abilities voor systeemversies, apparaten,
  locaties (sites), pollers, grafiekbomen, grafieken, gegevensbronnen en een
  begrensde, geredigeerde staart van het Cacti-logboek.
- Persoonlijke toegangstokens (`cmcp_pat_...`) als enige authenticatiegegevens.
- De console onder Management > MCP: abilities vrijgeven of verbergen, tokens aanmaken en intrekken,
  het auditlogboek lezen.
- Management > My MCP Tokens: gebruikers beheren hun eigen tokens, bekijken hun activiteit
  en zien welke tools hun tokens kunnen gebruiken.
- MCP via Streamable HTTP, protocolrevisies `2026-07-28` en `2025-11-25`,
  alleen tools.

Nog niet beschikbaar:

- Aanmelden via OAuth 2.1. Gehoste connectors die geen persoonlijk token kunnen meesturen, zoals
  aangepaste connectors van ChatGPT en claude.ai, kunnen geen verbinding maken zolang dit niet bestaat. Het is
  gepland als Plan 2; dat plan is nog niet geschreven.
- Schrijf-abilities. Alleen alleen-lezen abilities kunnen worden geregistreerd.

Het ontwerp staat in de
[ontwerpspecificatie voor het eindpunt](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
en de bouwvolgorde staat in [docs/plan.md](../../plan.md).

## Ingebouwde abilities

| ID | Categorie | Argumenten | Vereiste Cacti-realm |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | geen | 15 |
| `cacti-list-devices` | `inventory` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | verplicht `name`, zoals `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 7 of 4 |
| `cacti-list-graphs` | `inventory` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 7 of 5 |
| `cacti-list-data-sources` | `inventory` | optioneel `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | optioneel `lines` (1 tot 200, standaard 50), `severity`, `search` | 19 of 18 |

Elke aanroep vereist ook de realm **MCP and Abilities API** voor de tokeneigenaar,
de scope `abilities:read` (elk persoonlijk token heeft deze) en een vrijgegeven
ability. Het tabblad Abilities in de console toont welke primaire realm elke ingebouwde ability nodig heeft.

Alle zes `cacti-list-*`-abilities retourneren pagina's van maximaal 100 items
(standaard 50) en een `nextPageToken`. Een paginatoken is alleen geldig voor
dezelfde `filter` en `orderBy`. `filter` is een AIP-160-expressie van
vergelijkingen (`=`, `!=`, `<`, `<=`, `>`, `>=`) gekoppeld met `AND`,
bijvoorbeeld `state = "DOWN" AND disabled = false`. `orderBy` accepteert een
komma-gescheiden lijst van sorteerbare velden, elk optioneel gevolgd door `asc`
of `desc`.

| Ability | Filtervelden | Sorteervelden |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Machtigingsafbakening en uitsluiting van geheimen:

- `cacti-list-devices` en `cacti-get-device` voeren query's uit via
  `get_allowed_devices()` van Cacti en sluiten SNMP-communitystrings,
  wachtwoordzinnen en andere inloggegevens uit.
- `cacti-list-trees` voert query's uit via `get_allowed_trees()` (en filtert met
  `is_tree_allowed()` indien beschikbaar); `cacti-list-graphs` voert query's uit
  via `get_allowed_graphs()` (en filtert met `is_graph_allowed()` indien
  beschikbaar).
- `cacti-list-data-sources` beperkt rijen tot de toegestane apparaten van de
  aanroeper uit `get_allowed_devices()` (en `is_device_allowed()` indien
  beschikbaar) en retourneert alleen metadata zonder `data_input_data` te
  bevragen of geheime invoerwaarden bloot te geven.
- `cacti-list-pollers` sluit databasegegevens (`dbpass`, `dbuser`) en
  TLS-sleutel- en certificaatkolommen (`dbsslkey`, `dbsslcert`, `dbsslca`) uit.
- `cacti-get-clog` leest maximaal de laatste 1 MiB van het geconfigureerde
  Cacti-logboek (waarbij afzonderlijke regels langer dan 2048 bytes worden
  afgekapt), filtert op `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`,
  `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`,
  `SYSTEM`; standaard `ALL`) en hoofdletterongevoelige `search` (maximaal 256
  tekens), en retourneert `lines`, `count` en `truncated`. Elke regel wordt
  geschoond van persoonlijke tokens, bearer/basic-headers, wachtwoorden, geheimen,
  SNMP-communities, sleutels, `dbpass`, `dbsslkey` en URL-userinfo voordat de
  filters `severity` en `search` draaien, zodat `search` niet als geheime
  orakel kan fungeren. Redactie faalt gesloten met `[redacted]`, en een
  onleesbaar logboek retourneert `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Installatie

Vereist Cacti 1.2.31 of hoger, PHP 8.2 of hoger en de hoofdpoller. Cacti-authenticatie
moet zijn ingeschakeld; de plug-in weigert te authenticeren wanneer deze is uitgeschakeld.

De plug-inmap moet `mcp` heten, niet `plugin_mcp`. De plug-inslug, realm-namen,
vertaaldomein en URL's gebruiken allemaal `mcp`.

Vanuit een broncode-checkout:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Totdat er getagde releases bestaan, kunt u in plaats daarvan het artifact `mcp-plugin`
downloaden van een geslaagde
[CI-run](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Dit bevat `mcp.tar.gz` en `SHA256SUMS`. Controleer de controlesom en pak daarna
`mcp.tar.gz` uit in de map `plugins/` van Cacti zodat het resultaat `plugins/mcp/` is.
De automatische bronarchieven van GitHub gebruiken een andere naam voor de bovenliggende map. Het
archief laat `docs/` (inclusief de onderstaande schermafbeeldingen), `tests/` en
`.github/` weg, dus de README-links naar `docs/` werken wel op GitHub maar niet in een geïnstalleerde
kopie.

Vervolgens:

1. Installeer en schakel **Cacti MCP** in bij Plugin Management. De installerende
   beheerder ontvangt automatisch de realm **MCP Administration**.
2. Stel onder Settings > MCP **Public Cacti URL** in op het adres dat clients gebruiken,
   bijvoorbeeld `https://cacti.example.com/cacti`. HTTPS is vereist behalve voor
   `localhost`, `127.0.0.1` en `[::1]`. Zolang dit niet is ingesteld, antwoordt `mcp.php` met HTTP 400
   en een JSON-RPC-fout waarvan `data` gelijk is aan `FAILED_PRECONDITION` en
   `PUBLIC_URL_REQUIRED`. `api.php` leest dit veld niet.

   ![Settings > MCP met het veld Public Cacti URL](../../images/settings-public-url.png)

3. Ken de realm **MCP and Abilities API** toe aan elke gebruiker die een token zal bezitten.
   Geen enkele gebruiker ontvangt deze automatisch.
4. Zorg ervoor dat de webserver de header `Authorization` en padinformatie doorgeeft aan PHP
   (zie hieronder).
5. Open Management > MCP en geef de abilities vrij die u zichtbaar wilt maken voor clients.

**Upgraden vanaf een ontwikkelingsbuild.** De plug-in is pre-release en de tabellen ervan
zijn tijdens de ontwikkeling zonder migraties gewijzigd. Als u een eerdere
build hebt geïnstalleerd, verwijder de plug-in dan en installeer deze opnieuw. Opnieuw installeren behoudt reeds bestaande
tabellen, dus verwijder eerst de oude tabellen `plugin_mcp_token`, `plugin_mcp_audit` en
`plugin_mcp_ability` (en de overeenkomstige tabellen van
builds van vóór de hernoeming). Maak er een back-up van als u de geschiedenis nodig hebt; tokens uit
die builds worden bij deïnstallatie ingetrokken en worden niet overgenomen.

### Webserver

Apache-configuraties die `Authorization` strippen vóór PHP hebben dit nodig in de betreffende
virtual host of map, gevolgd door een herlaadactie:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache met `mod_php` verwerkte `api.php`-routes zonder extra padconfiguratie.

`api.php`-routes bevinden zich in het pad na de scriptnaam
(`/plugins/mcp/api.php/v1/abilities`), dus nginx moet URI's matchen waarin `.php` wordt
gevolgd door extra pad, de padinformatie splitsen en deze doorgeven aan PHP. Een
`location ~ \.php$`-blok matcht deze URL's nooit; nginx antwoordt dan met zijn eigen
HTML 404. Het locatiepatroon en de twee path-info-regels hieronder zijn geverifieerd met
PHP-FPM; de overige regels zijn standaardboilerplate:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Pas de regels `include` en `fastcgi_pass` aan zodat ze overeenkomen met het blok dat al
Cacti bedient. Voeg `try_files $fastcgi_script_name =404;` niet toe aan dit blok: dit wist
`$fastcgi_path_info`, en `api.php` antwoordt dan met 404 `UNKNOWN_PATH`. Als uw
configuratie `try_files` vereist, sla de waarde dan eerst op met
`set $path_info $fastcgi_path_info;` en geef `fastcgi_param PATH_INFO $path_info;` door.

`mcp.php` heeft geen padroutes en heeft deze niet nodig.

## Console

Management > MCP heeft drie tabbladen. U hebt de realm **MCP Administration** nodig.
Schermafbeeldingen hier en hieronder zijn afkomstig van een Cacti-ontwikkelingsbuild met voorbeeldgegevens.

- **Abilities** toont elke geregistreerde ability met de bijbehorende plug-in, categorie, de
  benodigde realm en of deze is vrijgegeven. Selecteer rijen en kies Expose of
  Hide; u bevestigt voordat de wijziging wordt toegepast. Ingebouwde `cacti-*`-abilities zijn
  standaard vrijgegeven. Abilities van andere plug-ins beginnen verborgen, zodat het installeren van een
  plug-in nooit iets publiceert totdat een beheerder daartoe besluit. Vrijgave
  beperkt de toegang alleen maar verder: een gebruiker heeft nog steeds de realm van de ability nodig.

  ![Tabblad Abilities met de ingebouwde abilities, hun realms en vrijgavestatus](../../images/console-abilities.png)
- **Tokens** toont tokens met eigenaar, aanmaker, aanmaakdatum, vervaldatum, laatste gebruik en
  status (Active, Expired, Revoked). Selecteer rijen en kies Revoke om ze in te trekken.
  Ingetrokken tokens kunnen niet opnieuw worden gebruikt. Create Token maakt een nieuw token aan.

  ![Tabblad Tokens met tokens inclusief eigenaar, vervaldatum, laatste gebruik en status, boven het formulier Create Token](../../images/console-tokens.png)
- **Audit** toont auditregels, nieuwste eerst, en filtert op gebruiker, ability en
  uitkomst.

  ![Tabblad Audit met aanroepen inclusief gebruiker, token, ability en uitkomst, met filters](../../images/console-audit.png)

## Tokens

Een persoonlijk token leest Cacti als zijn eigenaar. Het heeft de vorm `cmcp_pat_` gevolgd door
64 kleine hexadecimale tekens en draagt de enkele scope `abilities:read`. Wat het
kan zien wordt bepaald door de Cacti-realms en apparaatmachtigingen van de eigenaar, niet door het
token. De eigenaar moet een ingeschakelde gebruiker zijn die beschikt over de realm **MCP and Abilities API**.

Tokens worden altijd aangemaakt voor een gebruiker, vervallen na verloop van tijd en kunnen worden ingetrokken:

- **Console.** Management > MCP > Tokens > Create Token. De levensduur is 1 tot 365 dagen
  en is standaard 90. Het token wordt gegenereerd door de server en eenmalig getoond op de
  antwoordpagina, dus kopieer het direct naar uw wachtwoord- of geheimenbeheerder. U kunt een
  token voor uzelf aanmaken. Voor het aanmaken voor een andere gebruiker is ook de realm Users/Groups
  nodig, omdat het token Cacti leest als die gebruiker.
- **My MCP Tokens.** Elke gebruiker met de realm MCP and Abilities API kan zijn eigen
  tokens beheren; zie hieronder.
- **Opdrachtregel.** `tokens.php` draait alleen vanaf de CLI, als een OS-account dat
  Cacti kan beheren. Het haalt het token uit de omgeving zodat de waarde nooit
  op een opdrachtregel of in de proceslijst verschijnt. De levensduur is 1 tot 365 dagen en
  is standaard 30. Het aanmaken en intrekken van een token via de CLI wordt geaudit net als in de
  console, met de eigenaar van het token als actor omdat de CLI geen Cacti-gebruiker heeft; de
  auditregel markeert de actie dus niet als afkomstig van de CLI. `--list` drukt
  elk token af als JSON (ID, eigenaar, scopes, tijdstempels, vlag voor ingetrokken) en nooit de
  tokenwaarde; `--help` toont het gebruik.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokens kunnen niet worden aangemaakt voor het gastaccount, voor uitgeschakelde gebruikers of voor gebruikers
zonder de realm **MCP and Abilities API**, noch vanuit de console, noch vanaf de opdrachtregel, noch vanuit
My MCP Tokens. Cacti slaat de gastinstelling op als gebruikersnaam of als gebruikers-ID, en de
plug-in herleidt beide. Een token waarvan de eigenaar het gastaccount wordt, werkt bij het
volgende verzoek niet meer.

### Mijn MCP-tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) heeft geen beheerdersrealm nodig:
het valt onder de realm **MCP and Abilities API** en het menu-item
verschijnt alleen voor gebruikers die deze bezitten. De pagina handelt altijd namens de aangemelde gebruiker.
Het menu van Cacti maakt deel uit van de console, dus een gebruiker zonder consoletoegang bereikt de
pagina via het directe adres.

![Tabblad My Tokens met de tokens van de aangemelde gebruiker en het aanmaakformulier](../../images/my-tokens.png)

- **Tokens** toont uw tokens, maakt er een aan (1 tot 365 dagen, standaard 90, eenmalig getoond
  in het antwoord) en trekt uw eigen tokens in. U kunt geen tokens van anderen zien of intrekken.
- **Activity** toont de acties die u hebt uitgevoerd, nieuwste eerst: aanroepen gedaan met uw
  tokens en tokenwijzigingen die u hebt doorgevoerd.
- **Available Tools** toont de abilities die een token van u op dit moment kan gebruiken, met
  van elke ability de ID, naam en beschrijving. Deze lijst volgt uw Cacti-machtigingen en
  de vrijgave-instellingen die een beheerder heeft gekozen.

  ![Lijst Available Tools met van elke ability de ID, naam en beschrijving](../../images/my-tools.png)

Een installatie die is gemaakt voordat deze pagina bestond, heeft een realm-bestandslijst zonder
`mcp_tokens.php`. Installeren registreert de lijst; deze wordt niet bijgewerkt door de plug-in in of uit te
schakelen. Verwijder de plug-in en installeer deze opnieuw, en ken de realms vervolgens
opnieuw toe, omdat Cacti realm-toekenningen verwijdert wanneer een plug-in wordt gedeïnstalleerd.

De database slaat alleen de SHA-256-hash van het token op, zodat een verloren token niet kan worden
hersteld; trek het in en maak een ander aan. Rotatie werkt hetzelfde: maak een nieuw token aan,
schakel de client over en trek daarna het oude in. Een verlopen token, een ingetrokken token, een
uitgeschakelde eigenaar of een verloren realm mislukken elk bij het volgende verzoek. Tokens worden alleen
geaccepteerd in de header `Authorization: Bearer`; een token in de querystring of body wordt
niet geaccepteerd.

## Een client verbinden

Gebruik het MCP-eindpunt `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, met het
token in een `Authorization: Bearer`-header. Bewaar het token in een
omgevingsvariabele of secret manager en verwijs ernaar vanuit de clientconfiguratie
in plaats van de waarde in een bestand op te slaan.

### Claude Code

Plaats het eindpunt in een `.mcp.json`-bestand van het project dat op naam naar
het token verwijst. Claude Code breidt `${VAR}` uit in `url` en `headers`, zodat
het bestand geen geheim bevat en veilig kan worden gecommit. Exporteer
`CACTI_MCP_TOKEN` in de omgeving die Claude Code start.

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

Je kunt het ook toevoegen vanaf de opdrachtregel:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Bij dubbele aanhalingstekens breidt je shell `$CACTI_MCP_TOKEN` eerst uit, waardoor
de tokenwaarde wordt weggeschreven naar het configuratiebestand voor de gekozen
`--scope` (`local`, `user` of `project`; standaard `local`). Gebruik die vorm niet
met `--scope project` en houd het bestand buiten versiebeheer. Geef de voorkeur
aan de bovenstaande `.mcp.json`-verwijzing. Claude Code leest sommige
inlogvariabelen (zoals `ANTHROPIC_AUTH_TOKEN`) als leeg in externe `url` en
`headers`; `CACTI_MCP_TOKEN` is daar geen van. Bron:
[Claude Code MCP-documentatie](https://code.claude.com/docs/en/mcp).

### GitHub Copilot in VS Code

Gebruik een `.mcp.json` in de hoofdmap van de werkruimte (of het gebruikersbestand
`~/.copilot/mcp-config.json`). Deze Copilot-eigen bestanden gebruiken een
`mcpServers`-object op het hoogste niveau en `${NAME}`-verwijzingen naar
omgevingsvariabelen in headerwaarden:

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

Exporteer `CACTI_MCP_TOKEN` in de omgeving die VS Code start. Copilot-eigen
bestanden ondersteunen geen `inputs`-prompts. De begeleide installatie van VS Code
wijst `${...}`-waarden af, dus voeg de `Authorization`-header toe door het bestand
te bewerken en niet via de begeleide flow. De begeleide installatie biedt het
bestand in de hoofdmap van de werkruimte alleen aan wanneer de experimentele
instelling `chat.mcp.workspaceRootConfig.enabled` is ingeschakeld. Zie de
[VS Code MCP-configuratiereferentie](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Verouderd: `.vscode/mcp.json`.** VS Code geeft aan dat nieuwe
Copilot-configuraties geen gebruik moeten maken van `.vscode/mcp.json` of het
profielbestand `mcp.json`; deze behoren tot het uitgefaseerde Local-harnas, dat in
februari 2027 wordt verwijderd. Als je het nog gebruikt, verwacht het door de
editor beheerde formaat een `servers`-sleutel op het hoogste niveau en kan het om
het token vragen:

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

### Clients die alleen stdio spreken

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) is een optionele
adapter die draait als een lokale stdio-MCP-server en de HTTP-API van de plug-in
aanroept. Gebruik deze voor een client die geen verbinding kan maken met een
externe HTTP-server. Deze heeft hetzelfde persoonlijke token nodig en communiceert
met `api.php`.

### MCP-gedrag

Het eindpunt levert uitsluitend tools: elke vrijgegeven, toegestane ability is een
tool met zijn ID als naam, met bijbehorende invoer- en uitvoerschema's en
alleen-lezen-annotaties (`openWorldHint` is `false`). Het verwerkt `initialize`,
`server/discover`, `ping`, `tools/list` en `tools/call`. Het houdt geen sessie
bij, verstuurt geen `Mcp-Session-Id` (en negeert een ontvangen exemplaar) en
accepteert geen JSON-RPC-batches. Een bericht zonder `id` is een melding en krijgt
HTTP 202 zonder body. Alleen `POST` is toegestaan.

- **Revisies.** Een verzoek met `io.modelcontextprotocol/protocolVersion` in
  `params._meta` moet `2026-07-28` vermelden; alles wat afwijkt krijgt fout
  `-32022`. Dergelijke verzoeken moeten ook overeenkomstige `Mcp-Protocol-Version`-,
  `Mcp-Method`- en (voor `tools/call`) `Mcp-Name`-headers bevatten, anders is het
  antwoord fout `-32020`. Andere verzoeken worden behandeld als `2025-11-25`:
  `initialize` antwoordt met die revisie, en bij elke andere methode moet een
  eventueel meegestuurde `Mcp-Protocol-Version`-header `2025-11-25`, `2025-06-18`
  of `2025-03-26` zijn.
- **Toolfouten.** Een ability-fout, waaronder argumenten die niet overeenkomen
  met het schema of een `arguments`-waarde die geen JSON-object is, komt terug als
  een toolresultaat met `isError: true` en de AIP-193-fout in `structuredContent`,
  niet als een protocolfout.
- **Protocolfouten.** Fouten die geen toolfouten zijn, zijn JSON-RPC-foutobjecten
  (code `-32000` met de status en reden in `data`, of de standaardcodes): de
  ontbrekende Public Cacti URL, een geweigerde `Origin`, een verzoek terwijl de
  plug-in is uitgeschakeld of op een externe poller, en onverwachte serverfouten
  (`-32603`, waarbij de details naar het Cacti-logboek worden geschreven en niet
  in het antwoord staan). Verzoekcontroles die als eerste draaien (405, 413, 415)
  en authenticatiefouten (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) behouden de
  AIP-193-body zoals beschreven onder HTTP-API.

## HTTP-API

Basis-URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Het contract
staat in [openapi.json](../../../openapi.json).

| Methode en pad | Doel |
| --- | --- |
| `GET /v1/abilities` | Toegestane abilities oplijsten. Query: `pageSize`, `pageToken` en `filter` in de vorm `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Eén ability uitlezen. |
| `POST /v1/abilities/{id}:execute` | Uitvoeren. De body is exact `{"arguments": {...}}`. Het antwoord is `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Fouten volgen AIP-193: een `error`-object met `code`, `message`, `status` en
`details` dat een `ErrorInfo` bevat met domein `cacti.net` en een stabiele
`reason`. Problemen met argumenten voegen een `BadRequest`-detail toe dat het veld
benoemt. Verzoek-bodies zijn beperkt tot 64 KB en resultaten tot 1 MB. Beide
eindpunten antwoorden alleen op de hoofdpoller en retourneren `UNAVAILABLE`
(`PLUGIN_UNAVAILABLE`) wanneer de plug-in is uitgeschakeld of de server niet de
hoofdpoller is.

| HTTP | `reason`-waarden |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (stuurt ook `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (stuurt `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Een ability schrijven (plug-inauteurs)

Een ingeschakelde Cacti-plug-in registreert abilities vanuit een functie die wordt
gekoppeld aan de `abilities_register`-hook, meestal in de eigen
`plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

De functie ontvangt een `AbilitiesRegistrar` die is afgebakend tot de plug-in. De
retourwaarde wordt genegeerd.

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

De regels, allemaal afgedwongen bij registratie:

- **ID's.** Een ID voldoet aan `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, is maximaal
  64 tekens lang en moet beginnen met de slug van de plug-in gevolgd door een
  koppelteken: `acme-` hierboven. De slug is de mapnaam van de plug-in, dus een
  map zoals `my_plugin` kan niets registreren. Een plug-inmap met de naam `cacti`
  wordt geweigerd; die naamruimte hoort bij de ingebouwde abilities.
- **Definitie.** Exact deze sleutels: `label`, `description` (tot 4096 bytes),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. De categorie moet al bestaan: gebruik een ingebouwde categorie
  (`inventory`, `system`) of registreer je eigen categorie met
  `registerCategory()`, waarvan het ID uniek is over alle plug-ins heen en
  voldoet aan `^[a-z][a-z0-9-]{0,31}$`.
- **Uitsluitend alleen-lezen.** `annotations` moet exact `readOnly: true`,
  `destructive: false`, `idempotent: true` zijn. Alles wat afwijkt werpt een
  uitzondering op.
- **Schema's.** `input_schema` en `output_schema` moeten elk op het hoogste niveau
  `type` `object` hebben. Het dialect is klein en faalt gesloten (*fail-closed*).
  Objecten moeten gesloten zijn (`additionalProperties: false`, met `properties`
  aanwezig); andere typen zijn `integer` en `number` (`minimum`, `maximum`),
  `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean` en `array`
  (die `items` en `maxItems` vereist). Een type kan nullable worden gemaakt als
  `['string', 'null']`. Argumentstrings zijn standaard beperkt tot maximaal 4096
  tekens; resultaatstrings worden alleen beperkt door een gedeclareerde
  `maxLength` en de limiet op de resultaatgrootte. Er kunnen maximaal 256
  abilities worden geregistreerd.
- **`permission(int $userId): bool`.** Moet exact `true` retourneren om toe te
  staan. Het gebruikers-ID is dat van de eigenaar van het token; lees nooit
  sessiestatus uit.
- **`execute(int $userId, stdClass $args): array`.** `$args` is al gevalideerd
  tegen `input_schema`. Dwing machtigingen op objectniveau zelf af. Retourneer een
  associatieve array die exact overeenkomt met `output_schema`; een lijst, een
  extra veld of meer dan 1 MB aan JSON levert een `INVALID_RESULT`-fout op. Werp
  `AbilitiesError` op voor een voor de client zichtbare fout, zoals `NOT_FOUND`.
- **Lege objecten.** PHP codeert `[]` als een JSON-array. Overal waar het
  uitvoerschema een `object` declareert, op elk niveau, behandelt het register
  `[]` als het lege object en verstuurt `{}`; `new stdClass()` werkt ook. Een
  niet-lege lijst geldt nooit als een object en faalt met `INVALID_RESULT`. Een
  lege `properties`-map in een schema mag `[]` of `new stdClass()` zijn; beide
  worden gepubliceerd als `{}`.
- **Foutisolatie.** Elke plug-in registreert in een tijdelijke werkkopie (*scratch
  copy*) die alleen behouden blijft als je functie normaal terugkeert. Als de
  functie een uitzondering opwerpt, wordt geen enkele van je abilities
  geregistreerd en wordt de fout gelogd.

Abilities van plug-ins beginnen verborgen. De beheerder geeft ze vrij op het
tabblad Abilities van de console, en de kolom Required Realm vermeldt dan
"Set by the plugin".

## Beveiligingsmodel

- **Alleen bearer-tokens.** `api.php` en `mcp.php` accepteren een persoonlijk token in de
  `Authorization`-header en niets anders. Ze verwijderen cookies, `$_POST` en
  `$_REQUEST` voordat Cacti wordt geladen en vernietigen de sessie die Cacti start, zodat
  een browserlogin nooit API-toegang verleent.
- **CSRF-omweg.** De CSRF-beveiliging van Cacti weigert een JSON POST zonder
  Cacti-CSRF-token, dat geen enkele MCP-client kan meesturen. Alleen voor deze twee
  endpoints hernoemt de plug-in de request-methode voordat Cacti wordt geladen en herstelt
  deze daarna weer, zodat de beveiliging ze overslaat. Dit is veilig omdat CSRF verzoeken
  beschermt die een browser met cookies authenticeert, en deze endpoints geen
  cookie-identiteit accepteren: een cross-site pagina kan het bearer-token niet meesturen.
  Consolepagina's behouden volledige CSRF-bescherming. De omweg is tijdelijk, totdat Cacti
  een ondersteunde uitzondering biedt; zie `lib/bootstrap.php`.
- **Origin-controle.** Op `mcp.php` geldt dat als het verzoek een `Origin`-header bevat,
  deze exact overeen moet komen met het schema, de host en de poort van de Public Cacti URL;
  anders wordt het verzoek geweigerd met `ORIGIN_NOT_ALLOWED`. Een verzoek zonder
  `Origin`-header, wat de manier is waarop niet-browserclients verbinding maken, wordt
  toegestaan. Dit voorkomt dat een webpagina het endpoint vanuit de browser van een bezoeker
  aanstuurt. `api.php` past deze controle niet toe.
- **Alleen-lezen.** Registratie weigert elke ability die niet alleen-lezen, niet-destructief
  en idempotent is.
- **Zowel blootstelling als realms zijn van toepassing.** Een ability moet zijn blootgesteld
  en de eigenaar van het token moet het bijbehorende realm bezitten. Als de
  blootstellingstabel niet kan worden gelezen, wordt elke ability verborgen in plaats van
  terug te vallen op standaardwaarden.
- **Verborgen, onbekend en niet-toegestaan zien er hetzelfde uit.** Een client kan een
  ability die niet bestaat niet onderscheiden van een verborgen ability of een ability die
  de gebruiker niet mag gebruiken: discovery laat deze weg en uitvoering retourneert
  `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Tokens.** Opgeslagen als SHA-256-hashes, eenmalig getoond, altijd voorzien van een
  vervaldatum, intrekbaar en geweigerd wanneer de eigenaar is uitgeschakeld of het realm
  verliest.
- **Audit.** `plugin_mcp_audit` legt het verzoek-ID, token-ID, gebruikers-ID, de ability,
  de uitkomst (`started`, `succeeded`, `failed`, `denied`, `rejected`) en tijdstempels vast.
  Er worden nooit argumenten, resultaten of tokenwaarden opgeslagen. Een ability wordt pas
  uitgevoerd nadat de `started`-rij is weggeschreven; als de audittabel niet beschikbaar is,
  mislukt de aanroep met `UNAVAILABLE` en wordt deze niet uitgevoerd. Een aanroep die vóór
  uitvoering wordt geweigerd, levert één rij op: `denied` voor een onbekende, verborgen of
  niet-toegestane ability, `rejected` voor argumenten die niet aan het schema voldoen. Het
  aanmaken en intrekken van tokens vanuit de console, My MCP Tokens en de CLI worden
  vastgelegd als `mcp-token-create` en `mcp-token-revoke` met uitkomst `succeeded`, en een
  intrekking wordt alleen vastgelegd voor een token dat actief was. Discovery en een aanroep
  waarvan `arguments` geen JSON-object is, worden niet gelogd.
- **Foutenlog.** Een onverwachte fout, `INVALID_RESULT` of een niet-beschikbare audittabel
  schrijft één regel naar het Cacti-logboek met faciliteit `MCP`: het ability-ID, een vaste
  reden en de exception-klasse. Meldingen, argumenten en tokens worden nooit gelogd.
- **Alleen hoofdpoller.** Beide endpoints, beide consolepagina's en `tokens.php` weigeren
  elders uit te voeren.

## Levenscyclus

Het uitschakelen van de plug-in blokkeert beide endpoints. Verwijderen trekt elk token in en
behoudt de drie tabellen (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`)
voor bewaring; opnieuw installeren heractiveert een ingetrokken token niet. Maak een back-up
van de tabellen samen met de Cacti-database en pas buiten de plug-in een bewaarbeleid voor
audits toe.

## Ontwikkeling en tests

De testsuite omvat gewone PHP-scripts in `tests/` plus PHPUnit-unittests in
`tests/Unit/` en statische analyse met PHPStan (niveau 6), allemaal uitvoerbaar
zonder Cacti-installatie:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI draait op PHP 8.2 tot en met 8.5: een `test`-taak die de PHP-syntaxis
controleert (`php -l`) en de 13 gewone PHP-testscripts uitvoert die in
`.github/workflows/ci.yml` staan vermeld, een `quality`-taak die
`composer phpstan` en `composer test` uitvoert, en een `package`-taak die het
installeerbare `mcp/`-archief (zonder de ontwikkelings- en testbestanden die in
`.gitattributes` staan vermeld) en de bijbehorende `SHA256SUMS` bouwt. Tests
die Cacti raken gebruiken fixtures op de grens van de Cacti-helpers; ze testen
geen volledige Cacti-installatie.

### Integratietests

`tests/integration/run.sh 1.2.31` of `tests/integration/run.sh develop` installeert de
plug-in in een echte Cacti-omgeving in containers en voert er live controles op uit.
Hiervoor zijn Docker met Compose v2.23.1 of hoger, git en openssl vereist. `KEEP=1` laat de
stack draaien voor debugging. CI voert dit elke nacht en op aanvraag uit, niet bij pull
requests.

## Lokalisatie

Cacti MCP wordt geleverd met gecompileerde GNU gettext-catalogi onder `locales/po/` en
`locales/LC_MESSAGES/` en gelokaliseerde README's onder `docs/i18n/` voor Engels plus 47 locales (19 Broad Tier 1-, 15 Afrikaanse, 10 Aziatische, plus Bosnische, Kroatische en Servische locales), met behulp van het
tekstdomein `mcp` (`locales/po/mcp.pot`). Cacti laadt automatisch de bijbehorende catalogus
wanneer taalondersteuning is ingeschakeld.

## Bijdragen

Pull requests gaan naar `develop`. Houd productiecode compatibel met PHP 8.2 en volg de
stijl van Cacti: tabs, strings met enkele aanhalingstekens en de database- en
permissiehelpers van Cacti. Voeg tests toe voor gewijzigd validatie-, autorisatie- of
protocolgedrag, en onderteken commits met `git commit -s`. Stem wijzigingen aan de HTTP-API
af met [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licentie

Copyright (C) 2026 Thomas Vincent. Uitgebracht onder de GNU General Public
License, versie 2 of hoger. Zie [LICENSE](../../../LICENSE).
