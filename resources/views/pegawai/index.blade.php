@extends('layout.app')

@section('title', 'Data Pegawai')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Pegawai</h2>

  {{-- 🔍 Form Pencarian --}}
  <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2" 
           placeholder="Cari Pegawai (Nama Pegawai)" 
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- 💬 Info hasil pencarian --}}
  @if(request('search'))
    <div class="alert alert-info">
      Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong>
    </div>
  @endif

  {{-- 🔔 Pesan sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-3">+ Tambah Pegawai</a>

  {{-- 📋 Tabel Data Pegawai --}}
  <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama Pegawai</th>
        <th>Alamat</th>
        <th>Tanggal Lahir</th>
        <th>No. Telepon</th>
        <th>Username</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- ✅ Gunakan forelse agar tampil pesan kalau data kosong --}}
      @forelse ($pegawais as $pegawai)
        <tr>
          <td>{{ $pegawai->ID_PEGAWAI }}</td>
          <td>{{ $pegawai->NAMA_PEGAWAI }}</td>
          <td>{{ $pegawai->ALAMAT_PEGAWAI }}</td>
          <td>{{ $pegawai->TGL_LAHIR_PEGAWAI }}</td>
          <td>{{ $pegawai->NOMOR_TELEPON_PEGAWAI }}</td>
          <td>{{ $pegawai->USERNAME }}</td>
          <td>
            <a href="{{ route('pegawai.edit', $pegawai->ID_PEGAWAI) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('pegawai.destroy', $pegawai->ID_PEGAWAI) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pegawai ini?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        {{-- ⚠️ Pesan kalau data kosong --}}
        <tr>
          <td colspan="7" class="text-center text-muted">Data pegawai tidak ditemukan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
