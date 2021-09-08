<?php

namespace App\Services;

class TicketService
{
    public function is_records_exists($lakes): bool
    {
        return count($lakes) > 0;
    }

    public function is_record_exists($lakes): bool
    {
        return $lakes !== null;
    }
}
