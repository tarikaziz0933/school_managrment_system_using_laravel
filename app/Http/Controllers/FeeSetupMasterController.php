<?php
namespace App\Http\Controllers;

use App\Models\FeeSetupItem;
use App\Models\FeeSetupMaster;
use App\Models\FeeType;
use App\Models\Group;
use App\Models\PaymentFrequencyType;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class FeeSetupMasterController extends Controller
{

    public function index(Request $request)
    {
        $request->merge([
            'year' => $request->year ?? date('Y'),
        ]);

        $groups  = Group::where('status', 1)->pluck('name', 'id');
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();

        $groups = Group::where('status', 1)->pluck('name', 'id');

        $fee_setup_masters = \App\Models\FeeSetupMaster::with(['feeType', 'schoolClass', 'group', 'paymentFrequencyType'])
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->where('year', $request->year);
            })
            ->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->get()
            ->sortBy(function ($item) {
                return $item->feeType->code;
            })
            ->values();

        $fee_setup_items = FeeSetupItem::with(['feeType', 'schoolClass', 'group'])
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->where('year', $request->year);
            })
            ->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->get()
            ->sortBy(function ($item) {
                return $item->feeType->code;
            })
            ->values();

        return view('setups.accounts_setups.fee_setup_masters.index', compact('fee_setup_masters', 'fee_setup_items', 'classes', 'groups'))->with('year', $request->year)->with('class_id', $request->class_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fee_items = FeeSetupItem::all();
        $feeTypes  = FeeType::where('status', 1)
            ->orderBy('code')
            ->get();
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        return view('setups.accounts_setups.fee_setup_masters.create', compact('fee_items', 'feeTypes', 'classes', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year'               => 'required|integer',
            'class_id'           => 'required',
            // 'class_id_to' => 'required',
            'group_id'           => 'nullable',
            'fees'               => 'required|array',
            'fees.*.fee_type_id' => 'required|uuid|exists:fee_types,id',
            'fees.*.amount'      => 'required|numeric|min:0',
            // 'fees.*.serial_no' => 'required|integer',
        ]);

        $class = SchoolClass::find($request->class_id);

        // dd($request->fees);

        foreach ($request->fees as $fee) {
            $feeType = FeeType::find($fee['fee_type_id']);

            $data = [
                'fee_type_id'               => $fee['fee_type_id'],
                'class_id'                  => $class->id,
                'group_id'                  => $request->group_id,
                'year'                      => $request->year,
                'payment_frequency_type_id' => $feeType->payment_frequency_type_id,
                'amount'                    => $fee['amount'],
            ];

            $feeSetupMaster = FeeSetupMaster::where('fee_type_id', $fee['fee_type_id'])
                ->where('class_id', $class->id)
                ->where('group_id', $request->group_id)
                ->where('year', $request->year)
                ->first();

            if ($feeSetupMaster) {
                // If a fee setup master already exists, update it
                $feeSetupMaster->update($data);
            } else {
                // If it doesn't exist, create a new one
                $feeSetupMaster = FeeSetupMaster::create($data);
            }

            switch ($feeType->paymentFrequencyType->name) {
                case PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_ONE_TIME:

                    $feeSetupItem = FeeSetupItem::updateOrCreate(
                        [
                            'class_id'    => $class->id,
                            'group_id'    => $request->group_id,
                            'month'       => null,
                            'year'        => $request->year,
                            'fee_type_id' => $fee['fee_type_id'],
                        ],
                        [
                            'amount'              => $fee['amount'],
                            'fee_setup_master_id' => $feeSetupMaster->id,

                        ]
                    );

                    break;

                case PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_MONTHLY:
                    for ($month = 1; $month <= 12; $month++) {

                        $feeSetupItem = FeeSetupItem::updateOrCreate(
                            [
                                'class_id'    => $class->id,
                                'group_id'    => $request->group_id,
                                'month'       => $month,
                                'year'        => $request->year,
                                'fee_type_id' => $fee['fee_type_id'],
                            ],
                            [
                                'amount'              => $fee['amount'],
                                'fee_setup_master_id' => $feeSetupMaster->id,
                            ]
                        );

                    }

                    break;

                case PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_HALF_YEARLY:
                    // Create fees for both halves of the year

                    $feeSetupItem = FeeSetupItem::updateOrCreate(
                        [
                            'class_id'    => $class->id,
                            'group_id'    => $request->group_id,
                            'month'       => 1, // January
                            'year'        => $request->year,
                            'fee_type_id' => $fee['fee_type_id'],
                        ],
                        [
                            'amount'              => $fee['amount'],
                            'fee_setup_master_id' => $feeSetupMaster->id,
                        ]
                    );

                    $feeSetupItem = FeeSetupItem::updateOrCreate(
                        [
                            'class_id'    => $class->id,
                            'group_id'    => $request->group_id,
                            'month'       => 7, // July
                            'year'        => $request->year,
                            'fee_type_id' => $fee['fee_type_id'],
                        ],
                        [
                            'amount'              => $fee['amount'],
                            'fee_setup_master_id' => $feeSetupMaster->id,
                        ]
                    );

                    break;

                case PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY:
                    // Create a single yearly fee

                    $feeSetupItem = FeeSetupItem::updateOrCreate(
                        [
                            'class_id'    => $class->id,
                            'group_id'    => $request->group_id,
                            'month'       => 1, // January
                            'year'        => $request->year,
                            'fee_type_id' => $fee['fee_type_id'],
                        ],
                        [
                            'amount'              => $fee['amount'],
                            'fee_setup_master_id' => $feeSetupMaster->id,
                        ]
                    );

                    break;

                default:

            }

        }

        return redirect()->route('fee-setup-masters.index', [
            'year'     => $request->year,
            'class_id' => $request->class_id,
            'group_id' => $request->group_id,
        ])->with('success', 'Yearly fees created successfully for all selected classes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeSetupItem $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeSetupItem $fee)
    {
        $feeTypes = FeeType::where('status', 1)->get();
        $classes  = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        return view('setups.accounts_setups.fee_setup_masters.edit', compact('fee', 'feeTypes', 'classes', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeSetupItem $fee)
    {
        $request->validate([
            'year'               => 'required|integer',
            'class_id'           => 'required',
            'group_id'           => 'nullable',
            'fees'               => 'required|array',
            'fees.*.fee_type_id' => 'required',
            'fees.*.amount'      => 'required|numeric|min:0',
            // 'fees.*.serial_no' => 'required|integer',
        ]);

        $fee->update([
            'year'     => $request->year,
            'class_id' => $request->class_id,
            'group_id' => $request->group_id,
        ]);

        foreach ($request->fees as $fee) {
            $fee->update([
                'fee_type_id' => $fee['fee_type_id'],
                // 'class_id' => $request->class_id,
                // 'group_id' => $request->group_id,
                // 'year' => $request->year,

                // 'serial_no' => $fee['serial_no'],
                'amount'      => $fee['amount'],
            ]);
        }

        return redirect()->route('fee-setup-items.index')->with('success', 'Yearly fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
