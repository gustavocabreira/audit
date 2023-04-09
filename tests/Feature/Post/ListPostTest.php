<?php

use App\Http\Livewire\Post\ListPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('should list all posts', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();
    actingAs($user);

    // Act
    $lw = livewire(ListPost::class);

    // Assert
    $lw->assertSee($post->title)
        ->assertSee($post->author->name);
});

todo('user can only update posts that belongs to him');
todo('user can only delete posts that belongs to him');
