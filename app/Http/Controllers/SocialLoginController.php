<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
     //redirect
     public function redirect($provider){
        return Socialite::driver($provider)->redirect();
     }

     //callback
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

      $user = User::updateOrCreate([
    'email' => $socialUser->email,
], [
    'name' => $socialUser->name,
    'nickname' => $socialUser->nickname,
    'provider_id' => $socialUser->id,
    'provider_token' => $socialUser->token,
    'provider' => $provider,
    'role' => 'user',
]);
        Auth::login($user);
         return to_route('userHome');

    }
}
