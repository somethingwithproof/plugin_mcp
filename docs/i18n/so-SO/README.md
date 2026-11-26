<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: geed kaktus ah oo gaashaan wata. Soo hel. Oggolow. Fuli.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Ruqsadda: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP waa kordhin Cacti ah oo u oggolaanaysa macaamiisha AI inay akhriyaan
xogtaada Cacti iyagoo adeegsanaya hawlgallo magac leh oo oggolaansho lagu
shaandheeyay kuwaas oo loo yaqaan awoodo. Waxay uga adeegtaa laba hab isla
kordhinta gudaheeda: barta dhammaadka MCP (`mcp.php`, Streamable HTTP) iyo API
HTTP oo qaabka AIP ah (`api.php`). Cacti ayaa mas'uul ka sii ahaata oggolaanshaha
iyo fulinta. Macmiilku weligii si toos ah uma weydiiyo kaydka xogta; wuxuu
kaliya wici karaa awood uu maamule bandhigay oo ay oggolaadaan qaybaha Cacti ee
milkiilaha calaamadda.

Qorayaasha kordhimaha waxay iska diiwaangelin karaan awoodahooda akhris-kaliya
iyagoo adeegsanaya qabsatada `abilities_register`, waxayna macaamiisha MCP ugu
muuqdaan sidii qalab iyadoon la qorin wax koodh borotokool ah.

**Xaaladda: sii-deyn ka hor, nooca 0.1.0.** Ma jiro wax sii-deyn ah oo calaamadeysan.

Waxyaabaha maanta diyaarka ah:

- Awoodo ku dhex jira oo akhris-kaliya ah kuwaas oo loogu talagalay noocyada nidaamka iyo liiska qalabka.
- Calaamadaha gelitaanka shaqsiga ah (`cmcp_pat_...`) oo ah aqoonsiga kaliya.
- Koonsoolka Management > MCP: bandhig ama qari awoodaha, abuur oo buri
  calaamadaha, akhri diiwaanka hubinta.
- Management > My MCP Tokens: isticmaalayaashu waxay maamulaan calaamadahooda, waxay arkaan
  dhaqdhaqaaqooda, waxayna arkaan qalabka ay calaamadahoodu isticmaali karaan.
- MCP oo dul mara Streamable HTTP, dib-u-eegisyada borotokoolka `2026-07-28` iyo `2025-11-25`,
  qalabka kaliya.

Waxyaabaha aan weli diyaar ahayn:

- Galitaanka OAuth 2.1. Xidhiidhiyeyaasha la martigeliyay ee aan diri karin calaamad shaqsi ah,
  sida xidhiidhiyeyaasha gaarka ah ee ChatGPT iyo claude.ai, ma xidhiidhi karaan ilaa uu jiro.
  Waxaa loo qorsheeyay Qorshaha 2; qorshahaas weli lama qorin.
- Awoodaha wax-qorista. Kaliya awoodaha akhris-kaliya ayaa la diiwaangelin karaa.

Naqshadeyntu waxay ku jirtaa
[tilmaamaha naqshadda barta dhammaadka](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
taxanaha dhismuhuna wuxuu ku jiraa [docs/plan.md](../../plan.md).

## Awoodaha ku dhex jira

| Aqoonsiga | Doodaha | Qaybta Cacti ee loo baahan yahay |
| --- | --- | --- |
| `cacti-get-system-info` | waxba | 15 |
| `cacti-list-devices` | ikhtiyaari `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | loo baahan yahay `name`, sida `devices/12` | 3 |

Wicitaan kastaa wuxuu sidoo kale u baahan yahay qaybta **MCP and Abilities API** ee
milkiilaha calaamadda, baaxadda `abilities:read` (calaamad kasta oo shaqsi ah way leedahay),
iyo awood la bandhigay. Qaybta Abilities ee koonsoolku waxay muujisaa qaybta ay u baahan tahay
mid kasta oo ka mid ah kuwa ku dhex jira.

- `cacti-list-devices` waxay soo celisaa bogag ka kooban ilaa 100 qalab (qaabka caadiga ah waa 50)
  iyo `nextPageToken`. Calaamad bog waxay shaqaynaysaa oo keliya isla `filter` iyo
  `orderBy`. `filter` waa weedh AIP-160 ah oo isbarbardhigyo ah oo lagu xidhay `AND`,
  tusaale ahaan `state = "DOWN" AND disabled = false`. Goobaha shaandhaynta waa
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, iyo `state`. `orderBy` waxay qaadataa `displayName`, `hostname`, ama `name`,
  iyadoo mid kasta ikhtiyaari ahaan ay raaci karto `desc`.
- Weydiimaha qalabku waxay maraan `get_allowed_devices()` ee Cacti, si isticmaaluhu u arko
  oo keliya qalabka ay Cacti u tusi lahayd.
- Goobaha qalabku kama mid aha xargaha bulshada SNMP, ereyada sirta ah, iyo
  aqoonsiyada kale.

## Rakibidda

Waxay u baahan tahay Cacti 1.2.31 ama ka dambeeya, PHP 8.2 ama ka dambeeya, iyo ururiyaha weyn.
Xaqiijinta aqoonsiga Cacti waa in la shidaa; kordhintu way diiddaa inay xaqiijiso marka ay dansan tahay.

Faylka galka kordhinta waa in loo bixiyaa `mcp`, ee ma aha `plugin_mcp`. Magaca gaaban ee kordhinta,
magacyada qaybaha, bogga tarjumaadda, iyo URL-yada dhammaantood waxay isticmaalaan `mcp`.

Laga bilaabo hubinta koodhka isha:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Ilaa ay ka jiraan sii-deyno calaamadeysan, waxaad beddelkeeda kala soo degi kartaa farshaxanka
`mcp-plugin` [socodka CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
ee guuleystay. Waxay ka kooban tahay `mcp.tar.gz` iyo `SHA256SUMS`. Xaqiiji summadda hubinta,
ka dibna ka soo saar `mcp.tar.gz` gudaha galka `plugins/` ee Cacti si natiijadu u noqoto `plugins/mcp/`.
Kaydka isha ee tooska ah ee GitHub waxay isticmaalaan magac gal sare oo ka duwan. Kaydku wuxuu
ka tagaa `docs/` (oo ay ku jiraan sawirrada shaashadda ee hoose), `tests/`, iyo `.github/`,
marka xidhiidhiyeyaasha README ee galaya `docs/` waxay ka shaqeeyaan GitHub laakiin kama
shaqeeyaan nuqulka la rakibay.

Markaa:

1. Gudaha Plugin Management, rakib oo hawlgeli **Cacti MCP**. Maamulaha rakibaya
   wuxuu si toos ah u helayaa qaybta **MCP Administration**.
2. Hoosta Settings > MCP, u deji **Public Cacti URL** cinwaanka ay macaamiishu isticmaalaan,
   tusaale ahaan `https://cacti.example.com/cacti`. HTTPS waa loo baahan yahay marka laga reebo
   `localhost`, `127.0.0.1`, iyo `[::1]`. Ilaa inta tan la dejinayo, `mcp.php` waxay ku jawaabtaa HTTP 400
   oo wadata khalad JSON-RPC ah oo `data` kiisu yahay `FAILED_PRECONDITION` iyo
   `PUBLIC_URL_REQUIRED`. `api.php` ma akhrido.

   ![Settings > MCP oo muujinaysa goobta Public Cacti URL](../../images/settings-public-url.png)

3. Sii qaybta **MCP and Abilities API** isticmaale kasta oo yeelan doona calaamad.
   Ma jiro isticmaale si toos ah u helaya.
4. Hubi in adeegaha shabakadda uu u gudbiyo madaxa `Authorization` iyo macluumaadka jidka PHP
   (eeg hoos).
5. Fur Management > MCP oo bandhig awoodaha aad rabto in macaamiishu arkaan.

**Ka cusbooneysiinta dhisme horumarineed.** Kordhintu waa sii-deyn ka hor, miisaskeeda
xogtuna way isbeddeleen intii lagu jiray horumarinta iyadoon lahayn guuritaan. Haddii aad rakibtay
dhisme hore, ka saar oo mar kale rakib. Dib-u-rakibidda waxay haysaa miisaska horeba u jiray,
markaa marka hore tirtir miisaska duugga ah ee `plugin_mcp_token`, `plugin_mcp_audit`, iyo
`plugin_mcp_ability` (iyo miisaska u dhigma ee dhismayaashii la sameeyay ka hor magac-beddelka).
Kaydi haddii aad u baahan tahay taariikhdooda; calaamadaha dhismayaashaas waa la buriyaa
marka la saaro mana sii gudbaan.

### Adeegaha shabakadda

Dejinta Apache ee meesha ka saarta `Authorization` ka hor PHP waxay u baahan tahay tan
martigeliyaha dalwaddaa ama galka khuseeya, oo ay ku xigto dib-u-rarid:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache oo wata `mod_php` wuxuu u adeegay waddooyinka `api.php` iyadoon wax qaabayn jid oo dheeraad ah loo baahan.

Waddooyinka `api.php` waxay ku nool yihiin jidka ka dambeeya magaca qoraalka
(`/plugins/mcp/api.php/v1/abilities`), markaa nginx waa inuu waafajiyaa URI-yada halka `.php` uu
raaco jid dheeraad ah, kala gooyaa macluumaadka jidka, una gudbiyaa PHP. Qaybta
`location ~ \.php$` weligeed ma waafaqdo URL-yadan; nginx waxay ku jawaabtaa HTML 404 iyada u gaar ah.
Qaabka goobta iyo labada sadar ee path-info ee hoose waxaa lagu xaqiijiyay PHP-FPM;
sadarrada kale waa qaab-dhismeed caadi ah:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Hagaaji sadarrada `include` iyo `fastcgi_pass` si ay u waafaqaan qaybta horeba u adeegta
Cacti. Ha ku darin `try_files $fastcgi_script_name =404;` qaybtan: waxay nadiifisaa
`$fastcgi_path_info`, ka dibna `api.php` waxay ku jawaabtaa 404 `UNKNOWN_PATH`. Haddii
qaabayntaadu u baahan tahay `try_files`, marka hore ku kaydi qiimaha
`set $path_info $fastcgi_path_info;` oo gudbi `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` ma laha waddooyin jid mana u baahna.

## Koonsoolka

Management > MCP wuxuu leeyahay saddex qaybood. Waxaad u baahan tahay qaybta **MCP Administration**.
Sawirrada shaashadda ee halkan iyo hoose waxay ka yimaadeen dhisme horumarineed oo Cacti ah oo wata xog tusaale ah.

- **Abilities** waxay taxdaa awood kasta oo diiwaangashan iyo kordhinteeda, qaybteeda,
  qaybta oggolaanshaha ee ay u baahan tahay, iyo in la bandhigay iyo in kale. Dooro safaf oo dooro Expose ama
  Hide; waad xaqiijinaysaa ka hor intaan isbeddelku dhaqan galin. Awoodaha ku dhex jira ee `cacti-*` waa la
  bandhigay qaab ahaan. Awoodaha ka yimaada kordhimaha kale waxay ku bilaabmaan qarsoon, markaa rakibidda
  kordhin weligeed waxba ma daabacdo ilaa maamule go'aan ka gaaro. Bandhigiddu waxay
  cidhiidhisaa oo keliya gelitaanka: isticmaaluhu weli wuxuu u baahan yahay qaybta awoodda.

  ![Qaybta Abilities oo taxaysa awoodaha ku dhex jira iyadoo la socota qaybahooda iyo xaaladda bandhigidda](../../images/console-abilities.png)
- **Tokens** waxay taxdaa calaamadaha iyadoo la socda milkiilaha, abuuraha, abuurista, dhammaadka muddada, isticmaalkii u dambeeyay, iyo
  xaaladda (Active, Expired, Revoked). Dooro safaf oo dooro Revoke si aad u buriso.
  Calaamadaha la buriyay mar dambe lama isticmaali karo. Create Token waxay samaysaa mid cusub.

  ![Qaybta Tokens oo taxaysa calaamadaha iyadoo la socda milkiilaha, dhammaadka muddada, isticmaalkii u dambeeyay, iyo xaaladda, ee ka sarraysa foomka Create Token](../../images/console-tokens.png)
- **Audit** waxay taxdaa safafka hubinta, kan ugu cusub baa horreeya, waxayna ku shaandhaysaa isticmaalaha, awoodda, iyo
  natiijada.

  ![Qaybta Audit oo taxaysa wicitaannada iyadoo la socda isticmaalaha, calaamadda, awoodda, iyo natiijada, iyadoo leh shaandheeyayaal](../../images/console-audit.png)

## Calaamadaha

Calaamad shaqsi ah waxay u akhrisaa Cacti sidii milkiilaheeda. Waxay leedahay qaabka `cmcp_pat_` oo ay raacaan
64 xaraf oo hex yar ah waxayna xambaarsan tahay hal baaxad oo ah `abilities:read`. Waxa ay
arki karto waxaa go'aamiya qaybaha Cacti ee milkiilaheeda iyo oggolaanshaha qalabka, ee ma aha
calaamadda. Milkiiluhu waa inuu noqdaa isticmaale shaqaynaya oo haysta qaybta **MCP and Abilities API**.

Calaamadaha mar walba waxaa loo abuuraa isticmaale, way dhacaan, waana la burin karaa:

- **Console.** Management > MCP > Tokens > Create Token. Muddada noolaanshaha waa 1 ilaa 365 maalmood
  waxayna qaabka caadiga ah ku tahay 90. Calaamaddu waxaa soo saara adeegaha waxaana lagu muujiyaa hal mar
  bogga jawaabta, markaa isla markiiba ku koobiyee maareeyahaaga sirta. Waad u abuuri kartaa
  calaamad naftaada. U abuurista mid qof kale waxay sidoo kale u baahan tahay qaybta Users/Groups,
  sababtoo ah calaamadda waxay u akhrisaa Cacti sidii isticmaalahaas.
- **My MCP Tokens.** Isticmaale kasta oo leh qaybta MCP and Abilities API wuxuu maamuli karaa
  calaamadihiisa; eeg hoos.
- **Khadka taliska.** `tokens.php` waxay ka shaqaysaa oo keliya CLI, iyadoo loo marayo akoon OS oo
  maamuli kara Cacti. Waxay calaamadda ka qaadataa deegaanka si qiimuhu uusan weligii
  uga muuqan khadka taliska ama liiska hawlgallada. Muddada noolaanshaha waa 1 ilaa 365 maalmood waxayna
  qaabka caadiga ah ku tahay 30. Abuurista iyo burinta calaamad iyadoo loo marayo CLI waa la hubiyaa sida
  koonsoolka, iyadoo milkiilaha calaamadda uu yahay jilaha sababtoo ah CLI ma laha isticmaale Cacti, markaa
  safka hubintu ma calaamadeeyo falka inuu ka yimid CLI. `--list` waxay u daabacdaa
  calaamad kasta sidii JSON (ID, milkiile, baaxado, waqtiyada, calanka burinta) mana daabacdo
  qiimaha calaamadda weligeed; `--help` waxay muujisaa isticmaalka.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Calaamadaha looma abuuri karo akoonka martida, isticmaalayaasha dansan, ama isticmaalayaasha
aan lahayn qaybta **MCP and Abilities API**, laga bilaabo koonsoolka, khadka taliska, ama
My MCP Tokens. Cacti waxay u kaydisaa dejinta martida sidii magac isticmaale ama ID isticmaale,
kordhintuna labadaba way xallisaa. Calaamad uu milkiilaheedu noqdo akoonka martida waxay joojisaa shaqada
codsigeeda xiga.

### Calaamadahayga MCP

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) uma baahna qayb maamul:
waxaa daboolaya qaybta **MCP and Abilities API**, gelitaanka liiskuna
wuxuu u muuqdaa oo keliya isticmaalayaasha haya. Boggu wuxuu had iyo jeer ku shaqeeyaa isticmaalaha soo galay.
Liiska Cacti waa qayb ka mid ah koonsoolka, markaa isticmaalaha aan lahayn gelitaanka koonsoolka wuxuu bogga ku gaadhaa
cinwaankiisa.

![Qaybta My Tokens oo taxaysa calaamadaha isticmaalaha soo galay iyo foomka abuurista](../../images/my-tokens.png)

- **Tokens** waxay taxdaa calaamadahaaga, waxay abuurtaa mid (1 ilaa 365 maalmood, qaabka caadiga ah 90, oo hal mar
  lagu muujiyo jawaabta), waxayna burisaa kuwaaga. Ma arki kartid mana burin kartid kuwa qof kale.
- **Activity** waxay taxdaa ficillada aad samaysay, kan ugu cusub baa horreeya: wicitaannada lagu sameeyay
  calaamadahaaga iyo isbeddellada calaamadaha ee aad samaysay.
- **Available Tools** waxay taxdaa awoodaha ay calaamadahaagu isticmaali karaan hadda, iyadoo la socota
  aqoonsiga, magaca, iyo sharaxaadda awood kasta. Waxay raacdaa oggolaanshahaaga Cacti iyo
  dejinta bandhigidda ee uu maamuluhu doortay.

  ![Liiska Available Tools oo muujinaya aqoonsiga, magaca, iyo sharaxaadda awood kasta](../../images/my-tools.png)

Rakibidda la sameeyay ka hor intaan boggani jirin waxay leedahay liis faylal qayb ah oo aan lahayn
`mcp_tokens.php`. Rakibidda ayaa diiwaangelisa liiska; laguma cusbooneysiiyo hawlgelinta ama
joojinta kordhinta. Ka saar oo mar kale rakib kordhinta, ka dibna mar kale bixi qaybaha,
sababtoo ah Cacti waxay tirtirtaa deeqaha qaybaha marka kordhinta la saaro.

Kaydka xogtu wuxuu kaydiyaa oo keliya summadda SHA-256 ee calaamadda, markaa calaamad luntay dib looma
soo celin karo; buri oo mid kale abuur. Beddelidda waa isku mid: abuur calaamad cusub,
beddel macmiilka, ka dibna buri tii hore. Calaamad dhacday, calaamad la buriyay,
milkiile dansan, ama qayb luntay mid kasta wuxuu ku fashilmaa codsiga xiga. Calaamadaha waxaa lagu aqbalaa
oo keliya madaxa `Authorization: Bearer`; calaamadda ku jirta xargaha weydiinta ama jirka codsiga lama
aqbalo.

## Ku xir macaamil

Isticmaal barta dhammaadka MCP ee `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, iyadoo calaamadda sirta ahi ku jirto madaxa `Authorization: Bearer`. Ku kaydi calaamadda doorsoome deegaan ama maareeye sir ah oo ka tixraac habaynta macaamilka halkii aad qiimaheeda ku qori lahayd fayl.

### Claude Code

Geli barta dhammaadka faylka mashruuca ee `.mcp.json` kaas oo calaamadda ku tixraacaya magac. Claude Code waxay ku fidisaa `${VAR}` gudaha `url` iyo `headers`, sidaas darteed faylku ma hayo wax sir ah wuuna ammaan yahay in la gudbiyo. Ku dhoofi `CACTI_MCP_TOKEN` deegaanka bilaaba Claude Code.

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

Waxaad sidoo kale ku dari kartaa khadka taliska:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Marka la adeegsado xigashooyinka labanlaaban, qolofkaagu wuxuu marka hore fidiyaa `$CACTI_MCP_TOKEN`, sidaas darteed qiimaha calaamadda waxaa lagu qoraa faylka habaynta ee loo doortay `--scope` (`local`, `user`, ama `project`; ka caadiga ah `local`). Ha u isticmaalin qaabkaas `--scope project`, faylkana ka fogee xakamaynta noocyada. Doorbid tixraaca `.mcp.json` ee kore. Claude Code waxay u akhridaa qaar ka mid ah doorsoomayaasha aqoonsiga (sida `ANTHROPIC_AUTH_TOKEN`) inay yihiin kuwo madhan gudaha `url` iyo `headers` fog; `CACTI_MCP_TOKEN` kama mid aha kuwaas. Isha: [Dukumeentiga Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot ee gudaha VS Code

Isticmaal `.mcp.json` oo ku yaal xididka goobta shaqada (ama faylka isticmaalaha `~/.copilot/mcp-config.json`). Faylashan u gaarka ah Copilot waxay adeegsadaan shay heer sare ah oo `mcpServers` ah iyo tixraacyada doorsoomayaasha deegaanka ee `${NAME}` ee ku jira qiimayaasha madaxa:

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

Ku dhoofi `CACTI_MCP_TOKEN` deegaanka bilaaba VS Code. Faylasha u gaarka ah Copilot ma taageeraan weydiimaha `inputs`. Dejinta la hagayo ee VS Code way diiddaa qiimayaasha `${...}`, sidaas darteed ku dar madaxa `Authorization` adigoo wax ka beddelaya faylka, ee ha marin habka la hagayo. Dejinta la hagayo waxay soo bandhigtaa faylka xididka goobta shaqada oo keliya marka dejinta tijaabada ah ee `chat.mcp.workspaceRootConfig.enabled` ay shidan tahay. Eeg [tixraaca habaynta MCP ee VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Hore: `.vscode/mcp.json`.** VS Code waxay sheegaysaa in habaynta cusub ee Copilot aysan isticmaalin `.vscode/mcp.json` ama faylka astaan-qoridda ee `mcp.json`; waxay ka tirsan yihiin qalabka Local harness ee la joojiyay, kaas oo laga saari doono Febraayo 2027. Haddii aad weli isticmaasho, qaabka uu maamulo tifaftiruhu wuxuu qaataa fure heer sare ah oo `servers` ah wuxuuna ku weydiin karaa calaamadda:

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

### Macaamiisha ku hadla stdio oo keliya

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) waa qalab isku-xir oo ikhtiyaari ah kaas oo u shaqeeya sidii adeegaha maxalliga ah ee stdio MCP oo wacaya HTTP API-ga plugin-ka. U isticmaal macmiil aan ku xirmi karin adeegaha HTTP ee fog. Wuxuu u baahan yahay isla calaamadda shakhsi ahaaneed wuxuuna la hadlaa `api.php`.

### Hab-dhaqanka MCP

Barta dhammaadka waxay u adeegtaa qalabka oo keliya: awood kasta oo la soo bandhigay oo la oggolaaday waa qalab lagu magacaabo ID-geeda, oo leh qaab-dhismeedkeeda gelinta iyo soo-saarka iyo qoraallada akhris-keliya (`openWorldHint` waa `false`). Waxay maamushaa `initialize`, `server/discover`, `ping`, `tools/list`, iyo `tools/call`. Ma hayso wax fadhi ah, ma dirto `Mcp-Session-Id` (wayna iska indho-tirtaa mid ay hesho), mana aqbasho kooxaha JSON-RPC. Farriin aan lahayn `id` waa ogeysiis waxayna helaysaa HTTP 202 iyadoo aan jidh lahayn. Kaliya `POST` ayaa la oggol yahay.

- **Dib-u-eegista.** Codsiga wata `io.modelcontextprotocol/protocolVersion` gudaha `params._meta` waa inuu magacaabaa `2026-07-28`; wax kasta oo kale waxay helayaan khaladka `-32022`. Codsiyada noocaas ah waa inay sidoo kale wataan madaxyada u dhigma ee `Mcp-Protocol-Version`, `Mcp-Method`, iyo (marka loo eego `tools/call`) `Mcp-Name`, haddii kale jawaabtu waa khaladka `-32020`. Codsiyada kale waxaa loola dhaqmaa sidii `2025-11-25`: `initialize` wuxuu ku jawaabaa dib-u-eegistaas, hab kasta oo kalena madaxa `Mcp-Protocol-Version`, haddii la diro, waa inuu ahaadaa `2025-11-25`, `2025-06-18`, ama `2025-03-26`.
- **Khaladaadka qalabka.** Khalad awoodeed, oo ay ku jiraan doodaha aan u dhigmin qaab-dhismeedka ama qiimaha `arguments` ee aan ahayn shay JSON ah, wuxuu ku soo noqdaa sidii natiijo qalab oo leh `isError: true` iyo khaladka AIP-193 ee gudaha `structuredContent`, ee ma aha khalad hab-maamuus.
- **Khaladaadka hab-maamuuska.** Fashilrada aan ahayn khaladaadka qalabka waa shayada khaladka JSON-RPC (koodhka `-32000` oo leh xaaladda iyo sababta gudaha `data`, ama koodhadhka caadiga ah): maqnaanshaha URL-ka Dadweynaha ee Cacti, `Origin` la diiday, codsi iyadoo plugin-ku dansan yahay ama ku yaal cod-bixiye fog, iyo khaladaadka adeegaha ee aan la filayn (`-32603`, iyadoo faahfaahinta lagu qoro diiwaanka Cacti, ee aan lagu qorin jawaabta). Hubinta codsiyada ee marka hore shaqeeya (405, 413, 415) iyo fashilrada xaqiijinta (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) waxay ilaaliyaan jidhka AIP-193 ee lagu sharraxay qaybta HTTP API.

## HTTP API

URL-ka saldhigga: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Heshiisku wuxuu ku jiraa [openapi.json](../../../openapi.json).

| Habka iyo dariiqa | Ujeeddada |
| --- | --- |
| `GET /v1/abilities` | Liis garee awoodaha la oggolaaday. Weydiin: `pageSize`, `pageToken`, iyo `filter` leh qaabka `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Akhri hal awood. |
| `POST /v1/abilities/{id}:execute` | Ku shaqeysii. Jidhku waa mid sax ah `{"arguments": {...}}`. Jawaabtu waa `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Khaladaadku waxay raacaan AIP-193: shay `error` ah oo leh `code`, `message`, `status`, iyo `details` oo sita `ErrorInfo` leh domain `cacti.net` iyo `reason` deggan. Dhibaatooyinka dooduhu waxay ku daraan faahfaahinta `BadRequest` oo magacowda goobta. Jidhka codsiyada waxaa lagu xaddiday 64 KB, natiijooyinkana 1 MB. Labada bar dhammaadba waxay ka jawaabaan cod-bixiyaha weyn oo keliya waxayna soo celiyaan `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) marka plugin-ku dansan yahay ama adeeguhu uusan ahayn cod-bixiyaha weyn.

| HTTP | Qiimayaasha `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (sidoo kale wuxuu diraa `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (wuxuu diraa `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Qor awood (qorayaasha plugin-ka)

Plugin-ka Cacti ee shidan wuxuu diiwaangeliyaa awoodaha iyadoo laga soo qaadayo hawl uu ku xiro qabsatada `abilities_register`, badanaa gudaha `plugin_<slug>_install()`-kiisa:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Hawshu waxay heshaa `AbilitiesRegistrar` ku kooban plugin-ka. Qiimaha soo noqoshadeeda waa la iska indho-tiraa.

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

Xeerarka, oo dhammaantood la dhaqan geliyo marka la diiwaangelinayo:

- **Aqoonsiyada.** Aqoonsigu wuxuu u dhigmaa `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, wuxuu ugu badnaan yahay 64 xaraf, waana inuu ku bilaabmaa magaca gaaban (slug) ee plugin-ka iyo calaamadda jiitinka: `acme-` ee kor ku xusan. Slug-gu waa magaca galka plugin-ka, sidaas darteed gal sida `my_plugin` waxba ma diiwaangelin karo. Galka plugin-ka ee loo bixiyay `cacti` waa la diidaa; magac-booskaas wuxuu leeyahay kuwii hore loogu dhisay.
- **Qeexidda.** Furayaashan oo keliya: `label`, `description` (ilaa 4096 bytes), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Qaybtu waa inay horay u jirtaa: isticmaal mid ku dhex dhisan (`inventory`, `system`) ama ku diiwaangeli mid adiga kuu gaar ah `registerCategory()`, kaas oo ID-giisu gaar u yahay dhammaan plugin-nada oo u dhigma `^[a-z][a-z0-9-]{0,31}$`.
- **Akhris-keliya oo keliya.** `annotations` waa inay ahaadaan si sax ah `readOnly: true`, `destructive: false`, `idempotent: true`. Wax kasta oo kale waxay tuuraan khalad.
- **Qaab-dhismeedyada.** `input_schema` iyo `output_schema` mid kasta waa inuu leeyahay heerka sare `type` `object`. Lahjadda qaab-dhismeedku waa mid yar waxayna u fashilantaa si xidhan. Shayada waa inay xidhan yihiin (`additionalProperties: false`, iyadoo `properties` ay joogaan); noocyada kale waa `integer` iyo `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, iyo `array` (taas oo u baahan `items` iyo `maxItems`). Nooc waxaa laga dhigi karaa mid bannaan sida `['string', 'null']`. Xargaha dooduhu waxay si caadi ah ugu badnaan karaan 4096 xaraf; xargaha natiijada waxaa xaddidaya oo keliya `maxLength` la shaaciyay iyo xadka cabbirka natiijada. Ugu badnaan 256 awoodood ayaa la diiwaangelin karaa.
- **`permission(int $userId): bool`.** Waa inay soo celisaa si sax ah `true` si loo oggolaado. Aqoonsiga isticmaaluhu waa kan milkiilaha calaamadda; weligaa ha akhrin xaaladda fadhiga.
- **`execute(int $userId, stdClass $args): array`.** `$args` waxaa horay loogu xaqiijiyay iyadoo la raacayo `input_schema`. Adigu dhaqan geli oggolaanshaha heerka shayga. Soo celi shax xiriir leh oo si sax ah ugu dhigma `output_schema`; liis, goob dheeraad ah, ama in ka badan 1 MB oo JSON ah wuxuu noqdaa khaladka `INVALID_RESULT`. Tuur `AbilitiesError` fashilka u muuqda macaamilka, sida `NOT_FOUND`.
- **Shayada madhan.** PHP waxay u beddeshaa `[]` sidii shax JSON ah. Meel kasta oo qaab-dhismeedka soo-saarku ku dhawaaqo `object`, qoto kasta ha lahaatee, diiwaanku wuxuu ula dhaqmaa `[]` sidii shay madhan wuxuuna diraa `{}`; `new stdClass()` sidoo kale way shaqeysaa. Liis aan madhnayn weligii looma xisaabiyo shay wuxuuna ku fashilmaa `INVALID_RESULT`. Khariidad `properties` oo madhan oo ku jirta qaab-dhismeed waxay noqon kartaa `[]` ama `new stdClass()`; labaduba waxaa loo daabacaa sidii `{}`.
- **Go'doominta fashilka.** Plugin kasta wuxuu ku diiwaangeliyaa nuqul ku meel gaar ah oo la hayo oo keliya haddii hawshaadu si caadi ah u soo noqoto. Haddii ay tuurto khalad, midkoodna awoodahaaga lama diiwaangeliyo, fashilkana waa la diiwaangeliyaa.

Awoodaha ka yimaada plugin-nadu waxay ku bilowdaan iyagoo qarsoon. Maamuluhu wuxuu ku soo bandhigaa bogga console-ka ee tab-ka Abilities, tiirka Required Realm-na wuxuu u akhriyaa "Set by the plugin" iyaga.

## Qaab-dhismeedka amniga

- **Bearer oo keliya.** `api.php` iyo `mcp.php` waxay aqbalaan calaamad shakhsiyeed oo ku jirta madaxa `Authorization` oo keliya, wax kalena ma aqbalaan. Waxay tuuraan kukiyada, `$_POST`, iyo `$_REQUEST` ka hor inta uusan Cacti soo shubin, waxayna burburiyaan fadhiga uu Cacti bilaabo, sidaas darteed gelitaanka biraawsarku marnaba ma bixiyo rukhsadda API-ga.
- **Xal-ku-meel-gaar ah oo CSRF.** Ilaaliyaha CSRF ee Cacti wuxuu diidaa JSON POST aan lahayn calaamadda CSRF ee Cacti, taas oo uusan macmiilka MCP diri karin. Labadan dhammaad oo keliya, kordhinta waxay beddeshaa magaca habka codsiga ka hor inta uusan Cacti soo shubin ka dibna dib ayay u soo celisaa, si ilaaliyuhu uga boodo. Tani waa ammaan maxaa yeelay CSRF waxay ilaalisaa codsiyada uu biraawsarku ku xaqiijiyo kukiyada, dhammaadyadanna ma aqbalaan wax aqoonsi kuki ah: bog kale kuma lifaaqi karo calaamadda bearer-ka. Boggaga konsoolku waxay haystaan ilaalin CSRF oo buuxda. Xalkan ku-meel-gaarka ah waa mid socda ilaa Cacti uu bixiyo ka-dhaafitaan la taageero; eeg `lib/bootstrap.php`.
- **Hubinta asalka.** Gudaha `mcp.php`, haddii codsigu leeyahay madax `Origin`, waa inuu si sax ah ula mid noqdaa nidaamka (scheme), martigeliyaha (host), iyo dekedda (port) ee URL-ka Guud ee Cacti, haddii kalena codsiga waxaa lagu diidaa `ORIGIN_NOT_ALLOWED`. Codsiga aan lahayn madaxa `Origin`, oo ah sida macaamiisha aan biraawsarka ahayn ay u xirmaan, waa la oggol yahay. Tani waxay ka joojisaa bogga shabakadda inuu dhammaadka ka wado biraawsarka booqdayaasha. `api.php` ma dabaqo hubintan.
- **Akhri-keliya oo keliya.** Diiwaangelintu waxay diidaa awood kasta oo aan ahayn akhri-keliya, aan wax burburinayn, oo aan lahayn saameyn is-daba-joog ah (idempotent).
- **Bandhigga iyo aagagga labaduba way khuseeyaan.** Awooddu waa inay ahaataa mid la bandhigay, milkiilaha calaamadduna waa inuu haystaa aaggeeda. Haddii aan la akhrin karin shaxda bandhigga, awood kasta waa la qariyaa halkii dib loogu laaban lahaa kuwa caadiga ah.
- **Kuwa qarsoon, kuwa aan la aqoon, iyo kuwa aan la oggolayn isku mid bay u muuqdaan.** Macmiilku ma kala saari karo awood aan jirin iyo mid qarsoon ama mid uusan isticmaalaheedu adeegsan karin: sahamintu way ka saartaa, fulintuna waxay soo celisaa `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Calaamadaha.** Waxaa loo kaydiyaa sidii SHA-256 hashes, hal mar ayaa la muujiyaa, had iyo jeer way dhacaan, waa la burin karaa, waana la diidaa marka milkiiluhu naafoobo ama uu lumiyo aagga.
- **Hanti-dhawrka.** `plugin_mcp_audit` waxay diiwaangelisaa aqoonsiga codsiga, aqoonsiga calaamadda, aqoonsiga isticmaalaha, awoodda, natiijada (`started`, `succeeded`, `failed`, `denied`, `rejected`), iyo summadaha waqtiga. Marnaba ma diiwaangeliso doodyada, natiijooyinka, ama qiimayaasha calaamadda. Awooddu waxay shaqeysaa oo keliya ka dib marka safkeeda `started` la qoro; haddii aan la heli karin shaxda hanti-dhawrka, wicitaanku wuxuu ku fashilmaa `UNAVAILABLE` mana shaqeeyo. Wicitaanka la diido ka hor inta uusan shaqeyn waa hal saf: `denied` oo loogu talagalay awood aan la aqoon, qarsoon, ama aan la oggolayn, `rejected` oo loogu talagalay doodyada ku guuldarraysta qaab-dhismeedka. Abuurista iyo burinta calaamadaha ee laga sameeyo konsoolka, My MCP Tokens, iyo CLI waxaa loo diiwaangeliyaa sida `mcp-token-create` iyo `mcp-token-revoke` iyadoo natiijadu tahay `succeeded`, burintana waxaa la diiwaangeliyaa oo keliya calaamad firfircoonayd. Sahaminta, iyo wicitaanka ay `arguments` kiisu aanay ahayn shay JSON ah, lama diiwaangeliyo.
- **Diiwaanka fashilka.** Fashil lama filaan ah, `INVALID_RESULT`, ama shax hanti-dhawr oo aan la heli karin waxay hal sadar ku qoraan diiwaanka Cacti iyadoo adeegsanaysa xarunta `MCP`: aqoonsiga awoodda, sabab go'an, iyo fasalka ka-reebista. Fariimaha, doodyada, iyo calaamadaha marnaba lama diiwaangeliyo.
- **Ururiyaha weyn oo keliya.** Labada dhammaad, labada bog ee konsoolka, iyo `tokens.php` waxay diidaan inay meel kale ka shaqeeyaan.

## Wareegga nolosha

Joojinta kordhinta waxay xirtaa labada dhammaad. Ka-saarista waxay burisaa calaamad kasta waxayna u haysaa saddexda shax (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) si loo kaydiyo; dib-u-rakibidda dib uma hawlgeliso calaamad la buriyay. Ku kaydi shaxaha keydka xogta ee Cacti oo dabaq siyaasadda haynta hanti-dhawrka meel ka baxsan kordhinta.

## Horumarinta iyo tijaabooyinka

Tijaabooyinku waa qoraallo PHP ah oo caadi ah oo shaqeeya Cacti la'aanteed:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI waxay hubisaa tayada koodhka PHP waxayna ka dhex waddaa qoraallada ku jira `tests/` (mid kasta wuxuu ku qoran yahay `.github/workflows/ci.yml`) noocyada PHP 8.2 ilaa 8.5, ka dibna waxay dhistaa kaydka la rakibi karo ee `mcp/` iyo checksum-kiisa. Tijaabooyinka taabta Cacti waxay adeegsadaan qalab-tijaabo oo ku yaal xadka caawiyaha Cacti; ma tijaabiyaan rakibaad Cacti oo buuxda.

### Tijaabooyinka is-dhexgalka

`tests/integration/run.sh 1.2.31` ama `tests/integration/run.sh develop` waxay ku rakibtaa kordhinta Cacti dhab ah oo ku jira weelal waxayna ku samaysaa hubin toos ah. Waxay u baahan tahay Docker oo leh Compose v2.23.1 ama ka dambeeya, git iyo openssl. `KEEP=1` waxay u daysaa nidaamka mid shaqeynaya si loo saxo cilladaha. CI waxay waddaa habeen kasta iyo marka la dalbado, ee maaha codsiyada jiidista.

## Deegaamaynta

Cacti MCP waxay la timaaddaa buugaagta GNU gettext ee la ururiyay kuwaas oo ku hoos jira `locales/po/` iyo `locales/LC_MESSAGES/` iyo READMEs la deegaameeyay oo ku hoos jira `docs/i18n/` oo loogu talagalay Ingiriisiga iyo 47 deegaan oo dheeraad ah (19 Heerka 1-aad ee Ballaaran, 15 Afrika ah, 10 Aasiya ah, iyo Bosnian, Croatian, iyo Serbian), iyadoo adeegsanaysa aagga qoraalka ee `mcp` (`locales/po/mcp.pot`). Cacti wuxuu si toos ah u soo shubaa buugga u dhigma marka taageerada luqadda la hawlgeliyo.

## Ka-qaybgalka

Codsiyada jiidista waxay aadaan `develop`. Ku hay koodhka wax-soo-saarka mid la jaanqaada PHP 8.2 oo adeegso qaabka Cacti: tabs, xargo hal-xigasho leh, iyo caawiyayaasha keydka xogta iyo rukhsadaha ee Cacti. Ku dar tijaabooyin wixii isbeddel ah ee ku yimaada xaqiijinta, oggolaanshaha, ama hab-dhaqanka borotokoolka, oo ku saxiix ballanqaadyada `git commit -s`. Kala shaqee isbeddellada HTTP API mashruuca [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Shatiga

Xuquuqda daabacaadda (C) 2026 Thomas Vincent. Waxaa lagu sii daayay shatiga GNU General Public License, nooca 2 ama ka dambeeya. Eeg [LICENSE](../../../LICENSE).
