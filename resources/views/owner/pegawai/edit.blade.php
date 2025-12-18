@extends('layout.owner')

@section('title', 'Edit Pegawai')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Edit Pegawai</h2>

  <form action="{{ route('owner.pegawai.update', $pegawai->ID_PEGAWAI) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card shadow-sm p-4">

      {{-- JABATAN --}}
      <div class="mb-3">
        <label class="form-label">Jabatan</label>
        <select name="ID_JABATAN" class="form-control" required>
          <option value="1" {{ $pegawai->ID_JABATAN == 1 ? 'selected' : '' }}>Kasir</option>
          <option value="2" {{ $pegawai->ID_JABATAN == 2 ? 'selected' : '' }}>CS</option>
          <option value="3" {{ $pegawai->ID_JABATAN == 3 ? 'selected' : '' }}>Owner</option>
        </select>
      </div>

      {{-- NAMA --}}
      <div class="mb-3">
        <label class="form-label">Nama Pegawai</label>
        <input type="text"
               name="NAMA_PEGAWAI"
               class="form-control"
               value="{{ $pegawai->NAMA_PEGAWAI }}"
               required>
      </div>

      {{-- ALAMAT --}}
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="ALAMAT_PEGAWAI"
                  class="form-control"
                  rows="3"
                  required>{{ $pegawai->ALAMAT_PEGAWAI }}</textarea>
      </div>

      {{-- TANGGAL LAHIR --}}
      <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date"
               name="TGL_LAHIR_PEGAWAI"
               class="form-control"
               value="{{ $pegawai->TGL_LAHIR_PEGAWAI }}"
               required>
      </div>

      {{-- NOMOR TELEPON --}}
      <div class="mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="text"
               name="NOMOR_TELEPON_PEGAWAI"
               class="form-control"
               value="{{ $pegawai->NOMOR_TELEPON_PEGAWAI }}"
               pattern="[0-9]{10,12}"
               maxlength="12"
               title="Nomor telepon harus 10-12 digit angka"
               required>
      </div>

      {{-- USERNAME --}}
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text"
               name="USERNAME"
               class="form-control"
               value="{{ $pegawai->USERNAME }}"
               required>
      </div>

      {{-- PASSWORD (OPSIONAL) --}}
      <div class="mb-3">
        <label class="form-label">
          Password <small class="text-muted">(kosongkan jika tidak diubah)</small>
        </label>
        <input type="password"
               name="PASSWORD"
               class="form-control"
               minlength="6">
      </div>

      {{-- ACTION --}}
      <div class="mt-4">
        <button class="btn btn-success">Update</button>
        <a href="{{ route('owner.pegawai.index') }}" class="btn btn-secondary">Kembali</a>
      </div>

    </div>
  </form>
</div>
@endsection
