<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCollection extends Model
{
    use HasFactory;
    use AutoUuid;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeCollectionItems()
    {
        return $this->hasMany(FeeCollectionItem::class,'fee_collection_id');
    }

    public function transportItems()
    {
        return $this->hasMany(TransportCollectionItem::class, 'fee_collection_id');
    }

    public function feePaymentDetail()
    {
        return $this->hasOne(FeePaymentDetail::class, 'fee_collection_id');
    }

    public static function getNextCollectionNo()
    {

        $collection_no = FeeCollection::max("collection_no");

        // Get the next number (incremented), defaulting to 1
        $next_collection_no = $collection_no ? $collection_no + 1 : 1;

        return $next_collection_no;

    }
}
