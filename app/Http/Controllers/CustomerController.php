<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Pegawai;

class CustomerController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::when($search, function ($query, $search) {
            $query->where('NAMA_CUSTOMER', 'like', "%{$search}%");
        })->get();

        return view('customer.index', compact('customers'));
    }

   
    public function create()
    {
        // Ambil semua data pegawai dari tabel pegawai
        $pegawais = Pegawai::all();

        // Kirim data ke view
        return view('customer.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PEGAWAI' => 'required|integer',
            'NAMA_CUSTOMER' => 'required|string|max:100',
            'ALAMAT_CUSTOMER' => 'required|string|max:255',
            'TGL_LAHIR_CUSTOMER' => 'required|date',
            'NOMOR_TELEPON_CUSTOMER' => [
                'required',
                'digits_between:10,12',
                'regex:/^[0-9]+$/',
                'unique:customer,NOMOR_TELEPON_CUSTOMER',
            ],
        ], [
            'NOMOR_TELEPON_CUSTOMER.unique' => 'Nomor telepon sudah terdaftar.',
        ]);

        Customer::create($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }


    public function edit(Customer $customer)
    {
        $pegawais = Pegawai::all();
        return view('customer.edit', compact('customer', 'pegawais'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'ID_PEGAWAI' => 'required|integer',
            'NAMA_CUSTOMER' => 'required|string|max:100',
            'ALAMAT_CUSTOMER' => 'required|string|max:255',
            'TGL_LAHIR_CUSTOMER' => 'required|date',
            'NOMOR_TELEPON_CUSTOMER' => [
                'required',
                'digits_between:10,12',
                'regex:/^[0-9]+$/',
                'unique:customer,NOMOR_TELEPON_CUSTOMER',
            ],
        ], [
            'NOMOR_TELEPON_CUSTOMER.unique' => 'Nomor telepon sudah terdaftar.',
        ]);

        $customer->update($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui.');
    }

        public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete(); // hanya menandai deleted_at, tidak menghapus di database
        return redirect()->route('customer.index')->with('success', 'customer diarsipkan.');
    }
}
