<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeSetupItem;

class FeeItemController extends Controller
{
    public function getFeeItems($class_id, $year, $student_id)
    {

        // $paidFeeSetupItems = \App\Models\FeeSetupItem::whereHas('feeCollectionItems.feeCollection', function ($query) use ($student_id) {
        //     $query->where('student_id', $student_id);
        // })->get();

        $paidFeeSetupItemIds = \App\Models\FeeSetupItem::whereHas('feeCollectionItems.feeCollection', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })->pluck('id')->toArray();

        // Optional validation (UUID & Year)
        if (! preg_match('/^[0-9a-fA-F\-]{36}$/', $class_id) || ! is_numeric($year)) {
            return response()->json(
                [
                    'status'  => 'ERROR',
                    'message' => 'Invalid class_id or year',
                ],
                400,
            );
        }

        // $feeSetupItems = FeeSetupItem::with(['feeType', 'feeType.paymentFrequencyType'])
        //     ->where('class_id', $class_id) // UUID match
        //     ->where('year', $year)

        //     ->orderBy('fee_type_id', 'asc')
        //     ->orderBy('month', 'asc')
        //     ->get()
        //     ->sortBy(function ($item) {
        //         return $item->feeType->code;
        //     })
        //     ->values();

        $feeSetupItems = FeeSetupItem::with(['feeType', 'feeType.paymentFrequencyType'])
            ->where('class_id', $class_id)
            ->where('year', $year)
            ->whereNotIn('id', $paidFeeSetupItemIds) // ⛔ exclude paid items
            ->orderBy('fee_type_id', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->sortBy(function ($item) {
                return $item->feeType->code;
            })
            ->values();

        return response()->json([
            'status' => 'OK',
            'data'   => $feeSetupItems,
        ]);
    }
}
