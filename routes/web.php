<?php

use App\Http\Controllers\TitleCacheController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TitleMongoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rotas MariaDB
Route::resource('title', TitleController::class)->except(['show', 'create', 'edit']);
Route::get('title/get', [TitleController::class, 'get']);

//Rotas Redis
Route::resource('title/redis', TitleCacheController::class)->except(['show', 'create', 'edit']);
Route::get('title/redis/get', [TitleCacheController::class, 'get']);

//Rotas MongoDB
Route::resource('title/mongo', TitleMongoController::class)->except(['show', 'create', 'edit']);
Route::get('title/mongo/get', [TitleMongoController::class, 'get']);