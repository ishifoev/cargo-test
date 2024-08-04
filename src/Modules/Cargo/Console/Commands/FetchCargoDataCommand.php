<?php

declare(strict_types=1);

namespace Modules\Cargo\Console\Commands;

use Illuminate\Console\Command;
use Modules\Cargo\Jobs\ProcessCargo;
use Modules\Api\Services\ClientService;

class FetchCargoDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cargo:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from Cargo API and dispatch jobs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Получаем экземпляр ClientService
        $clientService = app(ClientService::class);

        // Запускаем задание ProcessCargo
        ProcessCargo::dispatch($clientService);

        $this->info('ProcessCargo job dispatched successfully.');

        return 0;
    }
}
