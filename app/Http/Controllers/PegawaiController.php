<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all(); // pakai plural biar konsisten di view
        return view('pegawai.index', compact('pegawais'));
    }

    // Form tambah pegawai baru
    public function create()
    {
        return view('pegawai.create');
    }

    // Simpan data pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'ID_JABATAN' => 'required|integer',
            'NAMA_PEGAWAI' => 'required|string|max:100',
            'ALAMAT_PAGAWAI' => 'required|string',
            'TGL_LAHIR_PEGAWAI' => 'required|date',
            'NOMOR_TELEPON_PEGAWAI' => 'required|string|max:20',
            'USERNAME' => 'required|string|max:50',
            'PASSWORD' => 'required|string|max:255',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    // Form edit pegawai
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    // Update data pegawai
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'ID_JABATAN' => 'required|integer',
            'NAMA_PEGAWAI' => 'required|string|max:100',
            'ALAMAT_PAGAWAI' => 'required|string',
            'TGL_LAHIR_PEGAWAI' => 'required|date',
            'NOMOR_TELEPON_PEGAWAI' => 'required|string|max:20',
            'USERNAME' => 'required|string|max:50',
            'PASSWORD' => 'required|string|max:255',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui!');
    }

    // Hapus data pegawai
    public function destroy($id)
    {
        Pegawai::destroy($id);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus!');
    }
}
