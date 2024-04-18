<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario; // Importa el modelo Usuario

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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'CorreoElectronico' => 'required|string|email|unique:Usuarios',
            'Contrasena' => 'required|string|min:6',
        ]);

        // Crear un nuevo usuario
        $user = new Usuario;
        $user->NombreUsuario = $request->NombreUsuario;
        $user->CorreoElectronico = $request->CorreoElectronico;
        $user->FechaNacimiento = $request->FechaNacimiento;
        $user->Contrasena = bcrypt($request->Contrasena);
         $user->TipoUsuario = 'Estudiante';

      
        if ($user->TipoUsuario == 'Estudiante'){
            $user->Estado = 'Aprobado'; 
            $mensaje = 'Usuario creado';

        }

        $user->save();

        return redirect()->route('login')->with('success', $mensaje);
    }

  
}