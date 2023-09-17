<?php declare(strict_types=1); 

namespace App\Console\Commands;

use App\Jobs\ProcessCargo;
use Illuminate\Console\Command;
use Modules\Cargo\Services\CargoService;

class ProcessCargoData extends Command
{
    
    protected $signature = 'cargo:process';
    protected $description = 'Process cargo data from API';

    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $cargoService = new CargoService();

        $data = $cargoService->fetchDataFromApi();

        foreach($data as $cargo) {
            dispatch(new ProcessCargo($cargo));
        }
    }
}
