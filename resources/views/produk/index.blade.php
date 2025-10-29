@extends('layout.app')

@section('title', 'Data Produk')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Produk</h2>

  <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($produks as $produk)
      <tr>
        <td>{{ $produk->ID_PRODUK }}</td>
        <td>{{ $produk->NAMA_PRODUK }}</td>
        <td>{{ $produk->DESKRIPSI_PRODUK }}</td>
        <td>
          @if($produk->GAMBAR_PRODUK)
            <img src="{{ asset('storage/' . $produk->GAMBAR_PRODUK) }}" alt="gambar" width="100">
          @else
            <span class="text-muted">Tidak ada</span>
          @endif
        </td>
        <td>{{ $produk->STOK_PRODUK }}</td>
        <td>Rp {{ number_format($produk->HARGA_PRODUK, 0, ',', '.') }}</td>
        <td>
          <a href="{{ route('produk.edit', $produk->ID_PRODUK) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('produk.destroy', $produk->ID_PRODUK) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
