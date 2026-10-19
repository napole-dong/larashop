CƠ SỞ DỮ LIỆU MYSQL

         Nguyễn Hoàng Tùng
         Bộ môn Kỹ thuật phần mềm
         nhoangtung@agu.edu.vn
         www.nhtung.id.vn
Nội dung chính của phần này
❑ Tổng quan.
❑ Kiểu dữ liệu.
❑ Các thuật ngữ và hàm hỗ trợ.
❑ Xây dựng câu truy vấn.




20/07/2026                       Công nghệ Web - PHP   2
Tổng quan
❑ MySQL là một Hệ quản trị cơ sở dữ liệu quan hệ (RDBMS - Relational Database
  Management System) mã nguồn mở.
❑ MySQL sở hữu bởi công ty MySQL AB của Thụy Điển, năm 2010, được bán lại cho
  Oracle Corporation. Sau đó đồng sáng lập Michael Widenius đã rẽ nhánh dự án
  MySQL để tạo ra MariaDB.
❑ Năm 2013, MySQL được đánh giá là CSDL được sử dụng nhiều thứ 2 trên thế giới.




20/07/2026                        Công nghệ Web - PHP                             3
Tổng quan
      Phiên bản   Ngày công bố                 Phiên bản cuối   Ngày ngưng hỗ trợ
       5.7 LTS    21/10/2015                           5.7.44       10/2023
       8.0 LTS    19/04/2018                           8.0.46       04/2026
       8.4 LTS    30/04/2024                           8.4.11       04/2032
       9.7 LTS    21/04/2026                           9.7.0        04/2034




20/07/2026                       Công nghệ Web - PHP                                4
Tổng quan




20/07/2026   Công nghệ Web - PHP   5
Tổng quan
❑ Non-transaction-safe table: MyISAM, Heap
    ⚫ Tốc độ nhanh.
    ⚫ Ít tốn bộ nhớ khi thực thi.
    ⚫ Ít tốn không gian đĩa.
    ⚫ Không tạo được ràng buộc giữa các bảng (Relationship).
❑ Transaction-safe table: InnoDB
    ⚫ An toàn, khi MySQL bị crash hoặc mất điện vẫn còn dữ liệu cũ.
    ⚫ Thực hiện một nhóm truy vấn cho tới khi commit.
    ⚫ Hủy nhóm truy vấn bằng rollback.
    ⚫ Nếu thay đổi thất bại, các thay đổi sẽ bị hủy.
    ⚫ Hỗ trợ Relationship.

20/07/2026                              Công nghệ Web - PHP           6
MySQL
❑ Tổng quan
❑ Kiểu dữ liệu
❑ Các thuật ngữ và hàm hỗ trợ
❑ Xây dựng câu truy vấn




20/07/2026                      Công nghệ Web - PHP   7
Kiểu dữ liệu (MySQL 9.x)
❑ Dữ liệu kiểu số.
    ⚫ Số nguyên.
    ⚫ Số thực dấu phẩy động (Floating-Point).
    ⚫ Số thực dấu phẩy cố định (Fixed-Point).
❑ Dữ liệu kiểu thời gian.
❑ Dữ liệu kiểu chuỗi.
    ⚫ Văn bản (Text).
    ⚫ Nhị phân (Binary).
❑ Dữ liệu kiểu không gian.
    ⚫ Chứa giá trị hình học đơn lẻ.
    ⚫ Chứa các tập hợp giá trị.
20/07/2026                             Công nghệ Web - PHP   8
Dữ liệu kiểu số
❑ Kiểu số nguyên.
                         Giá trị thấp nhất         Giá trị thấp nhất       Giá trị cao nhất     Giá trị cao nhất
       Kiểu   Vùng nhớ
                               (Âm)                  (Không âm)                  (Âm)            (Không âm)
 TINYINT       1 bytes                 -128                            0                 127                  255
 SMALLINT      2 bytes              -32.768                            0              32.767               65.535
 MEDIUMINT     3 bytes          -8.388.608                             0          8.388.607           16.777.215
 INT           4 bytes      -2.147.483.648                             0      2.147.483.647        4.294.967.295
 BIGINT        8 bytes                  -263                           0                263-1                264-1




20/07/2026                                     Công nghệ Web - PHP                                                 9
Dữ liệu kiểu số
❑ Kiểu số thực dấu phẩy động (Floating-Point).
                        Giá trị thấp nhất       Giá trị thấp nhất       Giá trị cao nhất    Giá trị cao nhất
     Kiểu    Vùng nhớ
                              (Âm)                (Không âm)                  (Âm)           (Không âm)
 FLOAT        4 bytes            -3.4E+38                 1.17E-38              -1.17E-38            3.4E+38
 DOUBLE       8 bytes          -1.79E+308                           0          -2.22E-308          1.79E+308



❑ Vì các giá trị dấu phẩy động là gần đúng và không được lưu trữ dưới dạng giá trị
  chính xác nên việc cố gắng coi chúng là chính xác trong so sánh có thể dẫn đến
  vấn đề. Chúng cũng phải tuân theo sự phụ thuộc vào nền tảng hoặc việc triển khai.




20/07/2026                                  Công nghệ Web - PHP                                                10
Dữ liệu kiểu số
❑ Kiểu số thực dấu phẩy cố định (Fixed-Point).
         Kiểu                                                  Mô tả
                 m Tổng số chữ số, tối đa là 65 chữ số.
                 d    Số chữ số phần thập phân.
 DECIMAL(m, d)   Khai báo DECIMAL(m) có nghĩa là d = 0.
                 Khai báo DECIMAL có nghĩa là m = 10, d = 0.
                 Ví dụ: DECIMAL(5,2) sẽ lưu các số từ -999.99 đến 999.99.




20/07/2026                               Công nghệ Web - PHP                11
Dữ liệu kiểu thời gian
❑ Xem thêm: https://dev.mysql.com/doc/refman/9.7/en/date-and-time-types.html
         Kiểu                                                     Mô tả
                  Định dạng 'YYYY-MM-DD'.
 DATE
                  Phạm vi hỗ trợ là '1000-01-01' đến '9999-12-31'.
                  Định dạng 'YYYY-MM-DD HH:MM:SS'.
 DATETIME
                  Phạm vi hỗ trợ là '1000-01-01 00:00:00' đến '9999-12-31 23:59:59'.
                  Nhãn thời gian, được tính theo 'Unix timestamp'.
 TIMESTAMP
                  Phạm vi hỗ trợ là '1970-01-01 00:00:01' đến '2038-01-19 03:14:07'.
                  Định dạng 'HH:MM:SS'.
 TIME
                  Phạm vi hỗ trợ là '-838:59:59' đến '838:59:59'.
                  Định dạng 'YYYY'.
 YEAR
                  Phạm vi hỗ trợ là '1901' đến '2155’.




20/07/2026                                  Công nghệ Web - PHP                        12
Dữ liệu kiểu chuỗi
❑ Kiểu văn bản (Text).
         Kiểu                                                   Mô tả
                Lưu trữ chuỗi có chiều dài cố định.
 CHAR
                Tối đa 255 ký tự (1 byte).
                Lưu trữ chuỗi có chiều dài không cố định.
 VARCHAR        Tối đa 65.535 ký tự (2 bytes).
                Tối đa ~16,383 ký tự nếu dung bảng mã utf8mb4.

 TINYTEXT       Lưu trữ chuỗi có chiều dài tối đa 28 = 255 bytes.

 TEXT           Lưu trữ chuỗi có chiều dài tối đa 216 = 65.535 bytes (~16,383 ký tự utf8mb4).

 MEDIUMTEXT     Lưu trữ chuỗi có chiều dài tối đa 224 = 16.777.215 bytes (~4 triệu ký tự utf8mb4).

 LONGTEXT       Lưu trữ chuỗi có chiều dài tối đa 232 = 4.294.967.295 bytes (~1 tỷ ký tự utf8mb4).


20/07/2026                                Công nghệ Web - PHP                                        13
Dữ liệu kiểu chuỗi
❑ Kiểu nhị phân (Binary).
         Kiểu                                                   Mô tả

 TINYBLOB        Lưu trữ dữ liệu có dung lượng tối đa 28 = 255 bytes (0.25 KB).


 BLOB            Lưu trữ dữ liệu có dung lượng tối đa 216 = 65.535 bytes (64 KB).


 MEDIUMBLOB      Lưu trữ dữ liệu có dung lượng tối đa 224 = 16.777.215 bytes (16 MB).


 LONGBLOB        Lưu trữ dữ liệu có dung lượng tối đa 232 = 4.294.967.295 bytes (4 GB).




20/07/2026                                Công nghệ Web - PHP                             14
Dữ liệu kiểu không gian
❑ Trong MySQL 9, kiểu dữ liệu không gian (Spatial) dựa trên chuẩn OpenGIS được sử
  dụng để lưu trữ dữ liệu bản đồ, tọa độ hình học phẳng (Cartesian) hoặc địa lý quả
  cầu (Geodetic).
❑ Chứa giá trị hình học đơn lẻ.
         Kiểu                                                    Mô tả

 POINT           Một cặp tọa độ đơn: POINT(X Y)


 LINESTRING      Tập hợp chuỗi từ 2 điểm nối nhau trở lên: LINESTRING(X1 Y1, X2 Y2, ...)


 POLYGON         Một đa giác khép kín, có thể có lỗ rỗng bên trong: POLYGON((X1 Y1, X2 Y2, ..., X1 Y1)).


 GEOMETRY        Có thể chứa bất kỳ kiểu dữ liệu nào trong các kiểu ở trên.


20/07/2026                                 Công nghệ Web - PHP                                             15
Dữ liệu kiểu không gian
❑ Chứa các tập hợp giá trị.
             Kiểu                                              Mô tả

 MULTIPOINT           Tập hợp nhiều điểm đơn độc lập: MULTIPOINT(X1 Y1, X2 Y2).


 MULTILINESTRING      Tập hợp nhiều đường kẻ: MULTILINESTRING((...),(...)).


 MULTIPOLYGON         Tập hợp nhiều đa giác: MULTIPOLYGON(((...)),((...))).


 GEOMETRYCOLLECTION   Tập hợp hỗn hợp nhiều loại đối tượng không gian khác nhau.




20/07/2026                               Công nghệ Web - PHP                       16
MySQL
❑ Tổng quan
❑ Kiểu dữ liệu
❑ Các thuật ngữ và hàm hỗ trợ
❑ Xây dựng câu truy vấn




20/07/2026                      Công nghệ Web - PHP   17
Một số thuật ngữ thường dùng
❑ NULL: Giá trị cho phép rỗng.
❑ NOT NULL: Giá trị không được rỗng.
❑ AUTO_INCREMENT: Cho phép giá trị tăng dần (tự động).
❑ UNSIGNED: Số nguyên dương.
❑ ZEROFILL: Lấp đầy số 0 nếu số chưa đủ độ dài.
❑ COLLATE: Quy tắc so sánh (thường là utf8mb4_unicode_ci).
❑ ENGINE: Cấu trúc lưu trữ (thường là MyISAM / InnoDB).
❑ COMMENT: Chú thích cho trường hoặc bảng.




20/07/2026                        Công nghệ Web - PHP        18
Các hàm hỗ trợ trong câu truy vấn
❑ CHAR_LENGTH
❑ CONCAT, CONCAT_WS
❑ LEFT, RIGHT, MID
❑ LCASE, UCASE
❑ TRIM, RTRIM, LTRIM
❑ COUNT, SUM, MAX, MIN, AVG
❑…
❑ Xem thêm: https://dev.mysql.com/doc/refman/9.7/en/functions.html




20/07/2026                            Công nghệ Web - PHP            19
MySQL
❑ Tổng quan
❑ Kiểu dữ liệu
❑ Các thuật ngữ và hàm hỗ trợ
❑ Xây dựng câu truy vấn




20/07/2026                      Công nghệ Web - PHP   20
Xây dựng câu truy vấn
                    • ALTER
                    • CREATE
             DDL    • DROP
                    • RENAME
                         • SELECT
                         • INSERT                   Data Definition Language
                   DML   • UPDATE
                         • DELETE                   Data Manipulation Language
    SQL                                             Data Control Language
                         • GRANT                    Transaction Control Language
                   DCL   • REVOKE

                    • START TRANSACTION
                    • COMMIT
             TCL    • ROLLBACK
                    • SAVEPOINT

20/07/2026                          Công nghệ Web - PHP                            21
Giải đáp thắc mắc




20/07/2026          Công nghệ Web - PHP   22
