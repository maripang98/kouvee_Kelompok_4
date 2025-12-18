<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan Tahunan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
        }

        th, td {
            border:1px solid #333;
            padding:8px;
            text-align:center;
        }

        th {
            background:#eee;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

{{-- ================= HEADER ================= --}}
<div style="text-align:center; margin-bottom:20px;">
    <img src="{{ public_path('image/logo.png') }}" style="width:180px;">
    <h2 style="margin:5px 0;">KOUVEE PET SHOP</h2>
    <p style="margin:0; font-size:13px;">
        Jl. Moses Gatotkaca No. 22 Yogyakarta
    </p>
    <hr style="margin:15px 0; border-top:2px solid #000;">
    <h3 style="margin:0;">
        LAPORAN PENDAPATAN TAHUN {{ $tahun }}
    </h3>
</div>

{{-- ================= TABEL ================= --}}
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Bulan</th>
            <th>Jasa Layanan</th>
            <th>Produk</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}
            </td>
            <td class="text-right">
                Rp {{ number_format($row['jasa_layanan'],0,',','.') }}
            </td>
            <td class="text-right">
                Rp {{ number_format($row['produk'],0,',','.') }}
            </td>
            <td class="text-right">
                <strong>
                    Rp {{ number_format($row['total'],0,',','.') }}
                </strong>
            </td>
        </tr>
        @endforeach
    </tbody>

    {{-- ================= TOTAL ================= --}}
    <tfoot>
        <tr>
            <th colspan="2">TOTAL</th>
            <th class="text-right">
                Rp {{ number_format($laporan->sum('jasa_layanan'),0,',','.') }}
            </th>
            <th class="text-right">
                Rp {{ number_format($laporan->sum('produk'),0,',','.') }}
            </th>
            <th class="text-right">
                Rp {{ number_format($laporan->sum('total'),0,',','.') }}
            </th>
        </tr>
    </tfoot>
</table>

</body>
</html>
