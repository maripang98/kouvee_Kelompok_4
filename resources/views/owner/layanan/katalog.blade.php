<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Layanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/katalog_layanan.css') }}">
</head>
<body>

    <!-- HEADER -->
    <div class="katalog-header">
        <h2>Semua Layanan</h2>

        <div class="d-flex justify-content-center position-relative mt-4">

            <!-- Search -->
            <input id="searchInput" type="text" class="form-control me-2"
                   placeholder="Cari nama layanan..." autocomplete="off">

            <!-- Filter Button -->
            <div id="filterBtn" class="filter-btn">
                <i class="bi bi-funnel-fill"></i> Filter
            </div>

            <!-- Filter Dropdown -->
            <div id="filterPanel" class="filter-panel">
                <form id="filterForm" method="GET">
                    <input type="hidden" name="search" value="{{ $search }}">

                    <button name="sort" value="harga_asc">Harga Termurah</button>
                    <button name="sort" value="harga_desc">Harga Termahal</button>
                </form>
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="container py-5">

        <div class="row g-4" id="serviceContainer">

            @foreach($layanans as $layanan)
            <div class="col-6 col-md-3 service-item">
                <a href="{{ route('layanan.show', $layanan->ID_LAYANAN) }}" class="text-decoration-none">
                    <div class="service-card shadow-sm">
                        <img src="{{ $layanan->GAMBAR_LAYANAN ? asset('storage/'.$layanan->GAMBAR_LAYANAN) : 'https://via.placeholder.com/400x300?text=No+Image' }}">
                        <div class="p-3 text-center">
                            <h6 class="text-truncate">{{ $layanan->NAMA_LAYANAN }}</h6>
                            <p class="fw-semibold mb-0">
                                Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>

        <div id="noResult">
            <h4>😿 Tidak ada layanan ditemukan</h4>
        </div>

        @if($layanans->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $layanans->links() }}
            </div>
        @endif

    </div>

<script>
    const searchInput = document.getElementById("searchInput");
    const items = document.querySelectorAll(".service-item");
    const noResult = document.getElementById("noResult");

    searchInput.addEventListener("input", () => {
        const keyword = searchInput.value.toLowerCase();
        let visible = 0;

        items.forEach(item => {
            const name = item.querySelector("h6").textContent.toLowerCase();

            if (name.includes(keyword)) {
                item.style.display = "block";
                visible++;
            } else {
                item.style.display = "none";
            }
        });

        noResult.style.display = visible === 0 ? "block" : "none";
    });

    // FILTER dropdown
    const filterBtn = document.getElementById("filterBtn");
    const filterPanel = document.getElementById("filterPanel");

    filterBtn.addEventListener("click", () => {
        filterPanel.style.display = (filterPanel.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function(e) {
        if (!filterBtn.contains(e.target) && !filterPanel.contains(e.target)) {
            filterPanel.style.display = "none";
        }
    });
</script>

</body>
</html>
