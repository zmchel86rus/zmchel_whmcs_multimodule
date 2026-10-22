# Hướng dẫn sử dụng zmchel WHMCS Multimodule

**Trước khi dùng mô-đun, hãy tạo các salt riêng và điền vào `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` và `ZM_PB_NONCE_SALT`.** Mô-đun được phát triển và thử nghiệm trên **WHMCS 8.13.1–8.13.7**; khả năng tương thích PHP đã được kiểm tra từ **7.4 đến 8.5**. Apache được hỗ trợ đầy đủ; Nginx có thể cần cấu hình thêm cho định tuyến ngôn ngữ ở trang chủ. **Mô-đun hoàn toàn miễn phí.**

**Trước lần sử dụng đầu tiên, hãy mở Cài đặt mô-đun → Ngôn ngữ được hỗ trợ và bật những ngôn ngữ bạn cần.**

## Trình quản lý ngôn ngữ (đang phát triển)

Trong khu vực quản trị WHMCS, mở Trình quản lý ngôn ngữ rồi chọn mục (ngôn ngữ khách hàng hoặc quản trị của WHMCS, mô-đun này hay mô-đun khác) và ngôn ngữ. So sánh bản gốc hoặc bản tham chiếu với bản dịch, sửa một dòng và lưu; bạn cũng có thể xuất và nhập các khóa hiện có dưới dạng JSON. Ngôn ngữ mới dùng bản tham chiếu cho tới khi được dịch. Trình quản lý bật hoặc tắt tệp ngôn ngữ và sửa tên tệp cũ; hãy đổi ngôn ngữ mặc định trong WHMCS trước.

## Bắt đầu và tạo trang

Trong khu vực quản trị WHMCS, mở **Addons → zmchel WHMCS Multimodule**. Trước khi sửa URL, chuyển hướng hoặc quy tắc máy chủ, hãy xuất cấu hình mô-đun. Ở danh sách trang, tạo trang với tên nội bộ và *slug* như `gioi-thieu`, không kèm tên miền hay `.php`. Chọn quyền xem cho mọi người, khách hàng đã đăng nhập hoặc cả hai; tiếp theo chọn trạng thái nháp hay đã xuất bản, loại trang và ngôn ngữ. Ngôn ngữ mặc định của WHMCS phải có trong `supported_langs.php`.

Sau khi lưu, mở trang để biên tập nội dung, siêu dữ liệu và cài đặt sơ đồ trang cho từng ngôn ngữ. Mỗi phần có nút Lưu riêng. Kiểm tra thông báo kết quả và mở trang công khai. Thao tác xóa đầu tiên đưa trang vào thùng rác; chỉ trong thùng rác mới xóa vĩnh viễn.

## Trình biên tập và ngôn ngữ

Chọn ngôn ngữ trong thẻ nội dung, kéo khối GrapesJS vào vùng làm việc rồi chỉnh văn bản, hình ảnh và tùy chọn. Có các khối bố cục, cột, bảng, FAQ, biểu mẫu liên hệ, danh sách, phân trang và vùng nội dung dành cho khách hoặc thành viên. Bạn có thể sao chép bố cục sang ngôn ngữ khác, dịch văn bản rồi lưu. Khối liên kết và nút có tùy chọn thêm ngôn ngữ hiện tại vào URL nội bộ; tắt tùy chọn này với liên kết ngoài, tệp, `mailto:` và các đường dẫn WHMCS không có bản dịch.

Khi bật URL đẹp và định tuyến ngôn ngữ, ngôn ngữ chính dùng đường dẫn ngắn như `/vi/`, hoặc không có tiền tố nếu tắt tùy chọn đường dẫn cho ngôn ngữ mặc định. Các biến thể vùng miền dùng locale BCP 47. Hãy kiểm tra liên kết bằng nhiều ngôn ngữ.

## SEO, phương tiện và menu

Điền tiêu đề, mô tả, robots, URL chuẩn và dữ liệu mạng xã hội cho từng ngôn ngữ. Trang đã xuất bản, không phải trang hệ thống, có thể xuất hiện trong sơ đồ trang XML. Tải hình qua Media Manager, thêm văn bản thay thế và kiểm tra chất lượng sau tối ưu hóa. Trong Menu Manager, sắp xếp trang và liên kết tùy chỉnh, đặt nhãn theo ngôn ngữ, vị trí và cách hiển thị trên máy tính hoặc điện thoại.

## Chuyển hướng và bảo trì

Dùng Redirect Manager cho chuyển hướng `301` vĩnh viễn hoặc `302` tạm thời. Rewrite Manager ghi quy tắc `.htaccess` cho Apache; Nginx cần quy tắc tương ứng trong cấu hình máy chủ. Thử các URL mới khi chưa và đã đăng nhập. Xuất JSON trước khi nhập lượng dữ liệu lớn, sau đó kiểm tra trang, menu và thư viện ảnh. Tài liệu chi tiết bằng tiếng Anh: [menu](../english/docs/menus.md), [phân trang](../english/docs/pagination.md), [chuyển hướng](../english/docs/redirects.md), [sơ đồ trang](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [dữ liệu có cấu trúc](../english/docs/structured-data.md) và [chuyển dữ liệu](../english/docs/transfer.md).
