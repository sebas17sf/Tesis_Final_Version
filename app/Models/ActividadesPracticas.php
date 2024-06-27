<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
use App\Models\PracticaI;
use App\Models\PracticaII;

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

    public function practicasii()
    {
        return $this->belongsTo(PracticaII::class, 'practicasII');
    }





}
