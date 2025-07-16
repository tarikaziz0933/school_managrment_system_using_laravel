<?php

namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{

    protected $table = 'educations';

    use SoftDeletes, HasFactory;
    use AutoUuid;

    protected $guarded = [];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function educationBoard(){
        return $this->belongsTo(EducationBoard::class, 'education_board_id', 'id');
    }


    public function educationable()
    {
        return $this->morphTo();
    }


}
