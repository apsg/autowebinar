<?php

use App\Domains\Chat\Controllers\ChatController;
use App\Domains\Webinar\Controllers\WebinarController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/home', HomeController::class . '@index')->name('home');

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::get('/', ChatController::class . '@index');
    Route::get('messages', ChatController::class . '@fetchMessages');
    Route::post('messages', ChatController::class . '@sendMessage');
});

Route::get('/', WebinarController::class . '@index')->name('webinar.index');
Route::get('/webinar/{webinar}', WebinarController::class . '@show')->name('webinar.show');
Route::post('/webinar/{webinar}/subscribe', WebinarController::class . '@subscribe')
    ->name('webinar.subscribe');

Route::group(['prefix' => 'webinar', 'middleware' => 'auth'], function () {
    Route::get('/{webinar}/messages', ChatController::class . '@index');
    Route::get('/{webinar}/messages', ChatController::class . '@fetchMessages');
    Route::post('/{webinar}/messages', ChatController::class . '@sendMessage');
});
