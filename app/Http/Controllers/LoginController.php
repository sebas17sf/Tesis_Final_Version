<?php

namespace App\Http\Controllers;

use App\Models\UsuariosSession;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarContrasena;
use App\Models\Role;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\Estudiante;


class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el inicio de sesión

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'CorreoElectronico' => 'required|email',
            'Contrasena' => 'required',
        ]);

        $user = Usuario::where('CorreoElectronico', $credentials['CorreoElectronico'])->first();

        if ($user && (password_verify($credentials['Contrasena'], $user->Contrasena) || $user->Contrasena === $credentials['Contrasena'])) {
            Auth::login($user);

            $userAgent = $request->userAgent();
            $response = Http::get('https://api.ipify.org?format=json');

            if ($response->successful()) {
                $ipAddress = $response->json('ip');
            } else {
                $ipAddress = $request->ip();
            }

            $geoIpResponse = Http::get("https://ipinfo.io/{$ipAddress}/json");

            if ($geoIpResponse->successful()) {
                $geoData = $geoIpResponse->json();
                $locality = $geoData['city'] . ', ' . $geoData['region'] . ', ' . $geoData['country'];
                $locality .= ', ' . $geoData['loc'];
            } else {
                $locality = 'Desconocida';
            }



            $existingSession = UsuariosSession::where('UserID', $user->UserID)
                ->where('user_agent', $userAgent)
                ->where('ip_address', $ipAddress)
                ->first();


            if ($existingSession) {
                $existingSession->update(['start_time' => now()]);
            } else {
                $session = new UsuariosSession();
                $session->UserID = $user->UserID;
                $session->session_id = session()->getId();
                $session->start_time = now();
                $session->user_agent = $request->userAgent();
                $session->locality = $locality;


                $response = Http::get('https://api.ipify.org?format=json');
                if ($response->successful()) {
                    $ip = $response->json()['ip'];
                    $session->ip_address = $ip;
                } else {
                    $session->ip_address = $request->ip();
                }

                $session->save();
            }

            session()->regenerate();

            $token = Str::random(60);

            $user->token = hash('sha256', $token);
            $user->save();

            $userRole = Role::find($user->role_id);

            if ($userRole->Tipo === 'Administrador') {
                return redirect()->route('admin.index')->with('token', $token);
            } elseif ($user->Estado === 'activo') {
                if ($userRole->Tipo === 'Director-Departamento' || $user->Estado === 'Director-Carrera') {
                    return redirect()->route('director.indexProyectos')->with('token', $token);
                } elseif ($userRole->Tipo === 'Vinculacion') {
                    return redirect()->route('coordinador.index')->with('token', $token);
                } elseif ($userRole->Tipo === 'DirectorVinculacion') {
                    return redirect()->route('director_vinculacion.index')->with('token', $token);
                } elseif ($userRole->Tipo === 'ParticipanteVinculacion') {
                    return redirect()->route('ParticipanteVinculacion.index')->with('token', $token);
                } else {
                    return back()->withErrors([
                        'CorreoElectronico' => 'Su estado no permite el acceso en este momento.',
                    ]);
                }
            } else {
                return redirect()->route('estudiantes.create')->with('token', $token);
            }
        }

        return redirect()->route('login')->with('error', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
    }


    //////recuperar contraseña
    public function recuperarContrasena()
    {
        return view('recuperarContrasena');
    }

    public function enviarEnlaceRestablecimiento(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $usuario = Usuario::where('CorreoElectronico', $request->email)->first();

        if (!$usuario) {
            return back()->with('error', 'Correo no registrado, no cuenta con un usuario en el sistema.');
        }

        $token = Str::random(60);
        $usuario->token = $token;
        $usuario->token_expires_at = now()->addHours(1);
        $usuario->save();

        $estudiante = Estudiante::where('Correo', $request->email)->first();

        Mail::to($usuario->CorreoElectronico)->send(new RecuperarContrasena($usuario, $estudiante, $token));

        return redirect('/')->with('success', 'Se ha enviado un enlace de restablecimiento de contraseña a su correo electrónico.');
    }


    public function mostrarFormularioRestablecimiento($token)
    {
        $usuario = Usuario::where('token', $token)
            ->where('token_expires_at', '>', now())
            ->first();

        if (!$usuario) {
            return redirect('/')->with('error', 'Su solicitud de restablecimiento de contraseña no es válida o ha expirado.');
        }

        // Pasa los datos a la vista utilizando un arreglo asociativo
        return view('cambiarContrasena')->with([
            'correoElectronico' => $usuario->CorreoElectronico,
            'token' => $token,
        ]);
    }


    public function cambiarContrasenaUsuario(Request $request, $correoElectronico)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);

        // Buscar al usuario por su correo electrónico
        $usuario = Usuario::where('CorreoElectronico', $correoElectronico)
            ->where('token', $request->token)
            ->where('token_expires_at', '>', now())
            ->first();

        if (!$usuario) {
            return back()->with('error', 'El token de restablecimiento de contraseña no es válido o ha expirado.');
        }

        // Actualizar la contraseña del usuario
        $usuario->Contrasena = Hash::make($request->password);
        $usuario->token = null; // Eliminar el token
        $usuario->token_expires_at = null; // Eliminar la fecha de expiración del token
        $usuario->save();

        return redirect('/')->with('success', 'Contraseña cambiada exitosamente.');
    }



    ////funcion para cerrar la sesion del usuario

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }




}
