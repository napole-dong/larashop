                                                                                        Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                                 PHẦN 4: QUẢN LÝ TẬP TIN – THƯ MỤC
Bước 1: Thư viện và hàm hỗ trợ
Hàm về đường dẫn thường dùng:
 public_path();
 // Trả về: Z:\Wamp64\www\larashop\public

 public_path('css/style.css');
 // Trả về: Z:\Wamp64\www\larashop\public\css\style.css

 storage_path();
 // Trả về: Z:\Wamp64\www\larashop\storage

 storage_path('app/file.txt')
 // Trả về: Z:\Wamp64\www\larashop\storage\app\file.txt
Xem thêm: https://laravel.com/docs/master/helpers#paths-method-list


Hàm về địa chỉ thường dùng:
 asset('public/demo.jpg');
 // Trả về: http://127.0.0.1/larashop/public/demo.jpg
Xem thêm: https://laravel.com/docs/master/helpers#urls-method-list


File request:
- Quản lý tập tin được gởi lên từ Form.
- Form gởi tập tin phải gởi bằng POST và có thuộc tính enctype="multipart/form-data".
- Ví dụ mẫu:
 // Lấy tập tin upload
 $file = $request->file('avatar');

 // Kiểm tra trường tập tin có bỏ trống?
 if($request->hasFile('avatar'))
 {
 }

 // Lấy đường dẫn tập tin
 $path = $request->file('avatar')->path();

 // Lấy tên tập tin
 $name = $request->file('avatar')->getClientOriginalName();
 // Lấy phần mở rộng tập tin
 $extension = $request->file('avatar')->extension();
Xem thêm: https://laravel.com/docs/master/requests#files


Thành phần Storage:
- use Illuminate\Support\Facades\Storage;
- Thành phần này hỗ trợ các hàm quản lý tập tin thư mục.
- Xem thêm: https://laravel.com/docs/master/filesystem


Quy định vị trí lưu trữ:
- Mở tập tin config/filesystems.php để xác định vị trí mà tập tin hoặc thư mục sẽ được lưu trữ.
 'default' => env('FILESYSTEM_DRIVER', 'local'),

 'local' => [
     'driver' => 'local',
     'root' => storage_path('app/private'),
     'serve' => true,
     'throw' => false,
 ],
 'public' => [
     'driver' => 'local',
     'root' => storage_path('app/public'),
     'url' => env('APP_URL').'/storage',
     'visibility' => 'public',
     'throw' => false,
 ],
- Theo thiết lập mặc định (default), tập tin, thư mục được tạo ra sẽ được lưu trong thư mục storage/app/private.
- Ngoài các drives có sẵn, chúng ta có thể tự cấu hình để lưu tập tin sang nơi khác, ví dụ: Google Drive, One Drive,…


Phương thức thường dùng trong thành phần Storage:
 use Illuminate\Support\Facades\Storage;

 // Lấy đường dẫn tập tin
 $url = Storage::url('file.jpg');

 // Lấy dung lượng tập tin
 $size = Storage::size('file.jpg');
 // Lưu tập tin vào thư mục avatars, tên tập tin bị mã hóa
 $path = Storage::putFile('avatars', $request->file('avatar'));

 // Lưu tập tin vào thư mục avatars với tên khác
 $path = Storage::putFileAs('avatars', $request->file('avatar'), 'another_name.jpg');

 // Tải tập về
 return Storage::download('file.jpg');
 // Xóa tập tin
 Storage::delete('file.jpg');

 // Xóa nhiều tập tin
 Storage::delete(['file.jpg', 'file2.jpg']);

 // Lấy tất cả tập tin bên trong thư mục $directory
 $files = Storage::files($directory);

 // Lấy tất cả tập tin kể cả tập tin trong thư mục con của $directory
 $files = Storage::allFiles($directory);

 // Tạo thư mục
 Storage::makeDirectory($directory);

 // Xóa thư mục
 Storage::deleteDirectory($directory);

 // Lấy tất cả thư mục trong thư mục $directory
 $directories = Storage::directories($directory);

 // Lấy tất cả thư mục kể cả thư mục con bên trong thư mục $directory
 $directories = Storage::allDirectories($directory);



Bước 2: Upload hình ảnh hãng sản xuất
Kịch bản:
- Các hình ảnh hãng sản xuất sẽ lưu trong thư mục storage/app/private/hang-san-xuat.
- Tên tập tin lưu dưới dạng tên hãng sản xuất không dấu (slug).
- Khi xóa hãng sản xuất thì xóa luôn hình ảnh đi kèm.


 Nội dung cần bổ sung vào tập tin Controller: app/Http/Controlles/HangSanXuatController.php
 <?php

 namespace App\Http\Controllers;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HangSanXuatController extends Controller
{
    public function postThem(Request $request)
    {
        // Kiểm tra
        $request->validate([
            'tenhang' => ['required', 'string', 'max:255', 'unique:hangsanxuat'],
            'hinhanh' => ['nullable', 'image', 'max:1024']
        ]);

        // Xử lý upload (nếu có)
        $path = null;
        if($request->hasFile('hinhanh'))
        {
            // Xác định tên tập tin
            $file = $request->file('hinhanh');
            $extension = $file->extension();
            $filename = Str::slug($request->tenhang, '-') . '.' . $extension;

            // Upload vào thư mục 'hang-san-xuat' và trả về đường dẫn
            $path = $file->storeAs('hang-san-xuat', $filename);
        }

        // Thêm
        $orm = new HangSanXuat();
        $orm->tenhang = $request->tenhang;
        $orm->tenhang_slug = Str::slug($request->tenhang, '-');
        $orm->hinhanh = $path ?? null;
        $orm->save();

        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('hangsanxuat');
   }

   public function postSua(Request $request, $id)
   {
       // Kiểm tra
       $request->validate([
           'tenhang' => ['required', 'string', 'max:255', 'unique:hangsanxuat,tenhang,' . $id],
           'hinhanh' => ['nullable', 'image', 'max:1024']
       ]);

        $orm = HangSanXuat::find($id);

        // Kiểm tra tập tin rỗng hay không?
          $path = null;
          if($request->hasFile('hinhanh'))
          {
              // Xóa tập tin cũ
              if($orm->hinhanh) Storage::delete($orm->hinhanh);

              // Xác định tên tập tin
              $file = $request->file('hinhanh');
              $extension = $file->extension();
              $filename = Str::slug($request->tenhang, '-') . '.' . $extension;

              // Upload vào thư mục 'hang-san-xuat' và trả về đường dẫn
              $path = $file->storeAs('hang-san-xuat', $filename);
          }

          // Sửa
          $orm->tenhang = $request->tenhang;
          $orm->tenhang_slug = Str::slug($request->tenhang, '-');
          $orm->hinhanh = $path ?? $orm->hinhanh ?? null;
          $orm->save();

          // Sau khi sửa thành công thì tự động chuyển về trang danh sách
          return redirect()->route('hangsanxuat');
     }

     public function getXoa($id)
     {
         $orm = HangSanXuat::find($id);

          // Lấy đường dẫn ảnh trước khi xóa đối tượng
          $hinhanh = $orm->hinhanh;

          $orm->delete();

          // Xóa tập tin khi xóa dữ liệu
          if($hinhanh) Storage::delete($hinhanh);

          // Sau khi xóa thành công thì tự động chuyển về trang danh sách
          return redirect()->route('hangsanxuat');
     }
 }


 Nội dung bổ sung vào view Danh sách: resources/views/hangsanxuat/danhsach.blade.php
 <table class="table table-bordered table-hover table-sm mb-0">
     <thead>
         <tr>
             <th width="5%">#</th>
             <th width="10%">Hình ảnh</th>
             <th width="45%">Tên hãng sản xuất</th>
             <th width="30%">Tên hãng sản xuất không dấu</th>
             <th width="5%">Sửa</th>
             <th width="5%">Xóa</th>
         </tr>
     </thead>
     <tbody>
         @foreach($hangsanxuat as $value)
             <tr>
                 <td class="align-middle">{{ $loop->iteration }}</td>
                 <td class="align-middle text-center">
                     <img src="{{ asset('storage/app/private/'. $value->hinhanh) }}" width="100" class="img-thumbnail" />
                 </td>
                 <td class="align-middle">{{ $value->tenhang }}</td>
                 <td class="align-middle">{{ $value->tenhang_slug }}</td>
                 <td class="align-middle text-center">
                     <a href="{{ route('hangsanxuat.sua', ['id' => $value->id]) }}">
                         <i class="fa-light fa-edit"></i>
                     </a>
                 </td>
                 <td class="align-middle text-center">
                     <a href="{{ route('hangsanxuat.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa hãng sản xuất {{ $value->tenhang }} không?')">
                         <i class="fa-light fa-trash-alt text-danger"></i>
                     </a>
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>



 Nội dung bổ sung vào view Thêm: resources/views/hangsanxuat/them.blade.php
 <form action="{{ route('hangsanxuat.them') }}" method="post" enctype="multipart/form-data">
     @csrf

     <div class="mb-3">
         <label class="form-label" for="tenhang">Tên hãng sản xuất</label>
         <input type="text" class="form-control @error('tenhang') is-invalid @enderror" id="tenhang" name="tenhang" value="{{ old('tenhang') }}" required />
         @error('tenhang')
             <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
         @enderror
     </div>

     <div class="mb-3">
         <label class="form-label" for="hinhanh">Hình ảnh</label>
         <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
         @error('hinhanh')
             <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
         @enderror
     </div>

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
 </form>
 Nội dung bổ sung vào view Sửa: resources/views/hangsanxuat/sua.blade.php
 <form action="{{ route('hangsanxuat.sua', ['id' => $hangsanxuat->id]) }}" method="post" enctype="multipart/form-data">
     @csrf

    <div class="mb-3">
        <label class="form-label" for="tenhang">Tên hãng sản xuất</label>
         <input type="text" class="form-control @error('tenhang') is-invalid @enderror" id="tenhang" name="tenhang" value="{{ $hangsanxuat->tenhang }}" required />
        @error('tenhang')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="hinhanh">Hình ảnh</label>
        @if(!empty($hangsanxuat->hinhanh))
            <img class="d-block rounded img-thumbnail" src="{{ asset('storage/app/private/'. $hangsanxuat->hinhanh) }}" width="100" />
            <span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
        @endif
        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
        @error('hinhanh')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
 </form>



Bước 3: Upload hình ảnh sản phẩm
Kịch bản:
- Mỗi loại hình ảnh sản phẩm sẽ lưu trong một thư mục riêng, ví dụ: storage/app/private/dien-thoai, storage/app/private/may-tinh-bang,…
- Tên tập tin lưu dưới dạng tên sản phẩm không dấu (slug).
- Khi xóa sản phẩm thì xóa luôn hình ảnh đi kèm.


 Nội dung tập tin Controller: app/Http/Controlles/SanPhamController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\SanPham;
 use App\Models\LoaiSanPham;
 use App\Models\HangSanXuat;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;
class SanPhamController extends Controller
{
    public function postThem(Request $request)
    {
        // Kiểm tra
        $request->validate([
            'loaisanpham_id' => ['required'],
            'hangsanxuat_id' => ['required'],
            'tensanpham' => ['required', 'string', 'max:255', 'unique:sanpham'],
            'soluong' => ['required', 'numeric'],
            'dongia' => ['required', 'numeric'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload hình ảnh
        $path = null;
        if($request->hasFile('hinhanh'))
        {
            // Xác định thư mục
            $loaisanpham = LoaiSanPham::find($request->loaisanpham_id);
            $directory = $loaisanpham->tenloai_slug;

            // Xác định tên tập tin
            $file = $request->file('hinhanh');
            $extension = $file->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

            // Upload vào thư mục và trả về đường dẫn
            $path = $file->storeAs($directory, $filename);
        }

        $orm = new SanPham();
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->soluong = $request->soluong;
        $orm->dongia = $request->dongia;
        $orm->hinhanh = $path ?? null;
        $orm->motasanpham = $request->motasanpham;
        $orm->save();

        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('sanpham');
   }

   public function postSua(Request $request, $id)
   {
       // Kiểm tra
    $request->validate([
        'loaisanpham_id' => ['required'],
        'hangsanxuat_id' => ['required'],
        'tensanpham' => ['required', 'string', 'max:255', 'unique:sanpham,tensanpham,' . $id],
        'soluong' => ['required', 'numeric'],
        'dongia' => ['required', 'numeric'],
        'hinhanh' => ['nullable', 'image', 'max:2048'],
    ]);

    $orm = SanPham::find($id);

    // Upload hình ảnh
    $path = null;
    if($request->hasFile('hinhanh'))
    {
        // Xóa tập tin cũ
        if($orm->hinhanh) Storage::delete($orm->hinhanh);

        // Xác định thư mục
        $loaisanpham = LoaiSanPham::find($request->loaisanpham_id);
        $directory = $loaisanpham->tenloai_slug;

        // Xác định tên tập tin
        $file = $request->file('hinhanh');
        $extension = $file->extension();
        $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

        // Upload vào thư mục và trả về đường dẫn
        $path = $file->storeAs($directory, $filename);
    }

    $orm->loaisanpham_id = $request->loaisanpham_id;
    $orm->hangsanxuat_id = $request->hangsanxuat_id;
    $orm->tensanpham = $request->tensanpham;
    $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
    $orm->soluong = $request->soluong;
    $orm->dongia = $request->dongia;
    $orm->hinhanh = $path ?? $orm->hinhanh ?? null;
    $orm->motasanpham = $request->motasanpham;
    $orm->save();

    // Sau khi sửa thành công thì tự động chuyển về trang danh sách
    return redirect()->route('sanpham');
}

public function getXoa($id)
{
    $orm = SanPham::find($id);

    // Lấy đường dẫn ảnh trước khi xóa đối tượng
          $hinhanh = $orm->hinhanh;

          $orm->delete();

          // Xóa tập tin khi xóa dữ liệu
          if($hinhanh) Storage::delete($hinhanh);

          // Sau khi xóa thành công thì tự động chuyển về trang danh sách
          return redirect()->route('sanpham');
     }
 }


 Nội dung bổ sung vào view Danh sách: resources/views/sanpham/danhsach.blade.php
 <table class="table table-bordered table-hover table-sm mb-0">
     <thead>
         <tr>
             <th width="5%">#</th>
             <th width="10%">Hình ảnh</th>
             <th width="15%">Loại sản phẩm</th>
             <th width="10%">HSX</th>
             <th width="35%">Tên sản phẩm</th>
             <th width="5%">SL</th>
             <th width="10%">Đơn giá</th>
             <th width="5%">Sửa</th>
             <th width="5%">Xóa</th>
         </tr>
     </thead>
     <tbody>
         @foreach($sanpham as $value)
             <tr>
                 <td class="align-middle">{{ $loop->iteration }}</td>
                 <td class="align-middle text-center">
                     <img src="{{ asset('storage/app/private/' . $value->hinhanh) }}" width="80" class="img-thumbnail" />
                 </td>
                 <td class="align-middle">{{ $value->LoaiSanPham->tenloai }}</td>
                 <td class="align-middle">{{ $value->HangSanXuat->tenhang }}</td>
                 <td class="align-middle">{{ $value->tensanpham }}</td>
                 <td class="align-middle text-end">{{ $value->soluong }}</td>
                 <td class="align-middle text-end">{{ number_format($value->dongia) }}</td>
                 <td class="align-middle text-center">
                     <a href="{{ route('sanpham.sua', ['id' => $value->id]) }}">
                         <i class="fa-light fa-edit"></i>
                     </a>
                 </td>
                 <td class="align-middle text-center">
                     <a href="{{ route('sanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')">
                         <i class="fa-light fa-trash-alt text-danger"></i>
                     </a>
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>



 Nội dung bổ sung vào view Thêm: resources/views/sanpham/them.blade.php
 <form action="{{ route('sanpham.them') }}" method="post" enctype="multipart/form-data">
     @csrf

    ...

    <div class="mb-3">
        <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
        @error('hinhanh')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    ...

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
 </form>



 Nội dung bổ sung vào view Sửa: resources/views/sanpham/sua.blade.php
 <form action="{{ route('sanpham.sua', ['id' => $sanpham->id]) }}" method="post" enctype="multipart/form-data">
     @csrf

    ...

    <div class="mb-3">
        <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
        @if(!empty($sanpham->hinhanh))
            <img class="d-block rounded img-thumbnail" src="{{ asset('storage/app/private/'. $sanpham->hinhanh) }}" width="100" />
            <span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
        @endif
        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
        @error('hinhanh')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    ...

     <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
 </form>



                               MỞ RỘNG: SỬ DỤNG CKFINDER ĐỂ QUẢN LÝ TẬP TIN – THƯ MỤC
