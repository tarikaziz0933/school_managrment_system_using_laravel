<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoUuid;
    protected $guarded = ['id'];

    protected $casts = [
        'dob'         => 'date',
        'joined_at' => 'date',
        'entry_date'  => 'date',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_name', 'name');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function presentAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type_slug', Address::ADDRESS_TYPE_PRESENT);
    }

    public function permanentAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type_slug', Address::ADDRESS_TYPE_PERMANENT);
    }

    public function educations(): MorphMany
    {
        return $this->morphMany(Education::class, 'educationable');
    }

    public static function generateEmployeeId($joinedAt)
    {
        // Format join date as Ymd (e.g., 20250430)
        $formatted_join_date = date('Ymd', strtotime($joinedAt));

        // Get the max 2-digit serial for that date
        $max_id = Employee::whereRaw('LEFT(id_number, 8) = ?', [$formatted_join_date])
            ->selectRaw('MAX(CAST(RIGHT(id_number, 2) AS UNSIGNED)) as max_serial')
            ->first();

        // Calculate next serial number
        $next_serial = $max_id && $max_id->max_serial ? $max_id->max_serial + 1 : 1;

        // Ensure it's always 2 digits
        $serial = str_pad($next_serial, 2, '0', STR_PAD_LEFT);

        // Combine to make 10-digit employee ID
        return $formatted_join_date . $serial;
    }


    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

}
