<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesUniversidad extends Model
{
    use HasFactory;
    protected $table = 'profesuniversidad';
    protected $fillable = [
        'userId',
        'apellidos',
        'nombres',
        'correo',
        'usuario',
        'cedula',
        'departamento',
        'espeId',
    ];

    public function proyectosDirigidos()
    {
        return $this->hasMany(Proyecto::class, 'directorId');
    }

     public function proyectosParticipantes()
    {
        return $this->hasMany(Proyecto::class, 'id_docenteParticipante');
    }



    public function asignadosEstudiantes ()
    {
        return $this->hasMany(AsignacionProyecto::class, 'DirectorID');
    }

    public function asignadosParticipantes ()
    {
        return $this->hasMany(AsignacionProyecto::class, 'ParticipanteID');
    }

    public function asignadosDirector ()
    {
        return $this->hasMany(AsignacionProyecto::class, 'DirectorID');
    }

     public function usuarios()
    {
        return $this->belongsTo(Usuario::class, 'userId');
    }

    public function tutorAcademico()
    {
        return $this->hasMany(PracticaI::class, 'idTutorAcademico');
    }







}
