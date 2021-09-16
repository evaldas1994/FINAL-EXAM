<?php

namespace App\Services;

class TicketService extends Service
{
    static function wordsToFirstLetterUpper($text)
    {
        $words = explode(' ', $text);

        for ($i = 0; $i < count($words); $i++) {
            $words[$i] = self::toFirstLetterUpper($words[$i]);
        }

        return implode(' ', $words);
    }
}
