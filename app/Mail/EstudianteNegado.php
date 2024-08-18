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
        return $this->subject('¡Lo sentimos! Tu estado ha sido negado')
            ->view('emails.estudiante-negado')
            ->with([
                'estudiante' => $this->estudiante,
                'motivoNegacion' => $this->motivoNegacion,
            ])
            ->withSwiftMessage(function ($message) {
                $imagePath = public_path('img/logos/itin-presencial.png');
                $cid = $message->embed($imagePath);
                $this->with(['imageCid' => $cid]);
            });
    }
}

