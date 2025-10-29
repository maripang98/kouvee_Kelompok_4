@extends('layout.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Tambah Produk Baru</h2>

  <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="NAMA_PRODUK" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="DESKRIPSI_PRODUK" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar (opsional)</label>
      <input type="file" name="GAMBAR_PRODUK" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input type="number" name="STOK_PRODUK" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="HARGA_PRODUK" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
