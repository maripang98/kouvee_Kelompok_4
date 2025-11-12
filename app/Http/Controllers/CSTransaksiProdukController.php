<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TransaksiProduk;
use App\Models\DetailTransaksiProduk;
use App\Models\Produk;
use App\Models\Customer;

class CSTransaksiProdukController extends Controller
{
    // 🏠 Daftar semua transaksi produk
    public function index()
    {
        $transaksi = TransaksiProduk::with('details')
            ->withoutTrashed() // hanya tampilkan data aktif
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('cs.transaksi_produk.index', compact('transaksi'));
    }




    // ➕ Form entri transaksi baru
    public function create()
    {
        $produks = Produk::whereNull('deleted_at')->get();
        $customers = Customer::whereNull('deleted_at')->get();
        return view('cs.transaksi_produk.create', compact('produks', 'customers'));
    }

    // 💾 Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
        ]);

        $lastId = \App\Models\TransaksiProduk::max('ID_TRANSAKSI_PENJUALAN_PRODUK') ?? 0;
        $nextId = str_pad($lastId + 1, 2, '0', STR_PAD_LEFT); // dua digit misalnya 01, 02, 03

        $kodeTransaksi = 'PR-' . now()->format('dmy') . '-' . $nextId;

        $transaksi = TransaksiProduk::create([
            'ID_PEGAWAI' => 2,
            'PEG_ID_PEGAWAI' => 2,
            'KODE_TRANSAKSI_PENJUALAN_PRODUK' => $kodeTransaksi,
            'TGL_TRANSAKSI_PENJUALAN_PRODUK' => now(),
            'SUB_TOTAL_PENJUALAN_PRODUK' => 0,
            'DISKON_PENJUALAN_PRODUK' => 0,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => 0,
            'STATUS_PEMBAYARAN_PRODUK' => 'Lunas',
        ]);

        $total = 0;

        // Loop untuk tiap produk
        foreach ($request->produk_id as $i => $idProduk) {
            $produk = Produk::findOrFail($idProduk);
            $qty = (int) $request->jumlah[$i];
            $subtotal = $produk->HARGA_PRODUK * $qty;

            // Simpan detail transaksi
            DetailTransaksiProduk::create([
                'ID_PRODUK' => $produk->ID_PRODUK,
                'ID_TRANSAKSI_PENJUALAN_PRODUK' => $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK,
                'JUMLAH_ORDER_PRODUK' => $qty,
            ]);

            // Kurangi stok
            $produk->decrement('STOK_PRODUK', $qty);

            $total += $subtotal;
        }

        // Update total harga di tabel transaksi
        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_PRODUK' => $total,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => $total,
            'STATUS_PEMBAYARAN_PRODUK' => 'Lunas',
        ]);

        return redirect()->route('cs.transaksi_produk.index')->with('success', 'Transaksi produk berhasil disimpan!');
    }


    // ✏️ Edit transaksi
    public function edit($id)
    {
        $transaksi = TransaksiProduk::with(['details.produk'])->findOrFail($id);
        $produks = Produk::whereNull('deleted_at')->get(); // ✅ kirim daftar produk
        return view('cs.transaksi_produk.edit', compact('transaksi', 'produks'));
    }


    // 📋 Update data transaksi
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiProduk::findOrFail($id);

        $request->validate([
            'produk_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
        ]);

        // 🧹 Hapus semua detail lama (pakai query builder biar pasti terhapus)
        \DB::table('detail_transaksi_penjualan_pro')
            ->where('ID_TRANSAKSI_PENJUALAN_PRODUK', $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK)
            ->delete();

        $total = 0;

        // 🔁 Tambah ulang data detail baru
        foreach ($request->produk_id as $i => $idProduk) {
            $produk = Produk::findOrFail($idProduk);
            $qty = (int) $request->jumlah[$i];
            $subtotal = $produk->HARGA_PRODUK * $qty;

            \DB::table('detail_transaksi_penjualan_pro')->insert([
                'ID_PRODUK' => $produk->ID_PRODUK,
                'ID_TRANSAKSI_PENJUALAN_PRODUK' => $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK,
                'JUMLAH_ORDER_PRODUK' => $qty,
            ]);

            $total += $subtotal;
        }

        // 💰 Update total dan updated_at
        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_PRODUK' => $total,
            'TOTAL_HARGA_PENJUALAN_PRODUK' => $total,
            'updated_at' => now(), // 🕒 waktu edit terakhir
        ]);

        return redirect()
            ->route('cs.transaksi_produk.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiProduk::with('details')->findOrFail($id);

        // 🧹 Soft delete semua detail secara manual (pakai query builder)
        \DB::table('detail_transaksi_penjualan_pro')
            ->where('ID_TRANSAKSI_PENJUALAN_PRODUK', $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK)
            ->update(['deleted_at' => now()]);

        // 🔹 Lalu soft delete transaksi utama (pakai Eloquent)
        $transaksi->delete();

        return redirect()
            ->route('cs.transaksi_produk.index')
            ->with('success', 'Transaksi berhasil dihapus (soft delete).');
    }

}
