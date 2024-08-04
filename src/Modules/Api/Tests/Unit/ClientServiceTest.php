<?php

declare(strict_types=1);

namespace Modules\Api\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Api\Services\ClientService;

class ClientServiceTest extends TestCase
{
    protected ClientService $clientService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clientService = new ClientService();
    }

    public function testGetCargoExists()
    {
        $existingCargoId = 68612408; // Replace with a known existing cargo ID
        $cargo = $this->clientService->getCargo($existingCargoId);

        // Ensure the cargo is not empty
        $this->assertNotEmpty($cargo, "Expected cargo data for ID: $existingCargoId, but received an empty collection.");
        $this->assertEquals($existingCargoId, $cargo->get('id'), "The cargo ID should match the requested ID.");
    }

    public function testGetCargoDoesNotExist()
    {
        $nonExistentCargoId = 9999999; // Use a high number unlikely to exist
        $cargo = $this->clientService->getCargo($nonExistentCargoId);

        // Ensure the cargo is empty
        $this->assertTrue($cargo->isEmpty(), "Expected no cargo data for ID: $nonExistentCargoId, but data was returned.");
    }


}
