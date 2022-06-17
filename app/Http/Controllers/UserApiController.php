<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function pin(Request $request)
    {
        $attributes = $request->validate([
            'pin' => 'required|min:6|max:6|unique:users,pin'
        ]);
        $attributes['pin'] = bcrypt($request->pin);

        $user = User::where('id',auth()->id())->update($attributes);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
