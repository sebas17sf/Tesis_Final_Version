<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NrcVinculacion extends Model
{
    protected $table = 'nrc';
    protected $fillable = [
        'idPeriodo', 'nrc', 'tipo'
    ];

     public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo', 'id');
    }

    public function practicas()
    {
        return $this->hasMany(PracticaI::class, 'nrc', 'id');
    }
}
