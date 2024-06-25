<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Estudiante;
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
        $periodos = Periodo::all();



        // Validar los datos del formulario
        $validatedData = $request->validate([
            'cedula' => [
                'required',
                'string',
                function($attribute, $value, $fail) {
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


}
