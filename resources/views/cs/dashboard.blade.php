@extends('layout.cs')

@section('title', 'Dashboard CS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard_cs.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/cs-dashboard.css']) --}}
@endpush

@section('content')

<div class="cs-dashboard-container">

    <!-- PAGE TITLE -->
    <h1 class="cs-dashboard-title">📊 Dashboard Customer Service</h1>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 cs-summary-cards">
        
        <!-- Total Customer -->
        <div class="col-md-6">
            <div class="card cs-summary-card border-0">
                <div class="cs-icon-circle customer">
                    👥
                </div>
                <div class="cs-summary-title">Total Customer</div>
                <div class="cs-summary-value">{{ $totalCustomer }}</div>
                <a href="{{ route('cs.customer.index') }}" class="cs-summary-btn customer">
                    Kelola Customer
                </a>
            </div>
        </div>

        <!-- Total Hewan -->
        <div class="col-md-6">
            <div class="card cs-summary-card border-0">
                <div class="cs-icon-circle hewan">
                    🐾
                </div>
                <div class="cs-summary-title">Total Hewan</div>
                <div class="cs-summary-value">{{ $totalHewan }}</div>
                <a href="{{ route('cs.hewan.index') }}" class="cs-summary-btn hewan">
                    Kelola Hewan
                </a>
            </div>
        </div>

    </div>

    <!-- SECTION DIVIDER -->
    <hr class="cs-section-divider">

    <!-- DATA TABLES - Customer & Hewan -->
    <div class="row g-4 cs-data-section">

        <!-- Customer Terbaru -->
        <div class="col-lg-6">
            <div class="card cs-data-card border-0">
                <div class="cs-data-card-header">
                    <h5 class="cs-data-card-title">
                        <span class="cs-data-card-title-icon">👥</span>
                        <span>Customer Terbaru</span>
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table cs-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $c)
                            <tr>
                                <td><strong>{{ $c->NAMA_CUSTOMER }}</strong></td>
                                <td>{{ $c->NOMOR_TELEPON_CUSTOMER ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="cs-empty-state">
                                    <i class="bi bi-people"></i>
                                    <div class="cs-empty-state-text">Belum ada customer</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Hewan Terbaru -->
        <div class="col-lg-6">
            <div class="card cs-data-card border-0">
                <div class="cs-data-card-header">
                    <h5 class="cs-data-card-title">
                        <span class="cs-data-card-title-icon">🐾</span>
                        <span>Hewan Terbaru</span>
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table cs-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Hewan</th>
                                <th>Jenis</th>
                                <th>Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hewans as $h)
                            <tr>
                                <td><strong>{{ $h->NAMA_HEWAN }}</strong></td>
                                <td>{{ $h->JENIS_HEWAN }}</td>
                                <td>{{ $h->customer->NAMA_CUSTOMER ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="cs-empty-state">
                                    <i class="bi bi-heart"></i>
                                    <div class="cs-empty-state-text">Belum ada hewan</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- SECTION DIVIDER -->
    <hr class="cs-section-divider">

    <!-- DATA TABLES - Produk & Layanan -->
    <div class="row g-4 cs-data-section">

        <!-- Produk -->
        <div class="col-lg-6">
            <div class="card cs-data-card border-0">
                <div class="cs-data-card-header">
                    <h5 class="cs-data-card-title">
                        <span class="cs-data-card-title-icon">📦</span>
                        <span>Produk Tersedia</span>
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table cs-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produks as $p)
                            <tr>
                                <td><strong>{{ Str::limit($p->NAMA_PRODUK, 30) }}</strong></td>
                                <td>Rp {{ number_format($p->HARGA_PRODUK, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->STOK_PRODUK < 10)
                                        <span class="cs-table-badge low-stock">{{ $p->STOK_PRODUK }}</span>
                                    @else
                                        <span class="cs-table-badge in-stock">{{ $p->STOK_PRODUK }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="cs-empty-state">
                                    <i class="bi bi-box-seam"></i>
                                    <div class="cs-empty-state-text">Belum ada produk</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Layanan -->
        <div class="col-lg-6">
            <div class="card cs-data-card border-0">
                <div class="cs-data-card-header">
                    <h5 class="cs-data-card-title">
                        <span class="cs-data-card-title-icon">✂️</span>
                        <span>Layanan Tersedia</span>
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table cs-table mb-0">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanans as $l)
                            <tr>
                                <td><strong>{{ Str::limit($l->NAMA_LAYANAN, 35) }}</strong></td>
                                <td>Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="cs-empty-state">
                                    <i class="bi bi-scissors"></i>
                                    <div class="cs-empty-state-text">Belum ada layanan</div>
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