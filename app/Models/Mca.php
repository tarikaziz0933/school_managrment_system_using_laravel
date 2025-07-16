<?php
namespace App\Models;

use App\Traits\AutoUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Mca extends Model
{

    use AutoUuid, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'new_data'    => 'array',
        'old_data'    => 'array',
        'made_at'     => 'datetime',
        'modified_at' => 'datetime',
        'deleted_at'  => 'datetime',
        'checked_at'  => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function mcaable()
    {
        return $this->morphTo();
    }

    public function maker()
    {
        return $this->belongsTo(User::class, 'made_by');
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function authorizer()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public static function make(Model $target): Mca
    {
        $newData = $target->getAttributes(); // ← convert to array
        // $oldData = $target->getOriginal();

        $mca = Mca::create([
            'mcaable_id'   => $target->id,
            'mcaable_type' => get_class($target),
            'new_data'     => json_encode($newData),
            'status'       => 'pending',
            'made_by'      => Auth::id(),
            'made_at'      => now(),
        ]);

        return $mca;
    }

 public static function modify(Model $target): void
{
    $newData = $target->getAttributes(); // array

    $mca = Mca::where('mcaable_id', $target->id)->first();

    $oldData = json_decode($mca?->new_data, true); // ✅ fix here

    $mca?->update([
        'new_data'    => json_encode($newData),
        'old_data'    => json_encode($oldData),
        'diff_data'   => json_encode(array_diff_assoc($newData, $oldData)),
        'status'      => 'pending',
        'modified_by' => Auth::id(),
        'modified_at' => now(),
    ]);
}

}
