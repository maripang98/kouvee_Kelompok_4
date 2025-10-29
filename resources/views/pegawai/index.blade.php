@extends('layout.app')

@section('title', 'Data Pegawai')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4 fw-bold">Data Pegawai</h2>

  <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-3">+ Tambah Pegawai</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

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
      @foreach ($pegawais as $pegawai)
      <tr>
        <td>{{ $pegawai->ID_PEGAWAI }}</td>
        <td>{{ $pegawai->NAMA_PEGAWAI }}</td>
        <td>{{ $pegawai->ALAMAT_PAGAWAI }}</td>
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
      @endforeach
    </tbody>
  </table>
</div>
@endsection
