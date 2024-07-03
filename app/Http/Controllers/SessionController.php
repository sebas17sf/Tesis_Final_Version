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

        return response()->json(['success' => false, 'message' => 'User not authenticated']);
    }

    public function updateTokenExpiration(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->token_expires_at) {
            $user->token_expires_at = null;
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'User not authenticated or token expiration not set']);
    }

    public function checkSessionStatus()
    {
        $user = Auth::user();
        if ($user && $user->token_expires_at) {
            $timeRemaining = now()->diffInMinutes($user->token_expires_at);
            $halfTimeRemaining = floor((10 * 60) / 2);

            if ($timeRemaining <= 5) {
                return response()->json(['success' => true, 'timeRemaining' => $timeRemaining, 'halfTimeRemaining' => $halfTimeRemaining]);
            }
        }

        return response()->json(['success' => false, 'message' => 'User not authenticated or token expiration not set']);
    }

}
