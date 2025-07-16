<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeCollectionItem extends Model
{
    use  HasFactory;
    use AutoUuid;

    protected $guarded = ['id'];

    public function FeeCollection()
    {
        return $this->belongsTo(FeeCollection::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function feeSetupItem()
    {
        return $this->belongsTo(FeeSetupItem::class);
    }

}
