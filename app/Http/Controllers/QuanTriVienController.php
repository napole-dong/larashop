<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DonHang;
use App\Models\User;
use App\Models\LoaiSanPham;
use Illuminate\Http\Request;

class QuanTriVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        $stats = [
            'sanpham' => SanPham::count(),
            'donhang' => DonHang::count(),
            'nguoidung' => User::count(),
            'loaisanpham' => LoaiSanPham::count(),
        ];

        $donhangMoi = DonHang::with(['User', 'TinhTrang'])->latest()->take(5)->get();

        return view('admin.home', compact('stats', 'donhangMoi'));
    }
}
