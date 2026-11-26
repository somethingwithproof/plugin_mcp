<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: osisi kaktọs nwere ọta. Chọpụta. Nye ikike. Mezuo.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Ikikere: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP bụ ngwa mgbakwunye Cacti nke na-enye ndị ahịa AI ohere ịgụ data Cacti gị site
n'ọrụ ndị a kpọrọ aha ma jiri ikike nyochaa a na-akpọ ikike (abilities). Ọ na-enye ha n'ụzọ abụọ
site na ngwa mgbakwunye ahụ n'onwe ya: njedebe MCP (`mcp.php`, Streamable HTTP) na
API HTTP nke ụdị AIP (`api.php`). Cacti ka na-achịkwa inye ikike na
mmezu. Onye ahịa anaghị ajụ ebe nchekwa data ajụjụ ma ọlị; ọ nwere ike ịkpọ naanị ikike nke
onye nchịkwa kpugheere na nke mpaghara ikike Cacti nke onye nwe token ahụ kwadoro.

Ndị na-ede ngwa mgbakwunye nwere ike ịdebanye aha ikike ọgụgụ naanị nke ha site na
nko `abilities_register`, ha ga-egosikwa ndị ahịa MCP dị ka ngwaọrụ n'enweghị
koodu usoro nkwukọrịta ọ bụla.

**Ọnọdụ: tupu mwepụta, ntụgharị 0.1.0.** Enweghị mwepụta e tinyere akara.

Dị taa:

- Ikike ọgụgụ naanị ndị dịbu n'ime ya maka ụdị sistemụ na ndepụta ngwa.
- Token nnweta nke onwe (`cmcp_pat_...`) dị ka naanị nzere njirimara.
- Njikwa Management > MCP: kpughee ma ọ bụ zoo ikike, mepụta ma kagbuo
  token, gụọ ndekọ nyocha.
- Management > My MCP Tokens: ndị ọrụ na-ejikwa token nke ha, hụ ọrụ ha,
  ma hụ ngwaọrụ ndị token ha nwere ike iji.
- MCP site na Streamable HTTP, ntụgharị usoro nkwukọrịta `2026-07-28` na `2025-11-25`,
  ngwaọrụ naanị.

Ọ dịbeghị ugbu a:

- Nbanye OAuth 2.1. Njikọ ndị a na-akwado n'ịntanetị ndị na-enweghị ike izipu token nke onwe, dị ka
  njikọ omenala ChatGPT na claude.ai, enweghị ike ijikọ ruo mgbe ọ dị. E mere
  atụmatụ ya dị ka Plan 2; edebeghị atụmatụ ahụ ugbu a.
- Ikike ide ihe. Naanị ikike ọgụgụ naanị nwere ike ịdebanye aha.

Nhazi ya dị na
[nkọwa nhazi njedebe](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
usoro nrụnye ya dịkwa na [docs/plan.md](../../plan.md).

## Ikike ndị dịbu n'ime ya

| ID | Arụmụka | Mpaghara ikike Cacti dị mkpa |
| --- | --- | --- |
| `cacti-get-system-info` | enweghị | 15 |
| `cacti-list-devices` | nke nhọrọ `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | nke dị mkpa `name`, dị ka `devices/12` | 3 |

Ọkpụkpọ ọ bụla chọkwara mpaghara ikike **MCP and Abilities API** maka onye nwe token,
oke ikike `abilities:read` (token nke onwe ọ bụla nwere ya), na ikike e kpugheere.
Taabụ Abilities nke njikwa ahụ na-egosi mpaghara ikike nke ọ bụla dịbu n'ime ya chọrọ.

- `cacti-list-devices` na-eweghachi peeji ndị nwere ruo ngwa 100 (ndabere 50) na
  `nextPageToken`. Token peeji dị irè naanị maka otu `filter` na
  `orderBy` ahụ. `filter` bụ okwu AIP-160 nke ntụnyere ndị `AND` jikọtara,
  dị ka ọmụmaatụ `state = "DOWN" AND disabled = false`. Mpaghara nzacha bụ
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, na `state`. `orderBy` na-anara `displayName`, `hostname`, ma ọ bụ `name`,
  nke ọ bụla nwere ike inwe `desc` na-eso ya.
- Ajụjụ ngwa na-agafe na `get_allowed_devices()` nke Cacti, ya mere onye ọrụ na-ahụ naanị
  ngwa ndị Cacti ga-egosi ha.
- Mpaghara ngwa anaghị agụnye eriri obodo SNMP, okwuntụghe, na nzere
  ndị ọzọ.

## Wụnye

Ọ chọrọ Cacti 1.2.31 ma ọ bụ nke ọhụrụ, PHP 8.2 ma ọ bụ nke ọhụrụ, na main poller. A ga-agbanyerịrị
nkwenye njirimara Cacti; ngwa mgbakwunye ahụ na-ajụ ịkwado njirimara mgbe agbanyụrụ ya.

A ga-akpọrịrị folda ngwa mgbakwunye ahụ `mcp`, ọ bụghị `plugin_mcp`. Aha nkenke ngwa mgbakwunye, aha mpaghara ikike,
ngalaba ntụgharị asụsụ, na URL niile na-eji `mcp`.

Site na nbudata koodu mmalite:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Ruo mgbe mwepụta e tinyere akara dị, ị nwere ike ibudata ngwa `mcp-plugin`
site na [ọrụ CI gara nke ọma](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
kama. O nwere `mcp.tar.gz` na `SHA256SUMS`. Nyochaa checksum ahụ, wee wepụta
`mcp.tar.gz` n'ime folda `plugins/` nke Cacti ka nsonaazụ ya bụrụ `plugins/mcp/`.
Ebe nchekwa koodu akpaaka nke GitHub na-eji aha folda dị elu dị iche. Ebe
nchekwa ahụ na-ahapụ `docs/` (gụnyere foto ihuenyo ndị dị n'okpuru), `tests/`, na
`.github/`, ya mere njikọ README na-abanye na `docs/` na-arụ ọrụ na GitHub mana ọ bụghị na nke a wụnyere.

Mgbe ahụ:

1. Na Plugin Management, wụnye ma gbanye **Cacti MCP**. Onye nchịkwa na-awụnye ya
   na-enweta mpaghara ikike **MCP Administration** na-akpaghị aka.
2. N'okpuru Settings > MCP, tọọ **Public Cacti URL** ka ọ bụrụ adreesị ndị ahịa na-eji, dị ka
   ọmụmaatụ `https://cacti.example.com/cacti`. HTTPS dị mkpa ma e wezụga maka
   `localhost`, `127.0.0.1`, na `[::1]`. Ruo mgbe e tọrọ nke a, `mcp.php` na-aza HTTP 400
   na njehie JSON-RPC nke `data` ya bụ `FAILED_PRECONDITION` na
   `PUBLIC_URL_REQUIRED`. `api.php` anaghị agụ ya.

   ![Settings > MCP na-egosi mpaghara Public Cacti URL](../../images/settings-public-url.png)

3. Nye onye ọrụ ọ bụla ga-enwe token mpaghara ikike **MCP and Abilities API**.
   Onweghị onye ọrụ na-enweta ya na-akpaghị aka.
4. Jide n'aka na seva weebụ na-ezigara PHP nkụnye isi `Authorization` na ozi ụzọ
   (lee n'okpuru).
5. Mepee Management > MCP ma kpughee ikike ndị ị chọrọ ka ndị ahịa hụ.

**Nkwalite site na nrụpụta mmepe.** Ngwa mgbakwunye a bụ tupu mwepụta, tebụl ya
gbanwekwara n'oge mmepe n'enweghị njem data. Ọ bụrụ na ị wụnyere nrụpụta nke
mbụ, wepụ ya ma wụnye ya ọzọ. Iwụnye ọzọ na-edobe tebụl ndị dịbu,
ya mere buru ụzọ hichapụ tebụl ochie `plugin_mcp_token`, `plugin_mcp_audit`, na
`plugin_mcp_ability` (na tebụl ndị yiri ha site na
nrụpụta e mere tupu mgbanwe aha). Chekwaa ha ma ọ bụrụ na ị chọrọ akụkọ ihe mere eme ha; a na-akagbu
token sitere na nrụpụta ndị ahụ mgbe e wepụrụ ha, ha anaghịkwa agafe.

### Seva weebụ

Nhazi Apache ndị na-ewepụ `Authorization` tupu PHP chọrọ nke a na
virtual host ma ọ bụ folda dị mkpa, wee bugharịa ya:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache nwere `mod_php` jere ozi ụzọ `api.php` n'enweghị nhazi ụzọ ọzọ.

Ụzọ `api.php` bi n'ụzọ na-esote aha skriptị
(`/plugins/mcp/api.php/v1/abilities`), ya mere nginx ga-ejikọtarịrị URI ebe ụzọ ọzọ
na-eso `.php`, kewaa ozi ụzọ ahụ, ma nyefee ya PHP. Ngọngọ
`location ~ \.php$` anaghị adaba na URL ndị a ma ọlị; nginx na-aza na
HTML 404 nke ya. E jiri PHP-FPM nyochaa ụkpụrụ ebe ahụ na ahịrị ozi ụzọ abụọ dị n'okpuru;
ahịrị ndị ọzọ bụ usoro ọkọlọtọ:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Gbanwee ahịrị `include` na `fastcgi_pass` ka ha dabaa na ngọngọ nke na-ejere
Cacti ozi ugbua. Etinyela `try_files $fastcgi_script_name =404;` na ngọngọ a: ọ na-ehichapụ
`$fastcgi_path_info`, `api.php` na-azakwazị 404 `UNKNOWN_PATH`. Ọ bụrụ na
nhazi gị chọrọ `try_files`, buru ụzọ chekwaa uru ahụ na
`set $path_info $fastcgi_path_info;` ma nyefee `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` enweghị ụzọ ntugharị ọ bụla, ọ chọghịkwa ha.

## Njikwa

Management > MCP nwere taabụ atọ. Ị chọrọ mpaghara ikike **MCP Administration**.
Foto ihuenyo ndị dị ebe a na n'okpuru sitere na nrụpụta mmepe Cacti nwere data ọmụmaatụ.

- **Abilities** na-edepụta ikike ọ bụla e debanyere aha ya na ngwa mgbakwunye ya, ngalaba,
  mpaghara ikike ọ chọrọ, na ma e kpugheere ya. Họrọ ahịrị ma họrọ Expose ma ọ bụ
  Hide; ị ga-akwado tupu mgbanwe ahụ abanye n'ọrụ. A na-ekpughe ikike `cacti-*` ndị dịbu n'ime ya
  na ndabere. Ikike sitere na ngwa mgbakwunye ndị ọzọ na-amalite n'ụzọ zoro ezo, ya mere ịwụnye
  ngwa mgbakwunye anaghị ebipụta ihe ọ bụla ruo mgbe onye nchịkwa kpebiri. Nkpughe
  na-ebelata naanị ohere: onye ọrụ ka chọrọ mpaghara ikike nke ikike ahụ.

  ![Taabụ Abilities na-edepụta ikike ndị dịbu n'ime ya na mpaghara ikike ha na ọnọdụ nkpughe](../../images/console-abilities.png)
- **Tokens** na-edepụta token na onye nwe ya, onye mepụtara ya, oge e mepụtara ya, oge ngwụcha, ojiji ikpeazụ, na
  ọnọdụ (Active, Expired, Revoked). Họrọ ahịrị ma họrọ Revoke iji kagbuo ha.
  Enweghị ike iji token a kagburu ọzọ. Create Token na-emepụta nke ọhụrụ.

  ![Taabụ Tokens na-edepụta token na onye nwe ya, oge ngwụcha, ojiji ikpeazụ, na ọnọdụ, n'elu fọm Create Token](../../images/console-tokens.png)
- **Audit** na-edepụta ahịrị nyocha, nke kachasị ọhụrụ na mbụ, ma na-enyocha site na onye ọrụ, ikike, na
  nsonaazụ.

  ![Taabụ Audit na-edepụta ọkpụkpọ na onye ọrụ, token, ikike, na nsonaazụ, nwere ihe nzacha](../../images/console-audit.png)

## Token

Token nke onwe na-agụ Cacti dị ka onye nwe ya. O nwere ụdị `cmcp_pat_` nke
mkpụrụedemede hex obere 64 na-eso ma na-ebu naanị otu oke ikike `abilities:read`. Ihe ọ
nwere ike ịhụ bụ mpaghara ikike Cacti na ikike ngwa nke onye nwe ya na-ekpebi, ọ bụghị
token ahụ. Onye nwe ya ga-abụrịrị onye ọrụ a gbanyere nke nwere mpaghara ikike **MCP and Abilities API**.

A na-emepụta token mgbe niile maka onye ọrụ, ha na-agwụ oge, a pụkwara ịkagbu ha:

- **Njikwa.** Management > MCP > Tokens > Create Token. Ogologo ndụ ya bụ ụbọchị 1 ruo 365
  ma nwee ndabere nke 90. Seva na-emepụta token ahụ ma gosipụta ya otu ugboro na
  peeji nzaghachi, ya mere depụta ya n'ime njikwa nzuzo gị ozugbo. Ị nwere ike ịmepụtara
  onwe gị token. Ịmepụtara onye ọrụ ọzọ chọkwara mpaghara ikike Users/Groups,
  n'ihi na token ahụ na-agụ Cacti dị ka onye ọrụ ahụ.
- **My MCP Tokens.** Onye ọrụ ọ bụla nwere mpaghara ikike MCP and Abilities API nwere ike ijikwa
  token nke ya; lee n'okpuru.
- **Ahịrị iwu.** `tokens.php` na-agba naanị site na CLI, dị ka akaụntụ OS nke nwere ike
  ịchịkwa Cacti. Ọ na-enweta token site na gburugburu ebe obibi ka uru ya ghara
  ịpụta n'ahịrị iwu ma ọ bụ na ndepụta usoro. Ogologo ndụ ya bụ ụbọchị 1 ruo 365 ma
  nwee ndabere nke 30. A na-enyocha ịmepụta na ịkagbu token site na CLI dị ka
  njikwa, na-eji onye nwe token dị ka onye mere ya n'ihi na CLI enweghị onye ọrụ Cacti, ya mere
  ahịrị nyocha anaghị egosi na omume ahụ sitere na CLI. `--list` na-ebipụta
  token ọ bụla dị ka JSON (ID, onye nwe, oke ikike, akara oge, ọkọlọtọ nkwụsị) ma ọ dịghị mgbe ọ na-ebipụta
  uru token ahụ; `--help` na-egosi ojiji.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Enweghị ike ịmepụta token maka akaụntụ ọbịa, maka ndị ọrụ a gbanyụrụ, ma ọ bụ maka ndị ọrụ
na-enweghị mpaghara ikike **MCP and Abilities API**, site na njikwa, ahịrị iwu, ma ọ bụ
My MCP Tokens. Cacti na-echekwa ntọala ọbịa dị ka aha njirimara ma ọ bụ ID onye ọrụ, ngwa
mgbakwunye ahụ na-edozi ha abụọ. Token nke onye nwe ya ghọrọ akaụntụ ọbịa na-akwụsị ịrụ ọrụ na
arịrịọ ya na-esote.

### Token MCP M

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) achọghị mpaghara ikike
nchịkwa: mpaghara ikike **MCP and Abilities API** na-ekpuchi ya, ndenye menu
na-apụtakwa naanị maka ndị ọrụ nwere ya. Peeji ahụ na-arụ ọrụ mgbe niile n'aha onye ọrụ banyere n'ime ya.
Menu Cacti bụ akụkụ nke njikwa, ya mere onye ọrụ na-enweghị ohere njikwa na-eru
peeji ahụ site na adreesị ya.

![Taabụ My Tokens na-edepụta token nke onye ọrụ banyere n'ime ya na fọm mmepụta](../../images/my-tokens.png)

- **Tokens** na-edepụta token gị, na-emepụta otu (ụbọchị 1 ruo 365, ndabere 90, a na-egosi ya otu ugboro
  na nzaghachi), ma na-akagbu nke gị. Ị nweghị ike ịhụ ma ọ bụ kagbuo nke onye ọzọ.
- **Activity** na-edepụta omume ndị i mere, nke kachasị ọhụrụ na mbụ: ọkpụkpọ e ji token gị
  mee na mgbanwe token ndị i mere.
- **Available Tools** na-edepụta ikike token gị nwere ike iji ugbu a, na
  ID, aha, na nkọwa nke ikike ọ bụla. Ọ na-eso ikike Cacti gị na
  ntọala nkpughe nke onye nchịkwa họọrọ.

  ![Ndepụta Available Tools na-egosi ID, aha, na nkọwa nke ikike ọ bụla](../../images/my-tools.png)

Nwụnye e mere tupu peeji a adị nwere ndepụta faịlụ mpaghara ikike nke na-enweghị
`mcp_tokens.php`. Nwụnye na-edebanye aha ndepụta ahụ; a naghị emelite ya site n'ịgbanye ma ọ bụ
ịgbanyụ ngwa mgbakwunye ahụ. Wepụ ma wụnye ngwa mgbakwunye ahụ ọzọ, wee nyeghachi mpaghara ikike
ndị ahụ, n'ihi na Cacti na-ewepụ onyinye mpaghara ikike mgbe e wepụrụ ngwa mgbakwunye.

Ebe nchekwa data na-echekwa naanị hash SHA-256 nke token ahụ, ya mere enweghị ike
iweghachite token furu efu; kagbuo ya ma mepụta ọzọ. Ntugharị bụ otu ihe ahụ: mepụta token ọhụrụ,
gbanwee onye ahịa ahụ, wee kagbuo nke ochie. Token gwụrụ oge, token a kagburu,
onye nwe a gbanyụrụ, ma ọ bụ mpaghara ikike furu efu nke ọ bụla na-ada na arịrịọ na-esote. A na-anabata token
naanị na nkụnye isi `Authorization: Bearer`; a naghị anabata token dị n'eriri ajụjụ ma ọ bụ n'ahụ ozi.

## Jikọọ klịentị

Jiri ebe njikọ MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, tinye
token n'ime isiokwu `Authorization: Bearer`. Debe token ahụ n'ime mgbanwe
gburugburu ma ọ bụ njikwa ihe nzuzo ma rụtụ aka na ya site na nhazi klịentị
kama ide uru ya n'ime faịlụ.

### Claude Code

Tinye ebe njikọ ahụ n'ime faịlụ `.mcp.json` nke ọrụ ngo nke na-arụtụ aka na token
site n'aha ya. Claude Code na-agbasa `${VAR}` n'ime `url` na `headers`, ya mere
faịlụ ahụ enweghị ihe nzuzo ọ bụla ma dị mma itinye na nchekwa koodu. Bupụ
`CACTI_MCP_TOKEN` n'ime gburugburu nke na-amalite Claude Code.

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

Ị nwekwara ike itinye ya site n'ahịrị iwu:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Site na akara okwu okpukpu abụọ, shell gị na-agbasa `$CACTI_MCP_TOKEN` nke mbụ,
ya mere a na-ede uru token ahụ n'ime faịlụ nhazi maka `--scope` a họọrọ
(`local`, `user`, ma ọ bụ `project`; ndabara bụ `local`). Ejila ụdị ahụ na
`--scope project`, ma debe faịlụ ahụ n'èzí njikwa mbipụta. Họrọ ntụaka
`.mcp.json` dị n'elu. Claude Code na-agụ ụfọdụ mgbanwe njirimara (dị ka
`ANTHROPIC_AUTH_TOKEN`) dị ka ihe efu n'ime `url` na `headers` dị anya;
`CACTI_MCP_TOKEN` abụghị otu n'ime ha. Isi mmalite:
[Akwụkwọ ntụaka Claude Code MCP](https://code.claude.com/docs/en/mcp).

### GitHub Copilot n'ime VS Code

Jiri faịlụ `.mcp.json` dị na mgbọrọgwụ ebe ọrụ (ma ọ bụ faịlụ onye ọrụ
`~/.copilot/mcp-config.json`). Faịlụ ndị a bụ nke Copilot n'onwe ya na-eji
ihe `mcpServers` n'ogo kachasị elu na ntụaka mgbanwe gburugburu `${NAME}` n'ime
uru isiokwu:

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

Bupụ `CACTI_MCP_TOKEN` n'ime gburugburu nke na-amalite VS Code. Faịlụ Copilot
nke ya anaghị akwado ajụjụ `inputs`. Nhazi eduzi nke VS Code na-ajụ uru
`${...}`, ya mere tinye isiokwu `Authorization` site na idezi faịlụ ahụ,
ọ bụghị site na usoro nhazi eduzi. Nhazi eduzi na-enye faịlụ mgbọrọgwụ ebe ọrụ
naanị mgbe agbanyere ntọala nnwale `chat.mcp.workspaceRootConfig.enabled`. Lee
[ntụaka nhazi VS Code MCP](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Nke ochie: `.vscode/mcp.json`.** VS Code kwuru na nhazi Copilot ọhụrụ ekwesịghị
iji `.vscode/mcp.json` ma ọ bụ `mcp.json` nke profaịlụ; ha bụ nke ngwa Local
harness nke akwụsịla ịkwado, nke a ga-ewepụ na Febụwarị 2027. Ọ bụrụ na ị ka
na-eji ya, usoro nke onye nchịkọta na-ejikwa na-ewere mkpịsị ugodi `servers`
n'ogo kachasị elu ma nwee ike ịjụ maka token:

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

### Klịentị ndị na-asụ naanị stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) bụ ihe nkwụnye nhọrọ
nke na-arụ ọrụ dị ka sava MCP stdio nke mpaghara ma na-akpọ HTTP API nke ngwa
mgbakwunye ahụ. Jiri ya maka klịentị nke na-enweghị ike ijikọ na sava HTTP dị
anya. Ọ chọrọ otu token nkeonwe ahụ ma na-agwa `api.php` okwu.

### Omume MCP

Ebe njikọ ahụ na-enye naanị ngwaọrụ: ikike ọ bụla ekpughere ma kwado bụ ngwaọrụ
nke a gụrụ aha ya site na ID ya, ya na atụmatụ nhazi ntinye na mmepụta ya na
nkọwapụta na-agụ naanị (`openWorldHint` bụ `false`). Ọ na-ejikwa `initialize`,
`server/discover`, `ping`, `tools/list`, na `tools/call`. Ọ naghị edobe oge
ọrụ, anaghị ezipụ `Mcp-Session-Id` (ma na-eleghara nke ọ natara anya), ọ naghị
anabata ụyọkọ JSON-RPC. Ozi na-enweghị `id` bụ ọkwa ma na-enweta HTTP 202
nke na-enweghị ahụ. Naanị `POST` ka e kwere.

- **Ndozigharị.** Arịrịọ nke bu `io.modelcontextprotocol/protocolVersion` n'ime
  `params._meta` ga-akpọ `2026-07-28`; ihe ọ bụla ọzọ na-enweta mmejọ `-32022`.
  Arịrịọ dị otu ahụ ga-ebukwa isiokwu `Mcp-Protocol-Version`, `Mcp-Method`, na
  (maka `tools/call`) `Mcp-Name` kwekọrọ, ma ọ bụghị ya azịza ya ga-abụ mmejọ
  `-32020`. Arịrịọ ndị ọzọ ka a na-ewere dị ka `2025-11-25`: `initialize`
  na-aza na ndozigharị ahụ, na n'usoro ọ bụla ọzọ isiokwu `Mcp-Protocol-Version`,
  ma ọ bụrụ na e zipụrụ ya, ga-abụrịrị `2025-11-25`, `2025-06-18`, ma ọ bụ
  `2025-03-26`.
- **Mmejọ ngwaọrụ.** Mmejọ ikike, gụnyere arụmụka ndị na-ekwekọghị na atụmatụ
  nhazi ma ọ bụ uru `arguments` nke na-abụghị ihe JSON, na-alọghachi dị ka
  nsonazụ ngwaọrụ nwere `isError: true` na mmejọ AIP-193 n'ime
  `structuredContent`, ọ bụghị dị ka mmejọ usoro njikọ.
- **Mmejọ usoro njikọ.** Ọdịda ndị na-abụghị mmejọ ngwaọrụ bụ ihe mmejọ JSON-RPC
  (koodu `-32000` nwere ọnọdụ na ihe kpatara ya n'ime `data`, ma ọ bụ koodu ndị a
  na-ejikarị): URL Cacti ọha na-efu, `Origin` a jụrụ, arịrịọ mgbe agbanyụrụ ngwa
  mgbakwunye ahụ ma ọ bụ na poller dị anya, na mmejọ sava a na-atụghị anya ya
  (`-32603`, ebe e dere nkọwa ya n'ime ndekọ Cacti, ọ bụghị na nzaghachi).
  Nyocha arịrịọ ndị na-agba ọsọ na mbụ (405, 413, 415) na ọdịda nyocha njirimara
  (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) na-edobe ahụ AIP-193 nke a kọwara
  n'okpuru HTTP API.

## HTTP API

Isi URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Nkwekọrịta ahụ
dị n'ime [openapi.json](../../../openapi.json).

| Usoro na ụzọ | Ebumnuche |
| --- | --- |
| `GET /v1/abilities` | Depụta ikike e kwere. Ajụjụ: `pageSize`, `pageToken`, na `filter` nke ụdị `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Gụọ otu ikike. |
| `POST /v1/abilities/{id}:execute` | Mee ka ọ rụọ ọrụ. Ahụ ya bụ kpọmkwem `{"arguments": {...}}`. Nzaghachi ya bụ `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Mmejọ na-agbaso AIP-193: ihe `error` nke nwere `code`, `message`, `status`, na
`details` nke bu `ErrorInfo` nwere ngalaba `cacti.net` na `reason` kwụsiri ike.
Nsogbu arụmụka na-agbakwunye nkọwa `BadRequest` nke na-akpọ aha ogige ahụ. Ahụ
arịrịọ nwere oke ruo 64 KB, na nsonaazụ ruo 1 MB. Ebe njikọ abụọ ahụ na-aza
naanị na isi poller ma weghachite `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) mgbe
agbanyụrụ ngwa mgbakwunye ahụ ma ọ bụ mgbe sava ahụ abụghị isi poller.

| HTTP | Uru `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (na-ezipụkwa `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (na-ezipụ `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Dee ikike (ndị na-emepụta ngwa mgbakwunye)

Ngwa mgbakwunye Cacti a gbanyere na-edeba ikike site n'ọrụ ọ na-ejikọta na
nko `abilities_register`, na-abụkarị n'ime `plugin_<slug>_install()` ya:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Ọrụ ahụ na-anata `AbilitiesRegistrar` nke e mere ka ọ dịrị naanị maka ngwa
mgbakwunye ahụ. A na-eleghara uru ọ na-alọghachi anya.

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

Iwu ndị ahụ, ndị a na-amanye n'oge ndebanye aha:

- **ID dị iche iche.** ID na-adakọ na `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, o
  gaghị akarị mkpụrụedemede 64, ma ọ ga-amaliterịrị na slug ngwa mgbakwunye ahụ na
  akara njikọ: `acme-` dị n'elu. Slug ahụ bụ aha ndekọ faịlụ ngwa mgbakwunye,
  ya mere ndekọ faịlụ dị ka `my_plugin` enweghị ike ideba ihe ọ bụla. A na-ajụ
  ndekọ faịlụ ngwa mgbakwunye akpọrọ `cacti`; oghere aha ahụ bụ nke ndị e wuru
  n'ime ya.
- **Nkọwa.** Kpọmkwem mkpịsị ugodi ndị a: `label`, `description` (ruo byte 4096),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Ngalaba ahụ ga-adịrịrị ugbua: jiri nke e wuru n'ime ya (`inventory`,
  `system`) ma ọ bụ deba nke gị na `registerCategory()`, nke ID ya pụrụ iche
  n'etiti ngwa mgbakwunye niile ma dakọọ na `^[a-z][a-z0-9-]{0,31}$`.
- **Na-agụ naanị.** `annotations` ga-abụrịrị kpọmkwem `readOnly: true`,
  `destructive: false`, `idempotent: true`. Ihe ọ bụla ọzọ na-atụpụ mmejọ.
- **Atụmatụ nhazi.** `input_schema` na `output_schema` ga-enwerịrị `type` `object`
  n'ogo kachasị elu. Asụsụ nhazi ahụ dị ntakịrị ma na-akwụsị ma ọ bụrụ na ihe
  adabaghị. Ihe ga-abụrịrị nke mechiri emechi (`additionalProperties: false`,
  nwere `properties` dị n'ime ya); ụdị ndị ọzọ bụ `integer` na `number`
  (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`),
  `boolean`, na `array` (nke chọrọ `items` na `maxItems`). Enwere ike ime ka ụdị
  nwee ike ịbụ null dị ka `['string', 'null']`. Eriri arụmụka na-anabata nke
  kachasị mkpụrụedemede 4096 na ndabara; eriri nsonaazụ nwere oke naanị site na
  `maxLength` e kwupụtara na oke ibu nsonaazụ. O kachasị ikike 256 ka a pụrụ
  ideba aha.
- **`permission(int $userId): bool`.** Ga-alọghachirịrị kpọmkwem `true` iji
  kwado. ID onye ọrụ ahụ bụ nke onye nwe token; agụla ọnọdụ oge ọrụ ma ọlị.
- **`execute(int $userId, stdClass $args): array`.** E leleela `$args` megide
  `input_schema` ugbua. Manye ikike n'ogo ihe n'onwe gị. Weghachite usoro
  mkpịsị ugodi na uru nke dabara na `output_schema` kpọmkwem; ndepụta, ogige
  mgbakwunye, ma ọ bụ ihe karịrị 1 MB nke JSON na-aghọ mmejọ `INVALID_RESULT`.
  Tụpụ `AbilitiesError` maka ọdịda nke klịentị nwere ike ịhụ, dị ka `NOT_FOUND`.
- **Ihe efu.** PHP na-etinye koodu na `[]` dị ka usoro JSON. Ebe ọ bụla atụmatụ
  nhazi mmepụta kwupụtara `object`, n'omimi ọ bụla, ndekọ aha ahụ na-ewere `[]`
  dị ka ihe efu ma na-ezipụ `{}`; `new stdClass()` na-arụkwa ọrụ. Ndepụta
  na-abụghị efu anaghị agụta dị ka ihe ma na-ada na `INVALID_RESULT`. Maapụ
  `properties` efu n'ime atụmatụ nhazi nwere ike ịbụ `[]` ma ọ bụ `new stdClass()`;
  a na-ebipụta ha abụọ dị ka `{}`.
- **Nkewapụ ọdịda.** Ngwa mgbakwunye ọ bụla na-edeba aha n'ime nnomi nnwale nke
  a na-edobe naanị ma ọ bụrụ na ọrụ gị lọghachiri nke ọma. Ọ bụrụ na ọ tụpụ
  mmejọ, ọ dịghị nke ọ bụla n'ime ikike gị a ga-edeba, a ga-edekwa ọdịda ahụ
  n'akụkọ ndekọ.

Ikike sitere na ngwa mgbakwunye na-amalite n'ụzọ zoro ezo. Onye nchịkwa
na-ekpughe ha na taabụ Ikike nke njikwa, ma kọlụm Mpaghara Achọrọ na-agụ
"Ngwa mgbakwunye debere ya" maka ha.

## Ụdị nchekwa

- **Naanị Bearer.** `api.php` na `mcp.php` na-anabata naanị token nke onwe n'ime isiokwu `Authorization`, ọ bụghị ihe ọzọ. Ha na-ewepụ kuki, `$_POST`, na `$_REQUEST` tupu Cacti ebido ma bibie nnọkọ nke Cacti malitere, ya mere nbanye n'ime ihe nchọgharị weebụ agaghị enye ohere ịbanye API.
- **Ụzọ mgbanwe maka CSRF.** Nchekwa CSRF nke Cacti na-ajụ JSON POST nke na-enweghị CSRF token nke Cacti, nke na ọ nweghị onye ahịa MCP nwere ike izipu. Maka naanị njedebe abụọ a, plugin ahụ na-agbanwe aha usoro arịrịọ tupu Cacti ebido ma weghachite ya ma e mechaa, ka nchekwa ahụ wee mafee ha. Nke a dị nchebe n'ihi na CSRF na-echebe arịrịọ ndị ihe nchọgharị weebụ na-eji kuki enyocha, ebe njedebe ndị a anaghị anabata njirimara kuki ọ bụla: ibe weebụ sitere na saịtị ọzọ enweghị ike itinye bearer token. Ibe Console na-ejigide nchekwa CSRF zuru oke. Ụzọ mgbanwe a bụ maka nwa oge, ruo mgbe Cacti nyere nnwere onwe kwadoro; lee `lib/bootstrap.php`.
- **Nnyocha Origin.** Na `mcp.php`, ọ bụrụ na arịrịọ ahụ nwere isiokwu `Origin`, ọ ga-abụrịrị kpọmkwem atụmatụ (scheme), host, na port nke Public Cacti URL, ma ọ bụghị ya a ga-ajụ arịrịọ ahụ na `ORIGIN_NOT_ALLOWED`. A na-anabata arịrịọ na-enweghị isiokwu `Origin`, nke bụ ụzọ ndị ahịa na-abụghị ihe nchọgharị weebụ si ejikọta. Nke a na-egbochi ibe weebụ ịchịkwa njedebe ahụ site na ihe nchọgharị onye ọbịa. `api.php` anaghị etinye nnyocha a n'ọrụ.
- **Naanị ọgụgụ naanị.** Ndebanye aha na-ajụ ikike ọ bụla nke na-abụghị naanị ọgụgụ, nke na-adịghị emebi ihe, ma na-enye otu nsonaazụ mgbe e megharịrị ya (idempotent).
- **Ngosipụta na realms na-arụkọ ọrụ.** Ikike ga-abụrịrị nke e gosipụtara, onye nwe token ahụ ga-ejikwa realm ya. Ọ bụrụ na enweghị ike ịgụ tebụl ngosipụta, a na-ezo ikike niile kama ịlaghachi na ntọala ndị mbụ.
- **Nke e zoro ezo, nke a na-amaghị, na nke a na-ekweghị ekwe yiri otu.** Onye ahịa enweghị ike ịmata ọdịiche dị n'etiti ikike na-adịghị adị na nke e zoro ezo ma ọ bụ nke onye ọrụ ya na-enweghị ike iji: nchọpụta na-ewepụ ya na mmezu na-eweghachi `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Tokens.** A na-echekwa ha dị ka SHA-256 hash, na-egosi ha otu ugboro, ha na-agwụkarị oge mgbe niile, enwere ike ịkagbu ha, ma na-ajụ ha mgbe a kwụsịrị onye nwe ha ma ọ bụ mgbe ọ tụfuru realm ahụ.
- **Nyocha.** `plugin_mcp_audit` na-edekọ ID arịrịọ, ID token, ID onye ọrụ, ikike, nsonaazụ (`started`, `succeeded`, `failed`, `denied`, `rejected`), na akara oge. Ọ naghị edekọ arụmụka, nsonaazụ ọrụ, ma ọ bụ uru token. Ikike na-agba ọsọ naanị mgbe e dere ahịrị `started` ya; ọ bụrụ na tebụl nyocha adịghị, oku ahụ na-ada na `UNAVAILABLE` ma ọ naghị agba ọsọ. Oku a jụrụ tupu ya agbaa ọsọ bụ otu ahịrị: `denied` maka ikike a na-amaghị, nke e zoro ezo, ma ọ bụ nke a na-ekweghị, `rejected` maka arụmụka ndị dara na schema. A na-edekọ imepụta na ịkagbu token site na console, My MCP Tokens, na CLI dị ka `mcp-token-create` na `mcp-token-revoke` nwere nsonaazụ `succeeded`, ma a na-edekọ nkagbu naanị maka token nke na-arụ ọrụ. A naghị edekọ nchọpụta, na oku nke `arguments` ya na-abụghị ihe JSON.
- **Ndekọ ọdịda.** Ọdịda a na-atụghị anya ya, `INVALID_RESULT`, ma ọ bụ tebụl nyocha na-adịghị na-ede otu ahịrị na ndekọ Cacti na ngalaba `MCP`: ID ikike ahụ, ihe kpatara ya edobere edo, na klaasị ewepụrụ (exception class). A naghị edekọ ozi, arụmụka, na token.
- **Naanị isi poller.** Ma njedebe abụọ ahụ, ma ibe console abụọ ahụ, na `tokens.php` na-ajụ ime ihe n'ebe ọzọ.

## Usoro ndụ

Ịgbanyụ plugin ahụ na-egbochi njedebe abụọ ahụ. Iwepụ ya na-akagbu token ọ bụla ma na-edobe tebụl atọ ahụ (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) maka nchekwa; ịwụnye ya ọzọ anaghị eme ka token a kagburu rụọ ọrụ ọzọ. Mee nkwado ndabere maka tebụl ndị ahụ tinyere nchekwa data Cacti ma tinye iwu nchekwa nyocha n'ọrụ na mpụga plugin ahụ.

## Mmepe na ule

Ule ndị ahụ bụ edemede PHP dị mfe nke na-agba ọsọ na-enweghị Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI na-enyocha PHP ma na-agba edemede ndị dị na `tests/` (edepụtara nke ọ bụla na `.github/workflows/ci.yml`) na PHP 8.2 ruo 8.5, wee wuo ebe nchekwa `mcp/` enwere ike ịwụnye na checksum ya. Ule ndị na-emetụ Cacti na-eji ngwa nkwado (fixtures) n'ókè nke onye inyeaka Cacti; ha anaghị anwale nwụnye Cacti zuru ezu.

### Ule njikọta

`tests/integration/run.sh 1.2.31` ma ọ bụ `tests/integration/run.sh develop` na-awụnye plugin ahụ n'ime ezigbo Cacti dị na kọntena ma na-agba nyocha dị ndụ megide ya. Ọ chọrọ Docker nwere Compose v2.23.1 ma ọ bụ karịa, git na openssl. `KEEP=1` na-ahapụ stack ahụ ka ọ na-agba ọsọ maka nchọpụta mmejọ. CI na-agba ya kwa abalị na mgbe a chọrọ ya, ọ bụghị na pull request.

## Nhazi asụsụ mpaghara

Cacti MCP na-ebubata katalọgụ GNU gettext achịkọtara n'okpuru `locales/po/` na `locales/LC_MESSAGES/` yana README ndị a sụgharịrị n'okpuru `docs/i18n/` maka Bekee tinyere asụsụ mpaghara 44 (19 Broad Tier 1, 15 nke Afrịka, na 10 nke Eshia), na-eji ngalaba ederede `mcp` (`locales/po/mcp.pot`). Cacti na-ebudata katalọgụ dabara adaba na-akpaghị aka mgbe agbanyere nkwado asụsụ.

## Ntinye aka

Pull request na-aga na `develop`. Mee ka koodu mmepụta dakọọ na PHP 8.2 ma jiri ụdị Cacti: tabs, eriri ndị nwere otu akara nhota (single-quoted strings), na ndị inyeaka nchekwa data na ikike nke Cacti. Tinye ule maka mgbanwe nkwenye, ikike, ma ọ bụ omume usoro, ma jiri `git commit -s` banye akwụkwọ na commit. Hazie mgbanwe na HTTP API na [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Ikike

Nwebisiinka (C) 2026 Thomas Vincent. Ewepụtara ya n'okpuru GNU General Public License, mbipụta nke 2 ma ọ bụ karịa. Lee [LICENSE](../../../LICENSE).
