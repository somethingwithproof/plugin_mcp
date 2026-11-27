<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ڈھال کے ساتھ ایک کیکٹس۔ دریافت کریں۔ مجاز بنائیں۔ عمل درآمد کریں۔">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="لائسنس: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP ایک Cacti پلگ ان ہے جو AI کلائنٹس کو نامزد اور اجازت کے مطابق فلٹر کیے گئے آپریشنز (جنہیں صلاحیتیں یا abilities کہا جاتا ہے) کے ذریعے آپ کا Cacti ڈیٹا پڑھنے کی سہولت دیتا ہے۔ یہ پلگ ان خود انہیں دو طریقوں سے فراہم کرتا ہے: ایک MCP اینڈ پوائنٹ (`mcp.php`، Streamable HTTP) اور ایک AIP طرز کی HTTP API (`api.php`)۔ اختیارات اور عمل درآمد کا مکمل کنٹرول Cacti کے پاس رہتا ہے۔ کوئی کلائنٹ براہِ راست ڈیٹا بیس سے استفسار نہیں کرتا؛ وہ صرف اسی صلاحیت کو کال کر سکتا ہے جسے منتظم نے ظاہر کیا ہو اور جس کی اجازت ٹوکن کے مالک کے Cacti ریمز (realms) دیتے ہوں۔

پلگ ان مصنفین `abilities_register` ہُک کے ذریعے اپنی صرف پڑھنے کی (read-only) صلاحیتیں رجسٹر کر سکتے ہیں، اور وہ بغیر کسی پروٹوکول کوڈ کے MCP کلائنٹس کو ٹولز کے طور پر نظر آتی ہیں۔

**حیثیت: پیشگی ریلیز (pre-release)، ورژن 0.1.0۔** ابھی کوئی ٹیگ شدہ ریلیز موجود نہیں ہے۔

آج دستیاب خصوصیات:

- سسٹم کے ورژنز، ڈیوائسز، سائٹس، پولرز، گراف ٹریز، گرافس، ڈیٹا سورسز، اور ایک محدود، ریڈیکٹ شدہ Cacti لاگ ٹیل کا احاطہ کرنے والی نو صرف پڑھنے کی بلٹ ان صلاحیتیں۔
- واحد اسناد کے طور پر ذاتی رسائی کے ٹوکنز (`cmcp_pat_...`)۔
- مینجمنٹ > MCP کنسول: صلاحیتیں ظاہر یا مخفی کریں، ٹوکنز بنائیں اور منسوخ کریں، آڈٹ لاگ پڑھیں۔
- مینجمنٹ > میرے MCP ٹوکنز: صارفین اپنے ٹوکنز کا انتظام خود کرتے ہیں، اپنی سرگرمی دیکھتے ہیں، اور یہ دیکھتے ہیں کہ ان کے ٹوکنز کون سے ٹولز استعمال کر سکتے ہیں۔
- Streamable HTTP پر MCP، پروٹوکول ریویژنز `2026-07-28` اور `2025-11-25`، صرف ٹولز۔

ابھی دستیاب نہیں:

- OAuth 2.1 سائن ان۔ ہوسٹڈ کنیکٹرز جو ذاتی ٹوکن نہیں بھیج سکتے، جیسے ChatGPT اور claude.ai کسٹم کنیکٹرز، اس وقت تک منسلک نہیں ہو سکتے جب تک یہ موجود نہ ہو۔ اسے منصوبہ 2 (Plan 2) کے طور پر طے کیا گیا ہے؛ وہ منصوبہ ابھی تحریر نہیں کیا گیا۔
- لکھنے کی (Write) صلاحیتیں۔ صرف پڑھنے کی (read-only) صلاحیتیں ہی رجسٹر ہو سکتی ہیں۔

ڈیزائن [اینڈ پوائنٹ ڈیزائن کی تفصیلات](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md) میں موجود ہے، اور تعمیر کی ترتیب [docs/plan.md](../../plan.md) میں ہے۔

## بلٹ ان صلاحیتیں

| شناخت (ID) | زمرہ | دلائل (Arguments) | درکار Cacti ریم |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | کوئی نہیں | 15 |
| `cacti-list-devices` | `inventory` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-get-device` | `inventory` | لازمی `name`، جیسے `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-list-pollers` | `system` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 7 یا 4 |
| `cacti-list-graphs` | `inventory` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 7 یا 5 |
| `cacti-list-data-sources` | `inventory` | اختیاری `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-get-clog` | `system` | اختیاری `lines` (1 سے 200، ڈیفالٹ 50)، `severity`، `search` | 19 یا 18 |

ہر کال کے لیے ٹوکن کے مالک کے پاس **MCP اور Abilities API** ریم، `abilities:read` اسکوپ (یہ ہر ذاتی ٹوکن میں ہوتا ہے)، اور ایک ظاہر کردہ صلاحیت کا ہونا بھی ضروری ہے۔ کنسول کا صلاحیتوں (Abilities) والا ٹیب دکھاتا ہے کہ ہر بلٹ ان صلاحیت کو کون سا بنیادی ریم درکار ہے۔

تمام چھ `cacti-list-*` صلاحیتیں زیادہ سے زیادہ 100 آئٹمز کے صفحات (ڈیفالٹ 50) اور ایک `nextPageToken` لوٹاتی ہیں۔ صفحے کا ٹوکن صرف اسی `filter` اور `orderBy` کے لیے درست ہوتا ہے۔ `filter` موازنوں (`=`, `!=`, `<`, `<=`, `>`, `>=`) کا ایک AIP-160 ایکسپریشن ہے جو `AND` سے جڑا ہوتا ہے، مثال کے طور پر `state = "DOWN" AND disabled = false`۔ `orderBy` کوما سے الگ کیے گئے ترتیب دینے کے قابل فیلڈز کی فہرست قبول کرتا ہے، جن میں سے ہر ایک کے بعد اختیاری طور پر `asc` یا `desc` آ سکتا ہے۔

| صلاحیت | فلٹر فیلڈز | ترتیب کے فیلڈز |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`، `hostname`، `disabled`، `site`، `poller`، `deviceTemplate`، `externalId`، `state` (`UNKNOWN`، `DOWN`، `RECOVERING`، `UP`، `ERROR`) | `displayName`، `hostname`، `name` |
| `cacti-list-sites` | `displayName`، `city`، `state`، `country`، `timezone`، `alternateId` | `displayName`، `city`، `state`، `country`، `name` |
| `cacti-list-pollers` | `displayName`، `hostname`، `disabled`، `state` (`NEW`، `RUNNING`، `IDLE`، `UNKNOWN`، `DISABLED`، `RECOVERING`، `ERROR`) | `displayName`، `hostname`، `name` |
| `cacti-list-trees` | `displayName`، `enabled` | `displayName`، `name` |
| `cacti-list-graphs` | `title`، `device`، `graphTemplate`، `templateName` | `title`، `templateName`، `name` |
| `cacti-list-data-sources` | `displayName`، `device`، `dataTemplate`، `active` | `displayName`، `name` |

اجازت کا دائرہ کار اور خفیہ معلومات کا اخراج:

- `cacti-list-devices` اور `cacti-get-device` Cacti کے `get_allowed_devices()` کے ذریعے استفسار کرتے ہیں اور SNMP کمیونٹی سٹرنگز، پاس فریزز، اور دیگر اسناد کو خارج کرتے ہیں۔
- `cacti-list-trees` `get_allowed_trees()` کے ذریعے استفسار کرتا ہے (اور دستیاب ہونے پر `is_tree_allowed()` سے فلٹر کرتا ہے)؛ `cacti-list-graphs` `get_allowed_graphs()` کے ذریعے استفسار کرتا ہے (اور دستیاب ہونے پر `is_graph_allowed()` سے فلٹر کرتا ہے)۔
- `cacti-list-data-sources` قطاروں کو `get_allowed_devices()` (اور دستیاب ہونے پر `is_device_allowed()`) سے کالر کی مجاز ڈیوائسز تک محدود کرتا ہے اور `data_input_data` سے استفسار کیے بغیر یا خفیہ ان پٹ اقدار کو ظاہر کیے بغیر صرف میٹا ڈیٹا لوٹاتا ہے۔
- `cacti-list-pollers` ڈیٹا بیس کی اسناد (`dbpass`، `dbuser`) اور TLS کلید و سرٹیفکیٹ کے کالمز (`dbsslkey`، `dbsslcert`، `dbsslca`) کو خارج کرتا ہے۔
- `cacti-get-clog` کنفیگر کردہ Cacti لاگ کے آخری 1 MiB تک پڑھتا ہے (2048 بائٹس سے زیادہ کی انفرادی سطروں کو کاٹتے ہوئے)، `severity` (`ALL`، `DEBUG`، `INFO`، `NOTICE`، `WARNING`، `ERROR`، `CRITICAL`، `ALERT`، `EMERGENCY`، `FATAL`، `STATS`، `POLLER`، `SYSTEM`؛ ڈیفالٹ `ALL`) اور کیس سے غیر حساس `search` (256 حروف تک) کے ذریعے فلٹر کرتا ہے، اور `lines`، `count`، اور `truncated` لوٹاتا ہے۔ `severity` اور `search` فلٹرز چلنے سے پہلے ہی ہر سطر کو ذاتی ٹوکنز، bearer/basic ہیڈرز، پاس ورڈز، اسرار، SNMP کمیونٹیز، کلیدوں، `dbpass`، `dbsslkey`، اور URL صارف معلومات کے لیے ریڈیکٹ کیا جاتا ہے تاکہ `search` خفیہ معلومات کے اوریکل کے طور پر کام نہ کر سکے۔ ریڈیکشن ناکامی کی صورت میں `[redacted]` کے ساتھ بند ہو جاتی ہے، اور ناقابلِ مطالعہ لاگ `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`) لوٹاتا ہے۔

## تنصیب

اس کے لیے Cacti 1.2.31 یا اس سے جدید ورژن، PHP 8.2 یا اس سے جدید ورژن، اور مرکزی پولر (main poller) درکار ہیں۔ Cacti کی توثیق (authentication) فعال ہونی چاہیے؛ جب یہ بند ہو تو پلگ ان توثیق کرنے سے انکار کر دیتا ہے۔

پلگ ان کی ڈائریکٹری کا نام `mcp` ہونا ضروری ہے، `plugin_mcp` نہیں۔ پلگ ان سلگ، ریم کے نام، ترجمے کا ڈومین، اور URLs سب `mcp` استعمال کرتے ہیں۔

سورس چیک آؤٹ سے:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

جب تک ٹیگ شدہ ریلیزز موجود نہیں ہوتیں، آپ اس کے بجائے کسی کامیاب [CI رن](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) سے `mcp-plugin` آرٹیفیکٹ ڈاؤن لوڈ کر سکتے ہیں۔ اس میں `mcp.tar.gz` اور `SHA256SUMS` شامل ہیں۔ چیک سم کی تصدیق کریں، پھر `mcp.tar.gz` کو Cacti کی `plugins/` ڈائریکٹری کے اندر اس طرح نکالیں کہ نتیجہ `plugins/mcp/` ہو۔ GitHub کے خودکار سورس آرکائیوز ایک مختلف اعلیٰ سطحی ڈائریکٹری نام استعمال کرتے ہیں۔ اس آرکائیو میں `docs/` (بشمول نیچے دیے گئے اسکرین شاٹس)، `tests/`، اور `.github/` شامل نہیں ہوتے، اس لیے README میں `docs/` کے لنکس GitHub پر کام کرتے ہیں لیکن نصب شدہ کاپی میں نہیں۔

اس کے بعد:

1. پلگ ان مینجمنٹ میں **Cacti MCP** کو نصب اور فعال کریں۔ نصب کرنے والے منتظم کو **MCP ایڈمنسٹریشن** ریم خودکار طور پر مل جاتا ہے۔
2. ترتیبات > MCP کے تحت، **عوامی Cacti URL** کو اس پتے پر سیٹ کریں جو کلائنٹس استعمال کرتے ہیں، مثال کے طور پر `https://cacti.example.com/cacti`۔ `localhost`، `127.0.0.1`، اور `[::1]` کے علاوہ HTTPS لازمی ہے۔ جب تک یہ سیٹ نہ ہو، `mcp.php` HTTP 400 کے ساتھ ایک JSON-RPC خرابی کا جواب دیتا ہے جس کا `data` `FAILED_PRECONDITION` اور `PUBLIC_URL_REQUIRED` ہوتا ہے۔ `api.php` اسے نہیں پڑھتا۔

   ![ترتیبات > MCP میں عوامی Cacti URL کا خانہ دکھایا گیا ہے](../../images/settings-public-url.png)

3. ہر اس صارف کو **MCP اور Abilities API** ریم عطا کریں جو ٹوکن کا مالک ہوگا۔ کسی صارف کو یہ خودکار طور پر نہیں ملتا۔
4. یقینی بنائیں کہ ویب سرور `Authorization` ہیڈر اور پاتھ انفو (path info) کو PHP تک منتقل کرتا ہے (نیچے دیکھیں)۔
5. مینجمنٹ > MCP کھولیں اور ان صلاحیتوں کو ظاہر کریں جنہیں آپ چاہتے ہیں کہ کلائنٹس دیکھیں۔

**ڈیولپمنٹ بلڈ سے اپ گریڈ کرنا۔** یہ پلگ ان پیشگی ریلیز مرحلے میں ہے، اور ڈیولپمنٹ کے دوران اس کے ٹیبلز بغیر مائیگریشن کے تبدیل ہوئے ہیں۔ اگر آپ نے کوئی پرانا بلڈ نصب کیا تھا تو اسے ان انسٹال کریں اور دوبارہ نصب کریں۔ دوبارہ نصب کرنے سے پہلے سے موجود ٹیبلز برقرار رہتے ہیں، اس لیے پہلے پرانے `plugin_mcp_token`، `plugin_mcp_audit`، اور `plugin_mcp_ability` ٹیبلز کو حذف کر دیں (اور نام کی تبدیلی سے پہلے بنائے گئے بلڈز کے مساوی ٹیبلز کو بھی)۔ اگر آپ کو ان کی تاریخ درکار ہو تو ان کا بیک اپ لے لیں؛ ان بلڈز کے ٹوکنز ان انسٹال کرنے پر منسوخ ہو جاتے ہیں اور آگے منتقل نہیں ہوتے۔

### ویب سرور

Apache کے وہ سیٹ اپس جو PHP سے پہلے `Authorization` کو ہٹا دیتے ہیں، انہیں متعلقہ ورچوئل ہوسٹ یا ڈائریکٹری میں اس کی ضرورت ہوتی ہے، اور اس کے بعد ری لوڈ کرنا ہوتا ہے:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` کے ساتھ Apache نے بغیر کسی اضافی پاتھ کنفیگریشن کے `api.php` روٹس فراہم کیے۔

`api.php` روٹس اسکرپٹ کے نام کے بعد پاتھ میں ہوتے ہیں (`/plugins/mcp/api.php/v1/abilities`)، اس لیے nginx کو ایسے URIs سے مطابقت رکھنی چاہیے جہاں `.php` کے بعد مزید پاتھ ہو، پاتھ انفو کو الگ کرے، اور اسے PHP کو بھیجے۔ `location ~ \.php$` بلاک ان URLs سے کبھی مطابقت نہیں رکھتا؛ nginx اپنے HTML 404 کے ساتھ جواب دیتا ہے۔ نیچے دیا گیا لوکیشن پیٹرن اور دو پاتھ انفو لائنیں PHP-FPM کے ساتھ تصدیق شدہ ہیں؛ باقی لائنیں معیاری بوائلر پلیٹ ہیں:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

پہلے سے Cacti چلانے والے بلاک سے مطابقت کے لیے `include` اور `fastcgi_pass` لائنوں کو ایڈجسٹ کریں۔ اس بلاک میں `try_files $fastcgi_script_name =404;` شامل نہ کریں: یہ `$fastcgi_path_info` کو صاف کر دیتا ہے، اور پھر `api.php` 404 `UNKNOWN_PATH` کا جواب دیتا ہے۔ اگر آپ کی کنفیگریشن کو `try_files` کی ضرورت ہو تو پہلے `set $path_info $fastcgi_path_info;` کے ذریعے قدر محفوظ کریں اور `fastcgi_param PATH_INFO $path_info;` پاس کریں۔

`mcp.php` میں کوئی پاتھ روٹس نہیں ہیں اور اسے ان کی ضرورت نہیں ہے۔

## کنسول

مینجمنٹ > MCP میں تین ٹیبز ہیں۔ آپ کو **MCP ایڈمنسٹریشن** ریم کی ضرورت ہے۔ یہاں اور نیچے دیے گئے اسکرین شاٹس مثالی ڈیٹا کے ساتھ Cacti کے ڈیولپمنٹ بلڈ سے لیے گئے ہیں۔

- **صلاحیتیں (Abilities)** ہر رجسٹرڈ صلاحیت کو اس کے پلگ ان، زمرے، درکار ریم، اور اس بات کے ساتھ فہرست میں دکھاتا ہے کہ آیا یہ ظاہر کی گئی ہے یا نہیں۔ قطاریں منتخب کریں اور ظاہر کریں (Expose) یا مخفی کریں (Hide) چنیں؛ تبدیلی لاگو ہونے سے پہلے آپ تصدیق کرتے ہیں۔ بلٹ ان `cacti-*` صلاحیتیں ڈیفالٹ طور پر ظاہر ہوتی ہیں۔ دوسرے پلگ انز کی صلاحیتیں مخفی طور پر شروع ہوتی ہیں، اس لیے کوئی پلگ ان نصب کرنے سے اس وقت تک کچھ شائع نہیں ہوتا جب تک منتظم خود فیصلہ نہ کرے۔ ظاہر کرنا صرف رسائی کو محدود دائرے میں کھولا جاتا ہے: صارف کو پھر بھی اس صلاحیت کے ریم کی ضرورت ہوتی ہے۔

  ![صلاحیتوں کا ٹیب جس میں بلٹ ان صلاحیتیں، ان کے ریمز اور دستیابی کی حالت درج ہے](../../images/console-abilities.png)
- **ٹوکنز (Tokens)** ٹوکنز کو مالک، تخلیق کار، تخلیق کے وقت، میعادِ خاتمہ، آخری استعمال، اور حالت (فعال، زائد المیعاد، منسوخ) کے ساتھ فہرست میں دکھاتا ہے۔ قطاریں منتخب کریں اور انہیں منسوخ کرنے کے لیے Revoke چنیں۔ منسوخ شدہ ٹوکنز دوبارہ استعمال نہیں ہو سکتے۔ Create Token نیا ٹوکن بناتا ہے۔

  ![ٹوکنز کا ٹیب جس میں مالک، میعادِ خاتمہ، آخری استعمال، اور حالت کے ساتھ ٹوکنز کی فہرست، ٹوکن بنانے کے فارم کے اوپر موجود ہے](../../images/console-tokens.png)
- **آڈٹ (Audit)** آڈٹ کی قطاریں دکھاتا ہے، تازہ ترین سب سے پہلے، اور صارف، صلاحیت، اور نتیجے کے حساب سے فلٹر کرتا ہے۔

  ![آڈٹ ٹیب جس میں صارف، ٹوکن، صلاحیت، اور نتیجے کے ساتھ کالز کی فہرست اور فلٹرز موجود ہیں](../../images/console-audit.png)

## ٹوکنز

ایک ذاتی ٹوکن اپنے مالک کی حیثیت سے Cacti کو پڑھتا ہے۔ اس کی شکل `cmcp_pat_` کے بعد 64 چھوٹے حروفِ تہجی والے ہیکس (hex) حروف پر مشتمل ہوتی ہے اور اس میں واحد اسکوپ `abilities:read` ہوتا ہے۔ یہ کیا دیکھ سکتا ہے اس کا فیصلہ ٹوکن کے بجائے اس کے مالک کے Cacti ریمز اور ڈیوائس کی اجازتوں سے ہوتا ہے۔ مالک کا ایک فعال صارف ہونا ضروری ہے جس کے پاس **MCP اور Abilities API** ریم موجود ہو۔

ٹوکنز ہمیشہ کسی صارف کے لیے بنائے جاتے ہیں، ان کی میعاد ختم ہوتی ہے، اور انہیں منسوخ کیا جا سکتا ہے:

- **کنسول۔** مینجمنٹ > MCP > ٹوکنز > نیا ٹوکن بنائیں۔ مدت 1 سے 365 دن تک ہوتی ہے اور ڈیفالٹ 90 ہے۔ ٹوکن سرور کے ذریعے تیار کیا جاتا ہے اور جوابی صفحے پر ایک بار دکھایا جاتا ہے، اس لیے اسے فوراً اپنے سیکرٹ مینیجر میں کاپی کر لیں۔ آپ اپنے لیے ٹوکن بنا سکتے ہیں۔ کسی دوسرے صارف کے لیے ٹوکن بنانے کے لیے صارفین/گروپس (Users/Groups) ریم کی بھی ضرورت ہوتی ہے، کیونکہ ٹوکن اس صارف کی حیثیت سے Cacti پڑھتا ہے۔
- **میرے MCP ٹوکنز۔** MCP اور Abilities API ریم والا کوئی بھی صارف اپنے ٹوکنز کا انتظام خود کر سکتا ہے؛ نیچے دیکھیں۔
- **کمانڈ لائن۔** `tokens.php` صرف CLI سے چلتا ہے، ایسے OS اکاؤنٹ کے طور پر جو Cacti کا انتظام کر سکتا ہو۔ یہ ٹوکن کو ماحول (environment) سے لیتا ہے تاکہ قدر کبھی کمانڈ لائن یا پروسیس لسٹ میں ظاہر نہ ہو۔ مدت 1 سے 365 دن تک ہوتی ہے اور ڈیفالٹ 30 ہے۔ CLI کے ذریعے ٹوکن بنانا اور منسوخ کرنا کنسول کی طرح آڈٹ ہوتا ہے، جس میں ٹوکن کے مالک کو فاعل (actor) کے طور پر درج کیا جاتا ہے کیونکہ CLI کا کوئی Cacti صارف نہیں ہوتا، اس لیے آڈٹ کی قطار اس عمل کو CLI سے آنے والا ظاہر نہیں کرتی۔ `--list` ہر ٹوکن کو JSON کے طور پر پرنٹ کرتا ہے (ID، مالک، اسکوپس، ٹائم اسٹیمپس، منسوخی کا فلیگ) اور کبھی ٹوکن کی قدر نہیں دکھاتا؛ `--help` استعمال کا طریقہ دکھاتا ہے۔

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

مہمان (guest) اکاؤنٹ، غیر فعال صارفین، یا **MCP اور Abilities API** ریم کے بغیر صارفین کے لیے نہ کنسول سے، نہ کمانڈ لائن سے، اور نہ ہی میرے MCP ٹوکنز سے ٹوکنز بنائے جا سکتے ہیں۔ Cacti مہمان کی ترتیب کو یوزر نام یا یوزر ID کے طور پر محفوظ کرتا ہے، اور پلگ ان دونوں کو حل کرتا ہے۔ جس ٹوکن کا مالک مہمان اکاؤنٹ بن جائے وہ اپنی اگلی درخواست پر کام کرنا بند کر دیتا ہے۔

### میرے MCP ٹوکنز

مینجمنٹ > میرے MCP ٹوکنز (`plugins/mcp/mcp_tokens.php`) کو کسی ایڈمنسٹریشن ریم کی ضرورت نہیں ہے: یہ **MCP اور Abilities API** ریم کے تحت آتا ہے، اور مینو کا اندراج صرف ان صارفین کو نظر آتا ہے جن کے پاس یہ ریم ہو۔ یہ صفحہ ہمیشہ سائن ان صارف پر عمل کرتا ہے۔ Cacti کا مینو کنسول کا حصہ ہے، اس لیے کنسول تک رسائی کے بغیر صارف اس صفحے تک اس کے پتے کے ذریعے پہنچتا ہے۔

![میرے ٹوکنز کا ٹیب جس میں لاگ ان صارف کے ٹوکنز کی فہرست اور نیا ٹوکن بنانے کا فارم موجود ہے](../../images/my-tokens.png)

- **ٹوکنز** آپ کے ٹوکنز کی فہرست دکھاتا ہے، ایک نیا ٹوکن بناتا ہے (1 سے 365 دن، ڈیفالٹ 90، جواب میں ایک بار دکھایا جاتا ہے)، اور آپ کے اپنے ٹوکنز کو منسوخ کرتا ہے۔ آپ کسی اور کے ٹوکنز نہیں دیکھ سکتے اور نہ ہی منسوخ کر سکتے ہیں۔
- **سرگرمی (Activity)** آپ کے کیے گئے اعمال کی فہرست دکھاتا ہے، تازہ ترین سب سے پہلے: آپ کے ٹوکنز کے ساتھ کی گئی کالز اور ٹوکن میں کی گئی تبدیلیاں۔
- **دستیاب ٹولز (Available Tools)** ان صلاحیتوں کی فہرست دکھاتا ہے جنہیں آپ کا کوئی ٹوکن اس وقت استعمال کر سکتا ہے، ہر صلاحیت کی ID، نام، اور تفصیل کے ساتھ۔ یہ آپ کی Cacti اجازتوں اور منتظم کی منتخب کردہ نمائش (exposure) کی ترتیبات کی پیروی کرتا ہے۔

  ![دستیاب ٹولز کی فہرست جس میں ہر صلاحیت کی ID، نام، اور تفصیل دکھائی گئی ہے](../../images/my-tools.png)

اس صفحے کے وجود میں آنے سے پہلے کی گئی تنصیب میں ریم فائل کی فہرست `mcp_tokens.php` کے بغیر ہوتی ہے۔ تنصیب (Install) فہرست کو رجسٹر کرتی ہے؛ پلگ ان کو فعال یا غیر فعال کرنے سے یہ اپ ڈیٹ نہیں ہوتی۔ پلگ ان کو ان انسٹال کریں اور دوبارہ نصب کریں، پھر دوبارہ ریمز عطا کریں، کیونکہ پلگ ان ان انسٹال کرنے پر Cacti ریم کی اجازتیں ہٹا دیتا ہے۔

ڈیٹا بیس میں ٹوکن کا صرف SHA-256 ہیش محفوظ کیا جاتا ہے، اس لیے کھویا ہوا ٹوکن بحال نہیں کیا جا سکتا؛ اسے منسوخ کریں اور دوسرا بنائیں۔ تبدیلی (Rotation) کا طریقہ بھی یہی ہے: نیا ٹوکن بنائیں، کلائنٹ کو تبدیل کریں، پھر پرانا منسوخ کر دیں۔ زائد المیعاد ٹوکن، منسوخ شدہ ٹوکن، غیر فعال مالک، یا کھویا ہوا ریم، ان میں سے ہر ایک اگلی درخواست پر ناکام ہو جاتا ہے۔ ٹوکنز صرف `Authorization: Bearer` ہیڈر میں قبول کیے جاتے ہیں؛ کوئری سٹرنگ یا باڈی میں دیا گیا ٹوکن قبول نہیں کیا جاتا۔

## کلائنٹ کو منسلک کریں

MCP اینڈ پوائنٹ `https://cacti.example.com/cacti/plugins/mcp/mcp.php` استعمال کریں، جس میں ٹوکن `Authorization: Bearer` ہیڈر میں ہو۔ ٹوکن کو کسی ماحولیاتی متغیر یا سیکرٹ مینیجر میں محفوظ رکھیں اور اس کی قدر کو فائل میں لکھنے کے بجائے کلائنٹ کی کنفیگریشن سے اس کا حوالہ دیں۔

### Claude Code

اینڈ پوائنٹ کو پروجیکٹ کی `.mcp.json` فائل میں رکھیں جو نام کے ذریعے ٹوکن کا حوالہ دیتی ہو۔ Claude Code `url` اور `headers` میں `${VAR}` کو خود پھیلا دیتا ہے، اس لیے فائل میں کوئی خفیہ معلومات موجود نہیں ہوتیں اور اسے کمٹ کرنا محفوظ ہے۔ اس ماحول میں `CACTI_MCP_TOKEN` ایکسپورٹ کریں جو Claude Code کو شروع کرتا ہے۔

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

آپ اسے کمانڈ لائن سے بھی شامل کر سکتے ہیں:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

ڈبل کوٹس کے ساتھ، آپ کا شیل پہلے `$CACTI_MCP_TOKEN` کو پھیلا دیتا ہے، اس لیے منتخب کردہ `--scope` (`local`، `user`، یا `project`؛ طے شدہ `local`) کے لیے ٹوکن کی قدر کنفیگریشن فائل میں لکھ دی جاتی ہے۔ اس شکل کو `--scope project` کے ساتھ استعمال نہ کریں، اور فائل کو ورژن کنٹرول سے باہر رکھیں۔ اوپر دیے گئے `.mcp.json` حوالے کو ترجیح دیں۔ Claude Code کچھ اسنادی متغیرات (مثلاً `ANTHROPIC_AUTH_TOKEN`) کو ریموٹ `url` اور `headers` میں خالی پڑھتا ہے؛ `CACTI_MCP_TOKEN` ان میں شامل نہیں ہے۔ ماخذ: [Claude Code MCP دستاویزات](https://code.claude.com/docs/en/mcp)۔

### VS Code میں GitHub Copilot

ورک اسپیس کی جڑ میں موجود `.mcp.json` (یا صارف کی فائل `~/.copilot/mcp-config.json`) استعمال کریں۔ یہ Copilot کی مقامی فائلیں اعلیٰ سطحی `mcpServers` آبجیکٹ اور ہیڈر کی قدروں میں `${NAME}` ماحولیاتی متغیر کے حوالے استعمال کرتی ہیں:

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

اس ماحول میں `CACTI_MCP_TOKEN` ایکسپورٹ کریں جو VS Code کو شروع کرتا ہے۔ مقامی Copilot فائلیں `inputs` پرامپٹس کی معاونت نہیں کرتیں۔ VS Code کا گائیڈڈ سیٹ اپ `${...}` قدروں کو مسترد کر دیتا ہے، اس لیے `Authorization` ہیڈر کو گائیڈڈ فلو کے ذریعے نہیں بلکہ فائل میں ترمیم کر کے شامل کریں۔ گائیڈڈ سیٹ اپ ورک اسپیس کی جڑ والی فائل صرف اس وقت پیش کرتا ہے جب تجرباتی `chat.mcp.workspaceRootConfig.enabled` ترتیب آن ہو۔ دیکھیں [VS Code MCP کنفیگریشن کا حوالہ](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)۔

**قدیم طریقہ: `.vscode/mcp.json`.** VS Code کا کہنا ہے کہ نئی Copilot کنفیگریشنز میں `.vscode/mcp.json` یا پروفائل `mcp.json` استعمال نہیں کرنی چاہئیں؛ یہ متروک Local ہارنس سے تعلق رکھتی ہیں، جسے فروری 2027 میں ہٹا دیا جائے گا۔ اگر آپ اب بھی اسے استعمال کرتے ہیں، تو ایڈیٹر کے زیرِ انتظام فارمیٹ اعلیٰ سطحی `servers` کلید لیتا ہے اور ٹوکن کے لیے پرامپٹ کر سکتا ہے:

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

### صرف stdio استعمال کرنے والے کلائنٹس

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ایک اختیاری اڈاپٹر ہے جو مقامی stdio MCP سرور کے طور پر چلتا ہے اور پلگ ان کے HTTP API کو کال کرتا ہے۔ اسے ایسے کلائنٹ کے لیے استعمال کریں جو ریموٹ HTTP سرور سے منسلک نہیں ہو سکتا۔ اسے وہی ذاتی ٹوکن درکار ہوتا ہے اور یہ `api.php` سے بات چیت کرتا ہے۔

### MCP کا برتاؤ

یہ اینڈ پوائنٹ صرف ٹولز فراہم کرتا ہے: ہر ظاہر کردہ، مجاز صلاحیت ایک ٹول ہے جس کا نام اس کی ID کے مطابق ہوتا ہے، اور اس کے ساتھ اس کے ان پٹ اور آؤٹ پٹ اسکیماز اور صرف پڑھنے کے لیے تشریحات (`openWorldHint` کی قدر `false` ہے) شامل ہوتی ہیں۔ یہ `initialize`، `server/discover`، `ping`، `tools/list`، اور `tools/call` کو سنبھالتا ہے۔ یہ کوئی سیشن برقرار نہیں رکھتا، `Mcp-Session-Id` نہیں بھیجتا (اور موصول ہونے والے کو نظر انداز کر دیتا ہے)، اور JSON-RPC بیچز قبول نہیں کرتا۔ `id` کے بغیر پیغام ایک نوٹیفکیشن ہوتا ہے اور اسے بغیر باڈی کے HTTP 202 ملتا ہے۔ صرف `POST` کی اجازت ہے۔

- **نظرثانیاں۔** کوئی درخواست جو `params._meta` میں `io.modelcontextprotocol/protocolVersion` لے کر آتی ہے، اسے لازماً `2026-07-28` کا نام دینا چاہیے؛ اس کے علاوہ کچھ بھی ہونے پر `-32022` خرابی ملتی ہے۔ ایسی درخواستوں میں مماثل `Mcp-Protocol-Version`، `Mcp-Method`، اور (`tools/call` کے لیے) `Mcp-Name` ہیڈرز بھی ہونے چاہئیں، ورنہ جواب `-32020` خرابی ہوتی ہے۔ دیگر درخواستوں کو `2025-11-25` کے طور پر برتا جاتا ہے: `initialize` اسی نظرثانی کے ساتھ جواب دیتا ہے، اور کسی بھی دوسرے میتھڈ پر `Mcp-Protocol-Version` ہیڈر، اگر بھیجا جائے، تو لازماً `2025-11-25`، `2025-06-18`، یا `2025-03-26` ہونا چاہیے۔
- **ٹول کی خرابیاں۔** صلاحیت کی کوئی خرابی، بشمول ایسے دلائل جو اسکیما سے مطابقت نہیں رکھتے یا `arguments` کی ایسی قدر جو JSON آبجیکٹ نہیں ہے، پروٹوکول کی خرابی کے بجائے `isError: true` اور `structuredContent` میں AIP-193 خرابی کے ساتھ ٹول کے نتیجے کے طور پر واپس آتی ہے۔
- **پروٹوکول کی خرابیاں۔** وہ ناکامیاں جو ٹول کی خرابیاں نہیں ہیں، JSON-RPC ایرر آبجیکٹس ہوتی ہیں (کوڈ `-32000` جس کے `data` میں اسٹیٹس اور وجہ ہوتی ہے، یا معیاری کوڈز): گمشدہ Public Cacti URL، مسترد شدہ `Origin`، پلگ ان غیر فعال ہونے یا ریموٹ پولر پر کی گئی درخواست، اور غیر متوقع سرور خرابیاں (`-32603`، جن کی تفصیل جواب کے بجائے Cacti لاگ میں لکھی جاتی ہے)۔ درخواست کی جو جانچ پڑتال پہلے چلتی ہے (405، 413، 415) اور توثیقی ناکامیاں (401 `INVALID_TOKEN`، 403 `REALM_REQUIRED`) HTTP API کے تحت بیان کردہ AIP-193 باڈی کو برقرار رکھتی ہیں۔

## HTTP API

بنیادی URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`۔ معاہدہ [openapi.json](../../../openapi.json) میں موجود ہے۔

| میتھڈ اور راستہ | مقصد |
| --- | --- |
| `GET /v1/abilities` | مجاز صلاحیتوں کی فہرست بنائیں۔ کوئیری: `pageSize`، `pageToken`، اور `category = "inventory"` کی شکل میں `filter`۔ |
| `GET /v1/abilities/{id}` | ایک صلاحیت پڑھیں۔ |
| `POST /v1/abilities/{id}:execute` | اسے چلائیں۔ باڈی بالکل `{"arguments": {...}}` ہے۔ جواب `{"requestId": "...", "result": {...}}` ہے۔ |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

خرابیاں AIP-193 کی پیروی کرتی ہیں: ایک `error` آبجیکٹ جس میں `code`، `message`، `status`، اور `details` شامل ہوتے ہیں جو `cacti.net` ڈومین اور ایک مستحکم `reason` کے ساتھ `ErrorInfo` رکھتا ہے۔ دلیل کے مسائل فیلڈ کا نام بتانے والی `BadRequest` تفصیل شامل کرتے ہیں۔ درخواست کی باڈیز 64 KB تک، اور نتائج 1 MB تک محدود ہیں۔ دونوں اینڈ پوائنٹس صرف مرکزی پولر پر جواب دیتے ہیں اور جب پلگ ان غیر فعال ہو یا سرور مرکزی پولر نہ ہو تو `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) واپس کرتے ہیں۔

| HTTP | `reason` کی قدریں |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`، `INVALID_FILTER`، `INVALID_PAGE_TOKEN`، `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer` بھی بھیجتا ہے) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`، `DEVICE_NOT_FOUND`، `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` بھیجتا ہے) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`، `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`، `PLUGIN_UNAVAILABLE`، `CACTI_UNAVAILABLE` |

## صلاحیت لکھیں (پلگ ان مصنفین)

ایک فعال Cacti پلگ ان اس فنکشن سے صلاحیتوں کو رجسٹر کرتا ہے جسے وہ `abilities_register` ہک کے ساتھ منسلک کرتا ہے، عموماً اپنی `plugin_<slug>_install()` میں:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

فنکشن کو پلگ ان کے دائرہ کار میں ایک `AbilitiesRegistrar` موصول ہوتا ہے۔ اس کی واپسی کی قدر کو نظر انداز کر دیا جاتا ہے۔

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

قواعد، جن کی پابندی رجسٹریشن کے وقت کرائی جاتی ہے:

- **IDs۔** ایک ID `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` سے میل کھاتی ہے، زیادہ سے زیادہ 64 حروف پر مشتمل ہوتی ہے، اور اسے لازماً پلگ ان کے سلگ اور ایک ہائفن سے شروع ہونا چاہیے: اوپر دی گئی مثال میں `acme-`۔ سلگ پلگ ان کی ڈائریکٹری کا نام ہوتا ہے، اس لیے `my_plugin` جیسی ڈائریکٹری کچھ بھی رجسٹر نہیں کر سکتی۔ `cacti` نامی پلگ ان ڈائریکٹری مسترد کر دی جاتی ہے؛ وہ نیم اسپیس بلٹ انز سے تعلق رکھتی ہے۔
- **تعریف۔** بالکل یہی کلیدیں: `label`، `description` (4096 بائٹس تک)، `category`، `input_schema`، `output_schema`، `annotations`، `permission`، `execute`۔ زمرہ پہلے سے موجود ہونا ضروری ہے: بلٹ ان (`inventory`، `system`) استعمال کریں یا `registerCategory()` کے ساتھ اپنا رجسٹر کریں، جس کی ID تمام پلگ انز میں منفرد ہو اور `^[a-z][a-z0-9-]{0,31}$` سے میل کھاتی ہو۔
- **صرف پڑھنے کے قابل۔** `annotations` کو لازماً بالکل `readOnly: true`، `destructive: false`، `idempotent: true` ہونا چاہیے۔ اس کے علاوہ کچھ بھی ایرر تھرو کرتا ہے۔
- **اسکیماز۔** `input_schema` اور `output_schema` میں سے ہر ایک کے اعلیٰ سطح پر `type` کی قدر `object` ہونی چاہیے۔ یہ ڈائلیکٹ چھوٹا ہے اور ناکامی پر بند ہو جاتا ہے۔ آبجیکٹس کا بند ہونا ضروری ہے (`additionalProperties: false`، اور `properties` موجود ہوں)؛ دیگر اقسام `integer` اور `number` (`minimum`، `maximum`)، `string` (`minLength`، `maxLength`، `enum`، `pattern`)، `boolean`، اور `array` (جسے `items` اور `maxItems` درکار ہوتے ہیں) ہیں۔ کسی قسم کو `['string', 'null']` کے طور پر نل ایبل بنایا جا سکتا ہے۔ دلائل کی اسٹرنگز طے شدہ طور پر زیادہ سے زیادہ 4096 حروف کی ہوتی ہیں؛ نتیجے کی اسٹرنگز صرف اعلان کردہ `maxLength` اور نتیجے کے حجم کی حد تک محدود ہوتی ہیں۔ زیادہ سے زیادہ 256 صلاحیتیں رجسٹر ہو سکتی ہیں۔
- **`permission(int $userId): bool`.** اجازت دینے کے لیے لازماً بالکل `true` واپس کرنا چاہیے۔ صارف کی ID ٹوکن کے مالک کی ہوتی ہے؛ سیشن اسٹیٹ کو کبھی نہ پڑھیں۔
- **`execute(int $userId, stdClass $args): array`.** `$args` کی توثیق پہلے ہی `input_schema` کے مقابلے میں ہو چکی ہوتی ہے۔ آبجیکٹ کی سطح کی اجازتیں خود نافذ کریں۔ ایک ایسا ایسوسی ایٹو ارے واپس کریں جو بالکل `output_schema` سے میل کھاتا ہو؛ کوئی لسٹ، کوئی اضافی فیلڈ، یا 1 MB سے زیادہ JSON ایک `INVALID_RESULT` خرابی بن جاتا ہے۔ کلائنٹ کو نظر آنے والی ناکامی، جیسے کہ `NOT_FOUND` کے لیے `AbilitiesError` تھرو کریں۔
- **خالی آبجیکٹس۔** PHP `[]` کو JSON ارے کے طور پر انکوڈ کرتا ہے۔ جہاں کہیں بھی آؤٹ پٹ اسکیما کسی بھی گہرائی پر `object` کا اعلان کرتا ہے، رجسٹری `[]` کو خالی آبجیکٹ کے طور پر لیتی ہے اور `{}` بھیجتی ہے؛ `new stdClass()` بھی کام کرتا ہے۔ کوئی غیر خالی لسٹ کبھی بھی آبجیکٹ شمار نہیں ہوتی اور `INVALID_RESULT` کے ساتھ ناکام ہو جاتی ہے۔ اسکیما میں خالی `properties` میپ `[]` یا `new stdClass()` ہو سکتا ہے؛ دونوں `{}` کے طور پر شائع ہوتے ہیں۔
- **ناکامی کی علیحدگی۔** ہر پلگ ان ایک عارضی کاپی میں رجسٹر ہوتا ہے جسے صرف اسی صورت میں برقرار رکھا جاتا ہے جب آپ کا فنکشن عام طور پر واپس آئے۔ اگر یہ تھرو کرے، تو آپ کی کوئی بھی صلاحیت رجسٹر نہیں ہوتی، اور ناکامی کو لاگ کر لیا جاتا ہے۔

پلگ انز سے آنے والی صلاحیتیں پوشیدہ شروع ہوتی ہیں۔ منتظم انہیں کنسول کے Abilities ٹیب پر ظاہر کرتا ہے، اور ان کے لیے Required Realm کالم میں "Set by the plugin" لکھا ہوتا ہے۔

## سیکیورٹی ماڈل

- **صرف Bearer ٹوکن۔** `api.php` اور `mcp.php` صرف `Authorization` ہیڈر میں ذاتی ٹوکن قبول کرتے ہیں اور اس کے علاوہ کچھ نہیں۔ یہ Cacti کے لوڈ ہونے سے پہلے کوکیز، `$_POST` اور `$_REQUEST` کو حذف کر دیتے ہیں اور Cacti کے شروع کردہ سیشن کو ختم کر دیتے ہیں، تاکہ براؤزر لاگ ان سے کبھی API تک رسائی حاصل نہ ہو سکے۔
- **CSRF کا عارضی حل۔** Cacti کا CSRF محافظ ایسے JSON POST کو مسترد کر دیتا ہے جس میں Cacti CSRF ٹوکن نہ ہو، جسے کوئی بھی MCP کلائنٹ نہیں بھیج سکتا۔ صرف ان دو اینڈ پوائنٹس کے لیے، پلگ ان Cacti کے لوڈ ہونے سے پہلے درخواست کا طریقہ (request method) تبدیل کر دیتا ہے اور بعد میں اسے بحال کر دیتا ہے، تاکہ محافظ انہیں نظر انداز کر دے۔ یہ محفوظ ہے کیونکہ CSRF ان درخواستوں کا تحفظ کرتا ہے جن کی تصدیق براؤزر کوکیز کے ذریعے کرتا ہے، اور یہ اینڈ پوائنٹس کوئی کوکی شناخت قبول نہیں کرتے: کوئی کراس سائٹ صفحہ bearer ٹوکن منسلک نہیں کر سکتا۔ کنسول کے صفحات پر مکمل CSRF تحفظ برقرار رہتا ہے۔ یہ عارضی حل اس وقت تک ہے جب تک Cacti باضابطہ استثنیٰ فراہم نہیں کرتا؛ `lib/bootstrap.php` دیکھیں۔
- **Origin کی جانچ۔** `mcp.php` پر، اگر درخواست میں `Origin` ہیڈر موجود ہو تو وہ لازماً Public Cacti URL کے عین مطابق اسکیم، ہوسٹ اور پورٹ پر مشتمل ہونا چاہیے، ورنہ درخواست کو `ORIGIN_NOT_ALLOWED` کے ساتھ مسترد کر دیا جاتا ہے۔ بغیر `Origin` ہیڈر والی درخواست کی اجازت ہے، کیونکہ غیر براؤزر کلائنٹس اسی طرح منسلک ہوتے ہیں۔ اس سے کوئی ویب صفحہ صارف کے براؤزر سے اس اینڈ پوائنٹ کو استعمال نہیں کر سکتا۔ `api.php` یہ جانچ لاگو نہیں کرتا۔
- **صرف پڑھنے تک محدود (Read-only)۔** رجسٹریشن کسی بھی ایسی اہلیت (ability) کو مسترد کر دیتی ہے جو صرف پڑھنے کے قابل، غیر تباہ کن اور idempotent نہ ہو۔
- **ایکسپوژر اور رِیلمز (realms) دونوں لاگو ہوتے ہیں۔** کسی اہلیت کا ظاہر ہونا اور ٹوکن کے مالک کے پاس اس کا رِیلم ہونا ضروری ہے۔ اگر ایکسپوژر ٹیبل نہ پڑھا جا سکے، تو ڈیفالٹس پر واپس جانے کے بجائے ہر اہلیت کو پوشیدہ رکھا جاتا ہے۔
- **پوشیدہ، نامعلوم اور غیر مجاز ایک جیسے دکھائی دیتے ہیں۔** کوئی کلائنٹ یہ فرق نہیں کر سکتا کہ آیا کوئی اہلیت موجود نہیں ہے، پوشیدہ ہے، یا اس کے صارف کو اس کے استعمال کی اجازت نہیں ہے: دریافت (discovery) اسے شامل نہیں کرتی اور عمل درآمد پر `NOT_FOUND` (`ABILITY_NOT_FOUND`) واپس آتا ہے۔
- **ٹوکنز۔** SHA-256 ہیشز کے طور پر محفوظ کیے جاتے ہیں، صرف ایک بار دکھائے جاتے ہیں، ہمیشہ میعاد ختم ہونے والے ہوتے ہیں، منسوخ کیے جا سکتے ہیں، اور جب مالک کو غیر فعال کر دیا جائے یا وہ رِیلم کھو دے تو مسترد کر دیے جاتے ہیں۔
- **آڈٹ۔** `plugin_mcp_audit` درخواست کی ID، ٹوکن ID، صارف ID، اہلیت، نتیجہ (`started`، `succeeded`، `failed`، `denied`، `rejected`) اور ٹائم اسٹیمپس ریکارڈ کرتا ہے۔ یہ کبھی بھی آرگیومنٹس، نتائج یا ٹوکن کی قدریں ریکارڈ نہیں کرتا۔ کوئی اہلیت صرف اس وقت چلتی ہے جب اس کی `started` قطار لکھ لی جائے؛ اگر آڈٹ ٹیبل دستیاب نہ ہو تو کال `UNAVAILABLE` کے ساتھ ناکام ہو جاتی ہے اور نہیں چلتی۔ چلنے سے پہلے مسترد کی گئی کال ایک قطار ہوتی ہے: نامعلوم، پوشیدہ یا غیر مجاز اہلیت کے لیے `denied`، اور اسکیما پر پورا نہ اترنے والے آرگیومنٹس کے لیے `rejected`۔ کنسول، My MCP Tokens اور CLI سے ٹوکن بنانا اور منسوخ کرنا `mcp-token-create` اور `mcp-token-revoke` کے طور پر `succeeded` نتیجے کے ساتھ ریکارڈ کیا جاتا ہے، اور منسوخی صرف اس ٹوکن کے لیے ریکارڈ کی جاتی ہے جو فعال تھا۔ دریافت، اور ایسی کال جس کے `arguments` ایک JSON آبجیکٹ نہ ہوں، لاگ نہیں کی جاتیں۔
- **ناکامی کا لاگ۔** کسی غیر متوقع ناکامی، `INVALID_RESULT`، یا آڈٹ ٹیبل کے دستیاب نہ ہونے کی صورت میں `MCP` فیسلٹی کے ساتھ Cacti لاگ میں ایک سطر لکھی جاتی ہے: اہلیت کی ID، ایک مقررہ وجہ، اور exception کلاس۔ پیغامات، آرگیومنٹس اور ٹوکنز کبھی لاگ نہیں کیے جاتے۔
- **صرف مین پولر۔** دونوں اینڈ پوائنٹس، دونوں کنسول صفحات، اور `tokens.php` کسی اور جگہ کام کرنے سے انکار کرتے ہیں۔

## لائف سائیکل

پلگ ان کو غیر فعال کرنے سے دونوں اینڈ پوائنٹس بلاک ہو جاتے ہیں۔ اَن انسٹال کرنے سے ہر ٹوکن منسوخ ہو جاتا ہے اور تینوں ٹیبلز (`plugin_mcp_token`، `plugin_mcp_audit`، `plugin_mcp_ability`) برقرار رکھنے کے لیے محفوظ رہتے ہیں؛ دوبارہ انسٹال کرنے سے منسوخ شدہ ٹوکن دوبارہ فعال نہیں ہوتا۔ Cacti ڈیٹا بیس کے ساتھ ان ٹیبلز کا بیک اپ لیں اور پلگ ان سے باہر آڈٹ برقرار رکھنے کی پالیسی لاگو کریں۔

## ڈیولپمنٹ اور ٹیسٹس

ٹیسٹ سوٹ میں `tests/` میں سادہ PHP اسکرپٹس کے ساتھ ساتھ `tests/Unit/` میں PHPUnit یونٹ ٹیسٹس اور PHPStan جامد تجزیہ (لیول 6) شامل ہیں، جو سب Cacti انسٹالیشن کے بغیر چلتے ہیں:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI، PHP 8.2 سے 8.5 تک پر چلتا ہے: ایک `test` جاب جو PHP نحو کی لنٹنگ (`php -l`) کرتا ہے اور `.github/workflows/ci.yml` میں درج 13 سادہ PHP ٹیسٹ اسکرپٹس چلاتا ہے، ایک `quality` جاب جو `composer phpstan` اور `composer test` چلاتا ہے، اور ایک `package` جاب جو انسٹال کے قابل `mcp/` آرکائیو (`.gitattributes` میں درج ڈیولپمنٹ اور ٹیسٹ فائلوں کو چھوڑ کر) اور اس کا `SHA256SUMS` تیار کرتا ہے۔ وہ ٹیسٹس جو Cacti کو چھوتے ہیں وہ Cacti ہیلپر کی حد پر فکسچرز استعمال کرتے ہیں؛ وہ مکمل Cacti انسٹالیشن کی جانچ نہیں کرتے۔

### انٹیگریشن ٹیسٹس

`tests/integration/run.sh 1.2.31` یا `tests/integration/run.sh develop` پلگ ان کو کنٹینرز میں ایک حقیقی Cacti کے اندر انسٹال کرتا ہے اور اس پر لائیو جانچ چلاتا ہے۔ اس کے لیے Docker بمع Compose v2.23.1 یا اس سے جدید ورژن، git اور openssl درکار ہیں۔ `KEEP=1` ڈیبگنگ کے لیے اسٹیک کو چلتا چھوڑ دیتا ہے۔ CI اسے رات کے وقت اور طلب پر چلاتا ہے، پل ریکویسٹس پر نہیں۔

## لوکلائزیشن

Cacti MCP، انگریزی کے علاوہ 47 لوکیلز (19 Broad Tier 1، 15 افریقی، 10 ایشیائی، نیز بوسنیائی، کروشیائی، اور سربیائی لوکیلز) کے لیے `locales/po/` اور `locales/LC_MESSAGES/` کے تحت مرتب شدہ GNU gettext کیٹلاگز اور `docs/i18n/` کے تحت مقامی READMEs فراہم کرتا ہے، جس میں `mcp` ٹیکسٹ ڈومین (`locales/po/mcp.pot`) استعمال ہوتا ہے۔ زبان کی معاونت فعال ہونے پر Cacti خودکار طور پر مماثل کیٹلاگ لوڈ کر لیتا ہے۔

## تعاون کرنا

پل ریکویسٹس `develop` برانچ میں بھیجیں۔ پروڈکشن کوڈ کو PHP 8.2 کے مطابق رکھیں اور Cacti کا انداز استعمال کریں: ٹیبز، سنگل کوٹڈ اسٹرنگز، اور Cacti کے ڈیٹا بیس اور اجازت کے ہیلپرز۔ تبدیل شدہ توثیق، اجازت، یا پروٹوکول کے رویے کے لیے ٹیسٹس شامل کریں، اور کمٹس کو `git commit -s` کے ساتھ سائن آف کریں۔ HTTP API میں تبدیلیوں کے لیے [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) کے ساتھ ہم آہنگی کریں۔

## لائسنس

کاپی رائٹ (C) 2026 Thomas Vincent۔ GNU General Public License، ورژن 2 یا اس کے بعد کے ورژن کے تحت جاری کیا گیا۔ [لائسنس](../../../LICENSE) دیکھیں۔
