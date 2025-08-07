@extends('layout.v_layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="mb-0">📋 Laporan Buku Tamu</h4>

                        <a href="{{ route('cetak.tamu', ['tahun' => request('tahun'), 'bulan' => request('bulan')]) }}"
                            target="_blank" class="btn btn-outline-success shadow-sm px-3 py-2">
                            <i class="bi bi-printer-fill"></i> Cetak PDF
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Filter --}}
                        <form method="GET" action="{{ route('laporan.tamu') }}" class="row g-2 mb-4">
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
                                <a href="{{ route('laporan.tamu') }}" class="btn btn-secondary">♻️ Reset</a>
                            </div>
                        </form>

                        {{-- Tabel Tamu --}}
                        <div class="table-responsive">
                            <table id="tamuTable" class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tamu</th>
                                        <th>Instansi</th>
                                        <th>Keperluan</th>
                                        <th>Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tamu as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_pengunjung }}</td>
                                            <td>{{ $item->instansi ?? '-' }}</td>
                                            <td>{{ $item->keperluan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d F Y') }}
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
            $('#tamuTable').DataTable({
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
