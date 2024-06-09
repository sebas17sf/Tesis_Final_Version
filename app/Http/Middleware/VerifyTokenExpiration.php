<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyTokenExpiration
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->token_expires_at) {
            if (now()->greaterThan($user->token_expires_at)) {
                $this->updateSessionEndTime($user);
                $user->token = null;
                $user->token_expires_at = null;
                $user->save();

                Auth::logout();
                return redirect()->route('login')->with('error', 'Tu sesión ha expirado.');
            }

             if (!session('show_alert') && now()->diffInMinutes($user->token_expires_at) <= 5) {
                session(['show_alert' => true]);
            }
        }

        return $next($request);
    }
    private function updateSessionEndTime($user)
    {
        $existingSession = UsuariosSession::where('UserID', $user->UserID)
             ->first();

        if ($existingSession) {
            $existingSession->end_time = now();
            $existingSession->save();
        }
    }
}
