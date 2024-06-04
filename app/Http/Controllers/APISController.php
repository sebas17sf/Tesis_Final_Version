<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class APISController extends Controller
{
    /////api para obtener los datos de los usuarios por UserID
    public function getUserData($id)
    {
        $user = Usuario::find($id);
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }
    ////api para obtener el rol del usuario
    public function getUserRole($id)
    {
        $user = Usuario::find($id);
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user->role
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }

    ////api para cerrar sesion y regresar a la pagina de inicio
    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
    
        Auth::logout();
    
        return redirect('/');
    }

    

}
