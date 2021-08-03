<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        $user = User::where('email', $userSocial->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'email_verified_at' => now(),
                'provider' => $provider,
                'provider_id' => $userSocial->getId(),
                'image' => $userSocial->getAvatar(),
            ]);
        }
        Auth::login($user);
        return redirect('/');
    }
}