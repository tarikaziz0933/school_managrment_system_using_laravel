<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeSelect2Resourse;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function select2(Request $request)
    {
        $term = $request->input('term');

        $query = Employee::with('image')->select('id', 'name');

        if (! empty($term)) {
            $query->where('name', 'like', '%' . $term . '%');
        }

        $employees = $query->limit(20)->get(); // Limit results for faster load

        return response()->json(
            [
                'data' => EmployeeSelect2Resourse::collection($employees),
            ]
        );
    }

    public function generateIdNumber(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'joined_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $joinDate = \Carbon\Carbon::parse($request->joined_at);

        $nextId = Employee::generateEmployeeId($joinDate);

        return response()->json(
            ['data' => [
                'id_number' => $nextId,
            ]]
        );

    }

}
