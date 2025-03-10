<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function index($provider)
    {
        try {
            $user = Auth::user();

            $provider_user = Socialite::driver($provider)->userFromToken($user->provider_token);

            dd($provider_user);
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }
}
