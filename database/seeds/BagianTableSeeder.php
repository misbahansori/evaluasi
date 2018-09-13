<?php

use Illuminate\Database\Seeder;

class BagianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = [
            'Umum', 'Medis', 'Penunjang Medis'
        ];

        foreach ($bagian as $key => $value) {
            $bagian[$key] = [
                'id' => $key + 1,
                'nama'  => $value,
            ];
        }

        DB::table('bagian')->insert($bagian);
    }
}