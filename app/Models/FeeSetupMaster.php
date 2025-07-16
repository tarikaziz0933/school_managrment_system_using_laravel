<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeSetupMaster extends Model
{

    use SoftDeletes, HasFactory;
    use AutoUuid;

    protected $guarded = ['id'];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function paymentFrequencyType()
    {
        return $this->belongsTo(PaymentFrequencyType::class, 'payment_frequency_type_id', 'id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }
}
