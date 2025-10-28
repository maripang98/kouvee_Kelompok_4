@extends('layout.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Tambah Layanan Baru</h2>

  <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nama Layanan</label>
      <input type="text" name="NAMA_LAYANAN" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="DESKRIPSI_LAYANAN" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar (opsional)</label>
      <input type="file" name="GAMBAR_LAYANAN" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="HARGA_LAYANAN" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
