<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate();
        return view('setups.groups.index', compact('groups'));
    }
    public function create()
    {
        $groups = Group::all();
        return view('setups.groups.create', compact('groups'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        Group::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('groups.index')->with('success', 'Group added successfully!');
    }
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('setups.groups.edit', compact('group'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $group = Group::findOrFail($id);
        $group->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('groups.index')->with('success', 'Group updated successfully!');
    }

    public function softDelete($id)
    {
        Group::findOrFail($id)->delete();
        return back()->with('success', 'Group Name deleted.');
    }

}
