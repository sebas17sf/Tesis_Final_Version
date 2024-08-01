<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionProyecto extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'asignacionproyectos';

    // Nombre de la columna que es clave primaria en la tabla
    protected $primaryKey = 'asignacionID';

    // Campos que pueden ser llenados en masa (en el proceso de registro)
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
