<?php

namespace App\Console\Commands;

use App\Jobs\PublishPostJob;
use App\Models\Post;
use Illuminate\Console\Command;

class PostPublish extends Command
{
    protected $signature = 'post:publish';

    protected $description = 'Insert posts that must be published on a queue';

    public function handle(): void
    {
        $posts = Post::query()
            ->where('published', 0)
            ->whereDate('published_at', '<=', now())
            ->get();

        $this->withProgressBar($posts, fn(Post $post) => PublishPostJob::dispatch($post));
    }
}
