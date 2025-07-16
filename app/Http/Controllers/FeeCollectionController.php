<?php
namespace App\Http\Controllers;

use App\Models\FeeCollection;
use App\Models\FeeCollectionItem;
use App\Models\TransportCollectionItem;
use Illuminate\Http\Request;

class FeeCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $feeCollections = \App\Models\FeeCollection::with('student')->orderByDesc('collected_at')->get();

        return view('accounts_sections.fee_collections.index', compact('feeCollections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $FeeCollections = FeeCollection::all();

        $next_collection_no = FeeCollection::getNextCollectionNo();

        return view('accounts_sections.fee_collections.create', compact('next_collection_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        // Step 1: Validation
        $request->validate([
            'collection_no'                 => 'required|string|unique:fee_collections,collection_no',
            'year'                          => 'required|string',
            'applicable_month'              => 'required|string',
            'student_id'                    => 'required|uuid|exists:students,id',

            'fees'                          => 'nullable|array',
            'fees.*.fee_type_id'            => 'required|uuid|exists:fee_types,id',
            'fees.*.fee_amount'             => 'required|numeric|min:0',
            'fees.*.less'                   => 'nullable|numeric|min:0',
            'fees.*.payable'                => 'required|numeric|min:0',

            'transport_fees'                => 'nullable|array',
            'transport_fees.*.root_code_id' => 'required|string',
            'transport_fees.*.vehicle_name' => 'required|string',
            'transport_fees.*.amount'       => 'required|numeric|min:0',
            'transport_fees.*.less'         => 'nullable|numeric|min:0',
            'transport_fees.*.payable'      => 'required|numeric|min:0',

            // Payment info
            'paid_by'                       => 'required|string',
            'cheque_no'                     => 'nullable|string',
            'bank_name'                     => 'nullable|string',
            'address'                       => 'nullable|string',
            'remarks'                       => 'nullable|string',

            'total_amount'                  => 'required|numeric',
            'fine_amount'                   => 'nullable|numeric',
            'grand_total'                   => 'required|numeric',
            'less_amount'                   => 'nullable|numeric',
            'total_payable_amount'          => 'required|numeric',
            'paid_amount'                   => 'required|numeric',
            'due_amount'                   => 'nullable|numeric',
            'return_amount'                 => 'nullable|numeric',
        ]);

        // Step 2: Duplicate Check (same month, year, student)
        // $exists = FeeCollection::where('student_id', $request->student_id)->where('year', $request->year)->where('applicable_month', $request->applicable_month)->exists();

        // if ($exists) {
        //     throw ValidationValidationException::withMessages([
        //         'student_id' => ["Collection already exists for {$request->year} - Month {$request->applicable_month}."],
        //     ]);
        // }
        // Step 3-5: Use DB Transaction for atomicity
        \DB::beginTransaction();
        try {

            // Step 3: Create Fees Collection
            $feeCollection = FeeCollection::create([
                'collection_no'        => $request->collection_no,
                'applicable_year'      => $request->year,
                'student_id'           => $request->student_id,
                'collected_at'         => $request->collected_at,
                'total_amount'         => $request->total_amount,
                'fine_amount'          => $request->fine_amount ?? 0,
                'grand_total'          => $request->grand_total,
                'less_amount'          => $request->less_amount ?? 0,
                'total_payable_amount' => $request->total_payable_amount,
                'paid_amount'          => $request->paid_amount,
                'due_amount'           => $request->due_amount ?? 0,
            ]);

            // Step 4: Fee Items
            if ($request->filled('fees')) {

                $index = 0;

                foreach ($request->fees as $fee) {

                    FeeCollectionItem::create([
                        'fee_collection_id' => $feeCollection->id,
                        'fee_type_id'       => $fee['fee_type_id'],
                        'fee_amount'        => $fee['fee_amount'],
                        'less'              => $fee['less'] ?? 0,
                        'payable'           => $fee['payable'],
                        'fee_setup_item_id' => $request->fee_type_ids[$index],
                    ]);

                    $index++;
                }
            }

            // Step 5: Transport Fees
            if ($request->filled('transport_fees')) {
                foreach ($request->transport_fees as $transport) {
                    TransportCollectionItem::create([
                        'fee_collection_id' => $feeCollection->id,
                        'root_code_id'      => $transport['root_code_id'],
                        'vehicle_name'      => $transport['vehicle_name'],
                        'amount'            => $transport['amount'],
                        'less'              => $transport['less'] ?? 0,
                        'payable'           => $transport['payable'],
                    ]);
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        // Step 6: Payment Details
        // FeePaymentDetail::create([
        //     'fee_collection_id' => $FeeCollection->id,

        //     'paid_by' => $request->paid_by,
        //     'cheque_no' => $request->cheque_no,
        //     'bank_name' => $request->bank_name,
        //     'address' => $request->address,
        //     'remarks' => $request->remarks,

        //     'total_amount' => $request->total_amount,
        //     'fine_amount' => $request->fine_amount ?? 0,
        //     'grand_total' => $request->grand_total,
        //     'less_amount' => $request->less_amount ?? 0,
        //     'total_payable_amount' => $request->total_payable_amount,
        //     'paid_amount' => $request->paid_amount,
        //     'due_amount' => $request->due_amount,
        //     'return_amount' => $request->return_amount,
        // ]);

        return redirect()->route('fee-collections.index')->with('success', 'Fees, Transport, and Payment details saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeCollection $FeeCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeCollection $FeeCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeCollection $FeeCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeCollection $FeeCollection)
    {
        //
    }
}
