<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use AutoUuid;
    use HasFactory;
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function policeStation()
    {
        return $this->belongsTo(PoliceStation::class, 'police_station_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function show(){
        return $this->address_line_1 . ', ' . $this->area_name . ', ' . $this->policeStation?->name. ', ' . $this->district?->name;
    }


    const ADDRESS_TYPE_PRESENT = 'present';
    const ADDRESS_TYPE_PERMANENT = 'permanent';
    const ADDRESS_TYPE_GUARDIAN = 'guardian';
}
