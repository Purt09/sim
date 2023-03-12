<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Country
$methods = ['index', 'create', 'edit', 'store', 'update', 'destroy'];
$prefix = 'admin/';
Route::resource($prefix . 'countries', \App\Http\Controllers\Admin\CountryController::class)
    ->only($methods)->names('admin.countries');
Route::get($prefix . 'countries/delete', [\App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('admin.countries.delete');
// Users
$methods = ['index', 'create', 'edit', 'store', 'update', 'destroy'];
Route::resource($prefix . 'users', \App\Http\Controllers\Admin\UserController::class)
    ->only($methods)->names('admin.users');
// Operators
Route::get($prefix . 'operators/gets/{country}', [\App\Http\Controllers\Admin\OperatorController::class, 'gets'])->name('admin.operator.gets');
// bots
$methods = ['index', 'create', 'edit', 'store', 'update', 'destroy'];
Route::resource($prefix . 'bots', \App\Http\Controllers\Admin\BotController::class)
    ->only($methods)->names('admin.bots');


// Проверка API
Route::get('sim/balance', [\App\Http\Controllers\SimController::class, 'balance']);
Route::get('sim/test', [\App\Http\Controllers\SimController::class, 'test']);
Route::get('sim/countries', [\App\Http\Controllers\SimController::class, 'countries']);

// API для фронта:
Route::get('countries', [\App\Http\Controllers\ApiController::class, 'countries']);
Route::get('getResources', [\App\Http\Controllers\ApiController::class, 'resources']);
Route::get('operators', [\App\Http\Controllers\ApiController::class, 'operators']);
Route::get('getUser', [\App\Http\Controllers\ApiController::class, 'getUser']);
Route::get('setCountry', [\App\Http\Controllers\ApiController::class, 'setCountry']);
Route::get('setOperator', [\App\Http\Controllers\ApiController::class, 'setOperator']);
Route::get('setLanguage', [\App\Http\Controllers\ApiController::class, 'setLanguage']);
Route::get('services', [\App\Http\Controllers\ApiController::class, 'services']);


// API для модуля:
Route::get('ping', [\App\Http\Controllers\BotController::class, 'ping']);
Route::get('create', [\App\Http\Controllers\BotController::class, 'create']);
Route::get('error', [\App\Http\Controllers\BotController::class, 'error']);
Route::get('get', [\App\Http\Controllers\BotController::class, 'get']);
Route::post('update', [\App\Http\Controllers\BotController::class, 'update']);
