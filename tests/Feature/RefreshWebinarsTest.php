<?php
namespace Tests\Feature;

use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RefreshWebinarsTest extends TestCase
{
    use WithoutEvents;

    /** @test */
    public function it_refreshes_webinar_scheduled_date()
    {
        // given
        /** @var Webinar $webinar */
        $webinar = factory(Webinar::class)->create([
            'scheduled_at' => Carbon::now()->subMinutes(10),
            'length'       => 100,
            'repeat'       => '1 day',
        ]);

        /** @var Carbon $originalDate */
        $originalDate = clone $webinar->scheduled_at;

        // when
        Artisan::call('webinar:refresh');
        $webinar = $webinar->fresh();

        // then
        $this->assertNotEquals(
            $originalDate->timestamp,
            $webinar->scheduled_at->timestamp
        );

        $this->assertEquals(60 * 60 * 24,
            $originalDate->diffInSeconds($webinar->scheduled_at)
        );
    }

    /** @test */
    public function it_does_not_change_webinars_still_in_progress()
    {
        // given
        /** @var Webinar $webinar */
        $webinar = factory(Webinar::class)->create([
            'scheduled_at' => Carbon::now(),
            'length'       => 100,
            'repeat'       => '1 day',
        ]);

        /** @var Carbon $originalDate */
        $originalDate = clone $webinar->scheduled_at;

        // when
        Artisan::call('webinar:refresh');
        $webinar = $webinar->fresh();

        // then
        $this->assertEquals(
            $originalDate->timestamp,
            $webinar->scheduled_at->timestamp
        );
    }

    /**
     * @test
     * @dataProvider incorrectRepeats
     */
    public function it_handles_incorrect_values_for_repeat($repeat)
    {
        // given
        /** @var Webinar $webinar */
        $webinar = factory(Webinar::class)->create([
            'scheduled_at' => Carbon::now()->subMinutes(10),
            'length'       => 100,
            'repeat'       => $repeat,
        ]);

        /** @var Carbon $originalDate */
        $originalDate = clone $webinar->scheduled_at;

        // when
        Artisan::call('webinar:refresh');
        $webinar = $webinar->fresh();

        // then
        $this->assertNull($webinar->repeat);
        $this->assertEquals($originalDate, $webinar->scheduled_at);
    }

    public function incorrectRepeats()
    {
        return [
            [' '],
            [' 1sads dsfsawq2 23'],
            [-2],
        ];
    }

    /** @test */
    public function it_does_not_change_webinars_without_repeat()
    {
        // given
        /** @var Webinar $webinar */
        $webinar = factory(Webinar::class)->create([
            'scheduled_at' => Carbon::now()->subMinutes(10),
            'length'       => 100,
            'repeat'       => null,
        ]);

        /** @var Carbon $originalDate */
        $originalDate = clone $webinar->scheduled_at;

        // when
        Artisan::call('webinar:refresh');
        $webinar = $webinar->fresh();

        // then
        $this->assertNull($webinar->repeat);
        $this->assertEquals($originalDate, $webinar->scheduled_at);
    }
}