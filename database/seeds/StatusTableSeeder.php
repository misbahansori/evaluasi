<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            ['nama' => 'Pegawai Magang'],
            ['nama' => 'Pegawai Kontrak'],
            ['nama' => 'Calon Pegawai'],
            ['nama' => 'Pegawai Tetap'],
        ]);
    }
}
