@extends('layout.owner')

@section('title', 'Laporan Layanan Terlaris')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-center mb-4">📊 Laporan Layanan Terlaris</h2>

    <form method="GET" class="d-flex justify-content-end mb-3">
        <select name="tahun" class="form-select w-auto" onchange="this.form.submit()">
            @for ($th = 2020; $th <= date('Y'); $th++)
                <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>{{ $th }}</option>
            @endfor
        </select>
    </form>

    <div class="text-end mb-3">
        <a href="{{ route('owner.laporan.layanan.pdf', ['tahun'=>$tahun]) }}"
           class="btn btn-danger" target="_blank">
            🖨 Cetak PDF
        </a>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Nama Layanan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}</td>
                <td>{{ $row['nama_layanan'] }}</td>
                <td>{{ $row['jumlah'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
