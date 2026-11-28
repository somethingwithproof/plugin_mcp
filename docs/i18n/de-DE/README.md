<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ein Kaktus mit einem Schild. Entdecken. Autorisieren. Ausführen.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lizenz: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP ist ein Cacti-Plugin, mit dem KI-Clients Ihre Cacti-Daten über
benannte, berechtigungsgefilterte Operationen – sogenannte Abilities – lesen können.
Es stellt diese direkt über das Plugin auf zwei Wegen bereit: über einen
MCP-Endpunkt (`mcp.php`, Streamable HTTP) und eine HTTP-API im AIP-Stil
(`api.php`). Cacti behält dabei die Kontrolle über Autorisierung und
Ausführung. Ein Client fragt niemals direkt die Datenbank ab; er kann nur
eine Ability aufrufen, die von einem Administrator freigegeben wurde und die
durch die Cacti-Realms des Token-Inhabers erlaubt ist.

Plugin-Autoren können eigene schreibgeschützte Abilities über den Hook
`abilities_register` registrieren; diese erscheinen für MCP-Clients ohne
zusätzlichen Protokollcode als Tools.

**Status: Vorabversion, Version 0.1.0.** Es gibt noch kein getaggtes Release.

Bereits verfügbar:

- Neun schreibgeschützte integrierte Abilities für Systemversionen, Geräte, Standorte,
  Poller, Graph-Bäume, Graphen, Datenquellen sowie einen begrenzten, geschwärzten
  Auszug vom Ende des Cacti-Logs.
- Persönliche Zugriffstoken (`cmcp_pat_...`) als einzige Anmeldeinformationen.
- Die Konsole Management > MCP: Abilities freigeben oder ausblenden, Token
  erstellen und widerrufen sowie das Audit-Protokoll einsehen.
- Management > My MCP Tokens: Benutzer verwalten ihre eigenen Token, sehen ihre
  Aktivität ein und prüfen, welche Tools ihre Token verwenden können.
- MCP über Streamable HTTP, Protokollrevisionen `2026-07-28` und `2025-11-25`,
  ausschließlich Tools.

Noch nicht verfügbar:

- OAuth-2.1-Anmeldung. Gehostete Konnektoren, die kein persönliches Token senden
  können – wie etwa benutzerdefinierte Konnektoren von ChatGPT und claude.ai –,
  können erst eine Verbindung herstellen, wenn diese Funktion existiert. Sie ist
  als Plan 2 vorgesehen; dieser Plan wurde noch nicht verfasst.
- Schreibende Abilities. Es können nur schreibgeschützte Abilities registriert werden.

Das Design ist in der
[Endpunkt-Designspezifikation](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)
beschrieben, die Umsetzungsreihenfolge in [docs/plan.md](../../plan.md).

## Integrierte Abilities

| ID | Kategorie | Argumente | Erforderlicher Cacti-Realm |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | keine | 15 |
| `cacti-list-devices` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | erforderlich `name`, z. B. `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 oder 4 |
| `cacti-list-graphs` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 oder 5 |
| `cacti-list-data-sources` | `inventory` | optional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | optional `lines` (1 bis 200, Standard 50), `severity`, `search` | 19 oder 18 |

Jeder Aufruf erfordert außerdem den Realm **MCP and Abilities API** für den
Token-Inhaber, den Scope `abilities:read` (diesen besitzt jedes persönliche
Token) sowie eine freigegebene Ability. Auf der Registerkarte Abilities der
Konsole wird angezeigt, welchen primären Realm jede integrierte Ability benötigt.

Alle sechs `cacti-list-*`-Abilities geben Seiten mit bis zu 100 Einträgen
(Standard: 50) und einem `nextPageToken` zurück. Ein Seiten-Token ist nur für
denselben `filter` und dasselbe `orderBy` gültig. `filter` ist ein
AIP-160-Ausdruck aus Vergleichen (`=`, `!=`, `<`, `<=`, `>`, `>=`), die mit
`AND` verknüpft sind, zum Beispiel `state = "DOWN" AND disabled = false`.
`orderBy` akzeptiert eine kommagetrennte Liste sortierbarer Felder, jeweils
optional gefolgt von `asc` oder `desc`.

| Ability | Filterfelder | Sortierfelder |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Berechtigungsabgrenzung und Ausschluss vertraulicher Daten:

- `cacti-list-devices` und `cacti-get-device` fragen über `get_allowed_devices()`
  von Cacti ab und schließen SNMP-Community-Strings, Passphrasen und andere
  Anmeldeinformationen aus.
- `cacti-list-trees` fragt über `get_allowed_trees()` ab (und filtert mit
  `is_tree_allowed()`, sofern verfügbar); `cacti-list-graphs` fragt über
  `get_allowed_graphs()` ab (und filtert mit `is_graph_allowed()`, sofern verfügbar).
- `cacti-list-data-sources` beschränkt Zeilen auf die über `get_allowed_devices()`
  (und `is_device_allowed()`, sofern verfügbar) erlaubten Geräte des Aufrufers
  und gibt nur Metadaten zurück, ohne `data_input_data` abzufragen oder geheime
  Eingabewerte offenzulegen.
- `cacti-list-pollers` schließt Datenbank-Anmeldeinformationen (`dbpass`, `dbuser`)
  sowie TLS-Schlüssel- und Zertifikatsspalten (`dbsslkey`, `dbsslcert`, `dbsslca`) aus.
- `cacti-get-clog` liest bis zu den letzten 1 MiB des konfigurierten Cacti-Logs
  (einzelne Zeilen über 2048 Bytes werden gekürzt), filtert nach `severity` (`ALL`,
  `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`,
  `FATAL`, `STATS`, `POLLER`, `SYSTEM`; Standard `ALL`) und Groß-/Kleinschreibung
  ignorierendem `search` (bis zu 256 Zeichen) und gibt `lines`, `count` und
  `truncated` zurück. Jede Zeile wird bezüglich persönlicher Tokens,
  Bearer/Basic-Headern, Passwörtern, Geheimnissen, SNMP-Communities, Schlüsseln,
  `dbpass`, `dbsslkey` und URL-Benutzerdaten geschwärzt, bevor die Filter
  `severity` und `search` ausgeführt werden, damit `search` nicht als
  Geheimnis-Orakel dienen kann. Die Schwärzung schlägt geschlossen mit
  `[redacted]` fehl, und ein nicht lesbares Log gibt `FAILED_PRECONDITION`
  (`LOG_UNAVAILABLE`) zurück.

## Installation

Erfordert Cacti 1.2.31 oder neuer, PHP 8.2 oder neuer sowie den Haupt-Poller. Die
Cacti-Authentifizierung muss aktiviert sein; ist sie deaktiviert, verweigert das
Plugin die Authentifizierung.

Das Plugin-Verzeichnis muss `mcp` heißen, nicht `plugin_mcp`. Plugin-Slug,
Realm-Namen, Übersetzungsdomäne und URLs verwenden durchgängig `mcp`.

Aus einem Quellcode-Checkout:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Solange keine getaggten Releases vorliegen, können Sie stattdessen das
Artefakt `mcp-plugin` aus einem erfolgreichen
[CI-Lauf](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
herunterladen. Es enthält `mcp.tar.gz` und `SHA256SUMS`. Prüfen Sie die
Prüfsumme und entpacken Sie `mcp.tar.gz` anschließend im Verzeichnis `plugins/`
von Cacti, sodass das Ergebnis `plugins/mcp/` lautet. Die automatisch von
GitHub erzeugten Quellcode-Archive verwenden einen anderen Namen für das
oberste Verzeichnis. Das Archiv lässt `docs/` (einschließlich der unten
gezeigten Screenshots), `tests/` und `.github/` aus, sodass die README-Links
auf `docs/` zwar auf GitHub funktionieren, nicht jedoch in einer installierten
Kopie.

Anschließend:

1. Installieren und aktivieren Sie **Cacti MCP** im Plugin Management. Der
   installierende Administrator erhält automatisch den Realm **MCP Administration**.
2. Setzen Sie unter Settings > MCP die Option **Public Cacti URL** auf die
   Adresse, die Clients verwenden, zum Beispiel `https://cacti.example.com/cacti`.
   HTTPS ist erforderlich, außer für `localhost`, `127.0.0.1` und `[::1]`. Solange
   dies nicht festgelegt ist, antwortet `mcp.php` mit HTTP 400 und einem
   JSON-RPC-Fehler, dessen `data` die Werte `FAILED_PRECONDITION` und
   `PUBLIC_URL_REQUIRED` enthält. `api.php` liest diese Einstellung nicht aus.

   ![Settings > MCP mit dem Feld Public Cacti URL](../../images/settings-public-url.png)

3. Weisen Sie den Realm **MCP and Abilities API** jedem Benutzer zu, der ein
   Token besitzen soll. Kein Benutzer erhält diesen Realm automatisch.
4. Stellen Sie sicher, dass der Webserver den `Authorization`-Header und die
   Pfadinformationen an PHP übergibt (siehe unten).
5. Öffnen Sie Management > MCP und geben Sie die Abilities frei, die für
   Clients sichtbar sein sollen.

**Upgrade von einem Entwicklungs-Build.** Das Plugin ist eine Vorabversion und
seine Tabellen haben sich während der Entwicklung ohne Migrationen geändert.
Wenn Sie einen früheren Build installiert haben, deinstallieren Sie das Plugin
und installieren Sie es erneut. Bei einer Neuinstallation bleiben bereits
vorhandene Tabellen erhalten; löschen Sie daher zuerst die alten Tabellen
`plugin_mcp_token`, `plugin_mcp_audit` und `plugin_mcp_ability` (sowie die
entsprechenden Tabellen aus Builds vor der Umbenennung). Sichern Sie diese
vorab, falls Sie deren Verlauf benötigen; Token aus diesen Builds werden bei
der Deinstallation widerrufen und nicht übernommen.

### Webserver

Apache-Konfigurationen, die `Authorization` vor PHP entfernen, benötigen
folgende Direktive im jeweiligen Virtual Host oder Verzeichnis, gefolgt von
einem Reload:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache mit `mod_php` bediente `api.php`-Routen ohne zusätzliche Pfadkonfiguration.

Die Routen von `api.php` liegen im Pfad hinter dem Skriptnamen
(`/plugins/mcp/api.php/v1/abilities`). Daher muss nginx URIs abgleichen, bei
denen auf `.php` ein weiterer Pfad folgt, die Pfadinformationen abtrennen und an
PHP übergeben. Ein Block `location ~ \.php$` trifft auf solche URLs nie zu;
nginx antwortet dann mit einer eigenen HTML-404-Seite. Das Location-Muster
sowie die beiden Path-Info-Zeilen unten wurden mit PHP-FPM verifiziert; die
übrigen Zeilen sind Standardkonfiguration:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Passen Sie die Zeilen `include` und `fastcgi_pass` an den Block an, der Cacti
bereits ausliefert. Fügen Sie diesem Block kein `try_files $fastcgi_script_name =404;`
hinzu: Dadurch wird `$fastcgi_path_info` gelöscht, und `api.php` antwortet
anschließend mit 404 `UNKNOWN_PATH`. Falls Ihre Konfiguration `try_files`
benötigt, speichern Sie den Wert zuvor mit `set $path_info $fastcgi_path_info;`
und übergeben Sie `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` besitzt keine Pfadrouten und benötigt diese Konfiguration nicht.

## Konsole

Management > MCP verfügt über drei Registerkarten. Sie benötigen dafür den
Realm **MCP Administration**. Die Screenshots hier und im Folgenden stammen aus
einem Cacti-Entwicklungs-Build mit Beispieldaten.

- **Abilities** listet jede registrierte Ability mit ihrem Plugin, ihrer
  Kategorie, dem benötigten Realm und dem Freigabestatus auf. Markieren Sie
  Zeilen und wählen Sie *Expose* (Freigeben) oder *Hide* (Ausblenden); vor der
  Übernahme erscheint eine Bestätigung. Integrierte `cacti-*`-Abilities sind
  standardmäßig freigegeben. Abilities anderer Plugins sind zunächst
  ausgeblendet, sodass bei der Installation eines Plugins nichts veröffentlicht
  wird, bis ein Administrator dies entscheidet. Die Freigabe schränkt den
  Zugriff lediglich ein: Ein Benutzer benötigt weiterhin den jeweiligen Realm der
  Ability.

  ![Registerkarte Abilities mit den integrierten Abilities, ihren Realms und ihrem Freigabestatus](../../images/console-abilities.png)
- **Tokens** listet Token mit Inhaber, Ersteller, Erstellungsdatum, Ablaufdatum,
  letzter Verwendung und Status (*Active*, *Expired*, *Revoked*) auf. Markieren
  Sie Zeilen und wählen Sie *Revoke*, um sie zu widerrufen. Widerrufene Token
  können nicht erneut verwendet werden. Über *Create Token* erstellen Sie ein
  neues Token.

  ![Registerkarte Tokens mit Token samt Inhaber, Ablaufdatum, letzter Verwendung und Status oberhalb des Formulars Create Token](../../images/console-tokens.png)
- **Audit** listet Audit-Einträge absteigend nach Aktualität auf und filtert nach
  Benutzer, Ability und Ergebnis.

  ![Registerkarte Audit mit Aufrufen samt Benutzer, Token, Ability und Ergebnis sowie Filtern](../../images/console-audit.png)

## Token

Ein persönliches Token liest Cacti im Namen seines Inhabers. Es hat das Format
`cmcp_pat_` gefolgt von 64 kleingeschriebenen Hexadezimalzeichen und trägt den
einzelnen Scope `abilities:read`. Was es sehen darf, wird durch die Cacti-Realms
und Geräteberechtigungen seines Inhabers bestimmt, nicht durch das Token selbst.
Der Inhaber muss ein aktivierter Benutzer mit dem Realm **MCP and Abilities API**
sein.

Token werden stets für einen Benutzer erstellt, laufen ab und können widerrufen
werden:

- **Konsole.** Management > MCP > Tokens > Create Token. Die Gültigkeitsdauer
  beträgt 1 bis 365 Tage und ist standardmäßig auf 90 Tage eingestellt. Das
  Token wird vom Server generiert und einmalig auf der Antwortseite angezeigt;
  kopieren Sie es daher sofort in Ihren Passwort- oder Secret-Manager. Sie
  können ein Token für sich selbst erstellen. Für einen anderen Benutzer ist
  zusätzlich der Realm Users/Groups erforderlich, da das Token Cacti als dieser
  Benutzer liest.
- **My MCP Tokens.** Jeder Benutzer mit dem Realm MCP and Abilities API kann
  seine eigenen Token verwalten (siehe unten).
- **Kommandozeile.** `tokens.php` läuft ausschließlich über die CLI unter einem
  Betriebssystemkonto, das Cacti administrieren darf. Es liest das Token aus der
  Umgebung, sodass der Wert niemals in einer Befehlszeile oder in der
  Prozessliste erscheint. Die Gültigkeitsdauer beträgt 1 bis 365 Tage und ist
  standardmäßig auf 30 Tage eingestellt. Das Erstellen und Widerrufen eines Tokens
  über die CLI wird ebenso auditiert wie in der Konsole, wobei der Inhaber des
  Tokens als Akteur eingetragen wird, da die CLI keinen Cacti-Benutzer hat; der
  Audit-Eintrag kennzeichnet die Aktion daher nicht als CLI-Aufruf. `--list`
  gibt alle Token als JSON aus (ID, Inhaber, Scopes, Zeitstempel,
  Widerrufs-Flag), jedoch niemals den Token-Wert; `--help` zeigt die
  Verwendungshinweise an.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Weder über die Konsole noch über die Kommandozeile oder My MCP Tokens können
Token für das Gastkonto, für deaktivierte Benutzer oder für Benutzer ohne den
Realm **MCP and Abilities API** erstellt werden. Cacti speichert die
Gast-Einstellung als Benutzername oder Benutzer-ID, und das Plugin löst beides
auf. Ein Token, dessen Inhaber zum Gastkonto wird, funktioniert bei der nächsten
Anfrage nicht mehr.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) benötigt keinen
Administrations-Realm: Der Zugriff ist durch den Realm **MCP and Abilities API**
abgedeckt, und der Menüeintrag erscheint nur für Benutzer, die diesen Realm
besitzen. Die Seite bezieht sich immer auf den angemeldeten Benutzer. Das
Cacti-Menü ist Teil der Konsole; Benutzer ohne Konsolenzugriff erreichen die
Seite daher direkt über ihre Adresse.

![Registerkarte My Tokens mit den Token des angemeldeten Benutzers und dem Erstellungsformular](../../images/my-tokens.png)

- **Tokens** listet Ihre Token auf, erstellt ein neues Token (1 bis 365 Tage,
  Standard: 90 Tage, einmalig in der Antwort angezeigt) und widerruft Ihre
  eigenen Token. Token anderer Benutzer können Sie weder einsehen noch widerrufen.
- **Activity** listet die von Ihnen ausgeführten Aktionen absteigend nach
  Aktualität auf: Aufrufe mit Ihren Token sowie von Ihnen vorgenommene
  Token-Änderungen.
- **Available Tools** listet die Abilities auf, die eines Ihrer Token aktuell
  verwenden kann – jeweils mit ID, Name und Beschreibung der Ability. Die Liste
  richtet sich nach Ihren Cacti-Berechtigungen und den von einem Administrator
  gewählten Freigabeeinstellungen.

  ![Liste Available Tools mit ID, Name und Beschreibung jeder Ability](../../images/my-tools.png)

Eine Installation, die vor der Einführung dieser Seite erfolgte, enthält eine
Realm-Dateiliste ohne `mcp_tokens.php`. Die Liste wird bei der Installation
registriert und beim Aktivieren oder Deaktivieren des Plugins nicht
aktualisiert. Deinstallieren Sie das Plugin, installieren Sie es erneut und
weisen Sie anschließend die Realms neu zu, da Cacti Realm-Zuweisungen bei der
Deinstallation eines Plugins entfernt.

In der Datenbank wird ausschließlich der SHA-256-Hash des Tokens gespeichert,
sodass ein verlorenes Token nicht wiederhergestellt werden kann; widerrufen Sie es
und erstellen Sie ein neues. Bei einer Rotation gehen Sie genauso vor: Erstellen
Sie ein neues Token, stellen Sie den Client um und widerrufen Sie anschließend das
alte Token. Ein abgelaufenes Token, ein widerrufenes Token, ein deaktivierter
Inhaber oder ein entzogener Realm führen jeweils bei der nächsten Anfrage zu
einem Fehler. Token werden ausschließlich im Header `Authorization: Bearer`
akzeptiert; ein Token im Query-String oder im Request-Body wird nicht akzeptiert.

## Client verbinden

Verwenden Sie den MCP-Endpunkt `https://cacti.example.com/cacti/plugins/mcp/mcp.php` und übergeben Sie das Token in einem `Authorization: Bearer`-Header. Speichern Sie das Token in einer Umgebungsvariable oder einem Secret-Manager und referenzieren Sie es aus der Client-Konfiguration heraus, statt seinen Wert direkt in eine Datei zu schreiben.

### Claude Code

Hinterlegen Sie den Endpunkt in einer projektbezogenen Datei `.mcp.json`, die das Token über seinen Namen referenziert. Claude Code expandiert `${VAR}` in `url` und `headers`, sodass die Datei kein Secret enthält und bedenkenlos committet werden kann. Exportieren Sie `CACTI_MCP_TOKEN` in der Umgebung, aus der Claude Code gestartet wird.

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

Sie können den Server auch über die Befehlszeile hinzufügen:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Bei doppelten Anführungszeichen expandiert Ihre Shell `$CACTI_MCP_TOKEN` zuerst, sodass der Token-Wert für den gewählten `--scope` (`local`, `user` oder `project`; Standardwert `local`) in die Konfigurationsdatei geschrieben wird. Verwenden Sie diese Form nicht mit `--scope project` und halten Sie die Datei aus der Versionskontrolle heraus. Bevorzugen Sie die oben gezeigte Referenz in `.mcp.json`. Claude Code liest einige Zugangsdaten-Variablen (wie `ANTHROPIC_AUTH_TOKEN`) in Remote-`url` und -`headers` als leer ein; `CACTI_MCP_TOKEN` gehört nicht dazu. Quelle:
[Claude Code MCP-Dokumentation](https://code.claude.com/docs/en/mcp).

### GitHub Copilot in VS Code

Verwenden Sie eine Datei `.mcp.json` im Workspace-Stammverzeichnis (oder die Benutzerdatei `~/.copilot/mcp-config.json`). Diese nativen Copilot-Dateien verwenden ein Top-Level-Objekt `mcpServers` und `${NAME}`-Umgebungsvariablenreferenzen in Header-Werten:

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

Exportieren Sie `CACTI_MCP_TOKEN` in der Umgebung, aus der VS Code gestartet wird. Native Copilot-Dateien unterstützen keine `inputs`-Eingabeaufforderungen. Die geführte Einrichtung von VS Code lehnt `${...}`-Werte ab; fügen Sie den `Authorization`-Header daher durch direktes Bearbeiten der Datei hinzu und nicht über den geführten Ablauf. Die geführte Einrichtung bietet die Datei im Workspace-Stammverzeichnis nur an, wenn die experimentelle Einstellung `chat.mcp.workspaceRootConfig.enabled` aktiviert ist. Siehe die
[VS Code-MCP-Konfigurationsreferenz](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Veraltet: `.vscode/mcp.json`.** Laut VS Code sollten neue Copilot-Konfigurationen weder `.vscode/mcp.json` noch die `mcp.json` des Profils verwenden; diese gehören zum veralteten Local-Harness, der im Februar 2027 entfernt wird. Falls Sie es weiterhin verwenden, erwartet das vom Editor verwaltete Format einen Top-Level-Schlüssel `servers` und kann das Token per Eingabeaufforderung abfragen:

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

### Clients, die nur stdio unterstützen

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ist ein optionaler Adapter, der als lokaler stdio-MCP-Server läuft und die HTTP-API des Plugins aufruft. Verwenden Sie ihn für Clients, die sich nicht mit einem Remote-HTTP-Server verbinden können. Er benötigt dasselbe persönliche Token und kommuniziert mit `api.php`.

### MCP-Verhalten

Der Endpunkt stellt ausschließlich Tools bereit: Jede freigegebene, zulässige Ability ist ein Tool mit ihrer ID als Namen, ihrem Eingabe- und Ausgabeschema sowie Read-only-Annotationen (`openWorldHint` ist `false`). Er unterstützt `initialize`, `server/discover`, `ping`, `tools/list` und `tools/call`. Er führt keine Sitzungen, sendet kein `Mcp-Session-Id` (und ignoriert ein empfangenes) und akzeptiert keine JSON-RPC-Batches. Eine Nachricht ohne `id` ist eine Benachrichtigung und erhält HTTP 202 ohne Body. Nur `POST` ist zulässig.

- **Revisionen.** Eine Anfrage, die `io.modelcontextprotocol/protocolVersion` in `params._meta` enthält, muss `2026-07-28` angeben; alles andere liefert den Fehler `-32022`. Solche Anfragen müssen außerdem passende Header `Mcp-Protocol-Version`, `Mcp-Method` und (für `tools/call`) `Mcp-Name` enthalten, andernfalls lautet die Antwort Fehler `-32020`. Andere Anfragen werden als `2025-11-25` behandelt: `initialize` antwortet mit dieser Revision, und bei jeder anderen Methode muss ein eventuell gesendeter `Mcp-Protocol-Version`-Header `2025-11-25`, `2025-06-18` oder `2025-03-26` sein.
- **Tool-Fehler.** Ein Ability-Fehler – einschließlich Argumenten, die nicht dem Schema entsprechen, oder eines `arguments`-Werts, der kein JSON-Objekt ist – wird als Tool-Ergebnis mit `isError: true` und dem AIP-193-Fehler in `structuredContent` zurückgegeben, nicht als Protokollfehler.
- **Protokollfehler.** Fehler, die keine Tool-Fehler sind, sind JSON-RPC-Fehlerobjekte (Code `-32000` mit Status und Begründung in `data` oder die Standardcodes): eine fehlende Public Cacti URL, ein abgelehnter `Origin`, eine Anfrage bei deaktiviertem Plugin oder auf einem Remote-Poller sowie unerwartete Serverfehler (`-32603`, wobei das Detail ins Cacti-Log geschrieben wird und nicht in die Antwort). Vorab ausgeführte Anfrageprüfungen (405, 413, 415) und Authentifizierungsfehler (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) behalten den unter HTTP-API beschriebenen AIP-193-Body bei.

## HTTP-API

Basis-URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Der Vertrag ist in [openapi.json](../../../openapi.json) definiert.

| Methode und Pfad | Zweck |
| --- | --- |
| `GET /v1/abilities` | Zulässige Abilities auflisten. Query-Parameter: `pageSize`, `pageToken` und `filter` in der Form `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Eine einzelne Ability abrufen. |
| `POST /v1/abilities/{id}:execute` | Ausführen. Der Body lautet exakt `{"arguments": {...}}`. Die Antwort lautet `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Fehler folgen AIP-193: ein `error`-Objekt mit `code`, `message`, `status` und `details`, das ein `ErrorInfo` mit der Domain `cacti.net` und einem stabilen `reason` enthält. Bei Argumentproblemen wird ein `BadRequest`-Detail ergänzt, das das betreffende Feld benennt. Anfrage-Bodies sind auf 64 KB und Ergebnisse auf 1 MB begrenzt. Beide Endpunkte antworten nur auf dem Main-Poller und geben `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) zurück, wenn das Plugin deaktiviert ist oder der Server nicht der Main-Poller ist.

| HTTP | `reason`-Werte |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (sendet außerdem `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (sendet `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Eine Ability schreiben (Plugin-Autoren)

Ein aktiviertes Cacti-Plugin registriert Abilities über eine Funktion, die es an den Hook `abilities_register` anhängt – üblicherweise in seiner `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Die Funktion erhält einen auf das Plugin begrenzten `AbilitiesRegistrar`. Ihr Rückgabewert wird ignoriert.

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

Die Regeln, die sämtlich bei der Registrierung durchgesetzt werden:

- **IDs.** Eine ID entspricht `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ist höchstens 64 Zeichen lang und muss mit dem Slug des Plugins und einem Bindestrich beginnen: oben `acme-`. Der Slug ist der Name des Plugin-Verzeichnisses, sodass ein Verzeichnis wie `my_plugin` nichts registrieren kann. Ein Plugin-Verzeichnis namens `cacti` wird abgelehnt; dieser Namensraum gehört den integrierten Abilities.
- **Definition.** Exakt diese Schlüssel: `label`, `description` (bis zu 4096 Bytes), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Die Kategorie muss bereits existieren: Verwenden Sie eine integrierte Kategorie (`inventory`, `system`) oder registrieren Sie eine eigene mit `registerCategory()`, deren ID pluginübergreifend eindeutig ist und `^[a-z][a-z0-9-]{0,31}$` entspricht.
- **Nur Read-only.** `annotations` muss exakt `readOnly: true`, `destructive: false`, `idempotent: true` sein. Alles andere wirft eine Ausnahme.
- **Schemas.** `input_schema` und `output_schema` müssen jeweils als Top-Level-`type` `object` haben. Der Dialekt ist bewusst klein gehalten und schlägt im Zweifel sicher fehl (fail closed). Objekte müssen geschlossen sein (`additionalProperties: false`, wobei `properties` vorhanden sein muss); weitere Typen sind `integer` und `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean` und `array` (das `items` und `maxItems` benötigt). Ein Typ kann als `['string', 'null']` nullable gemacht werden. Argument-Strings sind standardmäßig auf höchstens 4096 Zeichen begrenzt; Ergebnis-Strings sind nur durch ein deklariertes `maxLength` und das Limit für die Ergebnisgröße begrenzt. Es können höchstens 256 Abilities registriert werden.
- **`permission(int $userId): bool`.** Muss exakt `true` zurückgeben, um den Zugriff zu erlauben. Die Benutzer-ID ist die des Token-Eigentümers; lesen Sie niemals den Sitzungsstatus aus.
- **`execute(int $userId, stdClass $args): array`.** `$args` ist bereits gegen `input_schema` validiert. Setzen Sie Berechtigungen auf Objektebene selbst durch. Geben Sie ein assoziatives Array zurück, das exakt zu `output_schema` passt; eine Liste, ein zusätzliches Feld oder mehr als 1 MB JSON führt zu einem `INVALID_RESULT`-Fehler. Werfen Sie `AbilitiesError` für einen für den Client sichtbaren Fehler wie `NOT_FOUND`.
- **Leere Objekte.** PHP kodiert `[]` als JSON-Array. Überall dort, wo das Ausgabeschema ein `object` deklariert – auf beliebiger Tiefe –, behandelt die Registry `[]` als leeres Objekt und sendet `{}`; `new stdClass()` funktioniert ebenfalls. Eine nicht leere Liste zählt niemals als Objekt und schlägt mit `INVALID_RESULT` fehl. Eine leere `properties`-Map in einem Schema darf `[]` oder `new stdClass()` sein; beide werden als `{}` veröffentlicht.
- **Fehlerisolation.** Jedes Plugin registriert in eine Arbeitskopie, die nur übernommen wird, wenn Ihre Funktion normal zurückkehrt. Wenn sie eine Ausnahme wirft, wird keine Ihrer Abilities registriert und der Fehler wird protokolliert.

Abilities aus Plugins sind zunächst ausgeblendet. Der Administrator gibt sie in der Konsole auf dem Tab „Abilities“ frei, und in der Spalte „Required Realm“ steht dort für sie „Set by the plugin“.

## Sicherheitsmodell

- **Ausschließlich Bearer-Token.** `api.php` und `mcp.php` akzeptieren ein persönliches Token im
  `Authorization`-Header und nichts anderes. Sie verwerfen Cookies, `$_POST` und
  `$_REQUEST`, bevor Cacti geladen wird, und beenden die von Cacti gestartete Sitzung, sodass eine
  Browser-Anmeldung niemals API-Zugriff gewährt.
- **CSRF-Workaround.** Der CSRF-Schutz von Cacti lehnt einen JSON-POST-Request ohne Cacti-CSRF-Token
  ab, den kein MCP-Client senden kann. Ausschließlich für diese beiden Endpunkte benennt das Plugin
  die Request-Methode vor dem Laden von Cacti um und stellt sie anschließend wieder her, sodass der
  Schutz sie überspringt. Dies ist sicher, da CSRF Anfragen schützt, die ein Browser mit Cookies
  authentifiziert, und diese Endpunkte keine Cookie-Identität akzeptieren: Eine Cross-Site-Seite
  kann das Bearer-Token nicht anhängen. Konsolenseiten behalten den vollständigen CSRF-Schutz. Der
  Workaround ist vorübergehend, bis Cacti eine unterstützte Ausnahme bereitstellt; siehe
  `lib/bootstrap.php`.
- **Origin-Prüfung.** Bei `mcp.php` muss ein eventuell vorhandener `Origin`-Header exakt dem Schema,
  Host und Port der öffentlichen Cacti-URL entsprechen, andernfalls wird die Anfrage mit
  `ORIGIN_NOT_ALLOWED` abgelehnt. Eine Anfrage ohne `Origin`-Header – wie sie Nicht-Browser-Clients
  verwenden – ist zulässig. Dies verhindert, dass eine Webseite den Endpunkt über den Browser eines
  Besuchers ansteuert. `api.php` wendet diese Prüfung nicht an.
- **Nur schreibgeschützt.** Die Registrierung lehnt jede Ability ab, die nicht schreibgeschützt,
  nicht destruktiv und idempotent ist.
- **Freigabe und Berechtigungsbereiche (Realms) gelten gemeinsam.** Eine Ability muss freigegeben
  sein und der Token-Inhaber muss den zugehörigen Realm besitzen. Wenn die Freigabetabelle nicht
  gelesen werden kann, werden alle Abilities ausgeblendet, statt auf Standardwerte zurückzufallen.
- **Ausgeblendete, unbekannte und nicht zulässige Abilities wirken identisch.** Ein Client kann nicht
  zwischen einer nicht existierenden, einer ausgeblendeten oder einer für seinen Benutzer nicht
  freigegebenen Ability unterscheiden: Bei der Discovery wird sie ausgelassen und die Ausführung
  liefert `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Token.** Als SHA-256-Hashes gespeichert, einmalig angezeigt, immer mit Ablaufdatum, widerrufbar
  und ungültig, sobald der Inhaber deaktiviert wird oder den Realm verliert.
- **Audit.** `plugin_mcp_audit` protokolliert Request-ID, Token-ID, Benutzer-ID, Ability, Ergebnis
  (`started`, `succeeded`, `failed`, `denied`, `rejected`) sowie Zeitstempel. Argumente, Ergebnisse
  oder Token-Werte werden niemals aufgezeichnet. Eine Ability wird erst ausgeführt, nachdem der
  `started`-Eintrag geschrieben wurde; ist die Audit-Tabelle nicht verfügbar, schlägt der Aufruf mit
  `UNAVAILABLE` fehl und wird nicht ausgeführt. Ein vor der Ausführung abgelehnter Aufruf erzeugt
  genau einen Eintrag: `denied` für eine unbekannte, ausgeblendete oder nicht zulässige Ability,
  `rejected` für Argumente, die das Schema nicht erfüllen. Das Erstellen und Widerrufen von Token
  über die Konsole, Meine MCP-Token und die CLI wird als `mcp-token-create` bzw. `mcp-token-revoke`
  mit dem Ergebnis `succeeded` protokolliert; ein Widerruf wird nur für ein aktives Token
  aufgezeichnet. Discovery-Aufrufe sowie Aufrufe, deren `arguments` kein JSON-Objekt ist, werden
  nicht protokolliert.
- **Fehlerprotokoll.** Ein unerwarteter Fehler, `INVALID_RESULT` oder eine nicht verfügbare
  Audit-Tabelle schreibt eine einzelne Zeile mit der Facility `MCP` in das Cacti-Protokoll: die
  Ability-ID, einen festen Grund und die Exception-Klasse. Meldungen, Argumente und Token werden
  niemals protokolliert.
- **Nur Haupt-Poller.** Beide Endpunkte, beide Konsolenseiten und `tokens.php` verweigern die
  Ausführung an jeder anderen Stelle.

## Lebenszyklus

Das Deaktivieren des Plugins sperrt beide Endpunkte. Bei der Deinstallation werden alle Token
widerrufen; die drei Tabellen (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`)
bleiben jedoch zur Aufbewahrung erhalten. Eine Neuinstallation reaktiviert kein widerrufenes Token.
Sichern Sie die Tabellen zusammen mit der Cacti-Datenbank und wenden Sie außerhalb des Plugins eine
Aufbewahrungsrichtlinie für Audit-Daten an.

## Entwicklung und Tests

Die Testsuite umfasst einfache PHP-Skripte in `tests/` sowie PHPUnit-Unit-Tests in
`tests/Unit/` und statische Analyse mit PHPStan (Stufe 6), die alle ohne eine
Cacti-Installation ausgeführt werden:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

Die CI läuft unter PHP 8.2 bis 8.5: ein `test`-Job, der die PHP-Syntax prüft (`php -l`)
und die 13 in `.github/workflows/ci.yml` aufgeführten einfachen PHP-Testskripte ausführt,
ein `quality`-Job, der `composer phpstan` und `composer test` ausführt, sowie ein
`package`-Job, der das installierbare `mcp/`-Archiv (ohne die in `.gitattributes`
aufgeführten Entwicklungs- und Testdateien) samt `SHA256SUMS` erstellt. Tests, die Cacti
berühren, verwenden Fixtures an der Cacti-Hilfsschnittstelle; sie testen keine
vollständige Cacti-Installation.

### Integrationstests

`tests/integration/run.sh 1.2.31` oder `tests/integration/run.sh develop` installiert das Plugin
in einer echten Cacti-Instanz in Containern und führt Live-Prüfungen dagegen aus. Dafür sind Docker
mit Compose v2.23.1 oder neuer, git und openssl erforderlich. `KEEP=1` lässt den Stack für das
Debugging weiterlaufen. Die CI führt diese Tests nächtlich und bei Bedarf aus, nicht bei Pull
Requests.

## Lokalisierung

Cacti MCP liefert kompilierte GNU-gettext-Kataloge unter `locales/po/` und `locales/LC_MESSAGES/`
sowie lokalisierte READMEs unter `docs/i18n/` für Englisch plus 47 Sprachen/Regionen (19 Broad Tier 1-, 15 afrikanische, 10 asiatische sowie bosnische, kroatische und serbische Locales) unter Verwendung der Textdomäne `mcp`
(`locales/po/mcp.pot`). Cacti lädt den passenden Katalog automatisch, wenn die Sprachunterstützung
aktiviert ist.

## Mitwirken

Pull Requests richten sich an `develop`. Halten Sie den Produktivcode kompatibel mit PHP 8.2 und
verwenden Sie den Cacti-Stil: Tabulatoren, einfach angeführte Zeichenketten sowie die Datenbank- und
Berechtigungshelfer von Cacti. Fügen Sie Tests für geändertes Validierungs-, Autorisierungs- oder
Protokollverhalten hinzu und signieren Sie Commits mit `git commit -s`. Stimmen Sie Änderungen an
der HTTP-API mit [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ab.

## Lizenz

Copyright (C) 2026 Thomas Vincent. Veröffentlicht unter der GNU General Public
License, Version 2 oder höher. Siehe [LICENSE](../../../LICENSE).
