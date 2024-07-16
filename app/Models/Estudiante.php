<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'estudiantes';

    // Nombre de la columna que es clave primaria en la tabla
    protected $primaryKey = 'estudianteId';

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

    public function notas_practicasi()
    {
        return $this->hasMany(NotasPracticasi::class, 'estudianteId', 'estudianteId');
    }

    public function notas_practicasii()
    {
        return $this->hasMany(NotasPracticasii::class, 'estudianteId', 'estudianteId');
    }

    public function notas_practicasiii()
    {
        return $this->hasMany(NotasPracticasiii::class, 'estudianteId', 'estudianteId');
    }

    public function notas_practicasiv()
    {
        return $this->hasMany(NotasPracticasiv::class, 'estudianteId', 'estudianteId');
    }

    public function notas_practicasv()
    {
        return $this->hasMany(NotasPracticasv::class, 'estudianteId', 'estudianteId');
    }











}
