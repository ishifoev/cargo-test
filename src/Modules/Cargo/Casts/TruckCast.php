<?php

declare(strict_types=1);

namespace Modules\Cargo\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Modules\Cargo\DTOs\TruckDto;

class TruckCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return new TruckDto(json_decode($value, true));
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof TruckDto) {
            $value = $value->toArray();
        }

        return json_encode($value);
    }
}
