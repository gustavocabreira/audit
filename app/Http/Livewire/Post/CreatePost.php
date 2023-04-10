<?php

namespace App\Http\Livewire\Post;

use App\Jobs\SendPostCreatedSuccessfullyNotification;
use App\Notifications\PostCreatedSuccessfully;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreatePost extends Component
{
    public ?string $title = null;
    public ?string $body = null;
    public ?string $publish_date = null;

    public array $rules = [
        'title' => ['required'],
        'body' => ['required'],
    ];

    public function mount(): void
    {
        $this->publish_date = now()->format('Y-m-d');
    }

    public function create()
    {
        $this->validate();

        $isNotScheduled = now()->startOfDay()->timestamp === Carbon::createFromDate($this->publish_date)->startOfDay()->timestamp;

        $payload = [
            'title' => $this->title,
            'body' => $this->body,
            'published_at' => $this->publish_date,
            'is_published' => $isNotScheduled,
        ];

        auth()->user()->posts()->create($payload);

        if ($isNotScheduled) SendPostCreatedSuccessfullyNotification::dispatch(auth()->user());

        $this->emit('createdPost');
        $this->reset('body', 'title');
        $this->publish_date = now()->format('Y-m-d');
    }

    public function render(): View
    {
        return view('livewire.post.create-post');
    }
}
