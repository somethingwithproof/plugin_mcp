<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kakati yenye ngao. Gundua. Idhinisha. Tekeleza.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Leseni: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP ni programu-jalizi ya Cacti inayowezesha wateja wa AI kusoma data yako ya Cacti kupitia
shughuli zilizopewa majina na kuchujwa kwa ruhusa zinazoitwa uwezo (abilities). Inazihudumia kwa njia mbili
kutoka kwa programu-jalizi yenyewe: sehemu ya mwisho ya MCP (`mcp.php`, Streamable HTTP) na
API ya HTTP ya mtindo wa AIP (`api.php`). Cacti inabaki kuwa msimamizi wa uidhinishaji na
utekelezaji. Mteja hawezi kamwe kuuliza hifadhidata moja kwa moja; anaweza tu kuita uwezo ambao
msimamizi ameufichua na ambao maeneo (realms) ya Cacti ya mmiliki wa tokeni yanaruhusu.

Waandishi wa programu-jalizi wanaweza kusajili uwezo wao wenyewe wa kusoma tu kupitia
kiunganishi cha `abilities_register`, na unaonekana kwa wateja wa MCP kama zana bila
msimbo wowote wa itifaki.

**Hali: toleo la awali, toleo la 0.1.0.** Hakuna toleo lililotiwa alama bado.

Yanayopatikana leo:

- Uwezo uliojengewa ndani wa kusoma tu kwa matoleo ya mfumo na orodha ya vifaa.
- Tokeni za ufikiaji za kibinafsi (`cmcp_pat_...`) kama kitambulisho pekee.
- Konsoli ya Management > MCP: fichua au ficha uwezo, unda na ubatilishe
  tokeni, soma kumbukumbu ya ukaguzi.
- Management > My MCP Tokens: watumiaji husimamia tokeni zao wenyewe, huona shughuli zao,
  na huona zana ambazo tokeni zao zinaweza kutumia.
- MCP kupitia Streamable HTTP, marekebisho ya itifaki `2026-07-28` na `2025-11-25`,
  zana pekee.

Ambavyo havipatikani bado:

- Kuingia kwa OAuth 2.1. Viunganishi vilivyopangishwa ambavyo haviwezi kutuma tokeni ya kibinafsi, kama vile
  viunganishi maalum vya ChatGPT na claude.ai, haviwezi kuunganishwa hadi kiwepo. Kimepangwa
  kama Mpango wa 2; mpango huo bado haujaandikwa.
- Uwezo wa kuandika. Uwezo wa kusoma tu ndio unaoweza kusajiliwa.

Muundo umo katika
[vipimo vya muundo wa sehemu ya mwisho](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
na mfuatano wa ujenzi umo katika [docs/plan.md](../../plan.md).

## Uwezo uliojengewa ndani

| Kitambulisho (ID) | Hoja (Arguments) | Eneo la Cacti linalohitajika |
| --- | --- | --- |
| `cacti-get-system-info` | hakuna | 15 |
| `cacti-list-devices` | za hiari `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | ya lazima `name`, kama vile `devices/12` | 3 |

Kila mwito pia unahitaji eneo la **MCP and Abilities API** kwa mmiliki wa tokeni,
wigo wa `abilities:read` (kila tokeni ya kibinafsi inao), na uwezo
uliofichuliwa. Kichupo cha Abilities cha konsoli kinaonyesha eneo ambalo kila uwezo uliojengewa ndani linahitaji.

- `cacti-list-devices` hurejesha kurasa za hadi vifaa 100 (chaguo-msingi 50) na
  `nextPageToken`. Tokeni ya ukurasa ni halali tu kwa `filter` na
  `orderBy` zilezile. `filter` ni usemi wa AIP-160 wa ulinganisho uliounganishwa na `AND`,
  kwa mfano `state = "DOWN" AND disabled = false`. Sehemu za kichujio ni
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, na `state`. `orderBy` huchukua `displayName`, `hostname`, au `name`,
  kila moja ikifuatiwa kwa hiari na `desc`.
- Maswali ya vifaa hupitia `get_allowed_devices()` ya Cacti, hivyo mtumiaji huona tu
  vifaa ambavyo Cacti ingemwonyesha.
- Sehemu za kifaa hazijumuishi misururu ya jamii ya SNMP, kaulisiri, na vitambulisho
  vingine.

## Sakinisha

Inahitaji Cacti 1.2.31 au mpya zaidi, PHP 8.2 au mpya zaidi, na poller kuu. Uthibitishaji wa Cacti
lazima uwe umewezeshwa; programu-jalizi hukataa kuthibitisha unapokuwa umezimwa.

Saraka ya programu-jalizi lazima iitwe `mcp`, si `plugin_mcp`. Jina fupi la programu-jalizi, majina ya maeneo,
kikoa cha tafsiri, na URL zote hutumia `mcp`.

Kutoka kwa nakala ya msimbo chanzo:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Hadi matoleo yaliyotiwa alama yawepo, unaweza badala yake kupakua kijenzi cha `mcp-plugin`
kutoka kwa
[uendeshaji wa CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) uliofaulu.
Kina `mcp.tar.gz` na `SHA256SUMS`. Thibitisha checksum, kisha utoe
`mcp.tar.gz` ndani ya saraka ya `plugins/` ya Cacti ili matokeo yawe `plugins/mcp/`.
Kumbukumbu za chanzo otomatiki za GitHub hutumia jina tofauti la saraka ya ngazi ya juu.
Kumbukumbu huacha `docs/` (ikiwa ni pamoja na picha za skrini zilizo hapa chini), `tests/`, na
`.github/`, kwa hivyo viungo vya README kwenda `docs/` hufanya kazi kwenye GitHub lakini si katika nakala
iliyosakinishwa.

Kisha:

1. Katika Plugin Management, sakinisha na uwashe **Cacti MCP**. Msimamizi
   anayesakinisha hupokea eneo la **MCP Administration** kiotomatiki.
2. Chini ya Settings > MCP, weka **Public Cacti URL** kuwa anwani ambayo wateja hutumia, kwa
   mfano `https://cacti.example.com/cacti`. HTTPS inahitajika isipokuwa kwa
   `localhost`, `127.0.0.1`, na `[::1]`. Hadi hii iwekwe, `mcp.php` hujibu HTTP 400
   ikiwa na kosa la JSON-RPC ambalo `data` yake ni `FAILED_PRECONDITION` na
   `PUBLIC_URL_REQUIRED`. `api.php` haisomi hii.

   ![Settings > MCP ikionyesha sehemu ya Public Cacti URL](../../images/settings-public-url.png)

3. Mpe eneo la **MCP and Abilities API** kila mtumiaji ambaye atamiliki tokeni.
   Hakuna mtumiaji anayelipokea kiotomatiki.
4. Hakikisha seva ya wavuti inapitisha kichwa cha `Authorization` na maelezo ya njia kwenda kwa PHP
   (tazama hapa chini).
5. Fungua Management > MCP na ufichue uwezo unaotaka wateja wauone.

**Kuboresha kutoka kwa toleo la uundaji.** Programu-jalizi ni ya awali, na majedwali yake
yalibadilika wakati wa uundaji bila uhamishaji (migrations). Ikiwa ulisakinisha toleo la
awali, liondoe na usakinishe tena. Kusakinisha tena huhifadhi majedwali ambayo tayari
yapo, hivyo futa kwanza majedwali ya zamani ya `plugin_mcp_token`, `plugin_mcp_audit`, na
`plugin_mcp_ability` (na majedwali yanayolingana kutoka kwa
matoleo yaliyotengenezwa kabla ya kubadilisha jina). Yahifadhi nakala ikiwa unahitaji historia yake; tokeni kutoka kwa
matoleo hayo hubatilishwa zinapoondolewa na hazihamishiwi.

### Seva ya wavuti

Mipangilio ya Apache inayoondoa `Authorization` kabla ya PHP inahitaji hii katika
seva pepe au saraka husika, ikifuatiwa na kupakia upya:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache iliyo na `mod_php` ilihudumia njia za `api.php` bila usanidi wowote wa ziada wa njia.

Njia za `api.php` hukaa katika njia baada ya jina la hati
(`/plugins/mcp/api.php/v1/abilities`), kwa hivyo nginx lazima ilinganishe URI ambapo `.php`
inafuatiwa na njia zaidi, itenganishe maelezo ya njia, na kuyapitisha kwa PHP. Kizuizi cha
`location ~ \.php$` hakilingani kamwe na URL hizi; nginx hujibu kwa HTML 404 yake yenyewe.
Mchoro wa eneo na mistari miwili ya maelezo ya njia iliyo hapa chini ilithibitishwa na
PHP-FPM; mistari mingine ni kiolezo cha kawaida:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Rekebisha mistari ya `include` na `fastcgi_pass` ili ilingane na kizuizi ambacho tayari kinahudumia
Cacti. Usiongeze `try_files $fastcgi_script_name =404;` kwenye kizuizi hiki: kinafuta
`$fastcgi_path_info`, na `api.php` kisha hujibu 404 `UNKNOWN_PATH`. Ikiwa usanidi wako
unahitaji `try_files`, hifadhi thamani kwanza kwa
`set $path_info $fastcgi_path_info;` na upitishe `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` haina njia za path na haihitaji hizo.

## Konsoli

Management > MCP ina vichupo vitatu. Unahitaji eneo la **MCP Administration**.
Picha za skrini hapa na chini ni kutoka kwa toleo la uundaji la Cacti lenye data ya mfano.

- **Abilities** huorodhesha kila uwezo uliosajiliwa pamoja na programu-jalizi yake, kategoria,
  eneo linalohitajika, na ikiwa umefichuliwa. Chagua safu mlalo na uchague Expose au
  Hide; unathibitisha kabla ya mabadiliko kutumika. Uwezo uliojengewa ndani wa `cacti-*`
  umefichuliwa kwa chaguo-msingi. Uwezo kutoka kwa programu-jalizi nyingine huanza ukiwa umefichwa, hivyo kusakinisha
  programu-jalizi hakuchapishi chochote kamwe hadi msimamizi aamue. Kufichua
  hupunguza ufikiaji tu: mtumiaji bado anahitaji eneo la uwezo huo.

  ![Kichupo cha Abilities kikiorodhesha uwezo uliojengewa ndani pamoja na maeneo yake na hali ya ufichuzi](../../images/console-abilities.png)
- **Tokens** huorodhesha tokeni pamoja na mmiliki, muundaji, uundaji, muda wa kuisha, matumizi ya mwisho, na
  hali (Active, Expired, Revoked). Chagua safu mlalo na uchague Revoke ili kuzibatilisha.
  Tokeni zilizobatilishwa haziwezi kutumika tena. Create Token huunda mpya.

  ![Kichupo cha Tokens kikiorodhesha tokeni pamoja na mmiliki, muda wa kuisha, matumizi ya mwisho, na hali, juu ya fomu ya Create Token](../../images/console-tokens.png)
- **Audit** huorodhesha safu mlalo za ukaguzi, mpya zaidi kwanza, na huchuja kwa mtumiaji, uwezo, na
  matokeo.

  ![Kichupo cha Audit kikiorodhesha miito pamoja na mtumiaji, tokeni, uwezo, na matokeo, kikiwa na vichujio](../../images/console-audit.png)

## Tokeni

Tokeni ya kibinafsi husoma Cacti kama mmiliki wake. Ina muundo wa `cmcp_pat_` ikifuatiwa na
vibambo 64 vya herufi ndogo za heksadesimali na hubeba wigo mmoja wa `abilities:read`. Kile
inachoweza kuona kinaamuliwa na maeneo ya Cacti ya mmiliki wake na ruhusa za vifaa, si kwa
tokeni. Mmiliki lazima awe mtumiaji aliyewezeshwa ambaye anashikilia eneo la **MCP and Abilities API**.

Tokeni huundwa kila wakati kwa ajili ya mtumiaji, huisha muda wake, na zinaweza kubatilishwa:

- **Konsoli.** Management > MCP > Tokens > Create Token. Muda wa uhai ni siku 1 hadi 365
  na chaguo-msingi ni 90. Tokeni hutengenezwa na seva na kuonyeshwa mara moja kwenye
  ukurasa wa majibu, kwa hivyo inakili kwenye kidhibiti chako cha siri mara moja. Unaweza kuunda
  tokeni kwa ajili yako mwenyewe. Kuunda moja kwa ajili ya mtumiaji mwingine pia kunahitaji eneo la Users/Groups,
  kwa sababu tokeni husoma Cacti kama mtumiaji huyo.
- **My MCP Tokens.** Mtumiaji yeyote aliye na eneo la MCP and Abilities API anaweza kusimamia tokeni zake
  mwenyewe; tazama hapa chini.
- **Mstari wa amri.** `tokens.php` huendeshwa kutoka kwa CLI pekee, kama akaunti ya OS inayoweza
  kusimamia Cacti. Inachukua tokeni kutoka kwa mazingira ili thamani isionekane
  kamwe kwenye mstari wa amri au katika orodha ya michakato. Muda wa uhai ni siku 1 hadi 365 na
  chaguo-msingi ni 30. Kuunda na kubatilisha tokeni kupitia CLI kunakaguliwa kama
  konsoli, na mmiliki wa tokeni kama mhusika kwa sababu CLI haina mtumiaji wa Cacti, hivyo
  safu mlalo ya ukaguzi haiashirii kitendo hicho kama kinatoka kwa CLI. `--list` huchapisha
  kila tokeni kama JSON (ID, mmiliki, mawigo, mihuri ya muda, alama iliyobatilishwa) na kamwe si
  thamani ya tokeni; `--help` huonyesha matumizi.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Tokeni haziwezi kuundwa kwa akaunti ya mgeni, kwa watumiaji waliozimwa, au kwa watumiaji
wasio na eneo la **MCP and Abilities API**, kutoka kwa konsoli, mstari wa amri, au
My MCP Tokens. Cacti huhifadhi mpangilio wa mgeni kama jina la mtumiaji au kitambulisho cha mtumiaji, na
programu-jalizi hutatua zote mbili. Tokeni ambayo mmiliki wake anakuwa akaunti ya mgeni huacha kufanya kazi kwenye
ombi lake linalofuata.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) haihitaji eneo la usimamizi:
inashughulikiwa na eneo la **MCP and Abilities API**, na ingizo la menyu
huonekana tu kwa watumiaji wanaolishikilia. Ukurasa hufanya kazi kila wakati kwa mtumiaji aliyeingia.
Menyu ya Cacti ni sehemu ya konsoli, kwa hivyo mtumiaji asiye na ufikiaji wa konsoli hufikia
ukurasa kwa anwani yake.

![Kichupo cha My Tokens kikiorodhesha tokeni za mtumiaji aliyeingia na fomu ya kuunda](../../images/my-tokens.png)

- **Tokens** huorodhesha tokeni zako, huunda moja (siku 1 hadi 365, chaguo-msingi 90, huonyeshwa mara moja
  katika jibu), na hubatilisha zako mwenyewe. Huwezi kuona au kubatilisha za mtu mwingine yeyote.
- **Activity** huorodhesha vitendo ulivyofanya, vipya zaidi kwanza: miito iliyofanywa kwa
  tokeni zako na mabadiliko ya tokeni uliyofanya.
- **Available Tools** huorodhesha uwezo ambao tokeni yako inaweza kutumia sasa hivi, pamoja na
  kitambulisho, jina, na maelezo ya kila uwezo. Inafuata ruhusa zako za Cacti na
  mipangilio ya ufichuzi ambayo msimamizi alichagua.

  ![Orodha ya Available Tools ikionyesha kitambulisho, jina, na maelezo ya kila uwezo](../../images/my-tools.png)

Usakinishaji uliofanywa kabla ya ukurasa huu kuwepo una orodha ya faili za eneo bila
`mcp_tokens.php`. Kusakinisha husajili orodha hiyo; haiboreshwi kwa kuwasha au
kuzima programu-jalizi. Ondoa na usakinishe programu-jalizi tena, kisha utoe maeneo
tena, kwa sababu Cacti huondoa ruzuku za maeneo programu-jalizi inapoondolewa.

Hifadhidata huhifadhi hash ya SHA-256 ya tokeni pekee, hivyo tokeni iliyopotea haiwezi
kurejeshwa; ibatilishe na uunde nyingine. Mzunguko (rotation) ni sawa: unda tokeni mpya,
badilisha mteja, kisha batilisha ya zamani. Tokeni iliyoisha muda, tokeni iliyobatilishwa,
mmiliki aliyezimwa, au eneo lililopotea kila moja hushindwa kwenye ombi linalofuata. Tokeni zinakubaliwa
katika kichwa cha `Authorization: Bearer` pekee; tokeni katika msururu wa hoja au kiini
haikubaliwi.

## Unganisha mteja

Tumia sehemu ya mwisho ya MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, ukiwa na tokeni katika kichwa cha `Authorization: Bearer`. Weka tokeni katika kibadiliko cha mazingira au kidhibiti siri na uirejelee kutoka kwa usanidi wa mteja badala ya kuandika thamani yake kwenye faili.

### Claude Code

Weka sehemu ya mwisho katika faili ya mradi ya `.mcp.json` inayorejelea tokeni kwa jina. Claude Code hupanua `${VAR}` katika `url` na `headers`, kwa hivyo faili hiyo haihifadhi siri yoyote na ni salama kuwasilishwa kwenye hazina. Hamisha `CACTI_MCP_TOKEN` katika mazingira yanayoanzisha Claude Code.

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

Unaweza pia kuiongeza kutoka kwa mstari wa amri:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Ukitumia alama za kunukuu maradufu, sheli yako hupanua `$CACTI_MCP_TOKEN` kwanza, kwa hivyo thamani ya tokeni huandikwa kwenye faili ya usanidi kwa `--scope` iliyochaguliwa (`local`, `user`, au `project`; chaguo-msingi ni `local`). Usitumie muundo huo na `--scope project`, na weka faili hiyo nje ya udhibiti wa matoleo. Pendelea marejeleo ya `.mcp.json` hapo juu. Claude Code husoma baadhi ya vibadiliko vya vitambulisho (kama vile `ANTHROPIC_AUTH_TOKEN`) kama tupu katika `url` na `headers` za mbali; `CACTI_MCP_TOKEN` si mojawapo ya hizo. Chanzo: [Nyaraka za Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot katika VS Code

Tumia faili ya `.mcp.json` kwenye mzizi wa eneo la kazi (au faili ya mtumiaji `~/.copilot/mcp-config.json`). Faili hizi asili za Copilot hutumia kipengee cha kiwango cha juu cha `mcpServers` na marejeleo ya vibadiliko vya mazingira ya `${NAME}` katika thamani za vichwa:

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

Hamisha `CACTI_MCP_TOKEN` katika mazingira yanayoanzisha VS Code. Faili asili za Copilot hazitumii vidokezo vya `inputs`. Usanidi elekezi wa VS Code hukataa thamani za `${...}`, kwa hivyo ongeza kichwa cha `Authorization` kwa kuhariri faili, si kupitia mtiririko elekezi. Usanidi elekezi hutoa faili ya mzizi wa eneo la kazi pale tu ambapo mpangilio wa majaribio wa `chat.mcp.workspaceRootConfig.enabled` umewashwa. Tazama [Marejeleo ya usanidi wa VS Code MCP](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Ya zamani: `.vscode/mcp.json`.** VS Code inasema usanidi mpya wa Copilot haupaswi kutumia `.vscode/mcp.json` au `mcp.json` ya wasifu; hizo ni za mfumo wa zamani wa Local harness ambao utaondolewa mnamo Februari 2027. Ikiwa bado unaitumia, umbizo linalodhibitiwa na kihariri huchukua ufunguo wa kiwango cha juu wa `servers` na linaweza kuomba tokeni:

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

### Wateja wanaotumia stdio pekee

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ni kiunganishi cha hiari kinachoendeshwa kama seva ya ndani ya stdio MCP na kuita API ya HTTP ya programu-jalizi. Kitumie kwa mteja asiyeweza kuunganisha kwenye seva ya mbali ya HTTP. Kinahitaji tokeni ileile ya kibinafsi na huwasiliana na `api.php`.

### Tabia ya MCP

Sehemu hii ya mwisho hutoa zana pekee: kila uwezo uliofichuliwa na ulioruhusiwa ni zana iliyopewa jina kwa kitambulisho chake, ikiwa na miundo yake ya ingizo na towe na ufafanuzi wa kusoma pekee (`openWorldHint` ni `false`). Hushughulikia `initialize`, `server/discover`, `ping`, `tools/list`, na `tools/call`. Haihifadhi kipindi, haitumi `Mcp-Session-Id` (na hupuuza yoyote inayopokea), na haikubali makundi ya JSON-RPC. Ujumbe usio na `id` ni arifa na hupata HTTP 202 bila maudhui ya mwili. `POST` pekee ndiyo inayoruhusiwa.

- **Matoleo.** Ombi linalobeba `io.modelcontextprotocol/protocolVersion` katika `params._meta` lazima litaje `2026-07-28`; kingine chochote hupata kosa `-32022`. Maombi kama hayo lazima pia yabebe vichwa vinavyolingana vya `Mcp-Protocol-Version`, `Mcp-Method`, na (kwa `tools/call`) `Mcp-Name`, la sivyo jibu ni kosa `-32020`. Maombi mengine huchukuliwa kama `2025-11-25`: `initialize` hujibu kwa toleo hilo, na kwa mbinu nyingine yoyote kichwa cha `Mcp-Protocol-Version`, ikiwa kitatumwa, lazima kiwe `2025-11-25`, `2025-06-18`, au `2025-03-26`.
- **Makosa ya zana.** Kosa la uwezo, ikijumuisha hojaji zisizolingana na muundo au thamani ya `arguments` ambayo si kipengee cha JSON, hurudi kama matokeo ya zana yenye `isError: true` na kosa la AIP-193 katika `structuredContent`, si kama kosa la itifaki.
- **Makosa ya itifaki.** Hitilafu ambazo si makosa ya zana ni vipengee vya makosa vya JSON-RPC (msimbo `-32000` pamoja na hali na sababu katika `data`, au misimbo ya kawaida): URL ya Umma ya Cacti inayokosekana, `Origin` iliyokataliwa, ombi wakati programu-jalizi imezimwa au kwenye poller ya mbali, na makosa ya seva yasiyotarajiwa (`-32603`, ambapo maelezo huandikwa kwenye kumbukumbu ya Cacti, si kwenye jibu). Ukaguzi wa maombi unaofanyika kwanza (405, 413, 415) na hitilafu za uthibitishaji (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) huhifadhi mwili wa AIP-193 uliofafanuliwa chini ya API ya HTTP.

## API ya HTTP

URL Msingi: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Mkataba uko katika [openapi.json](../../../openapi.json).

| Mbinu na njia | Kusudi |
| --- | --- |
| `GET /v1/abilities` | Orodhesha uwezo ulioruhusiwa. Hoja: `pageSize`, `pageToken`, na `filter` ya muundo `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Soma uwezo mmoja. |
| `POST /v1/abilities/{id}:execute` | Uendeshe. Mwili ni `{"arguments": {...}}` haswa. Jibu ni `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Makosa hufuata AIP-193: kipengee cha `error` chenye `code`, `message`, `status`, na `details` kinachobeba `ErrorInfo` yenye kikoa cha `cacti.net` na `reason` thabiti. Matatizo ya hojaji huongeza maelezo ya `BadRequest` yanayotaja uga husika. Miili ya maombi ina kikomo cha KB 64, na matokeo ni MB 1. Sehemu zote mbili za mwisho hujibu kwenye poller kuu pekee na hurejesha `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) wakati programu-jalizi imezimwa au seva si poller kuu.

| HTTP | Thamani za `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (also sends `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (sends `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Andika uwezo (waandishi wa programu-jalizi)

Programu-jalizi ya Cacti iliyowezeshwa husajili uwezo kutoka kwa kitendakazi inachokiambatanisha kwenye ndoano ya `abilities_register`, kwa kawaida ndani ya `plugin_<slug>_install()` yake:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Kitendakazi hiki hupokea `AbilitiesRegistrar` iliyowekwa wigo kwa programu-jalizi hiyo. Thamani yake ya kurejesha hupuuzwa.

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

Sheria, zote zikitekelezwa wakati wa usajili:

- **Vitambulisho.** Kitambulisho hulingana na `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, kina herufi zisizozidi 64, na lazima kianze na slug ya programu-jalizi na kistari kifupi: `acme-` hapo juu. Slug ni jina la saraka ya programu-jalizi, kwa hivyo saraka kama `my_plugin` haiwezi kusajili chochote. Saraka ya programu-jalizi inayoitwa `cacti` hukataliwa; nafasi hiyo ya majina ni ya vilivyojengewa ndani.
- **Ufafanuzi.** Funguo hizi pekee: `label`, `description` (hadi baiti 4096), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Kategoria lazima tayari iwepo: tumia iliyojengewa ndani (`inventory`, `system`) au sajili yako mwenyewe ukitumia `registerCategory()`, ambayo kitambulisho chake ni cha kipekee kati ya programu-jalizi zote na hulingana na `^[a-z][a-z0-9-]{0,31}$`.
- **Kusoma pekee.** `annotations` lazima ziwe `readOnly: true`, `destructive: false`, `idempotent: true` haswa. Kingine chochote hutupa kosa.
- **Miundo.** `input_schema` na `output_schema` lazima kila moja iwe na `type` ya kiwango cha juu ya `object`. Lahaja ni ndogo na hushindwa kwa kufunga. Vipengee lazima vifungwe (`additionalProperties: false`, vikiwa na `properties`); aina nyingine ni `integer` na `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, na `array` (ambayo inahitaji `items` na `maxItems`). Aina inaweza kufanywa iweze kuwa tupu kama `['string', 'null']`. Mifuatano ya hojaji kwa chaguo-msingi ina ukomo wa herufi 4096; mifuatano ya matokeo hupunguzwa tu na `maxLength` iliyotangazwa na kikomo cha ukubwa wa matokeo. Uwezo usiozidi 256 unaweza kusajiliwa.
- **`permission(int $userId): bool`.** Lazima irejeshe `true` haswa ili kuruhusu. Kitambulisho cha mtumiaji ni cha mmiliki wa tokeni; usiwahi kusoma hali ya kipindi.
- **`execute(int $userId, stdClass $args): array`.** `$args` tayari imethibitishwa dhidi ya `input_schema`. Tekeleza ruhusa za kiwango cha kipengee wewe mwenyewe. Rejesha safu shirikishi inayolingana na `output_schema` haswa; orodha, uga wa ziada, au zaidi ya MB 1 ya JSON huwa kosa la `INVALID_RESULT`. Tupa `AbilitiesError` kwa hitilafu inayoonekana kwa mteja, kama vile `NOT_FOUND`.
- **Vipengee tupu.** PHP husimba `[]` kama safu ya JSON. Popote ambapo muundo wa towe unatangaza `object`, katika kina chochote, sajili huchukulia `[]` kama kipengee tupu na kutuma `{}`; `new stdClass()` hufanya kazi pia. Orodha isiyo tupu haihesabiwi kamwe kama kipengee na hushindwa na `INVALID_RESULT`. Ramani tupu ya `properties` katika muundo inaweza kuwa `[]` au `new stdClass()`; zote mbili huchapishwa kama `{}`.
- **Utengaji wa hitilafu.** Kila programu-jalizi husajili kwenye nakala ya muda inayohifadhiwa tu ikiwa kitendakazi chako kitarejea kawaida. Ikitupa kosa, hakuna hata uwezo wako mmoja unaosajiliwa, na hitilafu hurekodiwa kwenye kumbukumbu.

Uwezo kutoka kwa programu-jalizi huanza ukiwa umefichwa. Msimamizi huuonyesha kwenye kichupo cha Abilities cha kiweko, na safu wima ya Required Realm husomeka "Set by the plugin" kwa uwezo huo.

## Muundo wa usalama

- **Bearer pekee.** `api.php` na `mcp.php` hukubali tokeni binafsi kwenye kichwa cha
  `Authorization` na si kingine chochote. Huondoa vidakuzi, `$_POST`, na
  `$_REQUEST` kabla ya Cacti kupakia na huharibu kipindi ambacho Cacti huanzisha,
  hivyo kuingia kupitia kivinjari kamwe hakutoi ufikiaji wa API.
- **Mbinu mbadala ya CSRF.** Kilinzi cha CSRF cha Cacti hukataa ombi la JSON POST
  lisilo na tokeni ya CSRF ya Cacti, ambayo hakuna mteja wa MCP anayeweza kutuma.
  Kwa miisho hii miwili pekee, programu-jalizi hubadilisha jina la mbinu ya ombi
  kabla ya Cacti kupakia na kulirejesha baadaye, ili kilinzi kiruke maombi hayo.
  Hii ni salama kwa sababu CSRF hulinda maombi ambayo kivinjari huyathibitisha kwa
  vidakuzi, na miisho hii haikubali utambulisho wowote wa kidakuzi: ukurasa wa
  tovuti nyingine hauwezi kuambatisha tokeni ya bearer. Kurasa za kiweko huhifadhi
  ulinzi kamili wa CSRF. Mbinu hii mbadala ni ya muda, hadi Cacti itakapotoa
  msamaha unaoauniwa; angalia `lib/bootstrap.php`.
- **Ukaguzi wa chanzo (Origin).** Kwenye `mcp.php`, ikiwa ombi lina kichwa cha
  `Origin` lazima lilingane kikamilifu na mpango (scheme), mwenyeji (host), na
  mlango (port) wa URL ya Umma ya Cacti, la sivyo ombi litakataliwa kwa
  `ORIGIN_NOT_ALLOWED`. Ombi lisilo na kichwa cha `Origin`, ambalo ndilo wateja
  wasio wa kivinjari hutumia kuunganisha, linaruhusiwa. Hii huzuia ukurasa wa
  wavuti kuendesha mwisho huu kutoka kwa kivinjari cha mgeni. `api.php` haitumii
  ukaguzi huu.
- **Kusoma pekee.** Usajili hukataa uwezo wowote ambao si wa kusoma pekee,
  usioharibu, na unaotoa matokeo sawa unapoitwa tena (idempotent).
- **Ufichuzi na maeneo (realms) vyote viwili hutumika.** Uwezo lazima uwe
  umefichuliwa na mmiliki wa tokeni lazima awe na eneo lake (realm). Ikiwa jedwali
  la ufichuzi haliwezi kusomwa, kila uwezo hufichwa badala ya kurejelea mipangilio
  chaguo-msingi.
- **Vilivyofichwa, visivyojulikana, na visivyoruhusiwa huonekana sawa.** Mteja
  hawezi kutofautisha uwezo ambao haupo na ule uliofichwa au ambao mtumiaji wake
  haruhusiwi kutumia: ugunduzi huuacha nje na utekelezaji hurejesha `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Tokeni.** Huhifadhiwa kama hashi za SHA-256, huonyeshwa mara moja, huisha
  muda wake kila wakati, zinaweza kubatilishwa, na hukataliwa wakati mmiliki
  amelemazwa au amepoteza eneo (realm).
- **Ukaguzi.** `plugin_mcp_audit` hurekodi kitambulisho cha ombi, kitambulisho cha
  tokeni, kitambulisho cha mtumiaji, uwezo, matokeo (`started`, `succeeded`,
  `failed`, `denied`, `rejected`), na mihuri ya muda. Kamwe hairekodi hoja,
  matokeo, au thamani za tokeni. Uwezo huendeshwa tu baada ya safu mlalo yake ya
  `started` kuandikwa; ikiwa jedwali la ukaguzi halipatikani wito hushindwa kwa
  `UNAVAILABLE` na hauendeshwi. Wito unaokataliwa kabla ya kuendeshwa ni safu
  mlalo moja: `denied` kwa uwezo usiojulikana, uliofichwa, au usioruhusiwa,
  `rejected` kwa hoja zinazoshindwa katika muundo (schema). Uundaji na ubatilishaji
  wa tokeni kutoka kwa kiweko, My MCP Tokens, na CLI hurekodiwa kama
  `mcp-token-create` na `mcp-token-revoke` zikiwa na matokeo `succeeded`, na
  ubatilishaji hurekodiwa tu kwa tokeni iliyokuwa hai. Ugunduzi, na wito ambao
  `arguments` zake si kipengee cha JSON, hazirekodiwi.
- **Kumbukumbu ya hitilafu.** Kushindwa kusikotarajiwa, `INVALID_RESULT`, au
  jedwali la ukaguzi lisilopatikana huandika mstari mmoja kwenye kumbukumbu ya
  Cacti na kituo (facility) `MCP`: kitambulisho cha uwezo, sababu isiyobadilika,
  na darasa la hitilafu (exception class). Ujumbe, hoja, na tokeni kamwe
  hazirekodiwi.
- **Kikusanyaji kikuu (main poller) pekee.** Miisho yote miwili, kurasa zote
  mbili za kiweko, na `tokens.php` hukataa kufanya kazi mahali pengine popote.

## Mzunguko wa maisha

Kulemaza programu-jalizi huzuia miisho yote miwili. Kuondoa programu-jalizi
hubatilisha kila tokeni na huhifadhi majedwali matatu (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) kwa uhifadhi; kusakinisha tena hakuwashi
tena tokeni iliyobatilishwa. Hifadhi nakala za majedwali pamoja na hifadhidata ya
Cacti na utumie sera ya uhifadhi wa ukaguzi nje ya programu-jalizi.

## Uundaji na majaribio

Majaribio ni hati za kawaida za PHP zinazoendeshwa bila Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI hukagua sintaksia ya PHP na huendesha hati katika `tests/` (kila moja
imeorodheshwa katika `.github/workflows/ci.yml`) kwenye PHP 8.2 hadi 8.5, kisha
hujenga kumbukumbu ya `mcp/` inayoweza kusakinishwa na hundi yake ya ukaguzi
(checksum). Majaribio yanayogusa Cacti hutumia vifaa vya majaribio (fixtures)
kwenye mpaka wa visaidizi vya Cacti; hayajaribu usakinishaji kamili wa Cacti.

### Majaribio ya ujumuishaji

`tests/integration/run.sh 1.2.31` au `tests/integration/run.sh develop` husakinisha
programu-jalizi katika Cacti halisi ndani ya kontena na huendesha ukaguzi wa moja
kwa moja dhidi yake. Inahitaji Docker yenye Compose v2.23.1 au mpya zaidi, git na
openssl. `KEEP=1` huacha mfumo ukiendelea kufanya kazi kwa ajili ya utatuzi. CI
huiendesha kila usiku na inapohitajika, si kwenye maombi ya kuvuta (pull
requests).

## Ujanibishaji

Cacti MCP huja na katalogi zilizokusanywa za GNU gettext chini ya `locales/po/`
na `locales/LC_MESSAGES/` na faili za README zilizojanibishwa chini ya
`docs/i18n/` kwa Kiingereza pamoja na lugha 44 za maeneo (19 za Daraja la 1 Pana,
15 za Kiafrika, na 10 za Kiasia), kwa kutumia kikoa cha maandishi cha `mcp`
(`locales/po/mcp.pot`). Cacti hupakia katalogi inayolingana kiotomatiki wakati
usaidizi wa lugha umewashwa.

## Kuchangia

Maombi ya kuvuta (pull requests) huenda kwenye `develop`. Weka msimbo wa
uzalishaji ukiwa sambamba na PHP 8.2 na utumie mtindo wa Cacti: vichupo (tabs),
tungo zenye alama moja ya nukuu, na visaidizi vya hifadhidata na ruhusa vya
Cacti. Ongeza majaribio kwa mabadiliko ya uthibitishaji, uidhinishaji, au tabia
ya itifaki, na uidhinishe mabadiliko (commits) kwa `git commit -s`. Ratibu
mabadiliko kwenye API ya HTTP na [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Leseni

Hakimiliki (C) 2026 Thomas Vincent. Imetolewa chini ya Leseni ya Umma ya GNU (GNU
General Public License), toleo la 2 au la baadaye. Angalia [LICENSE](../../../LICENSE).
