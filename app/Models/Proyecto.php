<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'Proyectos';
    protected $primaryKey = 'ProyectoID';

    protected $fillable = [
        'id_directorProyecto',
        'id_docenteParticipante',
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
        return $this->belongsToMany(Estudiante::class, 'AsignacionProyectos', 'ProyectoID', 'EstudianteID');
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


 

}
