<?php

namespace App\Console\Commands;

use App\Jobs\PublishPostJob;
use App\Models\Post;
use Illuminate\Console\Command;

class PostPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $posts = Post::query()
            ->where('published', 0)
            ->whereDate('published_at', '<=', now())
            ->get();

        $this->withProgressBar($posts, fn(Post $post) => PublishPostJob::dispatch($post));
    }
}
