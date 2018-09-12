<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'misbah ansori',
            'email' => 'misbah.ansori24@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
