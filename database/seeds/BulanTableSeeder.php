<?php

use Illuminate\Database\Seeder;

class BulanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bulan')->truncate();
        
        $bulan = [
            [
                'id' => 1,
                'nama' => 'Januari',
                'nama_singkat' => 'Jan'
            ],
            [
                'id' => 2,
                'nama' => 'Februari',
                'nama_singkat' => 'Feb'
            ],
            [
                'id' => 3,
                'nama' => 'Maret',
                'nama_singkat' => 'Mar'
            ],
            [
                'id' => 4,
                'nama' => 'April',
                'nama_singkat' => 'Apr'
            ],
            [
                'id' => 5,
                'nama' => 'Mei',
                'nama_singkat' => 'Mei'
            ],
            [
                'id' => 6,
                'nama' => 'Juni',
                'nama_singkat' => 'Jun'
            ],
            [
                'id' => 7,
                'nama' => 'Juli',
                'nama_singkat' => 'Jul'
            ],
            [
                'id' => 8,
                'nama' => 'Agustus',
                'nama_singkat' => 'Agt'
            ],
            [
                'id' => 9,
                'nama' => 'September',
                'nama_singkat' => 'Sep'
            ],
            [
                'id' => 10,
                'nama' => 'Okober',
                'nama_singkat' => 'Okt'
            ],
            [
                'id' => 11,
                'nama' => 'November',
                'nama_singkat' => 'Nov'
            ],
            [
                'id' => 12,
                'nama' => 'Desember',
                'nama_singkat' => 'Des'
            ],
        ];

        DB::table('bulan')->insert($bulan);
    }
}
