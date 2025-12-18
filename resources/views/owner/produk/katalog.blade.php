<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/katalog_produk.css') }}">

</head>
<body>

    <!-- HEADER -->
    <div class="katalog-header">
        <div class="container text-center">
            <h2 class="text-white fw-bold">Semua Produk Kami</h2>

            <!-- SEARCH + FILTER -->
            <div class="search-container mt-4 position-relative">

                <!-- SEARCH -->
                <input id="searchInput" type="text"
                       class="form-control"
                       placeholder="Cari nama produk..."
                       autocomplete="off">

                <!-- FILTER BUTTON -->
                <div id="filterBtn" class="filter-btn">
                    <i class="bi bi-funnel-fill"></i> Filter
                </div>

                <!-- FILTER PANEL DROPDOWN -->
                <div id="filterPanel" class="filter-panel">
                    <button data-sort="harga_asc">Harga Termurah</button>
                    <button data-sort="harga_desc">Harga Termahal</button>
                    <button data-sort="stok_desc">Stok Terbanyak</button>
                    <button data-sort="stok_asc">Stok Tersedikit</button>
                </div>

            </div>
        </div>
    </div>

    <!-- PRODUCT GRID -->
    <div class="produk-grid-section">
        <div class="container">
            <div class="row g-4" id="productContainer">
                @foreach ($produks as $produk)
                    <div class="col-6 col-md-3 product-item"
                         data-name="{{ strtolower($produk->NAMA_PRODUK) }}"
                         data-price="{{ $produk->HARGA_PRODUK }}"
                         data-stock="{{ $produk->STOK_PRODUK }}">

                        <a href="{{ route('produk.show', $produk->ID_PRODUK) }}" style="text-decoration:none;">
                            <div class="card product-card">
                                <div class="image-wrapper">
                                    <img src="{{ $produk->GAMBAR_PRODUK ? asset('storage/' . $produk->GAMBAR_PRODUK) : 'https://via.placeholder.com/400?text=No+Image' }}">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="fw-bold">{{ $produk->NAMA_PRODUK }}</h6>
                                    <strong>Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}</strong>
                                    <div class="mt-1 text-muted" style="font-size: 13px;">
                                        Stok: {{ $produk->STOK_PRODUK }}
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>

            <!-- EMPTY STATE -->
            <div id="noResult">
                <h4>😿 Tidak ada produk ditemukan</h4>
            </div>

        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        const searchInput = document.getElementById("searchInput");
        const filterBtn = document.getElementById("filterBtn");
        const filterPanel = document.getElementById("filterPanel");
        const container = document.getElementById("productContainer");
        const items = Array.from(document.querySelectorAll(".product-item"));
        const noResult = document.getElementById("noResult");

        // ========================
        // 🔽 TOGGLE FILTER PANEL
        // ========================
        filterBtn.addEventListener("click", () => {
            filterPanel.style.display =
                filterPanel.style.display === "block" ? "none" : "block";
        });

        // Hide panel when clicking outside
        document.addEventListener("click", function (e) {
            if (!filterBtn.contains(e.target) && !filterPanel.contains(e.target)) {
                filterPanel.style.display = "none";
            }
        });

        // ========================
        // 🔍 SEARCH FUNCTION
        // ========================
        searchInput.addEventListener("input", filterProducts);

        function filterProducts() {
            const keyword = searchInput.value.toLowerCase();
            let count = 0;

            items.forEach(item => {
                const name = item.dataset.name;

                if (name.includes(keyword)) {
                    item.style.display = "block";
                    count++;
                } else {
                    item.style.display = "none";
                }
            });

            noResult.style.display = count === 0 ? "block" : "none";
        }

        // ========================
        // 🔽 SORTING FUNCTION
        // ========================
        document.querySelectorAll(".filter-panel button")
            .forEach(btn => btn.addEventListener("click", function () {

                const type = this.dataset.sort;
                let sorted = [...items];

                if (type === "harga_asc") sorted.sort((a, b) => a.dataset.price - b.dataset.price);
                if (type === "harga_desc") sorted.sort((a, b) => b.dataset.price - a.dataset.price);
                if (type === "stok_asc") sorted.sort((a, b) => a.dataset.stock - b.dataset.stock);
                if (type === "stok_desc") sorted.sort((a, b) => b.dataset.stock - a.dataset.stock);

                container.innerHTML = "";
                sorted.forEach(el => container.appendChild(el));

                filterProducts();  
                filterPanel.style.display = "none";
            }));

    </script>

</body>
</html>
