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
        'DirectorID',
        'NombreProyecto',
        'DescripcionProyecto',
        'CorreoElectronicoTutor',
        'DepartamentoTutor',
        'codigoProyecto',
        'FechaInicio',
        'FechaFinalizacion',
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
        return $this->belongsTo(ProfesUniversidad::class, 'DirectorID', 'id');
    }






}
