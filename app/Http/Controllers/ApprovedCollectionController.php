<?php

namespace App\Http\Controllers;

use App\Models\ApprovedCollection;
use App\Models\FeeCollection;
use Illuminate\Http\Request;

class ApprovedCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $approval = $request->input('approved_status', 1); // default to Approved
        // dd($approval);
        $FeeCollections = FeeCollection::with(['student', 'feePaymentDetail', 'currentClass'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')->orWhere('id_number', $request->search);
                });
            })
            ->when($request->filled('from_date'), function ($query) use ($request) {
                $query->whereDate('collection_date', '>=', $request->from_date);
            })
            ->when($request->filled('to_date'), function ($query) use ($request) {
                $query->whereDate('collection_date', '<=', $request->to_date);
            })
            ->where('approval', $approval)
            ->latest()
            ->paginate(20);
        // dd($FeeCollections);
        $approvedCount = FeeCollection::where('approval', 1)->count();

        return view('accounts_sections.approved_collections.index', compact('FeeCollections', 'approvedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $FeeCollections = FeeCollection::with(['student', 'feePaymentDetail', 'currentClass'])
            ->where('approval', 0)
            ->latest()
            ->paginate(20);
        // dd($FeeCollections);
        return view('accounts_sections.approved_collections.create', compact('FeeCollections'));
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
    public function show($id)
    {
        $FeeCollection = FeeCollection::with(['student', 'feePaymentDetail', 'currentClass'])->findOrFail($id);

        return view('accounts_sections.approved_collections.show', compact('FeeCollection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApprovedCollection $approvedCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $selectedIds = $request->input('selected', []); // UUID array

        if (!empty($selectedIds)) {
            // Bulk update using Eloquent whereIn
            FeeCollection::whereIn('id', $selectedIds)->update(['approval' => 1]); // Or whatever value you need to set
        }

        return redirect()->back()->with('success', 'Selected fees have been approved.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApprovedCollection $approvedCollection)
    {
        //
    }
}
