# Chuyển hướng

Địa chỉ chính xác: nguồn → đích. Nguồn là đường dẫn tính từ thư mục gốc của trang web hoặc một URL thuộc trang web này. Đích là đường dẫn hoặc URL HTTP(S) đầy đủ. Quy tắc không có tham số truy vấn cũng áp dụng cho yêu cầu có tham số truy vấn; địa chỉ đích được sử dụng đúng như đã nhập. Các quy tắc áp dụng cho yêu cầu GET/HEAD đi đến WHMCS.

Mặc định: 14 ngày. Được tính từ lần thay đổi gần nhất đối với trang đã xuất bản hoặc bản dịch đang hoạt động của trang; nếu chưa từng thay đổi thì tính từ ngày tạo. Đặt 0 để không trì hoãn. Các quy tắc tự động sử dụng HTTP 301.

Địa chỉ của trang ghi đè tự động chuyển hướng đến trang hệ thống tương ứng mà chúng thay thế. Nếu một trang ghi đè có nhiều đích, hệ thống sử dụng đích được cấu hình đầu tiên. Các chuyển hướng này hoạt động khi tính năng ghi đè được bật, độc lập với quy tắc của Trình quản lý chuyển hướng.

Nhập đường dẫn hợp lệ bắt đầu bằng / hoặc URL HTTP(S) đầy đủ. Địa chỉ nguồn phải thuộc trang web này; không hỗ trợ phần neo #.

## HTTP

Quy tắc hỗ trợ mã HTTP `301`, `302`, `303`, `307`, `308` và chỉ áp dụng cho yêu cầu `GET`/`HEAD` đến được WHMCS. Nguồn được so khớp chính xác theo đường dẫn và, nếu có, tham số truy vấn; tham số của đích thay thế tham số cũ. Trình quản lý lưu quy tắc trong `zm_pb_redirects`, nhưng không tạo bảng trong lúc có yêu cầu: hãy dùng **Cơ sở dữ liệu mô-đun**. Các cột URL hiện có giới hạn 128 byte.

Quy tắc thủ công được ưu tiên hơn quy tắc tự động. Đổi slug của trang đã xuất bản có thể tạo chuyển hướng `301` tự động cho từng ngôn ngữ đang hoạt động sau thời gian chờ đã đặt; xuất bản bản nháp không tạo chuyển hướng này. Các lần đổi tên tiếp theo cập nhật đích cũ. Quy tắc có tham số truy vấn được ưu tiên hơn quy tắc chỉ khớp đường dẫn. URL nguồn phải thuộc trang này và không chứa đoạn `#`.

## Hướng dẫn

- Nguồn
- Đích
- Đã bật
- Đã tắt
