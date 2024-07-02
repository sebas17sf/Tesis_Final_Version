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
            // Actualizar token_expires_at a 10 minutos desde ahora
            $user->token_expires_at = now()->addMinutes(10);
            $user->save();

            // Calcular el tiempo restante y la mitad del tiempo restante
            $timeRemaining = now()->diffInMinutes($user->token_expires_at);
            $halfTimeRemaining = floor($timeRemaining / 2);

            // Determinar si se debe mostrar la alerta cuando falte la mitad del tiempo
            $showAlert = $timeRemaining <= $halfTimeRemaining && !session('alert_shown');

            // Marcar alerta como mostrada para evitar mostrarla nuevamente
            if ($showAlert) {
                session(['alert_shown' => true]);
            }

            return response()->json(['success' => true, 'showAlert' => $showAlert]);
        }

        return response()->json(['success' => false]);
    }

    public function updateTokenExpiration(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->token_expires_at) {
            $user->token_expires_at = null; // Establecer token_expires_at a null si hay actividad reciente
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
