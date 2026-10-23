# Trình quản lý trang

## Bắt đầu và tạo trang

Trong khu vực quản trị WHMCS, mở **Addons → zmchel WHMCS Multimodule**. Trước khi sửa URL, chuyển hướng hoặc quy tắc máy chủ, hãy xuất cấu hình mô-đun. Ở danh sách trang, tạo trang với tên nội bộ và *slug* như `gioi-thieu`, không kèm tên miền hay `.php`. Chọn quyền xem cho mọi người, khách hàng đã đăng nhập hoặc cả hai; tiếp theo chọn trạng thái nháp hay đã xuất bản, loại trang và ngôn ngữ. Ngôn ngữ mặc định của WHMCS phải có trong `supported_langs.php`.

Sau khi lưu, mở trang để biên tập nội dung, siêu dữ liệu và cài đặt sơ đồ trang cho từng ngôn ngữ. Mỗi phần có nút Lưu riêng. Kiểm tra thông báo kết quả và mở trang công khai. Thao tác xóa đầu tiên đưa trang vào thùng rác; chỉ trong thùng rác mới xóa vĩnh viễn.

## URL

Lọc danh sách theo tên, quyền truy cập, loại, trạng thái hoặc ngôn ngữ. **Truy cập** mở URL công khai. **Xóa** trước tiên chuyển trang vào thùng rác; việc xóa vĩnh viễn thực hiện tại đó. Nếu trang không mở được, hãy kiểm tra trạng thái xuất bản, ngôn ngữ đang hoạt động và loại quyền truy cập.

## WHMCS

Để thay thế một trang WHMCS, chọn địa chỉ hệ thống hiện có và một trang mô-đun đã xuất bản. Chọn thay thế toàn bộ, thêm trước hoặc sau nội dung mặc định, hoặc chỉ thay meta/SEO. Lưu và thử URL WHMCS gốc với tư cách khách và khách hàng đã đăng nhập.

## Hướng dẫn

- Thêm trang
- **Tên trang** — Tên nội bộ của trang
- **Slug của trang** — Chỉ cho phép chữ cái Latinh, dấu gạch nối và chữ số.
- **Loại quyền truy cập** — Người dùng đã đăng nhập: chỉ người đã đăng nhập mới truy cập được trang; Khách truy cập: chỉ người chưa đăng nhập mới truy cập được; Hỗn hợp: mọi người đều có thể truy cập, còn khả năng hiển thị được kiểm soát bằng các khối trong trang.
- **Loại trang** — Các trang hệ thống không được đưa vào sơ đồ trang web và người dùng thông thường không thể truy cập.
- **Ngôn ngữ của trang** — Ngôn ngữ mặc định luôn được bao gồm bất kể lựa chọn của bạn.
- Ghi đè toàn bộ thay thế nội dung và siêu dữ liệu đang hiển thị. Thêm vào trước đặt nội dung phía trước nội dung hiện có của trang. Thêm vào sau đặt nội dung phía sau nội dung hiện có của trang. Chỉ siêu dữ liệu/SEO thay thế siêu dữ liệu của trang.
- Điều hướng danh sách trang
