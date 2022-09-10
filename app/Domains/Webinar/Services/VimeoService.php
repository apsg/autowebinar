<?php

namespace App\Domains\Webinar\Services;

use Illuminate\Support\Arr;
use Vimeo\Laravel\Facades\Vimeo;

class VimeoService
{
    public static function getVideoDetails(string $id): array
    {
        return Vimeo::request('/videos/' . $id, [], 'GET');
    }

    public static function getDuration(string $videoId): int
    {
        return Arr::get(static::getVideoDetails($videoId), 'body.duration', 300);
    }

    public static function getVideoId(string $url)
    {
        $pattern = '/.+vimeo.com\/(.{0}|video\/)(?P<id>\d+)/';

        $matches = [];
        preg_match($pattern, $url, $matches);

        return Arr::get($matches, 'id', null);
    }

    public static function fixUrl(string $url)
    {
        return 'https://player.vimeo.com/video/' . static::getVideoId($url);
    }
}
