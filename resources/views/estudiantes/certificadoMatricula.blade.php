<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial del Estudiante</title>
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 200px;
        }

        .titulo {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: right;
            margin-left: 20px;
        }

        .titulo h1 {
            margin: -10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            text-transform: uppercase;

        }

        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }

        td {
            font-size: 11px;
        }

        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="img/logos/itin-presencial.png" class="logo" alt="Logotipo">
        <div class="titulo">
            <h1>Historial del Estudiante</h1>
            <p>Documento Generado por el Sistema Vinculación Prácticas.</p>
        </div>
    </div>
    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">

    <h4>Datos del estudiante</h4>
    <p><strong>Estudiante:</strong> {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</p>
    <p><strong>Cohorte:</strong> {{ $estudiante->periodos->numeroPeriodo }}</p>
    <p><strong>Carrera:</strong> {{ $estudiante->carrera }}</p>
    <p><strong>Correo:</strong> {{ $estudiante->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $estudiante->celular }}</p>
    <p><strong>Cédula:</strong> {{ $estudiante->cedula }}</p>
    <p><strong>ESPE ID:</strong> {{ $estudiante->espeId }}</p>
    <p><strong>Departamento:</strong> {{ $estudiante->departamento }}</p>

    <h4>Proceso actualmente:</h4>
    <p><strong>Estado:</strong>
        @if ($estudiante->estado == 'Aprobado')
            Aprobado Vinculación
        @elseif ($estudiante->estado == 'Aprobado-practicas')
            Practicas
        @else
            {{ $estudiante->Estado }}
        @endif
    </p>

    <div class="section-title">
        <h4>Información de los proceso realizados:</h4>
    </div>
    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">

    @if($asignaciones->isNotEmpty())
        <div class="section-title">
            <h4>Vinculación</h4>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NOMBRE DEL PROYECTO</th>
                    <th>Director de proyecto</th>
                    <th>Docente participante</th>
                    <th>Periodo de vinculación</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>NOTA FINAL</th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->proyecto->nombreProyecto }}</td>
                        <td>{{ $asignacion->proyecto->director->apellidos }}
                            {{ $asignacion->proyecto->director->nombres }}</td>
                        <td>{{ $asignacion->docenteParticipante->apellidos }}
                            {{ $asignacion->docenteParticipante->nombres }}</td>
                        <td>{{ $asignacion->periodo->numeroPeriodo }}</td>
                        <td>{{ $asignacion->inicioFecha }}</td>
                        <td>{{ $asignacion->finalizacionFecha }}</td>

                        <td>
                            @foreach ($asignacion->estudiante->horas_vinculacion as $hora)
                                {{ $hora->horasVinculacion ?? 'SIN HORAS' }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($asignacion->estudiante->notas as $nota)
                                {{ $nota->notaFinal }}<br>
                            @endforeach
                        </td>
                        <td>{{ $asignacion->estado }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif

    @if($practicasi->isNotEmpty())
        <div class="section-title">
            <h4>Prácticas 1</h4>
        </div>

        @php
            $tieneReprobado = $practicasi->contains(function ($practica) {
                return $practica->Estado == 'Reprobado';
            });
        @endphp

        <table>
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor empresarial</th>
                    <th>Tutor académico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>Nota Final</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practicasi as $practica)
                    @if ($practica->Estado != 'Reprobado')
                        <tr>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <td>{{ $practica->NombreTutorEmpresarial}}</td>
                            <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                            <td>{{ $practica->periodoPractica }}</td>
                            <td>{{ $practica->FechaInicio }}</td>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                            <td>{{ $practica->nota_final }}</td>
                            <td>{{ $practica->Estado }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="9">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($tieneReprobado)
            <div class="section-title">
                <h4>Prácticas 1 Reprobada</h4>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Tutor empresarial</th>
                        <th>Tutor académico</th>
                        <th>Periodo de la práctica</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Horas realizadas</th>
                        <th>Nota Final</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($practicasi as $practica)
                        @if ($practica->Estado == 'Reprobado')
                            <tr>
                                <td>{{ $practica->empresa->nombreEmpresa }}</td>
                                <td>{{ $practica->NombreTutorEmpresarial}}</td>
                                <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}
                                </td>
                                <td>{{ $practica->periodoPractica }}</td>
                                <td>{{ $practica->FechaInicio }}</td>
                                <td>{{ $practica->FechaFinalizacion }}</td>
                                <td>{{ $practica->HorasPlanificadas }}</td>
                                <td>{{ $practica->nota_final }}</td>
                                <td>{{ $practica->Estado }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9">No ha realizado este proceso.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    @endif

    @if($practicasiii->isNotEmpty())
        <div class="section-title">
            <h4>Práctica 1.2</h4>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor empresarial</th>
                    <th>Tutor académico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>Nota Final</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practicasiii as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->NombreTutorEmpresarial}}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                        <td>{{ $practica->nota_final }}</td>
                        <td>{{ $practica->Estado }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif

    @if($practicasiv->isNotEmpty())
        <div class="section-title">
            <h4>Práctica 1.3</h4>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor empresarial</th>
                    <th>Tutor académico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>Nota Final</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practicasiv as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->NombreTutorEmpresarial}}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                        <td>{{ $practica->nota_final }}</td>
                        <td>{{ $practica->Estado }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif

    @if($practicasii->isNotEmpty())
        <div class="section-title">
            <h4>Prácticas 2</h4>
        </div>

        @php
            $tieneReprobado = $practicasii->contains(function ($practica) {
                return $practica->Estado == 'Reprobado';
            });
        @endphp

        <table>
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor empresarial</th>
                    <th>Tutor académico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>Nota Final</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practicasii as $practica)
                    @if ($practica->Estado != 'Reprobado')
                        <tr>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <td>{{ $practica->NombreTutorEmpresarial}}</td>
                            <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                            <td>{{ $practica->periodoPractica }}</td>
                            <td>{{ $practica->FechaInicio }}</td>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                            <td>{{ $practica->nota_final }}</td>
                            <td>{{ $practica->Estado }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="9">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($tieneReprobado)
            <div class="section-title">
                <h4>Prácticas 2 Reprobada</h4>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Tutor empresarial</th>
                        <th>Tutor académico</th>
                        <th>Periodo de la práctica</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Horas realizadas</th>
                        <th>Nota Final</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($practicasii as $practica)
                        @if ($practica->Estado == 'Reprobado')
                            <tr>
                                <td>{{ $practica->empresa->nombreEmpresa }}</td>
                                <td>{{ $practica->NombreTutorEmpresarial}}</td>
                                <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}
                                </td>
                                <td>{{ $practica->periodoPractica }}</td>
                                <td>{{ $practica->FechaInicio }}</td>
                                <td>{{ $practica->FechaFinalizacion }}</td>
                                <td>{{ $practica->HorasPlanificadas }}</td>
                                <td>{{ $practica->nota_final }}</td>
                                <td>{{ $practica->Estado }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9">No ha realizado este proceso.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    @endif

    @if($practicasv->isNotEmpty())
        <div class="section-title">
            <h4>Prácticas 2.2</h4>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tutor empresarial</th>
                    <th>Tutor académico</th>
                    <th>Periodo de la práctica</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas realizadas</th>
                    <th>Nota Final</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practicasv as $practica)
                    <tr>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <td>{{ $practica->NombreTutorEmpresarial}}</td>
                        <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                        <td>{{ $practica->periodoPractica }}</td>
                        <td>{{ $practica->FechaInicio }}</td>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                        <td>{{ $practica->nota_final }}</td>
                        <td>{{ $practica->Estado }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</body>

</html>
