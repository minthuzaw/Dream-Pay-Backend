<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\RegisterApiRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
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
        logger($request);
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::where('email', $attributes['email'])->first();


        if ($user) {
            if (Hash::check($attributes['password'], $user->password)) {
                return $user->createToken('test')->accessToken;
            }
            return $user;
        } else {
            return response()->json(['message' => 'no user found'], 401);
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user()->makeVisible('pin')->toArray();
        $user['current_step'] = $user['pin'] ? 1 : 0;
        unset($user['pin']);
        return $user;

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return 'logout';
    }

    public function updatePin(Request $request)
    {
//        return $request->all();
        $attributes = $request->validate([
            'pin' => 'required|min:6|max:6|unique:users,pin'
        ]);
        $attributes['pin'] = bcrypt($request->pin);

        $user = User::where('id', auth()->id())->update($attributes);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
