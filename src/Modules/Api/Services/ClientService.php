<?php

declare(strict_types=1);

namespace Modules\Api\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ClientService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.cargo.tech/v1';
    }

    public function getCargo(int $id): Collection
    {
        $response = Http::get("{$this->baseUrl}/cargos/{$id}");
        $data = $response->json();
        return collect($data['data'] ?? []);
    }

    public function getFirstPages(int $limit = 100): Collection
    {
        $data = collect();
        for ($i = 0; $i < 5; $i++) {
            $offset = $i * $limit;
            $response = Http::get("{$this->baseUrl}/cargos", [
                'limit' => $limit,
                'offset' => $offset,
            ]);

            $responseData = $response->json();

            if (isset($responseData['data'])) {
                $data = $data->merge($responseData['data']);
            }
        }
        return $data;
    }

    public function getAllPages(int $limit = 100): Collection
    {
        $data = collect();
        $offset = 0;

        do {
            $response = Http::get("{$this->baseUrl}/cargos", [
                'limit' => $limit,
                'offset' => $offset,
            ]);

            $responseData = $response->json();
            if (isset($responseData['data'])) {
                $fetchedData = $responseData['data'];
                $data = $data->merge($fetchedData);
                $offset += $limit;
            } else {
                $fetchedData = [];
            }

        } while (count($fetchedData) === $limit);

        return $data;
    }
}
