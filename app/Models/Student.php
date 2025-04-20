<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;
    protected $guarded = ['id'];


    protected $casts = [
        'dob' => 'datetime',
        'admitted_at' => 'datetime',
    ];


    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_name', 'name');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'birth_place_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function father()
    {
        return $this->hasOne(Guardian::class)->where('relation_slug', Relation::FATHER);
    }

    public function mother()
    {
        return $this->hasOne(Guardian::class)->where('relation_slug', Relation::MOTHER);
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'student_characteristics', 'student_id', 'characteristic_id');
    }

}
