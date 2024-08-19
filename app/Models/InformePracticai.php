<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformePracticai extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'informePracticai';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'introduccion',
        'conclusion',
        'recomendaciones',
        'estudianteId',
    ];

    /**
     * Obtener el estudiante asociado con el informe.
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
