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
            'role' => 'required|integer|exists:roles,id',
        ]);

        $role = Role::find($request->role);

        $user->assignRole($role);

        return redirect()->back()
            ->with('success', "Group $role->name berhasil ditambahkan");
    }

    public function destroy(User $user, Role $role)
    {
        $user->removeRole($role);

        return redirect()->back()
            ->with('success', "Group $role->name berhasil dihapus");
    }
}
