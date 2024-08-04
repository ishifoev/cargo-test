<?php

namespace Modules\Cargo\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Cargo\Events\CargoCreatedEvent;
use Modules\Cargo\Events\CargoUpdatedEvent;
use Modules\Cargo\Listeners\SendCargoCreatedNotification;
use Modules\Cargo\Listeners\SoftDeleteCargo;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CargoCreatedEvent::class => [
            SendCargoCreatedNotification::class,
        ],
        CargoUpdatedEvent::class => [
            SoftDeleteCargo::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
