@extends('layout.app')

@section('title', 'Transaksi Penjualan Layanan')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">🧾 Transaksi Penjualan Layanan</h2>

  <div class="text-end mb-3">
    <a href="{{ route('cs.transaksi_layanan.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Transaksi
    </a>
  </div>

  <!-- 🔍 Filter -->
  <form method="GET" action="{{ route('cs.transaksi_layanan.index') }}" class="row mb-4 align-items-end">
    <div class="col-md-4">
      <label class="form-label fw-semibold">Filter Status Pembayaran</label>
      <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="Semua" {{ ($status ?? '') === 'Semua' ? 'selected' : '' }}>Semua</option>
        <option value="Lunas" {{ ($status ?? '') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
        <option value="Belum Lunas" {{ ($status ?? '') === 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
      </select>
    </div>
  </form>

  <!-- 🔢 Tabel -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark text-center">
          <tr>
            <th width="60">No</th>
            <th>Kode Transaksi</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Status Pembayaran</th>
            <th width="180">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($transaksi as $t)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}</td>
              <td>Rp {{ number_format($t->TOTAL_HARGA_PENJUALAN_LAYANAN, 0, ',', '.') }}</td>
              <td>{{ \Carbon\Carbon::parse($t->TGL_TRANSAKSI_PENJUALAN_LAYANAN)->format('d M Y H:i') }} WIB</td>
              <td>
                @if (trim(strtolower($t->STATUS_PEMBAYARAN_LAYANAN)) === 'lunas')
                  <span class="badge bg-success">Lunas</span>
                @elseif (trim(strtolower($t->STATUS_PEMBAYARAN_LAYANAN)) === 'belum lunas')
                  <span class="badge bg-warning text-dark">Belum Lunas</span>
                @else
                  <span class="badge bg-secondary">Tidak Diketahui</span>
                @endif
              </td>
              <td>
                <a href="{{ route('cs.transaksi_layanan.edit', $t->ID_TRANSAKSI_LAYANAN) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil"></i> Edit
                </a>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $t->ID_TRANSAKSI_LAYANAN }}">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-3">Belum ada transaksi layanan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- 📄 Pagination -->
  <div class="mt-3 d-flex justify-content-center">
    {{ $transaksi->appends(['status' => $status])->links() }}
  </div>
</div>

<!-- 🗑️ Modal Konfirmasi Hapus -->
@foreach ($transaksi as $t)
<div class="modal fade" id="hapusModal{{ $t->ID_TRANSAKSI_LAYANAN }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $t->ID_TRANSAKSI_LAYANAN }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="hapusModalLabel{{ $t->ID_TRANSAKSI_LAYANAN }}">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        Apakah Anda yakin ingin menghapus transaksi <strong>{{ $t->KODE_TRANSAKSI_PENJUALAN_LAYANAN }}</strong>?
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="{{ route('cs.transaksi_layanan.destroy', $t->ID_TRANSAKSI_LAYANAN) }}" method="POST" class="d-inline">
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
