<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Search
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
            ->orWhereHas("userable",function($query) use($request) {
                $query->where('employees.name', 'like', '%' . $request->search . '%')->orWhere('email', $request->search);
            })
            ->orderBy("created_at", "desc")
            ->paginate();
            return view('users.index', compact('users'));
        }

        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employee = Employee::find($request->employee_id);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'userable_id' => $request->employee_id,
            "userable_type" => get_class($employee)
        ];



       $user = User::create($data);

        $syncData = collect($request->roles)->mapWithKeys(fn($roleId) => [
            $roleId => ['user_type' => \App\Models\User::class]
        ])->toArray();

        $user->roles()->sync($syncData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('display_name', 'id');

        $user->load("userable");


        return view('users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);


        $syncData = collect($request->roles)->mapWithKeys(fn($roleId) => [
            $roleId => ['user_type' => \App\Models\User::class]
        ])->toArray();

        $user->roles()->sync($syncData);


        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
