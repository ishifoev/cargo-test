<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cargo;
use Illuminate\Support\Facades\Mail;

class CargoCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $cargo;

    public function __construct(Cargo $cargo)
    {
        $this->cargo = $cargo;
    }

    public function handle()
    {
        //$email = "your_email_address@mail.ru";

        //Mail::to($email)->send(new CargoCreatedNotification($this->cargo));
    }
}
