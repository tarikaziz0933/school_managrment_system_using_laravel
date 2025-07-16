<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use AutoUuid;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];


    protected $casts = [
        'dob' => 'date',
        'is_primary_guardian' => 'boolean',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function relation()
    {
        return $this->belongsTo(RelationType::class, 'relation_type_slug', 'slug');
    }

    public function guardianable()
    {
        return $this->morphTo();
    }
    // public function address()
    // {
    //     return $this->morphOne(Address::class, 'addressable');
    // }

}
