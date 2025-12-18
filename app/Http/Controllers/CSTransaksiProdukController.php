<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiProduk;
use App\Models\DetailTransaksiProduk;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class CSTransaksiProdukController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiProduk::with(['details', 'customer'])
            ->withoutTrashed()
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('cs.transaksi_produk.index', compact('transaksi'));
    }


    public function create()
    {
        $produks = Produk::whereNull('deleted_at')->get();
        $customers = Customer::whereNull('deleted_at')->get();
        return view('cs.transaksi_produk.create', compact('produks', 'customers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|integer',
            'produk_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
        ]);

        $lastId = TransaksiProduk::max('ID_TRANSAKSI_PENJUALAN_PRODUK') ?? 0;
        $nextId = str_pad($lastId + 1, 2, '0', STR_PAD_LEFT);

        $kode = 'PR-' . now()->format('dmy') . '-' . $nextId;

        $transaksi = TransaksiProduk::create([
            'ID_PEGAWAI' => 2,
            'PEG_ID_PEGAWAI' => 1,
            'ID_CUSTOMER' => $request->id_customer,
            'KODE_TRANSAKSI_PENJUALAN_PRODUK' => $kode,
            'TGL_TRANSAKSI_PENJUALAN_PRODUK' => now(),
            'SUB_TOTAL_PENJUALAN_PRODUK' => 0,
            'DISKON_PENJUALAN_PRODUK' => 0,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => 0,
            'STATUS_PEMBAYARAN_PRODUK' => 'Belum Lunas',
        ]);

        $total = 0;

        foreach ($request->produk_id as $i => $idProduk) {
            $produk = Produk::findOrFail($idProduk);
            $qty = (int) $request->jumlah[$i];
            $subtotal = $produk->HARGA_PRODUK * $qty;

            DetailTransaksiProduk::create([
                'ID_PRODUK' => $produk->ID_PRODUK,
                'ID_TRANSAKSI_PENJUALAN_PRODUK' => $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK,
                'JUMLAH_ORDER_PRODUK' => $qty,
            ]);

            $produk->decrement('STOK_PRODUK', $qty);

            $total += $subtotal;
        }

        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_PRODUK' => $total,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => $total,
        ]);

        return redirect()->route('cs.transaksi_produk.index')
            ->with('success', 'Transaksi produk berhasil disimpan!');
    }


    public function edit($id)
    {
        $transaksi = TransaksiProduk::with(['details.produk', 'customer'])->findOrFail($id);
        $produks = Produk::whereNull('deleted_at')->get();
        $customers = Customer::whereNull('deleted_at')->get();

        return view('cs.transaksi_produk.edit', compact('transaksi', 'produks', 'customers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_customer' => 'required',
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        $transaksi = TransaksiProduk::findOrFail($id);

        DB::table('detail_transaksi_penjualan_pro')
            ->where('ID_TRANSAKSI_PENJUALAN_PRODUK', $id)
            ->delete();

        $total = 0;

        foreach ($request->produk_id as $i => $idProduk) {
            $produk = Produk::findOrFail($idProduk);
            $qty = (int) $request->jumlah[$i];
            $sub = $produk->HARGA_PRODUK * $qty;

            DB::table('detail_transaksi_penjualan_pro')->insert([
                'ID_PRODUK' => $produk->ID_PRODUK,
                'ID_TRANSAKSI_PENJUALAN_PRODUK' => $id,
                'JUMLAH_ORDER_PRODUK' => $qty,
            ]);

            $total += $sub;
        }

        $transaksi->update([
            'ID_CUSTOMER' => $request->id_customer,
            'SUB_TOTAL_PENJUALAN_PRODUK' => $total,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => $total,
            'updated_at' => now(),
        ]);

        return redirect()->route('cs.transaksi_produk.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $transaksi = TransaksiProduk::findOrFail($id);

        DB::table('detail_transaksi_penjualan_pro')
            ->where('ID_TRANSAKSI_PENJUALAN_PRODUK', $id)
            ->update(['deleted_at' => now()]);

        $transaksi->delete();

        return redirect()->route('cs.transaksi_produk.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'ID_CUSTOMER', 'ID_CUSTOMER');
    }

    public function pegawai_cs() {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }

    public function pegawai_kasir() {
        return $this->belongsTo(Pegawai::class, 'PEG_ID_PEGAWAI', 'ID_PEGAWAI');
    }

}
