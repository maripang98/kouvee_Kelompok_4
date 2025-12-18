@extends('layout.owner')

@section('title', 'Edit Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Edit Layanan</h2>

  <form action="{{ route('owner.layanan.update', $layanan->ID_LAYANAN) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card shadow-sm p-4">

      <div class="mb-3">
        <label class="form-label fw-semibold">Nama Layanan</label>
        <input type="text" name="NAMA_LAYANAN"
               value="{{ $layanan->NAMA_LAYANAN }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="DESKRIPSI_LAYANAN" rows="3" class="form-control" required>
{{ $layanan->DESKRIPSI_LAYANAN }}
        </textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Gambar</label><br>

        @if($layanan->GAMBAR_LAYANAN)
          <img src="{{ asset('storage/' . $layanan->GAMBAR_LAYANAN) }}"
               width="150" class="rounded shadow-sm mb-3">
          <br>
        @endif

        <input type="file" name="GAMBAR_LAYANAN" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Harga</label>
        <input type="number" name="HARGA_LAYANAN"
               value="{{ $layanan->HARGA_LAYANAN }}" class="form-control" required>
      </div>

      <div class="mt-4">
        <button class="btn btn-success px-4">Update</button>
        <a href="{{ route('owner.layanan.index') }}" class="btn btn-secondary px-4">Kembali</a>
      </div>

    </div>
  </form>
</div>
@endsection
