                                           BUỔI 1: TẠO TRANG TIN ĐIỆN TỬ SỬ DỤNG PDO

Bước 1: Khởi động Wamp/XAMPP/Vertrigo và thiết lập cấu hình
- Khởi động Wamp/XAMPP/Vertrigo với quyền Administrator.




- Đổi cổng 80 sang cổng khác (ví dụ: 81, 8000, 8080,…) nếu bị xung đột cổng.
- Đổi thư mục www hoặc htdocs sang ổ đĩa Z: nếu đang sử dụng máy bàn.
- Mở trình duyệt và chạy thử ở địa chỉ 127.0.0.1:port hoặc localhost:port (nếu mặc định là cổng 80 thì có thể bỏ qua không cần gõ vào).
- Xóa hết tất cả các tập tin không cần thiết trong www hoặc htdocs để khi chạy trang web ta sẽ được giao diện như hình bên dưới:
Bước 2: Nhập CSDL có sẵn
- Sao chép thư mục trangtin_v1.0 vào www.




- Mở phpMyAdmin ở địa chỉ: http://127.0.0.1:port/phpmyadmin
Lưu ý: Đối với Wamp/XAMPP, thông tin đăng nhập là root, bỏ trống mật khẩu; đối với Vertrigo, tài khoản root kèm với mật khẩu là vertrigo.
- Tạo cơ sở dữ liệu rỗng với tên “trangtin”.




- Nhập (Import) tập tin trangtin.sql có sẵn trong thư mục data vào.
Mô tả CSDL:
a. Bảng Người dùng (tbl_nguoidung):
             Field Name                      Type                 Length    Null      Collation         Extra
 ID                                int                      10             Not null               AUTO_INCREMENT
 HoVaTen                           varchar                  50             Not null
 TenDangNhap                       varchar                  50             Not null
 MatKhau                           varchar                  100            Not null
 QuyenHan                          tinyint                  1              Not null
 Khoa                              tinyint                  1              Not null
Chú thích:     Quyền hạn 1 là Admin, 2 là User.
               Khóa 1 là bị khóa tài khoản, 0 không khóa.
b. Bảng Chủ đề (tbl_chude):
             Field Name                      Type                 Length    Null      Collation         Extra
 ID                                int                      10             Not null               AUTO_INCREMENT
 TenChuDe                          varchar                  100            Not null
c. Bảng Bài viết (tbl_baiviet):
             Field Name                      Type                 Length    Null      Collation         Extra
 ID                                int                      10             Not null               AUTO_INCREMENT
 MaChuDe                           int                      10             Not null
 MaNguoiDung                       int                      10             Not null
 TieuDe                            varchar                  255            Not null
 TomTat                            text                                    Not null
 NoiDung                           text                                    Not null
 NgayDang                          datetime                                Not null
 LuotXem                          Int                   10                       Not null
 KiemDuyet                        tinyint               1                        Not null
Chú thích:    Kiểm duyệt 1 đã kiểm duyệt, 0 chưa kiểm duyệt


Bước 3: Tạo quan hệ giữa các bảng
Bước 1. Tạo Index cho các trường khóa ngoại (tạo Index lần lượt từng trường).
Bước 2. Chọn CSDL, vào Designer.

Bước 3. Nhấp vào       trên thanh công cụ bên trái, click vào khóa chính trước, sau đó click vào khóa ngoại.


Lưu ý: Chọn các mục trong hộp thoại hiện ra (ON UPDATE, ON DELETE).
Kết quả sau khi thực hiện xong bước này:
Bước 4: Tạo tập tin index.php
- Truy cập trang web https://getbootstrap.com để sử dụng thư viện CSS và Javascript của Bootstrap.
- Vào mục Docs (https://getbootstrap.com/docs/5.3/getting-started/introduction) sao chép code mẫu ở mục 2. vào một tập tin trắng và lưu lại với tên index.php.




- Chỉnh sửa lại nội dung cho phù hợp:
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Bootstrap demo</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
     </head>
     <body>
         <div class="container">
             <!-- Content here -->
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>
- Vào mục Navbar, sao chép đoạn code mẫu đầu tiên vào trong vùng container.




- Chỉnh sửa màu sắc (Color schemes) theo ý thích.
- Chỉnh lại nội dung hiển thị trên Navbar.
- Code mẫu sau khi đã chèn Navbar vào:
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Trang chủ - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
     </head>
     <body>
         <div class="container">
             <nav class="navbar navbar-expand-lg bg-info">
                  <div class="container-fluid">
                      <a class="navbar-brand" href="index.php">iNews</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                                  <a class="nav-link" href="#">Tin mới nhất</a>
                              </li>
                              <li class="nav-item dropdown">
                                           <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Quản lý
                                 </a>
                                 <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="chude.php">Chủ đề</a></li>
                                      <li><a class="dropdown-item" href="nguoidung.php">Người dùng</a></li>
                                      <li><hr class="dropdown-divider"></li>
                                      <li><a class="dropdown-item" href="baiviet.php">Bài viết</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="dangky.php">Đăng ký</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="dangnhap.php">Đăng nhập</a>
                             </li>
                         </ul>
                         <form class="d-flex" role="search">
                             <input class="form-control me-2" type="search" placeholder="Bạn muốn tìm gì?" aria-label="Search">
                             <button class="btn btn-outline-success" type="submit">Tìm</button>
                         </form>
                     </div>
                 </div>
             </nav>
         </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>
- Vào mục Card, sao chép đoạn code mẫu trong menu Header and footer ở bên phải vào bên dưới Navbar.




- Chỉnh sửa lại nội dung cho phù hợp.
- Đây là code ví dụ sau khi chỉnh sửa:
 <div class="card mt-3">
     <h5 class="card-header">Trang chủ</h5>
     <div class="card-body">
         <p class="card-text">Nội dung trang chủ sẽ cập nhật sau.</p>
     </div>
 </div>
- Kết quả khi chạy trên màn hình trình duyệt:




- Thêm vào cuối trang thông tin đơn giản để làm Footer.




- Vào mục Icons.
- Sao chép thẻ <link …> dùng để chèn biểu tượng sau đó dán vào phần <head> trong tập tin index.php.




 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>Trang chủ - iNews</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
 </head>
- Ví dụ mẫu về việc sử dụng các biểu tượng:

 #      Code                                                                                      Biểu tượng

 1      <i class="bi bi-search"></i>

 2      <i class="bi bi-star-fill"></i>

 3      <i class="bi bi-cup-hot"></i>

 4      <i class="bi bi-diagram-2"></i>

 5      <i class="bi bi-people"></i>
 6      <i class="bi bi-stickies"></i>

 7      <i class="bi bi-person-plus"></i>

 8      <i class="bi bi-box-arrow-in-right"></i>

 9      <i class="bi bi-database-gear"></i>

- Kết quả sau khi áp dụng các biểu tượng:




Bước 5: Tách các phần dùng chung ra các tập tin riêng để tái sử dụng
- Di chuyển code phần Narbar và Footer lần lượt ra các tập tin riêng và đặt tên là navbar.php và footer.php.
- Nội dung tập tin index.php lúc này sẽ có dạng như sau:
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Trang chủ - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Trang chủ</h5>
                  <div class="card-body">
                      <p class="card-text">Nội dung trang chủ sẽ cập nhật sau.</p>
                  </div>
              </div>

               <?php include_once 'footer.php'; ?>
           </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>



Bước 6: Tạo tập tin ketnoi.php (Kết nối đến CSDL)
<?php
    // Tạo kết nối đến CSDL
    $dns = 'mysql:host=127.0.0.1;dbname=trangtin;charset=utf8mb4';
    $user = 'root';
    $pass = 'vertrigo';
    $option = ['PDO::ATTR_ERRMODE' => 'PDO::ERRMODE_EXCEPTION'];
    $conn = null;

     try
     {
         $conn = new PDO($dns, $user, $pass, $option);
     }
     catch(PDOException $e)
     {
         echo $e->getMessage();
     }
?>



Bước 7: Tạo tập tin chude.php (Danh sách chủ đề)
<?php
    require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chủ đề - iNews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>
<body>
    <div class="container">
        <?php include_once 'navbar.php'; ?>

        <div class="card mt-3">
            <h5 class="card-header">Chủ đề</h5>
            <div class="card-body">

                <p><a href="chude_them.php" class="btn btn-info"><i class="bi bi-plus-lg"></i> Thêm mới</a></p>

                <table class="table table-sm table-hover table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Tên chủ đề</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = 'SELECT * FROM tbl_chude';
                            $cmd = $conn->prepare($sql);
                            $cmd->execute();
                            $result = $cmd->fetchAll();

                           $stt = 1;
                           foreach($result as $value)
                           {
                               echo '<tr>
                                       <td>' . $stt++ . '</td>
                                       <td>' . $value['TenChuDe'] . '</td>
                                        <td class="text-center"><a href="chude_sua.php?id=' . $value['ID'] . '"><i class="bi bi-pencil-square"></i></a></td>
                                        <td class="text-center"><a href="chude_xoa.php?id=' . $value['ID'] . '"><i class="bi bi-trash text-danger"></i></a></td>
                                      </tr>';
                           }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include_once 'footer.php'; ?>
          </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>
Kết quả trên trình duyệt:




Bước 8: Tạo tập tin chude_them.php (Thêm chủ đề)
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Thêm chủ đề - iNews</title>
         <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Thêm chủ đề</h5>
                  <div class="card-body">
                      <form action="chude_them_xuly.php" method="post" class="needs-validation" novalidate>
                          <div class="mb-3">
                              <label for="TenChuDe" class="form-label">Tên chủ đề</label>
                              <input type="text" class="form-control" id="TenChuDe" name="TenChuDe" required />
                              <div class="invalid-feedback">Tên chủ đề không được bỏ trống.</div>
                          </div>

                          <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Thêm vào CSDL</button>
                      </form>
                  </div>
              </div>

              <?php include_once 'footer.php'; ?>
          </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
         <script>
             (() => {
                 'use strict';
                 const forms = document.querySelectorAll('.needs-validation');
                 Array.from(forms).forEach(form => {
                     form.addEventListener('submit', event => {
                         if (!form.checkValidity()) {
                             event.preventDefault();
                             event.stopPropagation();
                         }
                         form.classList.add('was-validated');
                     }, false);
                 });
             })();
         </script>
     </body>
 </html>
Sử dụng Form Validation để kiểm tra thông tin trên Form.


Xem thêm tại đường dẫn: https://getbootstrap.com/docs/5.3/forms/validation
Kết quả trên trình duyệt:
Bước 9: Tạo tập tin chude_them_xuly.php (Xử lý thêm chủ đề)
<?php
    require_once 'ketnoi.php';

    $TenChuDe = $_POST['TenChuDe'];

    try
    {
          $sql = 'INSERT INTO tbl_chude(TenChuDe) VALUES (:TenChuDe)';
          $cmd = $conn->prepare($sql);
          $cmd->bindValue(':TenChuDe', $TenChuDe);
          $result = $cmd->execute();

        header('Location: chude.php');
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
     }
?>



Bước 10: Tạo tập tin chude_sua.php (Sửa chủ đề)
<?php
    require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sửa chủ đề - iNews</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    </head>
    <body>
        <div class="container">
            <?php include_once 'navbar.php'; ?>

            <div class="card mt-3">
                <h5 class="card-header">Sửa chủ đề</h5>
                <div class="card-body">
                    <?php
                        $id = $_GET['id'];

                       $sql = 'SELECT * FROM tbl_chude WHERE ID = :ID';
                       $cmd = $conn->prepare($sql);
                       $cmd->bindValue(':ID', $id);
                       $cmd->execute();
                       $result = $cmd->fetch();
                    ?>
                    <form action="chude_sua_xuly.php" method="post" class="needs-validation" novalidate>
                        <input type="text" id="ID" name="ID" value="<?php echo $result['ID']; ?>" hidden />

                       <div class="mb-3">
                           <label for="TenChuDe" class="form-label">Tên chủ đề</label>
                           <input type="text" class="form-control" id="TenChuDe" name="TenChuDe" value="<?php echo $result['TenChuDe']; ?>" required />
                           <div class="invalid-feedback">Tên chủ đề không được bỏ trống.</div>
                       </div>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Cập nhật</button>
                    </form>
                </div>
            </div>

            <?php include_once 'footer.php'; ?>
          </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
         <script>
             (() => {
                 'use strict';
                 const forms = document.querySelectorAll('.needs-validation');
                 Array.from(forms).forEach(form => {
                     form.addEventListener('submit', event => {
                         if (!form.checkValidity()) {
                             event.preventDefault();
                             event.stopPropagation();
                         }
                         form.classList.add('was-validated');
                     }, false);
                 });
             })();
         </script>
     </body>
 </html>
Kết quả trên trình duyệt:
Bước 11: Tạo tập tin chude_sua_xuly.php (Xử lý sửa chủ đề)
 <?php
     require_once 'ketnoi.php';

      $ID = $_POST['ID'];
      $TenChuDe = $_POST['TenChuDe'];

      try
      {
            $sql = 'UPDATE tbl_chude SET TenChuDe = :TenChuDe WHERE ID = :ID';
            $cmd = $conn->prepare($sql);
            $cmd->bindValue(':ID', $ID);
            $cmd->bindValue(':TenChuDe', $TenChuDe);
            $result = $cmd->execute();

          header('Location: chude.php');
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>



Bước 12: Tạo tập tin chude_xoa.php (Xử lý xóa chủ đề)
 <?php
     require_once 'ketnoi.php';

      $id = $_GET['id'];

      try
      {
            $sql = 'DELETE FROM tbl_chude WHERE ID = :ID';
            $cmd = $conn->prepare($sql);
            $cmd->bindValue(':ID', $id);
            $result = $cmd->execute();

          header('Location: chude.php');
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>
Lưu ý: Sinh viên bổ sung code để khi xóa phải có hộp thoại xác nhận.
Bước 13: Tạo tập tin nguoidung.php (Danh sách người dùng)
Sao chép tập tin chude.php và đổi tên thành nguoidung.php sau đó tự chỉnh lại code cho phù hợp.
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Người dùng - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Người dùng</h5>
                  <div class="card-body">

                      <p><a href="nguoidung_them.php" class="btn btn-info"><i class="bi bi-plus-lg"></i> Thêm mới</a></p>

                      <table class="table table-sm table-hover table-striped table-bordered mb-0">
                          <thead>
                              <tr>
                                  <th width="5%">#</th>
                                  <th>Họ và tên</th>
                                  <th>Tên đăng nhập</th>
                                  <th>Quyền hạn</th>
                                  <th>Trạng thái</th>
                                  <th width="5%">Sửa</th>
                                  <th width="5%">Xóa</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                  $sql = 'SELECT * FROM tbl_nguoidung';
                                  $cmd = $conn->prepare($sql);
                                  $cmd->execute();
                                  $result = $cmd->fetchAll();

                                   $stt = 1;
                                   foreach($result as $value)
                                   {
                                       echo '<tr>
                                               <td>' . $stt++ . '</td>
                                               <td>' . $value['HoVaTen'] . '</td>
                                               <td>' . $value['TenDangNhap'] . '</td>
                                               <td>' . ($value['QuyenHan'] == 1 ? "Quản trị viên" : "Thành viên") . '</td>
                                               <td>' . ($value['Khoa'] == 1 ? "Đang bị khóa" : "Hoạt động") . '</td>
                                               <td class="text-center"><a href="nguoidung_sua.php?id=' . $value['ID'] . '"><i class="bi bi-pencil-square"></i></a></td>
                                               <td class="text-center"><a href="nguoidung_xoa.php?id=' . $value['ID'] . '"><i class="bi bi-trash text-danger"></i></a></td>
                                             </tr>';
                                  }
                             ?>
                         </tbody>
                     </table>
                 </div>
             </div>

             <?php include_once 'footer.php'; ?>
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>



Bước 14: Tạo tập tin nguoidung_them.php (Thêm người dùng)
Sao chép tập tin chude_them.php và đổi tên thành nguoidung_them.php sau đó tự chỉnh lại code cho phù hợp.
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Thêm người dùng - iNews</title>
         <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

             <div class="card mt-3">
                 <h5 class="card-header">Thêm người dùng</h5>
                 <div class="card-body">
                     <form action="nguoidung_them_xuly.php" method="post" class="needs-validation" novalidate>
                         <div class="mb-3">
                   <label for="HoVaTen" class="form-label">Họ và tên</label>
                   <input type="text" class="form-control" id="HoVaTen" name="HoVaTen" required />
                   <div class="invalid-feedback">Họ và tên không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="TenDangNhap" class="form-label">Tên đăng nhập</label>
                   <input type="text" class="form-control" id="TenDangNhap" name="TenDangNhap" required />
                   <div class="invalid-feedback">Tên đăng nhập không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="MatKhau" class="form-label">Mật khẩu</label>
                   <input type="password" class="form-control" id="MatKhau" name="MatKhau" required />
                   <div class="invalid-feedback">Mật khẩu không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="XacNhanMatKhau" class="form-label">Xác nhận mật khẩu</label>
                   <input type="password" class="form-control" id="XacNhanMatKhau" name="XacNhanMatKhau" required />
                   <div class="invalid-feedback">Xác nhận mật khẩu không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="QuyenHan" class="form-label">Quyền hạn</label>
                   <select class="form-select" id="QuyenHan" name="QuyenHan" required>
                       <option value="">-- Chọn --</option>
                       <option value="1">Quản trị viên</option>
                       <option value="2">Thành viên</option>
                   </select>
                   <div class="invalid-feedback">Chưa chọn quyền hạn.</div>
               </div>

               <div class="mb-3">
                   <div class="form-check">
                       <input class="form-check-input" type="checkbox" id="KhoaTaiKhoan" name="KhoaTaiKhoan" />
                       <label class="form-check-label" for="KhoaTaiKhoan">
                           Khóa tài khoản.
                       </label>
                   </div>
               </div>

               <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Thêm vào CSDL</button>
           </form>
       </div>
   </div>

    <?php include_once 'footer.php'; ?>
</div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
         <script>
             (() => {
                 'use strict';
                 const forms = document.querySelectorAll('.needs-validation');
                 Array.from(forms).forEach(form => {
                     form.addEventListener('submit', event => {
                         if (!form.checkValidity()) {
                             event.preventDefault();
                             event.stopPropagation();
                         }
                         form.classList.add('was-validated');
                     }, false);
                 });
             })();
         </script>
     </body>
 </html>



Bước 15: Tạo tập tin nguoidung_them_xuly.php (Xử lý thêm người dùng)
Sao chép tập tin chude_them_xuly.php và đổi tên thành nguoidung_them_xuly.php sau đó tự chỉnh lại code cho phù hợp.
Lưu ý: Mật khẩu được mã hóa bằng cách dùng hàm sha1.
 <?php
     require_once 'ketnoi.php';

     $HoVaTen = $_POST['HoVaTen'];
     $TenDangNhap = $_POST['TenDangNhap'];
     $MatKhau = $_POST['MatKhau'];
     $XacNhanMatKhau = $_POST['XacNhanMatKhau'];
     $QuyenHan = $_POST['QuyenHan'];
     $Khoa = empty($_POST['KhoaTaiKhoan']) ? 0 : 1;

     try
     {
           $sql = 'INSERT INTO tbl_nguoidung(HoVaTen, TenDangNhap, MatKhau, QuyenHan, Khoa)
                   VALUES (:HoVaTen, :TenDangNhap, :MatKhau, :QuyenHan, :Khoa)';
           $cmd = $conn->prepare($sql);
           $cmd->bindValue(':HoVaTen', $HoVaTen);
           $cmd->bindValue(':TenDangNhap', $TenDangNhap);
           $cmd->bindValue(':MatKhau', sha1($MatKhau));
           $cmd->bindValue(':QuyenHan', $QuyenHan);
           $cmd->bindValue(':Khoa', $Khoa);
           $result = $cmd->execute();
          header('Location: nguoidung.php');
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>



Bước 16: Tạo tập tin nguoidung_sua.php (Sửa người dùng)
Sao chép tập tin chude_sua.php và đổi tên thành nguoidung_sua.php sau đó tự chỉnh lại code cho phù hợp.
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Sửa người dùng - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Sửa người dùng</h5>
                  <div class="card-body">
                      <?php
                          $id = $_GET['id'];

                           $sql = 'SELECT * FROM tbl_nguoidung WHERE ID = :ID';
                           $cmd = $conn->prepare($sql);
                           $cmd->bindValue(':ID', $id);
                           $cmd->execute();
                           $result = $cmd->fetch();
                      ?>

                      <form action="nguoidung_sua_xuly.php" method="post" class="needs-validation" novalidate>
                          <input type="text" id="ID" name="ID" value="<?php echo $result['ID']; ?>" hidden />

                           <div class="mb-3">
                               <label for="HoVaTen" class="form-label">Họ và tên</label>
                              <input type="text" class="form-control" id="HoVaTen" name="HoVaTen" value="<?php echo $result['HoVaTen']; ?>" required />
                              <div class="invalid-feedback">Họ và tên không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="TenDangNhap" class="form-label">Tên đăng nhập</label>
                   <input type="text" class="form-control" id="TenDangNhap" name="TenDangNhap" value="<?php echo $result['TenDangNhap']; ?>" required />
                   <div class="invalid-feedback">Tên đăng nhập không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="MatKhau" class="form-label">Mật khẩu</label>
                   <input type="password" class="form-control" id="MatKhau" name="MatKhau" placeholder="Bỏ trống để giữ nguyên mật khẩu cũ." />
               </div>

               <div class="mb-3">
                   <label for="XacNhanMatKhau" class="form-label">Xác nhận mật khẩu</label>
                   <input type="password" class="form-control" id="XacNhanMatKhau" name="XacNhanMatKhau" placeholder="Bỏ trống để giữ nguyên mật khẩu cũ." />
               </div>

               <div class="mb-3">
                   <label for="QuyenHan" class="form-label">Quyền hạn</label>
                   <select class="form-select" id="QuyenHan" name="QuyenHan" required>
                       <option value="">-- Chọn --</option>
                       <option value="1" <?php echo ($result['QuyenHan'] == 1 ? 'selected' : ''); ?>>Quản trị viên</option>
                       <option value="2" <?php echo ($result['QuyenHan'] == 2 ? 'selected' : ''); ?>>Thành viên</option>
                   </select>
                   <div class="invalid-feedback">Chưa chọn quyền hạn.</div>
               </div>

               <div class="mb-3">
                   <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="KhoaTaiKhoan" name="KhoaTaiKhoan" <?php echo ($result['Khoa'] == 1 ? 'checked' : ''); ?> />
                       <label class="form-check-label" for="KhoaTaiKhoan">
                           Khóa tài khoản.
                       </label>
                   </div>
               </div>

               <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Cập nhật</button>
           </form>
       </div>
   </div>

    <?php include_once 'footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
                 Array.from(forms).forEach(form => {
                     form.addEventListener('submit', event => {
                         if (!form.checkValidity()) {
                             event.preventDefault();
                             event.stopPropagation();
                         }
                         form.classList.add('was-validated');
                     }, false);
                 });
             })();
         </script>
     </body>
 </html>



Bước 17: Tạo tập tin nguoidung_sua_xuly.php (Xử lý sửa người dùng)
Sao chép tập tin chude_sua_xuly.php và đổi tên thành nguoidung_sua_xuly.php sau đó tự chỉnh lại code cho phù hợp.
Lưu ý: Mật khẩu được mã hóa bằng cách dùng hàm sha1.
 <?php
     require_once 'ketnoi.php';

     $ID = $_POST['ID'];
     $HoVaTen = $_POST['HoVaTen'];
     $TenDangNhap = $_POST['TenDangNhap'];
     $MatKhau = $_POST['MatKhau'];
     $XacNhanMatKhau = $_POST['XacNhanMatKhau'];
     $QuyenHan = $_POST['QuyenHan'];
     $Khoa = empty($_POST['KhoaTaiKhoan']) ? 0 : 1;

     try
     {
           if(empty($MatKhau))
           {
               $sql = 'UPDATE tbl_nguoidung
                       SET     HoVaTen = :HoVaTen,
                               TenDangNhap = :TenDangNhap,
                               QuyenHan = :QuyenHan,
                               Khoa = :Khoa
                       WHERE   ID = :ID';
               $cmd = $conn->prepare($sql);
               $cmd->bindValue(':ID', $ID);
               $cmd->bindValue(':HoVaTen', $HoVaTen);
               $cmd->bindValue(':TenDangNhap', $TenDangNhap);
               $cmd->bindValue(':QuyenHan', $QuyenHan);
               $cmd->bindValue(':Khoa', $Khoa);
               $result = $cmd->execute();
            }
            else
            {
                $sql = 'UPDATE  tbl_nguoidung
                        SET     HoVaTen = :HoVaTen,
                                TenDangNhap = :TenDangNhap,
                                MatKhau = :MatKhau,
                                QuyenHan = :QuyenHan,
                                Khoa = :Khoa
                        WHERE   ID = :ID';
                $cmd = $conn->prepare($sql);
                $cmd->bindValue(':ID', $ID);
                $cmd->bindValue(':HoVaTen', $HoVaTen);
                $cmd->bindValue(':TenDangNhap', $TenDangNhap);
                $cmd->bindValue(':MatKhau', sha1($MatKhau));
                $cmd->bindValue(':QuyenHan', $QuyenHan);
                $cmd->bindValue(':Khoa', $Khoa);
                $result = $cmd->execute();
            }

          header('Location: nguoidung.php');
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>



Bước 18: Tạo tập tin nguoidung_xoa.php (Xử lý xóa người dùng)
Sao chép tập tin chude_xoa.php và đổi tên thành nguoidung_xoa.php sau đó tự chỉnh lại code cho phù hợp.
 <?php
     require_once 'ketnoi.php';

      $id = $_GET['id'];

      try
      {
            $sql = 'DELETE FROM tbl_nguoidung WHERE ID = :ID';
            $cmd = $conn->prepare($sql);
            $cmd->bindValue(':ID', $id);
            $result = $cmd->execute();

          header('Location: nguoidung.php');
      }
      catch(PDOException $e)
      {
         echo $e->getMessage();
     }
?>

                                  HẾT BUỔI 1
