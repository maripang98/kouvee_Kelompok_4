@extends('layout.cs')

@section('title', 'Data Customer')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index_customer.css') }}">
<!-- Atau jika menggunakan Vite: -->
{{-- @vite(['resources/css/cs-customer.css']) --}}
@endpush

@section('content')

<div class="cs-customer-container">

    <!-- PAGE HEADER -->
    <div class="cs-page-header">
        <h2 class="cs-page-title">
            <div class="cs-page-title-icon">👥</div>
            <span>Data Customer</span>
        </h2>
        <p class="cs-page-subtitle">Kelola data customer dan informasi pelanggan</p>
    </div>

    <!-- SEARCH SECTION -->
    <div class="cs-search-section">
        <form action="{{ route('cs.customer.index') }}" method="GET" class="cs-search-form">
            <input 
                type="text" 
                name="search" 
                class="cs-search-input" 
                placeholder="🔍 Cari customer berdasarkan nama..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="cs-btn cs-btn-search">
                <i class="bi bi-search"></i>
                Cari
            </button>
            <a href="{{ route('cs.customer.index') }}" class="cs-btn cs-btn-reset">
                <i class="bi bi-arrow-clockwise"></i>
                Reset
            </a>
        </form>
    </div>

    <!-- SEARCH RESULT INFO -->
    @if(request('search'))
    <div class="cs-alert cs-alert-info">
        Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
    </div>
    @endif

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
    <div class="cs-alert cs-alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- ACTION HEADER -->
    <div class="cs-action-header">
        <div>
            <span style="color: #334443; font-weight: 600;">
                Total: <strong style="color: #34656D; font-size: 1.2rem;">{{ $customers->total() }}</strong> Customer
            </span>
        </div>
        <a href="{{ route('cs.customer.create') }}" class="cs-btn cs-btn-add">
            <i class="bi bi-plus-circle"></i>
            Tambah Customer
        </a>
    </div>

    <!-- TABLE SECTION -->
    <div class="cs-table-container">
        <div class="cs-table-responsive">
            <table class="cs-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Pegawai</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $c)
                    <tr>
                        <td>
                            <span class="cs-id-badge">{{ $c->ID_CUSTOMER }}</span>
                        </td>
                        <td>{{ $c->ID_PEGAWAI }}</td>
                        <td class="cs-name-cell">{{ $c->NAMA_CUSTOMER }}</td>
                        <td>{{ Str::limit($c->ALAMAT_CUSTOMER, 30) ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->TGL_LAHIR_CUSTOMER)->format('d M Y') }}</td>
                        <td>
                            @if($c->NOMOR_TELEPON_CUSTOMER)
                                <a href="tel:{{ $c->NOMOR_TELEPON_CUSTOMER }}" 
                                   style="color: #34656D; text-decoration: none; font-weight: 600;">
                                    <i class="bi bi-telephone"></i> {{ $c->NOMOR_TELEPON_CUSTOMER }}
                                </a>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="cs-action-buttons">
                                <a href="{{ route('cs.customer.edit', $c->ID_CUSTOMER) }}" 
                                   class="cs-btn-action cs-btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                                <form action="{{ route('cs.customer.destroy', $c->ID_CUSTOMER) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="cs-btn-action cs-btn-delete" 
                                            onclick="return confirm('⚠️ Yakin ingin menghapus customer {{ $c->NAMA_CUSTOMER }}?')">
                                        <i class="bi bi-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="cs-empty-state">
                                <div class="cs-empty-icon">
                                    @if(request('search'))
                                        🔍
                                    @else
                                        👥
                                    @endif
                                </div>
                                <div class="cs-empty-text">
                                    @if(request('search'))
                                        Tidak ada customer dengan nama "{{ request('search') }}"
                                    @else
                                        Belum ada data customer
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
    @if($customers->hasPages())
    <div class="cs-pagination">
        {{ $customers->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
// Optional: Auto-hide success message after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.querySelector('.cs-alert-success');
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