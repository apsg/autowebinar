<?php
namespace Tests\Unit;

use App\Domains\Webinar\Services\VimeoService;
use Tests\TestCase;

class VimeoServiceTest extends TestCase
{
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
}