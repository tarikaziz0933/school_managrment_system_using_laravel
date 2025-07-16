<?php

namespace App\Http\Controllers;

use App\Models\PaymentFrequencyType;
use Illuminate\Http\Request;

class PaymentFrequencyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = PaymentFrequencyType::orderBy('name')->get();

        return view('payment_frequency_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_frequency_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:payment_frequency_types,name',
            'code' => 'required|string|max:20|unique:payment_frequency_types,code',
            'description' => 'nullable|string|max:255',
        ]);

        PaymentFrequencyType::create($validated);

        return redirect()->route('payment-frequency-types.index')
            ->with('success', 'Payment Frequency Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = PaymentFrequencyType::findOrFail($id);

        return view('payment_frequency_types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = PaymentFrequencyType::findOrFail($id);

        return view('payment_frequency_types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = PaymentFrequencyType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:payment_frequency_types,name,' . $type->id,
            'code' => 'required|string|max:20|unique:payment_frequency_types,code,' . $type->id,
            'description' => 'nullable|string|max:255',
        ]);

        $type->update($validated);

        return redirect()->route('payment-frequency-types.index')
            ->with('success', 'Payment Frequency Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = PaymentFrequencyType::findOrFail($id);
        $type->delete();

        return redirect()->route('payment-frequency-types.index')
            ->with('success', 'Payment Frequency Type deleted successfully.');
    }
}
