<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'name' => 'Lab Patologi',
            ],
            [
                'name' => 'Lab Mikrobiologi',
            ],
            [
                'name' => 'Lab Biomokuler',
            ],
            [
                'name' => 'Lab Parasitologi',
            ],
            [
                'name' => 'Lab Darah',
            ],
            [
                'name' => 'Ruang UGD',
            ],
            [
                'name' => 'Kamar Operasi',
            ],
            [
                'name' => 'Kamar Perawatan',
            ],
            [
                'name' => 'Klinik Rawat Jalan',
            ],
            [
                'name' => 'Poli Bedah',
            ],
            [
                'name' => 'Poli Anak',
            ],
            [
                'name' => 'Poli Kandungan',
            ],
            [
                'name' => 'Poli THT',
            ],
            [
                'name' => 'Poli Kulit',
            ],
            [
                'name' => 'Poli Gigi',
            ],
            [
                'name' => 'Poli Umum',
            ]
        ]);
    }
}
