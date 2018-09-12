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
        // DB::table('unit')->truncate();

        $unit = [
            'TU', 'Keuangan', 'Rumah Tangga', 'IPSRS', 'Fisioterapi', 'Pendaftaran', 'BPJS', 'Filling', 
            'IGD', 'Radiologi', 'Customer Service', 'Poliklinik', 'Apotik', 'OK', 'Laboratorium', 'Shafa',
            'Marwah', 'Cleaning Service', 'Bindatra', 'Loundry', 'Mina', 'Arafah', 'ICU', 'IT', 'Gizi',
            'Teknisi', 'Elektromedis'
        ];

        foreach ($unit as $key => $value) {
            $unit[$key] = [
                'id' => $key + 1,
                'nama'  => $value,
            ];
        }

        DB::table('unit')->insert($unit);
    }
}
