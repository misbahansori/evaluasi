<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Models\User;
use Spatie\Permission\Models\Role;

class UserRolesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate(['role' => 'required']);

        $user->assignRole($request->role);

        return back()->with('success', "Group berhasil ditambahkan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Role $role)
    {
        $user->removeRole($role);

        return back()->with('success', "Group $role->name berhasil dihapus");
    }
}
