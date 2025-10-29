@extends('layout.app')

@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">Data Hewan</h2>
  <a href="{{ route('hewan.create') }}" class="btn btn-primary mb-3">+ Tambah Hewan</a>

  {{-- Pesan sukses atau info --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Form Pencarian --}}
  <form action="{{ route('hewan.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2"
           placeholder="Cari hewan (nama hewan atau id customer)..."
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('hewan.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- Info hasil pencarian --}}
  @if(request('search'))
    <div class="alert alert-info">
      Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong>
    </div>
  @endif

  {{-- Tabel data --}}
  <table class="table table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>ID Hewan</th>
        <th>Nama Hewan</th>
        <th>Jenis Hewan</th>
        <th>ID Customer</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- Forelse = foreach + pengecekan kosong --}}
      @forelse ($hewans as $h)
        <tr>
          <td>{{ $h->ID_HEWAN }}</td>
          <td>{{ $h->NAMA_HEWAN }}</td>
          <td>{{ $h->JENIS_HEWAN }}</td>
          <td>{{ $h->ID_CUSTOMER }}</td>
          <td>
            <a href="{{ route('hewan.edit', $h->ID_HEWAN) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('hewan.destroy', $h->ID_HEWAN) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        {{-- Pesan kalau data kosong --}}
        <tr>
          <td colspan="5" class="text-center text-muted">
            Data hewan tidak ditemukan.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
