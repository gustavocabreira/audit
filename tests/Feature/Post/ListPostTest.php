<?php

use App\Http\Livewire\Post\ListPost;
use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('should list all posts', function () {
    // Arrange
    $user = User::factory()->create();
    $post = $user->posts()->create(Post::factory()->make()->toArray());

    // Act
    $lw = livewire(ListPost::class);

    // Assert
    $lw->assertSee($post->title)
        ->assertSee($post->author->name);
});

test('user can not see update button when the post does not belongs to him', function () {
    // Arrange
    $postUser = User::factory()->create();
    $anotherUser = User::factory()->create(['email' => 'anotheruser@email.com']);
    actingAs($anotherUser);

    // Act
    $lw = livewire(ListPost::class);

    // Assert
    $lw->assertDontSee('Update');
});

test('user can not delete posts that does not belongs to him', function () {
    // Arrange
    $postUser = User::factory()->create();
    $anotherUser = User::factory()->create(['email' => 'anotheruser@email.com']);
    actingAs($anotherUser);

    // Act
    $lw = livewire(ListPost::class);

    // Assert
    $lw->assertDontSee('Delete0,');
});
