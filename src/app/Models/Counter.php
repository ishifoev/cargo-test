<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = ['table', 'count'];

    public static function updateCount($table, $increment = 0)
    {
        $counter = static::firstOrNew(["table" => $table]);
        $counter->count+= $increment;
        $counter->save();
    }
}
