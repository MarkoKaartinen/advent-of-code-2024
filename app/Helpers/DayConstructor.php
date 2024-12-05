<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DayConstructor
{
    public static function construct($data, $day, $type = 'collection'): Collection|string
    {
        $return = $data;
        if($type == 'collection'){
            if (! is_a($data, Collection::class)) {
                $return = collect(Str::of(Storage::disk('inputs')->get('day' . $day . '.txt'))->explode("\n"));
            }
        }
        if($type == 'string'){
            if($return == ''){
                $return = Storage::disk('inputs')->get('day' . $day . '.txt');
            }
        }

        return $return;
    }
}
