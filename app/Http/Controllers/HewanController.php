<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Customer;

class HewanController extends Controller
{
    public function index()
    {
        $hewans = Hewan::with('customer')->get();
        return view('hewan.index', compact('hewans'));
    }

    // Form tambah hewan baru
    public function create()
    {
        $customers = Customer::all(); // ambil daftar owner (customer)
        return view('hewan.create', compact('customers'));
    }

    // Simpan data hewan baru
    public function store(Request $request)
    {
        $request->validate([
            'ID_CUSTOMER' => 'required|exists:customer,ID_CUSTOMER', // pastikan owner ada
            'NAMA_HEWAN' => 'required|string|max:100',
            'TGL_LAHIR_HEWAN' => 'required|date',
            'JENIS_HEWAN' => 'required|string|max:50',
        ]);

        Hewan::create($request->all());

        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil ditambahkan!');
    }

    // Form edit hewan
    public function edit($id)
    {
        $hewan = Hewan::findOrFail($id);
        $customers = Customer::all();
        return view('hewan.edit', compact('hewan', 'customers'));
    }

    // Update data hewan
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_CUSTOMER' => 'required|exists:customer,ID_CUSTOMER',
            'NAMA_HEWAN' => 'required|string|max:100',
            'TGL_LAHIR_HEWAN' => 'required|date',
            'JENIS_HEWAN' => 'required|string|max:50',
        ]);

        $hewan = Hewan::findOrFail($id);
        $hewan->update($request->all());

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diperbarui!');
    }

    // Hapus hewan
    public function destroy($id)
    {
        Hewan::destroy($id);
        return redirect()->route('hewan.index')->with('success', 'Hewan berhasil dihapus!');
    }
}
