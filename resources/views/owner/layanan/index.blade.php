@extends('layout.owner')

@section('title', 'Data Layanan')

@section('content')
<div class="container mt-4">
  <h2 class="fw-bold mb-4">Data Layanan</h2>

  {{-- 🔍 Form Pencarian --}}
  <form action="{{ route('owner.layanan.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2"
           placeholder="Cari layanan..."
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-outline-primary">Search</button>
    <a href="{{ route('owner.layanan.index') }}" class="btn btn-secondary ms-2">Reset</a>
  </form>

  {{-- Info pencarian --}}
  @if(request('search'))
    <div class="alert alert-info">
      Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
    </div>
  @endif

  {{-- Pesan sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('owner.layanan.create') }}" class="btn btn-primary mb-3">+ Tambah Layanan</a>

  {{-- Tabel --}}
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-bordered text-center align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          @forelse ($layanans as $layanan)
            <tr>
              <td>{{ $layanan->ID_LAYANAN }}</td>
              <td>{{ $layanan->NAMA_LAYANAN }}</td>
              <td>{{ $layanan->DESKRIPSI_LAYANAN }}</td>

              <td>
                @if($layanan->GAMBAR_LAYANAN)
                  <img src="{{ asset('storage/' . $layanan->GAMBAR_LAYANAN) }}"
                       width="100" class="rounded shadow-sm">
                @else
                  <span class="text-muted">Tidak ada</span>
                @endif
              </td>

              <td>Rp {{ number_format($layanan->HARGA_LAYANAN, 0, ',', '.') }}</td>

              <td>
                <a href="{{ route('owner.layanan.edit', $layanan->ID_LAYANAN) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('owner.layanan.destroy', $layanan->ID_LAYANAN) }}"
                      method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Hapus layanan ini?')"
                          class="btn btn-danger btn-sm">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-muted py-3">Tidak ada layanan.</td>
            </tr>
          @endforelse

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
