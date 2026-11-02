<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        return view('frontend.home');
    }

    public function getSanPham($tenloai_slug = '')
    {
        return view('frontend.sanpham');
    }

    public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
    {
        return view('frontend.sanpham_chitiet');
    }

    public function getBaiViet($tenchude_slug = '')
    {
        return view('frontend.baiviet');
    }

    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
    {
        return view('frontend.baiviet_chitiet');
    }

    public function getGioHang()
    {
        return view('frontend.giohang');
    }

    public function getGioHang_Them($tensanpham_slug = '')
    {
        return redirect()->route('frontend.home');
    }

    public function getGioHang_Xoa($row_id)
    {
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Giam($row_id)
    {
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
        return redirect()->route('frontend.giohang');
    }

    public function getTuyenDung()
    {
        return view('frontend.tuyendung');
    }

    public function getLienHe()
    {
        return view('frontend.lienhe');
    }

    public function getDangKy()
    {
        return view('user.dangky');
    }

    public function getDangNhap()
    {
        return view('user.dangnhap');
    }
}
