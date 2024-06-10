<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticaII extends Model
{
    use HasFactory;
    protected $table = 'practicasii';
    protected $primaryKey = 'PracticasII';

    protected $fillable = [
        'EstudianteID',
        'tipoPractica',
        'IDEmpresa',
        'idTutorAcademico',
        'nrc',
        'CedulaTutorEmpresarial',
        'NombreTutorEmpresarial',
        'Funcion',
        'TelefonoTutorEmpresarial',
        'EmailTutorEmpresarial',
        'DepartamentoTutorEmpresarial',
        'EstadoAcademico',
        'FechaInicio',
        'FechaFinalizacion',
        'HorasPlanificadas',
        'HoraEntrada',
        'HoraSalida',
        'AreaConocimiento',
        'Estado'

    ];
    public $timestamps = true;


    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'EstudianteID', 'EstudianteID');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'IDEmpresa', 'id');
    }

    public function tutorAcademico()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'idTutorAcademico', 'id');
    }



    public function actividades_practicas()
    {
        return $this->hasMany(ActividadesPracticas::class, 'IDPracticasI', 'PracticasI');
    }
}
