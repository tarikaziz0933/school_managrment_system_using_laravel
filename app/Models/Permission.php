<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laratrust\Models\Permission as PermissionModel;
use Mpdf\Tag\S;

class Permission extends PermissionModel
{
    use HasFactory;
    use AutoUuid;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


    const PERMISSIONS = [
        'student.create' => 'Create Student',
        'student.view' => 'View Student',
        'student.edit' => 'Edit Student',
        'student.delete' => 'Delete Student',
        'student.admission' => 'Student Admission',
        'student.quick_admission' => 'Quick Admission',
        'user.create' => 'Create User',
        'user.view' => 'View User',
        'user.edit' => 'Edit User',
        'user.delete' => 'Delete User',
        'role.create' => 'Create Role',
        'role.view' => 'View Role',
        'role.edit' => 'Edit Role',
        'role.delete' => 'Delete Role',
        'permission.create' => 'Create Permission',
        'permission.view' => 'View Permission',
        'permission.edit' => 'Edit Permission',
        'permission.delete' => 'Delete Permission',
        'class.create' => 'Create Class',
        'class.view' => 'View Class',
        'class.edit' => 'Edit Class',
        'class.delete' => 'Delete Class',
        'section.create' => 'Create Section',
        'section.view' => 'View Section',
        'section.edit' => 'Edit Section',
        'section.delete' => 'Delete Section',
    ];

}
