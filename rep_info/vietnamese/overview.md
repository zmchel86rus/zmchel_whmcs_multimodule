# Mô-đun đa năng miễn phí cho WHMCS

**zmchel WHMCS Multimodule miễn phí.** Ngay trong khu vực quản trị WHMCS, bạn có thể quản lý trang đa ngôn ngữ bằng trình biên tập trực quan, menu, thư viện ảnh, siêu dữ liệu SEO, sơ đồ trang XML, chuyển hướng, quy tắc rewrite và nhập/xuất dữ liệu. Xem [hướng dẫn sử dụng](instruction.md) trước khi bắt đầu.

## Trước khi sử dụng lần đầu

**Trước lần sử dụng đầu tiên, hãy mở Cài đặt mô-đun → Ngôn ngữ được hỗ trợ và bật những ngôn ngữ bạn cần.**

Mỗi lần kích hoạt, mô-đun tự động tạo giá trị salt mới và ghi vào `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kiểm tra để bảo đảm cả ba giá trị salt đều đã được điền.

Mô-đun được phát triển và thử nghiệm trên **WHMCS 8.13.0–9.1.0**. Khả năng tương thích PHP đã được kiểm tra từ **7.4 đến 8.5**. Apache được hỗ trợ đầy đủ (100%); Nginx có thể cần cấu hình thêm để định tuyến ngôn ngữ ở trang chủ.

## Hướng phát triển

- Thêm trang lồng nhau và danh mục hoặc chuyên mục trang.
- Tách mã nguyên khối thành các thành phần tương tác.
- Xây dựng trình quản lý quyền truy cập quản trị và mở rộng ngôn ngữ mặc định trong `supported_langs.php`.
- Tạo trình sửa mã cho tệp `.tpl` của mô-đun và giao diện khách hàng WHMCS, không gồm giao diện quản trị.
- ~~Phát triển trình quản lý ngôn ngữ cho tệp của mô-đun và WHMCS.~~
- Cải thiện trình quản lý phương tiện.
- Xây dựng trình quản lý SEO đầy đủ, lấy cảm hứng từ Yoast SEO nhưng được tối ưu hơn.
- ~~Thêm sơ đồ trang đa ngôn ngữ và trang sơ đồ HTML.~~
- Thêm trang sơ đồ trang web bằng HTML.
- Thêm thống kê sử dụng vào trình quản lý trang.
- Tạo công cụ tối ưu hóa JS, CSS, HTML, bộ nhớ đệm toàn trang và các bảng dữ liệu của mô-đun và WHMCS.
- Xây dựng hệ thống cập nhật mô-đun hoàn chỉnh.

Đây là **ý tưởng cho tương lai, không phải lịch phát hành cố định**.

## Đề xuất ý tưởng hoặc đặt câu hỏi

[Gửi đề xuất](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) hoặc [đặt câu hỏi](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) qua `ackirkin@gmail.com`.
