@extends('layout.app')

@section('title', 'Transaksi Produk')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">🛒 Transaksi Penjualan Produk</h2>

  <!-- Tombol Tambah Transaksi -->
  <div class="text-end mb-3">
    <a href="{{ route('cs.transaksi_produk.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Transaksi
    </a>
  </div>

  <!-- Tabel Transaksi -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark text-center">
          <tr>
            <th width="60">No</th>
            <th>Kode Transaksi</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th width="160">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($transaksi as $t)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $t->KODE_TRANSAKSI_PENJUALAN_PRODUK }}</td>
              <td>Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_PRODUK, 0, ',', '.') }}</td>
              <td>{{ \Carbon\Carbon::parse($t->updated_at ?? $t->TGL_TRANSAKSI_PENJUALAN_PRODUK)->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</td>
              <td>
                <a href="{{ route('cs.transaksi_produk.edit', $t->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil"></i> Edit
                </a>
                <button 
                  class="btn btn-sm btn-danger" 
                  data-bs-toggle="modal" 
                  data-bs-target="#hapusModal{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted py-3">Belum ada transaksi produk.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="mt-4">
    <div class="d-flex justify-content-center">
      {{ $transaksi->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
  </div>


<!-- Modal Konfirmasi Hapus (Ditaruh di luar tabel agar tidak lag) -->
@foreach ($transaksi as $t)
<div class="modal fade" 
     id="hapusModal{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}" 
     tabindex="-1" 
     aria-labelledby="hapusModalLabel{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}" 
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-semibold" id="hapusModalLabel{{ $t->ID_TRANSAKSI_PENJUALAN_PRODUK }}">
          Konfirmasi Hapus
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Apakah Anda yakin ingin menghapus transaksi 
          <strong>{{ $t->KODE_TRANSAKSI_PENJUALAN_PRODUK }}</strong>?
        </p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="{{ route('cs.transaksi_produk.destroy', $t->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection

@push('styles')
<style>
  /* Pastikan modal muncul di atas semua elemen */
  .modal { z-index: 1055 !important; }
  .modal-backdrop { z-index: 1050 !important; }
</style>
@endpush
