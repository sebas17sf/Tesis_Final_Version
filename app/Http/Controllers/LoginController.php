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
use Illuminate\Support\Facades\Log;
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
            // Validar las credenciales del usuario
            $credentials = $request->validate([
                'CorreoElectronico' => 'required',
                'Contrasena' => 'required',
            ]);

            // Buscar el usuario por nombre de usuario
            $user = Usuario::where('nombreUsuario', $credentials['CorreoElectronico'])->first();

            // Verificar las credenciales y el estado del usuario
            if ($user && (password_verify($credentials['Contrasena'], $user->contrasena) || $user->contrasena === $credentials['Contrasena'])) {
                // Verificar si el usuario está en proceso de verificación
                if ($user->estado === 'En verificacion') {
                    return redirect()->route('login')->with('error', 'Su usuario está en proceso de verificación.');
                }

                // Autenticar al usuario
                Auth::login($user);

                // Obtener el user agent del usuario
                $userAgent = $request->userAgent();

                // Generar un identificador único para la sesión
                $uuid = (string) Str::uuid();

                // Crear una nueva sesión de usuario
                $session = new UsuariosSession();
                $session->userId = $user->userId;
                $session->ip_address = $request->ip();
                $session->start_time = now();
                $session->user_agent = $userAgent;
                $session->locality = 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE SEDE SANTO DOMINGO';
                $session->session_id = $uuid;
                $session->save();

                // Regenerar la sesión para evitar fijación de sesión
                session()->regenerate();

                // Generar y almacenar el token de la sesión
                $token = Str::random(60);
                $encryptedToken = hash('sha256', $token);
                $user->token = $encryptedToken;
                $user->save();

                // Establecer cookies para la sesión y el token
                setcookie('tokensesion', $token, time() + 3600, "/");
                setcookie('session_uuid', $uuid, time() + 3600, "/"); // Guardar el identificador único en la cookie
                session(['token' => $encryptedToken]);

                // Redirigir al usuario a la página de módulos
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

        $usuario = Usuario::where('correoElectronico', $request->email)->first();

        if (!$usuario) {
            return redirect()->route('recuperar-contrasena')->withErrors(['email' => 'Correo no registrado, no cuenta con un usuario en el sistema.']);
        }

        $token = Str::random(60);
        $usuario->token = $token;
        $usuario->token_expires_at = now()->addHours(1);
        $usuario->save();

        $estudiante = Estudiante::where('correo', $request->email)->first();

        Mail::to($usuario->correoElectronico)->send(new RecuperarContrasena($usuario, $estudiante, $token));

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
            'correoElectronico' => $usuario->correoElectronico,
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
        try {
            $user = Auth::user();
            if ($user) {
                $uuid = $_COOKIE['session_uuid'] ?? null;

                if ($uuid) {
                    $existingSession = UsuariosSession::where('UserID', $user->userId)
                        ->where('session_id', $uuid)
                        ->first();

                    if ($existingSession) {
                        $existingSession->update(['end_time' => now()]);
                    }
                }

                $user->token = null;
                $user->token_expires_at = null;
                $user->save();
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } catch (\Exception $e) {
            Log::error('Error al cerrar sesión: ' . $e->getMessage());

            return redirect('/')->withErrors(['error' => 'Hubo un problema al cerrar sesión. Por favor, inténtelo de nuevo.']);
        }
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
            } elseif ($userRole->Tipo === 'Vinculacion' || $userRole->Tipo === 'Practicas') {
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




    public function Modulo1()
    {
        try {
            $user = Auth::user();
            $userRole = Role::find($user->role_id);
            $credentials = [
                'CorreoElectronico' => $user->correoElectronico,
                'Contrasena' => $user->contrasena,
            ];

            if ($user && (password_verify($credentials['Contrasena'], $user->contrasena) || $user->contrasena === $credentials['Contrasena'])) {
                Auth::login($user);

                session()->regenerate();

                // Update token and token_expires_at
                $user->token = Str::random(60);
                $user->save();

                $encryptedToken = $user->token;

                setcookie('token', $encryptedToken, time() + 3600, "/");

                session(['token' => $encryptedToken]);

                if ($userRole->tipo === 'Administrador') {
                    return redirect()->route('admin.index')->with('token', $encryptedToken);
                } elseif ($userRole->tipo === 'Director-Departamento' || $userRole->tipo === 'Director-Carrera') {
                    return redirect()->route('director.indexProyectos')->with('token', $encryptedToken);
                } elseif ($userRole->tipo === 'Vinculacion' || $userRole->tipo === 'Practicas') {
                    return redirect()->route('coordinador.index')->with('token', $encryptedToken);
                } elseif ($userRole->tipo === 'DirectorVinculacion') {
                    return redirect()->route('director_vinculacion.index')->with('token', $encryptedToken);
                } elseif ($userRole->tipo === 'ParticipanteVinculacion') {
                    return redirect()->route('ParticipanteVinculacion.index')->with('token', $encryptedToken);
                } else {
                    return redirect()->route('estudiantes.create')->with('token', $encryptedToken);
                }
            }

            return redirect()->route('login')->with('error', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }




    ////////////////////////////////////////////////////////////////////////////////////////////conexion
    public function conectarModulos()
    {
        return view('ConexionSistemas');

    }



    public function Modulo2()
    {
        $content = File::get(public_path('base-angular/index.html'));

        return response($content);
    }

}
