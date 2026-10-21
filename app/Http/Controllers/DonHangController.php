<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\User;
use App\Models\TinhTrang;

class DonHangController extends Controller
{
	public function getDanhSach()
	{
		$donhang = DonHang::with(['User', 'TinhTrang'])->latest()->get();
		return view('donhang.danhsach', compact('donhang'));
	}

	public function getThem()
	{
		$user = User::all();
		$tinhtrang = TinhTrang::all();
		return view('donhang.them', compact('user', 'tinhtrang'));
	}

	public function postThem(Request $request)
	{
		$request->validate([
			'user_id' => ['required', 'exists:users,id'],
			'tinhtrang_id' => ['required', 'exists:tinhtrang,id'],
			'dienthoaigiaohang' => ['required', 'string', 'max:20'],
			'diachigiaohang' => ['required', 'string', 'max:255'],
		]);

		$orm = new DonHang();
		$orm->user_id = $request->user_id;
		$orm->tinhtrang_id = $request->tinhtrang_id;
		$orm->dienthoaigiaohang = $request->dienthoaigiaohang;
		$orm->diachigiaohang = $request->diachigiaohang;
		$orm->save();

		return redirect()->route('donhang');
	}

	public function getSua($id)
	{
		$donhang = DonHang::findOrFail($id);
		$user = User::all();
		$tinhtrang = TinhTrang::all();
		return view('donhang.sua', compact('donhang', 'user', 'tinhtrang'));
	}

	public function postSua(Request $request, $id)
	{
		$request->validate([
			'user_id' => ['required', 'exists:users,id'],
			'tinhtrang_id' => ['required', 'exists:tinhtrang,id'],
			'dienthoaigiaohang' => ['required', 'string', 'max:20'],
			'diachigiaohang' => ['required', 'string', 'max:255'],
		]);

		$orm = DonHang::findOrFail($id);
		$orm->user_id = $request->user_id;
		$orm->tinhtrang_id = $request->tinhtrang_id;
		$orm->dienthoaigiaohang = $request->dienthoaigiaohang;
		$orm->diachigiaohang = $request->diachigiaohang;
		$orm->save();

		return redirect()->route('donhang');
	}

	public function getXoa($id)
	{
		$orm = DonHang::findOrFail($id);
		$orm->delete();

		return redirect()->route('donhang');
	}
}
