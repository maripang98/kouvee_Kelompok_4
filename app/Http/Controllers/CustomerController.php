<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
     public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
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
        ],
        ]);

        Customer::create($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
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
        ],
        ]);

        $customer->update($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus.');
    }
}
