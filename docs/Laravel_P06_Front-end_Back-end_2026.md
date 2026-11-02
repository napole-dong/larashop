                                                                                                      Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                   PHẦN 6: XÂY DỰNG GIAO DIỆN FRONT-END và BACK-END
Bước 1: Tách giao diện Front-end và Back-end
Trong 5 phần trước chúng ta đã tập trung xây dựng cho phần Back-end (Trang dành cho người quản lý).
Nhưng phần thiết lập routes chưa được tối ưu.


Hướng đề xuất:
- Trang Back-end (admin) sẽ có đường dẫn là ../admin/
http://127.0.0.1/larashop/admin/loaisanpham
http://127.0.0.1/larashop/admin/loaisanpham/them
http://127.0.0.1/larashop/admin/loaisanpham/sua/1



- Trang Front-end sẽ không có ../admin/ và địa chỉ thân thiện hơn.
http://127.0.0.1/larashop/san-pham
http://127.0.0.1/larashop/san-pham/dien-thoai
http://127.0.0.1/larashop/san-pham/dien-thoai/iphone-14-plus-128gb



 Code routes/web.php gợi ý:
 <?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\HomeController;
 use App\Http\Controllers\LoaiSanPhamController;
 use App\Http\Controllers\HangSanXuatController;
 use App\Http\Controllers\SanPhamController;
 use App\Http\Controllers\TinhTrangController;
 use App\Http\Controllers\DonHangController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\KhachHangController;
 use App\Http\Controllers\QuanTriVienController;

 // Đăng ký, đăng nhập, Quên mật khẩu
 Auth::routes();

 // Các trang dành cho khách chưa đăng nhập
 Route::name('frontend.')->group(function() {
     // Trang chủ
     Route::get('/', [HomeController::class, 'getHome'])->name('home');
      Route::get('/home', [HomeController::class, 'getHome'])->name('home');

      // Trang sản phẩm
      Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('sanpham');
      Route::get('/san-pham/{tenloai_slug}', [HomeController::class, 'getSanPham'])->name('sanpham.phanloai');
      Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('sanpham.chitiet');

      // Tin tức
      Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
      Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
      Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');

      // Trang giỏ hàng
      Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('giohang');
      Route::get('/gio-hang/them/{tensanpham_slug}', [HomeController::class, 'getGioHang_Them'])->name('giohang.them');
      Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('giohang.xoa');
      Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('giohang.giam');
      Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('giohang.tang');

      // Tuyển dụng
      Route::get('/tuyen-dung', [HomeController::class, 'getTuyenDung'])->name('tuyendung');

      // Liên hệ
      Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');
});

// Trang khách hàng
Route::get('/user/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/user/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');

// Trang tài khoản khách hàng
Route::prefix('user')->name('user.')->group(function() {
    // Trang chủ của giao diện khách hàng
    Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
    Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');

      // Đặt hàng
      Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
      Route::post('/dat-hang', [KhachHangController::class, 'postDatHang'])->name('dathang');
      Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('dathangthanhcong');

      // Xem và cập nhật trạng thái đơn hàng
      Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
      Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang'])->name('donhang.chitiet');
      Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang'])->name('donhang.chitiet');

      // Cập nhật thông tin tài khoản
      Route::get('/ho-so', [KhachHangController::class, 'getHoSo'])->name('hoso');
      Route::post('/ho-so', [KhachHangController::class, 'postHoSo'])->name('hoso');
      // Đổi mật khẩu
      Route::get('/doi-mat-khau', [KhachHangController::class, 'getDoiMatKhau'])->name('doimatkhau');
      Route::post('/doi-mat-khau', [KhachHangController::class, 'postDoiMatKhau'])->name('doimatkhau');

      // Đăng xuất
      Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
});

// Trang tài khoản quản trị
Route::prefix('admin')->name('admin.')->group(function() {
    // Trang chủ của giao diện quản trị
    Route::get('/', [QuanTriVienController::class, 'getHome'])->name('home');
    Route::get('/home', [QuanTriVienController::class, 'getHome'])->name('home');

      // Quản lý Loại sản phẩm
      Route::get('/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('loaisanpham');
      Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('loaisanpham.them');
      Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('loaisanpham.them');
      Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('loaisanpham.sua');
      Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('loaisanpham.sua');
      Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('loaisanpham.xoa');

      // Quản lý Hãng sản xuất
      Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('hangsanxuat');
      Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('hangsanxuat.them');
      Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('hangsanxuat.them');
      Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('hangsanxuat.sua');
      Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('hangsanxuat.sua');
      Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('hangsanxuat.xoa');
      Route::post('/hangsanxuat/nhap', [HangSanXuatController::class, 'postNhap'])->name('hangsanxuat.nhap');
      Route::get('/hangsanxuat/xuat', [HangSanXuatController::class, 'getXuat'])->name('hangsanxuat.xuat');

      // Quản lý Sản phẩm
      Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('sanpham');
      Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('sanpham.them');
      Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('sanpham.them');
      Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('sanpham.sua');
      Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('sanpham.sua');
      Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('sanpham.xoa');
      Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('sanpham.nhap');
      Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('sanpham.xuat');

      // Quản lý Tình trạng
      Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang');
      Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them');
      Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them');
      Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua');
      Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua');
       Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa');

       // Quản lý Đơn hàng
       Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('donhang');
       Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('donhang.them');
       Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('donhang.them');
       Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('donhang.sua');
       Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('donhang.sua');
       Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('donhang.xoa');

       // Quản lý Tài khoản người dùng
       Route::get('/nguoidung', [UserController::class, 'getDanhSach'])->name('nguoidung');
       Route::get('/nguoidung/them', [UserController::class, 'getThem'])->name('nguoidung.them');
       Route::post('/nguoidung/them', [UserController::class, 'postThem'])->name('nguoidung.them');
       Route::get('/nguoidung/sua/{id}', [UserController::class, 'getSua'])->name('nguoidung.sua');
       Route::post('/nguoidung/sua/{id}', [UserController::class, 'postSua'])->name('nguoidung.sua');
       Route::get('/nguoidung/xoa/{id}', [UserController::class, 'getXoa'])->name('nguoidung.xoa');
 });


 Để tăng tính bảo mật, có thể sử dụng thêm middleware vào các routes.
 Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
     ...
 });
- Xem thêm: https://laravel.com/docs/master/middleware#assigning-middleware-to-routes


 Bố trí lại cấu trúc tập tin trong thư mục views:
- Tạo mới thư mục admin, frontend và user.
- Di chuyển các thư mục donhang, hangsanxuat, loaisanpham, nguoidung, sanpham, tinhtrang vào thư mục admin.
- Tạo mới các tập tin home.blade.php trong thư mục admin, frontend và user.
- Tạo mới một view master trong thư mục layouts với tên frontend.blade.php.


 Chỉnh lại các view master cho phù hợp với routes và vị trí tập tin trong views.
- views\layouts\app.blade.php
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />

       <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <title>Trang quản trị - {{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    <i class="fa-light fa-cart-shopping"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left side of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.loaisanpham') }}">
                                <i class="fa-light fa-fw fa-diagram-project"></i> Loại sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.hangsanxuat') }}">
                                <i class="fa-light fa-fw fa-copyright"></i> Hãng sản xuất
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.sanpham') }}">
                                <i class="fa-light fa-fw fa-box"></i> Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.tinhtrang') }}">
                                <i class="fa-light fa-fw fa-list-check"></i> Tình trạng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.donhang') }}">
                                <i class="fa-light fa-fw fa-file-invoice"></i> Đơn hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.nguoidung') }}">
                                <i class="fa-light fa-fw fa-users"></i> Tài khoản
                            </a>
                        </li>
                    </ul>

                    <!-- Right side of Navbar -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @guest
                               @if (Route::has('login'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('login') }}">
                                           <i class="fa-light fa-fw fa-sign-in-alt"></i> Đăng nhập
                                       </a>
                                   </li>
                               @endif
                               @if (Route::has('register'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('register') }}">
                                           <i class="fa-light fa-user-plus"></i> Đăng ký
                                       </a>
                                   </li>
                               @endif
                           @else
                               <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#nguoidung" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                       <i class="fa-light fa-user-circle"></i> {{ Auth::user()->name }}
                                   </a>
                                   <div class="dropdown-menu">
                                       <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                           <i class="fa-light fa-fw fa-sign-out-alt"></i> Đăng xuất
                                       </a>
                                       <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                           @csrf
                                       </form>
                                   </div>
                               </li>
                           @endguest
                       </ul>
                   </div>
               </div>
           </nav>

           <main class="pt-3">
               @yield('content')
           </main>

        <hr class="shadow-sm" />
        <footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
    </div>

     <!-- Scripts -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     @yield('javascript')
 </body>

 </html>



- views\layouts\frontend.blade.php
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <title>Trang khách hàng - {{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('frontend.home') }}">
                    <i class="fa-light fa-cart-shopping"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left side of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.sanpham') }}">
                                <i class="fa-light fa-fw fa-box"></i> Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.baiviet') }}">
                                <i class="fa-light fa-fw fa-newspaper"></i> Tin tức
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.giohang') }}">
                                <i class="fa-light fa-fw fa-cart-shopping"></i> Giỏ hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.tuyendung') }}">
                                <i class="fa-light fa-fw fa-list-check"></i> Tuyển dụng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.lienhe') }}">
                                <i class="fa-light fa-fw fa-phone"></i> Liên hệ
                            </a>
                        </li>
                    </ul>

                    <!-- Right side of Navbar -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @guest
                            @if (Route::has('login'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('login') }}">
                                           <i class="fa-light fa-fw fa-sign-in-alt"></i> Đăng nhập
                                       </a>
                                   </li>
                               @endif
                               @if (Route::has('register'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('register') }}">
                                           <i class="fa-light fa-user-plus"></i> Đăng ký
                                       </a>
                                   </li>
                               @endif
                           @else
                               <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#nguoidung" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                       <i class="fa-light fa-user-circle"></i> {{ Auth::user()->name }}
                                   </a>
                                   <div class="dropdown-menu">
                                       <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                           <i class="fa-light fa-fw fa-sign-out-alt"></i> Đăng xuất
                                       </a>
                                       <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                           @csrf
                                       </form>
                                   </div>
                               </li>
                           @endguest
                       </ul>
                   </div>
               </div>
           </nav>

           <main class="pt-3">
               @yield('content')
           </main>

         <hr class="shadow-sm" />
         <footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
     </div>

     <!-- Scripts -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     @yield('javascript')
 </body>

 </html>



 Chỉnh lại các tập tin Controllers cho phù hợp với routes và vị trí tập tin trong views.
- HomeController: Tập tin HomeController mặc định được tạo ra và cần thiết lập không đăng nhập vẫn truy xuất được.
 <?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        // Bổ sung code tại đây
        return view('frontend.home');
    }

   public function getSanPham($tenloai_slug = '')
   {
       // Bổ sung code tại đây
       return view('frontend.sanpham');
   }

   public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
   {
       // Bổ sung code tại đây
       return view('frontend.sanpham_chitiet');
   }

   public function getBaiViet($tenchude_slug = '')
   {
       // Bổ sung code tại đây
       return view('frontend.baiviet');
   }

   public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
   {
       // Bổ sung code tại đây
       return view('frontend.baiviet_chitiet');
   }

   public function getGioHang()
   {
       // Bổ sung code tại đây
       return view('frontend.giohang');
   }

   public function getGioHang_Them($tensanpham_slug = '')
   {
       // Bổ sung code tại đây
       return redirect()->route('frontend.home');
   }

   public function getGioHang_Xoa($row_id)
     {
         // Bổ sung code tại đây
         return redirect()->route('frontend.giohang');
     }

     public function getGioHang_Giam($row_id)
     {
         // Bổ sung code tại đây
         return redirect()->route('frontend.giohang');
     }

     public function getGioHang_Tang($row_id)
     {
         // Bổ sung code tại đây
         return redirect()->route('frontend.giohang');
     }

     public function getTuyenDung()
     {
         return view('frontend.tuyendung');
     }

     public function getLienHe()
     {
         return view('frontend.lienhe');
     }

     // Trang đăng ký dành cho khách hàng
     public function getDangKy()
     {
         return view('user.dangky');
     }

     // Trang đăng nhập dành cho khách hàng
     public function getDangNhap()
     {
         return view('user.dangnhap');
     }
 }


- KhachHangController (Tạo mới trong thư mục Controllers)
 php artisan make:controller KhachHangController



 <?php

 namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function getHome()
   {
       return view('user.home');
   }

   public function getDatHang()
   {
       // Bổ sung code tại đây
       return view('user.dathang');
   }

   public function postDatHang(Request $request)
   {
       // Bổ sung code tại đây
       return redirect()->route('user.dathangthanhcong');
   }

   public function getDatHangThanhCong()
   {
       return view('user.dathangthanhcong');
   }

   public function getDonHang($id = '')
   {
       // Bổ sung code tại đây
       return view('user.donhang');
   }

   public function postDonHang(Request $request, $id)
   {
       // Bổ sung code tại đây
   }

   public function getHoSo()
   {
       // Bổ sung code tại đây
       return view('user.hoso');
   }
     public function postHoSo(Request $request)
     {
         // Bổ sung code tại đây
         return redirect()->route('user.home');
     }

     public function postDoiMatKhau(Request $request)
     {
         // Bổ sung code tại đây
         return redirect()->route('user.home');
     }

     public function postDangXuat(Request $request)
     {
         // Bổ sung code tại đây
         return redirect()->route('frontend.home');
     }
 }


- QuanTriVienController (Tạo mới trong thư mục Controllers)
 php artisan make:controller QuanTriVienController



 <?php

 namespace App\Http\Controllers;

 use Illuminate\Http\Request;

 class QuanTriVienController extends Controller
 {
     public function __construct()
     {
         $this->middleware('auth');
     }

     public function getHome()
     {
         return view('admin.home');
     }
 }


- LoaiSanPhamController
 // Code cũ
 return view('loaisanpham.danhsach', compact('loaisanpham'));
 return view('loaisanpham.them');
 return view('loaisanpham.sua', compact('loaisanpham'));
 return redirect()->route('loaisanpham');

 // Code mới
 return view('admin.loaisanpham.danhsach', compact('loaisanpham'));
 return view('admin.loaisanpham.them');
 return view('admin.loaisanpham.sua', compact('loaisanpham'));
 return redirect()->route('admin.loaisanpham');


- HangSanXuatController
 // Code cũ
 return view('hangsanxuat.danhsach', compact('hangsanxuat'));
 return view('hangsanxuat.them');
 return view('hangsanxuat.sua', compact('hangsanxuat'));
 return redirect()->route('hangsanxuat');

 // Code mới
 return view('admin.hangsanxuat.danhsach', compact('hangsanxuat'));
 return view('admin.hangsanxuat.them');
 return view('admin.hangsanxuat.sua', compact('hangsanxuat'));
 return redirect()->route('admin.hangsanxuat');


- TinhTrangController
 // Code cũ
 return view('tinhtrang.danhsach', compact('tinhtrang'));
 return view('tinhtrang.them');
 return view('tinhtrang.sua', compact('tinhtrang'));
 return redirect()->route('tinhtrang');

 // Code mới
 return view('admin.tinhtrang.danhsach', compact('tinhtrang'));
 return view('admin.tinhtrang.them');
 return view('admin.tinhtrang.sua', compact('tinhtrang'));
 return redirect()->route('admin.tinhtrang');


- SanPhamController
 // Code cũ
 return view('sanpham.danhsach', compact('sanpham'));
 return view('sanpham.them', compact('loaisanpham', 'hangsanxuat'));
 return view('sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
 return redirect()->route('sanpham');

 // Code mới
 return view('admin.sanpham.danhsach', compact('sanpham'));
 return view('admin.sanpham.them', compact('loaisanpham', 'hangsanxuat'));
 return view('admin.sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
 return redirect()->route('admin.sanpham');


- UserController
 // Code cũ
 return view('nguoidung.danhsach', compact('nguoidung'));
 return view('nguoidung.them');
 return view('nguoidung.sua', compact('nguoidung'));
 return redirect()->route('nguoidung');

 // Code mới
 return view('admin.nguoidung.danhsach', compact('nguoidung'));
 return view('admin.nguoidung.them');
 return view('admin.nguoidung.sua', compact('nguoidung'));
 return redirect()->route('admin.nguoidung');


- DonHangController
 // Code cũ
 return view('donhang.danhsach', compact('donhang'));
 return view('donhang.sua', compact('donhang', 'tinhtrang'));
 return redirect()->route('donhang');

 // Code mới
 return view('admin.donhang.danhsach', compact('donhang'));
 return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
 return redirect()->route('admin.donhang');


 Chỉnh lại các tập tin view cho phù hợp với routes và vị trí tập tin trong views.
- views\admin\home.blade.php (Tạo mới)
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Trang chủ</div>
         <div class="card-body">
             @if (session('status'))
                 <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                 </div>
             @endif
             Trang chủ quản trị.
         </div>
     </div>
 @endsection



- views\frontend\home.blade.php (Tạo mới)
 @extends('layouts.frontend')

 @section('content')
     <div class="card">
         <div class="card-header">Trang chủ</div>
         <div class="card-body">
             @if (session('status'))
                 <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                 </div>
             @endif
             Trang chủ dành cho khách truy cập.
         </div>
     </div>
 @endsection



- views\user\home.blade.php (Tạo mới)
 @extends('layouts.frontend')

 @section('content')
     <div class="card">
         <div class="card-header">Trang chủ</div>
         <div class="card-body">
             @if (session('status'))
                 <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                 </div>
             @endif
             Trang chủ khách hàng.
         </div>
     </div>
 @endsection



- views\admin\loaisanpham\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('loaisanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('loaisanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('loaisanpham.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('loaisanpham.sua', ['id' => $loaisanpham->id]) }}" method="post">
 <form action="{{ route('loaisanpham.them') }}" method="post">

 <!-- Code mới -->
 <a href="{{ route('admin.loaisanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.loaisanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.loaisanpham.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.loaisanpham.sua', ['id' => $loaisanpham->id]) }}" method="post">
 <form action="{{ route('admin.loaisanpham.them') }}" method="post">



- views\admin\hangsanxuat\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('hangsanxuat.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('hangsanxuat.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
 <a href="{{ route('hangsanxuat.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('hangsanxuat.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('hangsanxuat.nhap') }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('hangsanxuat.sua', ['id' => $hangsanxuat->id]) }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('hangsanxuat.them') }}" method="post" enctype="multipart/form-data">

 <!-- Code mới -->
 <a href="{{ route('admin.hangsanxuat.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.hangsanxuat.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
 <a href="{{ route('admin.hangsanxuat.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.hangsanxuat.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.hangsanxuat.nhap') }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('admin.hangsanxuat.sua', ['id' => $hangsanxuat->id]) }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('admin.hangsanxuat.them') }}" method="post" enctype="multipart/form-data">



- views\admin\tinhtrang\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('tinhtrang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('tinhtrang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('tinhtrang.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('tinhtrang.sua', ['id' => $tinhtrang->id]) }}" method="post">
 <form action="{{ route('tinhtrang.them') }}" method="post">

 <!-- Code mới -->
 <a href="{{ route('admin.tinhtrang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.tinhtrang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.tinhtrang.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.tinhtrang.sua', ['id' => $tinhtrang->id]) }}" method="post">
 <form action="{{ route('admin.tinhtrang.them') }}" method="post">



- views\admin\sanpham\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('sanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('sanpham.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
 <a href="{{ route('sanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('sanpham.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('sanpham.nhap') }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('sanpham.sua', ['id' => $sanpham->id]) }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('sanpham.them') }}" method="post" enctype="multipart/form-data">
 <!-- Code mới -->
 <a href="{{ route('admin.sanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.sanpham.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
 <a href="{{ route('admin.sanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.sanpham.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.sanpham.nhap') }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('admin.sanpham.sua', ['id' => $sanpham->id]) }}" method="post" enctype="multipart/form-data">
 <form action="{{ route('admin.sanpham.them') }}" method="post" enctype="multipart/form-data">



- views\admin\nguoidung\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('nguoidung.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('nguoidung.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('nguoidung.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('nguoidung.sua', ['id' => $nguoidung->id]) }}" method="post">
 <form action="{{ route('nguoidung.them') }}" method="post">

 <!-- Code mới -->
 <a href="{{ route('admin.nguoidung.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.nguoidung.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.nguoidung.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.nguoidung.sua', ['id' => $nguoidung->id]) }}" method="post">
 <form action="{{ route('admin.nguoidung.them') }}" method="post">



- views\admin\donhang\*.blade.php
 <!-- Code cũ -->
 <a href="{{ route('donhang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('donhang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('donhang.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('donhang.sua', ['id' => $donhang->id]) }}" method="post">

 <!-- Code mới -->
 <a href="{{ route('admin.donhang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
 <a href="{{ route('admin.donhang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a>
 <a href="{{ route('admin.donhang.xoa', ['id' => $value->id]) }}"><i class="fa-light fa-trash-alt text-danger"></i></a>
 <form action="{{ route('admin.donhang.sua', ['id' => $donhang->id]) }}" method="post">



Bước 2: Chỉnh sửa app/Http/Controllers/Auth/LoginController.php
Bổ sung hàm redirectTo. Hàm này quy định: “Khi nhấn vào link Đăng nhập/Đăng ký, nếu người dùng đã đăng nhập thành công trước đó thì chuyển tới trang
nào?”.
 <?php

 namespace App\Http\Controllers\Auth;

 use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
      * Where to redirect users after login.
      *
      * @var string
      */
    protected function redirectTo()
    {
         if (Auth::user()->role == 'admin')
              return route('admin.home');
         else if (Auth::user()->role == 'user')
              return route('user.home');
         else
              return route('frontend.home');
    }

    /**
      * Create a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
         $this->middleware('guest')->except('logout');
         $this->middleware('auth')->only('logout');
    }
}
Bước 3: Thay thế trang đăng nhập mặc định từ /login thành user/dang-nhap
Bổ sung code vào bootstrap/app.php
 <?php

 use Illuminate\Http\Request;
 use Illuminate\Foundation\Application;
 use Illuminate\Foundation\Configuration\Exceptions;
 use Illuminate\Foundation\Configuration\Middleware;

 return Application::configure(basePath: dirname(__DIR__))
     ->withRouting(
         web: __DIR__.'/../routes/web.php',
         commands: __DIR__.'/../routes/console.php',
         health: '/up',
     )
     ->withMiddleware(function(Middleware $middleware): void {
         $middleware->redirectGuestsTo(fn(Request $request) => route('user.dangnhap'));
     })
     ->withExceptions(function(Exceptions $exceptions): void {
         //
     })->create();



Bước 4: Áp dụng giao diện bán hàng cho Front-end
Có rất nhiều themes thương mại điện tử (ecommerce, shopping, store,…) trên mạng, các bạn có thể tải chúng về và áp dụng vào trang web của mình.
Ví dụ này sẽ sử dụng một theme như vậy, sau đây là thông tin về theme:
- Tên: Cartzilla – Multipurpose eCommerce Template
- Tác giả: Coderthemes
- Liên kết: https://coderthemes.com/cartzilla


 Giải nén và copy theme vào đúng vị trí
Giải nén thư mục cartzilla cho sẵn.
Sao chép thư mục assets bên trong thư mục edited vào thư mục larashop/public.


 Tạo view master cho Front-end
Xác định được cái gì chung thì đưa vào master (header, footer,…).
Nếu master có nội dung dài quá thì chia nhỏ ra rồi dùng chức năng @include để nhúng vào.
Xem thêm: https://laravel.com/docs/master/blade#including-subviews


Sao chép toàn bộ tập tin cartzilla/laravel/_layouts.html và dán vào frontend.blade.php trong thư mục views/layouts.
Sau đó chỉnh lại đường dẫn các tập tin CSS, Javascript và hình ảnh mẫu.
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-pwa="true">
 <head>
     <meta charset="utf-8" />

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Title -->
    <title>@yield('title', 'Trang chủ') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon / App icons -->
    <link rel="icon" type="image/png" href="{{ asset('public/assets/img/app-icons/icon-32x32.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('public/assets/img/app-icons/icon-180x180.png') }}" />

    <!-- Theme switcher (color modes) -->
    <script src="{{ asset('public/assets/js/theme-switcher.js') }}"></script>

    <!-- Preloaded local web font (Inter) -->
    <link rel="preload" href="{{ asset('public/assets/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin />

    <!-- Font icons -->
    <link rel="preload" href="{{ asset('public/assets/icons/cartzilla-icons.woff2') }}" as="font" type="font/woff2" crossorigin />
    <link rel="stylesheet" href="{{ asset('public/assets/icons/cartzilla-icons.min.css') }}" />

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/simplebar/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.css') }}" />

     <!-- Bootstrap + Theme styles -->
     <link rel="preload" href="{{ asset('public/assets/css/theme.min.css') }}" as="style" />
     <link rel="stylesheet" href="{{ asset('public/assets/css/theme.min.css') }}" id="theme-styles" />
     @yield('css')
 </head>

 <body>
     <!-- Search offcanvas -->
     <div class="offcanvas offcanvas-top" id="searchBox" data-bs-backdrop="static" tabindex="-1">
         <div class="offcanvas-header border-bottom p-0 py-lg-1">
             <form class="container d-flex align-items-center">
                 <input type="search" class="form-control form-control-lg fs-lg border-0 rounded-0 py-3 ps-0" placeholder="Bạn muốn tìm gì?" data-autofocus="offcanvas" />
                 <button type="reset" class="btn-close fs-lg" data-bs-dismiss="offcanvas"></button>
             </form>
    </div>
    <div class="offcanvas-body px-0">
        <div class="container text-center">
            <img src="{{ asset('public/assets/img/icons/search.svg') }}" class="text-body-tertiary opacity-60 mb-4" alt="Search" />
            <h6 class="mb-2">Kết quả tìm kiếm của bạn sẽ xuất hiện ở đây</h6>
            <p class="fs-sm mb-0">Bắt đầu nhập vào trường tìm kiếm ở trên để xem kết quả tìm kiếm ngay lập tức.</p>
        </div>
    </div>
</div>

<!-- Shopping cart offcanvas -->
<div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="shoppingCart" tabindex="-1" style="width:500px">
    <!-- Header -->
    <div class="offcanvas-header flex-column align-items-start py-3 pt-lg-4">
        <div class="d-flex align-items-center justify-content-between w-100">
            <h4 class="offcanvas-title" id="shoppingCartLabel">Giỏ hàng (1)</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
    </div>

    <!-- Items -->
    <div class="offcanvas-body d-flex flex-column gap-4 pt-2">
        <!-- Item -->
        <div class="d-flex align-items-center">
            <a class="flex-sm-shrink-0" href="#" style="width:142px">
                <div class="ratio bg-body-tertiary rounded overflow-hidden" style="--cz-aspect-ratio:calc(110 / 142 * 100%)">
                    <img src="{{ asset('public/assets/img/shop/10.png') }}" alt="Thumbnail" />
                </div>
            </a>
            <div class="w-100 min-w-0 ps-3">
                <h5 class="d-flex animate-underline mb-2">
                    <a class="d-block fs-sm fw-medium text-truncate animate-target" href="#">Apple iPhone 14 128GB White</a>
                </h5>
                <div class="d-flex align-items-center justify-content-between gap-1">
                    <div class="h6 mt-1 mb-0">$27</div>
                    <button type="button" class="btn btn-icon btn-sm flex-shrink-0 fs-sm" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-sm" data-bs-title="Xóa khỏi giỏ">
                        <i class="ci-trash fs-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="offcanvas-header flex-column align-items-start">
        <div class="d-flex align-items-center justify-content-between w-100 mb-3 mb-md-4">
            <span class="text-light-emphasis">Tổng tiền:</span>
            <span class="h6 mb-0">$47</span>
        </div>
        <a class="btn btn-lg btn-dark w-100 rounded-pill" href="{{ route('frontend.giohang') }}">Giỏ hàng</a>
    </div>
</div>

<!-- Navigation bar (Page header) -->
<header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element>
    <div class="container flex-nowrap">
            <!-- Mobile toggler -->
            <button type="button" class="navbar-toggler me-4 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar brand (Logo) -->
            <a class="navbar-brand py-1 py-md-2 py-xl-1" href="{{ route('frontend.home') }}">
                <span class="d-none d-sm-flex flex-shrink-0 text-primary me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"><path d="M36 18.01c0 8.097-5.355 14.949-12.705 17.2a18.12 18.12 0 0 1-
5.315.79C9.622 36 2.608 30.313.573 22.611.257 21.407.059 20.162 0 18.879v-1.758c.02-.395.059-.79.099-1.185.099-.908.277-1.817.514-2.686C2.687 5.628 9.682 0
18 0c5.572 0 10.551 2.528 13.871 6.517 1.502 1.797 2.648 3.91 3.359 6.201.494 1.659.771 3.436.771 5.292z" fill="currentColor" /><g fill="#fff"><path
d="M17.466 21.624c-.514 0-.988-.316-1.146-.829-.198-.632.138-1.303.771-1.501l7.666-2.469-1.205-8.254-13.317 4.621a1.19 1.19 0 0 1-1.521-.75 1.19 1.19 0 0 1
.751-1.521l13.89-4.818c.553-.197 1.166-.138 1.64.158a1.82 1.82 0 0 1 .85 1.284l1.344 9.183c.138.987-.494 1.994-1.482 2.33l-7.864 2.528-.375.04zm7.31.138c-
.178-.632-.85-1.007-1.482-.81l-5.177 1.58c-2.331.79-3.28.02-3.418-.099l-6.56-8.412a4.25 4.25 0 0 0-4.406-1.758l-3.122.987c-.237.889-.415 1.777-.514
2.686l4.228-1.363a1.84 1.84 0 0 1 1.857.81l6.659 8.551c.751.948 2.015 1.323 3.359 1.323.909 0 1.857-.178 2.687-.474l5.078-1.54c.632-.178 1.008-.829.81-
1.481z" /><use href="#czlogo" /><use href="#czlogo" x="8.516" y="-2.172" /></g><defs><path id="czlogo" d="M18.689 28.654a1.94 1.94 0 0 1-1.936 1.935 1.94
1.94 0 0 1-1.936-1.935 1.94 1.94 0 0 1 1.936-1.935 1.94 1.94 0 0 1 1.936 1.935z" /></defs></svg>
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Main navigation -->
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">{{ config('app.name', 'Laravel') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body pt-3 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                            <a class="nav-link" href="{{ route('frontend.home') }}"><i class="ci-home me-2"></i>Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown py-lg-2 me-lg-n1 me-xl-0">
                           <a class="nav-link dropdown-toggle" href="{{ route('frontend.sanpham') }}" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" data-bs-auto-close="outside"><i class="ci-gift me-2"></i>Sản phẩm</a>
                           <ul class="dropdown-menu" style="--cz-dropdown-spacer:.875rem">
                                  <li><a class="dropdown-item" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'dien-thoai']) }}">Điện thoại</a></li>
                                  <li><a class="dropdown-item" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-bang']) }}">Máy tính bảng</a></li>
                                  <li><a class="dropdown-item" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-xach-tay']) }}">Máy tính xách tay</a></li>
                            </ul>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                            <a class="nav-link" href="{{ route('frontend.baiviet') }}"><i class="ci-globe me-2"></i>Tin tức</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                            <a class="nav-link" href="{{ route('frontend.tuyendung') }}"><i class="ci-target me-2"></i>Tuyển dụng</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                            <a class="nav-link" href="{{ route('frontend.lienhe') }}"><i class="ci-chat me-2"></i>Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-header nav border-top px-0 py-3 mt-3 d-md-none">
                    <a class="nav-link justify-content-center w-100" href="{{ route('user.home') }}">
                        <i class="ci-user fs-lg opacity-60 ms-n2 me-2"></i>
                        Tài khoản
                    </a>
                </div>
        </nav>

        <!-- Button group -->
        <div class="d-flex align-items-center">
            <!-- Theme switcher (light/dark/auto) -->
            <div class="dropdown">
                  <button type="button" class="theme-switcher btn btn-icon btn-lg btn-outline-secondary fs-lg border-0 rounded-circle animate-scale" data-bs-toggle="dropdown">
                    <span class="theme-icon-active d-flex animate-target">
                        <i class="ci-sun"></i>
                    </span>
                </button>
                <ul class="dropdown-menu" style="--cz-dropdown-min-width:9rem">
                    <li>
                        <button type="button" class="dropdown-item active" data-bs-theme-value="light">
                            <span class="theme-icon d-flex fs-base me-2"><i class="ci-sun"></i></span>
                            <span class="theme-label">Sáng</span>
                            <i class="item-active-indicator ci-check ms-auto"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-bs-theme-value="dark">
                            <span class="theme-icon d-flex fs-base me-2"><i class="ci-moon"></i></span>
                            <span class="theme-label">Tối</span>
                            <i class="item-active-indicator ci-check ms-auto"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-bs-theme-value="auto">
                            <span class="theme-icon d-flex fs-base me-2"><i class="ci-auto"></i></span>
                            <span class="theme-label">Tự động</span>
                            <i class="item-active-indicator ci-check ms-auto"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Search toggle button -->
            <button type="button" class="btn btn-icon btn-lg fs-xl btn-outline-secondary border-0 rounded-circle animate-shake" data-bs-toggle="offcanvas" data-bs-target="#searchBox">
                <i class="ci-search animate-target"></i>
            </button>

            <!-- Account button visible on screens > 768px wide (md breakpoint) -->
            <a class="btn btn-icon btn-lg fs-lg btn-outline-secondary border-0 rounded-circle animate-shake d-none d-md-inline-flex" href="{{ route('user.home') }}">
                <i class="ci-user animate-target"></i>
                <span class="visually-hidden">Tài khoản</span>
            </a>

            <!-- Cart button -->
            <button type="button" class="btn btn-icon btn-lg fs-xl btn-outline-secondary position-relative border-0 rounded-circle animate-scale" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                  <span class="position-absolute top-0 start-100 badge fs-xs text-bg-primary rounded-pill mt-1 ms-n4 z-2" style="--cz-badge-padding-y:.25em; --cz-badge-padding-x:.42em">1</span>
                <i class="ci-shopping-bag animate-target me-1"></i>
            </button>
        </div>
    </div>
</header>

<!-- Page content -->
@yield('content')

<!-- Page footer -->
<footer class="footer pb-4">
    <div class="container pt-sm-2 pt-md-3 pt-lg-4">
        <div class="d-lg-flex align-items-center border-top pt-4 mt-3">
            <div class="d-flex gap-2 gap-sm-3 justify-content-center ms-lg-auto mb-3 mb-md-4 mb-lg-0 order-lg-2">
                <div>
                    <img src="{{ asset('public/assets/img/payment-methods/visa-light-mode.svg') }}" class="d-none-dark" alt="Visa" />
                    <img src="{{ asset('public/assets/img/payment-methods/visa-dark-mode.svg') }}" class="d-none d-block-dark" alt="Visa" />
                </div>
                <div>
                    <img src="{{ asset('public/assets/img/payment-methods/paypal-light-mode.svg') }}" class="d-none-dark" alt="PayPal" />
                    <img src="{{ asset('public/assets/img/payment-methods/paypal-dark-mode.svg') }}" class="d-none d-block-dark" alt="PayPal" />
                </div>
                <div>
                    <img src="{{ asset('public/assets/img/payment-methods/mastercard.svg') }}" alt="Mastercard" />
                </div>
                <div>
                    <img src="{{ asset('public/assets/img/payment-methods/google-pay-light-mode.svg') }}" class="d-none-dark" alt="Google Pay" />
                    <img src="{{ asset('public/assets/img/payment-methods/google-pay-dark-mode.svg') }}" class="d-none d-block-dark" alt="Google Pay" />
                </div>
                <div>
                    <img src="{{ asset('public/assets/img/payment-methods/apple-pay-light-mode.svg') }}" class="d-none-dark" alt="Apple Pay" />
                    <img src="{{ asset('public/assets/img/payment-methods/apple-pay-dark-mode.svg') }}" class="d-none d-block-dark" alt="Apple Pay" />
                </div>
            </div>
            <div class="d-md-flex justify-content-center order-lg-1">
                <ul class="nav justify-content-center gap-4 order-md-3 mb-4 mb-md-0">
                    <li class="animate-underline">
                        <a class="nav-link fs-xs fw-normal p-0 animate-target" href="#">Chính sách</a>
                    </li>
                    <li class="animate-underline">
                        <a class="nav-link fs-xs fw-normal p-0 animate-target" href="#">Điều khoản sử dụng</a>
                    </li>
                    <li class="animate-underline">
                        <a class="nav-link fs-xs fw-normal p-0 animate-target" href="#">Hợp tác quảng cáo</a>
                    </li>
                </ul>
                <div class="vr text-body-secondary opacity-25 mx-4 d-none d-md-inline-block order-md-2"></div>
                <p class="fs-xs text-center text-lg-start mb-0 order-md-1">
                    Bản quyền &copy; bởi <span class="animate-underline"><a class="animate-target text-dark-emphasis text-decoration-none" href="#" target="_blank">{{ config('app.name', 'Laravel') }}</a></span>.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top button -->
<div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
    <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
        Top
        <i class="ci-arrow-right fs-base ms-1 me-n1 animate-target"></i>
        <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
        <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
            </svg>
        </a>
    </div>

    @yield('floating-button')

    <!-- Vendor scripts -->
    <script src="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/cleave.js/cleave.min.js') }}"></script>
    @yield('javascript')

     <!-- Bootstrap + Theme scripts -->
     <script src="{{ asset('public/assets/js/theme.min.js') }}"></script>
 </body>
 </html>



 Sao chép nội dung của cartzilla/laravel/home.html vào tập tin home.blade.php trong thư mục views\frontend.
 @extends('layouts.frontend')

 @section('title', 'Trang chủ')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper">
         <!-- Hero slider -->
         <section class="container pt-3 mb-4">
             <div class="row">
                 <div class="col-12">
                     <div class="position-relative">
                         <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark rtl-flip" style="background:linear-gradient(90deg, #accbee 0%, #e7f0fd 100%)"></span>
                         <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark rtl-flip" style="background:linear-gradient(90deg, #1b273a 0%, #1f2632 100%)"></span>
                         <div class="row justify-content-center position-relative z-2">
                             <div class="col-xl-5 col-xxl-4 offset-xxl-1 d-flex align-items-center mt-xl-n3">
                                 <!-- Text content master slider -->
                                   <div class="swiper px-5 pe-xl-0 ps-xxl-0 me-xl-n5" data-swiper='{"spaceBetween": 64, "loop": true, "speed": 400, "controlSlider": "#sliderImages", "autoplay": {"delay": 5500, "disableOnInteraction": false}, "scrollbar": {"el": ".swiper-scrollbar"}}'>

                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                                    <p class="text-body">Cảm nhận âm thanh thực sự</p>
                                                    <h2 class="display-4 pb-2 pb-xl-4">Headphones ProMax</h2>
                                                    <a class="btn btn-lg btn-primary" href="#">
                                                        Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                                    </a>
                                                </div>
                                                <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                                    <p class="text-body">Ưu đãi trong tuần</p>
                                                    <h2 class="display-4 pb-2 pb-xl-4">Powerful iPad Pro M2</h2>
                                                    <a class="btn btn-lg btn-primary" href="#">
                                                        Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                                    </a>
                                                </div>
                                                <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                   <p class="text-body">Kính thực tế ảo</p>
                                   <h2 class="display-4 pb-2 pb-xl-4">Experience New Reality</h2>
                                   <a class="btn btn-lg btn-primary" href="#">
                                       Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-7">
                       <!-- Binded images (controlled slider) -->
                       <div class="swiper user-select-none" id="sliderImages" data-swiper='{"allowTouchMove": false, "loop": true, "effect": "fade", "fadeEffect": {"crossFade": true}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/01.png') }}" alt="Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/02.png') }}" alt="Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/03.png') }}" alt="Image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Scrollbar -->
                <div class="row justify-content-center" data-bs-theme="dark">
                    <div class="col-xxl-10">
                        <div class="position-relative mx-5 mx-xxl-0"><div class="swiper-scrollbar mb-4"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands -->
<section class="container mb-2">
    <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false">
        <div class="row row-cols-6 g-0" style="min-width:960px">
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/apple-light-mode.svg') }}" class="d-none-dark" alt="Apple" />
                    <img src="{{ asset('public/assets/img/brands/apple-dark-mode.svg') }}" class="d-none d-block-dark" alt="Apple" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/motorola-light-mode.svg') }}" class="d-none-dark" alt="Motorola" />
                    <img src="{{ asset('public/assets/img/brands/motorola-dark-mode.svg') }}" class="d-none d-block-dark" alt="Motorola" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/xiaomi-light-mode.svg') }}" class="d-none-dark" alt="Xiaomi" />
                    <img src="{{ asset('public/assets/img/brands/xiaomi-dark-mode.svg') }}" class="d-none d-block-dark" alt="Xiaomi" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/canon-light-mode.svg') }}" class="d-none-dark" alt="Canon" />
                    <img src="{{ asset('public/assets/img/brands/canon-dark-mode.svg') }}" class="d-none d-block-dark" alt="Canon" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/samsung-light-mode.svg') }}" class="d-none-dark" alt="Samsung" />
                    <img src="{{ asset('public/assets/img/brands/samsung-dark-mode.svg') }}" class="d-none d-block-dark" alt="Samsung" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/sony-light-mode.svg') }}" class="d-none-dark" alt="Sony" />
                    <img src="{{ asset('public/assets/img/brands/sony-dark-mode.svg') }}" class="d-none d-block-dark" alt="Sony" />
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Products (Grid) -->
<section class="container pt-2 mt-2 mb-3">
    <!-- Heading -->
    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
        <h2 class="h3 mb-0">Điện thoại</h2>
        <div class="nav ms-3">
            <a class="nav-link animate-underline px-0 py-2" href="#">
                <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
            </a>
        </div>
    </div>

    <!-- Product grid -->
    <!-- Phần này code quá dài nên đã cắt bớt -->
    <!-- Giữ nguyên code phần này, chỉ cập nhật lại đường dẫn các tập tin hình ảnh -->
    <img src="{{ asset('public/assets/img/shop/02.png') }}" />
</section>

<!-- Products (Grid) -->
<section class="container pt-2 mt-2 mb-3">
    <!-- Heading -->
    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
        <h2 class="h3 mb-0">Máy tính bảng</h2>
        <div class="nav ms-3">
            <a class="nav-link animate-underline px-0 py-2" href="#">
                         <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
                     </a>
                 </div>
             </div>

             <!-- Product grid -->
             <!-- Phần này code quá dài nên đã cắt bớt -->
             <!-- Giữ nguyên code phần này, chỉ cập nhật lại đường dẫn các tập tin hình ảnh -->
             <img src="{{ asset('public/assets/img/shop/05.png') }}" />
         </section>
     </main>
 @endsection



Kết quả khi chạy trên trình duyệt:
Bước 5: Tạo mới, bổ sung và cập nhập code cho các trang con
 Lần lượt thiết kế các view con cho tất cả các tập tin còn lại trong thư mục views/frontend:
home.blade.php sử dụng cartzilla/laravel/home.html (Đã thực hiện ở phía trên).
baiviet.blade.php sử dụng cartzilla/laravel/blog-grid.html.
baiviet_chitiet.blade.php - tuyendung.blade.php sử dụng cartzilla/laravel/blog-single.html.
lienhe.blade.php sử dụng cartzilla/laravel/contact.html.
giohang.blade.php sử dụng cartzilla/laravel/checkout-cart.html.
giohangrong.blade.php sử dụng cartzilla/laravel/checkout-cart-empty.html.
sanpham.blade.php sử dụng cartzilla/laravel/shop-categories.html.
sanpham_chitiet.blade.php sử dụng cartzilla/laravel/shop-product-details.html.


 Lần lượt thiết kế các view con cho tất cả các tập tin còn lại trong thư mục views/user:
home.blade.php sử dụng cartzilla/laravel/account-info.html.
dathang.blade.php sử dụng cartzilla/laravel/checkout-payment.html.
dathangthanhcong.blade.php sử dụng cartzilla/laravel/checkout-thankyou.html.
donhang.blade.php sử dụng cartzilla/laravel/account-orders.html.
dangky.blade.php - cartzilla/laravel/signup.html.
dangnhap.blade.php sử dụng cartzilla/laravel/signin.html.


 Sử dụng cartzilla/laravel/signin.html vào tập tin dangnhap.blade.php trong thư mục views\user.
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-pwa="true">
 <head>
     <meta charset="utf-8" />

     <!-- Viewport -->
     <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}" />

     <!-- Title -->
     <title>Đăng nhập | {{ config('app.name', 'Laravel') }}</title>

     <!-- Favicon / App icons -->
   <link rel="icon" type="image/png" href="{{ asset('public/assets/img/app-icons/icon-32x32.png') }}" sizes="32x32" />
   <link rel="apple-touch-icon" href="{{ asset('public/assets/img/app-icons/icon-180x180.png') }}" />

   <!-- Theme switcher (color modes) -->
   <script src="{{ asset('public/assets/js/theme-switcher.js') }}"></script>

   <!-- Preloaded local web font (Inter) -->
   <link rel="preload" href="{{ asset('public/assets/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin />

   <!-- Font icons -->
   <link rel="preload" href="{{ asset('public/assets/icons/cartzilla-icons.woff2') }}" as="font" type="font/woff2" crossorigin />
   <link rel="stylesheet" href="{{ asset('public/assets/icons/cartzilla-icons.min.css') }}" />

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('public/assets/css/theme.min.css') }}" as="style" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/theme.min.css') }}" id="theme-styles" />
</head>

<!-- Body -->
<body>
    <!-- Page content -->
    <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width:1920px">
        <div class="d-lg-flex">
            <!-- Login form + Footer -->
            <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width:416px">
                <!-- Logo -->
                <header class="navbar px-0 pb-4 mt-n2 mt-sm-0 mb-2 mb-md-3 mb-lg-4">
                    <a href="{{ route('frontend.home') }}" class="navbar-brand pt-0">
                        <span class="d-flex flex-shrink-0 text-primary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"><path d="M36 18.01c0 8.097-5.355 14.949-12.705 17.2a18.12 18.12
0 0 1-5.315.79C9.622 36 2.608 30.313.573 22.611.257 21.407.059 20.162 0 18.879v-1.758c.02-.395.059-.79.099-1.185.099-.908.277-1.817.514-2.686C2.687 5.628
9.682 0 18 0c5.572 0 10.551 2.528 13.871 6.517 1.502 1.797 2.648 3.91 3.359 6.201.494 1.659.771 3.436.771 5.292z" fill="currentColor" /><g
fill="#fff"><path d="M17.466 21.624c-.514 0-.988-.316-1.146-.829-.198-.632.138-1.303.771-1.501l7.666-2.469-1.205-8.254-13.317 4.621a1.19 1.19 0 0 1-1.521-
.75 1.19 1.19 0 0 1 .751-1.521l13.89-4.818c.553-.197 1.166-.138 1.64.158a1.82 1.82 0 0 1 .85 1.284l1.344 9.183c.138.987-.494 1.994-1.482 2.33l-7.864 2.528-
.375.04zm7.31.138c-.178-.632-.85-1.007-1.482-.81l-5.177 1.58c-2.331.79-3.28.02-3.418-.099l-6.56-8.412a4.25 4.25 0 0 0-4.406-1.758l-3.122.987c-.237.889-.415
1.777-.514 2.686l4.228-1.363a1.84 1.84 0 0 1 1.857.81l6.659 8.551c.751.948 2.015 1.323 3.359 1.323.909 0 1.857-.178 2.687-.474l5.078-1.54c.632-.178 1.008-
.829.81-1.481z" /><use href="#czlogo" /><use href="#czlogo" x="8.516" y="-2.172" /></g><defs><path id="czlogo" d="M18.689 28.654a1.94 1.94 0 0 1-1.936
1.935 1.94 1.94 0 0 1-1.936-1.935 1.94 1.94 0 0 1 1.936-1.935 1.94 1.94 0 0 1 1.936 1.935z" /></defs></svg>
                        </span>
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </header>

                <h1 class="h2 mt-auto">Đăng nhập</h1>
                <div class="nav fs-sm mb-4">
                    Bạn chưa có tài khoản?
                    <a class="nav-link text-decoration-underline p-0 ms-2" href="{{ route('user.dangky') }}">Tạo một tài khoản</a>
                </div>

                <!-- Form -->
                <form method="post" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="position-relative mb-4">
                       <input type="text" class="form-control form-control-lg {{ ($errors->has('email') || $errors->has('username')) ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Email, Tên đăng nhập hoặc Điện thoại" required />
                        <div class="invalid-tooltip bg-transparent py-0">Tên đăng nhập không đúng!</div>
                    </div>
       <div class="mb-4">
           <div class="password-toggle">
                 <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" autocomplete="current-password" placeholder="Mật khẩu" required />
               <div class="invalid-tooltip bg-transparent py-0">Mật khẩu không đúng!</div>
               <label class="password-toggle-button fs-lg">
                   <input type="checkbox" class="btn-check" />
               </label>
           </div>
       </div>
       <div class="d-flex align-items-center justify-content-between mb-4">
           <div class="form-check me-2">
               <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
               <label for="remember" class="form-check-label">Ghi nhớ đăng nhập</label>
           </div>
           @if (Route::has('password.request'))
               <div class="nav">
                   <a class="nav-link animate-underline p-0" href="{{ route('password.request') }}">
                       <span class="animate-target">Quên mật khẩu?</span>
                   </a>
               </div>
           @endif
       </div>
       <button type="submit" class="btn btn-lg btn-primary w-100">Đăng nhập</button>
   </form>

   <!-- Divider -->
   <div class="d-flex align-items-center my-4">
       <hr class="w-100 m-0">
       <span class="text-body-emphasis fw-medium text-nowrap mx-4">hoặc đăng nhập với</span>
       <hr class="w-100 m-0">
   </div>

   <!-- Social login -->
   <div class="d-flex flex-column flex-sm-row gap-3 pb-4 mb-3 mb-lg-4">
       <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
           <i class="ci-google ms-1 me-1"></i> Google
       </a>
       <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
           <i class="ci-facebook ms-1 me-1"></i> Facebook
       </a>
       <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
           <i class="ci-apple ms-1 me-1"></i> Apple
       </a>
   </div>

   <!-- Footer -->
   <footer class="mt-auto">
       <p class="fs-xs mb-0">
           Bản quyền &copy; bởi <span class="animate-underline"><a class="animate-target text-dark-emphasis text-decoration-none" href="#" target="_blank">{{ config('app.name', 'Laravel') }}</a></span>.
        </p>
    </footer>
</div>

<!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
<div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width:1034px">
    <div class="d-flex flex-column justify-content-end h-100 rounded-5 overflow-hidden">
       <span class="position-absolute top-0 start-0 w-100 h-100 d-none-dark" style="background:linear-gradient(-90deg, #accbee 0%, #e7f0fd 100%)"></span>
                    <span class="position-absolute top-0 start-0 w-100 h-100 d-none d-block-dark" style="background:linear-gradient(-90deg, #1b273a 0%, #1f2632 100%)"></span>
                    <div class="ratio position-relative z-2" style="--cz-aspect-ratio:calc(1030 / 1032 * 100%)">
                        <img src="{{ asset('public/assets/img/cover/cover.png') }}" alt="Girl" />
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Customizer toggle -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4"></div>

     <!-- Bootstrap + Theme scripts -->
     <script src="{{ asset('public/assets/js/theme.min.js') }}"></script>
 </body>
 </html>



 Đăng nhập đồng thời bằng Email và Tên đăng nhập/Điện thoại
Mặc định, Laravel chỉ cho phép đăng nhập bằng email. Người dùng phải tự thiết lập bổ sung các tùy chọn đăng nhập. Ví dụ: Đăng nhập bằng tên đăng
nhập, bằng số điện thoại, bằng căn cước công dân…
Chỉnh sửa code trong tập tin app/Http/Controllers/Auth/LoginController.php
 <?php

 namespace App\Http\Controllers\Auth;

 use App\Http\Controllers\Controller;
 use Illuminate\Foundation\Auth\AuthenticatesUsers;
 use Illuminate\Support\Facades\Auth;

 class LoginController extends Controller
 {
     /*
     |--------------------------------------------------------------------------
     | Login Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles authenticating users for the application and
     | redirecting them to your home screen. The controller uses a trait
     | to conveniently provide its functionality to your applications.
     |
     */
     use AuthenticatesUsers;

     /**
      * Where to redirect users after login.
      *
      * @var string
       */
     protected function redirectTo()
     {
          if (Auth::user()->role == 'admin')
              return route('admin.home');
          else if (Auth::user()->role == 'user')
              return route('user.home');
          else
              return route('frontend.home');
     }

     /**
       * Create a new controller instance.
       *
       * @return void
       */
     public function __construct()
     {
          $this->middleware('guest')->except('logout');
          $this->middleware('auth')->only('logout');
     }

     /**
       * Get the login username to be used by the controller.
       *
       * @return string
       */
     public function username()
     {
          $identity = request()->get('email');
          if(is_numeric($identity))
              $fieldName = 'phone';
          elseif(filter_var($identity, FILTER_VALIDATE_EMAIL))
              $fieldName = 'email';
          else
              $fieldName = 'username';
          request()->merge([$fieldName => $identity]);
          return $fieldName;
     }
 }
Lưu ý: Để đăng nhập bằng điện thoại, trong bảng users phải có cột phone.


 Sử dụng cartzilla/laravel/signup.html vào tập tin dangky.blade.php trong thư mục views\user.
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-pwa="true">
 <head>
     <meta charset="utf-8" />
   <!-- Viewport -->
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <!-- Title -->
   <title>Đăng ký tài khoản | {{ config('app.name', 'Laravel') }}</title>

   <!-- Favicon / App icons -->
   <link rel="icon" type="image/png" href="{{ asset('public/assets/img/app-icons/icon-32x32.png') }}" sizes="32x32" />
   <link rel="apple-touch-icon" href="{{ asset('public/assets/img/app-icons/icon-180x180.png') }}" />

   <!-- Theme switcher (color modes) -->
   <script src="{{ asset('public/assets/js/theme-switcher.js') }}"></script>

   <!-- Preloaded local web font (Inter) -->
   <link rel="preload" href="{{ asset('public/assets/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin />

   <!-- Font icons -->
   <link rel="preload" href="{{ asset('public/assets/icons/cartzilla-icons.woff2') }}" as="font" type="font/woff2" crossorigin />
   <link rel="stylesheet" href="{{ asset('public/assets/icons/cartzilla-icons.min.css') }}" />

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('public/assets/css/theme.min.css') }}" as="style" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/theme.min.css') }}" id="theme-styles" />
</head>

<!-- Body -->
<body>
    <!-- Page content -->
    <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width:1920px">
        <div class="d-lg-flex">
            <!-- Login form + Footer -->
            <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width:416px">
                <!-- Logo -->
                <header class="navbar px-0 pb-4 mt-n2 mt-sm-0 mb-2 mb-md-3 mb-lg-4">
                    <a href="{{ route('frontend.home') }}" class="navbar-brand pt-0">
                        <span class="d-flex flex-shrink-0 text-primary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"><path d="M36 18.01c0 8.097-5.355 14.949-12.705 17.2a18.12 18.12
0 0 1-5.315.79C9.622 36 2.608 30.313.573 22.611.257 21.407.059 20.162 0 18.879v-1.758c.02-.395.059-.79.099-1.185.099-.908.277-1.817.514-2.686C2.687 5.628
9.682 0 18 0c5.572 0 10.551 2.528 13.871 6.517 1.502 1.797 2.648 3.91 3.359 6.201.494 1.659.771 3.436.771 5.292z" fill="currentColor" /><g
fill="#fff"><path d="M17.466 21.624c-.514 0-.988-.316-1.146-.829-.198-.632.138-1.303.771-1.501l7.666-2.469-1.205-8.254-13.317 4.621a1.19 1.19 0 0 1-1.521-
.75 1.19 1.19 0 0 1 .751-1.521l13.89-4.818c.553-.197 1.166-.138 1.64.158a1.82 1.82 0 0 1 .85 1.284l1.344 9.183c.138.987-.494 1.994-1.482 2.33l-7.864 2.528-
.375.04zm7.31.138c-.178-.632-.85-1.007-1.482-.81l-5.177 1.58c-2.331.79-3.28.02-3.418-.099l-6.56-8.412a4.25 4.25 0 0 0-4.406-1.758l-3.122.987c-.237.889-.415
1.777-.514 2.686l4.228-1.363a1.84 1.84 0 0 1 1.857.81l6.659 8.551c.751.948 2.015 1.323 3.359 1.323.909 0 1.857-.178 2.687-.474l5.078-1.54c.632-.178 1.008-
.829.81-1.481z" /><use href="#czlogo" /><use href="#czlogo" x="8.516" y="-2.172" /></g><defs><path id="czlogo" d="M18.689 28.654a1.94 1.94 0 0 1-1.936
1.935 1.94 1.94 0 0 1-1.936-1.935 1.94 1.94 0 0 1 1.936-1.935 1.94 1.94 0 0 1 1.936 1.935z" /></defs></svg>
                        </span>
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </header>

                <h1 class="h2 mt-auto">Đăng ký tài khoản</h1>
                <div class="nav fs-sm mb-3 mb-lg-4">
    Tôi đã có tài khoản
    <a class="nav-link text-decoration-underline p-0 ms-2" href="{{ route('user.dangnhap') }}">Đăng nhập</a>
</div>

<!-- Form -->
<form method="post" action="{{ route('register') }}" class="needs-validation" novalidate>
    @csrf
    <div class="position-relative mb-4">
        <label for="register-email" class="form-label">Họ và tên</label>
       <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
       <div class="invalid-tooltip bg-transparent py-0">Họ và tên không được bỏ trống!</div>
   </div>
   <div class="position-relative mb-4">
       <label for="register-email" class="form-label">Địa chỉ email</label>
       <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="off" required />
       <div class="invalid-tooltip bg-transparent py-0">Vui lòng nhập địa chỉ email hợp lệ!</div>
   </div>
   <div class="mb-4">
       <label for="register-password" class="form-label">Mật khẩu</label>
       <div class="password-toggle">
            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" minlength="8" placeholder="Tối thiểu 8 ký tự" required />
           <div class="invalid-tooltip bg-transparent py-0">Mật khẩu không đáp ứng đủ tiêu chí yêu cầu!</div>
           <label class="password-toggle-button fs-lg">
               <input type="checkbox" class="btn-check" />
           </label>
       </div>
   </div>
   <div class="mb-4">
       <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
       <div class="password-toggle">
            <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" autocomplete="new-password" minlength="8" placeholder="Tối thiểu 8 ký tự" required />

           <div class="invalid-tooltip bg-transparent py-0">Xác nhận mật khẩu không đáp ứng đủ tiêu chí yêu cầu!</div>
           <label class="password-toggle-button fs-lg">
               <input type="checkbox" class="btn-check" />
           </label>
       </div>
   </div>
   <div class="d-flex flex-column gap-2 mb-4">
       <div class="form-check">
           <input type="checkbox" class="form-check-input" id="remember" name="remember" />
           <label for="save-pass" class="form-check-label">Lưu mật khẩu</label>
       </div>
       <div class="form-check">
           <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required />
            <label for="privacy" class="form-check-label">Tôi đã đọc và chấp nhận <a class="text-dark-emphasis" href="#">Chính sách bảo mật</a></label>
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-primary w-100">
        Tạo một tài khoản
        <i class="ci-chevron-right fs-lg ms-1 me-n1"></i>
    </button>
</form>

<!-- Divider -->
<div class="d-flex align-items-center my-4">
    <hr class="w-100 m-0">
    <span class="text-body-emphasis fw-medium text-nowrap mx-4">hoặc đăng nhập với</span>
                     <hr class="w-100 m-0">
                 </div>

                 <!-- Social login -->
                 <div class="d-flex flex-column flex-sm-row gap-3 pb-4 mb-3 mb-lg-4">
                     <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
                         <i class="ci-google ms-1 me-1"></i> Google
                     </a>
                     <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
                         <i class="ci-facebook ms-1 me-1"></i> Facebook
                     </a>
                     <a href="#" class="btn btn-lg btn-outline-secondary w-100 px-2">
                         <i class="ci-apple ms-1 me-1"></i> Apple
                     </a>
                 </div>

                 <!-- Footer -->
                 <footer class="mt-auto">
                     <p class="fs-xs mb-0">
                        Bản quyền &copy; bởi <span class="animate-underline"><a class="animate-target text-dark-emphasis text-decoration-none" href="#" target="_blank">{{ config('app.name', 'Laravel') }}</a></span>.
                     </p>
                 </footer>
             </div>

             <!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
             <div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width:1034px">
                 <div class="d-flex flex-column justify-content-end h-100 rounded-5 overflow-hidden">
                    <span class="position-absolute top-0 start-0 w-100 h-100 d-none-dark" style="background:linear-gradient(-90deg, #accbee 0%, #e7f0fd 100%)"></span>
                    <span class="position-absolute top-0 start-0 w-100 h-100 d-none d-block-dark" style="background:linear-gradient(-90deg, #1b273a 0%, #1f2632 100%)"></span>
                    <div class="ratio position-relative z-2" style="--cz-aspect-ratio:calc(1030 / 1032 * 100%)">
                        <img src="{{ asset('public/assets/img/cover/cover.png') }}" alt="Girl" />
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Customizer toggle -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4"></div>

     <!-- Bootstrap + Theme scripts -->
     <script src="{{ asset('public/assets/js/theme.min.js') }}"></script>
 </body>
 </html>



 Chỉnh sửa code trong tập tin app/Http/Controllers/Auth/RegisterController.php
 <?php

 namespace App\Http\Controllers\Auth;

 use App\Http\Controllers\Controller;
 use App\Models\User;
 use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
      * Create a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
         $this->middleware('guest');
    }

    /**
      * Get a validator for an incoming registration request.
      *
      * @param array $data
      * @return \Illuminate\Contracts\Validation\Validator
      */
    protected function validator(array $data)
    {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
         ]);
    }
     /**
       * Create a new user instance after a valid registration.
       *
       * @param array $data
       * @return \App\Models\User
       */
     protected function create(array $data)
     {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'username' => Str::before($data['email'], '@'),
              'password' => Hash::make($data['password']),
          ]);
     }
 }


 Sử dụng cartzilla/laravel/account-info.html vào tập tin home.blade.php trong thư mục views\user.
 @extends('layouts.frontend')

 @section('title', 'Hồ sơ khách hàng')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper">
         <nav class="container pt-3 my-3">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                 <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Khách hàng</a></li>
                 <li class="breadcrumb-item active">Hồ sơ cá nhân</li>
             </ol>
         </nav>

         <div class="container mt-4">
             <div class="row">
                 <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
                 <aside class="col-lg-3">
                     <div class="offcanvas-lg offcanvas-start pe-lg-0 pe-xl-4" id="accountSidebar">
                         <!-- Header -->
                         <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                             <div class="d-flex align-items-center">
                                <div class="h5 d-flex justify-content-center align-items-center flex-shrink-0 text-primary bg-primary-subtle lh-1 rounded-circle mb-0" style="width:3rem; height:3rem">S</div>
                                 <div class="min-w-0 ps-3">
                                     <h5 class="h6 mb-0">{{ $user->name }}</h5>
                                     <div class="nav flex-nowrap text-nowrap min-w-0">
                                         <a class="nav-link animate-underline text-body p-0" href="{{ route('user.home') }}">
                                             <svg class="text-warning flex-shrink-0 me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
 fill="currentColor"><path d="M1.333 9.667H7.5V16h-5c-.64 0-1.167-.527-1.167-1.167V9.667zm13.334 0v5.167c0 .64-.527 1.167-1.167 1.167h-5V9.667h6.167zM0
 5.833V7.5c0 .64.527 1.167 1.167 1.167h.167H7.5v-1-3H1.167C.527 4.667 0 5.193 0 5.833zm14.833-1.166H8.5v3 1h6.167.167C15.473 8.667 16 8.14 16 7.5V5.833c0-
 .64-.527-1.167-1.167-1.167z" /><path d="M8 5.363a.5.5 0 0 1-.495-.573C7.752 3.123 9.054-.03 12.219-.03c1.807.001 2.447.977 2.447 1.813 0 1.486-2.069 3.58-
6.667 3.58zM12.219.971c-2.388 0-3.295 2.27-3.595 3.377 1.884-.088 3.072-.565 3.756-.971.949-.563 1.287-1.193 1.287-1.595 0-.599-.747-.811-1.447-.811z"
/><path d="M8.001 5.363c-4.598 0-6.667-2.094-6.667-3.58 0-.836.641-1.812 2.448-1.812 3.165 0 4.467 3.153 4.713 4.819a.5.5 0 0 1-.495.573zM3.782.971c-.7 0-
1.448.213-1.448.812 0 .851 1.489 2.403 5.042 2.566C7.076 3.241 6.169.971 3.782.971z" /></svg>
                                             <span class="text-body fw-normal text-truncate mt-1">Khách hàng thân thiết</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar"></button>
                        </div>
                        <!-- Body (Navigation) -->
                        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                            <nav class="list-group list-group-borderless">
                                <a class="list-group-item list-group-item-action d-flex align-items-center pe-none active" href="{{ route('user.hoso') }}">
                                    <i class="ci-user fs-base opacity-75 me-2"></i> Hồ sơ cá nhân
                                </a>
                                @if($user->DonHang->count() > 0)
                                    <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('user.donhang') }}">
                                        <i class="ci-shopping-bag fs-base opacity-75 me-2"></i> Đơn hàng của tôi
                                        <span class="badge bg-primary rounded-pill ms-auto">{{ $user->DonHang->count() }}</span>
                                    </a>
                                @else
                                    <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                        <i class="ci-shopping-bag fs-base opacity-75 me-2"></i> Đơn hàng của tôi
                                        <span class="badge bg-primary rounded-pill ms-auto">0</span>
                                    </a>
                                @endif
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-heart fs-base opacity-75 me-2"></i> Sản phẩm yêu thích
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-star fs-base opacity-75 me-2"></i> Đánh giá sản phẩm
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-map-pin fs-base opacity-75 me-2"></i> Sổ địa chỉ
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-credit-card fs-base opacity-75 me-2"></i> Phương thức thanh toán
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-bell fs-base opacity-75 mt-1 me-2"></i> Cài đặt thông báo
                                </a>
                            </nav>
                            <nav class="list-group list-group-borderless pt-3">
                               <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="ci-log-out fs-base opacity-75 me-2"></i> Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Personal info content -->
<div class="col-lg-9">
    <div class="ps-lg-3 ps-xl-0">
        <!-- Page title -->
        <h1 class="h2 mb-1 mb-sm-2">Hồ sơ cá nhân</h1>
        <!-- Basic info -->
        <div class="border-bottom py-4">
            @if(session('warning'))
                <div class="alert d-flex alert-danger" role="alert">
                    <i class="ci-banned fs-lg pe-1 mt-1 me-2"></i>
                    <div>{{ session('warning') }}</div>
                </div>
            @endif
            @if(session('success'))
                <div class="alert d-flex alert-success" role="alert">
                    <i class="ci-check-circle fs-lg pe-1 mt-1 me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
                <h2 class="h6 mb-0">Thông tin cơ bản</h2>
            </div>
            <form action="{{ route('user.hoso') }}" method="post" class="row g-3 g-sm-4 needs-validation" novalidate>
                @csrf
                <div class="col-sm-6">
                    <label for="fn" class="form-label">Họ và tên</label>
                    <div class="position-relative">
                       <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" required />
                       <div class="invalid-feedback">Vui lòng nhập tên đầy đủ của bạn!</div>
                   </div>
               </div>
               <div class="col-sm-6">
                   <label for="ln" class="form-label">Địa chỉ email</label>
                   <div class="position-relative">
                       <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" required />
                       <div class="invalid-feedback">Vui lòng nhập email của bạn!</div>
                   </div>
               </div>
               <div class="col-12">
                   <div class="d-flex gap-3 pt-2 pt-sm-0">
                       <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
                   </div>
               </div>
           </form>
       </div>

       <!-- Password -->
       <div class="border-bottom py-4">
           <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
               <div class="d-flex align-items-center gap-3 me-4">
                   <h2 class="h6 mb-0">Đổi mật khẩu</h2>
               </div>
           </div>
           <form action="{{ route('user.doimatkhau') }}" method="post" class="row g-3 g-sm-4 needs-validation" novalidate>
               @csrf
               <div class="col-sm-6">
                   <label for="current-password" class="form-label">Mật khẩu hiện tại</label>
                                                                   <div class="password-toggle">
                                                                          <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="current-password" name="old_password" placeholder="Nhập mật khẩu hiện tại của bạn" required />
                                                                    <label class="password-toggle-button">
                                                                        <input type="checkbox" class="btn-check" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="new-password" class="form-label">Mật khẩu mới</label>
                                                                <div class="password-toggle">
                                                                          <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new-password" name="new_password" placeholder="Nhập mật khẩu mới" required />
                                                             <label class="password-toggle-button">
                                                                 <input type="checkbox" class="btn-check" />
                                                             </label>
                                                         </div>
                                                     </div>
                                                     <div class="col-12">
                                                         <div class="d-flex gap-3 pt-2 pt-sm-0">
                                                             <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                                         </div>
                                                     </div>
                                                 </form>
                                             </div>

                         <!-- Delete account -->
                         <div class="pt-3 mt-2 mt-sm-3">
                             <h2 class="h6">Xóa tài khoản</h2>
                             <p class="fs-sm">Khi bạn xóa tài khoản, hồ sơ công khai của bạn sẽ bị vô hiệu hóa ngay lập tức. Nếu bạn đổi ý trước khi hết 14 ngày, hãy đăng nhập bằng email và mật khẩu, chúng tôi sẽ gửi cho bạn liên kết để kích hoạt lại tài khoản.</p>
                             <a class="text-danger fs-sm fw-medium" href="#">Xác nhận xóa tài khoản</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </main>
 @endsection

 @section('floating-button')
     <!-- Sidebar navigation offcanvas toggle that is visible on screens < 992px wide (lg breakpoint) -->
        <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" data-bs-theme="light">
         <i class="ci-sidebar fs-base me-2"></i> Quản lý tài khoản
     </button>
 @endsection



 Bổ sung code bên trong KhachHangController.
 <?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function getHome()
   {
       if(Auth::check())
       {
           $user = User::find(Auth::user()->id);
           return view('user.home', compact('user'));
       }
       else
           return redirect()->route('user.dangnhap');
   }

   public function getDatHang()
   {
       // Bổ sung code tại đây
       return view('user.dathang');
   }

   public function postDatHang(Request $request)
   {
       // Bổ sung code tại đây
       return redirect()->route('user.dathangthanhcong');
   }

   public function getDatHangThanhCong()
   {
       return view('user.dathangthanhcong');
   }

   public function getDonHang($id = '')
   {
       // Bổ sung code tại đây
       return view('user.donhang');
   }

   public function postDonHang(Request $request, $id)
   {
       // Bổ sung code tại đây
   }

   public function getHoSo()
    {
        return redirect()->route('user.home');
    }

    public function postHoSo(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->save();

        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    }

    public function postDoiMatKhau(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::findOrFail(Auth::user()->id ?? 0);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('user.home')->with('success', 'Đổi mật khẩu thành công.');
        }
        else
            return redirect()->route('user.home')->with('warning', 'Mật khẩu cũ không chính xác.');
    }

    public function postDangXuat(Request $request)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.home');
    }
}
