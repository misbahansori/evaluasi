<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'tambah pegawai', 'edit pegawai',
            'tambah periode', 'hapus periode', 'cetak periode', 
            'verif wadir', 'verif kabag',
            'master aspek', 'master user', 'master group',
            'grafik pegawai'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
