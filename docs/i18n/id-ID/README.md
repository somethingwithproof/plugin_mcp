<!-- Source: README.md; SHA256: a0711b045d0578dd0c89eaf784f90b80493821faa5ae168442580bacbce74154 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kaktus dengan perisai. Temukan. Otorisasi. Jalankan.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lisensi: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP adalah plugin Cacti yang memungkinkan klien AI membaca data Cacti Anda
melalui operasi bernama yang difilter berdasarkan izin, yang disebut kemampuan
(*abilities*). Plugin ini menyajikannya melalui dua cara langsung dari plugin itu
sendiri: titik akhir MCP (`mcp.php`, Streamable HTTP) dan API HTTP bergaya AIP
(`api.php`). Cacti tetap memegang kendali atas otorisasi dan eksekusi. Klien
tidak pernah melakukan kueri langsung ke basis data; klien hanya dapat memanggil
kemampuan yang diekspos oleh administrator dan diizinkan oleh realm Cacti milik
pemilik token.

Pembuat plugin dapat mendaftarkan kemampuan baca-saja (*read-only*) milik mereka
sendiri melalui kait `abilities_register`, dan kemampuan tersebut akan muncul di
klien MCP sebagai alat (*tools*) tanpa perlu menulis kode protokol.

**Status: prarilis, versi 0.1.0.** Belum ada rilis bertag.

Tersedia saat ini:

- Sembilan kemampuan bawaan baca-saja yang mencakup versi sistem, perangkat,
  situs, poller, pohon grafik (*graph trees*), grafik, sumber data (*data
  sources*), serta bagian akhir log Cacti yang dibatasi dan disensor.
- Token akses pribadi (`cmcp_pat_...`) sebagai satu-satunya kredensial.
- Konsol Management > MCP: mengekspos atau menyembunyikan kemampuan, membuat dan
  mencabut token, serta membaca log audit.
- Management > My MCP Tokens: pengguna mengelola token mereka sendiri, melihat
  aktivitas mereka, dan melihat alat apa saja yang dapat digunakan oleh token
  mereka.
- MCP melalui Streamable HTTP, revisi protokol `2026-07-28` dan `2025-11-25`,
  hanya untuk alat (*tools*).

Belum tersedia saat ini:

- Masuk menggunakan OAuth 2.1. Konektor terkelola yang tidak dapat mengirimkan
  token pribadi, seperti konektor kustom ChatGPT dan claude.ai, tidak dapat
  terhubung sebelum fitur ini tersedia. Fitur ini direncanakan sebagai Rencana 2;
  rencana tersebut belum ditulis.
- Kemampuan tulis (*write abilities*). Hanya kemampuan baca-saja yang dapat
  didaftarkan.

Rancangannya terdapat pada
[spesifikasi desain titik akhir](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
dan urutan pembuatannya terdapat pada [docs/plan.md](../../plan.md).

## Kemampuan bawaan

| ID | Kategori | Argumen | Realm Cacti yang diperlukan |
| --- | --- | --- | --- |
| `cacti-get-system-info` | `system` | tidak ada | 15 |
| `cacti-list-devices` | `inventory` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | `inventory` | wajib `name`, seperti `devices/12` | 3 |
| `cacti-list-sites` | `inventory` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-list-pollers` | `system` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 15 |
| `cacti-list-trees` | `inventory` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 atau 4 |
| `cacti-list-graphs` | `inventory` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 7 atau 5 |
| `cacti-list-data-sources` | `inventory` | opsional `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-clog` | `system` | opsional `lines` (1 hingga 200, bawaan 50), `severity`, `search` | 19 atau 18 |

Setiap panggilan juga memerlukan realm **MCP and Abilities API** untuk pemilik
token, cakupan `abilities:read` (setiap token pribadi memilikinya), dan kemampuan
yang diekspos. Tab Abilities pada konsol menampilkan realm utama yang diperlukan
oleh masing-masing kemampuan bawaan.

Keenam kemampuan `cacti-list-*` mengembalikan halaman hingga 100 item (bawaan 50)
dan `nextPageToken`. Token halaman hanya berlaku untuk `filter` dan `orderBy`
yang sama. `filter` adalah ekspresi AIP-160 berisi perbandingan (`=`, `!=`, `<`,
`<=`, `>`, `>=`) yang digabungkan dengan `AND`, misalnya
`state = "DOWN" AND disabled = false`. `orderBy` menerima daftar kolom yang
dapat diurutkan dan dipisahkan koma, yang masing-masing dapat diikuti secara
opsional oleh `asc` atau `desc`.

| Kemampuan | Kolom filter | Kolom pengurutan |
| --- | --- | --- |
| `cacti-list-devices` | `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, `state` (`UNKNOWN`, `DOWN`, `RECOVERING`, `UP`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-sites` | `displayName`, `city`, `state`, `country`, `timezone`, `alternateId` | `displayName`, `city`, `state`, `country`, `name` |
| `cacti-list-pollers` | `displayName`, `hostname`, `disabled`, `state` (`NEW`, `RUNNING`, `IDLE`, `UNKNOWN`, `DISABLED`, `RECOVERING`, `ERROR`) | `displayName`, `hostname`, `name` |
| `cacti-list-trees` | `displayName`, `enabled` | `displayName`, `name` |
| `cacti-list-graphs` | `title`, `device`, `graphTemplate`, `templateName` | `title`, `templateName`, `name` |
| `cacti-list-data-sources` | `displayName`, `device`, `dataTemplate`, `active` | `displayName`, `name` |

Pembatasan izin dan pengecualian rahasia:

- `cacti-list-devices` dan `cacti-get-device` melakukan kueri melalui fungsi
  `get_allowed_devices()` milik Cacti serta mengecualikan string komunitas SNMP,
  frasa sandi, dan kredensial lainnya.
- `cacti-list-trees` melakukan kueri melalui `get_allowed_trees()` (dan memfilter
  dengan `is_tree_allowed()` apabila tersedia); `cacti-list-graphs` melakukan
  kueri melalui `get_allowed_graphs()` (dan memfilter dengan `is_graph_allowed()`
  apabila tersedia).
- `cacti-list-data-sources` membatasi baris ke perangkat yang diizinkan bagi
  pemanggil dari `get_allowed_devices()` (dan `is_device_allowed()` apabila
  tersedia) serta hanya mengembalikan metadata tanpa melakukan kueri ke
  `data_input_data` atau mengekspos nilai input rahasia.
- `cacti-list-pollers` mengecualikan kredensial basis data (`dbpass`, `dbuser`)
  serta kolom kunci dan sertifikat TLS (`dbsslkey`, `dbsslcert`, `dbsslca`).
- `cacti-get-clog` membaca hingga 1 MiB terakhir dari log Cacti yang dikonfigurasi
  (memotong baris individual yang lebih dari 2048 byte), memfilter berdasarkan
  `severity` (`ALL`, `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`,
  `ALERT`, `EMERGENCY`, `FATAL`, `STATS`, `POLLER`, `SYSTEM`; bawaan `ALL`) dan
  `search` yang tidak peka huruf besar/kecil (hingga 256 karakter), lalu
  mengembalikan `lines`, `count`, dan `truncated`. Setiap baris disensor untuk
  token pribadi, header bearer/basic, kata sandi, rahasia, komunitas SNMP, kunci,
  `dbpass`, `dbsslkey`, dan informasi pengguna URL sebelum filter `severity` dan
  `search` dijalankan agar `search` tidak dapat bertindak sebagai peramal rahasia
  (*secret oracle*). Penyensoran gagal secara tertutup (*fail-closed*) dengan
  `[redacted]`, dan log yang tidak dapat dibaca mengembalikan
  `FAILED_PRECONDITION` (`LOG_UNAVAILABLE`).

## Pemasangan

Memerlukan Cacti 1.2.31 atau lebih baru, PHP 8.2 atau lebih baru, serta poller
utama. Autentikasi Cacti harus diaktifkan; plugin menolak untuk melakukan
autentikasi apabila fitur tersebut dinonaktifkan.

Direktori plugin harus dinamai `mcp`, bukan `plugin_mcp`. Slug plugin, nama
realm, domain terjemahan, dan URL semuanya menggunakan `mcp`.

Dari salinan kode sumber:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Hingga rilis bertag tersedia, Anda dapat mengunduh artefak `mcp-plugin` dari
[eksekusi CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
yang berhasil. Artefak tersebut berisi `mcp.tar.gz` dan `SHA256SUMS`.
Verifikasi checksum-nya, lalu ekstrak `mcp.tar.gz` ke dalam direktori `plugins/`
milik Cacti sehingga hasilnya menjadi `plugins/mcp/`. Arsip kode sumber otomatis
GitHub menggunakan nama direktori tingkat atas yang berbeda. Arsip tersebut
tidak menyertakan `docs/` (termasuk tangkapan layar di bawah), `tests/`, dan
`.github/`, sehingga tautan README ke dalam `docs/` berfungsi di GitHub tetapi
tidak pada salinan yang terpasang.

Selanjutnya:

1. Di Plugin Management, pasang dan aktifkan **Cacti MCP**. Administrator yang
   memasang akan menerima realm **MCP Administration** secara otomatis.
2. Di bawah Settings > MCP, atur **Public Cacti URL** ke alamat yang digunakan
   klien, misalnya `https://cacti.example.com/cacti`. HTTPS wajib digunakan
   kecuali untuk `localhost`, `127.0.0.1`, dan `[::1]`. Hingga pengaturan ini
   diisi, `mcp.php` akan merespons dengan HTTP 400 beserta galat JSON-RPC yang
   memiliki `data` berupa `FAILED_PRECONDITION` dan `PUBLIC_URL_REQUIRED`.
   `api.php` tidak membaca pengaturan ini.

   ![Settings > MCP menampilkan kolom Public Cacti URL](../../images/settings-public-url.png)

3. Berikan realm **MCP and Abilities API** kepada setiap pengguna yang akan
   memiliki token. Tidak ada pengguna yang menerimanya secara otomatis.
4. Pastikan server web meneruskan header `Authorization` dan informasi jalur
   (*path info*) ke PHP (lihat di bawah).
5. Buka Management > MCP dan ekspos kemampuan yang ingin Anda perlihatkan kepada
   klien.

**Memutakhirkan dari build pengembangan.** Plugin ini masih berstatus prarilis,
dan tabel-tabelnya berubah selama pengembangan tanpa migrasi. Jika Anda pernah
memasang build sebelumnya, copot pemasangannya dan pasang kembali. Pemasangan
ulang mempertahankan tabel yang sudah ada, jadi hapus terlebih dahulu tabel lama
`plugin_mcp_token`, `plugin_mcp_audit`, dan `plugin_mcp_ability` (serta tabel
setara dari build yang dibuat sebelum perubahan nama). Cadangkan tabel-tabel
tersebut jika Anda memerlukan riwayatnya; token dari build tersebut dicabut saat
pencopotan pemasangan dan tidak diteruskan.

### Server web

Pengaturan Apache yang menghapus `Authorization` sebelum diteruskan ke PHP
memerlukan konfigurasi ini di dalam *virtual host* atau direktori yang relevan,
diikuti dengan muat ulang (*reload*):

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache dengan `mod_php` melayani rute `api.php` tanpa konfigurasi jalur
tambahan.

Rute `api.php` berada pada jalur setelah nama skrip
(`/plugins/mcp/api.php/v1/abilities`), sehingga nginx harus mencocokkan URI di
mana `.php` diikuti oleh jalur lanjutan, memisahkan informasi jalur tersebut,
dan meneruskannya ke PHP. Blok `location ~ \.php$` tidak pernah mencocokkan URL
semacam ini; nginx akan menjawab dengan halaman HTML 404 miliknya sendiri. Pola
lokasi dan dua baris *path-info* di bawah ini telah diverifikasi dengan PHP-FPM;
baris lainnya adalah templat standar:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Sesuaikan baris `include` dan `fastcgi_pass` agar cocok dengan blok yang sudah
melayani Cacti. Jangan tambahkan `try_files $fastcgi_script_name =404;` ke blok
ini: perintah tersebut menghapus `$fastcgi_path_info`, dan `api.php` kemudian
akan menjawab 404 `UNKNOWN_PATH`. Jika konfigurasi Anda memerlukan `try_files`,
simpan nilainya terlebih dahulu dengan `set $path_info $fastcgi_path_info;` dan
teruskan `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` tidak memiliki rute jalur dan tidak memerlukannya.

## Konsol

Management > MCP memiliki tiga tab. Anda memerlukan realm **MCP Administration**.
Tangkapan layar di sini dan di bawah berasal dari build pengembangan Cacti dengan
data contoh.

- **Abilities** mencantumkan setiap kemampuan yang terdaftar beserta plugin,
  kategori, realm yang diperlukan, dan status apakah kemampuan tersebut diekspos.
  Pilih baris lalu pilih Expose atau Hide; Anda perlu mengonfirmasi sebelum
  perubahan diterapkan. Kemampuan bawaan `cacti-*` diekspos secara bawaan.
  Kemampuan dari plugin lain berstatus tersembunyi pada awalnya, sehingga
  memasang suatu plugin tidak akan pernah memublikasikan apa pun hingga
  administrator memutuskannya. Eksposur hanya mempersempit akses: pengguna tetap
  memerlukan realm dari kemampuan tersebut.

  ![Tab Abilities mencantumkan kemampuan bawaan beserta realm dan status eksposurnya](../../images/console-abilities.png)
- **Tokens** mencantumkan token beserta pemilik, pembuat, waktu pembuatan, waktu
  kedaluwarsa, penggunaan terakhir, dan status (Active, Expired, Revoked). Pilih
  baris lalu pilih Revoke untuk mencabutnya. Token yang telah dicabut tidak
  dapat digunakan lagi. Create Token membuat token baru.

  ![Tab Tokens mencantumkan token dengan pemilik, kedaluwarsa, penggunaan terakhir, dan status, di atas formulir Create Token](../../images/console-tokens.png)
- **Audit** mencantumkan baris audit dari yang terbaru, serta menyediakan filter
  berdasarkan pengguna, kemampuan, dan hasil.

  ![Tab Audit mencantumkan panggilan dengan pengguna, token, kemampuan, dan hasil, beserta filter](../../images/console-audit.png)

## Token

Token pribadi membaca Cacti sebagai pemiliknya. Formatnya berupa `cmcp_pat_`
yang diikuti oleh 64 karakter heksadesimal huruf kecil dan membawa satu cakupan
`abilities:read`. Apa yang dapat dilihat ditentukan oleh realm Cacti dan izin
perangkat pemiliknya, bukan oleh token itu sendiri. Pemiliknya harus berupa
pengguna aktif yang memiliki realm **MCP and Abilities API**.

Token selalu dibuat untuk suatu pengguna, memiliki masa kedaluwarsa, dan dapat
dicabut:

- **Konsol.** Management > MCP > Tokens > Create Token. Masa berlaku adalah 1
  hingga 365 hari dengan bawaan 90 hari. Token dibuat oleh server dan ditampilkan
  satu kali pada halaman respons, jadi segera salin ke pengelola rahasia Anda.
  Anda dapat membuat token untuk diri Anda sendiri. Pembuatan token untuk
  pengguna lain juga memerlukan realm Users/Groups, karena token tersebut
  membaca Cacti sebagai pengguna bersangkutan.
- **My MCP Tokens.** Setiap pengguna dengan realm MCP and Abilities API dapat
  mengelola token mereka sendiri; lihat di bawah.
- **Baris perintah.** `tokens.php` hanya berjalan dari CLI, sebagai akun OS yang
  dapat mengadministrasikan Cacti. Skrip ini mengambil token dari lingkungan
  (*environment*) agar nilainya tidak pernah muncul di baris perintah atau di
  dalam daftar proses. Masa berlaku adalah 1 hingga 365 hari dengan bawaan 30
  hari. Pembuatan dan pencabutan token melalui CLI dicatat dalam audit seperti
  halnya di konsol, dengan pemilik token sebagai aktor karena CLI tidak
  memiliki pengguna Cacti, sehingga baris audit tidak menandai tindakan tersebut
  sebagai berasal dari CLI. `--list` mencetak setiap token sebagai JSON (ID,
  pemilik, cakupan, stempel waktu, penanda pencabutan) dan tidak pernah mencetak
  nilai token; `--help` menampilkan cara penggunaan.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Token tidak dapat dibuat untuk akun tamu (*guest*), untuk pengguna yang
dinonaktifkan, atau untuk pengguna tanpa realm **MCP and Abilities API**, baik
dari konsol, baris perintah, maupun My MCP Tokens. Cacti menyimpan pengaturan
tamu sebagai nama pengguna atau ID pengguna, dan plugin ini dapat menyelesaikan
keduanya. Token yang pemiliknya berubah menjadi akun tamu akan berhenti bekerja
pada permintaan berikutnya.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) tidak memerlukan
realm administrasi: halaman ini dicakup oleh realm **MCP and Abilities API**,
dan entri menunya hanya muncul bagi pengguna yang memilikinya. Halaman ini
selalu bertindak atas nama pengguna yang sedang masuk. Menu Cacti merupakan
bagian dari konsol, sehingga pengguna tanpa akses konsol dapat menjangkau
halaman ini melalui alamatnya secara langsung.

![Tab My Tokens mencantumkan token pengguna yang sedang masuk dan formulir pembuatan](../../images/my-tokens.png)

- **Tokens** mencantumkan daftar token Anda, membuat token baru (1 hingga 365
  hari, bawaan 90, ditampilkan satu kali pada respons), dan mencabut token Anda
  sendiri. Anda tidak dapat melihat atau mencabut token milik orang lain.
- **Activity** mencantumkan tindakan yang Anda lakukan, dimulai dari yang
  terbaru: panggilan yang dilakukan dengan token Anda dan perubahan token yang
  Anda buat.
- **Available Tools** mencantumkan kemampuan yang dapat digunakan oleh token
  Anda saat ini, beserta ID, nama, dan deskripsi setiap kemampuan. Daftar ini
  mengikuti izin Cacti Anda dan pengaturan eksposur yang dipilih administrator.

  ![Daftar Available Tools menampilkan ID, nama, dan deskripsi setiap kemampuan](../../images/my-tools.png)

Pemasangan yang dilakukan sebelum halaman ini ada memiliki daftar berkas realm
tanpa `mcp_tokens.php`. Proses pemasangan mendaftarkan daftar tersebut; daftar
ini tidak diperbarui oleh pengaktifan atau penonaktifan plugin. Copot dan pasang
kembali plugin tersebut, lalu berikan kembali realm-nya, karena Cacti menghapus
pemberian realm saat suatu plugin dicopot pemasangannya.

Basis data hanya menyimpan hash SHA-256 dari token, sehingga token yang hilang
tidak dapat dipulihkan; cabut token tersebut dan buat token baru. Rotasi token
bekerja dengan cara yang sama: buat token baru, alihkan klien, lalu cabut token
yang lama. Token yang kedaluwarsa, token yang dicabut, pemilik yang dinonaktifkan,
atau realm yang hilang masing-masing akan gagal pada permintaan berikutnya. Token
hanya diterima dalam header `Authorization: Bearer`; token pada string kueri
atau isi (*body*) permintaan tidak akan diterima.

## Menghubungkan klien

Gunakan titik akhir MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, dengan
token di dalam header `Authorization: Bearer`. Simpan token di variabel
lingkungan atau pengelola rahasia dan referensikan dari konfigurasi klien alih-alih
menuliskan nilainya langsung ke dalam berkas.

### Claude Code

Letakkan titik akhir tersebut dalam berkas `.mcp.json` proyek yang mereferensikan token berdasarkan nama.
Claude Code mengekspansi `${VAR}` pada `url` dan `headers`, sehingga berkas tersebut tidak menyimpan rahasia apa pun dan
aman untuk di-commit. Ekspor `CACTI_MCP_TOKEN` di lingkungan yang menjalankan Claude Code.

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

Anda juga dapat menambahkannya melalui baris perintah:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Dengan tanda kutip ganda, shell Anda akan mengekspansi `$CACTI_MCP_TOKEN` terlebih dahulu, sehingga nilai token
dituliskan ke dalam berkas konfigurasi untuk `--scope` yang dipilih (`local`, `user`, atau
`project`; bawaan `local`). Jangan gunakan bentuk tersebut dengan `--scope project`, dan jauhkan
berkas tersebut dari kontrol versi. Sebaiknya gunakan referensi `.mcp.json` di atas. Claude Code
membaca beberapa variabel kredensial (seperti `ANTHROPIC_AUTH_TOKEN`) sebagai nilai kosong pada
`url` dan `headers` jarak jauh; `CACTI_MCP_TOKEN` bukan salah satunya. Sumber:
[Dokumentasi MCP Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot di VS Code

Gunakan `.mcp.json` di akar ruang kerja (atau berkas pengguna `~/.copilot/mcp-config.json`).
Berkas asli Copilot ini menggunakan objek tingkat atas `mcpServers` dan referensi variabel lingkungan `${NAME}`
pada nilai header:

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

Ekspor `CACTI_MCP_TOKEN` di lingkungan yang menjalankan VS Code. Berkas asli Copilot
tidak mendukung permintaan input (`inputs`). Penyiapan terpandu VS Code menolak nilai `${...}`,
jadi tambahkan header `Authorization` dengan menyunting berkas tersebut secara langsung, bukan melalui
alur terpandu. Penyiapan terpandu hanya menawarkan berkas di akar ruang kerja
ketika pengaturan eksperimental `chat.mcp.workspaceRootConfig.enabled` diaktifkan. Lihat
[Referensi konfigurasi MCP VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Lawas: `.vscode/mcp.json`.** VS Code menyatakan bahwa konfigurasi Copilot baru tidak boleh
menggunakan `.vscode/mcp.json` atau `mcp.json` profil; keduanya termasuk dalam
harness Local yang sudah usang, yang akan dihapus pada Februari 2027. Jika Anda masih menggunakannya,
format yang dikelola editor menggunakan kunci tingkat atas `servers` dan dapat meminta input token:

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

### Klien yang hanya mendukung stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) adalah adaptor opsional
yang berjalan sebagai server MCP stdio lokal dan memanggil API HTTP plugin ini. Gunakan adaptor ini untuk
klien yang tidak dapat terhubung ke server HTTP jarak jauh. Adaptor ini memerlukan token pribadi yang sama
dan berkomunikasi dengan `api.php`.

### Perilaku MCP

Titik akhir ini hanya menyajikan perkakas: setiap kemampuan yang diekspos dan diizinkan menjadi perkakas yang dinamai berdasarkan
ID-nya, beserta skema input dan output serta anotasi baca-saja
(`openWorldHint` bernilai `false`). Titik akhir ini menangani `initialize`, `server/discover`, `ping`,
`tools/list`, dan `tools/call`. Titik akhir tidak menyimpan sesi, tidak mengirimkan `Mcp-Session-Id`
(dan mengabaikan header tersebut jika diterima), serta tidak menerima batch JSON-RPC. Pesan
tanpa `id` merupakan notifikasi dan mendapatkan HTTP 202 tanpa badan respons. Hanya `POST` yang
diizinkan.

- **Revisi.** Permintaan yang membawa `io.modelcontextprotocol/protocolVersion` di dalam
  `params._meta` harus menyebutkan `2026-07-28`; nilai lainnya akan mendapatkan galat `-32022`. Permintaan
  tersebut juga harus membawa header `Mcp-Protocol-Version`, `Mcp-Method`, dan (untuk
  `tools/call`) `Mcp-Name` yang sesuai, atau jawabannya adalah galat `-32020`. Permintaan lainnya
  diperlakukan sebagai `2025-11-25`: `initialize` menjawab dengan revisi tersebut, dan pada
  metode lainnya header `Mcp-Protocol-Version`, jika dikirim, harus bernilai `2025-11-25`,
  `2025-06-18`, atau `2025-03-26`.
- **Galat perkakas.** Galat kemampuan, termasuk argumen yang tidak cocok dengan
  skema atau nilai `arguments` yang bukan merupakan objek JSON, dikembalikan sebagai hasil perkakas
  dengan `isError: true` dan galat AIP-193 di dalam `structuredContent`, bukan sebagai
  galat protokol.
- **Galat protokol.** Kegagalan yang bukan merupakan galat perkakas berupa objek galat JSON-RPC
  (kode `-32000` dengan status dan alasan di `data`, atau kode standar):
  Public Cacti URL yang tidak ada, `Origin` yang ditolak, permintaan saat plugin dinonaktifkan
  atau pada poller jarak jauh, serta galat server tak terduga (`-32603`, dengan detail
  ditulis ke log Cacti, bukan ke respons). Pemeriksaan permintaan yang berjalan lebih awal (405,
  413, 415) dan kegagalan autentikasi (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`)
  tetap menggunakan badan AIP-193 yang dijelaskan di bawah bagian API HTTP.

## API HTTP

URL dasar: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Kontraknya tersedia
di [openapi.json](../../../openapi.json).

| Metode dan jalur | Tujuan |
| --- | --- |
| `GET /v1/abilities` | Mencantumkan daftar kemampuan yang diizinkan. Kueri: `pageSize`, `pageToken`, dan `filter` dalam bentuk `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Membaca satu kemampuan. |
| `POST /v1/abilities/{id}:execute` | Menjalankannya. Badan permintaan persis berupa `{"arguments": {...}}`. Respons berupa `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Galat mengikuti AIP-193: objek `error` dengan `code`, `message`, `status`, dan
`details` yang membawa `ErrorInfo` dengan domain `cacti.net` dan `reason` yang stabil.
Masalah argumen menambahkan detail `BadRequest` yang menyebutkan nama bidang terkait. Badan permintaan
dibatasi hingga 64 KB, dan hasil hingga 1 MB. Kedua titik akhir hanya merespons pada poller
utama dan mengembalikan `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) saat plugin dinonaktifkan
atau server bukan poller utama.

| HTTP | Nilai `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN`, `LOG_UNAVAILABLE` |
| 401 | `INVALID_TOKEN` (juga mengirimkan `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (mengirimkan `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Menulis kemampuan (penulis plugin)

Plugin Cacti yang diaktifkan mendaftarkan kemampuan dari sebuah fungsi yang ditautkan ke
hook `abilities_register`, biasanya di dalam `plugin_<slug>_install()`:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Fungsi tersebut menerima `AbilitiesRegistrar` yang dibatasi lingkupnya untuk plugin tersebut. Nilai kembaliannya
diabaikan.

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

Aturan-aturan yang seluruhnya diberlakukan saat pendaftaran:

- **ID.** Sebuah ID harus cocok dengan `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, panjang maksimal 64
  karakter, dan harus diawali dengan slug plugin diikuti tanda hubung: `acme-` di atas.
  Slug adalah nama direktori plugin, sehingga direktori seperti `my_plugin` tidak dapat
  mendaftarkan apa pun. Direktori plugin bernama `cacti` ditolak; ruang nama
  tersebut milik kemampuan bawaan.
- **Definisi.** Persis kunci-kunci berikut: `label`, `description` (hingga 4096 byte),
  `category`, `input_schema`, `output_schema`, `annotations`, `permission`,
  `execute`. Kategori harus sudah ada: gunakan kategori bawaan (`inventory`,
  `system`) atau daftarkan milik Anda sendiri dengan `registerCategory()`, yang ID-nya unik di seluruh
  plugin dan cocok dengan `^[a-z][a-z0-9-]{0,31}$`.
- **Hanya baca-saja.** `annotations` harus persis `readOnly: true`,
  `destructive: false`, `idempotent: true`. Nilai selain itu akan memicu pengecualian.
- **Skema.** `input_schema` dan `output_schema` masing-masing harus memiliki `type`
  tingkat atas `object`. Dialeknya ringkas dan menerapkan fail-closed. Objek harus tertutup
  (`additionalProperties: false`, dengan `properties` tersedia); tipe lainnya adalah
  `integer` dan `number` (`minimum`, `maximum`), `string` (`minLength`,
  `maxLength`, `enum`, `pattern`), `boolean`, dan `array` (yang memerlukan `items` dan
  `maxItems`). Sebuah tipe dapat
  dibuat nullable sebagai `['string', 'null']`. String argumen secara bawaan paling banyak
  4096 karakter; string hasil hanya dibatasi oleh `maxLength` yang dideklarasikan
  dan batas ukuran hasil. Paling banyak 256 kemampuan dapat didaftarkan.
- **`permission(int $userId): bool`.** Harus mengembalikan tepat `true` untuk mengizinkan.
  ID pengguna tersebut adalah milik pemilik token; jangan pernah membaca status sesi.
- **`execute(int $userId, stdClass $args): array`.** `$args` sudah divalidasi
  terhadap `input_schema`. Terapkan izin tingkat objek secara mandiri. Kembalikan
  larik asosiatif yang persis cocok dengan `output_schema`; daftar (list), bidang tambahan,
  atau JSON lebih dari 1 MB akan menjadi galat `INVALID_RESULT`. Lemparkan
  `AbilitiesError` untuk kegagalan yang terlihat oleh klien, seperti `NOT_FOUND`.
- **Objek kosong.** PHP mengodekan `[]` sebagai larik JSON. Di mana pun skema output
  mendeklarasikan `object`, pada kedalaman berapa pun, registri memperlakukan `[]` sebagai objek kosong
  dan mengirimkan `{}`; `new stdClass()` juga berfungsi. Daftar yang tidak kosong tidak pernah dihitung sebagai
  objek dan gagal dengan `INVALID_RESULT`. Peta `properties` yang kosong dalam skema
  dapat berupa `[]` atau `new stdClass()`; keduanya dipublikasikan sebagai `{}`.
- **Isolasi kegagalan.** Setiap plugin mendaftar ke dalam salinan sementara yang disimpan
  hanya jika fungsi Anda kembali secara normal. Jika fungsi melemparkan pengecualian, tidak ada satu pun kemampuan Anda
  yang terdaftar, dan kegagalan tersebut dicatat dalam log.

Kemampuan dari plugin berawal dalam keadaan tersembunyi. Administrator menampilkannya pada
tab Abilities konsol, dan kolom Required Realm menampilkan "Set by the plugin"
untuk kemampuan tersebut.

## Model keamanan

- **Hanya bearer.** `api.php` dan `mcp.php` hanya menerima token pribadi pada header
  `Authorization` dan tidak menerima metode lain. Keduanya membuang cookie, `$_POST`, dan
  `$_REQUEST` sebelum Cacti dimuat serta menghancurkan sesi yang dimulai oleh Cacti, sehingga login
  peramban tidak pernah memberikan akses API.
- **Solusi sementara CSRF.** Penjaga CSRF Cacti menolak JSON POST yang tidak memiliki token
  CSRF Cacti, yang memang tidak dapat dikirim oleh klien MCP mana pun. Khusus untuk kedua endpoint ini, plugin
  mengubah nama metode permintaan sebelum Cacti dimuat dan mengembalikannya setelah itu, sehingga
  penjaga melewatinya. Hal ini aman karena CSRF melindungi permintaan yang diautentikasi oleh peramban
  menggunakan cookie, sedangkan endpoint ini tidak menerima identitas cookie: halaman
  lintas situs tidak dapat melampirkan token bearer. Halaman konsol tetap mempertahankan perlindungan CSRF
  penuh. Solusi sementara ini bersifat temporer, hingga Cacti menyediakan pengecualian yang
  didukung; lihat `lib/bootstrap.php`.
- **Pemeriksaan origin.** Pada `mcp.php`, jika permintaan memiliki header `Origin`, nilainya harus
  sama persis dengan skema, host, dan port dari Public Cacti URL, atau permintaan
  ditolak dengan `ORIGIN_NOT_ALLOWED`. Permintaan tanpa header `Origin`, yang merupakan cara
  klien non-peramban terhubung, tetap diizinkan. Hal ini mencegah halaman web mengendalikan
  endpoint dari peramban pengunjung. `api.php` tidak menerapkan pemeriksaan ini.
- **Hanya baca-saja.** Pendaftaran menolak kemampuan apa pun yang tidak bersifat baca-saja,
  non-destruktif, dan idempoten.
- **Eksposur dan realm keduanya berlaku.** Sebuah kemampuan harus diekspos dan pemilik token
  harus memiliki realm-nya. Jika tabel eksposur tidak dapat dibaca, setiap kemampuan
  disembunyikan alih-alih kembali ke nilai bawaan.
- **Tersembunyi, tidak dikenal, dan tidak diizinkan tampak sama.** Klien tidak dapat membedakan
  kemampuan yang tidak ada dari kemampuan yang tersembunyi atau yang tidak boleh digunakan oleh
  penggunanya: penemuan menghilangkannya dan eksekusi mengembalikan `NOT_FOUND`
  (`ABILITY_NOT_FOUND`).
- **Token.** Disimpan sebagai hash SHA-256, ditampilkan satu kali, selalu memiliki masa kedaluwarsa, dapat dicabut, dan
  ditolak ketika pemilik dinonaktifkan atau kehilangan realm.
- **Audit.** `plugin_mcp_audit` mencatat ID permintaan, ID token, ID pengguna, kemampuan,
  hasil (`started`, `succeeded`, `failed`, `denied`, `rejected`), dan stempel waktu.
  Tabel ini tidak pernah mencatat argumen, hasil eksekusi, atau nilai token. Suatu kemampuan hanya berjalan setelah
  baris `started`-nya ditulis; jika tabel audit tidak tersedia, pemanggilan gagal
  dengan `UNAVAILABLE` dan tidak dijalankan. Pemanggilan yang ditolak sebelum berjalan dicatat sebagai satu baris: `denied`
  untuk kemampuan yang tidak dikenal, tersembunyi, atau tidak diizinkan, serta `rejected` untuk argumen yang gagal memenuhi
  skema. Pembuatan dan pencabutan token dari konsol, My MCP Tokens, dan CLI
  dicatat sebagai `mcp-token-create` dan `mcp-token-revoke` dengan hasil `succeeded`, dan
  pencabutan hanya dicatat untuk token yang sebelumnya aktif. Penemuan, serta pemanggilan yang nilai
  `arguments`-nya bukan objek JSON, tidak dicatat dalam log.
- **Log kegagalan.** Kegagalan tak terduga, `INVALID_RESULT`, atau tabel audit yang tidak tersedia
  menulis satu baris ke log Cacti dengan fasilitas `MCP`: ID kemampuan, alasan
  tetap, dan kelas pengecualian. Pesan, argumen, dan token tidak pernah dicatat dalam log.
- **Hanya poller utama.** Kedua endpoint, kedua halaman konsol, dan `tokens.php` menolak untuk
  beroperasi di tempat lain.

## Siklus hidup

Menonaktifkan plugin akan memblokir kedua endpoint. Mencopot pemasangan akan mencabut setiap token dan
mempertahankan ketiga tabel (`plugin_mcp_token`, `plugin_mcp_audit`,
`plugin_mcp_ability`) untuk keperluan retensi; memasang ulang tidak mengaktifkan kembali token yang telah
dicabut. Cadangkan tabel-tabel tersebut bersama basis data Cacti dan terapkan kebijakan retensi audit
di luar plugin.

## Pengembangan dan pengujian

Rangkaian pengujian mencakup skrip PHP biasa di `tests/` ditambah pengujian unit
PHPUnit di `tests/Unit/` dan analisis statis PHPStan (level 6), semuanya berjalan
tanpa instalasi Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
composer install
composer phpstan
composer test
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI berjalan pada PHP 8.2 hingga 8.5: pekerjaan `test` yang melakukan linting sintaks
PHP (`php -l`) dan menjalankan 13 skrip pengujian PHP biasa yang tercantum di
`.github/workflows/ci.yml`, pekerjaan `quality` yang menjalankan `composer phpstan`
dan `composer test`, serta pekerjaan `package` yang membangun arsip `mcp/` yang
dapat dipasang (tidak termasuk berkas pengembangan dan pengujian yang tercantum
di `.gitattributes`) beserta `SHA256SUMS`-nya. Pengujian yang menyentuh Cacti
menggunakan fikstur pada batas helper Cacti; pengujian ini tidak menjalankan
instalasi Cacti secara penuh.

### Pengujian integrasi

`tests/integration/run.sh 1.2.31` atau `tests/integration/run.sh develop` memasang
plugin ke dalam Cacti sungguhan di dalam kontainer dan menjalankan pemeriksaan langsung terhadapnya. Pengujian ini memerlukan Docker
dengan Compose v2.23.1 atau yang lebih baru, git, dan openssl. `KEEP=1` membiarkan stack tetap berjalan untuk penelusuran kesalahan. CI menjalankannya
setiap malam dan sesuai permintaan, bukan pada pull request.

## Pelokalan

Cacti MCP menyertakan katalog GNU gettext terkompilasi di bawah `locales/po/` dan `locales/LC_MESSAGES/`
serta README terlokalisasi di bawah `docs/i18n/` untuk bahasa Inggris ditambah 47 lokal (19 lokal Broad Tier 1, 15 lokal Afrika, 10 lokal Asia, serta Bosnia, Kroasia, dan Serbia), menggunakan domain teks `mcp` (`locales/po/mcp.pot`).
Cacti memuat katalog yang sesuai secara otomatis ketika dukungan bahasa diaktifkan.

## Kontribusi

Pull request ditujukan ke `develop`. Pastikan kode produksi tetap kompatibel dengan PHP 8.2 dan
gunakan gaya Cacti: tab, string berkutip tunggal, serta helper basis data dan
izin milik Cacti. Tambahkan pengujian untuk perubahan pada validasi, otorisasi, atau perilaku
protokol, dan sertakan sign-off pada commit dengan `git commit -s`. Koordinasikan perubahan pada HTTP
API dengan [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Lisensi

Hak Cipta (C) 2026 Thomas Vincent. Dirilis di bawah GNU General Public
License, versi 2 atau yang lebih baru. Lihat [LICENSE](../../../LICENSE).
