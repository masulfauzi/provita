<?php

namespace Database\Seeders;

use App\Modules\JenisKelamin\Models\JenisKelamin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKelamin::create([
            'jenis_kelamin' => 'Laki-Laki',
            'kode_jk' => 'L'
        ]);
        JenisKelamin::create([
            'jenis_kelamin' => 'Perempuan',
            'kode_jk' => 'P'
        ]);
    }
}
