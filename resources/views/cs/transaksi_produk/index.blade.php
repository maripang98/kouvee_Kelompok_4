@extends('layout.cs')

@section('title', 'Transaksi Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index_transaksi_produk.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/cs-transaksi-produk.css']) --}}
@endpush

@section('content')

<div class="cs-transaksi-container">

    <!-- PAGE HEADER -->
    <div class="cs-transaksi-header">
        <h2 class="cs-transaksi-title">
            🛒 Transaksi Penjualan Produk
        </h2>
        <p class="cs-transaksi-subtitle">Kelola transaksi penjualan produk kepada customer</p>
    </div>

    <!-- STATS CARD -->
    <div class="cs-transaksi-stats">
        <div class="cs-stat-item">
            <div class="cs-stat-label">Total Transaksi</div>
            <div class="cs-stat-value">{{ $transaksi->total() }}</div>
        </div>
        <div class="cs-stat-item">
            <div class="cs-stat-label">Transaksi Hari Ini</div>
            <div class="cs-stat-value">
                {{ $transaksi->filter(function($t) {
                    return \Carbon\Carbon::parse($t->updated_at)->isToday();
                })->count() }}
            </div>
        </div>
        <div class="cs-stat-item">
            <div class="cs-stat-label">Total Pendapatan</div>
            <div class="cs-stat-value">
                Rp {{ number_format($transaksi->sum('TOTAL_HARGA_PENJUALAN_PRODUK') / 1000, 0) }}K
            </div>
        </div>
    </div>

    <!-- ACTION HEADER -->
    <div class="cs-transaksi-action-header">
        <div class="cs-transaksi-info">
            Menampilkan <strong>{{ $transaksi->count() }}</strong> dari <strong>{{ $transaksi->total() }}</strong> transaksi
        </div>
        <a href="{{ route('cs.transaksi_produk.create') }}" class="cs-transaksi-btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Transaksi Baru
        </a>
    </div>

    <!-- TABLE SECTION -->
    <div class="cs-transaksi-table-container">
        <div class="cs-transaksi-table-responsive">
            <table class="cs-transaksi-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <th>Total Harga</th>
                        <th>Tanggal & Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $t)
                    <tr>
                        <td>
                            <div class="cs-transaksi-no-badge">
                                {{ $loop->iteration + ($transaksi->currentPage() - 1) * $transaksi->perPage() }}
                            </div>
                        </td>
                        <td>
                            <span class="cs-transaksi-kode-badge">
                                {{ $t->KODE_TRANSAKSI_PENJUALAN_PRODUK }}
                            </span>
                        </td>
                        <td class="cs-transaksi-customer">
                            @if($t->customer)
                                <i class="bi bi-person-fill" style="color: #FAEAB1;"></i>
                                {{ $t->customer->NAMA_CUSTOMER }}
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td class="cs-transaksi-price">
                            <span class="cs-transaksi-price-icon">💰</span>
                            Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_PRODUK, 0, ',', '.') }}
                        </td>
                        <td class="cs-transaksi-date">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($t->updated_at)->format('d M Y') }}
                            <br>
                            <small style="opacity: 0.7;">
                                <i class="bi bi-clock"></i>
                                {{ \Carbon\Carbon::parse($t->updated_at)->format('H:i') }} WIB
                            </small>
                        </td>
                        <td>
                            <div class="cs-transaksi-action-buttons">
                                <a href="{{ route('cs.transaksi_produk.edit', $t->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" 
                                   class="cs-transaksi-btn-action cs-transaksi-btn-edit"
                                   title="Edit transaksi">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <button type="button"
                                        class="cs-transaksi-btn-action cs-transaksi-btn-delete" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}"
                                        title="Hapus transaksi">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 20px; border: 2px solid #FAF8F1;">
                                <div class="modal-header" style="background: linear-gradient(135deg, #34656D 0%, #334443 100%); color: #FAF8F1; border-radius: 18px 18px 0 0;">
                                    <h5 class="modal-title">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="padding: 30px; text-align: center;">
                                    <div style="font-size: 4rem; margin-bottom: 20px;">⚠️</div>
                                    <h6 style="color: #334443; font-weight: 600; margin-bottom: 15px;">
                                        Yakin ingin menghapus transaksi ini?
                                    </h6>
                                    <p style="color: #334443; opacity: 0.7; margin-bottom: 0;">
                                        <strong>{{ $t->KODE_TRANSAKSI_PENJUALAN_PRODUK }}</strong><br>
                                        Customer: {{ $t->customer->NAMA_CUSTOMER ?? '-' }}<br>
                                        Total: Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_PRODUK, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="modal-footer" style="border: none; padding: 20px 30px;">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px; padding: 10px 25px;">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                    <form action="{{ route('cs.transaksi_produk.destroy', $t->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="border-radius: 10px; padding: 10px 25px;">
                                            <i class="bi bi-trash"></i> Ya, Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="cs-transaksi-empty-state">
                                <div class="cs-transaksi-empty-icon">🛒</div>
                                <div class="cs-transaksi-empty-text">
                                    Belum ada transaksi penjualan produk
                                </div>
                                <div class="cs-transaksi-empty-subtext">
                                    Klik tombol "Tambah Transaksi Baru" untuk membuat transaksi pertama
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    @if($transaksi->hasPages())
    <div class="cs-transaksi-pagination">
        {{ $transaksi->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

@endsection