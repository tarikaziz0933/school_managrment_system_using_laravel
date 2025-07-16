<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\Api\StudentInfoController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\FeeItemController;
use App\Http\Controllers\Api\YearlyTransportFeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('students/select2', [StudentController::class, 'select2'])->name('students.select2');

Route::get('students/{id}', [StudentController::class, 'show'])->name('students.show');


Route::get('fee-items/{class_id}/{year}/{student_id}', [FeeItemController::class, 'getFeeItems'])
    ->name('fee-items.get-fee-items');

Route::get('/yearly-transport/{student_id}/{year}', [YearlyTransportFeeController::class, 'getYearlyTransportFees']);


Route::get('employees/select2', [EmployeeController::class, 'select2'])->name('employees.select2');

Route::get('employees/generate-id-number', [EmployeeController::class, 'generateIdNumber']);

Route::get('sections/select2', [\App\Http\Controllers\API\SectionController::class, 'select2'])->name('sections.select2');

Route::get('police-stations/select2', [\App\Http\Controllers\API\PoliceStationController::class, 'select2'])->name('police-stations.select2');

Route::get('student-class/{id_number}', [\App\Http\Controllers\API\StudentInfoController::class, 'getStudentByIdNumber']);
