<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodGroup extends Model
{
    use SoftDeletes, HasFactory;
    // protected $fillable = ['name', 'description'];
    protected $guarded = [];

}
