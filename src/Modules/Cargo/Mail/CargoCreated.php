<?php

namespace Modules\Cargo\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Cargo\Entities\Cargo;

class CargoCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Cargo $cargo;

    public function __construct(Cargo $cargo)
    {
        $this->cargo = $cargo;
    }

    public function build()
    {
        return $this->view('emails.cargo.created')
                    ->with(['cargo' => $this->cargo]);
    }
}
