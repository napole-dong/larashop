                                                                                                                        Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                                PHẦN 2: KIỂM TRA THÔNG TIN TRÊN FORM
Bước 1: Cấu hình ngôn ngữ và múi giờ
Tất cả các tập tin cấu hình đều nằm trong thư mục config.
- app.php: Cấu hình chung.
- auth.php: Cấu hình tài khoản người dùng và xác thực.
- database.php: Cấu hình cơ sở dữ liệu.
- filesystems.php: Cấu hình tập tin và nơi lưu trữ.
- mail.php: Cấu hình email.
…
Các giá trị cấu hình có thể ghi trực tiếp vào các tập tin ở trên hoặc có thể ghi gián tiếp vào tập tin.env ở thư mục chính.
Có thể truy xuất các giá trị bên trong tập tin .env bằng hàm env('Key'). Ví dụ: env('APP_NAME');


Để cấu hình ngôn ngữ và múi giờ, hãy mở tập tin.env và bổ sung:
 APP_NAME=LaraShop
 APP_ENV=local
 APP_KEY=base64:/95yp53isHSNRVU+Y54Tg+0jYAX9RhHuTzI094KTMro=
 APP_DEBUG=true
 APP_TIMEZONE=Asia/Ho_Chi_Minh
 APP_URL=http://127.0.0.1/larashop

 APP_LOCALE=vi
 APP_FALLBACK_LOCALE=vi
 APP_FAKER_LOCALE=vi_VN

 APP_MAINTENANCE_DRIVER=file
 # APP_MAINTENANCE_STORE=database




Bước 2: Việt hóa ngôn ngữ
Mặc định, thư mục chứa các tập tin ngôn ngữ sẽ bị ẩn. Sử dụng lệnh để tạo thư mục lang.
 php artisan lang:publish
Sau khi đã cấu hình ở Bước 1, tiến hành Việt hóa ngôn ngữ. Tập tin ngôn ngữ nằm trong thư mục lang. Ở đó đã có sẵn thư mục en, bây giờ hãy copy thư
mục đó và dán thành vi, sau đó tiến hành Việt hóa lần lượt từng tập tin bên trong thư mục vi vừa tạo.


Nếu không muốn tốn thời gian Việt hóa thì hãy tải sử dụng tập tin vi.zip có sẵn và giải nén vào thư mục lang để sử dụng.


Bước 3: Cài đặt kiểm tra thông tin trên Form từ phía Controllers
Link đọc thêm: https://laravel.com/docs/master/validation
Có 2 loại Form cần phải kiểm tra là Thêm và Sửa. Kiểm tra được thực hiện trước khi lưu vào CSDL.
Cài đặt bên trong hàm postThem và postSua (xem lại Phần 1 nếu chưa biết 2 hàm này nằm ở đâu).
Ví dụ:
 public function postThem(Request $request)
 {
     // Kiểm tra
     $request->validate([
         'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham'],
     ]);

     $orm = new LoaiSanPham();
     $orm->tenloai = $request->tenloai;
     $orm->tenloai_slug = Str::slug($request->tenloai, '-');
     $orm->save();

     // Sau khi thêm thành công thì tự động chuyển về trang danh sách
     return redirect()->route('loaisanpham');
 }

 public function postSua(Request $request, $id)
 {
     // Kiểm tra
     $request->validate([
         'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham,tenloai,' . $id],
     ]);

     $orm = LoaiSanPham::find($id);
     $orm->tenloai = $request->tenloai;
     $orm->tenloai_slug = Str::slug($request->tenloai, '-');
     $orm->save();

     // Sau khi sửa thành công thì tự động chuyển về trang danh sách
     return redirect()->route('loaisanpham');
 }
Một số các ví dụ khác:
 // Thêm
 $request->validate([
     'madinhdanh' => ['required', 'string', 'size:6', 'unique:locations'],
     'hovaten' => ['required', 'string'],
     'kinhdo' => ['required', 'numeric'],
     'vido' => ['required', 'numeric'],
 ]);

 // Sửa
 $request->validate([
     'madinhdanh' => ['required', 'string', 'size:6', 'unique:locations,madinhdanh,' . $request->id],
     'hovaten' => ['required', 'string'],
     'kinhdo' => ['required', 'numeric'],
     'vido' => ['required', 'numeric'],
 ]);

 $request->validate([
     'vutrong_id' => ['required', 'numeric', 'min:1'],
     'hangsanxuat' => ['nullable', 'string', 'max:255'],
     'tennguyenvatlieu' => ['required', 'string', 'max:255'],
     'hoatchat' => ['nullable', 'string'],
     'hinhanh' => ['nullable', 'image', 'max:2048'],
     'donvitinh' => ['nullable', 'string', 'max:50'],
     'quycachdonggoi' => ['nullable', 'string', 'max:255'],
     'soluong' => ['required', 'numeric', 'min:0'],
     'dongia' => ['nullable', 'numeric', 'min:0'],
     'ngaymua' => ['nullable', 'date_format:d/m/Y'],
     'hansudung' => ['nullable', 'string', 'max:50'],
     'nguoimua' => ['nullable', 'string', 'max:50'],
     'nguoiban' => ['nullable', 'string', 'max:255'],
     'diachinguoiban' => ['nullable', 'string', 'max:255'],
     'ghichukhac' => ['nullable', 'string'],
 ]);


Một số luật thường dùng:
 STT   Luật                             Ý nghĩa                                            Ví dụ
 1     confirmed                        Xác nhận lại thông tin (ví dụ: mật khẩu).
 2     date                             Phải là kiểu ngày.
 3     digits:number                    Phải là kiểu số có chiều dài cố định.              digits:4
 4     email                            Phải là địa chỉ email.
 5     file                             Phải là một tập tin.
 6     image                            Phải là một tập tin hình ảnh.
 7     max:number                       Lớn nhất.                                          max:2020
 8     min:number                          Nhỏ nhất.                                                                min:1970
 9     numeric                             Phải là một số.
 10    required                            Bắt buộc nhập
 11    string                              Kiểu chuỗi.
 12    unique:table,column                 Không được phép trùng, duy nhất.                                         unique:loaisanpham
Xem thêm: https://laravel.com/docs/master/validation#available-validation-rules


Bước 4: Hiển thị thông báo lỗi ra ngoài Views
Khi một luật bị vi phạm, nó sẽ trả về thông báo lỗi trên views, hành động Thêm/Sửa sẽ không thực hiện được.


 Cài đặt thông báo lỗi tại form Thêm:
 <form action="{{ route('loaisanpham.them') }}" method="post">
     @csrf

     <div class="mb-3">
         <label class="form-label" for="tenloai">Tên loại</label>
         <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai" value="{{ old('tenloai') }}" required />
         @error('tenloai')
             <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
         @enderror
     </div>

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
 </form>

Lưu ý: invalid-feedback chỉ hiển thị khi có is-invalid.
Form với thông báo lỗi sẽ xóa hết tất cả các thông tin vừa nhập trước đó. Để tránh sự bất tiện này, hãy sử dụng hàm old để lấy lại giá trị cũ đã nhập.


 Cài đặt thông báo lỗi tại form Sửa:
 <form action="{{ route('loaisanpham.sua', ['id' => $loaisanpham->id]) }}" method="post">
     @csrf

     <div class="mb-3">
         <label class="form-label" for="tenloai">Tên loại</label>
         <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai" value="{{ $loaisanpham->tenloai }}" required />
         @error('tenloai')
             <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
         @enderror
     </div>

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
 </form>
