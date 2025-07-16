<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliceStation extends Model
{
    use SoftDeletes;
    use AutoUuid;
    use HasFactory;

    protected $guarded = [];


    public function district()
    {
        return $this->belongsTo(District::class);
    }


}
