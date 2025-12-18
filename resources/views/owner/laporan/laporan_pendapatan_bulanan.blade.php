@extends('layout.owner')

@section('title', 'Pendapatan Bulanan')

@section('content')
<div class="container py-5">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">💰 Laporan Pendapatan Bulanan</h2>

        {{-- FILTER & CETAK PDF --}}
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2">
                <select name="bulan" class="form-select" onchange="this.form.submit()">
                    @for ($b = 1; $b <= 12; $b++)
                        <option value="{{ $b }}" {{ $b == $bulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    @for ($th = 2020; $th <= date('Y'); $th++)
                        <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endfor
                </select>
            </form>

            <a href="{{ route('owner.laporan.pendapatan_bulanan_pdf', [
                    'bulan' => $bulan,
                    'tahun' => $tahun
                ]) }}"
               target="_blank"
               class="btn btn-danger">
                🖨 Cetak PDF
            </a>
        </div>
    </div>

    {{-- INFO BULAN --}}
    <p class="text-muted mb-4">
        Periode:
        <strong>{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</strong>
        {{ $tahun }}
    </p>

    {{-- ================= JASA LAYANAN ================= --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">
            🧼 Pendapatan Jasa Layanan
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Jasa Layanan</th>
                        <th width="25%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jasa as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $row->NAMA_LAYANAN }}</td>
                        <td class="text-end">
                            Rp {{ number_format($row->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Tidak ada transaksi jasa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end fw-bold">
            Total Jasa: Rp {{ number_format($total_jasa, 0, ',', '.') }}
        </div>
    </div>

    {{-- ================= PRODUK ================= --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">
            📦 Pendapatan Produk
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Produk</th>
                        <th width="25%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $row->NAMA_PRODUK }}</td>
                        <td class="text-end">
                            Rp {{ number_format($row->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Tidak ada transaksi produk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end fw-bold">
            Total Produk: Rp {{ number_format($total_produk, 0, ',', '.') }}
        </div>
    </div>

    {{-- ================= GRAND TOTAL ================= --}}
    <div class="alert alert-success text-end fw-bold fs-5">
        GRAND TOTAL:
        Rp {{ number_format($total_jasa + $total_produk, 0, ',', '.') }}
    </div>

</div>
@endsection
