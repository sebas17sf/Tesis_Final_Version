<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Role;
use App\Models\Periodo;



class AuthController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Procesar el registro de usuarios


    public function register(Request $request)
    {

        ////obtener todos los periodos
        $periodos = Periodo::orderBy('inicioPeriodo', 'asc')->get();



        // Validar los datos del formulario
        $validatedData = $request->validate([
            'cedula' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!Estudiante::where('cedula', $value)->exists()) {
                        return $fail('La cédula no está registrada en la tabla de estudiantes.');
                    }
                },
            ],
        ], [
            'cedula.required' => 'La cédula es requerida',
            'cedula.string' => 'La cédula debe ser una cadena de texto',
        ]);

        // Si los datos son válidos, continuamos aquí
        $estudiante = Estudiante::where('cedula', $request->cedula)->firstOrFail();

        // Retornar la vista con los datos del estudiante
        return view('estudiantes.create', compact('estudiante', 'periodos'));
    }

    public function mostrarRegistroDocente()
    {
        return view('ParticipanteVinculacion.create');
    }
    public function registerDocente(Request $request)
    {
        $validatedData = $request->validate([
            'cedula_docente' => 'required|string|max:20',
        ]);

        $estudiante = Estudiante::where('cedula', $request->cedula_docente)->first();
        if ($estudiante) {
            return back()
                ->withErrors(['cedula_docente' => 'Cédula registrada como estudiante.'])
                ->withInput();
        }

        $docente = ProfesUniversidad::where('cedula', $request->cedula_docente)->first();

        if ($docente) {
            return redirect()->route('ParticipanteVinculacion.create', ['id' => $docente->id])
                ->with('docente', $docente);
        } else {
            return redirect()->route('ParticipanteVinculacion.create', ['cedula' => $request->cedula_docente]);
        }
    }




    public function guadarRegistroDocente(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email',
            'cedula' => 'required|string|max:20',
            'espe_id' => 'required|string|max:50',
            'departamento' => 'required|string|max:255',
        ]);

        $correoUsuario = explode("@", $validatedData['correo'])[0];

        $docente = ProfesUniversidad::where('cedula', $validatedData['cedula'])->first();

        if ($docente) {
            // Buscar o crear el usuario asociado al docente
            $usuario = Usuario::where('correoElectronico', $validatedData['correo'])->first();

            if (!$usuario) {
                $rol = Role::where('tipo', 'ParticipanteVinculacion')->first();
                $usuario = new Usuario();
                $usuario->nombreUsuario = $correoUsuario;
                $usuario->correoElectronico = $validatedData['correo'];
                $usuario->contrasena = bcrypt($validatedData['cedula']);
                $usuario->role_id = $rol->id;
                $usuario->estado = 'activo';
                $usuario->save();

                // Asignar el nuevo usuario al docente
                $docente->userId = $usuario->id;
            } else {
                $rol = Role::where('tipo', 'ParticipanteVinculacion')->first();
                $usuario->nombreUsuario = $correoUsuario;
                $usuario->correoElectronico = $validatedData['correo'];
                $usuario->estado = 'activo';
                $usuario->role_id = $rol->id;
                $usuario->save();
            }

            // Actualizar el docente
            $docente->nombres = $validatedData['nombres'];
            $docente->apellidos = $validatedData['apellidos'];
            $docente->correo = $validatedData['correo'];
            $docente->espeId = $validatedData['espe_id'];
            $docente->departamento = $validatedData['departamento'];
            $docente->userId = $usuario->userId;
            $docente->save();

            $message = 'Docente actualizado exitosamente.';
        } else {
            // Crear nuevo usuario y docente
            $rol = Role::where('tipo', 'ParticipanteVinculacion')->first();

            $usuario = Usuario::where('correoElectronico', $validatedData['correo'])->first();
            if (!$usuario) {
                $usuario = new Usuario();
                $usuario->nombreUsuario = $correoUsuario;
                $usuario->correoElectronico = $validatedData['correo'];
                $usuario->contrasena = bcrypt($validatedData['cedula']);
                $usuario->role_id = $rol->id;
                $usuario->estado = 'En verificacion';
                $usuario->save();
            } else {
                $usuario->nombreUsuario = $correoUsuario;
                $usuario->correoElectronico = $validatedData['correo'];
                $usuario->contrasena = bcrypt($validatedData['cedula']);
                $usuario->role_id = $rol->id;
                $usuario->estado = 'En verificacion';
                $usuario->save();
            }

            $docente = new ProfesUniversidad();
            $docente->nombres = $validatedData['nombres'];
            $docente->apellidos = $validatedData['apellidos'];
            $docente->correo = $validatedData['correo'];
            $docente->cedula = $validatedData['cedula'];
            $docente->espeId = $validatedData['espe_id'];
            $docente->usuario = $correoUsuario;
            $docente->departamento = $validatedData['departamento'];
            $docente->userId = $usuario->userId;
            $docente->save();

            $message = 'Docente registrado exitosamente. Pronto será verificado.';
        }

        return redirect()->route('login')->with('success', $message);
    }






}
