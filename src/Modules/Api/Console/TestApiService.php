<?php

declare(strict_types=1);

namespace Modules\Api\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Api\Services\ClientService;

class TestApiService extends Command
{
   /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:test-service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to test the API service';

    /**
     * Execute the console command.
     */
    public function handle(ClientService $clientService): void
    {
        $this->info("Fetching first five pages of cargos...");
        $data = $clientService->getFirstPages(2);
        $this->info($data->toJson(JSON_PRETTY_PRINT));
    }
}
