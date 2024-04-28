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
        'DirectorID', 
         'FechaAsignacion',

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

    public function director()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'id_directorProyecto');
     }

    public function docenteParticipante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'id_docenteParticipante');
    }
}
