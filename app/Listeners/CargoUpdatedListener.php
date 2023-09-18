<?php declare(strict_types=1); 

namespace App\Listeners;

use App\Events\CargoUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\DelayedCargoDeletion;

class CargoUpdatedListener
{
    use InteractsWithQueue;
    public function handle(CargoUpdatedEvent $event)
    {
        $cargo = $event->getCargo();

        dispatch(new DelayedCargoDeletion($cargo))->delay(now()->addMinutes(5));    
    }
}
