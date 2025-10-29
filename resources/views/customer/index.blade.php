@extends('layout.app')
@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">Data Customer</h2>

  {{-- 🔍 Form Pencarian --}}
  <form action="{{ route('customer.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2" 
           placeholder="Cari customer (nama atau no. telepon)" 
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- 🔔 Info hasil pencarian --}}
  @if(request('search'))
    <div class="alert alert-info">
      Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong>
    </div>
  @endif

  {{-- 🔔 Pesan sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">+ Tambah Customer</a>

  {{-- 📋 Tabel Data Customer --}}
  <table class="table table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>ID Pegawai</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tgl Lahir</th>
        <th>No. Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- ✅ Gunakan @forelse agar bisa tampil pesan kalau data kosong --}}
      @forelse ($customers as $c)
        <tr>
          <td>{{ $c->ID_CUSTOMER }}</td>
          <td>{{ $c->ID_PEGAWAI }}</td>
          <td>{{ $c->NAMA_CUSTOMER }}</td>
          <td>{{ $c->ALAMAT_CUSTOMER }}</td>
          <td>{{ $c->TGL_LAHIR_CUSTOMER }}</td>
          <td>{{ $c->NOMOR_TELEPON_CUSTOMER }}</td>
          <td>
            <a href="{{ route('customer.edit', $c->ID_CUSTOMER) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('customer.destroy', $c->ID_CUSTOMER) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        {{-- ⚠️ Kalau data kosong (misal hasil search tidak ketemu) --}}
        <tr>
          <td colspan="7" class="text-center text-muted">Data customer tidak ditemukan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
