<?php
namespace Database\Seeders;

use App\Modules\Menu\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = Menu::create([
            'menu'      => 'Main Menu',
            'module'    => 'no',
            'routing'   => 'no',
            'is_tampil' => 1,
            'icon'      => 'fa fa-folder',
            'urutan'    => 1,
            'parent_id' => '-',
            'level'     => 0,
        ]);
        $ref = Menu::create([
            'menu'      => 'Referensi',
            'module'    => 'no',
            'routing'   => 'no',
            'is_tampil' => 1,
            'icon'      => 'fa fa-folder',
            'urutan'    => 9,
            'parent_id' => '-',
            'level'     => 0,
        ]);
        $man = Menu::create([
            'menu'      => 'Management Menu',
            'module'    => 'no',
            'routing'   => 'no',
            'is_tampil' => 1,
            'icon'      => 'fa fa-folder',
            'urutan'    => 2,
            'parent_id' => '-',
            'level'     => 0,
        ]);
        $dev = Menu::create([
            'menu'      => 'Advance Menu',
            'module'    => 'no',
            'routing'   => 'no',
            'is_tampil' => 1,
            'icon'      => 'fa fa-folder',
            'urutan'    => 3,
            'parent_id' => '-',
            'level'     => 0,
        ]);
        Menu::create([
            'menu'      => 'Dashboard',
            'module'    => 'dashboard',
            'routing'   => 'dashboard',
            'is_tampil' => 1,
            'icon'      => 'fa fa-tachometer-alt',
            'urutan'    => 1,
            'parent_id' => $main->id,
            'level'     => 1,
        ]);
        $nasabah = Menu::create([
            'menu'      => 'Nasabah',
            'module'    => 'nasabah',
            'routing'   => 'nasabah.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-users',
            'urutan'    => 2,
            'parent_id' => $main->id,
            'level'     => 1,
        ]);
        Menu::create([
            'menu'      => 'Daftar Nasabah',
            'module'    => 'nasabah',
            'routing'   => 'nasabah.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-users',
            'urutan'    => 2,
            'parent_id' => $nasabah->id,
            'level'     => 2,
        ]);
        
        Menu::create([
            'menu'      => 'User',
            'module'    => 'users',
            'routing'   => 'users.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-user',
            'urutan'    => 3,
            'parent_id' => $man->id,
            'level'     => 1,
        ]);

        // dev
        Menu::create([
            'menu'      => 'Role',
            'module'    => 'role',
            'routing'   => 'role.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-user-tag',
            'urutan'    => 1,
            'parent_id' => $dev->id,
            'level'     => 1,
        ]);
        Menu::create([
            'menu'      => 'Menu',
            'module'    => 'menu',
            'routing'   => 'menu.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-list',
            'urutan'    => 2,
            'parent_id' => $dev->id,
            'level'     => 1,
        ]);
        Menu::create([
            'menu'      => 'Privilege',
            'module'    => 'privilege',
            'routing'   => 'privilege.index',
            'is_tampil' => 0,
            'icon'      => 'fa fa-user-cog',
            'urutan'    => 3,
            'parent_id' => $dev->id,
            'level'     => 1,
        ]);
        // Menu::create([
        //     'menu'      => 'Storage',
        //     'module'    => 'files',
        //     'routing'   => 'files.index',
        //     'is_tampil' => 1,
        //     'icon'      => 'fa fa-box-open',
        //     'urutan'    => 4,
        //     'parent_id' => $dev->id,
        //     'level'     => 1,
        // ]);
        Menu::create([
            'menu'      => 'Jenis File',
            'module'    => 'jenisfile',
            'routing'   => 'jenisfile.index',
            'is_tampil' => 0,
            'icon'      => 'fa fa-boxes',
            'urutan'    => 5,
            'parent_id' => $dev->id,
            'level'     => 1,
        ]);
        Menu::create([
            'menu'      => 'Log',
            'module'    => 'log',
            'routing'   => 'log.index',
            'is_tampil' => 1,
            'icon'      => 'fa fa-wave-square',
            'urutan'    => 6,
            'parent_id' => $dev->id,
            'level'     => 1,
        ]);

        // Menu::create([
        //     'menu' => 'Backup & Restore',
        //     'module' => 'backup',
        //     'routing' => 'backup.index',
        //     'is_tampil' => 1,
        //     'icon' => 'fa fa-archive',
        //     'urutan' => 2,
        //     'parent_id' => $man->id,
        //     'level' => 1
        // ]);
    }
}
