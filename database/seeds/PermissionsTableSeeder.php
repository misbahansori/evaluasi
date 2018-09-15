<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'tambah periode', 'hapus periode', 
            'verif wadir', 'verif kabag',
            'master aspek', 'master user', 'master group'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        User::first()->givePermissionTo(Permission::all());
    }
}
