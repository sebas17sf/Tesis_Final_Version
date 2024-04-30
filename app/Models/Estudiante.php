<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'estudiantes';

    // Nombre de la columna que es clave primaria en la tabla
    protected $primaryKey = 'EstudianteID';

    // Campos que pueden ser llenados en masa (en el proceso de registro)
    protected $fillable = [
        'UserID',
        'Nombres',
        'Apellidos',
        'espe_id',
        'celular',
        'cedula',
        'Cohorte',
        'id_periodo',
        'Correo',
        'Departamento',
        'Carrera',
        'Provincia',
        'comentario',
        'Estado',


    ];

    // Desactivar timestamps (created_at y updated_at) en el modelo
    public $timestamps = false;

    // Relación con la tabla Usuarios
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UserID', 'UserID');
    }
    public function asignaciones()
    {
        return $this->hasMany(AsignacionProyecto::class, 'EstudianteID', 'EstudianteID');
    }
    public function notas()
    {
        return $this->hasMany(NotasEstudiante::class, 'EstudianteID', 'EstudianteID');
    }

    public function evidencias()
    {
        return $this->hasMany(ActividadEstudiante::class, 'EstudianteID');
    }
    
    public function actividades()
    {
        return $this->hasMany(ActividadEstudiante::class, 'EstudianteID');
    }
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'asignacionProyectos', 'EstudianteID', 'ProyectoID');
    }
 

    public function periodos()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id');
    }

    public function asignacionesEstudiantesDirectores()
    {
        return $this->hasMany(AsignacionEstudiantesDirector::class, 'EstudianteID');
    }

}
