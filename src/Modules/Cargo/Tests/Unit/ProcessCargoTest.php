<?php

declare(strict_types=1);

namespace Modules\Cargo\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Api\Services\ClientService;
use Modules\Cargo\Jobs\ProcessCargo;
use Tests\TestCase;
use Modules\Cargo\Entities\Cargo;

class ProcessCargoTest extends TestCase
{
    use RefreshDatabase;

    public function testProcessCargoJob()
    {
        $clientService = $this->createMock(ClientService::class);
        $clientService->method('getFirstPages')->willReturn(collect([
            ['id' => 1, 'weight' => 100, 'volume' => 50, 'truck' => ['tir' => true]],
            ['id' => 2, 'weight' => 200, 'volume' => 100, 'truck' => ['tir' => false]],
        ]));

        $job = new ProcessCargo($clientService);
        $job->handle();

        $this->assertDatabaseHas('cargos', ['id' => 1, 'weight' => 100]);
        $this->assertDatabaseHas('cargos', ['id' => 2, 'weight' => 200]);
    }
}
