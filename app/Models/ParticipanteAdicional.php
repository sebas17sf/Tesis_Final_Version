<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteAdicional extends Model
{
    use HasFactory;

     protected $table = 'participantesAdicionales';

     protected $fillable = [
        'ProyectoID',
        'ParticipanteID',
    ];

 
    public $timestamps = true;

     public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ProyectoID', 'ProyectoID');
    }

    public function participante()
    {
        return $this->belongsTo(ProfesUniversidad::class, 'ParticipanteID', 'id');
    }
}
