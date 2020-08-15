<?php

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
            'tambah periode', 'hapus periode', 'cetak periode', 'catatan penilaian',
            'verif wadir', 'verif kabag',
            'master aspek', 'master user', 'master group',
            'grafik pegawai', 'penilaian aik', 'catatan penilain', 'master komite',
            'tambah penilaian komite', 'master bagian', 'verif direktur', 'penilaian biasa dan aik'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
