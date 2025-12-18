@extends('layout.kasir')

@section('title', 'Dashboard Kasir')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard_kasir.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/kasir-dashboard.css']) --}}
@endpush

@section('content')

<div class="kasir-dashboard-container">

    <!-- PAGE HEADER -->
    <div class="kasir-dashboard-header">
        <h2 class="kasir-dashboard-title">
            💰 Dashboard Kasir
        </h2>
        <p class="kasir-dashboard-subtitle">
            Pilih jenis transaksi yang ingin diproses
        </p>
    </div>

    <!-- MENU CARDS -->
    <div class="kasir-menu-container">

        <!-- CARD TRANSAKSI PRODUK -->
        <a href="{{ route('kasir.produk') }}" class="kasir-menu-card produk">
            <div class="kasir-menu-card-content">
                <div class="kasir-menu-icon">
                    📦
                </div>
                <h3 class="kasir-menu-title">
                    Transaksi Produk
                </h3>
                <p class="kasir-menu-description">
                    Kelola pembayaran dan cetak struk untuk transaksi penjualan produk
                </p>
                <div class="kasir-menu-arrow">
                    →
                </div>
            </div>
        </a>

        <!-- CARD TRANSAKSI LAYANAN -->
        <a href="{{ route('kasir.layanan') }}" class="kasir-menu-card layanan">
            <div class="kasir-menu-card-content">
                <div class="kasir-menu-icon">
                    🛁
                </div>
                <h3 class="kasir-menu-title">
                    Transaksi Layanan
                </h3>
                <p class="kasir-menu-description">
                    Kelola pembayaran dan cetak struk untuk transaksi layanan grooming
                </p>
                <div class="kasir-menu-arrow">
                    →
                </div>
            </div>
        </a>

    </div>

</div>

@endsection