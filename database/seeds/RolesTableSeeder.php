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
        $path = database_path('/seeds/sql/roles.sql');
        
        DB::unprepared(file_get_contents($path));
    }
}
