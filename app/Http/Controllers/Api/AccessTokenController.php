<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
            'device_name' => 'string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'message' => 'Token created successfully',
                'status' => 201,
                'user' => $user,
            ]);
        }
        return response()->json([
            'message' => 'invalid credentials',
            'status' => 401,
        ]);
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        //revoke all tokens
        //$user->tokens()->delete();

        if (null == $token) {

            $user->currentAccessToken()->delete();
            return response()->json([
                'message' => 'Current device deleted successfully',
                'status' => 200,
            ]);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type) {
            $personalAccessToken->delete();
            return response()->json([
                'message' => 'Logout successfully',
                'status' => 200,
            ]);
        }


    }
    
}
