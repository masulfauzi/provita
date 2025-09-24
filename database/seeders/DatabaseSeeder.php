<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PrivilegeTableSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call(NasabahSeeder::class);
        $this->call(JenisRekeningSeeder::class);
        $this->call(RekeningSeeder::class);
        
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
