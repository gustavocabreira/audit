<?php

use App\Http\Livewire\User\CreateUser;
use App\Jobs\UserAuditJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('should be able to create an user', function () {
    // Arrange
    Queue::fake();

    // Act
    livewire(CreateUser::class)
        ->set('name', 'Gustavo Cabreira')
        ->set('email', 'gustavo.softdev@gmail.com')
        ->set('password', 'password')
        ->call('create');

    // Assert
    $user = User::query()->first();
    expect(User::query()->count())->toBe(1)
        ->and($user->name)
        ->toBe('Gustavo Cabreira')
        ->and($user->email)
        ->toBe('gustavo.softdev@gmail.com');
    Queue::assertPushed(UserAuditJob::class);

});
todo('it should be able to list all user');
todo('it should be able to show an user');
todo('it should be able to update an user');
todo('it should be able to delete an user');
