<?php

namespace App\Http\Controllers;

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
            $users = User::where('name', 'like', '%' . $request->search . '%')->paginate();
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
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

         // User image
         if ($request->hasFile('image')) {
            $photoFile = $request->file('image');
            Image::createX($photoFile, 512, $user);
        }

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
        $roles = Role::pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);


        // $user->roles()->sync($request->roles);

        $syncData = collect($request->roles)->mapWithKeys(fn($roleId) => [
            $roleId => ['user_type' => \App\Models\User::class]
        ])->toArray();

        $user->roles()->sync($syncData);

        // User image
        if ($request->hasFile('image')) {
            $photoFile = $request->file('image');

            if ($user->image == null) {
                Image::createX($photoFile, 512, $user);
            } else {
                $user->image->updateX($photoFile, 512);
            }
        }

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
