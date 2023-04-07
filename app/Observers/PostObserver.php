<?php

namespace App\Observers;

use App\Jobs\PostAuditJob;
use App\Models\Post;

class PostObserver
{
    public function created(Post $post): void
    {
        PostAuditJob::dispatch([
            'event' => 'created',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => $post->toArray(),
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
        ]);
    }

    public function updated(Post $post): void
    {
        $old = [];

        foreach ($post->getDirty() as $key => $value) {
            $old[$key] = $post->getOriginal($key);
        }

        PostAuditJob::dispatch([
            'event' => 'updated',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => [
                'old' => $old,
                'new' => $post->toArray(),
            ],
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
        ]);
    }

    public function deleted(Post $post): void
    {
        PostAuditJob::dispatch([
            'event' => 'deleted',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => $post->toArray(),
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
        ]);
    }
}
