@extends('layout.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="row g-0">
          <!-- Gambar Produk -->
          <div class="col-md-5">
            <img src="{{ $produk->GAMBAR_PRODUK ? asset('storage/' . $produk->GAMBAR_PRODUK) : 'https://via.placeholder.com/400x400?text=No+Image' }}" 
                 alt="{{ $produk->NAMA_PRODUK }}" 
                 class="img-fluid rounded-start" 
                 style="object-fit: cover; height: 100%;">
          </div>

          <!-- Detail Produk -->
          <div class="col-md-7">
            <div class="card-body p-4">
              <h3 class="fw-bold mb-3">{{ $produk->NAMA_PRODUK }}</h3>
              <p class="text-muted">{{ $produk->DESKRIPSI_PRODUK }}</p>
              <hr>
              <p class="fw-semibold">Harga: 
                <span class="text-success">Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}</span>
              </p>
              <p class="fw-semibold">Stok: {{ $produk->STOK_PRODUK }}</p>
              <hr>
              <a href="{{ route('produk.katalog') }}" class="btn btn-outline-secondary">← Kembali ke Katalog</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
