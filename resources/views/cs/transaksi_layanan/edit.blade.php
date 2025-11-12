@extends('layout.app')

@section('title', 'Edit Transaksi Layanan')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">✏️ Edit Transaksi Layanan</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_layanan.update', $transaksi->ID_TRANSAKSI_LAYANAN) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- DETAIL LAYANAN -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Detail Layanan</label>

          <div class="table-responsive">
            <table class="table table-sm table-bordered align-middle" id="layananTable">
              <thead class="table-light text-center">
                <tr>
                  <th>Layanan</th>
                  <th width="120">Jumlah</th>
                  <th width="150">Subtotal</th>
                  <th width="150">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaksi->details as $detail)
                  <tr>
                    <td>
                      <select name="layanan_id[]" class="form-select layananSelect" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($layanans as $l)
                          <option 
                            value="{{ $l->ID_LAYANAN }}" 
                            data-harga="{{ $l->HARGA_LAYANAN }}"
                            {{ $detail->layanan->ID_LAYANAN == $l->ID_LAYANAN ? 'selected' : '' }}>
                            {{ $l->NAMA_LAYANAN }} (Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }})
                          </option>
                        @endforeach
                      </select>
                    </td>

                    <td>
                      <input type="number" name="jumlah[]" 
                             value="{{ $detail->JUMLAH_ORDER_LAYANAN }}" 
                             class="form-control jumlahInput" min="1" required>
                    </td>

                    <td class="text-end align-middle">
                      <span class="subtotalText">
                        Rp {{ number_format($detail->layanan->HARGA_LAYANAN * $detail->JUMLAH_ORDER_LAYANAN, 0, ',', '.') }}
                      </span>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-outline-secondary btn-sm resetRow">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                      </button>
                      <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                        <i class="bi bi-x-circle"></i> Hapus
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm mt-2">
            <i class="bi bi-plus-circle"></i> Tambah Layanan
          </button>
        </div>

        <hr>

        <!-- STATUS PEMBAYARAN -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Status Pembayaran</label>
          <select name="status_pembayaran" class="form-select" required>
            <option value="Lunas" 
              {{ strtolower(trim($transaksi->STATUS_PEMBAYARAN_LAYANAN)) == 'lunas' ? 'selected' : '' }}>
              Lunas
            </option>
            <option value="Belum Lunas" 
              {{ strtolower(trim($transaksi->STATUS_PEMBAYARAN_LAYANAN)) == 'belum lunas' ? 'selected' : '' }}>
              Belum Lunas
            </option>
          </select>
        </div>

        <hr>

        <!-- TOTAL -->
        <div class="d-flex justify-content-end align-items-center">
          <h5 class="me-3 mb-0">Total:</h5>
          <h4 id="grandTotal" class="fw-bold text-success mb-0">
            Rp {{ number_format($transaksi->TOTAL_HARGA_PENJUALAN_LAYANAN, 0, ',', '.') }}
          </h4>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('cs.transaksi_layanan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Batal
          </a>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- TOAST NOTIFIKASI ERROR -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="toastError" class="toast align-items-center text-white bg-danger border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body fw-bold" id="toastErrorMessage">Error!</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<!-- SCRIPT DINAMIS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tableBody = document.querySelector('#layananTable tbody');
  const addRowBtn = document.getElementById('addRow');
  const grandTotal = document.getElementById('grandTotal');

  // 🔔 Toast function
  function showToast(message) {
    const toastEl = document.getElementById('toastError');
    const msgEl = document.getElementById('toastErrorMessage');
    msgEl.textContent = message;
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }

  // Hitung subtotal
  function hitungSubtotal(row) {
    const select = row.querySelector('.layananSelect');
    const jumlah = row.querySelector('.jumlahInput');
    const subtotalText = row.querySelector('.subtotalText');
    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
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

  // ➕ Tambah baris baru
  addRowBtn.addEventListener('click', () => {
    const firstRow = tableBody.querySelector('tr');
    const newRow = firstRow.cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    newRow.querySelector('.subtotalText').textContent = 'Rp 0';
    tableBody.appendChild(newRow);
  });

  // 🧹 Reset baris
  tableBody.addEventListener('click', e => {
    if (e.target.closest('.resetRow')) {
      const row = e.target.closest('tr');
      row.querySelectorAll('select, input').forEach(el => el.value = '');
      row.querySelector('.subtotalText').textContent = 'Rp 0';
      hitungTotalKeseluruhan();
    }
  });

  // ❌ Hapus baris (validasi minimal 1)
  tableBody.addEventListener('click', e => {
    if (e.target.closest('.removeRow')) {
      const row = e.target.closest('tr');

      if (tableBody.rows.length <= 1) {
        showToast("Minimal harus ada 1 layanan dalam transaksi!");
        return;
      }

      row.remove();
      hitungTotalKeseluruhan();
    }
  });

  // 🛑 Cegah layanan duplikat dalam satu transaksi
  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('layananSelect')) {

      const currentSelect = e.target;
      const selectedValue = currentSelect.value;
      let duplicate = false;

      document.querySelectorAll('.layananSelect').forEach(select => {
        if (select !== currentSelect && select.value === selectedValue && selectedValue !== "") {
          duplicate = true;
        }
      });

      if (duplicate) {
        showToast("Layanan tidak boleh duplikat dalam satu transaksi!");
        currentSelect.value = ""; // reset pilihan
        hitungSubtotal(currentSelect.closest('tr'));
        return;
      }

      hitungSubtotal(currentSelect.closest('tr'));
    }
  });

  // Perubahan jumlah
  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });

  hitungTotalKeseluruhan();
});
</script>

@endsection
