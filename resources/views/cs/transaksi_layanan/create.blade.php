@extends('layout.cs')

@section('title', 'Tambah Transaksi Layanan')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">➕ Tambah Transaksi Layanan</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_layanan.store') }}" method="POST">
        @csrf

        <!-- ========================= -->
        <!-- PILIH CUSTOMER -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <select name="ID_CUSTOMER" id="customerSelect" class="form-select" required>
              <option value="">-- Pilih Customer --</option>
              @foreach ($customers as $c)
                  <option value="{{ $c->ID_CUSTOMER }}">{{ $c->NAMA_CUSTOMER }}</option>
              @endforeach
          </select>
        </div>

        <!-- ========================= -->
        <!-- PILIH HEWAN -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Hewan</label>
          <select name="ID_HEWAN" id="hewanSelect" class="form-select" required>
              <option value="">-- Pilih Hewan --</option>

              @foreach ($hewan as $h)
                  <option value="{{ $h->ID_HEWAN }}" data-owner="{{ $h->ID_CUSTOMER }}">
                      {{ $h->NAMA_HEWAN }} ({{ $h->JENIS_HEWAN }})
                  </option>
              @endforeach
          </select>
        </div>

        <hr>

        <!-- ========================= -->
        <!-- LAYANAN -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Layanan dan Jumlah</label>

          <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle" id="layananTable">
              <thead class="table-light text-center">
                <tr>
                  <th>Layanan</th>
                  <th width="120">Jumlah</th>
                  <th width="160">Subtotal</th>
                  <th width="160">Aksi</th>
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
                    <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                      <i class="bi bi-x-circle"></i> Hapus
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

        <!-- TOTAL -->
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

<!-- TOAST -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 999999;">
  <div id="toastError" class="toast text-bg-danger border-0">
    <div class="d-flex">
      <div class="toast-body fw-semibold" id="toastErrorMessage"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ============================
     FILTER HEWAN BERDASARKAN CUSTOMER
  ============================= */
  const customerSelect = document.getElementById('customerSelect');
  const hewanSelect = document.getElementById('hewanSelect');

  function filterHewan() {
      const selectedCustomer = customerSelect.value;

      hewanSelect.value = "";
      for (let opt of hewanSelect.options) {
          if (!opt.value) continue;

          opt.hidden = (opt.dataset.owner !== selectedCustomer);
      }
  }

  customerSelect.addEventListener('change', filterHewan);


  /* ============================
     SCRIPT LAYANAN
  ============================= */
  const tableBody = document.querySelector('#layananTable tbody');
  const addRowBtn = document.getElementById('addRow');
  const grandTotal = document.getElementById('grandTotal');

  function showToast(msg) {
    document.getElementById('toastErrorMessage').textContent = msg;
    new bootstrap.Toast(document.getElementById('toastError')).show();
  }

  function hitungSubtotal(row) {
    const select = row.querySelector('.layananSelect');
    const jumlah = row.querySelector('.jumlahInput');
    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);
    row.querySelector('.subtotalText').textContent = 'Rp ' + (harga * qty).toLocaleString('id-ID');
    hitungTotalKeseluruhan();
  }

  function hitungTotalKeseluruhan() {
    let total = 0;
    document.querySelectorAll('.subtotalText').forEach(el => {
      total += parseInt(el.textContent.replace(/[^\d]/g, '') || 0);
    });
    grandTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  function isDuplicate(select) {
    let count = 0;
    document.querySelectorAll('.layananSelect').forEach(s => {
      if (s.value === select.value) count++;
    });
    return count > 1;
  }

  addRowBtn.addEventListener('click', () => {
    const newRow = tableBody.querySelector('tr').cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    newRow.querySelector('.subtotalText').textContent = 'Rp 0';
    tableBody.appendChild(newRow);
  });

  tableBody.addEventListener('click', e => {
    if (e.target.closest('.resetRow')) {
      const row = e.target.closest('tr');
      row.querySelectorAll('select, input').forEach(el => el.value = '');
      row.querySelector('.subtotalText').textContent = 'Rp 0';
      hitungTotalKeseluruhan();
    }
  });

  tableBody.addEventListener('click', e => {
    if (e.target.closest('.removeRow')) {
      if (tableBody.rows.length === 1) {
        showToast("❌ Minimal harus ada satu layanan!");
        return;
      }
      e.target.closest('tr').remove();
      hitungTotalKeseluruhan();
    }
  });

  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('layananSelect')) {
      if (isDuplicate(e.target)) {
        showToast("❌ Layanan tidak boleh duplikat!");
        e.target.value = "";
        hitungSubtotal(e.target.closest('tr'));
        return;
      }
      hitungSubtotal(e.target.closest('tr'));
    }
  });

  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });

});
</script>

@endsection
