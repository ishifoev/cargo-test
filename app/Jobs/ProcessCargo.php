<?php declare(strict_types=1); 

namespace App\Jobs;

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

    public function __construct($cargoData)
    {
        $this->cargoData = $cargoData;
    }

    public function handle()
    {
        //Производите обработку данных и создайте груз или обновите груз
        //в зависимости от наличия груза в базе отправить нужно в Event

        $cargo = Cargo::firstOrNew(["id" => $this->cargoData["id"]]);
        $cargo->fill($this->cargoData);
        $cargo->save();
    }
}
