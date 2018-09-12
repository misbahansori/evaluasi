<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BulanTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(BagianTableSeeder::class);
        $this->call(AspekTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
    }
}
