<?php
namespace Tests\Unit;

use App\Domains\Webinar\Models\Webinar;
use App\Domains\Webinar\Services\VimeoService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group database
 * @group slow
 * @group external
 */
class VimeoServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @dataProvider urlDataProvider
     */
    public function it_gets_correct_video_id_from_url($url)
    {
        // given url

        // when
        $id = VimeoService::getVideoId($url);

        // then
        $this->assertEquals(123, $id);
    }

    public function urlDataProvider()
    {
        return [
            ['https://vimeo.com/123'],
            ['https://player.vimeo.com/video/123'],
            ['https://player.vimeo.com/video/123?t=345'],
        ];
    }

    /** @test */
    public function it_gets_details_from_vimeo_video()
    {
        // given
        $id = '424890458';

        // when
        $data = VimeoService::getVideoDetails($id);
        $duration = VimeoService::getDuration($id);

        // then
        $this->assertNotEmpty($data);
        $this->assertTrue(is_array($data));
        $this->assertArrayHasKey('body', $data);
        $this->assertEquals(136, $duration);
    }

    /** @test */
    public function it_autocompletes_video_duration_after_webinar_is_created()
    {
        // given
        $url = 'https://player.vimeo.com/video/424890458';

        // when
        /** @var Webinar $webinar */
        $webinar = Webinar::create([
            'name'         => 'test',
            'description'  => 'test',
            'video'        => $url,
            'scheduled_at' => Carbon::now()->addMinutes(10),
        ]);

        $webinar = $webinar->fresh();

        // then
        $this->assertNotEmpty($webinar->length);
        $this->assertEquals(136, $webinar->length);
    }
}
