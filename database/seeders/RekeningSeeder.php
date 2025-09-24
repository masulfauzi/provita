<?php

namespace Database\Seeders;

use App\Modules\JenisRekening\Models\JenisRekening;
use App\Modules\Nasabah\Models\Nasabah;
use App\Modules\Rekening\Models\Rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nasabah = Nasabah::all();
        $jenis_rekening = JenisRekening::first();

        foreach ($nasabah as $row) {
            Rekening::create([
                'no_rekening' => fake()->randomNumber(9),
                'id_nasabah' => $row->id,
                'id_jenis_rekening' => $jenis_rekening->id,
            ]);
        }
    }
}
