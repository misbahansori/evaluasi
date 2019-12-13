<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Models\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
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
        $request->validate(['permission' => 'required']);

        $user->givePermissionTo($request->permission);

        return back()->with('success', "Group berhasil ditambahkan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);

        return back()->with('success', "Group $permission->name berhasil dihapus");
    }
}
