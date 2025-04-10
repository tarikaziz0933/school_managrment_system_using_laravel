<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    // Show users with roles and permissions
    public function index(Request $request)
    {
        $users = User::with(['roles', 'permissions'])
                     ->when($request->search, function ($query) use ($request) {
                         $query->where('name', 'like', '%' . $request->search . '%');
                     })
                     ->paginate(10);

        $roles = Role::all();
        $permissions = Permission::all();
        
        // Example of passing the first user (or any logic to select a user)
        $user = $users->first();  // or use Auth::user() if you want the currently logged-in user

        return view('roles_permissions.assign_roles', compact('users', 'roles', 'permissions', 'user'));
    }

    // Assign roles to a user
    public function assignRoles(Request $request, User $user)
    {
        // Validate the form data
        $validated = $request->validate([
            'roles' => 'array|nullable',
            'permissions' => 'array|nullable',
        ]);

        // Sync roles - passing an array of role IDs
        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        // Sync permissions - passing an array of permission IDs
        if (isset($validated['permissions'])) {
            $user->syncPermissions($validated['permissions']);
        }

        return redirect()->route('users.authorizations', $user->id)->with('success', 'Roles and permissions updated successfully!');

        return redirect()->route('users.authorizations')->with('success', 'Roles assigned successfully.');
    }

    // Assign permissions to a user
    public function assignPermissions(Request $request, User $user)
    {
        $request->validate(['permissions' => 'array|nullable']);
        $user->syncPermissions($request->permissions);  // Sync permissions

        return redirect()->route('users.authorizations')->with('success', 'Permissions assigned successfully.');
    }

    // Remove a role from a user
    public function removeRole(User $user, $role)
    {
        $user->removeRole($role);

        return redirect()->route('users.authorizations')->with('success', 'Role removed successfully.');
    }

    // Remove a permission from a user
    public function removePermission(User $user, $permissionId)
    {
        $user -> removePermission($permissionId);

        return redirect()->route('users.authorizations')->with('success', 'Permission removed successfully.');
    }

    // Assign roles and permissions to a user
    public function assignRolesAndPermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        dd($request->all());
        // Validate the form data
        $validated = $request->validate([
            'roles' => 'array|nullable',
            'permissions' => 'array|nullable',
        ]);

        // Sync roles - passing an array of role IDs
        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        // Sync permissions - passing an array of permission IDs
        if (isset($validated['permissions'])) {
            $user->syncPermissions($validated['permissions']);
        }

        return redirect()->route('users.authorizations.edit', $user->id)->with('success', 'Roles and permissions updated successfully!');
    }

    public function edit($id)
{
    // Fetch the user with their roles and permissions
    $user = User::with('roles', 'permissions')->findOrFail($id);

    // Get all available users, roles, and permissions for selection
    $users = User::all();
    $roles = Role::all();
    $permissions = Permission::all();

    // Pass the user, users, roles, and permissions to the view
    return view('roles_permissions.assign_roles', compact('user', 'users', 'roles', 'permissions'));
}
}
