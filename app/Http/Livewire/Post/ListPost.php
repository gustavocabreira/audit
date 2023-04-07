<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListPost extends Component
{
    public $posts;

    protected $listeners = ['createdPost' => 'refreshPosts'];

    public function mount(): void
    {
        $this->posts = Post::with('author')->latest()->get();
    }

    public function render(): View
    {
        return view('livewire.post.list-post');
    }

    public function refreshPosts(): void
    {
        $this->posts = Post::with('author')->latest()->get();
    }
}
