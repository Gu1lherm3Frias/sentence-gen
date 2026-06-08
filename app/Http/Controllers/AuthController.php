<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('senhaunica')->redirect();
    }

    public function callback() {
        $fakerUser = Socialite::driver('senhaunica')->user();
        $userOAuth = $fakerUser->attributes;
        
        $user = User::updateOrCreate(
            ['codpes' => $userOAuth['codpes']],
            [
                'name' => $userOAuth['nompes'],
                'email' => $userOAuth['email'] ?? $userOAuth['emailUsp'],
                'password' => Str::password(32),
            ]
        );

        Auth::login($user);

        return redirect('/');
    }
}
