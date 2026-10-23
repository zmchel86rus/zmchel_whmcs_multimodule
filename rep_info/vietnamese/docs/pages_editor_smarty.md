# Smarty

- **Cài đặt mô-đun → Thu thập biến Smarty → Sử dụng các biến Smarty đã thu thập → Trình chỉnh sửa trang.**

## Danh mục biến

Bật tính năng thu thập và sử dụng biến Smarty trong cài đặt mô-đun, sau đó mở các trang liên quan của website và tải lại trình chỉnh sửa. Danh mục lưu tên, kiểu và cấu trúc biến, chứ không lưu giá trị thực hay dữ liệu cá nhân. Nếu thiếu biến, hãy truy cập lại trang có sử dụng biến đó.

## Trình chỉnh sửa và giới hạn

Mở khối Smarty trong trình chỉnh sửa trang và chọn biến từ danh mục. Dùng điều kiện và vòng lặp được phép; thêm `|escape` khi hiển thị văn bản động. PHP, SQL, lời gọi phương thức, việc nhúng tệp và `nofilter` đều không được phép. Lưu trang rồi kiểm tra kết quả công khai.

## resources/available_vars/

Danh mục chỉ hướng dẫn về các biến đã quan sát trên một trang: nó không làm chúng khả dụng ở trang khác. Mã được kiểm tra khi lưu và trước khi xuất; khối nhận bản sao tách biệt của các giá trị được phép. Có thể dùng điều kiện, `foreach`, `assign` cục bộ và các bộ lọc như `escape`, `default`, `count`, `date_format`. Giá trị đầu ra được escape tự động; hãy viết HTML mong muốn trong mẫu. Nếu thiếu dữ liệu hoặc mã lỗi, khối sẽ trống và lỗi được ghi vào nhật ký PHP.

Danh mục trong `resources/available_vars/` lưu tên, kiểu, cấu trúc và ví dụ giả lập, không lưu giá trị thật. Danh mục cho biết biến từng xuất hiện ở đâu nhưng không khiến biến đó khả dụng trên trang khác. Nhấp đúp vào khối Smarty để mở trình soạn thảo. `Ctrl+Space` tìm biến, `Ctrl+S` áp dụng mã và `F11` mở toàn màn hình. Mã chạy tách biệt; nếu thiếu dữ liệu, khối để trống và cảnh báo được ghi vào nhật ký PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Hướng dẫn

- **Thu thập biến Smarty** — Bật hoặc tắt việc thu thập các biến Smarty.
- **Sử dụng các biến Smarty đã thu thập** — Bật hoặc tắt việc sử dụng các biến Smarty đã thu thập trong trình chỉnh sửa trang.
- Biến Smarty (PHP)
- Smarty: không cho phép PHP, phương thức đối tượng, lời gọi tĩnh và nofilter.
- Mẫu Smarty quá lớn.
- Smarty
- Trình chỉnh sửa Smarty

