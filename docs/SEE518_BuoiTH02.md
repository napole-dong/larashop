                                              BUỔI 2: PHÂN QUYỀN VÀ ĐĂNG BÀI VIẾT

Bước 1: Tạo tập tin dangky.php
- Mặc định khi đăng ký sẽ có quyền hạn là Thành viên và tài khoản không bị khóa.
- Nội dung tập tin dangky.php:
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Đăng ký tài khoản - iNews</title>
         <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

             <div class="card mt-3">
                 <h5 class="card-header">Đăng ký tài khoản</h5>
                 <div class="card-body">
                     <form action="dangky_xuly.php" method="post" class="needs-validation" novalidate>
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

                         <button type="submit" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Đăng ký</button>
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



Bước 2: Tạo tập tin dangky_xuly.php
<?php
    require_once 'ketnoi.php';

    $HoVaTen = $_POST['HoVaTen'];
    $TenDangNhap = $_POST['TenDangNhap'];
    $MatKhau = $_POST['MatKhau'];
    $XacNhanMatKhau = $_POST['XacNhanMatKhau'];

    try
    {
          $sql = 'INSERT INTO tbl_nguoidung(HoVaTen, TenDangNhap, MatKhau, QuyenHan, Khoa)
                  VALUES (:HoVaTen, :TenDangNhap, :MatKhau, :QuyenHan, :Khoa)';
          $cmd = $conn->prepare($sql);
           $cmd->bindValue(':HoVaTen', $HoVaTen);
           $cmd->bindValue(':TenDangNhap', $TenDangNhap);
           $cmd->bindValue(':MatKhau', sha1($MatKhau));
           $cmd->bindValue(':QuyenHan', 2);
           $cmd->bindValue(':Khoa', 0);
           $result = $cmd->execute();

           $message = 'Đăng ký thành công!';
           include_once 'success.php';
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
 ?>
- Sinh viên tự bổ sung 2 tập tin:
      1. success.php: Có chức năng thông báo thành công.
      2. error.php: Có chức năng thông báo lỗi.
Gợi ý: Dùng component Alert trong Bootstrap.
- Code mẫu tập tin success.php:
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Hoàn thành - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

                <div class="card mt-3">
                    <h5 class="card-header">Hoàn thành</h5>
                    <div class="card-body">
                        <div class="alert alert-primary mb-0" role="alert">
                            <i class="bi bi-check2-circle"></i> <?php echo $message; ?>
                        </div>
                    </div>
                </div>
             <?php include_once 'footer.php'; ?>
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>



- Code mẫu tập tin error.php:
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Lỗi - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Lỗi</h5>
                  <div class="card-body">
                      <div class="alert alert-danger mb-0" role="alert">
                          <i class="bi bi-x-octagon-fill"></i> <?php echo $error_message; ?>
                      </div>
                  </div>
              </div>

             <?php include_once 'footer.php'; ?>
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     </body>
 </html>



Bước 3: Tạo tập tin dangnhap.php
 <?php
     require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Đăng nhập - iNews</title>
        <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container">
            <?php include_once 'navbar.php'; ?>

            <div class="card mt-3">
                <h5 class="card-header">Đăng nhập</h5>
                <div class="card-body">
                    <form action="dangnhap_xuly.php" method="post" class="needs-validation" novalidate>
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

                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</button>
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



Bước 4: Tạo tập tin dangnhap_xuly.php
- Dùng biến siêu toàn cục $_SESSION để lưu trữ trạng thái đăng nhập.
- Khi đăng nhập thành công sẽ biết được: Mã người dùng, Họ tên và Quyền hạn.
- Code mẫu tập tin dangnhap_xuly.php:
 <?php
     require_once 'ketnoi.php';

     $TenDangNhap = $_POST['TenDangNhap'];
     $MatKhau = $_POST['MatKhau'];

     try
     {
           $sql = 'SELECT * FROM tbl_nguoidung WHERE TenDangNhap = :TenDangNhap AND MatKhau = :MatKhau';
           $cmd = $conn->prepare($sql);
           $cmd->bindValue(':TenDangNhap', $TenDangNhap);
           $cmd->bindValue(':MatKhau', sha1($MatKhau));
           $cmd->execute();
           $result = $cmd->fetch();

           if($result)
           {
               if($result['Khoa'] == 1)
               {
                   $error_message = 'Tài khoản người dùng đã bị khóa!';
                   include_once 'error.php';
               }
               else
               {
                   // Đăng ký SESSION
                   $_SESSION['ID'] = $result['ID'];
                   $_SESSION['HoVaTen'] = $result['HoVaTen'];
                   $_SESSION['QuyenHan'] = $result['QuyenHan'];

                  // Quay về trang chủ
                        header('Location: index.php');
                 }
          }
          else
          {
              $error_message = 'Tài khoản không tồn tại!';
              include_once 'error.php';
          }
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>



Bước 5: Cập nhật lại tập tin navbar.php
- Nếu chưa đăng nhập thì hiện Đăng ký và Đăng nhập.
- Nếu đã đăng nhập thành công thì ẩn Đăng ký và Đăng nhập; hiện lời chào và Đăng xuất.
- Nếu là Quản trị viên thì hiện Quản lý, nếu là Thành viên thì hiện menu dành cho Thành viên.
- Code mẫu tập tin navbar.php:
 <nav class="navbar navbar-expand-lg bg-info" data-bs-theme="light">
     <div class="container-fluid">
         <a class="navbar-brand" href="index.php"><i class="bi bi-star-fill"></i> iNews</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="#"><i class="bi bi-cup-hot"></i> Tin mới nhất</a>
                  </li>
                  <?php
                      if(isset($_SESSION['ID'])) // Nếu đã đăng nhập
                      {
                  ?>
                          <?php
                              if($_SESSION['QuyenHan'] == 1) // Nếu là Quản trị viên
                              {
                          ?>
                                  <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                   <i class="bi bi-database-gear"></i> Quản lý
                                                            </a>
                           <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="chude.php"><i class="bi bi-diagram-2"></i> Chủ đề</a></li>
                               <li><a class="dropdown-item" href="nguoidung.php"><i class="bi bi-people"></i> Người dùng</a></li>
                               <li><hr class="dropdown-divider"></li>
                               <li><a class="dropdown-item" href="baiviet.php"><i class="bi bi-stickies"></i> Bài viết</a></li>
                           </ul>
                       </li>
               <?php
                   }
                   else
                   {
               ?>
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['HoVaTen']; ?>
                       </a>
                       <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="baiviet_them.php"><i class="bi bi-pencil-square"></i> Đăng bài viết</a></li>
                            <li><a class="dropdown-item" href="baiviet_cuatoi.php"><i class="bi bi-person-badge"></i> Bài viết của tôi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="nguoidung_doimatkhau.php"><i class="bi bi-key"></i> Đổi mật khẩu</a></li>
                       </ul>
                   </li>
               <?php
                   }
               ?>

               <li class="nav-item">
                   <a class="nav-link" href="dangxuat.php"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
               </li>
        <?php
            }
            else // Nếu chưa đăng nhập
            {
        ?>
                <li class="nav-item">
                    <a class="nav-link" href="dangky.php"><i class="bi bi-person-plus"></i> Đăng ký</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dangnhap.php"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
                </li>
        <?php
            }
        ?>
    </ul>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Bạn muốn tìm gì?" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>
    </div>
</nav>



Bước 6: Tạo tập tin dangxuat.php
<?php
    session_start();

     // Hủy SESSION
     unset($_SESSION['ID']);
     unset($_SESSION['HoVaTen']);
     unset($_SESSION['QuyenHan']);

     // Quay về trang chủ
     header("Location: index.php");
?>



Bước 7: Tạo tập tin baiviet_them.php
<?php
    require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Thêm bài viết - iNews</title>
        <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container">
            <?php include_once 'navbar.php'; ?>

             <div class="card mt-3">
                 <h5 class="card-header">Thêm bài viết</h5>
                 <div class="card-body">
                     <form action="baiviet_them_xuly.php" method="post" class="needs-validation" novalidate>
                         <div class="mb-3">
                             <label for="MaChuDe" class="form-label">Chủ đề</label>
                             <select class="form-select" id="MaChuDe" name="MaChuDe" required>
                                 <option value="">-- Chọn --</option>
                                 <?php
                                     $sql = 'SELECT * FROM tbl_chude';
                            $cmd = $conn->prepare($sql);
                            $cmd->execute();
                            $result = $cmd->fetchAll();

                            foreach($result as $value)
                            {
                                echo '<option value="' . $value['ID'] . '">' . $value['TenChuDe'] . '</option>';
                            }
                       ?>
                   </select>
                   <div class="invalid-feedback">Chưa chọn chủ đề.</div>
               </div>

               <div class="mb-3">
                   <label for="TieuDe" class="form-label">Tiêu đề bài viết</label>
                   <input type="text" class="form-control" id="TieuDe" name="TieuDe" required />
                   <div class="invalid-feedback">Tiêu đề bài viết không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="TomTat" class="form-label">Tóm tắt</label>
                   <textarea class="form-control" id="TomTat" name="TomTat" required></textarea>
                   <div class="invalid-feedback">Tóm tắt không được bỏ trống.</div>
               </div>

               <div class="mb-3">
                   <label for="NoiDung" class="form-label">Nội dung bài viết</label>
                   <textarea class="form-control" id="NoiDung" name="NoiDung" required></textarea>
                   <div class="invalid-feedback">Nội dung bài viết không được bỏ trống.</div>
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



Bước 8: Nhúng CKEditor vào tập tin baiviet_them.php
- Giải nén tập tin ckeditor5.zip và sao chép vào thư mục js.
- Bổ sung thêm code vào tập tin baiviet_them.php:
 <script src="js/ckeditor5/ckeditor.js"></script>
 <script>
     ClassicEditor.create(document.querySelector('#NoiDung'), {
          licenseKey: '',
     }).then(editor => {
          window.editor = editor;
     }).catch(error => {
          console.error(error);
     });
 </script>



Bước 9: Tạo tập tin baiviet_them_xuly.php
 <?php
     require_once 'ketnoi.php';

     $MaChuDe = $_POST['MaChuDe'];
     $TieuDe = $_POST['TieuDe'];
     $TomTat = $_POST['TomTat'];
     $NoiDung = $_POST['NoiDung'];

     try
     {
           // Mã người dùng
           $MaNguoiDung = $_SESSION['ID'];

           // Kiểm quyệt
           $KiemDuyet = $_SESSION['QuyenHan'] == 1 ? 1 : 0;

           $sql = 'INSERT INTO tbl_baiviet(MaChuDe, MaNguoiDung, TieuDe, TomTat, NoiDung, NgayDang, LuotXem, KiemDuyet)
                   VALUES (:MaChuDe, :MaNguoiDung, :TieuDe, :TomTat, :NoiDung, :NgayDang, :LuotXem, :KiemDuyet)';
          $cmd = $conn->prepare($sql);
          $cmd->bindValue(':MaChuDe', $MaChuDe);
          $cmd->bindValue(':MaNguoiDung', $MaNguoiDung);
          $cmd->bindValue(':TieuDe', $TieuDe);
          $cmd->bindValue(':TomTat', $TomTat);
          $cmd->bindValue(':NoiDung', $NoiDung);
          $cmd->bindValue(':NgayDang', date('Y-m-d H:i:s'));    // Lấy giờ hiện tại của server
          $cmd->bindValue(':LuotXem', 0);                       // Mặc định lượt xem là 0
          $cmd->bindValue(':KiemDuyet', $KiemDuyet);
          $result = $cmd->execute();

          $message = 'Đăng bài viết thành công!';
          include_once 'success.php';
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>
Thiết lập múi giờ GMT + 7 bằng cách bổ sung thêm hàm vào cuối tập tin ketnoi.php:
 date_default_timezone_set('Asia/Ho_Chi_Minh');



Bước 10: Tạo tập tin baiviet_cuatoi.php (Trang hiển thị cho Thành viên)
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <title>Bài viết của tôi - iNews</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
     </head>
     <body>
         <div class="container">
             <?php include_once 'navbar.php'; ?>

              <div class="card mt-3">
                  <h5 class="card-header">Bài viết của tôi</h5>
                  <div class="card-body">

                      <p><a href="baiviet_them.php" class="btn btn-info"><i class="bi bi-plus-lg"></i> Thêm mới</a></p>
                    <table class="table table-sm table-hover table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Chủ đề</th>
                                <th width="50%">Tiêu đề</th>
                                <th width="20%">Ngày đăng</th>
                                <th width="5%" title="Tình trạng kiểm duyệt">D?</th>
                                <th width="5%">Sửa</th>
                                <th width="5%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'SELECT b.*, c.TenChuDe
                                        FROM tbl_baiviet b, tbl_chude c
                                        WHERE b.MaChuDe = c.ID AND b.MaNguoiDung = :MaNguoiDung';
                                $cmd = $conn->prepare($sql);
                                $cmd->bindValue(':MaNguoiDung', $_SESSION['ID']);
                                $cmd->execute();
                                $result = $cmd->fetchAll();

                               $stt = 1;
                               foreach($result as $value)
                               {
                                   echo '<tr>
                                           <td>' . $stt++ . '</td>
                                           <td>' . $value['TenChuDe'] . '</td>
                                           <td>' . $value['TieuDe'] . '</td>
                                           <td>' . $value['NgayDang'] . '</td>
                                           <td>' . ($value['KiemDuyet'] == 1 ? "Đã duyệt" : "Chưa duyệt") . '</td>
                                            <td class="text-center"><a href="baiviet_sua.php?id=' . $value['ID'] . '"><i class="bi bi-pencil-square"></i></a></td>
                                            <td class="text-center"><a href="baiviet_xoa.php?id=' . $value['ID'] . '"><i class="bi bi-trash text-danger"></i></a></td>
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
Bước 11: Tạo tập tin baiviet.php (Trang hiển thị cho Quản trị viên)
<?php
    require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bài viết - iNews</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    </head>
    <body>
        <div class="container">
            <?php include_once 'navbar.php'; ?>

            <div class="card mt-3">
                <h5 class="card-header">Bài viết</h5>
                <div class="card-body">

                    <p><a href="baiviet_them.php" class="btn btn-info"><i class="bi bi-plus-lg"></i> Thêm mới</a></p>

                    <table class="table table-sm table-hover table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Người đăng</th>
                                <th width="10%">Chủ đề</th>
                                <th width="40%">Tiêu đề</th>
                                <th width="15%">Ngày đăng</th>
                                <th width="5%" title="Tình trạng kiểm duyệt">D?</th>
                                <th width="5%">Sửa</th>
                                <th width="5%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'SELECT b.*, c.TenChuDe, n.HoVaTen
                                        FROM tbl_baiviet b, tbl_chude c, tbl_nguoidung n
                                        WHERE b.MaChuDe = c.ID AND b.MaNguoiDung = n.ID';
                                $cmd = $conn->prepare($sql);
                                $cmd->execute();
                                $result = $cmd->fetchAll();

                               $stt = 1;
                               foreach($result as $value)
                               {
                                    echo '<tr>
                                            <td>' . $stt++ . '</td>
                                            <td>' . $value['HoVaTen'] . '</td>
                                            <td>' . $value['TenChuDe'] . '</td>
                                            <td>' . $value['TieuDe'] . '</td>
                                            <td>' . $value['NgayDang'] . '</td>
                                            <td>' . ($value['KiemDuyet'] == 1 ? "Đã duyệt" : "Chưa duyệt") . '</td>
                                            <td class="text-center"><a href="baiviet_sua.php?id=' . $value['ID'] . '"><i class="bi bi-pencil-square"></i></a></td>
                                            <td class="text-center"><a href="baiviet_xoa.php?id=' . $value['ID'] . '"><i class="bi bi-trash text-danger"></i></a></td>
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



Bước 12: Tạo tập tin baiviet_sua.php
<?php
    require_once 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sửa bài viết - iNews</title>
        <link rel="shortcut icon" href="images/premium.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container">
            <?php include_once 'navbar.php'; ?>

            <div class="card mt-3">
                <h5 class="card-header">Sửa bài viết</h5>
                <div class="card-body">
                    <?php
                        $id = $_GET['id'];
     $sql = 'SELECT * FROM tbl_baiviet WHERE ID = :ID';
     $cmd = $conn->prepare($sql);
     $cmd->bindValue(':ID', $id);
     $cmd->execute();
     $result = $cmd->fetch();
?>

<form action="baiviet_sua_xuly.php" method="post" class="needs-validation" novalidate>
    <input type="text" id="ID" name="ID" value="<?php echo $result['ID']; ?>" hidden />

     <div class="mb-3">
         <label for="MaChuDe" class="form-label">Chủ đề</label>
         <select class="form-select" id="MaChuDe" name="MaChuDe" required>
             <option value="">-- Chọn --</option>
             <?php
                 $sqlChuDe = 'SELECT * FROM tbl_chude';
                 $cmdChuDe = $conn->prepare($sqlChuDe);
                 $cmdChuDe->execute();
                 $resultChuDe = $cmdChuDe->fetchAll();

                 foreach($resultChuDe as $value)
                 {
                     if($value['ID'] == $result['MaChuDe'])
                          echo '<option value="' . $value['ID'] . '" selected>' . $value['TenChuDe'] . '</option>';
                     else
                          echo '<option value="' . $value['ID'] . '">' . $value['TenChuDe'] . '</option>';
                 }
             ?>
         </select>
         <div class="invalid-feedback">Chưa chọn chủ đề.</div>
     </div>

     <div class="mb-3">
         <label for="TieuDe" class="form-label">Tiêu đề bài viết</label>
        <input type="text" class="form-control" id="TieuDe" name="TieuDe" value="<?php echo $result['TieuDe']; ?>" required />
         <div class="invalid-feedback">Tiêu đề bài viết không được bỏ trống.</div>
     </div>

     <div class="mb-3">
         <label for="TomTat" class="form-label">Tóm tắt</label>
         <textarea class="form-control" id="TomTat" name="TomTat" required><?php echo $result['TomTat']; ?></textarea>
         <div class="invalid-feedback">Tóm tắt không được bỏ trống.</div>
     </div>

     <div class="mb-3">
         <label for="NoiDung" class="form-label">Nội dung bài viết</label>
        <textarea class="form-control" id="NoiDung" name="NoiDung" required><?php echo $result['NoiDung']; ?></textarea>
         <div class="invalid-feedback">Nội dung bài viết không được bỏ trống.</div>
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
        <script src="js/ckeditor5/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#NoiDung'), {
                licenseKey: '',
            }).then(editor => {
                window.editor = editor;
            }).catch(error => {
                console.error(error);
            });
        </script>
    </body>
</html>



Bước 13: Tạo tập tin baiviet_sua_xuly.php
<?php
    require_once 'ketnoi.php';

    $ID = $_POST['ID'];
    $MaChuDe = $_POST['MaChuDe'];
    $TieuDe = $_POST['TieuDe'];
    $TomTat = $_POST['TomTat'];
    $NoiDung = $_POST['NoiDung'];
      try
      {
            $sql = 'UPDATE  tbl_baiviet
                    SET     MaChuDe = :MaChuDe,
                            TieuDe = :TieuDe,
                            TomTat = :TomTat,
                            NoiDung = :NoiDung
                    WHERE   ID = :ID';
            $cmd = $conn->prepare($sql);
            $cmd->bindValue(':ID', $ID);
            $cmd->bindValue(':MaChuDe', $MaChuDe);
            $cmd->bindValue(':TieuDe', $TieuDe);
            $cmd->bindValue(':TomTat', $TomTat);
            $cmd->bindValue(':NoiDung', $NoiDung);
            $result = $cmd->execute();

            $message = 'Cập nhật bài viết thành công!';
            include_once 'success.php';
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
 ?>
- Nếu bài viết đã được duyệt thì không cho sửa và xóa đối với quyền Thành viên.
- Sinh viên tự xây dựng chức năng Duyệt bài viết (Chức năng này chỉ có Quản trị viên mới thao tác được).


Bước 14: Tạo tập tin baiviet_xoa.php
 <?php
     require_once 'ketnoi.php';

      $id = $_GET['id'];

      try
      {
            $sql = 'DELETE FROM tbl_baiviet WHERE ID = :ID';
            $cmd = $conn->prepare($sql);
            $cmd->bindValue(':ID', $id);
            $result = $cmd->execute();

            $message = 'Đã xóa bài viết thành công!';
            include_once 'success.php';
      }
      catch(PDOException $e)
     {
         echo $e->getMessage();
     }
?>

                                  HẾT BUỔI 2
