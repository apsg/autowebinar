<?php
namespace Database\Factories;

use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebinarFactory extends Factory
{
    protected $model = Webinar::class;

    public function definition(): array
    {
        return [
            'name'         => $this->faker->title,
            'description'  => $this->faker->paragraph,
            'video'        => $this->faker->url,
            'scheduled_at' => Carbon::now()->addMinutes(rand(1, 100)),
            'length'       => rand(10, 200),
            'repeat'       => null,
        ];
    }
}
