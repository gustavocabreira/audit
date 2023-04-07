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
        $this->withProgressBar(Post::isScheduled()->get(), fn(Post $post) => PublishPostJob::dispatch($post));
    }
}
