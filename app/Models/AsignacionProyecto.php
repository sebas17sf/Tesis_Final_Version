<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionProyecto extends Model
{
    use HasFactory;

     protected $table = 'asignacionproyectos';

     protected $primaryKey = 'asignacionID';

     protected $fillable = [
        'estudianteId',
        'proyectoId',
        'participanteId',
        'idPeriodo',
        'nrc',
        'inicioFecha',
        'finalizacionFecha',
        'asignacionFecha',
        'estado'

    ];

    public $timestamps = false;

    // Definir relaciones
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId', 'estudianteId');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId', 'proyectoId');
    }


    public function docenteParticipante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'participanteId', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo', 'id');
    }

    public function nrcVinculacion()
    {
        return $this->belongsTo(NrcVinculacion::class, 'nrc', 'id');
    }
}
