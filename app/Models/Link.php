<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 */
class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'display_name', 'password', 'avatar', 'url',
    ];
}
