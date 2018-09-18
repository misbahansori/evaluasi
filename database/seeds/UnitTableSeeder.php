<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUnit = [
            ['nama' => 'Bagian Keuangan'],
            ['nama' => 'Bagian Umum'],
            ['nama' => 'Bindatra'],
            ['nama' => 'BPJS'],
            ['nama' => 'Instalasi Farmasi'],
            ['nama' => 'Instalasi Fisioterapi'],
            ['nama' => 'Instalasi Gizi'],
            ['nama' => 'Instalasi Laboratorium'],
            ['nama' => 'Instalasi Radiologi'],
            ['nama' => 'Instalasi Rekam Medis'],
            ['nama' => 'IPSRS'],
            ['nama' => 'Kabid Keperawatan & Kebidanan'],
            ['nama' => 'Komite PPNI'],
            ['nama' => 'Ruang Arafah'],
            ['nama' => 'Ruang Assalam'],
            ['nama' => 'Ruang Assyifa/Perianatalogi'],
            ['nama' => 'Ruang CSSD'],
            ['nama' => 'Ruang Hasanah'],
            ['nama' => 'Ruang ICU'],
            ['nama' => 'Ruang Marwah'],
            ['nama' => 'Ruang Mina'],
            ['nama' => 'Ruang OK'],
            ['nama' => 'Ruang Poliklinik'],
            ['nama' => 'Ruang Shafa'],
            ['nama' => 'Ruang UGD'],
            ['nama' => 'Tata Usaha dan Personalia'],
        ];

        DB::table('unit')->insert($listUnit);
    }
}
