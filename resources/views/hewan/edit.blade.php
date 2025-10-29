@extends('layout.app')

@section('title', 'Edit Hewan')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Edit Data Hewan</h2>

  <form action="{{ route('hewan.update', $hewan->ID_HEWAN) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Pemilik (Customer)</label>
      <select name="ID_CUSTOMER" class="form-select" required>
        @foreach($customers as $customer)
          <option value="{{ $customer->ID_CUSTOMER }}" {{ $hewan->ID_CUSTOMER == $customer->ID_CUSTOMER ? 'selected' : '' }}>
            {{ $customer->NAMA_CUSTOMER }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Hewan</label>
      <input type="text" name="NAMA_HEWAN" class="form-control" value="{{ $hewan->NAMA_HEWAN }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal Lahir Hewan</label>
      <input type="date" name="TGL_LAHIR_HEWAN" class="form-control" value="{{ $hewan->TGL_LAHIR_HEWAN }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Hewan</label>
      <select name="JENIS_HEWAN" class="form-select" required>
        <option value="Kucing" {{ $hewan->JENIS_HEWAN == 'Kucing' ? 'selected' : '' }}>Kucing 🐱</option>
        <option value="Anjing" {{ $hewan->JENIS_HEWAN == 'Anjing' ? 'selected' : '' }}>Anjing 🐶</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
