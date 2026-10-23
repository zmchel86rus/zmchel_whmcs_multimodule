# Dữ liệu có cấu trúc

- **Trình chỉnh sửa trang → Cài đặt siêu dữ liệu → Loại Schema → Lưu.**

## Nội dung mô-đun đánh dấu

Menu và mục lục có thể tạo `SiteNavigationElement`, phần hỏi đáp hiển thị tạo `FAQPage`, còn đường dẫn điều hướng nhiều mục tạo `BreadcrumbList`. Khối bố cục, nút và bộ lọc không tự động được gán loại nội dung. Loại Schema chọn cho trang quyết định JSON-LD của trang; khi tắt, phần đánh dấu này không được xuất ra.

## Kiểm tra sau khi xuất bản

Trên trang công khai, kiểm tra JSON-LD, URL chuẩn, ngôn ngữ và nội dung thực sự hiển thị. Đánh dấu hợp lệ không bảo đảm kết quả tìm kiếm mở rộng.

## Schema.org

`SiteNavigationElement` dùng các liên kết và nhãn menu thực sự hiển thị; mục lục có thể thêm `WebPageElement` cho những tiêu đề có thật trên trang. `FAQPage` chỉ gồm các câu hỏi và câu trả lời đầy đủ mà khách nhìn thấy: khối ẩn và accordion thông thường bị loại. `BreadcrumbList` chỉ được tạo khi có ít nhất hai mục. Dữ liệu tổ chức lấy từ WHMCS; ngôn ngữ liên hệ nằm trong `ContactPoint.availableLanguage` theo BCP 47. Mô-đun không tự đoán loại Schema cho bộ lọc, phân trang, biểu mẫu hoặc HTML tùy chỉnh.

## Hướng dẫn

- **Loại Schema** — Khi tắt, mã đánh dấu JSON Schema.org sẽ không được xuất cho trang này.
- **Đường dẫn phân cấp** — Tên trang trong đường dẫn phân cấp
- **URL chính tắc**
- **Tiêu đề trang**
- **Mô tả meta**
- **Tiêu đề Open Graph** — Nếu để trống, tiêu đề trang sẽ được sử dụng.
- **Mô tả Open Graph** — Nếu để trống, mô tả meta sẽ được sử dụng.
- **Hình ảnh Open Graph** — Nếu để trống, hình ảnh trang sẽ được sử dụng.
