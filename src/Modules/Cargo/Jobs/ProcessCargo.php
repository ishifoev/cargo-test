<?php

declare(strict_types=1);

namespace Modules\Cargo\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Api\Services\ClientService;
use Modules\Cargo\Entities\Cargo;
use Modules\Cargo\Events\CargoCreatedEvent;
use Modules\Cargo\Events\CargoUpdatedEvent;

class ProcessCargo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function handle()
    {
        // Получаем первые 2 страницы данных
        $data = $this->clientService->getFirstPages(2);

        foreach ($data as $cargoData) {
            $cargo = Cargo::find($cargoData['id']);

            if ($cargo) {
                $cargo->update($cargoData);
                event(new CargoUpdatedEvent($cargo));
            } else {
                $newCargo = Cargo::create($cargoData);
                event(new CargoCreatedEvent($newCargo));
            }
        }
    }
}
