<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Role $role, Request $request)
    {
        $this->validate($request, [
            'permission_id' => 'required|integer|exists:permissions,id',
        ]);
        
        $permission = Permission::findOrFail($request->permission_id);
        $role->givePermissionTo($permission);

        return back()->with('success', "Hak akses $permission->name diberikan kepada $role->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        return back()->with('success', "Hak akses $permission->name berhasil dihapus");
    }
}
