@extends('layout.owner')

@section('title', 'Dashboard Owner')

<link rel="stylesheet" href="{{ asset('css/dashboard_owner.css') }}">

@section('content')

<div class="dashboard-container">

    <!-- PAGE TITLE -->
    <h1 class="dashboard-title">📊 Dashboard Owner</h1>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 summary-cards">
        <!-- Total Produk -->
        <div class="col-md-4">
            <div class="card summary-card border-0">
                <div class="summary-card-icon produk">
                    📦
                </div>
                <div class="summary-card-title">Total Produk</div>
                <div class="summary-card-value">{{ $totalProduk }}</div>
                <a href="{{ route('owner.produk.index') }}" class="summary-card-btn produk">
                    Kelola Produk
                </a>
            </div>
        </div>

        <!-- Total Layanan -->
        <div class="col-md-4">
            <div class="card summary-card border-0">
                <div class="summary-card-icon layanan">
                    🧼
                </div>
                <div class="summary-card-title">Total Layanan</div>
                <div class="summary-card-value">{{ $totalLayanan }}</div>
                <a href="{{ route('owner.layanan.index') }}" class="summary-card-btn layanan">
                    Kelola Layanan
                </a>
            </div>
        </div>

        <!-- Total Pegawai -->
        <div class="col-md-4">
            <div class="card summary-card border-0">
                <div class="summary-card-icon pegawai">
                    👥
                </div>
                <div class="summary-card-title">Total Pegawai</div>
                <div class="summary-card-value">{{ $totalPegawai }}</div>
                <a href="{{ route('owner.pegawai.index') }}" class="summary-card-btn pegawai">
                    Kelola Pegawai
                </a>
            </div>
        </div>
    </div>

    <!-- DATA TABLES SECTION -->
    <div class="row g-4 data-tables-section">

        <!-- Produk Terbaru -->
        <div class="col-lg-6 col-xl-3">
            <div class="card data-card border-0">
                <div class="data-card-header">
                    <h5 class="data-card-title">
                        <span class="data-card-title-icon">📦</span>
                        <span>Produk Terbaru</span>
                    </h5>
                    <a href="{{ route('owner.produk.index') }}" class="data-card-btn produk">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table premium-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produk as $p)
                            <tr>
                                <td>{{ Str::limit($p->NAMA_PRODUK, 25) }}</td>
                                <td><strong>{{ $p->STOK_PRODUK }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <div>Belum ada produk</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Layanan Terbaru -->
        <div class="col-lg-6 col-xl-3">
            <div class="card data-card border-0">
                <div class="data-card-header">
                    <h5 class="data-card-title">
                        <span class="data-card-title-icon">🧼</span>
                        <span>Layanan Terbaru</span>
                    </h5>
                    <a href="{{ route('owner.layanan.index') }}" class="data-card-btn layanan">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table premium-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanan as $l)
                            <tr>
                                <td>{{ Str::limit($l->NAMA_LAYANAN, 25) }}</td>
                                <td><strong>Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <div>Belum ada layanan</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pegawai Terbaru -->
        <div class="col-lg-6 col-xl-3">
            <div class="card data-card border-0">
                <div class="data-card-header">
                    <h5 class="data-card-title">
                        <span class="data-card-title-icon">👥</span>
                        <span>Pegawai Terbaru</span>
                    </h5>
                    <a href="{{ route('owner.pegawai.index') }}" class="data-card-btn pegawai">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table premium-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pegawai as $pg)
                            <tr>
                                <td>{{ Str::limit($pg->NAMA_PEGAWAI, 20) }}</td>
                                <td><strong>{{ $pg->USERNAME }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <div>Belum ada pegawai</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Laporan Layanan Terlaris -->
        <div class="col-lg-6 col-xl-3">
            <div class="card data-card border-0">
                <div class="data-card-header">
                    <h5 class="data-card-title">
                        <span class="data-card-title-icon">📊</span>
                        <span>Layanan Terlaris</span>
                    </h5>
                    <a href="{{ route('owner.laporan.index') }}" class="data-card-btn laporan">
                        Lihat Semua Laporan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table premium-table mb-0">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Layanan</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporanPreview as $lp)
                            <tr>
                                <td>{{ \Carbon\Carbon::create()->month($lp['bulan'])->translatedFormat('F') }}</td>
                                <td>{{ Str::limit($lp['nama_layanan'], 15) }}</td>
                                <td><strong>{{ $lp['jumlah'] }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <div>Belum ada data</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection