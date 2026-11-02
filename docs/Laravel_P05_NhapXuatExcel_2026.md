                                                                                                                  Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                                           PHẦN 5: NHẬP – XUẤT EXCEL
Bước 1: Cài đặt gói Laravel Excel
Link: https://laravel-excel.com
Cài đặt gói maatwebsite/excel theo hướng dẫn trong link:
https://docs.laravel-excel.com/4.x/getting-started/installation.html


Lệnh cài: Chuyển dấu nhắc tới thư mục gốc ...\www\larashop> và gõ lệnh:
 composer require maatwebsite/excel


Chạy lệnh để tạo tập tin cấu hình trong thư mục config.
 php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config



Bước 2: “Mass assignment” là gì?
Đọc thêm: https://laravel.com/docs/master/eloquent#mass-assignment
Mass assignment nghĩa là thêm hàng loạt, bình thường khi thêm dữ liệu từ form, người dùng chỉ thêm lần lượt từng dòng một. Nhưng khi nhập dữ liệu từ
bên ngoài vào (Excel, CSV, XML, JSON,…) nó sẽ được thêm hàng loạt vào CSDL.
Vì lý do bảo mật, Laravel mặc định tắt tính năng thêm hàng loạt. Để bật chức năng này, người dùng cần phải cài đặt vào các tập tin models nằm ở thư mục
app/Models bằng thuộc tính fillable.


Ví dụ:
 <?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;

 class SanPham extends Model
 {
     protected $table = 'sanpham';

     protected $fillable = [
         'loaisanpham_id',
          'hangsanxuat_id',
          'tensanpham',
          'tensanpham_slug',
          'soluong',
          'dongia',
          'hinhanh',
          'motasanpham',
     ];

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
Như vậy, nếu bảng nào cần thêm hàng loạt dữ liệu thì phải cài đặt thêm thuộc tính fillable vào models của bảng đó.


Bước 3: Thiết lập routes cho hành động nhập – xuất.
Bổ sung code trong tập tin routes/web.php.
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

 ...



Bước 4: Các bước nhập dữ liệu từ Excel
 Chuẩn bị tập tin Excel có dữ liệu là các trường cần nhập vào.
- Trường hợp 1: Tập tin Excel không có tiêu đề




- Trường hợp 2: Tập tin Excel có tiêu đề có dấu




- Trường hợp 3: Tập tin Excel có tiêu đề không dấu và trùng với các cột của CSDL
- Trường hợp 4: Dữ liệu nhập không bắt đầu từ dòng đầu tiên trong bảng tính




Lưu ý: Nếu các ô ở dạng trộn nhiều ô (merge cells), phải xử lý để cho các ô là đơn nhất, không còn trạng thái trộn ô.


 Chạy lệnh artisan từ dấu nhắc …\www\larashop>
 php artisan make:import SanPhamImport --model=SanPham
Tập tin SanPhamImport.php sẽ được tạo trong thư mục app/Imports.


 Cài đặt tập tin SanPhamImport.php
- Trường hợp 1: Tập tin Excel không có tiêu đề
 <?php

 namespace App\Imports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\ToModel;

 class SanPhamImport implements ToModel
 {
     public function model(array $row)
     {
         return new SanPham([
             'loaisanpham_id' => $row[0],
             'hangsanxuat_id' => $row[1],
                'tensanpham' => $row[2],
                'tensanpham_slug' => $row[3],
                'soluong' => $row[4],
                'dongia' => $row[5],
                'hinhanh' => $row[6],
          ]);
     }
 }
Bắt đầu từ trái qua là cột thứ 0, rồi thứ 1,…


- Trường hợp 2: Tập tin Excel có tiêu đề có dấu
 <?php

 namespace App\Imports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\ToModel;
 use Maatwebsite\Excel\Concerns\WithHeadingRow;

 class SanPhamImport implements ToModel, WithHeadingRow
 {
     public function model(array $row)
     {
         return new SanPham([
             'loaisanpham_id' => $row['ma_loai'],
             'hangsanxuat_id' => $row['ma_hang_san_xuat'],
             'tensanpham' => $row['ten_san_pham'],
             'tensanpham_slug' => $row['ten_san_pham_khong_dau'],
             'soluong' => $row['so_luong'],
             'dongia' => $row['don_gia'],
             'hinhanh' => $row['hinh_anh'],
         ]);
     }
 }
Tiêu đề có dấu sẽ tự động chuyển thành chữ thường không dấu (slug) và khoảng trắng được thay thế bởi dấu gạch dưới _


- Trường hợp 3: Tập tin Excel có tiêu đề không dấu và trùng với các cột của CSDL
 <?php

 namespace App\Imports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\ToModel;
 use Maatwebsite\Excel\Concerns\WithHeadingRow;
 class SanPhamImport implements ToModel, WithHeadingRow
 {
     public function model(array $row)
     {
         return new SanPham([
             'loaisanpham_id' => $row['loaisanpham_id'],
             'hangsanxuat_id' => $row['hangsanxuat_id'],
             'tensanpham' => $row['tensanpham'],
             'tensanpham_slug' => $row['tensanpham_slug'],
             'soluong' => $row['soluong'],
             'dongia' => $row['dongia'],
             'hinhanh' => $row['hinhanh'],
         ]);
     }
 }
Trường hợp 3 giống Trường hợp 2 nhưng tiêu đề không cần slug.


Lưu ý cho trường hợp này:
Nếu các cột trong CSDL viết hoa thì phải chuyển thành thường hoặc cài thêm HeadingRowFormatter.
 <?php

 namespace App\Imports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\ToModel;
 use Maatwebsite\Excel\Concerns\WithHeadingRow;
 use Maatwebsite\Excel\Imports\HeadingRowFormatter;

 HeadingRowFormatter::default('none');

 class SanPhamImport implements ToModel, WithHeadingRow
 {
     public function model(array $row)
     {
         return new SanPham([
             'loaisanpham_id' => $row['LoaiSanPham_ID'],
             'hangsanxuat_id' => $row['HangSanXuat_ID'],
             'tensanpham' => $row['TenSanPham'],
             'tensanpham_slug' => $row['TenSanPham_Slug'],
             'soluong' => $row['SoLuong'],
             'dongia' => $row['DonGia'],
             'hinhanh' => $row['HinhAnh'],
         ]);
     }
 }
- Trường hợp 4: Dữ liệu nhập không bắt đầu từ dòng đầu tiên trong bảng tính
 <?php

 namespace App\Imports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\ToModel;
 use Maatwebsite\Excel\Concerns\WithHeadingRow;

 class SanPhamImport implements ToModel, WithHeadingRow
 {
     public function model(array $row)
     {
         return new SanPham([
             'loaisanpham_id' => $row['ma_loai'],
             'hangsanxuat_id' => $row['ma_hang_san_xuat'],
             'tensanpham' => $row['ten_san_pham'],
             'tensanpham_slug' => $row['ten_san_pham_khong_dau'],
             'soluong' => $row['so_luong'],
             'dongia' => $row['don_gia'],
             'hinhanh' => $row['hinh_anh'],
         ]);
     }

     public function headingRow(): int
     {
         return 6;
     }
 }


 Cài đặt view resources/views/sanpham/danhsach.blade.php
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Sản phẩm</div>
         <div class="card-body table-responsive">
             <p>
                 <a href="{{ route('sanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
                 <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fa-light fa-upload"></i> Nhập từ Excel</a>
                 <a href="{{ route('sanpham.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
             </p>
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
    </div>
</div>

<form action="{{ route('sanpham.nhap') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-0">
                        <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                        <input type="file" class="form-control @error('file_excel') is-invalid @enderror" id="file_excel" name="file_excel" required />
                        @error('file_excel')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-light fa-times"></i> Hủy bỏ</button>
                         <button type="submit" class="btn btn-danger"><i class="fa-light fa-upload"></i> Nhập dữ liệu</button>
                     </div>
                 </div>
             </div>
         </div>
     </form>
 @endsection

 @section('javascript')
     @error('file_excel')
         <script>
             const importModal = new bootstrap.Modal(document.getElementById('importModal'));
             importModal.show();
         </script>
     @enderror
 @endsection



Giao diện Danh sách sản phẩm:
Khi nhấn vào nút “Nhập từ Excel” sẽ hiện ra 1 modal, chọn tập tin và gởi bằng phương thức POST.




 Cài đặt SanPhamController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\SanPham;
 use App\Models\LoaiSanPham;
 use App\Models\HangSanXuat;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;
 use App\Imports\SanPhamImport;
 use Maatwebsite\Excel\Facades\Excel;

 class SanPhamController extends Controller
 {
     ...

     // Nhập từ Excel
     public function postNhap(Request $request)
     {
         $request->validate([
             'file_excel' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
         ]);

         $import = new SanPhamImport();
         Excel::import($import, $request->file('file_excel'));

         return redirect()->route('sanpham');
     }
 }



Bước 5: Các bước xuất dữ liệu ra Excel
 Chạy lệnh artisan từ dấu nhắc …\www\larashop>
 php artisan make:export SanPhamExport --model=SanPham
Tập tin SanPhamExport.php sẽ được tạo trong thư mục app/ Exports.


 Cài đặt tập tin SanPhamExport.php
 <?php

 namespace App\Exports;

 use App\Models\SanPham;
 use Maatwebsite\Excel\Concerns\FromCollection;
 use Maatwebsite\Excel\Concerns\WithHeadings;
 use Maatwebsite\Excel\Concerns\WithCustomStartCell;
 use Maatwebsite\Excel\Concerns\WithMapping;

 class SanPhamExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
 {
     public function headings(): array
     {
         return [
             'loaisanpham_id',
             'hangsanxuat_id',
             'tensanpham',
             'tensanpham_slug',
             'soluong',
             'dongia',
             'hinhanh',
         ];
     }

     public function map($row): array
     {
         return [
             $row->loaisanpham_id,
             $row->hangsanxuat_id,
             $row->tensanpham,
             $row->tensanpham_slug,
             $row->soluong,
             $row->dongia,
             $row->hinhanh,
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {
        return SanPham::all();
    }
}


 Cài đặt SanPhamController.php
<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Imports\SanPhamImport;
use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel;

class SanPhamController extends Controller
{
    ...

    // Nhập từ Excel
    public function postNhap(Request $request)
    {
        $request->validate([
            'file_excel' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
        ]);

        $import = new SanPhamImport();
        Excel::import($import, $request->file('file_excel'));

        return redirect()->route('sanpham');
    }
     // Xuất ra Excel
     public function getXuat()
     {
         $filename = 'san-pham.xlsx';
         return Excel::download(new SanPhamExport(), $filename);
     }
 }


Sinh viên đọc thêm tài liệu để xem thêm về trang trí (chèn logo, kẻ khung, tô nền, thiết lập công thức,…).


                     MỞ RỘNG: PHÂN TRANG SỬ DỤNG LARAVEL PAGINATION VÀ DATATABLES.JS
