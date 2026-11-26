<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ikhakhathasi enekhaka. Fumana. Gunyazisa. Sebenzisa.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Ilayisensi: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

I-Cacti MCP yi-plugin ye-Cacti evumela abaxhasi be-AI ukuba bafunde idatha yakho ye-Cacti ngokusebenzisa
imisebenzi enikwe amagama kwaye ihluzwe ngokweemvume ebizwa ngokuba zizakhono (abilities). Izibonelela ngeendlela
ezimbini ezivela kwi-plugin ngokwayo: indawo yokugqibela ye-MCP (`mcp.php`, Streamable HTTP) kunye ne-HTTP API
ekwimo ye-AIP (`api.php`). I-Cacti ihlala ilawula ugunyaziso kunye nokusebenza. Umxhasi akaze abuze kwisiseko
sedatha; angabiza kuphela isakhono esiveliswe ngumlawuli nesivunyelwa ziindawo zolawulo (realms) ze-Cacti
zomnini wethokheni.

Ababhali bee-plugin banokubhalisa ezabo izakhono zokufunda kuphela nge-hook ye-`abilities_register`,
kwaye zivela kubaxhasi be-MCP njengezixhobo ngaphandle kwekhowudi yeprothokholi.

**Imeko: phambi kokukhutshwa ngokusesikweni, uguqulelo 0.1.0.** Akukho kukhutshwa okunethegi.

Okukhoyo namhlanje:

- Izakhono ezakhelwe ngaphakathi zokufunda kuphela zeenguqulelo zenkqubo noluhlu lwezixhobo.
- Iithokheni zofikelelo lobuqu (`cmcp_pat_...`) njengesiqinisekiso esisodwa.
- Ikhonsoli ye-Management > MCP: velisa okanye ufihle izakhono, yenza kwaye urhoxise
  iithokheni, ufunde nengxelo yophicotho.
- I-Management > My MCP Tokens: abasebenzisi balawula ezabo iithokheni, babone imisebenzi yabo,
  baze babone ukuba zeziphi izixhobo ezinokusetyenziswa ziithokheni zabo.
- I-MCP nge-Streamable HTTP, uhlaziyo lweprothokholi `2026-07-28` kunye no-`2025-11-25`,
  izixhobo kuphela.

Okungekafumaneki okwangoku:

- Ukungena nge-OAuth 2.1. Izidibanisi ezibanjelwe ngaphandle ezingakwaziyo ukuthumela ithokheni yobuqu,
  njengezidibanisi eziqhelekileyo ze-ChatGPT ne-claude.ai, azikwazi ukuqhagamshela de ibekho.
  Icwangciswe njengeSicwangciso 2; eso sicwangciso asikabhalwa okwangoku.
- Izakhono zokubhala. Izakhono zokufunda kuphela ezinokubhaliswa.

Uyilo lusekwi-[ncukacha zoyilo lwendawo yokugqibela](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
kwaye ulandelelwano lolwakhiwo lusekwi-[docs/plan.md](../../plan.md).

## Izakhono ezakhelwe ngaphakathi

| I-ID | Ii-argumenti | Indawo yolawulo ye-Cacti efunekayo |
| --- | --- | --- |
| `cacti-get-system-info` | akukho | 15 |
| `cacti-list-devices` | ngokuzikhethela `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | kuyafuneka `name`, njenge-`devices/12` | 3 |

Umnxeba ngamnye kwakhona ufuna indawo yolawulo ye-**MCP and Abilities API** yomnini wethokheni,
umda we-`abilities:read` (ithokheni yobuqu nganye inawo), kunye nesakhono esivelisiweyo.
Ithebhu ye-Abilities yekhonsoli ibonisa indawo yolawulo efunwa sisakhono ngasinye esakhelwe ngaphakathi.

- I-`cacti-list-devices` ibuyisela amaphepha ezixhobo ezifikelela kwi-100 (ezihlala ziyi-50) kunye
  ne-`nextPageToken`. Ithokheni yephepha isebenza kuphela kwi-`filter` efanayo kunye ne-`orderBy` efanayo.
  I-`filter` yintetho ye-AIP-160 yothelekiso edityaniswe ngu-`AND`, umzekelo
  `state = "DOWN" AND disabled = false`. Imihlaba yokuhluzo ngu-`displayName`, `hostname`, `disabled`,
  `site`, `poller`, `deviceTemplate`, `externalId`, kunye no-`state`. I-`orderBy` ithatha
  u-`displayName`, `hostname`, okanye `name`, nganye inokulandelwa ngu-`desc` ngokuzikhethela.
- Imibuzo yezixhobo idlula ku-`get_allowed_devices()` we-Cacti, ngoko ke umsebenzisi ubona kuphela
  izixhobo ebeziya kuboniswa ngu-Cacti kuye.
- Imihlaba yezixhobo ayibandakanyi imitya yoluntu ye-SNMP, amagama okugqitha amade, kunye nezinye
  iziqinisekiso.

## Faka

Ifuna i-Cacti 1.2.31 okanye entsha, i-PHP 8.2 okanye entsha, kunye ne-poller ephambili. Uqinisekiso
lwe-Cacti kufuneka luvulwe; i-plugin iyala ukuqinisekisa xa luvaliwe.

Uvimba weefayili we-plugin kufuneka ubizwe ngokuba yi-`mcp`, hayi `plugin_mcp`. I-slug ye-plugin,
amagama eendawo zolawulo, indawo yenguqulelo, kunye nee-URL zonke zisebenzisa u-`mcp`.

Ukusuka kwindawo ekhuphela ikhowudi yomthombo:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Kude kubekho ukukhutshwa okunethegi, unokukhuphela endaweni yoko i-artifact ye-`mcp-plugin`
ku-[msebenzi we-CI ophumeleleyo](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml).
Iqulethe i-`mcp.tar.gz` kunye ne-`SHA256SUMS`. Qinisekisa i-checksum, uze ukhuphe i-`mcp.tar.gz`
ngaphakathi kuvimba weefayili we-`plugins/` we-Cacti ukuze isiphumo sibe yi-`plugins/mcp/`.
Oovimba bemithombo abazenzekelayo be-GitHub basebenzisa igama elahlukileyo luvimba oluphezulu.
Uvimba we-archive uyayishiya i-`docs/` (kubandakanya imifanekiso yesikrini engezantsi), i-`tests/`,
kunye ne-`.github/`, ngoko ke amakhonkco e-README aya ku-`docs/` asebenza kwi-GitHub kodwa hayi
kwikopi efakiweyo.

Emva koko:

1. Kwi-Plugin Management, faka kwaye uvule i-**Cacti MCP**. Umlawuli ofakayo ufumana
   indawo yolawulo ye-**MCP Administration** ngokuzenzekelayo.
2. Phantsi kwe-Settings > MCP, seta i-**Public Cacti URL** kwidilesi esetyenziswa ngabaxhasi,
   umzekelo `https://cacti.example.com/cacti`. I-HTTPS iyafuneka ngaphandle kwe-`localhost`,
   `127.0.0.1`, kunye no-`[::1]`. Kude kube oku kusetiwe, i-`mcp.php` iphendula nge-HTTP 400
   enempazamo ye-JSON-RPC ene-`data` engu-`FAILED_PRECONDITION` kunye no-`PUBLIC_URL_REQUIRED`.
   I-`api.php` ayiyifundi.

   ![I-Settings > MCP ebonisa umhlaba we-Public Cacti URL](../../images/settings-public-url.png)

3. Nika indawo yolawulo ye-**MCP and Abilities API** kumsebenzisi ngamnye oya kuba ngumnini wethokheni.
   Akukho msebenzisi uyifumana ngokuzenzekelayo.
4. Qinisekisa ukuba iseva yewebhu idlulisela iheader ye-`Authorization` kunye nolwazi lwendlela kwi-PHP
   (jonga ngezantsi).
5. Vula i-Management > MCP uze uvelise izakhono ofuna abaxhasi bazibone.

**Ukuphucula ukusuka kulwakhiwo lophuhliso.** I-plugin ikwinqanaba langaphambi kokukhutshwa,
kwaye iitheyibhile zayo zatshintsha ngexesha lophuhliso ngaphandle kweemigration. Ukuba ufake
ulwakhiwo lwangaphambili, yisuse uze uyifake kwakhona. Ukufaka kwakhona kugcina iitheyibhile esele
zikhona, ngoko ke cima iitheyibhile ezindala ze-`plugin_mcp_token`, `plugin_mcp_audit`, kunye
ne-`plugin_mcp_ability` kuqala (kunye neetheyibhile ezilinganayo ezivela kulwakhiwo olwenziwe
phambi kokutshintshwa kwegama). Zenzele ikopi yokugcina ukuba uyayidinga imbali yazo; iithokheni
ezivela kolu lwakhiwo ziyarhoxiswa xa zisuswa kwaye azigqithiselwa phambili.

### Iseva yewebhu

Useto lwe-Apache olususa i-`Authorization` phambi kwe-PHP lufuna oku kwi-virtual host
efanelekileyo okanye kuvimba weefayili, kulandelwe kukuyilayisha kwakhona:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

I-Apache ene-`mod_php` ibonelele ngeendlela ze-`api.php` ngaphandle kolunye ulungiselelo lwendlela.

Iindlela ze-`api.php` zihlala kwindlela emva kwegama leskripthi
(`/plugins/mcp/api.php/v1/abilities`), ngoko ke i-nginx kufuneka itshatise ii-URI apho u-`.php`
elandelwa yindlela engaphezulu, yahlule ulwazi lwendlela, ize iludlulisele kwi-PHP. Ibhulokhi
ye-`location ~ \.php$` ayize itshatise ezi URL; i-nginx iphendula nge-HTML 404 yayo.
Iphethini yendawo kunye nemigca emibini ye-path-info engezantsi ziqinisekisiwe nge-PHP-FPM;
eminye imigca yeqhelekileyo:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Lungisa imigca ye-`include` kunye ne-`fastcgi_pass` ukuze itshatise ibhulokhi esele ibonelela
nge-Cacti. Musa ukudibanisa u-`try_files $fastcgi_script_name =404;` kule bhulokhi: icima
u-`$fastcgi_path_info`, kwaye i-`api.php` ibuya iphendule nge-404 `UNKNOWN_PATH`. Ukuba uqwalaselo
lwakho lufuna u-`try_files`, gcina ixabiso kuqala ngo-`set $path_info $fastcgi_path_info;`
uze udlulise u-`fastcgi_param PATH_INFO $path_info;`.

I-`mcp.php` ayinazo iindlela zendlela kwaye ayizidingi.

## Ikhonsoli

I-Management > MCP ineethebhu ezintathu. Udinga indawo yolawulo ye-**MCP Administration**.
Imifanekiso yesikrini elapha nangenzantsi ivela kulwakhiwo lophuhliso lwe-Cacti olunedatha engumzekelo.

- **Abilities** idwelisa sonke isakhono esibhalisiweyo kunye ne-plugin yaso, udidi, indawo yolawulo
  esiyidingayo, kunye nokuba sivelisiwe na. Khetha imigca uze ukhethe u-Expose okanye u-Hide;
  uyakuqinisekisa phambi kokuba utshintsho lusebenze. Izakhono ezakhelwe ngaphakathi ze-`cacti-*`
  ziveliswa ngokungagqibekanga. Izakhono ezivela kwezinye ii-plugin ziqala zifihliwe, ngoko ke
  ukufaka i-plugin akukaze kupapashe nantoni na de umlawuli agqibe ukuba makwenziwe njalo.
  Ukutyhilwa kunciphisa ukufikelela kuphela: umsebenzisi usayidinga indawo yolawulo yeso sakhono.

  ![Ithebhu ye-Abilities edwelisa izakhono ezakhelwe ngaphakathi neendawo zazo zolawulo kunye nemeko yokutyhilwa](../../images/console-abilities.png)
- **Tokens** idwelisa iithokheni kunye nomnini, umdali, umhla wokudalwa, umhla wokuphelelwa, ukusetyenziswa
  kokugqibela, kunye nemeko (Active, Expired, Revoked). Khetha imigca uze ukhethe u-Revoke ukuzirhoxisa.
  Iithokheni ezirhoxisiweyo azinakuphinda zisetyenziswe. U-Create Token wenza entsha.

  ![Ithebhu ye-Tokens edwelisa iithokheni nomnini, ixesha lokuphelelwa, ukusetyenziswa kokugqibela, kunye nemeko, ngaphezu kwefomu ye-Create Token](../../images/console-tokens.png)
- **Audit** idwelisa imigca yophicotho, entsha kuqala, kwaye ihluzo ngokomsebenzisi, isakhono,
  kunye nesiphumo.

  ![Ithebhu ye-Audit edwelisa iminxeba enomsebenzisi, ithokheni, isakhono, kunye nesiphumo, kunye nezihluzi](../../images/console-audit.png)

## Iithokheni

Ithokheni yobuqu ifunda i-Cacti njengomnini wayo. Inemo ka-`cmcp_pat_` elandelwa ngamanani angama-64
ee-hex ezincinci kwaye ithwala umda omnye we-`abilities:read`. Okunokubonwa yiyo kugqitywa ziindawo
zolawulo ze-Cacti zomnini wayo kunye neemvume zezixhobo, hayi yithokheni. Umnini kufuneka abe ngumsebenzisi
ovuliweyo ophethe indawo yolawulo ye-**MCP and Abilities API**.

Iithokheni zisoloko zidalelwa umsebenzisi, ziyaphelelwa, kwaye zinokurhoxiswa:

- **Ikhonsoli.** Management > MCP > Tokens > Create Token. Ubomi bwayo buziintsuku ezi-1 ukuya
  kwezingama-365 kwaye ngokungagqibekanga buziintsuku ezingama-90. Ithokheni yenziwa yiseva kwaye
  iboniswa kanye kwiphepha lempendulo, ngoko ke yikopele kumphathi wakho weemfihlo ngoko nangoko.
  Unokuzenzela ithokheni ngokwakho. Ukudalela omnye umsebenzisi ithokheni kufuna kwakhona indawo
  yolawulo ye-Users/Groups, kuba ithokheni ifunda i-Cacti njengalowo msebenzisi.
- **My MCP Tokens.** Nawuphi na umsebenzisi onendawo yolawulo ye-MCP and Abilities API unokulawula
  ezakhe iithokheni; jonga ngezantsi.
- **Umgca womyalelo.** I-`tokens.php` isebenza kuphela kwi-CLI, njenge-akhawunti ye-OS enokulawula
  i-Cacti. Ithatha ithokheni kwindawo engqongileyo ukuze ixabiso lingaze livele kumgca womyalelo okanye
  kuluhlu lweenkqubo. Ubomi bwayo buziintsuku ezi-1 ukuya kwezingama-365 kwaye ngokungagqibekanga
  buziintsuku ezingama-30. Ukudala kunye nokurhoxisa ithokheni nge-CLI kuphicothwa njengekhonsoli,
  nomnini wethokheni njengomenzi kuba i-CLI ayinamsebenzisi we-Cacti, ngoko ke umgca wophicotho
  awuliphawuli inyathelo njengelivela kwi-CLI. I-`--list` iprinta yonke ithokheni njenge-JSON
  (i-ID, umnini, imida, izitampu zexesha, iflegi yokurhoxiswa) kwaye ayize iprinte ixabiso lethokheni;
  i-`--help` ibonisa indlela yokusebenzisa.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Iithokheni azinakudalelwa i-akhawunti yondwendwe, abasebenzisi abavaliweyo, okanye abasebenzisi abangenayo
indawo yolawulo ye-**MCP and Abilities API**, nokuba kusuka kwikhonsoli, kumgca womyalelo, okanye
ku-My MCP Tokens. I-Cacti igcina useto londwendwe njengegama lomsebenzisi okanye i-ID yomsebenzisi,
kwaye i-plugin izisombulula zombini. Ithokheni enomnini othi abe yi-akhawunti yondwendwe iyayeka
ukusebenza kwisicelo sayo esilandelayo.

### Iithokheni Zam ze-MCP

I-Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ayidingi ndawo yolawulo yokuphatha:
igutyungelwe yindawo yolawulo ye-**MCP and Abilities API**, kwaye ungeno lwemenyu luvela kuphela
kubasebenzisi abayiphetheyo. Iphepha lisoloko lisebenza kumsebenzisi ongenileyo. Imenyu ye-Cacti
yinxalenye yekhonsoli, ngoko ke umsebenzisi ongenako ukufikelela kwikhonsoli ufikelela kwiphepha
ngedilesi yalo.

![Ithebhu ye-My Tokens edwelisa iithokheni zomsebenzisi ongenileyo kunye nefomu yokudala](../../images/my-tokens.png)

- **Tokens** idwelisa iithokheni zakho, yenza enye (iintsuku ezi-1 ukuya kwezingama-365, ngokungagqibekanga
  zingama-90, iboniswa kanye kwimpendulo), kwaye irhoxisa ezakho. Awunakuzibona okanye uzirhoxise
  ezomnye umntu.
- **Activity** idwelisa izenzo ozenzileyo, ezintsha kuqala: iminxeba eyenziwe ngeethokheni zakho
  kunye notshintsho lweethokheni olwenzileyo.
- **Available Tools** idwelisa izakhono ezinokusetyenziswa yithokheni yakho ngoku, kunye ne-ID
  yesakhono ngasinye, igama, kunye nenkcazo. Ilandela iimvume zakho ze-Cacti kunye noseto lokutyhilwa
  olukhethwe ngumlawuli.

  ![Uluhlu lwe-Available Tools olubonisa i-ID yesakhono ngasinye, igama, kunye nenkcazo](../../images/my-tools.png)

Ufako olwenziwe phambi kokuba eli phepha libekho lunoluhlu lweefayili zendawo yolawulo olungenayo
i-`mcp_tokens.php`. Ukufaka kubhalisa olu luhlu; aluhlaziywa ngokuvula okanye ngokuvala i-plugin.
Susa uze ufake i-plugin kwakhona, emva koko unike iindawo zolawulo kwakhona, kuba i-Cacti isusa
izibonelelo zeendawo zolawulo xa i-plugin isuswa.

Isiseko sedatha sigcina kuphela i-hash ye-SHA-256 yethokheni, ngoko ke ithokheni elahlekileyo
ayinakubuyiselwa; yirhoxise uze wenze enye. Ukutshintshwa kwayo kuyafana: yenza ithokheni entsha,
tshintsha umxhasi, uze urhoxise endala. Ithokheni ephelelweyo, ithokheni erhoxisiweyo, umnini
ovaliweyo, okanye indawo yolawulo elahlekileyo nganye iyasilela kwisicelo esilandelayo. Iithokheni
zamkelwa kuphela kwiheader ye-`Authorization: Bearer`; ithokheni ekumtya wombuzo okanye kumzimba
wesicelo ayamkelwa.

## Qhagamshela umxhasi

Sebenzisa i-endpoint ye-MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, kunye ne-token ekwi-header ethi `Authorization: Bearer`. Gcina i-token kwi-environment variable okanye kwi-secret manager uze uyibhekisele ukusuka kuqwalaselo lomxhasi endaweni yokubhala ixabiso layo kwifayile.

### Claude Code

Faka i-endpoint kwi-`.mcp.json` yeprojekthi ebhekisela kwi-token ngegama. I-Claude Code yandisa i-`${VAR}` kwi-`url` nakwi-`headers`, ngoko ke ifayile ayigcini mfihlo kwaye ikhuselekile ukuba ingafakwa kwi-commit. Khupha i-`CACTI_MCP_TOKEN` kwi-environment eqalisa i-Claude Code.

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

Ungayongeza kwakhona ukusuka kwi-command line:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Ngee-double quotes, i-shell yakho yandisa i-`$CACTI_MCP_TOKEN` kuqala, ngoko ke ixabiso le-token libhalwa kwifayile yoqwalaselo ye-`--scope` ekhethiweyo (`local`, `user`, okanye `project`; okungagqibekanga ngu-`local`). Musa ukusebenzisa loo fomu nge-`--scope project`, kwaye gcina ifayile ingaphandle ko-version control. Khetha isalathiso se-`.mcp.json` esingasentla. I-Claude Code ifunda ezinye ii-credential variables (ezifana no-`ANTHROPIC_AUTH_TOKEN`) njengezingenanto kwi-`url` nakwi-`headers` ezikude; i-`CACTI_MCP_TOKEN` ayikho phakathi kwazo. Umthombo: [amaxwebhu e-Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot kwi-VS Code

Sebenzisa i-`.mcp.json` ekwi-workspace-root (okanye ifayile yomsebenzisi `~/.copilot/mcp-config.json`). Ezi fayile zomthonyama ze-Copilot zisebenzisa i-object ephezulu ye-`mcpServers` kunye nezalathiso ze-environment-variable ezithi `${NAME}` kumaxabiso ee-header:

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

Khupha i-`CACTI_MCP_TOKEN` kwi-environment eqalisa i-VS Code. Iifayile zomthonyama ze-Copilot azizixhasi ii-prompts ze-`inputs`. Useto olukhokelwayo lwe-VS Code luyawala amaxabiso e-`${...}`, ngoko ke yongeza i-header ye-`Authorization` ngokuhlela ifayile, hayi ngokuhamba ngenkqubo ekhokelwayo. Useto olukhokelwayo lubonelela ngefayile ye-workspace-root kuphela xa useto lovavanyo lwe-`chat.mcp.workspaceRootConfig.enabled` luvuliwe. Jonga [ireferensi yoqwalaselo lwe-VS Code MCP](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Okwakudala: `.vscode/mcp.json`.** I-VS Code ithi uqwalaselo olutsha lwe-Copilot akufunekanga lusebenzise `.vscode/mcp.json` okanye i-`mcp.json` yeprofayile; zeze-Local harness ephelelwe lixesha, eya kususwa ngoFebruwari 2027. Ukuba usayisebenzisa, ifomathi elawulwa ngumhleli ithatha isitshixo esiphezulu se-`servers` kwaye inokucela i-token:

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

### Abaxhasi abathetha i-stdio kuphela

I-[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) yi-adapter yokuzikhethela esebenza njengeseva yendawo ye-stdio MCP kwaye ibiza i-HTTP API ye-plugin. Yisebenzisele umxhasi ongakwaziyo ukuxhuma kwiseva ye-HTTP ekude. Ifuna kwakwalo i-token yobuqu enye kwaye ithetha ne-`api.php`.

### Indlela yokuziphatha ye-MCP

I-endpoint ibonelela ngee-tools kuphela: isakhono ngasinye esivezwayo nesivumelekileyo siyi-tool ethiywe nge-ID yaso, kunye nee-schemas zayo zegalelo nezesiphumo kunye nee-annotations zokufunda kuphela (`openWorldHint` ngu-`false`). Iphatha i-`initialize`, `server/discover`, `ping`, `tools/list`, kunye ne-`tools/call`. Ayigcini seshoni, ayithumeli `Mcp-Session-Id` (kwaye ayiyihoyi leyo iyifumanayo), kwaye ayamkeli ii-batches ze-JSON-RPC. Umyalezo ongena-`id` sisaziso kwaye ufumana i-HTTP 202 engenamzimba. Kuphela ngu-`POST` ovumelekileyo.

- **Uhlaziyo.** Isicelo esithwele `io.modelcontextprotocol/protocolVersion` kwi-`params._meta` kufuneka sichaze `2026-07-28`; nantoni na enye ifumana impazamo `-32022`. Ezo zicelo kufuneka ziphathe ii-headers ezihambelanayo ze-`Mcp-Protocol-Version`, `Mcp-Method`, kunye (kwi-`tools/call`) ne-`Mcp-Name`, kungenjalo impendulo iba yimpazamo `-32020`. Ezinye izicelo zithathwa njenge-`2025-11-25`: i-`initialize` iphendula ngolo hlaziyo, kwaye kuyo nayiphi na enye indlela i-header ye-`Mcp-Protocol-Version`, ukuba ithunyelwe, kufuneka ibe yi-`2025-11-25`, `2025-06-18`, okanye `2025-03-26`.
- **Iimpazamo zee-tool.** Impazamo yesakhono, kuquka ii-arguments ezingahambelaniyo ne-schema okanye ixabiso le-`arguments` elingeyiyo i-JSON object, ibuya njengesiphumo se-tool esino-`isError: true` kunye nempazamo ye-AIP-193 kwi-`structuredContent`, hayi njengempazamo ye-protocol.
- **Iimpazamo ze-protocol.** Ukusilela okungeyiyo impazamo ye-tool zii-JSON-RPC error objects (ikhowudi `-32000` enesimo nesizathu kwi-`data`, okanye iikhowudi ezisemgangathweni): i-Public Cacti URL engekhoyo, i-`Origin` ekatyiweyo, isicelo esine-plugin ekhubazekileyo okanye ekwi-remote poller, kunye neempazamo zeseva ezingalindelekanga (`-32603`, apho iinkcukacha zibhalwa kwi-log ye-Cacti, hayi kwimpendulo). Ukutshekishwa kwezicelo okuqala kuqala (405, 413, 415) kunye nokusilela kokuqinisekiswa (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) kugcina umzimba we-AIP-193 ochazwe phantsi kwe-HTTP API.

## I-HTTP API

I-URL esisiseko: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Isivumelwano siku-[openapi.json](../../../openapi.json).

| Indlela kunye ne-path | Injongo |
| --- | --- |
| `GET /v1/abilities` | Dwelisa izakhono ezivumelekileyo. Umbuzo: `pageSize`, `pageToken`, kunye ne-`filter` yohlobo lwe-`category = "inventory"`. |
| `GET /v1/abilities/{id}` | Funda isakhono esinye. |
| `POST /v1/abilities/{id}:execute` | Yiqhube. Umzimba ngu-`{"arguments": {...}}` kanye. Impendulo ngu-`{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Iimpazamo zilandela i-AIP-193: i-object ye-`error` ene-`code`, `message`, `status`, kunye ne-`details` ephethe i-`ErrorInfo` ene-domain ethi `cacti.net` kunye ne-`reason` ezinzileyo. Iingxaki zee-arguments zongeza i-`BadRequest` detail echaza igama le-field. Imizimba yezicelo ithintelwe kwi-64 KB, kwaye iziphumo kwi-1 MB. Zombini ii-endpoints ziphendula kuphela kwi-main poller kwaye zibuyisa i-`UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) xa i-plugin ikhubazekile okanye iseva ingeyiyo i-main poller.

| HTTP | Amaxabiso e-`reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (ikwathumela ne-`WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (ithumela i-`Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Bhala isakhono (ababhali bee-plugin)

I-plugin ye-Cacti evuliweyo ibhalisa izakhono ukusuka kwi-function eyidibanisa kwi-hook ye-`abilities_register`, ngokwesiqhelo kwi-`plugin_<slug>_install()` yayo:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

I-function ifumana i-`AbilitiesRegistrar` elinganiselwe kwi-plugin. Ixabiso layo elibuyiselwayo alihoywa.

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

Imigaqo, yonke inyanzeliswa ekubhalisweni:

- **Ii-ID.** I-ID ihambelana no-`^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, ubukhulu bayo ngama-64 characters, kwaye kufuneka iqale nge-slug ye-plugin kunye ne-hyphen: `acme-` ngasentla. I-slug ligama le-directory ye-plugin, ngoko ke i-directory efana no-`my_plugin` ayinakubhalisa nto. I-directory ye-plugin ethiywe `cacti` ayivumelekanga; loo namespace yeyezinto ezakhelwe ngaphakathi.
- **Inkcazelo.** Ezi zitshixo zizodwa: `label`, `description` (ukuya kuthi ga kwi-4096 bytes), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Udidi kufuneka sele lukho: sebenzisa olwakhelwe ngaphakathi (`inventory`, `system`) okanye ubhalise olwakho nge-`registerCategory()`, ene-ID ekhethekileyo kuzo zonke ii-plugins kwaye ehambelana no-`^[a-z][a-z0-9-]{0,31}$`.
- **Yokufunda kuphela.** I-`annotations` kufuneka ibe ngu-`readOnly: true`, `destructive: false`, `idempotent: true` kanye. Nantoni na enye iyaphosa.
- **Ii-schemas.** I-`input_schema` kunye ne-`output_schema` nganye kufuneka ibe ne-`type` ephezulu ethi `object`. Le dialect incinci kwaye isilela ngokuvala. Ii-objects kufuneka zivalwe (`additionalProperties: false`, i-`properties` ikhona); ezinye iindidi zii-`integer` kunye ne-`number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, kunye ne-`array` (efuna i-`items` kunye ne-`maxItems`). Uhlobo lunokwenziwa lubeyi-nullable njenge-`['string', 'null']`. Ii-strings zee-arguments ngokungagqibekanga zifikelela ubuninzi kuma-4096 characters; ii-strings zeziphumo zithintelwe kuphela yi-`maxLength` ebhengezweyo kunye nomda wobungakanani besiphumo. Kufikelela kwizakhono ezingama-256 ezikwaziyo ukubhalisa.
- **`permission(int $userId): bool`.** Kufuneka ibuyisele `true` kanye ukuze ivumele. I-user ID yeyomnini we-token; ungaze ufunde imo yeseshoni.
- **`execute(int $userId, stdClass $args): array`.** I-`$args` sele iqinisekisiwe ngokuchasene ne-`input_schema`. Nyanzelisa iimvume zenqanaba le-object ngokwakho. Buyisela i-associative array ehambelana ne-`output_schema` kanye; uluhlu, i-field eyongezelelweyo, okanye ngaphezu kwe-1 MB ye-JSON iba yimpazamo ye-`INVALID_RESULT`. Phosa i-`AbilitiesError` ngokusilela okubonakalayo kumxhasi, okufana ne-`NOT_FOUND`.
- **Ii-objects ezingenanto.** I-PHP ibhala i-`[]` njenge-JSON array. Naphi na apho i-output schema ibhengeza i-`object`, nakweliphi na inqanaba, i-registry iphatha i-`[]` njenge-empty object kwaye ithumela i-`{}`; i-`new stdClass()` iyasebenza nayo. Uluhlu olungelulo olungenanto aluze lubalwe njenge-object kwaye lusilela nge-`INVALID_RESULT`. Imephu ye-`properties` engenanto kwi-schema ingaba yi-`[]` okanye i-`new stdClass()`; zombini zipapashwa njenge-`{}`.
- **Ukwahlulwa kokusilela.** I-plugin nganye ibhalisa kwikopi yesikratshi egcinwa kuphela ukuba i-function yakho ibuya ngokuqhelekileyo. Ukuba iyaphosa, akukho nasinye kwizakhono zakho esibhaliswayo, kwaye ukusilela kuyabhalwa kwi-log.

Izakhono ezivela kwii-plugins ziqala zifihliwe. Umlawuli uziveza kwithebhu ye-Abilities yekhonsoli, kwaye ikholam ye-Required Realm ifundeka ngokuthi "Set by the plugin" kuzo.

## Imodeli yokhuseleko

- **I-Bearer kuphela.** I-`api.php` kunye ne-`mcp.php` zamkela ithokheni yobuqu
  kwintloko ye-`Authorization` kwaye akukho nto yimbi. Zilahla ii-cookie, i-`$_POST`,
  kunye ne-`$_REQUEST` phambi kokuba i-Cacti ilayishe kwaye zitshabalalise iseshoni
  eqaliswe yi-Cacti, ngoko ungeno lwesikhangeli aluze lunikeze ufikelelo kwi-API.
- **Indlela yesikhashana ye-CSRF.** Umkhuseli we-CSRF we-Cacti uyayala i-JSON POST
  engenathokheni ye-CSRF ye-Cacti, engenakuthunyelwa nguye nawuphi na umxhasi we-MCP.
  Kwezi ndawo zokuphela zimbini kuphela, iplagini iyayithiya ngokutsha indlela yesicelo
  phambi kokuba i-Cacti ilayishe kwaye iyibuyisele emva koko, ukuze umkhuseli azitsibe.
  Oku kukhuselekile kuba i-CSRF ikhusela izicelo eziqinisekiswa sisikhangeli ngee-cookie,
  kwaye ezi ndawo zokuphela azamkeli bunini be-cookie: iphepha le-cross-site alinakuyincamathisela
  ithokheni ye-bearer. Amaphepha ekhonsoli agcina ukhuseleko olupheleleyo lwe-CSRF.
  Le ndlela yesikhashana yeyethutyana, de i-Cacti inikezele ngoxolelo oluxhaswayo;
  jonga i-`lib/bootstrap.php`.
- **Uhlolo lwe-Origin.** Kwi-`mcp.php`, ukuba isicelo sinentloko ye-`Origin` kufuneka
  sifane nqo neskimu, umamkeli, kunye nezibuko le-Public Cacti URL, okanye isicelo
  siyaliwa nge-`ORIGIN_NOT_ALLOWED`. Isicelo esingenantloko ye-`Origin`, okuyindlela
  abaxhasi abangasebenzisi sikhangeli abaxhumeka ngayo, siyavunyelwa. Oku kuthintela
  iphepha lewebhu ekulawuleni indawo yokuphela ukusuka kwisikhangeli somtyeleli.
  I-`api.php` ayilusebenzisi olu hlolo.
- **Ufundo kuphela.** Ubhaliso luyayala nayiphi na into yokukwazi eyokufunda kuphela
  engekhoyo, etshabalalisayo, okanye eguqukayo xa iphindwa.
- **Ukuvezwa kunye nemimandla yomibini iyasebenza.** Into yokukwazi kufuneka ivezwe
  kwaye umnini wethokheni kufuneka abe nommandla wayo. Ukuba itheyibhile yokuvezwa
  ayifundeki, yonke into yokukwazi iyafihlwa endaweni yokubuyela kwiisetingi ezisisiseko.
- **Ezifihliweyo, ezingaziwayo, nezingavumelekanga zikhangeleka ngokufanayo.** Umxhasi
  akanakukwazi ukwahlula into yokukwazi engekhoyo kuleyo ifihliweyo okanye umsebenzisi
  wayo angavumelekanga ukuyisebenzisa: ufumaniso luyayishiya kwaye ukwenziwa kubuyisela
  i-`NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Iithokheni.** Zigcinwa njengama-hash e-SHA-256, ziboniswa kube kanye, zihlala
  ziphelelwa lixesha, zinokurhoxiswa, kwaye ziyaliwa xa umnini ekhutshaziwe okanye
  elahlekelwa ngummandla.
- **Uphicotho.** I-`plugin_mcp_audit` irekhoda i-ID yesicelo, i-ID yethokheni, i-ID
  yomsebenzisi, into yokukwazi, isiphumo (`started`, `succeeded`, `failed`, `denied`,
  `rejected`), kunye namaxesha oshicilelo. Ayize irekhode ii-argument, iziphumo, okanye
  amaxabiso ethokheni. Into yokukwazi isebenza kuphela emva kokuba umqolo wayo we-`started`
  ubhaliwe; ukuba itheyibhile yophicotho ayifumaneki ubizo luyasilela nge-`UNAVAILABLE`
  kwaye alusebenzi. Ubizo olwaliweyo phambi kokuba lusebenze ngumqolo omnye: `denied`
  kwinto yokukwazi engaziwayo, efihliweyo, okanye engavumelekanga, `rejected` kwii-argument
  ezingaphumeleliyo kwiskima. Ukudalwa nokurhoxiswa kwethokheni ukusuka kwikhonsoli,
  kwi-My MCP Tokens, nakwi-CLI kurekhodwa njenge-`mcp-token-create` kunye ne-`mcp-token-revoke`
  ngesiphumo esingu-`succeeded`, kwaye urhoxiso lurekhodwa kuphela kwethokheni ebisasebenza.
  Ufumaniso, kunye nobizo olu-`arguments` yalo ingeyiyo i-JSON object, azirekhodwa.
- **Irekhodi lokusilela.** Ukusilela okungalindelekanga, i-`INVALID_RESULT`, okanye
  itheyibhile yophicotho engafumanekiyo kubhala umgca omnye kwirekhodi le-Cacti
  elino-facility engu-`MCP`: i-ID yento yokukwazi, isizathu esimiselweyo, kunye neklasi
  yokwahluka. Imiyalezo, ii-argument, kunye neethokheni azize zirekhodwe.
- **I-poller engundoqo kuphela.** Zombini iindawo zokuphela, omabini amaphepha ekhonsoli,
  kunye ne-`tokens.php` ziyala ukusebenza kwenye indawo.

## Umjikelo wobomi

Ukukhupha isakhono kwiplagini kuvimba zombini iindawo zokuphela. Ukuyikhupha ngokupheleleyo
kurhoxisa zonke iithokheni kwaye kugcina iitheyibhile ezintathu (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) ukuze zigcinwe; ukufaka kwakhona akuyivuseleli
ithokheni erhoxisiweyo. Gcina iitheyibhile kwisiseko sedatha se-Cacti kwaye usebenzise
umgaqo-nkqubo wokugcina uphicotho ngaphandle kweplagini.

## Uphuhliso novavanyo

Iimvavanyo zizikripthi ze-PHP eziqhelekileyo ezisebenza ngaphandle kwe-Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

I-CI ihlola i-PHP kwaye iqhuba izikripthi kwi-`tests/` (nganye idweliswe
kwi-`.github/workflows/ci.yml`) kwi-PHP 8.2 ukuya kwi-8.5, emva koko yakha
uvimba we-`mcp/` ofakekayo kunye ne-checksum yawo. Iimvavanyo ezichaphazela i-Cacti
zisebenzisa ii-fixture kumda womncedisi we-Cacti; azivavanyi ukufakwa okupheleleyo kwe-Cacti.

### Iimvavanyo zokudibanisa

`tests/integration/run.sh 1.2.31` okanye `tests/integration/run.sh develop` ifaka
iplagini kwi-Cacti yokwenene kwii-container kwaye iqhuba uhlolo oluphilayo kuyo.
Ifuna i-Docker ene-Compose v2.23.1 okanye entsha kunayo, i-git ne-openssl.
I-`KEEP=1` ishiya i-stack isebenza ukuze kulungiswe iimpazamo. I-CI iyayiqhuba
rhoqo ngobusuku naxa ifunwa, hayi kwii-pull request.

## Ulungelelwaniso lweelwimi

I-Cacti MCP ithumela iikhathalogi ze-GNU gettext ezidibanisiweyo phantsi kwe-`locales/po/`
kunye ne-`locales/LC_MESSAGES/` kunye nee-README eziguqulelweyo phantsi kwe-`docs/i18n/`
zesiNgesi kunye nezinye iilokheyili ezingama-44 (ezili-19 ze-Broad Tier 1, ezili-15
zase-Afrika, kunye nezi-10 zase-Asiya), isebenzisa i-domain yombhalo ye-`mcp`
(`locales/po/mcp.pot`). I-Cacti ilayisha ikhathalogi ehambelanayo ngokuzenzekelayo
xa inkxaso yolwimi ivuliwe.

## Ukufaka isandla

Ii-pull request ziya kwi-`develop`. Gcina ikhowudi yemveliso ihambelana ne-PHP 8.2
kwaye usebenzise isitayile se-Cacti: ii-tab, imitya enophawu lwesicatshulwa olulodwa,
kunye nabancedisi besiseko sedatha nabemvume be-Cacti. Yongeza iimvavanyo zokutshintshwa
koqinisekiso, ugunyaziso, okanye indlela yokusebenza yeprothokholi, kwaye usayine ii-commit
nge-`git commit -s`. Lungelelanisa utshintsho kwi-HTTP API ne-[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Ilayisensi

Ilungelo lokushicilela (C) 2026 Thomas Vincent. Ikhutshwe phantsi kwe-GNU General Public
License, uguqulelo 2 okanye olutsha kunalo. Jonga i-[LICENSE](../../../LICENSE).
