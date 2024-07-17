<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AsignacionProyectoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $estudiantesAsignados;

    /**
     * Create a new message instance.
     *
     * @param $proyecto Datos del proyecto.
     * @param $estudiantesAsignados Lista de estudiantes asignados.
     */
    public function __construct($proyecto, $estudiantesAsignados)
    {
        $this->proyecto = $proyecto;
        $this->estudiantesAsignados = $estudiantesAsignados;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Asignación de estudiantes',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.director-asignacion',
            // Ensure you pass the correct variables to the view
            with: [
                'proyecto' => $this->proyecto,
                'estudiantes' => $this->estudiantesAsignados,
            ],
        );
    }

}
