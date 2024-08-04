<?php

declare(strict_types=1);

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Queue;
use Modules\Cargo\Events\CargoUpdatedEvent;
use Modules\Cargo\Jobs\SoftDeleteCargoJob;
use Modules\Cargo\Entities\Counter;

class SoftDeleteCargo implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(CargoUpdatedEvent $event)
    {
        // Планирование мягкого удаления через 5 минут
        dispatch(new SoftDeleteCargoJob($event->cargo))->delay(now()->addMinutes(5));
        // Уменьшение счетчика при мягком удалении груза
        Counter::decrementCount('cargos');
    }
}
