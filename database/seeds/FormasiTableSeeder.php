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
        $path = database_path('/seeds/sql/formasi.sql');
        
        DB::unprepared(file_get_contents($path));
    }
}
