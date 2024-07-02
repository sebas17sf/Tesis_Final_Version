<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuariosSession;
use Illuminate\Support\Facades\Session;

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

            // Calcular la mitad del tiempo restante hasta que expire el token
            $timeRemaining = now()->diffInMinutes($user->token_expires_at);
            $halfTimeRemaining = floor($timeRemaining / 2);

            // Mostrar la alerta si se cumple la condición y no se ha mostrado antes
            if ($timeRemaining <= $halfTimeRemaining && !session('alert_shown')) {
                session(['show_alert' => true, 'alert_shown' => true]);
            }
        }

        return $next($request);
    }

    private function updateSessionEndTime($user)
    {
        $existingSession = UsuariosSession::where('userId', $user->userId)->first();

        if ($existingSession) {
            $existingSession->end_time = now();
            $existingSession->save();
        }
    }
}
