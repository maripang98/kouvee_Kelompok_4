<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan Bulanan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background-color: #eee;
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

{{-- ================= HEADER ================= --}}
<div style="text-align:center; margin-bottom:15px;">
    <img src="{{ public_path('image/logo.png') }}" style="width:150px;">
    <h2 style="margin:0;">KOUVEE PET SHOP</h2>
    <p style="margin:0;">Jl. Moses Gatotkaca No. 22 Yogyakarta</p>
    <hr style="margin-top:10px; border-top:2px solid #000;">
    <h3 style="margin-top:10px;">
        LAPORAN PENDAPATAN BULANAN
    </h3>
    <p>
        Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
        Tahun {{ $tahun }}
    </p>
</div>

{{-- ================= JASA LAYANAN ================= --}}
<h4>Jasa Layanan</h4>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama Jasa Layanan</th>
            <th width="25%">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jasa as $row)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $row->NAMA_LAYANAN }}</td>
            <td class="text-right">
                Rp {{ number_format($row->total, 0, ',', '.') }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">
                Tidak ada transaksi jasa
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<p class="fw-bold text-right">
    Total Jasa : Rp {{ number_format($total_jasa, 0, ',', '.') }}
</p>

<br>

{{-- ================= PRODUK ================= --}}
<h4>Produk</h4>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama Produk</th>
            <th width="25%">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produk as $row)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $row->NAMA_PRODUK }}</td>
            <td class="text-right">
                Rp {{ number_format($row->total, 0, ',', '.') }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">
                Tidak ada transaksi produk
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<p class="fw-bold text-right">
    Total Produk : Rp {{ number_format($total_produk, 0, ',', '.') }}
</p>

<br>

{{-- ================= GRAND TOTAL ================= --}}
<p class="fw-bold text-right" style="font-size:14px;">
    GRAND TOTAL :
    Rp {{ number_format($total_jasa + $total_produk, 0, ',', '.') }}
</p>

</body>
</html>
