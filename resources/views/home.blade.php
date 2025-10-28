<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kouvee Petshop | Home</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Load Laravel CSS & JS -->
  @vite(['resources/css/home.css', 'resources/js/app.js'])
</head>

<body>

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">🐾 Kouvee Petshop</a>
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
          <li class="nav-item">
            <a class="nav-link {{ Request::is('cruds') ? 'active' : '' }}" href="{{ url('/cruds') }}">Cruds</a>
          </li>
          <li class="nav-item">
                <a class="nav-link {{ Request::is('customer*') ? 'active' : '' }}" href="{{ route('customer.index') }}">Customer</a>
          </li>
          <li class="nav-item">
                <a class="nav-link {{ Request::is('layanan*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Layanan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🌟 HERO SECTION -->
  <section class="hero-home text-center text-white d-flex align-items-center justify-content-center">
    <div class="container">
      <h1 class="fw-bold">Selamat Datang di Kouvee Petshop</h1>
      <p class="lead">Temukan produk & layanan terbaik untuk hewan kesayanganmu 🐶🐱</p>
      <a href="#products" class="btn btn-warning btn-lg mt-3">Lihat Produk & Layanan</a>
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
      <h2 class="fw-bold text-center mb-4">Ketersediaan Produk</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 product-card">
            <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Dog Shampoo">
            <div class="card-body text-center">
              <h5 class="card-title">Dog Shampoo</h5>
              <p>Stok: <strong>25 pcs</strong></p>
              <p>Harga: <strong>Rp 50.000</strong></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 product-card">
            <img src="https://images.unsplash.com/photo-1601758125946-6ec2ef642b04?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Cat Food">
            <div class="card-body text-center">
              <h5 class="card-title">Cat Food Premium</h5>
              <p>Stok: <strong>40 pcs</strong></p>
              <p>Harga: <strong>Rp 75.000</strong></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 product-card">
            <img src="https://images.unsplash.com/photo-1612817159949-1f4b62c4148b?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Pet Toys">
            <div class="card-body text-center">
              <h5 class="card-title">Pet Toys</h5>
              <p>Stok: <strong>18 pcs</strong></p>
              <p>Harga: <strong>Rp 35.000</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 🧼 LAYANAN SECTION -->
  <section id="services" class="bg-light py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Layanan Kami</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-4 service-card">
            <div class="service-icon fs-1 mb-3">🛁</div>
            <h5 class="fw-bold">Grooming Hewan</h5>
            <p class="text-muted">Perawatan lengkap untuk menjaga kebersihan & kesehatan hewan kesayangan Anda.</p>
            <p><strong>Harga mulai Rp 100.000</strong></p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-4 service-card">
            <div class="service-icon fs-1 mb-3">🏥</div>
            <h5 class="fw-bold">Konsultasi Dokter Hewan</h5>
            <p class="text-muted">Layanan profesional dengan dokter berpengalaman.</p>
            <p><strong>Harga mulai Rp 150.000</strong></p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-4 service-card">
            <div class="service-icon fs-1 mb-3">🍖</div>
            <h5 class="fw-bold">Penjualan Makanan & Aksesoris</h5>
            <p class="text-muted">Berbagai kebutuhan hewan tersedia dengan kualitas terbaik.</p>
            <p><strong>Harga bervariasi</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 📍 CONTACT SECTION -->
  <section id="contact" class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Hubungi Kami</h2>
      <p>📍 Jl. Sudirman No. 45, Yogyakarta</p>
      <p>📞 0812-3456-7890</p>
      <a href="https://wa.me/6281234567890" class="btn btn-success mt-3">Chat via WhatsApp</a>
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
