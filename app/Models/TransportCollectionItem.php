<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportCollectionItem extends Model
{
    use  HasFactory;
    use AutoUuid;

    protected $guarded = ['id'];
}
