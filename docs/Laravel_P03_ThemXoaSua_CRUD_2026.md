                                                                                   Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                         PHẦN 3: CRUD CODE (CONTROLLERS & VIEWS)
Bước 1: CRUD (Create, Read, Update, Delete) Loại sản phẩm
Đã xây dựng ở Phần 1 và Phần 2.


Bước 2: CRUD (Create, Read, Update, Delete) Hãng sản xuất
Tương tự với Loại sản phẩm.


Bước 3: CRUD (Create, Read, Update, Delete) Tình trạng
Tương tự với Loại sản phẩm.


Bước 4: CRUD Sản phẩm
 Nội dung tập tin Controller: app/Http/Controlles/SanPhamController.php.
Hình ảnh upload xem trong Phần tiếp theo (Phần 4).
 <?php

 namespace App\Http\Controllers;

 use App\Models\SanPham;
 use App\Models\LoaiSanPham;
 use App\Models\HangSanXuat;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;

 class SanPhamController extends Controller
 {
     public function getDanhSach()
     {
         $sanpham = SanPham::all();
         return view('sanpham.danhsach', compact('sanpham'));
     }

     public function getThem()
     {
         $loaisanpham = LoaiSanPham::all();
         $hangsanxuat = HangSanXuat::all();
         return view('sanpham.them', compact('loaisanpham', 'hangsanxuat'));
     }
public function postThem(Request $request)
{
    // Kiểm tra
    $request->validate([
        'loaisanpham_id' => ['required'],
        'hangsanxuat_id' => ['required'],
        'tensanpham' => ['required', 'string', 'max:255', 'unique:sanpham'],
        'soluong' => ['required', 'numeric'],
        'dongia' => ['required', 'numeric'],
        // 'hinhanh' => ['nullable', 'image', 'max:2048'],
    ]);

    $orm = new SanPham();
    $orm->loaisanpham_id = $request->loaisanpham_id;
    $orm->hangsanxuat_id = $request->hangsanxuat_id;
    $orm->tensanpham = $request->tensanpham;
    $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
    $orm->soluong = $request->soluong;
    $orm->dongia = $request->dongia;
    if($request->hasFile('hinhanh')) $orm->hinhanh = $request->hinhanh;
    $orm->motasanpham = $request->motasanpham;
    $orm->save();

    // Sau khi thêm thành công thì tự động chuyển về trang danh sách
    return redirect()->route('sanpham');
}

public function getSua($id)
{
    $sanpham = SanPham::find($id);
    $loaisanpham = LoaiSanPham::all();
    $hangsanxuat = HangSanXuat::all();
    return view('sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
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
        // 'hinhanh' => ['nullable', 'image', 'max:2048'],
    ]);

    $orm = SanPham::find($id);
         $orm->loaisanpham_id = $request->loaisanpham_id;
         $orm->hangsanxuat_id = $request->hangsanxuat_id;
         $orm->tensanpham = $request->tensanpham;
         $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
         $orm->soluong = $request->soluong;
         $orm->dongia = $request->dongia;
         if($request->hasFile('hinhanh')) $orm->hinhanh = $request->hinhanh;
         $orm->motasanpham = $request->motasanpham;
         $orm->save();

         // Sau khi sửa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('sanpham');
    }

    public function getXoa($id)
    {
        $orm = SanPham::find($id);
        $orm->delete();

         // Sau khi xóa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('sanpham');
    }
}


 Nội dung view Danh sách: resources/views/sanpham/danhsach.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Sản phẩm</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('sanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
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
                            <td>{{ $loop->iteration }}</td>
                           <td class="text-center">{{ $value->hinhanh }}</td>
                           <td>{{ $value->LoaiSanPham->tenloai }}</td>
                           <td>{{ $value->HangSanXuat->tenhang }}</td>
                           <td>{{ $value->tensanpham }}</td>
                           <td class="text-end">{{ $value->soluong }}</td>
                           <td class="text-end">{{ number_format($value->dongia) }}</td>
                           <td class="text-center"><a href="{{ route('sanpham.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
                           <td class="text-center"><a href="{{ route('sanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



 Nội dung view Thêm: resources/views/sanpham/them.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Thêm sản phẩm</div>
        <div class="card-body">
            <form action="{{ route('sanpham.them') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="loaisanpham_id">Loại sản phẩm</label>
                    <select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="loaisanpham_id" name="loaisanpham_id" required>
                        <option value="">-- Chọn --</option>
                        @foreach($loaisanpham as $value)
                            <option value="{{ $value->id }}">{{ $value->tenloai }}</option>
                        @endforeach
                    </select>
                    @error('loaisanpham_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="hangsanxuat_id">Hãng sản xuất</label>
                    <select class="form-select @error('hangsanxuat_id') is-invalid @enderror" id="hangsanxuat_id" name="hangsanxuat_id" required>
                        <option value="">-- Chọn --</option>
                        @foreach($hangsanxuat as $value)
                            <option value="{{ $value->id }}">{{ $value->tenhang }}</option>
                        @endforeach
                    </select>
                    @error('hangsanxuat_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tensanpham">Tên sản phẩm</label>
                     <input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham" value="{{ old('tensanpham') }}" required />
                     @error('tensanpham')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="soluong">Số lượng</label>
                     <input type="number" min="0" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong" value="{{ old('soluong') }}" required />
                     @error('soluong')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="dongia">Đơn giá</label>
                     <input type="number" min="0" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ old('dongia') }}" required />
                     @error('dongia')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
                     <input type="text" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ old('hinhanh') }}" />
                     @error('hinhanh')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="motasanpham">Mô tả sản phẩm</label>
                     <textarea class="form-control" id="motasanpham" name="motasanpham">{{ old('motasanpham') }}</textarea>
                 </div>

                 <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
             </form>
         </div>
     </div>
 @endsection



 Nội dung view Sửa: resources/views/sanpham/sua.blade.php
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Sửa sản phẩm</div>
         <div class="card-body">
             <form action="{{ route('sanpham.sua', ['id' => $sanpham->id]) }}" method="post">
                 @csrf

                 <div class="mb-3">
                     <label class="form-label" for="loaisanpham_id">Loại sản phẩm</label>
                     <select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="loaisanpham_id" name="loaisanpham_id" required>
        <option value="">-- Chọn --</option>
        @foreach($loaisanpham as $value)
             <option value="{{ $value->id }}" {{ ($sanpham->loaisanpham_id == $value->id) ? 'selected' : '' }}>{{ $value->tenloai }}</option>
        @endforeach
    </select>
    @error('loaisanpham_id')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="hangsanxuat_id">Hãng sản xuất</label>
    <select class="form-select @error('hangsanxuat_id') is-invalid @enderror" id="hangsanxuat_id" name="hangsanxuat_id" required>
        <option value="">-- Chọn --</option>
        @foreach($hangsanxuat as $value)
             <option value="{{ $value->id }}" {{ ($sanpham->hangsanxuat_id == $value->id) ? 'selected' : '' }}>{{ $value->tenhang }}</option>
        @endforeach
    </select>
    @error('hangsanxuat_id')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="tensanpham">Tên sản phẩm</label>
   <input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham" value="{{ $sanpham->tensanpham }}" required />
    @error('tensanpham')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="soluong">Số lượng</label>
   <input type="number" min="0" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong" value="{{ $sanpham->soluong }}" required />
    @error('soluong')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="dongia">Đơn giá</label>
   <input type="number" min="0" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ $sanpham->dongia }}" required />
    @error('dongia')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
   <input type="text" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ $sanpham->hinhanh }}" />
    @error('hinhanh')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="motasanpham">Mô tả sản phẩm</label>
                     <textarea class="form-control" id="motasanpham" name="motasanpham">{{ $sanpham->motasanpham }}</textarea>
                 </div>

                 <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
             </form>
         </div>
     </div>
 @endsection



Bước 5: CRUD Đơn hàng
 Nội dung tập tin Controller: app/Http/Controlles/DonHangController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\DonHang;
 use App\Models\DonHang_ChiTiet;
 use App\Models\TinhTrang;
 use Illuminate\Http\Request;

 class DonHangController extends Controller
 {
     public function getDanhSach()
     {
         $donhang = DonHang::orderBy('created_at', 'desc')->get();
         return view('donhang.danhsach', compact('donhang'));
     }

     public function getThem()
     {
         // Đặt hàng bên Front-end
     }

     public function postThem(Request $request)
     {
         // Xử lý đặt hàng bên Front-end
     }

     public function getSua($id)
     {
         $donhang = DonHang::find($id);
         $tinhtrang = TinhTrang::all();
         return view('donhang.sua', compact('donhang', 'tinhtrang'));
     }

     public function postSua(Request $request, $id)
     {
         // Kiểm tra
         $request->validate([
             'tinhtrang_id' => ['required'],
             'dienthoaigiaohang' => ['required', 'string', 'max:20'],
             'diachigiaohang' => ['required', 'string', 'max:255'],
         ]);

         $orm = DonHang::find($id);
         $orm->tinhtrang_id = $request->tinhtrang_id;
         $orm->dienthoaigiaohang = $request->dienthoaigiaohang;
         $orm->diachigiaohang = $request->diachigiaohang;
         $orm->save();

         // Sau khi sửa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('donhang');
    }

    public function getXoa($id)
    {
        // Xóa đơn hàng chi tiết
        DonHang_ChiTiet::where('donhang_id', $id)->delete();

         $orm = DonHang::find($id);
         $orm->delete();

         // Sau khi xóa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('donhang');
    }
}


 Nội dung view Danh sách: resources/views/donhang/danhsach.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Đơn hàng</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('donhang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Khách hàng</th>
                        <th width="45%">Thông tin giao hàng</th>
                        <th width="15%">Ngày đặt</th>
                        <th width="10%">Tình trạng</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                 <tbody>
                     @foreach($donhang as $value)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $value->User->name }}</td>
                             <td>
                                 <span class="d-block">Điện thoại: <strong>{{ $value->dienthoaigiaohang }}</strong></span>
                                 <span class="d-block">Địa chỉ: <strong>{{ $value->diachigiaohang }}</strong></span>
                                 <span class="d-block">Sản phẩm:</span>
                                 <table class="table table-bordered table-hover table-sm mb-0">
                                     <thead>
                                         <tr>
                                             <th width="5%">#</th>
                                             <th>Sản phẩm</th>
                                             <th width="5%">SL</th>
                                             <th width="15%">Đơn giá</th>
                                             <th width="20%">Thành tiền</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @php $tongtien = 0; @endphp
                                         @foreach($value->DonHang_ChiTiet as $chitiet)
                                             <tr>
                                                  <td>{{ $loop->iteration }}</td>
                                                  <td>{{ $chitiet->SanPham->tensanpham }}</td>
                                                  <td>{{ $chitiet->soluongban }}</td>
                                                  <td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                                                     <td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                             </tr>
                                             @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
                                         @endforeach
                                         <tr>
                                             <td colspan="4">Tổng tiền sản phẩm:</td>
                                             <td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
                             <td>{{ $value->TinhTrang->tinhtrang }}</td>
                             <td class="text-center"><a href="{{ route('donhang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
                             <td class="text-center"><a href="{{ route('donhang.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa đơn hàng của khách {{ $value->User->name }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>

                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 @endsection



 Nội dung view Sửa: resources/views/donhang/sua.blade.php
 @extends('layouts.app')

 @section('content')
    <div class="card">
        <div class="card-header">Sửa đơn hàng</div>
        <div class="card-body">
            <form action="{{ route('donhang.sua', ['id' => $donhang->id]) }}" method="post">
                @csrf

                 <div class="mb-3">
                     <label class="form-label" for="user_id">Khách hàng</label>
                     <input type="text" class="form-control" id="user" name="user_id" value="{{ $donhang->User->name }}" disabled required />
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="dienthoaigiaohang">Điện thoại giao hàng</label>
                     <input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang" name="dienthoaigiaohang" value="{{ $donhang->dienthoaigiaohang }}" required />
                     @error('dienthoaigiaohang')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="diachigiaohang">Địa chỉ giao hàng</label>
                     <input type="text" class="form-control @error('diachigiaohang') is-invalid @enderror" id="diachigiaohang" name="diachigiaohang" value="{{ $donhang->diachigiaohang }}" required />
                     @error('diachigiaohang')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="tinhtrang_id">Tình trạng đơn hàng</label>
                     <select class="form-select @error('tinhtrang_id') is-invalid @enderror" id="tinhtrang_id" name="tinhtrang_id" required>
                         <option value="">-- Chọn --</option>
                         @foreach($tinhtrang as $value)
                                 <option value="{{ $value->id }}" {{ ($donhang->tinhtrang_id == $value->id) ? 'selected' : '' }}>{{ $value->tinhtrang }}</option>
                         @endforeach
                     </select>
                     @error('tinhtrang_id')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
             </form>
         </div>
     </div>
 @endsection



Bước 6: CRUD Tài khoản người dùng
 Nội dung tập tin Controller: app/Http/Controlles/UserController.php
 <?php

 namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $nguoidung = User::all();
        return view('nguoidung.danhsach', compact('nguoidung'));
    }

   public function getThem()
   {
       return view('nguoidung.them');
   }

   public function postThem(Request $request)
   {
       // Kiểm tra
       $request->validate([
           'name' => ['required', 'string', 'max:100'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'role' => ['required'],
           'password' => ['required', 'min:4', 'confirmed'],
       ]);

        $orm = new User();
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->role = $request->role;
        $orm->save();

        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('nguoidung');
   }

   public function getSua($id)
   {
       $nguoidung = User::find($id);
       return view('nguoidung.sua', compact('nguoidung'));
   }

   public function postSua(Request $request, $id)
   {
       // Kiểm tra
         $request->validate([
             'name' => ['required', 'string', 'max:100'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
             'role' => ['required'],
             'password' => ['confirmed'],
         ]);

         $orm = User::find($request->id);
         $orm->name = $request->name;
         $orm->username = Str::before($request->email, '@');
         $orm->email = $request->email;
         $orm->role = $request->role;
         if(!empty($request->password)) $orm->password = Hash::make($request->password);
         $orm->save();

         // Sau khi sửa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('nguoidung');
    }

    public function getXoa($id)
    {
        $orm = User::find($id);
        $orm->delete();

         // Sau khi xóa thành công thì tự động chuyển về trang danh sách
         return redirect()->route('nguoidung');
    }
}


 Nội dung view Danh sách: resources/views/nguoidung/danhsach.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Người dùng</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('nguoidung.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Họ và tên</th>
                        <th width="20%">Tên đăng nhập</th>
                        <th width="35%">Email</th>
                        <th width="10%">Quyền hạn</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($nguoidung as $value)
                       <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $value->name }}</td>
                           <td>{{ $value->username }}</td>
                           <td>{{ $value->email }}</td>
                           <td>{{ $value->role }}</td>
                           <td class="text-center"><a href="{{ route('nguoidung.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
                            <td class="text-center"><a href="{{ route('nguoidung.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa người dùng {{ $value->name }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



 Nội dung view Thêm: resources/views/nguoidung/them.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Thêm người dùng</div>
        <div class="card-body">
            <form action="{{ route('nguoidung.them') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
                    @error('name')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Địa chỉ email</label>
                   <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="role">Quyền hạn</label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">-- Chọn --</option>
                        <option value="admin">Quản trị viên</option>
                        <option value="user" selected>Khách hàng</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                 <div class="mb-3">
                     <label class="form-label" for="password">Mật khẩu mới</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
                     @error('password')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                     <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
                     @error('password_confirmation')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <button type="submit" class="btn btn-primary"><i class="fa-light fa-user-plus"></i> Thêm người dùng</button>
             </form>
         </div>
     </div>
 @endsection



 Nội dung view Sửa: resources/views/nguoidung/sua.blade.php
 @extends('layouts.app')

 @section('content')
     <div class="card">
         <div class="card-header">Sửa người dùng</div>
         <div class="card-body">
             <form action="{{ route('nguoidung.sua', ['id' => $nguoidung->id]) }}" method="post">
                 @csrf

                 <div class="mb-3">
                     <label class="form-label" for="name">Họ và tên</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $nguoidung->name }}" required />
                     @error('name')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="email">Địa chỉ email</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $nguoidung->email }}" required />
                     @error('email')
                         <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <label class="form-label" for="role">Quyền hạn</label>
                     <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                         <option value="">-- Chọn --</option>
                         <option value="admin" {{ ($nguoidung->role == 'admin') ? 'selected' : '' }}>Quản trị viên</option>
                        <option value="user" {{ ($nguoidung->role == 'user') ? 'selected' : '' }}>Khách hàng</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="change_password_checkbox" name="change_password_checkbox" />
                    <label class="form-check-label" for="change_password_checkbox">Đổi mật khẩu</label>
                </div>

                <div id="change_password_group">
                    <div class="mb-3">
                        <label class="form-label" for="password">Mật khẩu mới</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                        @error('password')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                       <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" />
                        @error('password_confirmation')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#change_password_group").hide();
            $("#change_password_checkbox").change(function() {
                if($(this).is(":checked"))
                {
                    $("#change_password_group").show();
                    $("#change_password_group :input").attr("required", "required");
                }
                else
                {
                    $("#change_password_group").hide();
                    $("#change_password_group :input").removeAttr("required");
                }
            });
        });
    </script>
@endsection
