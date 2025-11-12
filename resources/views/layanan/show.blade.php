@extends('layout.app')

@section('title', 'Detail Layanan')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="row g-0">
          <!-- Gambar Layanan -->
          <div class="col-md-5">
            <img src="{{ $layanan->GAMBAR_LAYANAN ? asset('storage/' . $layanan->GAMBAR_LAYANAN) : 'https://via.placeholder.com/400x400?text=No+Image' }}" 
                 alt="{{ $layanan->NAMA_LAYANAN }}" 
                 class="img-fluid rounded-start" 
                 style="object-fit: cover; height: 100%;">
          </div>

          <!-- Detail Layanan -->
          <div class="col-md-7">
            <div class="card-body p-4">
              <h3 class="fw-bold mb-3">{{ $layanan->NAMA_LAYANAN }}</h3>
              <p class="text-muted">{{ $layanan->DESKRIPSI_LAYANAN }}</p>
              <hr>
              <p class="fw-semibold">Harga:
                <span class="text-success">Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}</span>
              </p>
              <hr>
              <a href="{{ route('layanan.katalog') }}" class="btn btn-outline-secondary">
                ← Kembali ke Daftar Layanan
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
