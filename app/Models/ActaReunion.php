<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaReunion extends Model
{
    use HasFactory;

    protected $table = 'acta_reuniones';

    protected $fillable = [
        'participanteId',
        'proyectoId',
        'lugar',
        'tema',
        'fecha',
        'horaInicial',
        'horaFinal',
        'objetivo',
        'antecedentes',
        'acciones',
        'responsables',
        'fechaAcciones',
        'desarrollo',
    ];

    protected $casts = [
        'acciones' => 'array',
        'responsables' => 'array',
        'fechaAcciones' => 'array',
        'desarrollo' => 'array',

    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

}

