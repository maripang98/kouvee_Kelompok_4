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
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">Kouvee Petshop</a>
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

  <!-- HERO SECTION -->
  <section class="hero-profile">
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
            Kouvee Pet Shop berdiri sejak tahun 2024 dan telah menjadi salah satu pusat perawatan hewan terbaik di Yogyakarta. Kami menyediakan berbagai layanan lengkap mulai dari grooming profesional hingga penjualan makanan dan perlengkapan hewan peliharaan berkualitas tinggi.
            Dengan dukungan tenaga ahli berpengalaman dan fasilitas yang modern, kami berkomitmen untuk memberikan pengalaman terbaik bagi setiap pelanggan dan hewan kesayangannya. Kami juga senantiasa menghadirkan produk-produk unggulan dari merek terpercaya untuk memastikan kebutuhan nutrisi dan kenyamanan hewan peliharaan Anda terpenuhi.
            Kouvee Pet Shop berpegang pada prinsip pelayanan dengan cinta dan kasih sayang, karena kami percaya setiap hewan berhak mendapatkan perhatian dan perawatan terbaik.
        </p>
        <p class="text-muted">
            Kami berkomitmen memberikan pelayanan terbaik dengan cinta dan kasih sayang untuk setiap hewan yang datang ke toko kami.
        </p>
        </div>
    </div>
</div>

    </div>
  </section>

  <!-- VALUES SECTION -->
  <section class="values bg-light py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Nilai-Nilai Kouvee Petshop</h2>
      <p class="mb-5 text-muted">
        Kami berkomitmen memberikan pelayanan terbaik dengan hati, demi kebahagiaan hewan peliharaan Anda.
      </p>

      <div class="row g-4">
        <!-- Value 1 -->
        <div class="col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm h-100">
            <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=800&q=80" 
     class="card-img-top" alt="Kasih Sayang dan Kepedulian">
            <div class="card-body">
              <h5 class="fw-bold">Kasih Sayang & Kepedulian</h5>
              <p>Kami memperlakukan setiap hewan dengan penuh cinta, layaknya keluarga sendiri.</p>
            </div>
          </div>
        </div>

        <!-- Value 2 -->
        <div class="col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm h-100">
            <img src="https://images.unsplash.com/photo-1592194996308-7b43878e84a6?auto=format&fit=crop&w=800&q=80" 
                class="card-img-top" alt="Peduli Hewan">
            <div class="card-body">
              <h5 class="fw-bold">Profesionalisme & Keahlian</h5>
              <p>Setiap layanan dilakukan oleh tim berpengalaman dengan standar kebersihan dan keamanan tinggi.</p>
            </div>
          </div>
        </div>

        <!-- Value 3 -->
        <div class="col-md-4 col-sm-6 mx-auto">
          <div class="card border-0 shadow-sm h-100">
            <img src="https://images.unsplash.com/photo-1525253086316-d0c936c814f8?auto=format&fit=crop&w=800&q=80" 
                class="card-img-top" alt="Kepercayaan">
            <div class="card-body">
              <h5 class="fw-bold">Kepercayaan & Integritas</h5>
              <p>Kami menjaga kepercayaan pelanggan dengan pelayanan jujur, transparan, dan bertanggung jawab.</p>
            </div>
          </div>
        </div>
      </div>
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
