<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosSession extends Model
{
    use HasFactory;
    protected $table = 'usuarios_sessions';

    protected $fillable = [
        'UserID',
        'session_id',
        'start_time',
        'end_time',
        'ip_address',
        'user_agent',
        'locality',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UserID', 'UserID');
    }
}
