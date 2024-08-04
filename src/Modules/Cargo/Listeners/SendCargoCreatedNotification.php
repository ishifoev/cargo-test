<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Cargo\Events\CargoCreatedEvent;
use Modules\Cargo\Mail\CargoCreated;
use Modules\Cargo\Entities\Counter;

class SendCargoCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \Modules\Cargo\Events\CargoCreatedEvent  $event
     * @return void
     */
    public function handle(CargoCreatedEvent $event)
    {
        // Отправка уведомления по электронной почте
        Mail::to('recipient@example.com')->send(new CargoCreated($event->cargo));

        // Увеличение счетчика при создании нового груза
        Counter::incrementCount('cargos');

    }
}
