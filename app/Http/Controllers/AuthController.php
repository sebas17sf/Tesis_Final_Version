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
            'cedula_docente' => 'required',
        ]);

        $estudiante = Estudiante::where('cedula', $request->cedula_docente)->first();
        if ($estudiante) {
            return back()->withErrors(['cedula_docente' => 'Cédula registrada como estudiante.']);
        }

        $docente = ProfesUniversidad::where('cedula', $request->cedula_docente)->first();
        if ($docente) {
            return back()->withErrors(['cedula_docente' => 'Docente ya registrado.']);
        } else {
            return redirect()->route('ParticipanteVinculacion.create', ['cedula' => $request->cedula_docente]);
        }
    }


    /////guardar registro de docente
    public function guadarRegistroDocente(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios,correoElectronico',
            'cedula' => 'required|string|max:20|unique:profesuniversidad,cedula',
            'espe_id' => 'required|string|max:50|unique:profesuniversidad,espeId',
            'departamento' => 'required|string|max:255',
        ]);

        $correoUsuario = explode("@", $validatedData['correo'])[0];

        $rol = Role::where('tipo', 'ParticipanteVinculacion')->first();


        $usuario = new Usuario();
        $usuario->nombreUsuario = $correoUsuario;
        $usuario->correoElectronico = $validatedData['correo'];
        $usuario->contrasena = bcrypt($validatedData['cedula']);
        $usuario->role_id = $rol->id;
        $usuario->estado = 'En verificacion';
        $usuario->save();

        $docente = new ProfesUniversidad();
        $docente->nombres = $validatedData['nombres'];
        $docente->apellidos = $validatedData['apellidos'];
        $docente->correo = $validatedData['correo'];
        $docente->cedula = $validatedData['cedula'];
        $docente->espeId = $validatedData['espe_id'];
        $docente->usuario = $correoUsuario;
        $docente->departamento = $validatedData['departamento'];
        $docente->userId = $usuario->id;
        $docente->save();

        return redirect()->route('login')->with('success', 'Docente registrado exitosamente. Por favor, inicie sesión.');
    }

}
