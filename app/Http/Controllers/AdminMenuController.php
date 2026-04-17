<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Penjual;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::user()->role != 'admin') abort(403);
        
        $query = Menu::query();
        
        if ($request->has('search')) {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }
        
        $menus = $query->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') abort(403);
        // hardcode or fetch penjual
        $penjual = Penjual::first();
        if(!$penjual) {
            $penjual = Penjual::create(['nama_penjual' => 'Admin Babeh']);
        }

        return view('admin.menu.create', compact('penjual'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') abort(403);

        $request->validate([
            'nama_menu' => 'required',
            'harga_dasar' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'status' => 'required',
            'is_custom' => 'required|boolean',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $imageName);

        Menu::create([
            'id_penjual' => $request->id_penjual ?? 1,
            'nama_menu' => $request->nama_menu,
            'harga_dasar' => $request->harga_dasar,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'is_custom' => $request->is_custom,
            'gambar' => $imageName
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required',
            'harga_dasar' => 'required|numeric',
            'stok' => 'required|numeric',
            'is_custom' => 'required|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $menu->gambar = $imageName;
        }

        $menu->nama_menu = $request->nama_menu;
        $menu->harga_dasar = $request->harga_dasar;
        $menu->stok = $request->stok;
        $menu->deskripsi = $request->deskripsi;
        $menu->status = $request->status;
        $menu->is_custom = $request->is_custom;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
