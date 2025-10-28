@extends('layout.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Edit Layanan</h2>

  <form action="{{ route('layanan.update', $layanan->ID_LAYANAN) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama Layanan</label>
      <input type="text" name="NAMA_LAYANAN" class="form-control" value="{{ $layanan->NAMA_LAYANAN }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="DESKRIPSI_LAYANAN" class="form-control" rows="3" required>{{ $layanan->DESKRIPSI_LAYANAN }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar</label><br>
      @if($layanan->GAMBAR_LAYANAN)
        <img src="{{ asset('storage/' . $layanan->GAMBAR_LAYANAN) }}" alt="gambar" width="120" class="mb-2"><br>
      @endif
      <input type="file" name="GAMBAR_LAYANAN" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="HARGA_LAYANAN" class="form-control" value="{{ $layanan->HARGA_LAYANAN }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
