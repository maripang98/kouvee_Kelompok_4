<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kouvee Petshop | Home</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Load Laravel CSS & JS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}"> Kouvee Petshop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🌟 HERO SECTION -->
<!-- 🌟 HERO SECTION -->
  <section class="hero-home mt-5 text-center position-relative d-flex align-items-center justify-content-center">
    <div class="overlay"></div>

    <div class="container position-relative text-dark">
      <h1 class="fw-bold display-4 mb-3 animate__animated animate__fadeInDown">
        Selamat Datang di <span class="text-warning">Kouvee Petshop</span>
      </h1>
      <p class="lead mb-4 text-secondary animate__animated animate__fadeInUp">
        Temukan produk & layanan terbaik untuk hewan kesayanganmu 🐶🐱
      </p>
      <a href="#products" class="btn btn-warning btn-lg shadow-lg fw-semibold animate__animated animate__zoomIn">
        🛍️ Lihat Produk & Layanan
      </a>
    </div>
  </section>

  <!-- 🔍 SEARCH SECTION -->
  <section class="py-5 bg-light" id="search">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Cari Produk & Layanan</h2>
      <form class="d-flex justify-content-center" role="search">
        <input class="form-control w-50 me-2" type="search" placeholder="Cari nama produk atau layanan..." aria-label="Search">
        <button class="btn btn-warning" type="submit">Cari</button>
      </form>
    </div>
  </section>

  <!-- 🛒 PRODUK SECTION -->
<section id="products" class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Produk Kami</h2>
      <a href="{{ route('produk.katalog') }}" class="btn btn-outline-warning btn-sm">Lihat Semua Produk →</a>
    </div>

    <div class="row g-4">
      @foreach ($produks as $produk)
        <div class="col-md-3">
          <div class="card border-0 shadow-sm h-100">
            <img 
              src="{{ $produk->GAMBAR_PRODUK 
                      ? asset('storage/' . $produk->GAMBAR_PRODUK) 
                      : 'https://via.placeholder.com/400x250?text=No+Image' }}" 
              class="card-img-top" 
              alt="{{ $produk->NAMA_PRODUK }}">
            <div class="card-body text-center">
              <h5 class="card-title">{{ $produk->NAMA_PRODUK }}</h5>
              <p class="text-muted small mb-1">Stok: {{ $produk->STOK_PRODUK }}</p>
              <p class="fw-semibold text-dark mb-0">Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>



  <!-- 🧼 LAYANAN SECTION -->
<section id="services" class="bg-light py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Layanan Kami</h2>
      <a href="{{ route('layanan.katalog') }}" class="btn btn-outline-dark btn-sm">Lihat Semua Layanan →</a>
    </div>

    <div class="row g-4">
      @foreach ($layanans as $layanan)
        <div class="col-md-3">
          <div class="card border-0 shadow-sm h-100">
            <img src="{{ $layanan->GAMBAR_LAYANAN ? asset('storage/' . $layanan->GAMBAR_LAYANAN) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                 class="card-img-top" alt="{{ $layanan->NAMA_LAYANAN }}">
            <div class="card-body text-center">
              <h5 class="fw-bold">{{ $layanan->NAMA_LAYANAN }}</h5>
              <p class="text-muted small">{{ Str::limit($layanan->DESKRIPSI_LAYANAN, 60) }}</p>
              <p class="fw-semibold text-dark mb-0">Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>© 2025 Kouvee Petshop. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
