<?php

use App\Http\Controllers\BirthPlaceController;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuickAdmissionController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('quickaddmission', QuickAdmissionController::class);
    Route::resource('students', StudentController::class);
    // Route::get('/students/{id}/report', [StudentController::class, 'show'])->name('students.report');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    //Branch Route
    Route::resource('campuses', CampusController::class);

    //Class Route
    Route::resource('classes', ClassController::class);
    
    //Group Route
    Route::resource('groups', GroupController::class);

    //Section Route
    Route::resource('sections', SectionController::class);

    //Religion Route
    Route::resource('religions', ReligionController::class);

    //Blood Group Route
    Route::resource('blood_groups', BloodGroupController::class);

    //Guardian Route
    Route::resource('guardians', GuardianController::class);

    //For nationality
    Route::resource('nationalities', NationalityController::class);

    //For occupations
    Route::resource('occupations', OccupationController::class);

    //For birth place
    Route::resource('birth_place', BirthPlaceController::class);

    //For relations
    Route::resource('relations', RelationController::class);

    // Route::get('/get-nationalities', function () {
    //     $nationalities = [
    //         ['value' => 'afghanistan', 'label' => 'Afghanistan'],
    //         ['value' => 'albania', 'label' => 'Albania'],
    //         ['value' => 'algeria', 'label' => 'Algeria'],
    //         ['value' => 'argentina', 'label' => 'Argentina'],
    //         ['value' => 'australia', 'label' => 'Australia'],
    //         ['value' => 'bangladeshi', 'label' => 'bangladeshi'],
    //         ['value' => 'brazil', 'label' => 'Brazil'],
    //         ['value' => 'canada', 'label' => 'Canada'],
    //         ['value' => 'china', 'label' => 'China'],
    //         ['value' => 'france', 'label' => 'France'],
    //         ['value' => 'germany', 'label' => 'Germany'],
    //         // Add other countries...
    //     ];
    
    //     return response()->json(['nationalities' => $nationalities]);
    // });

    //For birthplace
    Route::get('/get-birthplaces', function () {
        // List of birthplaces in Bangladesh
        $birthplaces = [
            ['value' => 'dhaka', 'label' => 'Dhaka'],
            ['value' => 'chittagong', 'label' => 'Chittagong'],
            ['value' => 'rajshahi', 'label' => 'Rajshahi'],
            ['value' => 'khulna', 'label' => 'Khulna'],
            ['value' => 'barisal', 'label' => 'Barisal'],
            ['value' => 'sylhet', 'label' => 'Sylhet'],
            ['value' => 'mymensingh', 'label' => 'Mymensingh'],
            ['value' => 'rajbari', 'label' => 'Rajbari'],
            ['value' => 'pabna', 'label' => 'Pabna'],
            ['value' => 'bogura', 'label' => 'Bogura'],
            // You can add more cities or regions if needed
        ];
    
        // Return the data as a JSON response
        return response()->json(['birthplaces' => $birthplaces]);
    });


    //Role & Permission Route
    Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('roles.permissions');
    Route::post('/roles/store', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::post('/permissions/store', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::post('/permissions/assign', [RolePermissionController::class, 'assignPermission'])->name('permissions.assign');
    Route::delete('/roles/{id}', [RolePermissionController::class, 'destroyRole'])->name('roles.destroy');
    // Correct Route Definition
    Route::delete('roles/{role}/permissions/{permission}/detach', [RolePermissionController::class, 'detachPermission'])->name('roles.permissions.detach');


    //User Role Route
    Route::get('/users-authorization', [UserRoleController::class, 'index'])->name('users.authorizations');
    
    // Route to assign roles to users
    Route::post('/users/{user}/assign-roles', [UserRoleController::class, 'assignRoles'])->name('users.assignRoles');
    
    // Route to assign permissions to users
    Route::post('/users/{user}/assign-permissions', [UserRoleController::class, 'assignPermissions'])->name('users.authorizations.assignPermissions');
    
    // Route to remove a specific role from a user
    Route::delete('/users/{user}/remove-role/{role}', [UserRoleController::class, 'removeRole'])->name('users.authorizations.removeRole');
    
    // Route to remove a specific permission from a user
    Route::delete('/users/{user}/remove-permission/{permission}', [UserRoleController::class, 'removePermission'])->name('users.authorizations.removePermission');
    Route::get('/users/{user}/edit-permissions', [UserRoleController::class, 'edit'])->name('users.authorizations.edit');
});

require __DIR__ . '/auth.php';
