# Cài đặt mô-đun

## WHMCS

Chọn những ngôn ngữ mà mô-đun được phép sử dụng. Tắt một ngôn ngữ sẽ không xóa nội dung của ngôn ngữ đó.

Nếu sử dụng URL thân thiện trên Apache, hãy cập nhật các quy tắc trong Trình quản lý quy tắc viết lại URL sau khi thay đổi ngôn ngữ.

- [chuyển dữ liệu](module_settings_transfer.md)

## Hướng dẫn

- **URL thân thiện** — Bật URL thân thiện, bao gồm cả các URL hệ thống.
- **Định tuyến ngôn ngữ** — Bật hoặc tắt các tuyến URL theo ngôn ngữ. Khi bật, các trang có thể truy cập bằng tiền tố /de/, /en/, /es/ và các tiền tố ngôn ngữ được hỗ trợ khác. Khi tắt, một URL trang duy nhất sẽ hiển thị nội dung theo ngôn ngữ mà người dùng đã cấu hình.
- **Tuyến URL cho ngôn ngữ mặc định** — Cấp tiền tố URL riêng cho ngôn ngữ mặc định và chuyển hướng các trang của mô-đun không có tiền tố đến URL tương ứng.
- **Chế độ bảo trì (mô-đun)** — Bật hoặc tắt chế độ bảo trì của mô-đun. Chế độ bảo trì nhẹ này vẫn cho phép các hook của WHMCS và thành phần khác hoạt động, khác với chế độ bảo trì hệ thống.
- **Thu thập biến Smarty** — Bật hoặc tắt việc thu thập các biến Smarty.
- **Sử dụng các biến Smarty đã thu thập** — Bật hoặc tắt việc sử dụng các biến Smarty đã thu thập trong trình chỉnh sửa trang.
- **Ghi đè trang** — Bật hoặc tắt tính năng ghi đè trang.
- **Tần suất cập nhật** — Nếu không chọn mục nào, sơ đồ trang web sẽ được cập nhật hằng ngày.
- **Sơ đồ trang web HTML** — Khi bật, /html-sitemap hiển thị sơ đồ trang web như một trang HTML thông thường; sitemap.xml không bị ảnh hưởng.
- **Phần đầu trang web** — Mã HTML tùy chỉnh trong phần <head>, bao gồm <script> và <style>.
- **Phần chân trang web** — Mã HTML tùy chỉnh trước </body>, bao gồm <script> và <style>.
- **Chỉnh sửa robots.txt**
