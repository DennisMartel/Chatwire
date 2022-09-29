<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Search extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.search');
    }

    public function getResultadosProperty()
    {
        return User::select('name', 'email', 'profile_photo_url')
            ->where('id', '!=', Auth::user()->id)
            ->where('name', 'LIKE', '%'. $this->search . '%')
            ->inRandomOrder()->take(15)->get();
    }
}
