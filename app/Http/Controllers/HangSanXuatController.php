<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HangSanXuat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class HangSanXuatController extends Controller
{
	public function getDanhSach()
	{
		$hangsanxuat = HangSanXuat::all();
		return view('hangsanxuat.danhsach', compact('hangsanxuat'));
	}

	public function getThem()
	{
		return view('hangsanxuat.them');
	}

	public function postThem(Request $request)
	{
		$request->validate([
			'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham'],
		]);
		$path = null;
		if ($request->hasFile('hinhanh')) {
			// Xác định tên tập tin
			$file = $request->file('hinhanh');
			$extension = $file->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
			// Upload vào thư mục 'hang-san-xuat' và trả về đường dẫn
			$path = $file->storeAs('hang-san-xuat', $filename);
		}
		$orm = new HangSanXuat();
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		$orm->save();

		return redirect()->route('hangsanxuat');
	}

	public function getSua($id)
	{
		$hangsanxuat = HangSanXuat::find($id);
		return view('hangsanxuat.sua', compact('hangsanxuat'));
	}

	public function postSua(Request $request, $id)
	{
		$request->validate([
			'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham,tenloai,' . $id],
		]);

		$orm = HangSanXuat::find($id);
		$path = null;
		if ($request->hasFile('hinhanh')) {
			// Xác định tên tập tin
			$file = $request->file('hinhanh');
			$extension = $file->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
			// Upload vào thư mục 'hang-san-xuat' và trả về đường dẫn
			$path = $file->storeAs('hang-san-xuat', $filename);
		}
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		$orm->hinhanh = $path ?? $orm->hinhanh ?? null;
		$orm->save();

		return redirect()->route('hangsanxuat');
	}

	public function getXoa($id)
	{
		$orm = HangSanXuat::find($id);
		$hinhanh = $orm->hinhanh;
		if($hinhanh) Storage::delete($hinhanh);
		$orm->delete();

		return redirect()->route('hangsanxuat');
	}
}
