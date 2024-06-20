<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        /*Parrafo de Información*/
        p {
            margin-bottom: 20px;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 20px;
        }


        /* Diseño para el texto del footer */
        .small-text {
            font-size: 10px;
            color: #2e8b57;
            text-align: justify;
        }

        .small-text p {
            margin: 0;
        }

        .important-text {
            font-size: 12px;
            color: #213028;
        }


        /*Linea */
        hr {
            border: 0;
            height: 2px;
            background-color: #060e09;
            margin: 20px 0;
        }

        /*Imagen Principal*/
        .container img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 20px;
        }

        /* Imagenes del Footer */
        #reducir-img {
            text-align: center;
        }

        #reducir-img img {
            max-width: 50%;
            height: auto;
            display: inline-block;
            margin: 10px;
        }
    </style>

</head>

<body>
    <div class="container">
        <img src="https://ugvc.espe.edu.ec/wp-content/uploads/2023/08/ugvc.png" alt="Redes Sociales">

        <h1>Restablecimiento de contraseña</h1>
        <p>Recibes este correo porque has solicitado restablecer tu contraseña en nuestro sistema.</p>

        <p>Por motivos de seguridad, te proporcionamos algunos detalles de tu cuenta:</p>
        <ul>
            @if ($estudiante)
                <li><strong>Nombre:</strong> {{ $estudiante->nombres}}</li>
                <li><strong>Apellido:</strong> {{ $estudiante->apellidos }}</li>
                <li><strong>ID ESPE:</strong> {{ $estudiante->espeId }}</li>
                <li><strong>Celular:</strong> {{ $estudiante->celular }}</li>
                <li><strong>Cedula:</strong> {{ $estudiante->cedula }}</li>
                <li><strong>Carrera:</strong> {{ $estudiante->carrera }}</li>
                <li><strong>Cohorte:</strong> {{ $estudiante->periodos->numeroPeriodo }}</li>
                <li><strong>Cohorte:</strong> {{ $estudiante->periodos->periodo }}</li>
                <li><strong>Correo Electrónico:</strong> {{ $estudiante->correo }}</li>
                <li><strong>Departamento:</strong> {{ $estudiante->departamento }}</li>
            @else
                <p>Aún no has proporcionado tu información académica.</p>
            @endif
        </ul>

        <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
        <p><a href="{{ route('mostrar-formulario-restablecimiento', ['token' => $token]) }}">Restablecer Contraseña</a>
        </p>


        <p>Si no has solicitado restablecer tu contraseña, puedes ignorar este correo.</p>

        <p>Por favor, no dudes en contactarnos si necesitas más información o asistencia.</p>
        <p>¡Gracias!</p>
        <p>Saludos cordiales,</p>
        <p>Equipo de Soporte</p>



        <div id="reducir-img">
            <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4z7EUv_PXmbRrZEFi4sUWPhKIGo595K0D9DrrY6_XH22qpDcSqp_aPpadwhPUgAwfuaskljR3M"
                alt="Unidad de Comunicación Social">
            <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4x5EBSmRrh-hB6hbSTg0NscUtGd6kunbMt2OzYMIsP8uUr9ZMIFovoHmLXV8O_ZJe7O991hAXw"
                alt="Redes Sociales">
        </div>


        <hr>
        <div class="small-text">
            <p>Antes de imprimir este mensaje, piense en su responsabilidad con la naturaleza. Quizás
                no puedes salvar el planeta, pero si puedes dejar de destruirlo.</p>
            <hr>
            <i class="important-text">
                “<b>Importante:</b> La información contenida en este mensaje y sus anexos tiene
                carácter confidencial, y está dirigida únicamente al destinatario de la misma y sólo
                podrá ser usada por éste. Si el lector de este mensaje no es el destinatario del
                mismo, se le notifica que cualquier copia o distribución de éste se encuentra
                totalmente prohibida. Si usted ha recibido este mensaje por error, por favor
                notifique inmediatamente al remitente por este mismo medio y borre el mensaje. Las
                opiniones que contenga este mensaje son exclusivas de su autor y no necesariamente
                representan la opinión oficial de la UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE.”
            </i>
        </div>



    </div>
</body>

</html>
