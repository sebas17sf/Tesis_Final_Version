<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesUniversidad extends Model
{
    use HasFactory;
    protected $table = 'profesUniversidad';
    protected $fillable = [
        'Apellidos',
        'Nombres',
        'Correo',
        'Usuario',
        'Cedula',
        'Departamento',
        'espe_id',
    ];

    public function proyectosDirigidos()
    {
        return $this->hasMany(Proyecto::class, 'id_directorProyecto');
    }

     public function proyectosParticipantes()
    {
        return $this->hasMany(Proyecto::class, 'id_docenteParticipante');
    }

    public function participantesAdicionales()
    {
        return $this->hasMany(ParticipanteAdicional::class, 'ParticipanteID');
    }

    public function asignacionesComoDirector()
    {
        return $this->hasMany(AsignacionEstudiantesDirector::class, 'DirectorID');
    }

     public function asignacionesComoParticipante()
    {
        return $this->hasMany(AsignacionEstudiantesDirector::class, 'ParticipanteID');
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



}
