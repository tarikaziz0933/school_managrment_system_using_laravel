<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function rel_to_campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }
    public function rel_to_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
    public function rel_to_group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function rel_to_section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function rel_to_religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
    public function rel_to_bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_name', 'name');
    }
    public function rel_to_nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function rel_to_birthPlace()
    {
        return $this->belongsTo(BirthPlace::class, 'birthplace_id');
    }
}
