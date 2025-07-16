<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationType extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'slug';
    public $incrementing = false; // Because slug is a string
    protected $keyType = 'string';

    const FATHER = 'father';
    const MOTHER = 'mother';
    const BORTHER = 'borther';
    const SISTER = 'sister';
    const UNCLE = 'uncle';

}
