<?php

namespace Database\Seeders;

use App\Modules\JenisKelamin\Models\JenisKelamin;
use App\Modules\Nasabah\Models\Nasabah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=20; $i++)
        {
            $jenis_kelamin = JenisKelamin::inRandomOrder()->first();
    
            Nasabah::create([
                'nama_nasabah' => fake()->name(),
                'no_hp' => fake()->phoneNumber(),
                'nik' => fake()->randomNumber(9) . fake()->randomNumber(7),
                'alamat' => fake()->address(),
                'email' => fake()->email(),
                'tgl_lahir' => fake()->date(),
                'id_jenis_kelamin' => $jenis_kelamin->id,
                'tgl_daftar' => fake()->date(),
            ]);
        }
    }
}
