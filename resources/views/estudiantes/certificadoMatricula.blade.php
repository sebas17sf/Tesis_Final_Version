<!DOCTYPE html>
<html>

<head>
    <title>Certificado de Matrícula</title>
    <style>
        body {
            background-image: url('imagenespe.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            /* Elimina los márgenes por defecto */
        }

        .container {
            position: relative;
            max-width: 800px;
            /* Ajusta el ancho de tu contenido */
            margin: 0 auto;
            /* Centra el contenido en la página */
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            /* Fondo semi-transparente para el contenido */
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 200px;
            z-index: 1;
        }

        h1 {
            margin-top: 140px;
        }
    </style>
</head>

<body>
    <div class="container"> <img src="plantillas/favicon.jpg" class="logo" alt="Logotipo">

        <h1>Historico del Estudiante</h1>
        <p>Documento Generado por el Sistema Vinculacion-Practicas ESPE.</p>
        <hr>
        <h3>Datos del Estudiante</h3>
        <p><strong>Nombre:</strong> {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</p>
        <p><strong>Cohorte:</strong> {{ $estudiante->periodos->numeroPeriodo }}</p>
        <p><strong>Carrera:</strong> {{ $estudiante->carrera }}</p>
        <p><strong>Correo:</strong> {{ $estudiante->correo }}</p>
        <p><strong>Teléfono:</strong> {{ $estudiante->celular }}</p>
        <p><strong>Cédula:</strong> {{ $estudiante->cedula }}</p>
        <p><strong>ESPE ID:</strong> {{ $estudiante->espeId }}</p>
        <p><strong>Departamento:</strong> {{ $estudiante->departamento }}</p>

        <h4>Proceso actualemnete:</h4>

        <p><strong>Estado:</strong>
            @if ($estudiante->estado == 'Aprobado')
                Aprobado Vinculación
            @elseif ($estudiante->estado == 'Aprobado-practicas')
                Practicas
            @else
                {{ $estudiante->Estado }}
            @endif
        </p>

        <br>
        <h3>Información de los proceso realizados: </h3>


        <hr>



        <h3>Vinculación</h3>

        <table border="1">
            <thead>
                <tr>
                    <th>Nombre del proyecto</th>
                    <th>Director de proyecto</th>
                    <th>Docente participante</th>|
                    <th>Periodo de vinculación</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacion)
                    <td>{{ $asignacion->proyecto->nombreProyecto }}</td>
                    <td>{{ $asignacion->proyecto->director->apellidos }}
                        {{ $asignacion->proyecto->director->nombres }}</td>
                    <td>{{ $asignacion->docenteParticipante->apellidos }}
                        {{ $asignacion->docenteParticipante->nombres }}</td>
                    <td>{{ $asignacion->periodo->numeroPeriodo }}</td>
                    <td>{{ $asignacion->inicioFecha }}</td>
                    <td>{{ $asignacion->finalizacionFecha }}</td>
                @endforeach
            </tbody>


        </table>

        <hr>

        <h3>Practicas 1</h3>

        @php
            $tieneReprobado = $practicasi->contains(function ($practica) {
                return $practica->Estado == 'Reprobado';
            });
        @endphp

        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor academico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicasi as $practica)
                    @if ($practica->Estado != 'Reprobado')
                        <tr>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <td>{{ $practica->tutorAcademico->apellidos }}
                                {{ $practica->tutorAcademico->nombres }}</td>
                            <td>{{ $practica->periodoPractica }}</td>
                            <td>{{ $practica->FechaInicio }}</td>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        @if ($tieneReprobado)
            <h3>Prácticas 1 Reprobada</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Tutor academico</th>
                        <th>Periodo de la práctica</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Horas realizadas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($practicasi as $practica)
                        @if ($practica->Estado == 'Reprobado')
                            <tr>
                                <td>{{ $practica->empresa->nombreEmpresa }}</td>
                                <td>{{ $practica->tutorAcademico->apellidos }}
                                    {{ $practica->tutorAcademico->nombres }}</td>
                                <td>{{ $practica->periodoPractica }}</td>
                                <td>{{ $practica->FechaInicio }}</td>
                                <td>{{ $practica->FechaFinalizacion }}</td>
                                <td>{{ $practica->HorasPlanificadas }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif

        <h3>Practica 1.2 </h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor academico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicasiii as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }}
                            {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Practica 1.3 </h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor academico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicasiv as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }}
                            {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <h3>Practicas 2</h3>

        @php
            $tieneReprobado = $practicasii->contains(function ($practica) {
                return $practica->Estado == 'Reprobado';
            });

        @endphp

        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor academico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicasii as $practica)
                    @if ($practica->Estado != 'Reprobado')
                        <tr>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <td>{{ $practica->tutorAcademico->apellidos }}
                                {{ $practica->tutorAcademico->nombres }}</td>
                            <td>{{ $practica->periodoPractica }}</td>
                            <td>{{ $practica->FechaInicio }}</td>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>


        </table>


        @if ($tieneReprobado)
            <h3>Prácticas 2 Reprobada</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Tutor academico</th>
                        <th>Periodo de la práctica</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Horas realizadas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($practicasii as $practica)
                        <tr>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <td>{{ $practica->tutorAcademico->apellidos }}
                                {{ $practica->tutorAcademico->nombres }}</td>
                            <td>{{ $practica->periodoPractica }}</td>
                            <td>{{ $practica->FechaInicio }}</td>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

        <hr>

        <h3>Practicas 2.2</h3>

        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor academico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicasv as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }}
                            {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>








    </div>
</body>

</html>
