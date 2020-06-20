<?php
namespace App\Helpers;

use Illuminate\Support\Arr;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class FractalHelper
{
    public static function toArray($data, TransformerAbstract $transformer) : array
    {
        $resource = new Collection($data, $transformer);

        return Arr::get(
            (new Manager())->createData($resource)->toArray(),
            'data',
            []
        );
    }
}