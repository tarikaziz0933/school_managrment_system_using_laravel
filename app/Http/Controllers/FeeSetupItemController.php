<?php
namespace App\Http\Controllers;

use App\Models\FeeSetupItem;
use App\Models\FeeType;
use App\Models\Group;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FeeSetupItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->merge([
            'year' => $request->year ?? date('Y'),
        ]);

        $fee_items = FeeSetupItem::with(['feeType', 'schoolClass', 'group'])
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->where('year', $request->year);
            })
            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            })
            ->when($request->filled('group_id'), function ($q) use ($request) {
                $q->where('group_id', $request->group_id);
            })
            ->get();
        // $feeTypes = FeeType::paginate();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();

        $groups = Group::where('status', 1)->pluck('name', 'id');

        return view('setups.accounts_setups.yearly_fees.index', compact('fee_items', 'classes', 'groups'))->with('year', $request->year)->with('class_id', $request->class_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fee_items = FeeSetupItem::all();
        $feeTypes = FeeType::where('status', 1)->get();
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        return view('setups.accounts_setups.yearly_fees.create', compact('fee_items', 'feeTypes', 'classes', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'class_id' => 'required',
            // 'class_id_to' => 'required',
            'group_id' => 'nullable',
            'fees' => 'required|array',
            'fees.*.fee_type_id' => 'required|uuid|exists:fee_types,id',
            'fees.*.amount' => 'required|numeric|min:0',
            // 'fees.*.serial_no' => 'required|integer',
        ]);

        $class = SchoolClass::find($request->class_id);

        $classLevel = $class->level;

        foreach ($request->fees as $fee) {
            $feeType = FeeType::find($fee['fee_type_id']);

            $exists = FeeSetupItem::where('fee_type_id', $fee['fee_type_id'])->where('class_id', $class->id)->where('group_id', $request->group_id)->where('year', $request->year)->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'fees' => ["Fee for type {$feeType->name} already exists for class {$class->name} (Level {$classLevel}), group, and year {$request->year}."],
                ]);
            }

            switch ($feeType->payment_frequency_type_name) {
                case FeeType::PAYMENT_FREQUENCY_TYPE_ONE_TIME:
                    $fee = FeeSetupItem::create([
                        'class_id' => $class->id,
                        'group_id' => $request->group_id,

                        'month' => null,
                        'year' => $request->year,

                        'fee_type_id' => $fee['fee_type_id'],
                        'amount' => $fee['amount'],
                    ]);

                    break;

                case FeeType::PAYMENT_FREQUENCY_TYPE_MONTHLY:
                    for ($month = 1; $month <= 12; $month++) {
                        FeeSetupItem::create([
                            'class_id' => $class->id,
                            'group_id' => $request->group_id,

                            'month' => $month,
                            'year' => $request->year,

                            'fee_type_id' => $fee['fee_type_id'],
                            'amount' => $fee['amount'],
                        ]);
                    }

                    break;

                case FeeType::PAYMENT_FREQUENCY_TYPE_HALF_YEARLY:
                    // Create fees for both halves of the year
                    FeeSetupItem::create([
                        'class_id' => $class->id,
                        'group_id' => $request->group_id,

                        'month' => 1, // January
                        'year' => $request->year,

                        'fee_type_id' => $fee['fee_type_id'],
                        'amount' => $fee['amount'],
                    ]);

                    FeeSetupItem::create([
                        'class_id' => $class->id,
                        'group_id' => $request->group_id,

                        'month' => 7, // July
                        'year' => $request->year,

                        'fee_type_id' => $fee['fee_type_id'],
                        'amount' => $fee['amount'],
                    ]);

                    break;

                case FeeType::PAYMENT_FREQUENCY_TYPE_YEARLY:
                    // Create a single yearly fee
                    FeeSetupItem::create([
                        'class_id' => $class->id,
                        'group_id' => $request->group_id,
                        'month' => 1, // No specific month for yearly fees
                        'year' => $request->year,
                        'fee_type_id' => $fee['fee_type_id'],
                        'amount' => $fee['amount'],
                    ]);

                    break;

                default:
                // throw ValidationException::withMessages([
                //     'fees' => ["Invalid fee type {$feeType->type} for fee type ID {$fee['fee_type_id']}."],
                // ]);
            }

            // $fee = FeeSetupItem::create([
            //     'class_id' => $class->id,
            //     'group_id' => $request->group_id,

            //     'year' => $request->year,

            //     'fee_type_id' => $fee['fee_type_id'],
            //     'amount' => $fee['amount'],
            // ]);
        }

        return redirect()->route('fee-setup-items.index')->with('success', 'Yearly fees created successfully for all selected classes.');
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
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        return view('setups.accounts_setups.yearly_fees.edit', compact('fee', 'feeTypes', 'classes', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeSetupItem $fee)
    {
        $request->validate([
            'year' => 'required|integer',
            'class_id' => 'required',
            'group_id' => 'nullable',
            'fees' => 'required|array',
            'fees.*.fee_type_id' => 'required',
            'fees.*.amount' => 'required|numeric|min:0',
            // 'fees.*.serial_no' => 'required|integer',
        ]);

        $fee->update([
            'year' => $request->year,
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
                'amount' => $fee['amount'],
            ]);
        }

        return redirect()->route('fee-setup-items.index')->with('success', 'Yearly fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeSetupItem $fee)
    {
        //
    }
}
