<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Kouvee Petshop | Kasir')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * { font-family: 'Poppins', sans-serif; }

    body {
      background: #FAF8F1;
      overflow-x: hidden;
    }

    /* === SIDEBAR KASIR (SAME STYLE AS CS BUT GREEN) === */
    #sidebar {
      width: 270px;
      background: linear-gradient(180deg, #2E8A6E 0%, #226F58 100%);
      transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
      padding-top: 25px;
      overflow-x: hidden;
      box-shadow: 4px 0 20px rgba(46,138,110,0.2);
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 1000;
    }

    #sidebar.collapsed {
      width: 80px;
    }

    /* Sidebar Header */
    .sidebar-header {
      font-size: 24px;
      color: #DFF6E8;
      text-align: center;
      font-weight: 700;
      margin-bottom: 40px;
      transition: all .3s ease;
      letter-spacing: 1px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
      padding: 0 20px;
    }

    #sidebar.collapsed .sidebar-header {
      font-size: 18px;
      writing-mode: vertical-rl;
      text-orientation: mixed;
      transform: rotate(180deg);
      margin-bottom: 20px;
    }

    .sidebar-brand-icon {
      font-size: 28px;
      margin-bottom: 10px;
      display: block;
    }

    /* Menu Section Label */
    .menu-section-label {
      color: #DFF6E8;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 20px 20px 10px;
      opacity: 0.7;
      transition: all .3s ease;
    }

    #sidebar.collapsed .menu-section-label {
      opacity: 0;
      height: 0;
      padding: 0;
      overflow: hidden;
    }

    /* Menu Items */
    .menu-item {
      padding: 14px 20px;
      color: #F7FBEF;
      font-size: 15px;
      display: flex;
      align-items: center;
      gap: 15px;
      cursor: pointer;
      transition: all .3s ease;
      border-radius: 12px;
      text-decoration: none;
      margin: 5px 15px;
      position: relative;
      font-weight: 500;
    }

    .menu-item:hover {
      background: rgba(223, 246, 232, 0.15);
      color: #DFF6E8;
      transform: translateX(5px);
    }

    .menu-item.active {
      background: #DFF6E8;
      color: #2E8A6E;
      box-shadow: 0 4px 15px rgba(223, 246, 232, 0.4);
    }

    .menu-item.active i { color: #2E8A6E; }

    .menu-item i {
      font-size: 22px;
      transition: all .3s ease;
      min-width: 22px;
      color: #F7FBEF;
    }

    .menu-item:hover i {
      transform: scale(1.1);
      color: #DFF6E8;
    }

    /* Hide text when collapsed */
    .item-text {
      transition: opacity .3s ease;
      white-space: nowrap;
    }

    #sidebar.collapsed .item-text {
      display: none;
      opacity: 0;
    }

    /* Tooltip when collapsed */
    #sidebar.collapsed .menu-item {
      justify-content: center;
      padding: 14px;
      margin: 5px 10px;
    }

    #sidebar.collapsed .menu-item:hover::after {
      content: attr(data-tooltip);
      position: absolute;
      left: 75px;
      background: #226F58;
      padding: 8px 15px;
      border-radius: 8px;
      color: #DFF6E8;
      white-space: nowrap;
      font-size: 13px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 1001;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      font-weight: 600;
    }

    /* Logout Button */
    .logout-section {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      padding: 0 15px;
    }

    .menu-item.logout {
      background: rgba(220,53,69,0.1);
      color: #F7FBEF;
      border: 1px solid rgba(220,53,69,0.3);
    }

    .menu-item.logout:hover {
      background: #dc3545;
      color: #fff;
      transform: translateX(0);
    }

    /* === TOP NAVBAR KASIR === */
    .top-navbar {
      position: fixed !important;
      top: 0;
      left: 270px;
      right: 0;
      height: 80px;

      display: flex;
      align-items: center;

      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      border-bottom: 2px solid #DFF6E8;
      box-shadow: 0 2px 15px rgba(46,138,110,0.2);

      z-index: 2000;
    }

    .top-navbar.expanded {
      left: 80px;
    }

    .navbar-title {
      color: #2E8A6E;
      font-weight: 700;
      font-size: 1.3rem;
      letter-spacing: .5px;
    }

    /* Toggle Button */
    .toggle-btn {
      background: linear-gradient(135deg, #2E8A6E 0%, #226F58 100%);
      color: #F7FBEF;
      border: none;
      border-radius: 10px;
      padding: 10px 15px;
      transition: all .3s ease;
      box-shadow: 0 4px 15px rgba(46,138,110,0.3);
    }

    .toggle-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(46,138,110,0.4);
      color: #DFF6E8;
    }

    .toggle-btn i { font-size: 20px; }

    /* User Info */
    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 15px;

      background: linear-gradient(135deg, #2E8A6E 0%, #226F58 100%);
      border-radius: 50px;
      color: #F7FBEF;
      font-weight: 600;
      font-size: 14px;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #DFF6E8;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #2E8A6E;
      font-weight: 700;
      font-size: 14px;
    }

    /* === CONTENT AREA === */
    #content-area {
      margin-left: 270px;
      transition: .3s ease;
      min-height: 100vh;
      padding-top: 120px;
    }

    #content-area.expanded {
      margin-left: 80px;
      padding-top: 100px;
    }
  </style>

  @stack('styles')
</head>

<body>

  <!-- SIDEBAR -->
  <div id="sidebar">
    <div class="sidebar-header">
      <span class="sidebar-brand-icon">💰</span>
      <span>Kouvee Kasir</span>
    </div>

    <div class="menu-section-label">Main Menu</div>

    <a href="{{ route('kasir.dashboard') }}"
       class="menu-item {{ Request::is('kasir/dashboard') ? 'active' : '' }}"
       data-tooltip="Dashboard">
      <i class="bi bi-speedometer2"></i>
      <span class="item-text">Dashboard</span>
    </a>

    <a href="{{ route('kasir.produk') }}"
       class="menu-item {{ Request::is('kasir/transaksi-produk*') ? 'active' : '' }}"
       data-tooltip="Transaksi Produk">
      <i class="bi bi-bag-check"></i>
      <span class="item-text">Transaksi Produk</span>
    </a>

    <a href="{{ route('kasir.layanan') }}"
       class="menu-item {{ Request::is('kasir/transaksi-layanan*') ? 'active' : '' }}"
       data-tooltip="Transaksi Layanan">
      <i class="bi bi-scissors"></i>
      <span class="item-text">Transaksi Layanan</span>
    </a>

    <div class="logout-section">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="menu-item logout w-100 border-0 bg-transparent text-start"
                data-tooltip="Logout">
          <i class="bi bi-box-arrow-right"></i>
          <span class="item-text">Logout</span>
        </button>
      </form>
    </div>
  </div>

  <!-- TOP NAVBAR -->
  <nav class="navbar navbar-light top-navbar px-4">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <div class="d-flex align-items-center gap-3">
        <button id="toggleSidebar" class="toggle-btn">
          <i class="bi bi-list"></i>
        </button>
        <span class="navbar-title">Kasir Panel</span>
      </div>

      <div class="user-info">
        <div class="user-avatar">KS</div>
        <span>Kasir</span>
      </div>

    </div>
  </nav>

  <!-- CONTENT -->
  <div id="content-area" class="p-4">
    @yield('content')
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content-area');
    const nav = document.querySelector('.top-navbar');
    const toggle = document.getElementById('toggleSidebar');

    let saved = localStorage.getItem('kasir-sidebar');

    if (saved === 'true') {
      sidebar.classList.add('collapsed');
      content.classList.add('expanded');
      nav.classList.add('expanded');
    }

    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      content.classList.toggle('expanded');
      nav.classList.toggle('expanded');

      localStorage.setItem('kasir-sidebar', sidebar.classList.contains('collapsed'));
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')

</body>
</html>
