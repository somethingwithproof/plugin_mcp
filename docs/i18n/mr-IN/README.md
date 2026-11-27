<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ढालीसह निवडुंग. शोधा. अधिकृत करा. कार्यान्वित करा.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="परवाना: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP हे एक Cacti प्लगइन आहे जे AI क्लायंटना क्षमता (abilities) नावाच्या नामांकित, परवानगी-फिल्टर केलेल्या ऑपरेशन्सद्वारे तुमचा Cacti डेटा वाचू देते. ते प्लगइनमधूनच दोन मार्गांनी सेवा देते: एक MCP एंडपॉइंट (`mcp.php`, Streamable HTTP) आणि एक AIP-शैलीतील HTTP API (`api.php`). अधिकृतता आणि अंमलबजावणीचे नियंत्रण Cacti कडेच राहते. क्लायंट कधीही थेट डेटाबेस क्वेरी करत नाही; तो फक्त प्रशासकाने उघड केलेली आणि टोकन मालकाच्या Cacti रेल्म्सनी परवानगी दिलेली क्षमता कॉल करू शकतो.

प्लगइन लेखक `abilities_register` हुकद्वारे त्यांच्या स्वतःच्या फक्त-वाचनीय क्षमता नोंदवू शकतात, आणि त्या कोणत्याही प्रोटोकॉल कोडशिवाय MCP क्लायंटना टूल्स म्हणून दिसतात.

**स्थिती: पूर्व-प्रकाशन, आवृत्ती 0.1.0.** कोणतेही टॅग केलेले प्रकाशन उपलब्ध नाही.

आज उपलब्ध:

- सिस्टीम आवृत्त्या, डिव्हाइसेस, साइट्स, पोलर्स, ग्राफ ट्रीज, ग्राफ्स, डेटा सोर्सेस आणि मर्यादित, संपादित (redacted) Cacti लॉग टेल समाविष्ट करणाऱ्या नऊ फक्त-वाचनीय अंतर्निर्मित क्षमता.
- एकमेव क्रेडेन्शियल म्हणून वैयक्तिक प्रवेश टोकन (`cmcp_pat_...`).
- Management > MCP कन्सोल: क्षमता उघड करा किंवा लपवा, टोकन तयार करा आणि रद्द करा, ऑडिट लॉग वाचा.
- Management > My MCP Tokens: वापरकर्ते त्यांचे स्वतःचे टोकन व्यवस्थापित करतात, त्यांची क्रियाकलाप नोंद पाहतात आणि त्यांचे टोकन कोणती टूल्स वापरू शकतात हे पाहतात.
- Streamable HTTP वर MCP, प्रोटोकॉल आवृत्त्या `2026-07-28` आणि `2025-11-25`, फक्त टूल्स.

अद्याप उपलब्ध नाही:

- OAuth 2.1 साइन-इन. वैयक्तिक टोकन पाठवू न शकणारे होस्ट केलेले कनेक्टर, जसे की ChatGPT आणि claude.ai कस्टम कनेक्टर, हे उपलब्ध होईपर्यंत कनेक्ट होऊ शकत नाहीत. हे Plan 2 म्हणून नियोजित आहे; तो आराखडा अद्याप लिहिलेला नाही.
- लेखन क्षमता. फक्त वाचनीय क्षमताच नोंदवता येतात.

डिझाइन
[एंडपॉइंट डिझाइन तपशील](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)
मध्ये आहे, आणि बिल्ड क्रम [docs/plan.md](../../plan.md) मध्ये आहे.

## अंतर्निर्मित क्षमता

| ID | श्रेणी | आर्ग्युमेंट्स | आवश्यक Cacti रेल्म |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | काहीही नाही | 15 |
| `cacti-list-devices` | `inventory` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | आवश्यक `name`, जसे की `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 7 किंवा 4 |
| `cacti-list-graphs` | `inventory` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 7 किंवा 5 |
| `cacti-list-data-sources` | `inventory` | ऐच्छिक `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | ऐच्छिक `lines` (1 ते 200, डीफॉल्ट 50), `severity`, `search` | 19 किंवा 18 |

प्रत्येक कॉलसाठी टोकन मालकाकडे **MCP and Abilities API** रेल्म, `abilities:read` स्कोप (प्रत्येक वैयक्तिक टोकनकडे तो असतो), आणि उघड केलेली क्षमता असणे आवश्यक आहे. कन्सोलचा Abilities टॅब प्रत्येक अंतर्निर्मित क्षमतेसाठी आवश्यक असलेला प्राथमिक रेल्म दाखवतो.

सर्व सहा `cacti-list-*` क्षमता कमाल 100 आयटम्सची (डीफॉल्ट 50) पृष्ठे आणि `nextPageToken` परत करतात. पेज टोकन फक्त त्याच `filter` आणि `orderBy` साठी वैध असते. `filter` हे `AND` ने जोडलेल्या तुलनांचे (`=`, `!=`, `<`, `<=`, `>`, `>=`) AIP-160 एक्सप्रेशन आहे, उदाहरणार्थ `state = "DOWN" AND disabled = false`. `orderBy` मध्ये क्रमाने लावता येणाऱ्या फील्ड्सची स्वल्पविरामाने विभक्त केलेली यादी घेता येते, ज्यातील प्रत्येकानंतर ऐच्छिकपणे `asc` किंवा `desc` देता येते.

| क्षमता | फिल्टर फील्ड्स | ऑर्डर फील्ड्स |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

परवानगीची मर्यादा आणि गुप्त माहिती वगळणे:

- `cacti-list-devices` आणि `cacti-get-device` Cacti च्या `get_allowed_devices()` मधून क्वेरी करतात आणि SNMP कम्युनिटी स्ट्रिंग्ज, पासफ्रेझ आणि इतर क्रेडेन्शियल्स वगळतात.
- `cacti-list-trees` हे `get_allowed_trees()` मधून क्वेरी करते (आणि उपलब्ध असल्यास `is_tree_allowed()` ने फिल्टर करते); `cacti-list-graphs` हे `get_allowed_graphs()` मधून क्वेरी करते (आणि उपलब्ध असल्यास `is_graph_allowed()` ने फिल्टर करते).
- `cacti-list-data-sources` कॉलरच्या `get_allowed_devices()` मधील (आणि उपलब्ध असल्यास `is_device_allowed()` मधील) परवानगी असलेल्या डिव्हाइसेसपुरत्या रांगा मर्यादित करते आणि `data_input_data` क्वेरी न करता किंवा गुप्त इनपुट मूल्ये उघड न करता फक्त मेटाडेटा परत करते.
- `cacti-list-pollers` डेटाबेस क्रेडेन्शियल्स (`dbpass`, `dbuser`) आणि TLS की व प्रमाणपत्र स्तंभ (`dbsslkey`, `dbsslcert`, `dbsslca`) वगळते.
- `cacti-get-clog` कॉन्फिगर केलेल्या Cacti लॉगचा शेवटचा कमाल 1 MiB भाग वाचते (2048 बाइट्सपेक्षा मोठ्या वैयक्तिक ओळी कापून), `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`; डीफॉल्ट `ALL`) आणि केस-असंवेदनशील `search` (कमाल 256 वर्ण) नुसार फिल्टर करते, आणि `lines`, `count`, व `truncated` परत करते. `search` चा वापर गुप्त माहिती शोधण्यासाठी (secret oracle) होऊ नये म्हणून `severity` आणि `search` फिल्टर्स चालण्यापूर्वीच प्रत्येक ओळीतील वैयक्तिक टोकन्स, bearer/basic हेडर्स, पासवर्ड्स, सीक्रेट्स, SNMP कम्युनिटीज, कीज, `dbpass`, `dbsslkey`, आणि URL userinfo संपादित (redact) केले जातात. संपादन अयशस्वी झाल्यास ते `[redacted]` ने सुरक्षितपणे बंद होते, आणि वाचता न येणारा लॉग `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`) परत करतो.

## स्थापना

यासाठी Cacti 1.2.31 किंवा नंतरची आवृत्ती, PHP 8.2 किंवा नंतरची आवृत्ती आणि मुख्य पॉलर आवश्यक आहे. Cacti प्रमाणीकरण सक्षम असणे आवश्यक आहे; ते बंद असल्यास प्लगइन प्रमाणीकरण करण्यास नकार देते.

प्लगइन डिरेक्टरीचे नाव `mcp` असणे आवश्यक आहे, `plugin_mcp` नाही. प्लगइन स्लग, रेल्म नावे, भाषांतर डोमेन आणि URL सर्व `mcp` वापरतात.

सोर्स चेकआउटवरून:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

टॅग केलेली प्रकाशने उपलब्ध होईपर्यंत, तुम्ही त्याऐवजी यशस्वी
[CI रन](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
मधून `mcp-plugin` आर्टिफॅक्ट डाउनलोड करू शकता. त्यामध्ये `mcp.tar.gz` आणि `SHA256SUMS` असतात. चेकसम तपासा, त्यानंतर Cacti च्या `plugins/` डिरेक्टरीमध्ये `mcp.tar.gz` एक्सट्रॅक्ट करा जेणेकरून परिणाम `plugins/mcp/` असा होईल. GitHub चे स्वयंचलित सोर्स आर्काइव्ह्ज वेगळे टॉप-लेव्हल डिरेक्टरी नाव वापरतात. या आर्काइव्हमध्ये `docs/` (खालील स्क्रीनशॉट्ससह), `tests/`, आणि `.github/` नसतात, त्यामुळे `docs/` कडे जाणाऱ्या README लिंक्स GitHub वर काम करतात परंतु स्थापित केलेल्या प्रतीमध्ये काम करत नाहीत.

त्यानंतर:

1. Plugin Management मध्ये **Cacti MCP** स्थापित करा आणि सक्षम करा. स्थापित करणाऱ्या प्रशासकाला **MCP Administration** रेल्म आपोआप मिळतो.
2. Settings > MCP अंतर्गत, **Public Cacti URL** क्लायंट वापरतात त्या पत्त्यावर सेट करा, उदाहरणार्थ `https://cacti.example.com/cacti`. `localhost`, `127.0.0.1`, आणि `[::1]` वगळता HTTPS आवश्यक आहे. हे सेट करेपर्यंत, `mcp.php` HTTP 400 सह JSON-RPC त्रुटी देते जिचा `data` हा `FAILED_PRECONDITION` आणि `PUBLIC_URL_REQUIRED` असतो. `api.php` ते वाचत नाही.

   ![Public Cacti URL फील्ड दर्शवणारे Settings > MCP](../../images/settings-public-url.png)

3. टोकन धारण करणाऱ्या प्रत्येक वापरकर्त्याला **MCP and Abilities API** रेल्म द्या. कोणत्याही वापरकर्त्याला तो आपोआप मिळत नाही.
4. वेब सर्व्हर PHP ला `Authorization` हेडर आणि पाथ माहिती पास करतो याची खात्री करा (खाली पहा).
5. Management > MCP उघडा आणि क्लायंटना ज्या क्षमता दिसाव्यात असे तुम्हाला वाटते त्या उघड करा.

**विकास बिल्डवरून अपग्रेड करणे.** प्लगइन पूर्व-प्रकाशन अवस्थेत आहे, आणि विकासादरम्यान मायग्रेशनशिवाय त्याचे टेबल्स बदलले आहेत. तुम्ही आधीचा बिल्ड स्थापित केला असल्यास, तो अनइंस्टॉल करून पुन्हा स्थापित करा. पुन्हा स्थापित केल्याने आधीपासून अस्तित्वात असलेले टेबल्स तसेच राहतात, त्यामुळे आधी जुने `plugin_mcp_token`, `plugin_mcp_audit`, आणि `plugin_mcp_ability` टेबल्स (आणि नाव बदलण्यापूर्वीच्या बिल्ड्समधील समतुल्य टेबल्स) ड्रॉप करा. त्यांचा इतिहास हवा असल्यास त्यांचा बॅकअप घ्या; त्या बिल्ड्समधील टोकन अनइंस्टॉल करताना रद्द होतात आणि पुढे नेले जात नाहीत.

### वेब सर्व्हर

PHP पूर्वी `Authorization` काढून टाकणाऱ्या Apache सेटअप्सना संबंधित व्हर्च्युअल होस्ट किंवा डिरेक्टरीमध्ये याची आवश्यकता असते, त्यानंतर रीलोड करावे लागते:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` सह Apache ने कोणत्याही अतिरिक्त पाथ कॉन्फिगरेशनशिवाय `api.php` रूट्स दिले.

`api.php` रूट्स स्क्रिप्टच्या नावानंतरच्या पाथमध्ये राहतात (`/plugins/mcp/api.php/v1/abilities`), त्यामुळे nginx ने `.php` नंतर अधिक पाथ असलेल्या URI शी जुळवून घेतले पाहिजे, पाथ माहिती वेगळी केली पाहिजे आणि ती PHP ला पास केली पाहिजे. `location ~ \.php$` ब्लॉक या URL शी कधीही जुळत नाही; nginx स्वतःचे HTML 404 उत्तर देते. खालील लोकेशन पॅटर्न आणि दोन पाथ-इन्फो ओळी PHP-FPM सह पडताळलेल्या आहेत; इतर ओळी मानक बॉयलरप्लेट आहेत:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

आधीपासून Cacti सेवा देणाऱ्या ब्लॉकशी जुळण्यासाठी `include` आणि `fastcgi_pass` ओळी समायोजित करा. या ब्लॉकमध्ये `try_files $fastcgi_script_name =404;` जोडू नका: ते `$fastcgi_path_info` रिकामे करते, आणि मग `api.php` 404 `UNKNOWN_PATH` उत्तर देते. तुमच्या कॉन्फिगरेशनला `try_files` आवश्यक असल्यास, आधी `set $path_info $fastcgi_path_info;` ने मूल्य जतन करा आणि `fastcgi_param PATH_INFO $path_info;` पास करा.

`mcp.php` ला कोणतेही पाथ रूट्स नाहीत आणि त्यांची आवश्यकता नाही.

## कन्सोल

Management > MCP मध्ये तीन टॅब आहेत. तुम्हाला **MCP Administration** रेल्मची आवश्यकता आहे. येथील आणि खालील स्क्रीनशॉट्स उदाहरण डेटासह एका Cacti विकास बिल्डमधील आहेत.

- **Abilities** मध्ये प्रत्येक नोंदवलेली क्षमता तिचे प्लगइन, श्रेणी, आवश्यक रेल्म आणि ती उघड आहे की नाही यासह सूचीबद्ध असते. ओळी निवडा आणि Expose किंवा Hide निवडा; बदल लागू होण्यापूर्वी तुम्ही पुष्टी करता. अंतर्निर्मित `cacti-*` क्षमता डीफॉल्टनुसार उघड असतात. इतर प्लगइन्सच्या क्षमता लपलेल्या अवस्थेत सुरू होतात, त्यामुळे प्रशासक ठरवत नाही तोपर्यंत प्लगइन स्थापित केल्याने काहीही प्रकाशित होत नाही. उघड केल्याने फक्त प्रवेश मर्यादित राहतो: वापरकर्त्याकडे क्षमतेचा रेल्म असणे अजूनही आवश्यक असते.

  ![अंतर्निर्मित क्षमता त्यांच्या रेल्म्स आणि उघड स्थितीसह दर्शवणारा Abilities टॅब](../../images/console-abilities.png)
- **Tokens** मध्ये मालक, निर्माता, निर्मिती, कालबाह्यता, शेवटचा वापर आणि स्थिती (Active, Expired, Revoked) सह टोकन सूचीबद्ध असतात. ओळी निवडा आणि त्यांना रद्द करण्यासाठी Revoke निवडा. रद्द केलेले टोकन पुन्हा वापरता येत नाहीत. Create Token नवीन टोकन तयार करते.

  ![Create Token फॉर्मच्या वर मालक, कालबाह्यता, शेवटचा वापर आणि स्थितीसह टोकन दर्शवणारा Tokens टॅब](../../images/console-tokens.png)
- **Audit** मध्ये ऑडिट ओळी, सर्वात नवीन प्रथम अशा क्रमाने सूचीबद्ध असतात आणि वापरकर्ता, क्षमता आणि परिणामावरून फिल्टर करता येतात.

  ![फिल्टरसह वापरकर्ता, टोकन, क्षमता आणि परिणामासह कॉल्स दर्शवणारा Audit टॅब](../../images/console-audit.png)

## टोकन

वैयक्तिक टोकन त्याच्या मालकाच्या रूपात Cacti वाचते. त्याचे स्वरूप `cmcp_pat_` त्यानंतर 64 लोअरकेस हेक्स वर्णांचे असते आणि त्यात `abilities:read` हा एकच स्कोप असतो. ते काय पाहू शकते हे टोकनद्वारे नव्हे तर त्याच्या मालकाच्या Cacti रेल्म्स आणि डिव्हाइस परवानग्यांद्वारे ठरवले जाते. मालक हा **MCP and Abilities API** रेल्म असलेला सक्षम वापरकर्ता असणे आवश्यक आहे.

टोकन नेहमी वापरकर्त्यासाठी तयार केले जातात, कालबाह्य होतात आणि रद्द करता येतात:

- **कन्सोल.** Management > MCP > Tokens > Create Token. आयुष्यमान 1 ते 365 दिवस असते आणि डीफॉल्ट 90 असते. टोकन सर्व्हरद्वारे तयार केले जाते आणि प्रतिसाद पृष्ठावर एकदाच दाखवले जाते, त्यामुळे ते ताबडतोब तुमच्या सिक्रेट मॅनेजरमध्ये कॉपी करा. तुम्ही स्वतःसाठी टोकन तयार करू शकता. दुसऱ्या वापरकर्त्यासाठी टोकन तयार करण्यासाठी Users/Groups रेल्म देखील आवश्यक असतो, कारण टोकन त्या वापरकर्त्याच्या रूपात Cacti वाचते.
- **My MCP Tokens.** MCP and Abilities API रेल्म असलेला कोणताही वापरकर्ता स्वतःचे टोकन व्यवस्थापित करू शकतो; खाली पहा.
- **कमांड लाइन.** `tokens.php` फक्त CLI वरून, Cacti चे प्रशासन करू शकणाऱ्या OS खात्याद्वारे चालते. ते एन्व्हायर्नमेंटमधून टोकन घेते जेणेकरून मूल्य कधीही कमांड लाइनवर किंवा प्रोसेस लिस्टमध्ये दिसणार नाही. आयुष्यमान 1 ते 365 दिवस असते आणि डीफॉल्ट 30 असते. CLI द्वारे टोकन तयार करणे आणि रद्द करणे कन्सोलप्रमाणेच ऑडिट केले जाते, ज्यामध्ये CLI ला Cacti वापरकर्ता नसल्यामुळे टोकनचा मालक हा कर्ता म्हणून नोंदवला जातो, त्यामुळे ऑडिट ओळ ती कृती CLI वरून आली असल्याचे चिन्हांकित करत नाही. `--list` प्रत्येक टोकन JSON म्हणून (ID, मालक, स्कोप्स, टाइमस्टॅम्प्स, रद्द ध्वज) प्रिंट करते आणि टोकनचे मूल्य कधीही दाखवत नाही; `--help` वापर दाखवते.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

कन्सोल, कमांड लाइन किंवा My MCP Tokens मधून अतिथी खात्यासाठी, अक्षम वापरकर्त्यांसाठी किंवा **MCP and Abilities API** रेल्म नसलेल्या वापरकर्त्यांसाठी टोकन तयार करता येत नाहीत. Cacti अतिथी सेटिंग वापरकर्तानाव किंवा वापरकर्ता ID म्हणून संग्रहित करते आणि प्लगइन दोन्ही सोडवते. ज्या टोकनचा मालक अतिथी खाते बनतो ते त्याच्या पुढील विनंतीवर काम करणे बंद करते.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) ला कोणत्याही प्रशासन रेल्मची आवश्यकता नसते: ते **MCP and Abilities API** रेल्मद्वारे संरक्षित असते आणि मेनू नोंद फक्त ती धारण करणाऱ्या वापरकर्त्यांनाच दिसते. हे पृष्ठ नेहमी साइन-इन केलेल्या वापरकर्त्यावर कार्य करते. Cacti चा मेनू कन्सोलचा भाग आहे, त्यामुळे कन्सोल प्रवेश नसलेला वापरकर्ता पृष्ठाच्या पत्त्याद्वारे तिथे पोहोचतो.

![साइन-इन केलेल्या वापरकर्त्याचे टोकन आणि तयार करण्याचा फॉर्म दर्शवणारा My Tokens टॅब](../../images/my-tokens.png)

- **Tokens** तुमचे टोकन सूचीबद्ध करते, एक तयार करते (1 ते 365 दिवस, डीफॉल्ट 90, प्रतिसादात एकदाच दाखवले जाते), आणि तुमचे स्वतःचे रद्द करते. तुम्ही इतर कोणाचेही पाहू किंवा रद्द करू शकत नाही.
- **Activity** तुम्ही केलेल्या कृती, सर्वात नवीन प्रथम या क्रमाने सूचीबद्ध करते: तुमच्या टोकनद्वारे केलेले कॉल्स आणि तुम्ही केलेले टोकन बदल.
- **Available Tools** तुमचा टोकन आत्ता वापरू शकेल अशा क्षमता प्रत्येक क्षमतेचा ID, नाव आणि वर्णनासह सूचीबद्ध करते. ते तुमच्या Cacti परवानग्या आणि प्रशासकाने निवडलेल्या उघड सेटिंग्जचे पालन करते.

  ![प्रत्येक क्षमतेचा ID, नाव आणि वर्णन दर्शवणारी Available Tools सूची](../../images/my-tools.png)

हे पृष्ठ अस्तित्वात येण्यापूर्वी केलेल्या स्थापनेमध्ये `mcp_tokens.php` शिवाय रेल्म फाइल सूची असते. Install ही सूची नोंदवते; प्लगइन सक्षम किंवा अक्षम केल्याने ती अद्यतनित होत नाही. प्लगइन अनइंस्टॉल करून पुन्हा स्थापित करा, त्यानंतर पुन्हा रेल्म द्या, कारण प्लगइन अनइंस्टॉल केल्यावर Cacti रेल्म अनुदाने काढून टाकते.

डेटाबेस टोकनचा फक्त SHA-256 हॅश संग्रहित करतो, त्यामुळे हरवलेले टोकन परत मिळवता येत नाही; ते रद्द करा आणि दुसरे तयार करा. रोटेशन देखील तसेच आहे: नवीन टोकन तयार करा, क्लायंट स्विच करा, त्यानंतर जुने रद्द करा. कालबाह्य झालेले टोकन, रद्द केलेले टोकन, अक्षम मालक किंवा गमावलेला रेल्म यांपैकी प्रत्येक पुढील विनंतीवर अयशस्वी होते. टोकन फक्त `Authorization: Bearer` हेडरमध्ये स्वीकारले जातात; क्वेरी स्ट्रिंग किंवा बॉडीमधील टोकन स्वीकारले जात नाही.

## क्लायंट कनेक्ट करा

`Authorization: Bearer` हेडरमध्ये टोकन देऊन `https://cacti.example.com/cacti/plugins/mcp/mcp.php` हा MCP एंडपॉइंट वापरा. टोकनची किंमत थेट फाइलमध्ये लिहिण्याऐवजी ते एन्व्हायर्नमेंट व्हेरिएबल किंवा सीक्रेट मॅनेजरमध्ये ठेवा आणि क्लायंट कॉन्फिगरेशनमधून त्याचा संदर्भ द्या.

### Claude Code

टोकनचा नावाने संदर्भ देणाऱ्या प्रोजेक्टमधील `.mcp.json` फाइलमध्ये हा एंडपॉइंट ठेवा. Claude Code `url` आणि `headers` मधील `${VAR}` विस्तारित करते, त्यामुळे फाइलमध्ये कोणताही गुप्त डेटा राहत नाही आणि ती कमिट करणे सुरक्षित असते. Claude Code सुरू करणाऱ्या एन्व्हायर्नमेंटमध्ये `CACTI_MCP_TOKEN` एक्सपोर्ट करा.

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

तुम्ही हे कमांड लाइनवरूनही जोडू शकता:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

दुहेरी अवतरणचिन्हांसह, तुमचे शेल प्रथम `$CACTI_MCP_TOKEN` विस्तारित करते, त्यामुळे निवडलेल्या `--scope` (`local`, `user`, किंवा `project`; डीफॉल्ट `local`) साठीच्या कॉन्फिग फाइलमध्ये टोकनची किंमत थेट लिहिली जाते. `--scope project` सह हे स्वरूप वापरू नका आणि ती फाइल व्हर्जन कंट्रोलपासून दूर ठेवा. वरील `.mcp.json` संदर्भ पद्धतीला प्राधान्य द्या. Claude Code रिमोट `url` आणि `headers` मध्ये काही क्रेडेन्शियल व्हेरिएबल्स (जसे की `ANTHROPIC_AUTH_TOKEN`) रिकामे म्हणून वाचते; `CACTI_MCP_TOKEN` त्यापैकी नाही. स्रोत: [Claude Code MCP दस्तऐवजीकरण](https://code.claude.com/docs/en/mcp).

### VS Code मधील GitHub Copilot

वर्कस्पेस-रूट `.mcp.json` (किंवा युजर फाइल `~/.copilot/mcp-config.json`) वापरा. या Copilot-नेटिव्ह फाइल्स टॉप-लेव्हल `mcpServers` ऑब्जेक्ट आणि हेडर व्हॅल्यूजमध्ये `${NAME}` एन्व्हायर्नमेंट-व्हेरिएबल संदर्भ वापरतात:

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

VS Code सुरू करणाऱ्या एन्व्हायर्नमेंटमध्ये `CACTI_MCP_TOKEN` एक्सपोर्ट करा. नेटिव्ह Copilot फाइल्स `inputs` प्रॉम्प्टना सपोर्ट करत नाहीत. VS Code चा मार्गदर्शित सेटअप `${...}` व्हॅल्यूज नाकारतो, त्यामुळे मार्गदर्शित प्रक्रियेतून न जाता फाइल संपादित करून `Authorization` हेडर जोडा. प्रायोगिक `chat.mcp.workspaceRootConfig.enabled` सेटिंग चालू असेल तरच मार्गदर्शित सेटअप वर्कस्पेस-रूट फाइलचा पर्याय देतो. पहा: [VS Code MCP कॉन्फिगरेशन संदर्भ](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**लीगसी: `.vscode/mcp.json`.** VS Code नुसार नवीन Copilot कॉन्फिगरेशनमध्ये `.vscode/mcp.json` किंवा प्रोफाइल `mcp.json` वापरू नये; त्या डेप्रिकेट केलेल्या Local हार्नेसशी संबंधित आहेत, जो फेब्रुवारी 2027 मध्ये काढून टाकला जाईल. तुम्ही तरीही ते वापरत असाल, तर एडिटर-मॅनेज्ड फॉरमॅट टॉप-लेव्हल `servers` की घेतो आणि टोकनसाठी प्रॉम्प्ट करू शकतो:

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

### केवळ stdio बोलणारे क्लायंट्स

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) हा एक पर्यायी अडॅप्टर आहे जो लोकल stdio MCP सर्व्हर म्हणून चालतो आणि प्लगइनच्या HTTP API ला कॉल करतो. जो क्लायंट रिमोट HTTP सर्व्हरशी कनेक्ट होऊ शकत नाही, त्याच्यासाठी याचा वापर करा. त्याला तेच वैयक्तिक टोकन लागते आणि तो `api.php` शी संवाद साधतो.

### MCP वर्तणूक

हा एंडपॉइंट फक्त टूल्स पुरवतो: प्रत्येक उघड केलेली, परवानगी असलेली क्षमता तिच्या ID च्या नावाने एक टूल असते, ज्यामध्ये तिचे इनपुट आणि आउटपुट स्कीमा तसेच रीड-ओन्ली भाष्ये (`openWorldHint` ची किंमत `false` असते) असतात. हा एंडपॉइंट `initialize`, `server/discover`, `ping`, `tools/list`, आणि `tools/call` हाताळतो. तो कोणतेही सेशन जतन करत नाही, `Mcp-Session-Id` पाठवत नाही (आणि प्राप्त झाल्यास त्याकडे दुर्लक्ष करतो), तसेच JSON-RPC बॅचेस स्वीकारत नाही. `id` नसलेला संदेश ही सूचना मानली जाते आणि त्याला बॉडीशिवाय HTTP 202 प्रतिसाद मिळतो. फक्त `POST` ला परवानगी आहे.

- **आवृत्त्या.** `params._meta` मध्ये `io.modelcontextprotocol/protocolVersion` असलेल्या विनंतीमध्ये `2026-07-28` असणे आवश्यक आहे; इतर कशासाठीही `-32022` त्रुटी मिळते. अशा विनंत्यांमध्ये जुळणारे `Mcp-Protocol-Version`, `Mcp-Method`, आणि (`tools/call` साठी) `Mcp-Name` हेडर्स देखील असणे आवश्यक आहे, अन्यथा `-32020` त्रुटी मिळते. इतर विनंत्या `2025-11-25` म्हणून हाताळल्या जातात: `initialize` त्या आवृत्तीसह उत्तर देते, आणि इतर कोणत्याही मेथडवर `Mcp-Protocol-Version` हेडर पाठवला असल्यास, तो `2025-11-25`, `2025-06-18`, किंवा `2025-03-26` असणे आवश्यक आहे.
- **टूल त्रुटी.** स्कीमाशी न जुळणारे आर्ग्युमेंट्स किंवा JSON ऑब्जेक्ट नसलेली `arguments` व्हॅल्यू यांसह कोणतीही क्षमता त्रुटी, प्रोटोकॉल त्रुटी म्हणून न येता `isError: true` आणि `structuredContent` मध्ये AIP-193 त्रुटी असलेला टूल परिणाम म्हणून परत येते.
- **प्रोटोकॉल त्रुटी.** ज्या अपयशांच्या नोंदी टूल त्रुटी नाहीत त्या JSON-RPC त्रुटी ऑब्जेक्ट्स असतात (`data` मध्ये स्थिती आणि कारणासह कोड `-32000`, किंवा मानक कोड): गहाळ Public Cacti URL, नाकारलेला `Origin`, प्लगइन बंद असताना किंवा रिमोट पोलरवर केलेली विनंती, आणि अनपेक्षित सर्व्हर त्रुटी (`-32603`, ज्याचे तपशील प्रतिसादात न देता Cacti लॉगमध्ये लिहिले जातात). प्रथम चालणाऱ्या विनंती तपासण्या (405, 413, 415) आणि ऑथेंटिकेशन अपयश (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) हे HTTP API अंतर्गत वर्णन केलेली AIP-193 बॉडी कायम ठेवतात.

## HTTP API

मूळ URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. कॉन्ट्रॅक्ट [openapi.json](../../../openapi.json) मध्ये आहे.

| मेथड आणि पाथ | उद्देश |
| --- | --- |
| `GET /v1/abilities` | परवानगी असलेल्या क्षमतांची यादी करा. क्वेरी: `pageSize`, `pageToken`, आणि `category = "inventory"` स्वरूपातील `filter`. |
| `GET /v1/abilities/{id}` | एक क्षमता वाचा. |
| `POST /v1/abilities/{id}:execute` | ती चालवा. बॉडी अगदी `{"arguments": {...}}` अशी असते. प्रतिसाद `{"requestId": "...", "result": {...}}` असा असतो. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

त्रुटी AIP-193 चे पालन करतात: `code`, `message`, `status`, आणि `details` असलेला `error` ऑब्जेक्ट, ज्यामध्ये `cacti.net` डोमेन आणि स्थिर `reason` असलेले `ErrorInfo` असते. आर्ग्युमेंटमधील समस्यांमुळे फील्डचे नाव देणारा `BadRequest` तपशील जोडला जातो. विनंती बॉडी 64 KB पर्यंत आणि परिणाम 1 MB पर्यंत मर्यादित आहेत. दोन्ही एंडपॉइंट्स फक्त मुख्य पोलरवर उत्तर देतात आणि प्लगइन बंद असल्यास किंवा सर्व्हर मुख्य पोलर नसल्यास `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) परत करतात.

| HTTP | `reason` व्हॅल्यूज |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer` देखील पाठवते) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` पाठवते) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## क्षमता लिहा (प्लगइन लेखकांसाठी)

सक्षम केलेले Cacti प्लगइन `abilities_register` हुकला जोडलेल्या फंक्शनमधून क्षमता नोंदवते, सामान्यतः त्याच्या `plugin_<slug>_install()` मध्ये:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

या फंक्शनला प्लगइनपुरते मर्यादित असलेले `AbilitiesRegistrar` मिळते. त्याच्या रिटर्न व्हॅल्यूकडे दुर्लक्ष केले जाते.

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

नोंदणीच्या वेळी लागू केलेले सर्व नियम:

- **ID.** ID हा `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` शी जुळणारा, जास्तीत जास्त 64 वर्णांचा असतो आणि तो प्लगइनच्या स्लग आणि हायफनने सुरू होणे आवश्यक आहे: जसे वरील `acme-`. स्लग हे प्लगइन डिरेक्टरीचे नाव असते, त्यामुळे `my_plugin` सारखी डिरेक्टरी काहीही नोंदवू शकत नाही. `cacti` नावाची प्लगइन डिरेक्टरी नाकारली जाते; तो नेमस्पेस बिल्ट-इन क्षमतांसाठी राखीव आहे.
- **व्याख्या.** नेमक्या याच कीज असाव्यात: `label`, `description` (4096 बाइट्सपर्यंत), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. वर्ग आधीच अस्तित्वात असणे आवश्यक आहे: बिल्ट-इन (`inventory`, `system`) वापरा किंवा `registerCategory()` ने तुमचा स्वतःचा नोंदवा, ज्याचा ID सर्व प्लगइन्समध्ये अद्वितीय असेल आणि `^[a-z][a-z0-9-]{0,31}$` शी जुळेल.
- **फक्त रीड-ओन्ली.** `annotations` अगदी `readOnly: true`, `destructive: false`, `idempotent: true` असेच असणे आवश्यक आहे. इतर काहीही असल्यास त्रुटी थ्रो होते.
- **स्कीमा.** `input_schema` आणि `output_schema` या दोन्हींमध्ये टॉप-लेव्हल `type` हा `object` असणे आवश्यक आहे. ही प्रणाली लहान आहे आणि सुरक्षितपणे नकार देते (fails closed). ऑब्जेक्ट्स बंद असणे आवश्यक आहे (`additionalProperties: false`, आणि `properties` उपस्थित असणे); इतर प्रकारांमध्ये `integer` आणि `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, आणि `array` (ज्याला `items` आणि `maxItems` आवश्यक आहेत) यांचा समावेश होतो. एखादा प्रकार `['string', 'null']` असा nullable करता येतो. आर्ग्युमेंट स्ट्रिंग्सची डीफॉल्ट मर्यादा जास्तीत जास्त 4096 वर्णांची असते; परिणाम स्ट्रिंग्स केवळ घोषित केलेल्या `maxLength` आणि परिणाम आकाराच्या मर्यादेनुसार मर्यादित असतात. जास्तीत जास्त 256 क्षमता नोंदवता येतात.
- **`permission(int $userId): bool`.** परवानगी देण्यासाठी नेमके `true` परत करणे आवश्यक आहे. युजर ID हा टोकन मालकाचा असतो; कधीही सेशन स्टेट वाचू नका.
- **`execute(int $userId, stdClass $args): array`.** `$args` आधीच `input_schema` नुसार प्रमाणित केलेले असते. ऑब्जेक्ट-स्तरीय परवानग्या स्वतः लागू करा. `output_schema` शी अगदी जुळणारा असोसिएटिव्ह अ‍ॅरे परत करा; लिस्ट, अतिरिक्त फील्ड किंवा 1 MB पेक्षा जास्त JSON असल्यास `INVALID_RESULT` त्रुटी येते. क्लायंटला दिसणाऱ्या अपयशासाठी, जसे की `NOT_FOUND`, `AbilitiesError` थ्रो करा.
- **रिकामे ऑब्जेक्ट्स.** PHP `[]` ला JSON अ‍ॅरे म्हणून एन्कोड करते. आउटपुट स्कीमामध्ये कोणत्याही स्तरावर `object` घोषित केलेला असल्यास, रजिस्ट्री `[]` ला रिकामा ऑब्जेक्ट मानते आणि `{}` पाठवते; `new stdClass()` देखील चालते. रिकामी नसलेली लिस्ट कधीही ऑब्जेक्ट मानली जात नाही आणि `INVALID_RESULT` सह अयशस्वी होते. स्कीमामधील रिकामा `properties` मॅप `[]` किंवा `new stdClass()` असू शकतो; दोन्ही `{}` म्हणून प्रकाशित केले जातात.
- **अपयश अलगीकरण.** प्रत्येक प्लगइन एका तात्पुरत्या प्रतीमध्ये नोंदणी करते, जी तुमचे फंक्शन सामान्यपणे परत आल्यासच जतन केली जाते. जर त्याने त्रुटी थ्रो केली, तर तुमच्या कोणत्याही क्षमता नोंदवल्या जात नाहीत आणि अपयशाची नोंद लॉगमध्ये केली जाते.

प्लगइनमधील क्षमता सुरुवातीला लपलेल्या असतात. प्रशासक त्यांना कन्सोलवरील Abilities टॅबवर उघड करतो, आणि त्यांच्यासाठी Required Realm स्तंभात "Set by the plugin" असे दिसते.

## सुरक्षा मॉडेल

- **फक्त Bearer टोकन.** `api.php` आणि `mcp.php` केवळ `Authorization` हेडरमधील वैयक्तिक टोकन स्वीकारतात आणि इतर काहीही स्वीकारत नाहीत. Cacti लोड होण्यापूर्वी ते कुकीज, `$_POST` आणि `$_REQUEST` काढून टाकतात आणि Cacti ने सुरू केलेले सत्र (session) नष्ट करतात, त्यामुळे ब्राउझर लॉगिनमधून कधीही API प्रवेश मिळत नाही.
- **CSRF तात्पुरता उपाय (workaround).** ज्या JSON POST विनंतीमध्ये Cacti CSRF टोकन नसते, तिला Cacti चा CSRF गार्ड नाकारतो; कोणताही MCP क्लायंट हे टोकन पाठवू शकत नाही. केवळ या दोन एंडपॉइंट्ससाठी, Cacti लोड होण्यापूर्वी प्लगइन विनंती पद्धतीचे (request method) नाव बदलतो आणि नंतर ते पूर्ववत करतो, ज्यामुळे गार्ड त्यांना वगळतो. हे सुरक्षित आहे कारण CSRF अशा विनंत्यांचे संरक्षण करते ज्यांना ब्राउझर कुकीजद्वारे प्रमाणित करतो, आणि हे एंडपॉइंट्स कोणतीही कुकी ओळख स्वीकारत नाहीत: कोणतेही क्रॉस-साइट पृष्ठ bearer टोकन जोडू शकत नाही. कन्सोल पृष्ठांवर पूर्ण CSRF संरक्षण कायम राहते. जोपर्यंत Cacti समर्थित सूट देत नाही तोपर्यंत हा उपाय तात्पुरता आहे; `lib/bootstrap.php` पहा.
- **Origin तपासणी.** `mcp.php` वर, विनंतीमध्ये `Origin` हेडर असल्यास ते तंतोतंत Public Cacti URL च्या स्कीम, होस्ट आणि पोर्टशी जुळले पाहिजे, अन्यथा विनंती `ORIGIN_NOT_ALLOWED` सह नाकारली जाते. `Origin` हेडर नसलेल्या विनंतीस परवानगी दिली जाते, कारण ब्राउझर-व्यतिरिक्त क्लायंट याच प्रकारे कनेक्ट होतात. यामुळे कोणतेही वेब पृष्ठ अभ्यागताच्या ब्राउझरवरून एंडपॉइंट चालवण्यापासून रोखले जाते. `api.php` ही तपासणी लागू करत नाही.
- **फक्त वाचनीय (Read-only).** नोंदणी प्रक्रिया अशी कोणतीही क्षमता (ability) नाकारते जी केवळ वाचनीय, विना-विध्वंसक (non-destructive) आणि आयडेम्पोटंट (idempotent) नाही.
- **प्रकटीकरण (Exposure) आणि अधिकार क्षेत्रे (realms) दोन्ही लागू होतात.** क्षमता प्रकट केलेली (exposed) असणे आवश्यक आहे आणि टोकन मालकाकडे तिचे अधिकार क्षेत्र (realm) असणे आवश्यक आहे. जर प्रकटीकरण सारणी (exposure table) वाचता आली नाही, तर डीफॉल्टवर जाण्याऐवजी प्रत्येक क्षमता लपवली जाते.
- **लपवलेली, अज्ञात आणि परवानगी नसलेली क्षमता एकसारखीच दिसते.** अस्तित्वात नसलेली क्षमता, लपवलेली क्षमता किंवा वापरकर्त्याला वापरण्याची परवानगी नसलेली क्षमता यातील फरक क्लायंटला समजू शकत नाही: शोध (discovery) तिला वगळतो आणि अंमलबजावणी `NOT_FOUND` (`ABILITY_NOT_FOUND`) परत करते.
- **टोकन्स.** SHA-256 हॅश म्हणून साठवले जातात, एकदाच दाखवले जातात, नेहमी कालबाह्य होणारे असतात, रद्द (revoke) करता येतात आणि मालक अक्षम केल्यास किंवा अधिकार क्षेत्र गमावल्यास नाकारले जातात.
- **ऑडिट.** `plugin_mcp_audit` मध्ये विनंती ID, टोकन ID, वापरकर्ता ID, क्षमता, निकाल (`started`, `succeeded`, `failed`, `denied`, `rejected`) आणि टाइमस्टॅम्प नोंदवले जातात. त्यामध्ये कधीही युक्तिवाद (arguments), परिणाम किंवा टोकन मूल्ये नोंदवली जात नाहीत. क्षमतेची `started` ओळ लिहिल्यानंतरच ती क्षमता कार्यान्वित होते; जर ऑडिट सारणी उपलब्ध नसेल तर कॉल `UNAVAILABLE` सह अयशस्वी होतो आणि चालत नाही. चालण्यापूर्वीच नाकारलेल्या कॉलसाठी एक ओळ नोंदवली जाते: अज्ञात, लपवलेल्या किंवा परवानगी नसलेल्या क्षमतेसाठी `denied`, आणि स्कीमामध्ये अयशस्वी झालेल्या युक्तिवादांसाठी `rejected`. कन्सोल, My MCP Tokens आणि CLI मधून टोकन तयार करणे आणि रद्द करणे हे `succeeded` निकालासह `mcp-token-create` आणि `mcp-token-revoke` म्हणून नोंदवले जाते, आणि केवळ सक्रिय असलेल्या टोकनसाठीच रद्दीकरण नोंदवले जाते. शोध (Discovery) आणि ज्या कॉलचे `arguments` JSON ऑब्जेक्ट नसतात असे कॉल लॉग केले जात नाहीत.
- **अयशस्वीता लॉग.** अनपेक्षित अयशस्वीता, `INVALID_RESULT` किंवा अनुपलब्ध ऑडिट सारणी असल्यास `MCP` सुविधेसह (facility) Cacti लॉगमध्ये एक ओळ लिहिली जाते: क्षमता ID, एक निश्चित कारण आणि अपवाद वर्ग (exception class). संदेश, युक्तिवाद आणि टोकन्स कधीही लॉग केले जात नाहीत.
- **फक्त मुख्य पोलर (Main poller).** दोन्ही एंडपॉइंट्स, दोन्ही कन्सोल पृष्ठे आणि `tokens.php` इतर कोठेही कार्य करण्यास नकार देतात.

## जीवनचक्र

प्लगइन अक्षम केल्याने दोन्ही एंडपॉइंट्स अवरोधित होतात. अनइंस्टॉल केल्याने प्रत्येक टोकन रद्द होते आणि जतन करण्यासाठी तीन सारण्या (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) ठेवल्या जातात; पुन्हा इंस्टॉल केल्याने रद्द केलेले टोकन पुन्हा सक्रिय होत नाही. Cacti डेटाबेससह या सारण्यांचा बॅकअप घ्या आणि प्लगइनच्या बाहेर ऑडिट जतन धोरण (retention policy) लागू करा.

## विकास आणि चाचण्या

चाचणी संचामध्ये Cacti इंस्टॉलेशनशिवाय चालणाऱ्या `tests/` मधील साध्या PHP स्क्रिप्ट्स तसेच `tests/Unit/` मधील PHPUnit युनिट चाचण्या आणि PHPStan स्टॅटिक विश्लेषण (स्तर 6) यांचा समावेश आहे:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI हे PHP 8.2 ते 8.5 वर चालते: एक `test` जॉब जो PHP सिंटॅक्स (`php -l`) तपासतो आणि `.github/workflows/ci.yml` मध्ये सूचीबद्ध केलेल्या 13 साध्या PHP चाचणी स्क्रिप्ट्स चालवतो, एक `quality` जॉब जो `composer phpstan` आणि `composer test` चालवतो, आणि एक `package` जॉब जो इंस्टॉल करण्यायोग्य `mcp/` संग्रह (`.gitattributes` मध्ये सूचीबद्ध विकास आणि चाचणी फाइल्स वगळून) आणि त्याचा `SHA256SUMS` तयार करतो. Cacti ला स्पर्श करणाऱ्या चाचण्या Cacti हेल्पर सीमेवर फिक्स्चर वापरतात; त्या संपूर्ण Cacti इंस्टॉलेशनची चाचणी घेत नाहीत.

### एकात्मता चाचण्या (Integration tests)

`tests/integration/run.sh 1.2.31` किंवा `tests/integration/run.sh develop` कंटेनरमधील वास्तविक Cacti मध्ये प्लगइन इंस्टॉल करते आणि त्यावर थेट तपासण्या चालवते. यासाठी Compose v2.23.1 किंवा त्यानंतरच्या आवृत्तीसह Docker, git आणि openssl आवश्यक आहेत. `KEEP=1` डीबगिंगसाठी स्टॅक चालू ठेवते. CI हे दररोज रात्री आणि मागणीनुसार चालवते, पुल विनंत्यांवर (pull requests) नाही.

## स्थानिकीकरण

Cacti MCP `mcp` मजकूर डोमेन (`locales/po/mcp.pot`) वापरून, इंग्रजी आणि 47 इतर लोकेल्ससाठी (19 Broad Tier 1, 15 आफ्रिकन, 10 आशियाई, तसेच बोस्नियन, क्रोएशियन आणि सर्बियन लोकेल्स) `locales/po/` आणि `locales/LC_MESSAGES/` अंतर्गत संकलित GNU gettext कॅटलॉग आणि `docs/i18n/` अंतर्गत स्थानिकीकृत README पुरवते. भाषा समर्थन सक्षम केल्यावर Cacti जुळणारा कॅटलॉग आपोआप लोड करते.

## योगदान

पुल विनंत्या (Pull requests) `develop` शाखेकडे पाठवाव्यात. प्रोडक्शन कोड PHP 8.2 शी सुसंगत ठेवा आणि Cacti ची शैली वापरा: टॅब, एकेरी अवतरण चिन्हांतील स्ट्रिंग्स (single-quoted strings), आणि Cacti चे डेटाबेस व परवानगी हेल्पर्स. बदललेल्या प्रमाणीकरण (validation), अधिकृतता (authorization), किंवा प्रोटोकॉल वर्तनासाठी चाचण्या जोडा आणि `git commit -s` वापरून कमिट्सवर साइन ऑफ करा. HTTP API मधील बदलांसाठी [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) सोबत समन्वय साधा.

## परवाना

कॉपीराइट (C) 2026 Thomas Vincent. GNU General Public License, आवृत्ती 2 किंवा त्यानंतरच्या आवृत्ती अंतर्गत प्रकाशित. [LICENSE](../../../LICENSE) पहा.
