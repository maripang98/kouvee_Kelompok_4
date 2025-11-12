@extends('layout.app')

@section('title', 'Tambah Transaksi Layanan')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">➕ Tambah Transaksi Layanan</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_layanan.store') }}" method="POST">
        @csrf

        <!-- Layanan -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Layanan dan Jumlah</label>
          <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle" id="layananTable">
              <thead class="table-light text-center">
                <tr>
                  <th>Layanan</th>
                  <th width="120">Jumlah</th>
                  <th width="160">Subtotal</th>
                  <th width="100">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select name="layanan_id[]" class="form-select layananSelect" required>
                      <option value="" data-harga="0">-- Pilih Layanan --</option>
                      @foreach ($layanans as $l)
                        <option value="{{ $l->ID_LAYANAN }}" data-harga="{{ $l->HARGA_LAYANAN }}">
                          {{ $l->NAMA_LAYANAN }} (Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }})
                        </option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" name="jumlah[]" class="form-control jumlahInput" min="1" value="1" required>
                  </td>
                  <td class="text-end align-middle">
                    <span class="subtotalText">Rp 0</span>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-outline-secondary btn-sm resetRow">
                      <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm mt-2">
            <i class="bi bi-plus-circle"></i> Tambah Layanan
          </button>
        </div>

        <hr>

        <!-- TOTAL AKHIR -->
        <div class="d-flex justify-content-end align-items-center">
          <h5 class="me-3 mb-0">Total:</h5>
          <h4 id="grandTotal" class="fw-bold text-success mb-0">Rp 0</h4>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('cs.transaksi_layanan.index') }}" class="btn btn-secondary">Batal</a>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan Transaksi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script Dinamis -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tableBody = document.querySelector('#layananTable tbody');
  const addRowBtn = document.getElementById('addRow');
  const grandTotal = document.getElementById('grandTotal');

  // Hitung subtotal per baris
  function hitungSubtotal(row) {
    const select = row.querySelector('.layananSelect');
    const jumlah = row.querySelector('.jumlahInput');
    const subtotalText = row.querySelector('.subtotalText');
    const harga = parseInt(select.selectedOptions[0].dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);
    const subtotal = harga * qty;
    subtotalText.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    hitungTotalKeseluruhan();
  }

  // Hitung total keseluruhan
  function hitungTotalKeseluruhan() {
    let total = 0;
    document.querySelectorAll('.subtotalText').forEach(el => {
      const val = el.textContent.replace(/[^\d]/g, '');
      total += parseInt(val || 0);
    });
    grandTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  // Tambah baris baru
  addRowBtn.addEventListener('click', () => {
    const newRow = tableBody.querySelector('tr').cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    newRow.querySelector('.subtotalText').textContent = 'Rp 0';
    tableBody.appendChild(newRow);
  });

  // Reset kolom per baris
  tableBody.addEventListener('click', e => {
    if (e.target.closest('.resetRow')) {
      const row = e.target.closest('tr');
      row.querySelectorAll('select, input').forEach(el => el.value = '');
      row.querySelector('.subtotalText').textContent = 'Rp 0';
      hitungTotalKeseluruhan();
    }
  });

  // Perubahan jumlah atau layanan → update subtotal
  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });

  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('layananSelect')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });
});
</script>
@endsection
