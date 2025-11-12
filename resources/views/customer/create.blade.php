@extends('layout.app')

@section('content')
<div class="container mt-5">
  <h2 class="mb-4 fw-bold">{{ isset($customer) ? 'Edit Customer' : 'Tambah Customer' }}</h2>

  {{-- Tampilkan pesan sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Tampilkan pesan error umum --}}
  @if($errors->has('duplicate'))
    <div class="alert alert-danger">{{ $errors->first('duplicate') }}</div>
  @endif

  {{-- Tampilkan daftar error validasi --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ isset($customer) ? route('customer.update', $customer->ID_CUSTOMER) : route('customer.store') }}" method="POST">
    @csrf
    @if(isset($customer)) @method('PUT') @endif

    <div class="container mt-5">

  {{-- Pesan error global --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ isset($customer) ? route('customer.update', $customer->ID_CUSTOMER) : route('customer.store') }}" method="POST">
    @csrf
    @if(isset($customer)) @method('PUT') @endif

    {{-- Dropdown ID Pegawai --}}
    <div class="mb-3">
      <label class="form-label">Pegawai</label>
      <select 
        name="ID_PEGAWAI" 
        class="form-select @error('ID_PEGAWAI') is-invalid @enderror" 
        required>
        <option value="">-- Pilih Pegawai --</option>
        @foreach($pegawais as $pegawai)
          <option value="{{ $pegawai->ID_PEGAWAI }}"
            {{ old('ID_PEGAWAI', $customer->ID_PEGAWAI ?? '') == $pegawai->ID_PEGAWAI ? 'selected' : '' }}>
            {{ $pegawai->NAMA_PEGAWAI }}
          </option>
        @endforeach
      </select>
      @error('ID_PEGAWAI')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

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
    <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
