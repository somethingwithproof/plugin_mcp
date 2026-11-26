<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: i-cactus enesihlangu. Thola. Gunyaza. Sebenzisa.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Ilayisensi: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

I-Cacti MCP iyi-plugin ye-Cacti evumela amaklayenti e-AI ukuthi afunde idatha yakho ye-Cacti ngemisebenzi enegama, ehlungwe ngezimvume ebizwa ngokuthi amakhono (abilities). Iwahlinzeka ngezindlela ezimbili isuka kuyo i-plugin ngokwayo: indawo yokugcina ye-MCP (`mcp.php`, i-Streamable HTTP) kanye ne-HTTP API enesitayela se-AIP (`api.php`). I-Cacti ihlala iphethe ukugunyazwa nokwenziwa kwemisebenzi. Iklayenti alikaze libuze isizindalwazi ngqo; lingabiza kuphela ikhono elivezwe umlawuli futhi elivunyelwe izindawo ze-Cacti zomnikazi wethokheni.

Ababhali bama-plugin bangabhalisa amakhono abo okufunda kuphela nge-hook ye-`abilities_register`, futhi avela kumaklayenti e-MCP njengamathuluzi ngaphandle kwekhodi ye-protocol.

**Isimo: ngaphambi kokukhululwa, inguqulo 0.1.0.** Akukho ukukhululwa okumakwe ngomaka.

Okutholakalayo namuhla:

- Amakhono akhelwe ngaphakathi okufunda kuphela ezinguqulo zesistimu kanye nohlu lwamadivayisi.
- Amathokheni okufinyelela omuntu siqu (`cmcp_pat_...`) njengekuphela kwesiqinisekiso.
- Ikhonsoli ye-Management > MCP: veza noma fihla amakhono, dala futhi uhoxise amathokheni, funda irekhodi lokuhlola.
- I-Management > My MCP Tokens: abasebenzisi baphatha amathokheni abo, babone umsebenzi wabo, futhi babone ukuthi yimaphi amathuluzi amathokheni abo angawasebenzisa.
- I-MCP phezu kwe-Streamable HTTP, izibuyekezo ze-protocol `2026-07-28` kanye ne-`2025-11-25`, amathuluzi kuphela.

Okungakatholakali okwamanje:

- Ukungena nge-OAuth 2.1. Izixhumi ezisingathiwe ezingakwazi ukuthumela ithokheni yomuntu siqu, njengezixhumi ezenziwe ngokwezifiso ze-ChatGPT ne-claude.ai, azikwazi ukuxhuma kuze kube yilapho lokhu sekukhona. Kuhlelelwe njenge-Plan 2; lolo hlelo alukabhalwa okwamanje.
- Amakhono okubhala. Amakhono okufunda kuphela kuphela angabhaliswa.

Umklamo uku-[spec somklamo wendawo yokugcina](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md), futhi ukulandelana kokwakha kuku-[docs/plan.md](../../plan.md).

## Amakhono akhelwe ngaphakathi

| I-ID | Ama-argument | Indawo ye-Cacti edingekayo |
| --- | --- | --- |
| `cacti-get-system-info` | awekho | 15 |
| `cacti-list-devices` | okokuzikhethela `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | okudingekayo `name`, okufana ne-`devices/12` | 3 |

Yonke imibuzo idinga futhi indawo ye-**MCP and Abilities API** yomnikazi wethokheni, ububanzi be-`abilities:read` (yonke ithokheni yomuntu siqu inabo), kanye nekhono eliveziwe. Ithebhu ye-Abilities ekhonsolini ikhombisa indawo edingwa yikhono ngalinye elakhelwe ngaphakathi.

- I-`cacti-list-devices` ibuyisa amakhasi afinyelela kumadivayisi ayi-100 (okuzenzakalelayo okungama-50) kanye ne-`nextPageToken`. Ithokheni yekhasi isebenza kuphela ku-`filter` kanye ne-`orderBy` efanayo. I-`filter` iyinkulumo ye-AIP-160 yokuqhathanisa ehlanganiswe nge-`AND`, ngokwesibonelo `state = "DOWN" AND disabled = false`. Izinkambu zokuhlunga yi-`displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, kanye ne-`state`. I-`orderBy` ithatha i-`displayName`, `hostname`, noma `name`, ngayinye ingalandelwa yi-`desc` ngokuzithandela.
- Imibuzo yamadivayisi idlula ku-`get_allowed_devices()` ye-Cacti, ngakho umsebenzisi ubona kuphela amadivayisi i-Cacti ebengamkhombisa wona.
- Izinkambu zamadivayisi azibandakanyi amachungechunge omphakathi we-SNMP, imishwana yokudlula, kanye nezinye iziqinisekiso.

## Ukufaka

Idinga i-Cacti 1.2.31 noma yakamuva, i-PHP 8.2 noma yakamuva, kanye ne-poller enkulu. Ukufakazela ubuqiniso kwe-Cacti kufanele kunikwe amandla; i-plugin iyala ukufakazela uma kuvaliwe.

Uhla lwemibhalo lwe-plugin kufanele lubizwe ngokuthi `mcp`, hhayi `plugin_mcp`. I-slug ye-plugin, amagama ezindawo, isizinda sokuhumusha, kanye nama-URL konke kusebenzisa i-`mcp`.

Kusuka ekukhishweni kwekhodi yomthombo:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Kuze kube yilapho ukukhululwa okumakwe ngomaka sekukhona, ungakwazi esikhundleni salokho ukulanda i-artifact ye-`mcp-plugin` kusuka ku-[run ye-CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) ephumelele. Iqukethe i-`mcp.tar.gz` kanye ne-`SHA256SUMS`. Qinisekisa i-checksum, bese ukhipha i-`mcp.tar.gz` ngaphakathi kohla lwemibhalo lwe-`plugins/` lwe-Cacti ukuze umphumela ube yi-`plugins/mcp/`. Izingobo zomthombo ezizenzakalelayo ze-GitHub zisebenzisa igama elihlukile lohla lwemibhalo olusezingeni eliphezulu. Ingobo ishiya ngaphandle i-`docs/` (kuhlanganise nezithombe-skrini ezingezansi), i-`tests/`, kanye ne-`.github/`, ngakho izixhumanisi ze-README eziya ku-`docs/` zisebenza ku-GitHub kodwa hhayi kukhophi efakiwe.

Bese:

1. Ku-Plugin Management, faka futhi unike amandla i-**Cacti MCP**. Umlawuli ofakayo uthola indawo ye-**MCP Administration** ngokuzenzakalelayo.
2. Ngaphansi kwe-Settings > MCP, setha i-**Public Cacti URL** ikheli elisetshenziswa amaklayenti, ngokwesibonelo `https://cacti.example.com/cacti`. I-HTTPS iyadingeka ngaphandle kwe-`localhost`, `127.0.0.1`, kanye ne-`[::1]`. Kuze kube yilapho lokhu sekusethiwe, i-`mcp.php` iphendula nge-HTTP 400 ngephutha le-JSON-RPC eline-`data` eyi-`FAILED_PRECONDITION` kanye ne-`PUBLIC_URL_REQUIRED`. I-`api.php` ayikufundi lokhu.

   ![I-Settings > MCP ekhombisa inkambu ye-Public Cacti URL](../../images/settings-public-url.png)

3. Nika umsebenzisi ngamunye ozoba umnikazi wethokheni indawo ye-**MCP and Abilities API**. Akekho umsebenzisi oyitholayo ngokuzenzakalelayo.
4. Qiniseka ukuthi iseva yewebhu idlulisela unhlokweni we-`Authorization` kanye nolwazi lwendlela ku-PHP (bheka ngezansi).
5. Vula i-Management > MCP bese uveza amakhono ofuna amaklayenti awabone.

**Ukuthuthukisa kusuka kusakhiwo sokuthuthukisa.** I-plugin isengaphambi kokukhululwa, futhi amathebula ayo ashintshile ngesikhathi sokuthuthukiswa ngaphandle kokufuduka. Uma ufake isakhiwo sangaphambilini, sikhiphe bese usifaka futhi. Ukufaka futhi kugcina amathebula asevele ekhona, ngakho susa amathebula amadala e-`plugin_mcp_token`, `plugin_mcp_audit`, kanye ne-`plugin_mcp_ability` kuqala (kanye namathebula afanayo avela ezakhiweni ezenziwe ngaphambi kokushintshwa kwegama). Wenzele ikhophi yasenqolobaneni uma udinga umlando wawo; amathokheni avela kulezo zakhiwo ayahoxiswa ekukhipheni futhi awaqhubekeli phambili.

### Iseva yewebhu

Izilungiselelo ze-Apache ezisusa i-`Authorization` ngaphambi kwe-PHP zidinga lokhu ku-virtual host noma kuhla lwemibhalo olufanele, okulandelwa ukulayisha kabusha:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

I-Apache ene-`mod_php` inikeze imizila ye-`api.php` ngaphandle kokucushwa kwendlela okwengeziwe.

Imizila ye-`api.php` ihlala endleleni ngemva kwegama leskripthi (`/plugins/mcp/api.php/v1/abilities`), ngakho i-nginx kufanele ifanise ama-URI lapho i-`.php` ilandelwa yindlela eningi, ihlukanise ulwazi lwendlela, futhi iludlulisele ku-PHP. I-block ye-`location ~ \.php$` ayikaze ifanise lawa ma-URL; i-nginx iphendula nge-HTML 404 yayo. Iphethini yendawo kanye nemigqa emibili yolwazi lwendlela engezansi kuqinisekiswe nge-PHP-FPM; eminye imigqa iyisakhiwo esijwayelekile:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Lungisa imigqa ye-`include` ne-`fastcgi_pass` ukuze ifane ne-block esivele inikeza i-Cacti. Ungangezi i-`try_files $fastcgi_script_name =404;` kule block: isula i-`$fastcgi_path_info`, futhi i-`api.php` ibe isiphendula nge-404 `UNKNOWN_PATH`. Uma ukucushwa kwakho kudinga i-`try_files`, gcina inani kuqala nge-`set $path_info $fastcgi_path_info;` bese udlulisa i-`fastcgi_param PATH_INFO $path_info;`.

I-`mcp.php` ayinayo imizila yendlela futhi ayikudingi.

## Ikhonsoli

I-Management > MCP inamathebhu amathathu. Udinga indawo ye-**MCP Administration**. Izithombe-skrini lapha nangezansi zivela kusakhiwo sokuthuthukisa se-Cacti esinedatha eyisibonelo.

- **Abilities** ibala lonke ikhono elibhalisiwe kanye ne-plugin yalo, isigaba, indawo eliyidingayo, kanye nokuthi liveziwe yini. Khetha imigqa bese ukhetha u-Expose noma u-Hide; uyaqinisekisa ngaphambi kokuba ushintsho lusebenze. Amakhono akhelwe ngaphakathi e-`cacti-*` avezwa ngokuzenzakalelayo. Amakhono avela kwamanye ama-plugin aqala efihliwe, ngakho ukufaka i-plugin akukaze kushicilele lutho kuze kube yilapho umlawuli enquma ukwenza njalo. Ukuvezwa kunciphisa ukufinyelela kuphela: umsebenzisi usadinga indawo yekhono.

  ![Ithebhu ye-Abilities ebala amakhono akhelwe ngaphakathi nezindawo zawo kanye nesimo sokuvezwa](../../images/console-abilities.png)
- **Tokens** ibala amathokheni nomnikazi, umdali, ukudalwa, ukuphelelwa yisikhathi, ukusetshenziswa kokugcina, kanye nesimo (Active, Expired, Revoked). Khetha imigqa bese ukhetha u-Revoke ukuze uwahoxise. Amathokheni ahoxisiwe awakwazi ukusetshenziswa futhi. I-Create Token yenza elisha.

  ![Ithebhu ye-Tokens ebala amathokheni nomnikazi, ukuphelelwa yisikhathi, ukusetshenziswa kokugcina, kanye nesimo, ngaphezu kwefomu le-Create Token](../../images/console-tokens.png)
- **Audit** ibala imigqa yokuhlola, emisha kuqala, futhi ihlunga ngomsebenzisi, ikhono, kanye nomphumela.

  ![Ithebhu ye-Audit ebala ukubizwa kwamakhono nomsebenzisi, ithokheni, ikhono, kanye nomphumela, nezihlungi](../../images/console-audit.png)

## Amathokheni

Ithokheni yomuntu siqu ifunda i-Cacti njengomnikazi wayo. Inesimo esithi `cmcp_pat_` esilandelwa izinhlamvu ezingama-64 ze-hex ezincane futhi ithwala ububanzi obulodwa obungu-`abilities:read`. Lokho engakubona kunqunywa izindawo ze-Cacti zomnikazi wayo kanye nezimvume zamadivayisi, hhayi yithokheni. Umnikazi kufanele abe umsebenzisi onikwe amandla onendawo ye-**MCP and Abilities API**.

Amathokheni ahlala edalelwa umsebenzisi, ayaphelelwa yisikhathi, futhi angahoxiswa:

- **Ikhonsoli.** I-Management > MCP > Tokens > Create Token. Isikhathi sokuphila siyizinsuku ezi-1 kuya kwezingama-365 futhi ngokuzenzakalelayo singama-90. Ithokheni ikhiqizwa yiseva futhi iboniswa kanye ekhasini lempendulo, ngakho yikopishe kumphathi wakho wezimfihlo ngokushesha. Ungazidalela ithokheni. Ukudalela omunye umsebenzisi nakho kudinga indawo ye-Users/Groups, ngoba ithokheni ifunda i-Cacti njengalowo msebenzisi.
- **I-My MCP Tokens.** Noma yimuphi umsebenzisi onendawo ye-MCP and Abilities API angaphatha amathokheni akhe; bheka ngezansi.
- **Umugqa womyalo.** I-`tokens.php` isebenza kuphela kusuka ku-CLI, njenge-akhawunti ye-OS engalawula i-Cacti. Ithatha ithokheni endaweni ezungezile ukuze inani lingalokothi livele emugqeni womyalo noma ohlwini lwenqubo. Isikhathi sokuphila siyizinsuku ezi-1 kuya kwezingama-365 futhi ngokuzenzakalelayo singama-30. Ukudala nokuhoxisa ithokheni nge-CLI kuyahlolwa njengekhonsoli, nomnikazi wethokheni njengomenzi ngoba i-CLI ayinaye umsebenzisi we-Cacti, ngakho umugqa wokuhlola awumaki isenzo njengesisuka ku-CLI. I-`--list` iphrinta yonke ithokheni njenge-JSON (I-ID, umnikazi, ububanzi, izitembu zesikhathi, ifulegi elihoxisiwe) futhi ayilokothi iphrinte inani lethokheni; i-`--help` ikhombisa ukusetshenziswa.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Amathokheni awakwazi ukudalelwa i-akhawunti yesivakashi, abasebenzisi abakhubaziwe, noma abasebenzisi abangenayo indawo ye-**MCP and Abilities API**, kusuka ekhonsolini, emugqeni womyalo, noma ku-My MCP Tokens. I-Cacti igcina ukulungiselelwa kwesivakashi njengegama lomsebenzisi noma i-ID yomsebenzisi, futhi i-plugin ixazulula kokubili. Ithokheni umnikazi wayo oba yi-akhawunti yesivakashi iyayeka ukusebenza esicelweni sayo esilandelayo.

### I-My MCP Tokens

I-Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ayidingi indawo yokulawula: imbozwe yindawo ye-**MCP and Abilities API**, futhi ukungena kwemenyu kuvela kuphela kubasebenzisi abanayo. Ikhasi lihlala lisebenza kumsebenzisi ongenile. Imenyu ye-Cacti iyingxenye yekhonsoli, ngakho umsebenzisi ongenakho ukufinyelela kwekhonsoli ufinyelela ekhasini ngekheli lalo.

![Ithebhu ye-My Tokens ebala amathokheni omsebenzisi ongenile kanye nefomu lokudala](../../images/my-tokens.png)

- **Tokens** ibala amathokheni akho, idala elilodwa (izinsuku ezi-1 kuya kwezingama-365, okuzenzakalelayo okungama-90, iboniswa kanye empendulweni), futhi ihoxisa awakho. Awukwazi ukubona noma ukuhoxisa awomunye umuntu.
- **Activity** ibala izenzo ozenzile, ezintsha kuqala: ukubizwa okwenziwe ngamathokheni akho kanye nezinguquko zethokheni ozenzile.
- **Available Tools** ibala amakhono ithokheni yakho engawasebenzisa khona manje, ne-ID yekhono ngalinye, igama, kanye nencazelo. Ilandela izimvume zakho ze-Cacti kanye nezilungiselelo zokuvezwa ezikhethwe umlawuli.

  ![Uhlu lwe-Available Tools olukhombisa i-ID yekhono ngalinye, igama, nencazelo](../../images/my-tools.png)

Ukufakwa okwenziwe ngaphambi kokuba leli khasi libe khona kunohlu lwefayela lendawo olungenayo i-`mcp_tokens.php`. Ukufaka kubhalisa uhlu; alubuyekezwa ngokunika amandla noma ukukhubaza i-plugin. Khipha bese ufaka i-plugin futhi, bese unikeza izindawo futhi, ngoba i-Cacti isusa izipho zendawo uma i-plugin ikhishwa.

Isizindalwazi sigcina kuphela i-hash ye-SHA-256 yethokheni, ngakho ithokheni elahlekile ayikwazi ukubuyiselwa; yihoxise bese udala enye. Ukushintshanisa kuyafana: dala ithokheni entsha, shintsha iklayenti, bese uhoxisa endala. Ithokheni ephelelwe yisikhathi, ithokheni ehoxisiwe, umnikazi okhubaziwe, noma indawo elahlekile konke kuyahluleka esicelweni esilandelayo. Amathokheni amukelwa kuphela kunhlokweni we-`Authorization: Bearer`; ithokheni ekuchungechungeni lwemibuzo noma emzimbeni ayemukelwa.

## Xhuma iklayenti

Sebenzisa i-endpoint ye-MCP ethi `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, enethokheni kwisheda ye-`Authorization: Bearer`. Gcina ithokheni ku-variable yendawo yokusebenza noma kumphathi wezimfihlo bese uyikhomba kusuka ekulungiselelweni kweklayenti esikhundleni sokubhala inani layo efayeleni.

### Claude Code

Faka i-endpoint ku-`.mcp.json` yephrojekthi ekhomba ithokheni ngegama. I-Claude Code inweba u-`${VAR}` ku-`url` nakuma-`headers`, ngakho-ke ifayela alinawo amagama ayimfihlo futhi liphephile ukuthunyelwa (commit). Khipha (export) u-`CACTI_MCP_TOKEN` endaweni yokusebenza eqala i-Claude Code.

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

Ungayengeza futhi kusuka kulayini womyalo:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Ngabacaphuni ababili, i-shell yakho inweba u-`$CACTI_MCP_TOKEN` kuqala, ngakho-ke inani lethokheni libhalwa efayeleni lokulungiselela le-`--scope` ekhethiwe (`local`, `user`, noma `project`; okuzenzakalelayo ngu-`local`). Ungalusebenzisi lolo hlobo nge-`--scope project`, futhi ugcine ifayela lingekho kulawulo lwezinguqulo (version control). Khetha inkomba ye-`.mcp.json` engenhla. I-Claude Code ifunda amanye ama-variable obufakazi (njengo-`ANTHROPIC_AUTH_TOKEN`) njengangenalutho ku-`url` nakuma-`headers` akude; u-`CACTI_MCP_TOKEN` akayona enye yawo. Umthombo: [Imibhalo ye-Claude Code MCP](https://code.claude.com/docs/en/mcp).

### I-GitHub Copilot ku-VS Code

Sebenzisa i-`.mcp.json` yempande yendawo yokusebenzela (noma ifayela lomsebenzisi `~/.copilot/mcp-config.json`). Lawa mafayela angokwendalo we-Copilot asebenzisa i-object yezinga eliphezulu ye-`mcpServers` kanye nezinkomba zama-variable endawo yokusebenzanza ze-`${NAME}` kumanani eheda:

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

Khipha (export) u-`CACTI_MCP_TOKEN` endaweni yokusebenza eqala i-VS Code. Amafayela angokwendalo we-Copilot awasekeli imibuzo ye-`inputs`. Ukusethwa okuqondisiwe kwe-VS Code kuyawenqaba amanani e-`${...}`, ngakho-ke engeza iheda ye-`Authorization` ngokuhlela ifayela, hhayi ngohlelo oluqondisiwe. Ukusethwa okuqondisiwe kunikeza ifayela lempande yendawo yokusebenzela kuphela uma ukulungiselelwa kokuhlola kwe-`chat.mcp.workspaceRootConfig.enabled` kuvuliwe. Bona [inkomba yokulungiselela i-VS Code MCP](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Okwakudala: `.vscode/mcp.json`.** I-VS Code ithi ukulungiselelwa okusha kwe-Copilot akufanele kusebenzise i-`.vscode/mcp.json` noma i-`mcp.json` yephrofayela; kungokwe-Local harness esiphelelwe yisikhathi, ezosuswa ngoFebhuwari 2027. Uma usayisebenzisa, ifomethi ephethwe ngumhleli ithatha ukhiye wezinga eliphezulu we-`servers` futhi ingakwazi ukucela ithokheni:

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

### Amaklayenti akhuluma i-stdio kuphela

I-[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) iyi-adaptha yokuzikhethela esebenza njengeseva ye-stdio MCP yasendaweni futhi eshayela i-HTTP API ye-plugin. Yisebenzisele iklayenti elingakwazi ukuxhuma kuseva ye-HTTP ekude. Idinga ithokheni efanayo yomuntu siqu futhi ikhuluma ne-`api.php`.

### Ukuziphatha kwe-MCP

I-endpoint inikeza amathuluzi kuphela: ikhono ngalinye eliveziwe, elivunyelwe liyithuluzi eliqanjwe nge-ID yalo, elinama-schema alo okufakwayo nokuphumayo kanye nezichasiselo zokufunda kuphela (u-`openWorldHint` ngu-`false`). Iphatha i-`initialize`, `server/discover`, `ping`, `tools/list`, kanye ne-`tools/call`. Ayigcini seshini, ayithumeli i-`Mcp-Session-Id` (futhi iyayiziba eyamukelayo), futhi ayamukeli amaqoqo e-JSON-RPC. Umlayezo ongenayo i-`id` uyisaziso futhi uthola i-HTTP 202 engenamzimba. Kuvunyelwe i-`POST` kuphela.

- **Izibuyekezo.** Isicelo esiphethe i-`io.modelcontextprotocol/protocolVersion` ku-`params._meta` kufanele siqambe u-`2026-07-28`; noma yini enye ithola iphutha elithi `-32022`. Izicelo ezinjalo kufanele futhi ziphathe amaheda afanayo e-`Mcp-Protocol-Version`, `Mcp-Method`, kanye (kwe-`tools/call`) `Mcp-Name`, ngaphandle kwalokho impendulo iyiphutha elithi `-32020`. Ezinye izicelo ziphathwa njenge-`2025-11-25`: i-`initialize` iphendula ngalelo buyekezo, futhi kunoma iyiphi enye indlela iheda ye-`Mcp-Protocol-Version`, uma ithunyelwe, kufanele ibe ngu-`2025-11-25`, `2025-06-18`, noma `2025-03-26`.
- **Amaphutha amathuluzi.** Iphutha lekhono, okuhlanganisa ama-argument angahambisani ne-schema noma inani le-`arguments` elingeyona i-object ye-JSON, libuya njengomphumela wethuluzi ono-`isError: true` kanye nephutha le-AIP-193 ku-`structuredContent`, hhayi njengephutha lephrothokholi.
- **Amaphutha ephrothokholi.** Ukwehluleka okungewona amaphutha amathuluzi kungama-object ephutha e-JSON-RPC (ikhodi ethi `-32000` enesimo nesizathu ku-`data`, noma amakhodi ajwayelekile): i-Public Cacti URL engekho, i-`Origin` enqatshiwe, isicelo ngesikhathi i-plugin ikhutshaziwe noma iku-poller ekude, kanye namaphutha eseva angalindelekile (`-32603`, nemininingwane ebhalwa kulogi ye-Cacti, hhayi empendulweni). Ukuhlolwa kwezicelo okusebenza kuqala (405, 413, 415) kanye nokwehluleka kokufakazela ubuqiniso (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) kugcina umzimba we-AIP-193 ochazwe ngaphansi kwe-HTTP API.

## I-HTTP API

I-URL eyisisekelo: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Inkontileka iku-[openapi.json](../../../openapi.json).

| Indlela kanye nendlela (path) | Inhloso |
| --- | --- |
| `GET /v1/abilities` | Bhala amakhono avunyelwe. Umbuzo: `pageSize`, `pageToken`, kanye ne-`filter` yohlobo oluthi `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Funda ikhono elilodwa. |
| `POST /v1/abilities/{id}:execute` | Lisebenzise. Umzimba uncamashi u-`{"arguments": {...}}`. Impendulo ithi `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Amaphutha alandela i-AIP-193: i-object ye-`error` eno-`code`, `message`, `status`, kanye ne-`details` ephethe i-`ErrorInfo` ene-domain engu-`cacti.net` kanye ne-`reason` ezinzile. Izinkinga zama-argument zengeza imininingwane ye-`BadRequest` eqamba inkambu. Imizimba yezicelo ikhawulelwe ku-64 KB, kanti imiphumela ku-1 MB. Zombili izindawo ze-endpoint ziphendula kuphela ku-poller eyinhloko futhi zibuyisa u-`UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) lapho i-plugin ikhutshaziwe noma iseva ingeyona i-poller eyinhloko.

| HTTP | Amanani e-`reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (iphinde ithumele i-`WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (ithumela i-`Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Bhala ikhono (abalobi bama-plugin)

I-plugin ye-Cacti enikwe amandla ibhalisa amakhono kusuka ku-function eyinamathisela ku-hook ye-`abilities_register`, ngokuvamile ku-`plugin_<slug>_install()` yayo:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Le function ithola i-`AbilitiesRegistrar` ekhawulelwe ku-plugin. Inani layo elibuyiswayo liyazitshwa.

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

Imithetho, yonke ephoqelelwa ngesikhathi sokubhalisa:

- **Ama-ID.** I-ID ihambisana ne-`^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, inezinhlamvu ezingeqile ku-64 ubuningi, futhi kufanele iqale nge-slug ye-plugin kanye nedweshana: `acme-` ngenhla. I-slug yigama lendawo yemibhalo (directory) ye-plugin, ngakho-ke indawo yemibhalo efana no-`my_plugin` ayikwazi ukubhalisa lutho. Indawo yemibhalo ye-plugin eqanjwe ngokuthi `cacti` iyenqatshwa; leyo namespace ingeyezakhiwo ezingaphakathi (built-ins).
- **Incazelo.** Lawa makhiye ncamashi: `label`, `description` (kuze kufike ku-4096 bytes), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Isigaba kufanele sivele sikhona: sebenzisa esakhelwe ngaphakathi (`inventory`, `system`) noma ubhalise esakho nge-`registerCategory()`, ene-ID ehlukile kuwo wonke ama-plugin futhi ehambisana ne-`^[a-z][a-z0-9-]{0,31}$`.
- **Ukufunda kuphela.** I-`annotations` kufanele ibe ngu-`readOnly: true`, `destructive: false`, `idempotent: true` ncamashi. Noma yini enye ikhipha iphutha (throws).
- **Ama-schema.** I-`input_schema` kanye ne-`output_schema` ngayinye kufanele ibe no-`type` wezinga eliphezulu ongu-`object`. Ulimi lwayo luncane futhi luyavala uma lwehluleka (fails closed). Ama-object kufanele avalwe (`additionalProperties: false`, kukhona i-`properties`); ezinye izinhlobo ngu-`integer` kanye no-`number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, kanye ne-`array` (edinga i-`items` ne-`maxItems`). Uhlobo lungenziwa lube nullable njenge-`['string', 'null']`. Imicu yama-argument ngokuzenzakalelayo inezinhlamvu ezingeqile ku-4096 ubuningi; imicu yemiphumela ikhawulelwe kuphela yi-`maxLength` emenyezelwe kanye nomkhawulo wosayizi womphumela. Kungabhaliswa amakhono angeqile ku-256 ubuningi.
- **`permission(int $userId): bool`.** Kufanele ibuyise u-`true` ncamashi ukuze ivumele. I-ID yomsebenzisi ingeyomnikazi wethokheni; ungalokothi ufunde isimo seseshini.
- **`execute(int $userId, stdClass $args): array`.** U-`$args` usevele uqinisekisiwe ngokumelene ne-`input_schema`. Ziphoqelele wena ngokwakho izimvume zezinga le-object. Buyisa i-associative array ehambisana ne-`output_schema` ncamashi; uhlu (list), inkambu eyengeziwe, noma ngaphezu kuka-1 MB we-JSON kuba yiphutha le-`INVALID_RESULT`. Phonsa i-`AbilitiesError` ngokwehluleka okubonakalayo kuklayenti, njenge-`NOT_FOUND`.
- **Ama-object angenalutho.** I-PHP ibhala i-`[]` njenge-array ye-JSON. Nomaphi lapho i-output schema imemezela khona i-`object`, kunoma yikuphi ukujula, irejista iphatha i-`[]` njenge-object engenalutho bese ithumela i-`{}`; u-`new stdClass()` uyasebenza nawo. Uhlu olungekho lungenalutho alubalwa nanini njenge-object futhi luyehluleka ngo-`INVALID_RESULT`. Imephu ye-`properties` engenalutho ku-schema ingaba yi-`[]` noma i-`new stdClass()`; zombili zishicilelwa njenge-`{}`.
- **Ukuhlukaniswa kokwehluleka.** I-plugin ngayinye ibhalisela kwikhophi yesikhashana egcinwa kuphela uma i-function yakho ibuya ngokujwayelekile. Uma iphonsa iphutha, awekho amakhono akho abhaliswayo, futhi ukwehluleka kuyabhalwa kulogi.

Amakhono avela kuma-plugin aqala efihliwe. Umlawuli uyawaveza kuthebhu ye-Abilities yekhonsoli, futhi ikholomu ye-Required Realm ifundeka ngokuthi "Set by the plugin" kuwo.

## Imodeli yokuvikela

- **I-Bearer kuphela.** I-`api.php` ne-`mcp.php` zamukela ithokheni yomuntu siqu ku-header ye-`Authorization` kuphela futhi azamukeli lutho olungaphezu kwalokho. Zilahla ama-cookie, i-`$_POST`, ne-`$_REQUEST` ngaphambi kokuba i-Cacti ilayishe futhi zibhubhise iseshini eqalwa yi-Cacti, ngakho ukungena nge-browser akusoze kwanikeza ukufinyelela ku-API.
- **Indlela yokudlula i-CSRF.** Isivikeli se-CSRF se-Cacti siyala i-JSON POST engenayo ithokheni ye-CSRF ye-Cacti, okungekho iklayenti le-MCP elingayithumela. Kulawa ma-endpoint amabili kuphela, i-plugin ishintsha igama lendlela yesicelo ngaphambi kokuba i-Cacti ilayishe bese ilibuyisela ngemva kwalokho, ukuze isivikeli sizishiye. Lokhu kuphephile ngoba i-CSRF ivikela izicelo eziqinisekiswa yi-browser ngama-cookie, futhi lawa ma-endpoint awamukeli ubunikazi be-cookie: ikhasi le-cross-site alikwazi ukunamathisela ithokheni ye-bearer. Amakhasi e-console agcina ukuvikelwa okugcwele kwe-CSRF. Le ndlela ingeyesikhashana, kuze kube yilapho i-Cacti inikeza ukukhululwa okusekelwayo; bheka ku-`lib/bootstrap.php`.
- **Ukuhlola i-Origin.** Ku-`mcp.php`, uma isicelo sine-header ye-`Origin` kufanele sifane ngqo ne-scheme, i-host, ne-port ye-URL Yomphakathi ye-Cacti, noma isicelo senqatshwe nge-`ORIGIN_NOT_ALLOWED`. Isicelo esingenayo i-header ye-`Origin`, okuyindlela amaklayenti angewona awe-browser axhuma ngayo, siyavunyelwa. Lokhu kuvimbela ikhasi lewebhu ekusebenziseni i-endpoint kusuka ku-browser yesivakashi. I-`api.php` ayikusebenzisi lokhu kuhlola.
- **Ukufunda kuphela.** Ukubhalisa kuyala noma yiliphi ikhono elingeyona eyokufunda kuphela, elingalimazi, neliyi-idempotent.
- **Ukuvezwa nama-realm kokubili kuyasebenza.** Ikhono kufanele livezwe futhi umnikazi wethokheni kufanele abe ne-realm yalo. Uma ithebula lokuvezwa lingafundeki, wonke amakhono ayafihlwa esikhundleni sokubuyela kokuzenzakalelayo.
- **Okufihliwe, okungaziwa, nokungavunyelwe kubukeka ngendlela efanayo.** Iklayenti alikwazi ukuhlukanisa phakathi kwekhono elingekho nelifihliwe noma lelo umsebenzisi walo angavumelekile ukulisebenzisa: ukutholakala kuyalishiya futhi ukwenziwa kubuyisela i-`NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Amathokheni.** Agcinwa njengama-hash e-SHA-256, akhonjiswa kanye kuphela, aphelelwa yisikhathi njalo, ayahoxiseka, futhi ayenqatshwa uma umnikazi ekhutshaziwe noma elahlekelwa yi-realm.
- **Ukuhlolwa.** I-`plugin_mcp_audit` iqopha i-ID yesicelo, i-ID yethokheni, i-ID yomsebenzisi, ikhono, umphumela (`started`, `succeeded`, `failed`, `denied`, `rejected`), kanye nezitembu zesikhathi. Ayisoze yaqopha ama-argument, imiphumela, noma amanani ethokheni. Ikhono lisebenza kuphela ngemva kokuba umugqa walo we-`started` ubhaliwe; uma ithebula lokuhlolwa lingatholakali, ikholi iyehluleka nge-`UNAVAILABLE` futhi ayisebenzi. Ikholi enqatshwe ngaphambi kokuba isebenze ingumugqa owodwa: `denied` ngekhono elingaziwa, elifihliwe, noma elingavunyelwe, `rejected` ngama-argument ahlulekayo ku-schema. Ukudalwa nokuhoxiswa kwethokheni kusuka ku-console, ku-My MCP Tokens, nakwi-CLI kuqoshwa njenge-`mcp-token-create` ne-`mcp-token-revoke` kanye nomphumela othi `succeeded`, futhi ukuhoxiswa kuqoshwa kuphela ngethokheni ebiyisebenza. Ukutholakala, kanye nekholi ene-`arguments` engeyona i-JSON object, akuqoshwa kumalogi.
- **Ilogi yokwehluleka.** Ukwehluleka okungalindelekile, i-`INVALID_RESULT`, noma ithebula lokuhlolwa elingatholakali kubhala umugqa owodwa kulogi ye-Cacti nge-facility ye-`MCP`: i-ID yekhono, isizathu esimisiwe, kanye ne-class ye-exception. Imilayezo, ama-argument, namathokheni akusoze kwaqoshwa kulogi.
- **I-poller enkulu kuphela.** Womabili ama-endpoint, womabili amakhasi e-console, ne-`tokens.php` ayenqaba ukusebenza noma kuphi kwenye indawo.

## Umjikelezo wempilo

Ukukhubaza i-plugin kuvimba womabili ama-endpoint. Ukukhipha kuhoxisa wonke amathokheni futhi kugcina amathebula amathathu (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) ukuze agcinwe; ukufaka futhi akuvuseleli ithokheni ehoxisiwe. Yenza ikhophi yokusekela yamathebula kanye nedathabheyisi ye-Cacti bese usebenzisa inqubomgomo yokugcina ukuhlolwa ngaphandle kwe-plugin.

## Ukuthuthukiswa kanye nezivivinyo

Izivivinyo zingama-script e-PHP avamile asebenza ngaphandle kwe-Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

I-CI ihlola i-syntax ye-PHP futhi isebenzisa ama-script aku-`tests/` (ngalinye libhalwe ku-`.github/workflows/ci.yml`) ku-PHP 8.2 kuya ku-8.5, bese yakha ingobo yomlando efakekayo ye-`mcp/` kanye ne-checksum yayo. Izivivinyo ezithinta i-Cacti zisebenzisa ama-fixture emngceleni wosizo we-Cacti; azihloli ukufakwa okugcwele kwe-Cacti.

### Izivivinyo zokuhlanganisa

I-`tests/integration/run.sh 1.2.31` noma i-`tests/integration/run.sh develop` ifaka i-plugin ku-Cacti yangempela ngaphakathi kwama-container bese yenza ukuhlola okubukhoma kuyo. Idinga i-Docker ene-Compose v2.23.1 noma entsha kunaleyo, i-git ne-openssl. I-`KEEP=1` ishiya i-stack isebenza ukuze kulungiswe amaphutha. I-CI ikwenza lokhu njalo ebusuku nangesicelo, hhayi kuma-pull request.

## Ukwenziwa kwezilimi zendawo

I-Cacti MCP ithunyelwa namakhathalogi ahlanganisiwe e-GNU gettext ngaphansi kwe-`locales/po/` ne-`locales/LC_MESSAGES/` kanye nama-README ahunyushiwe ngaphansi kwe-`docs/i18n/` esiNgisi kanye nezindawo zezilimi ezingama-47 (19 ze-Broad Tier 1, 15 zase-Afrika, ezi-10 zase-Asia, kanye nesiBosnian, isiCroatian, nesiSerbian), kusetshenziswa i-text domain ye-`mcp` (`locales/po/mcp.pot`). I-Cacti ilayisha ikhathalogi ehambisanayo ngokuzenzakalelayo uma ukusekelwa kolimi kunikwe amandla.

## Ukufaka isandla

Ama-pull request aya ku-`develop`. Gcina ikhodi yokukhiqiza ihambisana ne-PHP 8.2 futhi usebenzise isitayela se-Cacti: ama-tab, ama-string akhonjwe nge-quote eyodwa, kanye nabasizi bedathabheyisi nabemvume be-Cacti. Engeza izivivinyo zokuqinisekisa okushintshiwe, ukugunyaza, noma ukuziphatha kwe-protocol, bese usayina ama-commit nge-`git commit -s`. Qondanisa izinguquko ze-HTTP API ne-[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Ilayisensi

Copyright (C) 2026 Thomas Vincent. Kukhishwe ngaphansi kwe-GNU General Public License, inguqulo yesi-2 noma entsha kunaleyo. Bheka ku-[LICENSE](../../../LICENSE).
