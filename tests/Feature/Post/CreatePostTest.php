<?php

use App\Http\Livewire\Post\CreatePost;
use App\Models\User;
use App\Notifications\PostCreatedSuccessfully;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
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

it('should emmit a createdPost event', function () {
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
    $lw->assertEmitted('createdPost');
});

it('should send an email to the user that has created the post', function () {
    // Arrange
    Notification::fake();
    $user = User::factory()->create();
    actingAs($user);

    // Act
    livewire(CreatePost::class)
        ->set('title', 'Title')
        ->set('body', 'Body')
        ->set('publish_date', now()->format('Y-m-d'))
        ->call('create');

    // Assert
    Notification::assertSentTo($user, PostCreatedSuccessfully::class, function ($notification) use ($user) {
        return $notification->toMail($user)->subject === 'Post created successfully';
    });
});

it('should clear all fields after creating', function () {
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
    $lw->assertSet('title', null)
        ->assertSet('body', null)
        ->assertSet('publish_date', now()->format('Y-m-d'));
});

todo('should create the audit job when creating a new post');
