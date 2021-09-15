<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find(int $id)
 * @method static orderBy(string $string)
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
        return $this->hasMany(Lake::class)->orderBy('name');
    }
}
