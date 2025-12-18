<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Kouvee Petshop | CS')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #FAF8F1;
      overflow-x: hidden;
    }

    /* === SIDEBAR PREMIUM === */
    #sidebar {
      width: 270px;
      background: linear-gradient(180deg, #34656D 0%, #334443 100%);
      transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
      padding-top: 25px;
      overflow-x: hidden;
      box-shadow: 4px 0 20px rgba(52, 101, 109, 0.15);
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
      color: #FAEAB1;
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
      color: #FAEAB1;
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
      color: #FAF8F1;
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
      background: rgba(250, 234, 177, 0.15);
      color: #FAEAB1;
      transform: translateX(5px);
    }

    .menu-item.active {
      background: #FAEAB1;
      color: #34656D;
      box-shadow: 0 4px 15px rgba(250, 234, 177, 0.3);
    }

    .menu-item.active i {
      color: #34656D;
    }

    .menu-item i {
      font-size: 22px;
      transition: all .3s ease;
      min-width: 22px;
      color: #FAF8F1;
    }

    .menu-item:hover i {
      transform: scale(1.1);
      color: #FAEAB1;
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

    /* Tooltip when sidebar collapsed */
    #sidebar.collapsed .menu-item {
      justify-content: center;
      padding: 14px;
      margin: 5px 10px;
    }

    #sidebar.collapsed .menu-item:hover::after {
      content: attr(data-tooltip);
      position: absolute;
      left: 75px;
      background: #334443;
      padding: 8px 15px;
      border-radius: 8px;
      color: #FAEAB1;
      white-space: nowrap;
      font-size: 13px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 1001;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      font-weight: 600;
    }

    #sidebar.collapsed .menu-item:hover::before {
      content: '';
      position: absolute;
      left: 68px;
      width: 0;
      height: 0;
      border-top: 6px solid transparent;
      border-bottom: 6px solid transparent;
      border-right: 6px solid #334443;
      top: 50%;
      transform: translateY(-50%);
      z-index: 1001;
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
      background: rgba(220, 53, 69, 0.1);
      color: #FAF8F1;
      border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .menu-item.logout:hover {
      background: #dc3545;
      color: #fff;
      transform: translateX(0);
    }

    /* === CONTENT AREA === */
    #content-area {
      margin-left: 270px;
      transition: margin-left .3s cubic-bezier(0.4, 0, 0.2, 1);
      min-height: 100vh;
      padding-top: 120px;
    }

    #content-area.expanded {
        margin-left: 80px;
        padding-top: 100px;
    }

    /* === TOP NAVBAR === */
    .top-navbar {
        position: fixed !important;
        top: 0;
        left: 270px;
        right: 0;
        height: 80px;
        display: flex;
        align-items: center;

        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 2px solid #FAEAB1;
        box-shadow: 0 2px 15px rgba(52, 101, 109, 0.1);

        z-index: 2000; /* pastikan di atas konten */
    }

    .top-navbar.expanded {
      margin-left: 80px;
      left: 80px;
    }

    .navbar-title {
      color: #34656D;
      font-weight: 700;
      font-size: 1.3rem;
      letter-spacing: 0.5px;
    }

    .toggle-btn {
      background: linear-gradient(135deg, #34656D 0%, #334443 100%);
      color: #FAF8F1;
      border: none;
      border-radius: 10px;
      padding: 10px 15px;
      transition: all .3s ease;
      box-shadow: 0 4px 15px rgba(52, 101, 109, 0.2);
    }

    .toggle-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(52, 101, 109, 0.3);
      color: #FAEAB1;
    }

    .toggle-btn i {
      font-size: 20px;
    }

    /* User Info in Navbar */
    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 15px;
      background: linear-gradient(135deg, #34656D 0%, #334443 100%);
      border-radius: 50px;
      color: #FAF8F1;
      font-weight: 600;
      font-size: 14px;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #FAEAB1;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #34656D;
      font-weight: 700;
      font-size: 14px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
      #sidebar {
        width: 80px;
      }

      #content-area {
            margin-left: 270px;
            padding-top: 100px; /* ini paling pas */
            position: relative;
            z-index: 1;
      }

      .top-navbar {
        margin-left: 80px;
        left: 80px;
      }

      .sidebar-header {
        font-size: 18px;
        writing-mode: vertical-rl;
        text-orientation: mixed;
        transform: rotate(180deg);
      }

      .user-info span {
        display: none;
      }
    }

    /* === ANIMATIONS === */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .menu-item {
      animation: slideIn 0.3s ease-out;
    }

    .menu-item:nth-child(1) { animation-delay: 0.05s; }
    .menu-item:nth-child(2) { animation-delay: 0.1s; }
    .menu-item:nth-child(3) { animation-delay: 0.15s; }
    .menu-item:nth-child(4) { animation-delay: 0.2s; }
    .menu-item:nth-child(5) { animation-delay: 0.25s; }

    /* Scrollbar Styling */
    #sidebar::-webkit-scrollbar {
      width: 6px;
    }

    #sidebar::-webkit-scrollbar-track {
      background: rgba(0,0,0,0.1);
    }

    #sidebar::-webkit-scrollbar-thumb {
      background: #FAEAB1;
      border-radius: 3px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
      background: #FFD700;
    }
  </style>

  @stack('styles')
</head>

<body>

  <!-- SIDEBAR PREMIUM -->
  <div id="sidebar">
    <div class="sidebar-header">
      <span class="sidebar-brand-icon">🐾</span>
      <span>Kouvee CS</span>
    </div>

    <div class="menu-section-label">Main Menu</div>

    <a href="{{ route('cs.dashboard') }}" 
       class="menu-item {{ Request::is('cs/dashboard') ? 'active' : '' }}" 
       data-tooltip="Dashboard">
      <i class="bi bi-speedometer2"></i>
      <span class="item-text">Dashboard</span>
    </a>

    <a href="{{ route('cs.customer.index') }}" 
       class="menu-item {{ Request::is('cs/customer*') ? 'active' : '' }}" 
       data-tooltip="Customer">
      <i class="bi bi-people"></i>
      <span class="item-text">Customer</span>
    </a>

    <a href="{{ route('cs.hewan.index') }}" 
       class="menu-item {{ Request::is('cs/hewan*') ? 'active' : '' }}" 
       data-tooltip="Hewan">
      <i class="bi bi-heart"></i>
      <span class="item-text">Hewan</span>
    </a>

    <div class="menu-section-label">Transaksi</div>

    <a href="{{ route('cs.transaksi_produk.index') }}" 
       class="menu-item {{ Request::is('cs/transaksi_produk*') ? 'active' : '' }}" 
       data-tooltip="Transaksi Produk">
      <i class="bi bi-bag-check"></i>
      <span class="item-text">Transaksi Produk</span>
    </a>

    <a href="{{ route('cs.transaksi_layanan.index') }}" 
       class="menu-item {{ Request::is('cs/transaksi_layanan*') ? 'active' : '' }}" 
       data-tooltip="Transaksi Layanan">
      <i class="bi bi-scissors"></i>
      <span class="item-text">Transaksi Layanan</span>
    </a>

    <!-- LOGOUT SECTION -->
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
  <nav class="navbar navbar-light top-navbar">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-3">
        <button id="toggleSidebar" class="toggle-btn">
          <i class="bi bi-list"></i>
        </button>
        <span class="navbar-title">Customer Service Panel</span>
      </div>

      <!-- User Info -->
      <div class="user-info">
        <div class="user-avatar">CS</div>
        <span>Customer Service</span>
      </div>
    </div>
  </nav>

  <!-- CONTENT AREA -->
  <div id="content-area" class="p-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content-area');
    const nav = document.querySelector('.top-navbar');
    const toggle = document.getElementById('toggleSidebar');

    // === Apply saved state on load ===
    let savedState = localStorage.getItem('cs-sidebar-collapsed');

    if (savedState === 'true') {
      sidebar.classList.add('collapsed');
      content.classList.add('expanded');
      nav.classList.add('expanded');
    }

    // === Toggle action ===
    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      content.classList.toggle('expanded');
      nav.classList.toggle('expanded');

      // Save state with unique key for CS
      localStorage.setItem('cs-sidebar-collapsed', sidebar.classList.contains('collapsed'));
    });
  </script>

  @stack('scripts')

</body>
</html>