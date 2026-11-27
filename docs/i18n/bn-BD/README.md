<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: ঢালসহ একটি ক্যাকটাস। খুঁজুন। অনুমোদন দিন। কার্যকর করুন।">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="License: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP হলো একটি Cacti প্লাগইন যা এআই (AI) ক্লায়েন্টদের অ্যাবিলিটি নামক নির্দিষ্ট ও অনুমতি-ভিত্তিক অপারেশনের মাধ্যমে আপনার Cacti ডেটা পড়ার সুযোগ দেয়। এটি প্লাগইন থেকেই দুটি উপায়ে এগুলো পরিবেশন করে: একটি MCP এন্ডপয়েন্ট (`mcp.php`, Streamable HTTP) এবং একটি AIP-ধাঁচের HTTP API (`api.php`)। অনুমোদন এবং কার্যসম্পাদনের সম্পূর্ণ নিয়ন্ত্রণ Cacti-র হাতেই থাকে। কোনো ক্লায়েন্ট কখনোই সরাসরি ডাটাবেসে কোয়েরি করে না; এটি কেবল সেই অ্যাবিলিটিগুলোই কল করতে পারে যা একজন অ্যাডমিনিস্ট্রেটর উন্মুক্ত করেছেন এবং যা টোকেন মালিকের Cacti রিয়েলম অনুমতি দেয়।

প্লাগইন নির্মাতারা `abilities_register` হুকের মাধ্যমে তাদের নিজস্ব কেবল-পঠনযোগ্য অ্যাবিলিটি নিবন্ধন করতে পারেন, এবং কোনো প্রোটোকল কোড ছাড়াই সেগুলো MCP ক্লায়েন্টদের কাছে টুল হিসেবে প্রদর্শিত হয়।

**অবস্থা: প্রাক-রিলিজ, সংস্করণ 0.1.0।** এখনো কোনো ট্যাগকৃত রিলিজ নেই।

বর্তমানে যা উপলব্ধ:

- সিস্টেম সংস্করণ, ডিভাইস, সাইট, পোলার, গ্রাফ ট্রি, গ্রাফ, ডেটা সোর্স এবং সীমিত ও গোপন তথ্য-মুক্ত (redacted) Cacti লগ টেইল কভার করে এমন নয়টি কেবল-পঠনযোগ্য বিল্ট-ইন অ্যাবিলিটি।
- একমাত্র প্রমাণপত্র হিসেবে পার্সোনাল অ্যাক্সেস টোকেন (`cmcp_pat_...`)।
- Management > MCP কনসোল: অ্যাবিলিটি উন্মুক্ত বা গোপন করা, টোকেন তৈরি ও বাতিল করা এবং অডিট লগ দেখা।
- Management > My MCP Tokens: ব্যবহারকারীরা তাদের নিজস্ব টোকেন পরিচালনা করতে, নিজেদের কার্যকলাপ দেখতে এবং তাদের টোকেনগুলো কোন কোন টুল ব্যবহার করতে পারে তা দেখতে পারেন।
- Streamable HTTP-র মাধ্যমে MCP, প্রোটোকল রিভিশন `2026-07-28` এবং `2025-11-25`, কেবল টুলসমূহ।

এখনো যা উপলব্ধ নয়:

- OAuth 2.1 সাইন-ইন। যেসব হোস্টেড কানেক্টর পার্সোনাল টোকেন পাঠাতে পারে না, যেমন ChatGPT এবং claude.ai কাস্টম কানেক্টর, সেগুলো এটি চালু না হওয়া পর্যন্ত সংযুক্ত হতে পারবে না। এটি প্ল্যান ২ হিসেবে পরিকল্পিত; সেই পরিকল্পনা এখনো লেখা হয়নি।
- রাইট অ্যাবিলিটি। কেবল-পঠনযোগ্য অ্যাবিলিটিই নিবন্ধন করা যায়।

ডিজাইনটি
[এন্ডপয়েন্ট ডিজাইন স্পেক](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md)-এ রয়েছে,
এবং বিল্ড ক্রমটি [docs/plan.md](../../plan.md)-এ রয়েছে।

## বিল্ট-ইন অ্যাবিলিটি

| আইডি | বিভাগ | আর্গুমেন্ট | প্রয়োজনীয় Cacti রিয়েলম |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | নেই | 15 |
| `cacti-list-devices` | `inventory` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | আবশ্যিক `name`, যেমন `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 7 অথবা 4 |
| `cacti-list-graphs` | `inventory` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 7 অথবা 5 |
| `cacti-list-data-sources` | `inventory` | ঐচ্ছিক `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | ঐচ্ছিক `lines` (1 থেকে 200, ডিফল্ট 50), `severity`, `search` | 19 অথবা 18 |

প্রতিটি কলের জন্য টোকেন মালিকের **MCP and Abilities API** রিয়েলম,
`abilities:read` স্কোপ (প্রতিটি পার্সোনাল টোকেনেই এটি থাকে), এবং একটি উন্মুক্ত
অ্যাবিলিটি প্রয়োজন। কনসোলের Abilities ট্যাবে প্রতিটি বিল্ট-ইন অ্যাবিলিটির জন্য প্রয়োজনীয় প্রাথমিক রিয়েলম দেখানো হয়।

ছয়টি `cacti-list-*` অ্যাবিলিটিই সর্বোচ্চ 100টি আইটেমের পেজ (ডিফল্ট 50টি) এবং একটি
`nextPageToken` রিটার্ন করে। একটি পেজ টোকেন কেবল একই `filter` এবং
`orderBy`-এর জন্য বৈধ। `filter` হলো `AND` দ্বারা যুক্ত তুলনামূলক (`=`, `!=`, `<`,
`<=`, `>`, `>=`) এক্সপ্রেশনের একটি AIP-160 এক্সপ্রেশন, উদাহরণস্বরূপ
`state = "DOWN" AND disabled = false`। `orderBy` কমা-বিভক্ত ক্রমযোগ্য ফিল্ডের তালিকা
গ্রহণ করে, যার প্রতিটি ঐচ্ছিকভাবে `asc` বা `desc` দ্বারা অনুসৃত হতে পারে।

| অ্যাবিলিটি | ফিল্টার ফিল্ড | অর্ডার ফিল্ড |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

অনুমতি সীমাবদ্ধকরণ ও গোপন তথ্য বাদ দেওয়া:

- `cacti-list-devices` এবং `cacti-get-device` Cacti-র `get_allowed_devices()`-এর
  মাধ্যমে কোয়েরি করে এবং SNMP কমিউনিটি স্ট্রিং, পাসফ্রেজ এবং অন্যান্য প্রমাণপত্র বাদ দেয়।
- `cacti-list-trees` কোয়েরি করে `get_allowed_trees()`-এর মাধ্যমে (এবং উপলব্ধ থাকলে
  `is_tree_allowed()` দিয়ে ফিল্টার করে); `cacti-list-graphs` কোয়েরি করে
  `get_allowed_graphs()`-এর মাধ্যমে (এবং উপলব্ধ থাকলে `is_graph_allowed()` দিয়ে ফিল্টার করে)।
- `cacti-list-data-sources` সারিগুলোকে `get_allowed_devices()` (এবং উপলব্ধ থাকলে
  `is_device_allowed()`) থেকে প্রাপ্ত কলারের অনুমোদিত ডিভাইসগুলোতে সীমাবদ্ধ রাখে এবং
  `data_input_data` কোয়েরি না করে বা গোপন ইনপুট মান প্রকাশ না করে কেবল মেটাডেটা রিটার্ন করে।
- `cacti-list-pollers` ডেটাবেজ প্রমাণপত্র (`dbpass`, `dbuser`) এবং TLS কী ও
  সার্টিফিকেট কলাম (`dbsslkey`, `dbsslcert`, `dbsslca`) বাদ দেয়।
- `cacti-get-clog` কনফিগার করা Cacti লগের শেষ সর্বোচ্চ 1 MiB পড়ে (2048 বাইটের বেশি
  একক লাইন কেটে ছোট করে), `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`,
  `ERROR`, `CRITICAL`, `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`;
  ডিফল্ট `ALL`) এবং কেস-অসংবেদনশীল `search` (সর্বোচ্চ 256 অক্ষর) দিয়ে ফিল্টার করে এবং
  `lines`, `count`, এবং `truncated` রিটার্ন করে। `search` যেন গোপন তথ্য ফাঁসের মাধ্যম হিসেবে
  কাজ করতে না পারে সেজন্য `severity` এবং `search` ফিল্টার চলার আগেই প্রতিটি লাইন থেকে
  পার্সোনাল টোকেন, bearer/basic হেডার, পাসওয়ার্ড, গোপন তথ্য, SNMP কমিউনিটি, কী,
  `dbpass`, `dbsslkey`, এবং URL ইউজারইনফো গোপন (redacted) করা হয়। রিড্যাকশন ব্যর্থ
  হলে নিরাপদে `[redacted]` বসানো হয়, এবং অপঠনযোগ্য লগ `FAILED_PRECONDITION`
  (`LOG_UNAVAILABLE`) রিটার্ন করে।

## ইনস্টলেশন

এর জন্য Cacti 1.2.31 বা পরবর্তী সংস্করণ, PHP 8.2 বা পরবর্তী সংস্করণ এবং মেইন পোলার প্রয়োজন। Cacti
প্রমাণীকরণ অবশ্যই সক্রিয় থাকতে হবে; এটি বন্ধ থাকলে প্লাগইনটি প্রমাণীকরণ করতে অস্বীকৃতি জানায়।

প্লাগইন ডিরেক্টরির নাম অবশ্যই `mcp` হতে হবে, `plugin_mcp` নয়। প্লাগইন স্লাগ, রিয়েলমের নাম,
অনুবাদ ডোমেইন এবং ইউআরএল সবক্ষেত্রেই `mcp` ব্যবহৃত হয়।

সোর্স চেকআউট থেকে:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

ট্যাগকৃত রিলিজ তৈরি না হওয়া পর্যন্ত, আপনি এর পরিবর্তে একটি সফল
[CI রান](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) থেকে `mcp-plugin`
আর্টিফ্যাক্টটি ডাউনলোড করতে পারেন।
এতে `mcp.tar.gz` এবং `SHA256SUMS` রয়েছে। চেকসাম যাচাই করুন, তারপর Cacti-র `plugins/` ডিরেক্টরির ভেতরে
`mcp.tar.gz` এক্সট্র্যাক্ট করুন যাতে ফলাফলটি `plugins/mcp/` হয়।
GitHub-এর স্বয়ংক্রিয় সোর্স আর্কাইভগুলোতে ভিন্ন একটি শীর্ষ-স্তরের ডিরেক্টরির নাম ব্যবহৃত হয়।
আর্কাইভটিতে `docs/` (নিচের স্ক্রিনশটগুলোসহ), `tests/`, এবং
`.github/` বাদ দেওয়া হয়েছে, তাই `docs/`-এর দিকে নির্দেশ করা README লিংকগুলো GitHub-এ কাজ করে কিন্তু ইনস্টল করা
কপিতে কাজ করে না।

এরপর:

1. Plugin Management-এ **Cacti MCP** ইনস্টল ও সক্রিয় করুন। ইনস্টলকারী
   অ্যাডমিনিস্ট্রেটর স্বয়ংক্রিয়ভাবে **MCP Administration** রিয়েলম পান।
2. Settings > MCP-এর অধীনে, ক্লায়েন্টরা যে ঠিকানা ব্যবহার করে তাতে **Public Cacti URL** সেট করুন, উদাহরণস্বরূপ
   `https://cacti.example.com/cacti`। `localhost`, `127.0.0.1`, এবং `[::1]` ব্যতীত অন্য সব ক্ষেত্রে
   HTTPS আবশ্যক। এটি সেট না করা পর্যন্ত, `mcp.php` একটি JSON-RPC ত্রুটিসহ HTTP 400 উত্তর দেয়
   যার `data` হলো `FAILED_PRECONDITION` এবং
   `PUBLIC_URL_REQUIRED`। `api.php` এটি পড়ে না।

   ![Public Cacti URL ফিল্ড প্রদর্শনকারী Settings > MCP](../../images/settings-public-url.png)

3. যেসব ব্যবহারকারী টোকেন রাখবেন তাদের প্রত্যেককে **MCP and Abilities API** রিয়েলম প্রদান করুন।
   কোনো ব্যবহারকারী এটি স্বয়ংক্রিয়ভাবে পান না।
4. নিশ্চিত করুন যে ওয়েব সার্ভার PHP-র কাছে `Authorization` হেডার এবং পাথ ইনফো পাস করে
   (নিচে দেখুন)।
5. Management > MCP খুলুন এবং ক্লায়েন্টদের যে অ্যাবিলিটিগুলো দেখাতে চান সেগুলো উন্মুক্ত করুন।

**ডেভেলপমেন্ট বিল্ড থেকে আপগ্রেড করা।** প্লাগইনটি প্রাক-রিলিজ পর্যায়ে আছে এবং
ডেভেলপমেন্টের সময় মাইগ্রেশন ছাড়াই এর টেবিলগুলো পরিবর্তিত হয়েছে। আপনি যদি পূর্বের কোনো
বিল্ড ইনস্টল করে থাকেন, তবে সেটি আনইনস্টল করে পুনরায় ইনস্টল করুন। পুনরায় ইনস্টল করলে আগে থেকে থাকা টেবিলগুলো
থেকে যায়, তাই প্রথমে পুরোনো `plugin_mcp_token`, `plugin_mcp_audit`, এবং
`plugin_mcp_ability` টেবিলগুলো (এবং নাম পরিবর্তনের আগের বিল্ডগুলোর সমতুল্য টেবিলগুলো) ড্রপ করুন।
ইতিহাস সংরক্ষণের প্রয়োজন হলে সেগুলোর ব্যাকআপ নিন; ওই বিল্ডগুলোর টোকেন
আনইনস্টলের সময় বাতিল হয়ে যায় এবং পরবর্তীতে স্থানান্তরিত হয় না।

### ওয়েব সার্ভার

যেসব Apache সেটআপ PHP-তে পৌঁছানোর আগেই `Authorization` বাদ দেয়, সেগুলোর সংশ্লিষ্ট
ভার্চুয়াল হোস্ট বা ডিরেক্টরিতে এটি যোগ করে রিলোড করতে হবে:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` সহ Apache কোনো অতিরিক্ত পাথ কনফিগারেশন ছাড়াই `api.php` রুটগুলো পরিবেশন করেছে।

`api.php` রুটগুলো স্ক্রিপ্ট নামের পরের পাথে থাকে
(`/plugins/mcp/api.php/v1/abilities`), তাই nginx-কে অবশ্যই সেইসব URI ম্যাচ করতে হবে যেখানে `.php`-এর
পরে আরও পাথ থাকে, পাথ ইনফো আলাদা করতে হবে এবং PHP-র কাছে তা পাস করতে হবে। একটি
`location ~ \.php$` ব্লক কখনোই এই URL-গুলোর সাথে মেলে না; nginx তখন নিজস্ব
HTML 404 উত্তর দেয়। নিচের লোকেশন প্যাটার্ন এবং পাথ-ইনফো লাইন দুটি
PHP-FPM-এর সাথে যাচাই করা হয়েছে; বাকি লাইনগুলো সাধারণ বয়লারপ্লেট:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

ইতিমধ্যে Cacti পরিবেশন করছে এমন ব্লকের সাথে মিলিয়ে `include` এবং `fastcgi_pass` লাইনগুলো সমন্বয় করুন।
এই ব্লকে `try_files $fastcgi_script_name =404;` যোগ করবেন না: এটি
`$fastcgi_path_info` মুছে ফেলে এবং `api.php` তখন 404 `UNKNOWN_PATH` উত্তর দেয়। আপনার
কনফিগারেশনে `try_files` প্রয়োজন হলে, প্রথমে
`set $path_info $fastcgi_path_info;` দিয়ে মানটি সংরক্ষণ করুন এবং `fastcgi_param PATH_INFO $path_info;` পাস করুন।

`mcp.php` এর কোনো পাথ রুট নেই এবং এর এগুলোর প্রয়োজনও হয় না।

## কনসোল

Management > MCP-তে তিনটি ট্যাব রয়েছে। এর জন্য আপনার **MCP Administration** রিয়েলম প্রয়োজন।
এখানকার এবং নিচের স্ক্রিনশটগুলো নমুনা ডেটাসহ একটি Cacti ডেভেলপমেন্ট বিল্ড থেকে নেওয়া।

- **Abilities** ট্যাবটি প্রতিটি নিবন্ধিত অ্যাবিলিটি, এর প্লাগইন, ক্যাটাগরি, প্রয়োজনীয়
  রিয়েলম এবং এটি উন্মুক্ত কি না তা তালিকাভুক্ত করে। সারি নির্বাচন করুন এবং Expose বা
  Hide বেছে নিন; পরিবর্তনটি কার্যকর হওয়ার আগে আপনাকে নিশ্চিত করতে হবে। বিল্ট-ইন `cacti-*` অ্যাবিলিটিগুলো
  ডিফল্টভাবে উন্মুক্ত থাকে। অন্যান্য প্লাগইনের অ্যাবিলিটিগুলো শুরুতে গোপন থাকে, তাই কোনো অ্যাডমিনিস্ট্রেটর
  সিদ্ধান্ত না নেওয়া পর্যন্ত প্লাগইন ইনস্টল করলেই কিছু প্রকাশিত হয়ে যায় না। উন্মুক্ত করা
  কেবল প্রবেশাধিকারকে সংকুচিত করে: একজন ব্যবহারকারীর তখনও অ্যাবিলিটিটির রিয়েলম প্রয়োজন হয়।

  ![বিল্ট-ইন অ্যাবিলিটিগুলোর রিয়েলম এবং উন্মুক্ত অবস্থা প্রদর্শনকারী Abilities ট্যাব](../../images/console-abilities.png)
- **Tokens** ট্যাবটি মালিক, নির্মাতা, তৈরির সময়, মেয়াদোত্তীর্ণের সময়, সর্বশেষ ব্যবহার এবং
  অবস্থা (Active, Expired, Revoked) সহ টোকেনগুলো তালিকাভুক্ত করে। সারি নির্বাচন করুন এবং সেগুলো বাতিল করতে Revoke বেছে নিন।
  বাতিলকৃত টোকেন আর ব্যবহার করা যায় না। Create Token একটি নতুন টোকেন তৈরি করে।

  ![Create Token ফর্মের উপরে মালিক, মেয়াদোত্তীর্ণ, সর্বশেষ ব্যবহার এবং অবস্থাসহ টোকেনের তালিকা প্রদর্শনকারী Tokens ট্যাব](../../images/console-tokens.png)
- **Audit** ট্যাবটি অডিট সারিগুলো নতুন থেকে পুরোনো ক্রমে তালিকাভুক্ত করে এবং ব্যবহারকারী, অ্যাবিলিটি ও
  ফলাফল অনুযায়ী ফিল্টার করে।

  ![ফিল্টারসহ ব্যবহারকারী, টোকেন, অ্যাবিলিটি এবং ফলাফল প্রদর্শনকারী Audit ট্যাব](../../images/console-audit.png)

## টোকেনসমূহ

একটি পার্সোনাল টোকেন এর মালিকের পরিচয়ে Cacti পড়ে। এর ফরম্যাট হলো `cmcp_pat_` এবং তারপরে
64টি ছোট হাতের হেক্স অক্ষর, এবং এটি কেবল একটি স্কোপ `abilities:read` বহন করে। এটি কী
দেখতে পাবে তা টোকেনের মাধ্যমে নয়, বরং এর মালিকের Cacti রিয়েলম এবং ডিভাইস অনুমতির মাধ্যমে নির্ধারিত হয়।
মালিককে অবশ্যই একজন সক্রিয় ব্যবহারকারী হতে হবে যার **MCP and Abilities API**
রিয়েলম রয়েছে।

টোকেন সবসময় কোনো একজন ব্যবহারকারীর জন্য তৈরি করা হয়, এর মেয়াদ শেষ হয় এবং এটি বাতিল করা যায়:

- **কনসোল।** Management > MCP > Tokens > Create Token। মেয়াদকাল 1 থেকে 365 দিন
  এবং ডিফল্ট 90 দিন। টোকেনটি সার্ভার দ্বারা তৈরি হয় এবং রেসপন্স পেজে
  একবারই দেখানো হয়, তাই অবিলম্বে এটি আপনার সিক্রেট ম্যানেজারে কপি করে রাখুন। আপনি নিজের জন্য একটি
  টোকেন তৈরি করতে পারেন। অন্য ব্যবহারকারীর জন্য টোকেন তৈরি করতে Users/Groups
  রিয়েলমও প্রয়োজন, কারণ টোকেনটি সেই ব্যবহারকারীর পরিচয়ে Cacti পড়ে।
- **My MCP Tokens।** MCP and Abilities API রিয়েলম থাকা যেকোনো ব্যবহারকারী নিজের
  টোকেন পরিচালনা করতে পারেন; নিচে দেখুন।
- **কমান্ড লাইন।** `tokens.php` কেবল CLI থেকে চলে, এমন একটি OS অ্যাকাউন্ট হিসেবে যা
  Cacti পরিচালনা করতে পারে। এটি এনভায়রনমেন্ট থেকে টোকেনটি নেয় যাতে মানটি কখনোই
  কমান্ড লাইনে বা প্রসেস তালিকায় প্রদর্শিত না হয়। মেয়াদকাল 1 থেকে 365 দিন এবং
  ডিফল্ট 30 দিন। CLI-র মাধ্যমে টোকেন তৈরি এবং বাতিল করার বিষয়টিও কনসোলের
  মতোই অডিট করা হয়, যেখানে টোকেনের মালিককে অ্যাক্টর হিসেবে দেখানো হয় কারণ CLI-র কোনো Cacti ব্যবহারকারী নেই; ফলে
  অডিট সারিতে কাজটি CLI থেকে এসেছে বলে চিহ্নিত হয় না। `--list` প্রতিটি
  টোকেন JSON হিসেবে প্রিন্ট করে (ID, মালিক, স্কোপ, টাইমস্ট্যাম্প, বাতিল ফ্ল্যাগ) এবং কখনোই
  টোকেনের মান প্রিন্ট করে না; `--help` ব্যবহারবিধি দেখায়।

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

কনসোল, কমান্ড লাইন বা My MCP Tokens থেকে গেস্ট অ্যাকাউন্টের জন্য, নিষ্ক্রিয় ব্যবহারকারীদের জন্য, অথবা
**MCP and Abilities API** রিয়েলমবিহীন ব্যবহারকারীদের জন্য টোকেন তৈরি করা যায় না।
Cacti গেস্ট সেটিংটি ইউজারনেম অথবা ইউজার আইডি হিসেবে সংরক্ষণ করে, এবং
প্লাগইনটি উভয়ই সমাধান করে। কোনো টোকেনের মালিক যদি গেস্ট অ্যাকাউন্ট হয়ে যান, তবে
পরবর্তী রিকোয়েস্ট থেকেই টোকেনটি কাজ করা বন্ধ করে দেয়।

### আমার MCP টোকেনসমূহ

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`)-এর জন্য কোনো অ্যাডমিনিস্ট্রেশন
রিয়েলম প্রয়োজন হয় না: এটি **MCP and Abilities API** রিয়েলমের আওতাভুক্ত, এবং কেবল যাদের
এই রিয়েলম রয়েছে তাদের জন্যই মেনু এন্ট্রিটি প্রদর্শিত হয়। পেজটি সবসময় সাইন-ইন করা ব্যবহারকারীর ওপর কাজ করে।
Cacti-র মেনু কনসোলের অংশ, তাই কনসোল অ্যাক্সেস নেই এমন ব্যবহারকারী এর
ঠিকানার মাধ্যমে পেজটিতে পৌঁছাতে পারেন।

![সাইন-ইন করা ব্যবহারকারীর টোকেন তালিকা এবং তৈরি করার ফর্ম প্রদর্শনকারী My Tokens ট্যাব](../../images/my-tokens.png)

- **Tokens** আপনার টোকেনগুলো তালিকাভুক্ত করে, নতুন একটি তৈরি করে (1 থেকে 365 দিন, ডিফল্ট 90 দিন, রেসপন্সে একবার
  দেখানো হয়), এবং আপনার নিজের টোকেন বাতিল করে। আপনি অন্য কারও টোকেন দেখতে বা বাতিল করতে পারবেন না।
- **Activity** আপনার সম্পাদিত কার্যকলাপগুলো নতুন থেকে পুরোনো ক্রমে তালিকাভুক্ত করে: আপনার টোকেন দিয়ে করা
  কল এবং আপনার করা টোকেন পরিবর্তনসমূহ।
- **Available Tools** আপনার কোনো টোকেন এই মুহূর্তে ব্যবহার করতে পারে এমন অ্যাবিলিটিগুলো প্রতিটি
  অ্যাবিলিটির ID, নাম এবং বিবরণসহ তালিকাভুক্ত করে। এটি আপনার Cacti অনুমতি এবং
  অ্যাডমিনিস্ট্রেটরের নির্ধারিত উন্মুক্তকরণ সেটিংস অনুসরণ করে।

  ![প্রতিটি অ্যাবিলিটির ID, নাম এবং বিবরণ প্রদর্শনকারী Available Tools তালিকা](../../images/my-tools.png)

এই পেজটি তৈরি হওয়ার আগে করা কোনো ইনস্টলেশনের রিয়েলম ফাইল তালিকায়
`mcp_tokens.php` থাকে না। ইনস্টলেশন প্রক্রিয়া তালিকাটি নিবন্ধন করে; প্লাগইন সক্রিয় বা
নিষ্ক্রিয় করলে এটি আপডেট হয় না। প্লাগইনটি আনইনস্টল করে পুনরায় ইনস্টল করুন এবং তারপর পুনরায় রিয়েলমগুলো
প্রদান করুন, কারণ প্লাগইন আনইনস্টল করা হলে Cacti রিয়েলম অনুমোদনগুলো মুছে ফেলে।

ডাটাবেস টোকেনটির কেবল SHA-256 হ্যাশ সংরক্ষণ করে, তাই হারিয়ে যাওয়া টোকেন
পুনরুদ্ধার করা যায় না; সেটি বাতিল করুন এবং আরেকটি তৈরি করুন। রোটেশনের প্রক্রিয়াও একই: একটি নতুন টোকেন তৈরি করুন,
ক্লায়েন্টকে সেটি ব্যবহারে পরিবর্তন করুন, তারপর পুরোনোটি বাতিল করুন। মেয়াদোত্তীর্ণ টোকেন, বাতিলকৃত টোকেন,
নিষ্ক্রিয় মালিক বা হারানো রিয়েলমের প্রতিটিই পরবর্তী রিকোয়েস্টে ব্যর্থ হয়। টোকেন কেবল
`Authorization: Bearer` হেডারে গৃহীত হয়; কোয়েরি স্ট্রিং বা বডিতে থাকা টোকেন
গ্রহণ করা হয় না।

## ক্লায়েন্ট সংযুক্ত করুন

`Authorization: Bearer` হেডারে টোকেনসহ `https://cacti.example.com/cacti/plugins/mcp/mcp.php` MCP এন্ডপয়েন্টটি ব্যবহার করুন। কোনো ফাইলে টোকেনের মান সরাসরি না লিখে এটিকে একটি এনভায়রনমেন্ট ভ্যারিয়েবল বা সিক্রেট ম্যানেজারে সংরক্ষণ করুন এবং ক্লায়েন্ট কনফিগারেশন থেকে সেটিকে রেফারেন্স হিসেবে ব্যবহার করুন।

### Claude Code

প্রকল্পের `.mcp.json` ফাইলে এন্ডপয়েন্টটি যোগ করুন যা নাম ধরে টোকেনকে রেফারেন্স করে। Claude Code `url` এবং `headers`-এর ভেতরে থাকা `${VAR}` প্রসারিত করে, ফলে ফাইলটিতে কোনো গোপন তথ্য থাকে না এবং এটি কমিট করা নিরাপদ। যে এনভায়রনমেন্ট থেকে Claude Code চালু করা হয়, সেখানে `CACTI_MCP_TOKEN` এক্সপোর্ট করুন।

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

আপনি কমান্ড লাইন থেকেও এটি যোগ করতে পারেন:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

ডাবল কোট ব্যবহার করলে আপনার শেল প্রথমেই `$CACTI_MCP_TOKEN` প্রসারিত করে ফেলে, ফলে নির্বাচিত `--scope` (`local`, `user`, বা `project`; ডিফল্ট `local`)-এর কনফিগ ফাইলে টোকেনের মান সরাসরি লেখা হয়ে যায়। `--scope project`-এর সাথে এই পদ্ধতিটি ব্যবহার করবেন না এবং ফাইলটিকে ভার্সন কন্ট্রোলের বাইরে রাখুন। এর পরিবর্তে উপরের `.mcp.json` রেফারেন্স পদ্ধতিটি ব্যবহার করা উত্তম। Claude Code রিমোট `url` এবং `headers`-এ কিছু ক্রেডেনশিয়াল ভ্যারিয়েবল (যেমন `ANTHROPIC_AUTH_TOKEN`) ফাঁকা হিসেবে পড়ে; `CACTI_MCP_TOKEN` সেগুলোর অন্তর্ভুক্ত নয়। উৎস:
[Claude Code MCP ডকুমেন্টেশন](https://code.claude.com/docs/en/mcp)।

### VS Code-এ GitHub Copilot

ওয়ার্কস্পেস-রুটের `.mcp.json` (অথবা ব্যবহারকারীর `~/.copilot/mcp-config.json` ফাইল) ব্যবহার করুন। Copilot-নেটিভ এই ফাইলগুলোতে একটি টপ-লেভেল `mcpServers` অবজেক্ট এবং হেডার মানগুলোতে `${NAME}` এনভায়রনমেন্ট-ভ্যারিয়েবল রেফারেন্স ব্যবহৃত হয়:

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

যে এনভায়রনমেন্ট থেকে VS Code চালু হয়, সেখানে `CACTI_MCP_TOKEN` এক্সপোর্ট করুন। নেটিভ Copilot ফাইলগুলোতে `inputs` প্রম্পট সমর্থিত নয়। VS Code-এর গাইডেড সেটআপ `${...}` মানগুলো প্রত্যাখ্যান করে, তাই গাইডেড ফ্লো-এর মাধ্যমে নয়, বরং সরাসরি ফাইল সম্পাদনা করে `Authorization` হেডার যোগ করুন। শুধুমাত্র পরীক্ষামূলক `chat.mcp.workspaceRootConfig.enabled` সেটিংটি চালু থাকলেই গাইডেড সেটআপ ওয়ার্কস্পেস-রুট ফাইলটি দেখায়। বিস্তারিত দেখুন
[VS Code MCP কনফিগারেশন রেফারেন্সে](https://code.visualstudio.com/docs/agents/reference/mcp-configuration)।

**লিগ্যাসি: `.vscode/mcp.json`।** VS Code-এর নির্দেশনা অনুযায়ী নতুন Copilot কনফিগারেশনে `.vscode/mcp.json` বা প্রোফাইলের `mcp.json` ব্যবহার করা উচিত নয়; এগুলো অবচিত Local হারনেসের অন্তর্ভুক্ত, যা ২০২৭ সালের ফেব্রুয়ারিতে সরিয়ে ফেলা হবে। আপনি যদি এখনো এটি ব্যবহার করেন, তবে এডিটর-পরিচালিত ফরম্যাটটি একটি টপ-লেভেল `servers` কী গ্রহণ করে এবং টোকেনের জন্য প্রম্পট করতে পারে:

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

### যেসব ক্লায়েন্ট শুধু stdio সমর্থন করে

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) একটি ঐচ্ছিক অ্যাডাপ্টার, যা স্থানীয় stdio MCP সার্ভার হিসেবে চলে এবং প্লাগইনের HTTP API কল করে। যেসব ক্লায়েন্ট রিমোট HTTP সার্ভারের সাথে সংযুক্ত হতে পারে না, সেগুলোর জন্য এটি ব্যবহার করুন। এটির জন্য একই ব্যক্তিগত টোকেন প্রয়োজন এবং এটি `api.php`-এর সাথে যোগাযোগ করে।

### MCP আচরণ

এন্ডপয়েন্টটি শুধুমাত্র টুল পরিবেশন করে: উন্মুক্ত ও অনুমোদিত প্রতিটি অ্যাবিলিটি তার নিজস্ব ID নামযুক্ত একটি টুল, যার ইনপুট ও আউটপুট স্কিমা এবং রিড-অনলি অ্যানোটেশন থাকে (`openWorldHint` হলো `false`)। এটি `initialize`, `server/discover`, `ping`, `tools/list` এবং `tools/call` পরিচালনা করে। এটি কোনো সেশন সংরক্ষণ করে না, `Mcp-Session-Id` পাঠায় না (এবং কোনোটি পেলে উপেক্ষা করে), এবং JSON-RPC ব্যাচ গ্রহণ করে না। `id`-বিহীন কোনো বার্তা একটি নোটিফিকেশন হিসেবে গণ্য হয় এবং বডি ছাড়া HTTP 202 প্রতিক্রিয়া পায়। শুধুমাত্র `POST` অনুমোদিত।

- **রিভিশনসমূহ।** যে অনুরোধের `params._meta`-তে `io.modelcontextprotocol/protocolVersion` থাকে, সেটিতে অবশ্যই `2026-07-28` উল্লেখ থাকতে হবে; অন্য কিছু হলে `-32022` ত্রুটি আসে। এ ধরনের অনুরোধে অবশ্যই সামঞ্জস্যপূর্ণ `Mcp-Protocol-Version`, `Mcp-Method` এবং (`tools/call`-এর জন্য) `Mcp-Name` হেডার থাকতে হবে, অন্যথায় উত্তর হিসেবে `-32020` ত্রুটি পাওয়া যায়। অন্যান্য অনুরোধগুলোকে `2025-11-25` হিসেবে বিবেচনা করা হয়: `initialize` সেই রিভিশনসহ উত্তর দেয় এবং অন্য যেকোনো মেথডে যদি `Mcp-Protocol-Version` হেডার পাঠানো হয়, তবে তা অবশ্যই `2025-11-25`, `2025-06-18`, অথবা `2025-03-26` হতে হবে।
- **টুল ত্রুটি।** কোনো অ্যাবিলিটির ত্রুটি—যার মধ্যে স্কিমার সাথে না মেলা আর্গুমেন্ট বা JSON অবজেক্ট নয় এমন `arguments` মানও অন্তর্ভুক্ত—প্রোটোকল ত্রুটি হিসেবে নয়, বরং `isError: true` এবং `structuredContent`-এ AIP-193 ত্রুটিসহ একটি টুল ফলাফল হিসেবে ফিরে আসে।
- **প্রোটোকল ত্রুটি।** টুল ত্রুটি নয় এমন ব্যর্থতাগুলো JSON-RPC এরর অবজেক্ট হয় (যেখানে `data`-তে স্ট্যাটাস ও কারণসহ কোড `-32000` থাকে, অথবা স্ট্যান্ডার্ড কোড থাকে): যেমন অনুপস্থিত Public Cacti URL, প্রত্যাখ্যাত `Origin`, প্লাগইন নিষ্ক্রিয় থাকা অবস্থায় বা রিমোট পোলারে পাঠানো অনুরোধ, এবং অপ্রত্যাশিত সার্ভার ত্রুটি (`-32603`, যার বিস্তারিত প্রতিক্রিয়ায় নয় বরং Cacti লগে লেখা হয়)। যেসব অনুরোধ যাচাইকরণ প্রথমে চলে (405, 413, 415) এবং অথেনটিকেশন ব্যর্থতাগুলো (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) HTTP API-এর অধীনে বর্ণিত AIP-193 বডি বজায় রাখে।

## HTTP API

বেস URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`। এর কন্ট্র্যাক্ট
[openapi.json](../../../openapi.json)-এ রয়েছে।

| মেথড ও পাথ | উদ্দেশ্য |
| --- | --- |
| `GET /v1/abilities` | অনুমোদিত অ্যাবিলিটিগুলোর তালিকা দেখায়। কুয়েরি: `pageSize`, `pageToken` এবং `category = "inventory"` ফর্মের `filter`। |
| `GET /v1/abilities/{id}` | একটি অ্যাবিলিটি পড়ে। |
| `POST /v1/abilities/{id}:execute` | এটি চালায়। বডিটি হুবহু `{"arguments": {...}}` হয়। প্রতিক্রিয়াটি হয় `{"requestId": "...", "result": {...}}`। |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

ত্রুটিগুলো AIP-193 অনুসরণ করে: `code`, `message`, `status` এবং `details` সমৃদ্ধ একটি `error` অবজেক্ট, যা `cacti.net` ডোমেইন ও একটি স্থির `reason`সহ একটি `ErrorInfo` বহন করে। আর্গুমেন্ট-সংক্রান্ত সমস্যায় ফিল্ডের নাম উল্লেখ করে একটি `BadRequest` বিবরণ যুক্ত হয়। অনুরোধ বডির আকার সর্বোচ্চ 64 KB এবং ফলাফলের আকার সর্বোচ্চ 1 MB-এ সীমাবদ্ধ। উভয় এন্ডপয়েন্ট শুধুমাত্র মূল পোলারে উত্তর দেয় এবং প্লাগইন নিষ্ক্রিয় থাকলে বা সার্ভারটি মূল পোলার না হলে `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) রিটার্ন করে।

| HTTP | `reason` মানসমূহ |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (এছাড়াও `WWW-Authenticate: Bearer` পাঠায়) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` পাঠায়) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## একটি অ্যাবিলিটি লিখুন (প্লাগইন লেখকদের জন্য)

একটি সক্রিয় Cacti প্লাগইন এমন একটি ফাংশন থেকে অ্যাবিলিটি নিবন্ধন করে যা এটি `abilities_register` হুকের সাথে যুক্ত করে—সাধারণত এর `plugin_<slug>_install()`-এর ভেতরে:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

ফাংশনটি প্লাগইনের জন্য সীমাবদ্ধ একটি `AbilitiesRegistrar` পায়। এর রিটার্ন মান উপেক্ষা করা হয়।

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

নিয়মসমূহ, যেগুলোর সবকটিই নিবন্ধনের সময় কার্যকর করা হয়:

- **ID সমূহ।** একটি ID `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` প্যাটার্নের সাথে মেলে, সর্বোচ্চ 64 অক্ষরের হয় এবং প্লাগইনের স্লাগ ও একটি হাইফেন দিয়ে শুরু হতে হয়: যেমন উপরের `acme-`। স্লাগটি হলো প্লাগইন ডিরেক্টরির নাম, তাই `my_plugin`-এর মতো কোনো ডিরেক্টরি কিছু নিবন্ধন করতে পারে না। `cacti` নামের কোনো প্লাগইন ডিরেক্টরি প্রত্যাখ্যাত হয়; ওই নেমস্পেসটি বিল্ট-ইনগুলোর জন্য নির্ধারিত।
- **সংজ্ঞা।** ঠিক এই কীগুলো থাকতে হবে: `label`, `description` (সর্বোচ্চ 4096 বাইট), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`। ক্যাটাগরিটি অবশ্যই আগে থেকে বিদ্যমান থাকতে হবে: বিল্ট-ইন ক্যাটাগরি (`inventory`, `system`) ব্যবহার করুন অথবা `registerCategory()` দিয়ে আপনার নিজস্বটি নিবন্ধন করুন, যার ID সব প্লাগইনের মধ্যে অনন্য হতে হবে এবং `^[a-z][a-z0-9-]{0,31}$` প্যাটার্নের সাথে মিলতে হবে।
- **শুধুমাত্র রিড-অনলি।** `annotations` অবশ্যই হুবহু `readOnly: true`, `destructive: false`, `idempotent: true` হতে হবে। এর ব্যতিক্রম হলে এক্সসেপশন থ্রো করে।
- **স্কিমা।** `input_schema` এবং `output_schema` প্রতিটিরই টপ-লেভেল `type` হিসেবে `object` থাকতে হবে। এর ডায়ালেক্টটি সংক্ষিপ্ত এবং ফেইল-ক্লোজড হয়। অবজেক্টগুলো অবশ্যই ক্লোজড হতে হবে (`additionalProperties: false`, সাথে `properties` উপস্থিত থাকতে হবে); অন্যান্য টাইপগুলো হলো `integer` এবং `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, এবং `array` (যার জন্য `items` এবং `maxItems` প্রয়োজন)। একটি টাইপকে `['string', 'null']` হিসেবে নালেবল করা যেতে পারে। আর্গুমেন্ট স্ট্রিংগুলোর ডিফল্ট সর্বোচ্চ দৈর্ঘ্য 4096 অক্ষর; ফলাফলের স্ট্রিংগুলো শুধুমাত্র ঘোষিত `maxLength` এবং ফলাফলের আকারের সীমা দ্বারা সীমাবদ্ধ। সর্বোচ্চ 256টি অ্যাবিলিটি নিবন্ধন করা যাবে।
- **`permission(int $userId): bool`।** অনুমতি দেওয়ার জন্য অবশ্যই হুবহু `true` রিটার্ন করতে হবে। ইউজার ID হলো টোকেন মালিকের ID; কখনোই সেশন স্টেট পড়বেন না।
- **`execute(int $userId, stdClass $args): array`।** `$args` ইতিমধ্যেই `input_schema`-এর বিপরীতে যাচাইকৃত থাকে। অবজেক্ট-স্তরের অনুমতিগুলো নিজেই প্রয়োগ করুন। এমন একটি অ্যাসোসিয়েটিভ অ্যারে রিটার্ন করুন যা `output_schema`-এর সাথে হুবহু মেলে; কোনো লিস্ট, অতিরিক্ত ফিল্ড, বা 1 MB-এর বেশি JSON হলে তা `INVALID_RESULT` ত্রুটিতে পরিণত হয়। ক্লায়েন্টের কাছে দৃশ্যমান কোনো ব্যর্থতার (যেমন `NOT_FOUND`) জন্য `AbilitiesError` থ্রো করুন।
- **খালি অবজেক্ট।** PHP `[]`-কে JSON অ্যারে হিসেবে এনকোড করে। আউটপুট স্কিমার যেকোনো স্তরে যেখানে `object` ঘোষণা করা থাকে, রেজিস্ট্রি সেখানে `[]`-কে খালি অবজেক্ট হিসেবে গণ্য করে এবং `{}` পাঠায়; `new stdClass()`-ও কাজ করে। কোনো অ-শূন্য লিস্ট কখনোই অবজেক্ট হিসেবে গণ্য হয় না এবং `INVALID_RESULT` ত্রুটিসহ ব্যর্থ হয়। স্কিমায় একটি খালি `properties` ম্যাপ `[]` বা `new stdClass()` হতে পারে; উভয়ই `{}` হিসেবে প্রকাশিত হয়।
- **ব্যর্থতা বিচ্ছিন্নকরণ।** প্রতিটি প্লাগইন একটি স্ক্র্যাচ কপিতে নিবন্ধন করে, যা কেবল আপনার ফাংশন স্বাভাবিকভাবে রিটার্ন করলেই সংরক্ষিত হয়। যদি এটি এক্সসেপশন থ্রো করে, তবে আপনার কোনো অ্যাবিলিটিই নিবন্ধিত হয় না এবং ব্যর্থতাটি লগ করা হয়।

প্লাগইন থেকে আসা অ্যাবিলিটিগুলো শুরুতে লুকানো থাকে। অ্যাডমিনিস্ট্রেটর কনসোলের Abilities ট্যাবে সেগুলো উন্মুক্ত করেন এবং সেগুলোর জন্য Required Realm কলামে "Set by the plugin" লেখা দেখা যায়।

## নিরাপত্তা মডেল

- **শুধুমাত্র Bearer টোকেন।** `api.php` এবং `mcp.php` শুধুমাত্র `Authorization` হেডারে একটি ব্যক্তিগত টোকেন গ্রহণ করে, আর কিছুই নয়। Cacti লোড হওয়ার আগেই এগুলো কুকি, `$_POST` এবং `$_REQUEST` বাদ দেয় এবং Cacti যে সেশন শুরু করে তা নষ্ট করে দেয়, তাই ব্রাউজার লগইন কখনোই API অ্যাক্সেস দেয় না।
- **CSRF বিকল্প সমাধান।** Cacti-এর CSRF গার্ড এমন কোনো JSON POST অনুরোধ প্রত্যাখ্যান করে যাতে Cacti CSRF টোকেন নেই, যা কোনো MCP ক্লায়েন্ট পাঠাতে পারে না। শুধুমাত্র এই দুটি এন্ডপয়েন্টের জন্য, প্লাগইনটি Cacti লোড হওয়ার আগে অনুরোধের মেথডের নাম পরিবর্তন করে এবং পরে তা পুনরুদ্ধার করে, ফলে গার্ড এগুলোকে এড়িয়ে যায়। এটি নিরাপদ কারণ CSRF মূলত ব্রাউজার কুকির মাধ্যমে প্রমাণীকৃত অনুরোধগুলোকে সুরক্ষিত রাখে, আর এই এন্ডপয়েন্টগুলো কোনো কুকি পরিচয় গ্রহণ করে না: কোনো ক্রস-সাইট পেজ Bearer টোকেন যুক্ত করতে পারে না। কনসোল পেজগুলোতে পূর্ণ CSRF সুরক্ষা বজায় থাকে। Cacti সমর্থিত কোনো অব্যাহতি প্রদান না করা পর্যন্ত এই বিকল্প সমাধানটি সাময়িক; দেখুন `lib/bootstrap.php`।
- **Origin যাচাইকরণ।** `mcp.php`-তে অনুরোধে যদি `Origin` হেডার থাকে, তবে তা অবশ্যই Public Cacti URL-এর স্কিম, হোস্ট এবং পোর্টের সাথে হুবহু মিলতে হবে, নতুবা `ORIGIN_NOT_ALLOWED` ত্রুটিসহ অনুরোধটি প্রত্যাখ্যাত হবে। যেসব অনুরোধে `Origin` হেডার নেই—যেভাবে নন-ব্রাউজার ক্লায়েন্টগুলো সংযুক্ত হয়—সেগুলো অনুমোদিত। এটি কোনো ওয়েব পেজকে ভিজিটরের ব্রাউজার থেকে এন্ডপয়েন্টটি পরিচালনা করা থেকে বিরত রাখে। `api.php` এই যাচাইকরণ প্রয়োগ করে না।
- **শুধুমাত্র রিড-অনলি।** নিবন্ধন প্রক্রিয়া এমন যেকোনো অ্যাবিলিটি প্রত্যাখ্যান করে যা রিড-অনলি, অ-ধ্বংসাত্মক এবং আইডেমপোটেন্ট নয়।
- **এক্সপোজার এবং রিয়েলম উভয়ই প্রযোজ্য।** একটি অ্যাবিলিটি অবশ্যই উন্মুক্ত হতে হবে এবং টোকেন মালিকের কাছে এর রিয়েলম থাকতে হবে। এক্সপোজার টেবিল পড়া না গেলে ডিফল্ট মানে ফিরে যাওয়ার পরিবর্তে প্রতিটি অ্যাবিলিটি লুকানো অবস্থায় থাকে।
- **লুকানো, অজানা এবং অননুমোদিত অ্যাবিলিটি একইরকম দেখায়।** একটি ক্লায়েন্ট বুঝতে পারে না যে কোন অ্যাবিলিটি বিদ্যমান নেই, কোনটি লুকানো আছে, বা ব্যবহারকারীর তা ব্যবহারের অনুমতি নেই: ডিসকভারি এটিকে বাদ দেয় এবং এক্সিকিউশন `NOT_FOUND` (`ABILITY_NOT_FOUND`) রিটার্ন করে।
- **টোকেন।** SHA-256 হ্যাশ হিসেবে সংরক্ষিত হয়, একবারই দেখানো হয়, সর্বদা মেয়াদোত্তীর্ণ হয়, বাতিলযোগ্য, এবং মালিক নিষ্ক্রিয় হলে বা রিয়েলম হারালে প্রত্যাখ্যাত হয়।
- **অডিট।** `plugin_mcp_audit` অনুরোধ আইডি, টোকেন আইডি, ব্যবহারকারী আইডি, অ্যাবিলিটি, ফলাফল (`started`, `succeeded`, `failed`, `denied`, `rejected`) এবং টাইমস্ট্যাম্প সংরক্ষণ করে। এটি কখনোই আর্গুমেন্ট, ফলাফল বা টোকেনের মান সংরক্ষণ করে না। একটি অ্যাবিলিটি কেবল তখনই চলে যখন এর `started` সারিটি লেখা হয়; অডিট টেবিল অনুপলব্ধ হলে কলটি `UNAVAILABLE` ত্রুটিসহ ব্যর্থ হয় এবং চালানো হয় না। চালানোর আগেই প্রত্যাখ্যাত একটি কল একটি সারি হিসেবে লেখা হয়: অজানা, লুকানো বা অননুমোদিত অ্যাবিলিটির জন্য `denied`, এবং স্কিমা যাচাইয়ে ব্যর্থ আর্গুমেন্টের জন্য `rejected`। কনসোল, My MCP Tokens এবং CLI থেকে টোকেন তৈরি ও বাতিলকরণ যথাক্রমে `mcp-token-create` এবং `mcp-token-revoke` হিসেবে `succeeded` ফলাফলসহ নথিভুক্ত হয়, এবং কেবল সক্রিয় থাকা টোকেনের বাতিলকরণই নথিভুক্ত করা হয়। ডিসকভারি এবং যে কলের `arguments` একটি JSON অবজেক্ট নয়, সেগুলো লগ করা হয় না।
- **ব্যর্থতার লগ।** কোনো অপ্রত্যাশিত ব্যর্থতা, `INVALID_RESULT`, বা অডিট টেবিল অনুপলব্ধ হলে তা `MCP` ফ্যাসিলিটিসহ Cacti লগে এক লাইন লিখে রাখে: অ্যাবিলিটি আইডি, একটি নির্দিষ্ট কারণ এবং এক্সসেপশন ক্লাস। বার্তা, আর্গুমেন্ট এবং টোকেন কখনোই লগ করা হয় না।
- **শুধুমাত্র মেইন পোলার।** উভয় এন্ডপয়েন্ট, উভয় কনসোল পেজ এবং `tokens.php` অন্য কোথাও কাজ করতে অস্বীকার করে।

## জীবনচক্র

প্লাগইনটি নিষ্ক্রিয় করলে উভয় এন্ডপয়েন্টই ব্লক হয়ে যায়। আনইনস্টল করলে প্রতিটি টোকেন বাতিল হয়ে যায় এবং তথ্য সংরক্ষণের জন্য তিনটি টেবিল (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) রেখে দেওয়া হয়; পুনরায় ইনস্টল করলেও বাতিল হওয়া কোনো টোকেন পুনরায় সক্রিয় হয় না। Cacti ডেটাবেজের সাথে টেবিলগুলোর ব্যাকআপ নিন এবং প্লাগইনের বাইরে একটি অডিট সংরক্ষণ নীতি প্রয়োগ করুন।

## ডেভেলপমেন্ট ও পরীক্ষা

পরীক্ষার স্যুটে `tests/`-এ থাকা সাধারণ PHP স্ক্রিপ্টগুলোর পাশাপাশি `tests/Unit/`-এ থাকা PHPUnit ইউনিট পরীক্ষা এবং PHPStan স্ট্যাটিক বিশ্লেষণ (লেভেল 6) অন্তর্ভুক্ত রয়েছে, যার সবগুলোই Cacti ইনস্টলেশন ছাড়াই চলে:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI চলে PHP 8.2 থেকে 8.5 সংস্করণে: একটি `test` জব যা PHP সিনট্যাক্স লিন্ট (`php -l`) করে এবং `.github/workflows/ci.yml`-এ তালিকাভুক্ত 13টি সাধারণ PHP পরীক্ষা স্ক্রিপ্ট চালায়, একটি `quality` জব যা `composer phpstan` ও `composer test` চালায়, এবং একটি `package` জব যা ইনস্টলযোগ্য `mcp/` আর্কাইভ (`.gitattributes`-এ তালিকাভুক্ত ডেভেলপমেন্ট ও পরীক্ষা ফাইল বাদ দিয়ে) ও এর `SHA256SUMS` তৈরি করে। Cacti-সংশ্লিষ্ট পরীক্ষাগুলো Cacti হেল্পার বাউন্ডারিতে ফিক্সচার ব্যবহার করে; এগুলো পূর্ণাঙ্গ Cacti ইনস্টলেশন পরীক্ষা করে না।

### ইন্টিগ্রেশন পরীক্ষা

`tests/integration/run.sh 1.2.31` বা `tests/integration/run.sh develop` কন্টেইনারের ভেতর একটি প্রকৃত Cacti-তে প্লাগইনটি ইনস্টল করে এবং এর বিপরীতে সরাসরি পরীক্ষা চালায়। এর জন্য Compose v2.23.1 বা তার পরবর্তী সংস্করণসহ Docker, git এবং openssl প্রয়োজন। ডিবাগিংয়ের জন্য `KEEP=1` স্ট্যাকটিকে চালু অবস্থায় রাখে। CI এটি পুল রিকোয়েস্টে নয়, বরং প্রতি রাতে এবং চাহিদা অনুযায়ী চালায়।

## লোকালাইজেশন

Cacti MCP ইংরেজিসহ ৪৭টি লোকেলের (১৯টি ব্রড টিয়ার ১, ১৫টি আফ্রিকান, ১০টি এশীয়, এবং বসনীয়, ক্রোয়েশীয় ও সার্বীয় লোকেল) জন্য `mcp` টেক্সট ডোমেইন (`locales/po/mcp.pot`) ব্যবহার করে `locales/po/` ও `locales/LC_MESSAGES/`-এর অধীনে কম্পাইল করা GNU gettext ক্যাটালগ এবং `docs/i18n/`-এর অধীনে লোকালাইজড README সরবরাহ করে। ভাষা সহায়তা সক্রিয় থাকলে Cacti স্বয়ংক্রিয়ভাবে সামঞ্জস্যপূর্ণ ক্যাটালগটি লোড করে।

## অবদান রাখা

পুল রিকোয়েস্টগুলো `develop` ব্রাঞ্চে পাঠাতে হবে। প্রোডাকশন কোড PHP 8.2-এর সাথে সামঞ্জস্যপূর্ণ রাখুন এবং Cacti-এর কোডিং শৈলী অনুসরণ করুন: ট্যাব, সিঙ্গেল-কোটেড স্ট্রিং এবং Cacti-এর ডেটাবেজ ও অনুমতি হেল্পার ব্যবহার করুন। পরিবর্তিত ভ্যালিডেশন, অনুমোদন বা প্রোটোকল আচরণের জন্য পরীক্ষা যোগ করুন এবং `git commit -s` দিয়ে কমিট সাইন-অফ করুন। HTTP API-এর পরিবর্তনগুলো [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp)-এর সাথে সমন্বয় করুন।

## লাইসেন্স

স্বত্ব (C) ২০২৬ Thomas Vincent। GNU General Public License, সংস্করণ ২ বা তার পরবর্তী সংস্করণের অধীনে প্রকাশিত। দেখুন [LICENSE](../../../LICENSE)।
