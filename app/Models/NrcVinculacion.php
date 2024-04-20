<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NrcVinculacion extends Model
{
    protected $table = 'nrc_vinculacion';  
    protected $fillable = [
        'id_periodo', 'nrc'
    ];

     public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }
}
