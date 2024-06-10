<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesPracticas extends Model
{
    use HasFactory;

    protected $table = 'actividades_practicas';


    protected $fillable = [
        'actividad',
        'horas',
        'estudianteId',
        'idPracticasi',
        'observaciones',
        'fechaActividad',
        'departamento',
        'funcion',
        'evidencia'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }

    public function practicas()
    {
        return $this->belongsTo(PracticaI::class, 'practicasi');
    }


}
