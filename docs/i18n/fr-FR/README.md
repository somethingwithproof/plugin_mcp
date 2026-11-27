<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP : un cactus avec un bouclier. Découvrir. Autoriser. Exécuter.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Licence : GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP est un plugin Cacti qui permet aux clients d'IA de lire vos données
Cacti via des opérations nommées et filtrées par permissions appelées capacités
(*abilities*). Il les expose de deux manières directement depuis le plugin : un
point de terminaison MCP (`mcp.php`, Streamable HTTP) et une API HTTP de style
AIP (`api.php`). Cacti conserve la maîtrise de l'autorisation et de
l'exécution. Un client n'interroge jamais la base de données ; il peut
uniquement appeler une capacité qu'un administrateur a exposée et que les
domaines (*realms*) Cacti du propriétaire du jeton autorisent.

Les auteurs de plugins peuvent enregistrer leurs propres capacités en lecture
seule via le hook `abilities_register` ; elles apparaissent alors aux clients
MCP sous forme d'outils sans nécessiter de code protocolaire.

**Statut : préversion, version 0.1.0.** Il n'existe pas encore de version
publiée.

Disponible dès maintenant :

- Neuf capacités intégrées en lecture seule couvrant les versions système, les
  équipements, les sites, les collecteurs (*pollers*), les arborescences de
  graphiques, les graphiques, les sources de données et une fin de journal Cacti
  bornée et expurgée.
- Jetons d'accès personnels (`cmcp_pat_...`) comme unique moyen
  d'authentification.
- La console Management > MCP : exposer ou masquer des capacités, créer et
  révoquer des jetons, consulter le journal d'audit.
- Management > My MCP Tokens : les utilisateurs gèrent leurs propres jetons,
  consultent leur activité et voient quels outils leurs jetons peuvent utiliser.
- MCP sur Streamable HTTP, révisions du protocole `2026-07-28` et `2025-11-25`,
  outils uniquement.

Pas encore disponible :

- Connexion OAuth 2.1. Les connecteurs hébergés qui ne peuvent pas envoyer de
  jeton personnel, tels que les connecteurs personnalisés ChatGPT et claude.ai,
  ne peuvent pas se connecter tant que cette fonctionnalité n'existe pas. Elle
  est prévue dans le cadre du Plan 2, qui n'est pas encore rédigé.
- Capacités en écriture. Seules les capacités en lecture seule peuvent être
  enregistrées.

La conception est décrite dans la
[spécification de conception du point de terminaison](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
et la séquence de réalisation figure dans [docs/plan.md](../../plan.md).

## Capacités intégrées

| ID | Catégorie | Arguments | Domaine Cacti requis |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | aucun | 15 |
| `cacti-list-devices` | `inventory` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 3 |
| `cacti-get-device` | `inventory` | `name` (obligatoire), par exemple `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 3 |
| `cacti-list-pollers` | `system` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 15 |
| `cacti-list-trees` | `inventory` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 7 ou 4 |
| `cacti-list-graphs` | `inventory` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 7 ou 5 |
| `cacti-list-data-sources` | `inventory` | `pageSize`, `pageToken`, `filter`, `orderBy` (facultatifs) | 3 |
| `cacti-get-clog` | `system` | `lines` (1 à 200, 50 par défaut), `severity`, `search` (facultatifs) | 19 ou 18 |

Chaque appel nécessite également le domaine **MCP and Abilities API** pour le
propriétaire du jeton, la portée (*scope*) `abilities:read` (tout jeton
personnel la possède) et une capacité exposée. L'onglet Abilities de la console
indique le domaine principal requis par chaque capacité intégrée.

Les six capacités `cacti-list-*` renvoient des pages contenant jusqu'à 100
éléments (50 par défaut) ainsi qu'un `nextPageToken`. Un jeton de pagination
n'est valide que pour les mêmes valeurs de `filter` et `orderBy`. `filter` est
une expression AIP-160 composée de comparaisons (`=`, `!=`, `<`, `<=`, `>`,
`>=`) reliées par `AND`, par exemple `state = "DOWN" AND disabled = false`.
`orderBy` accepte une liste de champs triables séparés par des virgules, chacun
pouvant être suivi de `asc` ou `desc`.

| Capacité | Champs filtrables | Champs de tri |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Périmètre des permissions et exclusion des secrets :

- `cacti-list-devices` et `cacti-get-device` passent par `get_allowed_devices()`
  de Cacti et excluent les chaînes de communauté SNMP, les phrases secrètes et
  les autres identifiants.
- `cacti-list-trees` passe par `get_allowed_trees()` (et filtre avec
  `is_tree_allowed()` lorsqu'elle est disponible) ; `cacti-list-graphs` passe par
  `get_allowed_graphs()` (et filtre avec `is_graph_allowed()` lorsqu'elle est
  disponible).
- `cacti-list-data-sources` restreint les lignes aux équipements autorisés de
  l'appelant issus de `get_allowed_devices()` (et `is_device_allowed()` lorsqu'elle
  est disponible) et ne renvoie que les métadonnées sans interroger
  `data_input_data` ni exposer les valeurs d'entrée secrètes.
- `cacti-list-pollers` exclut les identifiants de base de données (`dbpass`,
  `dbuser`) ainsi que les colonnes de clés et certificats TLS (`dbsslkey`,
  `dbsslcert`, `dbsslca`).
- `cacti-get-clog` lit jusqu'au dernier Mio du journal Cacti configuré (en
  tronquant les lignes individuelles de plus de 2048 octets), filtre selon
  `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`,
  `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM` ; `ALL` par défaut)
  et `search` insensible à la casse (jusqu'à 256 caractères), et renvoie `lines`,
  `count` et `truncated`. Chaque ligne est expurgée des jetons personnels,
  en-têtes bearer/basic, mots de passe, secrets, communautés SNMP, clés,
  `dbpass`, `dbsslkey` et informations utilisateur d'URL avant l'exécution des
  filtres `severity` et `search` afin que `search` ne puisse pas servir d'oracle
  à secrets. L'expurgation échoue de manière fermée avec `[redacted]`, et un
  journal illisible renvoie `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Installation

Nécessite Cacti 1.2.31 ou ultérieur, PHP 8.2 ou ultérieur et le collecteur
(*poller*) principal. L'authentification Cacti doit être activée ; le plugin
refuse d'authentifier lorsqu'elle est désactivée.

Le répertoire du plugin doit s'appeler `mcp`, et non `plugin_mcp`. Le slug du
plugin, les noms de domaines, le domaine de traduction et les URL utilisent tous
`mcp`.

Depuis un clone des sources :

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

En attendant les versions taguées, vous pouvez télécharger l'artefact
`mcp-plugin` depuis une
[exécution CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
réussie. Il contient `mcp.tar.gz` et `SHA256SUMS`. Vérifiez la somme de
contrôle, puis extrayez `mcp.tar.gz` dans le répertoire `plugins/` de Cacti afin
d'obtenir `plugins/mcp/`. Les archives sources automatiques de GitHub utilisent
un nom de répertoire racine différent. L'archive omet `docs/` (y compris les
captures d'écran ci-dessous), `tests/` et `.github/`, de sorte que les liens du
README vers `docs/` fonctionnent sur GitHub mais pas dans une copie installée.

Ensuite :

1. Dans Plugin Management, installez et activez **Cacti MCP**. L'administrateur
   qui effectue l'installation reçoit automatiquement le domaine **MCP
   Administration**.
2. Sous Settings > MCP, définissez **Public Cacti URL** sur l'adresse utilisée
   par les clients, par exemple `https://cacti.example.com/cacti`. Le protocole
   HTTPS est obligatoire, sauf pour `localhost`, `127.0.0.1` et `[::1]`. Tant
   que ce paramètre n'est pas défini, `mcp.php` répond par un code HTTP 400 avec
   une erreur JSON-RPC dont le champ `data` vaut `FAILED_PRECONDITION` et
   `PUBLIC_URL_REQUIRED`. `api.php` ne lit pas ce paramètre.

   ![Settings > MCP affichant le champ Public Cacti URL](../../images/settings-public-url.png)

3. Accordez le domaine **MCP and Abilities API** à chaque utilisateur qui
   possédera un jeton. Aucun utilisateur ne le reçoit automatiquement.
4. Assurez-vous que le serveur web transmet l'en-tête `Authorization` et les
   informations de chemin (*path info*) à PHP (voir ci-dessous).
5. Ouvrez Management > MCP et exposez les capacités que vous souhaitez rendre
   visibles aux clients.

**Mise à niveau depuis une version de développement.** Le plugin est en
préversion et ses tables ont évolué en cours de développement sans script de
migration. Si vous avez installé une version antérieure, désinstallez-la puis
réinstallez le plugin. Une réinstallation conserve les tables existantes ;
supprimez donc d'abord les anciennes tables `plugin_mcp_token`, `plugin_mcp_audit`
et `plugin_mcp_ability` (ainsi que les tables équivalentes des versions
antérieures au renommage). Sauvegardez-les si vous avez besoin de leur
historique ; les jetons issus de ces versions sont révoqués lors de la
désinstallation et ne sont pas conservés.

### Serveur web

Les configurations Apache qui suppriment l'en-tête `Authorization` avant PHP
nécessitent la directive suivante dans l'hôte virtuel ou le répertoire concerné,
suivie d'un rechargement :

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache avec `mod_php` sert les routes de `api.php` sans configuration de chemin
supplémentaire.

Les routes de `api.php` se trouvent dans le chemin après le nom du script
(`/plugins/mcp/api.php/v1/abilities`). Nginx doit donc faire correspondre les
URI où `.php` est suivi d'un chemin supplémentaire, en extraire le *path info*
et le transmettre à PHP. Un bloc `location ~ \.php$` ne correspond jamais à ces
URL ; nginx répond alors avec sa propre page HTML 404. Le motif `location` et
les deux lignes de *path info* ci-dessous ont été vérifiés avec PHP-FPM ; les
autres lignes constituent la configuration standard habituelle :

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Adaptez les lignes `include` et `fastcgi_pass` à celles du bloc qui sert déjà
Cacti. N'ajoutez pas `try_files $fastcgi_script_name =404;` dans ce bloc : cela
effacerait `$fastcgi_path_info`, et `api.php` répondrait alors par une erreur 404
`UNKNOWN_PATH`. Si votre configuration requiert `try_files`, sauvegardez d'abord
la valeur avec `set $path_info $fastcgi_path_info;` et transmettez
`fastcgi_param PATH_INFO $path_info;`.

`mcp.php` ne comporte pas de routes basées sur le chemin et n'en a pas besoin.

## Console

Management > MCP comporte trois onglets. Vous devez disposer du domaine **MCP
Administration**. Les captures d'écran ici et ci-dessous proviennent d'une
version de développement de Cacti avec des données d'exemple.

- **Abilities** liste chaque capacité enregistrée avec son plugin, sa catégorie,
  le domaine requis et son état d'exposition. Sélectionnez des lignes et
  choisissez Expose ou Hide ; une confirmation vous est demandée avant
  l'application du changement. Les capacités intégrées `cacti-*` sont exposées
  par défaut. Les capacités provenant d'autres plugins sont masquées au départ,
  de sorte que l'installation d'un plugin ne publie jamais rien tant qu'un
  administrateur ne l'a pas décidé. L'exposition ne fait que restreindre l'accès :
  un utilisateur doit toujours posséder le domaine associé à la capacité.

  ![Onglet Abilities listant les capacités intégrées avec leurs domaines et leur état d'exposition](../../images/console-abilities.png)
- **Tokens** liste les jetons avec le propriétaire, le créateur, la date de
  création, l'expiration, la dernière utilisation et l'état (Active, Expired,
  Revoked). Sélectionnez des lignes et choisissez Revoke pour les révoquer. Les
  jetons révoqués ne peuvent plus être utilisés. Create Token permet d'en créer
  un nouveau.

  ![Onglet Tokens listant les jetons avec le propriétaire, l'expiration, la dernière utilisation et l'état, au-dessus du formulaire Create Token](../../images/console-tokens.png)
- **Audit** liste les entrées d'audit, de la plus récente à la plus ancienne, et
  permet de filtrer par utilisateur, capacité et résultat.

  ![Onglet Audit listant les appels avec l'utilisateur, le jeton, la capacité et le résultat, accompagnés de filtres](../../images/console-audit.png)

## Jetons

Un jeton personnel lit Cacti avec les droits de son propriétaire. Il prend la
forme `cmcp_pat_` suivi de 64 caractères hexadécimaux en minuscules et porte
l'unique portée `abilities:read`. Ce qu'il peut voir est déterminé par les
domaines Cacti et les permissions sur les équipements de son propriétaire, et non
par le jeton lui-même. Le propriétaire doit être un utilisateur actif possédant
le domaine **MCP and Abilities API**.

Les jetons sont toujours créés pour un utilisateur, ont une durée de validité
limitée et peuvent être révoqués :

- **Console.** Management > MCP > Tokens > Create Token. La durée de validité
  est comprise entre 1 et 365 jours, avec une valeur par défaut de 90. Le jeton
  est généré par le serveur et affiché une seule fois sur la page de réponse ;
  copiez-le immédiatement dans votre gestionnaire de secrets. Vous pouvez créer
  un jeton pour vous-même. En créer un pour un autre utilisateur nécessite
  également le domaine Users/Groups, car le jeton lit Cacti en tant que cet
  utilisateur.
- **My MCP Tokens.** Tout utilisateur disposant du domaine MCP and Abilities API
  peut gérer ses propres jetons ; voir ci-dessous.
- **Ligne de commande.** `tokens.php` s'exécute uniquement en CLI, sous un
  compte système habilité à administrer Cacti. Il récupère le jeton depuis
  l'environnement afin que la valeur n'apparaisse jamais sur une ligne de
  commande ni dans la liste des processus. La durée de validité va de 1 à
  365 jours, avec 30 jours par défaut. La création et la révocation d'un jeton
  via la CLI sont auditées comme depuis la console, avec le propriétaire du
  jeton comme acteur puisque la CLI ne dispose pas d'utilisateur Cacti ;
  l'entrée d'audit n'indique donc pas que l'action provient de la CLI. `--list`
  affiche chaque jeton au format JSON (ID, propriétaire, portées, horodatages,
  indicateur de révocation) sans jamais afficher la valeur du jeton ; `--help`
  affiche l'aide d'utilisation.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Il est impossible de créer des jetons pour le compte invité (*guest*), pour des
utilisateurs désactivés ou pour des utilisateurs ne possédant pas le domaine
**MCP and Abilities API**, que ce soit depuis la console, la ligne de commande
ou My MCP Tokens. Cacti stocke le paramètre du compte invité sous forme de nom
d'utilisateur ou d'identifiant utilisateur, et le plugin résout les deux formats.
Un jeton dont le propriétaire devient le compte invité cesse de fonctionner dès
la requête suivante.

### Mes jetons MCP

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ne nécessite aucun
domaine d'administration : la page est couverte par le domaine **MCP and
Abilities API**, et l'entrée de menu n'apparaît que pour les utilisateurs qui le
possèdent. La page agit toujours sur l'utilisateur connecté. Le menu de Cacti
faisant partie de la console, un utilisateur n'ayant pas accès à la console peut
accéder à la page directement par son adresse.

![Onglet My Tokens listant les jetons de l'utilisateur connecté et le formulaire de création](../../images/my-tokens.png)

- **Tokens** liste vos jetons, permet d'en créer un (de 1 à 365 jours, 90 par
  défaut, affiché une seule fois dans la réponse) et de révoquer les vôtres.
  Vous ne pouvez ni voir ni révoquer ceux d'un autre utilisateur.
- **Activity** liste les actions que vous avez effectuées, de la plus récente à
  la plus ancienne : appels effectués avec vos jetons et modifications apportées
  à vos jetons.
- **Available Tools** liste les capacités qu'un de vos jetons peut utiliser
  immédiatement, avec l'identifiant, le nom et la description de chaque capacité.
  Cette liste reflète vos permissions Cacti et les réglages d'exposition choisis
  par un administrateur.

  ![Liste Available Tools affichant l'identifiant, le nom et la description de chaque capacité](../../images/my-tools.png)

Une installation réalisée avant l'existence de cette page dispose d'une liste de
fichiers de domaine ne contenant pas `mcp_tokens.php`. L'installation enregistre
cette liste ; celle-ci n'est pas mise à jour lors de l'activation ou de la
désactivation du plugin. Désinstallez puis réinstallez le plugin, puis accordez
de nouveau les domaines, car Cacti supprime les attributions de domaines lors de
la désinstallation d'un plugin.

La base de données ne stocke que le condensat SHA-256 du jeton : un jeton perdu
ne peut donc pas être récupéré ; révoquez-le et créez-en un autre. La rotation
suit le même principe : créez un nouveau jeton, basculez le client dessus, puis
révoquez l'ancien. Un jeton expiré, un jeton révoqué, un propriétaire désactivé
ou un domaine retiré entraînent chacun un échec dès la requête suivante. Les
jetons ne sont acceptés que dans l'en-tête `Authorization: Bearer` ; un jeton
passé dans la chaîne de requête ou dans le corps de la requête est refusé.

## Connecter un client

Utilisez le point de terminaison MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, avec le
jeton dans un en-tête `Authorization: Bearer`. Conservez le jeton dans une variable
d'environnement ou un gestionnaire de secrets et référencez-le depuis la configuration du client au lieu
d'écrire sa valeur dans un fichier.

### Claude Code

Placez le point de terminaison dans un fichier `.mcp.json` de projet qui référence le jeton par son nom.
Claude Code développe `${VAR}` dans `url` et `headers`, de sorte que le fichier ne contient aucun secret et
peut être commité sans risque. Exportez `CACTI_MCP_TOKEN` dans l'environnement qui lance Claude Code.

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

Vous pouvez également l'ajouter depuis la ligne de commande :

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Avec des guillemets doubles, votre shell développe d'abord `$CACTI_MCP_TOKEN`, de sorte que la valeur du jeton
est écrite dans le fichier de configuration pour le `--scope` choisi (`local`, `user` ou
`project` ; par défaut `local`). N'utilisez pas cette forme avec `--scope project`, et conservez
le fichier hors du contrôle de version. Préférez la référence `.mcp.json` ci-dessus. Claude Code
lit certaines variables d'identification (telles que `ANTHROPIC_AUTH_TOKEN`) comme vides dans les champs distants
`url` et `headers` ; `CACTI_MCP_TOKEN` n'en fait pas partie. Source :
[documentation MCP de Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot dans VS Code

Utilisez un fichier `.mcp.json` à la racine de l'espace de travail (ou le fichier utilisateur `~/.copilot/mcp-config.json`).
Ces fichiers natifs de Copilot utilisent un objet racine `mcpServers` et des références de variables
d'environnement `${NAME}` dans les valeurs d'en-tête :

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

Exportez `CACTI_MCP_TOKEN` dans l'environnement qui lance VS Code. Les fichiers natifs de Copilot
ne prennent pas en charge les invites `inputs`. La configuration guidée de VS Code rejette les valeurs `${...}`,
ajoutez donc l'en-tête `Authorization` en modifiant le fichier plutôt que via le
flux guidé. La configuration guidée ne propose le fichier à la racine de l'espace de travail
que lorsque le paramètre expérimental `chat.mcp.workspaceRootConfig.enabled` est activé. Consultez la
[référence de configuration MCP de VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Obsolète : `.vscode/mcp.json`.** VS Code indique que les nouvelles configurations Copilot ne doivent pas
utiliser `.vscode/mcp.json` ni le fichier `mcp.json` du profil ; ils appartiennent à l'ancien harnais
Local, qui sera supprimé en février 2027. Si vous l'utilisez encore, le
format géré par l'éditeur prend une clé racine `servers` et peut demander le jeton :

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

### Clients qui ne parlent que stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) est un adaptateur optionnel
qui s'exécute comme serveur MCP stdio local et appelle l'API HTTP du plugin. Utilisez-le pour un
client qui ne peut pas se connecter à un serveur HTTP distant. Il nécessite le même jeton
personnel et communique avec `api.php`.

### Comportement MCP

Le point de terminaison expose uniquement des outils : chaque capacité exposée et autorisée est un outil nommé d'après
son identifiant, avec ses schémas d'entrée et de sortie et ses annotations en lecture seule
(`openWorldHint` vaut `false`). Il gère `initialize`, `server/discover`, `ping`,
`tools/list` et `tools/call`. Il ne conserve aucune session, n'envoie pas `Mcp-Session-Id`
(et ignore celui qu'il reçoit) et n'accepte pas les lots JSON-RPC. Un message
sans `id` est une notification et reçoit un code HTTP 202 sans corps de réponse. Seule la méthode `POST` est
autorisée.

- **Révisions.** Une requête qui contient `io.modelcontextprotocol/protocolVersion` dans
  `params._meta` doit indiquer `2026-07-28` ; toute autre valeur reçoit l'erreur `-32022`. De telles
  requêtes doivent également comporter les en-têtes correspondants `Mcp-Protocol-Version`, `Mcp-Method` et (pour
  `tools/call`) `Mcp-Name`, sans quoi la réponse est l'erreur `-32020`. Les autres requêtes
  sont traitées comme `2025-11-25` : `initialize` répond avec cette révision et, sur toute
  autre méthode, un en-tête `Mcp-Protocol-Version`, s'il est envoyé, doit être `2025-11-25`,
  `2025-06-18` ou `2025-03-26`.
- **Erreurs d'outil.** Une erreur de capacité, y compris des arguments qui ne correspondent pas au
  schéma ou une valeur `arguments` qui n'est pas un objet JSON, revient sous forme de résultat
  d'outil avec `isError: true` et l'erreur AIP-193 dans `structuredContent`, et non sous forme d'erreur
  de protocole.
- **Erreurs de protocole.** Les échecs qui ne sont pas des erreurs d'outil sont des objets d'erreur JSON-RPC
  (code `-32000` avec le statut et la raison dans `data`, ou les codes standard) : l'URL
  publique Cacti manquante, un `Origin` refusé, une requête lorsque le plugin est désactivé
  ou sur un poller distant, ainsi que les erreurs serveur inattendues (`-32603`, avec le détail
  écrit dans le journal Cacti, et non dans la réponse). Les vérifications de requête exécutées en premier (405,
  413, 415) et les échecs d'authentification (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  conservent le corps AIP-193 décrit dans la section API HTTP.

## API HTTP

URL de base : `https://cacti.example.com/cacti/plugins/mcp/api.php`. Le contrat figure
dans [openapi.json](../../../openapi.json).

| Méthode et chemin | Rôle |
| --- | --- |
| `GET /v1/abilities` | Lister les capacités autorisées. Paramètres de requête : `pageSize`, `pageToken`, et `filter` de la forme `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Lire une capacité. |
| `POST /v1/abilities/{id}:execute` | L'exécuter. Le corps est exactement `{"arguments": {...}}`. La réponse est `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Les erreurs suivent la norme AIP-193 : un objet `error` contenant `code`, `message`, `status` et
`details` qui transporte un élément `ErrorInfo` avec le domaine `cacti.net` et un champ `reason` stable.
Les problèmes d'arguments ajoutent un détail `BadRequest` nommant le champ. Les corps de requête sont
limités à 64 Ko, et les résultats à 1 Mo. Les deux points de terminaison répondent uniquement sur le poller
principal et renvoient `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) lorsque le plugin est désactivé
ou que le serveur n'est pas le poller principal.

| HTTP | Valeurs de `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (envoie également `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (envoie `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Écrire une capacité (auteurs de plugins)

Un plugin Cacti activé enregistre des capacités depuis une fonction qu'il attache au
hook `abilities_register`, généralement dans son `plugin_<slug>_install()` :

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

La fonction reçoit un `AbilitiesRegistrar` limité à la portée du plugin. Sa valeur de retour
est ignorée.

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

Les règles, toutes appliquées lors de l'enregistrement :

- **Identifiants.** Un identifiant correspond à `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, comporte au maximum 64
  caractères et doit commencer par le slug du plugin suivi d'un tiret : `acme-` ci-dessus.
  Le slug correspond au nom du répertoire du plugin ; un répertoire tel que `my_plugin` ne peut donc
  rien enregistrer. Un répertoire de plugin nommé `cacti` est refusé ; cet
  espace de noms appartient aux capacités intégrées.
- **Définition.** Exactement ces clés : `label`, `description` (jusqu'à 4096 octets),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. La catégorie doit déjà exister : utilisez une catégorie intégrée (`inventory`,
  `system`) ou enregistrez la vôtre avec `registerCategory()`, dont l'identifiant est unique pour
  l'ensemble des plugins et correspond à `^[a-z][a-z0-9-]{0,31}$`.
- **Lecture seule uniquement.** `annotations` doit contenir exactement `readOnly: true`,
  `destructive: false`, `idempotent: true`. Toute autre valeur lève une exception.
- **Schémas.** `input_schema` et `output_schema` doivent chacun avoir un `type` de premier niveau
  `object`. Le dialecte est restreint et échoue de manière sécurisée. Les objets doivent être fermés
  (`additionalProperties: false`, avec `properties` présent) ; les autres types sont
  `integer` et `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean` et `array` (qui nécessite `items` et
  `maxItems`). Un type peut être
  rendu nullable sous la forme `['string', 'null']`. Les chaînes d'arguments sont limitées par défaut à
  4096 caractères maximum ; les chaînes de résultats ne sont limitées que par un `maxLength` déclaré
  et par la limite de taille du résultat. Au plus 256 capacités peuvent être enregistrées.
- **`permission(int $userId): bool`.** Doit renvoyer exactement `true` pour autoriser. L'identifiant
  utilisateur est celui du propriétaire du jeton ; ne lisez jamais l'état de session.
- **`execute(int $userId, stdClass $args): array`.** `$args` est déjà validé
  par rapport à `input_schema`. Appliquez vous-même les permissions au niveau des objets. Renvoyez un
  tableau associatif qui correspond exactement à `output_schema` ; une liste, un champ supplémentaire
  ou plus de 1 Mo de JSON provoque une erreur `INVALID_RESULT`. Levez
  `AbilitiesError` pour un échec visible côté client, tel que `NOT_FOUND`.
- **Objets vides.** PHP encode `[]` sous forme de tableau JSON. Partout où le schéma de sortie
  déclare un `object`, à n'importe quelle profondeur, le registre traite `[]` comme l'objet vide
  et envoie `{}` ; `new stdClass()` fonctionne également. Une liste non vide ne compte jamais comme un
  objet et échoue avec `INVALID_RESULT`. Une map `properties` vide dans un schéma
  peut être `[]` ou `new stdClass()` ; les deux sont publiées sous forme de `{}`.
- **Isolation des pannes.** Chaque plugin s'enregistre dans une copie de travail qui n'est conservée
  que si votre fonction se termine normalement. Si elle lève une exception, aucune de vos capacités
  n'est enregistrée et l'échec est consigné dans le journal.

Les capacités des plugins commencent masquées. L'administrateur les expose dans l'onglet
Abilities de la console, et la colonne Required Realm indique « Set by the plugin »
pour elles.

## Modèle de sécurité

- **Jeton Bearer uniquement.** `api.php` et `mcp.php` acceptent un jeton personnel dans
  l'en-tête `Authorization` et rien d'autre. Ils suppriment les cookies, `$_POST` et
  `$_REQUEST` avant le chargement de Cacti et détruisent la session ouverte par Cacti, de sorte
  qu'une connexion via navigateur ne donne jamais accès à l'API.
- **Contournement CSRF.** La protection CSRF de Cacti rejette toute requête POST JSON dépourvue
  de jeton CSRF Cacti, qu'aucun client MCP ne peut envoyer. Pour ces deux points de
  terminaison uniquement, le plugin renomme la méthode de requête avant le chargement de Cacti
  puis la restaure ensuite, afin que la protection les ignore. Ce mécanisme est sûr car la
  protection CSRF protège les requêtes authentifiées par cookies dans un navigateur, et ces
  points de terminaison n'acceptent aucune identité par cookie : une page tierce ne peut pas
  joindre le jeton Bearer. Les pages de la console conservent une protection CSRF complète. Ce
  contournement est temporaire, en attendant que Cacti propose une exemption officielle ; voir
  `lib/bootstrap.php`.
- **Vérification de l'origine.** Sur `mcp.php`, si la requête comporte un en-tête `Origin`,
  celui-ci doit correspondre exactement au schéma, à l'hôte et au port de l'URL publique de
  Cacti, sinon la requête est refusée avec `ORIGIN_NOT_ALLOWED`. Une requête sans en-tête
  `Origin`, ce qui correspond au mode de connexion des clients hors navigateur, est autorisée.
  Cela empêche une page web de piloter le point de terminaison depuis le navigateur d'un
  visiteur. `api.php` n'applique pas cette vérification.
- **Lecture seule uniquement.** L'enregistrement rejette toute capacité qui n'est pas en
  lecture seule, non destructive et idempotente.
- **L'exposition et les domaines (realms) s'appliquent tous deux.** Une capacité doit être
  exposée et le propriétaire du jeton doit détenir son domaine d'autorisation. Si la table
  d'exposition ne peut pas être lue, toutes les capacités sont masquées plutôt que de revenir
  aux valeurs par défaut.
- **Capacité masquée, inconnue ou non autorisée : comportement identique.** Un client ne peut
  pas distinguer une capacité inexistante d'une capacité masquée ou que son utilisateur n'est
  pas autorisé à utiliser : la découverte l'omet et l'exécution renvoie `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Jetons.** Stockés sous forme de condensats SHA-256, affichés une seule fois, toujours dotés
  d'une date d'expiration, révocables et rejetés lorsque le propriétaire est désactivé ou
  perd le domaine associé.
- **Audit.** `plugin_mcp_audit` enregistre l'identifiant de requête, l'identifiant du jeton,
  l'identifiant de l'utilisateur, la capacité, le résultat (`started`, `succeeded`, `failed`,
  `denied`, `rejected`) et les horodatages. Elle n'enregistre jamais les arguments, les
  résultats ni les valeurs des jetons. Une capacité ne s'exécute qu'après l'écriture de sa
  ligne `started` ; si la table d'audit est indisponible, l'appel échoue avec `UNAVAILABLE` et
  ne s'exécute pas. Un appel refusé avant exécution génère une seule ligne : `denied` pour une
  capacité inconnue, masquée ou non autorisée, `rejected` pour des arguments non conformes au
  schéma. La création et la révocation de jetons depuis la console, My MCP Tokens et la CLI
  sont enregistrées sous `mcp-token-create` et `mcp-token-revoke` avec le résultat `succeeded`,
  et une révocation n'est enregistrée que pour un jeton qui était actif. La découverte, ainsi
  qu'un appel dont `arguments` n'est pas un objet JSON, ne sont pas journalisés.
- **Journal des échecs.** Une erreur inattendue, `INVALID_RESULT` ou une table d'audit
  indisponible écrit une ligne dans le journal Cacti avec la catégorie `MCP` : l'identifiant
  de la capacité, une raison fixe et la classe d'exception. Les messages, les arguments et les
  jetons ne sont jamais journalisés.
- **Collecteur principal uniquement.** Les deux points de terminaison, les deux pages de la
  console et `tokens.php` refusent d'agir ailleurs.

## Cycle de vie

La désactivation du plugin bloque les deux points de terminaison. La désinstallation révoque
tous les jetons et conserve les trois tables (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) à des fins de rétention ; une réinstallation ne réactive pas un jeton
révoqué. Sauvegardez ces tables avec la base de données Cacti et appliquez une politique de
rétention d'audit en dehors du plugin.

## Développement et tests

La suite de tests comprend de simples scripts PHP dans `tests/` ainsi que des
tests unitaires PHPUnit dans `tests/Unit/` et une analyse statique PHPStan
(niveau 6), le tout s'exécutant sans installation Cacti :

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

La CI s'exécute sur PHP 8.2 à 8.5 : un job `test` qui vérifie la syntaxe PHP
(`php -l`) et exécute les 13 scripts de test PHP simples listés dans
`.github/workflows/ci.yml`, un job `quality` qui exécute `composer phpstan` et
`composer test`, et un job `package` qui génère l'archive installable `mcp/`
(en excluant les fichiers de développement et de test listés dans
`.gitattributes`) ainsi que son fichier `SHA256SUMS`. Les tests qui interagissent
avec Cacti utilisent des fixtures à la frontière des fonctions auxiliaires de
Cacti ; ils n'exécutent pas une installation complète de Cacti.

### Tests d'intégration

`tests/integration/run.sh 1.2.31` ou `tests/integration/run.sh develop` installe le plugin dans
un véritable Cacti en conteneurs et exécute des vérifications en direct. Cela nécessite Docker
avec Compose v2.23.1 ou supérieur, git et openssl. `KEEP=1` laisse la pile en cours
d'exécution pour le débogage. La CI l'exécute chaque nuit et à la demande, pas sur les pull
requests.

## Localisation

Cacti MCP fournit des catalogues GNU gettext compilés dans `locales/po/` et
`locales/LC_MESSAGES/` ainsi que des fichiers README traduits dans `docs/i18n/` pour
l'anglais et 47 autres langues (19 langues principales de niveau 1, 15 langues africaines, 10 langues asiatiques, ainsi que le bosnien, le croate et le serbe), en utilisant le domaine de texte `mcp` (`locales/po/mcp.pot`). Cacti
charge automatiquement le catalogue correspondant lorsque la prise en charge des langues est
activée.

## Contribution

Les pull requests doivent cibler `develop`. Veillez à ce que le code de production reste
compatible avec PHP 8.2 et respectez le style de Cacti : tabulations, chaînes entre guillemets
simples et fonctions auxiliaires de base de données et de permissions de Cacti. Ajoutez des
tests pour toute modification de validation, d'autorisation ou de comportement protocolaire, et
signez vos commits avec `git commit -s`. Coordonnez les modifications de l'API HTTP avec
[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Licence

Copyright (C) 2026 Thomas Vincent. Distribué sous licence GNU General Public License, version 2
ou ultérieure. Voir [LICENSE](../../../LICENSE).
