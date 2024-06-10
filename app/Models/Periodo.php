<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodo';
    protected $primaryKey = 'id';

    protected $fillable = [
        'periodo',
        'numeroPeriodo',
        'inicioPeriodo',
        'finPeriodo'
    ];
    public $timestamps = false;

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'idPeriodo', 'id');
    }

    public function asignacionProyectos()
    {
        return $this->hasMany(AsignacionProyecto::class, 'idPeriodo', 'id');
    }

}
