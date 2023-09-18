<?php declare(strict_types=1); 

namespace App\Jobs;

use App\Events\CargoCreatedEvent;
use App\Events\CargoUpdatedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Cargo;

class ProcessCargo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cargoData;

    public function __construct(array $cargoData)
    {
        $this->cargoData = $cargoData;
    }

    public function handle()
    {
        //Производите обработку данных и создайте груз или обновите груз
        //в зависимости от наличия груза в базе отправить нужно в Event

        $cargoId = $this->cargoData["id"];
        $cargoWeight = $this->cargoData["weight"];
        $cargoVolume = $this->cargoData["volume"];
        $cargoTruck = $this->cargoData["truck"];

        $existingCargo = Cargo::find($cargoId);

        if($existingCargo) {
            $existingCargo->update([
                "id" => $cargoId,
                'weight' => $cargoWeight,
                'volume'=> $cargoVolume,
                'truck' => $cargoTruck
            ]);
            event(new CargoUpdatedEvent($existingCargo));
        } else {
            $newCargo = Cargo::create([
                "id" => $cargoId,
                "weight" => $cargoWeight,
                "volume" => $cargoVolume,
                "truck" => $cargoTruck
            ]);
            //dd($newCargo);
            event(new CargoCreatedEvent($newCargo));
        }
    }
}
