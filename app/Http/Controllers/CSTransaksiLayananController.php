<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TransaksiLayanan;
use App\Models\DetailTransaksiLayanan;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class CSTransaksiLayananController extends Controller
{
    // 🏠 Index transaksi layanan
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = TransaksiLayanan::with('details.layanan')
            ->orderByDesc('TGL_TRANSAKSI_PENJUALAN_LAYANAN');

        if (!empty($status) && $status !== 'Semua') {
            $query->where('STATUS_PEMBAYARAN_LAYANAN', $status);
        }

        $transaksi = $query->paginate(10);

        return view('cs.transaksi_layanan.index', compact('transaksi', 'status'));
    }

    // ➕ Form entri transaksi
    public function create()
    {
        $layanans = Layanan::whereNull('deleted_at')->get();
        return view('cs.transaksi_layanan.create', compact('layanans'));
    }

    // 💾 Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
        ]);

        $lastId = TransaksiLayanan::max('ID_TRANSAKSI_LAYANAN') ?? 0;
        $nextId = str_pad($lastId + 1, 2, '0', STR_PAD_LEFT);
        $kodeTransaksi = 'LY-' . now()->format('dmy') . '-' . $nextId;

        $transaksi = TransaksiLayanan::create([
            'ID_PEGAWAI' => 2,
            'PEG_ID_PEGAWAI' => 2,
            'KODE_TRANSAKSI_PENJUALAN_LAYANAN' => $kodeTransaksi,
            'TGL_TRANSAKSI_PENJUALAN_LAYANAN' => now(),
            'SUB_TOTAL_PENJUALAN_LAYANAN' => 0,
            'DISKON_PENJUALAN_LAYANAN' => 0,
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => 0,
            'STATUS_PEMBAYARAN_LAYANAN' => 'Belum Lunas',
        ]);

        $total = 0;

        foreach ($request->layanan_id as $i => $idLayanan) {
            $layanan = Layanan::find($idLayanan);
            if (!$layanan) continue;

            $qty = (int) $request->jumlah[$i];
            $subtotal = $layanan->HARGA_LAYANAN * $qty;

            DetailTransaksiLayanan::create([
                'ID_LAYANAN' => $layanan->ID_LAYANAN,
                'ID_TRANSAKSI_LAYANAN' => $transaksi->ID_TRANSAKSI_LAYANAN,
                'JUMLAH_ORDER_LAYANAN' => $qty,
            ]);

            $total += $subtotal;
        }

        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_LAYANAN' => $total,
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => $total,
            'STATUS_PEMBAYARAN_LAYANAN' => 'Belum Lunas',
        ]);

        return redirect()->route('cs.transaksi_layanan.index')
            ->with('success', 'Transaksi layanan berhasil disimpan!');
    }

    // ✏️ Edit transaksi
    public function edit($id)
    {
        $transaksi = TransaksiLayanan::with('details.layanan')->findOrFail($id);
        $layanans = Layanan::whereNull('deleted_at')->get();
        return view('cs.transaksi_layanan.edit', compact('transaksi', 'layanans'));
    }

    // 🧾 Update transaksi
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiLayanan::findOrFail($id);

        // Hapus detail lama
        DB::table('detail_transaksi_penjualan_lay')
            ->where('ID_TRANSAKSI_LAYANAN', $id)
            ->delete();

        $total = 0;

        foreach ($request->layanan_id as $i => $idLayanan) {
            $layanan = Layanan::findOrFail($idLayanan);
            $qty = (int) $request->jumlah[$i];
            $subtotal = $layanan->HARGA_LAYANAN * $qty;

            DetailTransaksiLayanan::create([
                'ID_LAYANAN' => $layanan->ID_LAYANAN,
                'ID_TRANSAKSI_LAYANAN' => $id,
                'JUMLAH_ORDER_LAYANAN' => $qty,
            ]);

            $total += $subtotal;
        }

        // Update transaksi + status pembayaran
        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_LAYANAN' => $total,
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => $total,
            'STATUS_PEMBAYARAN_LAYANAN' => $request->status_pembayaran,
            'updated_at' => now(),
        ]);

        return redirect()->route('cs.transaksi_layanan.index')
            ->with('success', 'Transaksi layanan berhasil diperbarui!');
    }

    // 🗑️ Soft delete
    public function destroy($id)
    {
        $transaksi = TransaksiLayanan::with('details')->findOrFail($id);

        DB::table('detail_transaksi_penjualan_lay')
            ->where('ID_TRANSAKSI_LAYANAN', $transaksi->ID_TRANSAKSI_LAYANAN)
            ->update(['deleted_at' => now()]);

        $transaksi->delete();

        return redirect()
            ->route('cs.transaksi_layanan.index')
            ->with('success', 'Transaksi layanan berhasil dihapus (soft delete).');
    }
}
