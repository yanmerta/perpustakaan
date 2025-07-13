@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if(auth()->user()->role == 'admin')
                        <button class="btn btn-outline-dark" onclick="openForm()">Tambah Buku</button>
                    @endif
                    @if(auth()->user()->role == 'siswa')
                        <h4 class="mb-3">Data Buku</h4>
                    @endif
                    <div class="d-flex align-items-center gap-2">
                        <label for="filterKategori" class="me-2 mb-0">Filter Kategori</label>
                        <select id="filterKategori" class="form-select form-select-sm" style="width: 200px;">
                            <option value="">Semua Kategori</option>
                            @php
                                $kategoriList = $buku->pluck('kategori')->unique();
                            @endphp
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori }}">{{ $kategori }}</option>
                            @endforeach
                        </select>
                        
                        <label for="customSearch" class="mb-0 ms-3">Cari:</label>
                        <input type="text" id="customSearch" class="form-control form-control-sm" placeholder="Cari buku..." style="width: 200px;">

                    </div>
                </div>

                {{-- Tombol Tambah Buku --}}
                <div class="card-body">
                    {{-- Tabel Buku --}}
                    <table id="tabelBuku" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Rak</th>
                                <th>Status</th>
                                @if(auth()->user()->role == 'admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->judul }}</td>
                                <td>{{ $b->penulis }}</td>
                                <td>
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/buku/' . $b->gambar) }}" alt="Gambar Buku" width="120">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $b->kategori }}</td>
                                <td>{{ $b->lokasi_rak }}</td>
                                <td>{{ $b->status }}</td>
                                @if(auth()->user()->role == 'admin')
                                <td>
                                    <button class="btn btn-sm btn-warning"
                                        onclick="editBuku({{ json_encode($b) }})">Edit</button>
                                    <form method="POST" action="{{ route('buku.destroy', $b->id_buku) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Modal Form Tambah/Edit Buku --}}
            <div class="modal fade" id="bukuModal" tabindex="-1" aria-labelledby="bukuModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="bukuForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" id="formMethod" value="POST">
                            <input type="hidden" name="id_buku" id="id_buku">

                            <div class="modal-header">
                                <h5 class="modal-title" id="bukuModalLabel">Form Buku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Penulis</label>
                                    <input type="text" name="penulis" id="penulis" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Penerbit</label>
                                    <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control"
                                        min="1900" max="{{ date('Y') }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control" required>
                                        <option value="cerita">Cerita</option>
                                        <option value="majalah">Majalah</option>
                                        <option value="pengetahuan">Pengetahuan</option>
                                        <option value="pembelajaran">Pembelajaran</option>
                                        <option value="seni">Seni</option>
                                        <option value="hukum">Hukum</option>
                                        <option value="sains">Sains</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Lokasi Rak</label>
                                    <select name="lokasi_rak" id="lokasi_rak" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="rusak">Rusak</option>
                                        <option value="hilang">Hilang</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Gambar Buku</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk form --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#tabelBuku').DataTable({
            dom: 'lrtip'
        });

        $('#filterKategori').on('change', function () {
            var selectedKategori = $(this).val();
            table.column(4).search(selectedKategori).draw(); // kolom ke-5 (0-based index)
        });

        $('#customSearch').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>

<script>
    function openForm() {
        $('#bukuForm')[0].reset();
        $('#formMethod').val('POST');
        $('#bukuForm').attr('action', "{{ route('buku.store') }}");
        $('#id_buku').val('');
        $('#bukuModalLabel').text('Tambah Buku');
        var modal = new bootstrap.Modal(document.getElementById('bukuModal'));
        modal.show();
    }

    function editBuku(data) {
        $('#judul').val(data.judul);
        $('#penulis').val(data.penulis);
        $('#penerbit').val(data.penerbit);
        $('#tahun_terbit').val(data.tahun_terbit);
        $('#kategori').val(data.kategori);
        $('#lokasi_rak').val(data.lokasi_rak);
        $('#status').val(data.status);
        $('#gambar').val('');

        $('#formMethod').val('PUT');
        $('#bukuForm').attr('action', `/buku/${data.id_buku}`);
        $('#id_buku').val(data.id_buku);
        $('#bukuModalLabel').text('Edit Buku');

        var modal = new bootstrap.Modal(document.getElementById('bukuModal'));
        modal.show();
    }
</script>

@endsection
