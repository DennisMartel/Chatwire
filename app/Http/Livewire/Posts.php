<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Posts extends Component
{
    public $perPage = 1;

    protected $listeners = ['render'];

    public function loadMorePosts()
    {
        $this->perPage += 1;
        $this->emit('loadOwlCarousel');
    }
    
    public function toggleLike($publicacionId)
    {
        $publicacion = Post::find($publicacionId);

        if (!$publicacion) 
        {
            $this->emit('alert', 'Lo sentimos, no se ha encontrado coincidencias con la publicación');    
        }

        if (!Auth::user()->isFriendsWith($publicacion->user)) 
        {
            $this->emit('alert', 'Lo sentimos, para reaccionar a la publicación debes de ser amigo con ' . Auth::user()->name);        
        }

        if (Auth::user()->hasLikedPost($publicacion) == true) 
        {
            Auth::user()->deleteLike($publicacion);
        } 
        else 
        {
            Auth::user()->addLike($publicacion);
        }

        $this->emitTo('posts', 'render');
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
