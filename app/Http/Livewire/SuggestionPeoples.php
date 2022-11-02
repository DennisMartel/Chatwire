<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuggestionPeoples extends Component
{
    public function render()
    {
        $personas = User::where('id', '!=', Auth::user()->id)
                    ->whereNotIn('id', Auth::user()->friends()->pluck('id'))
                    ->inRandomOrder()->take(10)->get();
                    
        return view('livewire.suggestion-peoples', compact('personas'));
    }

    public function sendFriendRequest($friendId)
    {
        $user = User::find($friendId);

        if (!$user)  
            return false;

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) 
            return false;

        if(Auth::user()->isFriendsWith($user)) 
            return false;

        Auth::user()->addFriend($user);
    }
}
