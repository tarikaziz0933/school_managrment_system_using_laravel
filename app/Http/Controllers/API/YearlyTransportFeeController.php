<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentsTransportAssign;
use Illuminate\Http\Request;

class YearlyTransportFeeController extends Controller
{
    public function getYearlyTransportFees($student_id, $year)
    {
        // Optional validation (UUID & Year)
        if (!preg_match('/^[0-9a-fA-F\-]{36}$/', $student_id) || !is_numeric($year)) {
            return response()->json(
                [
                    'status' => 'ERROR',
                    'message' => 'Invalid class_id or year',
                ],
                400,
            );
        }

        $yearlyTransportFees = StudentsTransportAssign::with(['rootDivide'])
            ->where('student_id', $student_id) // UUID match
            ->where('year', $year)
            ->get();

        return response()->json([
            'status' => 'OK',
            'data' => $yearlyTransportFees,
        ]);
    }
}
