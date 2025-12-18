@extends('layout.owner')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Tambah Produk Baru</h2>

  <form action="{{ route('owner.produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow-sm p-4">

      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Produk</label>
        <input type="text" name="NAMA_PRODUK" 
               class="form-control @error('NAMA_PRODUK') is-invalid @enderror"
               required>
        @error('NAMA_PRODUK') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi Produk</label>
        <textarea name="DESKRIPSI_PRODUK" rows="3"
                  class="form-control @error('DESKRIPSI_PRODUK') is-invalid @enderror"
                  required></textarea>
        @error('DESKRIPSI_PRODUK') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Gambar Produk (opsional)</label>
        <input type="file" name="GAMBAR_PRODUK" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="STOK_PRODUK"
               class="form-control @error('STOK_PRODUK') is-invalid @enderror" required>
        @error('STOK_PRODUK') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga</label>
        <input type="number" name="HARGA_PRODUK"
               class="form-control @error('HARGA_PRODUK') is-invalid @enderror" required>
        @error('HARGA_PRODUK') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success px-4">Simpan</button>
        <a href="{{ route('owner.produk.index') }}" class="btn btn-secondary px-4">Kembali</a>
      </div>

    </div>
  </form>
</div>
@endsection
