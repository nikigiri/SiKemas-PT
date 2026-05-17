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
                'ikon_kemasan'      => 'images/kemasan/box.png',
            ],
            [
                'nama_kemasan'      => 'Botol',
                'deskripsi_kemasan' => 'Kemasan berbentuk botol, cocok untuk produk cair',
                'ikon_kemasan'      => 'images/kemasan/botol.png',
            ],
            [
                'nama_kemasan'      => 'Paper Bag',
                'deskripsi_kemasan' => 'Kemasan tas kertas, cocok untuk produk fashion atau makanan',
                'ikon_kemasan'      => 'images/kemasan/paperbag.png',
            ],
            [
                'nama_kemasan'      => 'Sleeve',
                'deskripsi_kemasan' => 'Kemasan selongsong, cocok untuk minuman cup',
                'ikon_kemasan'      => 'images/kemasan/sleeve.png',
            ],
            [
                'nama_kemasan'      => 'Kaleng',
                'deskripsi_kemasan' => 'Kemasan kaleng, cocok untuk produk minuman atau makanan kaleng',
                'ikon_kemasan'      => 'images/kemasan/kaleng.png',
            ],
            [
                'nama_kemasan'      => 'Sachet',
                'deskripsi_kemasan' => 'Kemasan sachet, cocok untuk produk bubuk atau cairan kecil',
                'ikon_kemasan'      => 'images/kemasan/sachet.png',
            ],
        ];

        foreach ($kemasans as $kemasan) {
            JenisKemasan::create($kemasan);
        }
    }
}