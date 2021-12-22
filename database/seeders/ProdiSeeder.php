<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listProdi = [
            [
                'nama' => 'Teknik Informatika'
            ],
            [
                'nama' => 'Akuntansi'
            ],
            [
                'nama' => 'Teknik Pendingin'
            ],
        ];

        Prodi::insert($listProdi);
    }
}
