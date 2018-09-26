<?php

use Illuminate\Database\Seeder;

class FormasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listFormasi = [
            ['nama' => 'Analis'],
            ['nama' => 'Apoteker'],
            ['nama' => 'Asisten Apoteker'],
            ['nama' => 'Bidan'],
            ['nama' => 'Bina Rohani'],
            ['nama' => 'BPJS Center'],
            ['nama' => 'Cleaning Service'],
            ['nama' => 'Customer Service'],
            ['nama' => 'Dokter Umum'],
            ['nama' => 'Driver'],
            ['nama' => 'Fisioterapis'],
            ['nama' => 'Juru Masak'],
            ['nama' => 'Juru Racik'],
            ['nama' => 'Kasir'],
            ['nama' => 'Keuangan'],
            ['nama' => 'Loundry'],
            ['nama' => 'Pengantar Orang Sakit'],
            ['nama' => 'Perawat'],
            ['nama' => 'Perawat Gigi'],
            ['nama' => 'Pramusaji'],
            ['nama' => 'Radiografer'],
            ['nama' => 'Rekam Medis'],
            ['nama' => 'Rumah Tangga'],
            ['nama' => 'Sanitarian'],
            ['nama' => 'Satpam'],
            ['nama' => 'Staf  Pencitraan'],
            ['nama' => 'Staf Administrasi / Juru Racik'],
            ['nama' => 'Staf Filling'],
            ['nama' => 'Staf IPSRS'],
            ['nama' => 'Staf IT'],
            ['nama' => 'Staf Keuangan'],
            ['nama' => 'Staf Loundry'],
            ['nama' => 'Staf Pendaftaran'],
            ['nama' => 'Staf Tata Usaha & Personalia'],
            ['nama' => 'Teknisi'],
            ['nama' => 'Teknisi Elektromedis'],
            ['nama' => 'Tenaga Gizi'],
            ['nama' => 'Bindatra'],
        ];

        DB::table('formasi')->insert($listFormasi);
    }
}
