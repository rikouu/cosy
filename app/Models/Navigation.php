<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Menu
 *
 * @property Collection menus
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
     * @return HasMany
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     *
     */
    public function render()
    {
        return view('components.menus.items', ['items' => $this->menus]);
    }

}
