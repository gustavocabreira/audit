<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static isScheduled()
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function publish(): bool
    {
        return $this->update(['is_published' => true]);
    }

    public function scopeIsPublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeIsScheduled($query)
    {
        return $query->where('is_published', 0)->whereDate('published_at', '<=', now());
    }
}
