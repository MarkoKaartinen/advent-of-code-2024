<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DayConstructor
{
    public static function construct($data, $day): Collection
    {
        $return = $data;
        if (! is_a($data, Collection::class)) {
            $return = collect(Str::of(Storage::disk('inputs')->get('day' . $day . '.txt'))->explode("\n"));
        }

        return $return;
    }
}
