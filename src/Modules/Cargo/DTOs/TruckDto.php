<?php

declare(strict_types=1);

namespace Modules\Cargo\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class TruckDto extends DataTransferObject
{
    public bool $tir = false;
    public bool $t1 = false;
    public bool $cmr = false;
    public ?int $belt_count = null;

    public function toArray(): array
    {
        return [
            'tir' => $this->tir,
            't1' => $this->t1,
            'cmr' => $this->cmr,
            'belt_count' => $this->belt_count,
        ];
    }
}
