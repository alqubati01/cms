<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();

        return view('roles-permissions.index', ['roles' => $roles]);
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permission_groups = Permission::getPermissionGroup();

        return view('roles-permissions.edit', ['role' => $role, 'permission_groups' => $permission_groups]);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->permissions()->sync($permissions);
        }

        return redirect()->route('roles.permissions.index')
            ->with('success', 'Role Permission Updated successfully');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if($role) {
            $role->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Role Permission Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Role Permission Found.'
            ]);
        }
    }
}
