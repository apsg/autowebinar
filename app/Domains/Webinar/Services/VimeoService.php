<?php

namespace App\Domains\Webinar\Services;

use Illuminate\Support\Arr;

class VimeoService
{
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
