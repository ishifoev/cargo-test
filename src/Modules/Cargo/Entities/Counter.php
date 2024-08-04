<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['table_name', 'count'];

    public static function incrementCount(string $table)
    {
        $counter = self::firstOrCreate(['table_name' => $table]);
        $counter->increment('count');
        $counter->save();
    }

    public static function decrementCount(string $table)
    {
        $counter = self::firstOrCreate(['table_name' => $table]);
        if ($counter->count > 0) {
            $counter->decrement('count');
        }
        $counter->save();
    }
}
