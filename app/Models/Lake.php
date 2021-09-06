<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lake extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'region_id'
    ];
}
