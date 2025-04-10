<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        $groups = Group::paginate();
        return view('groups.index', compact('groups'));
    }
    public function create()
    {
        $groups = Group::all();
        return view('groups.create', compact('groups'));
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
}
