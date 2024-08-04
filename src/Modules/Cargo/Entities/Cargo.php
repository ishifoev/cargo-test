<?php

declare(strict_types=1);

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Cargo\Casts\TruckCast;

class Cargo extends Model
{
    protected $fillable = ['id', 'weight', 'volume', 'truck'];

    protected $casts = [
        'truck' => TruckCast::class,
        'weight' => 'integer',
        'volume' => 'decimal:2',
    ];
}
