<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;


class LayananController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $layanans = Layanan::when($search, function ($query, $search) {
            $query->where('NAMA_LAYANAN', 'like', "%{$search}%");
        })->get();

        return view('owner.layanan.index', compact('layanans'));
    }


    public function create()
    {
        return view('owner.layanan.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'NAMA_LAYANAN' => 'required',
        'DESKRIPSI_LAYANAN' => 'required',
        'HARGA_LAYANAN' => 'required|integer',
        'GAMBAR_LAYANAN' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('GAMBAR_LAYANAN')) {
        // simpan file di folder storage/app/public/produk
        $path = $request->file('GAMBAR_LAYANAN')->store('layanan', 'public');
    }

    Layanan::create([
        'NAMA_LAYANAN' => $request->NAMA_LAYANAN,
        'DESKRIPSI_LAYANAN' => $request->DESKRIPSI_LAYANAN,
        'HARGA_LAYANAN' => $request->HARGA_LAYANAN,
        'GAMBAR_LAYANAN' => $path, // simpan path file ke database
    ]);

    return redirect()->route('owner.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan)
    {
        return view('owner.layanan.edit', compact('layanan'));
    }

   public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'NAMA_LAYANAN' => 'required|string|max:100',
            'DESKRIPSI_LAYANAN' => 'required|string|max:255',
            'GAMBAR_LAYANAN' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'HARGA_LAYANAN' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('GAMBAR_LAYANAN')) {
            $data['GAMBAR_LAYANAN'] = $request->file('GAMBAR_LAYANAN')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()->route('owner.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete(); // hanya menandai deleted_at, tidak menghapus di database
        return redirect()->route('owner.layanan.index')->with('success', 'Layanan diarsipkan.');
    }
    

    public function katalog(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort'); 

        $layanans = \App\Models\Layanan::query()
            ->when($search, function ($query, $search) {
                $query->where('NAMA_LAYANAN', 'like', "%{$search}%");
            })
            ->when($sort, function ($query) use ($sort) {
                if ($sort === 'harga_asc') {
                    $query->orderBy('HARGA_LAYANAN', 'asc');
                }
                if ($sort === 'harga_desc') {
                    $query->orderBy('HARGA_LAYANAN', 'desc');
                }
            })
            ->latest('ID_LAYANAN')
            ->paginate(8)
            ->appends(request()->query()); 

        return view('owner.layanan.katalog', compact('layanans', 'search', 'sort'));
    }


    public function show($id)
    {
        $layanan = \App\Models\Layanan::findOrFail($id);
        return view('owner.layanan.show', compact('layanan'));
    }

}
