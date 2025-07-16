<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePaymentDetail extends Model
{
    use  HasFactory;
    use AutoUuid;

    protected $guarded = ['id'];

    public function collection()
    {
        return $this->belongsTo(FeeCollection::class, 'fee_collection_id');
    }
}
