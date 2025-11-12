@extends('layout.app')

@section('title', 'Edit Transaksi Produk')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">✏️ Edit Transaksi Produk</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_produk.update', $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- PRODUK -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Produk dan Jumlah</label>
          <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle" id="produkTable">
              <thead class="table-light text-center">
                <tr>
                  <th>Produk</th>
                  <th width="120">Jumlah</th>
                  <th width="160">Subtotal</th>
                  <th width="150">Aksi</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($transaksi->details as $detail)
                <tr>
                  <td>
                    <select name="produk_id[]" class="form-select produkSelect" required>
                      <option value="">-- Pilih Produk --</option>

                      @foreach ($produks as $p)
                        <option
                          value="{{ $p->ID_PRODUK }}"
                          data-harga="{{ $p->HARGA_PRODUK }}"
                          data-stok="{{ $p->STOK_PRODUK }}"
                          {{ $p->STOK_PRODUK <= 0 ? 'disabled' : '' }}
                          {{ $detail->produk->ID_PRODUK == $p->ID_PRODUK ? 'selected' : '' }}
                        >
                          {{ $p->NAMA_PRODUK }}
                          (Rp {{ number_format($p->HARGA_PRODUK, 0, ',', '.') }})
                          — Stok:
                          {{ $p->STOK_PRODUK <= 0 ? 'Habis' : $p->STOK_PRODUK }}
                        </option>
                      @endforeach
                    </select>
                  </td>

                  <td>
                    <input type="number" name="jumlah[]" class="form-control jumlahInput"
                      min="1" value="{{ $detail->JUMLAH_ORDER_PRODUK }}" required>
                  </td>

                  <td class="text-end align-middle">
                    <span class="subtotalText">
                      Rp {{ number_format($detail->produk->HARGA_PRODUK * $detail->JUMLAH_ORDER_PRODUK, 0, ',', '.') }}
                    </span>
                  </td>

                  <td class="text-center">
                    <button type="button" class="btn btn-outline-secondary btn-sm resetRow">
                      <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>

                    <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>

          <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm mt-2">
            <i class="bi bi-plus-circle"></i> Tambah Produk
          </button>
        </div>

        <hr>

        <!-- TOTAL -->
        <div class="d-flex justify-content-end align-items-center">
          <h5 class="me-3 mb-0">Total:</h5>
          <h4 id="grandTotal" class="fw-bold text-success mb-0">
            Rp {{ number_format($transaksi->TOTAL_HARGA_PENJUALAN_PRODUK, 0, ',', '.') }}
          </h4>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('cs.transaksi_produk.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
          </a>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Simpan Perubahan
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- TOAST ERROR -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="toastError" class="toast align-items-center text-white bg-danger border-0">
    <div class="d-flex">
      <div class="toast-body fw-bold" id="toastErrorMessage">Error!</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>

  <!-- TOAST WARNING -->
  <div id="toastWarning" class="toast align-items-center text-dark bg-warning border-0 mt-2">
    <div class="d-flex">
      <div class="toast-body fw-bold" id="toastWarningMessage">Warning!</div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  const tableBody = document.querySelector('#produkTable tbody');
  const addRowBtn = document.getElementById('addRow');
  const grandTotal = document.getElementById('grandTotal');

  function showError(msg) {
    document.getElementById('toastErrorMessage').textContent = msg;
    new bootstrap.Toast(document.getElementById('toastError')).show();
  }

  function showWarning(msg) {
    document.getElementById('toastWarningMessage').textContent = msg;
    new bootstrap.Toast(document.getElementById('toastWarning')).show();
  }

  // Hitung subtotal
  function hitungSubtotal(row) {
    const select = row.querySelector('.produkSelect');
    const jumlah = row.querySelector('.jumlahInput');
    const subtotalText = row.querySelector('.subtotalText');

    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);

    subtotalText.textContent = 'Rp ' + (harga * qty).toLocaleString('id-ID');
    hitungTotalKeseluruhan();
  }

  // Total keseluruhan
  function hitungTotalKeseluruhan() {
    let total = 0;
    document.querySelectorAll('.subtotalText').forEach(el => {
      total += parseInt(el.textContent.replace(/[^\d]/g, '') || 0);
    });
    grandTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  // Tambah baris
  addRowBtn.addEventListener('click', () => {
    const firstRow = tableBody.querySelector('tr');
    const newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('select,input').forEach(el => el.value = '');
    newRow.querySelector('.subtotalText').textContent = 'Rp 0';

    tableBody.appendChild(newRow);
  });

  // Reset baris
  tableBody.addEventListener('click', e => {
    if (e.target.closest('.resetRow')) {
      const row = e.target.closest('tr');
      row.querySelectorAll('select,input').forEach(el => el.value = '');
      row.querySelector('.subtotalText').textContent = 'Rp 0';
      hitungTotalKeseluruhan();
    }
  });

  // Hapus baris (minimal harus 1)
  tableBody.addEventListener('click', e => {
    if (e.target.closest('.removeRow')) {

      if (tableBody.rows.length <= 1) {
        showError("Minimal harus ada 1 produk dalam transaksi!");
        return;
      }

      e.target.closest('tr').remove();
      hitungTotalKeseluruhan();
    }
  });

  // Cek duplikasi + stok
  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('produkSelect')) {
      const selected = e.target;
      const option = selected.selectedOptions[0];
      const stok = parseInt(option.dataset.stok || 0);

      // Duplikasi
      const values = [...document.querySelectorAll('.produkSelect')].map(s => s.value);
      if (values.filter(v => v === selected.value).length > 1) {
        showError("Produk tidak boleh duplikat!");
        selected.value = "";
        return;
      }

      // Stok habis
      if (stok <= 0) {
        showError("Stok produk habis!");
        selected.value = "";
        return;
      }

      // Stok menipis
      if (stok > 0 && stok <= 5) {
        showWarning("Stok hampir habis! Sisa " + stok);
      }

      const jumlahInput = selected.closest('tr').querySelector('.jumlahInput');
      jumlahInput.value = 1;

      hitungSubtotal(selected.closest('tr'));
    }
  });

  // Validasi stok saat ubah jumlah
  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {

      const jumlahInput = e.target;
      const row = jumlahInput.closest('tr');
      const select = row.querySelector('.produkSelect');
      const option = select.selectedOptions[0];

      if (!option) return;

      const stok = parseInt(option.dataset.stok || 0);
      const qty = parseInt(jumlahInput.value);

      if (qty > stok) {
        showError(`Jumlah melebihi stok! (Stok: ${stok})`);
        jumlahInput.value = stok;
      }

      if (qty === stok) {
        showWarning("Anda menggunakan sisa stok terakhir!");
      }

      hitungSubtotal(row);
    }
  });

  hitungTotalKeseluruhan();
});
</script>

@endsection
