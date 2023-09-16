<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Services\ApiClientService;
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
    $apiService = new ApiClientService();
 
// Получить одну запись
$singleRecord = $apiService->getSingleRecord(100);


// Получить первые 5 страниц
$firstFivePages = $apiService->getFirstFivePages();

dd($firstFivePages);

    return view('welcome');
});
