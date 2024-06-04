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
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Hash;

use App\Models\Estudiante;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        try {
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
                $encryptedToken = hash('sha256', $token);
                $user->token = $encryptedToken;
                $user->save();

                setcookie('tokensesion', $token, time() + 3600, "/");
                session(['token' => $encryptedToken]);

                return redirect()->route('conectarModulos')->with('token', $encryptedToken);


            } else {
                throw new \Exception('Las credenciales proporcionadas no coinciden con nuestros registros.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }


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
        $user = Auth::user();
        $user->token = null;
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    ///////////iniciar con gith
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            dd($user);

            $user = Usuario::where('CorreoElectronico', $user->email)->first();

            if (!$user) {
                $user = Usuario::create([
                    'CorreoElectronico' => $user->email,
                    'Estado' => 'activo',
                    'role_id' => Role::where('Tipo', 'Estudiante')->first()->id,
                ]);
            }

            Auth::login($user, true);

            $token = Str::random(60);
            $user->token = hash('sha256', $token);
            $user->save();

            $userRole = $user->role;

            if ($userRole->Tipo === 'Administrador') {
                return redirect()->route('admin.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'Director-Departamento' || $userRole->Tipo === 'Director-Carrera') {
                return redirect()->route('director.indexProyectos')->with('token', $token);
            } elseif ($userRole->Tipo === 'Vinculacion') {
                return redirect()->route('coordinador.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'DirectorVinculacion') {
                return redirect()->route('director_vinculacion.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'ParticipanteVinculacion') {
                return redirect()->route('ParticipanteVinculacion.index')->with('token', $token);
            } else {
                return redirect()->route('estudiantes.create')->with('token', $token);
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error al iniciar sesión con Google.');
        }
    }


    public function githubCallback()
    {
        try {
            $cacheKey = 'github_user_' . session('github_id');
            if (Cache::has($cacheKey)) {
                $githubUser = Cache::get($cacheKey);
            } else {
                $githubUser = Socialite::driver('github')->user();
                Cache::put($cacheKey, $githubUser, 60);
            }

            $user = Usuario::where('github_id', $githubUser->id)->first();

            if (!$user) {
                $user = Usuario::create([
                    'github_id' => $githubUser->id,
                    'NombreUsuario' => $githubUser->nickname,
                    'CorreoElectronico' => $githubUser->email,
                    'Estado' => 'activo',
                    'role_id' => Role::where('Tipo', 'Estudiante')->first()->id,
                ]);
            }

            Auth::login($user, true);

            $token = Str::random(60);
            $user->token = hash('sha256', $token);
            $user->save();

            $userRole = $user->role;

            if ($userRole->Tipo === 'Administrador') {
                return redirect()->route('admin.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'Director-Departamento' || $userRole->Tipo === 'Director-Carrera') {
                return redirect()->route('director.indexProyectos')->with('token', $token);
            } elseif ($userRole->Tipo === 'Vinculacion') {
                return redirect()->route('coordinador.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'DirectorVinculacion') {
                return redirect()->route('director_vinculacion.index')->with('token', $token);
            } elseif ($userRole->Tipo === 'ParticipanteVinculacion') {
                return redirect()->route('ParticipanteVinculacion.index')->with('token', $token);
            } else {
                return redirect()->route('estudiantes.create')->with('token', $token);
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error al iniciar sesión con GitHub.');
        }


    }




    ////////////////////////////////////////////////////////////////////////////////////////////conexion
    public function conectarModulos()
    {
        return view('ConexionSistemas');

    }

    public function Modulo1()
    {
        $user = Auth::user();
        $userRole = Role::find($user->role_id);
        $credentials = [
            'CorreoElectronico' => $user->CorreoElectronico,
            'Contrasena' => $user->Contrasena,
        ];

        if ($user && (password_verify($credentials['Contrasena'], $user->Contrasena) || $user->Contrasena === $credentials['Contrasena'])) {
            Auth::login($user);

            session()->regenerate();

            $encryptedToken = $user->token;

            setcookie('token', $encryptedToken, time() + 3600, "/");

            session(['token' => $encryptedToken]);

            if ($userRole->Tipo === 'Administrador') {
                return redirect()->route('admin.index')->with('token', $encryptedToken);
            } elseif ($userRole->Tipo === 'Director-Departamento' || $userRole->Tipo === 'Director-Carrera') {
                return redirect()->route('director.indexProyectos')->with('token', $encryptedToken);
            } elseif ($userRole->Tipo === 'Vinculacion') {
                return redirect()->route('coordinador.index')->with('token', $encryptedToken);
            } elseif ($userRole->Tipo === 'DirectorVinculacion') {
                return redirect()->route('director_vinculacion.index')->with('token', $encryptedToken);
            } elseif ($userRole->Tipo === 'ParticipanteVinculacion') {
                return redirect()->route('ParticipanteVinculacion.index')->with('token', $encryptedToken);
            } else {
                return redirect()->route('estudiantes.create')->with('token', $encryptedToken);
            }
        }

        return redirect()->route('login')->with('error', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
    }

    public function Modulo2()
    {
        $content = File::get(public_path('base-angular/index.html'));

        return response($content);
    }

}
