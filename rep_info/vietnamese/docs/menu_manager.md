# Menu

Tạo menu, thêm trang hoặc liên kết tùy chỉnh rồi kéo thả để sắp xếp mục. Chọn mục cha cho menu con; đặt nhãn theo ngôn ngữ, quyền hiển thị cho khách hoặc khách hàng và thiết bị. Gán vị trí; mỗi vị trí chỉ có một menu. Với liên kết nội bộ, chọn có điều chỉnh URL theo ngôn ngữ hiện tại hay không. Kiểm tra menu công khai trên máy tính và điện thoại.

Mỗi mục có thể đặt tiêu đề, mô tả, lớp CSS, `rel`, biểu tượng và tùy chọn mở trong thẻ mới; trang đã xuất bản cũng có thể được thêm tự động. Chọn riêng cho máy tính và điện thoại việc trình đơn bổ sung hay thay thế điều hướng WHMCS. Liên kết đến trang của mô-đun được tính lại theo slug, ngôn ngữ và chế độ URL hiện tại; nhãn trống dùng tiêu đề đã dịch hoặc tên trang. Truy cập trang không đổi ngôn ngữ trong hồ sơ khách hàng. Máy chủ từ chối lược đồ URL không an toàn và HTML trong nhãn.

## WHMCS

Bật các vị trí menu WHMCS cần dùng trong phần cài đặt mô-đun. Mỗi vị trí chỉ nhận một menu, nhưng cùng một menu có thể dùng ở nhiều vị trí. Giao diện máy tính áp dụng từ độ rộng 768 px, còn màn hình hẹp hơn dùng giao diện di động. Khi một vị trí bị tắt, menu mặc định của WHMCS không thay đổi.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Trên các tuyến hệ thống WHMCS không dùng định tuyến ngôn ngữ của mô-đun, nhãn trình đơn dùng ngôn ngữ đã lưu của khách; trang mô-đun dùng ngôn ngữ trong URL. Khi ngôn ngữ mặc định có tuyến riêng, nó cũng có tiền tố. URL thường là `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Có thể giữ nguyên liên kết tùy chỉnh không bản địa hóa, chẳng hạn `clientarea.php`. Ẩn mục cha sẽ ẩn toàn bộ nhánh.

URL của mục trang được tính lại từ slug hiện tại và bản dịch đã xuất bản. Nếu thiếu bản dịch, mô-đun dùng phiên bản đã xuất bản bằng ngôn ngữ mặc định. Liên kết tùy chỉnh có thể giữ nguyên URL đã nhập; địa chỉ ngoài, mailto, tel và liên kết neo không có tiền tố ngôn ngữ. Bản nháp, trang đã xóa hoặc trang không có quyền truy cập sẽ không hiển thị.

## zm_pb_menus

Dữ liệu nằm trong các bảng `zm_pb_menus`, `zm_pb_menu_items` và `zm_pb_menu_locations`. Hãy tạo hoặc sửa các bảng trong mục Cơ sở dữ liệu của mô-đun. Cây menu hỗ trợ tối đa 10 cấp và 300 mục; khi xóa mục cha, các mục con được đưa lên một cấp.

## Hướng dẫn

- Tạo menu
- Thêm trang, bài viết hoặc liên kết tùy chỉnh.
- Kéo các mục để thay đổi thứ tự. Thiết lập cấp lồng nhau bằng bộ chọn mục cha hoặc các nút di chuyển.
- Sử dụng ngôn ngữ của trang hiện tại
- Giữ nguyên URL đã nhập
- Nhãn ở các ngôn ngữ khác
- Hiển thị cho
- Thiết bị
- Mỗi vị trí chỉ có thể được gán cho một menu. Khi chọn một vị trí, vị trí đó sẽ được chuyển từ menu khác sang menu này.
- Các mục cấp cao nhất sẽ trở thành cột và các mục lồng nhau sẽ trở thành liên kết. Sử dụng URL # để tạo tiêu đề không có liên kết.
- Các bảng menu chưa được tạo. Hãy thêm chúng trong phần Cơ sở dữ liệu mô-đun.
