<?php

use App\Domains\Webinar\Controllers\AdminWebinarsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'      => 'admin',
    'middleware' => [
        'auth',
        'admin',
    ],
], function () {
    Route::group(['prefix' => 'webinars'], function () {
        Route::get('/', AdminWebinarsController::class . '@index')->name('admin.webinar.index');
        Route::get('/create', AdminWebinarsController::class . '@create')->name('admin.webinar.create');
        Route::post('/', AdminWebinarsController::class . '@store')->name('admin.webinar.store');
        Route::get('/{webinar}', AdminWebinarsController::class . '@edit')->name('admin.webinar.edit');
        Route::post('/{webinar}', AdminWebinarsController::class . '@patch')->name('admin.webinar.patch');
        Route::delete('/{webinar}', AdminWebinarsController::class . '@destroy')->name('admin.webinar.destroy');
    });
});