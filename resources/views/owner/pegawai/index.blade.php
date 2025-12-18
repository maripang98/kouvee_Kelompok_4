@extends('layout.owner')

@section('title', 'Data Pegawai')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Data Pegawai</h2>

  {{-- 🔍 Pencarian --}}
  <form action="{{ route('owner.pegawai.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2"
           placeholder="Cari pegawai..."
           value="{{ request('search') }}">
    <button class="btn btn-outline-primary">Search</button>
    <a href="{{ route('owner.pegawai.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- Info pencarian --}}
  @if(request('search'))
    <div class="alert alert-info">
      Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
    </div>
  @endif

  {{-- Pesan sukses --}}
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('owner.pegawai.create') }}" class="btn btn-primary mb-3">+ Tambah Pegawai</a>

  {{-- TABLE --}}
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-bordered text-center align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tgl Lahir</th>
            <th>Telp</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          @forelse ($pegawais as $p)
            <tr>
              <td>{{ $p->ID_PEGAWAI }}</td>
              <td>{{ $p->NAMA_PEGAWAI }}</td>
              <td>{{ $p->ALAMAT_PEGAWAI }}</td>
              <td>{{ $p->TGL_LAHIR_PEGAWAI }}</td>
              <td>{{ $p->NOMOR_TELEPON_PEGAWAI }}</td>
              <td>{{ $p->USERNAME }}</td>

              <td>
                <a href="{{ route('owner.pegawai.edit', $p->ID_PEGAWAI) }}" 
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('owner.pegawai.destroy', $p->ID_PEGAWAI) }}"
                      method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus pegawai ini?')">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-muted py-3">Tidak ada pegawai.</td>
            </tr>
          @endforelse

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
