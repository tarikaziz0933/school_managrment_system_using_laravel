<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use SoftDeletes, HasFactory;
    use AutoUuid;
    protected $guarded = ['id'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_characteristics', 'characteristic_id', 'student_id');
    }
}
