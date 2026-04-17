<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
use Illuminate\Support\Facades\Auth;

class AdminToppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::user()->role != 'admin') abort(403);
        
        $query = Topping::query();
        if ($request->has('search')) {
            $query->where('nama_topping', 'like', '%' . $request->search . '%');
        }
        $toppings = $query->get();
        return view('admin.topping.index', compact('toppings'));
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') abort(403);
        return view('admin.topping.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') abort(403);

        $request->validate([
            'nama_topping' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $imageName);

        Topping::create([
            'nama_topping' => $request->nama_topping,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $imageName,
            'id_penjual' => 1
        ]);

        return redirect()->route('topping.index')->with('success', 'Topping berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $topping = Topping::findOrFail($id);
        return view('admin.topping.edit', compact('topping'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $topping = Topping::findOrFail($id);

        $request->validate([
            'nama_topping' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $topping->gambar = $imageName;
        }

        $topping->nama_topping = $request->nama_topping;
        $topping->harga = $request->harga;
        $topping->stok = $request->stok;
        $topping->save();

        return redirect()->route('topping.index')->with('success', 'Topping berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        $topping = Topping::findOrFail($id);
        $topping->delete();
        return redirect()->route('topping.index')->with('success', 'Topping dihapus.');
    }
}
