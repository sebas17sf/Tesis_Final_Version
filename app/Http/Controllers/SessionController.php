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
            $showAlert = now()->diffInMinutes($user->token_expires_at) <= 5;

             session(['alert_shown' => false]);

            return response()->json(['success' => true, 'showAlert' => $showAlert]);
        }

        return response()->json(['success' => false]);
    }
}
