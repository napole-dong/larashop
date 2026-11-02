<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            return view('user.home', compact('user'));
        } else {
            return redirect()->route('user.dangnhap');
        }
    }

    public function getDatHang()
    {
        return view('user.dathang');
    }

    public function postDatHang(Request $request)
    {
        return redirect()->route('user.dathangthanhcong');
    }

    public function getDatHangThanhCong()
    {
        return view('user.dathangthanhcong');
    }

    public function getDonHang($id = '')
    {
        return view('user.donhang');
    }

    public function postDonHang(Request $request, $id)
    {
    }

    public function getHoSo()
    {
        return redirect()->route('user.home');
    }

    public function getDoiMatKhau()
    {
        return redirect()->route('user.home');
    }

    public function postHoSo(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->save();

        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    }

    public function postDoiMatKhau(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::findOrFail(Auth::user()->id ?? 0);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('user.home')->with('success', 'Đổi mật khẩu thành công.');
        } else {
            return redirect()->route('user.home')->with('warning', 'Mật khẩu cũ không chính xác.');
        }
    }

    public function postDangXuat(Request $request)
    {
        Auth::logout();
        return redirect()->route('frontend.home');
    }
}
