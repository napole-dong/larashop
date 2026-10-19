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
    public function getDanhSach()
	{
		$sanpham = SanPham::all();
		return view('sanpham.danhsach', compact('sanpham'));
	}
    public function getThem()
	{
		return view('sanpham.them');
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
        // Lấy đường dẫn ảnh trước khi xóa đối tượng 
        $hinhanh = $orm->hinhanh;
        $orm->delete();
        // Xóa tập tin khi xóa dữ liệu
        if ($hinhanh)
            Storage::delete($hinhanh);
        // Sau khi xóa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('sanpham');
    }
}