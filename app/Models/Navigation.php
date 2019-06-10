<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Menu
 *
 * @package App\Models
 */
class Navigation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'position'
    ];

    /**
     * @return BelongsTo|null
     */
    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return BelongsTo
     */
    public function navigation(): BelongsTo
    {
        return $this->belongsTo(Navigation::class);
    }
}
