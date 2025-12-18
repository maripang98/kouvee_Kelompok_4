@extends('layout.cs')

@section('title', 'Tambah Transaksi Produk')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">➕ Tambah Transaksi Produk</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_produk.store') }}" method="POST">
        @csrf

        <!-- CUSTOMER -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <select name="id_customer" class="form-select" required>
            <option value="">-- Pilih Customer --</option>

            @foreach ($customers as $c)
                <option value="{{ $c->ID_CUSTOMER }}">
                    {{ $c->NAMA_CUSTOMER }} — {{ $c->NOMOR_TELEPON_CUSTOMER }}
                </option>
            @endforeach
        </select>

        </div>

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
                <tr>
                  <td>
                    <select name="produk_id[]" class="form-select produkSelect" required>
                      <option value="" data-harga="0" data-stok="0">-- Pilih Produk --</option>

                      @foreach ($produks as $p)
                        <option 
                          value="{{ $p->ID_PRODUK }}"
                          data-harga="{{ $p->HARGA_PRODUK }}"
                          data-stok="{{ $p->STOK_PRODUK }}"
                          {{ $p->STOK_PRODUK <= 0 ? 'disabled' : '' }}>
                          {{ $p->NAMA_PRODUK }}
                          (Rp {{ number_format($p->HARGA_PRODUK, 0, ',', '.') }}) —
                          Stok: {{ $p->STOK_PRODUK <= 0 ? 'Habis' : $p->STOK_PRODUK }}
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
                    <button type="button" class="btn btn-outline-secondary btn-sm resetRow">Reset</button>
                    <button type="button" class="btn btn-outline-danger btn-sm removeRow">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm mt-2">
            ➕ Tambah Produk
          </button>
        </div>

        <hr>

        <!-- TOTAL -->
        <div class="d-flex justify-content-end align-items-center">
          <h5 class="me-3 mb-0">Total:</h5>
          <h4 id="grandTotal" class="fw-bold text-success mb-0">Rp 0</h4>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('cs.transaksi_produk.index') }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- TOAST NOTIF -->
<div class="position-fixed top-0 end-0 p-3" style="z-index:9999">
  <div id="toastError" class="toast bg-danger text-white border-0 fade">
    <div class="toast-body fw-bold" id="toastErrorMessage"></div>
  </div>
  <div id="toastWarning" class="toast bg-warning border-0 fade mt-2">
    <div class="toast-body fw-bold" id="toastWarningMessage"></div>
  </div>
</div>


<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {

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

  function hitungSubtotal(row) {
    const select = row.querySelector('.produkSelect');
    const jumlah = row.querySelector('.jumlahInput');
    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);

    row.querySelector('.subtotalText').textContent =
      'Rp ' + (harga * qty).toLocaleString('id-ID');

    hitungTotal();
  }

  function hitungTotal() {
    let total = 0;
    document.querySelectorAll('.subtotalText').forEach(el => {
      total += parseInt(el.textContent.replace(/[^\d]/g, '') || 0);
    });
    grandTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  addRowBtn.addEventListener('click', () => {
    const newRow = tableBody.querySelector('tr').cloneNode(true);
    newRow.querySelectorAll('select,input').forEach(el => el.value = '');
    newRow.querySelector('.subtotalText').textContent = 'Rp 0';
    tableBody.appendChild(newRow);
  });

  tableBody.addEventListener('click', e => {
    if (e.target.closest('.resetRow')) {
      const row = e.target.closest('tr');
      row.querySelectorAll('select,input').forEach(el => el.value = '');
      row.querySelector('.subtotalText').textContent = 'Rp 0';
      hitungTotal();
    }

    if (e.target.closest('.removeRow')) {
      if (tableBody.rows.length === 1) {
        return showError("Minimal 1 produk!");
      }
      e.target.closest('tr').remove();
      hitungTotal();
    }
  });

  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('produkSelect')) {
      const selected = e.target;
      const stok = parseInt(selected.selectedOptions[0].dataset.stok || 0);

      const values = [...document.querySelectorAll('.produkSelect')].map(s => s.value);
      if (values.filter(v => v === selected.value).length > 1) {
        showError("Produk tidak boleh duplikat!");
        selected.value = "";
        return;
      }

      if (stok <= 0) {
        showError("Stok produk habis!");
        selected.value = "";
        return;
      }

      if (stok <= 5) {
        showWarning("Stok hampir habis (" + stok + ")");
      }

      hitungSubtotal(selected.closest('tr'));
    }
  });

  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {

      const row = e.target.closest('tr');
      const select = row.querySelector('.produkSelect');
      const stok = parseInt(select.selectedOptions[0]?.dataset.stok || 0);
      const qty = parseInt(e.target.value);

      if (qty > stok) {
        showError("Jumlah melebihi stok (" + stok + ")");
        e.target.value = stok;
      }

      hitungSubtotal(row);
    }
  });

});
</script>

@endsection
