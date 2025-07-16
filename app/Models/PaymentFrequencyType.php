<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentFrequencyType extends Model
{

    use SoftDeletes, HasFactory;
    use AutoUuid;
    protected $guarded = ['id'];


    const PAYMENT_FREQUENCY_TYPE_ONE_TIME   = 'one_time';
    const PAYMENT_FREQUENCY_TYPE_MONTHLY    = 'monthly';
    const PAYMENT_FREQUENCY_TYPE_QUARTERLY  = 'quarterly';
    const PAYMENT_FREQUENCY_TYPE_HALF_YEARLY = 'half_yearly';
    const PAYMENT_FREQUENCY_TYPE_YEARLY     = 'yearly';

}
