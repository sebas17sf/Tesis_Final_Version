<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionProyecto extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'asignacionProyectos';

    // Nombre de la columna que es clave primaria en la tabla
    protected $primaryKey = 'AsignacionID';

    // Campos que pueden ser llenados en masa (en el proceso de registro)
    protected $fillable = [
        'EstudianteID',
        'ProyectoID',
        'FechaAsignacion',
        'ParticipanteID',
        'IdPeriodo',
        'id_nrc_vinculacion',
        'FechaInicio',
        'FechaFinalizacion'


    ];

    public $timestamps = false;

    // Definir relaciones
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'EstudianteID', 'EstudianteID');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ProyectoID', 'ProyectoID');
    }


    public function docenteParticipante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'ParticipanteID', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'IdPeriodo', 'id');
    }

    public function nrcVinculacion()
    {
        return $this->belongsTo(NrcVinculacion::class, 'id_nrc_vinculacion', 'id');
    }
}
