<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $personas = User::where('id', '!=', Auth::user()->id)
                    ->whereNotIn('id', Auth::user()->friends()->pluck('id'))
                    ->inRandomOrder()->take(10)->get();
                    
        return view('home', compact('personas'));
    }
}
