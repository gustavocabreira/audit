<?php

namespace App\Observers;

use App\Jobs\UserAuditJob;
use App\Models\Audit;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        UserAuditJob::dispatch([
            'event' => 'created',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => $user->toArray(),
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);
    }

    public function updated(User $user): void
    {
        $old = [];

        foreach ($user->getDirty() as $key => $value) {
            $old[$key] = $user->getOriginal($key);
        }

        UserAuditJob::dispatch([
            'event' => 'updated',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => [
                'old' => $old,
                'new' => $user->toArray(),
            ],
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);
    }

    public function deleted(User $user): void
    {
        UserAuditJob::dispatch([
            'event' => 'deleted',
            'user_id' => auth()->id(),
            'when' => now(),
            'details' => $user->toArray(),
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);
    }
}
