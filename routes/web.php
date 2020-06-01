<?php

use App\Domains\Chat\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', HomeController::class . '@index')->name('home');

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::get('/', ChatController::class . '@index');
    Route::get('messages', ChatController::class . '@fetchMessages');
    Route::post('messages', ChatController::class . '@sendMessage');
});
