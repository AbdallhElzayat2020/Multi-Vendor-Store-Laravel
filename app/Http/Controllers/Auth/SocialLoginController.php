<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {
        try {
            $provider_user = Socialite::driver($provider)->user();

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $provider_user->id,
            ])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $provider_user->getName(),
                    'email' => $provider_user->getEmail(),
                    'password' => Hash::make(Str::random(10)),
                    'provider' => $provider,
                    'provider_id' => $provider_user->getId(),
                    'provider_token' => $provider_user->token,
                ]);

                Auth::login($user);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

//    public function callback_2($provider)
//    {
//        try {
//            $provider_user = Socialite::driver($provider)->user();
//
//            $user = User::firstOrCreate(
//                [
//                    'provider' => $provider,
//                    'provider_id' => $provider_user->id,
//                ],
//                [
//                    'name' => $provider_user->getName(),
//                    'email' => $provider_user->getEmail(),
//                    'password' => Hash::make(Str::random(10)),
//                    'provider_token' => $provider_user->token,
//                ]
//            );
//
//            Auth::login($user);
//            return redirect()->route('home');
//        } catch (\Exception $e) {
//            return redirect()->route('home')->withErrors(['email' => $e->getMessage()]);
//        }
//    }



}
