<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: igi ọ̀rọ́ pẹ̀lú apata. Ṣàwárí. Fún ní àṣẹ. Mú ṣẹ.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Ìwé-àṣẹ: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP jẹ́ ohun èlò àfikún Cacti tí ó ń gba àwọn ètò olùlo AI láàyè láti ka dátà Cacti rẹ nípasẹ̀ àwọn iṣẹ́ tí a fún lórúkọ tí a sì fi ìyọ̀ǹda ṣàṣàyàn, tí a ń pè ní àwọn agbára (abilities). Ó ń pèsè wọn ní ọ̀nà méjì láti inú ohun èlò àfikún náà fúnra rẹ̀: ojú-àbájáde MCP (`mcp.php`, Streamable HTTP) àti HTTP API bíi ti AIP (`api.php`). Cacti ṣì wà ní ìdarí ìfúnni-ní-àṣẹ àti ìṣeṣẹ. Ètò olùlo kò lè ṣe ìbéèrè sí ibi ìpamọ́ dátà láéláé; ó lè pe agbára tí olùṣàkóso bá ṣí sílẹ̀ nìkan àti èyí tí àwọn agbègbè Cacti ti olúwá àmì-àṣẹ náà bá fàyè gbà.

Àwọn òǹkọ̀wé ohun èlò àfikún lè forúkọ sílẹ̀ fún àwọn agbára kíkà-nìkan tiwọn nípasẹ̀ ìsopọ̀ `abilities_register`, wọn yóò sì farahàn sí àwọn ètò olùlo MCP gẹ́gẹ́ bí ohun èlò láìsí kòòdù ìlànà kankan.

**Ipò: ṣáájú ìtújáde, ẹ̀dà 0.1.0.** Kò sí ìtújáde tí a fi àmì sí lọ́wọ́lọ́wọ́.

Ohun tí ó wà lónìí:

- Àwọn agbára kíkà-nìkan àkọ́mọ́lé fún àwọn ẹ̀dà ètò àti àkójọ àwọn ẹ̀rọ.
- Àwọn àmì-àṣẹ ìwọlé ti ara-ẹni (`cmcp_pat_...`) gẹ́gẹ́ bí ìdánimọ̀ kan ṣoṣo.
- Pátákó ìṣàkóso Management > MCP: ṣí tàbí pa àwọn agbára mọ́, ṣẹ̀dá kí o sì fagilé àwọn àmì-àṣẹ, ka àkọsílẹ̀ ìṣàyẹ̀wò.
- Management > My MCP Tokens: àwọn olùlo ń ṣàkóso àwọn àmì-àṣẹ tiwọn, rí ìṣe wọn, kí wọ́n sì rí irú àwọn ohun èlò tí àmì-àṣẹ wọn lè lò.
- MCP lórí Streamable HTTP, àwọn àtúnyẹ̀wò ìlànà `2026-07-28` àti `2025-11-25`, àwọn ohun èlò nìkan.

Ohun tí kò tíì sí lọ́wọ́lọ́wọ́:

- Ìwọlé OAuth 2.1. Àwọn ìsopọ̀ tí a gbàlejò tí kò lè fi àmì-àṣẹ ti ara-ẹni ránṣẹ́, bíi àwọn ìsopọ̀ àdáni ChatGPT àti claude.ai, kò lè sopọ̀ títí tí yóò fi wà. A ti ṣètò rẹ̀ gẹ́gẹ́ bí Plan 2; ètò náà kò tíì jẹ́ kíkọ.
- Àwọn agbára kíkọ. Àwọn agbára kíkà-nìkan ṣoṣo ni a lè forúkọ sílẹ̀.

Àgbékalẹ̀ náà wà nínú
[àpèjúwe àgbékalẹ̀ ojú-àbájáde](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
ìtẹ̀léra ìkọ́lé náà sì wà nínú [docs/plan.md](../../plan.md).

## Àwọn agbára àkọ́mọ́lé

| ID | Àwọn pàrámítà (Arguments) | Agbègbè Cacti tí a nílò |
| --- | --- | --- |
| `cacti-get-system-info` | kò sí | 15 |
| `cacti-list-devices` | àṣàyàn `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | dandan `name`, bíi `devices/12` | 3 |

Ìpè kọ̀ọ̀kan tún nílò agbègbè **MCP and Abilities API** fún olúwá àmì-àṣẹ náà, ààyè `abilities:read` (gbogbo àmì-àṣẹ ti ara-ẹni ní i), àti agbára tí a ṣí sílẹ̀. Táàbù Abilities nínú pátákó ìṣàkóso fi agbègbè tí àkọ́mọ́lé kọ̀ọ̀kan nílò hàn.

- `cacti-list-devices` máa ń dá àwọn ojú-ìwé tí ó tó ẹ̀rọ 100 padà (àkọ́ṣẹ̀ṣe 50) àti `nextPageToken` kan. Àmì ojú-ìwé wúlò fún `filter` àti `orderBy` kan náà nìkan. `filter` jẹ́ ìsọ̀rọ̀ AIP-160 ti àwọn ìfiwéra tí a so pọ̀ pẹ̀lú `AND`, fún àpẹẹrẹ `state = "DOWN" AND disabled = false`. Àwọn pápá àṣàyàn ni `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, àti `state`. `orderBy` gba `displayName`, `hostname`, tàbí `name`, tí `desc` lè tẹ̀lé kọ̀ọ̀kan lọ́nà àṣàyàn.
- Àwọn ìbéèrè ẹ̀rọ máa ń gba inú `get_allowed_devices()` ti Cacti kọjá, nítorí náà olùlo máa ń rí àwọn ẹ̀rọ tí Cacti yóò fi hàn wọ́n nìkan.
- Àwọn pápá ẹ̀rọ yọ àwọn okùn àwùjọ SNMP, àwọn ọ̀rọ̀-ìkọ̀kọ̀, àti àwọn ìdánimọ̀ mìíràn kúrò.

## Ìfisílẹ̀

Ó nílò Cacti 1.2.31 tàbí tuntun jù bẹ́ẹ̀ lọ, PHP 8.2 tàbí tuntun jù bẹ́ẹ̀ lọ, àti olùṣàkóso ìwádìí àkọ́kọ́ (main poller). A gbọ́dọ̀ mú ìdánimọ̀ Cacti ṣiṣẹ́; ohun èlò àfikún náà máa ń kọ̀ láti fìdánimọ̀ múlẹ̀ nígbà tí ó bá wà ní pípa.

Orúkọ àpò ohun èlò àfikún náà gbọ́dọ̀ jẹ́ `mcp`, kì í ṣe `plugin_mcp`. Àmì-ìdánimọ̀ ohun èlò àfikún, àwọn orúkọ agbègbè, agbègbè ìtúmọ̀, àti àwọn URL gbogbo wọn ń lo `mcp`.

Láti inú ìgbàjáde kòòdù orísun:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Títí àwọn ìtújáde tí a fi àmì sí yóò fi wà, o lè ṣe ìgbasílẹ̀ ohun èlò `mcp-plugin` láti inú
[ìṣe CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) tí ó yọrí sí rere.
Ó ní `mcp.tar.gz` àti `SHA256SUMS` nínú. Ṣàyẹ̀wò àmì-ìṣàyẹ̀wò (checksum), lẹ́yìn náà tú `mcp.tar.gz` sí inú àpò `plugins/` ti Cacti kí èsì rẹ̀ lè jẹ́ `plugins/mcp/`. Àwọn àpò orísun aládàáṣe ti GitHub máa ń lo orúkọ àpò òkè tí ó yàtọ̀. Àpò náà yọ `docs/` (pẹ̀lú àwọn àwòrán ojú-òpó ìsàlẹ̀), `tests/`, àti `.github/` kúrò, nítorí náà àwọn ìjápọ̀ README sí `docs/` máa ń ṣiṣẹ́ lórí GitHub ṣùgbọ́n kì í ṣe nínú ẹ̀dà tí a ti fi sílẹ̀.

Lẹ́yìn náà:

1. Nínú Plugin Management, fi **Cacti MCP** sílẹ̀ kí o sì mú un ṣiṣẹ́. Olùṣàkóso tí ó fi sílẹ̀ yóò gba agbègbè **MCP Administration** láìfọwọ́ṣe.
2. Lábẹ́ Settings > MCP, ṣètò **Public Cacti URL** sí àdírẹ́sì tí àwọn ètò olùlo ń lò, fún àpẹẹrẹ `https://cacti.example.com/cacti`. HTTPS jẹ́ dandan àyàfi fún `localhost`, `127.0.0.1`, àti `[::1]`. Títí a ó fi ṣètò èyí, `mcp.php` yóò dá HTTP 400 padà pẹ̀lú àṣìṣe JSON-RPC tí `data` rẹ̀ jẹ́ `FAILED_PRECONDITION` àti `PUBLIC_URL_REQUIRED`. `api.php` kì í kà á.

   ![Settings > MCP tí ó ń fi pápá Public Cacti URL hàn](../../images/settings-public-url.png)

3. Fún olùlo kọ̀ọ̀kan tí yóò ni àmì-àṣẹ ní agbègbè **MCP and Abilities API**. Kò sí olùlo tí ó máa ń gbà á láìfọwọ́ṣe.
4. Rí i dájú pé olùpèsè wẹ́ẹ̀bù ń fi àkọlé `Authorization` àti ìsọfúnni ipa-ọ̀nà ránṣẹ́ sí PHP (wo ìsàlẹ̀).
5. Ṣí Management > MCP kí o sì ṣí àwọn agbára tí o fẹ́ kí àwọn ètò olùlo rí sílẹ̀.

**Ìgbéga láti inú ìkọ́lé ìdàgbàsókè.** Ohun èlò àfikún náà ṣì wà ṣáájú ìtújáde, àti pé àwọn tábìlì rẹ̀ yípadà nígbà ìdàgbàsókè láìsí ìṣílọ dátà. Tí o bá ti fi ìkọ́lé ìṣáájú sílẹ̀, yọ ọ́ kúrò kí o sì tún fi sílẹ̀. Títún fi sílẹ̀ máa ń pa àwọn tábìlì tí ó ti wà tẹ́lẹ̀ mọ́, nítorí náà pa àwọn tábìlì àtijọ́ `plugin_mcp_token`, `plugin_mcp_audit`, àti `plugin_mcp_ability` rẹ́ lákọ̀ọ́kọ́ (àti àwọn tábìlì tí ó bá wọn mu láti inú àwọn ìkọ́lé tí a ṣe ṣáájú ìyípadà orúkọ). Ṣe àfipamọ́ wọn tí o bá nílò ìtàn wọn; àwọn àmì-àṣẹ láti inú àwọn ìkọ́lé wọ̀nyẹn jẹ́ fífagilé nígbà yíyọkúrò wọn kò sì ní tẹ̀síwájú.

### Olùpèsè wẹ́ẹ̀bù

Àwọn ìṣètò Apache tí ó máa ń yọ `Authorization` kúrò ṣáájú PHP nílò èyí nínú àlejò fojú-inú tàbí àpò tí ó bá mu, kí a sì tún un gbé sókè lẹ́yìn náà:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache pẹ̀lú `mod_php` ti ṣiṣẹ́ fún àwọn ipa-ọ̀nà `api.php` láìsí ìṣètò ipa-ọ̀nà àfikún kankan.

Àwọn ipa-ọ̀nà `api.php` ń gbé nínú ipa-ọ̀nà lẹ́yìn orúkọ ìwé-àṣẹ (`/plugins/mcp/api.php/v1/abilities`), nítorí náà nginx gbọ́dọ̀ bá àwọn URI mu níbi tí ipa-ọ̀nà púpọ̀ bá tẹ̀lé `.php`, pín ìsọfúnni ipa-ọ̀nà náà yà, kí ó sì fi ránṣẹ́ sí PHP. Àkójọ `location ~ \.php$` kan kò bá àwọn URL wọ̀nyí mu láéláé; nginx máa ń dá HTML 404 tirẹ̀ padà. A ti fìdí ìlànà ibi àti àwọn ìlà ìsọfúnni ipa-ọ̀nà méjì ìsàlẹ̀ múlẹ̀ pẹ̀lú PHP-FPM; àwọn ìlà yòókù jẹ́ àpẹẹrẹ ìṣètò gbogbogbòò:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Ṣàtúnṣe àwọn ìlà `include` àti `fastcgi_pass` láti bá àkójọ tí ó ti ń ṣiṣẹ́ fún Cacti mu. Má ṣe fi `try_files $fastcgi_script_name =404;` kún àkójọ yìí: ó máa ń pa `$fastcgi_path_info` rẹ́, lẹ́yìn náà `api.php` yóò dá 404 `UNKNOWN_PATH` padà. Tí ìṣètò rẹ bá nílò `try_files`, fi iye náà pamọ́ lákọ̀ọ́kọ́ pẹ̀lú `set $path_info $fastcgi_path_info;` kí o sì fi `fastcgi_param PATH_INFO $path_info;` kọjá.

`mcp.php` kò ní àwọn ipa-ọ̀nà abẹ́lé kò sì nílò wọn.

## Pátákó ìṣàkóso

Management > MCP ní táàbù mẹ́ta. O nílò agbègbè **MCP Administration**. Àwọn àwòrán ojú-òpó níbí àti ní ìsàlẹ̀ wá láti inú ìkọ́lé ìdàgbàsókè Cacti pẹ̀lú dátà àpẹẹrẹ.

- **Abilities** ṣàkójọ gbogbo agbára tí a ti forúkọ sílẹ̀ pẹ̀lú ohun èlò àfikún rẹ̀, ẹ̀ka, agbègbè tí ó nílò, àti bóyá ó wà ní ṣíṣí sílẹ̀. Yan àwọn ìlà kí o sì yan Expose tàbí Hide; o máa fìdí rẹ̀ múlẹ̀ kí ìyípadà tó ṣẹ. Àwọn agbára àkọ́mọ́lé `cacti-*` wà ní ṣíṣí sílẹ̀ nípa àkọ́ṣẹ̀ṣe. Àwọn agbára láti inú àwọn ohun èlò àfikún mìíràn máa ń bẹ̀rẹ̀ ní ìpamọ́, nítorí náà fífi ohun èlò àfikún sílẹ̀ kì í tẹ ohunkóhun jáde títí olùṣàkóso yóò fi pinnu láti ṣe bẹ́ẹ̀. Ṣíṣí sílẹ̀ ń dín ìwọlé kù nìkan: olùlo ṣì nílò agbègbè agbára náà.

  ![Táàbù Abilities tí ó ń ṣàkójọ àwọn agbára àkọ́mọ́lé pẹ̀lú àwọn agbègbè wọn àti ipò ṣíṣí sílẹ̀](../../images/console-abilities.png)
- **Tokens** ṣàkójọ àwọn àmì-àṣẹ pẹ̀lú olúwá, olùṣẹ̀dá, ìṣẹ̀dá, ìparí-àkókò, ìlò ìkẹyìn, àti ipò (Active, Expired, Revoked). Yan àwọn ìlà kí o sì yan Revoke láti fagilé wọn. A kò lè tún àwọn àmì-àṣẹ tí a ti fagilé lò mọ́. Create Token máa ń ṣẹ̀dá tuntun kan.

  ![Táàbù Tokens tí ó ń ṣàkójọ àwọn àmì-àṣẹ pẹ̀lú olúwá, ìparí-àkókò, ìlò ìkẹyìn, àti ipò, lókè fọ́ọ̀mù Create Token](../../images/console-tokens.png)
- **Audit** ṣàkójọ àwọn ìlà ìṣàyẹ̀wò, tuntun jù lọ lákọ̀ọ́kọ́, ó sì máa ń ṣàṣàyàn nípasẹ̀ olùlo, agbára, àti èsì.

  ![Táàbù Audit tí ó ń ṣàkójọ àwọn ìpè pẹ̀lú olùlo, àmì-àṣẹ, agbára, àti èsì, pẹ̀lú àwọn àṣàyàn](../../images/console-audit.png)

## Àwọn àmì-àṣẹ

Àmì-àṣẹ ti ara-ẹni ń ka Cacti gẹ́gẹ́ bí olúwá rẹ̀. Ó ní ìrísí `cmcp_pat_` tí àwọn lẹ́tà kékeré hex 64 tẹ̀lé, ó sì ní ààyè kan ṣoṣo `abilities:read`. Ohun tí ó lè rí jẹ́ pínpinnu nípasẹ̀ àwọn agbègbè Cacti àti àwọn ìyọ̀ǹda ẹ̀rọ ti olúwá rẹ̀, kì í ṣe nípasẹ̀ àmì-àṣẹ náà. Olúwá gbọ́dọ̀ jẹ́ olùlo tí a mú ṣiṣẹ́ tí ó sì ní agbègbè **MCP and Abilities API**.

A máa ń ṣẹ̀dá àwọn àmì-àṣẹ fún olùlo kan nígbà gbogbo, wọ́n máa ń parí lẹ́yìn àkókò kan, a sì lè fagilé wọn:

- **Pátákó ìṣàkóso.** Management > MCP > Tokens > Create Token. Àkókò ìgbésí-ayé jẹ́ ọjọ́ 1 sí 365 ó sì ní àkọ́ṣẹ̀ṣe 90. Olùpèsè ni ó ń ṣẹ̀dá àmì-àṣẹ náà ó sì ń fi hàn lẹ́ẹ̀kan ṣoṣo lórí ojú-ìwé ìdáhùn, nítorí náà dà á kọ sínú olùṣàkóso àṣírí rẹ lẹ́sẹ̀kẹsẹ̀. O lè ṣẹ̀dá àmì-àṣẹ fún ara rẹ. Ṣíṣẹ̀dá ọ̀kan fún olùlo mìíràn tún nílò agbègbè Users/Groups, nítorí pé àmì-àṣẹ náà ń ka Cacti gẹ́gẹ́ bí olùlo yẹn.
- **My MCP Tokens.** Olùlo èyíkéyìí tí ó ní agbègbè MCP and Abilities API lè ṣàkóso àwọn àmì-àṣẹ tiwọn; wo ìsàlẹ̀.
- **Ìlà àṣẹ.** `tokens.php` ń ṣiṣẹ́ láti inú CLI nìkan, gẹ́gẹ́ bí àkọọ́lẹ̀ OS tí ó lè ṣàkóso Cacti. Ó ń gba àmì-àṣẹ láti inú àyíká (environment) kí iye náà má baà farahàn lórí ìlà àṣẹ tàbí nínú àkójọ ìṣẹ́. Àkókò ìgbésí-ayé jẹ́ ọjọ́ 1 sí 365 ó sì ní àkọ́ṣẹ̀ṣe 30. Ṣíṣẹ̀dá àti fífagilé àmì-àṣẹ nípasẹ̀ CLI máa ń jẹ́ ṣíṣàyẹ̀wò bíi ti pátákó ìṣàkóso, pẹ̀lú olúwá àmì-àṣẹ gẹ́gẹ́ bí olùṣe nítorí pé CLI kò ní olùlo Cacti, nítorí náà ìlà ìṣàyẹ̀wò kò fi hàn pé ìṣe náà wá láti inú CLI. `--list` máa ń tẹ gbogbo àmì-àṣẹ jáde bíi JSON (ID, olúwá, àwọn ààyè, àwọn àmì-àkókò, àmì ìfagilé) kò sì ní tẹ iye àmì-àṣẹ jáde láéláé; `--help` máa ń fi ìlò hàn.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

A kò lè ṣẹ̀dá àwọn àmì-àṣẹ fún àkọọ́lẹ̀ àlejò (guest account), fún àwọn olùlo tí a ti pa, tàbí fún àwọn olùlo tí kò ní agbègbè **MCP and Abilities API**, láti inú pátákó ìṣàkóso, ìlà àṣẹ, tàbí My MCP Tokens. Cacti máa ń fi ètò àlejò pamọ́ gẹ́gẹ́ bí orúkọ-olùlo tàbí ID olùlo, ohun èlò àfikún náà sì máa ń yanjú méjèèjì. Àmì-àṣẹ tí olúwá rẹ̀ bá di àkọọ́lẹ̀ àlejò yóò dáwọ́ dúró ní ìbéèrè rẹ̀ tí ó tẹ̀lé.

### Àwọn Àmì-àṣẹ MCP Mi

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) kò nílò agbègbè ìṣàkóso kankan: agbègbè **MCP and Abilities API** ti bò ó, àti pé àṣàyàn àkójọ náà farahàn fún àwọn olùlo tí ó ní i nìkan. Ojú-ìwé náà máa ń ṣiṣẹ́ lórí olùlo tí ó wọlé nígbà gbogbo. Àkójọ Cacti jẹ́ apá kan pátákó ìṣàkóso, nítorí náà olùlo tí kò ní ìwọlé pátákó ìṣàkóso máa ń dé ojú-ìwé náà nípa àdírẹ́sì rẹ̀.

![Táàbù My Tokens tí ó ń ṣàkójọ àwọn àmì-àṣẹ olùlo tí ó wọlé àti fọ́ọ̀mù ìṣẹ̀dá](../../images/my-tokens.png)

- **Tokens** ṣàkójọ àwọn àmì-àṣẹ rẹ, ṣẹ̀dá ọ̀kan (ọjọ́ 1 sí 365, àkọ́ṣẹ̀ṣe 90, tí a fi hàn lẹ́ẹ̀kan nínú ìdáhùn), ó sì fagilé tirẹ. O kò lè rí tàbí fagilé ti ẹlòmíràn.
- **Activity** ṣàkójọ àwọn ìṣe tí o ṣe, tuntun jù lọ lákọ̀ọ́kọ́: àwọn ìpè tí a fi àmì-àṣẹ rẹ ṣe àti àwọn àtúnṣe àmì-àṣẹ tí o ṣe.
- **Available Tools** ṣàkójọ àwọn agbára tí àmì-àṣẹ rẹ kan lè lò ní báyìí, pẹ̀lú ID, orúkọ, àti àpèjúwe agbára kọ̀ọ̀kan. Ó ń tẹ̀lé àwọn ìyọ̀ǹda Cacti rẹ àti àwọn ètò ìṣísílẹ̀ tí olùṣàkóso kan yàn.

  ![Àkójọ Available Tools tí ó ń fi ID, orúkọ, àti àpèjúwe agbára kọ̀ọ̀kan hàn](../../images/my-tools.png)

Ìfisílẹ̀ tí a ṣe ṣáájú kí ojú-ìwé yìí tó wà ní àkójọ fáìlì agbègbè láìsí `mcp_tokens.php`. Ìfisílẹ̀ ni ó ń forúkọ àkójọ náà sílẹ̀; mímú ṣiṣẹ́ tàbí pípa ohun èlò àfikún náà kì í ṣe àtúnṣe rẹ̀. Yọ ohun èlò àfikún náà kúrò kí o sì tún fi sílẹ̀, lẹ́yìn náà tún fúnni ní àwọn agbègbè náà lẹ́ẹ̀kan sí i, nítorí pé Cacti máa ń yọ àwọn ẹ̀bùn agbègbè kúrò nígbà tí a bá yọ ohun èlò àfikún kan kúrò.

Ibi ìpamọ́ dátà máa ń fi àmì ìdàrúdàpọ̀ SHA-256 ti àmì-àṣẹ náà pamọ́ nìkan, nítorí náà a kò lè gba àmì-àṣẹ tí ó sọnù padà; fagilé e kí o sì ṣẹ̀dá òmíràn. Ìyípadà-àkókò (rotation) rí bákannáà: ṣẹ̀dá àmì-àṣẹ tuntun, yí ètò olùlo padà sí i, lẹ́yìn náà fagilé èyí àtijọ́. Àmì-àṣẹ tí ó ti parí-àkókò, àmì-àṣẹ tí a ti fagilé, olúwá tí a ti pa, tàbí agbègbè tí ó sọnù kọ̀ọ̀kan yóò kùnà lórí ìbéèrè tí ó tẹ̀lé. A gba àwọn àmì-àṣẹ nínú àkọlé `Authorization: Bearer` nìkan; a kì í gba àmì-àṣẹ nínú okùn ìbéèrè tàbí ara ìfiránṣẹ́.

## So ohun èlò oníbàárà pọ̀

Lo ojú-ìsopọ̀ MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, pẹ̀lú
àmì-ìdánimọ̀ (token) nínú àkọlé `Authorization: Bearer`. Pa àmì-ìdánimọ̀ náà mọ́ sínú
oníyípadà àyíká tàbí olùṣàkóso àṣírí, kí o sì tọ́ka sí i láti inú ètò ohun èlò
oníbàárà dípò kíkọ iye rẹ̀ sínú fáìlì.

### Claude Code

Fi ojú-ìsopọ̀ náà sínú fáìlì `.mcp.json` iṣẹ́-àkànṣe kan tí ó ń tọ́ka sí
àmì-ìdánimọ̀ náà nípa orúkọ rẹ̀. Claude Code ń tú `${VAR}` jáde nínú `url` àti
`headers`, nítorí náà fáìlì náà kò ní àṣírí kankan nínú, ó sì wà ní ààbò láti fi
pamọ́ sínú ìtàn ìyípadà (commit). Gbé `CACTI_MCP_TOKEN` jáde nínú àyíká tí ó ń
bẹ̀rẹ̀ Claude Code.

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

O tún lè fi kún un láti ojú ìlà àṣẹ:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Pẹ̀lú àmì ìtọ́ka méjì, ikarahun (shell) rẹ yóò kọ́kọ́ tú `$CACTI_MCP_TOKEN` jáde,
nítorí náà a ó kọ iye àmì-ìdánimọ̀ náà sínú fáìlì ìṣètò fún `--scope` tí a yàn
(`local`, `user`, tàbí `project`; àìyípadà ìbẹ̀rẹ̀ ni `local`). Má ṣe lo ìrísí yẹn
pẹ̀lú `--scope project`, kí o sì pa fáìlì náà mọ́ kúrò nínú ìṣàkóso àtẹ̀jáde.
Yan ìtọ́kasí `.mcp.json` tí ó wà lókè yìí. Claude Code máa ń ka àwọn oníyípadà
ẹ̀rí ìwọ̀lé kan (bíi `ANTHROPIC_AUTH_TOKEN`) bí òfo nínú `url` àti `headers`
òkèèrè; `CACTI_MCP_TOKEN` kì í ṣe ọ̀kan lára wọn. Orísun:
[Ìwé ìtọ́kasí MCP ti Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot nínú VS Code

Lo fáìlì `.mcp.json` ní ìpilẹ̀ ibi-iṣẹ́ (tàbí fáìlì olùlò `~/.copilot/mcp-config.json`).
Àwọn fáìlì abínibí Copilot wọ̀nyí ń lo ohun ìṣètò `mcpServers` ní ìpele òkè àti
ìtọ́kasí oníyípadà àyíká `${NAME}` nínú àwọn iye àkọlé:

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

Gbé `CACTI_MCP_TOKEN` jáde nínú àyíká tí ó ń bẹ̀rẹ̀ VS Code. Àwọn fáìlì abínibí
Copilot kò ṣe àtìlẹ́yìn fún àwọn ìbéèrè `inputs`. Ìṣètò olùtọ́nisọ́nà ti VS Code ń kọ
àwọn iye `${...}`, nítorí náà fi àkọlé `Authorization` kún un nípa ṣíṣàtúnṣe fáìlì
náà, kì í ṣe nípasẹ̀ ìṣàn olùtọ́nisọ́nà. Ìṣètò olùtọ́nisọ́nà ń fi fáìlì ìpilẹ̀ ibi-iṣẹ́
hàn nìkan nígbà tí ìṣètò àdánwò `chat.mcp.workspaceRootConfig.enabled` bá wà ní títàn. Wo
[Ìwé ìtọ́kasí ìṣètò MCP ti VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Àtijọ́: `.vscode/mcp.json`.** VS Code sọ pé àwọn ìṣètò Copilot tuntun kò gbọ́dọ̀
lo `.vscode/mcp.json` tàbí `mcp.json` ti ìṣàkójọ àkọsílẹ̀; wọ́n jẹ́ ti ètò Local
harness tí a ti dáwọ́ dúró, èyí tí a ó yọ kúrò ní Oṣù Kejì ọdún 2027. Tí o bá ṣì ń lò ó,
ìrísí tí olùṣàtúnṣe ń ṣàkóso ń gba kọ́kọ́rọ́ `servers` ní ìpele òkè, ó sì lè béèrè fún
àmì-ìdánimọ̀ náà:

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

### Àwọn ohun èlò oníbàárà tí wọ́n ń sọ stdio nìkan

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) jẹ́ ohun èlò ìbámu
àṣàyàn tí ó ń ṣiṣẹ́ gẹ́gẹ́ bí olùpèsè MCP ti stdio abẹ́lé, tí ó sì ń pe HTTP API ti
àfikún náà. Lò ó fún ohun èlò oníbàárà tí kò lè sopọ̀ mọ́ olùpèsè HTTP òkèèrè. Ó nílò
àmì-ìdánimọ̀ àdáni kan náà, ó sì ń bá `api.php` sọ̀rọ̀.

### Ìhùwàsí MCP

Ojú-ìsopọ̀ náà ń pèsè àwọn irinṣẹ́ nìkan: agbára kọ̀ọ̀kan tí a fi síta tí a sì fún ní
àṣẹ jẹ́ irinṣẹ́ tí a sọ lórúkọ nípa ID rẹ̀, pẹ̀lú àwọn ètò ìṣàpẹẹrẹ ìtẹ̀wọlé àti
ìjáde rẹ̀ àti àwọn àlàyé kíkà-nìkan (`openWorldHint` jẹ́ `false`). Ó ń ṣàkóso
`initialize`, `server/discover`, `ping`, `tools/list`, àti `tools/call`. Kò pa ìgbà
ìbáṣepọ̀ mọ́, kì í fi `Mcp-Session-Id` ránṣẹ́ (ó sì ń kọ èyí tí ó bá gbà sílẹ̀), kò
sì gba àwọn àkójọ JSON-RPC. Ìfiranṣẹ́ tí kò ní `id` jẹ́ ìfitónilétí, ó sì ń gba HTTP
202 láìsí ara ìfiranṣẹ́. `POST` nìkan ni a fàyè gbà.

- **Àwọn àtúnyẹ̀wò.** Ìbéèrè tí ó bá gbé `io.modelcontextprotocol/protocolVersion`
  nínú `params._meta` gbọ́dọ̀ dárúkọ `2026-07-28`; ohunkóhun mìíràn yóò gba àṣìṣe
  `-32022`. Irú àwọn ìbéèrè bẹ́ẹ̀ tún gbọ́dọ̀ gbé àwọn àkọlé `Mcp-Protocol-Version`,
  `Mcp-Method`, àti (fún `tools/call`) `Mcp-Name` tí ó báramu, tàbí ìdáhùn yóò jẹ́
  àṣìṣe `-32020`. A ń ṣe àwọn ìbéèrè mìíràn gẹ́gẹ́ bí `2025-11-25`: `initialize` ń
  dáhùn pẹ̀lú àtúnyẹ̀wò yẹn, àti lórí ọ̀nà mìíràn èyíkéyìí, àkọlé
  `Mcp-Protocol-Version`, tí a bá fi ránṣẹ́, gbọ́dọ̀ jẹ́ `2025-11-25`,
  `2025-06-18`, tàbí `2025-03-26`.
- **Àwọn àṣìṣe irinṣẹ́.** Àṣìṣe agbára kan, pẹ̀lú àwọn kókó ìtẹ̀wọlé (arguments) tí
  kò bá ètò ìṣàpẹẹrẹ mu tàbí iye `arguments` tí kì í ṣe ohun JSON, ń padà wá gẹ́gẹ́ bí
  èsì irinṣẹ́ pẹ̀lú `isError: true` àti àṣìṣe AIP-193 nínú `structuredContent`, kì í
  ṣe gẹ́gẹ́ bí àṣìṣe ìlànà ìbánisọ̀rọ̀.
- **Àwọn àṣìṣe ìlànà ìbánisọ̀rọ̀.** Àwọn ìkùnà tí kì í ṣe àṣìṣe irinṣẹ́ jẹ́ àwọn ohun
  àṣìṣe JSON-RPC (kóòdù `-32000` pẹ̀lú ipò àti ìdí nínú `data`, tàbí àwọn kóòdù
  ìpìlẹ̀): Public Cacti URL tí ó sọnù, `Origin` tí a kọ̀, ìbéèrè nígbà tí àfikún wà
  ní pípa tàbí lórí olùṣàwárí òkèèrè, àti àwọn àṣìṣe olùpèsè àìròtẹ́lẹ̀ (`-32603`, pẹ̀lú
  ẹ̀kúnrẹ́rẹ́ tí a kọ sínú àkọsílẹ̀ Cacti, kì í ṣe ìdáhùn). Àwọn àyẹ̀wò ìbéèrè tí ó ń
  ṣiṣẹ́ ní àkọ́kọ́ (405, 413, 415) àti àwọn ìkùnà ìdánimọ̀ (401 `INVALID_TOKEN`,
  403 `REALM_REQUIRED`) ń pa ara AIP-193 tí a ṣàlàyé lábẹ́ HTTP API mọ́.

## HTTP API

URL ìpìlẹ̀: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Àdéhùn
ìbánisọ̀rọ̀ wà nínú [openapi.json](../../../openapi.json).

| Ọ̀nà àti ipa-ọ̀nà | Ète |
| --- | --- |
| `GET /v1/abilities` | Ṣe àkójọ àwọn agbára tí a fún ní àṣẹ. Ìbéèrè: `pageSize`, `pageToken`, àti `filter` ti irú `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Ka agbára kan. |
| `POST /v1/abilities/{id}:execute` | Ṣe é. Ara ìfiranṣẹ́ jẹ́ `{"arguments": {...}}` gẹ́lẹ́. Ìdáhùn jẹ́ `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Àwọn àṣìṣe ń tẹ̀lé AIP-193: ohun `error` pẹ̀lú `code`, `message`, `status`, àti
`details` tí ó gbé `ErrorInfo` pẹ̀lú agbègbè `cacti.net` àti `reason` tí ó dúró
ṣinṣin. Àwọn ìṣòro kókó ìtẹ̀wọlé ń fi àlàyé `BadRequest` kún un tí ó ń dárúkọ pápá
náà. A pààlà àwọn ara ìbéèrè sí 64 KB, àti àwọn èsì sí 1 MB. Àwọn ojú-ìsopọ̀
méjèèjì ń dáhùn lórí olùṣàwárí pàtàkì (main poller) nìkan, wọ́n sì ń dá
`UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) padà nígbà tí àfikún bá wà ní pípa tàbí tí
olùpèsè kò bá ṣe olùṣàwárí pàtàkì.

| HTTP | Àwọn iye `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (ó tún ń fi `WWW-Authenticate: Bearer` ránṣẹ́) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (ń fi `Allow` ránṣẹ́) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Kọ agbára kan (àwọn òǹkọ̀wé àfikún)

Àfikún Cacti tí ó wà ní títàn ń forúkọ àwọn agbára sílẹ̀ láti inú iṣẹ́ kan tí ó so
mọ́ ìkọ́ `abilities_register`, lọ́pọ̀ ìgbà nínú `plugin_<slug>_install()` rẹ̀:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Iṣẹ́ náà ń gba `AbilitiesRegistrar` tí a pààlà sí àfikún náà. A ń kọ iye ìpadàbọ̀
rẹ̀ sílẹ̀.

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

Àwọn òfin, gbogbo wọn ni a ń fi tipátipá mú ṣẹ nígbà ìforúkọsílẹ̀:

- **Àwọn ID.** ID kan bá `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` mu, kò ju lẹ́tà 64 lọ,
  ó sì gbọ́dọ̀ bẹ̀rẹ̀ pẹ̀lú slug àfikún náà àti àmì ìdàpọ̀: `acme-` lókè. Slug náà ni
  orúkọ fódà àfikún náà, nítorí náà fódà bíi `my_plugin` kò lè forúkọ ohunkóhun
  sílẹ̀. A kọ fódà àfikún tí a pè ní `cacti`; ààyè orúkọ yẹn jẹ́ ti àwọn tí a ṣe sínú
  rẹ̀.
- **Ìtumọ̀.** Àwọn kọ́kọ́rọ́ wọ̀nyí gẹ́lẹ́: `label`, `description` (títí dé bytes 4096),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Ìsọ̀rí náà gbọ́dọ̀ ti wà tẹ́lẹ̀: lo èyí tí a ṣe sínú rẹ̀ (`inventory`,
  `system`) tàbí kí o forúkọ tìrẹ sílẹ̀ pẹ̀lú `registerCategory()`, tí ID rẹ̀ jẹ́ ọ̀tọ̀
  láàárín gbogbo àwọn àfikún tí ó sì bá `^[a-z][a-z0-9-]{0,31}$` mu.
- **Kíkà-nìkan péré.** `annotations` gbọ́dọ̀ jẹ́ `readOnly: true`,
  `destructive: false`, `idempotent: true` gẹ́lẹ́. Ohunkóhun mìíràn ń ju àṣìṣe jáde.
- **Àwọn ètò ìṣàpẹẹrẹ.** `input_schema` àti `output_schema` kọ̀ọ̀kan gbọ́dọ̀ ní
  `type` `object` ní ìpele òkè. Èdè ìṣàpẹẹrẹ náà kéré, ó sì ń kùnà ní títìpa. Àwọn
  ohun gbọ́dọ̀ wà ní títìpa (`additionalProperties: false`, pẹ̀lú `properties` tí ó wà
  níbẹ̀); àwọn irú mìíràn ni `integer` àti `number` (`minimum`, `maximum`), `string`
  (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, àti `array` (tí ó nílò
  `items` àti `maxItems`). A lè sọ irú kan di èyí tí ó lè gba òfo gẹ́gẹ́ bí
  `['string', 'null']`. Àwọn okùn ìkọ̀wé kókó ìtẹ̀wọlé ń lọ sí ìwọ̀n tí kò ju àmì-ìkọ̀wé
  4096 lọ ní àìyípadà; àwọn okùn ìkọ̀wé èsì ni a pààlà nìkan nípa `maxLength` tí a
  kéde àti ààlà ìwọ̀n èsì. Agbára tí kò ju 256 lọ ni a lè forúkọ sílẹ̀.
- **`permission(int $userId): bool`.** Gbọ́dọ̀ dá `true` gẹ́lẹ́ padà láti fún ní àṣẹ.
  ID olùlò jẹ́ ti olówó àmì-ìdánimọ̀ náà; má ṣe ka ipò ìgbà ìbáṣepọ̀ láé.
- **`execute(int $userId, stdClass $args): array`.** A ti ṣe àyẹ̀wò ìfọwọ́sí `$args`
  lòdì sí `input_schema` tẹ́lẹ̀. Fi àwọn àṣẹ ìpele-ohun mú ṣẹ fúnra rẹ. Dá àkójọ
  ìbáṣepọ̀ padà tí ó bá `output_schema` mu gẹ́lẹ́; àtòjọ, pápá àfikún, tàbí ohun tí ó
  ju 1 MB ti JSON lọ ń di àṣìṣe `INVALID_RESULT`. Ju `AbilitiesError` jáde fún
  ìkùnà tí olùbáṣepọ̀ lè rí, bíi `NOT_FOUND`.
- **Àwọn ohun òfo.** PHP ń ṣàkóso `[]` gẹ́gẹ́ bí àkójọ JSON. Ní ibikíbi tí ètò
  ìṣàpẹẹrẹ ìjáde bá kéde `object`, ní ìjìnlẹ̀ èyíkéyìí, ibi ìforúkọsílẹ̀ ń ṣe `[]`
  gẹ́gẹ́ bí ohun òfo, ó sì ń fi `{}` ránṣẹ́; `new stdClass()` ń ṣiṣẹ́ pẹ̀lú. Àtòjọ tí
  kì í ṣe òfo kì í kà sí ohun láé, ó sì ń kùnà pẹ̀lú `INVALID_RESULT`. Àwòrán
  `properties` òfo nínú ètò ìṣàpẹẹrẹ lè jẹ́ `[]` tàbí `new stdClass()`; a ń gbé
  méjèèjì jáde gẹ́gẹ́ bí `{}`.
- **Ìyàsọ́tọ̀ ìkùnà.** Àfikún kọ̀ọ̀kan ń forúkọ sílẹ̀ sínú ẹ̀dà ìdánwò tí a ń pa mọ́
  nìkan tí iṣẹ́ rẹ bá padà déédé. Tí ó bá ju àṣìṣe jáde, kò sí ọ̀kan lára àwọn agbára
  rẹ tí yóò forúkọ sílẹ̀, a ó sì kọ ìkùnà náà sílẹ̀ sínú àkọsílẹ̀.

Àwọn agbára láti inú àfikún máa ń bẹ̀rẹ̀ ní ìpamọ́. Olùṣàkóso ètò ń fi wọ́n hàn lórí
táàbù Abilities ti kọ́ńsólù, òpó Required Realm sì ń kà pé "Àfikún ló ṣètò rẹ̀"
("Set by the plugin") fún wọn.

## Àwòṣe ààbò

- **Bearer nìkan.** `api.php` àti `mcp.php` ń gba àmì aládàáni nínú àkọlé
  `Authorization` nìkan, kò sì sí ohun mìíràn. Wọ́n ń kọ àwọn kókó-ìfipamọ́ (cookies), `$_POST`, àti
  `$_REQUEST` sílẹ̀ kí Cacti tó ṣíṣẹ́, wọ́n sì ń pa ìṣẹ̀ṣẹ̀ (session) tí Cacti bẹ̀rẹ̀ run, nítorí náà ìwọlé nípasẹ̀ aṣàwárí-wẹ́ẹ̀bù
  kò lè fúnni ní àyè sí API láéláé.
- **Ọ̀nà àbáyọ fún CSRF.** Olùṣọ́ CSRF ti Cacti máa ń kọ JSON POST tí kò ní àmì CSRF
  Cacti, èyí tí kò sí olùbáraẹnisọ̀rọ̀ MCP kankan tí ó lè fi ránṣẹ́. Fún àwọn òpin-ìsopọ̀ méjì yìí nìkan, àfikún náà
  ń yí orúkọ ọ̀nà ìbéèrè padà kí Cacti tó ṣíṣẹ́, ó sì ń dá a padà lẹ́yìn náà, kí olùṣọ́ náà
  lè fò wọ́n kọjá. Èyí ní ààbò nítorí pé CSRF máa ń dáàbò bo àwọn ìbéèrè tí aṣàwárí-wẹ́ẹ̀bù
  ń fi cookies fọwọ́ sí, àwọn òpin-ìsopọ̀ wọ̀nyí kò sì gba ìdánimọ̀ cookie kankan: ojú-ewé
  láti ibòmíràn (cross-site) kò lè so àmì bearer mọ́ ọn. Àwọn ojú-ewé kọ́nsólù máa ń pa ààbò CSRF kíkún
  mọ́. Ọ̀nà àbáyọ yìí jẹ́ ti ìgbà díẹ̀, títí tí Cacti yóò fi pèsè ìyọ̀ǹda tí a ṣètìlẹ́yìn
  fún; wo `lib/bootstrap.php`.
- **Àyẹ̀wò Origin.** Lórí `mcp.php`, tí ìbéèrè náà bá ní àkọlé `Origin`, ó gbọ́dọ̀ bá
  ìlànà (scheme), olùgbàlejò (host), àti ibùdó (port) ti URL Cacti Gbogbogbòò mu gan-an, tàbí kí á kọ ìbéèrè náà
  pẹ̀lú `ORIGIN_NOT_ALLOWED`. Ìbéèrè tí kò ní àkọlé `Origin`, èyí tí ó jẹ́ bí àwọn olùbáraẹnisọ̀rọ̀
  tí kì í ṣe aṣàwárí-wẹ́ẹ̀bù ṣe ń sopọ̀, ní a fọwọ́ sí. Èyí máa ń dá ojú-ewé wẹ́ẹ̀bù dúró láti má ṣe darí
  òpin-ìsopọ̀ náà láti inú aṣàwárí-wẹ́ẹ̀bù olùbẹ̀wò. `api.php` kì í lo àyẹ̀wò yìí.
- **Kíkà nìkan.** Ìforúkọsílẹ̀ máa ń kọ agbára èyíkéyìí tí kì í ṣe kíkà-nìkan,
  tí kì í ṣe aláìbàjẹ́ (non-destructive), tàbí tí kì í ṣe idempotent.
- **Ìfihàn àti àwọn agbègbè àṣẹ (realms) méjèèjì ń ṣiṣẹ́.** Agbára kan gbọ́dọ̀ wà ní ìfihàn, olówó àmì náà
  sì gbọ́dọ̀ ní agbègbè àṣẹ rẹ̀. Tí kò bá ṣeé ṣe láti ka tábìlì ìfihàn, gbogbo agbára ni yóò
  wà ní ìpamọ́ dípò pípadà sí àwọn ìṣètò àìyípadà.
- **Èyí tí ó pamọ́, àìmọ̀, àti àìlẹ́tọ̀ọ́ sí rí bákan náà.** Olùbáraẹnisọ̀rọ̀ kò lè mọ ìyàtọ̀ láàárín
  agbára tí kò sí, èyí tí ó pamọ́, tàbí èyí tí olùlò rẹ̀ kò gbọ́dọ̀
  lò: ìwákiri máa ń yọ ọ́ sílẹ̀, ìṣiṣẹ́ rẹ̀ sì máa ń dá `NOT_FOUND`
  (`ABILITY_NOT_FOUND`) padà.
- **Àwọn àmì.** A tọ́jú wọn gẹ́gẹ́ bí ìṣirò SHA-256 (hashes), a máa ń fi wọ́n hàn lẹ́ẹ̀kan ṣoṣo, wọ́n ní ọjọ́ ìparí nígbà gbogbo, wọ́n ṣeé fagi lé, a sì máa ń
  kọ̀ wọ́n nígbà tí a bá ti pa olówó wọn lẹ́nu iṣẹ́ tàbí tí ó bá pàdánù agbègbè àṣẹ rẹ̀.
- **Àyẹ̀wò ìṣirò (Audit).** `plugin_mcp_audit` máa ń ṣe àkọsílẹ̀ ID ìbéèrè, ID àmì, ID olùlò, agbára,
  èsì (`started`, `succeeded`, `failed`, `denied`, `rejected`), àti àkókò ìṣẹ̀lẹ̀.
  Kì í ṣe àkọsílẹ̀ àwọn àríyànjiyàn, èsì iṣẹ́, tàbí iye àmì láéláé. Agbára kan máa ń ṣiṣẹ́ lẹ́yìn tí
  a bá ti kọ ìlà `started` rẹ̀ nìkan; tí tábìlì àyẹ̀wò kò bá sí, ìpè náà yóò kùnà
  pẹ̀lú `UNAVAILABLE` kò sì ní ṣiṣẹ́. Ìpè tí a kọ̀ kí ó tó ṣiṣẹ́ jẹ́ ìlà kan: `denied`
  fún agbára àìmọ̀, èyí tí ó pamọ́, tàbí tí kò ní àṣẹ, `rejected` fún àwọn àríyànjiyàn tí kò bá
  ìlànà schema mu. Ìṣẹ̀dá àmì àti ìfagilé rẹ̀ láti inú kọ́nsólù, My MCP Tokens, àti CLI ni a máa ń
  ṣe àkọsílẹ̀ rẹ̀ gẹ́gẹ́ bí `mcp-token-create` àti `mcp-token-revoke` pẹ̀lú èsì `succeeded`, a sì máa ń ṣe àkọsílẹ̀
  ìfagilé fún àmì tí ó wà lẹ́nu iṣẹ́ tẹ́lẹ̀ nìkan. A kì í ṣe àkọsílẹ̀ ìwákiri, àti ìpè tí
  `arguments` rẹ̀ kì í ṣe JSON object.
- **Àkọsílẹ̀ ìkùnà.** Ìkùnà àìròtẹ́lẹ̀, `INVALID_RESULT`, tàbí àìsí tábìlì àyẹ̀wò
  máa ń kọ ìlà kan sínú àkọsílẹ̀ Cacti pẹ̀lú ẹ̀ka `MCP`: ID agbára, ìdí
  pàtó kan, àti kíláàsì ìṣìnà (exception class). A kì í ṣe àkọsílẹ̀ àwọn ìfiránṣẹ́, àwọn àríyànjiyàn, àti àwọn àmì láéláé.
- **Olùgbà-dátà àkọ́kọ́ (Main poller) nìkan.** Àwọn òpin-ìsopọ̀ méjèèjì, àwọn ojú-ewé kọ́nsólù méjèèjì, àti `tokens.php` máa ń kọ̀ láti
  ṣiṣẹ́ ní ibòmíràn èyíkéyìí.

## Ìyípo ìṣiṣẹ́

Pípa àfikún náà lẹ́nu iṣẹ́ máa ń dí àwọn òpin-ìsopọ̀ méjèèjì lọ́nà. Yíyọ ọ́ kúrò máa ń fagi lé gbogbo àmì, ó sì
máa ń pa àwọn tábìlì mẹ́tẹ̀ẹ̀ta (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) mọ́ fún ìtọ́jú àkọsílẹ̀; títún un gbé kalẹ̀ kì í mú àmì tí a ti fagi lé
padà ṣiṣẹ́. Ṣe àfipamọ́ àwọn tábìlì náà pẹ̀lú ibi-ìpamọ́ dátà Cacti, kí o sì lo ìlànà ìtọ́jú àkọsílẹ̀ àyẹ̀wò
níta àfikún náà.

## Ìdàgbàsókè àti àwọn àyẹ̀wò

Àwọn àyẹ̀wò náà jẹ́ àwọn ìwé-àṣẹ PHP lásán tí ó máa ń ṣiṣẹ́ láìsí Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI máa ń ṣàyẹ̀wò àṣìṣe (lints) PHP ó sì máa ń ṣiṣẹ́ àwọn ìwé-àṣẹ inú `tests/` (ọ̀kọ̀ọ̀kan wọn wà ní àkọsílẹ̀ nínú
`.github/workflows/ci.yml`) lórí PHP 8.2 títí dé 8.5, lẹ́yìn náà ó máa ń ṣẹ̀dá àpò `mcp/` tí a lè gbé kalẹ̀ àti ìṣirò ìdánilójú (checksum) rẹ̀. Àwọn àyẹ̀wò tí ó kan Cacti máa ń lo
àwọn ohun ìṣe-àyẹ̀wò (fixtures) ní ààlà olùrànlọ́wọ́ Cacti; wọn kì í dán ìgbékalẹ̀ Cacti kíkún wò.

### Àwọn àyẹ̀wò ìsopọ̀pọ̀

`tests/integration/run.sh 1.2.31` tàbí `tests/integration/run.sh develop` máa ń gbé
àfikún náà kalẹ̀ sínú Cacti gidi kan nínú àwọn àpótí (containers), ó sì máa ń ṣe àwọn àyẹ̀wò lọ́wọ́lọ́wọ́ lórí rẹ̀. Ó nílò Docker
pẹ̀lú Compose v2.23.1 tàbí èyí tí ó ga jù bẹ́ẹ̀ lọ, git àti openssl. `KEEP=1` máa ń jẹ́ kí àkójọ iṣẹ́ náà máa ṣiṣẹ́ lọ fún ṣíṣàtúnṣe àṣìṣe. CI máa ń ṣiṣẹ́ rẹ̀
lálẹ́ lójoojúmọ́ àti nígbà tí a bá béèrè fún un, kì í ṣe lórí àwọn ìbéèrè ìdàpọ̀ (pull requests).

## Ìtumọ̀ sí èdè ìbílẹ̀

Cacti MCP máa ń kó àwọn àkójọ GNU gettext tí a ti ṣàkójọ pọ̀ jọ lábẹ́ `locales/po/` àti `locales/LC_MESSAGES/`
àti àwọn README tí a túmọ̀ sí èdè ìbílẹ̀ lábẹ́ `docs/i18n/` fún èdè Gẹ̀ẹ́sì pẹ̀lú àwọn èdè agbègbè 44 (19 Broad Tier 1,
15 ti Áfíríkà, àti 10 ti Éṣíà), nípa lílo agbègbè ọ̀rọ̀ `mcp` (`locales/po/mcp.pot`).
Cacti máa ń gbé àkójọ tí ó bá a mu kalẹ̀ fúnra rẹ̀ nígbà tí a bá tan ìtìlẹ́yìn èdè.

## Ìkópa

Àwọn ìbéèrè ìdàpọ̀ (pull requests) máa ń lọ sí `develop`. Jẹ́ kí kóòdù ìṣelọ́pọ̀ bá PHP 8.2 mu, kí o sì
lo ìlànà Cacti: àwọn tabs, àwọn ọ̀rọ̀ inú àmì ìfọ̀rọ̀wérọ̀ kanṣoṣo (single-quoted strings), àti àwọn olùrànlọ́wọ́ ibi-ìpamọ́ dátà àti
àṣẹ ti Cacti. Fi àwọn àyẹ̀wò kún un fún ìfọwọ́sí, ìfúnni ní àṣẹ, tàbí ìhùwàsí ìlànà
tí a yí padà, kí o sì fọwọ́ sí àwọn ìfipamọ́ (commits) pẹ̀lú `git commit -s`. Ṣe àjọṣepọ̀ àwọn àyípadà sí HTTP
API pẹ̀lú [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Ìwé-àṣẹ

Ẹ̀tọ́ àwòkọ (C) 2026 Thomas Vincent. A gbé e jáde lábẹ́ GNU General Public
License, ẹ̀yà 2 tàbí èyí tí ó tẹ̀lé e. Wo [LICENSE](../../../LICENSE).
