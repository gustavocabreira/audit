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

    $user = User::factory()->create();
    Post::factory()->create([
        'user_id' => $user->id,
        'published_at' => now()->subDay(),
        'is_published' => false,
    ]);

    artisan('post:publish');
    assertDatabaseHas('posts', [
        'id' => 1,
        'is_published' => true,
    ]);
});

it('should send a post created successfully notification', function () {
    Notification::fake();

    $user = User::factory()->create();
    Post::factory()->create([
        'user_id' => $user->id,
        'published_at' => now()->subDay(),
        'is_published' => false,
    ]);

    artisan('post:publish');
    Notification::assertSentTo($user, PostCreatedSuccessfully::class);
});
