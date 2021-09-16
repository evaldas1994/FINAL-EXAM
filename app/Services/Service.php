<?php

namespace App\Services;

class Service
{
    static function toFirstLetterUpper($text): string
    {
        return strtoupper(substr($text, 0, 1)) . strtolower(substr($text, 1));
    }
}
