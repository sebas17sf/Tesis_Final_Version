<?php

namespace App\Mail;

use App\Models\Usuario;
use App\Models\Estudiante;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarContrasena extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $estudiante;

    /**
     * Create a new message instance.
     *
     * @param Usuario|null $usuario
     * @param Estudiante|null $estudiante
     */
    public function __construct(?Usuario $usuario, ?Estudiante $estudiante)
    {
        $this->usuario = $usuario;
        $this->estudiante = $estudiante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recuperar Contraseña')
                    ->markdown('emails.recuperar-contrasena');
    }
}
