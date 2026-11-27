<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: صبّار مع درع. استكشف. فوّض. نفّذ.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="التكامل المستمر (CI)"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="الترخيص: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="واجهة برمجة القدرات v2">
</p>

Cacti MCP هي إضافة لنظام Cacti تتيح لعملاء الذكاء الاصطناعي قراءة بيانات Cacti
الخاصة بك عبر عمليات مُسمّاة ومُصفّاة حسب الصلاحيات تُعرف باسم القدرات (abilities).
وتوفر الإضافة هذه العمليات بطريقتين من داخل الإضافة نفسها: نقطة نهاية MCP
(`mcp.php` عبر Streamable HTTP)، وواجهة برمجة تطبيقات HTTP بنمط AIP
(`api.php`). ويظل Cacti هو المسؤول عن التفويض والتنفيذ؛ إذ لا يستعلم العميل عن
قاعدة البيانات مطلقاً، بل يمكنه فقط استدعاء القدرة التي أتاحها المسؤول وتسمح
بها نطاقات صلاحيات مالك الرمز في Cacti.

يمكن لمؤلفي الإضافات تسجيل قدراتهم الخاصة للقراءة فقط عبر الخطاف
`abilities_register`، فتظهر لعملاء MCP كأدوات دون الحاجة إلى كتابة أي شيفرة
برمجية للبروتوكول.

**الحالة: إصدار تمهيدي، النسخة 0.1.0.** لا يوجد إصدار موسوم (tagged release) حتى الآن.

المتوفّر حالياً:

- تسع قدرات مدمجة للقراءة فقط تغطي إصدارات النظام والأجهزة والمواقع والمستطلِعات
  (pollers) وأشجار الرسوم البيانية والرسوم البيانية ومصادر البيانات ومقتطفاً
  محدوداً ومنقّحاً من نهاية سجل Cacti.
- رموز الوصول الشخصية (`cmcp_pat_...`) بوصفها بيانات الاعتماد الوحيدة.
- وحدة تحكم الإدارة > MCP: إتاحة القدرات أو إخفاؤها، وإنشاء الرموز وإلغاؤها،
  وقراءة سجل التدقيق.
- الإدارة > رموز MCP الخاصة بي: يدير المستخدمون رموزهم الخاصة، ويطّلعون على
  نشاطها، ويتحققون من الأدوات التي يمكن لرموزهم استخدامها.
- بروتوكول MCP عبر Streamable HTTP، بمراجعتي البروتوكول `2026-07-28` و`2025-11-25`،
  للأدوات فقط.

غير متوفّر بعد:

- تسجيل الدخول عبر OAuth 2.1. لا يمكن للموصّلات المستضافة التي يتعذّر عليها
  إرسال رمز شخصي — مثل موصّلات ChatGPT وclaude.ai المخصصة — الاتصال حتى
  يتوفّر ذلك. وهو مخطط له ضمن الخطة 2 (Plan 2)؛ ولم تُكتب تلك الخطة بعد.
- قدرات الكتابة. لا يمكن تسجيل سوى القدرات المخصصة للقراءة فقط.

يرد التصميم في
[مواصفات تصميم نقطة النهاية](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)،
كما يرد تسلسل البناء في [docs/plan.md](../../plan.md).

## القدرات المدمجة

| المعرّف | الفئة | المعاملات | نطاق Cacti المطلوب |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | لا يوجد | 15 |
| `cacti-list-devices` | `inventory` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 3 |
| `cacti-get-device` | `inventory` | مطلوب `name`، مثل `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 3 |
| `cacti-list-pollers` | `system` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 15 |
| `cacti-list-trees` | `inventory` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 7 أو 4 |
| `cacti-list-graphs` | `inventory` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 7 أو 5 |
| `cacti-list-data-sources` | `inventory` | اختياري `pageSize` و`pageToken` و`filter` و`orderBy` | 3 |
| `cacti-get-clog` | `system` | اختياري `lines` (من 1 إلى 200، الافتراضي 50) و`severity` و`search` | 19 أو 18 |

يتطلب كل استدعاء أيضاً توفّر نطاق **MCP and Abilities API** لمالك الرمز،
والنطاق `abilities:read` (يمتلكه كل رمز شخصي)، وأن تكون القدرة مُتاحة. ويعرض
تبويب القدرات (Abilities) في وحدة التحكم النطاق الأساسي الذي تحتاجه كل قدرة مدمجة.

تُرجع قدرات `cacti-list-*` الست جميعها صفحات تضم حتى 100 عنصر (الافتراضي 50)
و`nextPageToken`. ولا يكون رمز الصفحة صالحاً إلا مع نفس قيمتي `filter` و`orderBy`.
ويمثّل `filter` تعبير AIP-160 لمقارنات (`=`، `!=`، `<`، `<=`، `>`، `>=`)
مرتبطة بـ `AND`، مثل `state = "DOWN" AND disabled = false`. وتقبل `orderBy` قائمة
مفصولة بفواصل من الحقول القابلة للفرز، مع إمكانية إتباع كل منها اختيارياً بـ `asc` أو `desc`.

| القدرة | حقول التصفية | حقول الفرز |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

تقييد الصلاحيات واستبعاد الأسرار:

- تستعلم `cacti-list-devices` و`cacti-get-device` عبر الدالة `get_allowed_devices()` في
  Cacti، وتستبعد سلاسل مجتمع SNMP وعبارات المرور وبيانات الاعتماد الأخرى.
- تستعلم `cacti-list-trees` عبر `get_allowed_trees()` (وتُصفّي باستخدام `is_tree_allowed()`
  عند توفّرها)؛ وتستعلم `cacti-list-graphs` عبر `get_allowed_graphs()` (وتُصفّي باستخدام
  `is_graph_allowed()` عند توفّرها).
- تقصر `cacti-list-data-sources` الصفوف على الأجهزة المسموح بها للمستدعي من
  `get_allowed_devices()` (و`is_device_allowed()` عند توفّرها)، وتُرجع البيانات الوصفية
  فقط دون الاستعلام من `data_input_data` أو كشف قيم الإدخال السرية.
- تستبعد `cacti-list-pollers` بيانات اعتماد قاعدة البيانات (`dbpass` و`dbuser`) وأعمدة
  مفاتيح وشهادات TLS (`dbsslkey` و`dbsslcert` و`dbsslca`).
- تقرأ `cacti-get-clog` حتى آخر 1 ميجابايت من سجل Cacti المُعدّ (مع اقتطاع الأسطر
  الفردية التي تتجاوز 2048 بايت)، وتُصفّي حسب `severity` (`ALL`، `DEBUG`، `INFO`،
  `NOTICE`، `WARNING`، `ERROR`، `CRITICAL`، `ALERT`، `EMERGENCY`، `FATAL`، `STATS`،
  `POLLER`، `SYSTEM`؛ الافتراضي `ALL`) و`search` غير حساس لحالة الأحرف (حتى 256 حرفاً)،
  وتُرجع `lines` و`count` و`truncated`. ويُنقّح كل سطر لإخفاء الرموز الشخصية وترويسات
  bearer/basic وكلمات المرور والأسرار ومجتمعات SNMP والمفاتيح و`dbpass` و`dbsslkey`
  ومعلومات مستخدم عناوين URL قبل تشغيل مرشحات `severity` و`search` حتى لا يعمل `search`
  ككاشف للأسرار. ويفشل التنقيح بشكل آمن بالاستبدال بـ `[redacted]`، ويُرجع السجل غير
  القابل للقراءة `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## التثبيت

يتطلب Cacti 1.2.31 أو أحدث، وPHP 8.2 أو أحدث، والمستطلِع الرئيسي (main poller).
ويجب أن تكون مصادقة Cacti مفعّلة؛ إذ ترفض الإضافة المصادقة عندما تكون معطّلة.

يجب أن يكون اسم مجلد الإضافة `mcp` وليس `plugin_mcp`. إذ تستخدم كل من الاسم
اللطيف للإضافة وأسماء النطاقات ونطاق الترجمة وعناوين URL الاسم `mcp`.

من نسخة مستخرجة من الشيفرة المصدرية:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

وإلى أن تتوفّر إصدارات موسومة، يمكنك بدلاً من ذلك تنزيل الحزمة البرمجية `mcp-plugin`
من [تشغيل CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
ناجح. وتحتوي الحزمة على `mcp.tar.gz` و`SHA256SUMS`. تحقّق من المجموع
الاختباري، ثم استخرج `mcp.tar.gz` داخل مجلد `plugins/` في Cacti ليصبح المسار
الناتج `plugins/mcp/`. وتستخدم أرشيفات المصدر التلقائية في GitHub اسماً مختلفاً
للمجلد الجذري. كما يستبعد الأرشيف المجلدات `docs/` (بما في ذلك لقطات الشاشة
أدناه) و`tests/` و`.github/`، ولذلك تعمل روابط README المتجهة إلى `docs/` على
GitHub، ولكنها لا تعمل في النسخة المثبّتة.

بعد ذلك:

1. في إدارة الإضافات (Plugin Management)، ثبّت الإضافة **Cacti MCP** وفعّلها.
   يحصل المسؤول الذي يُجري التثبيت على نطاق **MCP Administration** تلقائياً.
2. ضمن الإعدادات > MCP، اضبط **Public Cacti URL** على العنوان الذي يستخدمه
   العملاء، مثل `https://cacti.example.com/cacti`. ويُلزَم استخدام HTTPS باستثناء
   `localhost` و`127.0.0.1` و`[::1]`. وإلى أن يُضبط هذا الإعداد، تُرجع `mcp.php`
   استجابة HTTP 400 مع خطأ JSON-RPC يحتوي حقل `data` فيه على `FAILED_PRECONDITION`
   و`PUBLIC_URL_REQUIRED`. ولا تقرأ `api.php` هذا الإعداد.

   ![صفحة الإعدادات > MCP التي تعرض حقل Public Cacti URL](../../images/settings-public-url.png)

3. امنح نطاق **MCP and Abilities API** لكل مستخدم سيمتلك رمزاً. لا يحصل عليه أي
   مستخدم تلقائياً.
4. تأكد من أن خادم الويب يمرّر ترويسة `Authorization` ومعلومات المسار إلى PHP
   (انظر أدناه).
5. افتح الإدارة > MCP وأتح القدرات التي تريد أن يراها العملاء.

**الترقية من نسخة تطوير.** الإضافة في مرحلة ما قبل الإصدار، وقد تغيّرت
جداولها أثناء التطوير دون ترحيلات (migrations). إذا سبق لك تثبيت نسخة أقدم،
فألغِ تثبيتها ثم ثبّتها من جديد. ويُبقي إعادة التثبيت على الجداول الموجودة
مسبقاً، لذا احذف أولاً الجداول القديمة `plugin_mcp_token` و`plugin_mcp_audit`
و`plugin_mcp_ability` (والجداول المكافئة من النسخ التي سبقت إعادة التسمية). خذ
نسخة احتياطية منها إذا كنت بحاجة إلى سجلها التاريخي؛ إذ تُلغى الرموز الصادرة
عن تلك النسخ عند إلغاء التثبيت ولا تُنقل.

### خادم الويب

تحتاج إعدادات Apache التي تُزيل ترويسة `Authorization` قبل الوصول إلى PHP إلى
إضافة ما يلي في المضيف الافتراضي أو الدليل المعني، متبوعاً بإعادة التحميل:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

وقد خدم خادم Apache المزوّد بـ `mod_php` مسارات `api.php` دون الحاجة إلى إعدادات
إضافية للمسار.

تقع مسارات `api.php` في المسار الذي يلي اسم السكربت
(`/plugins/mcp/api.php/v1/abilities`)، لذا يجب على nginx مطابقة عناوين URI التي
يتبع فيها `.php` مسار إضافي، وفصل معلومات المسار، وتمريرها إلى PHP. إذ إن كتلة
`location ~ \.php$` لا تطابق هذه العناوين إطلاقاً، فيردّ nginx بصفحة HTML 404
الخاصة به. وقد جرى التحقق من نمط الموقع وسطري معلومات المسار أدناه مع PHP-FPM؛
أما الأسطر الأخرى فهي إعدادات قياسية متكررة:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

عدّل سطري `include` و`fastcgi_pass` ليتطابقا مع الكتلة التي تخدم Cacti بالفعل.
ولا تضف `try_files $fastcgi_script_name =404;` إلى هذه الكتلة: إذ إن ذلك يمسح
قيمة `$fastcgi_path_info`، فتردّ `api.php` حينها بالرمز 404 `UNKNOWN_PATH`.
وإذا كان إعدادك يتطلب `try_files`، فاحفظ القيمة أولاً باستخدام
`set $path_info $fastcgi_path_info;` ومرّر `fastcgi_param PATH_INFO $path_info;`.

لا تحتوي `mcp.php` على مسارات ضمن المسار ولا تحتاج إلى ذلك.

## وحدة التحكم

تحتوي الإدارة > MCP على ثلاثة تبويبات، وتتطلب توفّر نطاق **MCP Administration**.
لقطات الشاشة هنا وأدناه مأخوذة من نسخة تطوير لـ Cacti ببيانات تجريبية.

- **القدرات (Abilities):** تسرد كل قدرة مسجّلة مع إضافتها وفئتها والنطاق الذي
  تحتاجه وحالة إتاحتها. حدّد الصفوف واختر إتاحة (Expose) أو إخفاء (Hide)؛
  وسيُطلب منك التأكيد قبل تطبيق التغيير. وتكون قدرات `cacti-*` المدمجة متاحة
  افتراضياً، بينما تبدأ قدرات الإضافات الأخرى مخفية، فلا يؤدي تثبيت إضافة جديدة
  إلى نشر أي شيء حتى يقرر المسؤول ذلك. وتقتصر الإتاحة على تضييق نطاق الوصول فقط:
  إذ يظل المستخدم بحاجة إلى نطاق القدرة.

  ![تبويب القدرات الذي يعرض القدرات المدمجة مع نطاقاتها وحالة إتاحتها](../../images/console-abilities.png)
- **الرموز (Tokens):** تسرد الرموز مع المالك والمنشئ وتاريخ الإنشاء وتاريخ
  الانتهاء وآخر استخدام والحالة (نشط، منتهي الصلاحية، ملغى). حدّد الصفوف واختر
  إلغاء (Revoke) لإلغائها. ولا يمكن إعادة استخدام الرموز الملغاة. وينشئ خيار إنشاء
  رمز (Create Token) رمزاً جديداً.

  ![تبويب الرموز الذي يعرض الرموز مع المالك وتاريخ الانتهاء وآخر استخدام والحالة، فوق نموذج إنشاء الرمز](../../images/console-tokens.png)
- **التدقيق (Audit):** يسرد صفوف سجل التدقيق من الأحدث إلى الأقدم، مع التصفية حسب
  المستخدم والقدرة والنتيجة.

  ![تبويب التدقيق الذي يعرض الاستدعاءات مع المستخدم والرمز والقدرة والنتيجة، مع عوامل التصفية](../../images/console-audit.png)

## الرموز

يقرأ الرمز الشخصي بيانات Cacti بصلاحيات مالكه. ويأخذ الصيغة `cmcp_pat_` متبوعةً
بـ 64 محرفاً ست عشرياً بأحرف صغيرة، ويحمل النطاق الوحيد `abilities:read`. ويُحدَّد
ما يمكنه رؤيته من خلال نطاقات صلاحيات مالكه وأذونات الأجهزة في Cacti، لا من خلال
الرمز نفسه. ويجب أن يكون المالك مستخدماً مفعّلاً يحمل نطاق **MCP and Abilities API**.

تُنشأ الرموز دائماً لمستخدم معيّن، ولها مدة صلاحية، ويمكن إلغاؤها:

- **وحدة التحكم.** الإدارة > MCP > الرموز > إنشاء رمز. تتراوح مدة الصلاحية بين
  1 و365 يوماً، والافتراضي 90 يوماً. يولّد الخادم الرمز ويعرضه مرة واحدة في صفحة
  الاستجابة، لذا انسخه إلى مدير الأسرار لديك فوراً. يمكنك إنشاء رمز لنفسك، أما
  إنشاء رمز لمستخدم آخر فيتطلب أيضاً نطاق Users/Groups، لأن الرمز يقرأ Cacti
  بصلاحيات ذلك المستخدم.
- **رموز MCP الخاصة بي.** يمكن لأي مستخدم يحمل نطاق MCP and Abilities API إدارة
  رموزه الخاصة؛ انظر أدناه.
- **سطر الأوامر.** يعمل `tokens.php` من واجهة سطر الأوامر (CLI) فقط، بحساب نظام
  تشغيل مخوّل لإدارة Cacti. ويستلم الرمز من متغيرات البيئة بحيث لا تظهر قيمته
  أبداً في سطر الأوامر أو قائمة العمليات. وتتراوح مدة الصلاحية بين 1 و365 يوماً،
  والافتراضي 30 يوماً. ويُسجَّل إنشاء الرمز وإلغاؤه عبر سطر الأوامر في سجل
  التدقيق تماماً مثل وحدة التحكم، مع تسجيل مالك الرمز بوصفه الفاعل لأن سطر
  الأوامر لا يملك مستخدم Cacti، ولذلك لا يشير صف التدقيق إلى أن الإجراء نُفِّذ من
  سطر الأوامر. يطبع الخيار `--list` كل رمز بتنسيق JSON (المعرّف، المالك، النطاقات،
  الطوابع الزمنية، وراية الإلغاء) دون طباعة قيمة الرمز مطلقاً؛ ويعرض `--help`
  طريقة الاستخدام.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

لا يمكن إنشاء الرموز لحساب الضيف (guest)، أو للمستخدمين المعطّلين، أو للمستخدمين
الذين لا يملكون نطاق **MCP and Abilities API**، سواء من وحدة التحكم أو سطر
الأوامر أو صفحة رموز MCP الخاصة بي. ويخزّن Cacti إعداد الضيف كاسم مستخدم أو
معرّف مستخدم، وتتعامل الإضافة مع كليهما. كما يتوقف الرمز الذي يصبح مالكه حساب
الضيف عن العمل في الطلب التالي.

### رموز MCP الخاصة بي

لا تتطلب صفحة الإدارة > رموز MCP الخاصة بي (`plugins/mcp/mcp_tokens.php`) أي نطاق
إداري: إذ يغطيها نطاق **MCP and Abilities API**، ولا يظهر عنصر القائمة إلا
للمستخدمين الذين يحملونه. وتعمل الصفحة دائماً على المستخدم المسجّل دخوله. وبما
أن قائمة Cacti جزء من وحدة التحكم، فإن المستخدم الذي لا يملك صلاحية الوصول إلى
وحدة التحكم يصل إلى الصفحة عبر عنوانها المباشر.

![تبويب رموزي الذي يعرض رموز المستخدم المسجّل دخوله ونموذج الإنشاء](../../images/my-tokens.png)

- **الرموز (Tokens):** يعرض رموزك، وينشئ رمزاً (من 1 إلى 365 يوماً، والافتراضي
  90 يوماً، ويُعرض مرة واحدة في الاستجابة)، ويلغي رموزك الخاصة. ولا يمكنك رؤية
  رموز أي شخص آخر أو إلغاؤها.
- **النشاط (Activity):** يعرض الإجراءات التي نفّذتها، من الأحدث إلى الأقدم:
  الاستدعاءات التي أُجريت برموزك والتغييرات التي أجريتها على الرموز.
- **الأدوات المتاحة (Available Tools):** يعرض القدرات التي يمكن لأحد رموزك
  استخدامها الآن، مع معرّف كل قدرة واسمها ووصفها. ويتبع ذلك أذوناتك في Cacti
  وإعدادات الإتاحة التي اختارها المسؤول.

  ![قائمة الأدوات المتاحة التي تعرض معرّف كل قدرة واسمها ووصفها](../../images/my-tools.png)

التثبيت الذي أُجري قبل وجود هذه الصفحة يملك قائمة ملفات نطاقات لا تتضمن
`mcp_tokens.php`. وتُحدَّث القائمة عند التثبيت فقط، ولا تتحدّث عند تفعيل الإضافة
أو تعطيلها. لذا ألغِ تثبيت الإضافة ثم ثبّتها مجدداً، وبعدها امنح النطاقات من
جديد، لأن Cacti يزيل منح النطاقات عند إلغاء تثبيت الإضافة.

لا تخزّن قاعدة البيانات سوى تجزئة SHA-256 للرمز، لذا لا يمكن استرداد الرمز
المفقود؛ ألغِه وأنشئ رمزاً آخر. وينطبق الأمر نفسه على التدوير (rotation): أنشئ
رمزاً جديداً، وحوّل العميل إليه، ثم ألغِ الرمز القديم. ويفشل الرمز منتهي
الصلاحية، أو الرمز الملغى، أو المالك المعطّل، أو النطاق المفقود في الطلب التالي
مباشرة. وتُقبل الرموز فقط عبر ترويسة `Authorization: Bearer`؛ ولا يُقبل الرمز
في سلسلة الاستعلام أو في متن الطلب.

## توصيل عميل

استخدم نقطة نهاية MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php` مع تمرير الرمز المميز في ترويسة `Authorization: Bearer`. احتفظ بالرمز المميز في متغير بيئة أو مدير أسرار وأشِر إليه من إعدادات العميل بدلًا من كتابة قيمته داخل ملف.

### Claude Code

ضع نقطة النهاية في ملف `.mcp.json` الخاص بالمشروع بحيث يشير إلى الرمز المميز بالاسم. يقوم Claude Code بتوسيع `${VAR}` في `url` و`headers`، لذا لا يحتوي الملف على أي سر ويكون آمنًا لإيداعه في نظام التحكم بالإصدارات. صدّر المتغير `CACTI_MCP_TOKEN` في البيئة التي تشغّل Claude Code.

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

يمكنك أيضًا إضافته من سطر الأوامر:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

عند استخدام علامات الاقتباس المزدوجة، يقوم الصدفة (shell) بتوسيع `$CACTI_MCP_TOKEN` أولًا، فتُكتب قيمة الرمز المميز في ملف الإعدادات للنطاق المختار `--scope` (`local` أو `user` أو `project`؛ والافتراضي هو `local`). لا تستخدم هذه الصيغة مع `--scope project`، وأبقِ الملف خارج نظام التحكم بالإصدارات. يُفضَّل استخدام المرجع في `.mcp.json` أعلاه. يقرأ Claude Code بعض متغيرات بيانات الاعتماد (مثل `ANTHROPIC_AUTH_TOKEN`) على أنها فارغة في `url` و`headers` البعيدة؛ إلا أن `CACTI_MCP_TOKEN` ليس واحدًا منها. المصدر: [توثيق MCP في Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot في VS Code

استخدم ملف `.mcp.json` في جذر مساحة العمل (أو ملف المستخدم `~/.copilot/mcp-config.json`). تستخدم هذه الملفات الأصلية الخاصة بـ Copilot كائن `mcpServers` في المستوى الأعلى ومراجع متغيرات البيئة بصيغة `${NAME}` في قيم الترويسات:

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

صدّر `CACTI_MCP_TOKEN` في البيئة التي تشغّل VS Code. لا تدعم ملفات Copilot الأصلية مطالبات `inputs`. كما يرفض الإعداد الموجّه في VS Code قيم `${...}`، لذا أضف ترويسة `Authorization` بتحرير الملف مباشرة وليس عبر مسار الإعداد الموجّه. لا يعرض الإعداد الموجّه ملف جذر مساحة العمل إلا عند تفعيل الإعداد التجريبي `chat.mcp.workspaceRootConfig.enabled`. راجع [مرجع إعدادات MCP في VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**قديم: `.vscode/mcp.json`.** يشير VS Code إلى أن إعدادات Copilot الجديدة يجب ألا تستخدم `.vscode/mcp.json` أو ملف `mcp.json` الخاص بالملف الشخصي؛ إذ تنتمي إلى إطار Local المُهمَل الذي ستتم إزالته في فبراير 2027. إذا كنت لا تزال تستخدمه، فإن التنسيق المُدار عبر المحرر يأخذ مفتاح `servers` في المستوى الأعلى ويمكنه المطالبة بإدخال الرمز المميز:

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

### العملاء الذين يدعمون stdio فقط

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) هو محوّل اختياري يعمل كخادم MCP محلي عبر stdio ويستدعي واجهة HTTP API الخاصة بالإضافات. استخدمه مع أي عميل لا يمكنه الاتصال بخادم HTTP بعيد. يحتاج إلى الرمز المميز الشخصي نفسه ويتواصل مع `api.php`.

### سلوك MCP

توفّر نقطة النهاية الأدوات فقط: كل قدرة مكشوفة ومصرّح بها تُعد أداةً مسمّاة بمعرّفها، مع مخططي الإدخال والإخراج والتعليقات التوضيحية للقراءة فقط (`openWorldHint` قيمته `false`). تتعامل النقطة مع `initialize` و`server/discover` و`ping` و`tools/list` و`tools/call`. وهي لا تحتفظ بأي جلسة، ولا ترسل `Mcp-Session-Id` (وتتجاهله إذا استقبلته)، ولا تقبل حزم JSON-RPC المجمّعة. أي رسالة دون `id` تُعد إشعارًا وتحصل على استجابة HTTP 202 دون جسم. يُسمح بطريقة `POST` فقط.

- **المراجعات.** الطلب الذي يحمل `io.modelcontextprotocol/protocolVersion` ضمن `params._meta` يجب أن يحدد `2026-07-28`؛ وأي قيمة أخرى تحصل على الخطأ `-32022`. كما يجب أن تحمل هذه الطلبات ترويسات متطابقة وهي `Mcp-Protocol-Version` و`Mcp-Method` و(بالنسبة إلى `tools/call`) `Mcp-Name`، وإلا تكون الإجابة الخطأ `-32020`. تُعامل الطلبات الأخرى بوصفها `2025-11-25`: ترد `initialize` بتلك المراجعة، وفي أي طريقة أخرى يجب أن تكون ترويسة `Mcp-Protocol-Version`، إذا أُرسلت، إحدى القيم `2025-11-25` أو `2025-06-18` أو `2025-03-26`.
- **أخطاء الأدوات.** يعود خطأ القدرة، بما في ذلك المعاملات التي لا تطابق المخطط أو قيمة `arguments` التي ليست كائن JSON، كنتيجة أداة تتضمن `isError: true` وخطأ AIP-193 داخل `structuredContent`، وليس كخطأ بروتوكول.
- **أخطاء البروتوكول.** الإخفاقات التي ليست أخطاء أدوات هي كائنات أخطاء JSON-RPC (بالرمز `-32000` مع الحالة والسبب في `data`، أو الرموز القياسية): غياب Public Cacti URL، أو رفض `Origin`، أو طلب والإضافة معطّلة أو على مستطلع بعيد، وأخطاء الخادم غير المتوقعة (`-32603`، مع كتابة التفاصيل في سجل Cacti وليس في الاستجابة). أما فحوصات الطلب التي تُنفّذ أولًا (405، 413، 415) وإخفاقات المصادقة (401 `INVALID_TOKEN`، 403 `REALM_REQUIRED`) فتحتفظ بجسم AIP-193 الموصوف تحت قسم HTTP API.

## واجهة HTTP API

عنوان URL الأساسي: `https://cacti.example.com/cacti/plugins/mcp/api.php`. يوجد العقد في [openapi.json](../../../openapi.json).

| الطريقة والمسار | الغرض |
| --- | --- |
| `GET /v1/abilities` | سرد القدرات المصرّح بها. الاستعلام: `pageSize` و`pageToken` و`filter` بصيغة `category = "inventory"`. |
| `GET /v1/abilities/{id}` | قراءة قدرة واحدة. |
| `POST /v1/abilities/{id}:execute` | تشغيلها. يكون الجسم تمامًا `{"arguments": {...}}`. وتكون الاستجابة `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

تتبع الأخطاء معيار AIP-193: كائن `error` يحتوي على `code` و`message` و`status` و`details` يحمل `ErrorInfo` بنطاق `cacti.net` وقيمة `reason` مستقرة. تضيف مشكلات المعاملات تفصيل `BadRequest` يذكر اسم الحقل. يبلغ الحد الأقصى لأجسام الطلبات 64 كيلوبايت، وللنتائج 1 ميجابايت. تستجيب كلتا نقطتي النهاية على المستطلع الرئيسي فقط وتُرجعان `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) عندما تكون الإضافة معطّلة أو عندما لا يكون الخادم هو المستطلع الرئيسي.

| HTTP | قيم `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`، `INVALID_FILTER`، `INVALID_PAGE_TOKEN`، `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (يرسل أيضًا `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`، `DEVICE_NOT_FOUND`، `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (يرسل `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`، `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`، `PLUGIN_UNAVAILABLE`، `CACTI_UNAVAILABLE` |

## كتابة قدرة (لمؤلفي الإضافات)

تسجّل إضافة Cacti المفعّلة القدرات من خلال دالة تربطها بخطّاف `abilities_register`، وعادةً ما يكون ذلك في `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

تستقبل الدالة كائن `AbilitiesRegistrar` محصور النطاق بالإضافة. ويُتجاهل قيمة الإرجاع الخاصة بها.

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

القواعد، وجميعها تُفرض عند التسجيل:

- **المعرّفات.** يطابق المعرّف النمط `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`، ولا يتجاوز 64 حرفًا، ويجب أن يبدأ بالاسم المختصر (slug) للإضافة متبوعًا بشرطة: `acme-` في المثال أعلاه. الاسم المختصر هو اسم مجلد الإضافة، لذا لا يمكن لمجلد مثل `my_plugin` تسجيل أي شيء. كما يُرفض مجلد إضافة باسم `cacti`؛ فذلك النطاق مخصّص للقدرات المدمجة.
- **التعريف.** هذه المفاتيح تحديدًا: `label`، `description` (حتى 4096 بايت)، `category`، `input_schema`، `output_schema`، `annotations`، `permission`، `execute`. يجب أن تكون الفئة موجودة مسبقًا: استخدم فئة مدمجة (`inventory`، `system`) أو سجّل فئتك الخاصة عبر `registerCategory()`، التي يكون معرّفها فريدًا عبر جميع الإضافات ويطابق `^[a-z][a-z0-9-]{0,31}$`.
- **للقراءة فقط حصرًا.** يجب أن تكون `annotations` تمامًا `readOnly: true`، `destructive: false`، `idempotent: true`. وأي قيمة أخرى تطلق استثناءً.
- **المخططات.** يجب أن يحتوي كل من `input_schema` و`output_schema` في المستوى الأعلى على `type` بقيمة `object`. هذه اللغة الفرعية للمخطط صغيرة وتفشل بإغلاق (fail closed). يجب أن تكون الكائنات مغلقة (`additionalProperties: false`، مع وجود `properties`)؛ أما الأنواع الأخرى فهي `integer` و`number` (`minimum`، `maximum`)، و`string` (`minLength`، `maxLength`، `enum`، `pattern`)، و`boolean`، و`array` (التي تتطلب `items` و`maxItems`). يمكن جعل النوع قابلًا للقيمة الفارغة مثل `['string', 'null']`. يبلغ الحد الافتراضي لسلاسل المعاملات 4096 حرفًا كحد أقصى؛ بينما تقتصر سلاسل النتائج على `maxLength` المصرّح به والحد الأقصى لحجم النتيجة فقط. يمكن تسجيل 256 قدرة كحد أقصى.
- **`permission(int $userId): bool`.** يجب أن تُرجع `true` تحديدًا للسماح. معرّف المستخدم هو معرّف مالك الرمز المميز؛ لا تقرأ حالة الجلسة أبدًا.
- **`execute(int $userId, stdClass $args): array`.** يكون `$args` قد تم التحقق من صحته بالفعل مقابل `input_schema`. طبّق صلاحيات مستوى الكائن بنفسك. أرجع مصفوفة ترابطية تطابق `output_schema` تمامًا؛ إذ تتحول القائمة أو الحقل الإضافي أو ما يتجاوز 1 ميجابايت من JSON إلى خطأ `INVALID_RESULT`. أطلق `AbilitiesError` عند حدوث إخفاق مرئي للعميل، مثل `NOT_FOUND`.
- **الكائنات الفارغة.** ترمّز PHP القيمة `[]` كمصفوفة JSON. وأينما يصرّح مخطط الإخراج عن `object`، على أي عمق، يعامل السجل `[]` ككائن فارغ ويرسل `{}`؛ كما تعمل `new stdClass()` أيضًا. لا تُعد القائمة غير الفارغة كائنًا أبدًا وتفشل بالخطأ `INVALID_RESULT`. يمكن أن تكون خريطة `properties` الفارغة في المخطط `[]` أو `new stdClass()`؛ ويُنشَر كلاهما كـ `{}`.
- **عزل الإخفاقات.** تسجّل كل إضافة داخل نسخة مؤقتة لا يُحتفَظ بها إلا إذا عادت دالتك بشكل طبيعي. أما إذا أطلقت استثناءً، فلا يُسجَّل أي من قدراتك، ويُدوَّن الإخفاق في السجل.

تبدأ قدرات الإضافات مخفية. يقوم المسؤول بإظهارها من تبويب Abilities في وحدة التحكم، ويُعرَض في عمود Required Realm لها النص "Set by the plugin".

## نموذج الأمان

- **رمز Bearer فقط.** يقبل كل من `api.php` و`mcp.php` رمزًا شخصيًا في ترويسة `Authorization` ولا يقبلان أي وسيلة مصادقة أخرى. إذ يتجاهلان ملفات تعريف الارتباط و`$_POST` و`$_REQUEST` قبل تحميل Cacti، كما يُتلفان الجلسة التي يبدؤها Cacti، وبذلك لا يمنح تسجيل الدخول عبر المتصفح أي صلاحية وصول إلى واجهة البرمجة.
- **معالجة بديلة لآلية CSRF.** يرفض حارس CSRF في Cacti أي طلب JSON من نوع POST لا يحتوي على رمز CSRF الخاص بـ Cacti، وهو ما لا يستطيع أي عميل MCP إرساله. ولهاتين النقطتين النهائيتين فقط، يُعيد المكون الإضافي تسمية طريقة الطلب قبل تحميل Cacti ثم يستعيدها بعد ذلك، بحيث يتجاوزهما الحارس. يُعد هذا الإجراء آمنًا لأن آلية CSRF تحمي الطلبات التي يصادق عليها المتصفح عبر ملفات تعريف الارتباط، بينما لا تقبل هاتان النقطتان النهائيتان أي هوية تعتمد على ملفات تعريف الارتباط: فلا يمكن لصفحة عابرة للمواقع إرفاق رمز Bearer. وتحتفظ صفحات وحدة التحكم بالحماية الكاملة لآلية CSRF. هذا الحل مؤقت إلى أن يوفّر Cacti استثناءً مدعومًا رسميًا؛ راجع `lib/bootstrap.php`.
- **التحقق من الأصل (Origin).** في `mcp.php`، إذا احتوى الطلب على ترويسة `Origin`، فيجب أن تطابق تمامًا المخطط والمضيف والمنفذ الخاصين بعنوان URL العام لـ Cacti، وإلا يُرفض الطلب بالرمز `ORIGIN_NOT_ALLOWED`. أما الطلب الذي لا يحتوي على ترويسة `Origin` — وهي الطريقة التي تتصل بها العملاء غير المعتمدة على المتصفح — فيُسمح به. يمنع ذلك أي صفحة ويب من تشغيل النقطة النهائية من متصفح الزائر. ولا يطبّق `api.php` هذا الفحص.
- **للقراءة فقط.** يرفض التسجيل أي قدرة ليست للقراءة فقط، أو غير مدمّرة، أو غير متكررة الأثر (idempotent).
- **تطبيق العرض والصلاحيات معًا.** يجب أن تكون القدرة مكشوفة وأن يمتلك مالك الرمز الصلاحية (realm) الخاصة بها. وإذا تعذّر قراءة جدول العرض، تُخفى كل القدرات بدلًا من الرجوع إلى القيم الافتراضية.
- **المخفي وغير المعروف وغير المصرح به تبدو متطابقة.** لا يستطيع العميل التمييز بين قدرة غير موجودة وأخرى مخفية أو لا يحق لمستخدمه استخدامها: إذ يتجاهلها الاستكشاف ويُرجع التنفيذ `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **الرموز.** تُخزَّن على هيئة بصمات SHA-256، وتُعرض مرة واحدة فقط، وتنتهي صلاحيتها دائمًا، وقابلة للإبطال، وتُرفض عند تعطيل مالكها أو فقده للصلاحية المطلوبة.
- **التدقيق.** يسجّل جدول `plugin_mcp_audit` معرّف الطلب ومعرّف الرمز ومعرّف المستخدم والقدرة والنتيجة (`started` أو `succeeded` أو `failed` أو `denied` أو `rejected`) والطوابع الزمنية. ولا يسجّل أبدًا الوسائط أو النتائج أو قيم الرموز. ولا تعمل القدرة إلا بعد كتابة سجل `started` الخاص بها؛ وإذا كان جدول التدقيق غير متاح، يفشل الاستدعاء بالرمز `UNAVAILABLE` ولا يُنفّذ. وأي استدعاء يُرفض قبل التنفيذ يُسجّل في صف واحد: `denied` للقدرة غير المعروفة أو المخفية أو غير المصرح بها، و`rejected` للوسائط التي تخالف المخطط. وتُسجّل عمليات إنشاء الرموز وإبطالها من وحدة التحكم وصفحة «رموز MCP الخاصة بي» وواجهة سطر الأوامر باسم `mcp-token-create` و`mcp-token-revoke` مع النتيجة `succeeded`، ولا يُسجّل الإبطال إلا لرمز كان نشطًا. ولا يُسجّل الاستكشاف ولا أي استدعاء لا تكون فيه `arguments` كائن JSON.
- **سجل الإخفاقات.** يؤدي أي فشل غير متوقع، أو `INVALID_RESULT`، أو عدم توفر جدول التدقيق إلى كتابة سطر واحد في سجل Cacti ضمن التصنيف `MCP`: معرّف القدرة، وسبب ثابت، وفئة الاستثناء. ولا تُسجّل الرسائل أو الوسائط أو الرموز أبدًا.
- **أداة الاستطلاع الرئيسية فقط.** ترفض كلتا النقطتين النهائيتين، وصفحتا وحدة التحكم، و`tokens.php` العمل في أي مكان آخر.

## دورة الحياة

يؤدي تعطيل المكون الإضافي إلى حظر كلتا النقطتين النهائيتين. ويؤدي إلغاء التثبيت إلى إبطال كل رمز مع الإبقاء على الجداول الثلاثة (`plugin_mcp_token` و`plugin_mcp_audit` و`plugin_mcp_ability`) للاحتفاظ بالبيانات؛ ولا يُعيد التثبيت تفعيل أي رمز مُبطل. احفظ نسخًا احتياطية من الجداول مع قاعدة بيانات Cacti وطبّق سياسة للاحتفاظ بسجلات التدقيق خارج المكون الإضافي.

## التطوير والاختبارات

تضم مجموعة الاختبارات نصوص PHP برمجية بسيطة في `tests/` إلى جانب اختبارات الوحدة لـ PHPUnit في `tests/Unit/` والتحليل الساكن عبر PHPStan (المستوى 6)، وتعمل جميعها من دون تثبيت Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

يعمل التكامل المستمر (CI) على إصدارات PHP من 8.2 إلى 8.5: مهمة `test` تفحص صياغة PHP (`php -l`) وتشغّل نصوص الاختبار الـ 13 البسيطة بلغة PHP المدرجة في `.github/workflows/ci.yml`، ومهمة `quality` تشغّل `composer phpstan` و`composer test`، ومهمة `package` تبني أرشيف `mcp/` القابل للتثبيت (باستثناء ملفات التطوير والاختبار المدرجة في `.gitattributes`) وقيم `SHA256SUMS` الخاصة به. وتستخدم الاختبارات التي تتعامل مع Cacti بيانات ثابتة عند حدود دوال Cacti المساعدة؛ ولا تختبر تثبيتًا كاملًا لـ Cacti.

### اختبارات التكامل

يقوم الأمر `tests/integration/run.sh 1.2.31` أو `tests/integration/run.sh develop` بتثبيت المكون الإضافي داخل نسخة حقيقية من Cacti ضمن حاويات وتشغيل فحوصات حية عليه. ويتطلب وجود Docker مع Compose بالإصدار v2.23.1 أو أحدث، بالإضافة إلى git وopenssl. ويُبقي المتغير `KEEP=1` الحزمة قيد التشغيل لأغراض التصحيح. ويشغّل التكامل المستمر هذا الاختبار ليليًا وعند الطلب، وليس في طلبات السحب.

## التوطين

يأتي Cacti MCP مزوّدًا بفهارس GNU gettext المجمّعة ضمن `locales/po/` و`locales/LC_MESSAGES/` وملفات README المترجمة ضمن `docs/i18n/` للغة الإنجليزية بالإضافة إلى 47 لغة وإعدادًا محليًا (19 لغة من الفئة الأولى الواسعة، و15 لغة أفريقية، و10 لغات آسيوية، بالإضافة إلى البوسنية والكرواتية والصربية)، باستخدام نطاق النصوص `mcp` (`locales/po/mcp.pot`). ويحمّل Cacti الفهرس المطابق تلقائيًا عند تفعيل دعم اللغات.

## المساهمة

تُرسل طلبات السحب إلى الفرع `develop`. حافظ على توافق شيفرة الإنتاج مع PHP 8.2 والتزم بأسلوب Cacti: المسافات الجدولية (tabs)، والسلاسل النصية ذات علامات الاقتباس المفردة، ودوال Cacti المساعدة لقاعدة البيانات والصلاحيات. أضف اختبارات لأي تغيير في التحقق أو التفويض أو سلوك البروتوكول، ووقّع الإيداعات باستخدام `git commit -s`. نسّق التغييرات على واجهة برمجة تطبيقات HTTP مع [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## الترخيص

حقوق النشر (C) 2026 Thomas Vincent. مُصدر بموجب رخصة GNU General Public License، الإصدار 2 أو أحدث. راجع [LICENSE](../../../LICENSE).
