<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraVinculacion extends Model
{
    use HasFactory;

    protected $table = 'horas_vinculacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'estudianteId',
        'horasVinculacion'
    ];

    public $timestamps = true;


    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }
}
