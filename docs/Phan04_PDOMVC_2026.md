XÂY DỰNG TRANG WEB MVC
      SỬ DỤNG PDO
           Nguyễn Hoàng Tùng
           Bộ môn Kỹ thuật phần mềm
           nhoangtung@agu.edu.vn
           www.nhtung.id.vn
Nội dung chính của phần này
❑ Tại sao lại sử dụng MVC?
❑ Mô hình MVC là gì?
❑ Cấu trúc thư mục.
❑ Các thành phần chính.




20/07/2026                   Công nghệ Web - PHP   2
Tại sao lại sử dụng MVC?
❑ Muốn hiểu tại sao người ta chia một phần mềm có lưu trữ dữ liệu thành 3 lớp
  (MVC), thì phải nhìn từ lịch sử lập trình, nghĩa là tại sao người ta cần chia một phần
  mềm ra thành nhiều phần khác nhau? Rồi những phần đó tại sao lại được xếp
  nhóm vào 3 lớp chính là Model, View và Controller?




                             Từ đây trở đi, thuật ngữ phần mềm có nghĩa là phần mềm có lưu trữ dữ liệu.


20/07/2026                             Công nghệ Web - PHP                                             3
Tại sao lại sử dụng MVC?
❑ Sau nhiều năm phát triển, kinh nghiệm cho người ta thấy chia phần mềm thành
  MVC sẽ có tác dụng tốt nhất cho:
    ⚫ Phát triển phần mềm: Có tính chuyên nghiệp hóa, có thể chia cho nhiều nhóm được
      đào tạo nhiều kỹ năng khác nhau, từ thiết kế mỹ thuật cho đến lập trình đến tổ chức
      Database.
    ⚫ Bảo trì: Với các lớp được phân chia theo như đã nói, thì các thành phần của một hệ
      thống dễ được thay đổi, nhưng sự thay đổi có thể được cô lập trong từng lớp, hoặc chỉ
      ảnh hưởng đến lớp ngay gần kề của nó, chứ không phát tán náo loạn trong cả chương
      trình.
    ⚫ Mở rộng: Việc thêm chức năng vào cho từng lớp sẽ dễ dàng hơn là phân chia theo
      cách khác.


20/07/2026                            Công nghệ Web - PHP                                 4
Nội dung chính của phần này
❑ Tại sao lại sử dụng MVC?
❑ Mô hình MVC là gì?
❑ Cấu trúc thư mục.
❑ Các thành phần chính.




20/07/2026                   Công nghệ Web - PHP   5
Mô hình MVC là gì?
❑ Mô hình MVC (Model - View - Controller) là một kiến trúc phần mềm hay mẫu thiết
  kế (design pattern) được sử dụng trong xây dựng phần mềm. Nó giúp cho người
  phát triển tách ứng dụng của họ ra 3 thành phần khác nhau Model, View và
  Controller. Mỗi thành phần có một nhiệm vụ riêng biệt và độc lập với các thành
  phần khác.
❑ Mô hình này được dùng khá rộng rãi và đặc biệt là trong các dự án web.
❑ Trong PHP có khá nhiều framework (Laravel, Symfony, CodeIgniter,…) và tất cả đều sử dụng
  mô hình MVC.




20/07/2026                            Công nghệ Web - PHP                                6
Các thành phần của mô hình MVC




                 Mô hình MVC về mặt lý thuyết

20/07/2026              Công nghệ Web - PHP     7
Các thành phần của mô hình MVC
❑ Model: Đại diện cho cấu trúc dữ liệu và xử lý các logic nghiệp vụ (Business logic)
  của ứng dụng. Model thường là nơi chứa các lệnh tương tác trực tiếp với Database.
❑ View: Có nhiệm vụ tiếp nhận dữ liệu từ Controller và hiển thị nội dung ra trình duyệt
  dưới dạng HTML.
❑ Controller: Đóng vai trò trung gian giữa Model và View. Nó có nhiệm vụ tiếp nhận
  request từ client, gọi các phương thức tương ứng từ Model và gửi dữ liệu qua View
  tương ứng.




20/07/2026                           Công nghệ Web - PHP                              8
Ưu điểm – Nhược điểm
❑ Ưu điểm
    ⚫ Hệ thống phân ra từng phần nên dễ dàng phát triển.
    ⚫ Chia thành nhiều mô-đun nên nhiều người có thể làm chung dự án.
    ⚫ Dễ bảo trì, nâng cấp, debug trong quá trình phát triển hệ thống.
❑ Nhược điểm
    ⚫ Xây dựng web với các Framework MVC có thể có độ trễ (overhead) cao hơn so với viết
      file PHP đơn giản, do hệ thống phải nạp nhiều thư viện và đi qua nhiều luồng xử lý.
    ⚫ Xây dựng cầu kỳ và mất thời gian để xây dựng thư viện, cấu trúc.
    ⚫ Cần kiến thức về lập trình hướng đối tượng và xử lý mảng.




20/07/2026                              Công nghệ Web - PHP                             9
Nội dung chính của phần này
❑ Tại sao lại sử dụng MVC?
❑ Mô hình MVC là gì?
❑ Cấu trúc thư mục.
❑ Các thành phần chính.




20/07/2026                   Công nghệ Web - PHP   10
Cấu trúc thư mục
                             ⚫ controllers: Class
                             ⚫ libs: Khai báo hằng số
                             ⚫ models: Class
                             ⚫ public: CSS, JS, Images
                             ⚫ storage: Lưu trữ dữ liệu
                             ⚫ views: HTML
                             ⚫ index.php: Trang chủ




20/07/2026         Công nghệ Web - PHP                    11
Nội dung chính của phần này
❑ Tại sao lại sử dụng MVC?
❑ Mô hình MVC là gì?
❑ Cấu trúc thư mục.
❑ Các thành phần chính.




20/07/2026                   Công nghệ Web - PHP   12
libs
             ❑ Khai báo thư viện và các lớp dùng chung.
             ❑ config.php
             <?php
                define('DB_HOST', 'localhost');
                define('DB_USER', 'root');
                define('DB_PASS', 'root');
                define('DB_NAME', 'trangtin');
                date_default_timezone_set('Asia/Ho_Chi_Minh');
             ?>




20/07/2026                  Công nghệ Web - PHP                  13
models
                                   models/database.php




20/07/2026   Công nghệ Web - PHP                         14
models
                       models/chude.php




20/07/2026   Công nghệ Web - PHP          15
models
                               models/chude.php




20/07/2026   Công nghệ Web - PHP                  16
models
                                   models/chude.php




20/07/2026   Công nghệ Web - PHP                      17
models
                               models/chude.php




20/07/2026   Công nghệ Web - PHP                  18
models
                               models/chude.php




20/07/2026   Công nghệ Web - PHP                  19
controllers
               controllers/chude.php




20/07/2026    Công nghệ Web - PHP      20
public
             ❑ Chứa các tập tin CSS, JS và hình ảnh dùng chung trong
               việc thiết kế giao diện.
             ❑ Thường dùng các thư viện:
                ⚫ Bootstrap
                ⚫ W3.CSS, W3.JS
                ⚫ CKEditor, CKFinder
                ⚫ DataTables jQuery
                ⚫ …




20/07/2026              Công nghệ Web - PHP                       21
storage
             ❑ Chứa các tập tin, hình ảnh liên quan đến bài viết; dữ liệu
               upload từ clients.
             ❑ Khi đưa project lên host, phải đảm bảo rằng thư mục
               storage có quyền ghi (writeable).




20/07/2026              Công nghệ Web - PHP                            22
views


                                                                        Các tập tin giao diện
                                                                            dùng chung




⚫ routes.php: Điều hướng các request của client tới các Controller tương ứng.
⚫ error.php: Hiện thông báo lỗi khi có vấn đề tương tác với dữ liệu.
⚫ success.php: Hiện thông báo khi hoàn thành tương tác.
20/07/2026                              Công nghệ Web - PHP                                     23
views
                    views/layouts/routes.php




                   Liên kết lúc này có dạng:
                   index.php?action=chude_them
                   index.php?action=chude_them_xuly
                   index.php?action=chude_sua&id=[1,2,…]
                   index.php?action=chude_sua_xuly
                   index.php?action=chude_xoa&id=[1,2,…]




20/07/2026   Công nghệ Web - PHP                           24
index.php
             ❑ Trang chủ của toàn bộ project.
             <?php
                include_once "views/layouts/header.php";
                include_once "views/layouts/navbar.php";
                include_once "views/layouts/routes.php";
                include_once "views/layouts/footer.php";
             ?>




20/07/2026              Công nghệ Web - PHP                25
Giải đáp thắc mắc




20/07/2026          Công nghệ Web - PHP   26
