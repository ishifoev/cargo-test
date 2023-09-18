<?php declare(strict_types=1); 

namespace Modules\Cargo\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;


class CargoService
{

    protected $httpClient;
 
    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.cargo.tech/',
        ]);
    }
 
    public function fetchDataFromApi(): Collection
    {
        $data = [];
 
        try {
            // Loop through the first 2 pages of data
            for ($page = 1; $page <= 2; $page++) {
                // Send a GET request to the API for each page
                $response = $this->httpClient->get("/v1/cargos?page={$page}&limit={$page}");
 
                if ($response->getStatusCode() !== 200) {
                    Log::error('API returned an error: ' . $response->getStatusCode());
                    // You can handle the error as needed
                    continue; // Skip this page and continue with the next one
                }
 
                $pageData = json_decode($response->getBody()->getContents(), true);
                $data = array_merge($data, $pageData);
            }
        } catch (GuzzleException $e) {
            Log::error('Error while fetching API data: ' . $e->getMessage());
            // You can handle the error as needed
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred: ' . $e->getMessage());
            // You can handle the error as needed
        }
 
        return new Collection($data);
    }
}