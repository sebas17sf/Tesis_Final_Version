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
        .no-border-table {
        border-collapse: collapse;
        width: 100%;
    }

    .no-border-table th, .no-border-table td {
        border: none;
        padding: 8px;
        text-align: left;
        font-size: .8em;
    }

    .no-border-table th {
        width: 20%;
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

    <h4>DATOS DEL ESTUDIANTE</h4>

    <table class="no-border-table">
    <tr>
        <th>Estudiante:</th>
        <td>{{ $estudiante->apellidos }} {{ $estudiante->nombres }}</td>
        <th>Teléfono:</th>
        <td>{{ $estudiante->celular }}</td>
    </tr>
    <tr>
        <th>Cohorte:</th>
        <td>{{ $estudiante->periodos->numeroPeriodo }}</td>
        <th>Cédula:</th>
        <td>{{ $estudiante->cedula }}</td>
    </tr>
    <tr>
        <th>Carrera:</th>
        <td>{{ $estudiante->carrera }}</td>
        <th>ESPE ID:</th>
        <td>{{ $estudiante->espeId }}</td>
    </tr>

        <th>Correo:</th>
        <td style="text-transform: lowercase;">{{ $estudiante->correo }}</td>
        <th>Departamento:</th>
        <td>{{ $estudiante->departamento->departamento }}</td>
    </tr>
    <tr>
        <th>Campus:</th>
        <td>EXTENSIÓN SANTO DOMINGO</td>

    <tr>
</table>

    <h4>Proceso actualmente:</h4>
    <p><strong>Estado:</strong>
        @if ($finalizadoProcesos)
            Finalizado procesos
        @elseif ($estudiante->estado == 'Aprobado')
            Vinculación
        @elseif ($estudiante->estado == 'Aprobado-practicas')
            Practicas
        @else
            {{ $estudiante->estado }}
        @endif
    </p>

    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">

    <div class="section-title">
        <h4>INFORMACIÓN DE PROCESOS REALIZADOS</h4>
    </div>

    <hr style="color: rgb(17, 31, 95);">


    @if($asignaciones->isNotEmpty())
    <div class="section-title">
        <h4>VINCULACIÓN</h4>
    </div>

    <table class="no-border-table">
        <tbody>
            @forelse ($asignaciones as $asignacion)
                <tr>
                    <th>NOMBRE DEL PROYECTO:</th>
                    <td>{{ $asignacion->proyecto->nombreProyecto }}</td>
                    <th>Director de proyecto:</th>
                    <td>{{ $asignacion->proyecto->director->apellidos }} {{ $asignacion->proyecto->director->nombres }}</td>
                </tr>
                <tr>
                    <th>Docente participante:</th>
                    <td>{{ $asignacion->docenteParticipante->apellidos }} {{ $asignacion->docenteParticipante->nombres }}</td>
                    <th>Periodo de vinculación:</th>
                    <td>{{ $asignacion->periodo->numeroPeriodo }}</td>
                </tr>
                <tr>
                    <th>Fecha Inicio:</th>
                    <td>{{ $asignacion->inicioFecha }}</td>
                    <th>Fecha Fin:</th>
                    <td>{{ $asignacion->finalizacionFecha }}</td>
                </tr>
                <tr>
                    <th>Horas realizadas:</th>
                    <td>
                        @foreach ($asignacion->estudiante->horas_vinculacion as $hora)
                            {{ $hora->horasVinculacion ?? 'SIN HORAS' }}<br>
                        @endforeach
                    </td>
                    <th>NOTA FINAL:</th>
                    <td>
                        @foreach ($asignacion->estudiante->notas as $nota)
                            {{ $nota->notaFinal }}<br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>ESTADO:</th>
                    <td colspan="3">{{ $asignacion->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endif
<br>
<br>
<hr style="color: rgb(17, 31, 95);">
<hr style="color: rgb(17, 31, 95);">

@if($practicasi->isNotEmpty())
    <div class="section-title">
        <h4>PRÁCTICA 1</h4>
    </div>

    @php
        $tieneReprobado = $practicasi->contains(function ($practica) {
            return $practica->Estado == 'Reprobado';
        });
    @endphp

    <table class="no-border-table">
        <tbody>
            @forelse ($practicasi as $practica)
                @if ($practica->Estado != 'Reprobado')
                    <tr>
                        <th>Empresa</th>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <th>Tutor empresarial</th>
                        <td>{{ $practica->NombreTutorEmpresarial}}</td>
                    </tr>




                        <th>Tutor académico</th>
                        <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                        <th>Periodo de la práctica</th>
                        <td>{{ $practica->periodoPractica }}</td>
                    </tr>
                    <tr>
                        <th>Fecha Inicio</th>
                        <td>{{ $practica->FechaInicio }}</td>
                        <th>Fecha Fin</th>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                    </tr>
                    <tr>
                        <th>Horas realizadas</th>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                        <th>Nota Final</th>
                        <td>{{ $practica->nota_final }}</td>
                    </tr>
                    <tr>
                    <th>Tipo de práctica</th>
                    <td>{{ $practica->tipoPractica }}</td>
                        <th>Estado</th>
                        <td colspan="3">{{ $practica->Estado }}</td>

                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($tieneReprobado)
        <div class="section-title">
            <h4>PRÁCTICA 1 REPROBADA</h4>
        </div>
        <table class="no-border-table">
            <tbody>
                @forelse ($practicasi as $practica)
                    @if ($practica->Estado == 'Reprobado')
                        <tr>
                            <th>Empresa</th>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <th>Tutor empresarial</th>
                            <td>{{ $practica->NombreTutorEmpresarial}}</td>
                        </tr>
                        <tr>
                            <th>Tutor académico</th>
                            <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                            <th>Periodo de la práctica</th>
                            <td>{{ $practica->periodoPractica }}</td>
                        </tr>
                        <tr>
                            <th>Fecha Inicio</th>
                            <td>{{ $practica->FechaInicio }}</td>
                            <th>Fecha Fin</th>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                        </tr>
                        <tr>
                            <th>Horas realizadas</th>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                            <th>Nota Final</th>
                            <td>{{ $practica->nota_final }}</td>
                        </tr>
                        <tr>
                        <th>Tipo de práctica</th>
                        <td>{{ $practica->tipoPractica }}</td>
                            <th>Estado</th>
                            <td colspan="3">{{ $practica->Estado }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
    <br>
<hr style="color: rgb(17, 31, 95);">
<hr style="color: rgb(17, 31, 95);">
@endif

@if($practicasiii->isNotEmpty())
    <div class="section-title">
        <h4>PRÁCTICA 1.2</h4>
    </div>

    <table class="no-border-table">
        <tbody>
            @forelse ($practicasiii as $practica)
                <tr>
                    <th>Empresa</th>
                    <td>{{ $practica->empresa->nombreEmpresa }}</td>
                    <th>Tutor empresarial</th>
                    <td>{{ $practica->NombreTutorEmpresarial }}</td>
                </tr>
                <tr>
                    <th>Tutor académico</th>
                    <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                    <th>Periodo de la práctica</th>
                    <td>{{ $practica->periodoPractica }}</td>
                </tr>
                <tr>
                    <th>Fecha Inicio</th>
                    <td>{{ $practica->FechaInicio }}</td>
                    <th>Fecha Fin</th>
                    <td>{{ $practica->FechaFinalizacion }}</td>
                </tr>
                <tr>
                    <th>Horas realizadas</th>
                    <td>{{ $practica->HorasPlanificadas }}</td>
                    <th>Nota Final</th>
                    <td>{{ $practica->nota_final }}</td>
                </tr>
                <tr>
                <th>Tipo de práctica</th>
                <td>{{ $practica->tipoPractica }}</td>
                    <th>Estado</th>
                    <td colspan="3">{{ $practica->Estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">
@endif

    @if($practicasiv->isNotEmpty())
    <div class="section-title">
        <h4>PRÁCTICA 1.3</h4>
    </div>

    <table class="no-border-table">
        <tbody>
            @forelse ($practicasiv as $practica)
                <tr>
                    <th>Empresa</th>
                    <td>{{ $practica->empresa->nombreEmpresa }}</td>
                    <th>Tutor empresarial</th>
                    <td>{{ $practica->NombreTutorEmpresarial }}</td>
                </tr>
                <tr>
                    <th>Tutor académico</th>
                    <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                    <th>Periodo de la práctica</th>
                    <td>{{ $practica->periodoPractica }}</td>
                </tr>
                <tr>
                    <th>Fecha Inicio</th>
                    <td>{{ $practica->FechaInicio }}</td>
                    <th>Fecha Fin</th>
                    <td>{{ $practica->FechaFinalizacion }}</td>
                </tr>
                <tr>
                    <th>Horas realizadas</th>
                    <td>{{ $practica->HorasPlanificadas }}</td>
                    <th>Nota Final</th>
                    <td>{{ $practica->nota_final }}</td>
                </tr>
                <tr>
                <th>Tipo de práctica</th>
                <td>{{ $practica->tipoPractica }}</td>
                    <th>Estado</th>
                    <td colspan="3">{{ $practica->Estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">
@endif

    @if($practicasii->isNotEmpty())
    <div class="section-title">
        <h4>PRÁCTICA 2</h4>
    </div>

    @php
        $tieneReprobado = $practicasii->contains(function ($practica) {
            return $practica->Estado == 'Reprobado';
        });
    @endphp

    <table class="no-border-table">
        <tbody>
            @forelse ($practicasii as $practica)
                @if ($practica->Estado != 'Reprobado')
                    <tr>
                        <th>Empresa</th>
                        <td>{{ $practica->empresa->nombreEmpresa }}</td>
                        <th>Tutor empresarial</th>
                        <td>{{ $practica->NombreTutorEmpresarial}}</td>
                    </tr>
                    <tr>
                        <th>Tutor académico</th>
                        <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                        <th>Periodo de la práctica</th>
                        <td>{{ $practica->periodoPractica }}</td>
                    </tr>
                    <tr>
                        <th>Fecha Inicio</th>
                        <td>{{ $practica->FechaInicio }}</td>
                        <th>Fecha Fin</th>
                        <td>{{ $practica->FechaFinalizacion }}</td>
                    </tr>
                    <tr>
                        <th>Horas realizadas</th>
                        <td>{{ $practica->HorasPlanificadas }}</td>
                        <th>Nota Final</th>
                        <td>{{ $practica->nota_final }}</td>
                    </tr>
                    <tr>
                    <th>Tipo de práctica</th>
                    <td>{{ $practica->tipoPractica }}</td>
                        <th>Estado</th>
                        <td colspan="3">{{ $practica->Estado }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($tieneReprobado)
        <div class="section-title">
            <h4>PRÁCTICA 2 REPROBADA</h4>
        </div>
        <table class="no-border-table">
            <tbody>
                @forelse ($practicasii as $practica)
                    @if ($practica->Estado == 'Reprobado')
                        <tr>
                            <th>Empresa:</th>
                            <td>{{ $practica->empresa->nombreEmpresa }}</td>
                            <th>Tutor empresarial:</th>
                            <td>{{ $practica->NombreTutorEmpresarial}}</td>
                        </tr>
                        <tr>
                            <th>Tutor académico:</th>
                            <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                            <th>Periodo de la práctica:</th>
                            <td>{{ $practica->periodoPractica }}</td>
                        </tr>
                        <tr>
                            <th>Fecha Inicio:</th>
                            <td>{{ $practica->FechaInicio }}</td>
                            <th>Fecha Fin:</th>
                            <td>{{ $practica->FechaFinalizacion }}</td>
                        </tr>
                        <tr>
                            <th>Horas realizadas:</th>
                            <td>{{ $practica->HorasPlanificadas }}</td>
                            <th>Nota Final:</th>
                            <td>{{ $practica->nota_final }}</td>
                        </tr>
                        <tr>
                        <th>Tipo de práctica</th>
                        <td>{{ $practica->tipoPractica }}</td>
                            <th>Estado:</th>
                            <td colspan="3">{{ $practica->Estado }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4">No ha realizado este proceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
@endif
    <br>
    <hr style="color: rgb(17, 31, 95);">
    <hr style="color: rgb(17, 31, 95);">
    @if($practicasv->isNotEmpty())
    <div class="section-title">
        <h4>PRÁCTICA 2.2</h4>
    </div>

    <table class="no-border-table">
        <tbody>
            @forelse ($practicasv as $practica)
                <tr>
                    <th>Empresa</th>
                    <td>{{ $practica->empresa->nombreEmpresa }}</td>
                    <th>Tutor empresarial</th>
                    <td>{{ $practica->NombreTutorEmpresarial }}</td>
                </tr>
                <tr>
                    <th>Tutor académico</th>
                    <td>{{ $practica->tutorAcademico->apellidos }} {{ $practica->tutorAcademico->nombres }}</td>
                    <th>Periodo de la práctica</th>
                    <td>{{ $practica->periodoPractica }}</td>
                </tr>
                <tr>
                    <th>Fecha Inicio</th>
                    <td>{{ $practica->FechaInicio }}</td>
                    <th>Fecha Fin</th>
                    <td>{{ $practica->FechaFinalizacion }}</td>
                </tr>
                <tr>
                    <th>Horas realizadas</th>
                    <td>{{ $practica->HorasPlanificadas }}</td>
                    <th>Nota Final</th>
                    <td>{{ $practica->nota_final }}</td>
                </tr>
                <tr>
                <th>Tipo de práctica</th>
                <td>{{ $practica->tipoPractica }}</td>
                    <th>Estado</th>
                    <td colspan="3">{{ $practica->Estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No ha realizado este proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endif
</body>

</html>
