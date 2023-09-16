<?php

namespace Modules\Api\Services;
 
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ApiClientService
{
    protected $httpClient;
 
    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.cargo.tech/',
        ]);
    }
 
    public function getSingleRecord($id): Collection
    {
        try {
            // Реализация запроса для получения одной записи
            $response = $this->httpClient->get("/v1/cargos/{$id}");
            
            if ($response->getStatusCode() !== 200) {
                // Обработка ошибочных статус-кодов API, например, 404 Not Found
                Log::error('API returned an error: ' . $response->getStatusCode());
                // Можно сгенерировать свое исключение или вернуть пустую коллекцию
                return new Collection([]);
            }
 
            $data = json_decode($response->getBody()->getContents(), true);
            return new Collection($data);
        } catch (GuzzleException $e) {
            // Обработка ошибок Guzzle (например, сетевые ошибки)
            Log::error('Error while fetching API data: ' . $e->getMessage());
            // Можно сгенерировать свое исключение или вернуть пустую коллекцию
            return new Collection([]);
        } catch (\Exception $e) {
            // Обработка других исключений
            Log::error('An unexpected error occurred: ' . $e->getMessage());
            // Можно сгенерировать свое исключение или вернуть пустую коллекцию
            return new Collection([]);
        }
    }

    public function getFirstFivePages(): Collection
    {
        return cache()->remember('first_five_pages', now()->addMinutes(5), function () {
            $data = [];
 
            try {
                for ($page = 1; $page <= 5; $page++) {
                    $response = $this->httpClient->get("/v1/cargos?page={$page}&limit={$page}");
                    $pageData = json_decode($response->getBody()->getContents(), true);
                    $data = array_merge($data, $pageData);
                }
            } catch (GuzzleException $e) {
                // Обработка ошибок Guzzle (например, сетевые ошибки)
                Log::error('Error while fetching API data: ' . $e->getMessage());
                // Можно сгенерировать свое исключение или вернуть пустую коллекцию
                return new Collection([]);
            } catch (\Exception $e) {
                // Обработка других исключений
                Log::error('An unexpected error occurred: ' . $e->getMessage());
                // Можно сгенерировать свое исключение или вернуть пустую коллекцию
                return new Collection([]);
            }
 
            return new Collection($data);
        });
    }

    public function getAllPages(): Collection
    {
        return cache()->remember('all_pages', now()->addMinutes(5), function () {
            $data = [];
            $perPage = 100; // Максимальное количество записей на странице
            $currentPage = 1;
 
            try {
                do {
                    $response = $this->httpClient->get("/v1/cargos?page={$currentPage}&limit={$perPage}");
                    $pageData = json_decode($response->getBody()->getContents(), true);
                    $data = array_merge($data, $pageData);
                    $currentPage++;
 
                } while (!empty($pageData));
            } catch (GuzzleException $e) {
                // Обработка ошибок Guzzle (например, сетевые ошибки)
                Log::error('Error while fetching API data: ' . $e->getMessage());
                // Можно сгенерировать свое исключение или вернуть пустую коллекцию
                return new Collection([]);
            } catch (\Exception $e) {
                // Обработка других исключений
                Log::error('An unexpected error occurred: ' . $e->getMessage());
                // Можно сгенерировать свое исключение или вернуть пустую коллекцию
                return new Collection([]);
            }
 
            return new Collection($data);
        });
    }
}