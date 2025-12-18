@extends('layout.owner')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Tambah Layanan Baru</h2>

  <form action="{{ route('owner.layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow-sm p-4">

      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Layanan</label>
        <input type="text" name="NAMA_LAYANAN" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="DESKRIPSI_LAYANAN" rows="3" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Gambar (opsional)</label>
        <input type="file" name="GAMBAR_LAYANAN" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga</label>
        <input type="number" name="HARGA_LAYANAN" class="form-control" required>
      </div>

      <div class="mt-4">
        <button class="btn btn-success px-4">Simpan</button>
        <a href="{{ route('owner.layanan.index') }}" class="btn btn-secondary px-4">Kembali</a>
      </div>

    </div>
  </form>
</div>
@endsection
