<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
use App\Models\ProfesUniversidad;
use App\Models\Periodo;

class AsignacionSinEstudiante extends Model
{
    use HasFactory;

    protected $table = 'asignacion_sin_estudiantes';

    protected $fillable = [
        'proyectoId',
        'participanteId',
        'idPeriodo',
        'inicioFecha',
        'finalizacionFecha',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

    public function docenteParticipante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'participanteId', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo');
    }


}
