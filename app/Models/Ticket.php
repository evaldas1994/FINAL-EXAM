<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'name',
        'surname',
        'email',
        'serial_number',
        'valid_from',
        'valid_to',
        'price',
        'rods'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
