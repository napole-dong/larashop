<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Str;

class DonHangController extends Controller
{
	public function getDanhSach()
	{
		$DonHang = DonHang::all();
		return view('donhang.danhsach', compact('donhang'));
	}

	public function getThem()
	{
		return view('donhang.them');
	}

	public function postThem(Request $request)
	{
		$request->validate([
			'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham'],
		]);
		$orm = new DonHang();
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		$orm->save();

		return redirect()->route('donhang');
	}

	public function getSua($id)
	{
		$DonHang = DonHang::find($id);
		return view('donhang.sua', compact('donhang'));
	}

	public function postSua(Request $request, $id)
	{
		$request->validate([
			'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham,tenloai,' . $id],
		]);
		$orm = DonHang::find($id);
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		$orm->save();

		return redirect()->route('donhang');
	}

	public function getXoa($id)
	{
		$orm = DonHang::find($id);
		$orm->delete();

		return redirect()->route('donhang');
	}
}
