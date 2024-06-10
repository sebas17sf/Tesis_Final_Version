<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $primaryKey = 'proyectoId';

    protected $fillable = [
        'directorId',
        'nombreProyecto',
        'descripcionProyecto',
         'departamentoTutor',
        'codigoProyecto',
        'inicioFecha',
        'finFecha',
        'estado',
    ];

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'asignacionproyectos', 'proyectoId', 'estudianteId');
    }

    public function asignaciones()
    {
        return $this->hasMany(AsignacionProyecto::class, 'proyectoId', 'proyectoId');
    }

    public function director()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'directorId', 'id');
    }






}
