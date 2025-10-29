<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove existing rows to make the seeder idempotent for development
        DB::table('akun')->delete();

        $now = Carbon::now();

        $rows = [
            ['id' => (string) Str::uuid(), 'no_akun' => '1001', 'nama_akun' => 'Kas', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '1002', 'nama_akun' => 'Piutang', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '1003', 'nama_akun' => 'Piutang Karyawan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '1004', 'nama_akun' => 'Barang Cetakan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '2001', 'nama_akun' => 'Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '2002', 'nama_akun' => 'Laba Belum Dibagi', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '2003', 'nama_akun' => 'Modal', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '3001', 'nama_akun' => 'Laba Di Tahan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '5001', 'nama_akun' => 'Penghasilan Jasa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '5002', 'nama_akun' => 'Penghasilan Administrasi Pinjaman', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '5003', 'nama_akun' => 'Penghasilan Administrasi Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '5004', 'nama_akun' => 'Penjualan Buku Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '5005', 'nama_akun' => 'Pendapatan Bunga Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '6001', 'nama_akun' => 'Beban Bunga Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '6002', 'nama_akun' => 'Beban Foto Kopi Buku Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '6003', 'nama_akun' => 'Beban Foto Kopi Slip Tabungan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '6004', 'nama_akun' => 'Beban Konsumsi', 'created_at' => $now, 'updated_at' => $now],
            ['id' => (string) Str::uuid(), 'no_akun' => '6005', 'nama_akun' => 'Beban Lain-Lain', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('akun')->insert($rows);
    }
}
