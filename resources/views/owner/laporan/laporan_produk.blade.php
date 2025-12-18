@extends('layout.owner')

@section('title', 'Laporan Produk Terlaris')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-center mb-4">📦 Laporan Produk Terlaris</h2>

    <form method="GET" class="d-flex justify-content-end mb-3">
        <select name="tahun" class="form-select w-auto" onchange="this.form.submit()">
            @for ($th = 2020; $th <= date('Y'); $th++)
                <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>{{ $th }}</option>
            @endfor
        </select>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET">
            <select name="tahun" class="form-select w-auto" onchange="this.form.submit()">
                @for ($th = 2020; $th <= date('Y'); $th++)
                    <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                        {{ $th }}
                    </option>
                @endfor
            </select>
        </form>

        <a href="{{ route('owner.laporan.produk.pdf', ['tahun' => $tahun]) }}"
        target="_blank"
        class="btn btn-danger">
            🖨 Cetak PDF
        </a>
    </div>


    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}</td>
                <td>{{ $row['nama_produk'] }}</td>
                <td>{{ $row['jumlah'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
