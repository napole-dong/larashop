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
    public function getSua($id)
	{
		$sanpham = SanPham::find($id);
		$loaisanpham = LoaiSanPham::all();
		$hangsanxuat = HangSanXuat::all();
		return view('sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
	}

    public function postThem(Request $request)
    {
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
        if ($request->hasFile('hinhanh')) {
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
        if ($request->hasFile('hinhanh')) {
            // Xóa tập tin cũ
            if ($orm->hinhanh)
                Storage::delete($orm->hinhanh);
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
        if ($orm) {
            $orm->DonHang_ChiTiet()->delete();
            $hinhanh = $orm->hinhanh;
            $orm->delete();
            if ($hinhanh)
                Storage::delete($hinhanh);
        }
        return redirect()->route('sanpham');
    }

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