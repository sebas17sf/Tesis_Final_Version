<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NrcPracticas1 extends Model
{
    use HasFactory;

    protected $table = 'nrc_practicas1';

    protected $fillable = [
        'id_periodo',
        'nrc',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id');
    }

    public function practicas()
    {
        return $this->hasMany(PracticaI::class, 'id_nrc_practicas1', 'id');
    }
}
