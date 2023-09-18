<?php declare(strict_types=1); 

namespace App\Models;

use App\Casts\TrustCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cargo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id","weight", "volume", "truck"];

    public $incrementing = false;

    protected $casts = [
        "truck" => TrustCast::class
    ];

    protected $dates = ["deleted_at"];

    public function scopeBeltCountGreaterThan($query, $value)
    {
        return $query->where('truck->belt_count', '>', $value);
    }
 
    public function scopeBeltCountLessThan($query, $value)
    {
        return $query->where('truck->belt_count', '<', $value);
    }

    public function scopeTruckContains($query, $value)
    {
        return $query->whereRaw('truck @> ?', [$value]);
    }

    /*public function softDeleteAfterDelay(int $minutes = 5)
    {
        // Schedule the cargo for deletion after the specified delay
        DB::table($this->getTable())
            ->where('id', $this->id)
            ->update(['deleted_at' => now()->addMinutes($minutes)]);
    }*/
}
