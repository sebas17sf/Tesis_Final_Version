<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticaI extends Model
{
    use HasFactory;

    protected $table = 'practicasi';
    protected $primaryKey = 'PracticasI';

    protected $fillable = [
        'EstudianteID',
        'tipoPractica',
        'IDEmpresa',
        'ID_tutorAcademico',
        'id_nrc_practicas1',
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
        return $this->belongsTo(ProfesUniversidad::class, 'ID_tutorAcademico', 'id');
    }

    public function nrcPractica()
    {
        return $this->belongsTo(NrcPracticas1::class, 'id_nrc_practicas1', 'id');
    }
}
