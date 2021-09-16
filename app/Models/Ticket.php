<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function lakes(): BelongsToMany
    {
        return $this->belongsToMany(
            Lake::class,
            'tickets_lakes',
            'ticket_id',
            'lake_id'
        );
    }
}
