<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPracticasv extends Model
{
    use HasFactory;

    protected $table = 'notas_practicasv';

    protected $fillable = [
        'estudianteId',
        'notaTutor',
        'notaAcademico'
    ];

    public $timestamps = true;

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }
}
