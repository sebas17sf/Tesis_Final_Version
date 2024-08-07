<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeParticipanteVinculacion extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'informeparticipante_vinculacion';

    // Propiedades que se pueden asignar en masa
    protected $fillable = [
        'participanteId',
        'objetivos',
        'intervencion',
        'actividadesPlanificadas',
        'resultadosAlcanzados',
        'porcentajesAlcanzados',
        'hombres',
        'mujeres',
        'niños',
        'personasConDiscapacidad',
        'observacionesHombres',
        'observacionesMujeres',
        'observacionesNiños',
        'observacionesPersonasConCapacidad',
        'conclusiones',
        'recomendaciones'
    ];

    // Cast JSON fields to arrays
    protected $casts = [
        'actividadesPlanificadas' => 'array',
        'resultadosAlcanzados' => 'array',
        'porcentajesAlcanzados' => 'array',
    ];

    // Relación con el modelo de Participante
    public function participante()
    {
        return $this->belongsTo(Profesuniversidad::class, 'participanteId');
    }
}
