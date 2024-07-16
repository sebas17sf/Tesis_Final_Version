<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesPracticasII extends Model
{
    use HasFactory;

    protected $table = 'actividades_practicasii';

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

    public $timestamps = true;

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }

    public function practicasii()
    {
        return $this->belongsTo(PracticaII::class, 'practicasII');
    }





}
