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
        $path = public_path('img/logos/itin-presencial.png');

        return $this->subject('Recuperar Contraseña')
            ->attach($path, [
                'as' => 'itin-presencial.png',
                'mime' => 'image/png',
            ])
            ->markdown('emails.estudiante-aprobado')
            ->with('imageCid', 'itin-presencial.png');
    }

}
