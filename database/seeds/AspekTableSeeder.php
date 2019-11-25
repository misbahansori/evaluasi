<?php

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class AspekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('/seeds/sql/aspek.sql');
        
        DB::unprepared(file_get_contents($path));
    }
}
