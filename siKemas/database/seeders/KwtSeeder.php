<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kwt;

class KwtSeeder extends Seeder
{
    public function run(): void
    {
        $kwts = [
            [
                'nama_kwt'   => 'KWT Melati',
                'no_kwt'     => '001',
                'alamat_kwt' => 'Jl. Melati No. 1',
                'desa'       => 'Desa Sukamaju',
            ],
            [
                'nama_kwt'   => 'KWT Mawar',
                'no_kwt'     => '002',
                'alamat_kwt' => 'Jl. Mawar No. 2',
                'desa'       => 'Desa Sukamaju',
            ],
            [
                'nama_kwt'   => 'KWT Anggrek',
                'no_kwt'     => '003',
                'alamat_kwt' => 'Jl. Anggrek No. 3',
                'desa'       => 'Desa Sukamaju',
            ],
            [
                'nama_kwt'   => 'KWT Kenanga',
                'no_kwt'     => '004',
                'alamat_kwt' => 'Jl. Kenanga No. 4',
                'desa'       => 'Desa Sukamaju',
            ],
            [
                'nama_kwt'   => 'KWT Dahlia',
                'no_kwt'     => '005',
                'alamat_kwt' => 'Jl. Dahlia No. 5',
                'desa'       => 'Desa Sukamaju',
            ],
        ];

        foreach ($kwts as $kwt) {
            Kwt::create($kwt);
        }
    }
}