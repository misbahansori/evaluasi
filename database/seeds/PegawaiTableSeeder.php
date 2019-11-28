<?php

use Illuminate\Database\Seeder;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('/seeds/sql/pegawai.sql');
        
        DB::unprepared(file_get_contents($path));
    }
}
