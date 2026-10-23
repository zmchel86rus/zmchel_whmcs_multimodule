# Chuyển dữ liệu

Một tệp JSON cho tất cả hoặc các mục được chọn, tối đa 32 MiB (đồng thời chịu giới hạn tải lên của PHP). Các trang trùng khớp được cập nhật theo slug và loại quyền truy cập, menu theo tên. Các bản ghi khác được giữ nguyên. Hãy bao gồm dữ liệu trang khi nhập menu vào một trang web mới. Các mục được chọn nhưng không có trong tệp sẽ được bỏ qua.

CSS/JS được xuất cùng với các trang; hình ảnh và các tệp đã tải lên khác được xuất cùng thư viện phương tiện. Lịch sử phiên bản, các biến Smarty đã thu thập và thông tin bí mật của WHMCS không được xuất. Hãy tạo lại sơ đồ trang web sau khi nhập và áp dụng các quy tắc viết lại trong Trình quản lý quy tắc viết lại URL.

Trang và bài viết (bản dịch, nội dung, SEO, cài đặt sơ đồ trang web, khối CSS/JS)

Các bản ghi trùng khớp trong những mục đã chọn sẽ được cập nhật từ tệp. Tiếp tục?

## JSON

Bản xuất có thể gồm trang và bài viết kèm bản dịch, nội dung, SEO và CSS/JS; trình đơn cùng cấu trúc và vị trí; cài đặt, chuyển hướng, quy tắc tùy chỉnh và thư viện phương tiện cùng tệp. Lịch sử sửa đổi, biến Smarty đã thu thập, tài khoản và thông tin bí mật WHMCS cùng tệp giao diện không được đưa vào. Tệp JSON giới hạn 32 MiB; các giới hạn PHP `upload_max_filesize` và `post_max_size` cũng áp dụng. Khi chuyển trình đơn sang trang khác, hãy nhập cả các trang và xử lý trước những tên trình đơn trùng nhau.

Tệp xuất dùng định dạng `zmchel_whmcs_multimodule` (phiên bản 1). Khi nhập, URL của trang nguồn được điều chỉnh theo `SystemURL` của trang đích, còn liên kết ngoài được giữ nguyên. Việc nhập không tạo bảng: hãy chuẩn bị bảng trước trong Cơ sở dữ liệu của mô-đun. Trước khi bắt đầu sẽ có bước xác nhận; bản ghi được thay đổi trong giao dịch và tệp bị thay thế được khôi phục nếu có lỗi.

## Hướng dẫn

- Menu và vị trí hiển thị
- Cài đặt mô-đun, ghi đè trang, head/footer, robots.txt
- Chuyển hướng
- Quy tắc viết lại URL tùy chỉnh
- Thư viện phương tiện (tệp và mô tả)
