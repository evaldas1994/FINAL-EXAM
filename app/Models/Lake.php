<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
