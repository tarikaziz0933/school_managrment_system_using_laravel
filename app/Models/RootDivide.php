<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RootDivide extends Model
{
    use SoftDeletes, HasFactory;
    use AutoUuid;
    protected $guarded = ['id'];
}
