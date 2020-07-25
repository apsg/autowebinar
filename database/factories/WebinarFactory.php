<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Webinar::class, function (Faker $faker) {
    return [
        'name'         => $faker->title,
        'description'  => $faker->paragraph,
        'video'        => $faker->url,
        'scheduled_at' => Carbon::now()->addMinutes(rand(1, 100)),
        'length'       => rand(10, 200),
        'repeat'       => null,
    ];
});
