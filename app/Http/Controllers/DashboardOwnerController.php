<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Layanan;
use App\Models\Pegawai;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardOwnerController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function index(ReportService $report)
    {
        return view('owner.dashboard', [
            'totalProduk'   => Produk::count(),
            'totalLayanan'  => Layanan::count(),
            'totalPegawai'  => Pegawai::count(),

            'produk'        => Produk::latest('ID_PRODUK')->take(5)->get(),
            'layanan'       => Layanan::latest('ID_LAYANAN')->take(5)->get(),
            'pegawai'       => Pegawai::latest('ID_PEGAWAI')->take(5)->get(),

            // preview laporan (ARRAY, bukan object)
            'laporanPreview'=> $report
                ->layananTerlarisPerTahun(date('Y'))
                ->take(3),
        ]);
    }

    /* ========== MENU LAPORAN ========== */
    public function indexLaporan()
    {
        return view('owner.laporan.index');
    }

    /* ========== LAPORAN LAYANAN TERLARIS ========== */
    public function laporanLayanan(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->layananTerlarisPerTahun($tahun);

        return view('owner.laporan.laporan_layanan', compact('laporan', 'tahun'));
    }

    public function laporanLayananPdf(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->layananTerlarisPerTahun($tahun);

        return Pdf::loadView(
            'owner.laporan.laporan_layanan_pdf',
            compact('laporan', 'tahun')
        )
        ->setPaper('A4', 'portrait')
        ->stream("Laporan-Layanan-Terlaris-$tahun.pdf");
    }

    /* ========== LAPORAN PRODUK TERLARIS ========== */
    public function laporanProduk(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->produkTerlarisPerTahun($tahun);

        return view('owner.laporan.laporan_produk', compact('laporan', 'tahun'));
    }

    public function laporanProdukPdf(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->produkTerlarisPerTahun($tahun);

        return Pdf::loadView(
            'owner.laporan.laporan_produk_pdf',
            compact('laporan', 'tahun')
        )
        ->setPaper('A4', 'portrait')
        ->stream("Laporan-Produk-Terlaris-$tahun.pdf");
    }

    /* ========== LAPORAN PENDAPATAN BULANAN ========== */
    public function pendapatanBulanan(Request $request, ReportService $report)
    {
        $bulan = (int) ($request->bulan ?? date('m'));
        $tahun = (int) ($request->tahun ?? date('Y'));

        $data = $report->pendapatanBulananDetail($bulan, $tahun);

        return view('owner.laporan.laporan_pendapatan_bulanan', $data);
    }


   public function pendapatanBulananPdf(Request $request, ReportService $report)
    {
        $bulan = (int) ($request->bulan ?? date('m'));
        $tahun = (int) ($request->tahun ?? date('Y'));

        $data = $report->pendapatanBulananDetail($bulan, $tahun);

        return Pdf::loadView(
            'owner.laporan.laporan_pendapatan_bulanan_pdf',
            $data + compact('bulan', 'tahun')
        )
        ->setPaper('A4', 'portrait')
        ->stream("Laporan-Pendapatan-Bulanan-$bulan-$tahun.pdf");
    }


    /* ========== LAPORAN PENDAPATAN TAHUNAN ========== */
    public function pendapatanTahunan(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->pendapatanTahunan($tahun);

        return view('owner.laporan.laporan_pendapatan_tahunan', compact('laporan', 'tahun'));
    }


    public function pendapatanTahunanPdf(Request $request, ReportService $report)
    {
        $tahun = (int) ($request->tahun ?? date('Y'));
        $laporan = $report->pendapatanTahunan($tahun);

        return Pdf::loadView(
            'owner.laporan.laporan_pendapatan_tahunan_pdf',
            compact('laporan', 'tahun')
        )
        ->setPaper('A4', 'portrait')
        ->stream("Laporan-Pendapatan-Tahunan-$tahun.pdf");
    }
}
