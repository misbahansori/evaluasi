<?php

use Illuminate\Database\Seeder;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::unprepared(file_get_contents(database_path('/seeds/sql/permissions.sql')));
        DB::unprepared(file_get_contents(database_path('/seeds/sql/model_has_permissions.sql')));
        DB::unprepared(file_get_contents(database_path('/seeds/sql/role_has_permissions.sql')));
        DB::unprepared(file_get_contents(database_path('/seeds/sql/model_has_roles.sql')));

        $user = User::find(1);
        $user->givePermissionTo(Permission::all());
        $user->assignRole(Role::all());
    }
}
