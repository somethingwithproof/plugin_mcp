<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: صبار بدرع. اكتشف. رخّص. نفّذ.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="التكامل المستمر (CI)"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="الترخيص: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP هي إضافة (plugin) لنظام Cacti تُمكّن عملاء الذكاء الاصطناعي من قراءة بيانات Cacti الخاصة بك عبر عمليات مُسمّاة ومُرشّحة حسب الصلاحيات تُعرف باسم القدرات (abilities). توفّر الإضافة هذه القدرات بطريقتين انطلاقاً من الإضافة نفسها: نقطة نهاية MCP (`mcp.php` عبر Streamable HTTP) وواجهة برمجة تطبيقات HTTP بنمط AIP (`api.php`). يظل نظام Cacti مسؤولاً عن التفويض والتنفيذ؛ إذ لا يقوم العميل أبداً بالاستعلام المباشر عن قاعدة البيانات، بل يمكنه فقط استدعاء القدرة التي كشفها المسؤول والتي تسمح بها مجالات (realms) Cacti الخاصة بمالك الرمز (token).

يمكن لمطوّري الإضافات تسجيل قدراتهم الخاصة للقراءة فقط عبر الخطاف (hook) `abilities_register`، فتظهر لعملاء MCP كأدوات (tools) دون الحاجة إلى كتابة أي شيفرة خاصة بالبروتوكول.

**الحالة: إصدار تجريبي مسبق (pre-release)، النسخة 0.1.0.** لا يوجد أي إصدار موسوم (tagged release) حالياً.

المتوفر حالياً:

- تسع قدرات مدمجة للقراءة فقط تغطي إصدارات النظام والأجهزة والمواقع والمُجمّعات (pollers) وأشجار الرسوم البيانية والرسوم البيانية ومصادر البيانات ومقتطفاً محدوداً ومنقّحاً من نهاية سجل Cacti.
- رموز الولوج الشخصية (`cmcp_pat_...`) باعتبارها وسيلة الاعتماد الوحيدة.
- وحدة تحكم الإدارة > MCP (Management > MCP): كشف القدرات أو إخفاؤها، إنشاء الرموز وإلغاؤها، وقراءة سجل التدقيق (audit log).
- الإدارة > رموز MCP الخاصة بي (Management > My MCP Tokens): يدير المستخدمون رموزهم الخاصة، ويطّلعون على نشاطهم، ويرون الأدوات التي يمكن لرموزهم استخدامها.
- بروتوكول MCP عبر Streamable HTTP، بمراجعتي البروتوكول `2026-07-28` و`2025-11-25`، للأدوات فقط.

غير المتوفر بعد:

- تسجيل الدخول عبر OAuth 2.1. الروابط المُستضافة التي لا تستطيع إرسال رمز شخصي، مثل موصلات ChatGPT وclaude.ai المخصصة، لا يمكنها الاتصال إلى أن يتوفر هذا الدعم. وهو مُخطط له ضمن الخطة 2؛ ولم تُكتب هذه الخطة بعد.
- قدرات الكتابة (تعديل البيانات). لا يمكن تسجيل سوى قدرات القراءة فقط.

التصميم موثّق في
[مواصفات تصميم نقطة النهاية](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)،
وتسلسل البناء موجود في [docs/plan.md](../../plan.md).

## القدرات المدمجة

| المعرّف | الفئة | المعاملات | مجال Cacti المطلوب |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | لا يوجد | 15 |
| `cacti-list-devices` | `inventory` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-get-device` | `inventory` | إجباري: `name`، مثل `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-list-pollers` | `system` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 7 أو 4 |
| `cacti-list-graphs` | `inventory` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 7 أو 5 |
| `cacti-list-data-sources` | `inventory` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-get-clog` | `system` | اختيارية: `lines` (من 1 إلى 200، الافتراضي 50)، `severity`، `search` | 19 أو 18 |

يتطلب كل استدعاء أيضاً امتلاك مالك الرمز لمجال **MCP وواجهة برمجة التطبيقات Abilities (MCP and Abilities API)**، ونطاق الصلاحية `abilities:read` (يمتلكه كل رمز شخصي)، وأن تكون القدرة مكشوفة. يعرض تبويب القدرات (Abilities) في وحدة التحكم المجال الأساسي الذي تحتاجه كل قدرة مدمجة.

تُرجع قدرات `cacti-list-*` الست جميعها صفحات تصل إلى 100 عنصر كحد أقصى (الافتراضي 50) مع رمز `nextPageToken`. يكون رمز الصفحة صالحاً فقط لنفس `filter` و`orderBy`. المعامل `filter` هو تعبير AIP-160 لمقارنات (`=`، `!=`، `<`، `<=`، `>`، `>=`) مربوطة بـ `AND`، مثلاً `state = "DOWN" AND disabled = false`. يقبل `orderBy` لائحة مفصولة بفواصل من الحقول القابلة للترتيب، متبوعة اختيارياً بـ `asc` أو `desc`.

| القدرة | حقول التصفية | حقول الترتيب |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

حصر الصلاحيات واستبعاد الأسرار:

- تمر استعلامات `cacti-list-devices` و`cacti-get-device` عبر دالة `get_allowed_devices()` في Cacti وتستبعد سلاسل مجتمع SNMP وعبارات المرور وباقي بيانات الاعتماد.
- تستعلم `cacti-list-trees` عبر `get_allowed_trees()` (وتُرشّح عبر `is_tree_allowed()` عند توفرها)؛ وتستعلم `cacti-list-graphs` عبر `get_allowed_graphs()` (وتُرشّح عبر `is_graph_allowed()` عند توفرها).
- تحصر `cacti-list-data-sources` الصفوف في الأجهزة المسموح بها للمُستدعي انطلاقاً من `get_allowed_devices()` (و`is_device_allowed()` عند توفرها) وتُرجع البيانات الوصفية فقط دون الاستعلام من `data_input_data` أو كشف قيم الإدخال السرية.
- تستبعد `cacti-list-pollers` بيانات اعتماد قاعدة البيانات (`dbpass`، `dbuser`) وأعمدة مفاتيح وشهادات TLS (`dbsslkey`، `dbsslcert`، `dbsslca`).
- تقرأ `cacti-get-clog` حتى آخر 1 ميغابايت من سجل Cacti المُعدّ (مع بتر السطور الفردية التي تتجاوز 2048 بايت)، وتُرشّح حسب `severity` (`ALL`، `DEBUG`، `INFO`، `NOTICE`، `WARNING`، `ERROR`، `CRITICAL`، `ALERT`، `EMERGENCY`، `FATAL`، `STATS`، `POLLER`، `SYSTEM`؛ الافتراضي `ALL`) و`search` غير حساس لحالة الأحرف (حتى 256 حرفاً)، وتُرجع `lines` و`count` و`truncated`. يتم تنقيح كل سطر لإخفاء الرموز الشخصية وترويسات bearer/basic وكلمات المرور والأسرار ومجتمعات SNMP والمفاتيح و`dbpass` و`dbsslkey` ومعلومات مستخدم URL قبل تشغيل مرشحات `severity` و`search` حتى لا يعمل `search` ككاشف للأسرار. يفشل التنقيح بشكل آمن مع `[redacted]`، ويُرجع السجل غير القابل للقراءة `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## التثبيت

يتطلب نظام Cacti 1.2.31 أو أحدث، وPHP 8.2 أو أحدث، والمُجمّع الرئيسي (main poller). يجب أن تكون مصادقة Cacti مُفعّلة؛ ترفض الإضافة المصادقة عندما تكون معطّلة.

يجب أن يكون اسم مجلد الإضافة `mcp` وليس `plugin_mcp`. فالمعرّف المختصر للإضافة، وأسماء المجالات، ونطاق الترجمة، وعناوين URL تعتمد جميعها على `mcp`.

انطلاقاً من نسخة مستخرجة من الشيفرة المصدرية:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

إلى أن تتوفر إصدارات موسومة، يمكنك بدلاً من ذلك تنزيل الحزمة `mcp-plugin` من
[تشغيل التكامل المستمر (CI)](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
ناجح. تحتوي الحزمة على `mcp.tar.gz` و`SHA256SUMS`. تحقّق من مجموع التحقق (checksum)، ثم فكّ ضغط `mcp.tar.gz` داخل مجلد `plugins/` في Cacti لتصبح النتيجة `plugins/mcp/`. تعتمد أرشيفات الشيفرة المصدرية التلقائية في GitHub اسماً مختلفاً للمجلد الأعلى. كما يستثني الأرشيف مجلدات `docs/` (بما فيها لقطات الشاشة أدناه)، و`tests/`، و`.github/`، لذلك تعمل روابط ملف README المؤدية إلى `docs/` على GitHub لكنها لا تعمل في نسخة مُثبّتة محلياً.

بعد ذلك:

1. في إدارة الإضافات (Plugin Management)، ثبّت وفعّل **Cacti MCP**. يحصل المسؤول الذي يقوم بالتثبيت تلقائياً على مجال **إدارة MCP (MCP Administration)**.
2. ضمن الإعدادات > MCP (Settings > MCP)، اضبط **عنوان URL العام لـ Cacti (Public Cacti URL)** على العنوان الذي يستخدمه العملاء، مثل `https://cacti.example.com/cacti`. بروتوكول HTTPS إجباري باستثناء `localhost` و`127.0.0.1` و`[::1]`. إلى أن يتم ضبط هذا الإعداد، يُجيب `mcp.php` بحالة HTTP 400 مع خطأ JSON-RPC يحتوي حقل `data` الخاص به على `FAILED_PRECONDITION` و`PUBLIC_URL_REQUIRED`. لا يقرأ `api.php` هذا الإعداد.

   ![الإعدادات > MCP تُظهر حقل عنوان URL العام لـ Cacti](../../images/settings-public-url.png)

3. امنح مجال **MCP وواجهة برمجة التطبيقات Abilities (MCP and Abilities API)** لكل مستخدم سيمتلك رمزاً. لا يحصل أي مستخدم على هذا المجال تلقائياً.
4. تأكّد من أن خادم الويب يُمرّر ترويسة `Authorization` ومعلومات المسار (path info) إلى PHP (انظر أدناه).
5. افتح الإدارة > MCP (Management > MCP) واكشف القدرات التي تريد أن يراها العملاء.

**الترقية من نسخة تطويرية.** الإضافة في مرحلة ما قبل الإصدار، وقد تغيّرت جداولها أثناء التطوير دون مسارات ترحيل (migrations). إذا كنت قد ثبّتّ نسخة سابقة، فألغِ تثبيتها ثم ثبّتها من جديد. تحافظ إعادة التثبيت على الجداول الموجودة مسبقاً، لذا احذف الجداول القديمة `plugin_mcp_token` و`plugin_mcp_audit` و`plugin_mcp_ability` أولاً (والجداول المكافئة من النسخ المبنية قبل تغيير الاسم). خذ نسخة احتياطية منها إذا كنت بحاجة إلى سجلّها التاريخي؛ تُلغى الرموز الصادرة عن تلك النسخ عند إلغاء التثبيت ولا تنتقل إلى النسخة الجديدة.

### خادم الويب

إعدادات Apache التي تزيل ترويسة `Authorization` قبل وصولها إلى PHP تحتاج إلى إضافة هذا السطر في المضيف الافتراضي (virtual host) أو المجلد المعني، متبوعاً بإعادة تحميل الخادم:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

خادم Apache مع `mod_php` يخدم مسارات `api.php` دون أي إعداد إضافي للمسار.

توجد مسارات `api.php` في جزء المسار الذي يلي اسم السكربت (`/plugins/mcp/api.php/v1/abilities`)، لذلك يجب أن يطابق nginx عناوين URI التي يتبع فيها `.php` مسار إضافي، وأن يفصل معلومات المسار ويُمرّرها إلى PHP. كتلة `location ~ \.php$` لا تطابق هذه العناوين أبداً؛ فيُجيب nginx بصفحة HTML 404 الخاصة به. تم التحقق من نمط الموقع وسطري معلومات المسار أدناه مع PHP-FPM؛ أما باقي الأسطر فهي إعدادات قياسية:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

عدّل سطري `include` و`fastcgi_pass` ليتطابقا مع الكتلة التي تخدم Cacti بالفعل. لا تُضف `try_files $fastcgi_script_name =404;` إلى هذه الكتلة: لأنها تمسح قيمة `$fastcgi_path_info`، وعندها يُجيب `api.php` بالخطأ 404 `UNKNOWN_PATH`. إذا كان إعدادك يتطلب `try_files`، فاحفظ القيمة أولاً عبر `set $path_info $fastcgi_path_info;` ثم مرّر `fastcgi_param PATH_INFO $path_info;`.

لا يحتوي `mcp.php` على مسارات إضافية داخل المسار ولا يحتاج إليها.

## وحدة التحكم

تضم الإدارة > MCP (Management > MCP) ثلاثة تبويبات. تحتاج إلى مجال **إدارة MCP (MCP Administration)**. لقطات الشاشة هنا وأدناه مأخوذة من نسخة تطويرية لنظام Cacti مع بيانات تجريبية.

- **القدرات (Abilities)** يسرد كل قدرة مُسجّلة مع إضافتها، وفئتها، والمجال الذي تحتاجه، وما إذا كانت مكشوفة. حدّد الصفوف واختر كشف (Expose) أو إخفاء (Hide)؛ وسيُطلب منك التأكيد قبل تطبيق التغيير. القدرات المدمجة `cacti-*` تكون مكشوفة افتراضياً. أما القدرات القادمة من إضافات أخرى فتبدأ مخفية، بحيث لا يؤدي تثبيت إضافة جديدة إلى نشر أي شيء حتى يقرّر المسؤول ذلك. يؤدي الكشف إلى حصر الوصول فقط: إذ يظل المستخدم بحاجة إلى مجال القدرة نفسه.

  ![تبويب القدرات يسرد القدرات المدمجة مع مجالاتها وحالة كشفها](../../images/console-abilities.png)
- **الرموز (Tokens)** يسرد الرموز مع المالك، والمنشئ، وتاريخ الإنشاء، وتاريخ الانتهاء، وآخر استخدام، والحالة (نشط Active، منتهي الصلاحية Expired، مُلغى Revoked). حدّد الصفوف واختر إلغاء (Revoke) لإبطالها. لا يمكن استخدام الرموز المُلغاة مجدداً. زر إنشاء رمز (Create Token) يُنشئ رمزاً جديداً.

  ![تبويب الرموز يسرد الرموز مع المالك وتاريخ الانتهاء وآخر استخدام والحالة، فوق نموذج إنشاء الرمز](../../images/console-tokens.png)
- **التدقيق (Audit)** يسرد سجلات التدقيق من الأحدث إلى الأقدم، ويتيح التصفية حسب المستخدم والقدرة والنتيجة.

  ![تبويب التدقيق يسرد الاستدعاءات مع المستخدم والرمز والقدرة والنتيجة، مع عوامل التصفية](../../images/console-audit.png)

## الرموز

يقرأ الرمز الشخصي نظام Cacti بصلاحيات مالكه. يتخذ الشكل `cmcp_pat_` متبوعاً بـ 64 محرفاً ست عشرياً بأحرف صغيرة، ويحمل نطاق الصلاحية الوحيد `abilities:read`. ما يمكن للرمز رؤيته تحدده مجالات Cacti وصلاحيات الأجهزة الخاصة بمالكه، وليس الرمز نفسه. يجب أن يكون المالك مستخدماً مفعّلاً يمتلك مجال **MCP وواجهة برمجة التطبيقات Abilities (MCP and Abilities API)**.

تُنشأ الرموز دائماً لمستخدم محدّد، ولها مدة صلاحية، ويمكن إلغاؤها:

- **وحدة التحكم.** الإدارة > MCP > الرموز > إنشاء رمز (Management > MCP > Tokens > Create Token). تتراوح مدة الصلاحية بين 1 و365 يوماً، والافتراضي هو 90 يوماً. يُولَّد الرمز من طرف الخادم ويُعرض مرة واحدة فقط في صفحة الاستجابة، لذا انسخه فوراً إلى مدير الأسرار الخاص بك. يمكنك إنشاء رمز لنفسك. أما إنشاء رمز لمستخدم آخر فيتطلب أيضاً مجال المستخدمين/المجموعات (Users/Groups)، لأن الرمز يقرأ Cacti بصفته ذلك المستخدم.
- **رموز MCP الخاصة بي (My MCP Tokens).** يمكن لأي مستخدم يمتلك مجال MCP وواجهة برمجة التطبيقات Abilities إدارة رموزه الخاصة؛ انظر أدناه.
- **سطر الأوامر.** يعمل `tokens.php` من واجهة سطر الأوامر (CLI) فقط، بحساب نظام تشغيل يملك صلاحية إدارة Cacti. يأخذ الرمز من متغيرات البيئة بحيث لا تظهر قيمته أبداً في سطر الأوامر أو في قائمة العمليات. تتراوح مدة الصلاحية بين 1 و365 يوماً، والافتراضي هو 30 يوماً. يُدقّق إنشاء الرمز وإلغاؤه عبر سطر الأوامر كما في وحدة التحكم، مع تسجيل مالك الرمز كفاعل لأن سطر الأوامر لا يملك مستخدم Cacti، ولذلك لا يُعلّم سطر التدقيق الإجراء على أنه صادر من سطر الأوامر. يطبع الخيار `--list` كل رمز بصيغة JSON (المعرّف، المالك، النطاقات، الطوابع الزمنية، وعلم الإلغاء) ولا يطبع قيمة الرمز أبداً؛ ويعرض `--help` طريقة الاستخدام.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

لا يمكن إنشاء رموز لحساب الضيف (guest)، أو للمستخدمين المعطّلين، أو للمستخدمين الذين لا يملكون مجال **MCP وواجهة برمجة التطبيقات Abilities (MCP and Abilities API)**، سواء من وحدة التحكم، أو سطر الأوامر، أو صفحة رموز MCP الخاصة بي. يخزّن Cacti إعداد الضيف كاسم مستخدم أو معرّف مستخدم، وتتعامل الإضافة مع الحالتين معاً. يتوقف أي رمز يصبح مالكه هو حساب الضيف عن العمل عند طلبه التالي.

### رموز MCP الخاصة بي

لا تحتاج صفحة الإدارة > رموز MCP الخاصة بي (`plugins/mcp/mcp_tokens.php`) إلى مجال الإدارة: فهي مشمولة بمجال **MCP وواجهة برمجة التطبيقات Abilities (MCP and Abilities API)**، ولا يظهر عنصر القائمة إلا للمستخدمين الذين يمتلكونه. تعمل الصفحة دائماً على المستخدم المسجّل دخوله. نظراً لأن قائمة Cacti جزء من وحدة التحكم، فإن المستخدم الذي لا يملك صلاحية الوصول إلى وحدة التحكم يصل إلى الصفحة عبر عنوانها المباشر.

![تبويب رموزي يسرد رموز المستخدم المسجل دخوله ونموذج الإنشاء](../../images/my-tokens.png)

- **الرموز (Tokens)** يسرد رموزك، ويُنشئ رمزاً جديداً (من 1 إلى 365 يوماً، الافتراضي 90، ويُعرض مرة واحدة في الاستجابة)، ويُلغي رموزك الخاصة. لا يمكنك رؤية رموز أي شخص آخر أو إلغاؤها.
- **النشاط (Activity)** يسرد الإجراءات التي نفّذتها، من الأحدث إلى الأقدم: الاستدعاءات المُنفّذة برموزك والتغييرات التي أجريتها على الرموز.
- **الأدوات المتوفرة (Available Tools)** يسرد القدرات التي يمكن لأحد رموزك استخدامها الآن، مع معرّف كل قدرة واسمها ووصفها. تتبع هذه القائمة صلاحياتك في Cacti وإعدادات الكشف التي اختارها المسؤول.

  ![قائمة الأدوات المتوفرة تُظهر معرّف كل قدرة واسمها ووصفها](../../images/my-tools.png)

التثبيت الذي أُجري قبل وجود هذه الصفحة تكون له قائمة ملفات مجال لا تتضمن `mcp_tokens.php`. يقوم التثبيت بتسجيل القائمة؛ ولا يتم تحديثها عبر تفعيل الإضافة أو تعطيلها. ألغِ تثبيت الإضافة ثم ثبّتها من جديد، وبعدها امنح المجالات مرة أخرى، لأن Cacti يزيل منح المجالات عند إلغاء تثبيت الإضافة.

لا تخزّن قاعدة البيانات سوى تجزئة SHA-256 للرمز، لذلك لا يمكن استرجاع الرمز المفقود؛ ألغِه وأنشئ آخر. وتتم عملية التدوير (rotation) بالطريقة نفسها: أنشئ رمزاً جديداً، وحوّل العميل إليه، ثم ألغِ الرمز القديم. يفشل كل من الرمز المنتهي الصلاحية، والرمز المُلغى، والمالك المعطّل، والمجال المفقود عند الطلب التالي. لا تُقبل الرموز إلا في ترويسة `Authorization: Bearer`؛ ولا يُقبل أي رمز في سلسلة الاستعلام (query string) أو في جسم الطلب (body).

## ربط عميل

استعمل نقطة النهاية `https://cacti.example.com/cacti/plugins/mcp/mcp.php` لبروتوكول MCP، مع تمرير الرمز (Token) في ترويسة `Authorization: Bearer`. احتفظ بالرمز في متغير بيئة أو في مدير أسرار وقم بالإشارة إليه انطلاقاً من إعدادات العميل بدل كتابة قيمته مباشرة داخل ملف.

### Claude Code

ضع نقطة النهاية في ملف `.mcp.json` خاص بالمشروع يشير إلى الرمز بالاسم. يقوم Claude Code بتوسيع `${VAR}` في `url` و `headers`، وبالتالي لا يتضمن الملف أي سر ويكون آمناً للإيداع في مستودع الشيفرة. قم بتصدير `CACTI_MCP_TOKEN` في البيئة التي تشغّل Claude Code.

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

يمكنك أيضاً إضافته انطلاقاً من سطر الأوامر:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

عند استخدام علامتي الاقتباس المزدوجتين، يقوم الصَدَفة (Shell) بتوسيع `$CACTI_MCP_TOKEN` أولاً، فتُكتب قيمة الرمز داخل ملف الإعدادات الخاص بالخيار `--scope` المحدد (`local` أو `user` أو `project`؛ والافتراضي هو `local`). لا تستعمل هذه الصيغة مع `--scope project`، واحرص على إبقاء الملف خارج نظام التحكم في الإصدارات. يُفضَّل استخدام الإشارة عبر `.mcp.json` المذكورة أعلاه. يقرأ Claude Code بعض متغيرات الاعتماد (مثل `ANTHROPIC_AUTH_TOKEN`) كقيم فارغة في `url` و `headers` البعيدين؛ غير أن `CACTI_MCP_TOKEN` ليس من ضمنها. المصدر: [توثيق MCP لـ Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot في VS Code

استعمل ملف `.mcp.json` في جذر مساحة العمل (أو ملف المستخدم `~/.copilot/mcp-config.json`). تستعمل هذه الملفات الأصلية لـ Copilot كائناً في المستوى الأعلى باسم `mcpServers` وإشارات إلى متغيرات البيئة بصيغة `${NAME}` في قيم الترويسات:

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

قم بتصدير `CACTI_MCP_TOKEN` في البيئة التي تشغّل VS Code. لا تدعم ملفات Copilot الأصلية مطالبات `inputs`. كما يرفض الإعداد الموجه في VS Code القيم بصيغة `${...}`، لذا أضف ترويسة `Authorization` عبر تحرير الملف مباشرة، وليس عبر المسار الموجه. يقترح الإعداد الموجه ملف جذر مساحة العمل فقط عند تفعيل الإعداد التجريبي `chat.mcp.workspaceRootConfig.enabled`. راجع [مرجع إعدادات MCP في VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**قديم: `.vscode/mcp.json`.** توصي VS Code بألا تستعمل إعدادات Copilot الجديدة ملف `.vscode/mcp.json` أو ملف `mcp.json` الخاص بالملف الشخصي؛ فهما يتبعان لإطار Local المهجور، الذي ستتم إزالته في فبراير 2027. إذا كنت لا تزال تستعمله، فإن الصيغة التي يديرها المحرر تأخذ مفتاح `servers` في المستوى الأعلى ويمكنها طلب إدخال الرمز تفاعلياً:

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

يُعد [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) محوّلاً اختيارياً يعمل كخادم MCP محلي عبر stdio ويتواصل مع واجهة HTTP API الخاصة بالإضافة. استعمله مع أي عميل لا يستطيع الاتصال بخادم HTTP بعيد. وهو يحتاج إلى الرمز الشخصي نفسه ويتواصل مع `api.php`.

### سلوك MCP

توفر نقطة النهاية الأدوات فقط: كل قدرة مكشوفة ومصرَّح بها تمثل أداة تحمل معرّفها كاسم، مع مخططي الإدخال والإخراج وتعليقات القراءة فقط (`openWorldHint` مضبوط على `false`). وهي تعالج `initialize` و `server/discover` و `ping` و `tools/list` و `tools/call`. ولا تحتفظ بأي جلسة، ولا ترسل `Mcp-Session-Id` (كما تتجاهل أي ترويسة تتلقاها بهذا الاسم)، ولا تقبل حُزَم JSON-RPC المجمّعة (Batches). أي رسالة بدون `id` تُعتبر إشعاراً وتحصل على رمز HTTP 202 بدون جسم رد. يُسمح فقط بطريقة `POST`.

- **الإصدارات (Revisions).** أي طلب يحمل `io.modelcontextprotocol/protocolVersion` داخل `params._meta` يجب أن يحدد `2026-07-28`؛ وأي قيمة أخرى ترجع الخطأ `-32022`. كما يجب أن تحمل هذه الطلبات ترويسات متطابقة هي `Mcp-Protocol-Version` و `Mcp-Method` و (بالنسبة لـ `tools/call`) `Mcp-Name`، وإلا يكون الرد بالخطأ `-32020`. تُعامَل الطلبات الأخرى كـ `2025-11-25`: يرد `initialize` بهذا الإصدار، وفي أي طريقة أخرى، إذا أُرسلت ترويسة `Mcp-Protocol-Version` فيجب أن تكون `2025-11-25` أو `2025-06-18` أو `2025-03-26`.
- **أخطاء الأدوات.** أي خطأ صادر عن قدرة، بما في ذلك الوسائط غير المطابقة للمخطط أو قيمة `arguments` التي ليست كائن JSON، يرجع كنتيجة أداة مع `isError: true` وخطأ AIP-193 داخل `structuredContent`، وليس كخطأ بروتوكول.
- **أخطاء البروتوكول.** الإخفاقات التي ليست أخطاء أدوات هي كائنات خطأ JSON-RPC (الرمز `-32000` مع الحالة والسبب داخل `data`، أو الرموز القياسية): غياب عنوان Public Cacti URL، أو رفض `Origin`، أو طلب والملحق معطّل أو على جامع بيانات بعيد (Remote poller)، والأخطاء غير المتوقعة في الخادم (`-32603`، مع تسجيل التفاصيل في سجل Cacti وليس في الرد). وتحتفظ فحوصات الطلب الأولية (405، 413، 415) وإخفاقات المصادقة (401 `INVALID_TOKEN`، 403 `REALM_REQUIRED`) بجسم AIP-193 الموصوف ضمن HTTP API.

## واجهة HTTP API

عنوان الأساس: `https://cacti.example.com/cacti/plugins/mcp/api.php`. يوجد العقد البرمجي في [openapi.json](../../../openapi.json).

| الطريقة والمسار | الغرض |
| --- | --- |
| `GET /v1/abilities` | سرد القدرات المصرَّح بها. معاملات الاستعلام: `pageSize` و `pageToken` و `filter` بصيغة `category = "inventory"`. |
| `GET /v1/abilities/{id}` | قراءة قدرة واحدة. |
| `POST /v1/abilities/{id}:execute` | تنفيذها. جسم الطلب هو بالضبط `{"arguments": {...}}`. والرد هو `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

تتبع الأخطاء معيار AIP-193: كائن `error` يحتوي على `code` و `message` و `status` و `details` التي تحمل كائن `ErrorInfo` بنطاق `cacti.net` وقيمة `reason` مستقرة. وتضيف مشاكل الوسائط تفصيل `BadRequest` يحدد اسم الحقل. يبلغ الحد الأقصى لحجم جسم الطلب 64 كيلوبايت، وللنتائج 1 ميغابايت. تجيب كلتا نقطتي النهاية على الجامع الرئيسي (Main poller) فقط، وترجعان `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) عندما تكون الإضافة معطّلة أو عندما لا يكون الخادم هو الجامع الرئيسي.

| HTTP | قيم `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (يرسل أيضاً `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (يرسل `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## كتابة قدرة (لمطوري الإضافات)

تقوم إضافة Cacti المفعَّلة بتسجيل القدرات انطلاقاً من دالة تربطها بخطاف `abilities_register`، وغالباً ما يكون ذلك داخل `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

تستقبل الدالة كائن `AbilitiesRegistrar` محصوراً في نطاق الإضافة. وتُتجاهل قيمة إرجاعها.

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

القواعد، وجميعها مفروضة عند التسجيل:

- **المعرّفات (IDs).** يجب أن يطابق المعرّف التعبير `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`، وألا يتجاوز 64 حرفاً، وأن يبدأ بالاسم المختصر (Slug) للإضافة متبوعاً بواصلة: مثل `acme-` أعلاه. الاسم المختصر هو اسم مجلد الإضافة، لذا فإن مجلداً مثل `my_plugin` لا يمكنه تسجيل أي قدرة. ويُرفَض مجلد إضافة باسم `cacti`؛ لأن فضاء الأسماء هذا مخصص للقدرات المدمجة.
- **التعريف (Definition).** هذه المفاتيح بالضبط: `label` و `description` (حتى 4096 بايت) و `category` و `input_schema` و `output_schema` و `annotations` و `permission` و `execute`. يجب أن تكون الفئة موجودة مسبقاً: استعمل فئة مدمجة (`inventory`، `system`) أو سجّل فئتك الخاصة عبر `registerCategory()`، بحيث يكون معرّفها فريداً عبر جميع الإضافات ويطابق `^[a-z][a-z0-9-]{0,31}$`.
- **للقراءة فقط (Read-only only).** يجب أن تكون قيمة `annotations` بالضبط: `readOnly: true`، `destructive: false`، `idempotent: true`. أي شيء آخر يطلق استثناءً.
- **المخططات (Schemas).** يجب أن يكون لكل من `input_schema` و `output_schema` في المستوى الأعلى `type` بقيمة `object`. اللغة المعتمدة للمخطط محدودة وتفشل بإغلاق (Fail closed). يجب أن تكون الكائنات مغلقة (`additionalProperties: false`، مع وجود `properties`)؛ والأنواع الأخرى هي `integer` و `number` (`minimum`، `maximum`)، و `string` (`minLength`، `maxLength`، `enum`، `pattern`)، و `boolean`، و `array` (التي تتطلب `items` و `maxItems`). يمكن جعل النوع قابلاً للقيمة الفارغة مثل `['string', 'null']`. وتصل السلاسل النصية في الوسائط افتراضياً إلى 4096 حرفاً كحد أقصى؛ أما السلاسل النصية في النتائج فلا يحدّها سوى `maxLength` المُصرَّح به والحد الأقصى لحجم النتيجة. يمكن تسجيل 256 قدرة كحد أقصى.
- **`permission(int $userId): bool`.** يجب أن ترجع `true` بالضبط للسماح بالتنفيذ. معرّف المستخدم هو لصاحب الرمز؛ لا تقرأ حالة الجلسة أبداً.
- **`execute(int $userId, stdClass $args): array`.** يكون `$args` قد تم التحقق منه مسبقاً مقابل `input_schema`. افحص الصلاحيات على مستوى الكائن بنفسك. أرجع مصفوفة ترابطية تطابق `output_schema` تماماً؛ أي قائمة أو حقل إضافي أو JSON يتجاوز 1 ميغابايت يتحول إلى خطأ `INVALID_RESULT`. أطلق `AbilitiesError` لإرجاع فشل ظاهر للعميل، مثل `NOT_FOUND`.
- **الكائنات الفارغة (Empty objects).** ترمّز PHP القيمة `[]` كمصفوفة JSON. وأينما صرّح مخطط الإخراج بنوع `object`، على أي عمق، يتعامل السجل مع `[]` ككائن فارغ ويرسل `{}`؛ كما يعمل `new stdClass()` أيضاً. القائمة غير الفارغة لا تُعد أبداً كائناً وتفشل بخطأ `INVALID_RESULT`. يمكن أن تكون خريطة `properties` الفارغة في المخطط `[]` أو `new stdClass()`؛ وكلاهما يُنشر كـ `{}`.
- **عزل الأخطاء (Failure isolation).** تسجّل كل إضافة في نسخة مؤقتة لا يُحتفظ بها إلا إذا أنهت دالتك تنفيذها بشكل طبيعي. وإذا أطلقت استثناءً، فلا يتم تسجيل أي من قدراتك، ويُسجَّل الإخفاق في السجل.

تبدأ القدرات القادمة من الإضافات مخفية. يقوم المدير بإظهارها من تبويب Abilities في وحدة التحكم، ويعرض عمود Required Realm عبارة "Set by the plugin" بالنسبة لها.

## نموذج الأمان

- **رمز Bearer فقط.** يقبل كل من `api.php` و`mcp.php` رمزاً شخصياً في ترويسة `Authorization` ولا يقبلان أي وسيلة مصادقة أخرى. كما يقومان بحذف ملفات تعريف الارتباط (Cookies)، و`$_POST`، و`$_REQUEST` قبل تحميل Cacti، وإتلاف الجلسة التي يبدأها Cacti، بحيث لا يمنح تسجيل الدخول عبر المتصفح أي وصول إلى واجهة برمجة التطبيقات (API).
- **حل مؤقت لحماية CSRF.** يرفض حارس CSRF الخاص بـ Cacti أي طلب JSON POST لا يحتوي على رمز CSRF الخاص بـ Cacti، وهو ما لا يمكن لأي عميل MCP إرساله. بالنسبة لهاتين النقطتين الطرفيتين فقط، يعيد الملحق تسمية طريقة الطلب قبل تحميل Cacti ثم يستعيدها بعد ذلك، حتى يتجاوزهما الحارس. يُعد هذا آمناً لأن CSRF يحمي الطلبات التي يصادق عليها المتصفح عبر ملفات تعريف الارتباط، بينما لا تقبل هاتان النقطتان الطرفيتان أي هوية عبر ملفات تعريف الارتباط: فلا يمكن لصفحة عابرة للمواقع (cross-site) إرفاق رمز Bearer. تحتفظ صفحات وحدة التحكم بالحماية الكاملة من CSRF. هذا الحل مؤقت إلى أن يوفر Cacti استثناءً مدعوماً؛ راجع `lib/bootstrap.php`.
- **التحقق من الأصل (Origin).** في `mcp.php`، إذا كان الطلب يحتوي على ترويسة `Origin`، فيجب أن تطابق تماماً المخطط (scheme) والمضيف (host) والمنفذ (port) لعنوان URL العام لـ Cacti، وإلا يُرفض الطلب بالرمز `ORIGIN_NOT_ALLOWED`. يُسمح بالطلب الذي لا يحتوي على ترويسة `Origin`، وهي الطريقة التي تتصل بها العملاء من خارج المتصفح. يمنع هذا أي صفحة ويب من توجيه النقطة الطرفية انطلاقاً من متصفح الزائر. لا يطبق `api.php` هذا التحقق.
- **للقراءة فقط.** يرفض التسجيل أي قدرة (ability) ليست للقراءة فقط، أو غير مأمونة من التعديل (غير مدمرة)، أو غير متكررة الأثر (idempotent).
- **تطبيق كل من الإتاحة والنطاقات (Realms).** يجب أن تكون القدرة مُتاحة (exposed) وأن يمتلك مالك الرمز نطاق الصلاحية الخاص بها. إذا تعذرت قراءة جدول الإتاحة، يتم إخفاء جميع القدرات بدلاً من الرجوع إلى الإعدادات الافتراضية.
- **المخفي وغير المعروف وغير المصرح به تبدو متماثلة.** لا يمكن للعميل التمييز بين قدرة غير موجودة وقدرة مخفية أو قدرة لا يُسمح لمستخدمه باستعمالها: يتجاهلها الاستكشاف ويُرجع التنفيذ الرمز `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **الرموز المميزة (Tokens).** تُخزَّن بصيغة تجزئة SHA-256، وتُعرض مرة واحدة، ولها دائماً تاريخ انتهاء صلاحية، وقابلة للإلغاء، وتُرفض عند تعطيل المالك أو فقده لنطاق الصلاحية.
- **التدقيق (Audit).** يسجل جدول `plugin_mcp_audit` معرف الطلب، ومعرف الرمز، ومعرف المستخدم، والقدرة، والنتيجة (`started`، و`succeeded`، و`failed`، و`denied`، و`rejected`)، والطوابع الزمنية. لا يسجل أبداً المعاملات أو النتائج أو قيم الرموز. لا تُشغَّل القدرة إلا بعد كتابة صف `started` الخاص بها؛ وإذا كان جدول التدقيق غير متاح، يفشل الاستدعاء بالرمز `UNAVAILABLE` ولا يتم تشغيله. الطلب المرفوض قبل تشغيله يُسجل في صف واحد: `denied` لقدرة غير معروفة أو مخفية أو غير مصرح بها، و`rejected` للمعاملات التي تخالف المخطط (schema). يتم تسجيل إنشاء الرموز وإلغاؤها من وحدة التحكم، ومن صفحة رموز MCP الخاصة بي (My MCP Tokens)، ومن سطر الأوامر كـ `mcp-token-create` و`mcp-token-revoke` بالنتيجة `succeeded`، ولا يُسجل الإلغاء إلا لرمز كان نشطاً. لا يتم تسجيل عمليات الاستكشاف، ولا الاستدعاءات التي لا تكون فيها `arguments` كائن JSON.
- **سجل الأخطاء.** يؤدي أي فشل غير متوقع، أو `INVALID_RESULT`، أو عدم توفر جدول التدقيق إلى كتابة سطر واحد في سجل Cacti بالتصنيف `MCP`: يتضمن معرف القدرة، وسبباً ثابتاً، وفئة الاستثناء (exception class). لا تُسجَّل الرسائل أو المعاملات أو الرموز أبداً.
- **المُستطلِع الرئيسي (Main poller) فقط.** ترفض كلتا النقطتين الطرفيتين، وكلتا صفحتي وحدة التحكم، و`tokens.php` العمل في أي مكان آخر.

## دورة الحياة

يؤدي تعطيل الملحق إلى حظر كلتا النقطتين الطرفيتين. يؤدي إلغاء التثبيت إلى إلغاء جميع الرموز مع الاحتفاظ بالجداول الثلاثة (`plugin_mcp_token`، و`plugin_mcp_audit`، و`plugin_mcp_ability`) لأغراض الحفظ؛ ولا يؤدي إعادة التثبيت إلى إعادة تفعيل رمز مُلغى. احرص على نسخ الجداول احتياطياً مع قاعدة بيانات Cacti وتطبيق سياسة للاحتفاظ بسجلات التدقيق خارج الملحق.

## التطوير والاختبارات

تضم مجموعة الاختبارات نصوص PHP برمجية بسيطة في `tests/` إلى جانب اختبارات الوحدة لـ PHPUnit في `tests/Unit/` والتحليل الساكن عبر PHPStan (المستوى 6)، وتعمل كلها من دون تثبيت Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

يشتغل التكامل المستمر (CI) على إصدارات PHP من 8.2 إلى 8.5: مهمة `test` تفحص صياغة PHP (`php -l`) وتشغّل نصوص الاختبار الـ 13 البسيطة بلغة PHP المدرجة في `.github/workflows/ci.yml`، ومهمة `quality` تشغّل `composer phpstan` و`composer test`، ومهمة `package` تبني أرشيف `mcp/` القابل للتثبيت (باستثناء ملفات التطوير والاختبار المدرجة في `.gitattributes`) وقيم `SHA256SUMS` الخاصة به. تستخدم الاختبارات التي تمس Cacti بيانات اختبارية (fixtures) عند حدود دوال Cacti المساعدة؛ وهي لا تختبر تثبيتاً كاملاً لـ Cacti.

### اختبارات التكامل

يقوم الأمر `tests/integration/run.sh 1.2.31` أو `tests/integration/run.sh develop` بتثبيت الملحق داخل نسخة حقيقية من Cacti ضمن حاويات وتشغيل فحوصات حية عليه. يتطلب Docker مع Compose الإصدار v2.23.1 أو أحدث، وgit وopenssl. يُبقي المتغير `KEEP=1` المكدس قيد التشغيل لأغراض تصحيح الأخطاء. يشغله CI ليلياً وعند الطلب، وليس عند طلبات السحب (pull requests).

## التوطين

يوفر Cacti MCP كتالوجات GNU gettext مُجمَّعة ضمن `locales/po/` و`locales/LC_MESSAGES/` وملفات README مترجمة ضمن `docs/i18n/` للغة الإنجليزية بالإضافة إلى 47 لغة وإقليماً (19 لغة رئيسية من الفئة الأولى، و15 لغة أفريقية، و10 لغات آسيوية، بالإضافة إلى البوسنية والكرواتية والصربية)، باستخدام نطاق النص `mcp` (`locales/po/mcp.pot`). يُحمِّل Cacti الكتالوج المطابق تلقائياً عند تفعيل دعم اللغات.

## المساهمة

تُوجَّه طلبات السحب (Pull requests) إلى الفرع `develop`. حافظ على توافق شيفرة الإنتاج مع PHP 8.2 واتبع أسلوب كتابة Cacti: مسافات الجدولة (tabs)، والسلاسل النصية بعلامات اقتباس مفردة، ودوال قاعدة البيانات والصلاحيات الخاصة بـ Cacti. أضف اختبارات لأي تغيير في التحقق من الصحة، أو التفويض، أو سلوك البروتوكول، ووقّع الإيداعات (commits) باستخدام `git commit -s`. نسّق التغييرات في واجهة HTTP API مع [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## الترخيص

حقوق النشر (C) 2026 Thomas Vincent. مُصدر بموجب رخصة GNU General Public License، الإصدار 2 أو أحدث. راجع [LICENSE](../../../LICENSE).
