<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

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
        // Adjuntar la imagen y obtener el CID
        $imagePath = public_path('img/logos/itin-presencial.png');
        $cid = $this->embed($imagePath);

        return new Content(
            view: 'emails.director-asignacion',
            with: [
                'proyecto' => $this->proyecto,
                'estudiantes' => $this->estudiantesAsignados,
                'imageCid' => $cid, // Pasar el CID a la vista
            ],
        );
    }
}
