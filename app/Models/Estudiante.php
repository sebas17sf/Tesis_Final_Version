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
        'userId',
        'nombres',
        'apellidos',
        'espeId',
        'celular',
        'cedula',
        'Cohorte',
        'idPeriodo',
        'correo',
        'departamento',
        'carrera',
        'provincia',
        'comentario',
        'estado',


    ];

    // Desactivar timestamps (created_at y updated_at) en el modelo
    public $timestamps = false;

    // Relación con la tabla Usuarios
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'userId', 'userId');
    }
    public function asignaciones()
    {
        return $this->hasMany(AsignacionProyecto::class, 'estudianteId', 'estudianteId');
    }
    public function notas()
    {
        return $this->hasMany(NotasEstudiante::class, 'estudianteId', 'estudianteId');
    }

    public function evidencias()
    {
        return $this->hasMany(ActividadEstudiante::class, 'estudianteId');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadEstudiante::class, 'estudianteId');
    }
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'asignacionProyectos', 'estudianteId', 'proyectoId');
    }


    public function periodos()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo', 'id');
    }




    public function actividades_practicas()
    {
        return $this->hasMany(ActividadesPracticas::class, 'estudianteId');
    }





}
