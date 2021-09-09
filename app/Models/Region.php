<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find(int $id)
 */
class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function lakes(): HasMany
    {
        return $this->hasMany(Lake::class);
    }
}
