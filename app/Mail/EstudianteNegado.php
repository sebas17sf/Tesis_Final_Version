<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Estudiante;

class EstudianteNegado extends Mailable
{
    use Queueable, SerializesModels;

    public $estudiante;
    public $motivoNegacion;

    public function __construct(Estudiante $estudiante, $motivoNegacion)
    {
        $this->estudiante = $estudiante;
        $this->motivoNegacion = $motivoNegacion;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('¡Lo sentimos! Tu estado ha sido negado')
                    ->view('emails.estudiante-negado');
    }

}