@extends('layout.cs')

@section('title', 'Edit Transaksi Produk')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">✏️ Edit Transaksi Produk</h2>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form action="{{ route('cs.transaksi_produk.update', $transaksi->ID_TRANSAKSI_PENJUALAN_PRODUK) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- CUSTOMER -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <select name="id_customer" class="form-select" required>
            @foreach ($customers as $c)
              <option value="{{ $c->ID_CUSTOMER }}"
                {{ $transaksi->ID_CUSTOMER == $c->ID_CUSTOMER ? 'selected' : '' }}>
                {{ $c->NAMA_CUSTOMER }} — {{ $c->NOMOR_TELEPON_CUSTOMER }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- PRODUK -->
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="produkTable">
            <thead class="table-light text-center">
              <tr>
                <th>Produk</th>
                <th width="120">Jumlah</th>
                <th width="150">Subtotal</th>
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
                      <option value="{{ $p->ID_PRODUK }}"
                        data-harga="{{ $p->HARGA_PRODUK }}"
                        data-stok="{{ $p->STOK_PRODUK }}"
                        {{ $detail->produk->ID_PRODUK == $p->ID_PRODUK ? 'selected' : '' }}>
                        {{ $p->NAMA_PRODUK }}
                        (Rp {{ number_format($p->HARGA_PRODUK, 0, ',', '.') }}) —
                        Stok: {{ $p->STOK_PRODUK }}
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
                  <button type="button" class="btn btn-outline-secondary btn-sm resetRow">Reset</button>
                  <button type="button" class="btn btn-outline-danger btn-sm removeRow">Hapus</button>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>

        <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm mt-2">
          ➕ Tambah Produk
        </button>

        <hr>

        <!-- TOTAL -->
        <div class="text-end">
          <h4 id="grandTotal" class="fw-bold text-success">
            Rp {{ number_format($transaksi->TOTAL_HARGA_PENJUALAN_PRODUK, 0, ',', '.') }}
          </h4>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('cs.transaksi_produk.index') }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {

  const tableBody = document.querySelector('#produkTable tbody');
  const addRowBtn = document.getElementById('addRow');
  const grandTotal = document.getElementById('grandTotal');

  function hitungSubtotal(row) {
    const select = row.querySelector('.produkSelect');
    const jumlah = row.querySelector('.jumlahInput');

    const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
    const qty = parseInt(jumlah.value || 0);
    const subtotal = harga * qty;

    row.querySelector('.subtotalText').textContent = 
      "Rp " + subtotal.toLocaleString("id-ID");

    hitungTotal();
  }

  function hitungTotal() {
    let total = 0;
    document.querySelectorAll('.subtotalText').forEach(el => {
      total += parseInt(el.textContent.replace(/[^\d]/g, '') || 0);
    });
    grandTotal.textContent = "Rp " + total.toLocaleString("id-ID");
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
      if (tableBody.rows.length == 1) {
        alert("Minimal 1 produk!");
        return;
      }
      e.target.closest('tr').remove();
      hitungTotal();
    }
  });

  tableBody.addEventListener('input', e => {
    if (e.target.classList.contains('jumlahInput')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });

  tableBody.addEventListener('change', e => {
    if (e.target.classList.contains('produkSelect')) {
      hitungSubtotal(e.target.closest('tr'));
    }
  });

});
</script>

@endsection
