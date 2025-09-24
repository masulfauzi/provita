<?php

namespace Database\Seeders;

use App\Modules\JenisRekening\Models\JenisRekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisRekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisRekening::create([
            'jenis_rekening' => 'Reguler',
            'kode_jenis_rekening' => 'R'
        ]);
    }
}
