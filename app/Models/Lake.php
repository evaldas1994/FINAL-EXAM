<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 * @method static find(int $id)
 */
class Lake extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'region_id'
    ];

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(
            Ticket::class,
            'tickets_lakes',
            'lake_id',
            'ticket_id');
    }
}
