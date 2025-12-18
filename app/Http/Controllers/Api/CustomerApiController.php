<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    public function apiIndex() {
        return response()->json([
            "data" => Customer::whereNull('deleted_at')->get()
        ]);
    }

    public function apiStore(Request $request) 
    {
        $request->validate([
            'NAMA_CUSTOMER' => 'required|string',
            'ALAMAT_CUSTOMER' => 'required|string',
            'TGL_LAHIR_CUSTOMER' => 'required|date',
            'NOMOR_TELEPON_CUSTOMER' => 'required|string|unique:customer,NOMOR_TELEPON_CUSTOMER',
        ]);

        $data = Customer::create([
            "NAMA_CUSTOMER" => $request->NAMA_CUSTOMER,
            "ALAMAT_CUSTOMER" => $request->ALAMAT_CUSTOMER,
            "TGL_LAHIR_CUSTOMER" => $request->TGL_LAHIR_CUSTOMER,
            "NOMOR_TELEPON_CUSTOMER" => $request->NOMOR_TELEPON_CUSTOMER,
            "ID_PEGAWAI" => 2
        ]);

        return response()->json(["success" => true, "data" => $data], 201);
    }

    public function apiUpdate(Request $request, $id) 
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'NAMA_CUSTOMER' => 'required|string',
            'ALAMAT_CUSTOMER' => 'required|string',
            'TGL_LAHIR_CUSTOMER' => 'required|date',
            'NOMOR_TELEPON_CUSTOMER' => 'required|string|unique:customer,NOMOR_TELEPON_CUSTOMER,' . $id . ',ID_CUSTOMER',
        ]);

        $customer->update([
            "NAMA_CUSTOMER" => $request->NAMA_CUSTOMER,
            "ALAMAT_CUSTOMER" => $request->ALAMAT_CUSTOMER,
            "TGL_LAHIR_CUSTOMER" => $request->TGL_LAHIR_CUSTOMER,
            "NOMOR_TELEPON_CUSTOMER" => $request->NOMOR_TELEPON_CUSTOMER,
            "ID_PEGAWAI" => 2
        ]);

        return response()->json(["success" => true]);
    }


    public function apiDelete($id) {
        $data = Customer::findOrFail($id);
        $data->delete();
        return response()->json(["success" => true]);
    }


}
