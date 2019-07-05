<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SearchHistory
 *
 * @package App\Models
 */
class SearchHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'query', 'search_date', 'search_count', 'description',
    ];

}
