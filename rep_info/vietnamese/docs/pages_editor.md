# Trình chỉnh sửa trang

- [phân trang](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [dữ liệu có cấu trúc](module_structured_data.md)

## Trình biên tập và ngôn ngữ

Chọn ngôn ngữ trong thẻ nội dung, kéo khối GrapesJS vào vùng làm việc rồi chỉnh văn bản, hình ảnh và tùy chọn. Có các khối bố cục, cột, bảng, FAQ, biểu mẫu liên hệ, danh sách, phân trang và vùng nội dung dành cho khách hoặc thành viên. Bạn có thể sao chép bố cục sang ngôn ngữ khác, dịch văn bản rồi lưu. Khối liên kết và nút có tùy chọn thêm ngôn ngữ hiện tại vào URL nội bộ; tắt tùy chọn này với liên kết ngoài, tệp, `mailto:` và các đường dẫn WHMCS không có bản dịch.

Khi bật URL đẹp và định tuyến ngôn ngữ, ngôn ngữ chính dùng đường dẫn ngắn như `/vi/`, hoặc không có tiền tố nếu tắt tùy chọn đường dẫn cho ngôn ngữ mặc định. Các biến thể vùng miền dùng locale BCP 47. Hãy kiểm tra liên kết bằng nhiều ngôn ngữ.

## WHMCS

Trong cài đặt cơ bản, kiểm tra tên, slug, loại, trạng thái, quyền truy cập và ngôn ngữ. Ngôn ngữ mặc định của WHMCS phải được bật trong mô-đun; trang đã xuất bản cần có nội dung bằng ngôn ngữ hiển thị.

## SEO

Điền tiêu đề và mô tả cho từng ngôn ngữ, sau đó kiểm tra canonical, robots, Open Graph, đường dẫn điều hướng và Schema. Trong thẻ sơ đồ trang, chọn tần suất và mức ưu tiên cho trang công khai không thuộc hệ thống. Lưu rồi kiểm tra URL công khai và XML.

## Biểu mẫu liên hệ

Thêm khối **Biểu mẫu liên hệ**. Chọn **phiếu hỗ trợ WHMCS** và bộ phận hỗ trợ hoặc **email** và người nhận; điền tiêu đề, mô tả, chủ đề và chữ trên nút. Đặt tên, loại, tính bắt buộc và quy tắc kiểm tra cho từng trường. Phiếu của khách cần các trường được gán vai trò tên và email người gửi. Với danh sách thả xuống, ghi một lựa chọn mỗi dòng, chẳng hạn `sales : Bán hàng`. Tạo trường riêng cho từng sự đồng ý và dùng CAPTCHA đã cấu hình trong WHMCS. Lưu rồi gửi thử thật với tư cách khách; kiểm tra phiếu hoặc thư, lỗi và việc đặt lại biểu mẫu. Trạng thái xanh của trình soạn thảo không xác nhận đã gửi; nếu `mail()` lỗi, cấu hình SMTP trong WHMCS.

## Hướng dẫn

- Vùng chứa bố cục Flex lồng nhau. Kéo các khối khác vào bên trong.
- Vùng chứa CSS Grid lồng nhau. Kéo các khối khác vào bên trong.
- Băng chuyền Bootstrap lồng nhau. Kéo các khối vào bên trong; mỗi khối sẽ trở thành một trang trình chiếu.
- Tất cả các khối nằm dưới khối này chỉ hiển thị với người dùng đã đăng nhập. Chỉ hoạt động khi loại quyền truy cập của trang là Hỗn hợp.
- Tất cả các khối nằm dưới khối này chỉ hiển thị với khách truy cập. Chỉ hoạt động khi loại quyền truy cập của trang là Hỗn hợp.
- **Tiêu đề trang**
- **Mô tả meta**
- **URL chính tắc**
- **Robots** — index, follow / noindex, nofollow. Kiểm soát việc lập chỉ mục.
- **Loại Schema** — Khi tắt, mã đánh dấu JSON Schema.org sẽ không được xuất cho trang này.
