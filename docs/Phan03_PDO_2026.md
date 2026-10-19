PDO (PHP DATA OBJECTS)

           Nguyễn Hoàng Tùng
           Bộ môn Kỹ thuật phần mềm
           nhoangtung@agu.edu.vn
           www.nhtung.id.vn
Nội dung chính của phần này
❑ PDO là gì?
❑ Cơ sở dữ liệu nào được hỗ trợ?
❑ So sánh PDO và MySQLi
❑ Kết nối cơ sở dữ liệu sử dụng PDO
❑ Thực thi truy vấn CRUD




20/07/2026                         Công nghệ Web - PHP   2
PDO là gì?
❑ PDO là viết tắt của PHP Data Objects.
❑ Là một lớp truy xuất cơ sở dữ liệu (CSDL) cung cấp một phương pháp thống nhất
  để làm việc với nhiều loại CSDL khác nhau.
❑ Được thiết kế để sử dụng tất cả các tính năng hướng đối tượng của PHP 5.x, và do
  đó sẽ không chạy với các phiên bản PHP trước đó.
❑ Xem thêm: http://php.net/manual/en/book.pdo.php




20/07/2026                           Công nghệ Web - PHP                         3
PDO là gì?
❑ Các thành phần của lớp PDO (https://www.php.net/manual/en/book.pdo.php)
<?php
    class PDO {
        public __construct($dsn [, $username [, $password [, $options]]]);
        public bool beginTransaction();
        public bool commit();
        public mixed errorCode();
        public array errorInfo();
        public int exec($statement);
        public mixed getAttribute($attribute);
        public static array getAvailableDrivers();
        public bool inTransaction();
        public string lastInsertId([$name = NULL]);
        public PDOStatement prepare($statement [, $driver_options = array()]);
        public PDOStatement query($statement);
        public string quote($string [, $parameter_type = PDO::PARAM_STR]);
        public bool rollBack();
        public bool setAttribute($attribute , $value);
    }
?>

20/07/2026                                   Công nghệ Web - PHP                 4
Nội dung chính của phần này
❑ PDO là gì?
❑ Cơ sở dữ liệu nào được hỗ trợ?
❑ So sánh PDO và MySQLi
❑ Kết nối cơ sở dữ liệu sử dụng PDO
❑ Thực thi truy vấn CRUD




20/07/2026                         Công nghệ Web - PHP   5
Cơ sở dữ liệu nào được hỗ trợ?
❑ PDO hỗ trợ đến 11 CSDL khác nhau:
 #      Tên driver      Cơ sở dữ liệu
 1      PDO_CUBRID      Cubrid
 2      PDO_DBLIB       FreeTDS / Microsoft SQL Server / Sybase
 3      PDO_FIREBIRD    Firebird
 4      PDO_IBM         IBM DB2
 5      PDO_INFORMIX    IBM Informix Dynamic Server
 6      PDO_MYSQL       MySQL
 7      PDO_OCI         Oracle Call Interface
 8      PDO_ODBC        ODBC v3 (IBM DB2, unixODBC, win32ODBC)
 9      PDO_PGSQL       PostgreSQL
 10     PDO_SQLITE      SQLite 2 and SQLite 3
 11     PDO_SQLSRV      Microsoft SQL Server / SQL Azure


20/07/2026                           Công nghệ Web - PHP          6
Cơ sở dữ liệu nào được hỗ trợ?
❑ Tuy nhiên không phải lúc nào PDO cũng hỗ trợ hết 11 CSDL đó, trước hết chúng ta
  phải xem các drivers mà PDO đang sẵn có.
   <?php
      // Kiểm tra các drives PDO sẵn có
      var_dump(PDO::getAvailableDrivers());
   ?>
❑ Kết quả ví dụ:



❑ Làm thế nào để “bật” một driver chưa sẵn có?
    ⚫ Vào quản lý Extensions nếu có sẵn mà chưa bật thì bật lên,
    ⚫ Nếu chưa có thì truy cập trang php.net vào mục PDO Drivers và tải về.


20/07/2026                             Công nghệ Web - PHP                      7
Nội dung chính của phần này
❑ PDO là gì?
❑ Cơ sở dữ liệu nào được hỗ trợ?
❑ So sánh PDO và MySQLi
❑ Kết nối cơ sở dữ liệu sử dụng PDO
❑ Thực thi truy vấn CRUD




20/07/2026                         Công nghệ Web - PHP   8
So sánh PDO và MySQLi
❑ PHP 5.x về sau có thể kết nối tới MySQL theo 2 cách:
    ⚫ MySQLi (chữ "i" là viết tắt của improved).
    ⚫ PDO (PHP Data Objects).
❑ PDO có thể kết nối với 11 CSDL khác nhau, còn MySQLi chỉ làm việc với MySQL.
❑ Nếu dự án cần trao đổi dữ liệu giữa nhiều loại CSDL khác nhau thì PDO sẽ hợp lý
  hơn.
❑ Cả 2 phương pháp đều hướng đối tượng, nhưng MySQLi hỗ trợ cả hướng thủ tục.




20/07/2026                              Công nghệ Web - PHP                      9
So sánh PDO và MySQLi




20/07/2026          Công nghệ Web - PHP   10
Nội dung chính của phần này
❑ PDO là gì?
❑ Cơ sở dữ liệu nào được hỗ trợ?
❑ So sánh PDO và MySQLi
❑ Kết nối cơ sở dữ liệu sử dụng PDO
❑ Thực thi truy vấn CRUD




20/07/2026                         Công nghệ Web - PHP   11
Kết nối cơ sở dữ liệu sử dụng PDO
❑ Các cách kết nối tới mỗi loại CSDL:
   <?php
      // Kết nối tới CSDL MySQL
      $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', $user, $pass);

        // Kết nối tới CSDL SQLite
        $conn = new PDO('sqlite:database/path/test.db');

        // Kết nối tới CSDL MS SQL Server
        $conn = new PDO('sqlsrv:Server=.\SQLEXPRESS;Database=Test;', $user, $pass);
   ?>

❑ Hủy kết nối:
   <?php
        $conn = null;
   ?>

20/07/2026                             Công nghệ Web - PHP                                 12
Kết nối cơ sở dữ liệu sử dụng PDO
❑ Tùy chọn kết nối:
   $conn = new PDO($dsn, $user, $pass, $options);

❑ Tùy chọn kết nối thường dùng:
    Thuộc tính                       Miền giá trị
                                     PDO::ERRMODE_SILENT
                                     Chỉ trả về mã lỗi

    PDO::ATTR_ERRMODE                PDO::ERRMODE_EXCEPTION
    Thiết lập chế độ thông báo lỗi   (Mặc định) Ngoài việc thiết lập mã lỗi, PDO sẽ ném ra ngoại lệ PDOException

                                     PDO::ERRMODE_WARNING
                                     Ngoài việc thiết lập mã lỗi, PDO sẽ hiển thị thông báo lỗi

❑ Xem thêm: http://php.net/manual/en/pdo.setattribute.php

20/07/2026                                          Công nghệ Web - PHP                                        13
Kết nối cơ sở dữ liệu sử dụng PDO
❑ Cách thêm tùy chọn cho kết nối:
   <?php
      $dsn = 'mysql:host=localhost;dbname=test;charset=utf8mb4';
      $user = 'root';
      $pass = 'vertrigo';

        $options = array(
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_TIMEOUT => 180);

        $conn = new PDO($dsn, $user, $pass, $options);
   ?>
❑ Hoặc:
   <?php
      $conn = new PDO($dsn, $user, $pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_TIMEOUT, 180);
   ?>
20/07/2026                           Công nghệ Web - PHP                14
Nội dung chính của phần này
❑ PDO là gì?
❑ Cơ sở dữ liệu nào được hỗ trợ?
❑ So sánh PDO và MySQLi
❑ Kết nối cơ sở dữ liệu sử dụng PDO
❑ Thực thi truy vấn CRUD (Create, Read, Update, Delete)




20/07/2026                         Công nghệ Web - PHP    15
Cơ sở dữ liệu mẫu
❑ Giả sử đã tồn tại CSDL Quản lý nhân viên với tên “qlnv”. Trong CSDL đã có sẵn một
  bảng với tên “nhanvien”.




20/07/2026                         Công nghệ Web - PHP                           16
Kết nối tới cơ sở dữ liệu
❑ config.php
   <?php
       $dsn = 'mysql:host=127.0.0.1;dbname=qlnv;charset=utf8mb4';
       $user = 'root';
       $pass = '';
       $conn = null;

         try
         {
               $conn = new PDO($dsn, $user, $pass);
         }
         catch(PDOException $e)
         {
             echo $e->getMessage();
         }
   ?>


20/07/2026                              Công nghệ Web - PHP         17
Thực thi truy vấn INSERT
❑ nhanvien_them_xuly.php (Xử lý thêm nhân viên)
   <?php
       require_once 'config.php';

        $HoVaTen = $_POST['HoVaTen'];       $NgaySinh = $_POST['NgaySinh'];
        $GioiTinh = $_POST['GioiTinh'];     $Email = $_POST['Email'];
        $DienThoai = $_POST['DienThoai'];   $NgayVaoLam = $_POST['NgayVaoLam'];

        try {
             $sql = 'INSERT INTO nhanvien(HoVaTen, NgaySinh, GioiTinh, Email, DienThoai, NgayVaoLam)
                     VALUES(:HoVaTen, :NgaySinh, :GioiTinh, :Email, :DienThoai, :NgayVaoLam)';
             $cmd = $conn->prepare($sql);
             $cmd->bindValue(':HoVaTen', $HoVaTen);        $cmd->bindValue(':NgaySinh', $NgaySinh);
             $cmd->bindValue(':GioiTinh', $GioiTinh);      $cmd->bindValue(':Email', $Email);
             $cmd->bindValue(':DienThoai', $DienThoai);    $cmd->bindValue(':NgayVaoLam', $NgayVaoLam);
             $result = $cmd->execute();
        }
        catch(PDOException $e) {
             echo $e->getMessage();
        }
   ?>

20/07/2026                                  Công nghệ Web - PHP                                      18
Thực thi truy vấn SELECT
❑ nhanvien.php (Hiển thị danh sách nhân viên)
   <?php
       require_once 'config.php';

        $sql = 'SELECT * FROM nhanvien';
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $result = $cmd->fetchAll();

        foreach($result as $value)
        {
            echo '<tr>
                <td>' . $value['HoVaTen'] . '</td>
                <td>' . $value['NgaySinh'] . '</td>
                <td>' . ($value['GioiTinh'] == 0 ? "Nữ" : "Nam") . '</td>
                <td>' . $value['Email'] . '</td>
                <td>' . $value['DienThoai'] . '</td>
                <td>' . $value['NgayVaoLam'] . '</td>
            </tr>';
        }
   ?>

20/07/2026                                  Công nghệ Web - PHP             19
Thực thi truy vấn SELECT
❑ nhanvien_sua.php (Lấy thông tin nhân viên cần sửa)
   <?php
       require_once 'config.php';

         $id = $_GET['id'];

         try
         {
               $sql = 'SELECT * FROM nhanvien WHERE ID = :ID';
               $cmd = $conn->prepare($sql);
               $cmd->bindValue(':ID', $id);
               $cmd->execute();
               $result = $cmd->fetch();
         }
         catch(PDOException $e)
         {
             echo $e->getMessage();
         }
   ?>

20/07/2026                                Công nghệ Web - PHP    20
Thực thi truy vấn UPDATE
❑ nhanvien_sua_xuly.php (Xử lý sửa thông tin nhân viên)
   <?php
       require_once 'config.php';

        $ID = $_POST['ID'];
        $HoVaTen = $_POST['HoVaTen'];          $NgaySinh = $_POST['NgaySinh'];
        $GioiTinh = $_POST['GioiTinh'];        $Email = $_POST['Email'];
        $DienThoai = $_POST['DienThoai'];      $NgayVaoLam = $_POST['NgayVaoLam'];

        try {
            $sql = 'UPDATE   nhanvien
                    SET      HoVaTen = :HoVaTen, NgaySinh = :NgaySinh, GioiTinh = :GioiTinh,
                             Email = :Email, DienThoai = :DienThoai, NgayVaoLam = :NgayVaoLam
                     WHERE   ID = :ID';
             $cmd = $conn->prepare($sql);
             $cmd->bindValue(':ID', $ID);
             $cmd->bindValue(':HoVaTen', $HoVaTen);        $cmd->bindValue(':NgaySinh', $NgaySinh);
             $cmd->bindValue(':GioiTinh', $GioiTinh);      $cmd->bindValue(':Email', $Email);
             $cmd->bindValue(':DienThoai', $DienThoai);    $cmd->bindValue(':NgayVaoLam', $NgayVaoLam);
             $result = $cmd->execute();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
   ?>

20/07/2026                                         Công nghệ Web - PHP                                    21
Thực thi truy vấn DELETE
❑ nhanvien_xoa.php (Xử lý xóa nhân viên)
   <?php
       require_once 'config.php';

         $id = $_GET['id'];

         try
         {
               $sql = 'DELETE FROM nhanvien WHERE ID = :ID';
               $cmd = $conn->prepare($sql);
               $cmd->bindValue(':ID', $id);
               $cmd->execute();
         }
         catch(PDOException $e)
         {
             echo $e->getMessage();
         }
   ?>

20/07/2026                              Công nghệ Web - PHP    22
Giải đáp thắc mắc




20/07/2026          Công nghệ Web - PHP   23
