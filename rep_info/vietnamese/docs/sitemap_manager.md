# Sơ đồ trang

Việc tạo sơ đồ tự động chạy sau tác vụ cron của WHMCS khi đến kỳ cập nhật. Có thể chạy tạo thủ công ngay lập tức.

Bao gồm các trang và bài viết đang hoạt động mà khách có thể truy cập, kể cả các phiên bản ngôn ngữ đã xuất bản. Các trang ghi đè sử dụng URL công khai của trang mà chúng thay thế.

Các tệp trong thư mục gốc của trang web

Nếu không chọn mục nào, sơ đồ trang web sẽ được cập nhật hằng ngày.

Khi bật, /html-sitemap hiển thị sơ đồ trang web như một trang HTML thông thường; sitemap.xml không bị ảnh hưởng.

## XML

XML có liên kết qua lại cho các ngôn ngữ đang hoạt động và `x-default` cho địa chỉ ngôn ngữ mặc định. Nguồn của chuyển hướng không được đưa vào `loc` hoặc biến thể ngôn ngữ; nội dung dự phòng được đánh dấu theo ngôn ngữ thực tế. Tệp trang và bài viết khai báo không gian tên XHTML.

Hook `AfterCronJob` so sánh khoảng `ZM_PB_SITEMAP_UPDFREQ` với thời điểm tạo thành công gần nhất `ZM_PB_SITEMAP_LASTUPD`; khi tắt sitemap, tạo thủ công cũng không khả dụng. Phiên bản ngôn ngữ được chọn theo `lang_active`, không theo `lang_status`. Các phần bổ sung mang hậu tố `_2`, `_3` và tiếp theo. Nếu tạo thất bại, tệp cũ được khôi phục và thời điểm thành công không đổi. Kiểm tra quyền ghi ở thư mục gốc, `resources/` và `inc/editable_consts.php`; sửa bảng riêng trong cơ sở dữ liệu mô-đun.

Việc tạo tự động phụ thuộc vào cron WHMCS và khoảng thời gian đã đặt; nút tạo sẽ chạy ngay. Chỉ trang và bài viết đã xuất bản mà khách có thể xem, cùng bản dịch đang hoạt động, được đưa vào. Nếu một trang thay thế trang hệ thống, URL công khai của trang hệ thống được dùng thay cho slug của trang thay thế. Tệp vượt 50.000 URL hoặc 50 MB được chia nhỏ. Tệp chỉ mục vẫn giữ các sơ đồ trang hợp lệ khác.

Mô-đun ghi `sitemap_index.xml`, `sitemap_pages.xml` và `sitemap_posts.xml` vào thư mục gốc của trang; danh mục rỗng không tạo tệp. Mô-đun không tạo `sitemap.xml` gộp. Sau khi sửa trang hoặc ngôn ngữ, hãy tạo lại sơ đồ và mở tệp chỉ mục trong trình duyệt. Nếu có lỗi, kiểm tra quyền ghi vào thư mục gốc; thời điểm tạo thành công gần nhất không đổi.

## Hướng dẫn

- Tạo sơ đồ trang web
- Lần tạo thành công gần nhất
- Lần cập nhật tiếp theo không sớm hơn
- **Tần suất cập nhật** — Nếu để trống, mặc định là 'monthly'.
- **Mức ưu tiên cập nhật** — Nếu để trống, mặc định là '0.5'.
