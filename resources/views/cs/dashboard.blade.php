<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kouvee Petshop | CS Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite(['resources/css/owner.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{ route('cs.dashboard') }}">📞 Kouvee CS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link {{ Request::is('cs/dashboard') ? 'active' : '' }}" href="{{ route('cs.dashboard') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link {{ Request::is('cs/customer*') ? 'active' : '' }}" href="{{ route('cs.customer.index') }}">Customer</a></li>
          <li class="nav-item"><a class="nav-link {{ Request::is('cs/hewan*') ? 'active' : '' }}" href="{{ route('cs.hewan.index') }}">Hewan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🏠 MAIN CONTENT -->
  <div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">📋 Dashboard Customer Service</h1>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 mb-5">
      <div class="col-md-6">
        <div class="card shadow-sm border-0 text-center p-4">
          <h5 class="fw-bold text-secondary">Total Customer</h5>
          <h2 class="fw-bold text-primary">{{ $totalCustomer }}</h2>
          <a href="{{ route('cs.customer.index') }}" class="btn btn-outline-primary btn-sm mt-2">Kelola Customer</a>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card shadow-sm border-0 text-center p-4">
          <h5 class="fw-bold text-secondary">Total Hewan</h5>
          <h2 class="fw-bold text-success">{{ $totalHewan }}</h2>
          <a href="{{ route('cs.hewan.index') }}" class="btn btn-outline-success btn-sm mt-2">Kelola Hewan</a>
        </div>
      </div>
    </div>

    <!-- DATA TABLES -->
    <div class="row g-4">
      <!-- Customer -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">👩‍💼 Customer Terbaru</h5>
            <a href="{{ route('cs.customer.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
          </div>
          <table class="table table-sm table-striped align-middle mb-0">
            <thead class="table-dark">
              <tr><th>Nama</th><th>No. Telepon</th></tr>
            </thead>
            <tbody>
              @foreach ($customers as $c)
                <tr><td>{{ $c->NAMA_CUSTOMER }}</td><td>{{ $c->NO_TELP_CUSTOMER ?? '-' }}</td></tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Hewan -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">🐾 Hewan Terbaru</h5>
            <a href="{{ route('cs.hewan.index') }}" class="btn btn-sm btn-success">Lihat Semua</a>
          </div>
          <table class="table table-sm table-striped align-middle mb-0">
            <thead class="table-dark">
              <tr><th>Nama Hewan</th><th>Jenis</th><th>Pemilik</th></tr>
            </thead>
            <tbody>
              @foreach ($hewans as $h)
                <tr>
                  <td>{{ $h->NAMA_HEWAN }}</td>
                  <td>{{ $h->JENIS_HEWAN }}</td>
                  <td>{{ $h->customer->NAMA_CUSTOMER ?? '-' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© 2025 Kouvee Petshop CS Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
