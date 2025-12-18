@extends('layout.cs')

@section('title', 'Edit Transaksi Layanan')

@section('content')
<div class="container py-5">

  <h2 class="fw-bold mb-4 text-center">✏️ Edit Transaksi Layanan</h2>

  <div class="card shadow-sm border-0">
    <div class="card-body">

      <form action="{{ route('cs.transaksi_layanan.update', $transaksi->ID_TRANSAKSI_LAYANAN) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ========================= -->
        <!-- CUSTOMER -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <select name="ID_CUSTOMER" id="customerSelect" class="form-select" required>
            <option value="">-- Pilih Customer --</option>

            @foreach ($customers as $c)
              <option value="{{ $c->ID_CUSTOMER }}"
                {{ $transaksi->ID_CUSTOMER == $c->ID_CUSTOMER ? 'selected' : '' }}>
                {{ $c->NAMA_CUSTOMER }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- ========================= -->
        <!-- HEWAN -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Hewan</label>
          <select name="ID_HEWAN" id="hewanSelect" class="form-select" required>
            <option value="">-- Pilih Hewan --</option>

            @foreach ($hewan as $h)
              <option value="{{ $h->ID_HEWAN }}"
                data-owner="{{ $h->ID_CUSTOMER }}"
                {{ $transaksi->ID_HEWAN == $h->ID_HEWAN ? 'selected' : '' }}>
                {{ $h->NAMA_HEWAN }} - {{ $h->JENIS_HEWAN }}
              </option>
            @endforeach
          </select>
        </div>

        <hr>

        <!-- ========================= -->
        <!-- DETAIL LAYANAN -->
        <!-- ========================= -->
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
                      <option value="{{ $l->ID_LAYANAN }}"
                        data-harga="{{ $l->HARGA_LAYANAN }}"
                        {{ $detail->ID_LAYANAN == $l->ID_LAYANAN ? 'selected' : '' }}>
                        {{ $l->NAMA_LAYANAN }} (Rp {{ number_format($l->HARGA_LAYANAN, 0, ',', '.') }})
                      </option>
                    @endforeach
                  </select>
                </td>

                <td>
                  <input 
                    type="number" 
                    name="jumlah[]" 
                    value="{{ $detail->JUMLAH_ORDER_LAYANAN }}" 
                    class="form-control jumlahInput" 
                    min="1" required>
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

        <hr>

        <!-- ========================= -->
        <!-- STATUS LAYANAN -->
        <!-- ========================= -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Status Layanan</label>
          <select name="status_layanan" class="form-select" required>

            <option value="Belum Dikerjakan" 
              {{ trim($transaksi->STATUS_LAYANAN) == 'Belum Dikerjakan' ? 'selected' : '' }}>
              Belum Dikerjakan
            </option>

            <option value="Dalam Pengerjaan"
              {{ trim($transaksi->STATUS_LAYANAN) == 'Dalam Pengerjaan' ? 'selected' : '' }}>
              Dalam Pengerjaan
            </option>

            <option value="Selesai"
              {{ trim($transaksi->STATUS_LAYANAN) == 'Selesai' ? 'selected' : '' }}>
              Selesai
            </option>

          </select>
        </div>

        <hr>

        <!-- ========================= -->
        <!-- TOTAL -->
        <!-- ========================= -->
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

<!-- TOAST ERROR -->
<div class="position-fixed top-0 end-0 p-3" style="z-index:99999">
  <div id="toastError" class="toast text-bg-danger border-0">
    <div class="d-flex">
      <div class="toast-body fw-semibold" id="toastErrorMessage"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  const tableBody = document.querySelector("#layananTable tbody");
  const addRowBtn = document.getElementById("addRow");
  const grandTotal = document.getElementById("grandTotal");

  const customerSelect = document.getElementById("customerSelect");
  const hewanSelect = document.getElementById("hewanSelect");


  /* ==================================================== */
  /* FILTER HEWAN BERDASARKAN CUSTOMER                    */
  /* ==================================================== */
  function filterHewan() {
    const ownerId = customerSelect.value;

    Array.from(hewanSelect.options).forEach(option => {
      if (!option.value) return;
      option.hidden = option.dataset.owner !== ownerId;
    });
  }

  filterHewan();
  customerSelect.addEventListener('change', filterHewan);


  /* ==================================================== */
  /* HITUNG SUBTOTAL & TOTAL                              */
  /* ==================================================== */
  function hitungSubtotal(row) {
    const select = row.querySelector(".layananSelect");
    const jumlah = row.querySelector(".jumlahInput");
    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);
    row.querySelector(".subtotalText").textContent =
      "Rp " + (harga * qty).toLocaleString("id-ID");
    hitungTotal();
  }

  function hitungTotal() {
    let total = 0;
    document.querySelectorAll(".subtotalText").forEach(el => {
      total += parseInt(el.textContent.replace(/[^\d]/g, "") || 0);
    });
    grandTotal.textContent = "Rp " + total.toLocaleString("id-ID");
  }

  function showToast(msg) {
    document.getElementById("toastErrorMessage").textContent = msg;
    new bootstrap.Toast(document.getElementById("toastError")).show();
  }

  function isDuplicate(selectEl) {
    const val = selectEl.value;
    if (!val) return false;

    let count = 0;
    document.querySelectorAll(".layananSelect").forEach(s => {
      if (s.value === val) count++;
    });

    return count > 1;
  }


  /* ==================================================== */
  /* EVENT HANDLER TABLE                                  */
  /* ==================================================== */
  addRowBtn.addEventListener("click", () => {
    const newRow = tableBody.querySelector("tr").cloneNode(true);

    newRow.querySelectorAll("select, input").forEach(el => el.value = "");
    newRow.querySelector(".subtotalText").textContent = "Rp 0";

    tableBody.appendChild(newRow);
  });

  tableBody.addEventListener("click", (e) => {
    if (e.target.closest(".resetRow")) {
      const row = e.target.closest("tr");
      row.querySelectorAll("select, input").forEach(el => el.value = "");
      row.querySelector(".subtotalText").textContent = "Rp 0";
      hitungTotal();
    }

    if (e.target.closest(".removeRow")) {
      if (tableBody.rows.length <= 1) {
        showToast("❌ Minimal harus ada 1 layanan!");
        return;
      }
      e.target.closest("tr").remove();
      hitungTotal();
    }
  });

  tableBody.addEventListener("change", (e) => {
    if (e.target.classList.contains("layananSelect")) {
      if (isDuplicate(e.target)) {
        showToast("❌ Layanan tidak boleh duplikat!");
        e.target.value = "";
        hitungSubtotal(e.target.closest("tr"));
        return;
      }
      hitungSubtotal(e.target.closest("tr"));
    }
  });

  tableBody.addEventListener("input", (e) => {
    if (e.target.classList.contains("jumlahInput")) {
      hitungSubtotal(e.target.closest("tr"));
    }
  });

  hitungTotal();
});
</script>

@endsection
