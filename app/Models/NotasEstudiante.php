<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasEstudiante extends Model
{
    use HasFactory;
    protected $table = 'notas_estudiante';
    protected $primaryKey = 'idNotas';

    protected $fillable = [
         'estudianteId',
        'tareas',
        'resultadosAlcanzados',
        'conocimientos',
        'adaptabilidad',
        'aplicacion',
        'CapacidadLiderazgo',
        'asistencia',
        'informe',
        'notaFinal',
    ];
    public $timestamps = true;

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId', 'estudianteId');
    }



}
