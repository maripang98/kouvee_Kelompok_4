<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kouvee Petshop | Home</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/home.css') }}">

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      🐾 Kouvee Petshop
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center gap-2">

        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">
            About Us
          </a>
        </li>

        {{-- ================= AUTH ACTION ================= --}}
        @guest
        <li class="nav-item ms-2">
          <a href="{{ route('login') }}"
             class="btn login-btn d-flex align-items-center gap-2
                    {{ Request::is('login') ? 'active-login' : '' }}">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
          </a>
        </li>
        @endguest

        @auth
        <li class="nav-item dropdown ms-2">
          <a class="btn login-btn dropdown-toggle d-flex align-items-center gap-2"
             href="#"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            {{ Auth::user()->NAMA_PEGAWAI }}
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
              @if(Auth::user()->isOwner())
                <a class="dropdown-item" href="{{ route('owner.dashboard') }}">Dashboard Owner</a>
              @elseif(Auth::user()->isCs())
                <a class="dropdown-item" href="{{ route('cs.dashboard') }}">Dashboard CS</a>
              @elseif(Auth::user()->isKasir())
                <a class="dropdown-item" href="{{ route('kasir.dashboard') }}">Dashboard Kasir</a>
              @endif
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger">
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>

<!-- ================= HERO CAROUSEL ================= -->
<div class="container mt-5 pt-4">
  <div class="carousel-home">
    <div id="homeCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
      <div class="carousel-inner h-100">
        <div class="carousel-item active h-100">
          <img src="{{ Vite::asset('resources/images/1.png') }}" alt="Slide 1">
        </div>
        <div class="carousel-item h-100">
          <img src="{{ Vite::asset('resources/images/2.png') }}" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
          <img src="{{ Vite::asset('resources/images/3.png') }}" alt="Slide 3">
        </div>
      </div>
    </div>

    <div class="carousel-btn">
      <a href="#products" class="btn">
        🛍️ Lihat Produk & Layanan
      </a>
    </div>
  </div>
</div>

<!-- ================= PRODUK ================= -->
<section id="products" class="products-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h2 class="section-header">Produk Kami</h2>
      <a href="{{ route('produk.katalog') }}" class="btn btn-outline-warning">
        Lihat Semua Produk →
      </a>
    </div>

    <div class="row g-4">
      @foreach ($produks as $produk)
        <div class="col-md-3">
          <div class="card product-card shadow-sm">
            <img
              src="{{ $produk->GAMBAR_PRODUK
                ? asset('storage/' . $produk->GAMBAR_PRODUK)
                : 'https://via.placeholder.com/400x250?text=No+Image' }}"
              class="card-img-top"
              alt="{{ $produk->NAMA_PRODUK }}">

            <div class="card-body text-center">
              <h5 class="card-title">{{ $produk->NAMA_PRODUK }}</h5>
              <span class="badge bg-secondary mb-2">
                Stok: {{ $produk->STOK_PRODUK }}
              </span>
              <p class="price-tag mt-2">
                Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ================= LAYANAN ================= -->
<section id="services" class="services-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h2 class="section-header">Layanan Kami</h2>
      <a href="{{ route('layanan.katalog') }}" class="btn btn-outline-dark">
        Lihat Semua Layanan →
      </a>
    </div>

    <div class="row g-4">
      @foreach ($layanans as $layanan)
        <div class="col-md-3">
          <div class="card service-card shadow-sm">
            <img
              src="{{ $layanan->GAMBAR_LAYANAN
                ? asset('storage/' . $layanan->GAMBAR_LAYANAN)
                : 'https://via.placeholder.com/400x250?text=No+Image' }}"
              class="card-img-top"
              alt="{{ $layanan->NAMA_LAYANAN }}">

            <div class="card-body text-center">
              <h5 class="card-title">{{ $layanan->NAMA_LAYANAN }}</h5>
              <p class="text-muted small">
                {{ Str::limit($layanan->DESKRIPSI_LAYANAN, 60) }}
              </p>
              <p class="price-tag">
                Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="text-white text-center py-3">
  © 2025 Kouvee Petshop. All Rights Reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
