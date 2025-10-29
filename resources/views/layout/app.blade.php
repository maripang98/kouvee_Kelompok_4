<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Kouvee Petshop')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Laravel Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- 🧩 Tambahkan class d-flex flex-column min-vh-100 -->
<body class="d-flex flex-column min-vh-100">

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
        </ul>
      </div>
    </div>
  </nav>

  <!-- ✅ PAGE CONTENT -->
  <main class="flex-fill pt-5 mt-5">
    @yield('content')
  </main>

  <!-- ✅ FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>© 2025 Kouvee Petshop. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
