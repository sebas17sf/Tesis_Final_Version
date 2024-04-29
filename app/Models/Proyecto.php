<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $primaryKey = 'ProyectoID';

    protected $fillable = [
        'id_directorProyecto',
        'id_docenteParticipante',
        'id_nrc_vinculacion',
        'NombreProyecto',
        'DescripcionProyecto',
        'CorreoElectronicoTutor',
        'DepartamentoTutor',
        'FechaInicio',
        'FechaFinalizacion',
        'cupos',
        'Estado',
    ];

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'asignacionProyectos', 'ProyectoID', 'EstudianteID');
    }

    public function asignaciones()
    {
        return $this->hasMany(AsignacionProyecto::class, 'ProyectoID', 'ProyectoID');
    }

    public function director()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'id_directorProyecto');
    }

    public function docenteParticipante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'id_docenteParticipante');
    }

    public function nrcs()
    {
        return $this->belongsTo(NrcVinculacion::class, 'id_nrc_vinculacion');
    }

    public function participantesAdicionales()
    {
        return $this->belongsToMany(ProfesUniversidad::class, 'participantesAdicionales', 'ProyectoID', 'ParticipanteID');
    }

    public function asignacionesEstudiantesDirectores()
    {
        return $this->hasMany(AsignacionEstudiantesDirector::class, 'IDProyecto');
    }

}
