<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUnit = [
            ['name' => 'Bagian Keuangan', 'guard_name' => 'web'],
            ['name' => 'Bagian Umum', 'guard_name' => 'web'],
            ['name' => 'Bindatra', 'guard_name' => 'web'],
            ['name' => 'BPJS', 'guard_name' => 'web'],
            ['name' => 'Instalasi Farmasi', 'guard_name' => 'web'],
            ['name' => 'Instalasi Fisioterapi', 'guard_name' => 'web'],
            ['name' => 'Instalasi Gizi', 'guard_name' => 'web'],
            ['name' => 'Instalasi Laboratorium', 'guard_name' => 'web'],
            ['name' => 'Instalasi Radiologi', 'guard_name' => 'web'],
            ['name' => 'Instalasi Rekam Medis', 'guard_name' => 'web'],
            ['name' => 'IPSRS', 'guard_name' => 'web'],
            ['name' => 'Kabid Keperawatan & Kebidanan', 'guard_name' => 'web'],
            ['name' => 'Komite PPNI', 'guard_name' => 'web'],
            ['name' => 'Ruang Arafah', 'guard_name' => 'web'],
            ['name' => 'Ruang Assalam', 'guard_name' => 'web'],
            ['name' => 'Ruang Assyifa/Perianatalogi', 'guard_name' => 'web'],
            ['name' => 'Ruang CSSD', 'guard_name' => 'web'],
            ['name' => 'Ruang Hasanah', 'guard_name' => 'web'],
            ['name' => 'Ruang ICU', 'guard_name' => 'web'],
            ['name' => 'Ruang Marwah', 'guard_name' => 'web'],
            ['name' => 'Ruang Mina', 'guard_name' => 'web'],
            ['name' => 'Ruang OK', 'guard_name' => 'web'],
            ['name' => 'Ruang Poliklinik', 'guard_name' => 'web'],
            ['name' => 'Ruang Shafa', 'guard_name' => 'web'],
            ['name' => 'Ruang UGD', 'guard_name' => 'web'],
            ['name' => 'Tata Usaha dan Personalia', 'guard_name' => 'web'],
            ['name' => 'Bindatra', 'guard_name' => 'web'],
            ['name' => 'Musdalifah', 'guard_name' => 'web'],
        ];

        DB::table('roles')->insert($listUnit);
    }
}
