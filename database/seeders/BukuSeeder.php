<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'kode_buku'     => 'KODE001',
                'judul'         => 'Laskar Pelangi',
                'penulis'       => 'Andrea Hirata',
                'penerbit'      => 'Bentang Pustaka',
                'tahun_terbit'  => 2005,
                'kategori'      => 'cerita',
                'lokasi_rak'    => '1',
                'gambar'        => 'laskar_pelangi.jpg',
                'status'        => 'tersedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kode_buku'     => 'KODE002',
                'judul'         => 'Negeri 5 Menara',
                'penulis'       => 'Ahmad Fuadi',
                'penerbit'      => 'Gramedia Pustaka Utama',
                'tahun_terbit'  => 2009,
                'kategori'      => 'cerita',
                'lokasi_rak'    => '2',
                'gambar'        => 'negeri_5_menara.jpg',
                'status'        => 'tersedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kode_buku'     => 'KODE003',
                'judul'         => 'Bumi',
                'penulis'       => 'Tere Liye',
                'penerbit'      => 'Gramedia',
                'tahun_terbit'  => 2014,
                'kategori'      => 'pengetahuan',
                'lokasi_rak'    => '3',
                'gambar'        => 'bumi.jpg',
                'status'        => 'tersedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kode_buku'     => 'KODE004',
                'judul'         => 'Ayat-Ayat Cinta',
                'penulis'       => 'Habiburrahman El Shirazy',
                'penerbit'      => 'Republika',
                'tahun_terbit'  => 2004,
                'kategori'      => 'cerita',
                'lokasi_rak'    => '4',
                'gambar'        => 'ayat_ayat_cinta.jpg',
                'status'        => 'tersedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kode_buku'     => 'KODE005',
                'judul'         => 'Dilan 1990',
                'penulis'       => 'Pidi Baiq',
                'penerbit'      => 'Pastel Books',
                'tahun_terbit'  => 2014,
                'kategori'      => 'cerita',
                'lokasi_rak'    => '5',
                'gambar'        => 'dilan_1990.jpg',
                'status'        => 'tersedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}