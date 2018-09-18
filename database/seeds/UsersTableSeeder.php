<?php

use App\Models\User;
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
        $user = User::create([
            'name' => 'misbah ansori',
            'email' => 'misbah.ansori24@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole(Spatie\Permission\Models\Role::all());
        $user->givePermissionTo(Spatie\Permission\Models\Permission::all());

    }
}
