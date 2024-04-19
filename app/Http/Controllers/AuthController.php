<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;  
use App\Models\Role;


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
    
        // Obtener el ID del rol 'Estudiante' de la tabla 'roles'
        $estudianteRoleId = Role::where('Tipo', 'Estudiante')->value('id');
    
        // Crear un nuevo usuario
        $user = new Usuario;
        $user->NombreUsuario = $request->NombreUsuario;
        $user->CorreoElectronico = $request->CorreoElectronico;
        $user->FechaNacimiento = $request->FechaNacimiento;
        $user->Contrasena = bcrypt($request->Contrasena);
        $user->role_id = $estudianteRoleId;
    
        // Verificar si el rol del usuario es 'Estudiante' y establecer el estado en 'Aprobado'
        if ($user->role_id === $estudianteRoleId) {
            $user->Estado = 'Aprobado'; 
            $mensaje = 'Usuario creado y aprobado';
        } else {
            $mensaje = 'Usuario creado';
        }
    
        $user->save();
    
        return redirect()->route('login')->with('success', $mensaje);
    }
  
}