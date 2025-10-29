@extends('layout.app')

@section('title', 'Data Hewan')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Hewan</h2>

  <a href="{{ route('hewan.create') }}" class="btn btn-primary mb-3">+ Tambah Hewan</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama Hewan</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Hewan</th>
        <th>Pemilik (Customer)</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($hewans as $hewan)
      <tr>
        <td>{{ $hewan->ID_HEWAN }}</td>
        <td>{{ $hewan->NAMA_HEWAN }}</td>
        <td>{{ $hewan->TGL_LAHIR_HEWAN }}</td>
        <td>{{ $hewan->JENIS_HEWAN }}</td>
        <td>{{ $hewan->customer->NAMA_CUSTOMER ?? 'Tidak diketahui' }}</td>
        <td>
          <a href="{{ route('hewan.edit', $hewan->ID_HEWAN) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('hewan.destroy', $hewan->ID_HEWAN) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data hewan ini?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
