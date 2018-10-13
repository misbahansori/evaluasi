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
        $this->call(BulanTableSeeder::class);
        // $this->call(UnitTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BagianTableSeeder::class);
        $this->call(FormasiTableSeeder::class);
        $this->call(AspekTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
