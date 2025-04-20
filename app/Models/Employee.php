<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;
    protected $guarded = ['id'];

    protected $casts = [
        'dob' => 'datetime',
        'admitted_at' => 'datetime',
    ];

    public function designation()
    {
        return $this->belongsTo(Campus::class, 'designation_id');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_name', 'name');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

   
}
