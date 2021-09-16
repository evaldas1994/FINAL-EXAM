<?php

namespace App\Services;

class TicketService
{
    static function wordsToFirstLetterUpper($text)
    {
        $words = explode(' ', $text);
        
        for ($i = 0; $i < count($words); $i++) {
            $words[$i] = self::toFirstLetterUpper($words[$i]);
        }

        return implode(' ', $words);
    }

    static function toFirstLetterUpper($text): string
    {
        return strtoupper(substr($text, 0, 1)) . strtolower(substr($text, 1)); 
    }  
}
