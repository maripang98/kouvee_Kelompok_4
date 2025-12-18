@extends('layout.owner')

@section('title', 'Data Produk (Owner)')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Kelola Produk</h2>

  {{-- 🔍 Form Pencarian --}}
  <form action="{{ route('owner.produk.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2" 
           placeholder="Cari Produk (Nama Produk)" 
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('owner.produk.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('owner.produk.create') }}" class="btn btn-primary mb-3">
    + Tambah Produk
  </a>

  <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($produks as $produk)
        <tr>
          <td>{{ $produk->ID_PRODUK }}</td>
          <td>{{ $produk->NAMA_PRODUK }}</td>
          <td>{{ $produk->DESKRIPSI_PRODUK }}</td>
          <td>
            @if($produk->GAMBAR_PRODUK)
              <img src="{{ asset('storage/' . $produk->GAMBAR_PRODUK) }}" width="80">
            @else
              <small class="text-muted">Tidak ada</small>
            @endif
          </td>
          <td>{{ $produk->STOK_PRODUK }}</td>
          <td>Rp {{ number_format($produk->HARGA_PRODUK,0,',','.') }}</td>
          <td>
            <a href="{{ route('owner.produk.edit', $produk->ID_PRODUK) }}" class="btn btn-warning btn-sm">
              Edit
            </a>

            <form action="{{ route('owner.produk.destroy', $produk->ID_PRODUK) }}" 
                  method="POST" 
                  class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk?')">
                Hapus
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-muted text-center">Tidak ada data produk.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>
@endsection
