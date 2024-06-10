<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEstudiante extends Model
{
    use HasFactory;
    protected $table = 'actividades_estudiante';
    protected $primaryKey = 'idActividades';
    public $timestamps = true;

    protected $fillable = [
        'estudianteId',
        'fecha',
        'actividades',
        'numeroHoras',
        'evidencias',
        'nombreActividad',
    ];

    public function estudiante()
        {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
     }

}
