<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticaI extends Model
{
    use HasFactory;

    protected $table = 'practicasi';
    protected $primaryKey = 'practicasi';

    protected $fillable = [
        'estudianteId',
        'tipoPractica',
        'idEmpresa',
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
        return $this->belongsTo(Estudiante::class, 'estudianteId', 'estudianteId');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idEmpresa', 'id');
    }

    public function tutorAcademico()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'idTutorAcademico', 'id');
    }


    public function actividades_practicas()
    {
        return $this->hasMany(ActividadesPracticas::class, 'IDPracticasI', 'PracticasI');
    }

    ////nrc
    


}
