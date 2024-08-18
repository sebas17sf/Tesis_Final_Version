<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Estudiante;

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
        // Ruta de la imagen que se va a incrustar
        $imagePath = public_path('img/logos/itin-presencial.png');
        // Obtener el CID de la imagen para incrustarla en el correo
        $cid = $this->embed($imagePath);

        return $this->subject('Asignación de estudiantes')
            ->view('emails.director-asignacion')
            ->with([
                'proyecto' => $this->proyecto,
                'estudiantes' => $this->estudiantesAsignados,
                'imageCid' => $cid,  
            ]);
    }
}

