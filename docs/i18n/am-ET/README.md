<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP፦ ጋሻ የያዘ ቁልቋል። ያግኙ። ፍቃድ ይስጡ። ያስፈጽሙ።">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="ፈቃድ፦ GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP የ AI ደንበኞች ችሎታዎች (abilities) ተብለው በሚጠሩ የተሰየሙ እና በፈቃድ የተጣሩ ተግባራት አማካኝነት የእርስዎን የ Cacti ውሂብ እንዲያነቡ የሚያስችል የ Cacti ተሰኪ ነው። ከተሰኪው ራሱ በሁለት መንገዶች ያቀርባቸዋል፦ የ MCP የመጨረሻ ነጥብ (`mcp.php`፣ Streamable HTTP) እና የ AIP ዓይነት HTTP API (`api.php`)። የፍቃድ አሰጣጥ እና የማስፈጸም ኃላፊነት በ Cacti ቁጥጥር ሥር ይቆያል። አንድ ደንበኛ በቀጥታ የውሂብ ጎታውን አይጠይቅም፤ መጥራት የሚችለው አንድ አስተዳዳሪ ይፋ ያደረገውን እና የቶከኑ ባለቤት የ Cacti ግዛቶች የሚፈቅዱትን ችሎታ ብቻ ነው።

የተሰኪ ደራሲዎች የራሳቸውን የንባብ-ብቻ ችሎታዎች በ `abilities_register` መንጠቆ በኩል መመዝገብ ይችላሉ፣ እና ምንም የፕሮቶኮል ኮድ ሳያስፈልግ ለ MCP ደንበኞች እንደ መሣሪያዎች ሆነው ይታያሉ።

**ሁኔታ፦ ቅድመ-ልቀት፣ ስሪት 0.1.0።** መለያ የተደረገበት ልቀት የለም።

ዛሬ የሚገኙት፦

- ለስርዓት ስሪቶች እና ለመሣሪያዎች ዝርዝር የንባብ-ብቻ አብሮገነብ ችሎታዎች።
- የግል መዳረሻ ቶከኖች (`cmcp_pat_...`) እንደ ብቸኛ ማረጋገጫ።
- የ Management > MCP ኮንሶል፦ ችሎታዎችን ይፋ ማድረግ ወይም መደበቅ፣ ቶከኖችን መፍጠር እና መሰረዝ፣ የኦዲት መዝገቡን ማንበብ።
- Management > My MCP Tokens፦ ተጠቃሚዎች የራሳቸውን ቶከኖች ያስተዳድራሉ፣ እንቅስቃሴያቸውን ያያሉ፣ እና ቶከኖቻቸው የትኞቹን መሣሪያዎች መጠቀም እንደሚችሉ ያያሉ።
- MCP በ Streamable HTTP ላይ፣ የፕሮቶኮል ክለሳዎች `2026-07-28` እና `2025-11-25`፣ መሣሪያዎች ብቻ።

ገና ያልተገኙት፦

- የ OAuth 2.1 መግቢያ። የግል ቶከን መላክ የማይችሉ በማስተናገጃ ላይ ያሉ አገናኞች፣ ለምሳሌ እንደ ChatGPT እና claude.ai ብጁ አገናኞች፣ ይህ እስኪኖር ድረስ መገናኘት አይችሉም። እንደ እቅድ 2 የታቀደ ሲሆን፤ ያ እቅድ ገና አልተጻፈም።
- የመጻፍ ችሎታዎች። መመዝገብ የሚችሉት የንባብ-ብቻ ችሎታዎች ብቻ ናቸው።

ንድፉ በ [የመጨረሻ ነጥብ ንድፍ ዝርዝር መግለጫ](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md) ውስጥ ይገኛል፣ የግንባታ ቅደም ተከተሉ ደግሞ በ [docs/plan.md](../../plan.md) ውስጥ ይገኛል።

## አብሮገነብ ችሎታዎች

| መለያ | ግቤቶች | የሚያስፈልገው የ Cacti ግዛት |
| --- | --- | --- |
| `cacti-get-system-info` | የለም | 15 |
| `cacti-list-devices` | አማራጭ `pageSize`፣ `pageToken`፣ `filter`፣ `orderBy` | 3 |
| `cacti-get-device` | አስገዳጅ `name`፣ ለምሳሌ `devices/12` | 3 |

እያንዳንዱ ጥሪ ለቶከኑ ባለቤት የ **MCP and Abilities API** ግዛትን፣ የ `abilities:read` ወሰንን (እያንዳንዱ የግል ቶከን አለው)፣ እና ይፋ የተደረገ ችሎታንም ይፈልጋል። የኮንሶሉ Abilities ትር እያንዳንዱ አብሮገነብ የሚፈልገውን ግዛት ያሳያል።

- `cacti-list-devices` እስከ 100 መሣሪያዎች (በነባሪ 50) የያዙ ገጾችን እና `nextPageToken` ይመልሳል። የገጽ ቶከን የሚሠራው ለተመሳሳዩ `filter` እና `orderBy` ብቻ ነው። `filter` በ `AND` የተያያዙ የንጽጽር AIP-160 አገላለጽ ነው፣ ለምሳሌ `state = "DOWN" AND disabled = false`። የማጣሪያ መስኮች `displayName`፣ `hostname`፣ `disabled`፣ `site`፣ `poller`፣ `deviceTemplate`፣ `externalId` እና `state` ናቸው። `orderBy` `displayName`፣ `hostname` ወይም `name` ይቀበላል፣ እያንዳንዱ እንደ አማራጭ በ `desc` ሊከተል ይችላል።
- የመሣሪያ ጥያቄዎች በ Cacti `get_allowed_devices()` በኩል ያልፋሉ፣ ስለዚህ አንድ ተጠቃሚ የሚያየው Cacti የሚያሳየውን መሣሪያዎች ብቻ ነው።
- የመሣሪያ መስኮች የ SNMP ማህበረሰብ ሕብረቁምፊዎችን፣ የይለፍ ሐረጎችን እና ሌሎች ማረጋገጫዎችን አያካትቱም።

## ጭነት

Cacti 1.2.31 ወይም ከዚያ በላይ፣ PHP 8.2 ወይም ከዚያ በላይ፣ እና ዋናውን ፖለር ይፈልጋል። የ Cacti ማረጋገጫ መንቃት አለበት፤ ሲጠፋ ተሰኪው ማረጋገጫ ለመስጠት ፈቃደኛ አይሆንም።

የተሰኪው ማውጫ `plugin_mcp` ሳይሆን `mcp` ተብሎ መሰየም አለበት። የተሰኪው ስለግ፣ የግዛት ስሞች፣ የትርጉም ጎራ እና URLs ሁሉም `mcp` ይጠቀማሉ።

ከምንጭ ቅጂ፦

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

መለያ የተደረገባቸው ልቀቶች እስኪኖሩ ድረስ፣ በምትኩ የ `mcp-plugin` ቅርስ ከተሳካ [የ CI ሩጫ](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) ማውረድ ይችላሉ። `mcp.tar.gz` እና `SHA256SUMS` ይዟል። የቼክሳም ማረጋገጫውን ያረጋግጡ፣ ከዚያ ውጤቱ `plugins/mcp/` እንዲሆን `mcp.tar.gz` ን በ Cacti `plugins/` ማውጫ ውስጥ ይፍቱት። የ GitHub አውቶማቲክ የምንጭ ማህደሮች የተለየ የከፍተኛ-ደረጃ ማውጫ ስም ይጠቀማሉ። ማህደሩ `docs/` ን (ከታች ያሉትን ቅጽበታዊ ገጽ እይታዎች ጨምሮ)፣ `tests/` ን እና `.github/` ን ስለሚተው፣ በ README ውስጥ ወደ `docs/` የሚወስዱ አገናኞች በ GitHub ላይ ይሰራሉ እንጂ በተጫነው ቅጂ ላይ አይሰሩም።

ከዚያም፦

1. በ Plugin Management ውስጥ **Cacti MCP** ን ይጫኑ እና ያንቁ። ጫኙ አስተዳዳሪ የ **MCP Administration** ግዛትን በራስ-ሰር ይቀበላል።
2. በ Settings > MCP ሥር፣ **Public Cacti URL** የሚለውን ደንበኞች ወደሚጠቀሙበት አድራሻ ያዘጋጁ፣ ለምሳሌ `https://cacti.example.com/cacti`። ከ `localhost`፣ `127.0.0.1` እና `[::1]` በስተቀር HTTPS ያስፈልጋል። ይህ እስኪዘጋጅ ድረስ `mcp.php` `data` ው `FAILED_PRECONDITION` እና `PUBLIC_URL_REQUIRED` የሆነ JSON-RPC ስህተት ይዞ HTTP 400 ይመልሳል። `api.php` ይህንን አያነብም።

   ![የ Public Cacti URL መስክን የሚያሳይ Settings > MCP](../../images/settings-public-url.png)

3. ቶከን ባለቤት ለሚሆን እያንዳንዱ ተጠቃሚ የ **MCP and Abilities API** ግዛትን ይስጡ። ማንም ተጠቃሚ በራስ-ሰር አይቀበለውም።
4. የድር አገልጋዩ የ `Authorization` ራስጌን እና የመንገድ መረጃን ወደ PHP ማስተላለፉን ያረጋግጡ (ከታች ይመልከቱ)።
5. Management > MCP ን ይክፈቱ እና ደንበኞች እንዲያዩዋቸው የሚፈልጓቸውን ችሎታዎች ይፋ ያድርጉ።

**ከልማት ግንባታ ማሻሻል።** ተሰኪው ቅድመ-ልቀት ነው፣ እና ሠንጠረዦቹ በልማት ወቅት ያለ ፍልሰት ተለውጠዋል። ቀደም ያለ ግንባታ ከጫኑ፣ ያራግፉት እና እንደገና ይጫኑ። እንደገና መጫን አስቀድመው የነበሩ ሠንጠረዦችን ያቆያል፣ ስለዚህ መጀመሪያ የድሮዎቹን `plugin_mcp_token`፣ `plugin_mcp_audit` እና `plugin_mcp_ability` ሠንጠረዦችን (እና ስሙ ከመቀየሩ በፊት ከተሠሩ ግንባታዎች የነበሩ ተመጣጣኝ ሠንጠረዦችን) ያጥፉ። ታሪካቸውን ከፈለጉ ምትኬ ያስቀምጡላቸው፤ ከእነዚያ ግንባታዎች የነበሩ ቶከኖች ሲራገፉ ይሰረዛሉ እና አይተላለፉም።

### የድር አገልጋይ

ከ PHP በፊት `Authorization` ን የሚያስወግዱ የ Apache ማዋቀሪያዎች በሚመለከተው ቨርቹዋል አስተናጋጅ ወይም ማውጫ ውስጥ ይህንን ይፈልጋሉ፣ ከዚያም እንደገና መጫን ያስፈልጋል፦

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` ያለው Apache ያለ ምንም ተጨማሪ የመንገድ ማዋቀር የ `api.php` መስመሮችን አገልግሏል።

የ `api.php` መስመሮች ከስክሪፕቱ ስም በኋላ ባለው መንገድ (`/plugins/mcp/api.php/v1/abilities`) ውስጥ ይገኛሉ፣ ስለዚህ nginx `.php` በተጨማሪ መንገድ የሚከተልባቸውን URIs ማዛመድ፣ የመንገድ መረጃውን መለየት እና ወደ PHP ማስተላለፍ አለበት። `location ~ \.php$` ብሎክ እነዚህን URLs በፍጹም አያዛምድም፤ nginx በራሱ HTML 404 ይመልሳል። ከታች ያለው የመገኛ ቦታ ንድፍ እና ሁለቱ የመንገድ-መረጃ መስመሮች በ PHP-FPM ተረጋግጠዋል፤ ሌሎቹ መስመሮች መደበኛ አብነት ናቸው፦

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

የ `include` እና `fastcgi_pass` መስመሮችን አስቀድሞ Cacti ን ከሚያገለግለው ብሎክ ጋር እንዲዛመዱ ያስተካክሉ። ወደዚህ ብሎክ `try_files $fastcgi_script_name =404;` ን አያክሉ፦ `$fastcgi_path_info` ን ያጠፋዋል፣ እና `api.php` ከዚያ 404 `UNKNOWN_PATH` ብሎ ይመልሳል። ማዋቀርዎ `try_files` ን የሚፈልግ ከሆነ፣ መጀመሪያ እሴቱን በ `set $path_info $fastcgi_path_info;` ያስቀምጡ እና `fastcgi_param PATH_INFO $path_info;` ን ያስተላልፉ።

`mcp.php` የመንገድ መስመሮች የሉትም እና አያስፈልጉትም።

## ኮንሶል

Management > MCP ሦስት ትሮች አሉት። የ **MCP Administration** ግዛት ያስፈልግዎታል። እዚህ እና ከታች ያሉት ቅጽበታዊ ገጽ እይታዎች ከ Cacti የልማት ግንባታ በምሳሌ ውሂብ የተወሰዱ ናቸው።

- **Abilities** የተመዘገበውን እያንዳንዱን ችሎታ ከተሰኪው፣ ከምድቡ፣ ከሚፈልገው ግዛት እና ይፋ መደረጉን ወይም አለመደረጉን ጨምሮ ይዘረዝራል። ረድፎችን ይምረጡ እና Expose ወይም Hide የሚለውን ይምረጡ፤ ለውጡ ከመተግበሩ በፊት ያረጋግጣሉ። አብሮገነብ `cacti-*` ችሎታዎች በነባሪነት ይፋ የተደረጉ ናቸው። ከሌሎች ተሰኪዎች የሚመጡ ችሎታዎች ተደብቀው ይጀምራሉ፣ ስለዚህ አንድ ተሰኪ መጫን አስተዳዳሪ እስኪወስን ድረስ ምንም ነገር አያትምም። ይፋ ማድረግ መዳረሻን የሚያጠብ ብቻ ነው፦ አንድ ተጠቃሚ አሁንም የችሎታውን ግዛት ይፈልጋል።

  ![አብሮገነብ ችሎታዎችን ከግዛቶቻቸው እና ከይፋዊነት ሁኔታቸው ጋር የሚዘረዝር የ Abilities ትር](../../images/console-abilities.png)
- **Tokens** ቶከኖችን ከባለቤት፣ ከፈጣሪ፣ ከተፈጠረበት ጊዜ፣ ከሚያበቃበት ጊዜ፣ ለመጨረሻ ጊዜ ጥቅም ላይ ከዋለበት እና ከሁኔታ (Active፣ Expired፣ Revoked) ጋር ይዘረዝራል። ረድፎችን ይምረጡ እና እነሱን ለመሰረዝ Revoke ን ይምረጡ። የተሰረዙ ቶከኖች እንደገና ጥቅም ላይ ሊውሉ አይችሉም። Create Token አዲስ ይፈጥራል።

  ![ቶከኖችን ከባለቤት፣ ከማብቂያ ጊዜ፣ ከመጨረሻ አጠቃቀም እና ከሁኔታ ጋር ከ Create Token ቅጽ በላይ የሚዘረዝር የ Tokens ትር](../../images/console-tokens.png)
- **Audit** የኦዲት ረድፎችን አዲሱን መጀመሪያ በማድረግ ይዘረዝራል፣ እና በተጠቃሚ፣ በችሎታ እና በውጤት ያጣራል።

  ![ጥሪዎችን ከተጠቃሚ፣ ከቶከን፣ ከችሎታ እና ከውጤት ጋር ከማጣሪያዎች ጋር የሚዘረዝር የ Audit ትር](../../images/console-audit.png)

## ቶከኖች

የግል ቶከን Cacti ን እንደ ባለቤቱ ያነባል። `cmcp_pat_` ን ተከትሎ በ 64 ትናንሽ ሄክሳዴሲማል ቁምፊዎች ቅርጽ ያለው ሲሆን ነጠላውን `abilities:read` ወሰን ይይዛል። ማየት የሚችለው የሚወሰነው በባለቤቱ የ Cacti ግዛቶች እና የመሣሪያ ፈቃዶች እንጂ በቶከኑ አይደለም። ባለቤቱ የ **MCP and Abilities API** ግዛት ያለው የነቃ ተጠቃሚ መሆን አለበት።

ቶከኖች ሁልጊዜ ለአንድ ተጠቃሚ ይፈጠራሉ፣ ጊዜያቸው ያልፋል፣ እና ሊሰረዙ ይችላሉ፦

- **ኮንሶል።** Management > MCP > Tokens > Create Token። የቆይታ ጊዜው ከ 1 እስከ 365 ቀናት ሲሆን በነባሪ 90 ነው። ቶከኑ በአገልጋዩ የሚመነጭ ሲሆን በምላሽ ገጹ ላይ አንድ ጊዜ ብቻ ይታያል፣ ስለዚህ ወዲያውኑ ወደ ሚስጥር አስተዳዳሪዎ ይቅዱት። ለራስዎ ቶከን መፍጠር ይችላሉ። ለሌላ ተጠቃሚ መፍጠር የ Users/Groups ግዛትንም ይፈልጋል፣ ምክንያቱም ቶከኑ Cacti ን እንደዚያ ተጠቃሚ ስለሚያነብ ነው።
- **My MCP Tokens።** የ MCP and Abilities API ግዛት ያለው ማንኛውም ተጠቃሚ የራሱን ቶከኖች ማስተዳደር ይችላል፤ ከታች ይመልከቱ።
- **የትዕዛዝ መስመር።** `tokens.php` የሚሄደው ከ CLI ብቻ ነው፣ Cacti ን ማስተዳደር እንደሚችል የስርዓተ ክወና መለያ ሆኖ። እሴቱ በትዕዛዝ መስመር ወይም በሂደት ዝርዝር ውስጥ በፍጹም እንዳይታይ ቶከኑን ከአካባቢው ይወስዳል። የቆይታ ጊዜው ከ 1 እስከ 365 ቀናት ሲሆን በነባሪ 30 ነው። በ CLI በኩል ቶከን መፍጠር እና መሰረዝ እንደ ኮንሶሉ ኦዲት ይደረጋል፣ CLI የ Cacti ተጠቃሚ ስለሌለው የቶከኑ ባለቤት እንደ አድራጊው ይመዘገባል፣ ስለዚህ የኦዲት ረድፉ ድርጊቱ ከ CLI እንደመጣ ምልክት አያደርግም። `--list` እያንዳንዱን ቶከን እንደ JSON (መለያ፣ ባለቤት፣ ወሰኖች፣ የጊዜ ማህተሞች፣ የተሰረዘ ምልክት) ያትማል እንጂ የቶከኑን እሴት በፍጹም አያትምም፤ `--help` አጠቃቀሙን ያሳያል።

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

ለእንግዳ መለያ፣ ለተሰናከሉ ተጠቃሚዎች፣ ወይም የ **MCP and Abilities API** ግዛት ለሌላቸው ተጠቃሚዎች፣ ከኮንሶሉ፣ ከትዕዛዝ መስመሩ ወይም ከ My MCP Tokens ቶከኖች ሊፈጠሩ አይችሉም። Cacti የእንግዳውን ቅንብር እንደ የተጠቃሚ ስም ወይም የተጠቃሚ መለያ ያስቀምጣል፣ እና ተሰኪው ሁለቱንም ይፈታል። ባለቤቱ የእንግዳ መለያ የሆነ ቶከን በሚቀጥለው ጥያቄው ላይ መስራቱን ያቆማል።

### የእኔ MCP ቶከኖች

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ምንም የአስተዳደር ግዛት አያስፈልገውም፦ በ **MCP and Abilities API** ግዛት የተሸፈነ ነው፣ እና የምናሌው ግቤት የሚታየው ይህ ግዛት ላላቸው ተጠቃሚዎች ብቻ ነው። ገጹ ሁልጊዜ በገባው ተጠቃሚ ላይ ይሠራል። የ Cacti ምናሌ የኮንሶሉ አካል ስለሆነ፣ የኮንሶል መዳረሻ የሌለው ተጠቃሚ በአድራሻው ወደ ገጹ ይደርሳል።

![የገባውን ተጠቃሚ ቶከኖች እና የመፍጠሪያ ቅጹን የሚዘረዝር የ My Tokens ትር](../../images/my-tokens.png)

- **Tokens** የእርስዎን ቶከኖች ይዘረዝራል፣ አንድ ይፈጥራል (ከ 1 እስከ 365 ቀናት፣ በነባሪ 90፣ በምላሹ ውስጥ አንድ ጊዜ የሚታይ)፣ እና የራስዎን ይሰርዛል። የሌላ ሰውን ማየት ወይም መሰረዝ አይችሉም።
- **Activity** እርስዎ የፈጸሟቸውን ድርጊቶች አዲሱን መጀመሪያ በማድረግ ይዘረዝራል፦ በቶከኖችዎ የተደረጉ ጥሪዎች እና እርስዎ ያደረጓቸው የቶከን ለውጦች።
- **Available Tools** የእርስዎ ቶከን አሁኑኑ ሊጠቀምባቸው የሚችላቸውን ችሎታዎች ከእያንዳንዱ ችሎታ መለያ፣ ስም እና መግለጫ ጋር ይዘረዝራል። የእርስዎን የ Cacti ፈቃዶች እና አንድ አስተዳዳሪ የመረጣቸውን የይፋዊነት ቅንብሮች ይከተላል።

  ![የእያንዳንዱን ችሎታ መለያ፣ ስም እና መግለጫ የሚያሳይ የ Available Tools ዝርዝር](../../images/my-tools.png)

ይህ ገጽ ከመኖሩ በፊት የተደረገ ጭነት `mcp_tokens.php` የሌለበት የግዛት ፋይል ዝርዝር አለው። መጫን ዝርዝሩን ይመዘግባል፤ ተሰኪውን በማንቃት ወይም በማሰናከል አይዘምንም። ተሰኪውን ያራግፉ እና እንደገና ይጫኑ፣ ከዚያ ግዛቶቹን እንደገና ይስጡ፣ ምክንያቱም አንድ ተሰኪ ሲራገፍ Cacti የግዛት ስጦታዎችን ስለሚያስወግድ ነው።

የውሂብ ጎታው የሚያስቀምጠው የቶከኑን የ SHA-256 ሃሽ ብቻ ነው፣ ስለዚህ የጠፋ ቶከን መልሶ ማግኘት አይቻልም፤ ይሰርዙት እና ሌላ ይፍጠሩ። መቀየርም ተመሳሳይ ነው፦ አዲስ ቶከን ይፍጠሩ፣ ደንበኛውን ይቀይሩ፣ ከዚያ አሮጌውን ይሰርዙ። ጊዜው ያለፈበት ቶከን፣ የተሰረዘ ቶከን፣ የተሰናከለ ባለቤት ወይም የጠፋ ግዛት እያንዳንዳቸው በሚቀጥለው ጥያቄ ላይ አይሳኩም። ቶከኖች ተቀባይነት የሚያገኙት በ `Authorization: Bearer` ራስጌ ውስጥ ብቻ ነው፤ በመጠይቅ ሕብረቁምፊ ወይም በአካል ውስጥ ያለ ቶከን ተቀባይነት የለውም።

## ደንበኛን ያገናኙ

`https://cacti.example.com/cacti/plugins/mcp/mcp.php` የሚለውን የMCP መጨረሻ ነጥብ ይጠቀሙ፤ ቶከኑንም በ`Authorization: Bearer` ራስጌ ውስጥ ያስቀምጡ። ቶከኑን በአካባቢ ተለዋዋጭ ወይም በሚስጥር አስተዳዳሪ ውስጥ ያስቀምጡትና ዋጋውን በፋይል ውስጥ ከመጻፍ ይልቅ ከደንበኛ ውቅር ውስጥ ይጥቀሱት።

### Claude Code

መጨረሻ ነጥቡን ቶከኑን በስም በሚጠቅስ የፕሮጀክት `.mcp.json` ፋይል ውስጥ ያስገቡ። Claude Code በ`url` እና በ`headers` ውስጥ ያለውን `${VAR}` ስለሚዘረጋው ፋይሉ ምንም ሚስጥር አይይዝም፤ እንዲሁም ወደ ስሪት ቁጥጥር ማስገባት ደህንነቱ የተጠበቀ ነው። Claude Codeን በሚያስጀምረው አካባቢ ውስጥ `CACTI_MCP_TOKEN`ን ወደ ውጭ ይላኩ።

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

ከትእዛዝ መስመርም ማከል ይችላሉ፦

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

ድርብ ጥቅሶችን ሲጠቀሙ፣ የእርስዎ ሼል መጀመሪያ `$CACTI_MCP_TOKEN`ን ስለሚዘረጋው የቶከኑ ዋጋ ለተመረጠው `--scope` (`local`፣ `user` ወይም `project`፤ ነባሪው `local`) ወደ ውቅር ፋይሉ ይጻፋል። ይህንን አጻጻፍ ከ`--scope project` ጋር አይጠቀሙ፣ ፋይሉንም ከስሪት ቁጥጥር ውጭ ያድርጉት። ከላይ ያለውን የ`.mcp.json` ማጣቀሻ መጠቀም ይመረጣል። Claude Code አንዳንድ የማረጋገጫ ተለዋዋጮችን (እንደ `ANTHROPIC_AUTH_TOKEN` ያሉትን) በርቀት `url` እና `headers` ውስጥ እንደ ባዶ ያነባቸዋል፤ `CACTI_MCP_TOKEN` ግን ከእነዚህ ውስጥ አይደለም። ምንጭ፦ [የClaude Code MCP ሰነድ](https://code.claude.com/docs/en/mcp)።

### GitHub Copilot በVS Code ውስጥ

የስራ ቦታ ስር `.mcp.json` (ወይም የተጠቃሚ ፋይል `~/.copilot/mcp-config.json`) ይጠቀሙ። እነዚህ የCopilot ተወላጅ ፋይሎች ከፍተኛ ደረጃ `mcpServers` ነገር እና በራስጌ ዋጋዎች ውስጥ `${NAME}` የአካባቢ ተለዋዋጭ ማጣቀሻዎችን ይጠቀማሉ፦

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

VS Codeን በሚያስጀምረው አካባቢ ውስጥ `CACTI_MCP_TOKEN`ን ወደ ውጭ ይላኩ። ተወላጅ የCopilot ፋይሎች የ`inputs` መጠየቂያዎችን አይደግፉም። የVS Code የሚመራ ማዋቀር `${...}` ዋጋዎችን ስለማይቀበል፣ የ`Authorization` ራስጌን በሚመራው ሂደት በኩል ሳይሆን ፋይሉን በማርትዕ ያክሉ። የሚመራው ማዋቀር የስራ ቦታ ስር ፋይሉን የሚያቀርበው የሙከራ `chat.mcp.workspaceRootConfig.enabled` ቅንብር ሲበራ ብቻ ነው። [የVS Code MCP ውቅር ማጣቀሻ](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)ን ይመልከቱ።

**ቀደምት፦ `.vscode/mcp.json`።** VS Code እንደሚለው አዲስ የCopilot ውቅሮች `.vscode/mcp.json` ወይም የመገለጫ `mcp.json` መጠቀም የለባቸውም፤ እነዚህ በፌብሩዋሪ 2027 የሚወገደው የተተወው Local harness አካል ናቸው። አሁንም የሚጠቀሙበት ከሆነ፣ በአርታኢ የሚተዳደረው ቅርጸት ከፍተኛ ደረጃ `servers` ቁልፍ ይወስዳል እንዲሁም ቶከኑን መጠየቅ ይችላል፦

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

### stdio ብቻ የሚናገሩ ደንበኞች

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) እንደ አካባቢያዊ stdio MCP አገልጋይ ሆኖ የሚሰራና የፕለጊኑን HTTP API የሚጠራ አማራጭ አስማሚ ነው። ከርቀት HTTP አገልጋይ ጋር መገናኘት ለማይችል ደንበኛ ይጠቀሙበት። ተመሳሳይ የግል ቶከን ያስፈልገዋል እንዲሁም ከ`api.php` ጋር ይነጋገራል።

### የMCP ባህሪ

መጨረሻ ነጥቡ መሳሪያዎችን ብቻ ያቀርባል፦ እያንዳንዱ የተገለጠ እና የተፈቀደ ችሎታ በመለያው የተሰየመ መሳሪያ ሲሆን፣ የግቤት እና የውጤት እቅዶቹን እና ለንባብ ብቻ የሆኑ ማብራሪያዎችን (`openWorldHint` `false` ነው) ይይዛል። `initialize`፣ `server/discover`፣ `ping`፣ `tools/list` እና `tools/call`ን ያስተናግዳል። ምንም ክፍለ-ጊዜ አይይዝም፣ `Mcp-Session-Id` አይልክም (የተቀበለውንም ችላ ይላል)፣ እና የJSON-RPC ጥቅሎችን አይቀበልም። `id` የሌለው መልዕክት ማሳወቂያ ሲሆን ምንም አካል ሳይኖረው HTTP 202 ያገኛል። `POST` ብቻ ነው የተፈቀደው።

- **ክለሳዎች።** በ`params._meta` ውስጥ `io.modelcontextprotocol/protocolVersion`ን የሚይዝ ጥያቄ `2026-07-28`ን መጥቀስ አለበት፤ ሌላ ማንኛውም ነገር `-32022` ስህተት ያገኛል። እንደዚህ ያሉ ጥያቄዎች ተዛማጅ `Mcp-Protocol-Version`፣ `Mcp-Method`፣ እና (ለ`tools/call`) `Mcp-Name` ራስጌዎችን መያዝ አለባቸው፣ ያለበለዚያ መልሱ `-32020` ስህተት ይሆናል። ሌሎች ጥያቄዎች እንደ `2025-11-25` ይቆጠራሉ፦ `initialize` በዚያ ክለሳ ይመልሳል፣ እና በሌላ በማንኛውም ዘዴ ላይ `Mcp-Protocol-Version` ራስጌ ከተላከ `2025-11-25`፣ `2025-06-18` ወይም `2025-03-26` መሆን አለበት።
- **የመሳሪያ ስህተቶች።** ከእቅዱ ጋር የማይዛመዱ ነጋሪ እሴቶችን ወይም የJSON ነገር ያልሆነ `arguments` ዋጋን ጨምሮ የችሎታ ስህተት፣ እንደ ፕሮቶኮል ስህተት ሳይሆን `isError: true` እና በ`structuredContent` ውስጥ የAIP-193 ስህተት ያለው የመሳሪያ ውጤት ሆኖ ይመለሳል።
- **የፕሮቶኮል ስህተቶች።** የመሳሪያ ስህተቶች ያልሆኑ ውድቀቶች የJSON-RPC ስህተት ነገሮች ናቸው (በ`data` ውስጥ ሁኔታ እና ምክንያት ያለው ኮድ `-32000`፣ ወይም መደበኛ ኮዶች)፦ የጎደለው Public Cacti URL፣ ውድቅ የተደረገ `Origin`፣ ፕለጊኑ ተሰናክሎ ሳለ ወይም በርቀት poller ላይ የቀረበ ጥያቄ፣ እና ያልተጠበቁ የአገልጋይ ስህተቶች (`-32603`፣ ዝርዝሩ በምላሹ ውስጥ ሳይሆን በCacti መዝገብ ውስጥ ይጻፋል)። መጀመሪያ የሚሰሩ የጥያቄ ፍተሻዎች (405፣ 413፣ 415) እና የማረጋገጫ ውድቀቶች (401 `INVALID_TOKEN`፣ 403 `REALM_REQUIRED`) በHTTP API ስር የተገለጸውን የAIP-193 አካል ይይዛሉ።

## HTTP API

መሰረታዊ URL፦ `https://cacti.example.com/cacti/plugins/mcp/api.php`። ውሉ በ[openapi.json](../../../openapi.json) ውስጥ ይገኛል።

| ዘዴ እና መንገድ | ዓላማ |
| --- | --- |
| `GET /v1/abilities` | የተፈቀዱ ችሎታዎችን ይዘርዝሩ። መጠይቅ፦ `pageSize`፣ `pageToken` እና `category = "inventory"` መልክ ያለው `filter`። |
| `GET /v1/abilities/{id}` | አንድ ችሎታ ያንብቡ። |
| `POST /v1/abilities/{id}:execute` | ያስኪዱት። አካሉ በትክክል `{"arguments": {...}}` ነው። ምላሹ `{"requestId": "...", "result": {...}}` ነው። |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

ስህተቶች AIP-193ን ይከተላሉ፦ `code`፣ `message`፣ `status` እና `cacti.net` ጎራ እና ቋሚ `reason` ያለው `ErrorInfo`ን የሚይዝ `details` ያለው `error` ነገር። የነጋሪ እሴት ችግሮች መስኩን የሚሰይም `BadRequest` ዝርዝር ይጨምራሉ። የጥያቄ አካላት በ64 KB፣ ውጤቶች ደግሞ በ1 MB የተገደቡ ናቸው። ሁለቱም መጨረሻ ነጥቦች የሚመልሱት በዋናው poller ላይ ብቻ ሲሆን ፕለጊኑ ሲሰናከል ወይም አገልጋዩ ዋናው poller ካልሆነ `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) ይመልሳሉ።

| HTTP | የ`reason` ዋጋዎች |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer`ንም ይልካል) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow`ን ይልካል) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## ችሎታ ይጻፉ (ለፕለጊን ደራሲዎች)

የነቃ የCacti ፕለጊን አብዛኛውን ጊዜ በ`plugin_<slug>_install()` ውስጥ ከ`abilities_register` መንጠቆ ጋር ከሚያያይዘው ተግባር ላይ ችሎታዎችን ይመዘግባል፦

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

ተግባሩ ለፕለጊኑ የተወሰነ `AbilitiesRegistrar` ይቀበላል። የመመለሻ ዋጋው ችላ ይባላል።

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

ሁሉም በምዝገባ ወቅት የሚተገበሩ ደንቦች፦

- **መለያዎች።** አንድ መለያ ከ`^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` ጋር ይዛመዳል፣ ቢበዛ 64 ቁምፊዎች አሉት፣ እና በፕለጊኑ slug እና በሰረዝ መጀመር አለበት፦ ከላይ `acme-`። slug የፕለጊን ማውጫ ስም ነው፣ ስለዚህ እንደ `my_plugin` ያለ ማውጫ ምንም መመዝገብ አይችልም። `cacti` የተባለ የፕለጊን ማውጫ ተቀባይነት የለውም፤ ያ የስም ቦታ የውስጠ-ግንቦች ነው።
- **ትርጓሜ።** እነዚህ ቁልፎች በትክክል፦ `label`፣ `description` (እስከ 4096 ባይት)፣ `category`፣ `input_schema`፣ `output_schema`፣ `annotations`፣ `permission`፣ `execute`። ምድቡ አስቀድሞ መኖር አለበት፦ ውስጠ-ግንብ (`inventory`፣ `system`) ይጠቀሙ ወይም በሁሉም ፕለጊኖች ላይ ልዩ የሆነ እና ከ`^[a-z][a-z0-9-]{0,31}$` ጋር የሚዛመድ መለያ ያለውን የራስዎን በ`registerCategory()` ይመዝግቡ።
- **ለንባብ ብቻ።** `annotations` በትክክል `readOnly: true`፣ `destructive: false`፣ `idempotent: true` መሆን አለበት። ሌላ ማንኛውም ነገር ስህተት ይጥላል።
- **እቅዶች።** `input_schema` እና `output_schema` እያንዳንዳቸው ከፍተኛ ደረጃ `type` `object` ሊኖራቸው ይገባል። ዘይቤው ትንሽ ሲሆን በዝግ ይወድቃል። ነገሮች ዝግ መሆን አለባቸው (`additionalProperties: false`፣ ከ`properties` ጋር)፤ ሌሎች ዓይነቶች `integer` እና `number` (`minimum`፣ `maximum`)፣ `string` (`minLength`፣ `maxLength`፣ `enum`፣ `pattern`)፣ `boolean` እና `array` (`items` እና `maxItems` የሚፈልግ) ናቸው። አንድ ዓይነት እንደ `['string', 'null']` ባዶ ሊደረግ የሚችል ሊሆን ይችላል። የነጋሪ እሴት ሕብረቁምፊዎች በነባሪነት ቢበዛ 4096 ቁምፊዎች ናቸው፤ የውጤት ሕብረቁምፊዎች የሚገደቡት በተገለጸው `maxLength` እና በውጤቱ መጠን ገደብ ብቻ ነው። ቢበዛ 256 ችሎታዎች መመዝገብ ይችላሉ።
- **`permission(int $userId): bool`።** ለመፍቀድ በትክክል `true` መመለስ አለበት። የተጠቃሚው መለያ የቶከኑ ባለቤት ነው፤ የክፍለ-ጊዜ ሁኔታን በፍጹም አያንብቡ።
- **`execute(int $userId, stdClass $args): array`።** `$args` አስቀድሞ ከ`input_schema` አንጻር ተረጋግጧል። የነገር-ደረጃ ፈቃዶችን እራስዎ ያስፈጽሙ። ከ`output_schema` ጋር በትክክል የሚዛመድ associative array ይመልሱ፤ ዝርዝር፣ ተጨማሪ መስክ፣ ወይም ከ1 MB በላይ የሆነ JSON `INVALID_RESULT` ስህተት ይሆናል። ለደንበኛ የሚታይ ውድቀት፣ ለምሳሌ `NOT_FOUND`፣ `AbilitiesError`ን ይጣሉ።
- **ባዶ ነገሮች።** PHP `[]`ን እንደ JSON array ይቀይረዋል። የውጤት እቅዱ በማንኛውም ጥልቀት `object`ን ባወጀበት ቦታ ሁሉ፣ መዝገቡ `[]`ን እንደ ባዶ ነገር ይቆጥረዋል እና `{}` ይልካል፤ `new stdClass()`ም ይሰራል። ባዶ ያልሆነ ዝርዝር በፍጹም እንደ ነገር አይቆጠርም እና በ`INVALID_RESULT` ይወድቃል። በእቅድ ውስጥ ያለ ባዶ የ`properties` ካርታ `[]` ወይም `new stdClass()` ሊሆን ይችላል፤ ሁለቱም እንደ `{}` ይታተማሉ።
- **የውድቀት ማግለል።** እያንዳንዱ ፕለጊን ተግባርዎ በመደበኛነት ከተመለሰ ብቻ በሚቆይ ጊዜያዊ ቅጂ ውስጥ ይመዘግባል። ስህተት ከጣለ፣ ከችሎታዎችዎ አንዱም አይመዘገብም፣ እና ውድቀቱ በመዝገብ ውስጥ ይቀመጣል።

ከፕለጊኖች የሚመጡ ችሎታዎች ተደብቀው ይጀምራሉ። አስተዳዳሪው በኮንሶሉ Abilities ትር ላይ ያጋልጣቸዋል፣ እና Required Realm የሚለው አምድ ለእነሱ "Set by the plugin" ይላል።

## የደህንነት ሞዴል

- **Bearer ብቻ።** `api.php` እና `mcp.php` በ`Authorization` ራስጌ ውስጥ የግል ቶከንን ብቻ ይቀበላሉ፤ ከዚህ ውጭ ሌላ ምንም አይቀበሉም። Cacti ከመጫኑ በፊት ኩኪዎችን፣ `$_POST`ን እና `$_REQUEST`ን ይጥላሉ እንዲሁም Cacti የሚጀምረውን ክፍለ ጊዜ ያጠፋሉ፤ ስለዚህ በአሳሽ መግባት በፍጹም የAPI መዳረሻ አይሰጥም።
- **የCSRF ጊዜያዊ መፍትሄ።** የCacti የCSRF መከላከያ የCacti CSRF ቶከን የሌለውን የJSON POST ጥያቄ ውድቅ ያደርጋል፤ ይህንንም የትኛውም የMCP ደንበኛ መላክ አይችልም። ለእነዚህ ሁለት መጨረሻ ነጥቦች ብቻ ፕለጊኑ Cacti ከመጫኑ በፊት የጥያቄውን ዘዴ ስም ይቀይራል እና በኋላ ይመልሰዋል፤ ስለዚህ መከላከያው ያልፋቸዋል። CSRF የሚከላከለው አሳሽ በኩኪዎች የሚያረጋግጣቸውን ጥያቄዎች ስለሆነ እና እነዚህ መጨረሻ ነጥቦች ምንም የኩኪ ማንነት ስለማይቀበሉ ይህ ደህንነቱ የተጠበቀ ነው፦ የሌላ ጣቢያ ገጽ የBearer ቶከኑን ማያያዝ አይችልም። የኮንሶል ገጾች ሙሉ የCSRF ጥበቃቸውን እንደያዙ ይቆያሉ። Cacti የተደገፈ ነጻ የመሆኛ መንገድ እስኪያቀርብ ድረስ ይህ መፍትሄ ጊዜያዊ ነው፤ `lib/bootstrap.php`ን ይመልከቱ።
- **የOrigin ፍተሻ።** በ`mcp.php` ላይ ጥያቄው የ`Origin` ራስጌ ካለው፣ የPublic Cacti URL እቅድ፣ አስተናጋጅ እና ወደብ ጋር ሙሉ በሙሉ ተመሳሳይ መሆን አለበት፤ አለበለዚያ ጥያቄው በ`ORIGIN_NOT_ALLOWED` ውድቅ ይደረጋል። አሳሽ ያልሆኑ ደንበኞች የሚገናኙበት መንገድ የሆነው የ`Origin` ራስጌ የሌለው ጥያቄ ይፈቀዳል። ይህ አንድ ድረ-ገጽ ከጎብኚው አሳሽ ሆኖ መጨረሻ ነጥቡን እንዳያንቀሳቅስ ያግዳል። `api.php` ይህንን ፍተሻ አይተገብርም።
- **ለንባብ ብቻ።** ምዝገባ ለንባብ ብቻ፣ የማያጠፋ እና ተደጋጋሚነቱ ተመሳሳይ ውጤት ያለው ያልሆነ ማንኛውንም ችሎታ ውድቅ ያደርጋል።
- **መጋለጥ እና ግዛቶች ሁለቱም ተግባራዊ ይሆናሉ።** አንድ ችሎታ የተጋለጠ መሆን አለበት እንዲሁም የቶከኑ ባለቤት የእሱን ግዛት መያዝ አለበት። የመጋለጥ ሰንጠረዡ መነበብ ካልቻለ፣ ወደ ነባሪዎች ከመመለስ ይልቅ እያንዳንዱ ችሎታ ይደበቃል።
- **የተደበቁ፣ የማይታወቁ እና ያልተፈቀዱ አንድ አይነት ይመስላሉ።** አንድ ደንበኛ የሌለን ችሎታ ከተደበቀ ወይም ተጠቃሚው ሊጠቀምበት ከማይችለው መለየት አይችልም፦ ማግኛው ይተወዋል እና ማስፈጸሚያው `NOT_FOUND` (`ABILITY_NOT_FOUND`) ይመልሳል።
- **ቶከኖች።** እንደ SHA-256 ሃሽ ይቀመጣሉ፣ አንድ ጊዜ ብቻ ይታያሉ፣ ሁልጊዜ የአገልግሎት ጊዜያቸው ያልፋል፣ ሊሻሩ ይችላሉ፣ እንዲሁም ባለቤቱ ሲሰናከል ወይም ግዛቱን ሲያጣ ውድቅ ይደረጋሉ።
- **ኦዲት።** `plugin_mcp_audit` የጥያቄ መለያ፣ የቶከን መለያ፣ የተጠቃሚ መለያ፣ ችሎታ፣ ውጤት (`started`፣ `succeeded`፣ `failed`፣ `denied`፣ `rejected`) እና የጊዜ ማህተሞችን ይመዘግባል። አርጉመንቶችን፣ ውጤቶችን ወይም የቶከን እሴቶችን በፍጹም አይመዘግብም። አንድ ችሎታ የሚሰራው የ`started` ረድፉ ከተጻፈ በኋላ ብቻ ነው፤ የኦዲት ሰንጠረዡ የማይገኝ ከሆነ ጥሪው በ`UNAVAILABLE` ይወድቃል እና አይሰራም። ከመሰራቱ በፊት ውድቅ የተደረገ ጥሪ አንድ ረድፍ ነው፦ ለማይታወቅ፣ ለተደበቀ ወይም ላልተፈቀደ ችሎታ `denied`፣ ስኪማውን ላላሟሉ አርጉመንቶች ደግሞ `rejected`። ከኮንሶል፣ ከMy MCP Tokens እና ከCLI የሚደረግ የቶከን ፈጠራ እና መሻር እንደ `mcp-token-create` እና `mcp-token-revoke` ከ`succeeded` ውጤት ጋር ይመዘገባሉ፤ መሻር የሚመዘገበውም ንቁ ለነበረ ቶከን ብቻ ነው። ማግኛ እና `arguments` የJSON ነገር ያልሆነበት ጥሪ አይመዘገቡም።
- **የብልሽት መዝገብ።** ያልተጠበቀ ብልሽት፣ `INVALID_RESULT` ወይም የማይገኝ የኦዲት ሰንጠረዥ በ`MCP` መገልገያ ወደ Cacti መዝገብ አንድ መስመር ይጽፋል፦ የችሎታ መለያውን፣ የተወሰነ ምክንያት እና የስህተት ክፍሉን። መልዕክቶች፣ አርጉመንቶች እና ቶከኖች በፍጹም አይመዘገቡም።
- **ዋና poller ብቻ።** ሁለቱም መጨረሻ ነጥቦች፣ ሁለቱም የኮንሶል ገጾች እና `tokens.php` ከዚህ ውጭ ሌላ ቦታ ለመስራት ፈቃደኛ አይሆኑም።

## የሕይወት ዑደት

ፕለጊኑን ማሰናከል ሁለቱንም መጨረሻ ነጥቦች ያግዳል። ፕለጊኑን ማራገፍ እያንዳንዱን ቶከን ይሽራል እንዲሁም ሶስቱን ሰንጠረዦች (`plugin_mcp_token`፣ `plugin_mcp_audit`፣ `plugin_mcp_ability`) ለመረጃ ማቆያነት ያስቀራል፤ እንደገና መጫን የተሻረ ቶከንን መልሶ አያነቃም። ሰንጠረዦቹን ከCacti ዳታቤዝ ጋር ምትኬ ያስቀምጡ እና ከፕለጊኑ ውጭ የኦዲት ማቆያ ፖሊሲን ይተግብሩ።

## ልማት እና ሙከራዎች

ሙከራዎች ያለ Cacti የሚሰሩ ቀላል የPHP ስክሪፕቶች ናቸው፦

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI የPHP ሊንት ያደርጋል እንዲሁም በ`tests/` ውስጥ ያሉትን ስክሪፕቶች (እያንዳንዱ በ`.github/workflows/ci.yml` ውስጥ ተዘርዝሯል) ከPHP 8.2 እስከ 8.5 ባሉት ላይ ያስኬዳል፤ ከዚያም የሚጫነውን የ`mcp/` ማህደር እና የቼክሰም ማረጋገጫውን ይገነባል። Cactiን የሚነኩ ሙከራዎች በCacti አጋዥ ወሰን ላይ ቋሚ መረጃዎችን ይጠቀማሉ፤ ሙሉ የCacti ጭነትን አይፈትሹም።

### የውህደት ሙከራዎች

`tests/integration/run.sh 1.2.31` ወይም `tests/integration/run.sh develop` ፕለጊኑን በኮንቴይነሮች ውስጥ ወዳለ እውነተኛ Cacti ይጭናል እና በላዩ ላይ ቀጥታ ፍተሻዎችን ያካሂዳል። ከCompose v2.23.1 ወይም ከዚያ በላይ ጋር Docker፣ git እና openssl ያስፈልገዋል። `KEEP=1` ለማረም ስታኩን እየሰራ እንዲቆይ ያደርገዋል። CI በየምሽቱ እና በጥያቄ ላይ ያስኬደዋል እንጂ በፑል ሪኩዌስቶች ላይ አያስኬደውም።

## አካባቢያዊ ማድረግ

Cacti MCP የተጠናቀሩ የGNU gettext ካታሎጎችን በ`locales/po/` እና በ`locales/LC_MESSAGES/` ስር፣ እንዲሁም የ`mcp` የጽሑፍ ጎራ (`locales/po/mcp.pot`) በመጠቀም ለእንግሊዝኛ እና ለ47 አካባቢያዊ ቋንቋዎች (19 ሰፊ ደረጃ 1፣ 15 አፍሪካዊ፣ 10 እስያዊ፣ እንዲሁም ቦስኒያዊ፣ ክሮኤሺያዊ እና ሰርቢያዊ አካባቢያዊ ቋንቋዎች) የተተረጎሙ READMEዎችን በ`docs/i18n/` ስር ያቀርባል። የቋንቋ ድጋፍ ሲነቃ Cacti ተዛማጁን ካታሎግ በራስ-ሰር ይጭናል።

## አስተዋጽኦ ማበርከት

ፑል ሪኩዌስቶች ወደ `develop` ይሄዳሉ። የምርት ኮድ ከPHP 8.2 ጋር ተኳሃኝ እንዲሆን ያድርጉ እና የCactiን ዘይቤ ይጠቀሙ፦ ትሮች፣ ነጠላ-ጥቅስ ሕብረቁምፊዎች እና የCacti ዳታቤዝ እና የፈቃድ አጋዦች። ለተለወጠ ማረጋገጫ፣ ፈቃድ ወይም የፕሮቶኮል ባህሪ ሙከራዎችን ያክሉ፣ እና ኮሚቶችን በ`git commit -s` ይፈርሙ። በHTTP API ላይ የሚደረጉ ለውጦችን ከ[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ጋር ያቀናጁ።

## ፈቃድ

የቅጂ መብት (C) 2026 Thomas Vincent። በGNU General Public License ሥሪት 2 ወይም ከዚያ በላይ ስር የተለቀቀ። [LICENSE](../../../LICENSE)ን ይመልከቱ።
