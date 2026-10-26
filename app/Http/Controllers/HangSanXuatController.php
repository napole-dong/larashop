<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HangSanXuat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Imports\HangSanXuatImport;
use App\Exports\HangSanXuatExport;
use Maatwebsite\Excel\Facades\Excel;

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
			'tenhang' => ['required', 'string', 'max:255', 'unique:hangsanxuat,tenhang'],
			'hinhanh' => ['nullable', 'image', 'max:2048'],
		]);

		$path = null;
		if ($request->hasFile('hinhanh')) {
			$file = $request->file('hinhanh');
			$extension = $file->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
			$path = $file->storeAs('hang-san-xuat', $filename);
		}

		$orm = new HangSanXuat();
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		$orm->hinhanh = $path ?? null;
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
			'tenhang' => ['required', 'string', 'max:255', 'unique:hangsanxuat,tenhang,' . $id],
			'hinhanh' => ['nullable', 'image', 'max:2048'],
		]);

		$orm = HangSanXuat::find($id);

		$path = null;
		if ($request->hasFile('hinhanh')) {
			if ($orm->hinhanh) {
				Storage::delete($orm->hinhanh);
			}
			$file = $request->file('hinhanh');
			$extension = $file->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
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
		if ($orm) {
			foreach ($orm->SanPham as $sp) {
				$sp->DonHang_ChiTiet()->delete();
				if ($sp->hinhanh) {
					Storage::delete($sp->hinhanh);
				}
				$sp->delete();
			}
			$hinhanh = $orm->hinhanh;
			if ($hinhanh) {
				Storage::delete($hinhanh);
			}
			$orm->delete();
		}

		return redirect()->route('hangsanxuat');
	}

	// Nhập từ Excel
	public function postNhap(Request $request)
	{
		$request->validate([
			'file_excel' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
		]);

		$import = new HangSanXuatImport();
		Excel::import($import, $request->file('file_excel'));

		return redirect()->route('hangsanxuat');
	}

	// Xuất ra Excel
	public function getXuat()
	{
		$filename = 'hang-san-xuat.xlsx';
		return Excel::download(new HangSanXuatExport(), $filename);
	}
}
