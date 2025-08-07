@extends('layout.v_layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="mb-0">📊 Laporan Transaksi Peminjaman & Pengembalian</h4>

                        <div class="btn-group">
                            <button class="btn btn-outline-success dropdown-toggle shadow-sm px-3 py-2" type="button"
                                id="dropdownCetak" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-printer-fill"></i> Cetak PDF
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownCetak">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('cetak.laporan', ['tipe' => 'peminjaman', 'tahun' => request('tahun'), 'bulan' => request('bulan')]) }}"
                                        target="_blank">📘 Cetak Peminjaman</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('cetak.laporan', ['tipe' => 'pengembalian', 'tahun' => request('tahun'), 'bulan' => request('bulan')]) }}"
                                        target="_blank">📗 Cetak Pengembalian</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('cetak.laporan', ['tipe' => 'semua', 'tahun' => request('tahun'), 'bulan' => request('bulan')]) }}"
                                        target="_blank">📚 Cetak Semua</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filter --}}
                        <form method="GET" action="{{ route('laporan.index') }}" class="row g-2 mb-4">
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach (range(date('Y'), 2020) as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach (range(1, 12) as $b)
                                        <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">🔍 Filter</button>
                                <a href="{{ route('laporan.index') }}" class="btn btn-secondary">♻️ Reset</a>
                            </div>
                        </form>

                        {{-- Tabel --}}
                        <div class="table-responsive">
                            <table id="laporanTable" class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status Peminjaman</th>
                                        <th>Status Pengembalian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $pinjam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pinjam->siswa->pluck('name')->implode(', ') }}</td>
                                            <td>{{ $pinjam->buku->kode_buku ?? '-' }}</td>
                                            <td>{{ $pinjam->buku->judul ?? '-' }}</td>
                                            <td>{{ $pinjam->tanggal_pinjam }}</td>
                                            <td>{{ $pinjam->tanggal_jatuh_tempo }}</td>
                                            <td>{{ $pinjam->pengembalian->tanggal_kembali ?? '-' }}</td>
                                            <td>{{ ucfirst($pinjam->status) ?? '-' }}</td>
                                            <td>
                                                @if ($pinjam->pengembalian)
                                                    {{ ucfirst($pinjam->pengembalian->status_pengembalian) ?? '-' }}
                                                @else
                                                    Belum Kembali
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    search: "🔎 Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(difilter dari _MAX_ total entri)"
                }
            });
        });
    </script>
@endsection
