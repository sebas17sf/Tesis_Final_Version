@extends('layouts.participante')
@section('title', 'Practicas')

@section('title_component', 'Estudiantes en Prácticas')
@section('content')


    <h4>Estudiantes en Prácticas 1</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Carrera</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Empresa</th>
                                    <th>Tutor Empresarial</th>
                                    <th>Horas de practicas</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $practica)
                                    <tr>
                                        <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td>{{ $practica->carrera }}</td>
                                        <td>{{ $practica->correo }}</td>
                                        <td>{{ $practica->celular }}</td>
                                        <td>{{ $practica->practicasii->empresa->nombreEmpresa }}</td>
                                        <td>{{ $practica->practicasii->NombreTutorEmpresarial }}</td>
                                        <td>{{ $practica->practicasii->HorasPlanificadas }}</td>
                                        <td>{{ $practica->practicasii->FechaInicio }}</td>
                                        <td>{{ $practica->practicasii->FechaFinalizacion }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#actividadesModal">
                                                Ver Actividades
                                            </button>

                                            <!-- Modal para mostrar actividades -->
                                            <div class="modal fade" id="actividadesModal" tabindex="-1" role="dialog"
                                                aria-labelledby="actividadesModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="actividadesModalLabel">Actividades
                                                                del Estudiante</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="actividadesContent">
                                                                @foreach ($actividades as $actividad)
                                                                    <p>Actividad: {{ $actividad->actividad }}</p>
                                                                    <p>Horas: {{ $actividad->horas }}</p>
                                                                    <p>Fecha: {{ $actividad->fechaActividad }}</p>
                                                                    <p>Departamento: {{ $actividad->departamento }}</p>
                                                                    <p>Función: {{ $actividad->funcion }}</p>
                                                                    <p>Evidencias: </p>
                                                                    <img src="data:image/png;base64,{{ $actividad->evidencia }}"
                                                                        alt="evidencia" width="100" height="100">
                                                                    <hr>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <form id="cerrarPracticaForm" action="{{ route('ParticipanteVinculacion.cerrarProcesoPracticasii') }}"
            method="POST">
            @csrf
            @method('PUT')
            <button type="button" id="cerrarPracticaBtn" class="btn btn-danger">Cerrar Práctica II estudiantes</button>
        </form>

    </div>

    <h4>Estudiantes a calificar</h4>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Nota tutor empresarial 12%</th>
                                    <th>Nota tutor academico 8%</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificar as $index => $practica)
                                    <form action="{{ route('ParticipanteVinculacion.guardarNotasPracticasii') }}"
                                        method="POST">
                                        @csrf
                                        <tr>
                                            <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                            <td>{{ $practica->correo }}</td>
                                            <td>{{ $practica->celular }}</td>
                                            <input type="hidden" name="estudianteId"
                                                value="{{ $practica->estudianteId }}">
                                            <td>
                                                <input type="number" name="notaTutorEmpresarial" id="notaTutorEmpresarial">
                                                <span id="errorMensaje" style="color: red; display: none;"></span>
                                            </td>
                                            <td>
                                                <input type="number" name="notaTutorAcademico" id="notaTutorAcademico">
                                                <span id="errorMensajeAcademico" style="color: red; display: none;"></span>
                                            </td>
                                            <td><button type="submit">Guardar</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <h4>Estudiants Calificados</h4>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>7
                                    <th>Carrera</th>
                                    <th>Nota tutor empresarial 12%</th>
                                    <th>Nota tutor academico 8%</th>
                                    <th>Nota final</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificados as $index => $practica)
                                    <tr>
                                        <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td>{{ $practica->carrera }}</td>
                                        <td>{{ $practica->correo }}</td>
                                        <td>{{ $practica->notas_practicasii->first()->notaTutor }}</td>
                                        <td>{{ $practica->notas_practicasii->first()->notaAcademico }}</td>
                                        <td>{{ $practica->notas_practicasii->first()->notaTutor + $practica->notas_practicasii->first()->notaAcademico }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#calificacionModal">
                                                editar calificacion
                                            </button>

                                            <!-- Modal para mostrar actividades -->
                                            <div class="modal fade " id="calificacionModal" tabindex="-1" role="dialog"
                                                aria-labelledby="calificacionModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="calificacionModalLabel">Editar
                                                                Calificacion del Estudiante</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('ParticipanteVinculacion.editarNotasPracticasii', ['id' => $practica->estudianteId]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body ">
                                                                <input type="hidden" name="estudianteId"
                                                                    value="{{ $practica->estudianteId }}">
                                                                <div class="form-group row">
                                                                    <label for="notaTutorEmpresarial"
                                                                        class="col-md-4 col-form-label text-md-right">Nota
                                                                        Tutor Empresarial</label>
                                                                    <div class="col-md-6">
                                                                        <input id="notaTutorEmpresarial" type="number"
                                                                            class="form-control"
                                                                            name="notaTutorEmpresarial"
                                                                            value="{{ $practica->notas_practicasii->first()->notaTutor }}"
                                                                            step="any" required>
                                                                        <span id="errorMensaje"
                                                                            style="color: red; display: none;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="notaTutorAcademico"
                                                                        class="col-md-4 col-form-label text-md-right">Nota
                                                                        Tutor Academico</label>
                                                                    <div class="col-md-6">
                                                                        <input id="notaTutorAcademico" type="number"
                                                                            class="form-control" name="notaTutorAcademico"
                                                                            value="{{ $practica->notas_practicasii->first()->notaAcademico }}"
                                                                            step="any" required>
                                                                        <span id="errorMensajeAcademico"
                                                                            style="color: red; display: none;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Guardar</button>
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
                    </div>

                </div>
            </div>
        </div>

        <script src="{{ asset('js/participante/practicas.js') }}"></script>

    @endsection
