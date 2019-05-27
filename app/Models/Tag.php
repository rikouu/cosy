<?php

namespace App\Models;

use App\Models\Traits\Sluggable;

class Tag extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image', 'description',
    ];
}
