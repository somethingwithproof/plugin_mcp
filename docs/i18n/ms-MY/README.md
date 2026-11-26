<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus dengan perisai. Temui. Beri Keizinan. Laksanakan.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lesen: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP ialah pemalam Cacti yang membolehkan klien AI membaca data Cacti anda
melalui operasi bernama dan ditapis kebenaran yang dipanggil keupayaan. Ia
menyediakannya dalam dua cara daripada pemalam itu sendiri: titik akhir MCP
(`mcp.php`, Streamable HTTP) dan API HTTP bergaya AIP (`api.php`). Cacti kekal
bertanggungjawab terhadap pengesahan keizinan dan pelaksanaan. Klien tidak
pernah menanyakan pangkalan data; ia hanya boleh memanggil keupayaan yang
didedahkan oleh pentadbir dan yang dibenarkan oleh realm Cacti pemilik token.

Pengarang pemalam boleh mendaftarkan keupayaan baca sahaja mereka sendiri melalui
cangkuk `abilities_register`, dan ia muncul kepada klien MCP sebagai alat tanpa
sebarang kod protokol.

**Status: prapelancaran, versi 0.1.0.** Tiada keluaran bertag buat masa ini.

Tersedia hari ini:

- Keupayaan terbina dalam baca sahaja untuk versi sistem dan inventori peranti.
- Token akses peribadi (`cmcp_pat_...`) sebagai satu-satunya kelayakan.
- Konsol Management > MCP: dedahkan atau sembunyikan keupayaan, cipta dan batal
  token, baca log audit.
- Management > My MCP Tokens: pengguna mengurus token mereka sendiri, melihat
  aktiviti mereka, dan melihat alat yang boleh digunakan oleh token mereka.
- MCP melalui Streamable HTTP, semakan protokol `2026-07-28` dan `2025-11-25`,
  alat sahaja.

Belum tersedia lagi:

- Log masuk OAuth 2.1. Penyambung terhos yang tidak dapat menghantar token
  peribadi, seperti penyambung tersuai ChatGPT dan claude.ai, tidak dapat
  bersambung sehingga ia wujud. Ia dirancang sebagai Pelan 2; pelan itu belum
  ditulis lagi.
- Keupayaan tulis. Hanya keupayaan baca sahaja boleh didaftarkan.

Reka bentuknya terdapat dalam
[spesifikasi reka bentuk titik akhir](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
dan jujukan binaannya terdapat dalam [docs/plan.md](../../plan.md).

## Keupayaan terbina dalam

| ID | Argumen | Realm Cacti yang diperlukan |
| --- | --- | --- |
| `cacti-get-system-info` | tiada | 15 |
| `cacti-list-devices` | pilihan `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | wajib `name`, seperti `devices/12` | 3 |

Setiap panggilan juga memerlukan realm **MCP and Abilities API** bagi pemilik
token, skop `abilities:read` (setiap token peribadi memilikinya), dan keupayaan
yang didedahkan. Tab Abilities pada konsol menunjukkan realm yang diperlukan oleh
setiap keupayaan terbina dalam.

- `cacti-list-devices` mengembalikan halaman sehingga 100 peranti (lalai 50) dan
  `nextPageToken`. Token halaman hanya sah untuk `filter` dan `orderBy` yang
  sama. `filter` ialah ungkapan AIP-160 bagi perbandingan yang digabungkan dengan
  `AND`, contohnya `state = "DOWN" AND disabled = false`. Medan penapis ialah
  `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`,
  `externalId`, dan `state`. `orderBy` menerima `displayName`, `hostname`, atau
  `name`, setiap satunya boleh diikuti secara pilihan dengan `desc`.
- Pertanyaan peranti melalui `get_allowed_devices()` Cacti, jadi pengguna hanya
  melihat peranti yang akan dipaparkan oleh Cacti kepada mereka.
- Medan peranti mengecualikan rentetan komuniti SNMP, frasa laluan dan kelayakan
  lain.

## Pemasangan

Memerlukan Cacti 1.2.31 atau lebih baharu, PHP 8.2 atau lebih baharu, dan
pengumpul utama. Pengesahan Cacti mesti didayakan; pemalam enggan mengesahkan
apabila ia dimatikan.

Direktori pemalam mesti dinamakan `mcp`, bukan `plugin_mcp`. Slug pemalam, nama
realm, domain terjemahan dan URL semuanya menggunakan `mcp`.

Daripada salinan sumber:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Sehingga keluaran bertag wujud, anda sebaliknya boleh memuat turun artifak
`mcp-plugin` daripada
[larian CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
yang berjaya. Ia mengandungi `mcp.tar.gz` dan `SHA256SUMS`. Sahkan hasil tambah
semak, kemudian ekstrak `mcp.tar.gz` di dalam direktori `plugins/` Cacti supaya
hasilnya ialah `plugins/mcp/`. Arkib sumber automatik GitHub menggunakan nama
direktori peringkat atas yang berbeza. Arkib ini mengecualikan `docs/` (termasuk
tangkapan skrin di bawah), `tests/`, dan `.github/`, jadi pautan README ke dalam
`docs/` berfungsi di GitHub tetapi tidak dalam salinan yang dipasang.

Kemudian:

1. Dalam Plugin Management, pasang dan dayakan **Cacti MCP**. Pentadbir yang
   memasang akan menerima realm **MCP Administration** secara automatik.
2. Di bawah Settings > MCP, tetapkan **Public Cacti URL** kepada alamat yang
   digunakan oleh klien, contohnya `https://cacti.example.com/cacti`. HTTPS
   diperlukan kecuali untuk `localhost`, `127.0.0.1`, dan `[::1]`. Sehingga ini
   ditetapkan, `mcp.php` menjawab HTTP 400 dengan ralat JSON-RPC yang `data`-nya
   ialah `FAILED_PRECONDITION` dan `PUBLIC_URL_REQUIRED`. `api.php` tidak
   membacanya.

   ![Settings > MCP menunjukkan medan Public Cacti URL](../../images/settings-public-url.png)

3. Berikan realm **MCP and Abilities API** kepada setiap pengguna yang akan
   memiliki token. Tiada pengguna menerimanya secara automatik.
4. Pastikan pelayan web menghantar pengepala `Authorization` dan maklumat laluan
   ke PHP (lihat di bawah).
5. Buka Management > MCP dan dedahkan keupayaan yang anda mahu klien lihat.

**Menaik taraf daripada binaan pembangunan.** Pemalam ini ialah prapelancaran,
dan jadualnya berubah semasa pembangunan tanpa migrasi. Jika anda memasang
binaan terdahulu, nyahpasang dan pasang semula. Pemasangan semula mengekalkan
jadual yang sudah wujud, jadi gugurkan jadual lama `plugin_mcp_token`,
`plugin_mcp_audit`, dan `plugin_mcp_ability` terlebih dahulu (dan jadual yang
setara daripada binaan yang dibuat sebelum penamaan semula). Sandarkannya jika
anda memerlukan sejarahnya; token daripada binaan tersebut dibatalkan semasa
nyahpasang dan tidak dibawa ke hadapan.

### Pelayan web

Persediaan Apache yang menanggalkan `Authorization` sebelum PHP memerlukan baris
ini dalam hos maya atau direktori yang berkaitan, diikuti dengan muat semula:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache dengan `mod_php` menyajikan laluan `api.php` tanpa konfigurasi laluan
tambahan.

Laluan `api.php` berada dalam laluan selepas nama skrip
(`/plugins/mcp/api.php/v1/abilities`), jadi nginx mesti memadankan URI di mana
`.php` diikuti dengan laluan tambahan, mengasingkan maklumat laluan, dan
menghantarnya ke PHP. Blok `location ~ \.php$` tidak pernah memadankan URL ini;
nginx menjawab dengan HTML 404 miliknya sendiri. Corak lokasi dan dua baris
maklumat laluan di bawah telah disahkan dengan PHP-FPM; baris lain ialah templat
piawai:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Laraskan baris `include` dan `fastcgi_pass` supaya sepadan dengan blok yang sedia
menyajikan Cacti. Jangan tambah `try_files $fastcgi_script_name =404;` pada blok
ini: ia mengosongkan `$fastcgi_path_info`, dan `api.php` kemudiannya menjawab
404 `UNKNOWN_PATH`. Jika konfigurasi anda memerlukan `try_files`, simpan nilainya
terlebih dahulu dengan `set $path_info $fastcgi_path_info;` dan hantarkan
`fastcgi_param PATH_INFO $path_info;`.

`mcp.php` tidak mempunyai laluan path dan tidak memerlukannya.

## Konsol

Management > MCP mempunyai tiga tab. Anda memerlukan realm **MCP Administration**.
Tangkapan skrin di sini dan di bawah adalah daripada binaan pembangunan Cacti
dengan data contoh.

- **Abilities** menyenaraikan setiap keupayaan berdaftar berserta pemalamnya,
  kategori, realm yang diperlukan, dan sama ada ia didedahkan. Pilih baris dan
  pilih Expose atau Hide; anda perlu mengesahkan sebelum perubahan digunakan.
  Keupayaan terbina dalam `cacti-*` didedahkan secara lalai. Keupayaan daripada
  pemalam lain bermula dalam keadaan tersembunyi, jadi pemasangan pemalam tidak
  pernah menerbitkan apa-apa sehingga pentadbir membuat keputusan. Pendedahan
  hanya mengecilkan akses: pengguna masih memerlukan realm keupayaan tersebut.

  ![Tab Abilities menyenaraikan keupayaan terbina dalam berserta realm dan keadaan pendedahannya](../../images/console-abilities.png)
- **Tokens** menyenaraikan token berserta pemilik, pencipta, tarikh cipta,
  tamat tempoh, penggunaan terakhir, dan keadaan (Active, Expired, Revoked).
  Pilih baris dan pilih Revoke untuk membatalkannya. Token yang dibatalkan tidak
  boleh digunakan lagi. Create Token menghasilkan token baharu.

  ![Tab Tokens menyenaraikan token berserta pemilik, tamat tempoh, penggunaan terakhir, dan keadaan, di atas borang Create Token](../../images/console-tokens.png)
- **Audit** menyenaraikan baris audit, terkini dahulu, dan menapis mengikut
  pengguna, keupayaan, dan hasil.

  ![Tab Audit menyenaraikan panggilan berserta pengguna, token, keupayaan, dan hasil, dengan penapis](../../images/console-audit.png)

## Token

Token peribadi membaca Cacti sebagai pemiliknya. Ia berbentuk `cmcp_pat_` diikuti
oleh 64 aksara perenambelasan huruf kecil dan membawa satu skop sahaja iaitu
`abilities:read`. Apa yang boleh dilihatnya ditentukan oleh realm Cacti dan
kebenaran peranti pemiliknya, bukan oleh token. Pemilik mestilah pengguna yang
didayakan dan memegang realm **MCP and Abilities API**.

Token sentiasa dicipta untuk pengguna, mempunyai tempoh luput, dan boleh
dibatalkan:

- **Konsol.** Management > MCP > Tokens > Create Token. Tempoh hayat ialah 1
  hingga 365 hari dan lalainya 90. Token dijana oleh pelayan dan dipaparkan
  sekali sahaja pada halaman respons, jadi salin ke dalam pengurus rahsia anda
  dengan segera. Anda boleh mencipta token untuk diri anda sendiri. Mencipta
  token untuk pengguna lain juga memerlukan realm Users/Groups, kerana token
  tersebut membaca Cacti sebagai pengguna itu.
- **My MCP Tokens.** Mana-mana pengguna dengan realm MCP and Abilities API boleh
  mengurus token mereka sendiri; lihat di bawah.
- **Baris perintah.** `tokens.php` hanya berjalan daripada CLI, sebagai akaun OS
  yang boleh mentadbir Cacti. Ia mengambil token daripada persekitaran supaya
  nilainya tidak pernah muncul pada baris perintah atau dalam senarai proses.
  Tempoh hayat ialah 1 hingga 365 hari dan lalainya 30. Penciptaan dan pembatalan
  token melalui CLI diaudit seperti konsol, dengan pemilik token sebagai pelaku
  kerana CLI tidak mempunyai pengguna Cacti, jadi baris audit tidak menandakan
  tindakan itu datang daripada CLI. `--list` mencetak setiap token sebagai JSON
  (ID, pemilik, skop, cap masa, bendera dibatalkan) dan tidak sekali-kali nilai
  token; `--help` menunjukkan penggunaan.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Token tidak boleh dicipta untuk akaun tetamu, untuk pengguna yang dinyahdayakan,
atau untuk pengguna tanpa realm **MCP and Abilities API**, daripada konsol,
baris perintah, atau My MCP Tokens. Cacti menyimpan tetapan tetamu sebagai nama
pengguna atau ID pengguna, dan pemalam menyelesaikan kedua-duanya. Token yang
pemiliknya menjadi akaun tetamu berhenti berfungsi pada permintaan seterusnya.

### Token MCP Saya

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) tidak memerlukan realm
pentadbiran: ia dilindungi oleh realm **MCP and Abilities API**, dan entri menu
hanya muncul untuk pengguna yang memegangnya. Halaman ini sentiasa bertindak ke
atas pengguna yang log masuk. Menu Cacti adalah sebahagian daripada konsol, jadi
pengguna tanpa akses konsol mencapai halaman melalui alamatnya.

![Tab My Tokens menyenaraikan token pengguna yang log masuk dan borang cipta](../../images/my-tokens.png)

- **Tokens** menyenaraikan token anda, mencipta satu token (1 hingga 365 hari,
  lalai 90, dipaparkan sekali dalam respons), dan membatalkan token anda
  sendiri. Anda tidak boleh melihat atau membatalkan token orang lain.
- **Activity** menyenaraikan tindakan yang anda lakukan, terkini dahulu:
  panggilan yang dibuat dengan token anda dan perubahan token yang anda buat.
- **Available Tools** menyenaraikan keupayaan yang boleh digunakan oleh token
  anda sekarang, berserta ID, nama, dan penerangan setiap keupayaan. Ia
  mengikut kebenaran Cacti anda dan tetapan pendedahan yang dipilih oleh
  pentadbir.

  ![Senarai Available Tools menunjukkan ID, nama, dan penerangan setiap keupayaan](../../images/my-tools.png)

Pemasangan yang dibuat sebelum halaman ini wujud mempunyai senarai fail realm
tanpa `mcp_tokens.php`. Pemasangan mendaftarkan senarai itu; ia tidak dikemas
kini dengan mendayakan atau menyahdayakan pemalam. Nyahpasang dan pasang semula
pemalam, kemudian berikan realm semula, kerana Cacti mengalih keluar pemberian
realm apabila pemalam dinyahpasang.

Pangkalan data hanya menyimpan cincangan SHA-256 bagi token tersebut, jadi token
yang hilang tidak dapat dipulihkan; batalkannya dan cipta yang lain. Penggiliran
adalah sama: cipta token baharu, tukar klien, kemudian batalkan yang lama. Token
yang tamat tempoh, token yang dibatalkan, pemilik yang dinyahdayakan, atau realm
yang hilang masing-masing akan gagal pada permintaan seterusnya. Token hanya
diterima dalam pengepala `Authorization: Bearer`; token dalam rentetan
pertanyaan atau isi tidak diterima.

## Sambungkan klien

Gunakan titik akhir MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, dengan
token dalam pengepala `Authorization: Bearer`. Simpan token dalam pemboleh ubah
persekitaran atau pengurus rahsia dan rujuk daripada konfigurasi klien berbanding
menulis nilainya ke dalam fail.

### Claude Code

Letakkan titik akhir dalam `.mcp.json` projek yang merujuk token mengikut nama.
Claude Code mengembangkan `${VAR}` dalam `url` dan `headers`, jadi fail tersebut tidak mengandungi rahsia dan
selamat untuk dikomit. Eksport `CACTI_MCP_TOKEN` dalam persekitaran yang memulakan Claude Code.

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

Anda juga boleh menambahkannya daripada baris perintah:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Dengan petikan berganda, shell anda mengembangkan `$CACTI_MCP_TOKEN` terlebih dahulu, jadi nilai token
ditulis ke dalam fail konfigurasi untuk `--scope` yang dipilih (`local`, `user`, atau
`project`; lalai `local`). Jangan gunakan bentuk itu dengan `--scope project`, dan jauhkan
fail tersebut daripada kawalan versi. Utamakan rujukan `.mcp.json` di atas. Claude Code
membaca beberapa pemboleh ubah kelayakan (seperti `ANTHROPIC_AUTH_TOKEN`) sebagai kosong dalam
`url` dan `headers` jauh; `CACTI_MCP_TOKEN` bukan salah satu daripadanya. Sumber:
[Dokumentasi MCP Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot dalam VS Code

Gunakan `.mcp.json` akar ruang kerja (atau fail pengguna `~/.copilot/mcp-config.json`).
Fail natif Copilot ini menggunakan objek peringkat atas `mcpServers` dan rujukan pemboleh ubah
persekitaran `${NAME}` dalam nilai pengepala:

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

Eksport `CACTI_MCP_TOKEN` dalam persekitaran yang memulakan VS Code. Fail natif Copilot
tidak menyokong gesaan `inputs`. Persediaan berpandu VS Code menolak nilai `${...}`,
jadi tambahkan pengepala `Authorization` dengan mengedit fail, bukan melalui
aliran berpandu. Persediaan berpandu menawarkan fail akar ruang kerja
hanya apabila tetapan eksperimen `chat.mcp.workspaceRootConfig.enabled` dihidupkan. Lihat
[rujukan konfigurasi MCP VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Legasi: `.vscode/mcp.json`.** VS Code menyatakan bahawa konfigurasi Copilot baharu tidak sepatutnya
menggunakan `.vscode/mcp.json` atau profil `mcp.json`; fail tersebut tergolong dalam abah-abah
Local yang telah ditamatkan penggunaannya, yang akan dialih keluar pada Februari 2027. Jika anda masih menggunakannya,
format terurus editor mengambil kunci peringkat atas `servers` dan boleh menggesa untuk token:

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

### Klien yang hanya menyokong stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) ialah penyesuai pilihan
yang berjalan sebagai pelayan MCP stdio tempatan dan memanggil API HTTP pemalam. Gunakannya untuk
klien yang tidak dapat menyambung ke pelayan HTTP jauh. Ia memerlukan token peribadi
yang sama dan berkomunikasi dengan `api.php`.

### Kelakuan MCP

Titik akhir hanya menyajikan alatan: setiap keupayaan yang didedahkan dan dibenarkan ialah alat yang dinamakan mengikut
ID-nya, dengan skema input dan outputnya serta anotasi baca sahaja
(`openWorldHint` ialah `false`). Ia mengendalikan `initialize`, `server/discover`, `ping`,
`tools/list`, dan `tools/call`. Ia tidak menyimpan sesi, tidak menghantar `Mcp-Session-Id`
(dan mengabaikan yang diterimanya), serta tidak menerima kelompok JSON-RPC. Mesej
tanpa `id` ialah pemberitahuan dan mendapat HTTP 202 tanpa isi. Hanya `POST`
dibenarkan.

- **Semakan.** Permintaan yang membawa `io.modelcontextprotocol/protocolVersion` dalam
  `params._meta` mesti menamakan `2026-07-28`; apa-apa selainnya mendapat ralat `-32022`. Permintaan
  sedemikian juga mesti membawa pengepala `Mcp-Protocol-Version`, `Mcp-Method`, dan (untuk
  `tools/call`) `Mcp-Name` yang sepadan, atau jawapannya ialah ralat `-32020`. Permintaan lain
  dianggap sebagai `2025-11-25`: `initialize` menjawab dengan semakan itu, dan pada mana-mana
  kaedah lain pengepala `Mcp-Protocol-Version`, jika dihantar, mestilah `2025-11-25`,
  `2025-06-18`, atau `2025-03-26`.
- **Ralat alat.** Ralat keupayaan, termasuk argumen yang tidak sepadan dengan
  skema atau nilai `arguments` yang bukan objek JSON, dikembalikan sebagai keputusan alat
  dengan `isError: true` dan ralat AIP-193 dalam `structuredContent`, bukan sebagai
  ralat protokol.
- **Ralat protokol.** Kegagalan yang bukan ralat alat ialah objek ralat JSON-RPC
  (kod `-32000` dengan status dan sebab dalam `data`, atau kod standard): ketiadaan
  URL Awam Cacti, `Origin` yang ditolak, permintaan semasa pemalam dilumpuhkan
  atau pada pengumpul jauh, dan ralat pelayan yang tidak dijangka (`-32603`, dengan butiran
  ditulis ke log Cacti, bukan respons). Semakan permintaan yang dijalankan terlebih dahulu (405,
  413, 415) dan kegagalan pengesahan (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  mengekalkan isi AIP-193 yang diterangkan di bawah API HTTP.

## API HTTP

URL asas: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Kontrak berada
dalam [openapi.json](../../../openapi.json).

| Kaedah dan laluan | Tujuan |
| --- | --- |
| `GET /v1/abilities` | Senaraikan keupayaan yang dibenarkan. Pertanyaan: `pageSize`, `pageToken`, dan `filter` dalam bentuk `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Baca satu keupayaan. |
| `POST /v1/abilities/{id}:execute` | Jalankannya. Isinya ialah tepat `{"arguments": {...}}`. Responsnya ialah `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Ralat mengikut AIP-193: objek `error` dengan `code`, `message`, `status`, dan
`details` yang membawa `ErrorInfo` dengan domain `cacti.net` dan `reason` yang stabil.
Masalah argumen menambah butiran `BadRequest` yang menamakan medan tersebut. Isi permintaan
dihadkan kepada 64 KB, dan keputusan kepada 1 MB. Kedua-dua titik akhir hanya menjawab pada pengumpul
utama dan mengembalikan `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) apabila pemalam dilumpuhkan
atau pelayan bukan pengumpul utama.

| HTTP | Nilai `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (juga menghantar `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (menghantar `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Tulis keupayaan (pengarang pemalam)

Pemalam Cacti yang didayakan mendaftarkan keupayaan daripada fungsi yang dilampirkan pada
cangkuk `abilities_register`, biasanya dalam `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Fungsi ini menerima `AbilitiesRegistrar` yang diskopkan kepada pemalam tersebut. Nilai
pulangannya diabaikan.

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

Peraturannya, kesemuanya dikuatkuasakan semasa pendaftaran:

- **ID.** ID sepadan dengan `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, mempunyai maksimum 64
  aksara, dan mesti bermula dengan slug pemalam diikuti tanda sempang: `acme-` di atas.
  Slug ialah nama direktori pemalam, jadi direktori seperti `my_plugin` tidak boleh
  mendaftarkan apa-apa. Direktori pemalam bernama `cacti` ditolak; ruang nama
  itu milik terbina dalam.
- **Takrif.** Tepat kunci-kunci ini: `label`, `description` (sehingga 4096 bait),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Kategori mesti sudah wujud: gunakan yang terbina dalam (`inventory`,
  `system`) atau daftarkan kategori anda sendiri dengan `registerCategory()`, yang ID-nya unik merentas
  semua pemalam dan sepadan dengan `^[a-z][a-z0-9-]{0,31}$`.
- **Baca sahaja semata-mata.** `annotations` mestilah tepat `readOnly: true`,
  `destructive: false`, `idempotent: true`. Apa-apa selainnya akan melontar ralat.
- **Skema.** `input_schema` dan `output_schema` masing-masing mesti mempunyai `type` `object`
  peringkat atas. Dialeknya kecil dan gagal secara tertutup. Objek mestilah tertutup
  (`additionalProperties: false`, dengan `properties` hadir); jenis lain ialah
  `integer` dan `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, dan `array` (yang memerlukan `items` dan
  `maxItems`). Sesuatu jenis boleh dijadikan
  boleh nol sebagai `['string', 'null']`. Rentetan argumen secara lalai mempunyai maksimum
  4096 aksara; rentetan keputusan hanya dihadkan oleh `maxLength` yang diisytiharkan
  dan had saiz keputusan. Maksimum 256 keupayaan boleh didaftarkan.
- **`permission(int $userId): bool`.** Mesti mengembalikan tepat `true` untuk membenarkan. ID
  pengguna ialah milik pemilik token; jangan sekali-kali membaca keadaan sesi.
- **`execute(int $userId, stdClass $args): array`.** `$args` telah disahkan
  terhadap `input_schema`. Kuatkuasakan keizinan peringkat objek sendiri. Kembalikan
  tatasusunan bersekutu yang sepadan dengan `output_schema` secara tepat; senarai, medan tambahan,
  atau lebih daripada 1 MB JSON akan menjadi ralat `INVALID_RESULT`. Lontar
  `AbilitiesError` untuk kegagalan yang boleh dilihat oleh klien, seperti `NOT_FOUND`.
- **Objek kosong.** PHP mengekod `[]` sebagai tatasusunan JSON. Di mana-mana skema output
  mengisytiharkan `object`, pada sebarang kedalaman, registri menganggap `[]` sebagai objek kosong
  dan menghantar `{}`; `new stdClass()` juga berfungsi. Senarai bukan kosong tidak pernah dikira sebagai
  objek dan gagal dengan `INVALID_RESULT`. Peta `properties` kosong dalam skema
  boleh berupa `[]` atau `new stdClass()`; kedua-duanya diterbitkan sebagai `{}`.
- **Pengasingan kegagalan.** Setiap pemalam mendaftar ke dalam salinan sementara yang disimpan
  hanya jika fungsi anda kembali secara normal. Jika ia melontar ralat, tiada satu pun keupayaan anda
  didaftarkan, dan kegagalan tersebut dilogkan.

Keupayaan daripada pemalam bermula dalam keadaan tersembunyi. Pentadbir mendedahkannya pada
tab Abilities konsol, dan lajur Required Realm memaparkan "Set by the plugin"
untuknya.

## Model keselamatan

- **Pembawa sahaja.** `api.php` dan `mcp.php` menerima token peribadi dalam pengepala
  `Authorization` dan tiada yang lain. Kedua-duanya menggugurkan kuki, `$_POST`, dan
  `$_REQUEST` sebelum Cacti dimuatkan serta memusnahkan sesi yang dimulakan oleh Cacti,
  supaya log masuk pelayar tidak pernah memberikan akses API.
- **Penyelesaian sementara CSRF.** Pengawal CSRF Cacti menolak JSON POST yang tiada token
  CSRF Cacti, yang tidak dapat dihantar oleh mana-mana klien MCP. Untuk kedua-dua titik akhir
  ini sahaja, pemalam menamakan semula kaedah permintaan sebelum Cacti dimuatkan dan
  memulihkannya selepas itu, supaya pengawal melangkaunya. Ini selamat kerana CSRF melindungi
  permintaan yang disahkan oleh pelayar dengan kuki, dan titik akhir ini tidak menerima sebarang
  identiti kuki: halaman rentas tapak tidak dapat melampirkan token pembawa. Halaman konsol
  mengekalkan perlindungan CSRF penuh. Penyelesaian sementara ini bersifat sementara sehingga
  Cacti menawarkan pengecualian yang disokong; lihat `lib/bootstrap.php`.
- **Semakan asal.** Pada `mcp.php`, jika permintaan mempunyai pengepala `Origin`, ia mestilah
  sepadan tepat dengan skema, hos, dan port URL Cacti Awam, atau permintaan akan ditolak
  dengan `ORIGIN_NOT_ALLOWED`. Permintaan tanpa pengepala `Origin`, iaitu cara klien bukan
  pelayar menyambung, adalah dibenarkan. Ini menghalang halaman web daripada mengawal titik
  akhir daripada pelayar pelawat. `api.php` tidak menggunakan semakan ini.
- **Baca sahaja.** Pendaftaran menolak sebarang keupayaan yang bukan baca sahaja,
  tidak merosakkan, dan idempoten.
- **Pendedahan dan realm kedua-duanya terpakai.** Sesuatu keupayaan mesti didedahkan dan
  pemilik token mesti memegang realmnya. Jika jadual pendedahan tidak dapat dibaca, setiap
  keupayaan akan disembunyikan dan bukannya kembali kepada tetapan lalai.
- **Tersembunyi, tidak diketahui, dan tidak dibenarkan kelihatan sama.** Klien tidak dapat
  membezakan keupayaan yang tidak wujud daripada keupayaan yang tersembunyi atau yang tidak
  boleh digunakan oleh penggunanya: penemuan menggugurkannya dan pelaksanaan mengembalikan
  `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Token.** Disimpan sebagai cincangan SHA-256, dipaparkan sekali sahaja, sentiasa tamat
  tempoh, boleh dibatalkan, dan ditolak apabila pemilik dilumpuhkan atau kehilangan realm.
- **Audit.** `plugin_mcp_audit` merekodkan ID permintaan, ID token, ID pengguna, keupayaan,
  hasil (`started`, `succeeded`, `failed`, `denied`, `rejected`), dan cap masa. Ia tidak
  pernah merekodkan argumen, keputusan, atau nilai token. Sesuatu keupayaan hanya dijalankan
  selepas baris `started` ditulis; jika jadual audit tidak tersedia, panggilan akan gagal
  dengan `UNAVAILABLE` dan tidak dijalankan. Panggilan yang ditolak sebelum dijalankan
  direkodkan sebagai satu baris: `denied` untuk keupayaan yang tidak diketahui, tersembunyi,
  atau tidak dibenarkan, manakala `rejected` untuk argumen yang gagal memenuhi skema.
  Penciptaan dan pembatalan token daripada konsol, My MCP Tokens, dan CLI direkodkan sebagai
  `mcp-token-create` dan `mcp-token-revoke` dengan hasil `succeeded`, dan pembatalan hanya
  direkodkan untuk token yang aktif. Penemuan, dan panggilan yang `arguments` bukan objek JSON,
  tidak dilogkan.
- **Log kegagalan.** Kegagalan luar jangka, `INVALID_RESULT`, atau jadual audit yang tidak
  tersedia menulis satu baris ke log Cacti dengan fasiliti `MCP`: ID keupayaan, sebab tetap,
  dan kelas pengecualian. Mesej, argumen, dan token tidak pernah dilogkan.
- **Poller utama sahaja.** Kedua-dua titik akhir, kedua-dua halaman konsol, dan `tokens.php`
  enggan bertindak di tempat lain.

## Kitaran hayat

Melumpuhkan pemalam menyekat kedua-dua titik akhir. Menyahpasang membatalkan setiap token
dan mengekalkan ketiga-tiga jadual (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) untuk pengekalan; memasang semula tidak mengaktifkan semula token yang
telah dibatalkan. Sandarkan jadual bersama pangkalan data Cacti dan gunakan dasar pengekalan
audit di luar pemalam.

## Pembangunan dan ujian

Ujian ialah skrip PHP biasa yang dijalankan tanpa Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI melakukan lint pada PHP dan menjalankan skrip dalam `tests/` (setiap satunya disenaraikan
dalam `.github/workflows/ci.yml`) pada PHP 8.2 hingga 8.5, kemudian membina arkib `mcp/` yang
boleh dipasang dan hasil tambah semaknya. Ujian yang menyentuh Cacti menggunakan lekapan pada
sempadan pembantu Cacti; ia tidak menguji pemasangan Cacti penuh.

### Ujian integrasi

`tests/integration/run.sh 1.2.31` atau `tests/integration/run.sh develop` memasang pemalam ke
dalam Cacti sebenar dalam bekas dan menjalankan semakan langsung terhadapnya. Ia memerlukan
Docker dengan Compose v2.23.1 atau lebih baharu, git dan openssl. `KEEP=1` membiarkan tindanan
terus berjalan untuk penyahpepijatan. CI menjalankannya setiap malam dan atas permintaan, bukan
pada permintaan tarik.

## Penyetempatan

Cacti MCP menyertakan katalog GNU gettext yang telah dikompil di bawah `locales/po/` dan
`locales/LC_MESSAGES/` serta README yang disetempatkan di bawah `docs/i18n/` untuk bahasa
Inggeris serta 44 lokaliti (19 Peringkat 1 Luas, 15 lokaliti Afrika, dan 10 lokaliti Asia),
menggunakan domain teks `mcp` (`locales/po/mcp.pot`). Cacti memuatkan katalog yang sepadan
secara automatik apabila sokongan bahasa didayakan.

## Sumbangan

Permintaan tarik hendaklah dihantar ke `develop`. Pastikan kod pengeluaran serasi dengan PHP
8.2 dan gunakan gaya Cacti: tab, rentetan petikan tunggal, serta pembantu pangkalan data dan
keizinan Cacti. Tambahkan ujian untuk tingkah laku pengesahan, pengizinan, atau protokol yang
diubah, dan tandatangani komit dengan `git commit -s`. Selaraskan perubahan pada API HTTP
dengan [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Lesen

Hak Cipta (C) 2026 Thomas Vincent. Dikeluarkan di bawah GNU General Public License, versi 2
atau lebih baharu. Lihat [LICENSE](../../../LICENSE).
