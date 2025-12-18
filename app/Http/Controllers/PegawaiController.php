<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pegawais = Pegawai::when($search, function ($query, $search) {
            $query->where('NAMA_PEGAWAI', 'like', "%{$search}%");
        })->get();

        return view('owner.pegawai.index', compact('pegawais'));
    }

    // Form tambah pegawai
    public function create()
    {
        return view('owner.pegawai.create');
    }

    // ==========================
    // SIMPAN PEGAWAI BARU
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'ID_JABATAN' => 'required|integer',
            'NAMA_PEGAWAI' => 'required|string|max:100',
            'ALAMAT_PEGAWAI' => 'required|string',
            'TGL_LAHIR_PEGAWAI' => 'required|date',
            'NOMOR_TELEPON_PEGAWAI' => [
                'required',
                'digits_between:10,12',
                'regex:/^[0-9]+$/',
            ],
            'USERNAME' => 'required|string|max:50|unique:pegawai,USERNAME',
            'PASSWORD' => 'required|string|min:6',
        ]);

        Pegawai::create([
            'ID_JABATAN' => $request->ID_JABATAN,
            'NAMA_PEGAWAI' => $request->NAMA_PEGAWAI,
            'ALAMAT_PEGAWAI' => $request->ALAMAT_PEGAWAI,
            'TGL_LAHIR_PEGAWAI' => $request->TGL_LAHIR_PEGAWAI,
            'NOMOR_TELEPON_PEGAWAI' => $request->NOMOR_TELEPON_PEGAWAI,
            'USERNAME' => $request->USERNAME,
            'PASSWORD' => Hash::make($request->PASSWORD), // ✅ HASH WAJIB
        ]);

        return redirect()
            ->route('owner.pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('owner.pegawai.edit', compact('pegawai'));
    }

    // ==========================
    // UPDATE PEGAWAI
    // ==========================
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'ID_JABATAN' => 'required|integer',
            'NAMA_PEGAWAI' => 'required|string|max:100',
            'ALAMAT_PEGAWAI' => 'required|string',
            'TGL_LAHIR_PEGAWAI' => 'required|date',
            'NOMOR_TELEPON_PEGAWAI' => [
                'required',
                'digits_between:10,12',
                'regex:/^[0-9]+$/',
            ],
            'USERNAME' => 'required|string|max:50|unique:pegawai,USERNAME,' . $pegawai->ID_PEGAWAI . ',ID_PEGAWAI',
            'PASSWORD' => 'nullable|string|min:6', // ✅ BOLEH KOSONG
        ]);

        $data = [
            'ID_JABATAN' => $request->ID_JABATAN,
            'NAMA_PEGAWAI' => $request->NAMA_PEGAWAI,
            'ALAMAT_PEGAWAI' => $request->ALAMAT_PEGAWAI,
            'TGL_LAHIR_PEGAWAI' => $request->TGL_LAHIR_PEGAWAI,
            'NOMOR_TELEPON_PEGAWAI' => $request->NOMOR_TELEPON_PEGAWAI,
            'USERNAME' => $request->USERNAME,
        ];

        // ✅ HASH HANYA JIKA PASSWORD DIISI
        if ($request->filled('PASSWORD')) {
            $data['PASSWORD'] = Hash::make($request->PASSWORD);
        }

        $pegawai->update($data);

        return redirect()
            ->route('owner.pegawai.index')
            ->with('success', 'Pegawai berhasil diperbarui!');
    }

    // Arsip pegawai (soft delete)
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()
            ->route('owner.pegawai.index')
            ->with('success', 'Pegawai diarsipkan.');
    }
}
