<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Str;

class EditPost extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;
    
    public $images = [];
    public $publicacion;
    public $body;

    protected $rules = [
        'publicacion.body' => 'required',
    ];

    protected $messages = [
        'publicacion.body.required' => 'Agrega una breve descripción de tu publicación',
    ];

    public function mount(Post $post)
    {
        $this->publicacion = $post;
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function updatePost()
    {
        $this->authorize('myPost', $this->publicacion);

        $this->validate();

        $this->publicacion->update([
            'body' => trim($this->publicacion->body)
        ]);

        if ($this->images) 
        {
            $imagenesActuales = $this->publicacion->images()->pluck('url');
            
            foreach ($imagenesActuales as $imagenActual) 
            {
                Storage::delete($imagenActual);
            }

            $this->publicacion->images()->delete();

            $urlImages = [];
            $extensionesValidas = ['jpg', 'png', 'jpeg'];

            foreach ($this->images as $image) 
            {
                if (in_array($image->extension(), $extensionesValidas)) 
                {
                    $fileName = date("d").'_'.time()."_".uniqid().".".$image->extension();
                    $folder = "posts/".date('Y')."/".date("m");
                    $url = $image->storeAs($folder, $fileName);
                    $ruta=public_path('storage/'.$folder."/".$fileName);
                    InterventionImage::make($image->getRealPath())->resize(640, 480)->save($ruta, 72);
    
                    $urlImages[]['url'] = $url;
                }
            }
            
            $this->publicacion->images()->createMany($urlImages);
        }

        return redirect()->to('/');
    }
}
