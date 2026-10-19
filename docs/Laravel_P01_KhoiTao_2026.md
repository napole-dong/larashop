                                                                                       Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                                      PHẦN 1: KHỞI TẠO DỰ ÁN LARAVEL
Bước 1: Cài WampServer (Wampserver 3.4.0 x64)
Link: https://wampserver.aviatechno.net


Bước 2: Cài đặt Composer (Composer 2.x)
Link: https://getcomposer.org/download
Nhớ chọn đường dẫn đến tập tin php.exe có phiên bản phù hợp với phiên bản Laravel.




Bước 3: Cài đặt Laravel
Chuyển tới thư mục www.
Link: https://laravel.com/docs/master/installation#creating-a-laravel-project
Lệnh cài:
 composer create-project laravel/laravel larashop
Bước 4: Bỏ “public” khỏi đường dẫn
Sao chép tập tin .htaccess và index.php trong thư mục public ra ngoài thư mục chính.
Mở tập tin index.php vừa copy ở thư mục larashop, chỉnh sửa đường dẫn ở dòng 9, 14, 18.
 9     if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
 14    require __DIR__.'/vendor/autoload.php';
 18    $app = require_once __DIR__.'/bootstrap/app.php';


Bình thường, chúng ta sử dụng HTTP Server của Apache để chạy dịch vụ, nếu chúng ta không muốn bỏ “public” khỏi đường dẫn, và muốn sử dụng
HTTP Server tích hợp sẵn của PHP, thì dùng lệnh artisan từ dấu nhắc …\www\larashop>
 php artisan serve
Lúc này một máy chủ sẽ được start ở cổng mặc định là 8000, chúng ta có thể truy cập trang web từ địa chỉ: http://127.0.0.1:8000 (nó tương đương
với http://127.0.0.1/larashop/public). Màn hình CMD phải được bật trong suốt quá trình chạy dịch vụ.


Nếu cổng 8000 bị trùng thì chạy lại lệnh để đổi cổng khác.
 php artisan serve --port=8001
Bước 5: Tạo Model – Controller – Migration bằng lệnh artisan
Chuyển tới thư mục www/larashop.
Các lệnh:
 php artisan make:model LoaiSanPham -mcr
 php artisan make:model HangSanXuat -mcr
 php artisan make:model SanPham -mcr
 php artisan make:model TinhTrang -mcr
 php artisan make:model DonHang -mcr
 php artisan make:model DonHang_ChiTiet -mcr
Ý nghĩa tham số:
  -m     Migration, tạo sẵn các tập tin migrations trong thư mục database/migrations
  -c     Controller, tạo sẵn các tập tin controllers trong thư mục app/Http/Controllers
  -r     Resource, tạo sẵn các hàm rỗng bên trong các tập tin controllers.


Nếu không muốn tạo các hàm rỗng bên trong các tập tin controllers thì bỏ tham số -r đi.
Ví dụ:
 php artisan make:model LoaiSanPham -mc
 php artisan make:model HangSanXuat -mc
 php artisan make:model SanPham -mc
 php artisan make:model TinhTrang -mc
 php artisan make:model DonHang -mc
 php artisan make:model DonHang_ChiTiet -mc
Xem thêm về các tham số: https://laravel.com/docs/master/eloquent#generating-model-classes


Bước 6: Chỉnh sửa các tập tin CSDL Migrations vừa tạo ra từ Bước 5
Mô tả CSDL:
 Bảng: loaisanpham
 STT     Tên trường                           Kiểu dữ liệu                   Kích thước      Ghi chú
 1       id                                   int                                            Khóa chính, Tự động tăng
 2       tenloai                              varchar                        255             Not Null
 3       tenloai_slug                         varchar                        255             Not Null
 Bảng: hangsanxuat
 STT   Tên trường          Kiểu dữ liệu   Kích thước   Ghi chú
 1     id                  int                         Khóa chính, Tự động tăng
 2     tenhang             varchar        255          Not Null
 3     tenhang_slug        varchar        255          Not Null
 4     hinhanh             varchar        255          Allow Null


 Bảng: sanpham
 STT   Tên trường          Kiểu dữ liệu   Kích thước   Ghi chú
 1     id                  int                         Khóa chính, Tự động tăng
 2     loaisanpham_id      int                         Khóa ngoại, Not Null
 3     hangsanxuat_id      int                         Khóa ngoại, Not Null
 4     tensanpham          varchar        255          Not Null
 5     tensanpham_slug     varchar        255          Not Null
 6     soluong             int                         Not Null
 7     dongia              double                      Not Null
 8     hinhanh             varchar        255          Allow Null
 9     motasanpham         text                        Allow Null


 Bảng: tinhtrang
 STT   Tên trường          Kiểu dữ liệu   Kích thước   Ghi chú
 1     id                  int                         Khóa chính, Tự động tăng
 2     tinhtrang           varchar        255          Not Null


 Bảng: donhang
 STT   Tên trường          Kiểu dữ liệu   Kích thước   Ghi chú
 1     id                  int                         Khóa chính, Tự động tăng
 2     user_id             int                         Khóa ngoại, Not Null
 3     tinhtrang_id        int                         Khóa ngoại, Not Null
 3     dienthoaigiaohang   varchar        20           Not Null
 4     diachigiaohang      varchar        255          Not Null


 Bảng: donhang_chitiet
 STT   Tên trường          Kiểu dữ liệu   Kích thước   Ghi chú
 1      id                                    int                  Khóa chính, Tự động tăng
 2      donhang_id                            int                  Khóa ngoại, Not Null
 3      sanpham_id                            int                  Khóa ngoại, Not Null
 4      soluongban                            int                  Not Null
 5      dongiaban                             double               Not Null


Nội dung các tập tin migrations:
Các tập tin migrations nằm trong thư mục database/migrations
Laravel đã tạo sẵn 3 tập tin migrations (users, cache, jobs).
 Loại sản phẩm
 public function up(): void
 {
     Schema::create('loaisanpham', function (Blueprint $table) {
         $table->id();
         $table->string('tenloai');
         $table->string('tenloai_slug');
         $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('loaisanpham');
 }


 Hãng sản xuất
 public function up(): void
 {
     Schema::create('hangsanxuat', function (Blueprint $table) {
         $table->id();
         $table->string('tenhang');
         $table->string('tenhang_slug');
         $table->string('hinhanh')->nullable();
         $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('hangsanxuat');
 }
 Sản phẩm
 public function up(): void
 {
     Schema::create('sanpham', function (Blueprint $table) {
         $table->id();
         $table->foreignId('loaisanpham_id')->constrained('loaisanpham');
         $table->foreignId('hangsanxuat_id')->constrained('hangsanxuat');
         $table->string('tensanpham');
         $table->string('tensanpham_slug');
         $table->integer('soluong');
         $table->double('dongia');
         $table->string('hinhanh')->nullable();
         $table->text('motasanpham')->nullable();
         $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('sanpham');
 }


 Tình trạng
 public function up(): void
 {
     Schema::create('tinhtrang', function (Blueprint $table) {
         $table->id();
         $table->string('tinhtrang');
         $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('tinhtrang');
 }


 Đơn hàng
 public function up(): void
 {
     Schema::create('donhang', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained('users');
         $table->foreignId('tinhtrang_id')->constrained('tinhtrang');
         $table->string('dienthoaigiaohang', 20);
           $table->string('diachigiaohang');
           $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('donhang');
 }


 Đơn hàng chi tiết
 public function up(): void
 {
     Schema::create('donhang_chitiet', function (Blueprint $table) {
         $table->id();
         $table->foreignId('donhang_id')->constrained('donhang');
         $table->foreignId('sanpham_id')->constrained('sanpham');
         $table->integer('soluongban');
         $table->double('dongiaban');
         $table->timestamps();
     });
 }

 public function down(): void
 {
     Schema::dropIfExists('donhang_chitiet');
 }


 Người dùng
 public function up(): void
 {
     Schema::create('users', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('email')->unique();
         $table->string('username')->nullable();
         $table->string('role')->default('user');
         $table->timestamp('email_verified_at')->nullable();
         $table->string('password');
         $table->rememberToken();
         $table->timestamps();
     });

     ...
 }
Bước 7: Chỉnh sửa thông số kết nối CSDL trong tập tin .env
Tập tin .env nằm trong thư mục gốc của dự án (thư mục larashop).
 APP_NAME=LaraShop
 APP_ENV=local
 APP_KEY=base64:/95yp53isHSNRVU+Y54Tg+0jYAX9RhHuTzI094KTMro=
 APP_DEBUG=true
 APP_URL=http://127.0.0.1/larashop

 APP_LOCALE=en
 APP_FALLBACK_LOCALE=en
 APP_FAKER_LOCALE=en_US

 APP_MAINTENANCE_DRIVER=file
 # APP_MAINTENANCE_STORE=database

 PHP_CLI_SERVER_WORKERS=4

 BCRYPT_ROUNDS=12

 LOG_CHANNEL=stack
 LOG_STACK=single
 LOG_DEPRECATIONS_CHANNEL=null
 LOG_LEVEL=debug

 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=larashop
 DB_USERNAME=root
 DB_PASSWORD=



Bước 8: Tạo CSDL rỗng trong phpMyAdmin
Vào phpMyAdmin tạo CSDL rỗng có tên giống như cấu hình ở Bước 7.




Chọn bảng mã utf8mb4_unicode_ci.
Bước 9: Chạy lệnh artisan để tạo các bảng
Link: https://laravel.com/docs/master/migrations
 php artisan migrate
Vào phpMyAdmin xem lại các bảng vừa mới sinh ra.


Nếu ở bước này có phát sinh lỗi về chiều dài (1071 Specified key was too long) thì xem fix lỗi bằng cách mở tập tin config/database.php và bổ sung:
 'mysql' => [
     'driver' => 'mysql',
     'url' => env('DB_URL'),
     'host' => env('DB_HOST', '127.0.0.1'),
     'port' => env('DB_PORT', '3306'),
     'database' => env('DB_DATABASE', 'laravel'),
     'username' => env('DB_USERNAME', 'root'),
     'password' => env('DB_PASSWORD', ''),
     'unix_socket' => env('DB_SOCKET', ''),
     'charset' => env('DB_CHARSET', 'utf8mb4'),
     'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
     'prefix' => '',
     'prefix_indexes' => true,
     'strict' => true,
     'engine' => env('DB_ENGINE', 'InnoDB'),
     'options' => extension_loaded('pdo_mysql') ? array_filter([
         PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
     ]) : [],
 ],
Sau khi cập nhật tập tin config/database.php, chạy lại lệnh để xóa bỏ bảng cũ và tạo lại bảng mới.
 php artisan migrate:fresh


Bước 10: Tạo form xác thực (Đăng ký, đăng nhập, quên mật khẩu, xác minh email…)
Cài gói UI bằng lệnh: composer require laravel/ui
Tạo form xác thực, sử dụng Bootstrap CSS bằng lệnh: php artisan ui bootstrap --auth
Xem thêm: https://github.com/laravel/ui
Lưu ý: Chọn Yes nếu được hỏi: The [Controller.php] file already exists. Do you want to replace it?
Bước 11: Chỉnh giao diện Master
- Giao diện master nằm trong thư mục resources/views/layouts
- Xóa bỏ dòng 17 trong tập tin app.blade.php: @vite(['resources/sass/app.scss', 'resources/js/app.js'])
- Nhúng liên kết CSS và JS Bootstrap phiên bản mới nhất, liên kết: https://getbootstrap.com/docs/5.3/getting-started/introduction
- Nhúng Font Awesome, liên kết: https://fontawesome.com
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}" />

     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
     <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
 </head>
 <body>
     <div class="container-fluid">
         <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-info">
             <div class="container-fluid">
                 <a class="navbar-brand" href="{{ route('frontend') }}">
                     <i class="fa-light fa-cart-shopping"></i> {{ config('app.name', 'Laravel') }}
                 </a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <!-- Left side of Navbar -->
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('loaisanpham') }}">
                                 <i class="fa-light fa-fw fa-diagram-project"></i> Loại sản phẩm
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('hangsanxuat') }}">
                                 <i class="fa-light fa-fw fa-copyright"></i> Hãng sản xuất
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sanpham') }}">
                                 <i class="fa-light fa-fw fa-box"></i> Sản phẩm
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('tinhtrang') }}">
                         <i class="fa-light fa-fw fa-list-check"></i> Tình trạng
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('donhang') }}">
                         <i class="fa-light fa-fw fa-file-invoice"></i> Đơn hàng
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('nguoidung') }}">
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
                                <i class="fa-light fa-fw fa-user-plus"></i> Đăng ký
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#nguoidung" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa-light fa-fw fa-user-circle"></i> {{ Auth::user()->name }}
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



Bước 12: Chỉnh nội dung tập tin web route tương ứng với các hàm trong Controllers (routes/web.php)
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\HangSanXuatController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\UserController;

Auth::routes();

// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('frontend');
Route::get('/home', [HomeController::class, 'getHome'])->name('frontend');

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

// Quản lý Sản phẩm
Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('sanpham');
Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('sanpham.them');
Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('sanpham.them');
 Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('sanpham.sua');
 Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('sanpham.sua');
 Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('sanpham.xoa');

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



Bước 13: Chỉnh các tập tin Models trong thư mục app/Models, lưu lý hasMany, belongsTo
Laravel đã tạo sẵn model User.php.


 Tập tin LoaiSanPham.php
 <?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Attributes\Table;
 use Illuminate\Database\Eloquent\Relations\HasMany;

 #[Table('loaisanpham')]
 class LoaiSanPham extends Model
 {
     public function SanPham(): HasMany
     {
        return $this->hasMany(SanPham::class, 'loaisanpham_id', 'id');
    }
}


 Tập tin HangSanXuat.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('hangsanxuat')]
class HangSanXuat extends Model
{
    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'hangsanxuat_id', 'id');
    }
}


 Tập tin SanPham.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('sanpham')]
class SanPham extends Model
{
    public function LoaiSanPham(): BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id', 'id');
    }

    public function HangSanXuat(): BelongsTo
    {
        return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
    }

    public function DonHang_ChiTiet(): HasMany
     {
         return $this->hasMany(DonHang_ChiTiet::class, 'sanpham_id', 'id');
     }
 }


 Tập tin TinhTrang.php
 <?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Attributes\Table;
 use Illuminate\Database\Eloquent\Relations\HasMany;

 #[Table('tinhtrang')]
 class TinhTrang extends Model
 {
     public function DonHang(): HasMany
     {
         return $this->hasMany(DonHang::class, 'tinhtrang_id', 'id');
     }
 }


 Tập tin DonHang.php
 <?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Attributes\Table;
 use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;

 #[Table('donhang')]
 class DonHang extends Model
 {
     public function User(): BelongsTo
     {
         return $this->belongsTo(User::class, 'user_id', 'id');
     }

     public function TinhTrang(): BelongsTo
     {
         return $this->belongsTo(TinhTrang::class, 'tinhtrang_id', 'id');
     }
     public function DonHang_ChiTiet(): HasMany
     {
         return $this->hasMany(DonHang_ChiTiet::class, 'donhang_id', 'id');
     }
 }


 Tập tin DonHang_ChiTiet.php
 <?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Attributes\Table;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;

 #[Table('donhang_chitiet')]
 class DonHang_ChiTiet extends Model
 {
     public function DonHang(): BelongsTo
     {
         return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
     }

     public function SanPham(): BelongsTo
     {
         return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
     }
 }




 Tập tin User.php
 <?php

 namespace App\Models;

 use Database\Factories\UserFactory;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
 use Illuminate\Database\Eloquent\Attributes\Hidden;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Database\Eloquent\Relations\HasMany;

 #[Fillable(['name', 'email', 'username', 'role', 'password'])]
 #[Hidden(['password', 'remember_token'])]
 class User extends Authenticatable
 {
     use HasFactory, Notifiable;

     protected function casts(): array
     {
         return [
             'email_verified_at' => 'datetime',
             'password' => 'hashed',
         ];
     }

     public function DonHang(): HasMany
     {
         return $this->hasMany(DonHang::class, 'user_id', 'id');
     }
 }



Bước 14: Chỉnh các tập tin Controllers
Thống nhất tên các hàm để dễ copy/paste.
Ví dụ: getDanhSach, getThem, postThem, getSua, postSua, getXoa
- Tập tin: LoaiSanPhamController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\LoaiSanPham;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;

 class LoaiSanPhamController extends Controller
 {
     public function getDanhSach()
     {
         $loaisanpham = LoaiSanPham::all();
         return view('loaisanpham.danhsach', compact('loaisanpham'));
     }

     public function getThem()
     {
         return view('loaisanpham.them');
     }

     public function postThem(Request $request)
     {
         $orm = new LoaiSanPham();
          $orm->tenloai = $request->tenloai;
          $orm->tenloai_slug = Str::slug($request->tenloai, '-');
          $orm->save();

          return redirect()->route('loaisanpham');
     }

     public function getSua($id)
     {
         $loaisanpham = LoaiSanPham::find($id);
         return view('loaisanpham.sua', compact('loaisanpham'));
     }

     public function postSua(Request $request, $id)
     {
         $orm = LoaiSanPham::find($id);
         $orm->tenloai = $request->tenloai;
         $orm->tenloai_slug = Str::slug($request->tenloai, '-');
         $orm->save();

          return redirect()->route('loaisanpham');
     }

     public function getXoa($id)
     {
         $orm = LoaiSanPham::find($id);
         $orm->delete();

          return redirect()->route('loaisanpham');
     }
 }



Bước 15: Xây dựng các views ứng với các Controller
Các views nằm trong thư mục resources/views
Một view con phải kế thừa một view master nào đó. Tập tin view phải có phần mở rộng .blade.php
Link: https://laravel.com/docs/master/blade


Ví dụ về view con:
- Trong thư mục views, tạo thư mục con loaisanpham.
- Trong thư mục con loaisanpham sẽ có 3 tập tin danhsach.blade.php, sua.blade.php, them.blade.php ứng với 3 giao diện Danh sách, Sửa, Thêm.
 Nội dung tập tin loaisanpham/danhsach.blade.php:
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Loại sản phẩm</div>
         <div class="card-body table-responsive">
             <p><a href="{{ route('loaisanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
             <table class="table table-bordered table-hover table-sm mb-0">
                 <thead>
                     <tr>
                         <th width="5%">#</th>
                         <th width="45%">Tên loại</th>
                         <th width="40%">Tên loại không dấu</th>
                         <th width="5%">Sửa</th>
                         <th width="5%">Xóa</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($loaisanpham as $value)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $value->tenloai }}</td>
                             <td>{{ $value->tenloai_slug }}</td>
                            <td class="text-center"><a href="{{ route('loaisanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
                            <td class="text-center"><a href="{{ route('loaisanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $value->tenloai }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>

                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 @endsection



 Nội dung tập tin loaisanpham/them.blade.php:
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Thêm loại sản phẩm</div>
         <div class="card-body">
             <form action="{{ route('loaisanpham.them') }}" method="post">
                 @csrf

                 <div class="mb-3">
                     <label class="form-label" for="tenloai">Tên loại</label>
                     <input type="text" class="form-control" id="tenloai" name="tenloai" required />
                 </div>

                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
            </form>
        </div>
    </div>
 @endsection



 Nội dung tập tin loaisanpham/sua.blade.php:
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Sửa loại sản phẩm</div>
         <div class="card-body">
             <form action="{{ route('loaisanpham.sua', ['id' => $loaisanpham->id]) }}" method="post">
                 @csrf

                 <div class="mb-3">
                     <label class="form-label" for="tenloai">Tên loại</label>
                     <input type="text" class="form-control" id="tenloai" name="tenloai" value="{{ $loaisanpham->tenloai }}" required />
                 </div>

                 <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
             </form>
         </div>
     </div>
 @endsection
