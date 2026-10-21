<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $orm = new User();
        $orm->name = $request->name;
        $orm->email = $request->email;
        $orm->username = $request->username;
        $orm->role = $request->role;
        $orm->password = Hash::make($request->password);
        $orm->save();

        return redirect()->route('nguoidung');
    }

    public function getSua($id)
    {
        $nguoidung = User::findOrFail($id);
        return view('nguoidung.sua', compact('nguoidung'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . $id],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $orm = User::findOrFail($id);
        $orm->name = $request->name;
        $orm->email = $request->email;
        $orm->username = $request->username;
        $orm->role = $request->role;
        if (!empty($request->password)) {
            $orm->password = Hash::make($request->password);
        }
        $orm->save();

        return redirect()->route('nguoidung');
    }

    public function getXoa($id)
    {
        $orm = User::findOrFail($id);
        $orm->delete();

        return redirect()->route('nguoidung');
    }
}
