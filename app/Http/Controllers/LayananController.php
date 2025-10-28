<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA_LAYANAN' => 'required|string|max:100',
            'DESKRIPSI_LAYANAN' => 'required|string|max:255',
            'GAMBAR_LAYANAN' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'HARGA_LAYANAN' => 'required|numeric',
        ]);

        $path = null;
        if ($request->hasFile('GAMBAR_LAYANAN')) {
            $path = $request->file('GAMBAR_LAYANAN')->store('layanan', 'public');
        }

        Layanan::create([
            'NAMA_LAYANAN' => $request->NAMA_LAYANAN,
            'DESKRIPSI_LAYANAN' => $request->DESKRIPSI_LAYANAN,
            'GAMBAR_LAYANAN' => $path,
            'HARGA_LAYANAN' => $request->HARGA_LAYANAN,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
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

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
