<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use App\Models\PaymentFrequencyType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeTypes = FeeType::orderBy('code')->get();
        return view('setups.accounts_setups.fee_types.index', compact('feeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentFrequencyTypes = PaymentFrequencyType::all()->pluck('display_name', 'id');


        return view('setups.accounts_setups.fee_types.create', compact('paymentFrequencyTypes') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|gt:0|unique:fee_types,code',
            'name' => 'required|string|max:255|unique:fee_types,name',
            'payment_frequency_type_id' => 'required|exists:payment_frequency_types,id',
            'status' => 'required|boolean',
        ]);

        FeeType::create($request->all());

        return redirect()->route('fee-types.index')->with('success', 'Fees name created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $paymentFrequencyTypes = PaymentFrequencyType::all()->pluck('display_name', 'id');

        $feeType = FeeType::findOrFail($id);


        return view('setups.accounts_setups.fee_types.edit', compact('feeType', 'paymentFrequencyTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required|numeric|min:0|unique:fee_types,code,' . $id,
            'name' => 'required|string|max:255|unique:fee_types,name,' . $id,
            'payment_frequency_type_id' => 'required|exists:payment_frequency_types,id',
            'status' => 'required|boolean',
        ]);

        $fees = FeeType::findOrFail($id);
        $fees->update($request->all());

        return redirect()->route('fee-types.index')->with('success', 'Fees name updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
