<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
     public function index()
    {
        $produks = Produk::all(); // pakai variabel plural untuk di-loop di view
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA_PRODUK' => 'required',
            'DESKRIPSI_PRODUK' => 'required',
            'STOK_PRODUK' => 'required|integer',
            'HARGA_PRODUK' => 'required|integer',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function katalog(Request $request)
    {
        $search = $request->input('search');

        $produks = \App\Models\Produk::when($search, function ($query, $search) {
            $query->where('NAMA_PRODUK', 'like', "%{$search}%");
        })
        ->latest('ID_PRODUK')
        ->paginate(12);

        return view('produk.katalog', compact('produks'));
    }

}
