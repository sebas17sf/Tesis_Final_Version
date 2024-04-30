<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsignacionEstudiantesDirector extends Model
{

    use HasFactory;

    protected $fillable = [
        'DirectorID',  
        'IDProyecto',
        'ParticipanteID',
        'EstudianteID',
        'FechaAsignacion',
    ];


    protected $table = 'asignacionEstudiantesDirector';

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'IDProyecto');
    }

    public function director()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'DirectorID');
    }

    public function participante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'ParticipanteID');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'EstudianteID');
    }
}
