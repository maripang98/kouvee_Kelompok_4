<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami - Kouvee Petshop</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Vite (memuat profile.css & app.js) -->
  @vite(['resources/css/about.css', 'resources/js/app.js'])
</head>
<body>

  <!-- NAVBAR -->
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
                <a class="nav-link {{ Request::is('customer*') ? 'active' : '' }}" href="{{ route('customer.index') }}">Customer</a>
          </li>
          <li class="nav-item">
                <a class="nav-link {{ Request::is('layanan*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Layanan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO SECTION -->
  <section class="hero-profile text-center text-white">
    <div class="container">
      <h1 class="fw-bold">Tentang Kouvee Petshop</h1>
      <p>Memberikan perawatan terbaik untuk sahabat berbulu Anda 🐶🐱</p>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section class="about py-5">
        <div class="container">
    <div class="row align-items-center g-5">
        <div class="col-md-6">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Petshop Logo">
        </div>
        <div class="col-md-6">
        <h2 class="fw-bold mb-3">Profil Kami</h2>
        <p class="text-muted">
            Kouvee Petshop berdiri sejak 2018 dan telah menjadi salah satu pusat perawatan hewan terbaik di Yogyakarta.
            Kami menyediakan berbagai layanan mulai dari grooming, konsultasi dokter hewan, hingga penjualan makanan dan perlengkapan hewan peliharaan.
        </p>
        <p class="text-muted">
            Kami berkomitmen memberikan pelayanan terbaik dengan cinta dan kasih sayang untuk setiap hewan yang datang ke toko kami.
        </p>
        </div>
    </div>
</div>

    </div>
  </section>

  <!-- TEAM SECTION -->
  <section class="team bg-light py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Tim Kami</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Owner">
            <div class="card-body">
              <h5 class="fw-bold">Maria</h5>
              <p>Owner & Grooming Specialist</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1573497491208-6b1acb260507?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Vet">
            <div class="card-body">
              <h5 class="fw-bold">Pace</h5>
              <p>Dokter Hewan</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Staff">
            <div class="card-body">
              <h5 class="fw-bold">Asima</h5>
              <p>Customer Care & Kasir</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section id="contact" class="py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Hubungi Kami</h2>
      <p>📍 Jl. Sudirman No. 45, Yogyakarta</p>
      <p>📞 0812-3456-7890</p>
      <a href="https://wa.me/6281234567890" class="btn btn-success mt-3">Chat WhatsApp</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="text-center text-white bg-dark py-3">
    <p>© 2025 Kouvee Petshop. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
