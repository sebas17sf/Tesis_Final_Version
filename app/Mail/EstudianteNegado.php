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
    public $imageCid; // Se añade esta propiedad para almacenar el CID de la imagen

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
        return $this->subject('¡Lo sentimos! Tu estado ha sido negado')
            ->view('emails.estudiante-negado')
            ->with([
                'estudiante' => $this->estudiante,
                'motivoNegacion' => $this->motivoNegacion,
                'imageCid' => $this->imageCid, // Asegúrate de pasar el CID a la vista
            ])
            ->withSwiftMessage(function ($message) {
                $imagePath = public_path('img/logos/itin-presencial.png');
                $this->imageCid = $message->embed($imagePath); // Asigna el CID de la imagen a la propiedad
            });
    }
}


