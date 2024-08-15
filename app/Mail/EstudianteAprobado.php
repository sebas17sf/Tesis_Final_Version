<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Estudiante;

class EstudianteAprobado extends Mailable
{
    use SerializesModels;

    public $estudiante;

    public function __construct(Estudiante $estudiante)
    {
        $this->estudiante = $estudiante;
    }





    public function build()
    {
        $this->subject('¡Felicidades! Tu estado ha sido aprobado')
            ->view('emails.estudiante-aprobado')
            ->withSwiftMessage(function ($message) {
                $imagePath = public_path('img/logos/itin-presencial.png');
                $cid = $message->embed($imagePath);
                $this->with('imageCid', $cid);
            });

        return $this;
    }
}
