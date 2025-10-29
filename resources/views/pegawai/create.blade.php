@extends('layout.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Tambah Pegawai Baru</h2>

  <form action="{{ route('pegawai.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">ID Jabatan</label>
      <input type="number" name="ID_JABATAN" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Pegawai</label>
      <input type="text" name="NAMA_PEGAWAI" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="ALAMAT_PEGAWAI" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal Lahir</label>
      <input type="date" name="TGL_LAHIR_PEGAWAI" class="form-control" required>
    </div>

    <div class="mb-3">
    <label class="form-label">Nomor Telepon</label>
    <input 
        type="text" 
        name="NOMOR_TELEPON_PEGAWAI" 
        class="form-control" 
        required 
        pattern="[0-9]{10,12}"        
        maxlength="12"                
        inputmode="numeric"           
        title="Nomor telepon hanya boleh berisi angka (10 - 12 digit)">
    </div>

    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="USERNAME" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="PASSWORD" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
