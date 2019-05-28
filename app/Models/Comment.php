<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'display_name', 'password', 'avatar', 'url',
    ];

    protected function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    protected function user(): ?BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
