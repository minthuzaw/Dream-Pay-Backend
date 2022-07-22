<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetRecipientRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRecipient(GetRecipientRequest $request)
    {
        $attributes = $request->validated();
        $recipient = $attributes['recipient'];

        return User::where(function ($query) use ($recipient) {
            $query->where('email', $recipient)->orWhere('mobile_phone', $recipient);
        })->whereNot(function ($query) use ($recipient) {
            $query->where('email', \Auth::user()->email)->orWhere('mobile_phone', \Auth::user()->mobile_phone);
        })->firstOrFail();

    }
}
