@extends('layout.app')

@section('title', 'Data Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Layanan</h2>

  <a href="{{ route('layanan.create') }}" class="btn btn-primary mb-3">+ Tambah Layanan</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

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
      @foreach ($layanans as $layanan)
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
      @endforeach
    </tbody>
  </table>
</div>
@endsection
