<?php

use App\Http\Controllers\ApprovedCollectionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DuesCollectionController;
use App\Http\Controllers\EducationBoardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmploymentTypeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeCollectionController;
use App\Http\Controllers\FeeSetupItemController;
use App\Http\Controllers\FeeSetupMasterController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\PaymentFrequencyTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PoliceStationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuickAdmissionController;
use App\Http\Controllers\ReadmissionController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RootDivideController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsTransportAssignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Models\Employee;
use App\Models\FeeCollection;
use App\Models\Notice;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // or your dashboard route name
    }

    // If the user is not authenticated, show the login page
    $authController = new AuthenticatedSessionController();

    return $authController->create();
});

Route::get('/dashboard', function () {
    $total_students = Student::where('status', 1)->count();

    $total_teachers = Employee::whereHas('designation', function ($q) {
        $q->where('name', 'Teacher');
    })
        ->where('status', 1)
        ->count();

    $total_employees = Employee::where('status', 1)->count();

    $today_employee_birthdays = Employee::where('dob', '!=', null)->where('status', 1)->whereMonth('dob', date('m'))->whereDay('dob', date('d'))->get();

    $today_student_birthdays = Student::where('dob', '!=', null)->whereMonth('dob', date('m'))->whereDay('dob', date('d'))->get();

    $notices = Notice::where('status', 1)->latest()->take(5)->get();

    $total_paid_amount = FeeCollection::sum('paid_amount');
    $total_due_amount  = FeeCollection::sum('due_amount'); // fixed column name

    return view('dashboard', compact('total_students', 'total_teachers', 'total_employees', 'today_employee_birthdays', 'today_student_birthdays', 'notices', 'total_paid_amount','total_due_amount'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    //For Birthdays
    Route::get('/student-birthdays', [BirthdayController::class, 'studentBirthdays'])->name('students.birthdays');
    Route::get('/employee-birthdays', [BirthdayController::class, 'teacherBirthdays'])->name('employees.birthdays');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Student Routes
    Route::resource('quickaddmissions', QuickAdmissionController::class);

    Route::get('students/{student}/report', [StudentController::class, 'showPdf'])->name('students.report');

    Route::resource('students', StudentController::class);

    Route::resource('re-admissions', ReadmissionController::class);

    //Employee Routes
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}/report', [EmployeeController::class, 'showPdf'])->name('employees.report');

    Route::resource('attendances', AttendanceController::class);

    //Accounts Routes
    Route::resource('fee-types', FeeTypeController::class);

    Route::resource('fee-setup-masters', FeeSetupMasterController::class);

    Route::resource('fee-setup-items', FeeSetupItemController::class);

    //Fees Amount Routes
    Route::resource('fee-collections', FeeCollectionController::class);

    Route::resource('payment-frequency-types', PaymentFrequencyTypeController::class);

    //Dues Collections
    Route::resource('dues-collections', DuesCollectionController::class);

    //Approved Collections
    Route::resource('approved-collections', ApprovedCollectionController::class);
    Route::put('/approved-collections/update', [ApprovedCollectionController::class, 'update'])->name('approved-collections.update');
    Route::get('/approved-collections', [ApprovedCollectionController::class, 'index'])->name('approved-collections.index');

    //Scholarships
    Route::resource('scholarships', ScholarshipController::class);

    //Transport Routes
    Route::resource('root-divides', RootDivideController::class);
    Route::resource('students-transport-assigns', StudentsTransportAssignController::class);

    //Exam Routes
    Route::resource('exams', ExamController::class);

    //Board Routes
    Route::resource('education_boards', EducationBoardController::class);

    //notices Route
    Route::resource('notices', NoticeController::class);

    //designations Route
    Route::resource('designations', DesignationController::class);

    //Employment-type Route
    Route::resource('employment-type', EmploymentTypeController::class);

    //Class Route
    Route::resource('classes', ClassController::class);

    //Group Route
    Route::resource('groups', GroupController::class);

    //Campus Route
    Route::resource('campuses', CampusController::class);

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
    Route::resource('districts', DistrictController::class);

    Route::resource('police-stations', PoliceStationController::class);

    //Role & Permission Route
    Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('roles.permissions');
    Route::post('/roles/store', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::post('/permissions/store', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::post('/permissions/assign', [RolePermissionController::class, 'assignPermission'])->name('permissions.assign');
    // Route::delete('/roles/{id}', [RolePermissionController::class, 'destroyRole'])->name('roles.destroy');
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

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);
});

require __DIR__ . '/auth.php';
