<?php

namespace App\Support;

use Illuminate\Support\Str;

class Helpers
{
    public static function randomString(int $length = 7): String
    {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $string;
    }
}
