<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Estudiante;

class EstudianteNegado extends Mailable
{
    use Queueable, SerializesModels;

    public $estudiante;
    public $motivoNegacion;

    /**
     * Create a new message instance.
     *
     * @param Estudiante $estudiante
     * @param string $motivoNegacion
     */
    public function __construct(Estudiante $estudiante, $motivoNegacion)
    {
        $this->estudiante = $estudiante;
        $this->motivoNegacion = $motivoNegacion;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $path = public_path('img/logos/itin-presencial.png');

        return $this->subject('¡Lo sentimos! Tu estado ha sido negado')
            ->attach($path, [
                'as' => 'itin-presencial.png',
                'mime' => 'image/png',
            ])
            ->markdown('emails.estudiante-negado')
            ->with([
                'estudiante' => $this->estudiante,
                'motivoNegacion' => $this->motivoNegacion,
                'imageCid' => 'itin-presencial.png', // Pasar la imagen adjunta como CID (si es necesario)
            ]);
    }
}
