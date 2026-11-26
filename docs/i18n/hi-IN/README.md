<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ढाल के साथ एक कैक्टस। खोजें। अधिकृत करें। निष्पादित करें।">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="लाइसेंस: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP एक Cacti प्लगइन है जो AI क्लाइंट को abilities कहे जाने वाले नामित, अनुमति-फ़िल्टर किए गए ऑपरेशनों के माध्यम से आपका Cacti डेटा पढ़ने देता है। यह उन्हें प्लगइन से ही दो तरीकों से उपलब्ध कराता है: एक MCP एंडपॉइंट (`mcp.php`, Streamable HTTP) और एक AIP-शैली का HTTP API (`api.php`)। प्राधिकरण और निष्पादन का नियंत्रण Cacti के पास ही रहता है। क्लाइंट कभी भी डेटाबेस से सीधे क्वेरी नहीं करता; यह केवल उसी ability को कॉल कर सकता है जिसे किसी प्रशासक ने उजागर (expose) किया हो और जिसकी अनुमति टोकन स्वामी के Cacti realms देते हों।

प्लगइन लेखक `abilities_register` हुक के माध्यम से अपनी स्वयं की केवल-पठन (read-only) abilities पंजीकृत कर सकते हैं, और वे बिना किसी प्रोटोकॉल कोड के MCP क्लाइंट को टूल्स के रूप में दिखाई देती हैं।

**स्थिति: प्री-रिलीज़, संस्करण 0.1.0।** अभी कोई टैग की गई रिलीज़ नहीं है।

आज उपलब्ध सुविधाएँ:

- सिस्टम संस्करणों और डिवाइस इन्वेंट्री के लिए केवल-पठन अंतर्निहित (built-in) abilities।
- एकमात्र क्रेडेंशियल के रूप में व्यक्तिगत एक्सेस टोकन (`cmcp_pat_...`)।
- Management > MCP कंसोल: abilities को उजागर करें या छिपाएं, टोकन बनाएं और निरस्त करें, ऑडिट लॉग पढ़ें।
- Management > My MCP Tokens: उपयोगकर्ता अपने स्वयं के टोकन प्रबंधित करते हैं, अपनी गतिविधि देखते हैं, और यह देखते हैं कि उनके टोकन किन टूल्स का उपयोग कर सकते हैं।
- Streamable HTTP पर MCP, प्रोटोकॉल संशोधन `2026-07-28` और `2025-11-25`, केवल टूल्स।

अभी उपलब्ध नहीं है:

- OAuth 2.1 साइन-इन। जो होस्टेड कनेक्टर व्यक्तिगत टोकन नहीं भेज सकते, जैसे ChatGPT और claude.ai कस्टम कनेक्टर, वे इसके उपलब्ध होने तक कनेक्ट नहीं हो सकते। इसकी योजना प्लान 2 के रूप में बनाई गई है; वह प्लान अभी लिखा नहीं गया है।
- राइट (write) abilities। केवल-पठन (read-only) abilities ही पंजीकृत की जा सकती हैं।

डिज़ाइन [एंडपॉइंट डिज़ाइन विनिर्देश](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md) में है, और बिल्ड अनुक्रम [docs/plan.md](../../plan.md) में है।

## अंतर्निहित abilities

| ID | तर्क (Arguments) | आवश्यक Cacti realm |
| --- | --- | --- |
| `cacti-get-system-info` | कोई नहीं | 15 |
| `cacti-list-devices` | वैकल्पिक `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | आवश्यक `name`, जैसे `devices/12` | 3 |

प्रत्येक कॉल के लिए टोकन स्वामी के पास **MCP and Abilities API** realm, `abilities:read` स्कोप (यह प्रत्येक व्यक्तिगत टोकन में होता है), और एक उजागर (exposed) की गई ability भी होनी आवश्यक है। कंसोल का Abilities टैब दिखाता है कि प्रत्येक अंतर्निहित ability के लिए किस realm की आवश्यकता है।

- `cacti-list-devices` अधिकतम 100 डिवाइस (डिफ़ॉल्ट 50) वाले पेज और एक `nextPageToken` लौटाता है। एक पेज टोकन केवल उसी `filter` और `orderBy` के लिए मान्य होता है। `filter` एक AIP-160 अभिव्यक्ति है जिसमें तुलनाएं `AND` से जुड़ी होती हैं, उदाहरण के लिए `state = "DOWN" AND disabled = false`। फ़िल्टर फ़ील्ड हैं: `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, और `state`। `orderBy` में `displayName`, `hostname`, या `name` लिया जाता है, जिनमें से प्रत्येक के बाद वैकल्पिक रूप से `desc` हो सकता है।
- डिवाइस क्वेरी Cacti के `get_allowed_devices()` से होकर गुजरती हैं, इसलिए एक उपयोगकर्ता को केवल वही डिवाइस दिखाई देते हैं जो Cacti उसे दिखाएगा।
- डिवाइस फ़ील्ड में SNMP कम्युनिटी स्ट्रिंग्स, पासफ़्रेज़ और अन्य क्रेडेंशियल शामिल नहीं होते हैं।

## इंस्टॉल करें

इसके लिए Cacti 1.2.31 या उसके बाद का संस्करण, PHP 8.2 या उसके बाद का संस्करण, और मुख्य पोलर (main poller) आवश्यक है। Cacti प्रमाणीकरण सक्षम होना चाहिए; जब यह बंद होता है तो प्लगइन प्रमाणित करने से मना कर देता है।

प्लगइन डायरेक्टरी का नाम `mcp` होना चाहिए, `plugin_mcp` नहीं। प्लगइन स्लग, realm नाम, अनुवाद डोमेन और URL सभी `mcp` का उपयोग करते हैं।

सोर्स चेकआउट से:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

जब तक टैग की गई रिलीज़ उपलब्ध न हों, तब तक आप इसके बजाय किसी सफल [CI रन](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) से `mcp-plugin` आर्टिफैक्ट डाउनलोड कर सकते हैं। इसमें `mcp.tar.gz` और `SHA256SUMS` शामिल हैं। चेकसम सत्यापित करें, फिर Cacti की `plugins/` डायरेक्टरी के अंदर `mcp.tar.gz` को एक्सट्रैक्ट करें ताकि परिणाम `plugins/mcp/` हो। GitHub के स्वचालित सोर्स आर्काइव एक अलग शीर्ष-स्तरीय डायरेक्टरी नाम का उपयोग करते हैं। यह आर्काइव `docs/` (नीचे दिए गए स्क्रीनशॉट सहित), `tests/`, और `.github/` को छोड़ देता है, इसलिए `docs/` में जाने वाले README लिंक GitHub पर काम करते हैं लेकिन इंस्टॉल की गई कॉपी में नहीं।

इसके बाद:

1. Plugin Management में, **Cacti MCP** को इंस्टॉल और सक्षम करें। इंस्टॉल करने वाले प्रशासक को **MCP Administration** realm स्वतः प्राप्त हो जाता है।
2. Settings > MCP के अंतर्गत, **Public Cacti URL** को उस पते पर सेट करें जिसका उपयोग क्लाइंट करते हैं, उदाहरण के लिए `https://cacti.example.com/cacti`। `localhost`, `127.0.0.1`, और `[::1]` को छोड़कर HTTPS आवश्यक है। जब तक यह सेट नहीं किया जाता, `mcp.php` एक JSON-RPC त्रुटि के साथ HTTP 400 उत्तर देता है जिसका `data` मान `FAILED_PRECONDITION` और `PUBLIC_URL_REQUIRED` होता है। `api.php` इसे नहीं पढ़ता है।

   ![Public Cacti URL फ़ील्ड दिखाते हुए Settings > MCP](../../images/settings-public-url.png)

3. प्रत्येक उस उपयोगकर्ता को **MCP and Abilities API** realm प्रदान करें जो टोकन का स्वामी होगा। किसी भी उपयोगकर्ता को यह स्वतः प्राप्त नहीं होता है।
4. सुनिश्चित करें कि वेब सर्वर `Authorization` हेडर और path info को PHP तक पास करता है (नीचे देखें)।
5. Management > MCP खोलें और उन abilities को उजागर करें जिन्हें आप चाहते हैं कि क्लाइंट देखें।

**डेवलपमेंट बिल्ड से अपग्रेड करना।** प्लगइन प्री-रिलीज़ है, और विकास के दौरान इसकी तालिकाएं बिना माइग्रेशन के बदल गई हैं। यदि आपने कोई पिछला बिल्ड इंस्टॉल किया था, तो उसे अनइंस्टॉल करें और फिर से इंस्टॉल करें। पुनः इंस्टॉल करने पर पहले से मौजूद तालिकाएं बनी रहती हैं, इसलिए पहले पुरानी `plugin_mcp_token`, `plugin_mcp_audit`, और `plugin_mcp_ability` तालिकाओं को हटा (drop) दें (और नाम बदलने से पहले बनाए गए बिल्ड की समकक्ष तालिकाओं को भी)। यदि आपको उनके इतिहास की आवश्यकता है तो उनका बैकअप लें; उन बिल्ड के टोकन अनइंस्टॉल करने पर निरस्त हो जाते हैं और आगे नहीं बढ़ते हैं।

### वेब सर्वर

ऐसे Apache सेटअप जो PHP से पहले `Authorization` को हटा देते हैं, उन्हें संबंधित वर्चुअल होस्ट या डायरेक्टरी में इसकी आवश्यकता होती है, जिसके बाद रीलोड करना होता है:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` के साथ Apache ने बिना किसी अतिरिक्त पथ कॉन्फ़िगरेशन के `api.php` रूट्स को सर्व किया।

`api.php` रूट्स स्क्रिप्ट नाम के बाद के पथ में रहते हैं (`/plugins/mcp/api.php/v1/abilities`), इसलिए nginx को उन URI से मिलान करना चाहिए जहाँ `.php` के बाद और पथ आता है, path info को अलग करना चाहिए, और इसे PHP को पास करना चाहिए। एक `location ~ \.php$` ब्लॉक कभी भी इन URL से मेल नहीं खाता; nginx अपने स्वयं के HTML 404 के साथ उत्तर देता है। नीचे दिए गए location पैटर्न और दो path-info पंक्तियों को PHP-FPM के साथ सत्यापित किया गया था; अन्य पंक्तियाँ मानक बॉयलरप्लेट हैं:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Cacti को पहले से सर्व करने वाले ब्लॉक से मिलान करने के लिए `include` और `fastcgi_pass` पंक्तियों को समायोजित करें। इस ब्लॉक में `try_files $fastcgi_script_name =404;` न जोड़ें: यह `$fastcgi_path_info` को साफ़ कर देता है, और तब `api.php` उत्तर में 404 `UNKNOWN_PATH` देता है। यदि आपके कॉन्फ़िगरेशन को `try_files` की आवश्यकता है, तो पहले `set $path_info $fastcgi_path_info;` के साथ मान सहेजें और `fastcgi_param PATH_INFO $path_info;` पास करें।

`mcp.php` में कोई पथ रूट्स नहीं हैं और उसे इनकी आवश्यकता नहीं है।

## कंसोल

Management > MCP में तीन टैब हैं। आपको **MCP Administration** realm की आवश्यकता है। यहाँ और नीचे दिए गए स्क्रीनशॉट उदाहरण डेटा वाले Cacti डेवलपमेंट बिल्ड से हैं।

- **Abilities** प्रत्येक पंजीकृत ability को उसके प्लगइन, श्रेणी, आवश्यक realm और इस बात के साथ सूचीबद्ध करता है कि वह उजागर है या नहीं। पंक्तियाँ चुनें और Expose या Hide चुनें; परिवर्तन लागू होने से पहले आप पुष्टि करते हैं। अंतर्निहित `cacti-*` abilities डिफ़ॉल्ट रूप से उजागर होती हैं। अन्य प्लगइन्स की abilities छिपी हुई शुरू होती हैं, इसलिए किसी प्लगइन को इंस्टॉल करने से तब तक कुछ भी प्रकाशित नहीं होता जब तक कोई प्रशासक निर्णय न ले। उजागर करना केवल पहुँच को सीमित करता है: उपयोगकर्ता को अभी भी ability के realm की आवश्यकता होती है।

  ![अपने realms और उजागर स्थिति के साथ अंतर्निहित abilities को सूचीबद्ध करता हुआ Abilities टैब](../../images/console-abilities.png)
- **Tokens** टोकन को स्वामी, निर्माता, निर्माण समय, समाप्ति, अंतिम उपयोग और स्थिति (Active, Expired, Revoked) के साथ सूचीबद्ध करता है। पंक्तियाँ चुनें और उन्हें निरस्त करने के लिए Revoke चुनें। निरस्त किए गए टोकन का दोबारा उपयोग नहीं किया जा सकता। Create Token एक नया टोकन बनाता है।

  ![Create Token फ़ॉर्म के ऊपर स्वामी, समाप्ति, अंतिम उपयोग और स्थिति के साथ टोकन सूचीबद्ध करता हुआ Tokens टैब](../../images/console-tokens.png)
- **Audit** ऑडिट पंक्तियों को नवीनतम पहले के क्रम में सूचीबद्ध करता है, और उपयोगकर्ता, ability तथा परिणाम के अनुसार फ़िल्टर करता है।

  ![फ़िल्टर के साथ उपयोगकर्ता, टोकन, ability और परिणाम सहित कॉल सूचीबद्ध करता हुआ Audit टैब](../../images/console-audit.png)

## टोकन

एक व्यक्तिगत टोकन अपने स्वामी के रूप में Cacti को पढ़ता है। इसका रूप `cmcp_pat_` के बाद 64 लोअरकेस हेक्स वर्ण होता है और इसमें एकमात्र स्कोप `abilities:read` होता है। यह क्या देख सकता है इसका निर्णय टोकन के बजाय इसके स्वामी के Cacti realms और डिवाइस अनुमतियों द्वारा किया जाता है। स्वामी एक सक्षम उपयोगकर्ता होना चाहिए जिसके पास **MCP and Abilities API** realm हो।

टोकन हमेशा किसी उपयोगकर्ता के लिए बनाए जाते हैं, समाप्त होते हैं, और निरस्त किए जा सकते हैं:

- **Console.** Management > MCP > Tokens > Create Token। जीवनकाल 1 से 365 दिन का होता है और डिफ़ॉल्ट 90 दिन है। टोकन सर्वर द्वारा जनरेट किया जाता है और रिस्पॉन्स पेज पर एक बार दिखाया जाता है, इसलिए इसे तुरंत अपने सीक्रेट मैनेजर में कॉपी करें। आप अपने लिए एक टोकन बना सकते हैं। किसी अन्य उपयोगकर्ता के लिए टोकन बनाने के लिए Users/Groups realm की भी आवश्यकता होती है, क्योंकि टोकन उस उपयोगकर्ता के रूप में Cacti को पढ़ता है।
- **My MCP Tokens.** MCP and Abilities API realm वाला कोई भी उपयोगकर्ता अपने स्वयं के टोकन प्रबंधित कर सकता है; नीचे देखें।
- **Command line.** `tokens.php` केवल CLI से चलता है, ऐसे OS खाते के रूप में जो Cacti को प्रशासित कर सकता है। यह एनवायरनमेंट से टोकन लेता है ताकि मान कभी भी कमांड लाइन या प्रोसेस सूची में दिखाई न दे। जीवनकाल 1 से 365 दिन का होता है और डिफ़ॉल्ट 30 दिन है। CLI के माध्यम से टोकन बनाने और निरस्त करने का ऑडिट कंसोल की तरह ही किया जाता है, जिसमें टोकन के स्वामी को कर्ता (actor) के रूप में दर्ज किया जाता है क्योंकि CLI में कोई Cacti उपयोगकर्ता नहीं होता है, इसलिए ऑडिट पंक्ति कार्रवाई को CLI से आने वाले के रूप में चिह्नित नहीं करती है। `--list` प्रत्येक टोकन को JSON (ID, स्वामी, स्कोप, टाइमस्टैम्प, निरस्त फ़्लैग) के रूप में प्रिंट करता है और टोकन मान कभी प्रिंट नहीं करता; `--help` उपयोग दिखाता है।

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

कंसोल, कमांड लाइन, या My MCP Tokens से गेस्ट खाते के लिए, अक्षम उपयोगकर्ताओं के लिए, या **MCP and Abilities API** realm के बिना वाले उपयोगकर्ताओं के लिए टोकन नहीं बनाए जा सकते। Cacti गेस्ट सेटिंग को उपयोगकर्ता नाम या उपयोगकर्ता ID के रूप में संग्रहीत करता है, और प्लगइन दोनों को हल करता है। कोई टोकन जिसका स्वामी गेस्ट खाता बन जाता है, अपने अगले अनुरोध पर काम करना बंद कर देता है।

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) को किसी प्रशासन realm की आवश्यकता नहीं है: यह **MCP and Abilities API** realm द्वारा कवर किया जाता है, और मेनू प्रविष्टि केवल उन उपयोगकर्ताओं के लिए दिखाई देती है जिनके पास यह realm है। यह पेज हमेशा साइन-इन किए गए उपयोगकर्ता पर कार्य करता है। Cacti का मेनू कंसोल का हिस्सा है, इसलिए कंसोल एक्सेस के बिना उपयोगकर्ता इसके पते के माध्यम से पेज तक पहुँचता है।

![साइन-इन किए गए उपयोगकर्ता के टोकन और क्रिएट फ़ॉर्म को सूचीबद्ध करता हुआ My Tokens टैब](../../images/my-tokens.png)

- **Tokens** आपके टोकन सूचीबद्ध करता है, एक नया बनाता है (1 से 365 दिन, डिफ़ॉल्ट 90, रिस्पॉन्स में एक बार दिखाया जाता है), और आपके स्वयं के टोकन को निरस्त करता है। आप किसी और का टोकन देख या निरस्त नहीं कर सकते।
- **Activity** आपके द्वारा किए गए कार्यों को नवीनतम पहले के क्रम में सूचीबद्ध करता है: आपके टोकन से किए गए कॉल और आपके द्वारा किए गए टोकन परिवर्तन।
- **Available Tools** उन abilities को सूचीबद्ध करता है जिनका उपयोग आपका कोई टोकन अभी कर सकता है, प्रत्येक ability की ID, नाम और विवरण के साथ। यह आपकी Cacti अनुमतियों और किसी प्रशासक द्वारा चुनी गई उजागर (exposure) सेटिंग्स का पालन करता है।

  ![प्रत्येक ability की ID, नाम और विवरण दिखाती हुई Available Tools सूची](../../images/my-tools.png)

इस पेज के अस्तित्व में आने से पहले किए गए इंस्टॉलेशन में `mcp_tokens.php` के बिना एक realm फ़ाइल सूची होती है। इंस्टॉल करने से सूची पंजीकृत होती है; प्लगइन को सक्षम या अक्षम करने से यह अपडेट नहीं होती है। प्लगइन को अनइंस्टॉल करें और फिर से इंस्टॉल करें, फिर फिर से realms प्रदान करें, क्योंकि प्लगइन को अनइंस्टॉल करने पर Cacti realm अनुदान हटा देता है।

डेटाबेस टोकन का केवल SHA-256 हैश संग्रहीत करता है, इसलिए खोया हुआ टोकन पुनर्प्राप्त नहीं किया जा सकता; इसे निरस्त करें और दूसरा बनाएं। रोटेशन भी ऐसा ही है: एक नया टोकन बनाएं, क्लाइंट को स्विच करें, फिर पुराने वाले को निरस्त करें। एक समाप्त टोकन, एक निरस्त टोकन, एक अक्षम स्वामी, या एक खोया हुआ realm प्रत्येक अगले अनुरोध पर विफल हो जाता है। टोकन केवल `Authorization: Bearer` हेडर में स्वीकार किए जाते हैं; क्वेरी स्ट्रिंग या बॉडी में टोकन स्वीकार नहीं किया जाता है।

## क्लाइंट कनेक्ट करें

`Authorization: Bearer` हेडर में टोकन के साथ MCP एंडपॉइंट `https://cacti.example.com/cacti/plugins/mcp/mcp.php` का उपयोग करें। टोकन को किसी एनवायरनमेंट वेरिएबल या सीक्रेट मैनेजर में रखें और फ़ाइल में उसका मान लिखने के बजाय क्लाइंट कॉन्फ़िगरेशन से उसका संदर्भ लें।

### Claude Code

एंडपॉइंट को प्रोजेक्ट `.mcp.json` में रखें जो टोकन को नाम से संदर्भित करता है। Claude Code `url` और `headers` में `${VAR}` को विस्तारित करता है, इसलिए फ़ाइल में कोई सीक्रेट नहीं होता है और इसे कमिट करना सुरक्षित है। Claude Code शुरू करने वाले एनवायरनमेंट में `CACTI_MCP_TOKEN` को एक्सपोर्ट करें।

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

आप इसे कमांड लाइन से भी जोड़ सकते हैं:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

डबल कोट्स के साथ, आपका शेल पहले `$CACTI_MCP_TOKEN` को विस्तारित करता है, इसलिए चुने गए `--scope` (`local`, `user`, या `project`; डिफ़ॉल्ट `local`) के लिए कॉन्फ़िग फ़ाइल में टोकन का मान लिख दिया जाता है। `--scope project` के साथ इस रूप का उपयोग न करें, और फ़ाइल को वर्ज़न कंट्रोल से बाहर रखें। ऊपर दिए गए `.mcp.json` संदर्भ को प्राथमिकता दें। Claude Code रिमोट `url` और `headers` में कुछ क्रेडेंशियल वेरिएबल्स (जैसे `ANTHROPIC_AUTH_TOKEN`) को खाली पढ़ता है; `CACTI_MCP_TOKEN` उनमें से नहीं है। स्रोत: [Claude Code MCP दस्तावेज़ीकरण](https://code.claude.com/docs/en/mcp)।

### VS Code में GitHub Copilot

वर्कस्पेस-रूट `.mcp.json` (या उपयोगकर्ता फ़ाइल `~/.copilot/mcp-config.json`) का उपयोग करें। ये Copilot-नेटिव फ़ाइलें हेडर मानों में टॉप-लेवल `mcpServers` ऑब्जेक्ट और `${NAME}` एनवायरनमेंट-वेरिएबल संदर्भों का उपयोग करती हैं:

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

VS Code शुरू करने वाले एनवायरनमेंट में `CACTI_MCP_TOKEN` को एक्सपोर्ट करें। नेटिव Copilot फ़ाइलें `inputs` प्रॉम्प्ट का समर्थन नहीं करती हैं। VS Code का गाइडेड सेटअप `${...}` मानों को अस्वीकार कर देता है, इसलिए गाइडेड फ़्लो के बजाय फ़ाइल को संपादित करके `Authorization` हेडर जोड़ें। गाइडेड सेटअप वर्कस्पेस-रूट फ़ाइल तभी प्रदान करता है जब प्रयोगात्मक `chat.mcp.workspaceRootConfig.enabled` सेटिंग चालू हो। [VS Code MCP कॉन्फ़िगरेशन संदर्भ](https://code.visualstudio.com/docs/agents/reference/mcp-configuration) देखें।

**लीगेसी: `.vscode/mcp.json`।** VS Code के अनुसार नए Copilot कॉन्फ़िगरेशन में `.vscode/mcp.json` या प्रोफ़ाइल `mcp.json` का उपयोग नहीं किया जाना चाहिए; वे डेप्रिकेटेड Local हार्नेस से संबंधित हैं, जिसे फ़रवरी 2027 में हटा दिया जाएगा। यदि आप अभी भी इसका उपयोग करते हैं, तो एडिटर-प्रबंधित फ़ॉर्मैट एक टॉप-लेवल `servers` कुंजी लेता है और टोकन के लिए प्रॉम्प्ट कर सकता है:

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

### ऐसे क्लाइंट जो केवल stdio का उपयोग करते हैं

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) एक वैकल्पिक एडेप्टर है जो स्थानीय stdio MCP सर्वर के रूप में चलता है और प्लगइन के HTTP API को कॉल करता है। इसका उपयोग ऐसे क्लाइंट के लिए करें जो रिमोट HTTP सर्वर से कनेक्ट नहीं हो सकता। इसे उसी व्यक्तिगत टोकन की आवश्यकता होती है और यह `api.php` से संवाद करता है।

### MCP व्यवहार

एंडपॉइंट केवल टूल्स प्रदान करता है: प्रत्येक एक्सपोज़्ड, अनुमत क्षमता अपनी ID के नाम वाला एक टूल है, जिसमें इसके इनपुट और आउटपुट स्कीमा और रीड-ओनली एनोटेशन (`openWorldHint` का मान `false` है) होते हैं। यह `initialize`, `server/discover`, `ping`, `tools/list`, और `tools/call` को संभालता है। यह कोई सेशन नहीं रखता, `Mcp-Session-Id` नहीं भेजता (और प्राप्त होने वाले किसी भी हेडर को अनदेखा करता है), और JSON-RPC बैच स्वीकार नहीं करता। बिना `id` वाला संदेश एक नोटिफ़िकेशन है और उसे बिना किसी बॉडी के HTTP 202 मिलता है। केवल `POST` की अनुमति है।

- **रिवीज़न।** `params._meta` में `io.modelcontextprotocol/protocolVersion` ले जाने वाले अनुरोध में `2026-07-28` नामित होना आवश्यक है; किसी भी अन्य मान पर त्रुटि `-32022` मिलती है। ऐसे अनुरोधों में मेल खाने वाले `Mcp-Protocol-Version`, `Mcp-Method`, और (`tools/call` के लिए) `Mcp-Name` हेडर भी होने चाहिए, अन्यथा उत्तर में त्रुटि `-32020` मिलती है। अन्य अनुरोधों को `2025-11-25` के रूप में माना जाता है: `initialize` उस रिवीज़न के साथ उत्तर देता है, और किसी भी अन्य मेथड पर `Mcp-Protocol-Version` हेडर, यदि भेजा गया हो, तो वह `2025-11-25`, `2025-06-18`, या `2025-03-26` होना चाहिए।
- **टूल त्रुटियाँ।** कोई क्षमता त्रुटि, जिसमें स्कीमा से मेल न खाने वाले तर्क या ऐसा `arguments` मान शामिल है जो JSON ऑब्जेक्ट नहीं है, प्रोटोकॉल त्रुटि के बजाय `isError: true` और `structuredContent` में AIP-193 त्रुटि के साथ टूल परिणाम के रूप में वापस आती है।
- **प्रोटोकॉल त्रुटियाँ।** वे विफलताएँ जो टूल त्रुटियाँ नहीं हैं, JSON-RPC त्रुटि ऑब्जेक्ट होती हैं (`data` में स्थिति और कारण के साथ कोड `-32000`, या मानक कोड): अनुपस्थित Public Cacti URL, अस्वीकृत `Origin`, प्लगइन अक्षम होने पर या रिमोट पोलर पर किया गया अनुरोध, और अप्रत्याशित सर्वर त्रुटियाँ (`-32603`, जिसका विवरण प्रतिक्रिया के बजाय Cacti लॉग में लिखा जाता है)। पहले चलने वाली अनुरोध जाँचें (405, 413, 415) और प्रमाणीकरण विफलताएँ (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) HTTP API के अंतर्गत वर्णित AIP-193 बॉडी को बनाए रखती हैं।

## HTTP API

आधार URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`। कॉन्ट्रैक्ट [openapi.json](../../../openapi.json) में है।

| मेथड और पाथ | उद्देश्य |
| --- | --- |
| `GET /v1/abilities` | अनुमत क्षमताओं को सूचीबद्ध करें। क्वेरी: `pageSize`, `pageToken`, और `category = "inventory"` के रूप में `filter`। |
| `GET /v1/abilities/{id}` | एक क्षमता पढ़ें। |
| `POST /v1/abilities/{id}:execute` | इसे चलाएँ। बॉडी ठीक `{"arguments": {...}}` है। प्रतिक्रिया `{"requestId": "...", "result": {...}}` है। |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

त्रुटियाँ AIP-193 का पालन करती हैं: `code`, `message`, `status`, और `details` के साथ एक `error` ऑब्जेक्ट, जिसमें डोमेन `cacti.net` और एक स्थिर `reason` के साथ `ErrorInfo` होता है। तर्क संबंधी समस्याएँ फ़ील्ड का नाम देते हुए एक `BadRequest` विवरण जोड़ती हैं। अनुरोध बॉडी 64 KB तक और परिणाम 1 MB तक सीमित हैं। दोनों एंडपॉइंट केवल मुख्य पोलर पर उत्तर देते हैं और जब प्लगइन अक्षम होता है या सर्वर मुख्य पोलर नहीं होता है, तो `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) लौटाते हैं।

| HTTP | `reason` मान |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer` भी भेजता है) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` भेजता है) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## क्षमता लिखें (प्लगइन लेखक)

एक सक्षम Cacti प्लगइन उस फ़ंक्शन से क्षमताओं को पंजीकृत करता है जिसे वह `abilities_register` हुक से जोड़ता है, जो आमतौर पर इसके `plugin_<slug>_install()` में होता है:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

फ़ंक्शन को प्लगइन तक सीमित एक `AbilitiesRegistrar` प्राप्त होता है। इसके रिटर्न मान को अनदेखा कर दिया जाता है।

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

नियम, जो सभी पंजीकरण के समय लागू किए जाते हैं:

- **ID।** एक ID `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` से मेल खाती है, अधिकतम 64 वर्णों की होती है, और इसे प्लगइन के स्लग और एक हाइफ़न से शुरू होना चाहिए: जैसे ऊपर `acme-`। स्लग प्लगइन डायरेक्टरी का नाम होता है, इसलिए `my_plugin` जैसी डायरेक्टरी कुछ भी पंजीकृत नहीं कर सकती। `cacti` नाम की प्लगइन डायरेक्टरी को अस्वीकार कर दिया जाता है; वह नेमस्पेस बिल्ट-इन क्षमताओं का है।
- **परिभाषा।** ठीक ये कुंजियाँ: `label`, `description` (4096 बाइट्स तक), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`। श्रेणी पहले से मौजूद होनी चाहिए: किसी बिल्ट-इन (`inventory`, `system`) का उपयोग करें या `registerCategory()` के साथ अपनी स्वयं की श्रेणी पंजीकृत करें, जिसकी ID सभी प्लगइन्स में अद्वितीय हो और `^[a-z][a-z0-9-]{0,31}$` से मेल खाती हो।
- **केवल रीड-ओनली।** `annotations` ठीक `readOnly: true`, `destructive: false`, `idempotent: true` होना चाहिए। कोई भी अन्य मान अपवाद (थ्रो) उत्पन्न करता है।
- **स्कीमा।** `input_schema` और `output_schema` प्रत्येक में टॉप-लेवल `type` `object` होना चाहिए। यह डायलेक्ट छोटा है और फ़ेल-क्लोज़्ड है। ऑब्जेक्ट बंद होने चाहिए (`additionalProperties: false`, जिसमें `properties` मौजूद हो); अन्य प्रकार `integer` और `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, और `array` (जिसमें `items` और `maxItems` की आवश्यकता होती है) हैं। किसी प्रकार को `['string', 'null']` के रूप में नलेबल बनाया जा सकता है। तर्क स्ट्रिंग डिफ़ॉल्ट रूप से अधिकतम 4096 वर्णों तक होती हैं; परिणाम स्ट्रिंग केवल घोषित `maxLength` और परिणाम आकार सीमा द्वारा सीमित होती हैं। अधिकतम 256 क्षमताएँ पंजीकृत की जा सकती हैं।
- **`permission(int $userId): bool`।** अनुमति देने के लिए ठीक `true` लौटाना आवश्यक है। उपयोगकर्ता ID टोकन स्वामी की होती है; सेशन स्थिति को कभी न पढ़ें।
- **`execute(int $userId, stdClass $args): array`।** `$args` पहले से ही `input_schema` के विरुद्ध सत्यापित होता है। ऑब्जेक्ट-स्तरीय अनुमतियाँ स्वयं लागू करें। एक ऐसा एसोसिएटिव एरे लौटाएँ जो `output_schema` से ठीक मेल खाता हो; एक सूची, एक अतिरिक्त फ़ील्ड, या 1 MB से अधिक JSON होने पर `INVALID_RESULT` त्रुटि हो जाती है। क्लाइंट-दृश्यमान विफलता, जैसे `NOT_FOUND`, के लिए `AbilitiesError` थ्रो करें।
- **खाली ऑब्जेक्ट।** PHP `[]` को JSON एरे के रूप में एन्कोड करता है। जहाँ भी आउटपुट स्कीमा किसी भी गहराई पर `object` घोषित करता है, रजिस्ट्री `[]` को खाली ऑब्जेक्ट मानती है और `{}` भेजती है; `new stdClass()` भी काम करता है। एक गैर-खाली सूची को कभी ऑब्जेक्ट नहीं माना जाता और वह `INVALID_RESULT` के साथ विफल हो जाती है। स्कीमा में एक खाली `properties` मैप `[]` या `new stdClass()` हो सकता है; दोनों को `{}` के रूप में प्रकाशित किया जाता है।
- **विफलता अलगाव।** प्रत्येक प्लगइन एक स्क्रैच कॉपी में पंजीकरण करता है जिसे केवल तभी रखा जाता है जब आपका फ़ंक्शन सामान्य रूप से लौटता है। यदि यह थ्रो करता है, तो आपकी कोई भी क्षमता पंजीकृत नहीं होती है, और विफलता लॉग कर दी जाती है।

प्लगइन्स की क्षमताएँ छिपी हुई स्थिति में शुरू होती हैं। व्यवस्थापक उन्हें कंसोल के Abilities टैब पर प्रदर्शित करता है, और उनके लिए Required Realm कॉलम में "Set by the plugin" लिखा होता है।

## सुरक्षा मॉडल

- **केवल Bearer।** `api.php` और `mcp.php` `Authorization` हेडर में केवल एक व्यक्तिगत टोकन स्वीकार करते हैं और कुछ नहीं। वे Cacti लोड होने से पहले कुकीज़, `$_POST`, और `$_REQUEST` को हटा देते हैं और Cacti द्वारा शुरू किए गए सत्र को नष्ट कर देते हैं, इसलिए ब्राउज़र लॉगिन से कभी भी API एक्सेस नहीं मिलता।
- **CSRF वैकल्पिक समाधान।** Cacti का CSRF गार्ड ऐसे JSON POST को अस्वीकार कर देता है जिसमें कोई Cacti CSRF टोकन नहीं होता, जिसे कोई भी MCP क्लाइंट नहीं भेज सकता। केवल इन दोनों एंडपॉइंट के लिए, प्लगइन Cacti लोड होने से पहले अनुरोध विधि का नाम बदल देता है और उसके बाद उसे पुनर्स्थापित कर देता है, ताकि गार्ड उन्हें छोड़ दे। यह सुरक्षित है क्योंकि CSRF उन अनुरोधों की सुरक्षा करता है जिन्हें ब्राउज़र कुकीज़ से प्रमाणित करता है, और ये एंडपॉइंट कोई कुकी पहचान स्वीकार नहीं करते: कोई क्रॉस-साइट पेज bearer टोकन संलग्न नहीं कर सकता। कंसोल पेजों पर पूर्ण CSRF सुरक्षा बनी रहती है। यह वैकल्पिक समाधान अस्थायी है, जब तक कि Cacti कोई समर्थित छूट प्रदान नहीं करता; देखें `lib/bootstrap.php`।
- **Origin जाँच।** `mcp.php` पर, यदि अनुरोध में `Origin` हेडर है, तो उसका स्कीम, होस्ट और पोर्ट Public Cacti URL के बिल्कुल समान होना चाहिए, अन्यथा अनुरोध को `ORIGIN_NOT_ALLOWED` के साथ अस्वीकार कर दिया जाता है। बिना `Origin` हेडर वाला अनुरोध, जो कि गैर-ब्राउज़र क्लाइंट के कनेक्ट करने का तरीका है, अनुमत है। यह किसी वेब पेज को विज़िटर के ब्राउज़र से एंडपॉइंट चलाने से रोकता है। `api.php` यह जाँच लागू नहीं करता।
- **केवल रीड-ओनली।** पंजीकरण किसी भी ऐसी क्षमता को अस्वीकार कर देता है जो रीड-ओनली, नॉन-डिस्ट्रक्टिव और इडेम्पोटेंट नहीं है।
- **एक्सपोज़र और रियल्म दोनों लागू होते हैं।** किसी क्षमता का एक्सपोज़्ड होना आवश्यक है और टोकन स्वामी के पास उसका रियल्म होना चाहिए। यदि एक्सपोज़र तालिका पढ़ी नहीं जा सकती है, तो डिफ़ॉल्ट पर वापस जाने के बजाय हर क्षमता को छिपा दिया जाता है।
- **छिपी हुई, अज्ञात और अननुमत क्षमताएँ एक जैसी दिखती हैं।** कोई क्लाइंट यह अंतर नहीं कर सकता कि कोई क्षमता मौजूद नहीं है, छिपी हुई है, या उसके उपयोगकर्ता को उसके उपयोग की अनुमति नहीं है: डिस्कवरी उसे छोड़ देती है और निष्पादन `NOT_FOUND` (`ABILITY_NOT_FOUND`) लौटाता है।
- **टोकन।** SHA-256 हैश के रूप में संग्रहीत, केवल एक बार दिखाए जाते हैं, हमेशा समाप्त होने वाले, निरस्त करने योग्य, और जब स्वामी अक्षम हो जाता है या रियल्म खो देता है तो अस्वीकार कर दिए जाते हैं।
- **ऑडिट।** `plugin_mcp_audit` अनुरोध ID, टोकन ID, उपयोगकर्ता ID, क्षमता, परिणाम (`started`, `succeeded`, `failed`, `denied`, `rejected`), और टाइमस्टैम्प रिकॉर्ड करता है। यह कभी भी आर्ग्युमेंट, परिणाम या टोकन मान रिकॉर्ड नहीं करता। कोई क्षमता केवल उसकी `started` पंक्ति लिखे जाने के बाद ही चलती है; यदि ऑडिट तालिका अनुपलब्ध है तो कॉल `UNAVAILABLE` के साथ विफल हो जाता है और चलता नहीं है। चलने से पहले अस्वीकार किया गया कॉल एक पंक्ति होता है: अज्ञात, छिपी हुई या अननुमत क्षमता के लिए `denied`, और स्कीमा में विफल होने वाले आर्ग्युमेंट के लिए `rejected`। कंसोल, My MCP Tokens और CLI से टोकन निर्माण और निरसन को `mcp-token-create` और `mcp-token-revoke` के रूप में `succeeded` परिणाम के साथ रिकॉर्ड किया जाता है, और निरसन केवल उसी टोकन के लिए रिकॉर्ड किया जाता है जो सक्रिय था। डिस्कवरी, और ऐसा कॉल जिसका `arguments` JSON ऑब्जेक्ट नहीं है, लॉग नहीं किए जाते।
- **विफलता लॉग।** कोई अप्रत्याशित विफलता, `INVALID_RESULT`, या अनुपलब्ध ऑडिट तालिका `MCP` सुविधा के साथ Cacti लॉग में एक पंक्ति लिखती है: क्षमता ID, एक निश्चित कारण, और अपवाद वर्ग। संदेश, आर्ग्युमेंट और टोकन कभी लॉग नहीं किए जाते।
- **केवल मुख्य पोलर।** दोनों एंडपॉइंट, दोनों कंसोल पेज और `tokens.php` कहीं और कार्य करने से इनकार करते हैं।

## जीवनचक्र

प्लगइन को अक्षम करने से दोनों एंडपॉइंट अवरुद्ध हो जाते हैं। अनइंस्टॉल करने से प्रत्येक टोकन निरस्त हो जाता है और डेटा प्रतिधारण के लिए तीनों तालिकाएँ (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) सुरक्षित रहती हैं; पुनः इंस्टॉल करने से निरस्त किया गया टोकन पुनः सक्रिय नहीं होता। Cacti डेटाबेस के साथ तालिकाओं का बैकअप लें और प्लगइन के बाहर ऑडिट प्रतिधारण नीति लागू करें।

## विकास और परीक्षण

परीक्षण सरल PHP स्क्रिप्ट हैं जो Cacti के बिना चलती हैं:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI, PHP 8.2 से 8.5 तक पर PHP को लिंट करता है और `tests/` में स्क्रिप्ट चलाता है (प्रत्येक `.github/workflows/ci.yml` में सूचीबद्ध है), फिर इंस्टॉल करने योग्य `mcp/` आर्काइव और उसका चेकसम बनाता है। जो परीक्षण Cacti को छूते हैं वे Cacti हेल्पर सीमा पर फ़िक्स्चर का उपयोग करते हैं; वे पूर्ण Cacti इंस्टॉल का परीक्षण नहीं करते।

### एकीकरण परीक्षण

`tests/integration/run.sh 1.2.31` या `tests/integration/run.sh develop` कंटेनरों में एक वास्तविक Cacti में प्लगइन इंस्टॉल करता है और उस पर लाइव जाँच चलाता है। इसके लिए Compose v2.23.1 या बाद के संस्करण वाला Docker, git और openssl आवश्यक हैं। `KEEP=1` डीबगिंग के लिए स्टैक को चालू छोड़ देता है। CI इसे रात्रिकालीन और मांग पर चलाता है, न कि पुल अनुरोधों पर।

## स्थानीयकरण

Cacti MCP, `mcp` टेक्स्ट डोमेन (`locales/po/mcp.pot`) का उपयोग करके अंग्रेज़ी और 47 अन्य लोकेल (19 Broad Tier 1, 15 अफ्रीकी, 10 एशियाई, तथा बोस्नियाई, क्रोएशियाई और सर्बियाई लोकेल) के लिए `locales/po/` और `locales/LC_MESSAGES/` के अंतर्गत संकलित GNU gettext कैटलॉग तथा `docs/i18n/` के अंतर्गत स्थानीयकृत README प्रदान करता है। भाषा समर्थन सक्षम होने पर Cacti स्वचालित रूप से मिलान करने वाला कैटलॉग लोड कर लेता है।

## योगदान

पुल अनुरोध `develop` पर जाएँगे। प्रोडक्शन कोड को PHP 8.2 के अनुकूल रखें और Cacti की शैली का उपयोग करें: टैब, सिंगल-कोटेड स्ट्रिंग, और Cacti के डेटाबेस और अनुमति हेल्पर। बदले गए सत्यापन, प्राधिकरण या प्रोटोकॉल व्यवहार के लिए परीक्षण जोड़ें, और `git commit -s` के साथ कमिट को साइन ऑफ करें। HTTP API में बदलावों का समन्वय [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) के साथ करें।

## लाइसेंस

कॉपीराइट (C) 2026 Thomas Vincent। GNU General Public License, संस्करण 2 या बाद के संस्करण के अंतर्गत जारी। देखें [LICENSE](../../../LICENSE)।
