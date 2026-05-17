<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaletWarna;

class PaletWarnaSeeder extends Seeder
{
    public function run(): void
    {
        $palets = [
            [
                'nama_palet'     => 'Classic Black',
                'warna_utama'    => '#000000',
                'warna_sekunder' => '#333333',
                'warna_aksen'    => '#FFD700',
                'kode_hex'       => '#000000',
            ],
            [
                'nama_palet'     => 'Fresh Green',
                'warna_utama'    => '#2ECC71',
                'warna_sekunder' => '#27AE60',
                'warna_aksen'    => '#F1C40F',
                'kode_hex'       => '#2ECC71',
            ],
            [
                'nama_palet'     => 'Ocean Blue',
                'warna_utama'    => '#2980B9',
                'warna_sekunder' => '#3498DB',
                'warna_aksen'    => '#ECF0F1',
                'kode_hex'       => '#2980B9',
            ],
            [
                'nama_palet'     => 'Warm Red',
                'warna_utama'    => '#E74C3C',
                'warna_sekunder' => '#C0392B',
                'warna_aksen'    => '#F39C12',
                'kode_hex'       => '#E74C3C',
            ],
            [
                'nama_palet'     => 'Purple Royal',
                'warna_utama'    => '#8E44AD',
                'warna_sekunder' => '#9B59B6',
                'warna_aksen'    => '#F1C40F',
                'kode_hex'       => '#8E44AD',
            ],
            [
                'nama_palet'     => 'Earth Tone',
                'warna_utama'    => '#795548',
                'warna_sekunder' => '#A1887F',
                'warna_aksen'    => '#D7CCC8',
                'kode_hex'       => '#795548',
            ],
        ];

        foreach ($palets as $palet) {
            PaletWarna::create($palet);
        }
    }
}