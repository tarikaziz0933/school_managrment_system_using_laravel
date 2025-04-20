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

    protected $guarded = ['id'];

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
        return $this->belongsTo(Relation::class, 'relation_slug', 'slug');
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

}
