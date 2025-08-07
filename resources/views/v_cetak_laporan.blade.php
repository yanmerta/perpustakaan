<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
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
        th:nth-child(5),
        th:nth-child(6),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6) {
            text-align: center;
            width: 90px;
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
            class="logo">
        <h1>SD Negeri Pangkung Tibah</h1>
        <h3>
            Laporan
            @if (isset($tipe))
                @if ($tipe === 'peminjaman')
                    Peminjaman
                @elseif($tipe === 'pengembalian')
                    Pengembalian
                @else
                    Peminjaman & Pengembalian
                @endif
            @else
                Peminjaman & Pengembalian
            @endif
        </h3>
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
                <th>Nama Siswa</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status Pinjam</th>
                <th>Status Kembali</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $pinjam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pinjam->siswa->pluck('name')->implode(', ') }}</td>
                    <td>{{ $pinjam->buku->kode_buku ?? '-' }}</td>
                    <td>{{ $pinjam->buku->judul ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                    <td>
                        @if ($pinjam->pengembalian && $pinjam->pengembalian->tanggal_kembali)
                            {{ \Carbon\Carbon::parse($pinjam->pengembalian->tanggal_kembali)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: center;">{{ ucfirst($pinjam->status ?? '-') }}</td>
                    <td style="text-align: center;">{{ ucfirst($pinjam->pengembalian->status_pengembalian ?? '-') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data tersedia.</td>
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
