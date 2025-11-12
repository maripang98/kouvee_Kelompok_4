@extends('layout.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="container py-5">

  <!-- 🔍 SEARCH BAR -->
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-4">🛍️ Semua Produk</h2>

    <form method="GET" action="{{ route('produk.katalog') }}" class="d-flex justify-content-center">
      <input type="text" name="search" class="form-control w-50 me-2 shadow-sm" 
             placeholder="Cari nama produk..." value="{{ request('search') }}">
      <button class="btn btn-warning fw-semibold shadow-sm">Cari</button>
    </form>
  </div>

  <!-- 🛒 PRODUK GRID -->
  <div class="row g-4">
    @forelse ($produks as $produk)
    <div class="col-6 col-md-3">
    <a href="{{ route('produk.show', $produk->ID_PRODUK) }}" class="text-decoration-none text-dark">
      <div class="card border-0 shadow-sm h-100 product-card">
        <div class="position-relative">
          <img src="{{ $produk->GAMBAR_PRODUK ? asset('storage/' . $produk->GAMBAR_PRODUK) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
              class="card-img-top rounded-top" alt="{{ $produk->NAMA_PRODUK }}">
          <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
            Stok {{ $produk->STOK_PRODUK }}
          </span>
        </div>

        <div class="card-body text-center">
          <h6 class="fw-bold text-truncate">{{ $produk->NAMA_PRODUK }}</h6>
          <p class="fw-semibold text-dark mb-0">
            Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}
          </p>
        </div>
      </div>
    </a>
  </div>
    @empty
      <div class="text-center text-muted py-5">
        <p class="mb-0">😿 Tidak ada produk ditemukan.</p>
      </div>
    @endforelse
  </div>

  <!-- PAGINATION -->
  <div class="mt-5 d-flex justify-content-center">
    {{ $produks->appends(request()->input())->links() }}
  </div>

</div>
@endsection
