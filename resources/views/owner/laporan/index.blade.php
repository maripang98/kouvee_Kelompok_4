@extends('layout.owner')

@section('title', 'Menu Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index_laporan.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/owner-laporan-menu.css']) --}}
@endpush

@section('content')

<div class="owner-laporan-container">

    <!-- PAGE HEADER -->
    <div class="owner-laporan-header">
        <h2 class="owner-laporan-title">
            📊 Menu Laporan
        </h2>
        <p class="owner-laporan-subtitle">
            Pilih jenis laporan yang ingin Anda lihat
        </p>
    </div>

    <!-- MENU GRID -->
    <div class="owner-laporan-grid">

        <!-- CARD LAYANAN TERLARIS -->
        <a href="{{ route('owner.laporan.layanan') }}" class="owner-laporan-card layanan">
            <span class="owner-laporan-card-badge">Popular</span>
            <div class="owner-laporan-card-content">
                <span class="owner-laporan-icon">🧼</span>
                <h5 class="owner-laporan-card-title">
                    Laporan Layanan Terlaris
                </h5>
                <p class="owner-laporan-card-desc">
                    Menampilkan layanan paling laku per bulan dengan detail jumlah transaksi
                </p>
                <div class="owner-laporan-arrow">
                    →
                </div>
            </div>
        </a>

        <!-- CARD PRODUK TERLARIS -->
        <a href="{{ route('owner.laporan.produk') }}" class="owner-laporan-card produk">
            <span class="owner-laporan-card-badge">Popular</span>
            <div class="owner-laporan-card-content">
                <span class="owner-laporan-icon">📦</span>
                <h5 class="owner-laporan-card-title">
                    Laporan Produk Terlaris
                </h5>
                <p class="owner-laporan-card-desc">
                    Menampilkan produk paling laku per bulan dengan detail jumlah penjualan
                </p>
                <div class="owner-laporan-arrow">
                    →
                </div>
            </div>
        </a>

        <!-- CARD PENDAPATAN BULANAN -->
        <a href="{{ route('owner.laporan.pendapatan.bulanan') }}" class="owner-laporan-card bulanan">
            <span class="owner-laporan-card-badge">Income</span>
            <div class="owner-laporan-card-content">
                <span class="owner-laporan-icon">💰</span>
                <h5 class="owner-laporan-card-title">
                    Pendapatan Bulanan
                </h5>
                <p class="owner-laporan-card-desc">
                    Laporan pendapatan dari jasa layanan & penjualan produk per bulan
                </p>
                <div class="owner-laporan-arrow">
                    →
                </div>
            </div>
        </a>

        <!-- CARD PENDAPATAN TAHUNAN -->
        <a href="{{ route('owner.laporan.pendapatan.tahunan') }}" class="owner-laporan-card tahunan">
            <span class="owner-laporan-card-badge">Annual</span>
            <div class="owner-laporan-card-content">
                <span class="owner-laporan-icon">📈</span>
                <h5 class="owner-laporan-card-title">
                    Pendapatan Tahunan
                </h5>
                <p class="owner-laporan-card-desc">
                    Total pendapatan keseluruhan dalam 1 tahun dengan grafik pertumbuhan
                </p>
                <div class="owner-laporan-arrow">
                    →
                </div>
            </div>
        </a>

    </div>

</div>

@endsection