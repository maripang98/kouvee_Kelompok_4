@extends('layout.cs')

@section('title', 'Data Hewan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index_hewan.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/cs-hewan.css']) --}}
@endpush

@section('content')

<div class="cs-hewan-container">

    <!-- PAGE HEADER -->
    <div class="cs-hewan-header">
        <h2 class="cs-hewan-title">
            <div class="cs-hewan-title-icon">🐾</div>
            <span>Data Hewan</span>
        </h2>
        <p class="cs-hewan-subtitle">Kelola data hewan peliharaan pelanggan</p>
    </div>

    <!-- SEARCH SECTION -->
    <div class="cs-hewan-search-section">
        <form action="{{ route('cs.hewan.index') }}" method="GET" class="cs-hewan-search-form">
            <input 
                type="text" 
                name="search" 
                class="cs-hewan-search-input" 
                placeholder="🔍 Cari hewan berdasarkan nama atau ID customer..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="cs-hewan-btn cs-hewan-btn-search">
                <i class="bi bi-search"></i>
                Cari
            </button>
            <a href="{{ route('cs.hewan.index') }}" class="cs-hewan-btn cs-hewan-btn-reset">
                <i class="bi bi-arrow-clockwise"></i>
                Reset
            </a>
        </form>
    </div>

    <!-- SEARCH RESULT INFO -->
    @if(request('search'))
    <div class="cs-hewan-alert cs-hewan-alert-info">
        Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
    </div>
    @endif

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
    <div class="cs-hewan-alert cs-hewan-alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- ACTION HEADER -->
    <div class="cs-hewan-action-header">
        <div>
            <span style="color: #334443; font-weight: 600;">
                Total: <strong style="color: #34656D; font-size: 1.2rem;">{{ $hewans->total() }}</strong> Hewan
            </span>
        </div>
        <a href="{{ route('cs.hewan.create') }}" class="cs-hewan-btn cs-hewan-btn-add">
            <i class="bi bi-plus-circle"></i>
            Tambah Hewan
        </a>
    </div>

    <!-- TABLE SECTION -->
    <div class="cs-hewan-table-container">
        <div class="cs-hewan-table-responsive">
            <table class="cs-hewan-table">
                <thead>
                    <tr>
                        <th>ID Hewan</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Hewan</th>
                        <th>ID Customer</th>
                        <th>Nama Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hewans as $h)
                    <tr>
                        <td>
                            <span class="cs-hewan-id-badge">{{ $h->ID_HEWAN }}</span>
                        </td>
                        <td class="cs-hewan-name-cell">
                            {{ $h->NAMA_HEWAN }}
                        </td>
                        <td>
                            <span class="cs-hewan-jenis-badge">
                                @if(strtolower($h->JENIS_HEWAN) == 'anjing')
                                    🐕
                                @elseif(strtolower($h->JENIS_HEWAN) == 'kucing')
                                    🐱
                                @elseif(strtolower($h->JENIS_HEWAN) == 'burung')
                                    🐦
                                @elseif(strtolower($h->JENIS_HEWAN) == 'kelinci')
                                    🐰
                                @elseif(strtolower($h->JENIS_HEWAN) == 'hamster')
                                    🐹
                                @else
                                    🐾
                                @endif
                                {{ $h->JENIS_HEWAN }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('cs.customer.edit', $h->ID_CUSTOMER) }}" 
                               class="cs-hewan-customer-link"
                               title="Lihat data customer">
                                {{ $h->ID_CUSTOMER }}
                            </a>
                        </td>
                        <td>
                            @if($h->customer)
                                <strong style="color: #34656D;">{{ $h->customer->NAMA_CUSTOMER }}</strong>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="cs-hewan-action-buttons">
                                <a href="{{ route('cs.hewan.edit', $h->ID_HEWAN) }}" 
                                   class="cs-hewan-btn-action cs-hewan-btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <form action="{{ route('cs.hewan.destroy', $h->ID_HEWAN) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="cs-hewan-btn-action cs-hewan-btn-delete" 
                                            onclick="return confirm('⚠️ Yakin ingin menghapus data hewan {{ $h->NAMA_HEWAN }}?')">
                                        <i class="bi bi-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="cs-hewan-empty-state">
                                <div class="cs-hewan-empty-icon">
                                    @if(request('search'))
                                        🔍
                                    @else
                                        🐾
                                    @endif
                                </div>
                                <div class="cs-hewan-empty-text">
                                    @if(request('search'))
                                        Tidak ada hewan dengan kata kunci "{{ request('search') }}"
                                    @else
                                        Belum ada data hewan
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    @if($hewans->hasPages())
    <div class="cs-pagination">
        {{ $hewans->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
// Auto-hide success message after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.querySelector('.cs-hewan-alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.animation = 'slideUp 0.4s ease-out';
            setTimeout(() => {
                successAlert.remove();
            }, 400);
        }, 5000);
    }
});

// Animation for slide up
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush