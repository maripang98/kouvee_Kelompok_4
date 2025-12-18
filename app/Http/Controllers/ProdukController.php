<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::when($search, function ($query, $search) {
            $query->where('NAMA_PRODUK', 'like', "%{$search}%");
        })->get();

        return view('owner.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('owner.produk.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'NAMA_PRODUK' => 'required',
        'DESKRIPSI_PRODUK' => 'required',
        'STOK_PRODUK' => 'required|integer',
        'HARGA_PRODUK' => 'required|integer',
        'GAMBAR_PRODUK' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('GAMBAR_PRODUK')) {
        // simpan file di folder storage/app/public/produk
        $path = $request->file('GAMBAR_PRODUK')->store('produk', 'public');
    }

    Produk::create([
        'NAMA_PRODUK' => $request->NAMA_PRODUK,
        'DESKRIPSI_PRODUK' => $request->DESKRIPSI_PRODUK,
        'STOK_PRODUK' => $request->STOK_PRODUK,
        'HARGA_PRODUK' => $request->HARGA_PRODUK,
        'GAMBAR_PRODUK' => $path, // simpan path file ke database
    ]);

    return redirect()->route('owner.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('owner.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('owner.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete(); // hanya menandai deleted_at, tidak menghapus di database
        return redirect()->route('owner.produk.index')->with('success', 'Produk diarsipkan.');
    }

    public function katalog(Request $request)
    {
        $search = $request->input('search');
        $sort   = $request->input('sort'); // NEW — menangkap pilihan sorting

        $produks = \App\Models\Produk::query()
            ->when($search, function ($query, $search) {
                return $query->where('NAMA_PRODUK', 'like', "%{$search}%");
            })
            ->when($sort == 'harga_asc', function ($query) {
                return $query->orderBy('HARGA_PRODUK', 'asc');
            })
            ->when($sort == 'harga_desc', function ($query) {
                return $query->orderBy('HARGA_PRODUK', 'desc');
            })
            ->when(!$sort, function ($query) {
                return $query->latest('ID_PRODUK');
            })

            ->paginate(12)
            ->appends(['search' => $search, 'sort' => $sort]); 

        return view('owner.produk.katalog', compact('produks'));
    }


    public function show($id)
    {
        $produk = Produk::findOrFail($id); // Ambil produk berdasarkan ID
        return view('owner.produk.show', compact('produk')); // Kirim ke view
    }


}
