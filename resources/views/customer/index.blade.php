@extends('layout.app')
@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">Data Customer</h2>
  <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">+ Tambah Customer</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

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
      @foreach ($customers as $c)
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
      @endforeach
    </tbody>
  </table>
</div>
@endsection
