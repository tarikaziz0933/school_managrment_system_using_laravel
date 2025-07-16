<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes, HasFactory;
    use AutoUuid;
    protected $guarded = ['id'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }

    public function showGenderName()
    {
        return ucfirst($this->gender ?? 'Combined');
    }

    function totalStudents(){
        return $this->total_boys +  $this->total_girls;
    }

}
