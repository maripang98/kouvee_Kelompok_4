@extends('layout.app')

@section('title', 'Katalog Layanan')

@section('content')
<div class="container py-5">

  <!-- 🔍 SEARCH BAR -->
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-4">🧼 Semua Layanan</h2>

    <form method="GET" action="{{ route('layanan.katalog') }}" class="d-flex justify-content-center">
      <input type="text" name="search" class="form-control w-50 me-2 shadow-sm"
             placeholder="Cari nama layanan..." value="{{ request('search') }}">
      <button class="btn btn-warning fw-semibold shadow-sm">Cari</button>
    </form>
  </div>

  <!-- 💆‍♂️ LAYANAN GRID -->
  <div class="row g-4">
    @forelse ($layanans as $layanan)
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="position-relative">
            <img src="{{ $layanan->GAMBAR_LAYANAN ? asset('storage/' . $layanan->GAMBAR_LAYANAN) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                 class="card-img-top rounded-top" alt="{{ $layanan->NAMA_LAYANAN }}">
            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
            {{ $layanan->created_at ? $layanan->created_at->format('d M Y') : 'Baru' }}
            </span>
          </div>

          <div class="card-body text-center">
            <h6 class="fw-bold text-truncate">{{ $layanan->NAMA_LAYANAN }}</h6>
            <p class="text-muted small mb-2">
              {{ Str::limit($layanan->DESKRIPSI_LAYANAN, 50) }}
            </p>
            <p class="fw-semibold text-dark mb-0">
              Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}
            </p>
          </div>
        </div>
      </div>
    @empty
      <div class="text-center text-muted py-5">
        <p class="mb-0">😿 Tidak ada layanan ditemukan.</p>
      </div>
    @endforelse
  </div>

  <!-- PAGINATION -->
  <div class="mt-5 d-flex justify-content-center">
    {{ $layanans->appends(request()->input())->links() }}
  </div>

</div>
@endsection
