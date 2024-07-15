<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPracticasiv extends Model
{
    use HasFactory;

    protected $table = 'notas_practicasiv';

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
