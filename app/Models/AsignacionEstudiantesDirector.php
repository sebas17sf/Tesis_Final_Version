<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionEstudiantesDirector extends Model
{
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
