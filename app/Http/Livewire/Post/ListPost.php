<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ListPost extends Component
{
    use AuthorizesRequests;

    public $posts;
    public $scheduledPosts;

    protected $listeners = ['createdPost' => 'refreshPosts'];

    public function mount(): void
    {
        $this->posts = Post::with('author')->isPublished()->latest()->get();
        $this->scheduledPosts = Post::with('author')->isScheduled()->latest()->get();
    }

    public function render(): View
    {
        return view('livewire.post.list-post');
    }

    public function refreshPosts(): void
    {
        $this->posts = Post::with('author')->isPublished()->latest()->get();
        $this->scheduledPosts = Post::with('author')->isScheduled()->latest()->get();
    }
}
