<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    const FATHER = 'father';
    const MOTHER = 'mother';
}
