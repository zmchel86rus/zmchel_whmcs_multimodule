# Phân trang

Nhấp vào khối danh sách. Nhấn Esc để hủy. Đặt khối phân trang bên ngoài khối đích.

Đối với Smarty, nhập biến chứa toàn bộ danh sách. Nếu không có biến, các phần tử HTML trong vùng chứa sẽ được phân trang; có thể chỉ định thêm lớp CSS của hàng hoặc thẻ tr. Các liên kết giữ nguyên count, sort và bộ lọc. Hỗ trợ nhiều danh sách độc lập.

Chọn số mục mỗi trang: 10, 25, 50, 100, 250

Kéo bộ chọn số mục mỗi trang vào bên trong khối phân trang hoặc sang các khối khác trên trang. Bộ chọn vẫn được liên kết với khối phân trang này.

Không lập chỉ mục từ trang 2 trở đi

Chọn khối danh sách Smarty. Tìm kiếm và phân trang phải cùng liên kết tới một khối.

Đặt biến chứa toàn bộ danh sách. Tìm kiếm khớp với bất kỳ trường nào đã chọn; các bộ lọc được kết hợp với nhau. Điều kiện được áp dụng trước khi tính số trang; thao tác áp dụng hoặc đặt lại sẽ quay về trang đầu tiên. Nếu đã có liên kết phân trang, hệ thống sẽ sử dụng biến của phân trang đó.

## Liên kết và nguồn danh sách

Đặt phân trang bên ngoài khối danh sách và chọn khối đó làm đích. Với danh sách Smarty, nhập biến chứa toàn bộ mục; nếu không, các phần tử HTML của vùng chứa sẽ được chia. Chọn dạng liên kết theo cài đặt mô-đun, `/page/2/` hoặc `?page=2`. Dạng đường dẫn cần quy tắc rewrite. Các danh sách độc lập dùng tham số riêng; liên kết giữ ngôn ngữ, bộ lọc và thứ tự sắp xếp.

## Kích thước trang, SEO và bộ lọc

Đặt số mục và nếu cần bật lựa chọn 10/25/50/100/250. Đổi kích thước đưa danh sách về trang đầu. Noindex chỉ áp dụng từ trang thứ hai; kiểm tra tiêu đề và URL chuẩn. Gắn bộ lọc vào cùng danh sách, rồi thử trang thứ hai và kết quả đã lọc trên website công khai.

## page / count / pager

Với danh sách Smarty, hãy chỉ định biến chứa toàn bộ mục và giữ vòng lặp `{foreach}`: mô-đun chia danh sách, nên đừng thêm `array_slice` lần thứ hai. Khi không có biến, các phần tử HTML trong vùng chứa được phân trang; có thể chọn lớp của hàng hoặc thẻ `tr`, còn `thead` và `tfoot` được giữ nguyên. Đặt số nút quanh trang hiện tại riêng cho máy tính và điện thoại. Với tuyến PHP trực tiếp hãy dùng `?page=2`; `/page/2/` cần quy tắc rewrite. Các trang tiếp theo có canonical riêng và có thể đặt `noindex`.

Khi có nhiều danh sách độc lập, danh sách đầu dùng `page`, `count` và `sort`; các danh sách khác dùng tham số kèm ID khối. Với đường dẫn `/page/N/`, `pager` cho biết số trang thuộc danh sách nào. Trong khối Smarty, `$zm_pagination` cung cấp `total`, `page`, `pages`, `count` và `offset`. `count` bị giới hạn trong khoảng 10–250. Nếu danh sách rỗng hoặc chỉ có một trang, bảng phân trang sẽ ẩn.

## YYYY-MM-DD

Bộ lọc hoạt động trên cùng danh sách với phân trang. Tìm kiếm văn bản có thể kiểm tra nhiều trường ngăn cách bằng dấu phẩy; khoảng ngày dùng `YYYY-MM-DD` và bao gồm cả ngày cuối.

## Flex / Grid

Chọn Flex hoặc Grid, điều chỉnh chiều rộng và số cột theo thiết bị. Áp dụng hay xóa bộ lọc đưa danh sách về trang đầu. Bộ chọn số kết quả có thể di chuyển mà vẫn liên kết; bảng điều khiển nhân đôi quản lý cùng danh sách.

## Hướng dẫn

- Định dạng liên kết
- Số mục mặc định mỗi trang
