<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialProfile;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        $drivers = ['facebook', 'google'];

        if (in_array($driver, $drivers)) 
        {
            return Socialite::driver($driver)->redirect();
        } 
        else 
        {
            return redirect()->route('login');
        }

    }
 
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        try 
        {
            $userSocialite = Socialite::driver($driver)->user();
    
            $socialProfile = SocialProfile::where('social_id', $userSocialite->getId())
                            ->where('social_name', $driver)->first();
    
            if (!$socialProfile) 
            {
                $user = User::where('email', $userSocialite->getEmail())->first();
    
                if (!$user) 
                {
                    $user = User::create([
                        'name' => $userSocialite->getName(),
                        'email' => $userSocialite->getEmail(),
                        'uid' => uniqid(true),
                    ]);
                }
    
                $socialProfile = SocialProfile::create([
                    'user_id' => $user->id,
                    'social_id' => $userSocialite->getId(),
                    'social_name' => $driver,
                    'social_avatar' => $userSocialite->getAvatar()
                ]);
            }
    
            Auth::login($socialProfile->user);
    
            return redirect()->route('/');
        } 
        catch (\Throwable $th) 
        {
            return redirect()->route('login');
        }
    }
}
