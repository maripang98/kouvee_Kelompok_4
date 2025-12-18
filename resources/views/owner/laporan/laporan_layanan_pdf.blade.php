<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Layanan Terlaris</title>

    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        th, td { border:1px solid #333; padding:8px; text-align:center; }
        th { background:#eee; }
    </style>
</head>
<body>

<div style="text-align:center; margin-bottom:20px;">
    <img src="{{ public_path('image/logo.png') }}" style="width:200px;">
    <h2 style="margin:0; font-weight:bold;">KOUVEE PET SHOP</h2>
    <p style="margin:0; font-size:14px;">Jl. Moses Gatotkaca No. 22 Yogyakarta</p>
    <hr style="margin-top:15px; border-top:2px solid #000;">
    <h3 style="margin-top:10px;">LAPORAN LAYANAN TERLARIS TAHUN {{ $tahun }}</h3>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Layanan Terlaris</th>
            <th>Jumlah</th>
        </tr>
    </thead>

    <tbody>
        @foreach($laporan as $i => $row)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ \Carbon\Carbon::create()->month($row['bulan'])->translatedFormat('F') }}</td>
            <td>{{ $row['nama_layanan'] }}</td>
            <td>{{ $row['jumlah'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
