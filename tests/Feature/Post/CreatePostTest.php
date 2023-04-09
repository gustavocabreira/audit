<?php

use App\Http\Livewire\Post\CreatePost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('should be able to create a new post', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $lw = livewire(CreatePost::class)
        ->set('title', 'Title')
        ->set('body', 'Body')
        ->set('publish_date', now()->format('Y-m-d'))
        ->call('create');

    // Assert
    $lw->assertHasNoErrors();
    assertDatabaseHas('posts', [
        'id' => 1,
        'user_id' => $user->id,
        'title' => 'Title',
        'body' => 'Body',
        'published_at' => now()->startOfDay()->format('Y-m-d H:i:s'),
        'is_published' => 1,
    ]);
});

test('body and title can not be empty', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $lw = livewire(CreatePost::class)
        ->set('title', null)
        ->set('body', null)
        ->set('publish_date', now()->format('Y-m-d'))
        ->call('create');

    // Assert
    $lw->assertHasErrors();
});

todo('should emmit a createdPost event');
todo('should send an email to the user that has created the post');
todo('should clear all fields after creating');
