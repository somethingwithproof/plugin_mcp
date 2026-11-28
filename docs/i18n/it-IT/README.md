<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: un cactus con uno scudo. Scopri. Autorizza. Esegui.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="License: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP è un plugin per Cacti che consente ai client AI di leggere i dati di
Cacti tramite operazioni denominate e filtrate per autorizzazione, chiamate
abilità. Il plugin stesso le espone in due modalità: un endpoint MCP (`mcp.php`,
Streamable HTTP) e un'API HTTP in stile AIP (`api.php`). Cacti mantiene il
controllo su autorizzazione ed esecuzione. Un client non interroga mai
direttamente il database; può richiamare esclusivamente un'abilità esposta da un
amministratore e consentita dai realm Cacti del titolare del token.

Gli autori di plugin possono registrare le proprie abilità di sola lettura
tramite l'hook `abilities_register`, rendendole disponibili ai client MCP come
strumenti senza dover scrivere codice di protocollo.

**Stato: pre-rilascio, versione 0.1.0.** Non è presente alcun rilascio con tag.

Funzionalità disponibili attualmente:

- Nove abilità integrate di sola lettura che coprono versioni di sistema,
  dispositivi, siti, poller, alberi dei grafici, grafici, origini dati e una
  coda delimitata e oscurata del log di Cacti.
- Token di accesso personali (`cmcp_pat_...`) come unica credenziale.
- La console Management > MCP: esporre o nascondere abilità, creare e revocare
  token, consultare il registro di audit.
- Management > My MCP Tokens: gli utenti gestiscono i propri token, visualizzano
  la propria attività e verificano quali strumenti possono utilizzare i propri
  token.
- MCP su Streamable HTTP, revisioni del protocollo `2026-07-28` e `2025-11-25`,
  solo strumenti.

Funzionalità non ancora disponibili:

- Accesso OAuth 2.1. I connettori ospitati che non possono inviare un token
  personale, come i connettori personalizzati di ChatGPT e claude.ai, non
  possono connettersi finché non sarà disponibile. È pianificato come Piano 2;
  tale piano non è ancora stato redatto.
- Abilità di scrittura. È possibile registrare esclusivamente abilità di sola
  lettura.

La progettazione è descritta nella
[specifica di progettazione dell'endpoint](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)
e la sequenza di sviluppo è riportata in [docs/plan.md](../../plan.md).

## Abilità integrate

| ID | Categoria | Argomenti | Realm Cacti necessario |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | nessuno | 15 |
| `cacti-list-devices` | `inventory` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | obbligatorio `name`, ad esempio `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 7 o 4 |
| `cacti-list-graphs` | `inventory` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 7 o 5 |
| `cacti-list-data-sources` | `inventory` | opzionali `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | opzionali `lines` (da 1 a 200, predefinito 50), `severity`, `search` | 19 o 18 |

Ogni chiamata richiede inoltre il realm **MCP and Abilities API** per il titolare
del token, lo scope `abilities:read` (presente in ogni token personale) e
un'abilità esposta. La scheda Abilities della console mostra il realm primario
necessario per ciascuna abilità integrata.

Tutte e sei le abilità `cacti-list-*` restituiscono pagine fino a 100 elementi
(valore predefinito 50) e un `nextPageToken`. Un token di pagina è valido solo
per gli stessi `filter` e `orderBy`. `filter` è un'espressione AIP-160 composta
da confronti (`=`, `!=`, `<`, `<=`, `>`, `>=`) uniti con `AND`, ad esempio
`state = "DOWN" AND disabled = false`. `orderBy` accetta un elenco separato da
virgole di campi ordinabili, ciascuno seguito opzionalmente da `asc` o `desc`.

| Abilità | Campi filtro | Campi di ordinamento |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Ambito dei permessi ed esclusione dei segreti:

- `cacti-list-devices` e `cacti-get-device` eseguono query attraverso
  `get_allowed_devices()` di Cacti ed escludono stringhe di community SNMP,
  passphrase e altre credenziali.
- `cacti-list-trees` esegue query attraverso `get_allowed_trees()` (e filtra con
  `is_tree_allowed()` quando disponibile); `cacti-list-graphs` esegue query
  attraverso `get_allowed_graphs()` (e filtra con `is_graph_allowed()` quando
  disponibile).
- `cacti-list-data-sources` limita le righe ai dispositivi consentiti al
  chiamante da `get_allowed_devices()` (e `is_device_allowed()` quando
  disponibile) e restituisce solo metadati senza interrogare `data_input_data` né
  esporre valori di input segreti.
- `cacti-list-pollers` esclude le credenziali del database (`dbpass`, `dbuser`) e
  le colonne di chiavi e certificati TLS (`dbsslkey`, `dbsslcert`, `dbsslca`).
- `cacti-get-clog` legge fino all'ultimo 1 MiB del log Cacti configurato
  (troncando le singole righe oltre 2048 byte), filtra per `severity` (`ALL`,
  `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`,
  `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`; predefinito `ALL`) e per
  `search` senza distinzione tra maiuscole e minuscole (fino a 256 caratteri),
  e restituisce `lines`, `count` e `truncated`. Ogni riga viene oscurata per
  rimuovere token personali, intestazioni bearer/basic, password, segreti,
  community SNMP, chiavi, `dbpass`, `dbsslkey` e informazioni utente negli URL
  prima dell'esecuzione dei filtri `severity` e `search`, in modo che `search`
  non possa fungere da oracolo dei segreti. L'oscuramento adotta il comportamento
  fail-closed con `[redacted]` e un log illeggibile restituisce
  `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Installazione

Richiede Cacti 1.2.31 o successivo, PHP 8.2 o successivo e il poller principale.
L'autenticazione di Cacti deve essere abilitata; il plugin rifiuta
l'autenticazione quando è disattivata.

La directory del plugin deve chiamarsi `mcp`, non `plugin_mcp`. Lo slug del
plugin, i nomi dei realm, il dominio di traduzione e gli URL utilizzano tutti
`mcp`.

Da un checkout dei sorgenti:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Finché non saranno disponibili rilasci con tag, è possibile scaricare
l'artefatto `mcp-plugin` da un'
[esecuzione CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
riuscita. Contiene `mcp.tar.gz` e `SHA256SUMS`. Verificare il checksum, quindi
estrarre `mcp.tar.gz` nella directory `plugins/` di Cacti in modo da ottenere
`plugins/mcp/`. Gli archivi sorgente automatici di GitHub utilizzano un nome di
directory principale diverso. L'archivio omette `docs/` (incluse le schermate
riportate di seguito), `tests/` e `.github/`, pertanto i collegamenti del README
verso `docs/` funzionano su GitHub ma non in una copia installata.

Successivamente:

1. In Plugin Management, installare e abilitare **Cacti MCP**. L'amministratore
   che esegue l'installazione riceve automaticamente il realm
   **MCP Administration**.
2. In Settings > MCP, impostare **Public Cacti URL** sull'indirizzo utilizzato
   dai client, ad esempio `https://cacti.example.com/cacti`. È richiesto HTTPS,
   ad eccezione di `localhost`, `127.0.0.1` e `[::1]`. Finché questo campo non è
   impostato, `mcp.php` risponde con HTTP 400 e un errore JSON-RPC il cui campo
   `data` contiene `FAILED_PRECONDITION` e `PUBLIC_URL_REQUIRED`. `api.php` non
   legge questo valore.

   ![Settings > MCP con il campo Public Cacti URL](../../images/settings-public-url.png)

3. Assegnare il realm **MCP and Abilities API** a ciascun utente che possiederà
   un token. Nessun utente lo riceve automaticamente.
4. Assicurarsi che il server web inoltri l'header `Authorization` e le
   informazioni sul percorso a PHP (vedere di seguito).
5. Aprire Management > MCP ed esporre le abilità che si desidera rendere
   visibili ai client.

**Aggiornamento da una build di sviluppo.** Il plugin è in fase di pre-rilascio
e le sue tabelle sono cambiate durante lo sviluppo senza migrazioni. Se è stata
installata una build precedente, disinstallarla e installarla nuovamente. La
reinstallazione mantiene le tabelle già esistenti, quindi eliminare prima le
vecchie tabelle `plugin_mcp_token`, `plugin_mcp_audit` e `plugin_mcp_ability`
(nonché le tabelle equivalenti delle build precedenti alla ridenominazione).
Eseguirne il backup se è necessario conservarne la cronologia; i token di tali
build vengono revocati alla disinstallazione e non vengono mantenuti.

### Server web

Le configurazioni di Apache che rimuovono `Authorization` prima di PHP
richiedono questa direttiva nel virtual host o nella directory pertinente,
seguita da un ricaricamento:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache con `mod_php` gestisce le route di `api.php` senza alcuna configurazione
aggiuntiva del percorso.

Le route di `api.php` si trovano nel percorso dopo il nome dello script
(`/plugins/mcp/api.php/v1/abilities`), pertanto nginx deve intercettare gli URI
in cui `.php` è seguito da altro percorso, separare il path info e passarlo a
PHP. Un blocco `location ~ \.php$` non corrisponde mai a questi URL; nginx
risponde con la propria pagina HTML 404. Il pattern `location` e le due righe
per il path info riportate di seguito sono stati verificati con PHP-FPM; le altre
righe costituiscono la configurazione standard di base:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Adattare le righe `include` e `fastcgi_pass` affinché corrispondano al blocco
che già serve Cacti. Non aggiungere `try_files $fastcgi_script_name =404;` a
questo blocco: azzera `$fastcgi_path_info` e `api.php` risponde con 404
`UNKNOWN_PATH`. Se la configurazione richiede `try_files`, salvare prima il
valore con `set $path_info $fastcgi_path_info;` e passare
`fastcgi_param PATH_INFO $path_info;`.

`mcp.php` non dispone di route di percorso e non necessita di queste direttive.

## Console

Management > MCP dispone di tre schede. È necessario il realm
**MCP Administration**. Le schermate riportate qui e di seguito provengono da una
build di sviluppo di Cacti con dati di esempio.

- **Abilities** elenca ogni abilità registrata con il relativo plugin, la
  categoria, il realm richiesto e se è esposta. Selezionare le righe e scegliere
  Expose o Hide; è richiesta una conferma prima di applicare la modifica. Le
  abilità integrate `cacti-*` sono esposte per impostazione predefinita. Le
  abilità di altri plugin sono inizialmente nascoste, in modo che
  l'installazione di un plugin non pubblichi nulla finché un amministratore non
  lo decida. L'esposizione può solo restringere l'accesso: un utente necessita
  comunque del realm dell'abilità.

  ![Scheda Abilities con l'elenco delle abilità integrate, i relativi realm e lo stato di esposizione](../../images/console-abilities.png)
- **Tokens** elenca i token con titolare, autore della creazione, data di
  creazione, scadenza, ultimo utilizzo e stato (Active, Expired, Revoked).
  Selezionare le righe e scegliere Revoke per revocarli. I token revocati non
  possono più essere utilizzati. Create Token genera un nuovo token.

  ![Scheda Tokens con l'elenco dei token con titolare, scadenza, ultimo utilizzo e stato, sopra il modulo Create Token](../../images/console-tokens.png)
- **Audit** elenca le righe di audit, dalla più recente, e consente di filtrare
  per utente, abilità ed esito.

  ![Scheda Audit con l'elenco delle chiamate con utente, token, abilità ed esito, dotata di filtri](../../images/console-audit.png)

## Token

Un token personale accede a Cacti con i permessi del proprio titolare. Ha il
formato `cmcp_pat_` seguito da 64 caratteri esadecimali minuscoli e possiede
l'unico scope `abilities:read`. Ciò che può visualizzare è determinato dai realm
Cacti e dai permessi sui dispositivi del titolare, non dal token. Il titolare
deve essere un utente abilitato in possesso del realm **MCP and Abilities API**.

I token vengono sempre creati per un utente, hanno una scadenza e possono essere
revocati:

- **Console.** Management > MCP > Tokens > Create Token. La durata va da 1 a 365
  giorni e il valore predefinito è 90. Il token viene generato dal server e
  mostrato una sola volta nella pagina di risposta, pertanto copiarlo
  immediatamente nel proprio gestore di segreti. È possibile creare un token per
  sé stessi. Creare un token per un altro utente richiede anche il realm
  Users/Groups, poiché il token legge Cacti come quell'utente.
- **My MCP Tokens.** Qualsiasi utente dotato del realm MCP and Abilities API può
  gestire i propri token; vedere di seguito.
- **Riga di comando.** `tokens.php` viene eseguito esclusivamente da CLI, con un
  account del sistema operativo in grado di amministrare Cacti. Legge il token
  dall'ambiente in modo che il valore non compaia mai sulla riga di comando o
  nell'elenco dei processi. La durata va da 1 a 365 giorni e il valore
  predefinito è 30. La creazione e la revoca di un token tramite CLI sono
  registrate nell'audit come nella console, con il titolare del token come
  attore perché la CLI non dispone di un utente Cacti, pertanto la riga di audit
  non indica che l'azione proviene dalla CLI. `--list` stampa ogni token in
  formato JSON (ID, titolare, scope, timestamp, flag di revoca) e mai il valore
  del token; `--help` mostra le istruzioni d'uso.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Non è possibile creare token per l'account guest, per utenti disabilitati o per
utenti privi del realm **MCP and Abilities API**, né dalla console, né da riga di
comando, né da My MCP Tokens. Cacti memorizza l'impostazione dell'account guest
come nome utente o come ID utente, e il plugin risolve entrambi. Un token il cui
titolare diventa l'account guest smette di funzionare alla richiesta successiva.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) non richiede alcun
realm di amministrazione: è coperto dal realm **MCP and Abilities API** e la
voce di menu compare solo per gli utenti che lo possiedono. La pagina opera
sempre sull'utente autenticato. Il menu di Cacti fa parte della console,
pertanto un utente privo di accesso alla console raggiunge la pagina tramite il
suo indirizzo.

![Scheda My Tokens con l'elenco dei token dell'utente autenticato e il modulo di creazione](../../images/my-tokens.png)

- **Tokens** elenca i propri token, consente di crearne uno (da 1 a 365 giorni,
  predefinito 90, mostrato una sola volta nella risposta) e di revocare i propri.
  Non è possibile visualizzare o revocare i token di altri utenti.
- **Activity** elenca le azioni eseguite, dalla più recente: chiamate effettuate
  con i propri token e modifiche apportate ai token.
- **Available Tools** elenca le abilità che un proprio token può utilizzare in
  quel momento, con ID, nome e descrizione di ciascuna abilità. Segue i permessi
  Cacti dell'utente e le impostazioni di esposizione scelte da un amministratore.

  ![Elenco Available Tools con ID, nome e descrizione di ciascuna abilità](../../images/my-tools.png)

Un'installazione effettuata prima dell'introduzione di questa pagina presenta un
elenco di file del realm privo di `mcp_tokens.php`. L'installazione registra
l'elenco; questo non viene aggiornato abilitando o disabilitando il plugin.
Disinstallare e installare nuovamente il plugin, quindi riassegnare i realm,
poiché Cacti rimuove le assegnazioni dei realm quando un plugin viene
disinstallato.

Il database memorizza esclusivamente l'hash SHA-256 del token, pertanto un token
smarrito non può essere recuperato; revocarlo e crearne un altro. La rotazione
segue lo stesso procedimento: creare un nuovo token, aggiornare il client,
quindi revocare quello precedente. Un token scaduto, un token revocato, un
titolare disabilitato o la perdita di un realm provocano ciascuno il fallimento
alla richiesta successiva. I token sono accettati esclusivamente nell'header
`Authorization: Bearer`; un token nella query string o nel corpo non viene
accettato.

## Connessione di un client

Utilizzare l'endpoint MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, passando il token in un'intestazione `Authorization: Bearer`. Conservare il token in una variabile d'ambiente o in un gestore di segreti e farvi riferimento dalla configurazione del client anziché scriverne il valore in un file.

### Claude Code

Inserire l'endpoint in un file `.mcp.json` di progetto che faccia riferimento al token per nome. Claude Code espande `${VAR}` in `url` e `headers`, quindi il file non contiene alcun segreto e può essere sottoposto a commit in sicurezza. Esportare `CACTI_MCP_TOKEN` nell'ambiente da cui viene avviato Claude Code.

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

È inoltre possibile aggiungerlo dalla riga di comando:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Con le virgolette doppie, la shell espande prima `$CACTI_MCP_TOKEN`, quindi il valore del token viene scritto nel file di configurazione per il `--scope` scelto (`local`, `user` o `project`; impostazione predefinita `local`). Non utilizzare questa forma con `--scope project` ed escludere il file dal controllo di versione. Preferire il riferimento in `.mcp.json` indicato sopra. Claude Code legge alcune variabili di credenziali (come `ANTHROPIC_AUTH_TOKEN`) come vuote in `url` e `headers` remoti; `CACTI_MCP_TOKEN` non è tra queste. Fonte: [documentazione MCP di Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot in VS Code

Utilizzare un file `.mcp.json` nella radice dell'area di lavoro (oppure il file utente `~/.copilot/mcp-config.json`). Questi file nativi di Copilot utilizzano un oggetto di primo livello `mcpServers` e riferimenti a variabili d'ambiente `${NAME}` nei valori delle intestazioni:

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

Esportare `CACTI_MCP_TOKEN` nell'ambiente da cui viene avviato VS Code. I file nativi di Copilot non supportano i prompt `inputs`. La configurazione guidata di VS Code rifiuta i valori `${...}`, quindi aggiungere l'intestazione `Authorization` modificando direttamente il file e non tramite la procedura guidata. La configurazione guidata propone il file nella radice dell'area di lavoro solo quando l'impostazione sperimentale `chat.mcp.workspaceRootConfig.enabled` è attiva. Consultare il [riferimento alla configurazione MCP di VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Legacy: `.vscode/mcp.json`.** Secondo VS Code, le nuove configurazioni di Copilot non dovrebbero utilizzare `.vscode/mcp.json` né il file `mcp.json` del profilo; essi appartengono al Local harness deprecato, che verrà rimosso a febbraio 2027. Se lo si utilizza ancora, il formato gestito dall'editor accetta una chiave di primo livello `servers` e può richiedere il token tramite prompt:

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

### Client che supportano solo stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) è un adattatore opzionale che viene eseguito come server MCP locale su stdio e richiama l'API HTTP del plugin. Utilizzarlo per un client che non può connettersi a un server HTTP remoto. Richiede lo stesso token personale e comunica con `api.php`.

### Comportamento MCP

L'endpoint espone esclusivamente strumenti (tool): ogni ability esposta e consentita è uno strumento identificato dal proprio ID, con i relativi schemi di input e output e annotazioni di sola lettura (`openWorldHint` è `false`). Gestisce `initialize`, `server/discover`, `ping`, `tools/list` e `tools/call`. Non mantiene alcuna sessione, non invia `Mcp-Session-Id` (e ignora quello eventualmente ricevuto) e non accetta batch JSON-RPC. Un messaggio privo di `id` è una notifica e riceve una risposta HTTP 202 senza corpo. È consentito solo il metodo `POST`.

- **Revisioni.** Una richiesta che contiene `io.modelcontextprotocol/protocolVersion` in `params._meta` deve specificare `2026-07-28`; qualsiasi altro valore restituisce l'errore `-32022`. Tali richieste devono inoltre includere intestazioni corrispondenti `Mcp-Protocol-Version`, `Mcp-Method` e (per `tools/call`) `Mcp-Name`, altrimenti la risposta è l'errore `-32020`. Le altre richieste vengono trattate come `2025-11-25`: `initialize` risponde con tale revisione e, per qualsiasi altro metodo, un'eventuale intestazione `Mcp-Protocol-Version` inviata deve essere `2025-11-25`, `2025-06-18` o `2025-03-26`.
- **Errori degli strumenti.** Un errore di un'ability, inclusi argomenti non conformi allo schema o un valore di `arguments` che non è un oggetto JSON, viene restituito come risultato dello strumento con `isError: true` e l'errore AIP-193 in `structuredContent`, non come errore di protocollo.
- **Errori di protocollo.** I guasti che non sono errori degli strumenti sono oggetti di errore JSON-RPC (codice `-32000` con stato e motivo in `data`, oppure i codici standard): URL pubblico di Cacti mancante, `Origin` rifiutato, richiesta con il plugin disabilitato o su un poller remoto ed errori imprevisti del server (`-32603`, con i dettagli scritti nel log di Cacti e non nella risposta). I controlli preliminari della richiesta (405, 413, 415) e gli errori di autenticazione (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) mantengono il corpo AIP-193 descritto nella sezione API HTTP.

## API HTTP

URL di base: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Il contratto è definito in [openapi.json](../../../openapi.json).

| Metodo e percorso | Scopo |
| --- | --- |
| `GET /v1/abilities` | Elenca le ability consentite. Query: `pageSize`, `pageToken` e `filter` nella forma `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Legge una singola ability. |
| `POST /v1/abilities/{id}:execute` | La esegue. Il corpo è esattamente `{"arguments": {...}}`. La risposta è `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Gli errori seguono AIP-193: un oggetto `error` con `code`, `message`, `status` e `details` che include un elemento `ErrorInfo` con dominio `cacti.net` e un `reason` stabile. I problemi relativi agli argomenti aggiungono un dettaglio `BadRequest` che indica il nome del campo. I corpi delle richieste sono limitati a 64 KB e i risultati a 1 MB. Entrambi gli endpoint rispondono esclusivamente sul poller principale e restituiscono `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) quando il plugin è disabilitato o il server non è il poller principale.

| HTTP | Valori di `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (invia anche `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (invia `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Scrittura di un'ability (autori di plugin)

Un plugin di Cacti abilitato registra le ability tramite una funzione collegata all'hook `abilities_register`, solitamente nella propria funzione `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

La funzione riceve un oggetto `AbilitiesRegistrar` con ambito limitato al plugin. Il suo valore di ritorno viene ignorato.

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

Le regole, tutte applicate al momento della registrazione, sono le seguenti:

- **ID.** Un ID soddisfa l'espressione regolare `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ha una lunghezza massima di 64 caratteri e deve iniziare con lo slug del plugin seguito da un trattino: `acme-` nell'esempio precedente. Lo slug corrisponde al nome della directory del plugin, pertanto una directory come `my_plugin` non può registrare nulla. Una directory del plugin denominata `cacti` viene rifiutata; tale namespace appartiene alle ability integrate.
- **Definizione.** Esattamente queste chiavi: `label`, `description` (fino a 4096 byte), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. La categoria deve esistere già: utilizzare una categoria integrata (`inventory`, `system`) oppure registrarne una propria con `registerCategory()`, il cui ID è univoco tra tutti i plugin e soddisfa `^[a-z][a-z0-9-]{0,31}$`.
- **Solo sola lettura.** `annotations` deve essere esattamente `readOnly: true`, `destructive: false`, `idempotent: true`. Qualsiasi altro valore genera un'eccezione.
- **Schemi.** `input_schema` e `output_schema` devono avere entrambi `type` di primo livello impostato su `object`. Il dialetto è ridotto e applica il criterio fail-closed. Gli oggetti devono essere chiusi (`additionalProperties: false`, con `properties` presente); gli altri tipi supportati sono `integer` e `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean` e `array` (che richiede `items` e `maxItems`). Un tipo può essere reso nullable come `['string', 'null']`. Per impostazione predefinita, le stringhe degli argomenti hanno una lunghezza massima di 4096 caratteri; le stringhe nei risultati sono limitate solo da un `maxLength` dichiarato e dal limite di dimensione del risultato. È possibile registrare al massimo 256 ability.
- **`permission(int $userId): bool`.** Deve restituire esattamente `true` per consentire l'esecuzione. L'ID utente è quello del proprietario del token; non leggere mai lo stato della sessione.
- **`execute(int $userId, stdClass $args): array`.** `$args` è già convalidato rispetto a `input_schema`. Applicare autonomamente i permessi a livello di oggetto. Restituire un array associativo che corrisponda esattamente a `output_schema`; una lista, un campo aggiuntivo o più di 1 MB di JSON genera un errore `INVALID_RESULT`. Lanciare `AbilitiesError` per un errore visibile al client, come `NOT_FOUND`.
- **Oggetti vuoti.** PHP codifica `[]` come array JSON. Ovunque lo schema di output dichiari un `object`, a qualsiasi profondità, il registro tratta `[]` come oggetto vuoto e invia `{}`; funziona anche `new stdClass()`. Una lista non vuota non viene mai considerata un oggetto e fallisce con `INVALID_RESULT`. Una mappa `properties` vuota in uno schema può essere `[]` o `new stdClass()`; entrambe vengono pubblicate come `{}`.
- **Isolamento dei guasti.** Ciascun plugin esegue la registrazione su una copia temporanea che viene mantenuta solo se la funzione termina normalmente. Se viene lanciata un'eccezione, nessuna delle ability del plugin viene registrata e l'errore viene registrato nel log.

Le ability dei plugin sono inizialmente nascoste. L'amministratore le rende visibili nella scheda Abilities della console, dove per esse la colonna Required Realm riporta "Set by the plugin".

## Modello di sicurezza

- **Solo Bearer.** `api.php` e `mcp.php` accettano esclusivamente un token personale
  nell'intestazione `Authorization`. Eliminano i cookie, `$_POST` e `$_REQUEST`
  prima del caricamento di Cacti e distruggono la sessione avviata da Cacti, in modo
  che un accesso tramite browser non conceda mai l'accesso all'API.
- **Soluzione temporanea per il CSRF.** La protezione CSRF di Cacti rifiuta una
  richiesta POST JSON priva di un token CSRF di Cacti, che nessun client MCP può
  inviare. Esclusivamente per questi due endpoint, il plugin rinomina il metodo della
  richiesta prima che Cacti venga caricato e lo ripristina successivamente, affinché
  il controllo venga ignorato. Questa soluzione è sicura perché la protezione CSRF
  tutela le richieste autenticate da un browser tramite cookie, mentre questi
  endpoint non accettano alcuna identità basata su cookie: una pagina cross-site non
  può allegare il token Bearer. Le pagine della console mantengono la protezione CSRF
  completa. La soluzione è temporanea, finché Cacti non offrirà un'esenzione
  supportata; vedere `lib/bootstrap.php`.
- **Verifica dell'origine.** Su `mcp.php`, se la richiesta include un'intestazione
  `Origin`, questa deve corrispondere esattamente a schema, host e porta dell'URL
  pubblico di Cacti, altrimenti la richiesta viene rifiutata con
  `ORIGIN_NOT_ALLOWED`. Una richiesta priva di intestazione `Origin`, ovvero la
  modalità con cui si connettono i client non browser, è consentita. Ciò impedisce a
  una pagina web di pilotare l'endpoint dal browser di un visitatore. `api.php` non
  applica questa verifica.
- **Solo lettura.** La registrazione rifiuta qualsiasi capacità che non sia di sola
  lettura, non distruttiva e idempotente.
- **Applicazione congiunta di esposizione e realm.** Una capacità deve essere esposta
  e il proprietario del token deve possedere il relativo realm. Se la tabella di
  esposizione non è leggibile, tutte le capacità vengono nascoste anziché ripiegare
  sui valori predefiniti.
- **Capacità nascoste, sconosciute e non consentite appaiono identiche.** Un client
  non può distinguere una capacità inesistente da una nascosta o che il proprio
  utente non è autorizzato a utilizzare: la scoperta la omette e l'esecuzione
  restituisce `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Token.** Archiviati come hash SHA-256, mostrati una sola volta, sempre soggetti
  a scadenza, revocabili e rifiutati quando il proprietario viene disabilitato o
  perde il realm.
- **Audit.** `plugin_mcp_audit` registra ID della richiesta, ID del token, ID
  utente, capacità, esito (`started`, `succeeded`, `failed`, `denied`, `rejected`) e
  marche temporali. Non registra mai argomenti, risultati o valori dei token. Una
  capacità viene eseguita solo dopo la scrittura della relativa riga `started`; se la
  tabella di audit non è disponibile, la chiamata fallisce con `UNAVAILABLE` e non
  viene eseguita. Una chiamata rifiutata prima dell'esecuzione genera una sola riga:
  `denied` per una capacità sconosciuta, nascosta o non consentita, `rejected` per
  argomenti che non soddisfano lo schema. La creazione e la revoca dei token dalla
  console, da My MCP Tokens e dalla CLI vengono registrate come `mcp-token-create` e
  `mcp-token-revoke` con esito `succeeded`, e la revoca viene registrata solo per un
  token che risultava attivo. La scoperta e una chiamata il cui campo `arguments` non
  è un oggetto JSON non vengono registrati.
- **Log degli errori.** Un errore imprevisto, `INVALID_RESULT` o una tabella di
  audit non disponibile scrivono una riga nel log di Cacti con facility `MCP`:
  l'ID della capacità, un motivo predefinito e la classe dell'eccezione. Messaggi,
  argomenti e token non vengono mai registrati.
- **Solo poller principale.** Entrambi gli endpoint, entrambe le pagine della console
  e `tokens.php` rifiutano di operare altrove.

## Ciclo di vita

La disabilitazione del plugin blocca entrambi gli endpoint. La disinstallazione
revoca tutti i token e conserva le tre tabelle (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) per finalità di conservazione dei dati;
una nuova installazione non riattiva i token revocati. Eseguire il backup delle
tabelle insieme al database di Cacti e applicare una politica di conservazione
dell'audit esternamente al plugin.

## Sviluppo e test

La suite di test comprende semplici script PHP in `tests/`, unit test PHPUnit in
`tests/Unit/` e analisi statica PHPStan (livello 6), tutti eseguibili senza
un'installazione di Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

La CI viene eseguita su PHP da 8.2 a 8.5: un job `test` che verifica la sintassi
PHP (`php -l`) ed esegue i 13 semplici script di test PHP elencati in
`.github/workflows/ci.yml`, un job `quality` che esegue `composer phpstan` e
`composer test`, e un job `package` che compila l'archivio installabile `mcp/`
(escludendo i file di sviluppo e test elencati in `.gitattributes`) e il relativo
file `SHA256SUMS`. I test che interagiscono con Cacti utilizzano fixture al
confine dell'helper di Cacti; non esercitano un'installazione completa di Cacti.

### Test di integrazione

`tests/integration/run.sh 1.2.31` o `tests/integration/run.sh develop` installa il
plugin in un'istanza reale di Cacti all'interno di container ed esegue verifiche
live su di essa. Richiede Docker con Compose v2.23.1 o successivo, git e openssl.
`KEEP=1` mantiene attivo lo stack per il debug. La CI lo esegue ogni notte e su
richiesta, non sulle pull request.

## Localizzazione

Cacti MCP distribuisce cataloghi GNU gettext compilati in `locales/po/` e
`locales/LC_MESSAGES/` e file README localizzati in `docs/i18n/` per l'inglese più
47 localizzazioni (19 localizzazioni Broad Tier 1, 15 africane, 10 asiatiche, oltre a bosniaco, croato e serbo),
utilizzando il dominio di testo `mcp` (`locales/po/mcp.pot`). Cacti carica
automaticamente il catalogo corrispondente quando il supporto linguistico è
abilitato.

## Contributi

Le pull request vanno indirizzate a `develop`. Mantenere il codice di produzione
compatibile con PHP 8.2 e adottare lo stile di Cacti: tabulazioni, stringhe tra
apici singoli e gli helper di database e permessi di Cacti. Aggiungere test per le
modifiche al comportamento di convalida, autorizzazione o protocollo e firmare i
commit con `git commit -s`. Coordinare le modifiche all'API HTTP con
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licenza

Copyright (C) 2026 Thomas Vincent. Rilasciato sotto licenza GNU General Public
License, versione 2 o successiva. Consultare [LICENSE](../../../LICENSE).
