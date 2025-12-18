@extends('layout.kasir')

@section('title', 'Nota LAYANAN')

@section('content')

<div class="container my-5" style="max-width: 700px">

    <div class="text-center mb-4">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" style="width:130px">
        <h3 class="fw-bold mt-2">KOUVEE PET SHOP</h3>
        <p>Jl. Moses Gatotkaca No. 22 Yogyakarta</p>
        <hr>
        <h4 class="fw-bold">NOTA LUNAS</h4>
    </div>

    <div class="row mb-3">
        <div class="col">
            <p><b>{{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}</b></p>
            <p>Member : {{ $t->customer->NAMA_CUSTOMER }}</p>
            <p>Telepon : {{ $t->customer->NOMOR_TELEPON_CUSTOMER }}</p>
        </div>
        <div class="col text-end">
            <p>{{ \Carbon\Carbon::parse($t->updated_at)->format('d M Y H:i') }}</p>
            <p>CS : {{ $t->pegawai_cs->NAMA_PEGAWAI ?? '-' }}</p>
            <p>Kasir : {{ $t->pegawai_kasir->NAMA_PEGAWAI ?? '-' }}</p>
        </div>
    </div>

    <h5 class="fw-bold mb-2">LAYANAN</h5>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($t->details as $i => $d)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $d->layanan->NAMA_LAYANAN }}</td>
                <td>Rp {{ number_format($d->layanan->HARGA_LAYANAN, 0, ',', '.') }}</td>
                <td>{{ $d->JUMLAH_ORDER_LAYANAN }}</td>
                <td>
                    Rp {{ number_format($d->layanan->HARGA_LAYANAN * $d->JUMLAH_ORDER_LAYANAN, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <p>Sub Total : <b>Rp {{ number_format($t->SUB_TOTAL_PENJUALAN_LAYANAN,0,',','.') }}</b></p>
        <p>Diskon : <b>Rp {{ number_format($t->DISKON_PENJUALAN_LAYANAN,0,',','.') }}</b></p>
        <p class="fs-4 fw-bold">TOTAL : Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_LAYANAN,0,',','.') }}</p>
    </div>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">🖨 Cetak Nota</button>
    </div>

</div>

@endsection
