<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Posts extends Component
{
    public $perPage = 1;

    public function loadMorePosts()
    {
        $this->perPage += 1;
        $this->emit('loadOwlCarousel');
    }
    
    public function toggleLike()
    {
        
    }

    public function render()
    {
        $publicaciones = Post::where(function($query) {
            return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
        })
        ->orderby('created_at', 'DESC')
        ->paginate($this->perPage);
        
        
        return view('livewire.posts', compact('publicaciones'));
    }
}
