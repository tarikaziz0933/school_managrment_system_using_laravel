<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{

    use SoftDeletes, HasFactory;
    use AutoUuid;

    protected $table = "classes";

    protected $guarded = ['id'];
}
