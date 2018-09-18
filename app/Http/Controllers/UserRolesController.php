<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRolesController extends Controller
{
    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        $user->assignRole($request->role);

        return back()->with('success', "Group berhasil ditambahkan");
    }

    public function destroy(User $user, Role $role)
    {
        $user->removeRole($role);

        return back()->with('success', "Group $role->name berhasil dihapus");
    }
}
