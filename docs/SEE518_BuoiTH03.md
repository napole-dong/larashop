                                         BUỔI 3: XÂY DỰNG GIAO DIỆN HIỂN THỊ TIN TỨC

Bước 1: Chỉnh sửa tập tin index.php sử dụng trang web mẫu Milo
- Sử dụng trang web mẫu Milo tại liên kết: https://themes.getbootstrap.com/product/milo-magazineblog-theme
- Sao chép toàn bộ nội dung trong thư mục milo vào trangtin_v3.0.
- Xóa toàn bộ nội dung đang có trong tập tin index.php.
- Sao chép toàn bộ code trong tập tin home.html vào index.php.


Kết quả khi chạy trên trình duyệt:
- Chỉnh code phần <head>:
 <?php
     require_once 'ketnoi.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="Trang tin điện tử nhiều người xem nhất vũ trụ." />
     <meta name="author" content="Nguyễn Hoàng Tùng" />
     <title>Trang chủ - iNews</title>
     <link href="css/app.css" rel="stylesheet" />
 </head>



- Tách các phần dùng chung ra các trang con để tái sử dụng.
 Tách phần header ra một trang mới và lưu lại với tên index_header.php
 Tách phần sidebar ra một trang mới và lưu lại với tên index_sidebar.php
 Tách phần footer ra một trang mới và lưu lại với tên index_footer.php
Code trang index.php sau khi tách và dùng hàm include_once để “nhập lại”:
- Hiển thị các chủ đề từ CSDL vào menu Chuyên mục (bổ sung code trong tập tin index_header.php).
 <div class="dropdown-menu" aria-labelledby="chuyenmuc">
     <?php
         $sqlCM = 'SELECT * FROM tbl_chude ORDER BY TenChuDe';
         $cmdCM = $conn->prepare($sqlCM);
         $cmdCM->execute();
         $resultCM = $cmdCM->fetchAll();

          foreach($resultCM as $value)
          {
              echo '<a class="dropdown-item" href="baiviet_chude.php?id=' . $value['ID'] . '">' . $value['TenChuDe'] . '</a>';
          }
     ?>
 </div>
- Hiển thị các bài viết từ CSDL vào vùng bên trái (Gợi ý: Dùng hàm array_chunk).
 <div class="col-md-9">
     <div class="row">
         <?php
             $sqlBV = 'SELECT b.*, c.TenChuDe
                        FROM tbl_baiviet b, tbl_chude c
                        WHERE b.MaChuDe = c.ID AND b.KiemDuyet = 1 ORDER BY b.NgayDang DESC LIMIT 12';
             $cmdBV = $conn->prepare($sqlBV);
             $cmdBV->execute();
             $resultBV = $cmdBV->fetchAll();

              foreach(array_chunk($resultBV, 4) as $array)
              {
                  if(count($resultBV) <= 4)
                      echo '<div class="col-12">';
                  else if(count($resultBV) <= 8)
                      echo '<div class="col-md-6">';
                  else
                      echo '<div class="col-md-4">';

                  foreach($array as $value)
                  {
                      echo '<article class="card mb-4">
                              <header class="card-header">
                                  <div class="card-meta">
                                       <a href="#"><time class="timeago" datetime="' . $value['NgayDang'] . '"></time></a>
                                       thuộc <a href="baiviet_chude.php?id=' . $value['MaChuDe'] . '">' . $value['TenChuDe'] . '</a>
                                  </div>
                                  <a href="baiviet_chitiet.php?id=' . $value['ID'] . '">
                                       <h4 class="card-title">' . $value['TieuDe'] . '</h4>
                                  </a>
                              </header>
                              <a href="baiviet_chitiet.php?id=' . $value['ID'] . '">
                                  <img class="card-img" src="' . LayHinhDauTien($value['NoiDung']) . '" alt="" />
                              </a>
                              <div class="card-body">
                                  <p class="card-text">' . $value['TomTat'] . '</p>
                              </div>
                            </article>';
                  }

                  echo '</div>';
              }
         ?>
     </div>
 </div>
Kết quả khi chạy trên trình duyệt:
- Hiển thị các chủ đề từ CSDL vào vùng Thẻ bên phải (bổ sung code trong tập tin index_sidebar.php).
 <div class="card-body">
     <h4 class="card-title">Thẻ</h4>
     <?php
         foreach($resultCM as $value)
         {
              echo '<a class="btn btn-light btn-sm mb-1 me-1" href="baiviet_chude.php?id=' . $value['ID'] . '">' . $value['TenChuDe'] . '</a>';
          }
     ?>
 </div>




- Hiển thị 2 bài viết có nhiều người xem nhất vào vùng Xem nhiều nhất bên phải (bổ sung code trong tập tin index_sidebar.php).
 <div class="card-body">
     <h4 class="card-title">Xem nhiều nhất</h4>
     <?php
         $sqlXNN = 'SELECT b.*, c.TenChuDe
                    FROM tbl_baiviet b, tbl_chude c
                    WHERE b.MaChuDe = c.ID AND b.KiemDuyet = 1 ORDER BY b.LuotXem DESC LIMIT 2';
         $cmdXNN = $conn->prepare($sqlXNN);
         $cmdXNN->execute();
         $resultXNN = $cmdXNN->fetchAll();

          foreach($resultXNN as $value)
          {
              echo '<a href="baiviet_chitiet.php?id=' . $value['ID'] . '" class="d-inline-block mt-3">
                      <h4 class="h6">' . $value['TieuDe'] . '</h4>
                      <img class="card-img" src="' . LayHinhDauTien($value['NoiDung']) . '" alt="" />
                    </a>';
              echo '<time class="timeago" datetime="' . $value['NgayDang'] . '"></time> thuộc ' . $value['TenChuDe'];
          }
     ?>
 </div>




Bước 2: Tạo tập tin baiviet_chitiet.php
- Sao chép tập tin index.php thành một tập tin mới và lưu lại với tên baiviet_chitiet.php.
- Sao chép code từ details.html vào tập tin baiviet_chitiet.php (chỉ sao chép phần nội dung bên trái như hình bên dưới).
- Xử lý code khi nhấn vào một bài viết từ trang index.php sẽ chuyển sang baiviet_chitiet.php và hiển thị nó.
 <?php
     require_once 'ketnoi.php';
     require_once 'thuvien.php';

     $id = $_GET['id'];
   $sqlBV = 'SELECT b.*, c.TenChuDe
             FROM tbl_baiviet b, tbl_chude c
             WHERE b.MaChuDe = c.ID AND b.KiemDuyet = 1 AND b.ID = :ID';
   $cmdBV = $conn->prepare($sqlBV);
   $cmdBV->bindValue(':ID', $id);
   $cmdBV->execute();
   $resultBV = $cmdBV->fetch();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Trang tin điện tử nhiều người xem nhất vũ trụ." />
    <meta name="author" content="Nguyễn Hoàng Tùng" />
    <title><?php echo $resultBV['TieuDe']; ?> - iNews</title>
    <link href="css/app.css" rel="stylesheet" />
</head>


<div class="col-md-9">
    <article class="card mb-4">
        <header class="card-header text-center">
            <div class="card-meta">
                <a href="#">Đăng vào <time class="timeago" datetime="<?php echo $resultBV['NgayDang']; ?>"></time></a>
                thuộc <a href="baiviet_chude.php?id=<?php echo $resultBV['MaChuDe']; ?>"><?php echo $resultBV['TenChuDe']; ?></a>,
                có <?php echo $resultBV['LuotXem']; ?> lượt xem.
            </div>
            <a href="#">
                <h3 class="card-title"><?php echo $resultBV['TieuDe']; ?></h3>
            </a>
        </header>
        <div class="card-body">
            <p class="fw-bold"><?php echo $resultBV['TomTat']; ?></p>
            <?php echo $resultBV['NoiDung']; ?>

            <hr />
            <h3>2 bình luận</h3>
            ...
        </div>
    </article>
</div>
Kết quả khi chạy trên trình duyệt:
- Khi xem một bài viết thì tăng lên 1 lượt xem (chỉ tăng 1 lần).
 // Xử lý tăng lượt xem
 if(!isset($_SESSION['DaXem' . $id]))
 {
     $sqlTLX = 'UPDATE tbl_baiviet SET LuotXem = LuotXem + 1 WHERE ID = :ID';
     $cmdTLX = $conn->prepare($sqlTLX);
     $cmdTLX->bindValue(':ID', $id);
     $cmdTLX->execute();

     // Đánh dấu đã xem
     $_SESSION['DaXem' . $id] = 1;
 }



Bước 3: Tạo tập tin baiviet_chude.php
- Sao chép tập tin index.php thành một tập tin mới và lưu lại với tên baiviet_chude.php.
- Sao chép code từ category.html vào tập tin baiviet_chude.php (chỉ sao chép phần nội dung bên trái như hình bên dưới).
- Xử lý code khi nhấn vào một vào chủ đề từ trang index.php sẽ chuyển sang baiviet_chude.php và hiển thị nó.
 <?php
     require_once 'ketnoi.php';
     require_once 'thuvien.php';

     $maChuDe = $_GET['id'];

     $sqlCD = 'SELECT * FROM tbl_chude WHERE ID = :ID';
     $cmdCD = $conn->prepare($sqlCD);
     $cmdCD->bindValue(':ID', $maChuDe);
     $cmdCD->execute();
     $resultCD = $cmdCD->fetch();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="Trang tin điện tử nhiều người xem nhất vũ trụ." />
     <meta name="author" content="Nguyễn Hoàng Tùng" />
     <title>Bài viết thuộc chuyên mục <?php echo $resultCD['TenChuDe']; ?> - iNews</title>
     <link href="css/app.css" rel="stylesheet" />
 </head>


 <div class="col-md-9">
     <div class="text-center">
         <span class="text-muted">Chuyên mục:</span>
         <h3><?php echo $resultCD['TenChuDe']; ?></h3>
         <hr />
     </div>
<div class="row">
    <?php
        $sqlBV = 'SELECT b.*, c.TenChuDe
                  FROM tbl_baiviet b, tbl_chude c
                  WHERE b.MaChuDe = c.ID AND b.KiemDuyet = 1 AND b.MaChuDe = :MaChuDe ORDER BY b.NgayDang DESC LIMIT 8';
        $cmdBV = $conn->prepare($sqlBV);
        $cmdBV->bindValue(':MaChuDe', $maChuDe);
        $cmdBV->execute();
        $resultBV = $cmdBV->fetchAll();

        if($resultBV)
        {
            foreach(array_chunk($resultBV, 4) as $array)
            {
                if(count($resultBV) <= 4)
                     echo '<div class="col-12">';
                else
                     echo '<div class="col-md-6">';

                foreach($array as $value)
                {
                    echo '<article class="card mb-4">
                            <header class="card-header">
                                 <div class="card-meta">
                                      <a href="#"><time class="timeago" datetime="' . $value['NgayDang'] . '"></time></a>
                                      thuộc <a href="baiviet_chude.php?id=' . $value['MaChuDe'] . '">' . $value['TenChuDe'] . '</a>
                                 </div>
                                 <a href="baiviet_chitiet.php?id=' . $value['ID'] . '">
                                      <h4 class="card-title">' . $value['TieuDe'] . '</h4>
                                 </a>
                            </header>
                            <a href="baiviet_chitiet.php?id=' . $value['ID'] . '">
                                 <img class="card-img" src="' . LayHinhDauTien($value['NoiDung']) . '" alt="" />
                            </a>
                            <div class="card-body">
                                 <p class="card-text">' . $value['TomTat'] . '</p>
                            </div>
                          </article>';
                }

                echo '</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Rất tiếc!</h4>
                    <p>Không có bài viết nào trong chuyên mục này.</p>
                    <hr>
                           <div class="btn-list">
                               <a class="btn btn-primary" type="button" href="index.php">Về trang chủ</a>
                           </div>
                         </div>';
              }
         ?>
     </div>
 </div>



Bước 4: Tạo tập tin baiviet_timkiem.php
- Sao chép tập tin index.php thành một tập tin mới và lưu lại với tên baiviet_timkiem.php.
- Sao chép code từ search.html vào tập tin baiviet_timkiem.php (chỉ sao chép phần nội dung bên trái như hình bên dưới).
- Xử lý code hiển thị kết quả tìm kiếm các bài viết có từ khóa chứa trong tiêu đề và tóm tắt vào tập tin baiviet_timkiem.php.
 <div class="col-md-9">
     <div class="text-center">
         <h3>Kết quả tìm kiếm</h3>
         <hr />
     </div>

     <?php
         $tukhoa = '%' . trim($_POST['tukhoa']) . '%';

          $sqlBV = "SELECT b.*, c.TenChuDe
                    FROM tbl_baiviet b, tbl_chude c
                    WHERE b.MaChuDe = c.ID AND b.KiemDuyet = 1 AND (b.TieuDe LIKE :TuKhoa OR b.TomTat LIKE :TuKhoa)
                    ORDER BY NgayDang DESC LIMIT 12";
          $cmdBV = $conn->prepare($sqlBV);
          $cmdBV->bindValue(':TuKhoa', $tukhoa);
          $cmdBV->execute();
          $resultBV = $cmdBV->fetchAll();

          if($resultBV)
          {
              foreach($resultBV as $value)
              {
                  echo '<article class="card mb-4">
                           <header class="card-header px-0">
                               <div class="card-meta">
                                   <a href="#"><time class="timeago" datetime="' . $value['NgayDang'] . '"></time></a>
                                   thuộc <a href="baiviet_chude.php?id=' . $value['MaChuDe'] . '">' . $value['TenChuDe'] . '</a>
                               </div>
                               <a href="baiviet_chitiet.php?id=' . $value['ID'] . '">
                                   <h4 class="card-title">' . $value['TieuDe'] . '</h4>
                               </a>
                           </header>
                           <div class="card-body px-0 pt-0">
                               <p class="card-text">' . $value['TomTat'] . '</p>
                           </div>
                        </article>';
              }
          }
          else
          {
              echo '<div class="alert alert-primary" role="alert">
                      <h4 class="alert-heading">Rất tiếc!</h4>
                      <p>Đã tìm rất kỹ nhưng không có bài viết nào phù hợp.</p>
                      <hr>
                      <div class="btn-list">
                           <a class="btn btn-primary" type="button" href="index.php">Về trang chủ</a>
                      </div>
             </div>';
         }
    ?>
</div>



                        HẾT BUỔI 3
