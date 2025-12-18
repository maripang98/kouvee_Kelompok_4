<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Kouvee Petshop</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { 
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            background: #FAF8F1;
            min-height: 100vh;
        }

        /* === NAVBAR PREMIUM === */
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

        /* === BREADCRUMB === */
        .breadcrumb-section {
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            padding: 40px 0;
            margin-top: 76px;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-custom .breadcrumb-item {
            color: #FAF8F1;
            font-size: 14px;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            color: #FAEAB1;
            content: "›";
            font-size: 18px;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: #FAEAB1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: #FFD700;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #FAF8F1;
            font-weight: 600;
        }

        /* === DETAIL SECTION === */
        .detail-section {
            padding: 80px 0;
        }

        .product-card {
            border-radius: 30px;
            overflow: hidden;
            border: 2px solid #FAF8F1;
            background: white;
            box-shadow: 0 20px 60px rgba(52, 101, 109, 0.15);
            transition: all 0.4s ease;
            animation: fadeInUp 0.8s ease-out;
        }

        .product-card:hover {
            box-shadow: 0 25px 70px rgba(52, 101, 109, 0.25);
            border-color: #FAEAB1;
        }

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

        /* === IMAGE SECTION === */
        .image-wrapper {
            position: relative;
            overflow: hidden;
            height: 100%;
            min-height: 500px;
            background: linear-gradient(135deg, #FAEAB1 0%, #FAF8F1 100%);
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .stock-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(52, 101, 109, 0.9);
            backdrop-filter: blur(10px);
            color: #FAF8F1;
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .quality-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #FAEAB1 0%, #FFD700 100%);
            color: #34656D;
            padding: 10px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 4px 15px rgba(250, 234, 177, 0.4);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* === CONTENT SECTION === */
        .content-wrapper {
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 500px;
        }

        .product-title {
            color: #334443;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .product-description {
            color: #334443;
            font-size: 1.05rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .info-divider {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, #34656D, transparent);
            margin: 30px 0;
        }

        /* === PRICE & STOCK SECTION === */
        .price-stock-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .price-box {
            flex: 1;
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            padding: 25px;
            border-radius: 20px;
            color: white;
            min-width: 200px;
        }

        .price-label {
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .price-value {
            font-weight: 700;
            font-size: 2rem;
            line-height: 1;
        }

        .stock-box {
            flex: 1;
            background: linear-gradient(135deg, #FAEAB1 0%, #FAF8F1 100%);
            padding: 25px;
            border-radius: 20px;
            border: 2px solid #34656D;
            min-width: 200px;
        }

        .stock-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            color: #334443;
        }

        .stock-value {
            font-weight: 700;
            font-size: 2rem;
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .stock-status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 10px;
        }

        .stock-status.available {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .stock-status.low {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .stock-status.out {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        /* === PRODUCT INFO === */
        .product-info-section {
            margin: 30px 0;
        }

        .info-title {
            color: #34656D;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            color: #334443;
            font-size: 0.95rem;
        }

        .info-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FAF8F1;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* === STORE INFO BOX === */
        .store-info-section {
            margin: 30px 0;
        }

        .store-info-box {
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            padding: 30px;
            border-radius: 20px;
            color: white;
            box-shadow: 0 8px 25px rgba(52, 101, 109, 0.3);
        }

        .store-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #FAEAB1;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .store-title i {
            font-size: 24px;
        }

        .store-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .store-detail-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 12px;
            background: rgba(250, 234, 177, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .store-detail-item:hover {
            background: rgba(250, 234, 177, 0.15);
            transform: translateX(5px);
        }

        .store-detail-icon {
            width: 40px;
            height: 40px;
            background: rgba(250, 234, 177, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .store-detail-icon i {
            font-size: 20px;
            color: #FAEAB1;
        }

        .store-detail-text {
            flex: 1;
        }

        .store-detail-label {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .store-detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: #FAF8F1;
            line-height: 1.5;
        }

        .store-cta-text {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(250, 234, 177, 0.2);
            font-size: 0.95rem;
            color: #FAEAB1;
            font-weight: 500;
        }

        /* === BUTTONS === */
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-back {
            padding: 14px 30px;
            border-radius: 12px;
            background: white;
            color: #34656D;
            border: 2px solid #34656D;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back:hover {
            background: #34656D;
            color: #FAF8F1;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(52, 101, 109, 0.3);
        }

        .btn-location {
            flex: 1;
            padding: 14px 35px;
            border-radius: 12px;
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            color: #FAF8F1;
            border: 2px solid #34656D;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-location:hover {
            background: #FAEAB1;
            color: #34656D;
            border-color: #FAEAB1;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(250, 234, 177, 0.5);
        }

        .btn-location i {
            font-size: 18px;
        }

        /* === FOOTER === */
        footer {
            background: linear-gradient(135deg, #34656D 0%, #334443 100%);
            padding: 30px 0;
            box-shadow: 0 -10px 30px rgba(52, 101, 109, 0.2);
            color: #FAF8F1;
            margin-top: 80px;
        }

        footer p {
            margin: 0;
            font-weight: 500;
            letter-spacing: 1px;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .breadcrumb-section {
                padding: 30px 0;
            }

            .detail-section {
                padding: 50px 0;
            }

            .image-wrapper {
                min-height: 350px;
            }

            .content-wrapper {
                padding: 30px 25px;
                min-height: auto;
            }

            .product-title {
                font-size: 1.8rem;
            }

            .price-value,
            .stock-value {
                font-size: 1.6rem;
            }

            .price-stock-container {
                flex-direction: column;
            }

            .price-box,
            .stock-box {
                min-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-back,
            .btn-location {
                width: 100%;
                justify-content: center;
            }

            .store-info-box {
                padding: 25px 20px;
            }

            .store-detail-item {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">🐾 Kouvee Petshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.katalog') }}">Produk</a></li>
                    <li class="breadcrumb-item active">{{ $produk->NAMA_PRODUK }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- DETAIL SECTION -->
    <div class="detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card product-card">
                        <div class="row g-0">

                            <!-- IMAGE SECTION -->
                            <div class="col-md-5">
                                <div class="image-wrapper">
                                    <img src="{{ $produk->GAMBAR_PRODUK ? asset('storage/' . $produk->GAMBAR_PRODUK) : 'https://via.placeholder.com/600x800?text=No+Image' }}"
                                         alt="{{ $produk->NAMA_PRODUK }}"
                                         class="product-img">
                                    <div class="stock-overlay">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Stok: {{ $produk->STOK_PRODUK }}</span>
                                    </div>
                                    <div class="quality-badge">
                                        <i class="bi bi-award-fill"></i>
                                        <span>Premium</span>
                                    </div>
                                </div>
                            </div>

                            <!-- CONTENT SECTION -->
                            <div class="col-md-7">
                                <div class="content-wrapper">
                                    <div>
                                        <h1 class="product-title">{{ $produk->NAMA_PRODUK }}</h1>

                                        <p class="product-description">
                                            {{ $produk->DESKRIPSI_PRODUK ?? 'Produk berkualitas tinggi untuk hewan kesayangan Anda. Dibuat dengan bahan premium dan standar kualitas internasional untuk memastikan kesehatan dan kebahagiaan hewan peliharaan Anda.' }}
                                        </p>

                                        <!-- PRODUCT INFO -->
                                        <div class="product-info-section">
                                            <div class="info-title">
                                                <i class="bi bi-info-circle-fill" style="color: #FAEAB1;"></i>
                                                Informasi Produk
                                            </div>
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="bi bi-check-lg"></i>
                                                </div>
                                                <span>Produk original & bergaransi</span>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="bi bi-check-lg"></i>
                                                </div>
                                                <span>Tersertifikasi dan aman</span>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="bi bi-check-lg"></i>
                                                </div>
                                                <span>Kualitas terjamin premium</span>
                                            </div>
                                        </div>

                                        <hr class="info-divider">

                                        <!-- PRICE & STOCK -->
                                        <div class="price-stock-container">
                                            <div class="price-box">
                                                <div class="price-label">Harga</div>
                                                <div class="price-value">
                                                    Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="stock-box">
                                                <div class="stock-label">Stok Tersedia</div>
                                                <div class="stock-value">{{ $produk->STOK_PRODUK }}</div>
                                                @if($produk->STOK_PRODUK > 10)
                                                    <span class="stock-status available">
                                                        <i class="bi bi-check-circle-fill"></i> Tersedia
                                                    </span>
                                                @elseif($produk->STOK_PRODUK > 0)
                                                    <span class="stock-status low">
                                                        <i class="bi bi-exclamation-circle-fill"></i> Stok Terbatas
                                                    </span>
                                                @else
                                                    <span class="stock-status out">
                                                        <i class="bi bi-x-circle-fill"></i> Habis
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- STORE INFO -->
                                        <div class="store-info-section">
                                            <div class="store-info-box">
                                                <div class="store-title">
                                                    <i class="bi bi-shop"></i>
                                                    <span>Kunjungi Toko Kami</span>
                                                </div>
                                                
                                                <div class="store-details">
                                                    <div class="store-detail-item">
                                                        <div class="store-detail-icon">
                                                            <i class="bi bi-geo-alt-fill"></i>
                                                        </div>
                                                        <div class="store-detail-text">
                                                            <div class="store-detail-label">Alamat</div>
                                                            <div class="store-detail-value">Jl. Magelang KM 5, Yogyakarta</div>
                                                        </div>
                                                    </div>

                                                    <div class="store-detail-item">
                                                        <div class="store-detail-icon">
                                                            <i class="bi bi-clock-fill"></i>
                                                        </div>
                                                        <div class="store-detail-text">
                                                            <div class="store-detail-label">Jam Operasional</div>
                                                            <div class="store-detail-value">Senin - Minggu: 09.00 - 21.00 WIB</div>
                                                        </div>
                                                    </div>

                                                    <div class="store-detail-item">
                                                        <div class="store-detail-icon">
                                                            <i class="bi bi-telephone-fill"></i>
                                                        </div>
                                                        <div class="store-detail-text">
                                                            <div class="store-detail-label">Telepon</div>
                                                            <div class="store-detail-value">0274-123456</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="store-cta-text">
                                                    💬 Datang langsung ke toko untuk melakukan pembelian dan konsultasi dengan Customer Service kami
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="action-buttons">
                                        <a href="{{ route('produk.katalog') }}" class="btn-back">
                                            <i class="bi bi-arrow-left"></i>
                                            Kembali
                                        </a>
                                        <a href="https://maps.google.com/?q=Kouvee+Petshop+Yogyakarta" 
                                           target="_blank" 
                                           class="btn-location">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Lihat Lokasi di Maps
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center">
        <p>© 2025 Kouvee Petshop. All Rights Reserved. Made with ❤️</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>