<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: קקטוס עם מגן. גלו. אשרו. בצעו.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="רישיון: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP הוא תוסף ל-Cacti המאפשר ללקוחות AI לקרוא את נתוני ה-Cacti שלכם באמצעות
פעולות בעלות שם ומסוננות הרשאות הנקראות יכולות (abilities). התוסף מגיש אותן בשתי דרכים
מתוך התוסף עצמו: נקודת קצה של MCP (`mcp.php`, Streamable HTTP) וממשק HTTP API
בסגנון AIP (`api.php`). מערכת Cacti נשארת אחראית על ההרשאה ועל הביצוע. הלקוח לעולם
אינו שולח שאילתות ישירות למסד הנתונים; הוא יכול לקרוא רק ליכולת שמנהל מערכת חשף
ושתחומי ההרשאה (realms) של בעל הטוקן ב-Cacti מתירים.

מפתחי תוספים יכולים לרשום יכולות קריאה-בלבד משלהם באמצעות ה-hook
`abilities_register`, והן מופיעות ללקוחות MCP ככלים ללא צורך בקוד פרוטוקול.

**מצב: קדם-הפצה, גרסה 0.1.0.** אין גרסה מתויגת עדיין.

זמין כיום:

- יכולות מובנות לקריאה בלבד עבור גרסאות מערכת ומלאי התקנים.
- טוקנים לגישה אישית (`cmcp_pat_...`) כאמצעי האימות היחיד.
- מסוף Management > MCP: חשיפה או הסתרה של יכולות, יצירה וביטול של טוקנים,
  וקריאת יומן הביקורת.
- Management > My MCP Tokens: משתמשים מנהלים את הטוקנים שלהם, רואים את הפעילות
  שלהם ובודקים באילו כלים הטוקנים שלהם יכולים להשתמש.
- MCP מעל Streamable HTTP, גרסאות פרוטוקול `2026-07-28` ו-`2025-11-25`,
  כלים בלבד.

עדיין לא זמין:

- התחברות באמצעות OAuth 2.1. מחברים מתארחים שאינם יכולים לשלוח טוקן אישי, כגון
  מחברים מותאמים אישית של ChatGPT ושל claude.ai, אינם יכולים להתחבר עד שהדבר יהיה קיים.
  יכולת זו מתוכננת כתוכנית 2; תוכנית זו טרם נכתבה.
- יכולות כתיבה. רק יכולות לקריאה בלבד יכולות להירשם.

התכנון מופיע ב[מפרט התכנון של נקודת הקצה](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
ורצף הבנייה מופיע ב-[docs/plan.md](../../plan.md).

## יכולות מובנות

| מזהה | ארגומנטים | תחום Cacti נדרש |
| --- | --- | --- |
| `cacti-get-system-info` | ללא | 15 |
| `cacti-list-devices` | אופציונליים: `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | נדרש: `name`, כגון `devices/12` | 3 |

כל קריאה דורשת גם את תחום ההרשאה **MCP and Abilities API** עבור בעל הטוקן,
את ההיקף (scope) `abilities:read` (הקיים בכל טוקן אישי), ויכולת חשופה.
הלשונית Abilities במסוף מציגה את תחום ההרשאה שכל יכולת מובנית דורשת.

- `cacti-list-devices` מחזירה דפים של עד 100 התקנים (ברירת מחדל 50) וכן
  `nextPageToken`. טוקן דף תקף רק עבור אותם `filter` ו-`orderBy`.
  `filter` הוא ביטוי AIP-160 של השוואות המחוברות ב-`AND`,
  לדוגמה `state = "DOWN" AND disabled = false`. שדות הסינון הם
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId` ו-`state`. `orderBy` מקבל `displayName`, `hostname` או `name`,
  וניתן להוסיף אחרי כל אחד מהם `desc`.
- שאילתות התקנים עוברות דרך `get_allowed_devices()` של Cacti, כך שמשתמש רואה רק
  את ההתקנים ש-Cacti הייתה מציגה לו.
- שדות ההתקנים אינם כוללים מחרוזות קהילה של SNMP, סיסמאות ופרטי אימות אחרים.

## התקנה

נדרשים Cacti 1.2.31 ואילך, PHP 8.2 ואילך, וה-poller הראשי. אימות המשתמשים של Cacti
חייב להיות מופעל; התוסף מסרב לאמת כאשר האימות כבוי.

תיקיית התוסף חייבת להיקרא `mcp`, ולא `plugin_mcp`. מזהה התוסף, שמות תחומי ההרשאה,
תחום התרגום וכתובות ה-URL משתמשים כולם ב-`mcp`.

מתוך עותק מקור:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

עד שיהיו גרסאות מתויגות, ניתן במקום זאת להוריד את ארטיפקט `mcp-plugin`
מתוך [הרצת CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
מוצלחת. הוא מכיל את `mcp.tar.gz` ואת `SHA256SUMS`. אמתו את סכום הביקורת, ולאחר מכן חלצו את
`mcp.tar.gz` בתוך תיקיית `plugins/` של Cacti כך שהתוצאה תהיה `plugins/mcp/`.
ארכיוני המקור האוטומטיים של GitHub משתמשים בשם תיקייה עליונה שונה. הארכיון
משמיט את `docs/` (כולל צילומי המסך שלהלן), את `tests/` ואת `.github/`, כך שקישורי
ה-README לתוך `docs/` עובדים ב-GitHub אך לא בהתקנה מקומית.

לאחר מכן:

1. תחת Plugin Management, התקינו והפעילו את **Cacti MCP**. מנהל המערכת המתקין
   מקבל אוטומטית את תחום ההרשאה **MCP Administration**.
2. תחת Settings > MCP, הגדירו את **Public Cacti URL** לכתובת שבה הלקוחות משתמשים,
   לדוגמה `https://cacti.example.com/cacti`. נדרש HTTPS למעט עבור
   `localhost`, `127.0.0.1` ו-`[::1]`. עד שערך זה מוגדר, `mcp.php` משיבה HTTP 400
   עם שגיאת JSON-RPC שבה הערך `data` הוא `FAILED_PRECONDITION` ו-`PUBLIC_URL_REQUIRED`.
   `api.php` אינה קוראת הגדרה זו.

   ![הגדרות > MCP המציג את השדה Public Cacti URL](../../images/settings-public-url.png)

3. העניקו את תחום ההרשאה **MCP and Abilities API** לכל משתמש שיהיה בעל טוקן.
   אף משתמש אינו מקבל אותו אוטומטית.
4. ודאו ששרת האינטרנט מעביר את כותרת ה-`Authorization` ואת מידע הנתיב (path info) ל-PHP
   (ראו להלן).
5. פתחו את Management > MCP וחשפו את היכולות שברצונכם שלקוחות יראו.

**שדרוג מגרסת פיתוח.** התוסף נמצא בקדם-הפצה, והטבלאות שלו השתנו במהלך הפיתוח ללא
מיגרציות. אם התקנתם גרסה מוקדמת יותר, הסירו את התקנתה והתקינו מחדש. התקנה מחדש
שומרת על טבלאות שכבר קיימות, לכן מחקו תחילה את הטבלאות הישנות `plugin_mcp_token`,
`plugin_mcp_audit` ו-`plugin_mcp_ability` (ואת הטבלאות המקבילות מגרסאות שנוצרו
לפני שינוי השם). גבו אותן אם אתם זקוקים להיסטוריה שלהן; טוקנים מגרסאות אלו מבוטלים
בעת הסרת ההתקנה ואינם עוברים לגרסה החדשה.

### שרת אינטרנט

התקנות Apache המסירות את כותרת ה-`Authorization` לפני PHP זקוקות להגדרה הבאה
ב-virtual host או בתיקייה הרלוונטית, ולאחריה טעינה מחדש של השרת:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache עם `mod_php` הגיש נתיבי `api.php` ללא צורך בהגדרת נתיבים נוספת.

נתיבי `api.php` נמצאים בחלק הנתיב שאחרי שם הסקריפט
(`/plugins/mcp/api.php/v1/abilities`), ולכן nginx חייב להתאים כתובות URI שבהן
אחרי `.php` מופיע נתיב נוסף, לפצל את מידע הנתיב ולהעביר אותו ל-PHP.
בלוק `location ~ \.php$` לעולם אינו מתאים לכתובות אלו; nginx משיב עם דף HTML 404
משלו. תבנית ה-location ושתי שורות ה-path-info שלהלן אומתו עם PHP-FPM;
שאר השורות הן תבנית תצורה סטנדרטית:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

התאימו את השורות `include` ו-`fastcgi_pass` כך שיתאימו לבלוק שכבר מגיש את Cacti.
אל תוסיפו `try_files $fastcgi_script_name =404;` לבלוק זה: פקודה זו מאפסת את
`$fastcgi_path_info`, ואז `api.php` משיבה 404 `UNKNOWN_PATH`. אם התצורה שלכם
דורשת `try_files`, שמרו תחילה את הערך באמצעות
`set $path_info $fastcgi_path_info;` והעבירו `fastcgi_param PATH_INFO $path_info;`.

ל-`mcp.php` אין נתיבי משנה ואינה זקוקה להגדרות אלו.

## מסוף

ל-Management > MCP יש שלוש לשוניות. נדרש תחום ההרשאה **MCP Administration**.
צילומי המסך כאן ובהמשך נלקחו מגרסת פיתוח של Cacti עם נתונים לדוגמה.

- **Abilities** מציגה כל יכולת רשומה עם התוסף שלה, הקטגוריה, תחום ההרשאה שהיא
  דורשת והאם היא חשופה. סמנו שורות ובחרו Expose או Hide; תידרשו לאשר לפני
  שהשינוי יוחל. היכולות המובנות `cacti-*` חשופות כברירת מחדל. יכולות מתוספים אחרים
  מתחילות כמוסתרות, כך שהתקנת תוסף לעולם אינה מפרסמת דבר עד שמנהל המערכת מחליט
  לעשות זאת. חשיפה רק מצמצמת גישה: המשתמש עדיין זקוק לתחום ההרשאה של היכולת.

  ![הלשונית Abilities המציגה את היכולות המובנות עם תחומי ההרשאה ומצב החשיפה שלהן](../../images/console-abilities.png)
- **Tokens** מציגה טוקנים עם בעלים, יוצר, מועד יצירה, תוקף, שימוש אחרון ומצב
  (Active, Expired, Revoked). סמנו שורות ובחרו Revoke כדי לבטל אותן.
  טוקנים מבוטלים אינם יכולים לשמש שוב. Create Token יוצר טוקן חדש.

  ![הלשונית Tokens המציגה טוקנים עם בעלים, תוקף, שימוש אחרון ומצב, מעל הטופס Create Token](../../images/console-tokens.png)
- **Audit** מציגה שורות ביקורת, מהחדשה לישנה, ומסננת לפי משתמש, יכולת ותוצאה.

  ![הלשונית Audit המציגה קריאות עם משתמש, טוקן, יכולת ותוצאה, יחד עם מסננים](../../images/console-audit.png)

## טוקנים

טוקן אישי קורא מ-Cacti בשם הבעלים שלו. צורתו היא `cmcp_pat_` ואחריה
64 תווים הקסדצימליים באותיות קטנות, והוא נושא את ההיקף היחיד `abilities:read`.
מה שהוא יכול לראות נקבע על ידי תחומי ההרשאה והרשאות ההתקנים של הבעלים ב-Cacti,
ולא על ידי הטוקן עצמו. הבעלים חייב להיות משתמש פעיל המחזיק בתחום ההרשאה
**MCP and Abilities API**.

טוקנים נוצרים תמיד עבור משתמש, פג תוקפם וניתן לבטל אותם:

- **מסוף.** Management > MCP > Tokens > Create Token. אורך החיים הוא 1 עד 365 ימים
  וברירת המחדל היא 90. הטוקן נוצר על ידי השרת ומוצג פעם אחת בלבד בדף התגובה,
  לכן העתיקו אותו למנהל הסודות שלכם מיד. ניתן ליצור טוקן עבור עצמכם. יצירת טוקן
  עבור משתמש אחר דורשת גם את תחום ההרשאה Users/Groups, משום שהטוקן קורא מ-Cacti
  בשם אותו משתמש.
- **My MCP Tokens.** כל משתמש בעל תחום ההרשאה MCP and Abilities API יכול לנהל את
  הטוקנים שלו; ראו להלן.
- **שורת הפקודה.** `tokens.php` רץ רק משורת הפקודה (CLI), תחת חשבון מערכת הפעלה
  שיכול לנהל את Cacti. הוא מקבל את הטוקן ממשתני הסביבה כך שהערך לעולם אינו מופיע
  בשורת הפקודה או ברשימת התהליכים. אורך החיים הוא 1 עד 365 ימים וברירת המחדל היא 30.
  יצירה וביטול של טוקן דרך ה-CLI מתועדים בביקורת כמו במסוף, עם בעל הטוקן כמבצע
  הפעולה מפני של-CLI אין משתמש Cacti, כך ששורת הביקורת אינה מסמנת שהפעולה הגיעה
  מה-CLI. `--list` מדפיס כל טוקן כ-JSON (מזהה, בעלים, היקפים, חותמות זמן, דגל ביטול)
  ולעולם לא את ערך הטוקן; `--help` מציג הוראות שימוש.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

לא ניתן ליצור טוקנים עבור חשבון האורח (guest), עבור משתמשים מושבתים או עבור משתמשים
ללא תחום ההרשאה **MCP and Abilities API**, לא מהמסוף, לא משורת הפקודה ולא מתוך
My MCP Tokens. Cacti שומרת את הגדרת האורח כשם משתמש או כמזהה משתמש, והתוסף
מפענח את שניהם. טוקן שבעליו הופך לחשבון האורח מפסיק לעבוד בבקשה הבאה שלו.

### הטוקנים שלי ב-MCP

ל-Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) אין צורך בתחום הרשאת
ניהול: הדף מכוסה על ידי תחום ההרשאה **MCP and Abilities API**, ופריט התפריט
מופיע רק עבור משתמשים המחזיקים בו. הדף פועל תמיד על המשתמש המחובר.
התפריט של Cacti הוא חלק מהמסוף, כך שמשתמש ללא גישה למסוף מגיע לדף באמצעות כתובתו.

![הלשונית My Tokens המציגה את הטוקנים של המשתמש המחובר ואת טופס היצירה](../../images/my-tokens.png)

- **Tokens** מציגה את הטוקנים שלכם, יוצרת טוקן (1 עד 365 ימים, ברירת מחדל 90,
  מוצג פעם אחת בתגובה), ומבטלת טוקנים שלכם. אינכם יכולים לראות או לבטל טוקנים של
  אף אחד אחר.
- **Activity** מציגה את הפעולות שביצעתם, מהחדשה לישנה: קריאות שבוצעו באמצעות
  הטוקנים שלכם ושינויים שביצעתם בטוקנים.
- **Available Tools** מציגה את היכולות שטוקן שלכם יכול להשתמש בהן כרגע, עם המזהה,
  השם והתיאור של כל יכולת. הרשימה פועלת לפי הרשאות ה-Cacti שלכם ולפי הגדרות החשיפה
  שמנהל המערכת בחר.

  ![רשימת Available Tools המציגה את המזהה, השם והתיאור של כל יכולת](../../images/my-tools.png)

התקנה שבוצעה לפני שדף זה היה קיים כוללת רשימת קבצים בתחום ההרשאה ללא
`mcp_tokens.php`. ההתקנה רושמת את הרשימה; היא אינה מתעדכנת בעת הפעלה או השבתה
של התוסף. הסירו והתקינו מחדש את התוסף, ולאחר מכן העניקו מחדש את תחומי ההרשאה,
משום ש-Cacti מסירה הענקות של תחומי הרשאה בעת הסרת התקנה של תוסף.

מסד הנתונים שומר רק את גיבוב ה-SHA-256 של הטוקן, כך שלא ניתן לשחזר טוקן שאבד;
בטלו אותו וצרו אחר. תחלופה (rotation) פועלת באותו אופן: צרו טוקן חדש, החליפו
בלקוח, ולאחר מכן בטלו את הישן. טוקן שפג תוקפו, טוקן שבוטל, בעלים מושבת או תחום
הרשאה שאבד — כל אחד מאלה נכשל בבקשה הבאה. טוקנים מתקבלים רק בכותרת
`Authorization: Bearer`; טוקן במחרוזת השאילתה (query string) או בגוף הבקשה אינו
מתקבל.

## חיבור לקוח

השתמשו בנקודת הקצה של MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, עם האסימון בכותרת `Authorization: Bearer`. שמרו את האסימון במשתנה סביבה או במנהל סודות והפנו אליו מתצורת הלקוח במקום לכתוב את ערכו בתוך קובץ.

### Claude Code

הגדירו את נקודת הקצה בקובץ `.mcp.json` של הפרויקט שמפנה אל האסימון לפי שמו. Claude Code מרחיב את `${VAR}` בשדות `url` ו-`headers`, כך שהקובץ אינו מכיל סודות ובטוח לביצוע commit. ייצאו את `CACTI_MCP_TOKEN` בסביבה שמפעילה את Claude Code.

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

ניתן להוסיף אותו גם משורת הפקודה:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

בשימוש במרכאות כפולות, המעטפת (shell) מרחיבה תחילה את `$CACTI_MCP_TOKEN`, כך שערך האסימון נכתב לתוך קובץ התצורה עבור ה-`--scope` שנבחר (`local`, `user`, או `project`; ברירת המחדל היא `local`). אל תשתמשו בצורה זו עם `--scope project`, ושמרו את הקובץ מחוץ לבקרת הגרסאות. העדיפו את ההפניה ב-`.mcp.json` שלעיל. Claude Code קורא חלק ממשתני האישורים (כגון `ANTHROPIC_AUTH_TOKEN`) כריקים בשדות `url` ו-`headers` מרוחקים; `CACTI_MCP_TOKEN` אינו אחד מהם. מקור: [תיעוד ה-MCP של Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot ב-VS Code

השתמשו בקובץ `.mcp.json` בשורש סביבת העבודה (או בקובץ המשתמש `~/.copilot/mcp-config.json`). קבצים ייעודיים אלה של Copilot משתמשים באובייקט `mcpServers` ברמה העליונה ובהפניות למשתני סביבה בצורת `${NAME}` בערכי כותרות:

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

ייצאו את `CACTI_MCP_TOKEN` בסביבה שמפעילה את VS Code. קבצים ייעודיים של Copilot אינם תומכים בבקשות קלט מסוג `inputs`. אשף ההגדרה המודרכת של VS Code דוחה ערכי `${...}`, לכן הוסיפו את הכותרת `Authorization` באמצעות עריכת הקובץ, ולא דרך התהליך המודרך. ההגדרה המודרכת מציעה את הקובץ בשורש סביבת העבודה רק כאשר ההגדרה הניסיונית `chat.mcp.workspaceRootConfig.enabled` מופעלת. ראו את [מדריך תצורת ה-MCP של VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**מדור קודם: `.vscode/mcp.json`.** לפי VS Code, תצורות Copilot חדשות אינן צריכות להשתמש ב-`.vscode/mcp.json` או בקובץ `mcp.json` של הפרופיל; הן שייכות למנגנון המקומי (Local harness) שהוצא משימוש ויוסר בפברואר 2027. אם אתם עדיין משתמשים בו, הפורמט המנוהל על ידי העורך מקבל מפתח `servers` ברמה העליונה ויכול לבקש הזנה של האסימון:

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

### לקוחות התומכים ב-stdio בלבד

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) הוא מתאם אופציונלי שרץ כשרת MCP מקומי מסוג stdio וקורא ל-HTTP API של התוסף. השתמשו בו עבור לקוח שאינו יכול להתחבר לשרת HTTP מרוחק. הוא דורש את אותו אסימון אישי ומתקשר מול `api.php`.

### התנהגות MCP

נקודת הקצה משרתת כלים (tools) בלבד: כל יכולת (ability) חשופה ומורשית היא כלי ששמו הוא המזהה שלה, עם סכמות הקלט והפלט שלה ואנוטציות לקריאה בלבד (`openWorldHint` הוא `false`). היא מטפלת ב-`initialize`, `server/discover`, `ping`, `tools/list`, ו-`tools/call`. היא אינה שומרת סשן, אינה שולחת `Mcp-Session-Id` (ומתעלמת ממנו אם הוא מתקבל), ואינה מקבלת אצוות (batches) של JSON-RPC. הודעה ללא `id` היא התראה (notification) ומחזירה קוד HTTP 202 ללא גוף תגובה. רק שיטת `POST` מותרת.

- **גרסאות פרוטוקול.** בקשה הנושאת את `io.modelcontextprotocol/protocolVersion` בתוך `params._meta` חייבת לציין `2026-07-28`; כל ערך אחר מקבל שגיאה `-32022`. בקשות כאלה חייבות לשאת גם כותרות תואמות `Mcp-Protocol-Version`, `Mcp-Method`, ועבור `tools/call` גם `Mcp-Name`, אחרת התגובה היא שגיאה `-32020`. בקשות אחרות מטופלות כ-`2025-11-25`: `initialize` עונה עם גרסה זו, ובכל מתודה אחרת הכותרת `Mcp-Protocol-Version`, אם נשלחה, חייבת להיות `2025-11-25`, `2025-06-18`, או `2025-03-26`.
- **שגיאות כלי.** שגיאת יכולת, כולל ארגומנטים שאינם תואמים לסכמה או ערך `arguments` שאינו אובייקט JSON, חוזרת כתוצאת כלי עם `isError: true` ושגיאת ה-AIP-193 בתוך `structuredContent`, ולא כשגיאת פרוטוקול.
- **שגיאות פרוטוקול.** כשלים שאינם שגיאות כלי הם אובייקטי שגיאה של JSON-RPC (קוד `-32000` עם הסטטוס והסיבה ב-`data`, או הקודים התקניים): כתובת Public Cacti URL חסרה, `Origin` שנדחה, בקשה כשהתוסף מושבת או על גבי poller מרוחק, ושגיאות שרת בלתי צפויות (`-32603`, כאשר הפירוט נכתב ליומן של Cacti ולא לתגובה). בדיקות בקשה הרצות ראשונות (405, 413, 415) וכשלי אימות (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) שומרים על גוף ה-AIP-193 המתואר תחת HTTP API.

## ממשק HTTP API

כתובת בסיס: `https://cacti.example.com/cacti/plugins/mcp/api.php`. החוזה נמצא בקובץ [openapi.json](../../../openapi.json).

| שיטה ונתיב | מטרה |
| --- | --- |
| `GET /v1/abilities` | הצגת רשימת יכולות מורשות. פרמטרי שאילתה: `pageSize`, `pageToken`, ו-`filter` בצורה `category = "inventory"`. |
| `GET /v1/abilities/{id}` | קריאת יכולת אחת. |
| `POST /v1/abilities/{id}:execute` | הרצת היכולת. גוף הבקשה הוא בדיוק `{"arguments": {...}}`. התגובה היא `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

שגיאות עומדות בתקן AIP-193: אובייקט `error` עם `code`, `message`, `status`, ו-`details` שנושא `ErrorInfo` עם הדומיין `cacti.net` ו-`reason` יציב. בעיות בארגומנטים מוסיפות פרט מסוג `BadRequest` המציין את שם השדה. גופי בקשה מוגבלים ל-64 KB, ותוצאות ל-1 MB. שתי נקודות הקצה עונות רק ב-poller הראשי ומחזירות `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) כאשר התוסף מושבת או שהשרת אינו ה-poller הראשי.

| HTTP | ערכי `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (שולח גם `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (שולח `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## כתיבת יכולת (למפתחי תוספים)

תוסף Cacti מופעל רושם יכולות מתוך פונקציה שהוא מחבר ל-hook בשם `abilities_register`, בדרך כלל בתוך `plugin_<slug>_install()` שלו:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

הפונקציה מקבלת אובייקט `AbilitiesRegistrar` המוגבל לתחום התוסף. המערכת מתעלמת מערך ההחזרה שלה.

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

הכללים, הנאכפים כולם בעת הרישום:

- **מזהים (IDs).** מזהה תואם לביטוי `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, אורכו לכל היותר 64 תווים, והוא חייב להתחיל ב-slug של התוסף ובמקף: `acme-` בדוגמה למעלה. ה-slug הוא שם תיקיית התוסף, כך שתיקייה כמו `my_plugin` אינה יכולה לרשום דבר. תיקיית תוסף בשם `cacti` נדחית; מרחב שמות זה שמור ליכולות המובנות.
- **הגדרה.** בדיוק המפתחות הבאים: `label`, `description` (עד 4096 בתים), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. הקטגוריה חייבת להיות קיימת כבר: השתמשו בקטגוריה מובנית (`inventory`, `system`) או רשמו קטגוריה משלכם באמצעות `registerCategory()`, שהמזהה שלה ייחודי בכלל התוספים ותואם לביטוי `^[a-z][a-z0-9-]{0,31}$`.
- **לקריאה בלבד.** הערך של `annotations` חייב להיות בדיוק `readOnly: true`, `destructive: false`, `idempotent: true`. כל ערך אחר זורק חריגה.
- **סכמות.** ל-`input_schema` ול-`output_schema` חייב להיות `type` מסוג `object` ברמה העליונה. הדיאלקט מצומצם ונכשל באופן סגור (fail closed). אובייקטים חייבים להיות סגורים (`additionalProperties: false`, עם `properties` נוכח); סוגים נוספים הם `integer` ו-`number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, ו-`array` (הדורש `items` ו-`maxItems`). ניתן להפוך סוג ל-nullable בצורה `['string', 'null']`. מחרוזות בארגומנטים מוגבלות כברירת מחדל לעד 4096 תווים; מחרוזות בתוצאה מוגבלות רק על ידי `maxLength` מוצהר ומגבלת גודל התוצאה. ניתן לרשום לכל היותר 256 יכולות.
- **`permission(int $userId): bool`.** חייבת להחזיר בדיוק `true` כדי לאשר גישה. מזהה המשתמש הוא של בעל האסימון; לעולם אל תקראו מצב סשן (session state).
- **`execute(int $userId, stdClass $args): array`.** הפרמטר `$args` כבר מאומת מול `input_schema`. אכפו הרשאות ברמת האובייקט בעצמכם. החזירו מערך אסוציאטיבי התואם בדיוק ל-`output_schema`; רשימה, שדה נוסף, או יותר מ-1 MB של JSON הופכים לשגיאת `INVALID_RESULT`. זרקו `AbilitiesError` עבור כשל הגלוי ללקוח, כגון `NOT_FOUND`.
- **אובייקטים ריקים.** PHP מקודדת `[]` כמערך JSON. בכל מקום שבו סכמת הפלט מצהירה על `object`, בכל עומק, הרישום מתייחס ל-`[]` כאל אובייקט ריק ושולח `{}`; גם `new stdClass()` עובד. רשימה שאינה ריקה לעולם אינה נחשבת לאובייקט ונכשלת עם `INVALID_RESULT`. מפת `properties` ריקה בסכמה יכולה להיות `[]` או `new stdClass()`; שתיהן מתפרסמות כ-`{}`.
- **בידוד כשלים.** כל תוסף נרשם לתוך עותק טיוטה שנשמר רק אם הפונקציה שלכם חוזרת בצורה תקינה. אם היא זורקת חריגה, אף אחת מהיכולות שלכם אינה נרשמת, והכשל נרשם ביומן.

יכולות מתוספים מתחילות כמוסתרות. מנהל המערכת חושף אותן בלשונית Abilities בקונסולה, ועמודת Required Realm מציגה עבורן "Set by the plugin".

## מודל אבטחה

- **Bearer בלבד.** `api.php` ו-`mcp.php` מקבלים אסימון אישי בכותרת `Authorization` ותו לא. הם משמיטים עוגיות, את `$_POST` ואת `$_REQUEST` לפני טעינת Cacti, והורסים את ההפעלה ש-Cacti מתחילה, כך שהתחברות בדפדפן לעולם אינה מעניקה גישת API.
- **מעקף CSRF.** מנגנון ההגנה מפני CSRF של Cacti דוחה בקשת JSON מסוג POST שאין בה אסימון CSRF של Cacti, שאף לקוח MCP אינו יכול לשלוח. עבור שתי נקודות קצה אלו בלבד, התוסף משנה את שם שיטת הבקשה לפני טעינת Cacti ומשחזר אותו לאחר מכן, כך שהמנגנון מדלג עליהן. הדבר בטוח מכיוון ש-CSRF מגן על בקשות שדפדפן מאמת באמצעות עוגיות, ונקודות קצה אלו אינן מקבלות שום זהות מבוססת עוגייה: דף חוצה-אתרים אינו יכול לצרף את אסימון ה-Bearer. דפי המסוף שומרים על הגנת CSRF מלאה. מעקף זה הוא זמני, עד ש-Cacti תציע החרגה נתמכת; ראו `lib/bootstrap.php`.
- **בדיקת Origin.** ב-`mcp.php`, אם לבקשה יש כותרת `Origin`, עליה להתאים בדיוק לסכמה, למארח ולפורט של כתובת ה-URL הציבורית של Cacti, אחרת הבקשה נדחית עם `ORIGIN_NOT_ALLOWED`. בקשה ללא כותרת `Origin`, שזו הדרך שבה לקוחות שאינם דפדפנים מתחברים, מותרת. בדיקה זו מונעת מדף אינטרנט להפעיל את נקודת הקצה מתוך הדפדפן של מבקר. `api.php` אינו מחיל בדיקה זו.
- **קריאה בלבד.** הרישום דוחה כל יכולת שאינה לקריאה בלבד, לא-הרסנית ואידמפוטנטית.
- **חשיפה והרשאות חלות יחד.** יכולת חייבת להיות חשופה ובעל האסימון חייב להחזיק בהרשאת ה-realm שלה. אם לא ניתן לקרוא את טבלת החשיפה, כל היכולות מוסתרות במקום לחזור לברירות המחדל.
- **יכולות מוסתרות, לא מוכרות וחסרות הרשאה נראות אותו הדבר.** לקוח אינו יכול להבחין בין יכולת שאינה קיימת לבין יכולת מוסתרת או כזו שלמשתמש שלו אסור להשתמש בה: הגילוי משמיט אותה והביצוע מחזיר `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **אסימונים.** נשמרים כגיבובי SHA-256, מוצגים פעם אחת, תמיד בעלי תוקף מוגבל, ניתנים לביטול, ונדחים כאשר הבעלים מושבת או מאבד את ה-realm.
- **ביקורת.** `plugin_mcp_audit` מתעדת מזהה בקשה, מזהה אסימון, מזהה משתמש, יכולת, תוצאה (`started`, `succeeded`, `failed`, `denied`, `rejected`) וחותמות זמן. היא לעולם אינה מתעדת ארגומנטים, תוצאות או ערכי אסימונים. יכולת רצה רק לאחר שנכתבת שורת ה-`started` שלה; אם טבלת הביקורת אינה זמינה, הקריאה נכשלת עם `UNAVAILABLE` ואינה רצה. קריאה שנדחתה לפני ריצתה נרשמת כשורה אחת: `denied` עבור יכולת לא מוכרת, מוסתרת או חסרת הרשאה, ו-`rejected` עבור ארגומנטים שנכשלים באימות הסכימה. יצירה וביטול של אסימונים מהמסוף, מדף My MCP Tokens ומה-CLI מתועדים כ-`mcp-token-create` ו-`mcp-token-revoke` עם התוצאה `succeeded`, וביטול מתועד רק עבור אסימון שהיה פעיל. פעולות גילוי, וכן קריאה שהשדה `arguments` שלה אינו אובייקט JSON, אינן נרשמות ביומן.
- **יומן כשלים.** כשל בלתי צפוי, `INVALID_RESULT` או טבלת ביקורת שאינה זמינה כותבים שורה אחת ליומן של Cacti תחת facility `MCP`: מזהה היכולת, סיבה קבועה ומחלקת החריגה. הודעות, ארגומנטים ואסימונים לעולם אינם נרשמים ביומן.
- **ה-poller הראשי בלבד.** שתי נקודות הקצה, שני דפי המסוף ו-`tokens.php` מסרבים לפעול בכל מקום אחר.

## מחזור חיים

השבתת התוסף חוסמת את שתי נקודות הקצה. הסרת ההתקנה מבטלת את כל האסימונים ושומרת את שלוש הטבלאות (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) לצורכי שימור נתונים; התקנה מחדש אינה מפעילה מחדש אסימון שבוטל. גבו את הטבלאות יחד עם מסד הנתונים של Cacti והחילו מדיניות שימור ביקורת מחוץ לתוסף.

## פיתוח ובדיקות

הבדיקות הן סקריפטים פשוטים של PHP שרצים ללא Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

מערכת ה-CI מבצעת בדיקת תחביר ל-PHP ומריצה את הסקריפטים ב-`tests/` (כל אחד מהם מופיע ב-`.github/workflows/ci.yml`) על גרסאות PHP 8.2 עד 8.5, ולאחר מכן בונה את ארכיון ההתקנה `mcp/` ואת סכום הביקורת שלו. בדיקות שנוגעות ב-Cacti משתמשות ב-fixtures בגבול הפונקציות המסייעות של Cacti; הן אינן בודקות התקנת Cacti מלאה.

### בדיקות אינטגרציה

הפקודה `tests/integration/run.sh 1.2.31` או `tests/integration/run.sh develop` מתקינה את התוסף לתוך סביבת Cacti אמיתית במכולות ומריצה מולו בדיקות חיות. היא דורשת Docker עם Compose מגרסה v2.23.1 ואילך, git ו-openssl. המשתנה `KEEP=1` משאיר את המחסנית פועלת לצורכי ניפוי שגיאות. מערכת ה-CI מריצה זאת מדי לילה ולפי דרישה, ולא על בקשות משיכה.

## לוקליזציה

Cacti MCP כולל קטלוגי GNU gettext מהודרים תחת `locales/po/` ו-`locales/LC_MESSAGES/` וקובצי README מתורגמים תחת `docs/i18n/` עבור אנגלית ועוד 47 אזורים (19 אזורי Broad Tier 1, 15 אזורים באפריקה, 10 אזורים באסיה, וכן בוסנית, קרואטית וסרבית), תוך שימוש בתחום הטקסט `mcp` (`locales/po/mcp.pot`). Cacti טוענת את הקטלוג התואם באופן אוטומטי כאשר תמיכה בשפות מופעלת.

## תרומה לפרויקט

בקשות משיכה מופנות לענף `develop`. שמרו על קוד הייצור תואם ל-PHP 8.2 והשתמשו בסגנון של Cacti: טאבים, מחרוזות במירכאות בודדות, ופונקציות העזר של Cacti למסד נתונים והרשאות. הוסיפו בדיקות עבור שינויים באימות קלט, בהרשאות או בהתנהגות הפרוטוקול, וחתמו על קומיטים באמצעות `git commit -s`. תאמו שינויים ב-HTTP API עם [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## רישיון

כל הזכויות שמורות (C) 2026 Thomas Vincent. מופץ תחת הרישיון הציבורי הכללי של GNU, גרסה 2 ומעלה. ראו [רישיון](../../../LICENSE).
