<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as InterventionImage;

class CreatePost extends Component
{
    use WithFileUploads;

    public $body;
    public $images = [];

    public function render()
    {
        return view('livewire.create-post');
    }

    public function storePost()
    {
        $this->validate([
            'body' => 'required',
            'images' => 'required'
        ], [
            'body.required' => 'Agrega una breve descripción de tu publicación',
            'images.required' => 'Agrega al menos una imagen'
        ]);

        $publicacion = Auth::user()->posts()->create([
            'body' => trim($this->body),
        ]);
        
        $urlImages = [];
        foreach ($this->images as $image) {
            $fileName = date("d").'_'.time()."_".uniqid().".".$image->extension();
            $folder = "posts/".date('Y')."/".date("m");
            $url = $image->storeAs($folder, $fileName);
            $ruta=public_path('storage/'.$folder."/".$fileName);
            InterventionImage::make($image->getRealPath())->resize(640, 480)->save($ruta, 72);

            $urlImages[]['url'] = $url;
        }
        
        $publicacion->images()->createMany($urlImages);

        return redirect()->to('/');
    }
}
