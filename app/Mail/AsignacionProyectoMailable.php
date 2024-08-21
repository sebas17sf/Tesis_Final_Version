<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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
     * Build the message.
     */
    public function build()
    {
        $path = public_path('img/logos/itin-presencial.png');

        return $this->subject('Asignación de estudiantes')
            ->view('emails.director-asignacion')
            ->with([
                'proyecto' => $this->proyecto,
                'estudiantes' => $this->estudiantesAsignados,
            ])
            ->attach($path, [
                'as' => 'itin-presencial.png',
                'mime' => 'image/png',
            ])
            ->with('imageCid', 'itin-presencial.png');


    }
}
