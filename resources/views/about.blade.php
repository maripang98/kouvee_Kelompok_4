<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami - Kouvee Petshop</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vite (memuat profile.css & app.js) -->
  @vite(['resources/css/about.css', 'resources/js/app.js'])
</head>

<style>
* {
  font-family: 'Poppins', sans-serif;
}

body {
  background: #FAF8F1;
  min-height: 100vh;
}

/* ===== NAVBAR PREMIUM ===== */
.navbar {
  backdrop-filter: blur(10px);
  background: rgba(52, 101, 109, 0.95) !important;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
  transition: all 0.3s ease;
}

.navbar-brand {
  font-size: 1.5rem;
  background: linear-gradient(135deg, #FAEAB1 0%, #FFD700 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: 700;
  letter-spacing: 1px;
}

.nav-link {
  position: relative;
  font-weight: 500;
  transition: all 0.3s ease;
  margin: 0 10px;
  color: #FAF8F1 !important;
}

.nav-link:hover {
  color: #FAEAB1 !important;
  transform: translateY(-2px);
}

.nav-link.active {
  color: #FAEAB1 !important;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #FAEAB1, #FFD700);
  transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
  width: 100%;
}

/* ===== HERO SECTION PREMIUM ===== */
.hero-profile {
  background: linear-gradient(135deg, #34656D 0%, #334443 100%);
  padding: 150px 0 100px;
  margin-top: 76px;
  position: relative;
  overflow: hidden;
}

.hero-profile::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(250, 234, 177, 0.08) 1px, transparent 1px);
  background-size: 50px 50px;
  animation: moveBackground 20s linear infinite;
}

@keyframes moveBackground {
  0% { transform: translate(0, 0); }
  100% { transform: translate(50px, 50px); }
}

.hero-profile .container {
  position: relative;
  z-index: 1;
}

.hero-profile h1 {
  color: #FAF8F1;
  font-weight: 700;
  font-size: 3rem;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-profile p {
  color: #FAEAB1;
  font-size: 1.3rem;
  font-weight: 400;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* ===== ABOUT SECTION PREMIUM ===== */
.about {
  padding: 100px 0;
  background: #FAF8F1;
}

.about .row {
  align-items: center;
}

.about img {
  width: 100%;
  border-radius: 30px;
  box-shadow: 0 20px 60px rgba(52, 101, 109, 0.2);
  transition: transform 0.5s ease;
}

.about img:hover {
  transform: scale(1.05) rotate(2deg);
}

.about h2 {
  color: #334443;
  font-weight: 700;
  font-size: 2.5rem;
  margin-bottom: 30px;
  position: relative;
  display: inline-block;
}

.about h2::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, #34656D, #FAEAB1);
  border-radius: 2px;
}

.about p {
  color: #334443;
  font-size: 1.05rem;
  line-height: 1.8;
  margin-bottom: 20px;
  text-align: justify;
}

/* ===== VALUES SECTION PREMIUM ===== */
.values {
  padding: 100px 0;
  background: linear-gradient(135deg, #FAEAB1 0%, #FAF8F1 100%);
  position: relative;
}

.values h2 {
  color: #334443;
  font-weight: 700;
  font-size: 2.5rem;
  margin-bottom: 20px;
  position: relative;
  display: inline-block;
}

.values h2::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, #34656D, #FAEAB1);
  border-radius: 2px;
}

.values > .container > p {
  color: #334443;
  font-size: 1.1rem;
  max-width: 700px;
  margin: 30px auto 60px;
}

/* ===== VALUE CARDS PREMIUM ===== */
.value-card {
  border-radius: 25px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  background: white;
  border: 2px solid #FAF8F1 !important;
  height: 100%;
}

.value-card:hover {
  transform: translateY(-20px);
  box-shadow: 0 25px 60px rgba(52, 101, 109, 0.25);
  border-color: #FAEAB1 !important;
}

.value-card img {
  height: 250px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.value-card:hover img {
  transform: scale(1.15);
}

.value-card .card-body {
  padding: 30px;
  text-align: center;
}

.value-card h5 {
  color: #34656D;
  font-weight: 700;
  font-size: 1.3rem;
  margin-bottom: 15px;
}

.value-card p {
  color: #334443;
  font-size: 1rem;
  line-height: 1.6;
  margin: 0;
}

/* Icon decoration for cards */
.value-card::before {
  content: '🐾';
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 2rem;
  opacity: 0;
  transition: all 0.3s ease;
  z-index: 1;
}

.value-card:hover::before {
  opacity: 0.2;
}

/* ===== FOOTER PREMIUM ===== */
footer {
  background: linear-gradient(135deg, #34656D 0%, #334443 100%);
  padding: 30px 0;
  box-shadow: 0 -10px 30px rgba(52, 101, 109, 0.2);
  color: #FAF8F1;
}

footer p {
  margin: 0;
  font-weight: 500;
  letter-spacing: 1px;
  color: #FAF8F1;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .hero-profile {
    padding: 120px 0 80px;
  }
  
  .hero-profile h1 {
    font-size: 2rem;
  }
  
  .hero-profile p {
    font-size: 1.1rem;
  }
  
  .about h2,
  .values h2 {
    font-size: 2rem;
  }
  
  .about,
  .values {
    padding: 60px 0;
  }
  
  .about img {
    margin-bottom: 30px;
  }
  
  .value-card {
    margin-bottom: 20px;
  }
}

/* ===== SCROLL ANIMATIONS ===== */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.about .row > div {
  animation: fadeInUp 0.8s ease-out;
}

.value-card {
  animation: fadeInUp 0.8s ease-out;
}

.value-card:nth-child(1) {
  animation-delay: 0.1s;
}

.value-card:nth-child(2) {
  animation-delay: 0.2s;
}

.value-card:nth-child(3) {
  animation-delay: 0.3s;
}
</style>

<body>

  <!-- NAVBAR PREMIUM -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO SECTION PREMIUM -->
  <section class="hero-profile text-center">
    <div class="container">
      <h1>Tentang Kouvee Petshop</h1>
      <p>Memberikan perawatan terbaik untuk sahabat berbulu Anda</p>
    </div>
  </section>

  <!-- ABOUT SECTION PREMIUM -->
  <section class="about">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-6">
          <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Kouvee Petshop Logo">
        </div>
        <div class="col-md-6">
          <h2>Profil Kami</h2>
          <p>
            Kouvee Pet Shop berdiri sejak tahun 2024 dan telah menjadi salah satu pusat perawatan hewan terbaik di Yogyakarta. Kami menyediakan berbagai layanan lengkap mulai dari grooming profesional hingga penjualan makanan dan perlengkapan hewan peliharaan berkualitas tinggi.
          </p>
          <p>
            Dengan dukungan tenaga ahli berpengalaman dan fasilitas yang modern, kami berkomitmen untuk memberikan pengalaman terbaik bagi setiap pelanggan dan hewan kesayangannya. Kami juga senantiasa menghadirkan produk-produk unggulan dari merek terpercaya untuk memastikan kebutuhan nutrisi dan kenyamanan hewan peliharaan Anda terpenuhi.
          </p>
          <p>
            Kouvee Pet Shop berpegang pada prinsip pelayanan dengan cinta dan kasih sayang, karena kami percaya setiap hewan berhak mendapatkan perhatian dan perawatan terbaik.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- VALUES SECTION PREMIUM -->
  <section class="values">
    <div class="container text-center">
      <h2>Nilai-Nilai Kouvee Petshop</h2>
      <p>
        Kami berkomitmen memberikan pelayanan terbaik dengan hati, demi kebahagiaan hewan peliharaan Anda.
      </p>

      <div class="row g-5">
        <!-- Value 1 -->
        <div class="col-md-4">
          <div class="card value-card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=800&q=80" 
                 class="card-img-top" alt="Kasih Sayang dan Kepedulian">
            <div class="card-body">
              <h5>Kasih Sayang & Kepedulian</h5>
              <p>Kami memperlakukan setiap hewan dengan penuh cinta, layaknya keluarga sendiri.</p>
            </div>
          </div>
        </div>

        <!-- Value 2 -->
        <div class="col-md-4">
          <div class="card value-card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1592194996308-7b43878e84a6?auto=format&fit=crop&w=800&q=80" 
                 class="card-img-top" alt="Profesionalisme dan Keahlian">
            <div class="card-body">
              <h5>Profesionalisme & Keahlian</h5>
              <p>Setiap layanan dilakukan oleh tim berpengalaman dengan standar kebersihan dan keamanan tinggi.</p>
            </div>
          </div>
        </div>

        <!-- Value 3 -->
        <div class="col-md-4">
          <div class="card value-card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1525253086316-d0c936c814f8?auto=format&fit=crop&w=800&q=80" 
                 class="card-img-top" alt="Kepercayaan dan Integritas">
            <div class="card-body">
              <h5>Kepercayaan & Integritas</h5>
              <p>Kami menjaga kepercayaan pelanggan dengan pelayanan jujur, transparan, dan bertanggung jawab.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER PREMIUM -->
  <footer class="text-center">
    <p>© 2025 Kouvee Petshop. All Rights Reserved. Made with ❤️</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>