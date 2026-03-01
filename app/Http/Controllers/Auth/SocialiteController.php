<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{

    public function redirect($platform) {
        return Socialite::driver($platform)->redirect();
    }

    public function callback($platform) {
        try {
            $socialUser = Socialite::driver($platform)->user();


            $user = User::updateOrCreate([
                'email' => $socialUser->email,
            ], [
                'name' => $socialUser->name ?? $socialUser->nickname,
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);

            Auth::login($user);
            return redirect()->route('userHome');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login with ' . $platform . ' failed!');
        }
    }
}



