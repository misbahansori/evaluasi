<?php

namespace Tests\Setup;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserFactory 
{ 
    protected $permission;
    protected $role;
    
    public function create()
    {
        $user =  factory(User::class)->create();

        if ($this->permission) {
            $user->givePermissionTo($this->permission->name);    
        }
        
        if ($this->role) {
            $user->assignRole($this->role);    
        }

        return $user; 
    }

    public function withPermission($name)
    {
        $this->permission = factory(Permission::class)->create(['name' =>  $name]);

        return $this;
    }

    public function withRole($name)
    {
        $this->role = factory(Role::class)->create(['name' =>  $name]);

        return $this;
    }


}