<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktosy misy ampinga. Mitadiava. Manomeza alalana. Manatanteraha.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Fahazoan-dalana: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP dia plugin ho an'ny Cacti izay ahafahan'ny mpanjifa AI mamaky ny angon-drakitrao ao amin'ny Cacti amin'ny alalan'ny asa voatondro anarana sy voasivana araka ny fahazoan-dalana antsoina hoe fahafahana. Manome izany amin'ny fomba roa avy amin'ny plugin ihany izy: teboka fidirana MCP (`mcp.php`, Streamable HTTP) sy API HTTP mitovy endrika amin'ny AIP (`api.php`). Mijanona ho tompon'andraikitra amin'ny fanomezan-dalana sy ny fanatanterahana ny Cacti. Tsy manao fangatahana mivantana amin'ny tahiry angona mihitsy ny mpanjifa; ny fahafahana nasehon'ny mpitantana sy eken'ny faritra Cacti ananan'ny tompon'ny mari-pamantarana ihany no azony antsoina.

Ny mpanoratra plugin dia afaka manoratra ny fahafahany manokana tsy azo ovaina amin'ny alalan'ny hook `abilities_register`, ary miseho ho fitaovana eo amin'ny mpanjifa MCP izy ireny tsy mila kaody protocole.

**Sata: mialoha ny famoahana, kinova 0.1.0.** Tsy mbola misy famoahana misy marika.

Misy amin'izao fotoana izao:

- Fahafahana raikitra tsy azo ovaina ho an'ny kinova rafitra sy ny lisitry ny fitaovana.
- Mari-pamantarana fidirana manokana (`cmcp_pat_...`) ihany no fitaovana fanamarinana ampiasaina.
- Ny console Management > MCP: maneho na manafina fahafahana, mamorona sy manafoana mari-pamantarana, mamaky ny firaketana fanaraha-maso.
- Management > My MCP Tokens: mitantana ny mari-pamantarany manokana ny mpampiasa, mijery ny hetsika nataony, ary mijery izay fitaovana azon'ny mari-pamantarany ampiasaina.
- MCP amin'ny alalan'ny Streamable HTTP, kinova protocole `2026-07-28` sy `2025-11-25`, fitaovana ihany.

Tsy mbola misy:

- Fidirana amin'ny alalan'ny OAuth 2.1. Ny mpampifandray ampiantranoana izay tsy afaka mandefa mari-pamantarana manokana, toy ny mpampifandray manokana ho an'ny ChatGPT sy claude.ai, dia tsy afaka mifandray raha tsy efa misy izany. Voalahatra ho Plan 2 izany; mbola tsy voasoratra izany drafitra izany.
- Fahafahana manoratra. Ny fahafahana mamaky ihany no azo soratana.

Ny famolavolana dia ao amin'ny
[famaritana ny famolavolana teboka fidirana](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
ary ny filaharan'ny fananganana dia ao amin'ny [docs/plan.md](../../plan.md).

## Fahafahana raikitra

| ID | Parametra (Arguments) | Faritra Cacti ilaina |
| --- | --- | --- |
| `cacti-get-system-info` | tsy misy | 15 |
| `cacti-list-devices` | azo isafidianana `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | ilaina `name`, toy ny `devices/12` | 3 |

Ny antso tsirairay dia mila ihany koa ny faritra **MCP and Abilities API** ho an'ny tompon'ny mari-pamantarana,
ny sehatra `abilities:read` (ananan'ny mari-pamantarana manokana rehetra izany), ary fahafahana iray
naseho. Ny tabilao Abilities ao amin'ny console dia mampiseho ny faritra ilain'ny fahafahana raikitra tsirairay.

- `cacti-list-devices` dia mamerina pejy misy fitaovana hatramin'ny 100 (50 raha tsy voafaritra) sy
  `nextPageToken`. Ny mari-pamantarana pejy dia tsy manan-kery afa-tsy ho an'ny `filter` sy
  `orderBy` mitovy. Ny `filter` dia fanehoana AIP-160 misy fampitahana ampifandraisina amin'ny `AND`,
  ohatra `state = "DOWN" AND disabled = false`. Ny saha fanivanana dia
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, ary `state`. Ny `orderBy` dia mandray `displayName`, `hostname`, na `name`,
  ary azo arahina `desc` raha tiana.
- Mandalo amin'ny `get_allowed_devices()` an'ny Cacti ny fangatahana fitaovana, ka ny fitaovana
  asehon'ny Cacti aminy ihany no hitan'ny mpampiasa.
- Tsy tafiditra ao amin'ny sahan'ny fitaovana ny SNMP community strings, tenimiafina, ary
  fitaovana fanamarinana hafa.

## Fametrahana

Mitaky Cacti 1.2.31 na vaovao kokoa, PHP 8.2 na vaovao kokoa, ary ny poller fototra. Tsy maintsy alefa ny
fanamarinana maha-izy azy ao amin'ny Cacti; mandà tsy hanamarina ny plugin raha maty izany.

Ny lahatahiry misy ny plugin dia tsy maintsy mitondra ny anarana `mcp`, fa tsy `plugin_mcp`. Ny slug an'ny plugin, ny anaran'ny faritra,
ny sehatra fandikan-teny, ary ny URL rehetra dia samy mampiasa `mcp`.

Avy amin'ny kaody loharano nalaina:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Mandrapisiany famoahana misy marika, azonao alaina kosa ny artefact `mcp-plugin`
avy amin'ny
[fandehanana CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) nahomby.
Ahitana `mcp.tar.gz` sy `SHA256SUMS` izany. Hamarino ny checksum, avy eo sokafy
ao anatin'ny lahatahiry `plugins/` an'ny Cacti ny `mcp.tar.gz` mba ho `plugins/mcp/` ny vokatra.
Mampiasa anaran-dahatahiry ambony hafa ny tahiry loharano mandeha ho azy avy amin'ny GitHub.
Tsy tafiditra ao amin'ny tahiry ny `docs/` (anisan'izany ireo pikantsary eto ambany), `tests/`, ary
`.github/`, ka miasa ao amin'ny GitHub ny rohy README mankany amin'ny `docs/` fa tsy ao amin'ny kopia
napetraka.

Avy eo:

1. Ao amin'ny Plugin Management, apetraho ary alefaso ny **Cacti MCP**. Mahazo mandeha ho azy
   ny faritra **MCP Administration** ny mpitantana nametraka azy.
2. Ao amin'ny Settings > MCP, apetraho ho ny adiresy ampiasain'ny mpanjifa ny **Public Cacti URL**,
   ohatra `https://cacti.example.com/cacti`. Ilaina ny HTTPS afa-tsy ho an'ny
   `localhost`, `127.0.0.1`, ary `[::1]`. Mandra-pametraka izany, mamaly HTTP 400
   miaraka amin'ny hadisoana JSON-RPC manana `data` hoe `FAILED_PRECONDITION` sy
   `PUBLIC_URL_REQUIRED` ny `mcp.php`. Tsy mamaky izany ny `api.php`.

   ![Settings > MCP mampiseho ny saha Public Cacti URL](../../images/settings-public-url.png)

3. Omeo ny faritra **MCP and Abilities API** ny mpampiasa tsirairay izay hanana mari-pamantarana.
   Tsy misy mpampiasa mahazo izany mandeha ho azy.
4. Hamarino fa mandefa ny lohapejy `Authorization` sy ny fampahalalana lalana mankany amin'ny PHP ny mpizara tranonkala
   (jereo eto ambany).
5. Sokafy ny Management > MCP ary asehoy ireo fahafahana tianao ho hitan'ny mpanjifa.

**Fanavaozana avy amin'ny kinova fampandrosoana.** Mialoha ny famoahana ity plugin ity, ary niova nandritra ny
fampandrosoana tsy nisy fifindrana ny tabilaony. Raha nametraka kinova taloha ianao,
esory izany ary apetraho indray. Ny fametrahana indray dia mitazona ireo tabilao efa
misy, koa fafao aloha ireo tabilao taloha `plugin_mcp_token`, `plugin_mcp_audit`, ary
`plugin_mcp_ability` (sy ireo tabilao mitovy aminy avy amin'ny
kinova natao talohan'ny fanovana anarana). Tehirizo izy ireo raha ilainao ny tantarany; foanana mandeha ho azy
mandritra ny fanesorana ny mari-pamantarana avy amin'ireny kinova ireny ary tsy mitohy.

### Mpizara tranonkala

Ny fametrahana Apache izay manala ny `Authorization` alohan'ny PHP dia mila ity ao amin'ny
virtual host na lahatahiry mifandraika aminy, arahina famelomana indray:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Ny Apache miaraka amin'ny `mod_php` dia manompo ny lalan'ny `api.php` tsy mila fanamboarana lalana fanampiny.

Ny lalan'ny `api.php` dia mitoetra ao amin'ny lalana aorian'ny anaran'ny script
(`/plugins/mcp/api.php/v1/abilities`), ka ny nginx dia tsy maintsy mampifanaraka ny URI izay arahin'ny
lalana fanampiny aorian'ny `.php`, manasaraka ny path info, ary mandefa izany any amin'ny PHP. Ny
sakana `location ~ \.php$` dia tsy mifanaraka na oviana na oviana amin'ireo URL ireo; mamaly amin'ny
HTML 404 azy manokana ny nginx. Ny endrika location sy ireo andalana roa momba ny path-info eto ambany dia voamarina niaraka tamin'ny
PHP-FPM; rafitra mahazatra ny andalana hafa:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Ampifanaraho amin'ny sakana efa manompo ny Cacti ny andalana `include` sy `fastcgi_pass`.
Aza ampidirina amin'ity sakana ity ny `try_files $fastcgi_script_name =404;`: mamafa ny
`$fastcgi_path_info` izany, ka mamaly 404 `UNKNOWN_PATH` ny `api.php`. Raha mila `try_files`
ny fanamboaranao, tehirizo aloha ny sandany amin'ny
`set $path_info $fastcgi_path_info;` ary ampitampitao ny `fastcgi_param PATH_INFO $path_info;`.

Tsy manana lalan-tsampana ny `mcp.php` ary tsy mila izany.

## Console

Manana tabilao telo ny Management > MCP. Mila ny faritra **MCP Administration** ianao.
Ny pikantsary eto sy eto ambany dia avy amin'ny kinova fampandrosoana Cacti misy angon-drakitra ohatra.

- **Abilities** dia mitanisa ny fahafahana voasoratra rehetra miaraka amin'ny plugin-ny, ny sokajy, ny
  faritra ilainy, ary raha aseho izy na tsia. Misafidiana andalana ary safidio ny Expose na
  Hide; manamafy ianao alohan'ny hihatran'ny fanovana. Ny fahafahana raikitra `cacti-*` dia
  aseho raha tsy misy fanovana. Ny fahafahana avy amin'ny plugin hafa dia miafina amin'ny voalohany, ka ny fametrahana
  plugin iray dia tsy mamoaka na inona na inona mihitsy mandra-panapahan'ny mpitantana hevitra. Mampihena ny fidirana ihany ny
  fanehoana: mbola mila ny faritry ny fahafahana ny mpampiasa.

  ![Tabilao Abilities mitanisa ny fahafahana raikitra miaraka amin'ny faritra sy ny satan'ny fanehoana](../../images/console-abilities.png)
- **Tokens** dia mitanisa ny mari-pamantarana miaraka amin'ny tompony, ny mpamorona, ny daty namoronana, ny fahataperan'ny fampiasana, ny fampiasana farany, ary
  ny sata (Active, Expired, Revoked). Misafidiana andalana ary safidio ny Revoke mba hanafoanana azy.
  Tsy azo ampiasaina intsony ny mari-pamantarana nofoanana. Ny Create Token dia mamorona vaovao.

  ![Tabilao Tokens mitanisa ny mari-pamantarana miaraka amin'ny tompony, ny fahataperana, ny fampiasana farany, ary ny sata, eo ambonin'ny taratasy Create Token](../../images/console-tokens.png)
- **Audit** dia mitanisa ny andalana fanaraha-maso, ny vaovao indrindra aloha, ary manivana araka ny mpampiasa, fahafahana, ary
  vokatra.

  ![Tabilao Audit mitanisa ny antso miaraka amin'ny mpampiasa, mari-pamantarana, fahafahana, ary vokatra, miaraka amin'ny sivana](../../images/console-audit.png)

## Mari-pamantarana (Tokens)

Ny mari-pamantarana manokana dia mamaky ny Cacti amin'ny anaran'ny tompony. Manana endrika `cmcp_pat_` arahina
tarehimarika hex zana-tsoratra miisa 64 izy io ary mitondra ny sehatra tokana `abilities:read`. Izay
azony jerena dia voafaritry ny faritra Cacti sy ny fahazoan-dalan'ny fitaovana ananan'ny tompony, fa tsy ny
mari-pamantarana. Tsy maintsy mpampiasa mandeha manana ny faritra **MCP and Abilities API** ny tompony.

Ny mari-pamantarana dia foronina foana ho an'ny mpampiasa iray, manana fetran'andro, ary azo foanana:

- **Console.** Management > MCP > Tokens > Create Token. 1 ka hatramin'ny 365 andro ny faharetany
  ary 90 raha tsy voafaritra. Mamorona ny mari-pamantarana ny mpizara ary aseho indray mandeha eo amin'ny
  pejy valiny izany, koa adika avy hatrany ao amin'ny mpitantana tsiambaratelo ny anao. Afaka mamorona
  mari-pamantarana ho an'ny tenanao ianao. Ny famoronana iray ho an'ny mpampiasa hafa dia mila ny faritra Users/Groups
  ihany koa, satria mamaky ny Cacti amin'ny anaran'io mpampiasa io ny mari-pamantarana.
- **My MCP Tokens.** Ny mpampiasa rehetra manana ny faritra MCP and Abilities API dia afaka mitantana ny mari-pamantarany
  manokana; jereo eto ambany.
- **Andalana baikon'ny rafitra.** Tsy mandeha afa-tsy avy amin'ny CLI ny `tokens.php`, amin'ny maha kaonty OS afaka
  mitantana ny Cacti. Maka ny mari-pamantarana avy amin'ny tontolo iainana izy mba tsy hiseho na oviana na oviana
  eo amin'ny andalana baiko na ao amin'ny lisitry ny fizotran'asa ny sandany. 1 ka hatramin'ny 365 andro ny faharetany ary
  30 raha tsy voafaritra. Ny famoronana sy ny fanafoanana mari-pamantarana amin'ny alalan'ny CLI dia voarakitra amin'ny fanaraha-maso toy ny
  console, miaraka amin'ny tompon'ny mari-pamantarana ho mpisehatra satria tsy manana mpampiasa Cacti ny CLI, ka
  tsy manamarika ny andalana fanaraha-maso fa avy amin'ny CLI ny hetsika. `--list` dia manonta ny
  mari-pamantarana rehetra amin'ny endrika JSON (ID, tompony, sehatra, marika fotoana, marika fanafoanana) ary tsy manonta ny
  sandan'ny mari-pamantarana mihitsy; `--help` dia mampiseho ny fampiasana.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tsy azo foronina ho an'ny kaonty vahiny, ho an'ny mpampiasa voasakana, na ho an'ny mpampiasa
tsy manana ny faritra **MCP and Abilities API** ny mari-pamantarana, na avy amin'ny console, na ny andalana baiko, na
My MCP Tokens. Tehirizin'ny Cacti ho solonanarana na ID mpampiasa ny firafitry ny vahiny, ary mamaha ny roa tonta ny
plugin. Ny mari-pamantarana izay lasa kaonty vahiny ny tompony dia mitsahatra tsy miasa amin'ny
fangatahana manaraka.

### My MCP Tokens

Ny Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) dia tsy mila faritra fitantanana:
saronan'ny faritra **MCP and Abilities API** izany, ary miseho ho an'ny mpampiasa manana izany ihany ny singa ao amin'ny menio.
Miasa foana eo amin'ny mpampiasa tafiditra ny pejy.
Ampahany amin'ny console ny menion'ny Cacti, ka tonga eo amin'ny
pejy amin'ny alalan'ny adiresiny ny mpampiasa tsy manana fidirana amin'ny console.

![Tabilao My Tokens mitanisa ny mari-pamantarana an'ny mpampiasa tafiditra sy ny taratasy famoronana](../../images/my-tokens.png)

- **Tokens** dia mitanisa ny mari-pamantaranao, mamorona iray (1 ka hatramin'ny 365 andro, 90 raha tsy voafaritra, aseho indray mandeha
  ao amin'ny valiny), ary manafoana ny anao manokana. Tsy afaka mahita na manafoana ny an'olon-kafa ianao.
- **Activity** dia mitanisa ny hetsika nataonao, ny vaovao indrindra aloha: ny antso natao tamin'ny
  mari-pamantaranao sy ny fanovana mari-pamantarana nataonao.
- **Available Tools** dia mitanisa ireo fahafahana azon'ny mari-pamantarana anao ampiasaina amin'izao fotoana izao, miaraka amin'ny
  ID, anarana, ary famaritan'ny fahafahana tsirairay. Manaraka ny fahazoan-dalana Cacti anao sy
  ny firafitry ny fanehoana nosafidian'ny mpitantana izany.

  ![Lisitry ny Available Tools mampiseho ny ID, anarana, ary famaritan'ny fahafahana tsirairay](../../images/my-tools.png)

Ny fametrahana natao talohan'ny nisian'ity pejy ity dia manana lisitry ny rakitra faritra tsy ahitana
`mcp_tokens.php`. Ny fametrahana no manoratra ny lisitra; tsy havaozina izany amin'ny alalan'ny famelomana na
famonoana ny plugin. Esory ary apetraho indray ny plugin, avy eo omeo indray ireo faritra,
satria esorin'ny Cacti ny fanomezana faritra rehefa esorina ny plugin.

Ny tahiry angona dia tsy mitahiry afa-tsy ny hash SHA-256 an'ny mari-pamantarana, ka tsy azo
averina intsony ny mari-pamantarana very; foano izy ary mamorona iray hafa. Mitovy amin'izany ny fanoloana mifandimby: mamorona mari-pamantarana vaovao,
ovay ny mpanjifa, avy eo foano ilay taloha. Ny mari-pamantarana lany daty, ny mari-pamantarana nofoanana, ny
tompony voasakana, na ny faritra very dia samy tsy mandeha avokoa amin'ny fangatahana manaraka. Tsy ekena
afa-tsy ao amin'ny lohapejy `Authorization: Bearer` ny mari-pamantarana; tsy ekena ny mari-pamantarana ao amin'ny query string na ao amin'ny votoatin'ny fangatahana.

## Mampifandray mpanjifa

Ampiasao ny teboka fiafarana MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, miaraka amin'ny marika (token) ao amin'ny lohapejy `Authorization: Bearer`. Tehirizo ao amin'ny fari-tontolo iainana na mpitantana tsiambaratelo ny marika ary tondroy avy amin'ny kirakiran'ny mpanjifa izany fa aza soratana ao anaty rakitra ny sandany.

### Claude Code

Apetraho ao amin'ny rakitra `.mcp.json` an'ny tetikasa izay manondro ny marika amin'ny alalan'ny anarany ny teboka fiafarana.
Manitatra ny `${VAR}` ao amin'ny `url` sy `headers` ny Claude Code, ka tsy mitahiry tsiambaratelo ny rakitra ary azo antoka ny manao commit azy. Avoahy ny `CACTI_MCP_TOKEN` ao amin'ny tontolo iainana izay manomboka ny Claude Code.

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

Azonao ampiana avy amin'ny baikon'ny terminal ihany koa izany:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Amin'ny fampiasana farango roa, ny shell-nao no manitatra voalohany ny `$CACTI_MCP_TOKEN`, ka voasoratra ao amin'ny rakitra kirakira ho an'ny `--scope` voafidy (`local`, `user`, na `project`; `local` amin'ny alalan'ny mahazatra) ny sandan'ny marika. Aza mampiasa izany endrika izany miaraka amin'ny `--scope project`, ary tazony ivelan'ny fanaraha-maso kinova (version control) ilay rakitra. Aleo mampiasa ny fanondroana `.mcp.json` etsy ambony. Mamaky ny fari-pahazoan-dalana sasany (toy ny `ANTHROPIC_AUTH_TOKEN`) ho foana ao amin'ny `url` sy `headers` lavitra ny Claude Code; tsy isan'izany ny `CACTI_MCP_TOKEN`. Loharano:
[Tahirin-kevitra MCP an'ny Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot ao amin'ny VS Code

Mampiasà `.mcp.json` ao amin'ny fakan'ny toeram-piasana (na ny rakitry ny mpampiasa `~/.copilot/mcp-config.json`).
Ireo rakitra teratany an'ny Copilot ireo dia mampiasa zavatra `mcpServers` ambony indrindra sy fanondroana fari-tontolo iainana `${NAME}` ao amin'ny sandan'ny lohapejy:

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

Avoahy ny `CACTI_MCP_TOKEN` ao amin'ny tontolo iainana manomboka ny VS Code. Tsy manohana fampidirana fanontaniana `inputs` ny rakitra teratany Copilot. Mandà ny sanda `${...}` ny fanamboarana voatarika an'ny VS Code, koa ampio amin'ny fanovana ny rakitra ny lohapejy `Authorization`, fa tsy amin'ny alalan'ny dingana voatarika. Tsy manolotra ny rakitra fakan'ny toeram-piasana ny fanamboarana voatarika raha tsy mandeha ny firafitra andrana `chat.mcp.workspaceRootConfig.enabled`. Jereo ny
[Tondro kirakira MCP an'ny VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Lova: `.vscode/mcp.json`.** Milaza ny VS Code fa ny kirakira Copilot vaovao dia tsy tokony hampiasa `.vscode/mcp.json` na ny `mcp.json` an'ny mombamomba (profile); an'ny Local harness efa lany andro izy ireo, izay hesorina amin'ny Febroary 2027. Raha mbola mampiasa izany ianao, ny endrika tantanin'ny tonian-dahatsoratra dia maka fanalahidy `servers` ambony indrindra ary afaka mangataka ny marika:

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

### Mpanjifa izay miteny stdio ihany

Ny [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) dia mpampifanaraka azo isafidianana izay mandeha toy ny mpizara MCP stdio eo an-toerana ary miantso ny HTTP API an'ny plugin. Ampiasao izany ho an'ny mpanjifa tsy afaka mifandray amin'ny mpizara HTTP lavitra. Mila ilay marika manokana mitovy ihany izy io ary miresaka amin'ny `api.php`.

### Fitondran-tenan'ny MCP

Fitaovana ihany no omen'ny teboka fiafarana: ny fahaiza-manao tsirairay aseho sy nahazoana alalana dia fitaovana mitondra ny anaran'ny ID-ny, miaraka amin'ny drafitra fidirana sy fivoahana ary fanamarihana famakiana ihany (`openWorldHint` dia `false`). Mikirakira `initialize`, `server/discover`, `ping`, `tools/list`, ary `tools/call` izy. Tsy mitazona fivoriana izy, tsy mandefa `Mcp-Session-Id` (ary tsy miraharaha izay azony), ary tsy manaiky andiany JSON-RPC. Ny hafatra tsy misy `id` dia fampandrenesana ary mahazo HTTP 202 tsy misy vatana. `POST` ihany no azo ekena.

- **Fanavaozana.** Ny fangatahana mitondra `io.modelcontextprotocol/protocolVersion` ao amin'ny `params._meta` dia tsy maintsy manonona `2026-07-28`; izay zavatra hafa dia mahazo hadisoana `-32022`. Ny fangatahana toy izany dia tsy maintsy mitondra lohapejy `Mcp-Protocol-Version`, `Mcp-Method`, ary (ho an'ny `tools/call`) `Mcp-Name` mifanaraka ihany koa, raha tsy izany dia hadisoana `-32020` ny valiny. Ny fangatahana hafa dia raisina ho `2025-11-25`: mamaly amin'izany fanavaozana izany ny `initialize`, ary amin'ny fomba hafa rehetra, ny lohapejy `Mcp-Protocol-Version`, raha alefa, dia tsy maintsy `2025-11-25`, `2025-06-18`, na `2025-03-26`.
- **Hadisoan'ny fitaovana.** Ny hadisoan'ny fahaiza-manao, anisan'izany ny tohan-kevitra tsy mifanaraka amin'ny drafitra na ny sanda `arguments` izay tsy zavatra JSON, dia miverina ho valin'ny fitaovana miaraka amin'ny `isError: true` sy ny hadisoana AIP-193 ao amin'ny `structuredContent`, fa tsy toy ny hadisoan'ny protocole.
- **Hadisoan'ny protocole.** Ny tsy fahombiazana izay tsy hadisoan'ny fitaovana dia zavatra hadisoana JSON-RPC (kaody `-32000` miaraka amin'ny sata sy ny antony ao amin'ny `data`, na ny kaody mahazatra): ny tsy fisian'ny Public Cacti URL, `Origin` nolavina, fangatahana miaraka amin'ny plugin tsy mandeha na eo amin'ny poller lavitra, ary ny hadisoan'ny mpizara tsy ampoizina (`-32603`, miaraka amin'ny antsipiriany voasoratra ao amin'ny rakitra tatitra Cacti, fa tsy ao amin'ny valiny). Ny fanamarinana fangatahana mandeha voalohany (405, 413, 415) sy ny tsy fahombiazan'ny fanamarinana maha-izy azy (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) dia mitazona ny vatana AIP-193 voalaza eo ambanin'ny HTTP API.

## HTTP API

URL fototra: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Ny fifanarahana dia ao amin'ny [openapi.json](../../../openapi.json).

| Fomba sy lalana | Tanjona |
| --- | --- |
| `GET /v1/abilities` | Mitanisa ireo fahaiza-manao nahazoana alalana. Fanontaniana: `pageSize`, `pageToken`, ary `filter` amin'ny endrika `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Mamaky fahaiza-manao iray. |
| `POST /v1/abilities/{id}:execute` | Mandefa azy. Ny vatana dia `{"arguments": {...}}` indrindra. Ny valiny dia `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Manaraka ny AIP-193 ny hadisoana: zavatra `error` miaraka amin'ny `code`, `message`, `status`, ary `details` izay mitondra `ErrorInfo` miaraka amin'ny sehatra `cacti.net` sy `reason` marin-toerana. Ny olan'ny tohan-kevitra dia manampy antsipiriany `BadRequest` manonona ny saha. Voafetra ho 64 KB ny vatan'ny fangatahana, ary 1 MB ny valiny. Ireo teboka fiafarana roa ireo dia mamaly eo amin'ny poller fototra ihany ary mamerina `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) rehefa tsy mandeha ny plugin na tsy ny poller fototra ny mpizara.

| HTTP | Sanda `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (mandefa `WWW-Authenticate: Bearer` ihany koa) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (mandefa `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Manorata fahaiza-manao (mpamorona plugin)

Ny plugin Cacti mandeha dia manoratra fahaiza-manao avy amin'ny fiasa ampifandraisiny amin'ny hook `abilities_register`, matetika ao amin'ny `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Mahazo `AbilitiesRegistrar` voafetra ho an'ny plugin ny fiasa. Tsy raharahiana ny sanda averiny.

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

Ny fitsipika, izay ampiharina avokoa amin'ny fisoratana anarana:

- **ID.** Ny ID dia mifanaraka amin'ny `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, tsy mihoatra ny 64 litera/isa, ary tsy maintsy manomboka amin'ny slug an'ny plugin sy tsipika kely: `acme-` etsy ambony. Ny slug dia ny anaran'ny lahatahiry an'ny plugin, ka ny lahatahiry toy ny `my_plugin` dia tsy afaka manoratra na inona na inona. Lavina ny lahatahiry plugin mitondra ny anarana `cacti`; an'ireo voaorina ao anatiny izany sehatr'anarana izany.
- **Famaritana.** Ireto fanalahidy ireto indrindra: `label`, `description` (hatramin'ny 4096 bytes), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Tsy maintsy efa misy ny sokajy: ampiasao ny iray efa voaorina ao anatiny (`inventory`, `system`) na soraty ny anao manokana amin'ny `registerCategory()`, izay tokana ny ID-ny manerana ny plugin rehetra ary mifanaraka amin'ny `^[a-z][a-z0-9-]{0,31}$`.
- **Famakiana ihany.** `annotations` dia tsy maintsy `readOnly: true`, `destructive: false`, `idempotent: true` indrindra. Ny zavatra hafa rehetra dia miteraka hadisoana.
- **Drafitra.** `input_schema` sy `output_schema` dia tsy maintsy samy manana `type` `object` eo amin'ny ambaratonga ambony indrindra. Kely ny fiteny ary mikatona rehefa tsy mahomby. Ny zavatra dia tsy maintsy mikatona (`additionalProperties: false`, miaraka amin'ny `properties` eo); ny karazana hafa dia `integer` sy `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, ary `array` (izay mila `items` sy `maxItems`). Ny karazana iray dia azo atao manaiky null toy ny `['string', 'null']`. Ny lahatsoratra tohan-kevitra dia voafetra ho 4096 tarehintsoratra raha be indrindra amin'ny alalan'ny mahazatra; ny lahatsoratra valiny dia voafetra amin'ny `maxLength` nambara sy ny fetran'ny haben'ny valiny ihany. Fahaiza-manao 256 raha be indrindra no azo soratana.
- **`permission(int $userId): bool`.** Tsy maintsy mamerina `true` indrindra mba hamelana. Ny ID an'ny mpampiasa dia an'ny tompon'ny marika; aza mamaky ny toetry ny fivoriana na oviana na oviana.
- **`execute(int $userId, stdClass $args): array`.** Efa voamarina mifanaraka amin'ny `input_schema` ny `$args`. Ampiharo samirery ny fahazoan-dalana amin'ny ambaratongan'ny zavatra. Mamerena associative array izay mifanaraka tsara amin'ny `output_schema`; ny lisitra, saha fanampiny, na JSON mihoatra ny 1 MB dia lasa hadisoana `INVALID_RESULT`. Avoahy ny `AbilitiesError` ho an'ny tsy fahombiazana hitan'ny mpanjifa, toy ny `NOT_FOUND`.
- **Zavatra foana.** Manodika ny `[]` ho toy ny JSON array ny PHP. Na aiza naiza anambaran'ny drafitra fivoahana `object`, amin'ny halaliny rehetra, ny rejisitra dia mandray ny `[]` ho toy ny zavatra foana ary mandefa `{}`; mandeha koa ny `new stdClass()`. Ny lisitra tsy foana dia tsy raisina ho zavatra velively ary tsy mahomby miaraka amin'ny `INVALID_RESULT`. Ny sarintany `properties` foana ao amin'ny drafitra iray dia mety ho `[]` na `new stdClass()`; samy avoaka ho `{}` izy roa.
- **Fitokanana ny tsy fahombiazana.** Ny plugin tsirairay dia misoratra anarana ao amin'ny dika mitovy vonjimaika izay tazonina raha tsy miverina ara-dalàna ny fiasanao. Raha miteraka hadisoana izy, dia tsy misy amin'ireo fahaiza-manao anao voasoratra, ary voasoratra ao amin'ny tatitra ny tsy fahombiazana.

Manomboka miafina ny fahaiza-manao avy amin'ny plugin. Ny mpitantana no mamoaka azy ireo ao amin'ny takelaka Abilities eo amin'ny console, ary ny tsanganana Required Realm dia mamaky hoe "Set by the plugin" ho azy ireo.

## Modely ara-piarovana

- **Bearer ihany.** Ny `api.php` sy `mcp.php` dia mandray mari-pamantarana manokana ao amin'ny lohapejy `Authorization` ary tsy mandray zavatra hafa mihitsy. Esorin'izy ireo ny cookies, ny `$_POST`, ary ny `$_REQUEST` alohan'ny handefasana ny Cacti ary ravan'izy ireo ny fotoam-pivoriana natombok'i Cacti, ka tsy manome alalana hiditra amin'ny API mihitsy ny fidirana avy amin'ny mpitety tranonkala.
- **Fomba fandalovana CSRF.** Ny fiarovana CSRF an'ny Cacti dia mandà ny fangatahana JSON POST tsy misy mari-pamantarana CSRF an'ny Cacti, izay tsy azon'ny mpanjifa MCP alefa mihitsy. Ho an'ireo teboka fidirana roa ireo ihany, ny plugin dia manova ny anaran'ny fomba fangatahana alohan'ny handefasana ny Cacti ary mamerina izany avy eo, mba handalovan'ny fiarovana azy ireo. Azo antoka izany satria ny CSRF dia miaro ny fangatahana hamarinin'ny mpitety tranonkala amin'ny alalan'ny cookies, nefa ireo teboka fidirana ireo dia tsy mandray famantarana avy amin'ny cookie: tsy afaka mampiditra ny mari-pamantarana bearer ny pejy avy amin'ny tranonkala hafa. Ny pejin'ny console kosa dia mitazona ny fiarovana CSRF feno. Vonjimaika ity vahaolana ity mandra-panoloran'ny Cacti fanafahana tohanana; jereo ny `lib/bootstrap.php`.
- **Fanamarinana ny Origin.** Ao amin'ny `mcp.php`, raha manana lohapejy `Origin` ny fangatahana dia tsy maintsy mitovy tanteraka amin'ny scheme, ny host, ary ny port an'ny URL Cacti ho an'ny besinimaro izany, raha tsy izany dia lavina amin'ny `ORIGIN_NOT_ALLOWED` ny fangatahana. Avela kosa ny fangatahana tsy misy lohapejy `Origin`, izay fomba fifandraisan'ny mpanjifa tsy mpitety tranonkala. Izany dia manakana ny pejin-tranonkala iray tsy hibaiko ilay teboka fidirana avy amin'ny mpitety tranonkalan'ny mpitsidika. Tsy mampihatra izany fanamarinana izany ny `api.php`.
- **Famakiana ihany.** Ny fisoratana anarana dia mandà izay fahaiza-manao tsy natao ho famakiana ihany, tsy mahasimba, ary idempotent.
- **Mihatra avokoa na ny fampisehoana na ny sehatr'alalana.** Tsy maintsy aseho ny fahaiza-manao iray ary tsy maintsy manana ny sehatr'alalany ny tompon'ny mari-pamantarana. Raha tsy azo vakiana ny tabilao fampisehoana dia afenina avokoa ny fahaiza-manao rehetra fa tsy miverina amin'ny sanda fototra.
- **Mitovy endrika ny miafina, ny tsy fantatra, ary ny tsy nahazoana alalana.** Tsy afaka manavaka ny fahaiza-manao tsy misy amin'ny iray izay nafenina na tsy azon'ny mpampiasa ampiasaina ny mpanjifa: esorin'ny fikarohana izany ary mamerina `NOT_FOUND` (`ABILITY_NOT_FOUND`) ny fanatanterahana.
- **Mari-pamantarana.** Tehirizina amin'ny endrika hash SHA-256, aseho indray mandeha ihany, manana fe-potoana lany andro hatrany, azo foanana, ary lavina rehefa nakatona ny tompony na very ny sehatr'alalana.
- **Fanaraha-maso.** Ny `plugin_mcp_audit` dia mirakitra ny ID-n'ny fangatahana, ny ID-n'ny mari-pamantarana, ny ID-n'ny mpampiasa, ny fahaiza-manao, ny vokatra (`started`, `succeeded`, `failed`, `denied`, `rejected`), ary ny marik'ora. Tsy mirakitra ny tohan-kevitra, ny vokatra azo, na ny sandan'ny mari-pamantarana mihitsy izy. Mandeha ihany ny fahaiza-manao aorian'ny nanoratana ny andalana `started`; raha tsy azo ampiasaina ny tabilaon'ny fanaraha-maso dia tsy mahomby ny antso miaraka amin'ny `UNAVAILABLE` ary tsy mandeha. Ny antso nolavina talohan'ny nandehanany dia andalana iray: `denied` ho an'ny fahaiza-manao tsy fantatra, miafina, na tsy nahazoana alalana, ary `rejected` ho an'ny tohan-kevitra tsy manaraka ny schema. Ny famoronana sy ny fanafoanana mari-pamantarana avy amin'ny console, ny My MCP Tokens, ary ny CLI dia voarakitra ho `mcp-token-create` sy `mcp-token-revoke` miaraka amin'ny vokatra `succeeded`, ary ho an'ny mari-pamantarana navitrika ihany no iraketana ny fanafoanana. Ny fikarohana sy ny antso izay tsy zavatra JSON ny `arguments` ao aminy dia tsy voarakitra.
- **Firaketana tsy fahombiazana.** Ny tsy fahombiazana tsy nampoizina, ny `INVALID_RESULT`, na ny tabilaon'ny fanaraha-maso tsy azo ampiasaina dia manoratra andalana iray ao amin'ny diary Cacti miaraka amin'ny facility `MCP`: ny ID-n'ny fahaiza-manao, ny antony voafaritra, ary ny kilasin'ny exception. Tsy voarakitra ao amin'ny diary mihitsy ny hafatra, ny tohan-kevitra, ary ny mari-pamantarana.
- **Poller fototra ihany.** Ny teboka fidirana roa, ny pejin'ny console roa, ary ny `tokens.php` dia samy mandà tsy hiasa na aiza naiza hafa.

## Tsingerim-piainana

Ny fanakatonana ny plugin dia manakana ny teboka fidirana roa. Ny fanesorana ny fametrahana dia manafoana ny mari-pamantarana rehetra ary mitahiry ireo tabilao telo (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) ho an'ny fitahirizana; tsy mamelona indray ny mari-pamantarana efa nofoanana ny fametrahana indray. Ataovy backup miaraka amin'ny tahiry angon'ny Cacti ireo tabilao ireo ary ampiharo ivelan'ny plugin ny politikan'ny fitahirizana ny fanaraha-maso.

## Fampandrosoana sy fitiliana

Ny fitiliana dia script PHP tsotra mandeha tsy mila Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

Ny CI dia manamarina ny syntaxe PHP ary mandefa ny script ao amin'ny `tests/` (samy voatanisa ao amin'ny `.github/workflows/ci.yml` avy) amin'ny PHP 8.2 hatramin'ny 8.5, avy eo manamboatra ny arisiva `mcp/` azo apetraka sy ny checksum-ny. Ny fitiliana mikasika ny Cacti dia mampiasa fixtures eo amin'ny sisin'ny mpanampy Cacti; tsy manandrana fametrahana Cacti feno izy ireo.

### Fitiliana fampidirana

Ny `tests/integration/run.sh 1.2.31` na `tests/integration/run.sh develop` dia mametraka ny plugin ao anaty Cacti tena izy ao amin'ny kaontenera ary mandefa fanamarinana mivantana amin'izany. Mila Docker miaraka amin'ny Compose v2.23.1 na vaovao kokoa, git ary openssl izy io. Ny `KEEP=1` dia mamela ilay stack handeha ho an'ny debugging. Mandefa izany isan'alina sy rehefa angatahina ny CI, fa tsy amin'ny pull requests.

## Fandikana amin'ny fiteny maro

Ny Cacti MCP dia mitondra katalaogy GNU gettext voadika eo ambanin'ny `locales/po/` sy `locales/LC_MESSAGES/` ary README voadika amin'ny fiteny maro eo ambanin'ny `docs/i18n/` ho an'ny teny Anglisy miampy fiteny 44 (19 Broad Tier 1, 15 Afrikana, ary 10 Aziatika), amin'ny fampiasana ny sehatra lahatsoratra `mcp` (`locales/po/mcp.pot`). Mandefa ho azy ny katalaogy mifanaraka aminy ny Cacti rehefa alefa ny fanohanana fiteny.

## Fandraisana anjara

Alefa any amin'ny `develop` ny pull requests. Tazomy ho mifanaraka amin'ny PHP 8.2 ny kaody famokarana ary ampiasao ny fomba fanoratry ny Cacti: tabulations, rojo lahatsoratra amin'ny tsipika tokana, ary ireo mpanampy amin'ny tahiry angona sy fahazoan-dalana an'ny Cacti. Manampia fitiliana ho an'ny fanamarinana, fanomezana alalana, na fihetsiky ny protocole novana, ary soniavo amin'ny `git commit -s` ny commits. Mifandrindra amin'ny [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) amin'ny fanovana ny HTTP API.

## Lisansa

Zon'ny mpamorona (C) 2026 Thomas Vincent. Navoaka eo ambanin'ny GNU General Public License, kinova 2 na vaovao kokoa. Jereo ny [LICENSE](../../../LICENSE).
