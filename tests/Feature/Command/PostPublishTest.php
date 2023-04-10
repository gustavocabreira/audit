<?php

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreatedSuccessfully;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\freezeTime;

it('should publish a post', function () {
    freezeTime();
    Notification::fake();

    $user = User::factory()->create();
    Post::factory()->create([
        'published_at' => now()->subDay(),
        'is_published' => false,
    ]);

    artisan('post:publish');
    Notification::assertSentTo($user, PostCreatedSuccessfully::class);
    assertDatabaseHas('posts', [
        'id' => 1,
        'is_published' => true,
    ]);
});

todo('should send a post created successfully notification');
