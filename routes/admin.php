<?php

use App\Domains\Webinar\Controllers\AdminCtasController;
use App\Domains\Webinar\Controllers\AdminScheduledController;
use App\Domains\Webinar\Controllers\AdminWebinarsController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'admin',
    'middleware' => [
        'auth',
        AdminMiddleware::class,
    ],
], function () {
    Route::group(['prefix' => 'webinars'], function () {
        Route::get('/', AdminWebinarsController::class . '@index')->name('admin.webinar.index');
        Route::get('/create', AdminWebinarsController::class . '@create')->name('admin.webinar.create');
        Route::post('/', AdminWebinarsController::class . '@store')->name('admin.webinar.store');
        Route::get('/{webinar}', AdminWebinarsController::class . '@edit')->name('admin.webinar.edit');
        Route::post('/{webinar}', AdminWebinarsController::class . '@patch')->name('admin.webinar.patch');
        Route::delete('/{webinar}', AdminWebinarsController::class . '@destroy')->name('admin.webinar.destroy');
        Route::post('/{webinar}/restart', AdminWebinarsController::class . '@restart')->name('admin.webinar.restart');
        Route::get('/{webinar}/stats', AdminWebinarsController::class . '@stats')->name('admin.webinar.stats');

        Route::delete('/{webinar}/delete_messages', AdminWebinarsController::class . '@deleteMessages')
            ->name('admin.webinar.delete_messages');

        Route::group(['prefix' => '/{webinar}/scheduled'], function () {
            Route::post('/', AdminScheduledController::class . '@store')->name('admin.scheduled.store');
            Route::post('/import', AdminScheduledController::class . '@import')->name('admin.scheduled.import');
            Route::delete('/{message}', AdminScheduledController::class . '@destroy')->name('admin.scheduled.destroy');
        });
    });

    Route::group(['prefix' => 'ctas'], function () {
        Route::post('/', AdminCtasController::class . '@store')->name('admin.cta.store');
        Route::delete('/{cta}', AdminCtasController::class . '@destroy')->name('admin.cta.destroy');
    });
});
