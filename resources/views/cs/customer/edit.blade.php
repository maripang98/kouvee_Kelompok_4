@extends('layout.cs')
@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">{{ isset($customer) ? 'Edit Customer' : 'Tambah Customer' }}</h2>

  <form action="{{ isset($customer) ? route('cs.customer.update', $customer->ID_CUSTOMER) : route('customer.store') }}" method="POST">
    @csrf
    @if(isset($customer)) @method('PUT') @endif


    {{-- Nama Customer --}}
    <div class="mb-3">
      <label class="form-label">Nama Customer</label>
      <input 
        type="text" 
        name="NAMA_CUSTOMER" 
        class="form-control @error('NAMA_CUSTOMER') is-invalid @enderror" 
        value="{{ old('NAMA_CUSTOMER', $customer->NAMA_CUSTOMER ?? '') }}" 
        required>
      @error('NAMA_CUSTOMER')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Alamat --}}
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input 
        type="text" 
        name="ALAMAT_CUSTOMER" 
        class="form-control @error('ALAMAT_CUSTOMER') is-invalid @enderror" 
        value="{{ old('ALAMAT_CUSTOMER', $customer->ALAMAT_CUSTOMER ?? '') }}" 
        required>
      @error('ALAMAT_CUSTOMER')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Tanggal Lahir --}}
    <div class="mb-3">
      <label class="form-label">Tanggal Lahir</label>
      <input 
        type="date" 
        name="TGL_LAHIR_CUSTOMER" 
        class="form-control @error('TGL_LAHIR_CUSTOMER') is-invalid @enderror" 
        value="{{ old('TGL_LAHIR_CUSTOMER', $customer->TGL_LAHIR_CUSTOMER ?? '') }}" 
        required>
      @error('TGL_LAHIR_CUSTOMER')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Nomor Telepon (unik) --}}
    <div class="mb-3">
      <label class="form-label">Nomor Telepon</label>
      <input 
        type="text" 
        name="NOMOR_TELEPON_CUSTOMER" 
        class="form-control @error('NOMOR_TELEPON_CUSTOMER') is-invalid @enderror" 
        value="{{ old('NOMOR_TELEPON_CUSTOMER', $customer->NOMOR_TELEPON_CUSTOMER ?? '') }}" 
        pattern="[0-9]{10,12}" 
        maxlength="12" 
        inputmode="numeric"
        title="Nomor telepon hanya boleh berisi angka (10 - 12 digit)"
        required>
      @error('NOMOR_TELEPON_CUSTOMER')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('cs.customer.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
