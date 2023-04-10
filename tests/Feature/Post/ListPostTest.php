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

it('user can not see update button when the post does not belongs to him', function () {
    // Arrange
    $postUser = User::factory()->create();
    $anotherUser = User::factory()->create(['email' => 'anotheruser@email.com']);
    actingAs($anotherUser);

    // Act
    $lw = livewire(ListPost::class);

    // Assert
    $lw->assertDontSee('Update');
});

todo('user can not delete posts that does not belongs to him');
