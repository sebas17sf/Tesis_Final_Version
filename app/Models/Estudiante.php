<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
     protected $table = 'estudiantes';

     protected $primaryKey = 'estudianteId';

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
        'departamentoId',
        'carrera',
        'provincia',
        'comentario',
        'estado',
        'activacion',
        'actualizacion',


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
        return $this->hasMany(ActividadEstudiante::class, 'estudianteId', 'estudianteId');
    }
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'asignacionproyectos', 'estudianteId', 'proyectoId');
    }


    public function periodos()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo', 'id');
    }

    ////HoraVinculacion
    public function horas_vinculacion()
    {
        return $this->hasMany(HoraVinculacion::class, 'estudianteId', 'estudianteId');
    }

    public function actividades_practicas()
    {
        return $this->hasMany(ActividadesPracticas::class, 'estudianteId');
    }

    public function actividades_practicasii()
    {
        return $this->hasMany(ActividadesPracticasii::class, 'estudianteId');
    }

    public function practicasi()
    {
        return $this->belongsTo(PracticaI::class, 'estudianteId', 'estudianteId');
    }

    public function practicasii()
    {
        return $this->belongsTo(PracticaII::class, 'estudianteId', 'estudianteId');
    }

    public function practicasiii()
    {
        return $this->belongsTo(PracticaIII::class, 'estudianteId', 'estudianteId');
    }

    public function practicasiv()
    {
        return $this->belongsTo(PracticaIV::class, 'estudianteId', 'estudianteId');
    }

    public function practicasv()
    {
        return $this->belongsTo(PracticaV::class, 'estudianteId', 'estudianteId');
    }

    ///departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentoId', 'id');
    }

    












}
