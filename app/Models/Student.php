<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;
    protected $guarded = [];

    protected $casts = [
        'dob' => 'datetime',
        'admitted_at' => 'datetime',
    ];

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

    public function father(): MorphOne
    {
        return $this->morphOne(Guardian::class, 'guardianable')->where('relation_type_slug', RelationType::FATHER);
    }

    public function mother(): MorphOne
    {
        return $this->morphOne(Guardian::class, 'guardianable')->where('relation_type_slug', RelationType::MOTHER);
    }

    public function guardian(): MorphOne
    {
        return $this->morphOne(Guardian::class, 'guardianable')->whereNotIn('relation_type_slug', [RelationType::FATHER, RelationType::MOTHER]);
    }

    public function presentAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type_slug', Address::ADDRESS_TYPE_PRESENT);
    }

    public function permanentAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type_slug', Address::ADDRESS_TYPE_PERMANENT);
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'student_characteristics', 'student_id', 'characteristic_id');
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class, 'student_id', 'id');
    }

    public function currentClass()
    {
        return $this->hasOne(StudentClass::class, 'student_id', 'id')->orderBy('year', 'desc');
    }

    public static function generateStudentId($year = null)
    {
        // Get the current year
        $year = $year ?? Carbon::now()->year;

        // Get the highest 4-digit number used this year
        $max_id = Student::whereYear('created_at', $year)->selectRaw('MAX(CAST(SUBSTRING(id_number, 5, 4) AS UNSIGNED)) as max_id')->first();

        // Get the next number (incremented), defaulting to 1
        $next_number = $max_id && $max_id->max_id ? $max_id->max_id + 1 : 1;

        // Return the new 8-digit ID
        return $year . str_pad($next_number, 4, '0', STR_PAD_LEFT);
    }


    function vouchers(){
        return $this->morphMany(Voucher::class, 'voucherable');
    }
}
