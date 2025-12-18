<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiProduk;
use App\Models\TransaksiLayanan;

class KasirController extends Controller
{
    // ===========================
    // DASHBOARD KASIR
    // ===========================
    public function dashboard()
    {
        return view('kasir.dashboard');
    }

    // ===========================
    // HALAMAN PRODUK
    // ===========================
    public function produk(Request $request)
    {
        $query = TransaksiProduk::query();

        if ($request->pembayaran == 'Lunas') {
            $query->where('STATUS_PEMBAYARAN_PRODUK', 'Lunas');
        } elseif ($request->pembayaran == 'Belum Lunas') {
            $query->where('STATUS_PEMBAYARAN_PRODUK', 'Belum Lunas');
        }

        $transaksi = $query->latest()->paginate(10);

        return view('kasir.produk', compact('transaksi'));
    }

    // ===========================
    // HALAMAN LAYANAN
    // ===========================
    public function layanan(Request $request)
    {
        $query = TransaksiLayanan::with(['customer', 'hewan']);

        // Filter pembayaran
        if ($request->pembayaran == 'Lunas') {
            $query->where('STATUS_PEMBAYARAN_LAYANAN', 'Lunas');
        } elseif ($request->pembayaran == 'Belum Lunas') {
            $query->where('STATUS_PEMBAYARAN_LAYANAN', 'Belum Lunas');
        }

        // Filter status layanan
        if ($request->status_layanan) {
            $query->where('STATUS_LAYANAN', $request->status_layanan);
        }

        $transaksi = $query->latest()->paginate(10);

        return view('kasir.layanan', compact('transaksi'));
    }

    // ===========================
    // PROSES PEMBAYARAN
    // ===========================
    public function bayar(Request $request, $jenis, $id)
    {
        // Diskon
        $diskon = $request->diskon ?? 0;

        if ($jenis === 'produk') {
            $t = TransaksiProduk::findOrFail($id);

            $t->DISKON_PENJUALAN_PRODUK = $diskon;
            $t->TOTAL_HARGA_PENJUALAN_PRODUK = $t->SUB_TOTAL_PENJUALAN_PRODUK - $diskon;
            $t->STATUS_PEMBAYARAN_PRODUK = 'Lunas';
            $t->save();

            return response()->json([
                'redirect' => route('kasir.nota.produk', $id)
            ]);
        }

        if ($jenis === 'layanan') {
            $t = TransaksiLayanan::findOrFail($id);

            $t->DISKON_PENJUALAN_LAYANAN = $diskon;
            $t->TOTAL_HARGA_PENJUALAN_LAYANAN = $t->SUB_TOTAL_PENJUALAN_LAYANAN - $diskon;
            $t->STATUS_PEMBAYARAN_LAYANAN = 'Lunas';
            $t->save();

            return response()->json([
                'redirect' => route('kasir.nota.layanan', $id)
            ]);
        }
    }

    public function notaLayanan($id)
    {
        $t = TransaksiLayanan::with([
            'customer',
            'hewan',
            'details.layanan',
            'pegawai_cs',
            'pegawai_kasir'
        ])->findOrFail($id);

        return view('kasir.nota_layanan', compact('t'));
    }


    public function notaProduk($id)
    {
        $t = TransaksiProduk::with(['customer','details.produk'])->findOrFail($id);

        return view('kasir.nota_produk', compact('t'));
    }


}
