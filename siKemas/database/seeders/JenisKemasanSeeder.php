<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKemasan;

class JenisKemasanSeeder extends Seeder
{
    public function run(): void
    {
        $kemasans = [
            [
                'nama_kemasan'      => 'Box',
                'deskripsi_kemasan' => 'Kemasan berbentuk kotak, cocok untuk produk padat',
                'ikon_kemasan'      => 'images/box.png',
            ],
            [
                'nama_kemasan'      => 'Botol',
                'deskripsi_kemasan' => 'Kemasan berbentuk botol, cocok untuk produk cair',
                'ikon_kemasan'      => 'images/botol.png',
            ],
            [
                'nama_kemasan'      => 'Paper Bag',
                'deskripsi_kemasan' => 'Kemasan tas kertas, cocok untuk produk fashion atau makanan',
                'ikon_kemasan'      => 'images/paperbag.png',
            ],
            [
                'nama_kemasan'      => 'Sleeve',
                'deskripsi_kemasan' => 'Kemasan selongsong, cocok untuk minuman cup',
                'ikon_kemasan'      => 'images/sleeve.png',
            ],
            [
                'nama_kemasan'      => 'Kaleng',
                'deskripsi_kemasan' => 'Kemasan kaleng, cocok untuk produk minuman atau makanan kaleng',
                'ikon_kemasan'      => 'images/kaleng.png',
            ],
            [
                'nama_kemasan'      => 'Sachet',
                'deskripsi_kemasan' => 'Kemasan sachet, cocok untuk produk bubuk atau cairan kecil',
                'ikon_kemasan'      => 'images/sachet.png',
            ],
        ];

        foreach ($kemasans as $kemasan) {
            JenisKemasan::create($kemasan);
        }
    }
}