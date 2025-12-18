@extends('layout.owner')

@section('title', 'Pendapatan Tahunan')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-center mb-4">📈 Laporan Pendapatan Tahunan</h2>

    {{-- FILTER & CETAK PDF --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <form method="GET" class="d-flex gap-2">
            <select name="tahun" class="form-select w-auto" onchange="this.form.submit()">
                @for ($th = 2020; $th <= date('Y'); $th++)
                    <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                        {{ $th }}
                    </option>
                @endfor
            </select>
        </form>

        {{-- TOMBOL CETAK PDF --}}
        <a href="{{ route('owner.laporan.pendapatan.tahunan.pdf', ['tahun' => $tahun]) }}"
        target="_blank"
        class="btn btn-danger">
            🖨 Cetak PDF
        </a>

    </div>


    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Jasa Layanan</th>
                <th>Produk</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}</td>
                <td>Rp {{ number_format($row['jasa_layanan'],0,',','.') }}</td>
                <td>Rp {{ number_format($row['produk'],0,',','.') }}</td>
                <td class="fw-bold">
                    Rp {{ number_format($row['total'],0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>

        <tfoot class="table-light fw-bold">
            <tr>
                <td colspan="4" class="text-end">Total</td>
                <td>
                    Rp {{ number_format($laporan->sum('total'),0,',','.') }}
                </td>
            </tr>
        </tfoot>
    </table>

</div>
@endsection
