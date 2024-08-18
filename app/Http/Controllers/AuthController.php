<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Role;
use App\Models\Periodo;
use App\Models\Departamento;



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
         $periodos = Periodo::orderBy('inicioPeriodo', 'asc')->get();
        $departamentos = Departamento::all();

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

        $estudiante = Estudiante::where('cedula', $request->cedula)->firstOrFail();

        if ($estudiante->activacion) {
            return redirect()->route('login')->with(['error' => 'No puede validar porque ya fue validado sus datos.']);
        }

        return view('estudiantes.create', compact('estudiante', 'periodos', 'departamentos'));
    }


    public function mostrarRegistroDocente()
    {
        $departamentos = Departamento::all();
        return view('ParticipanteVinculacion.create', compact('departamentos'));
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
        ],
            [
                'nombres.required' => 'El nombre es requerido',
                'nombres.string' => 'El nombre debe ser una cadena de texto',
                'nombres.max' => 'El nombre no debe exceder los 255 caracteres',
                'apellidos.required' => 'El apellido es requerido',
                'apellidos.string' => 'El apellido debe ser una cadena de texto',
                'apellidos.max' => 'El apellido no debe exceder los 255 caracteres',
                'correo.required' => 'El correo es requerido',
                'correo.string' => 'El correo debe ser una cadena de texto',
                'correo.email' => 'El correo debe ser una dirección de correo válida',
                'cedula.required' => 'La cédula es requerida',
                'cedula.string' => 'La cédula debe ser una cadena de texto',
                'cedula.max' => 'La cédula no debe exceder los 20 caracteres',
                'espe_id.required' => 'La especialidad es requerida',
                'espe_id.string' => 'La especialidad debe ser una cadena de texto',
                'espe_id.max' => 'La especialidad no debe exceder los 50 caracteres',
                'departamento.required' => 'El departamento es requerido',
                'departamento.string' => 'El departamento debe ser una cadena de texto',
                'departamento.max' => 'El departamento no debe exceder los 255 caracteres',
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
            $docente->departamentoId = $validatedData['departamento'];
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
            $docente->departamentoId = $validatedData['departamento'];
            $docente->userId = $usuario->userId;
            $docente->save();

            $message = 'Docente registrado exitosamente. Pronto será verificado.';
        }

        return redirect()->route('login')->with('success', $message);
    }






}
