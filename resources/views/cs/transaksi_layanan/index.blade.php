@extends('layout.cs')

@section('title', 'Transaksi Penjualan Layanan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index_transaksi_layanan.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/cs-transaksi-layanan.css']) --}}
@endpush

@section('content')

<div class="cs-transaksi-layanan-container">

    <!-- PAGE HEADER -->
    <div class="cs-transaksi-layanan-header">
        <h2 class="cs-transaksi-layanan-title">
            🧾 Transaksi Penjualan Layanan
        </h2>
        <p class="cs-transaksi-layanan-subtitle">Kelola transaksi layanan grooming & perawatan hewan</p>
    </div>

    <!-- STATS CARD -->
    <div class="cs-transaksi-layanan-stats">
        <div class="cs-layanan-stat-item">
            <div class="cs-layanan-stat-label">Total Transaksi</div>
            <div class="cs-layanan-stat-value">{{ $transaksi->total() }}</div>
        </div>
        <div class="cs-layanan-stat-item">
            <div class="cs-layanan-stat-label">Selesai</div>
            <div class="cs-layanan-stat-value">
                {{ $transaksi->filter(fn($t) => strtolower(trim($t->STATUS_LAYANAN)) === 'selesai')->count() }}
            </div>
        </div>
        <div class="cs-layanan-stat-item">
            <div class="cs-layanan-stat-label">Dalam Pengerjaan</div>
            <div class="cs-layanan-stat-value">
                {{ $transaksi->filter(fn($t) => strtolower(trim($t->STATUS_LAYANAN)) === 'dalam pengerjaan')->count() }}
            </div>
        </div>
        <div class="cs-layanan-stat-item">
            <div class="cs-layanan-stat-label">Belum Dikerjakan</div>
            <div class="cs-layanan-stat-value">
                {{ $transaksi->filter(fn($t) => strtolower(trim($t->STATUS_LAYANAN)) === 'belum dikerjakan')->count() }}
            </div>
        </div>
    </div>

    <!-- FILTER SECTION -->
    <div class="cs-transaksi-layanan-filter">
        <form method="GET" action="{{ route('cs.transaksi_layanan.index') }}" class="row align-items-end">
            <div class="col-md-4">
                <label class="cs-filter-label">
                    <i class="bi bi-funnel-fill" style="color: #FAEAB1;"></i>
                    Filter Status Layanan
                </label>
                <select name="status" class="form-select cs-filter-select" onchange="this.form.submit()">
                    <option value="Semua" {{ ($status ?? '') === 'Semua' ? 'selected' : '' }}>📋 Semua Status</option>
                    <option value="Selesai" {{ ($status ?? '') === 'Selesai' ? 'selected' : '' }}>✓ Selesai</option>
                    <option value="Dalam Pengerjaan" {{ ($status ?? '') === 'Dalam Pengerjaan' ? 'selected' : '' }}>⏳ Dalam Pengerjaan</option>
                    <option value="Belum Dikerjakan" {{ ($status ?? '') === 'Belum Dikerjakan' ? 'selected' : '' }}>⏸️ Belum Dikerjakan</option>
                </select>
            </div>
        </form>
    </div>

    <!-- ACTION HEADER -->
    <div class="cs-transaksi-layanan-action-header">
        <div class="cs-transaksi-layanan-info">
            Menampilkan <strong>{{ $transaksi->count() }}</strong> dari <strong>{{ $transaksi->total() }}</strong> transaksi
            @if(isset($status) && $status !== 'Semua')
                <span style="color: #FAEAB1; font-weight: 700;"> ({{ $status }})</span>
            @endif
        </div>
        <a href="{{ route('cs.transaksi_layanan.create') }}" class="cs-transaksi-layanan-btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Transaksi Baru
        </a>
    </div>

    <!-- TABLE SECTION -->
    <div class="cs-transaksi-layanan-table-container">
        <div class="cs-layanan-table-responsive">
            <table class="cs-transaksi-layanan-table">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <th>Total Harga</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status Layanan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $t)
                    <tr>
                        <td>
                            <div class="cs-layanan-no-badge">
                                {{ $transaksi->firstItem() + $loop->index }}
                            </div>
                        </td>
                        <td>
                            <span class="cs-layanan-kode-badge">
                                {{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}
                            </span>
                        </td>
                        <td class="cs-layanan-customer">
                            @if($t->customer)
                                <i class="bi bi-person-fill" style="color: #FAEAB1;"></i>
                                {{ $t->customer->NAMA_CUSTOMER }}
                            @else
                                <span style="color: #999;">Tidak diketahui</span>
                            @endif
                        </td>
                        <td class="cs-layanan-price">
                            <span class="cs-layanan-price-icon">💰</span>
                            Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_LAYANAN, 0, ',', '.') }}
                        </td>
                        <td class="cs-layanan-date">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($t->updated_at ?? $t->TGL_TRANSAKSI_PENJUALAN_LAYANAN)
                                ->timezone('Asia/Jakarta')
                                ->format('d M Y') }}
                            <br>
                            <small style="opacity: 0.7;">
                                <i class="bi bi-clock"></i>
                                {{ \Carbon\Carbon::parse($t->updated_at ?? $t->TGL_TRANSAKSI_PENJUALAN_LAYANAN)
                                    ->timezone('Asia/Jakarta')
                                    ->format('H:i') }} WIB
                            </small>
                        </td>
                        <td>
                            @php
                                $status = strtolower(trim($t->STATUS_LAYANAN));
                            @endphp

                            @if ($status === 'selesai')
                                <span class="cs-status-badge selesai">Selesai</span>
                            @elseif ($status === 'dalam pengerjaan')
                                <span class="cs-status-badge dalam-pengerjaan">Pengerjaan</span>
                            @elseif ($status === 'belum dikerjakan')
                                <span class="cs-status-badge belum-dikerjakan">Belum</span>
                            @else
                                <span class="cs-status-badge tidak-diketahui">Unknown</span>
                            @endif
                        </td>
                        <td>
                            <div class="cs-layanan-action-buttons">
                                <a href="{{ route('cs.transaksi_layanan.edit', $t->ID_TRANSAKSI_LAYANAN) }}" 
                                   class="cs-layanan-btn-action cs-layanan-btn-edit"
                                   title="Edit transaksi">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <button type="button"
                                        class="cs-layanan-btn-action cs-layanan-btn-delete" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $t->ID_TRANSAKSI_LAYANAN }}"
                                        title="Hapus transaksi">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $t->ID_TRANSAKSI_LAYANAN }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 20px; border: 2px solid #FAF8F1;">
                                <div class="modal-header" style="background: linear-gradient(135deg, #FAEAB1 0%, #FFD700 100%); color: #34656D; border-radius: 18px 18px 0 0;">
                                    <h5 class="modal-title" style="font-weight: 700;">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: brightness(0.5);"></button>
                                </div>
                                <div class="modal-body" style="padding: 30px; text-align: center;">
                                    <div style="font-size: 4rem; margin-bottom: 20px;">⚠️</div>
                                    <h6 style="color: #334443; font-weight: 600; margin-bottom: 15px;">
                                        Yakin ingin menghapus transaksi ini?
                                    </h6>
                                    <p style="color: #334443; opacity: 0.7; margin-bottom: 0;">
                                        <strong>{{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}</strong><br>
                                        Customer: {{ $t->customer->NAMA_CUSTOMER ?? 'Tidak diketahui' }}<br>
                                        Status: 
                                        @if ($status === 'selesai')
                                            <span style="color: #28a745;">Selesai</span>
                                        @elseif ($status === 'dalam pengerjaan')
                                            <span style="color: #ff9800;">Dalam Pengerjaan</span>
                                        @else
                                            <span style="color: #6c757d;">Belum Dikerjakan</span>
                                        @endif
                                        <br>
                                        Total: Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_LAYANAN, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="modal-footer" style="border: none; padding: 20px 30px;">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px; padding: 10px 25px;">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                    <form action="{{ route('cs.transaksi_layanan.destroy', $t->ID_TRANSAKSI_LAYANAN) }}" method="POST" style="display: inline;">
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
                        <td colspan="7">
                            <div class="cs-layanan-empty-state">
                                <div class="cs-layanan-empty-icon">🧾</div>
                                <div class="cs-layanan-empty-text">
                                    Belum ada transaksi layanan
                                    @if(isset($status) && $status !== 'Semua')
                                        dengan status "{{ $status }}"
                                    @endif
                                </div>
                                <div class="cs-layanan-empty-subtext">
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
    <div class="cs-layanan-pagination">
        {{ $transaksi->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

@endsection