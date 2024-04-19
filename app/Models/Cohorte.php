<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohorte extends Model
{
    use HasFactory;
    protected $table = 'cohorte';
    protected $primaryKey = 'ID_cohorte';

    protected $fillable = [
        'Cohorte', 
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_cohorte', 'ID_cohorte');
    }
}
