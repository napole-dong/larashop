LARAVEL (PHP FRAMEWORK)

           Nguyễn Hoàng Tùng
           Bộ môn Kỹ thuật phần mềm
           nhoangtung@agu.edu.vn
           www.nhtung.id.vn
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   2
Giới thiệu
❑ Được phát triển và cung cấp miễn phí bởi Taylor Otwell, ra mắt lần đầu vào tháng
  06 năm 2011.
❑ Laravel là một PHP framework được sử dụng phổ biến nhất trên thế giới vì những
  ưu điểm vượt trội tận dụng các kỹ thuật Design Pattern, các công nghệ mới nhất
  của PHP và tính dễ dàng tiếp cận và sử dụng nó.
❑ Trang chủ: https://laravel.com




20/07/2026                         Công nghệ Web - PHP                           3
Giới thiệu




             Nguồn: https://www.excellentwebworld.com/best-php-frameworks

20/07/2026                         Công nghệ Web - PHP                      4
Giới thiệu
❑ Các phiên bản đang hỗ trợ (tính đến 08/2025):
    Phiên bản     PHP tối thiểu             Ngày công bố   Ngưng hỗ trợ
        11           >= 8.2                     03/2024      03/2026
        12           >= 8.2                     02/2025      02/2027
        13           >= 8.3                     03/2026      02/2028




❑ Xem thêm: https://laravel.com/docs/13.x/releases

20/07/2026                         Công nghệ Web - PHP                    5
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   6
Cài đặt
1. Cài Wamp/XAMPP có phiên bản PHP phù hợp với bản Laravel muốn cài đặt.
2. Cài Composer.
3. Dùng CMD, chuyển tới thư mục www và dùng lệnh composer để cài.
    // Cài Laravel 12.x
    composer create-project laravel/laravel:^12.0 app-name

    // Cài Laravel mới nhất
    composer create-project laravel/laravel app-name




    // Trong đó: app-name là tên của project

20/07/2026                       Công nghệ Web - PHP                       7
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   8
Cấu trúc thư mục
             Folder/File        Công dụng
             app                Chứa Models, Controllers, Providers,…
             bootstrap          Chứa các tập tin khởi tạo.
             config             Chứa các tập tin cấu hình.
             database           Chứa các tập tin cơ sở dữ liệu.
             public             Chứa các tập tin tĩnh như HTML, CSS, Javascript,…
             resources          Chứa Views.
             routes             Chứa các tập tin chỉ đường cho request.
             storage            Chứa dữ liệu do người dùng upload lên.
             vendor             Chứa thư viện chính của Laravel.
             .env               Tập tin cấu hình.
             artisan            Tập tin chứa lệnh artisan
             composer.json      Quy định cấu trúc để lấy dữ liệu từ Composer.
                             Xem thêm: https://laravel.com/docs/13.x/structure
20/07/2026                         Công nghệ Web - PHP                              9
Mô hình MVC của Laravel




20/07/2026           Công nghệ Web - PHP   10
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   11
Cấu hình
❑ Tất cả các tập tin cấu hình đều nằm trong thư mục config:
    ⚫ app.php: Cấu hình chung.
    ⚫ auth.php: Cấu hình tài khoản người dùng và xác thực.
    ⚫ database.php: Cấu hình cơ sở dữ liệu.
    ⚫ filesystems.php: Cấu hình tập tin và nơi lưu trữ.
    ⚫ mail.php: Cấu hình email.
    ⚫ …
❑ Các giá trị cấu hình có thể ghi trực tiếp vào các file ở trên hoặc có thể ghi gián tiếp
  vào file .env ở thư mục chính.




20/07/2026                              Công nghệ Web - PHP                             12
Lệnh artisan
❑ Artisan là giao diện dòng lệnh đi kèm với Laravel.
❑ Để thực thi lệnh artisan, phải chuyển về thư mục gốc của dự án.
❑ Để xem tất cả các lệnh sẵn có:
   php artisan list

❑ Một số lệnh thường dùng:
   php artisan serve
   php artisan make:model
   php artisan make:controller
   php artisan make:migration
   php artisan migrate
   php artisan vendor:publish
❑ Xem thêm: https://laravel.com/docs/13.x/artisan

20/07/2026                          Công nghệ Web - PHP             13
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   14
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   15
Các thành phần cơ bản / Cơ sở dữ liệu
❑ Trong Laravel có thể tạo CSDL bằng 2 cách:
    ⚫ Tạo thủ công trong phpMyAdmin (Database first).
    ⚫ Dùng lệnh migration (Code first).
❑ Có 2 lệnh để tạo tập tin CSDL:
   php artisan make:migration create_chude_table
   php artisan make:migration create_baiviet_table
   php artisan make:migration create_nguoidung_table

   Hoặc

   php artisan make:model ChuDe --migration --controller
   php artisan make:model BaiViet -m -c
   php artisan make:model NguoiDung -mc


20/07/2026                                Công nghệ Web - PHP   16
Các thành phần cơ bản / Cơ sở dữ liệu
❑ Vào thư mục database/migrations và bổ sung các định nghĩa vào các file vừa tạo.
❑ Vào phpMyAdmin tạo CSDL rỗng có tên giống như cấu hình trong .env
❑ Chạy lệnh artisan để tạo các bảng:
   php artisan migrate

   // Xóa các bảng cũ và tạo lại bảng mới
   php artisan migrate:fresh




❑ Xem thêm: https://laravel.com/docs/13.x/migrations

20/07/2026                         Công nghệ Web - PHP                            17
Các thành phần cơ bản / Models
❑ Các tập tin Models khi tạo ra sẽ được lưu ở thư mục app\Models.
❑ Dùng lệnh artisan để tạo các tập tin Models:
   php artisan make:model ChuDe --migration --controller
   php artisan make:model BaiViet -m -c
   php artisan make:model NguoiDung -mc
❑ Mở các tập tin Models và bổ sung các khai báo.
    ⚫ Lưu ý về tên bảng.
    ⚫ Lưu ý về khóa chính.
    ⚫ Lưu ý về trường khóa chính tự động tăng.
    ⚫ Lưu ý về kiểu dữ liệu của khóa chính.
    ⚫ Lưu ý về hasMany và belongsTo.
❑ Xem thêm: https://laravel.com/docs/13.x/eloquent
20/07/2026                             Công nghệ Web - PHP          18
Các thành phần cơ bản / Xây dựng truy vấn
❑ Các hàm thường dùng:
         Lấy dữ liệu            Thêm                         Xóa          Cập nhật
 all                   create                     delete           save
 get                   save                       destroy          updateOrCreate
 first                 updateOrCreate
 firstOrFail
 find
 where
 orderBy
 take
 …
❑ Xem thêm: https://laravel.com/docs/13.x/eloquent

20/07/2026                             Công nghệ Web - PHP                           19
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   20
Các thành phần cơ bản / Routing
❑ Được quy định trong thư mục routes.
❑ Route thực hiện chức năng định tuyến, dẫn đường cho các HTTP request.
❑ Các loại route chính:
    ⚫ Route::get();
    ⚫ Route::post();
    ⚫ Route::prefix();
    ⚫ Route::group();
❑ Đặt tên cho Route
   Route::post('/chude/sua', [ChuDeController::class, 'postSua'])->name('chude.sua');

❑ Xem thêm: https://laravel.com/docs/13.x/routing

20/07/2026                          Công nghệ Web - PHP                            21
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   22
Các thành phần cơ bản / CSRF Protection
❑ CSRF (Cross-Site Request Forgery) là một loại tấn công bằng cách gởi yêu cầu giả
  mạo lên máy chủ nhằm đánh cắp thông tin của người dùng.
    ⚫ Ví dụ: Hacker cố tình tạo một trang đăng nhập giả mạo để gởi thông tin lên một máy
      chủ ngân hàng, nếu máy chủ ngân hàng không có biện pháp phòng chống CSRF, nạn
      nhân vẫn đăng nhập được vào ngân hàng nhưng đồng thời thông tin đăng nhập cũng
      sẽ bị hacker đánh cắp.
❑ Laravel yêu cầu tất cả các request POST đều phải có token csrf.




20/07/2026                           Công nghệ Web - PHP                              23
Các thành phần cơ bản / CSRF Protection
❑ Phải thêm @csrf vào trong thẻ FORM.
   <form action="{{ route('chude.them') }}" method="post">
      @csrf
      <div class="mb-3">
         <label for="TenChuDe">Tên chủ đề</label>
         <input type="text" name="TenChuDe" required />
      </div>

      <button type="submit">Thêm vào CSDL</button>
   </form>




20/07/2026                       Công nghệ Web - PHP         24
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   25
Các thành phần cơ bản / Session
❑ Để cấu hình thông số cho session, truy cập config/session.php.
❑ Để lưu dữ liệu vào session:
   // Thông qua Request
   $request->session()->put('key', 'value');

   // Thông qua hàm toàn cục
   session(['key' => 'value']);


❑ Để truy xuất dữ liệu đã lưu:
   // Thông qua Request
   $request->session()->get('key');

   // Thông qua hàm toàn cục
   $value = session('key');

20/07/2026                         Công nghệ Web - PHP             26
Các thành phần cơ bản / Session
❑ Session dùng một lần (flash) và sẽ bị xóa sau khi thực hiện xong request tiếp theo:
   $request->session()->flash('status', 'Đã thêm thành công!');

❑ Để gởi flash session từ Controller qua View:
   return redirect()->route('chude.them')->with('status', 'Thêm thành công!');

❑ Để hiển thị flash session trên View:
   @session('status')
      <div class="alert alert-info">
         {{ session('status') }}
      </div>
   @endsession


❑ Để xóa session: $request->session()->forget('key');

20/07/2026                           Công nghệ Web - PHP                             27
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   28
Các thành phần cơ bản / Validation
❑ Validation bao gồm một tập hợp các luật để kiểm tra dữ liệu trên form và hiển thị
  các thông báo lỗi nếu luật bị vi phạm.
❑ Cài đặt trong Controller:
   $request->validate([
     'email' => ['required', 'email', 'max:255', 'unique:users’],
     'password' => ['required', 'min:6', 'confirmed'],
     'privilege' => ['required']
   ]);
❑ Hiển thị thông báo lỗi trên View:
   @error('email')
     <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
     </div>
   @enderror

20/07/2026                             Công nghệ Web - PHP                        29
Các thành phần cơ bản / Validation
❑ Phải Việt hóa tập tin trong lang\en\validation.php để có thể hiển thị Tiếng Việt.
❑ Để xuất thư mục ngôn ngữ, cần chạy lệnh php artisan lang:publish
❑ Để xem tất cả các luật: https://laravel.com/docs/13.x/validation#available-validation-rules
❑ Xem thêm: https://laravel.com/docs/13.x/validation




20/07/2026                               Công nghệ Web - PHP                                    30
Các thành phần cơ bản
❑ Cơ sở dữ liệu.
❑ Routing.
❑ CSRF Protection.
❑ Session.
❑ Validation.
❑ Blade templates.




20/07/2026              Công nghệ Web - PHP   31
Các thành phần cơ bản / Blade templates
❑ Controller trong Laravel trả dữ liệu cho View.
❑ View phải có khả năng xử lý dữ liệu và hiển thị ra màn hình. Điều này được thực
  hiện bằng cách dùng Blade, nó cho chúng ta “nhúng” mã Blade vào trong tài liệu
  HTML.
❑ Blade templates là một công cụ tạo mẫu (Templating engines) của Laravel, có vai
  trò chuyển mã Blade sang mã PHP thuần túy trong View.
❑ Các tập tin Blade trong views cần có phần mở rộng .blade.php




20/07/2026                          Công nghệ Web - PHP                         32
Các thành phần cơ bản / Blade templates
❑ Được quy định trong thư mục resources/views
    ⚫ Thư mục layouts chứa view master.
❑ Gọi View từ Controller:
   return view('chude.them');

❑ Gọi View từ Controller kèm theo dữ liệu:
   $chude = ChuDe::all();
   return view('chude.danhsach', compact('chude'));


   $chude = ChuDe::all();
   $baiviet = BaiViet::find($id);
   return view('baiviet.sua', compact('chude', 'baiviet'));


20/07/2026                          Công nghệ Web - PHP       33
Các thành phần cơ bản / Blade templates
❑ Các từ khóa thường dùng:
    ⚫ @yield('name')
    ⚫ @section('name')
    ⚫ @extends('layouts.app')
    ⚫ {{ $data }}
    ⚫ {!! data !!}
    ⚫ @php … @endphp
    ⚫ @include('view.name', ['some' => 'data'])
    ⚫ …
❑ Xem thêm: https://laravel.com/docs/13.x/blade


20/07/2026                              Công nghệ Web - PHP   34
Nội dung chính của phần này
❑ Giới thiệu.
❑ Cài đặt.
❑ Cấu trúc thư mục.
❑ Cấu hình.
❑ Các thành phần cơ bản.
❑ Các thành phần nâng cao.




20/07/2026                   Công nghệ Web - PHP   35
Các thành phần nâng cao
❑ Collections
❑ Helpers
❑ Strings
❑ Middleware (Xem thêm tại: https://laravel.com/docs/13.x/middleware)
❑ File Storage (Xem thêm tại: https://laravel.com/docs/13.x/filesystem)
❑ Mail (Xem thêm tại: https://laravel.com/docs/13.x/mail)
❑ Notifications (Xem thêm tại: https://laravel.com/docs/13.x/notifications)
❑ Queues (Xem thêm tại: https://laravel.com/docs/13.x/queues)




20/07/2026                             Công nghệ Web - PHP                    36
Các thành phần nâng cao / Collections
❑ Các phương thức sẵn có (https://laravel.com/docs/13.x/collections)




20/07/2026                            Công nghệ Web - PHP              37
Các thành phần nâng cao / Helpers
❑ Hàm xử lý Mảng & Đối tượng (https://laravel.com/docs/13.x/helpers#arrays-and-objects-method-list)
❑ Hàm xử lý Số học (https://laravel.com/docs/13.x/helpers#numbers-method-list)
❑ Hàm xử lý Đường dẫn (https://laravel.com/docs/13.x/helpers#paths-method-list)
❑ Hàm xử lý Tài nguyên (https://laravel.com/docs/13.x/helpers#urls-method-list)
❑ Hàm xử lý Khác (https://laravel.com/docs/13.x/helpers#miscellaneous-method-list)




20/07/2026                                    Công nghệ Web - PHP                                     38
Các thành phần nâng cao / Strings
❑ Các phương thức sẵn có (https://laravel.com/docs/13.x/strings)




20/07/2026                        Công nghệ Web - PHP              39
Giải đáp thắc mắc




20/07/2026          Công nghệ Web - PHP   40
