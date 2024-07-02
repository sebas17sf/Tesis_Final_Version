@extends('layouts.directorVinculacion')
@section('title', 'Panel Estudiante')

@section('title_component', 'Panel Estudiantes')
@section('content')
@if (session('success'))
<div class="contenedor_alerta success">
    <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
    <div class="content_alert">
        <div class="title">Éxito!</div>
        <div class="body">{{ session('success') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif


@if (session('error'))
<div class="contenedor_alerta error">
    <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
    <div class="content_alert">
        <div class="title">Error!</div>
        <div class="body">{{ session('error') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif


    <div class="container" style="overflow-x: auto;">


        <h4><b>Estudiantes por calificar</b></h4>

        <hr>
        @if (count($estudiantesConNotasPendientes) === 0)
            <p>El docente participante aun no a calificado a los estudiantes.</p>
        @else
            <h4>Actualizar Informe de Servicio Comunitario</h4>
            <form method="post" action="{{ route('director_vinculacion.actualizarInforme') }}">
                @csrf
                <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                        <th>Nombres</th>
                            <th>Espe ID</th>
                            <th>Carrera</th>
                            <th>Departamento</th>
                            <th>Informe de Servicio Comunitario 30%</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantesConNotasPendientes as $estudiante)
                            <tr>
                                <td class="wide-cell">{{ $estudiante->apellidos }} {{ $estudiante->nombres }}</td>
                                <td>{{ $estudiante->espeId }}</td>
                                <td class="wide-cell">{{ $estudiante->carrera }}</td>
                                <td>{{ $estudiante->departamento }}</td>
                                <td>
                                    <input type="hidden" class="input input_select1" name="estudiante_id[]" value="{{ $estudiante->estudianteId }}">
                                    <input type="text" class="input" name="informe_servicio[]" value="{{ $estudiante->notas->first()->Informe !== 'Pendiente' ? $estudiante->notas->first()->Informe : '' }}" @if($estudiante->notas->first()->Informe === 'Pendiente') style="display: none;" @endif required>

                                     <small class="form-text text-danger" style="display: none;"></small>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
</div>
</div>
</div>
                <br>
                <button type="submit" class="button1">Guardar calificacion</button>
                <br>
                <hr>
            </form>
        @endif

        <h4><b>Estudiantes Calificados</b></h4>
        <hr>
        @if (count($estudiantesCalificados) === 0)
            <p>No hay estudiantes calificados en este momento.</p>
        @else
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                        <th class="tamanio1">NOMBRES</th>
                        <th>ESPE ID</th>
                        <th class= "tamanio1">CARRERA</th>
                        <th class= "tamanio1">DEPARTAMENTO</th>
                        <th>TAREAS</th>
                        <th>RESULTADOS ALCANZADOS</th>
                        <th>CONOCIMIENTOS EN EL ÁREA</th>
                        <th>ADAPTABILIDAD</th>
                        <th>APLICACION DE DESTREZAS Y HABILIDADES</th>
                        <th>CAPACIDAD DE LIDERAZGO</th>
                        <th>ASISTENCIA</th>
                        <th>INFORME DE SERVICIO COMINITARIO</th>
                        <th>NOTA FINAL</th>
                        <th>EDITAR NOTAS</th>
                    </tr>
                </thead>
                <tbody class="mdc-data-table__content ng-star-inserted">
                    @foreach ($estudiantesCalificados as $estudiante)
                        <tr>
                            <td class="wide-cell" style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ $estudiante->apellidos }} {{ $estudiante->nombres }}</td>
                            <td>{{ $estudiante->espeId }}</td>
                            <td class="wide-cell" style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ $estudiante->carrera }}</td>
                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ $estudiante->departamento }}</td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->tareas }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->resultadosAlcanzados }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->conocimientos }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->adaptabilidad }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->aplicacion }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->CapacidadLiderazgo }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->asistencia }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->informe }}<br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @php
                                    $notaTotal = $estudiante->notas->sum(function ($nota) {
                                        return $nota->tareas +
                                            $nota->resultadosAlcanzados +
                                            $nota->conocimientos +
                                            $nota->adaptabilidad +
                                            $nota->aplicacion +
                                            $nota->CapacidadLiderazgo +
                                            $nota->asistencia +
                                            $nota->informe;
                                    });
                                    $notaFinal = ($notaTotal * 20) / 100;
                                @endphp
                                {{ $notaFinal }}
                            </td>

                            <td style="text-align: center;">
                                <center><button class="button3 efects_button btn_editar3" data-toggle="modal"
                                data-target="#modalEditarInforme{{ $estudiante->EstudianteID }}"><i class="bx bx-edit-alt"></i></button></center>

                                <div class="modal fade" id="modalEditarInforme{{ $estudiante->EstudianteID }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarInforme{{ $estudiante->EstudianteID }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="{{ route('director_vinculacion.actualizarNota', ['id' => $estudiante->estudianteId]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="modalEditarNota{{ $estudiante->estudianteId }}Label">
                                                        Nota de Informe {{ $estudiante->Apellidos }}
                                                        {{ $estudiante->Nombres }}</h5>

                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->estudianteId }}">
                                                    <div class="form-group">
                                                        <label for="nota_servicio">Informe de Servicio Comunitario</label>
                                                        <input type="text" class="input" name="nota_servicio" value="{{ $estudiante->notas->first()->informe }}" required>
                                                        <small class="form-text text-danger" style="display: none;"></small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="button">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>




                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    </div>
    </div>

    <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>
    <style>
        .contenedor_tabla .table-container table td {
    width: 200px;
    min-width: 150px;
    font-size: 11px !important;
    padding: .5rem !important;
}
.contenedor_tabla .table-container table th {
    position: sticky;
    font-size: .8em !important;
        </style>
@endsection

