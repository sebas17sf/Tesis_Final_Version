<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\UsuariosSession;

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

            if (now()->diffInMinutes($user->token_expires_at) <= 5 && !session('alert_shown')) {
                session(['show_alert' => true, 'alert_shown' => true]);
            }
        }

        return $next($request);
    }

    private function updateSessionEndTime($user)
    {
        $existingSession = UsuariosSession::where('userId', $user->UserID)->first();

        if ($existingSession) {
            $existingSession->end_time = now();
            $existingSession->save();
        }
    }
}
