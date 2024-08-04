<?php

declare(strict_types=1);

namespace Modules\Cargo\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Cargo\Entities\Cargo;

class CargoCreatedEvent
{
    use Dispatchable, SerializesModels;

    public Cargo $cargo;

    /**
     * Create a new event instance.
     *
     * @param Cargo $cargo
     * @return void
     */
    public function __construct(Cargo $cargo)
    {
        $this->cargo = $cargo;
    }
}
