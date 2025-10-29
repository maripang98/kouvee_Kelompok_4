<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kouvee Petshop | Owner Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite(['resources/css/owner.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{ route('owner.dashboard') }}">Kouvee Owner</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link {{ Request::is('owner/dashboard') ? 'active' : '' }}" href="{{ route('owner.dashboard') }}">Dashboard</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🏠 MAIN CONTENT -->
  <div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">📊 Dashboard Owner</h1>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-4">
          <h5 class="fw-bold text-secondary">Total Produk</h5>
          <h2 class="fw-bold text-primary">{{ $totalProduk }}</h2>
          <a href="{{ route('owner.produk.index') }}" class="btn btn-outline-primary btn-sm mt-2">Kelola Produk</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-4">
          <h5 class="fw-bold text-secondary">Total Layanan</h5>
          <h2 class="fw-bold text-success">{{ $totalLayanan }}</h2>
          <a href="{{ route('owner.layanan.index') }}" class="btn btn-outline-success btn-sm mt-2">Kelola Layanan</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-4">
          <h5 class="fw-bold text-secondary">Total Pegawai</h5>
          <h2 class="fw-bold text-warning">{{ $totalPegawai }}</h2>
          <a href="{{ route('owner.pegawai.index') }}" class="btn btn-outline-warning btn-sm mt-2">Kelola Pegawai</a>
        </div>
      </div>
    </div>

    <!-- DATA TABLES -->
    <div class="row g-4">
      <!-- Produk -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">📦 Produk Terbaru</h5>
            <a href="{{ route('owner.produk.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
          </div>
          <table class="table table-sm table-striped align-middle mb-0">
            <thead class="table-dark">
              <tr><th>Nama</th><th>Stok</th></tr>
            </thead>
            <tbody>
              @foreach ($produk as $p)
                <tr><td>{{ $p->NAMA_PRODUK }}</td><td>{{ $p->STOK_PRODUK }}</td></tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Layanan -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">🧼 Layanan Terbaru</h5>
            <a href="{{ route('owner.layanan.index') }}" class="btn btn-sm btn-success">Lihat Semua</a>
          </div>
          <table class="table table-sm table-striped align-middle mb-0">
            <thead class="table-dark">
              <tr><th>Nama</th><th>Harga</th></tr>
            </thead>
            <tbody>
              @foreach ($layanan as $l)
                <tr><td>{{ $l->NAMA_LAYANAN }}</td><td>Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }}</td></tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pegawai -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">👩‍💼 Pegawai Terbaru</h5>
            <a href="{{ route('owner.pegawai.index') }}" class="btn btn-sm btn-warning">Lihat Semua</a>
          </div>
          <table class="table table-sm table-striped align-middle mb-0">
            <thead class="table-dark">
              <tr><th>Nama</th><th>Username</th></tr>
            </thead>
            <tbody>
              @foreach ($pegawai as $pg)
                <tr><td>{{ $pg->NAMA_PEGAWAI }}</td><td>{{ $pg->USERNAME }}</td></tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© 2025 Kouvee Petshop Owner Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
