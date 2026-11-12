[![Theo dõi](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Theo%20d%C3%B5i)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Sao](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Sao)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Fork](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Fork)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Vấn đề](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=V%E1%BA%A5n%20%C4%91%E1%BB%81)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Hướng dẫn sử dụng zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule miễn phí.** Ngay trong khu vực quản trị WHMCS, bạn có thể quản lý trang đa ngôn ngữ bằng trình biên tập trực quan, menu, thư viện ảnh, siêu dữ liệu SEO, sơ đồ trang XML, chuyển hướng, quy tắc rewrite và nhập/xuất dữ liệu.

## Trước khi sử dụng lần đầu

**Trước lần sử dụng đầu tiên, hãy mở Cài đặt mô-đun → Ngôn ngữ được hỗ trợ và bật những ngôn ngữ bạn cần.**

Mỗi lần kích hoạt, mô-đun tự động tạo giá trị salt mới và ghi vào `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kiểm tra để bảo đảm cả ba giá trị salt đều đã được điền.

## Khả năng tương thích và hoạt động đã kiểm thử

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Tương thích với máy chủ web

Apache được hỗ trợ đầy đủ (100%); Nginx có thể cần cấu hình thêm để định tuyến ngôn ngữ ở trang chủ.

## Cài đặt mô-đun

Chọn những ngôn ngữ mà mô-đun được phép sử dụng. Tắt một ngôn ngữ sẽ không xóa nội dung của ngôn ngữ đó.

- **Cài đặt mô-đun → Các ngôn ngữ được hỗ trợ → Bật**
- **Cơ sở dữ liệu mô-đun → Sửa Các mục đã chọn**
- **Quy tắc viết lại URL → Kiểm tra quy tắc → Thêm hoặc cập nhật quy tắc**

Nginx không đọc .htaccess nên các quy tắc này không hoạt động trên Nginx. Hãy cấu hình các quy tắc tương đương trong nginx.

## Trình quản lý trang

- **Thêm trang → Tên trang → Slug của trang → Lưu**
- **Trình chỉnh sửa trang → Cài đặt nội dung → Cài đặt siêu dữ liệu → Cài đặt sơ đồ trang web cho trang → Lưu tất cả**
- **Trình quản lý trang → Truy cập**
- **Sơ đồ trang web → Tạo sơ đồ trang web**

Chỉ cho phép chữ cái Latinh, dấu gạch nối và chữ số.

Người dùng đã đăng nhập: chỉ người đã đăng nhập mới truy cập được trang; Khách truy cập: chỉ người chưa đăng nhập mới truy cập được; Hỗn hợp: mọi người đều có thể truy cập, còn khả năng hiển thị được kiểm soát bằng các khối trong trang.

Việc tạo sơ đồ tự động chạy sau tác vụ cron của WHMCS khi đến kỳ cập nhật. Có thể chạy tạo thủ công ngay lập tức.

## Hướng dẫn theo từng mục

- [Trình quản lý trang](docs/pages_manager.md)
- [Trình chỉnh sửa trang](docs/pages_editor.md)
- [Trình quản lý phương tiện](docs/media_manager.md)
- [menu](docs/menu_manager.md)
- [Trình quản lý ngôn ngữ](docs/langs_manager.md)
- [chuyển hướng](docs/redirects_manager.md)
- [sơ đồ trang](docs/sitemap_manager.md)
- [Quy tắc viết lại URL](docs/rewrite_manager.md)
- [Cài đặt mô-đun](docs/module_settings.md)
- [Cơ sở dữ liệu mô-đun](docs/module_db.md)

## Tài liệu bổ sung

- [phân trang](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [dữ liệu có cấu trúc](docs/module_structured_data.md)
- [chuyển dữ liệu](docs/module_settings_transfer.md)
