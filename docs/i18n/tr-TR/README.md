<!-- Source: README.md; SHA256: c12fa4c7d7a3caad21297cb19693610b9639b219c8cac8ef7c53f8a62f5f5a7c -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Bosanski](../bs-BA/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Hrvatski](../hr-HR/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Српски](../sr-RS/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](../vi-VN/README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: kalkanlı bir kaktüs. Keşfet. Yetkilendir. Yürüt.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Lisans: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP, yapay zeka istemcilerinin Cacti verilerinizi yetenek (ability) adı
verilen adlandırılmış, izinlere göre filtrelenmiş işlemler aracılığıyla okumasını
sağlayan bir Cacti eklentisidir. Bunları eklentinin kendi içinden iki yolla sunar:
bir MCP uç noktası (`mcp.php`, Streamable HTTP) ve AIP tarzı bir HTTP API'si
(`api.php`). Yetkilendirme ve yürütme kontrolü Cacti'de kalır. Bir istemci hiçbir
zaman doğrudan veritabanını sorgulamaz; yalnızca bir yöneticinin kullanıma açtığı
ve belirteç sahibinin Cacti yetki alanlarının izin verdiği bir yeteneği
çağırabilir.

Eklenti geliştiricileri `abilities_register` kancası aracılığıyla kendi salt
okunur yeteneklerini kaydedebilir ve bunlar MCP istemcilerine herhangi bir
protokol kodu gerekmeden araç (tool) olarak görünür.

**Durum: ön sürüm, sürüm 0.1.0.** Etiketlenmiş bir sürüm yoktur.

Şu anda mevcut olanlar:

- Sistem sürümleri ve aygıt envanteri için salt okunur yerleşik yetenekler.
- Tek kimlik bilgisi olarak kişisel erişim belirteçleri (`cmcp_pat_...`).
- Yönetim > MCP konsolu: yetenekleri kullanıma açma veya gizleme, belirteç
  oluşturma ve iptal etme, denetim günlüğünü okuma.
- Yönetim > MCP Belirteçlerim: kullanıcılar kendi belirteçlerini yönetir,
  etkinliklerini görür ve belirteçlerinin hangi araçları kullanabileceğini
  görüntüler.
- Streamable HTTP üzerinden MCP, `2026-07-28` ve `2025-11-25` protokol
  revizyonları, yalnızca araçlar.

Henüz mevcut olmayanlar:

- OAuth 2.1 oturum açma. ChatGPT ve claude.ai özel bağlayıcıları gibi kişisel
  belirteç gönderemeyen barındırılan bağlayıcılar, bu özellik eklenene kadar
  bağlanamaz. Plan 2 olarak planlanmıştır; söz konusu plan henüz yazılmamıştır.
- Yazma yetenekleri. Yalnızca salt okunur yetenekler kaydedilebilir.

Tasarım [uç nokta tasarım belirtiminde](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md),
derleme sırası ise [docs/plan.md](../../plan.md) dosyasında yer almaktadır.

## Yerleşik yetenekler

| Kimlik | Argümanlar | Gereken Cacti yetki alanı |
| --- | --- | --- |
| `cacti-get-system-info` | yok | 15 |
| `cacti-list-devices` | isteğe bağlı `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | zorunlu `name`, örneğin `devices/12` | 3 |

Her çağrı ayrıca belirteç sahibi için **MCP ve Yetenekler API'si** yetki alanını,
`abilities:read` kapsamını (her kişisel belirteç buna sahiptir) ve kullanıma
açılmış bir yeteneği gerektirir. Konsolun Yetenekler sekmesi, her yerleşik
yeteneğin hangi yetki alanına ihtiyaç duyduğunu gösterir.

- `cacti-list-devices` en fazla 100 aygıttan oluşan sayfalar (varsayılan 50) ve
  bir `nextPageToken` döndürür. Sayfa belirteci yalnızca aynı `filter` ve
  `orderBy` değerleri için geçerlidir. `filter`, `AND` ile birleştirilmiş
  karşılaştırmalardan oluşan bir AIP-160 ifadesidir; örneğin
  `state = "DOWN" AND disabled = false`. Filtre alanları `displayName`,
  `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId` ve
  `state` şeklindedir. `orderBy`, her biri isteğe bağlı olarak `desc` ile
  izlenebilen `displayName`, `hostname` veya `name` değerlerini alır.
- Aygıt sorguları Cacti'nin `get_allowed_devices()` işlevinden geçer; böylece
  bir kullanıcı yalnızca Cacti'nin kendisine göstereceği aygıtları görür.
- Aygıt alanları SNMP topluluk dizelerini, parolaları ve diğer kimlik
  bilgilerini hariç tutar.

## Kurulum

Cacti 1.2.31 veya üzeri, PHP 8.2 veya üzeri ve ana yoklayıcı (main poller)
gerektirir. Cacti kimlik doğrulaması etkinleştirilmiş olmalıdır; kapalı olduğunda
eklenti kimlik doğrulamayı reddeder.

Eklenti dizininin adı `plugin_mcp` değil `mcp` olmalıdır. Eklenti kısa adı, yetki
alanı adları, çeviri alanı ve URL'lerin tümü `mcp` kullanır.

Bir kaynak kod deposundan kurulum:

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Etiketlenmiş sürümler çıkana kadar, bunun yerine başarılı bir
[CI çalıştırmasından](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml)
`mcp-plugin` yapıtını indirebilirsiniz. Bu yapıt `mcp.tar.gz` ve `SHA256SUMS`
dosyalarını içerir. Sağlama toplamını doğrulayın, ardından `mcp.tar.gz`
dosyasını Cacti'nin `plugins/` dizini içine çıkarın; böylece sonuç
`plugins/mcp/` olur. GitHub'ın otomatik kaynak arşivleri farklı bir üst düzey
dizin adı kullanır. Arşiv `docs/` (aşağıdaki ekran görüntüleri dahil), `tests/`
ve `.github/` dizinlerini dışarıda bırakır; bu nedenle `docs/` içindeki README
bağlantıları GitHub üzerinde çalışır ancak kurulu bir kopyada çalışmaz.

Ardından:

1. Eklenti Yönetimi bölümünden **Cacti MCP** eklentisini kurun ve etkinleştirin.
   Kurulumu yapan yönetici **MCP Yönetimi** yetki alanını otomatik olarak alır.
2. Ayarlar > MCP altında **Genel Cacti URL'si** alanını istemcilerin kullandığı
   adrese ayarlayın; örneğin `https://cacti.example.com/cacti`. `localhost`,
   `127.0.0.1` ve `[::1]` dışında HTTPS zorunludur. Bu ayar yapılana kadar
   `mcp.php`, `data` alanı `FAILED_PRECONDITION` ve `PUBLIC_URL_REQUIRED` olan bir
   JSON-RPC hatasıyla HTTP 400 yanıtı verir. `api.php` bu ayarı okumaz.

   ![Genel Cacti URL'si alanını gösteren Ayarlar > MCP ekranı](../../images/settings-public-url.png)

3. Belirteç sahibi olacak her kullanıcıya **MCP ve Yetenekler API'si** yetki
   alanını verin. Hiçbir kullanıcı bu yetki alanını otomatik olarak almaz.
4. Web sunucusunun `Authorization` üstbilgisini ve yol bilgisini (path info)
   PHP'ye ilettiğinden emin olun (aşağıya bakın).
5. Yönetim > MCP'yi açın ve istemcilerin görmesini istediğiniz yetenekleri
   kullanıma açın.

**Geliştirme derlemesinden yükseltme.** Eklenti ön sürüm aşamasındadır ve
tabloları geliştirme sırasında geçiş (migration) betikleri olmadan değişmiştir.
Daha önceki bir derlemeyi kurduysanız eklentiyi kaldırın ve yeniden kurun.
Yeniden kurulum mevcut tabloları koruduğundan, önce eski `plugin_mcp_token`,
`plugin_mcp_audit` ve `plugin_mcp_ability` tablolarını (ve yeniden adlandırma
öncesinde oluşturulmuş derlemelerdeki eşdeğer tabloları) silin. Geçmişlerine
ihtiyacınız varsa bunları yedekleyin; bu derlemelerden kalan belirteçler
kaldırma sırasında iptal edilir ve aktarılmaz.

### Web sunucusu

PHP öncesinde `Authorization` üstbilgisini kaldıran Apache kurulumları, ilgili
sanal ana bilgisayarda veya dizinde şuna ve ardından bir yeniden yüklemeye
ihtiyaç duyar:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

`mod_php` ile çalışan Apache, `api.php` rotalarını ek bir yol yapılandırması
olmadan sunmuştur.

`api.php` rotaları betik adından sonraki yolda yer alır
(`/plugins/mcp/api.php/v1/abilities`); bu nedenle nginx'in `.php` uzantısını
daha fazla yol bilgisinin izlediği URI'leri eşleştirmesi, yol bilgisini ayırması
ve PHP'ye iletmesi gerekir. `location ~ \.php$` bloğu bu URL'lerle hiçbir zaman
eşleşmez; nginx kendi HTML 404 yanıtını döndürür. Aşağıdaki konum deseni ve iki
yol bilgisi satırı PHP-FPM ile doğrulanmıştır; diğer satırlar standart kalıp
yapılandırmadır:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

`include` ve `fastcgi_pass` satırlarını Cacti'yi halihazırda sunan blokla
eşleşecek şekilde düzenleyin. Bu bloğa `try_files $fastcgi_script_name =404;`
eklemeyin: bu ifade `$fastcgi_path_info` değişkenini temizler ve `api.php` bunun
ardından 404 `UNKNOWN_PATH` yanıtı verir. Yapılandırmanız `try_files`
gerektiriyorsa değeri önce `set $path_info $fastcgi_path_info;` ile kaydedin ve
`fastcgi_param PATH_INFO $path_info;` ile iletin.

`mcp.php` yol rotalarına sahip değildir ve bunlara ihtiyaç duymaz.

## Konsol

Yönetim > MCP üç sekmeye sahiptir. **MCP Yönetimi** yetki alanına ihtiyacınız
vardır. Buradaki ve aşağıdaki ekran görüntüleri örnek veriler içeren bir Cacti
geliştirme derlemesinden alınmıştır.

- **Yetenekler**, kayıtlı her yeteneği eklentisi, kategorisi, gerektirdiği yetki
  alanı ve kullanıma açık olup olmadığıyla birlikte listeler. Satırları seçip
  Kullanıma Aç veya Gizle'yi seçin; değişiklik uygulanmadan önce onaylarsınız.
  Yerleşik `cacti-*` yetenekleri varsayılan olarak kullanıma açıktır. Diğer
  eklentilerden gelen yetenekler gizli olarak başlar; böylece bir eklentiyi
  kurmak, yönetici karar verene kadar hiçbir şeyi yayımlamaz. Kullanıma açma
  yalnızca erişimi daraltır: kullanıcının yine de yeteneğin yetki alanına sahip
  olması gerekir.

  ![Yerleşik yetenekleri, yetki alanlarını ve kullanıma açıklık durumlarını listeleyen Yetenekler sekmesi](../../images/console-abilities.png)
- **Belirteçler**, belirteçleri sahibi, oluşturanı, oluşturulma tarihi, son
  geçerlilik tarihi, son kullanımı ve durumuyla (Etkin, Süresi Dolmuş, İptal
  Edilmiş) listeler. İptal etmek için satırları seçip İptal Et'i seçin. İptal
  edilen belirteçler tekrar kullanılamaz. Belirteç Oluştur yeni bir belirteç
  yapar.

  ![Belirteç Oluştur formunun üzerinde belirteçleri sahibi, son geçerlilik tarihi, son kullanımı ve durumuyla listeleyen Belirteçler sekmesi](../../images/console-tokens.png)
- **Denetim**, denetim satırlarını en yeniden eskiye doğru listeler ve kullanıcı,
  yetenek ve sonuca göre filtreler.

  ![Filtrelerle birlikte çağrıları kullanıcı, belirteç, yetenek ve sonuçla listeleyen Denetim sekmesi](../../images/console-audit.png)

## Belirteçler

Kişisel bir belirteç, Cacti'yi sahibi olarak okur. `cmcp_pat_` önekini izleyen
64 küçük harfli onaltılık karakter biçimindedir ve tek bir `abilities:read`
kapsamını taşır. Neleri görebileceği belirteç tarafından değil, sahibinin Cacti
yetki alanları ve aygıt izinleri tarafından belirlenir. Sahibi, **MCP ve
Yetenekler API'si** yetki alanına sahip etkin bir kullanıcı olmalıdır.

Belirteçler her zaman bir kullanıcı için oluşturulur, süreleri dolar ve iptal
edilebilir:

- **Konsol.** Yönetim > MCP > Belirteçler > Belirteç Oluştur. Yaşam süresi 1 ila
  365 gündür ve varsayılan olarak 90 gündür. Belirteç sunucu tarafından
  oluşturulur ve yanıt sayfasında yalnızca bir kez gösterilir; bu nedenle hemen
  gizli bilgi yöneticinize kopyalayın. Kendiniz için bir belirteç
  oluşturabilirsiniz. Başka bir kullanıcı için belirteç oluşturmak, belirteç
  Cacti'yi o kullanıcı olarak okuduğu için Kullanıcılar/Gruplar yetki alanını da
  gerektirir.
- **MCP Belirteçlerim.** MCP ve Yetenekler API'si yetki alanına sahip herhangi bir
  kullanıcı kendi belirteçlerini yönetebilir; aşağıya bakın.
- **Komut satırı.** `tokens.php` yalnızca CLI'dan, Cacti'yi yönetebilen bir
  işletim sistemi hesabı olarak çalışır. Değerin komut satırında veya işlem
  listesinde asla görünmemesi için belirteci ortamdan alır. Yaşam süresi 1 ila
  365 gündür ve varsayılan olarak 30 gündür. CLI aracılığıyla belirteç oluşturma
  ve iptal etme işlemleri tıpkı konsol gibi denetlenir; CLI'da bir Cacti
  kullanıcısı bulunmadığından aktör olarak belirtecin sahibi kaydedilir, bu
  nedenle denetim satırı eylemi CLI'dan gelmiş olarak işaretlemez. `--list` her
  belirteci JSON olarak yazdırır (kimlik, sahip, kapsamlar, zaman damgaları,
  iptal bayrağı) ve asla belirteç değerini yazdırmaz; `--help` kullanımı
  gösterir.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Konuk hesabı, devre dışı bırakılmış kullanıcılar veya **MCP ve Yetenekler
API'si** yetki alanına sahip olmayan kullanıcılar için konsoldan, komut
satırından veya MCP Belirteçlerim sayfasından belirteç oluşturulamaz. Cacti konuk
ayarını kullanıcı adı veya kullanıcı kimliği olarak saklar ve eklenti her ikisini
de çözer. Sahibi konuk hesabı haline gelen bir belirteç bir sonraki isteğinde
çalışmayı durdurur.

### MCP Belirteçlerim

Yönetim > MCP Belirteçlerim (`plugins/mcp/mcp_tokens.php`) yönetim yetki alanı
gerektirmez: **MCP ve Yetenekler API'si** yetki alanı kapsamındadır ve menü
girişi yalnızca bu yetki alanına sahip kullanıcılar için görünür. Sayfa her zaman
oturum açmış kullanıcı üzerinde işlem yapar. Cacti'nin menüsü konsolun bir
parçasıdır; bu nedenle konsol erişimi olmayan bir kullanıcı sayfaya adresi
üzerinden ulaşır.

![Oturum açmış kullanıcının belirteçlerini ve oluşturma formunu listeleyen Belirteçlerim sekmesi](../../images/my-tokens.png)

- **Belirteçler**, belirteçlerinizi listeler, yeni bir tane oluşturur (1 ila 365
  gün, varsayılan 90, yanıtta bir kez gösterilir) ve kendi belirteçlerinizi
  iptal eder. Başka birinin belirteçlerini göremez veya iptal edemezsiniz.
- **Etkinlik**, gerçekleştirdiğiniz eylemleri en yeniden eskiye doğru listeler:
  belirteçlerinizle yapılan çağrılar ve yaptığınız belirteç değişiklikleri.
- **Kullanılabilir Araçlar**, belirteçlerinizden birinin şu anda
  kullanabileceği yetenekleri her yeteneğin kimliği, adı ve açıklamasıyla
  birlikte listeler. Cacti izinlerinizi ve bir yöneticinin seçtiği kullanıma
  açma ayarlarını izler.

  ![Her yeteneğin kimliğini, adını ve açıklamasını gösteren Kullanılabilir Araçlar listesi](../../images/my-tools.png)

Bu sayfa var olmadan önce yapılmış bir kurulum, `mcp_tokens.php` dosyasını
içermeyen bir yetki alanı dosya listesine sahiptir. Kurulum işlemi listeyi
kaydeder; eklentiyi etkinleştirmek veya devre dışı bırakmak listeyi güncellemez.
Cacti bir eklenti kaldırıldığında yetki alanı izinlerini kaldırdığı için
eklentiyi kaldırıp yeniden kurun, ardından yetki alanlarını tekrar verin.

Veritabanı yalnızca belirtecin SHA-256 karmasını saklar; bu nedenle kaybolan bir
belirteç kurtarılamaz, iptal edip yenisini oluşturun. Döndürme (rotation) de
aynıdır: yeni bir belirteç oluşturun, istemciyi ona geçirin ve ardından eskisini
iptal edin. Süresi dolmuş bir belirteç, iptal edilmiş bir belirteç, devre dışı
bırakılmış bir sahip veya kaybedilmiş bir yetki alanı bir sonraki istekte
başarısız olur. Belirteçler yalnızca `Authorization: Bearer` üstbilgisinde kabul
edilir; sorgu dizesindeki veya gövdedeki bir belirteç kabul edilmez.

## İstemci bağlama

Belirteci bir `Authorization: Bearer` üstbilgisinde göndererek `https://cacti.example.com/cacti/plugins/mcp/mcp.php` MCP uç noktasını kullanın. Belirteç değerini bir dosyaya yazmak yerine bir ortam değişkeninde veya gizli anahtar yöneticisinde tutun ve istemci yapılandırmasından ona başvurun.

### Claude Code

Uç noktayı, belirtece adıyla başvuran bir proje `.mcp.json` dosyasına ekleyin. Claude Code, `url` ve `headers` içinde `${VAR}` ifadelerini genişletir; böylece dosya herhangi bir gizli bilgi içermez ve sürüm kontrolüne gönderilmesi güvenlidir. Claude Code'u başlatan ortamda `CACTI_MCP_TOKEN` değişkenini dışa aktarın.

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

Ayrıca komut satırından da ekleyebilirsiniz:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Çift tırnak kullanıldığında kabuğunuz önce `$CACTI_MCP_TOKEN` değişkenini genişletir; bu nedenle belirteç değeri seçilen `--scope` (`local`, `user` veya `project`; varsayılan `local`) için yapılandırma dosyasına yazılır. Bu biçimi `--scope project` ile kullanmayın ve dosyayı sürüm kontrolünün dışında tutun. Yukarıdaki `.mcp.json` başvurusunu tercih edin. Claude Code, uzak `url` ve `headers` alanlarında bazı kimlik bilgisi değişkenlerini (örneğin `ANTHROPIC_AUTH_TOKEN`) boş olarak okur; `CACTI_MCP_TOKEN` bunlardan biri değildir. Kaynak: [Claude Code MCP belgeleri](https://code.claude.com/docs/en/mcp).

### VS Code'da GitHub Copilot

Çalışma alanı kökündeki bir `.mcp.json` dosyasını (veya kullanıcı dosyası `~/.copilot/mcp-config.json`'ı) kullanın. Copilot'a özgü bu dosyalar üst düzey bir `mcpServers` nesnesi ve üstbilgi değerlerinde `${NAME}` ortam değişkeni başvurularını kullanır:

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

VS Code'u başlatan ortamda `CACTI_MCP_TOKEN` değişkenini dışa aktarın. Yerel Copilot dosyaları `inputs` istemlerini desteklemez. VS Code'un rehberli kurulumu `${...}` değerlerini reddeder; bu nedenle `Authorization` üstbilgisini rehberli akış üzerinden değil, dosyayı düzenleyerek ekleyin. Rehberli kurulum, çalışma alanı kökü dosyasını yalnızca deneysel `chat.mcp.workspaceRootConfig.enabled` ayarı açık olduğunda sunar. Bkz. [VS Code MCP yapılandırma başvurusu](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Eski: `.vscode/mcp.json`.** VS Code, yeni Copilot yapılandırmalarının `.vscode/mcp.json` veya profil `mcp.json` dosyasını kullanmaması gerektiğini belirtir; bunlar Şubat 2027'de kaldırılacak olan kullanım dışı bırakılmış Local ortamına aittir. Yine de kullanıyorsanız, düzenleyici tarafından yönetilen biçim üst düzey bir `servers` anahtarı alır ve belirteci sorabilir:

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

### Yalnızca stdio ile iletişim kuran istemciler

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp), yerel bir stdio MCP sunucusu olarak çalışan ve eklentinin HTTP API'sini çağıran isteğe bağlı bir bağdaştırıcıdır. Uzak bir HTTP sunucusuna bağlanamayan istemciler için kullanın. Aynı kişisel belirteci gerektirir ve `api.php` ile iletişim kurar.

### MCP davranışı

Uç nokta yalnızca araçlar sunar: dışa açılan ve izin verilen her yetenek, kendi kimliğiyle adlandırılan, giriş ve çıkış şemalarına ve salt okunur ek açıklamalara sahip bir araçtır (`openWorldHint` değeri `false` şeklindedir). `initialize`, `server/discover`, `ping`, `tools/list` ve `tools/call` yöntemlerini işler. Oturum tutmaz, `Mcp-Session-Id` göndermez (aldığını da yok sayar) ve JSON-RPC toplu isteklerini kabul etmez. `id` içermeyen bir ileti bildirimdir ve gövdesiz HTTP 202 yanıtı alır. Yalnızca `POST` yöntemine izin verilir.

- **Sürümler.** `params._meta` içinde `io.modelcontextprotocol/protocolVersion` taşıyan bir istek `2026-07-28` değerini belirtmelidir; başka herhangi bir değer `-32022` hatası alır. Bu tür istekler ayrıca eşleşen `Mcp-Protocol-Version`, `Mcp-Method` ve (`tools/call` için) `Mcp-Name` üstbilgilerini de taşımalıdır; aksi halde yanıt `-32020` hatası olur. Diğer istekler `2025-11-25` olarak işlenir: `initialize` bu sürümle yanıt verir ve diğer herhangi bir yöntemde gönderilen bir `Mcp-Protocol-Version` üstbilgisi varsa `2025-11-25`, `2025-06-18` veya `2025-03-26` olmalıdır.
- **Araç hataları.** Şemayla eşleşmeyen bağımsız değişkenler veya JSON nesnesi olmayan bir `arguments` değeri dahil olmak üzere bir yetenek hatası, protokol hatası olarak değil, `isError: true` ve `structuredContent` içinde AIP-193 hatası içeren bir araç sonucu olarak döner.
- **Protokol hataları.** Araç hatası olmayan başarısızlıklar JSON-RPC hata nesneleridir (`data` içinde durum ve neden bilgisini içeren `-32000` kodu veya standart kodlar): eksik Public Cacti URL'si, reddedilen bir `Origin`, eklenti devre dışıyken veya uzak bir poller üzerinde yapılan istek ve beklenmeyen sunucu hataları (`-32603`, ayrıntılar yanıta değil Cacti günlüğüne yazılır). İlk olarak çalışan istek denetimleri (405, 413, 415) ve kimlik doğrulama hataları (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`), HTTP API altında açıklanan AIP-193 gövdesini korur.

## HTTP API

Temel URL: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Sözleşme [openapi.json](../../../openapi.json) dosyasındadır.

| Yöntem ve yol | Amaç |
| --- | --- |
| `GET /v1/abilities` | İzin verilen yetenekleri listeler. Sorgu: `pageSize`, `pageToken` ve `category = "inventory"` biçiminde `filter`. |
| `GET /v1/abilities/{id}` | Bir yeteneği okur. |
| `POST /v1/abilities/{id}:execute` | Çalıştırır. Gövde tam olarak `{"arguments": {...}}` şeklindedir. Yanıt `{"requestId": "...", "result": {...}}` şeklindedir. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Hatalar AIP-193 standardını izler: `cacti.net` etki alanına ve kararlı bir `reason` değerine sahip bir `ErrorInfo` taşıyan `code`, `message`, `status` ve `details` alanlarını içeren bir `error` nesnesi döner. Bağımsız değişken sorunları, alanı adlandıran bir `BadRequest` ayrıntısı ekler. İstek gövdeleri 64 KB ile, sonuçlar ise 1 MB ile sınırlıdır. Her iki uç nokta da yalnızca ana poller üzerinde yanıt verir ve eklenti devre dışı olduğunda veya sunucu ana poller olmadığında `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) döndürür.

| HTTP | `reason` değerleri |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (`WWW-Authenticate: Bearer` üstbilgisini de gönderir) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (`Allow` üstbilgisini gönderir) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Yetenek yazma (eklenti geliştiricileri)

Etkinleştirilmiş bir Cacti eklentisi, genellikle `plugin_<slug>_install()` içinde `abilities_register` kancasına bağladığı bir işlevden yetenekleri kaydeder:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

İşlev, eklenti kapsamındaki bir `AbilitiesRegistrar` nesnesi alır. Dönüş değeri yok sayılır.

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

Tamamı kayıt sırasında uygulanan kurallar:

- **Kimlikler.** Bir kimlik `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$` ifadesiyle eşleşir, en fazla 64 karakterdir ve eklentinin slug değeri ile ardından gelen bir kısa çizgiyle başlamalıdır: yukarıdaki `acme-` gibi. Slug, eklenti dizininin adıdır; bu nedenle `my_plugin` gibi bir dizin hiçbir şey kaydedemez. `cacti` adlı bir eklenti dizini reddedilir; bu ad alanı yerleşik yeteneklere aittir.
- **Tanım.** Tam olarak şu anahtarlar: `label`, `description` (en fazla 4096 bayt), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Kategori halihazırda mevcut olmalıdır: yerleşik bir kategori (`inventory`, `system`) kullanın veya tüm eklentiler arasında benzersiz olan ve `^[a-z][a-z0-9-]{0,31}$` ile eşleşen bir kimliğe sahip kendi kategorinizi `registerCategory()` ile kaydedin.
- **Yalnızca salt okunur.** `annotations` tam olarak `readOnly: true`, `destructive: false`, `idempotent: true` olmalıdır. Başka herhangi bir değer hata fırlatır.
- **Şemalar.** `input_schema` ve `output_schema` şemalarının her biri üst düzeyde `type` olarak `object` değerine sahip olmalıdır. Diyalekt küçüktür ve başarısızlıkta kapalı kalır. Nesneler kapalı olmalıdır (`additionalProperties: false` ve `properties` mevcut olmalıdır); diğer türler `integer` ve `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean` ve `array` (`items` ve `maxItems` gerektirir) türleridir. Bir tür `['string', 'null']` şeklinde null atanabilir yapılabilir. Bağımsız değişken dizeleri varsayılan olarak en fazla 4096 karakterdir; sonuç dizeleri yalnızca bildirilen `maxLength` ve sonuç boyutu sınırı ile kısıtlanır. En fazla 256 yetenek kaydedilebilir.
- **`permission(int $userId): bool`.** İzin vermek için tam olarak `true` döndürmelidir. Kullanıcı kimliği belirteç sahibine aittir; hiçbir zaman oturum durumunu okumayın.
- **`execute(int $userId, stdClass $args): array`.** `$args`, `input_schema`'ya göre önceden doğrulanmıştır. Nesne düzeyindeki izinleri kendiniz uygulayın. `output_schema` ile tam olarak eşleşen bir ilişkisel dizi döndürün; bir liste, fazladan bir alan veya 1 MB'tan büyük JSON, `INVALID_RESULT` hatasına dönüşür. `NOT_FOUND` gibi istemci tarafından görülebilen bir başarısızlık için `AbilitiesError` fırlatın.
- **Boş nesneler.** PHP, `[]` ifadesini JSON dizisi olarak kodlar. Çıkış şemasının herhangi bir derinlikte `object` bildirdiği her yerde kayıt defteri `[]` ifadesini boş nesne olarak değerlendirir ve `{}` gönderir; `new stdClass()` de çalışır. Boş olmayan bir liste hiçbir zaman nesne sayılmaz ve `INVALID_RESULT` ile başarısız olur. Bir şemadaki boş `properties` eşlemi `[]` veya `new stdClass()` olabilir; her ikisi de `{}` olarak yayımlanır.
- **Hata yalıtımı.** Her eklenti, yalnızca işleviniz normal şekilde döndüğünde saklanan bir taslak kopyaya kayıt yapar. Hata fırlatırsa yeteneklerinizin hiçbiri kaydedilmez ve başarısızlık günlüğe yazılır.

Eklentilerden gelen yetenekler gizli olarak başlar. Yönetici bunları konsoldaki Abilities sekmesinden görünür hale getirir ve Required Realm sütununda bunlar için "Set by the plugin" yazar.

## Güvenlik modeli

- **Yalnızca Bearer.** `api.php` ve `mcp.php`, `Authorization` üstbilgisinde yalnızca
  kişisel bir belirteç kabul eder; başka hiçbir kimlik bilgisini kabul etmez. Cacti
  yüklenmeden önce çerezleri, `$_POST` ve `$_REQUEST` değişkenlerini temizler ve
  Cacti'nin başlattığı oturumu sonlandırır; böylece tarayıcı oturumu hiçbir zaman API
  erişimi sağlamaz.
- **CSRF geçici çözümü.** Cacti'nin CSRF koruması, hiçbir MCP istemcisinin
  gönderemeyeceği Cacti CSRF belirtecine sahip olmayan bir JSON POST isteğini reddeder.
  Yalnızca bu iki uç nokta için eklenti, Cacti yüklenmeden önce istek yöntemini
  yeniden adlandırır ve sonrasında geri yükler; böylece koruma bu istekleri atlar.
  CSRF yalnızca tarayıcının çerezlerle kimlik doğruladığı istekleri koruduğu ve bu uç
  noktalar hiçbir çerez kimliğini kabul etmediği için bu yaklaşım güvenlidir: siteler
  arası (cross-site) bir sayfa Bearer belirtecini ekleyemez. Konsol sayfaları tam
  CSRF korumasını korur. Bu geçici çözüm, Cacti desteklenen bir muafiyet sunana
  dek geçerlidir; bkz. `lib/bootstrap.php`.
- **Origin denetimi.** `mcp.php` üzerinde, istekte bir `Origin` üstbilgisi varsa bunun
  Public Cacti URL'sinin şeması, ana makinesi ve bağlantı noktasıyla birebir aynı
  olması gerekir; aksi durumda istek `ORIGIN_NOT_ALLOWED` ile reddedilir. Tarayıcı
  dışı istemcilerin bağlanma biçimi olan `Origin` üstbilgisi içermeyen bir isteğe izin
  verilir. Bu, bir web sayfasının ziyaretçinin tarayıcısı üzerinden uç noktayı
  yönetmesini engeller. `api.php` bu denetimi uygulamaz.
- **Yalnızca salt okunur.** Kayıt işlemi salt okunur, yıkıcı olmayan ve eşgüçlü
  (idempotent) olmayan her yeteneği reddeder.
- **Hem erişime açma hem de yetki alanları uygulanır.** Bir yeteneğin erişime açılmış
  olması ve belirteç sahibinin ilgili yetki alanına (realm) sahip olması gerekir.
  Erişime açma tablosu okunamazsa varsayılanlara dönülmek yerine tüm yetenekler
  gizlenir.
- **Gizli, bilinmeyen ve yetkisiz yetenekler aynı görünür.** Bir istemci, var olmayan
  bir yeteneği gizli olan veya kullanıcısının kullanma yetkisi bulunmayan bir
  yetenekten ayırt edemez: keşif bu yeteneği dışarıda bırakır ve yürütme `NOT_FOUND`
  (`ABILITY_NOT_FOUND`) döndürür.
- **Belirteçler.** SHA-256 karması olarak saklanır, yalnızca bir kez gösterilir, her
  zaman süre sonuna sahiptir, iptal edilebilir ve sahibi devre dışı bırakıldığında
  veya yetki alanını kaybettiğinde reddedilir.
- **Denetim.** `plugin_mcp_audit`; istek kimliğini, belirteç kimliğini, kullanıcı
  kimliğini, yeteneği, sonucu (`started`, `succeeded`, `failed`, `denied`, `rejected`)
  ve zaman damgalarını kaydeder. Hiçbir zaman argümanları, sonuçları veya belirteç
  değerlerini kaydetmez. Bir yetenek yalnızca `started` satırı yazıldıktan sonra
  çalışır; denetim tablosu erişilemez durumdaysa çağrı `UNAVAILABLE` ile başarısız
  olur ve çalıştırılmaz. Çalıştırılmadan önce reddedilen bir çağrı tek satır olarak
  kaydedilir: bilinmeyen, gizli veya yetkisiz bir yetenek için `denied`, şemayı
  karşılamayan argümanlar için `rejected`. Konsoldan, MCP Belirteçlerim'den ve CLI'dan
  yapılan belirteç oluşturma ve iptal işlemleri `mcp-token-create` ve
  `mcp-token-revoke` olarak `succeeded` sonucuyla kaydedilir; iptal yalnızca etkin
  olan bir belirteç için kaydedilir. Keşif ve `arguments` alanı bir JSON nesnesi
  olmayan çağrılar günlüğe kaydedilmez.
- **Hata günlüğü.** Beklenmeyen bir hata, `INVALID_RESULT` veya erişilemeyen bir
  denetim tablosu, Cacti günlüğüne `MCP` tesisiyle (facility) tek bir satır yazar:
  yetenek kimliği, sabit bir neden ve istisna sınıfı. İletiler, argümanlar ve
  belirteçler hiçbir zaman günlüğe kaydedilmez.
- **Yalnızca ana yoklayıcı.** Her iki uç nokta, her iki konsol sayfası ve
  `tokens.php`, başka herhangi bir yerde işlem yapmayı reddeder.

## Yaşam döngüsü

Eklentinin devre dışı bırakılması her iki uç noktayı da engeller. Kaldırılması tüm
belirteçleri iptal eder ve saklama amacıyla üç tabloyu (`plugin_mcp_token`,
`plugin_mcp_audit`, `plugin_mcp_ability`) korur; yeniden yüklenmesi iptal edilmiş
bir belirteci yeniden etkinleştirmez. Tabloları Cacti veritabanıyla birlikte
yedekleyin ve eklenti dışında bir denetim saklama politikası uygulayın.

## Geliştirme ve testler

Testler, Cacti olmadan çalışan düz PHP betikleridir:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI, PHP 8.2'den 8.5'e kadar PHP kodunu lint'ler ve `tests/` altındaki betikleri
(her biri `.github/workflows/ci.yml` içinde listelenmiştir) çalıştırır; ardından
kurulabilir `mcp/` arşivini ve sağlama toplamını oluşturur. Cacti'ye dokunan testler,
Cacti yardımcı sınırında test fikstürleri kullanır; tam bir Cacti kurulumunu
çalıştırmaz.

### Entegrasyon testleri

`tests/integration/run.sh 1.2.31` veya `tests/integration/run.sh develop`, eklentiyi
konteynerler içinde gerçek bir Cacti kurulumuna yükler ve buna karşı canlı denetimler
çalıştırır. Compose v2.23.1 veya üzeri ile Docker, git ve openssl gerektirir.
`KEEP=1`, hata ayıklama için yığını çalışır durumda bırakır. CI bunu çekme
isteklerinde değil, gecelik ve isteğe bağlı olarak çalıştırır.

## Yerelleştirme

Cacti MCP; `mcp` metin alanını (`locales/po/mcp.pot`) kullanarak İngilizce ile
birlikte 47 yerel ayar (19 Broad Tier 1, 15 Afrika, 10 Asya ile Boşnakça, Hırvatça ve Sırpça yerel ayarları) için
`locales/po/` ve `locales/LC_MESSAGES/` altında derlenmiş GNU gettext katalogları ve
`docs/i18n/` altında yerelleştirilmiş README dosyaları sunar. Dil desteği
etkinleştirildiğinde Cacti eşleşen kataloğu otomatik olarak yükler.

## Katkıda bulunma

Çekme istekleri `develop` dalına gönderilir. Üretim kodunu PHP 8.2 ile uyumlu
tutun ve Cacti'nin stilini kullanın: sekmeler, tek tırnaklı dizeler ve Cacti'nin
veritabanı ile izin yardımcıları. Değişen doğrulama, yetkilendirme veya protokol
davranışları için testler ekleyin ve commit'leri `git commit -s` ile imzalayın. HTTP
API değişikliklerini [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp)
ile koordine edin.

## Lisans

Telif Hakkı (C) 2026 Thomas Vincent. GNU Genel Kamu Lisansı, sürüm 2 veya sonrası
kapsamında yayımlanmıştır. Bkz. [LICENSE](../../../LICENSE).
