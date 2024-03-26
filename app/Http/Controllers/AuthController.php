<?php

namespace App\Http\Controllers;

use App\Business\AbilitiesResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $abilities = AbilitiesResolver::resolve($user);
            $token = $user->createToken('authToken', $abilities);
            return response()->json(['token' => $token->plainTextToken]);
        }

        return response()->json(['error' => 'UnAuthorised'], 401);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getLoggedInUser()
    {
        return new UserResource(auth()->user());
    }
}
