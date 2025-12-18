<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReportService
{
    /* =====================================================
     * 1. LAPORAN LAYANAN TERLARIS (PER BULAN DALAM 1 TAHUN)
     * ===================================================== */
    public function layananTerlarisPerTahun(int $tahun)
    {
        return collect(range(1, 12))->map(function ($bulan) use ($tahun) {

            $data = DB::table('detail_transaksi_penjualan_lay AS d')
                ->join('transaksi_penjualan_layanan AS t', 't.ID_TRANSAKSI_LAYANAN', '=', 'd.ID_TRANSAKSI_LAYANAN')
                ->join('layanan AS l', 'l.ID_LAYANAN', '=', 'd.ID_LAYANAN')
                ->select(
                    'l.NAMA_LAYANAN',
                    DB::raw('SUM(d.JUMLAH_ORDER_LAYANAN) AS jumlah')
                )
                ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $tahun)
                ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $bulan)
                ->where('t.STATUS_PEMBAYARAN_LAYANAN', 'Lunas')
                ->groupBy('l.ID_LAYANAN', 'l.NAMA_LAYANAN')
                ->orderByDesc('jumlah')
                ->first();

            return [
                'bulan' => $bulan,
                'nama_layanan' => $data->NAMA_LAYANAN ?? '-',
                'jumlah' => (int) ($data->jumlah ?? 0),
            ];
        });
    }

    /* =====================================================
     * 2. LAPORAN PRODUK TERLARIS (PER BULAN DALAM 1 TAHUN)
     * ===================================================== */
    public function produkTerlarisPerTahun(int $tahun)
    {
        return collect(range(1, 12))->map(function ($bulan) use ($tahun) {

            $data = DB::table('detail_transaksi_penjualan_pro AS d')
                ->join('transaksi_penjualan_produk AS t', 't.ID_TRANSAKSI_PENJUALAN_PRODUK', '=', 'd.ID_TRANSAKSI_PENJUALAN_PRODUK')
                ->join('produk AS p', 'p.ID_PRODUK', '=', 'd.ID_PRODUK')
                ->select(
                    'p.NAMA_PRODUK',
                    DB::raw('SUM(d.JUMLAH_ORDER_PRODUK) AS jumlah')
                )
                ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $tahun)
                ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $bulan)
                ->where('t.STATUS_PEMBAYARAN_PRODUK', 'Lunas')
                ->groupBy('p.ID_PRODUK', 'p.NAMA_PRODUK')
                ->orderByDesc('jumlah')
                ->first();

            return [
                'bulan' => $bulan,
                'nama_produk' => $data->NAMA_PRODUK ?? '-',
                'jumlah' => (int) ($data->jumlah ?? 0),
            ];
        });
    }

    /* =====================================================
     * 3. LAPORAN PENDAPATAN BULANAN
     * ===================================================== */
    public function pendapatanBulananDetail(int $bulan, int $tahun)
    {
        // JASA
        $jasa = DB::table('detail_transaksi_penjualan_lay AS d')
            ->join('transaksi_penjualan_layanan AS t', 't.ID_TRANSAKSI_LAYANAN', '=', 'd.ID_TRANSAKSI_LAYANAN')
            ->join('layanan AS l', 'l.ID_LAYANAN', '=', 'd.ID_LAYANAN')
            ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $bulan)
            ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $tahun)
            ->where('t.STATUS_PEMBAYARAN_LAYANAN', 'Lunas')
            ->select(
                'l.NAMA_LAYANAN',
                DB::raw('SUM(l.HARGA_LAYANAN * d.JUMLAH_ORDER_LAYANAN) AS total')
            )
            ->groupBy('l.ID_LAYANAN', 'l.NAMA_LAYANAN')
            ->get();

        // PRODUK
        $produk = DB::table('detail_transaksi_penjualan_pro AS d')
            ->join('transaksi_penjualan_produk AS t', 't.ID_TRANSAKSI_PENJUALAN_PRODUK', '=', 'd.ID_TRANSAKSI_PENJUALAN_PRODUK')
            ->join('produk AS p', 'p.ID_PRODUK', '=', 'd.ID_PRODUK')
            ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $bulan)
            ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $tahun)
            ->where('t.STATUS_PEMBAYARAN_PRODUK', 'Lunas')
            ->select(
                'p.NAMA_PRODUK',
                DB::raw('SUM(p.HARGA_PRODUK * d.JUMLAH_ORDER_PRODUK) AS total')
            )
            ->groupBy('p.ID_PRODUK', 'p.NAMA_PRODUK')
            ->get();

        return [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jasa' => $jasa,
            'total_jasa' => $jasa->sum('total'),
            'produk' => $produk,
            'total_produk' => $produk->sum('total'),
        ];
    }


    /* =====================================================
     * 4. LAPORAN PENDAPATAN TAHUNAN (SUMMARY)
     * ===================================================== */
    public function pendapatanTahunan(int $tahun)
    {
        return collect(range(1, 12))->map(function ($bulan) use ($tahun) {

            // jasa layanan per bulan
            $jasa = DB::table('detail_transaksi_penjualan_lay AS d')
                ->join('transaksi_penjualan_layanan AS t', 't.ID_TRANSAKSI_LAYANAN', '=', 'd.ID_TRANSAKSI_LAYANAN')
                ->join('layanan AS l', 'l.ID_LAYANAN', '=', 'd.ID_LAYANAN')
                ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $tahun)
                ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_LAYANAN', $bulan)
                ->where('t.STATUS_PEMBAYARAN_LAYANAN', 'Lunas')
                ->sum(DB::raw('l.HARGA_LAYANAN * d.JUMLAH_ORDER_LAYANAN'));

            // produk per bulan
            $produk = DB::table('detail_transaksi_penjualan_pro AS d')
                ->join('transaksi_penjualan_produk AS t', 't.ID_TRANSAKSI_PENJUALAN_PRODUK', '=', 'd.ID_TRANSAKSI_PENJUALAN_PRODUK')
                ->join('produk AS p', 'p.ID_PRODUK', '=', 'd.ID_PRODUK')
                ->whereYear('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $tahun)
                ->whereMonth('t.TGL_TRANSAKSI_PENJUALAN_PRODUK', $bulan)
                ->where('t.STATUS_PEMBAYARAN_PRODUK', 'Lunas')
                ->sum(DB::raw('p.HARGA_PRODUK * d.JUMLAH_ORDER_PRODUK'));

            return [
                'bulan' => $bulan,
                'jasa_layanan' => (float) $jasa,
                'produk' => (float) $produk,
                'total' => (float) ($jasa + $produk),
            ];
        });
    }


}
