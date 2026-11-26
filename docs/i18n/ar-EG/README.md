<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: صبّارة بدرع. اكتشف. فوّض. نفّذ.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="الترخيص: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

إضافة Cacti MCP هي إضافة لنظام Cacti تتيح لعملاء الذكاء الاصطناعي قراءة بيانات Cacti الخاصة بك من خلال عمليات مُسمّاة ومُصفّاة حسب الصلاحيات تُعرف باسم القدرات (abilities). توفّر الإضافة هذه القدرات بطريقتين من داخل الإضافة نفسها: نقطة نهاية MCP (`mcp.php`، عبر Streamable HTTP) وواجهة HTTP API بنمط AIP (`api.php`). يظل Cacti هو المسؤول عن التفويض والتنفيذ؛ فلا يستعلم العميل من قاعدة البيانات مباشرةً أبدًا، بل يمكنه فقط استدعاء القدرة التي أتاحها المسؤول وتسمح بها نطاقات صلاحيات (realms) مالك الرمز في Cacti.

يمكن لمؤلفي الإضافات تسجيل قدراتهم الخاصة للقراءة فقط من خلال خطّاف `abilities_register`، وتظهر لعملاء MCP كأدوات دون الحاجة لأي كود بروتوكول.

**الحالة: إصدار تجريبي أولي (pre-release)، الإصدار 0.1.0.** لا يوجد إصدار موسوم (tagged release) حتى الآن.

المتاح حاليًا:

- قدرات مدمجة للقراءة فقط لإصدارات النظام وقائمة الأجهزة.
- رموز الوصول الشخصية (`cmcp_pat_...`) باعتبارها وسيلة الاعتماد الوحيدة.
- وحدة تحكم Management > MCP: لإتاحة أو إخفاء القدرات، وإنشاء الرموز وإلغائها، وقراءة سجل التدقيق.
- صفحة Management > My MCP Tokens: يدير المستخدمون رموزهم الخاصة، ويطّلعون على نشاطهم، ويرون الأدوات التي يمكن لرموزهم استخدامها.
- بروتوكول MCP عبر Streamable HTTP، بمراجعتي البروتوكول `2026-07-28` و`2025-11-25`، للأدوات فقط.

غير المتاح حتى الآن:

- تسجيل الدخول عبر OAuth 2.1. الروابط المُستضافة التي لا تستطيع إرسال رمز شخصي، مثل الموصّلات المخصصة في ChatGPT وclaude.ai، لا يمكنها الاتصال حتى يتوفر هذا الدعم. وهو مُخطّط له ضمن الخطة 2 (Plan 2)، ولم تُكتب تلك الخطة بعد.
- قدرات الكتابة. يمكن تسجيل قدرات القراءة فقط في الوقت الحالي.

التصميم موجود في
[مواصفات تصميم نقطة النهاية](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)،
وتسلسل البناء موجود في [docs/plan.md](../../plan.md).

## القدرات المدمجة

| المعرّف | المعاملات | نطاق Cacti المطلوب |
| --- | --- | --- |
| `cacti-get-system-info` | لا يوجد | 15 |
| `cacti-list-devices` | اختيارية: `pageSize`، `pageToken`، `filter`، `orderBy` | 3 |
| `cacti-get-device` | مطلوبة: `name`، مثل `devices/12` | 3 |

يحتاج كل استدعاء أيضًا إلى نطاق **MCP and Abilities API** لمالك الرمز،
ونطاق الصلاحية (scope) `abilities:read` (يمتلكه كل رمز شخصي)، وأن تكون القدرة
مُتاحة (exposed). يعرض تبويب Abilities في وحدة التحكم النطاق الذي تحتاجه كل قدرة مدمجة.

- تُرجع `cacti-list-devices` صفحات تضم حتى 100 جهاز (الافتراضي 50) ورمز
  `nextPageToken`. يكون رمز الصفحة صالحًا فقط لنفس قيمتي `filter` و`orderBy`.
  `filter` هو تعبير AIP-160 من مقارنات مربوطة بـ `AND`،
  على سبيل المثال `state = "DOWN" AND disabled = false`. حقول التصفية هي
  `displayName` و`hostname` و`disabled` و`site` و`poller` و`deviceTemplate`
  و`externalId` و`state`. يقبل `orderBy` القيم `displayName` أو `hostname` أو `name`،
  ويمكن إتباع كل منها اختياريًا بـ `desc`.
- تمر استعلامات الأجهزة عبر دالة `get_allowed_devices()` في Cacti، بحيث لا يرى المستخدم
  إلا الأجهزة التي يعرضها له Cacti أصلًا.
- تستبعد حقول الأجهزة سلاسل مجتمع SNMP وعبارات المرور وبيانات الاعتماد الأخرى.

## التثبيت

يتطلب Cacti 1.2.31 أو أحدث، وPHP 8.2 أو أحدث، والمُستطلِع الرئيسي (main poller). يجب أن تكون مصادقة Cacti مُفعّلة؛ ترفض الإضافة المصادقة عندما تكون معطّلة.

يجب أن يكون اسم مجلد الإضافة `mcp` وليس `plugin_mcp`. فالمعرّف المختصر للإضافة وأسماء النطاقات ونطاق الترجمة وعناوين URL كلها تستخدم `mcp`.

من نسخة مستنسخة من المصدر:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

وإلى أن تتوفر إصدارات موسومة، يمكنك بدلًا من ذلك تنزيل حزمة `mcp-plugin`
من [تشغيل CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) ناجح.
تحتوي الحزمة على `mcp.tar.gz` و`SHA256SUMS`. تحقّق من قيمة التدقيق (checksum)، ثم فك ضغط
`mcp.tar.gz` داخل مجلد `plugins/` في Cacti بحيث يكون الناتج `plugins/mcp/`.
تستخدم أرشيفات المصدر التلقائية في GitHub اسم مجلد أعلى مختلفًا. كما يستثني
الأرشيف مجلدات `docs/` (بما في ذلك لقطات الشاشة أدناه) و`tests/`
و`.github/`، لذا تعمل روابط README المتجهة إلى `docs/` على GitHub لكنها لا تعمل في النسخة المثبّتة.

بعد ذلك:

1. في إدارة الإضافات (Plugin Management)، ثبّت وفعّل **Cacti MCP**. يحصل المسؤول
   الذي يقوم بالتثبيت على نطاق **MCP Administration** تلقائيًا.
2. ضمن Settings > MCP، اضبط **Public Cacti URL** على العنوان الذي يستخدمه العملاء، مثل
   `https://cacti.example.com/cacti`. بروتوكول HTTPS مطلوب باستثناء
   `localhost` و`127.0.0.1` و`[::1]`. وحتى يتم ضبط هذا الإعداد، يرد `mcp.php` برمز HTTP 400
   مع خطأ JSON-RPC تكون قيمة `data` فيه `FAILED_PRECONDITION`
   و`PUBLIC_URL_REQUIRED`. لا يقرأ `api.php` هذا الإعداد.

   ![صفحة Settings > MCP وتظهر فيها خانة Public Cacti URL](../../images/settings-public-url.png)

3. امنح نطاق **MCP and Abilities API** لكل مستخدم سيمتلك رمزًا.
   لا يحصل أي مستخدم على هذا النطاق تلقائيًا.
4. تأكد من أن خادم الويب يمرّر ترويسة `Authorization` ومعلومات المسار (path info) إلى PHP
   (انظر أدناه).
5. افتح Management > MCP وأتِح (expose) القدرات التي تريد للعملاء رؤيتها.

**الترقية من نسخة تطوير.** الإضافة في مرحلة ما قبل الإصدار، وقد تغيّرت جداولها
أثناء التطوير دون نصوص ترحيل (migrations). إذا كنت قد ثبّت نسخة أقدم،
فألغِ تثبيتها ثم أعد التثبيت. تحتفظ إعادة التثبيت بالجداول الموجودة مسبقًا، لذا احذف
جداول `plugin_mcp_token` و`plugin_mcp_audit` و`plugin_mcp_ability` القديمة أولًا
(وما يقابلها من جداول في النسخ التي أُنشئت قبل إعادة التسمية). خذ نسخة احتياطية منها
إذا كنت بحاجة إلى سجلها؛ فالرموز من تلك النسخ تُلغى عند إلغاء التثبيت ولا تُنقل.

### خادم الويب

إعدادات Apache التي تزيل ترويسة `Authorization` قبل الوصول إلى PHP تحتاج إلى هذا السطر في المضيف الافتراضي (virtual host) أو المجلد المعني، متبوعًا بإعادة التحميل:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

يخدم Apache مع `mod_php` مسارات `api.php` دون أي إعدادات إضافية للمسار.

تقع مسارات `api.php` في المسار التالي لاسم السكربت
(`/plugins/mcp/api.php/v1/abilities`)، لذلك يجب على nginx مطابقة عناوين URI التي يتبع فيها
`.php` مسارٌ إضافي، وفصل معلومات المسار، وتمريرها إلى PHP. لا يطابق مقطع
`location ~ \.php$` هذه العناوين أبدًا؛ ويرد nginx بصفحة HTML 404 الخاصة به. تم التحقق من نمط الموقع وسطرَي معلومات المسار أدناه مع
PHP-FPM؛ أما باقي الأسطر فهي إعدادات قياسية:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

عدّل سطرَي `include` و`fastcgi_pass` بما يطابق المقطع الذي يخدم Cacti بالفعل.
لا تضف `try_files $fastcgi_script_name =404;` إلى هذا المقطع: فهو يمسح قيمة
`$fastcgi_path_info`، وعندها يرد `api.php` بالخطأ 404 `UNKNOWN_PATH`. إذا كانت إعداداتك
تتطلب `try_files`، فاحفظ القيمة أولًا باستخدام
`set $path_info $fastcgi_path_info;` ومرّر `fastcgi_param PATH_INFO $path_info;`.

لا يملك `mcp.php` مسارات إضافية ولا يحتاج إليها.

## لوحة التحكم (Console)

تحتوي Management > MCP على ثلاثة تبويبات. تحتاج إلى نطاق **MCP Administration**.
لقطات الشاشة هنا وأدناه مأخوذة من نسخة تطوير لنظام Cacti ببيانات تجريبية.

- **Abilities** يعرض كل قدرة مسجّلة مع الإضافة التابعة لها، والفئة، والنطاق
  الذي تحتاجه، وما إذا كانت متاحة (exposed). حدد الصفوف واختر Expose أو Hide؛
  وستؤكد الإجراء قبل تطبيقه. تكون قدرات `cacti-*` المدمجة متاحة افتراضيًا.
  أما قدرات الإضافات الأخرى فتبدأ مخفية، بحيث لا يؤدي تثبيت أي إضافة إلى نشر
  أي شيء حتى يقرر المسؤول ذلك. وتقتصر الإتاحة على تضييق الوصول فقط: فلا يزال
  المستخدم بحاجة إلى نطاق القدرة نفسها.

  ![تبويب Abilities يعرض القدرات المدمجة مع نطاقاتها وحالة الإتاحة](../../images/console-abilities.png)
- **Tokens** يعرض الرموز مع المالك، والمنشئ، وتاريخ الإنشاء، وتاريخ الانتهاء، وآخر استخدام،
  والحالة (Active، Expired، Revoked). حدد الصفوف واختر Revoke لإلغائها.
  لا يمكن استخدام الرموز الملغاة مرة أخرى. ينشئ زر Create Token رمزًا جديدًا.

  ![تبويب Tokens يعرض الرموز مع المالك وتاريخ الانتهاء وآخر استخدام والحالة أعلى نموذج Create Token](../../images/console-tokens.png)
- **Audit** يعرض صفوف التدقيق، الأحدث أولًا، مع إمكانية التصفية حسب المستخدم والقدرة والنتيجة.

  ![تبويب Audit يعرض الاستدعاءات مع المستخدم والرمز والقدرة والنتيجة مع عوامل التصفية](../../images/console-audit.png)

## الرموز (Tokens)

يقرأ الرمز الشخصي بيانات Cacti بصلاحيات مالكه. يأخذ الشكل `cmcp_pat_` متبوعًا بـ
64 حرفًا ست عشريًا صغيرًا، ويحمل نطاق الصلاحية الوحيد `abilities:read`. ما يمكنه
رؤيته تحدده نطاقات Cacti وأذونات الأجهزة الخاصة بمالكه، وليس الرمز نفسه. يجب أن يكون
المالك مستخدمًا مُفعّلًا يمتلك نطاق **MCP and Abilities API**.

تُنشأ الرموز دائمًا لمستخدم معين، ولها مدة صلاحية، ويمكن إلغاؤها:

- **لوحة التحكم (Console).** Management > MCP > Tokens > Create Token. تتراوح مدة الصلاحية من 1 إلى 365 يومًا
  والافتراضي 90 يومًا. يُولّد الرمز بواسطة الخادم ويُعرض مرة واحدة فقط في صفحة
  الاستجابة، لذا انسخه إلى مدير الأسرار الخاص بك فورًا. يمكنك إنشاء رمز لنفسك.
  يتطلب إنشاء رمز لمستخدم آخر امتلاك نطاق Users/Groups أيضًا، لأن الرمز يقرأ Cacti بصلاحيات ذلك المستخدم.
- **My MCP Tokens.** يمكن لأي مستخدم يمتلك نطاق MCP and Abilities API إدارة رموزه الخاصة؛
  انظر أدناه.
- **سطر الأوامر.** يعمل `tokens.php` من سطر الأوامر (CLI) فقط، بحساب نظام تشغيل
  يملك صلاحية إدارة Cacti. يأخذ الرمز من متغيرات البيئة بحيث لا تظهر القيمة أبدًا
  في سطر الأوامر أو في قائمة العمليات. تتراوح مدة الصلاحية من 1 إلى 365 يومًا
  والافتراضي 30 يومًا. يتم تدقيق إنشاء الرمز وإلغائه عبر سطر الأوامر تمامًا مثل
  لوحة التحكم، مع تسجيل مالك الرمز كمنفّذ العملية لأن سطر الأوامر لا يملك مستخدم Cacti،
  لذا لا يشير سجل التدقيق إلى أن الإجراء تم من سطر الأوامر. يطبع `--list`
  كل رمز بصيغة JSON (المعرّف، المالك، النطاقات، الطوابع الزمنية، علامة الإلغاء) ولا يطبع
  قيمة الرمز أبدًا؛ ويعرض `--help` طريقة الاستخدام.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

لا يمكن إنشاء رموز لحساب الضيف (guest)، أو للمستخدمين المعطّلين، أو للمستخدمين الذين
لا يملكون نطاق **MCP and Abilities API**، سواء من لوحة التحكم أو سطر الأوامر أو
My MCP Tokens. يخزّن Cacti إعداد الضيف كاسم مستخدم أو معرّف مستخدم، وتتعامل الإضافة
مع الحالتين. وأي رمز يصبح مالكه هو حساب الضيف يتوقف عن العمل في طلبه التالي.

### رموز MCP الخاصة بي (My MCP Tokens)

لا تحتاج صفحة Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) إلى نطاق
إدارة: فهي مغطاة بنطاق **MCP and Abilities API**، ولا يظهر عنصر القائمة إلا للمستخدمين
الذين يمتلكونه. تعمل الصفحة دائمًا على المستخدم المسجّل دخوله حاليًا. وبما أن قائمة Cacti
جزء من لوحة التحكم، يمكن للمستخدم الذي لا يملك صلاحية الوصول إلى لوحة التحكم الوصول إلى
الصفحة عبر عنوانها المباشر.

![تبويب My Tokens يعرض رموز المستخدم المسجّل دخوله ونموذج الإنشاء](../../images/my-tokens.png)

- **Tokens** يعرض رموزك، وينشئ رمزًا جديدًا (من 1 إلى 365 يومًا، الافتراضي 90، يُعرض
  مرة واحدة في الاستجابة)، ويلغي رموزك الخاصة. لا يمكنك رؤية رموز أي شخص آخر أو إلغاؤها.
- **Activity** يعرض الإجراءات التي نفّذتها، الأحدث أولًا: الاستدعاءات التي تمت برموزك
  والتغييرات التي أجريتها على الرموز.
- **Available Tools** يعرض القدرات التي يمكن لرمز يخصك استخدامها الآن، مع
  معرّف كل قدرة واسمها ووصفها. وهي تتبع أذوناتك في Cacti وإعدادات الإتاحة
  التي اختارها المسؤول.

  ![قائمة Available Tools وتظهر فيها كل قدرة بمعرّفها واسمها ووصفها](../../images/my-tools.png)

أي تثبيت تم قبل وجود هذه الصفحة يملك قائمة ملفات نطاقات لا تحتوي على
`mcp_tokens.php`. يسجّل التثبيت هذه القائمة، ولا يتم تحديثها بمجرد تفعيل الإضافة أو
تعطيلها. ألغِ تثبيت الإضافة ثم أعد تثبيتها، وبعدها امنح النطاقات مجددًا، لأن Cacti يزيل
منح النطاقات عند إلغاء تثبيت الإضافة.

تخزّن قاعدة البيانات تجزئة SHA-256 للرمز فقط، لذا لا يمكن استرجاع الرمز المفقود؛
ألغه وأنشئ واحدًا آخر. وينطبق الشيء نفسه على التدوير (rotation): أنشئ رمزًا جديدًا،
وبدّل الإعداد في العميل، ثم ألغِ الرمز القديم. يفشل الرمز منتهي الصلاحية، أو الرمز الملغى،
أو التابع لمالك معطّل، أو عند فقدان النطاق، في الطلب التالي مباشرةً. تُقبل الرموز
فقط في ترويسة `Authorization: Bearer`؛ ولا يُقبل الرمز في سلسلة الاستعلام أو جسم الطلب.

## توصيل عميل

استخدم نقطة نهاية MCP وهي `https://cacti.example.com/cacti/plugins/mcp/mcp.php` مع تمرير الـ token في ترويسة `Authorization: Bearer`. احتفظ بالـ token في متغير بيئة أو مدير أسرار وأشر إليه من إعدادات العميل بدلًا من كتابة قيمته مباشرة داخل ملف.

### Claude Code

ضع نقطة النهاية في ملف `.mcp.json` خاص بالمشروع بحيث يشير إلى الـ token بالاسم. يقوم Claude Code بتوسيع `${VAR}` في `url` و`headers`، وبالتالي لا يحتوي الملف على أي أسرار ويكون آمنًا للإضافة إلى نظام التحكم في الإصدارات (commit). قم بتصدير `CACTI_MCP_TOKEN` في البيئة التي تشغّل منها Claude Code.

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

يمكنك أيضًا إضافتها من سطر الأوامر:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

عند استخدام علامات التنصيص المزدوجة، يقوم الـ shell بتوسيع `$CACTI_MCP_TOKEN` أولًا، مما يؤدي إلى كتابة قيمة الـ token داخل ملف الإعدادات للـ `--scope` المختار (`local` أو `user` أو `project`؛ والافتراضي هو `local`). لا تستخدم هذه الصيغة مع `--scope project`، وأبقِ الملف خارج نظام التحكم في الإصدارات. يُفضّل استخدام الإشارة عبر `.mcp.json` الموضحة أعلاه. يقرأ Claude Code بعض متغيرات بيانات الاعتماد (مثل `ANTHROPIC_AUTH_TOKEN`) كقيمة فارغة في `url` و`headers` البعيدة؛ لكن `CACTI_MCP_TOKEN` ليس واحدًا منها. المصدر:
[توثيق MCP في Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot في VS Code

استخدم ملف `.mcp.json` في جذر مساحة العمل (أو ملف المستخدم `~/.copilot/mcp-config.json`). تستخدم هذه الملفات الأصلية لـ Copilot كائن `mcpServers` في المستوى الأعلى وإشارات متغيرات البيئة بصيغة `${NAME}` داخل قيم الترويسات:

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

قم بتصدير `CACTI_MCP_TOKEN` في البيئة التي تشغّل منها VS Code. لا تدعم ملفات Copilot الأصلية مطالبات `inputs`. كما يرفض الإعداد الموجّه في VS Code قيم `${...}`، لذا أضف ترويسة `Authorization` عن طريق تعديل الملف مباشرة وليس عبر خطوات الإعداد الموجّه. يعرض الإعداد الموجّه ملف جذر مساحة العمل فقط عندما يكون الإعداد التجريبي `chat.mcp.workspaceRootConfig.enabled` مفعّلًا. راجع
[مرجع إعدادات MCP في VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**صيغة قديمة: `.vscode/mcp.json`.** يوضح VS Code أن إعدادات Copilot الجديدة يجب ألا تستخدم `.vscode/mcp.json` أو ملف `mcp.json` الخاص بالـ profile؛ فهي تتبع الـ Local harness المتقادم، والذي ستتم إزالته في فبراير 2027. إذا كنت لا تزال تستخدمه، فإن الصيغة المُدارة عبر المحرر تأخذ مفتاح `servers` في المستوى الأعلى ويمكنها طلب إدخال الـ token تفاعليًا:

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

يُعد [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) محوّلًا اختياريًا يعمل كخادم MCP محلي عبر stdio ويتصل بواجهة HTTP API الخاصة بالإضافات (plugin). استخدمه مع العميل الذي لا يمكنه الاتصال بخادم HTTP بعيد. يحتاج إلى نفس الـ token الشخصي ويتواصل مع `api.php`.

### سلوك MCP

توفر نقطة النهاية الأدوات فقط: كل قدرة (ability) مكشوفة ومصرّح بها هي أداة تُسمى بمعرّفها (ID)، مع مخططات الإدخال والإخراج الخاصة بها وتعليقات القراءة فقط (حيث تكون قيمة `openWorldHint` هي `false`). وتعالج نقطة النهاية طلبات `initialize` و`server/discover` و`ping` و`tools/list` و`tools/call`. ولا تحتفظ بأي جلسة، ولا ترسل `Mcp-Session-Id` (وتتجاهله إذا استقبلته)، ولا تقبل حزم JSON-RPC المجمّعة (batches). الرسالة التي لا تحتوي على `id` تُعامل كإشعار وتحصل على استجابة HTTP 202 بدون جسم (body). يُسمح فقط بطريقة `POST`.

- **المراجعات (Revisions).** أي طلب يحمل `io.modelcontextprotocol/protocolVersion` داخل `params._meta` يجب أن يحدد `2026-07-28`؛ وأي قيمة أخرى تحصل على الخطأ `-32022`. يجب أن تحمل هذه الطلبات أيضًا ترويسات متطابقة هي `Mcp-Protocol-Version` و`Mcp-Method` و(بالنسبة إلى `tools/call`) `Mcp-Name`، وإلا تكون الاستجابة هي الخطأ `-32020`. تُعامل الطلبات الأخرى على أنها `2025-11-25`: يستجيب `initialize` بهذه المراجعة، وفي أي طريقة أخرى يجب أن تكون ترويسة `Mcp-Protocol-Version`، إذا تم إرسالها، إحدى القيم `2025-11-25` أو `2025-06-18` أو `2025-03-26`.
- **أخطاء الأدوات.** أي خطأ في القدرة، بما في ذلك المعاملات التي لا تطابق المخطط أو كون قيمة `arguments` ليست كائن JSON، يعود كنتيجة أداة مع `isError: true` وخطأ AIP-193 داخل `structuredContent`، وليس كخطأ بروتوكول.
- **أخطاء البروتوكول.** الإخفاقات التي ليست أخطاء أدوات هي كائنات أخطاء JSON-RPC (بالرمز `-32000` مع الحالة والسبب في `data`، أو الرموز القياسية): غياب عنوان Public Cacti URL، أو رفض `Origin`، أو طلب مع تعطيل الإضافة أو على remote poller، وأخطاء الخادم غير المتوقعة (`-32603`، مع كتابة التفاصيل في سجل Cacti وليس في الاستجابة). تحتفظ فحوصات الطلب التي تعمل أولًا (405 و413 و415) وإخفاقات المصادقة (401 `INVALID_TOKEN` و403 `REALM_REQUIRED`) بجسم AIP-193 الموصوف ضمن قسم HTTP API.

## واجهة HTTP API

عنوان URL الأساسي: `https://cacti.example.com/cacti/plugins/mcp/api.php`. يوجد العقد (contract) في [openapi.json](../../../openapi.json).

| الطريقة والمسار | الغرض |
| --- | --- |
| `GET /v1/abilities` | عرض قائمة القدرات المصرّح بها. معاملات الاستعلام: `pageSize` و`pageToken` و`filter` بالصيغة `category = "inventory"`. |
| `GET /v1/abilities/{id}` | قراءة قدرة واحدة. |
| `POST /v1/abilities/{id}:execute` | تشغيل القدرة. يجب أن يكون جسم الطلب بالضبط `{"arguments": {...}}`. وتكون الاستجابة `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

تتبع الأخطاء معيار AIP-193: كائن `error` يحتوي على `code` و`message` و`status` و`details` يحمل `ErrorInfo` بنطاق `cacti.net` و`reason` ثابت. تضيف مشكلات المعاملات تفصيل `BadRequest` يحدد اسم الحقل. يقتصر حجم جسم الطلب على 64 كيلوبايت، والنتائج على 1 ميجابايت. تستجيب كلتا نقطتي النهاية فقط على الـ main poller وتُرجعان `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) عندما تكون الإضافة معطّلة أو عندما لا يكون الخادم هو الـ main poller.

| HTTP | قيم `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (يرسل أيضًا `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (يرسل `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## كتابة قدرة (لمطوري الإضافات)

تقوم إضافة Cacti المفعّلة بتسجيل القدرات من خلال دالة تربطها بـ hook المسمى `abilities_register`، وعادةً ما يكون ذلك داخل `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

تستقبل الدالة كائن `AbilitiesRegistrar` مخصصًا لنطاق الإضافة. ويتم تجاهل قيمة الإرجاع الخاصة بها.

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

القواعد، وجميعها تُفرض وقت التسجيل:

- **المعرّفات (IDs).** يطابق المعرّف التعبير `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`، وبحد أقصى 64 حرفًا، ويجب أن يبدأ بالـ slug الخاص بالإضافة متبوعًا بشرطة: مثل `acme-` أعلاه. يمثل الـ slug اسم مجلد الإضافة، لذلك لا يمكن لمجلد مثل `my_plugin` تسجيل أي شيء. كما يُرفض مجلد إضافة باسم `cacti`؛ لأن مساحة الأسماء تلك مخصصة للقدرات المدمجة.
- **التعريف.** هذه المفاتيح تحديدًا بالضبط: `label` و`description` (بحد أقصى 4096 بايت) و`category` و`input_schema` و`output_schema` و`annotations` و`permission` و`execute`. يجب أن تكون الفئة (category) موجودة مسبقًا: استخدم فئة مدمجة (`inventory`، `system`) أو سجّل فئتك الخاصة عبر `registerCategory()`، على أن يكون معرّفها فريدًا عبر جميع الإضافات ويطابق `^[a-z][a-z0-9-]{0,31}$`.
- **للقراءة فقط حصرًا.** يجب أن تكون `annotations` بالضبط `readOnly: true` و`destructive: false` و`idempotent: true`. أي شيء آخر يرمي استثناءً.
- **المخططات (Schemas).** يجب أن يحتوي كل من `input_schema` و`output_schema` في المستوى الأعلى على `type` بقيمة `object`. اللهجة المعتمدة محدودة وتعتمد الفشل المغلق (fails closed). يجب أن تكون الكائنات مغلقة (`additionalProperties: false`، مع وجود `properties`)؛ والأنواع الأخرى هي `integer` و`number` (`minimum`، `maximum`)، و`string` (`minLength`، `maxLength`، `enum`، `pattern`)، و`boolean`، و`array` (التي تتطلب `items` و`maxItems`). يمكن جعل النوع قابلًا للقيمة الفارغة مثل `['string', 'null']`. يبلغ الحد الافتراضي لنصوص المعاملات 4096 حرفًا بحد أقصى؛ بينما تقتصر نصوص النتائج فقط على `maxLength` المُعلن وحد حجم النتيجة. يمكن تسجيل 256 قدرة كحد أقصى.
- **`permission(int $userId): bool`.** يجب أن تُرجع `true` تحديدًا للسماح. معرّف المستخدم هو لمالك الـ token؛ لا تقرأ حالة الجلسة (session state) أبدًا.
- **`execute(int $userId, stdClass $args): array`.** يتم التحقق من `$args` مسبقًا مقابل `input_schema`. طبّق أذونات مستوى الكائن بنفسك. أرجع مصفوفة ترابطية (associative array) تطابق `output_schema` بالضبط؛ فإرجاع قائمة، أو حقل إضافي، أو أكثر من 1 ميجابايت من JSON يتحول إلى خطأ `INVALID_RESULT`. ارمِ `AbilitiesError` للإخفاقات الظاهرة للعميل، مثل `NOT_FOUND`.
- **الكائنات الفارغة.** تقوم PHP بترميز `[]` كمصفوفة JSON. أينما يعلن مخطط الإخراج عن `object`، وعلى أي عمق، يعامل السجل (registry) القيمة `[]` ككائن فارغ ويرسل `{}`؛ كما تعمل `new stdClass()` أيضًا. لا تُحتسب القائمة غير الفارغة أبدًا ككائن وتفشل مع `INVALID_RESULT`. يمكن أن تكون خريطة `properties` الفارغة في المخطط `[]` أو `new stdClass()`؛ ويتم نشر كلتيهما كـ `{}`.
- **عزل الإخفاقات.** تسجّل كل إضافة في نسخة مؤقتة لا يتم الاحتفاظ بها إلا إذا عادت دالتك بشكل طبيعي. وإذا رمت استثناءً، فلن يتم تسجيل أي من قدراتك، ويتم تسجيل الإخفاق في السجل.

تبدأ القدرات القادمة من الإضافات مخفية. يقوم المسؤول بإظهارها من تبويب Abilities في وحدة التحكم، ويظهر لها النص "Set by the plugin" في عمود Required Realm.

## نموذج الأمان

- **توكن Bearer فقط.** يقبل كل من `api.php` و `mcp.php` توكن شخصي في ترويسة `Authorization` ولا يقبلان أي وسيلة أخرى. كما يقومان بحذف ملفات تعريف الارتباط (cookies) و `$_POST` و `$_REQUEST` قبل تحميل Cacti، ويُنهيان الجلسة التي يبدأها Cacti، بحيث لا يمنح تسجيل الدخول عبر المتصفح أي وصول إلى واجهة برمجة التطبيقات (API).
- **تجاوز فحص CSRF.** يرفض حارس CSRF الخاص بـ Cacti أي طلب JSON POST لا يحتوي على توكن CSRF خاص بـ Cacti، وهو ما لا يستطيع أي عميل MCP إرساله. ولهاتين النقطتين (endpoints) فقط، يعيد المكوّن الإضافي تسمية طريقة الطلب قبل تحميل Cacti ثم يستعيدها بعده، مما يجعل الحارس يتجاوزهما. هذا الإجراء آمن لأن CSRF يحمي الطلبات التي يوثّقها المتصفح باستخدام ملفات تعريف الارتباط، وهاتان النقطتان لا تقبلان أي هوية عبر ملفات تعريف الارتباط: فلا يمكن لصفحة من موقع آخر إرفاق توكن Bearer. وتحتفظ صفحات وحدة التحكم (Console) بالحماية الكاملة ضد CSRF. هذا الحل مؤقت إلى أن يوفّر Cacti استثناءً مدعومًا رسميًا؛ راجع `lib/bootstrap.php`.
- **فحص المصدر (Origin).** في `mcp.php`، إذا احتوى الطلب على ترويسة `Origin`، فيجب أن تطابق تمامًا المخطط (scheme) والمضيف (host) والمنفذ (port) الخاصين بعنوان Public Cacti URL، وإلا يُرفض الطلب مع رمز الخطأ `ORIGIN_NOT_ALLOWED`. أما الطلبات التي لا تحتوي على ترويسة `Origin`—وهي الطريقة التي تتصل بها العملاء من خارج المتصفح—فيُسمح بها. يمنع هذا أي صفحة ويب من استدعاء نقطة النهاية عبر متصفح الزائر. ولا يطبّق `api.php` هذا الفحص.
- **للقراءة فقط.** يرفض التسجيل أي قدرة (ability) ليست للقراءة فقط، وغير تدميرية، ومتكررة الأثر بشكل آمن (idempotent).
- **تطبيق الإتاحة والصلاحيات (Realms) معًا.** يجب أن تكون القدرة مُتاحة (exposed) وأن يمتلك مالك التوكن الصلاحية (realm) الخاصة بها. وإذا تعذّر قراءة جدول الإتاحة، يتم إخفاء جميع القدرات بدلًا من الرجوع إلى الإعدادات الافتراضية.
- **المخفي وغير المعروف وغير المصرح به متطابقون في الاستجابة.** لا يمكن للعميل التمييز بين قدرة غير موجودة، أو قدرة مخفية، أو قدرة لا يُسمح لمستخدمه باستخدامها: فالاكتشاف يتجاهلها والتنفيذ يُرجع `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **التوكنات.** تُخزّن كقيم تجزئة (hashes) بصيغة SHA-256، وتُعرض مرة واحدة فقط، ولها تاريخ انتهاء صلاحية دائمًا، وقابلة للإلغاء، وتُرفض عند تعطيل مالكها أو فقدانه للصلاحية.
- **التدقيق (Audit).** يسجّل جدول `plugin_mcp_audit` معرّف الطلب، ومعرّف التوكن، ومعرّف المستخدم، والقدرة، والنتيجة (`started`، `succeeded`، `failed`، `denied`، `rejected`)، والطوابع الزمنية. ولا يسجّل أبدًا المعاملات (arguments)، أو النتائج، أو قيم التوكنات. لا تُنفّذ أي قدرة إلا بعد كتابة صف `started` الخاص بها؛ وإذا كان جدول التدقيق غير متاح، تفشل العملية مع `UNAVAILABLE` ولا يتم تنفيذها. وأي استدعاء يُرفض قبل تنفيذه يُسجّل كصف واحد: `denied` للقدرة غير المعروفة أو المخفية أو غير المصرح بها، و `rejected` للمعاملات التي تخالف المخطط (schema). أما إنشاء التوكنات وإلغاؤها من وحدة التحكم، أو صفحة My MCP Tokens، أو واجهة سطر الأوامر (CLI)، فيُسجّل كـ `mcp-token-create` و `mcp-token-revoke` بنتيجة `succeeded`، ولا يُسجّل الإلغاء إلا للتوكن النشط فقط. ولا يتم تسجيل عمليات الاكتشاف، ولا الاستدعاءات التي لا يكون حقل `arguments` فيها كائن JSON.
- **سجل الأعطال.** أي فشل غير متوقع، أو نتيجة `INVALID_RESULT`، أو عدم توفر جدول التدقيق يؤدي إلى كتابة سطر واحد في سجل Cacti تحت التصنيف (facility) `MCP`: معرّف القدرة، وسبب ثابت، وفئة الاستثناء (exception class). ولا يتم تسجيل الرسائل أو المعاملات أو التوكنات أبدًا.
- **المُجمّع الرئيسي (Main poller) فقط.** ترفض نقطتا النهاية، وصفحتا وحدة التحكم، و `tokens.php` العمل في أي مكان آخر.

## دورة الحياة

يؤدي تعطيل المكوّن الإضافي إلى حظر كلتا نقطتي النهاية. أما إلغاء التثبيت فيلغي صلاحية جميع التوكنات ويحتفظ بالجداول الثلاثة (`plugin_mcp_token`، `plugin_mcp_audit`، `plugin_mcp_ability`) لأغراض الأرشفة والاحتفاظ بالبيانات؛ ولا تؤدي إعادة التثبيت إلى إعادة تفعيل أي توكن مُلغى. احرص على عمل نسخ احتياطي لهذه الجداول مع قاعدة بيانات Cacti وتطبيق سياسة للاحتفاظ بسجلات التدقيق خارج المكوّن الإضافي.

## التطوير والاختبارات

الاختبارات عبارة عن نصوص برمجية بسيطة بلغة PHP تعمل بدون الحاجة إلى تشغيل Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

يقوم التكامل المستمر (CI) بفحص جودة أكواد PHP وتشغيل النصوص البرمجية الموجودة في `tests/` (وكل منها مُدرج في `.github/workflows/ci.yml`) على إصدارات PHP من 8.2 إلى 8.5، ثم يبني أرشيف `mcp/` القابل للتثبيت وقيمة التحقق (checksum) الخاصة به. وتستخدم الاختبارات التي تتعامل مع Cacti بيانات ثابتة (fixtures) عند حدود دوال Cacti المساعدة؛ لذا فهي لا تختبر تثبيتًا كاملًا لـ Cacti.

### اختبارات التكامل

يقوم الأمر `tests/integration/run.sh 1.2.31` أو `tests/integration/run.sh develop` بتثبيت المكوّن الإضافي داخل نسخة حقيقية من Cacti ضمن حاويات، وتنفيذ فحوصات حية عليه. ويتطلب ذلك Docker مع Compose الإصدار v2.23.1 أو أحدث، بالإضافة إلى git و openssl. ويؤدي تعيين `KEEP=1` إلى إبقاء الحاويات قيد التشغيل لأغراض تصحيح الأخطاء. يشغّل نظام CI هذه الاختبارات ليليًا وعند الطلب، وليس عند فتح طلبات السحب (pull requests).

## التوطين والترجمة (Localization)

يوفّر Cacti MCP ملفات كتالوج GNU gettext المجمّعة ضمن `locales/po/` و `locales/LC_MESSAGES/`، بالإضافة إلى ملفات README مترجمة ضمن `docs/i18n/` للغة الإنجليزية و47 لغة وإقليمًا (19 من الفئة الأولى الموسّعة Broad Tier 1، و15 لغة أفريقية، و10 لغات آسيوية، بالإضافة إلى البوسنية والكرواتية والصربية)، باستخدام نطاق النصوص `mcp` (`locales/po/mcp.pot`). ويحمّل Cacti الكتالوج المطابق تلقائيًا عند تفعيل دعم اللغات.

## المساهمة

تُرسل طلبات السحب (Pull requests) إلى الفرع `develop`. حافظ على توافق كود الإنتاج مع PHP 8.2 والتزم بأسلوب كتابة Cacti: استخدام علامات الجدولة (tabs)، والسلاسل النصية ذات علامات الاقتباس المفردة، ودوال Cacti المساعدة لقاعدة البيانات والصلاحيات. أضف اختبارات لأي تغييرات في التحقق من الصحة، أو التفويض، أو سلوك البروتوكول، ووقّع الالتزامات (commits) باستخدام `git commit -s`. ونسّق التغييرات في واجهة HTTP API مع مشروع [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## الترخيص

حقوق النشر (C) 2026 Thomas Vincent. منشور بموجب رخصة GNU General Public License، الإصدار 2 أو أحدث. راجع [ملف الترخيص](../../../LICENSE).
