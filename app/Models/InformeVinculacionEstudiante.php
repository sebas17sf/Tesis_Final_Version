<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeVinculacionEstudiante extends Model
{
    use HasFactory;

    protected $table = 'informevinculacion_estudiantes';

    protected $fillable = [
        'estudianteId',
        'nombre_comunidad',
        'provincias',
        'cantones',
        'parroquias',
        'direcciones',
        'especificos',
        'alcanzados',
        'porcentajes',
        'conclusiones1',
        'conclusiones2',
        'conclusiones3',
        'recomendaciones'
    ];

    protected $casts = [
        'provincias' => 'array',
        'cantones' => 'array',
        'parroquias' => 'array',
        'direcciones' => 'array',
        'especificos' => 'array',
        'alcanzados' => 'array',
        'porcentajes' => 'array'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }
}
