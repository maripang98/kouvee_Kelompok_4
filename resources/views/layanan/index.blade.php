@extends('layout.app')

@section('title', 'Data Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Layanan</h2>

  {{-- 🔍 Form Pencarian --}}
  <form action="{{ route('layanan.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2" 
           placeholder="Cari layanan (nama layanan)" 
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary ms-2">Reset</a>
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

  <a href="{{ route('layanan.create') }}" class="btn btn-primary mb-3">+ Tambah Layanan</a>

  {{-- 📋 Tabel Data Layanan --}}
  <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama Layanan</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- ✅ Gunakan @forelse supaya bisa tampil pesan jika kosong --}}
      @forelse ($layanans as $layanan)
        <tr>
          <td>{{ $layanan->ID_LAYANAN }}</td>
          <td>{{ $layanan->NAMA_LAYANAN }}</td>
          <td>{{ $layanan->DESKRIPSI_LAYANAN }}</td>
          <td>
            @if($layanan->GAMBAR_LAYANAN)
              <img src="{{ asset('storage/' . $layanan->GAMBAR_LAYANAN) }}" alt="gambar" width="100">
            @else
              <span class="text-muted">Tidak ada</span>
            @endif
          </td>
          <td>Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}</td>
          <td>
            <a href="{{ route('layanan.edit', $layanan->ID_LAYANAN) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('layanan.destroy', $layanan->ID_LAYANAN) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus layanan ini?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        {{-- ⚠️ Pesan kalau data kosong --}}
        <tr>
          <td colspan="6" class="text-center text-muted">Data layanan tidak ditemukan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
