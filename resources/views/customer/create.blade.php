@extends('layout.app')
@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">{{ isset($customer) ? 'Edit Customer' : 'Tambah Customer' }}</h2>

  <form action="{{ isset($customer) ? route('customer.update', $customer->ID_CUSTOMER) : route('customer.store') }}" method="POST">
    @csrf
    @if(isset($customer)) @method('PUT') @endif

    <div class="mb-3">
      <label>ID Pegawai</label>
      <input type="number" name="ID_PEGAWAI" class="form-control" value="{{ $customer->ID_PEGAWAI ?? '' }}" required>
    </div>
    <div class="mb-3">
      <label>Nama Customer</label>
      <input type="text" name="NAMA_CUSTOMER" class="form-control" value="{{ $customer->NAMA_CUSTOMER ?? '' }}" required>
    </div>
    <div class="mb-3">
      <label>Alamat</label>
      <input type="text" name="ALAMAT_CUSTOMER" class="form-control" value="{{ $customer->ALAMAT_CUSTOMER ?? '' }}" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Lahir</label>
      <input type="date" name="TGL_LAHIR_CUSTOMER" class="form-control" value="{{ $customer->TGL_LAHIR_CUSTOMER ?? '' }}" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Nomor Telepon</label>
    <input 
        type="text" 
        name="NOMOR_TELEPON_CUSTOMER" 
        class="form-control" 
        required 
        pattern="[0-9]{10,12}"        
        maxlength="12"                
        inputmode="numeric"           
        title="Nomor telepon hanya boleh berisi angka (10 - 12 digit)">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
