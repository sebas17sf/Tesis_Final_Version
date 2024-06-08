<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function keepAlive(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->token_expires_at = now()->addMinutes(10);
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
