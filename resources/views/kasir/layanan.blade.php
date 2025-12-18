@extends('layout.kasir')

@section('title', 'Kasir - Transaksi Layanan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/transaksi_kasir.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/kasir-transaksi.css']) --}}
@endpush

@section('content')

<div class="kasir-transaksi-container">

    <!-- PAGE HEADER -->
    <div class="kasir-transaksi-header">
        <h2 class="kasir-transaksi-title">
            🧾 Transaksi Layanan (Kasir)
        </h2>
    </div>

    <!-- FILTER SECTION -->
    <div class="kasir-filter-card">
        <form method="GET" action="{{ route('kasir.layanan') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="kasir-filter-label">
                    <i class="bi bi-credit-card-fill"></i>
                    Status Pembayaran
                </label>
                <select name="pembayaran" class="form-select kasir-filter-select">
                    <option value="">📋 Semua</option>
                    <option value="Lunas" {{ request('pembayaran') == 'Lunas' ? 'selected' : '' }}>✓ Lunas</option>
                    <option value="Belum Lunas" {{ request('pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>⏸️ Belum Lunas</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="kasir-filter-label">
                    <i class="bi bi-tools"></i>
                    Status Layanan
                </label>
                <select name="status_layanan" class="form-select kasir-filter-select">
                    <option value="">📋 Semua</option>
                    <option value="Belum Dikerjakan" {{ request('status_layanan') == 'Belum Dikerjakan' ? 'selected' : '' }}>⏸️ Belum Dikerjakan</option>
                    <option value="Dalam Pengerjaan" {{ request('status_layanan') == 'Dalam Pengerjaan' ? 'selected' : '' }}>⏳ Dalam Pengerjaan</option>
                    <option value="Selesai" {{ request('status_layanan') == 'Selesai' ? 'selected' : '' }}>✓ Selesai</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="kasir-btn-filter w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('kasir.layanan') }}" class="kasir-btn-reset w-100">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- TABLE SECTION -->
    <div class="kasir-table-container">
        <div class="kasir-table-responsive">
            <table class="kasir-table">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <th>Hewan</th>
                        <th>Total Harga</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status Layanan</th>
                        <th>Status Pembayaran</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $t)
                    <tr>
                        <td>
                            <div class="kasir-no-badge">
                                {{ $transaksi->firstItem() + $loop->index }}
                            </div>
                        </td>
                        <td>
                            <span class="kasir-kode-badge">
                                {{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}
                            </span>
                        </td>
                        <td>
                            @if($t->customer)
                                <i class="bi bi-person-fill" style="color: #FAEAB1;"></i>
                                <strong>{{ $t->customer->NAMA_CUSTOMER }}</strong>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($t->hewan)
                                🐾 {{ $t->hewan->NAMA_HEWAN }}
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td class="kasir-price">
                            💰 Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_LAYANAN, 0, ',', '.') }}
                        </td>
                        <td>
                            <i class="bi bi-calendar-event" style="color: #FAEAB1;"></i>
                            {{ \Carbon\Carbon::parse($t->TGL_TRANSAKSI_PENJUALAN_LAYANAN)->timezone('Asia/Jakarta')->format('d M Y') }}
                            <br>
                            <small style="opacity: 0.7;">
                                <i class="bi bi-clock"></i>
                                {{ \Carbon\Carbon::parse($t->TGL_TRANSAKSI_PENJUALAN_LAYANAN)->timezone('Asia/Jakarta')->format('H:i') }} WIB
                            </small>
                        </td>
                        <td>
                            @php $status = strtolower(trim($t->STATUS_LAYANAN)); @endphp
                            @if ($status === 'selesai')
                                <span class="kasir-status-badge selesai">✓ Selesai</span>
                            @elseif ($status === 'dalam pengerjaan')
                                <span class="kasir-status-badge dalam-pengerjaan">⏳ Pengerjaan</span>
                            @elseif ($status === 'belum dikerjakan')
                                <span class="kasir-status-badge belum-dikerjakan">⏸️ Belum</span>
                            @else
                                <span class="kasir-status-badge belum-dikerjakan">❓ Unknown</span>
                            @endif
                        </td>
                        <td>
                            @if ($t->STATUS_PEMBAYARAN_LAYANAN === 'Lunas')
                                <span class="kasir-status-badge lunas">✓ Sudah Dibayar</span>
                            @else
                                <span class="kasir-status-badge belum-lunas">⏸️ Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            @if ($t->STATUS_PEMBAYARAN_LAYANAN === 'Lunas')
                                <button class="kasir-btn-sudah-bayar" disabled>
                                    ✓ Sudah Dibayar
                                </button>
                            @else
                                <button 
                                    class="kasir-btn-bayar bayarBtn"
                                    data-id="{{ $t->ID_TRANSAKSI_LAYANAN }}"
                                    data-total="{{ $t->TOTAL_HARGA_PENJUALAN_LAYANAN }}"
                                >
                                    💰 Bayar
                                </button>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="kasir-empty-state">
                                <div class="kasir-empty-icon">🧾</div>
                                <div class="kasir-empty-text">
                                    Tidak ada transaksi layanan
                                    @if(request('pembayaran') || request('status_layanan'))
                                        dengan filter yang dipilih
                                    @endif
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
    <div class="kasir-pagination">
        {{ $transaksi->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

<!-- MODAL PEMBAYARAN -->
<div class="modal fade kasir-modal" id="modalBayar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">💰 Pembayaran Layanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="bayar_id">

                <div class="mb-3">
                    <label class="kasir-modal-label">Total Harga</label>
                    <h4 id="total_awal" class="kasir-modal-value"></h4>
                </div>

                <div class="mb-3">
                    <label class="kasir-modal-label">Diskon (Rp)</label>
                    <input type="number" id="bayar_diskon" class="form-control kasir-modal-input" min="0" value="0" placeholder="Masukkan diskon">
                </div>

                <div class="mb-3">
                    <label class="kasir-modal-label">Total Setelah Diskon</label>
                    <h4 id="total_setelah_diskon" class="kasir-modal-value" style="color: #34656D;"></h4>
                </div>

                <div class="mb-3">
                    <label class="kasir-modal-label">Uang Dibayar</label>
                    <input type="number" id="bayar_uang" class="form-control kasir-modal-input" min="0" placeholder="Masukkan uang dibayar">
                </div>

                <div class="mb-3">
                    <label class="kasir-modal-label">Kembalian</label>
                    <h4 id="bayar_kembalian" class="kasir-modal-value" style="color: #ffc107;"></h4>
                </div>
            </div>

            <div class="modal-footer">
                <button class="kasir-btn-modal-cancel" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button class="kasir-btn-modal-confirm" id="btnProsesBayar">
                    <i class="bi bi-check-circle"></i> Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalBayar = new bootstrap.Modal(document.getElementById('modalBayar'));
    let bayar_id = null;
    let bayar_total = 0;
    let total_setelah_diskon = 0;

    // BUKA MODAL BAYAR
    document.querySelectorAll('.bayarBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            bayar_id = this.dataset.id;
            bayar_total = parseInt(this.dataset.total);

            document.getElementById('bayar_id').value = bayar_id;
            document.getElementById('total_awal').textContent = "Rp " + bayar_total.toLocaleString('id-ID');
            document.getElementById('bayar_diskon').value = 0;
            document.getElementById('bayar_uang').value = "";
            document.getElementById('bayar_kembalian').textContent = "";

            total_setelah_diskon = bayar_total;
            document.getElementById('total_setelah_diskon').textContent = "Rp " + total_setelah_diskon.toLocaleString('id-ID');

            modalBayar.show();
        });
    });

    // HITUNG TOTAL SETELAH DISKON
    document.getElementById('bayar_diskon').addEventListener('input', function () {
        let diskon = parseInt(this.value || 0);
        if (diskon < 0) diskon = 0;
        if (diskon > bayar_total) diskon = bayar_total;

        total_setelah_diskon = bayar_total - diskon;
        document.getElementById('total_setelah_diskon').textContent = "Rp " + total_setelah_diskon.toLocaleString('id-ID');
    });

    // HITUNG KEMBALIAN
    document.getElementById('bayar_uang').addEventListener('input', function () {
        let uang = parseInt(this.value || 0);
        let kembali = uang - total_setelah_diskon;

        document.getElementById('bayar_kembalian').textContent = kembali >= 0 ? "Rp " + kembali.toLocaleString('id-ID') : "Uang kurang!";
    });

    // PROSES PEMBAYARAN
    document.getElementById('btnProsesBayar').addEventListener('click', function () {
        let uang = parseInt(document.getElementById('bayar_uang').value || 0);
        let diskon = parseInt(document.getElementById('bayar_diskon').value || 0);

        if (uang < total_setelah_diskon) {
            alert("❌ Uang yang dibayarkan kurang!");
            return;
        }

        fetch(`/kasir/bayar/layanan/${bayar_id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ diskon: diskon })
        })
        .then(res => res.json())
        .then(data => {
            modalBayar.hide();
            window.location.href = `/kasir/nota/layanan/${bayar_id}`;
        });
    });
});
</script>
@endpush