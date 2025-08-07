<?php

namespace App\Http\Controllers;

use App\Models\M_peminjaman;
use App\Models\M_buku_tamu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class C_laporan extends Controller
{
    public function index(Request $request)
    {
        $query = M_peminjaman::with(['buku', 'siswa', 'pengembalian']);

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pinjam', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pinjam', $request->bulan);
        }

        $peminjaman = $query->get();

        return view('admin.v_laporan', compact('peminjaman'));
    }

    public function index_tamu()
    {
        $bukuTamu = M_buku_tamu::orderBy('tanggal_kunjungan', 'desc')->get();
        return view('admin.v_laporan_tamu', ['tamu' => $bukuTamu]); // ubah disini
    }

   public function cetak(Request $request)
{
    $query = M_peminjaman::with(['buku', 'siswa', 'pengembalian']);

    // Filter tahun
    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_pinjam', $request->tahun);
    }

    // Filter bulan
    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal_pinjam', $request->bulan);
    }

    // Filter berdasarkan tipe: peminjaman, pengembalian, semua
    if ($request->filled('tipe')) {
        if ($request->tipe == 'peminjaman') {
            $query->whereDoesntHave('pengembalian'); // Belum dikembalikan
        } elseif ($request->tipe == 'pengembalian') {
            $query->whereHas('pengembalian'); // Sudah dikembalikan
        }
        // Jika 'semua' atau selain itu, tidak difilter
    }

    $peminjaman = $query->get();
    $tipe = $request->tipe ?? 'semua'; // Kirim juga ke view jika ingin tampilkan jenis laporan

    $pdf = Pdf::loadView('v_cetak_laporan', compact('peminjaman', 'tipe'));
    return $pdf->stream("laporan-transaksi-{$tipe}.pdf");
}

    public function cetak_tamu(Request $request)
    {
        $query = M_buku_tamu::query();

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_kunjungan', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan);
        }

        $bukuTamu = $query->orderBy('tanggal_kunjungan', 'desc')->get();

        $pdf = Pdf::loadView('v_cetak_laporan_tamu', compact('bukuTamu'));
        return $pdf->stream('laporan-buku-tamu.pdf');
    }
}
