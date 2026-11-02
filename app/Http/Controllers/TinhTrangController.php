<?php

namespace App\Http\Controllers;

use App\Models\TinhTrang;
use Illuminate\Http\Request;

class TinhTrangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $tinhtrang = TinhTrang::paginate(25);
        return view('admin.tinhtrang.danhsach', compact('tinhtrang'));
    }

    public function getThem()
    {
        return view('admin.tinhtrang.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tinhtrang' => ['required', 'string', 'max:255', 'unique:tinhtrang,tinhtrang'],
        ]);

        $orm = new TinhTrang();
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();

        return redirect()->route('admin.tinhtrang');
    }

    public function getSua($id)
    {
        $tinhtrang = TinhTrang::findOrFail($id);
        return view('admin.tinhtrang.sua', compact('tinhtrang'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tinhtrang' => ['required', 'string', 'max:255', 'unique:tinhtrang,tinhtrang,' . $id],
        ]);

        $orm = TinhTrang::findOrFail($id);
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();

        return redirect()->route('admin.tinhtrang');
    }

    public function getXoa($id)
    {
        $orm = TinhTrang::findOrFail($id);
        $orm->delete();

        return redirect()->route('admin.tinhtrang');
    }
}
