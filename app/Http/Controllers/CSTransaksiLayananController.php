<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TransaksiLayanan;
use App\Models\DetailTransaksiLayanan;
use App\Models\Layanan;
use App\Models\Customer;
use App\Models\Hewan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class CSTransaksiLayananController extends Controller
{
    // 🏠 Index transaksi layanan
    public function index(Request $request)
    {
        $status = $request->get('status');

        // Urutkan berdasarkan updated_at (jika null, pakai tanggal transaksi)
        $query = TransaksiLayanan::with('details.layanan')
            ->orderByDesc(DB::raw('COALESCE(updated_at, TGL_TRANSAKSI_PENJUALAN_LAYANAN)'));

        // Filter status pembayaran
        if (!empty($status) && $status !== 'Semua') {
            $query->where('STATUS_LAYANAN', $status);
        }

        $transaksi = $query->paginate(10);

        return view('cs.transaksi_layanan.index', compact('transaksi', 'status'));
    }

    // ➕ Form entri transaksi
    public function create()
    {
        // Ambil semua customer yang punya hewan
        $customers = \App\Models\Customer::whereIn('ID_CUSTOMER', function($q){
            $q->select('ID_CUSTOMER')->from('hewan')->whereNull('deleted_at');
        })->whereNull('deleted_at')->get();

        // Ambil semua hewan juga (optional, nanti filtered via JS)
        $hewan = \App\Models\Hewan::whereNull('deleted_at')->get();

        $layanans = \App\Models\Layanan::whereNull('deleted_at')->get();

        return view('cs.transaksi_layanan.create', compact('layanans','customers','hewan'));
    }


    // 💾 Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'ID_CUSTOMER' => 'required|integer',
            'ID_HEWAN' => 'required|integer',
            'layanan_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
        ]);

        // Membuat kode transaksi
        $lastId = TransaksiLayanan::max('ID_TRANSAKSI_LAYANAN') ?? 0;
        $nextId = str_pad($lastId + 1, 2, '0', STR_PAD_LEFT);
        $kodeTransaksi = 'LY-' . now()->format('dmy') . '-' . $nextId;

        // Simpan transaksi utama
        $transaksi = TransaksiLayanan::create([
            'ID_PEGAWAI' => 2,
            'PEG_ID_PEGAWAI' => 1,
            'ID_CUSTOMER' => $request->ID_CUSTOMER,
            'ID_HEWAN' => $request->ID_HEWAN,
            'KODE_TRANSAKSI_PENJUALAN_LAYANAN' => $kodeTransaksi,
            'TGL_TRANSAKSI_PENJUALAN_LAYANAN' => now(),
            'SUB_TOTAL_PENJUALAN_LAYANAN' => 0,
            'DISKON_PENJUALAN_LAYANAN' => 0,
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => 0,
            'STATUS_LAYANAN' => 'Belum Dikerjakan', // DEFAULT FIX
        ]);

        // Simpan detail transaksi
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

        // Update total tanpa merusak STATUS_LAYANAN
        $transaksi->update([
            'SUB_TOTAL_PENJUALAN_LAYANAN' => $total,
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => $total,
        ]);

        return redirect()->route('cs.transaksi_layanan.index')
            ->with('success', 'Transaksi layanan berhasil disimpan!');
    }




    // ✏️ Edit transaksi
    public function edit($id)
    {
        $transaksi = TransaksiLayanan::with('details.layanan')->findOrFail($id);

        // Ambil daftar customer yang punya hewan
        $customers = Customer::whereIn('ID_CUSTOMER', function($q){
            $q->select('ID_CUSTOMER')->from('hewan')->whereNull('deleted_at');
        })->whereNull('deleted_at')->get();

        // Ambil semua hewan
        $hewan = Hewan::whereNull('deleted_at')->get();

        // Semua layanan
        $layanans = Layanan::whereNull('deleted_at')->get();

        return view('cs.transaksi_layanan.edit', compact('transaksi', 'customers', 'hewan', 'layanans'));
    }



    // 🧾 Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_CUSTOMER' => 'required|integer',
            'ID_HEWAN' => 'required|integer',
            'layanan_id' => 'required|array|min:1',
            'jumlah' => 'required|array|min:1',
            'status_layanan' => 'required|string|in:Belum Dikerjakan,Dalam Pengerjaan,Selesai',
        ]);

        $transaksi = TransaksiLayanan::findOrFail($id);

        // Hapus detail lama
        DB::table('detail_transaksi_penjualan_lay')
            ->where('ID_TRANSAKSI_LAYANAN', $id)
            ->delete();

        $total = 0;

        // Simpan detail baru
        foreach ($request->layanan_id as $i => $idLayanan) {

            $layanan = Layanan::findOrFail($idLayanan);
            $qty = (int)$request->jumlah[$i];
            $subtotal = $layanan->HARGA_LAYANAN * $qty;

            DetailTransaksiLayanan::create([
                'ID_LAYANAN' => $layanan->ID_LAYANAN,
                'ID_TRANSAKSI_LAYANAN' => $id,
                'JUMLAH_ORDER_LAYANAN' => $qty,
            ]);

            $total += $subtotal;
        }

        // Update transaksi utama
        $transaksi->update([
            'ID_CUSTOMER' => $request->ID_CUSTOMER,
            'ID_HEWAN' => $request->ID_HEWAN,
            'SUB_TOTAL_PENJUALAN_LAYANAN' => $total,
            'DISKON_PENJUALAN_LAYANAN' => 0, // default
            'TOTAL_HARGA_PENJUALAN_LAYANAN' => $total,
            'STATUS_LAYANAN' => $request->status_layanan,
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
