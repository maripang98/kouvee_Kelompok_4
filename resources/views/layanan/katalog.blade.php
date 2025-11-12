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
        <a href="{{ route('layanan.show', $layanan->ID_LAYANAN) }}" class="text-decoration-none text-dark">
          <div class="card border-0 shadow-sm h-100">
            <div class="position-relative">
              <img src="{{ $layanan->GAMBAR_LAYANAN ? asset('storage/' . $layanan->GAMBAR_LAYANAN) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                  class="card-img-top rounded-top" alt="{{ $layanan->NAMA_LAYANAN }}">
            </div>
            <div class="card-body text-center">
              <h6 class="fw-bold text-truncate">{{ $layanan->NAMA_LAYANAN }}</h6>
              <p class="fw-semibold text-dark mb-0">
                Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}
              </p>
            </div>
          </div>
        </a>
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
