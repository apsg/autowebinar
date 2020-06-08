<?php

use App\Domains\Chat\Controllers\ChatController;
use App\Domains\Webinar\Controllers\WebinarController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/home', HomeController::class . '@index')->name('home');

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::get('/', ChatController::class . '@index');
    Route::get('messages', ChatController::class . '@fetchMessages');
    Route::post('messages', ChatController::class . '@sendMessage');
});

Route::get('/', WebinarController::class . '@index')->name('webinar.index');

Route::group(['prefix' => 'webinar'], function () {
    Route::get('/{webinar}', WebinarController::class . '@show')->name('webinar.show');
    Route::post('/{webinar}/subscribe', WebinarController::class . '@subscribe')
        ->name('webinar.subscribe');
    Route::get('/{webinar}/l/{token}', WebinarController::class . '@login')
        ->name('webinar.login');
});

Route::group(['prefix' => 'webinar', 'middleware' => 'auth'], function () {
    Route::get('/{webinar}/messages', ChatController::class . '@index');
    Route::get('/{webinar}/messages', ChatController::class . '@fetchMessages');
    Route::post('/{webinar}/messages', ChatController::class . '@sendMessage');
});
