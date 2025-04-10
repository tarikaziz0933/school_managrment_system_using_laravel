<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionController extends Controller
{
    // Show Roles & Permissions Page with Search and Pagination
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles_permissions.index', compact('roles', 'permissions'));
    }

    // Store New Role
    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $request->name]);
        return back()->with('success', 'Role created successfully');
    }

    // Store New Permission
    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $request->name]);
        return back()->with('success', 'Permission created successfully');
    }

    // Assign Permission to Role
    public function assignPermission(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array', // Ensure the permissions are passed as an array
            'permissions.*' => 'exists:permissions,id', // Ensure each permission ID exists in the database
        ]);

        // Find the role
        $role = Role::findOrFail($request->role_id);

        // Attach permissions to the role
        $role->permissions()->syncWithoutDetaching($request->permissions);

        return back()->with('success', 'Permissions assigned to role');
    }
    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);

        // Detach all permissions before deleting
        $role->permissions()->detach();

        // Delete the role
        $role->delete();

        return back()->with('success', 'Role deleted successfully');
    }
    public function detachPermission(Role $role, Permission $permission)
    {
        // Detach the permission from the role
        $role->permissions()->detach($permission);

        // Redirect back with success message
        return back()->with('success', 'Permission detached successfully');
    }
}
