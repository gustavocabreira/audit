<?php

namespace App\Http\Livewire\Post;

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

        $payload = [
            'title' => $this->title,
            'body' => $this->body,
            'published_at' => $this->publish_date,
            'is_published' => now()->startOfDay()->timestamp === Carbon::createFromDate($this->publish_date)->startOfDay()->timestamp,
        ];

        auth()->user()->posts()->create($payload);
        
        $this->emit('createdPost');
        $this->title = null;
        $this->body = null;
        $this->publish_date = now()->format('Y-m-d');
    }

    public function render(): View
    {
        return view('livewire.post.create-post');
    }
}
