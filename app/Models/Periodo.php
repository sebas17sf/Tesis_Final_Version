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
        'Periodo', 
        'PeriodoInicio',
        'PeriodoFin',
        'numeroPeriodo'
    ];
    public $timestamps = false;

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_periodo', 'id');
    }

}
