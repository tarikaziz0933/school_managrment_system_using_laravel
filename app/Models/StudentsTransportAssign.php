<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Mailer\Transport;

class StudentsTransportAssign extends Model
{
    use SoftDeletes, HasFactory;
    use AutoUuid;

    protected $guarded = [];
    protected $casts = [
        'assign_date' => 'date',
        'fees_amount' => 'double',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function rootDivide()
    {
        return $this->belongsTo(RootDivide::class, 'root_divide_id');
    }
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'student_id');
    }
}
