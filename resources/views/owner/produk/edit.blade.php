@extends('layout.owner')

@section('title', 'Edit Produk')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Edit Produk</h2>

  <form action="{{ route('owner.produk.update', $produk->ID_PRODUK) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card shadow-sm p-4">

      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Produk</label>
        <input type="text" name="NAMA_PRODUK" 
               value="{{ $produk->NAMA_PRODUK }}"
               class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="DESKRIPSI_PRODUK" class="form-control" rows="3" required>
          {{ $produk->DESKRIPSI_PRODUK }}
        </textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Gambar Produk</label><br>
        @if($produk->GAMBAR_PRODUK)
          <img src="{{ asset('storage/' . $produk->GAMBAR_PRODUK) }}" 
               alt="gambar" width="150" class="rounded shadow-sm mb-3"><br>
        @endif

        <input type="file" name="GAMBAR_PRODUK" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="STOK_PRODUK" 
               value="{{ $produk->STOK_PRODUK }}"
               class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga</label>
        <input type="number" name="HARGA_PRODUK" 
               value="{{ $produk->HARGA_PRODUK }}"
               class="form-control" required>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success px-4">Update</button>
        <a href="{{ route('owner.produk.index') }}" class="btn btn-secondary px-4">Kembali</a>
      </div>

    </div>
  </form>
</div>
@endsection
