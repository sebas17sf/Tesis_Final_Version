<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesPracticas extends Model
{
    use HasFactory;

    protected $table = 'actividades_practicas';

 
    protected $fillable = [
        'Actividad',
        'horas',
        'EstudianteID',
        'IDPracticasI',
        'observaciones',
        'fechaActividad',
        'departamento',
        'funcion',
        'evidencia'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'EstudianteID');
    }

    public function practicas()
    {
        return $this->belongsTo(PracticaI::class, 'IDPracticasI');
    }

    
}
