@extends('layout.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Edit Produk</h2>

  <form action="{{ route('produk.update', $produk->ID_PRODUK) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="NAMA_PRODUK" class="form-control" value="{{ $produk->NAMA_PRODUK }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="DESKRIPSI_PRODUK" class="form-control" rows="3" required>{{ $produk->DESKRIPSI_PRODUK }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar</label><br>
      @if($produk->GAMBAR_PRODUK)
        <img src="{{ asset('storage/' . $produk->GAMBAR_PRODUK) }}" alt="gambar" width="120" class="mb-2"><br>
      @endif
      <input type="file" name="GAMBAR_PRODUK" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input type="number" name="STOK_PRODUK" class="form-control" value="{{ $produk->STOK_PRODUK }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="HARGA_PRODUK" class="form-control" value="{{ $produk->HARGA_PRODUK }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
