@extends('layout.cs')

@section('title', 'Tambah Hewan')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Tambah Hewan Baru</h2>

  <form action="{{ route('cs.hewan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Pemilik (Customer)</label>
      <select name="ID_CUSTOMER" class="form-select" required>
        <option value="">-- Pilih Pemilik --</option>
        @foreach($customers as $customer)
          <option value="{{ $customer->ID_CUSTOMER }}">{{ $customer->NAMA_CUSTOMER }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Hewan</label>
      <input type="text" name="NAMA_HEWAN" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal Lahir Hewan</label>
      <input type="date" name="TGL_LAHIR_HEWAN" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Hewan</label>
      <select name="JENIS_HEWAN" class="form-select" required>
        <option value="">-- Pilih Jenis Hewan --</option>
        <option value="Kucing">Kucing 🐱</option>
        <option value="Anjing">Anjing 🐶</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('cs.hewan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
