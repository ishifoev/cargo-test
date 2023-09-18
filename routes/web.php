<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Services\ApiClientService;
use App\Models\Cargo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//$apiService = new ApiClientService();
 
// Получить одну запись
//$singleRecord = $apiService->getSingleRecord(100);


// Получить первые 5 страниц
//$firstFivePages = $apiService->getFirstFivePages();

// Получить все страницы
//$allPages = $apiService->getAllPages();
//dd($allPages);

// Найти записи, где truck.belt_count > 5
$cargos = Cargo::beltCountGreaterThan(5)->get();


 
// Найти записи, где truck.belt_count < 10
$cargos = Cargo::beltCountLessThan(10)->get();
 
// Найти записи, где truck содержит определенное значение (например, '{"tir":true}')
$cargos = Cargo::truckContains('{"tir":true}')->get();
//dd($cargos);
//exit;
    return view('welcome');
});
