<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\RegisterApiRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthApiController extends Controller
{
    public function register(RegisterApiRequest $request)
    {
        $attributes = $request->validated();

        $attributes['password'] = Hash::make($request->password);

        $user = User::create($attributes);
        $token = $user->createToken('register PAT')->accessToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ]);

    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::where('email', $attributes['email'])->first();

        if ($user) {
            if (Hash::check($attributes['password'], $user->password)) {
                return $user->createToken('test')->accessToken;
            }
            return 'wrong';
        } else {
            return 'wrong';
        }
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return 'logout';
    }
}
