<?php

namespace App\Http\Controllers;

use App\Models\DuesCollection;
use Illuminate\Http\Request;

class DuesCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('accounts_sections.dues_collections.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts_sections.dues_collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DuesCollection $duesCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DuesCollection $duesCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DuesCollection $duesCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DuesCollection $duesCollection)
    {
        //
    }
}
