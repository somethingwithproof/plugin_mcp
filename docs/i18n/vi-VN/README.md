<!-- Source: README.md; SHA256: 2e820760752cd13cf9c70dcc90a290b4ae03138f998af295915a99de2cc890d4 -->

<!-- translations:start -->
[English](../../../README.md) | [Afrikaans](../af-ZA/README.md) | [አማርኛ](../am-ET/README.md) | [العربية (مصر)](../ar-EG/README.md) | [العربية (المغرب)](../ar-MA/README.md) | [العربية (السعودية)](../ar-SA/README.md) | [বাংলা](../bn-BD/README.md) | [Deutsch](../de-DE/README.md) | [Español (España)](../es-ES/README.md) | [فارسی](../fa-IR/README.md) | [Filipino](../fil-PH/README.md) | [Français](../fr-FR/README.md) | [Français (Maroc)](../fr-MA/README.md) | [Français (Sénégal)](../fr-SN/README.md) | [Hausa](../ha-NG/README.md) | [עברית](../he-IL/README.md) | [हिन्दी](../hi-IN/README.md) | [Bahasa Indonesia](../id-ID/README.md) | [Igbo](../ig-NG/README.md) | [Italiano](../it-IT/README.md) | [日本語](../ja-JP/README.md) | [한국어](../ko-KR/README.md) | [Malagasy](../mg-MG/README.md) | [मराठी](../mr-IN/README.md) | [Bahasa Melayu](../ms-MY/README.md) | [Nederlands](../nl-NL/README.md) | [Polski](../pl-PL/README.md) | [Português (Brasil)](../pt-BR/README.md) | [Русский](../ru-RU/README.md) | [Kinyarwanda](../rw-RW/README.md) | [Soomaali](../so-SO/README.md) | [Svenska](../sv-SE/README.md) | [Kiswahili](../sw-KE/README.md) | [தமிழ்](../ta-IN/README.md) | [తెలుగు](../te-IN/README.md) | [ไทย](../th-TH/README.md) | [Türkçe](../tr-TR/README.md) | [Українська](../uk-UA/README.md) | [اردو](../ur-PK/README.md) | [Tiếng Việt](README.md) | [isiXhosa](../xh-ZA/README.md) | [Yorùbá](../yo-NG/README.md) | [简体中文](../zh-CN/README.md) | [繁體中文](../zh-TW/README.md) | [isiZulu](../zu-ZA/README.md)
<!-- translations:end -->

<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

<h1 align="center">
	<picture>
		<source media="(prefers-color-scheme: dark)" srcset="../../../images/mcp_logo_dark.png">
		<img src="../../../images/mcp_logo.png" width="360" alt="Cacti MCP: cây xương rồng cùng chiếc khiên. Khám phá. Ủy quyền. Thực thi.">
	</picture>
</h1>

<p align="center">
	<a href="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml"><img src="https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml/badge.svg?branch=develop" alt="CI"></a>
	<a href="../../../LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue" alt="Giấy phép: GPL-2.0-or-later"></a>
	<img src="https://img.shields.io/badge/Cacti-1.2.31%2B-2e7d32" alt="Cacti 1.2.31+">
	<img src="https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&amp;logoColor=white" alt="PHP 8.2+">
	<img src="https://img.shields.io/badge/Abilities_API-v2-2e7d32" alt="Abilities API v2">
</p>

Cacti MCP là một plugin cho Cacti cho phép các client AI đọc dữ liệu Cacti của bạn thông qua các thao tác có tên và được lọc theo quyền gọi là ability. Plugin tự cung cấp các ability này theo hai cách: một endpoint MCP (`mcp.php`, Streamable HTTP) và một HTTP API theo phong cách AIP (`api.php`). Cacti vẫn giữ quyền kiểm soát việc ủy quyền và thực thi. Client không bao giờ truy vấn trực tiếp cơ sở dữ liệu; nó chỉ có thể gọi một ability mà quản trị viên đã công khai và được các realm Cacti của chủ sở hữu token cho phép.

Tác giả plugin có thể tự đăng ký các ability chỉ đọc của riêng mình thông qua hook `abilities_register`, và chúng sẽ hiển thị với các client MCP dưới dạng công cụ (tool) mà không cần viết mã giao thức.

**Trạng thái: bản tiền phát hành (pre-release), phiên bản 0.1.0.** Hiện chưa có bản phát hành gắn thẻ (tagged release).

Hiện đã có:

- Các ability tích hợp sẵn ở chế độ chỉ đọc để lấy thông tin phiên bản hệ thống và danh sách thiết bị.
- Personal access token (`cmcp_pat_...`) là loại thông tin xác thực duy nhất.
- Bảng điều khiển Management > MCP: công khai hoặc ẩn ability, tạo và thu hồi token, xem nhật ký kiểm tra (audit log).
- Management > My MCP Tokens: người dùng tự quản lý token của mình, xem hoạt động của bản thân và xem những công cụ nào mà token của họ có thể sử dụng.
- MCP qua Streamable HTTP, các phiên bản giao thức `2026-07-28` và `2025-11-25`, chỉ hỗ trợ công cụ (tools).

Hiện chưa có:

- Đăng nhập OAuth 2.1. Các trình kết nối lưu trữ trên đám mây không thể gửi personal token, chẳng hạn như các trình kết nối tùy chỉnh của ChatGPT và claude.ai, sẽ chưa thể kết nối cho đến khi tính năng này ra mắt. Tính năng này được lên kế hoạch cho Plan 2; kế hoạch đó hiện chưa được viết.
- Ability ghi dữ liệu. Hiện chỉ cho phép đăng ký các ability chỉ đọc.

Thiết kế nằm trong [đặc tả thiết kế endpoint](../../superpowers/specs/2026-11-19-mcp-endpoint-design.md), và trình tự xây dựng nằm trong [docs/plan.md](../../plan.md).

## Ability tích hợp sẵn

| ID | Tham số | Realm Cacti cần thiết |
| --- | --- | --- |
| `cacti-get-system-info` | không có | 15 |
| `cacti-list-devices` | tùy chọn `pageSize`, `pageToken`, `filter`, `orderBy` | 3 |
| `cacti-get-device` | bắt buộc `name`, ví dụ `devices/12` | 3 |

Mọi lệnh gọi cũng cần chủ sở hữu token có realm **MCP and Abilities API**, phạm vi (scope) `abilities:read` (mọi personal token đều có sẵn), và ability đó phải đang được công khai. Tab Abilities trên bảng điều khiển sẽ hiển thị realm mà mỗi ability tích hợp sẵn yêu cầu.

- `cacti-list-devices` trả về từng trang tối đa 100 thiết bị (mặc định 50) kèm theo `nextPageToken`. Page token chỉ hợp lệ khi dùng cùng một `filter` và `orderBy`. `filter` là một biểu thức AIP-160 gồm các phép so sánh nối với nhau bằng `AND`, ví dụ `state = "DOWN" AND disabled = false`. Các trường lọc gồm `displayName`, `hostname`, `disabled`, `site`, `poller`, `deviceTemplate`, `externalId`, và `state`. `orderBy` nhận `displayName`, `hostname`, hoặc `name`, mỗi trường có thể tùy chọn theo sau bởi `desc`.
- Các truy vấn thiết bị đi qua hàm `get_allowed_devices()` của Cacti, nên người dùng chỉ thấy những thiết bị mà Cacti cho phép họ xem.
- Các trường thông tin thiết bị loại bỏ chuỗi SNMP community, cụm mật khẩu (passphrase) và các thông tin xác thực khác.

## Cài đặt

Yêu cầu Cacti 1.2.31 trở lên, PHP 8.2 trở lên và main poller. Tính năng xác thực của Cacti phải được bật; plugin sẽ từ chối xác thực nếu tính năng này đang tắt.

Thư mục plugin phải được đặt tên là `mcp`, không phải `plugin_mcp`. Slug của plugin, tên realm, miền dịch thuật (translation domain) và các URL đều sử dụng `mcp`.

Từ bản sao mã nguồn (source checkout):

```console
cd /path/to/cacti/plugins
git clone https://github.com/somethingwithproof/plugin_mcp.git mcp
```

Trong khi chưa có bản phát hành gắn thẻ, bạn có thể tải xuống artifact `mcp-plugin` từ một [lần chạy CI](https://github.com/somethingwithproof/plugin_mcp/actions/workflows/ci.yml) thành công. Gói này chứa `mcp.tar.gz` và `SHA256SUMS`. Hãy kiểm tra checksum, sau đó giải nén `mcp.tar.gz` vào bên trong thư mục `plugins/` của Cacti sao cho kết quả là `plugins/mcp/`. Các gói lưu trữ mã nguồn tự động của GitHub dùng tên thư mục cấp cao nhất khác. Gói lưu trữ này lược bỏ `docs/` (bao gồm các ảnh chụp màn hình bên dưới), `tests/`, và `.github/`, vì vậy các liên kết README trỏ vào `docs/` chỉ hoạt động trên GitHub chứ không hoạt động trong bản cài đặt.

Sau đó:

1. Trong Plugin Management, hãy cài đặt và bật **Cacti MCP**. Quản trị viên thực hiện cài đặt sẽ tự động nhận được realm **MCP Administration**.
2. Trong Settings > MCP, đặt **Public Cacti URL** thành địa chỉ mà các client sử dụng, ví dụ `https://cacti.example.com/cacti`. Bắt buộc phải dùng HTTPS ngoại trừ đối với `localhost`, `127.0.0.1`, và `[::1]`. Cho đến khi giá trị này được thiết lập, `mcp.php` sẽ trả về HTTP 400 kèm lỗi JSON-RPC có `data` là `FAILED_PRECONDITION` và `PUBLIC_URL_REQUIRED`. `api.php` không đọc thiết lập này.

   ![Settings > MCP hiển thị trường Public Cacti URL](../../images/settings-public-url.png)

3. Cấp realm **MCP and Abilities API** cho từng người dùng sẽ sở hữu token. Không có người dùng nào được cấp tự động quyền này.
4. Đảm bảo máy chủ web truyền header `Authorization` và path info đến PHP (xem bên dưới).
5. Mở Management > MCP và công khai các ability bạn muốn client nhìn thấy.

**Nâng cấp từ bản dựng phát triển.** Plugin đang ở giai đoạn tiền phát hành, và các bảng cơ sở dữ liệu của nó đã thay đổi trong quá trình phát triển mà không có kịch bản di trú (migration). Nếu bạn đã cài đặt một bản dựng trước đó, hãy gỡ cài đặt rồi cài đặt lại. Việc cài đặt lại vẫn giữ nguyên các bảng đã tồn tại, vì vậy trước tiên hãy xóa các bảng cũ `plugin_mcp_token`, `plugin_mcp_audit`, và `plugin_mcp_ability` (cũng như các bảng tương đương từ những bản dựng trước khi đổi tên). Hãy sao lưu chúng nếu bạn cần giữ lại lịch sử; các token từ những bản dựng đó sẽ bị thu hồi khi gỡ cài đặt và không được chuyển tiếp sang bản mới.

### Máy chủ web

Các cấu hình Apache loại bỏ header `Authorization` trước khi đến PHP cần thêm dòng sau vào virtual host hoặc directory tương ứng, sau đó tải lại cấu hình:

```apache
SetEnvIf Authorization "(.+)" HTTP_AUTHORIZATION=$1
```

Apache dùng `mod_php` phục vụ các route của `api.php` mà không cần cấu hình đường dẫn bổ sung.

Các route của `api.php` nằm trong phần đường dẫn phía sau tên script (`/plugins/mcp/api.php/v1/abilities`), vì vậy nginx phải khớp các URI có `.php` theo sau bởi phần đường dẫn thêm, tách riêng path info và truyền cho PHP. Một khối `location ~ \.php$` sẽ không bao giờ khớp với các URL này; nginx sẽ trả về trang lỗi HTML 404 của riêng nó. Mẫu `location` và hai dòng xử lý path-info bên dưới đã được kiểm chứng với PHP-FPM; các dòng còn lại là cấu hình mẫu tiêu chuẩn:

```nginx
location ~ \.php(/|$) {
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass unix:/run/php/php-fpm.sock;   # your PHP-FPM socket or host:port
}
```

Hãy điều chỉnh các dòng `include` và `fastcgi_pass` cho khớp với khối đang phục vụ Cacti sẵn có. Không thêm `try_files $fastcgi_script_name =404;` vào khối này: lệnh đó sẽ xóa mất `$fastcgi_path_info`, và khi đó `api.php` sẽ trả về 404 `UNKNOWN_PATH`. Nếu cấu hình của bạn bắt buộc phải dùng `try_files`, hãy lưu lại giá trị trước bằng `set $path_info $fastcgi_path_info;` và truyền `fastcgi_param PATH_INFO $path_info;`.

`mcp.php` không có các route đường dẫn nên không cần cấu hình này.

## Bảng điều khiển

Management > MCP có ba tab. Bạn cần có realm **MCP Administration**. Ảnh chụp màn hình tại đây và bên dưới được lấy từ một bản dựng phát triển Cacti với dữ liệu mẫu.

- **Abilities** liệt kê mọi ability đã đăng ký cùng với plugin, danh mục, realm cần thiết và trạng thái công khai của nó. Chọn các hàng rồi chọn Expose hoặc Hide; bạn sẽ xác nhận trước khi thay đổi được áp dụng. Các ability tích hợp sẵn `cacti-*` được công khai theo mặc định. Các ability từ plugin khác mặc định ở trạng thái ẩn, để việc cài đặt một plugin không bao giờ tự ý xuất bản bất cứ thứ gì cho đến khi quản trị viên quyết định. Việc công khai chỉ thu hẹp quyền truy cập ở mức công cụ: người dùng vẫn cần có realm của ability đó.

  ![Tab Abilities liệt kê các ability tích hợp sẵn cùng realm và trạng thái công khai](../../images/console-abilities.png)
- **Tokens** liệt kê các token cùng chủ sở hữu, người tạo, thời gian tạo, hạn sử dụng, lần sử dụng cuối và trạng thái (Active, Expired, Revoked). Chọn các hàng và chọn Revoke để thu hồi chúng. Token đã thu hồi không thể sử dụng lại được nữa. Nút Create Token dùng để tạo token mới.

  ![Tab Tokens liệt kê các token với chủ sở hữu, hạn sử dụng, lần dùng cuối và trạng thái, phía trên biểu mẫu Create Token](../../images/console-tokens.png)
- **Audit** liệt kê các dòng nhật ký kiểm tra, mới nhất trước, và hỗ trợ lọc theo người dùng, ability và kết quả.

  ![Tab Audit liệt kê các lệnh gọi với người dùng, token, ability và kết quả, kèm bộ lọc](../../images/console-audit.png)

## Token

Một personal token đọc dữ liệu Cacti với tư cách chủ sở hữu của nó. Token có dạng `cmcp_pat_` theo sau bởi 64 ký tự hex viết thường và mang duy nhất một phạm vi là `abilities:read`. Những gì token có thể xem được quyết định bởi các realm Cacti và quyền truy cập thiết bị của chủ sở hữu, chứ không phải bởi bản thân token. Chủ sở hữu phải là người dùng đang được kích hoạt và nắm giữ realm **MCP and Abilities API**.

Token luôn được tạo cho một người dùng cụ thể, có thời hạn và có thể bị thu hồi:

- **Bảng điều khiển.** Management > MCP > Tokens > Create Token. Thời hạn từ 1 đến 365 ngày và mặc định là 90 ngày. Token được máy chủ tạo và chỉ hiển thị một lần trên trang phản hồi, vì vậy hãy sao chép ngay vào trình quản lý bí mật của bạn. Bạn có thể tạo token cho chính mình. Để tạo token cho người dùng khác, bạn cũng cần có realm Users/Groups, vì token đó sẽ đọc dữ liệu Cacti với tư cách người dùng kia.
- **My MCP Tokens.** Bất kỳ người dùng nào có realm MCP and Abilities API đều có thể tự quản lý token của mình; xem bên dưới.
- **Dòng lệnh.** `tokens.php` chỉ chạy từ CLI, dưới tài khoản hệ điều hành có quyền quản trị Cacti. Lệnh nhận token từ biến môi trường để giá trị token không bao giờ xuất hiện trên dòng lệnh hoặc trong danh sách tiến trình. Thời hạn từ 1 đến 365 ngày và mặc định là 30 ngày. Việc tạo và thu hồi token qua CLI được ghi nhật ký kiểm tra giống như trên bảng điều khiển, với chủ sở hữu token là tác nhân thực hiện vì CLI không có người dùng Cacti, do đó dòng nhật ký sẽ không đánh dấu hành động là xuất phát từ CLI. `--list` in toàn bộ token dưới dạng JSON (ID, chủ sở hữu, phạm vi, dấu thời gian, cờ thu hồi) và không bao giờ in giá trị token; `--help` hiển thị hướng dẫn sử dụng.

  ```console
  export CACTI_MCP_TOKEN="$(printf 'cmcp_pat_%s\n' "$(openssl rand -hex 32)")"
  # Store this value in your secret manager before you end this shell session.
  php plugins/mcp/tokens.php --create=USERNAME --days=30
  php plugins/mcp/tokens.php --list
  php plugins/mcp/tokens.php --revoke=ID
  ```

Không thể tạo token cho tài khoản khách (guest), cho người dùng bị vô hiệu hóa, hoặc cho người dùng không có realm **MCP and Abilities API**, dù từ bảng điều khiển, dòng lệnh hay My MCP Tokens. Cacti lưu thiết lập tài khoản khách dưới dạng tên người dùng hoặc ID người dùng, và plugin xử lý được cả hai. Một token mà chủ sở hữu trở thành tài khoản khách sẽ ngừng hoạt động ở yêu cầu tiếp theo.

### My MCP Tokens

Management > My MCP Tokens (`plugins/mcp/mcp_tokens.php`) không cần realm quản trị: trang này được bao phủ bởi realm **MCP and Abilities API**, và mục menu chỉ xuất hiện đối với những người dùng nắm giữ realm đó. Trang luôn thao tác trên người dùng đang đăng nhập. Menu của Cacti là một phần của giao diện quản trị (console), vì vậy người dùng không có quyền truy cập console sẽ truy cập trang qua địa chỉ trực tiếp của nó.

![Tab My Tokens liệt kê các token của người dùng đang đăng nhập và biểu mẫu tạo mới](../../images/my-tokens.png)

- **Tokens** liệt kê các token của bạn, tạo token mới (từ 1 đến 365 ngày, mặc định 90 ngày, chỉ hiển thị một lần trong phản hồi) và thu hồi token của chính bạn. Bạn không thể xem hoặc thu hồi token của người khác.
- **Activity** liệt kê các hành động bạn đã thực hiện, mới nhất trước: các lệnh gọi thực hiện bằng token của bạn và các thay đổi token bạn đã thực hiện.
- **Available Tools** liệt kê các ability mà token của bạn có thể sử dụng ngay lúc này, cùng ID, tên và mô tả của từng ability. Danh sách này tuân theo quyền Cacti của bạn và các thiết lập công khai mà quản trị viên đã chọn.

  ![Danh sách Available Tools hiển thị ID, tên và mô tả của từng ability](../../images/my-tools.png)

Bản cài đặt được thực hiện trước khi trang này tồn tại sẽ có danh sách tệp realm chưa bao gồm `mcp_tokens.php`. Quá trình cài đặt (Install) mới đăng ký danh sách này; việc bật hoặc tắt plugin không cập nhật nó. Hãy gỡ cài đặt rồi cài đặt lại plugin, sau đó cấp lại các realm, vì Cacti sẽ xóa các quyền realm đã cấp khi gỡ cài đặt plugin.

Cơ sở dữ liệu chỉ lưu mã băm SHA-256 của token, nên token bị mất sẽ không thể khôi phục; hãy thu hồi nó và tạo một token khác. Việc xoay vòng (rotation) token cũng tương tự: tạo một token mới, chuyển client sang dùng token mới, rồi thu hồi token cũ. Token hết hạn, token đã thu hồi, chủ sở hữu bị vô hiệu hóa, hoặc bị mất realm đều sẽ gặp lỗi ở yêu cầu tiếp theo. Token chỉ được chấp nhận trong header `Authorization: Bearer`; token nằm trong chuỗi truy vấn (query string) hoặc phần thân (body) sẽ không được chấp nhận.

## Kết nối client

Sử dụng điểm cuối MCP `https://cacti.example.com/cacti/plugins/mcp/mcp.php`, với token nằm trong header `Authorization: Bearer`. Hãy lưu token trong biến môi trường hoặc trình quản lý bí mật và tham chiếu nó từ cấu hình client thay vì ghi trực tiếp giá trị vào tệp.

### Claude Code

Đặt điểm cuối vào tệp `.mcp.json` của dự án để tham chiếu token theo tên.
Claude Code sẽ mở rộng `${VAR}` trong `url` và `headers`, vì vậy tệp này không chứa bí mật nào và an toàn để commit. Hãy export `CACTI_MCP_TOKEN` trong môi trường khởi chạy Claude Code.

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

Bạn cũng có thể thêm từ dòng lệnh:

```console
claude mcp add --transport http cacti https://cacti.example.com/cacti/plugins/mcp/mcp.php \
  --header "Authorization: Bearer $CACTI_MCP_TOKEN"
```

Với dấu ngoặc kép, shell của bạn sẽ mở rộng `$CACTI_MCP_TOKEN` trước, do đó giá trị token được ghi vào tệp cấu hình cho `--scope` đã chọn (`local`, `user`, hoặc `project`; mặc định là `local`). Không sử dụng dạng này với `--scope project`, và giữ tệp đó ngoài hệ thống quản lý phiên bản. Hãy ưu tiên tham chiếu `.mcp.json` ở trên. Claude Code đọc một số biến thông tin xác thực (như `ANTHROPIC_AUTH_TOKEN`) là rỗng trong `url` và `headers` từ xa; `CACTI_MCP_TOKEN` không nằm trong số đó. Nguồn: [Tài liệu MCP của Claude Code](https://code.claude.com/docs/en/mcp).

### GitHub Copilot trong VS Code

Sử dụng tệp `.mcp.json` ở thư mục gốc của workspace (hoặc tệp người dùng `~/.copilot/mcp-config.json`). Các tệp gốc của Copilot này sử dụng một đối tượng `mcpServers` ở cấp cao nhất và tham chiếu biến môi trường `${NAME}` trong các giá trị header:

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

Hãy export `CACTI_MCP_TOKEN` trong môi trường khởi chạy VS Code. Các tệp gốc của Copilot không hỗ trợ lời nhắc `inputs`. Trình thiết lập có hướng dẫn của VS Code từ chối các giá trị `${...}`, vì vậy hãy thêm header `Authorization` bằng cách chỉnh sửa tệp, không thông qua quy trình có hướng dẫn. Trình thiết lập có hướng dẫn chỉ cung cấp tệp ở thư mục gốc workspace khi thiết lập thử nghiệm `chat.mcp.workspaceRootConfig.enabled` được bật. Xem [Tài liệu tham khảo cấu hình MCP của VS Code](https://code.visualstudio.com/docs/agents/reference/mcp-configuration).

**Cũ: `.vscode/mcp.json`.** VS Code cho biết các cấu hình Copilot mới không nên sử dụng `.vscode/mcp.json` hoặc tệp `mcp.json` của hồ sơ; chúng thuộc về Local harness đã lỗi thời và sẽ bị xóa vào tháng 2 năm 2027. Nếu bạn vẫn sử dụng nó, định dạng do trình soạn thảo quản lý dùng khóa `servers` ở cấp cao nhất và có thể nhắc nhập token:

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

### Các client chỉ hỗ trợ stdio

[cacti-mcp](https://github.com/somethingwithproof/cacti-mcp) là một bộ chuyển đổi tùy chọn chạy như một máy chủ MCP stdio cục bộ và gọi API HTTP của plugin. Sử dụng nó cho client không thể kết nối tới máy chủ HTTP từ xa. Nó cần cùng một token cá nhân và giao tiếp với `api.php`.

### Hành vi MCP

Điểm cuối này chỉ phục vụ các công cụ: mỗi ability được hiển thị và được cấp phép là một công cụ được đặt tên theo ID của nó, kèm theo các lược đồ đầu vào, đầu ra và chú thích chỉ đọc (`openWorldHint` là `false`). Nó xử lý `initialize`, `server/discover`, `ping`, `tools/list`, và `tools/call`. Nó không lưu giữ phiên, không gửi `Mcp-Session-Id` (và bỏ qua giá trị này nếu nhận được), đồng thời không chấp nhận các lô JSON-RPC. Một thông điệp không có `id` là một thông báo và nhận về HTTP 202 không có nội dung phản hồi. Chỉ cho phép phương thức `POST`.

- **Phiên bản giao thức.** Một yêu cầu mang `io.modelcontextprotocol/protocolVersion` trong `params._meta` phải chỉ định `2026-07-28`; bất kỳ giá trị nào khác sẽ nhận lỗi `-32022`. Các yêu cầu như vậy cũng phải mang các header `Mcp-Protocol-Version`, `Mcp-Method`, và (đối với `tools/call`) `Mcp-Name` khớp tương ứng, nếu không câu trả lời sẽ là lỗi `-32020`. Các yêu cầu khác được xử lý dưới dạng `2025-11-25`: `initialize` phản hồi với phiên bản đó, và trên bất kỳ phương thức nào khác, header `Mcp-Protocol-Version` nếu được gửi phải là `2025-11-25`, `2025-06-18`, hoặc `2025-03-26`.
- **Lỗi công cụ.** Một lỗi của ability, bao gồm các tham số không khớp lược đồ hoặc giá trị `arguments` không phải là đối tượng JSON, sẽ trả về dưới dạng kết quả công cụ với `isError: true` và lỗi AIP-193 trong `structuredContent`, không phải dưới dạng lỗi giao thức.
- **Lỗi giao thức.** Các lỗi không phải lỗi công cụ là các đối tượng lỗi JSON-RPC (mã `-32000` kèm trạng thái và lý do trong `data`, hoặc các mã tiêu chuẩn): thiếu Public Cacti URL, `Origin` bị từ chối, yêu cầu gửi khi plugin bị vô hiệu hóa hoặc trên remote poller, và các lỗi máy chủ không mong muốn (`-32603`, với chi tiết được ghi vào nhật ký Cacti chứ không có trong phản hồi). Các bước kiểm tra yêu cầu chạy trước (405, 413, 415) và lỗi xác thực (401 `INVALID_TOKEN`, 403 `REALM_REQUIRED`) vẫn giữ nguyên phần thân AIP-193 được mô tả trong mục HTTP API.

## HTTP API

URL cơ sở: `https://cacti.example.com/cacti/plugins/mcp/api.php`. Đặc tả giao diện nằm trong [openapi.json](../../../openapi.json).

| Phương thức và đường dẫn | Mục đích |
| --- | --- |
| `GET /v1/abilities` | Liệt kê các ability được phép. Tham số truy vấn: `pageSize`, `pageToken`, và `filter` có dạng `category = "inventory"`. |
| `GET /v1/abilities/{id}` | Đọc một ability. |
| `POST /v1/abilities/{id}:execute` | Thực thi ability đó. Phần thân là chính xác `{"arguments": {...}}`. Phản hồi là `{"requestId": "...", "result": {...}}`. |

```console
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" \
  https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities
curl -sS -H "Authorization: Bearer $CACTI_MCP_TOKEN" -H 'Content-Type: application/json' \
  -d '{"arguments": {"filter": "state = \"DOWN\""}}' \
  'https://cacti.example.com/cacti/plugins/mcp/api.php/v1/abilities/cacti-list-devices:execute'
```

Lỗi tuân theo chuẩn AIP-193: một đối tượng `error` gồm `code`, `message`, `status`, và `details` mang một `ErrorInfo` với tên miền `cacti.net` và một `reason` ổn định. Các sự cố về tham số sẽ bổ sung chi tiết `BadRequest` nêu tên trường bị lỗi. Phần thân yêu cầu bị giới hạn ở 64 KB, và kết quả ở 1 MB. Cả hai điểm cuối chỉ phản hồi trên main poller và trả về `UNAVAILABLE` (`PLUGIN_UNAVAILABLE`) khi plugin bị vô hiệu hóa hoặc máy chủ không phải là main poller.

| HTTP | Giá trị `reason` |
| --- | --- |
| 400 | `INVALID_ARGUMENTS`, `INVALID_FILTER`, `INVALID_PAGE_TOKEN` |
| 401 | `INVALID_TOKEN` (cũng gửi kèm `WWW-Authenticate: Bearer`) |
| 403 | `REALM_REQUIRED` |
| 404 | `ABILITY_NOT_FOUND`, `DEVICE_NOT_FOUND`, `UNKNOWN_PATH` |
| 405 | `METHOD_NOT_ALLOWED` (gửi kèm `Allow`) |
| 413 | `REQUEST_TOO_LARGE` |
| 415 | `UNSUPPORTED_MEDIA_TYPE` |
| 500 | `INTERNAL_ERROR`, `INVALID_RESULT` |
| 503 | `AUDIT_UNAVAILABLE`, `PLUGIN_UNAVAILABLE`, `CACTI_UNAVAILABLE` |

## Viết một ability (dành cho tác giả plugin)

Một plugin Cacti đã bật sẽ đăng ký các ability từ một hàm gắn vào hook `abilities_register`, thường nằm trong `plugin_<slug>_install()` của plugin đó:

```php
api_plugin_register_hook('acme', 'abilities_register', 'acme_abilities_register', 'setup.php');
```

Hàm này nhận vào một `AbilitiesRegistrar` được giới hạn phạm vi cho plugin. Giá trị trả về của nó bị bỏ qua.

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

Các quy tắc, tất cả đều được kiểm tra bắt buộc khi đăng ký:

- **ID.** Một ID khớp với `^[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$`, dài tối đa 64 ký tự, và phải bắt đầu bằng slug của plugin cùng dấu gạch nối: `acme-` như trên. Slug là tên thư mục plugin, nên một thư mục như `my_plugin` không thể đăng ký bất kỳ ability nào. Thư mục plugin có tên `cacti` sẽ bị từ chối; không gian tên đó thuộc về các thành phần tích hợp sẵn.
- **Định nghĩa.** Chính xác các khóa sau: `label`, `description` (tối đa 4096 byte), `category`, `input_schema`, `output_schema`, `annotations`, `permission`, `execute`. Danh mục phải tồn tại sẵn: sử dụng danh mục tích hợp sẵn (`inventory`, `system`) hoặc tự đăng ký bằng `registerCategory()`, với ID là duy nhất trên tất cả các plugin và khớp với `^[a-z][a-z0-9-]{0,31}$`.
- **Chỉ đọc.** `annotations` phải chính xác là `readOnly: true`, `destructive: false`, `idempotent: true`. Bất kỳ giá trị nào khác đều ném ra ngoại lệ.
- **Lược đồ.** `input_schema` và `output_schema` mỗi loại phải có `type` ở cấp cao nhất là `object`. Cú pháp lược đồ này nhỏ gọn và fail-closed. Các đối tượng phải đóng (`additionalProperties: false`, và có `properties`); các kiểu khác gồm `integer` và `number` (`minimum`, `maximum`), `string` (`minLength`, `maxLength`, `enum`, `pattern`), `boolean`, và `array` (cần có `items` và `maxItems`). Một kiểu có thể cho phép null dưới dạng `['string', 'null']`. Chuỗi tham số mặc định dài tối đa 4096 ký tự; chuỗi kết quả chỉ bị giới hạn bởi `maxLength` đã khai báo và giới hạn kích thước kết quả. Có thể đăng ký tối đa 256 ability.
- **`permission(int $userId): bool`.** Phải trả về chính xác `true` để cho phép. ID người dùng là của chủ sở hữu token; không bao giờ đọc trạng thái phiên.
- **`execute(int $userId, stdClass $args): array`.** `$args` đã được xác thực dựa trên `input_schema`. Tự thực thi kiểm tra quyền ở cấp độ đối tượng. Trả về một mảng kết hợp khớp chính xác với `output_schema`; một danh sách, một trường dư thừa, hoặc lượng JSON vượt quá 1 MB sẽ trở thành lỗi `INVALID_RESULT`. Ném `AbilitiesError` cho lỗi hiển thị phía client, chẳng hạn như `NOT_FOUND`.
- **Đối tượng rỗng.** PHP mã hóa `[]` thành mảng JSON. Bất cứ nơi nào lược đồ đầu ra khai báo là `object`, ở bất kỳ độ sâu nào, registry đều coi `[]` là đối tượng rỗng và gửi `{}`; `new stdClass()` cũng hoạt động tương tự. Một danh sách không rỗng không bao giờ được tính là một đối tượng và sẽ thất bại với lỗi `INVALID_RESULT`. Một ánh xạ `properties` rỗng trong lược đồ có thể là `[]` hoặc `new stdClass()`; cả hai đều được xuất bản thành `{}`.
- **Cô lập lỗi.** Mỗi plugin đăng ký vào một bản sao nháp và bản sao này chỉ được giữ lại nếu hàm của bạn trả về bình thường. Nếu hàm ném ngoại lệ, không có ability nào của bạn được đăng ký, và lỗi sẽ được ghi vào nhật ký.

Các ability từ plugin ban đầu sẽ bị ẩn. Quản trị viên hiển thị chúng trên tab Abilities trong bảng điều khiển, và cột Required Realm sẽ hiển thị "Set by the plugin" cho các ability đó.

## Mô hình bảo mật

- **Chỉ dùng Bearer.** `api.php` và `mcp.php` chỉ chấp nhận một token cá nhân trong
  header `Authorization` và không chấp nhận bất kỳ thứ gì khác. Chúng loại bỏ cookie,
  `$_POST` và `$_REQUEST` trước khi Cacti tải và hủy phiên do Cacti khởi tạo, nên phiên
  đăng nhập trên trình duyệt không bao giờ cấp quyền truy cập API.
- **Giải pháp tạm thời cho CSRF.** Cơ chế bảo vệ CSRF của Cacti từ chối yêu cầu JSON
  POST không có CSRF token của Cacti, điều mà không MCP client nào có thể gửi. Chỉ đối
  với hai endpoint này, plugin đổi tên phương thức yêu cầu trước khi Cacti tải và khôi
  phục lại sau đó để cơ chế bảo vệ bỏ qua chúng. Điều này an toàn vì CSRF bảo vệ các yêu
  cầu mà trình duyệt xác thực bằng cookie, còn hai endpoint này không chấp nhận danh
  tính từ cookie: một trang web khác nguồn không thể đính kèm bearer token. Các trang
  bảng điều khiển vẫn giữ nguyên cơ chế bảo vệ CSRF đầy đủ. Giải pháp tạm thời này chỉ
  mang tính tạm thời, cho đến khi Cacti cung cấp cơ chế miễn trừ được hỗ trợ; xem
  `lib/bootstrap.php`.
- **Kiểm tra Origin.** Trên `mcp.php`, nếu yêu cầu có header `Origin`, giá trị đó phải
  trùng khớp chính xác về scheme, host và cổng của URL Cacti công khai, nếu không yêu
  cầu sẽ bị từ chối với lỗi `ORIGIN_NOT_ALLOWED`. Yêu cầu không có header `Origin`, vốn
  là cách các client không phải trình duyệt kết nối, được cho phép. Điều này ngăn một
  trang web điều khiển endpoint từ trình duyệt của người truy cập. `api.php` không áp
  dụng kiểm tra này.
- **Chỉ đọc.** Quá trình đăng ký từ chối mọi năng lực không ở trạng thái chỉ đọc, không
  phá hủy dữ liệu và bất biến.
- **Áp dụng đồng thời cả mức độ hiển thị và quyền hạn (realm).** Một năng lực phải được
  hiển thị và chủ sở hữu token phải có quyền hạn tương ứng. Nếu không thể đọc bảng hiển
  thị, toàn bộ năng lực sẽ bị ẩn thay vì quay về giá trị mặc định.
- **Ẩn, không tồn tại và không có quyền đều trả về giống nhau.** Client không thể phân
  biệt giữa một năng lực không tồn tại với một năng lực bị ẩn hoặc người dùng không
  được phép sử dụng: quá trình khám phá sẽ bỏ qua nó và quá trình thực thi trả về
  `NOT_FOUND` (`ABILITY_NOT_FOUND`).
- **Token.** Được lưu dưới dạng hàm băm SHA-256, chỉ hiển thị một lần, luôn có thời hạn,
  có thể thu hồi, và bị từ chối khi chủ sở hữu bị vô hiệu hóa hoặc mất quyền hạn.
- **Kiểm toán.** `plugin_mcp_audit` ghi lại ID yêu cầu, ID token, ID người dùng, năng lực,
  kết quả (`started`, `succeeded`, `failed`, `denied`, `rejected`) và dấu thời gian.
  Bảng này không bao giờ ghi lại tham số, kết quả trả về hay giá trị token. Một năng lực
  chỉ chạy sau khi dòng `started` của nó được ghi; nếu bảng kiểm toán không khả dụng,
  lệnh gọi sẽ thất bại với lỗi `UNAVAILABLE` và không chạy. Một lệnh gọi bị từ chối trước
  khi chạy được ghi thành một dòng: `denied` đối với năng lực không tồn tại, bị ẩn hoặc
  không có quyền, `rejected` đối với tham số không đạt schema. Việc tạo và thu hồi token
  từ bảng điều khiển, My MCP Tokens và CLI được ghi nhận là `mcp-token-create` và
  `mcp-token-revoke` với kết quả `succeeded`, và thao tác thu hồi chỉ được ghi lại đối
  với token đang hoạt động. Quá trình khám phá và lệnh gọi có `arguments` không phải là
  một đối tượng JSON sẽ không được ghi nhật ký.
- **Nhật ký lỗi.** Một lỗi ngoài dự kiến, `INVALID_RESULT`, hoặc bảng kiểm toán không khả
  dụng sẽ ghi một dòng vào nhật ký Cacti với facility `MCP`: ID năng lực, một lý do cố
  định và lớp ngoại lệ. Thông báo, tham số và token không bao giờ được ghi vào nhật ký.
- **Chỉ chạy trên poller chính.** Cả hai endpoint, cả hai trang bảng điều khiển và
  `tokens.php` đều từ chối hoạt động ở bất kỳ nơi nào khác.

## Vòng đời

Việc vô hiệu hóa plugin sẽ chặn cả hai endpoint. Việc gỡ cài đặt sẽ thu hồi mọi token
và giữ lại ba bảng (`plugin_mcp_token`, `plugin_mcp_audit`, `plugin_mcp_ability`) để
lưu trữ; việc cài đặt lại không kích hoạt lại token đã bị thu hồi. Hãy sao lưu các bảng
này cùng với cơ sở dữ liệu Cacti và áp dụng chính sách lưu giữ nhật ký kiểm toán bên
ngoài plugin.

## Phát triển và kiểm thử

Các bài kiểm thử là những script PHP thuần chạy không cần Cacti:

```console
for t in tests/*.php; do php "$t" || break; done
git archive --format=tar.gz --prefix=mcp/ HEAD > mcp.tar.gz
```

CI kiểm tra cú pháp PHP và chạy các script trong `tests/` (mỗi script được liệt kê trong
`.github/workflows/ci.yml`) trên PHP 8.2 đến 8.5, sau đó đóng gói gói cài đặt `mcp/` cùng
checksum của nó. Các bài kiểm thử có chạm tới Cacti sử dụng fixture tại ranh giới hàm
trợ giúp Cacti; chúng không chạy trên một bản cài đặt Cacti đầy đủ.

### Kiểm thử tích hợp

`tests/integration/run.sh 1.2.31` hoặc `tests/integration/run.sh develop` cài đặt plugin
vào một hệ thống Cacti thực tế trong các container và chạy kiểm tra trực tiếp trên đó.
Quá trình này cần Docker kèm Compose v2.23.1 trở lên, git và openssl. `KEEP=1` giữ cho
stack tiếp tục chạy để phục vụ gỡ lỗi. CI chạy quy trình này hằng đêm và theo yêu cầu,
không chạy trên các pull request.

## Bản địa hóa

Cacti MCP phân phối các catalog GNU gettext đã biên dịch trong `locales/po/` và
`locales/LC_MESSAGES/` cùng các tệp README đã bản địa hóa trong `docs/i18n/` cho tiếng
Anh và 44 ngôn ngữ địa phương (19 ngôn ngữ Broad Tier 1, 15 ngôn ngữ châu Phi và 10
ngôn ngữ châu Á), sử dụng text domain `mcp` (`locales/po/mcp.pot`). Cacti tự động tải
catalog tương ứng khi hỗ trợ ngôn ngữ được bật.

## Đóng góp

Các pull request được gửi vào nhánh `develop`. Giữ mã nguồn thực thi tương thích với
PHP 8.2 và tuân theo phong cách của Cacti: dùng tab, chuỗi nháy đơn, cùng các hàm trợ
giúp cơ sở dữ liệu và phân quyền của Cacti. Bổ sung bài kiểm thử khi thay đổi hành vi
kiểm tra hợp lệ, phân quyền hoặc giao thức, và ký xác nhận commit bằng `git commit -s`.
Phối hợp các thay đổi đối với HTTP API với [cacti-mcp](https://github.com/somethingwithproof/cacti-mcp).

## Giấy phép

Bản quyền (C) 2026 Thomas Vincent. Phát hành theo Giấy phép Công cộng GNU (GNU General
Public License), phiên bản 2 hoặc mới hơn. Xem [LICENSE](../../../LICENSE).
