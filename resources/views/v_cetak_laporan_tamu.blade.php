<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Buku Tamu</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        h1,
        h3 {
            margin: 4px 0;
        }

        .info {
            text-align: center;
            margin-top: 10px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }

        thead {
            background-color: #2c3e50;
            color: #ffffff;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        td {
            text-align: left;
        }

        th:nth-child(1),
        td:nth-child(1) {
            text-align: center;
            width: 30px;
        }

        th:nth-child(4),
        td:nth-child(4) {
            text-align: center;
            width: 120px;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
            font-size: 11px;
        }

        .footer .left {
            float: left;
            width: 50%;
        }

        .footer .right {
            float: right;
            width: 40%;
            text-align: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('dist/assets/template_admin/demo1/dist/assets/media/SD.png') }}" alt="Logo Sekolah"
            class="logo" />
        <h1>SD Negeri Pangkung Tibah</h1>
        <h3>Laporan Buku Tamu</h3>
        <div class="info">
            Tahun: {{ request('tahun') ?? 'Semua' }} |
            Bulan:
            {{ request('bulan') ? \Carbon\Carbon::create()->month(request('bulan'))->translatedFormat('F') : 'Semua' }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tamu</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bukuTamu as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_pengunjung }}</td>
                    <td>{{ $item->instansi }}</td>
                    <td>{{ $item->keperluan }}</td>
                    <td style="text-align: center;">
                        {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d F Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer clearfix">
        <div class="left">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </div>
        <div class="right">
            <p>Pangkung Tibah, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p><u><b>Ni Made Dwijayanti, S.Pd.SD</b></u><br>NIP. 198909192015032003</p>
        </div>
    </div>

</body>

</html>
