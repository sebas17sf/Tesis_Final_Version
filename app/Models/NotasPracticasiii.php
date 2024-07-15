<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPracticasiii extends Model
{
    use HasFactory;

    protected $table = 'notas_practicasiii';

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
