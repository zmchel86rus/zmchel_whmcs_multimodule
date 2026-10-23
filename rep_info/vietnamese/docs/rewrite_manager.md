# Quy tắc viết lại URL

## WHMCS

Quy tắc cho các URL theo ngôn ngữ, bao gồm các trang dưới tiền tố /ru/, /en/ và những tiền tố khác. Danh sách ngôn ngữ lấy từ supported_langs.php; các quy tắc được chèn vào .htaccess trước quy tắc của WHMCS.

Nginx không đọc .htaccess nên các quy tắc này không hoạt động trên Nginx. Hãy cấu hình các quy tắc tương đương trong nginx.

Phát hiện cấu hình nginx → Apache. Các quy tắc này chỉ hoạt động với yêu cầu được chuyển tiếp đến Apache; nginx không đọc .htaccess.

Sau khi thêm hoặc xóa quy tắc, hãy nhấp vào “Thêm hoặc cập nhật quy tắc” để áp dụng thay đổi vào .htaccess.

## .htaccess

Mở trình quản lý và so sánh các quy tắc với tệp `.htaccess` chính của trang. Với quy tắc riêng, lưu mẫu URL, đích và cờ; sau đó chọn **Thêm hoặc cập nhật quy tắc** để ghi khối trước các quy tắc WHMCS. Kiểm tra lại trạng thái và mở một trang đã xuất bản bằng ngôn ngữ mặc định và ngôn ngữ khác. Mẫu quá rộng có thể ảnh hưởng trang khác. Trong cấu hình Nginx → Apache, quy tắc chỉ áp dụng cho yêu cầu được chuyển đến Apache.

## Hướng dẫn

- Kiểm tra quy tắc
- Thêm hoặc cập nhật quy tắc
- Xóa tất cả quy tắc khỏi .htaccess
- Mẫu URL
- Đích
- Cờ
