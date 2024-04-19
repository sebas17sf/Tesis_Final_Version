<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Usuario extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios';

    // Nombre de la columna que es clave primaria en la tabla
    protected $primaryKey = 'UserID';

    // Campos que pueden ser llenados en masa (en el proceso de registro)
    protected $fillable = [
        'NombreUsuario',
        'FechaNacimiento',
        'CorreoElectronico',
        'Contrasena',
         'token',
        'Estado',
        'role_id'
    ];

    // Desactivar timestamps (created_at y updated_at) en el modelo
    public $timestamps = true;



 // Implementación de la función getAuthIdentifierName
 public function getAuthIdentifierName()
 {
     return 'UserID'; // Nombre de la columna que es clave primaria en la tabla
 }

 // Implementación de la función getAuthIdentifier
 public function getAuthIdentifier()
 {
     return $this->getKey(); // Devuelve la clave primaria del usuario
 }

 // Implementación de la función getAuthPassword
 public function getAuthPassword()
 {
     return $this->Contrasena; // Nombre de la columna que almacena la contraseña
 }

 public function getRememberToken()
 {
     return $this->remember_token; // Nombre de la columna que almacena el token
 }

 // Implementación de la función setRememberToken
 public function setRememberToken($value)
 {
     $this->remember_token = $value; // Nombre de la columna que almacena el token
 }

 // Implementación de la función getRememberTokenName
 public function getRememberTokenName()
 {
     return 'remember_token'; // Nombre de la columna que almacena el token
 }



    // Relación con la tabla Estudiantes
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'UserID', 'UserID');
    }

    // Relación con la tabla roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }



   
}
