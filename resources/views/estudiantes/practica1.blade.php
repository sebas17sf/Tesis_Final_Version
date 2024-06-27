@extends('layouts.app')
@section('title', 'Práctica 1')

@section('title_component', 'Panel Prácticas')

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

    @if (isset($practicaPendiente))
        <div class="container">
            <h4>Detalles de la Práctica en Ejecución:</h4>
            <div class="row">
                <div class="col-md-6">

                    <dl class="row">
                        <dt class="col-sm-5 text-nowrap">Estudiante:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->estudiante->apellidos }}
                            {{ $practicaPendiente->estudiante->nombres }}</dd>
                        <dt class="col-sm-5 text-nowrap">Práctica:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->tipoPractica }}</dd>
                        <dt class="col-sm-5 text-nowrap">Docente Tutor:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->tutorAcademico->Apellidos }}
                            {{ $practicaPendiente->tutorAcademico->Nombres }}</dd>
                        <dt class="col-sm-5 text-nowrap">Empresa:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Empresa->nombreEmpresa }}</dd>
                        <dt class="col-sm-5 text-nowrap">Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->NombreTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Cédula Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->CedulaTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Función:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Funcion }}</dd>
                        <dt class="col-sm-5 text-nowrap">Teléfono Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->TelefonoTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Estado de Fase I:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Estado }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaEstudiante') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Estudiantes
                            </button>
                        </form>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaDocentes') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Docente
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.EvTutorEmpresarial') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Evaluacion Tutor Empresarial
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.PlanificacionPPEstudiante') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Planificacion Estudiante
                            </button>
                        </form>
                    </div>
                </div>




                <br>
                <button type="button" class="button" data-toggle="modal" data-target="#modalAgregarActividad">
                    Agregar actividad
                </button>
                <br>


                <div class="modal fade" id="modalAgregarActividad" tabindex="-1" role="dialog"
                    aria-labelledby="modalAgregarActividadLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAgregarActividadLabel">Agregar Actividad</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="actividadForm" action="{{ route('estudiantes.guardarActividadesPracticas1') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="EstudianteID" name="EstudianteID"
                                        value="{{ $practicaPendiente->estudiante->estudianteId }}">
                                    <input type="hidden" id="PracticasI" name="PracticasI"
                                        value="{{ $practicaPendiente->practicasi }}">
                                    <div class="form-group">
                                        <label for="Actividad">Actividad Realizada:</label>
                                        <textarea id="Actividad" name="Actividad" class="form-control input"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="horas">Número de Horas:</label>
                                        <input type="text" id="horas" name="horas" class="form-control input">
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Observación:</label>
                                        <input type="text" id="observaciones" name="observaciones"
                                            class="form-control input">
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaActividad">Fecha de la Actividad:</label>
                                        <input type="date" id="fechaActividad" name="fechaActividad"
                                            class="form-control input">
                                    </div>
                                    <div class="form-group">
                                        <label for="departamento">Departamento:</label>
                                        <input type="text" id="departamento" name="departamento"
                                            class="form-control input">
                                    </div>
                                    <div class="form-group">
                                        <label for="funcion">Función Asignada:</label>
                                        <input type="text" id="funcion" name="funcion" class="form-control input">
                                    </div>
                                    <div class="form-group">
                                        <label for="evidencia">Evidencia:</label>
                                        <input type="file" id="evidencia" name="evidencia"
                                            class="form-control-file input">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="button">Guardar Actividad</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Actividad Realizada</th>
                                <th>Horas</th>
                                <th>Observaciones</th>
                                <th>Fecha de la Actividad</th>
                                <th>Departamento</th>
                                <th>Función Asignada</th>
                                <th>Evidencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $actividad)
                                <tr>
                                    <td>{{ $actividad->actividad }}</td>
                                    <td>{{ $actividad->horas }}</td>
                                    <td>{{ $actividad->observaciones }}</td>
                                    <td>{{ $actividad->fechaActividad }}</td>
                                    <td>{{ $actividad->departamento }}</td>
                                    <td>{{ $actividad->funcion }}</td>
                                    <td><img src="data:image/png;base64,{{ $actividad->evidencia }}"
                                            alt="Evidencia de la actividad" width="100px"></td>
                                    <td>
                                        <form
                                            action="{{ route('estudiantes.eliminarActividadPracticas1', $actividad->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="tooltip-container">
                                                <span class="tooltip-text">Eliminar</span>
                                                <button type="submit" class="button3 efects_button btn_eliminar3"> <i
                                                        class="material-icons">delete</i></button>
                                            </div>
                                        </form>
                                        <div class="tooltip-container">
                                            <span class="tooltip-text">Editar</span>
                                            <button type="button" class="button3 efects_button btn_editar3"
                                                data-toggle="modal"
                                                data-target="#modalEditarActividad{{ $actividad->id }}">
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </div>

                                        <!-- Modal para editar actividad -->
                                        <div class="modal fade" id="modalEditarActividad{{ $actividad->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="modalEditarActividadLabel{{ $actividad->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modalEditarActividadLabel{{ $actividad->id }}">Editar
                                                            Actividad</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('estudiantes.actualizarActividadPracticas1', $actividad->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="Actividad">Actividad Realizada:</label>
                                                                <input type="text" id="Actividad" name="Actividad"
                                                                    value="{{ $actividad->actividad }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="horas">Horas:</label>
                                                                <input type="text" id="horas" name="horas"
                                                                    value="{{ $actividad->horas }}" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="observaciones">Observaciones:</label>
                                                                <input type="text" id="observaciones"
                                                                    name="observaciones"
                                                                    value="{{ $actividad->observaciones }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="fechaActividad">Fecha de la
                                                                    Actividad:</label>
                                                                <input type="date" id="fechaActividad"
                                                                    name="fechaActividad"
                                                                    value="{{ $actividad->fechaActividad }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="departamento">Departamento:</label>
                                                                <input type="text" id="departamento"
                                                                    name="departamento"
                                                                    value="{{ $actividad->departamento }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="funcion">Función Asignada:</label>
                                                                <input type="text" id="funcion" name="funcion"
                                                                    value="{{ $actividad->funcion }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="evidencia">Evidencia:</label>
                                                                <input type="file" id="evidencia" name="evidencia"
                                                                    class="form-control-file">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="button"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="button">Guardar
                                                                    Cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>



                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7" align="left"><strong>Total horas realizadas:</strong>
                                    {{ $totalHoras }} / {{ $practicaPendiente->HorasPlanificadas }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>


                </div>



            </div>










            <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
        @else
            <br>
            <h3><b>Fase 1 - Inicio del proceso de prácticas pre profesionales del estudiante</b></h3>
            <hr>
            <form action="{{ route('guardarPracticas') }}" method="POST">
                @csrf
                <div class="table-responsive-sm">
                    <table class="table2 table table-bordered">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2"> <center>DATOS DEL ESTUDIANTE</center></th>
                    </tr>
                        <tbody>
                            <tr>
                                <th>ID de Estudiante:</th>
                                <td>{{ strtoupper($estudiante->espeId) }}</td>
                            </tr>
                            <tr>
                                <th>Cédula:</th>
                                <td>{{ strtoupper($estudiante->cedula) }}</td>
                            </tr>
                            <tr>
                                <th>Nombres Completos:</th>
                                <td>{{ strtoupper($estudiante->apellidos) }}
                                    {{ strtoupper($estudiante->nombres) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Correo:</th>
                                <td >{{ $correoEstudiante }}</td>
                            </tr>
                            <tr>
                                <th>Nivel:</th>
                                <td>
                                    <select id="Nivel" name="Nivel" class="form-control input input_select3">
                                        <option value="1">Seleccione un nivel</option>
                                        <option value="Pregrado">PREGRADO</option>
                                        <option value="Posgrado">POSTGRADO</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Campus:</th>
                                <td>EXTENSIÓN SANTO DOMINGO</td>
                            </tr>
                            <tr>
                                <th>Departamento:</th>
                                <td style=" text-transform: uppercase;">{{ strtoupper($estudiante->departamento) }}</td>
                            </tr>
                            <tr>
                                <th>Escoja Práctica:</th>
                                <td>
                                    <select id="Practicas" name="Practicas" class="form-control input input_select3">
                                        <option value="1">Seleccione una práctica</option>
                                        <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                        <option value="PASANTIAS">PASANTÍAS</option>
                                        <option value="PRACTICAS PRE PROFESIONALES">PRÁCTICAS PRE PROFESIONALES
                                        </option>
                                        <option value="AYUDANDIA DE CATEDRA">AYUDANTÍA DE CATEDRA</option>
                                        <option value="AYUDANTIA DE INVESTIGACION">AYUDANTÍA DE INVESTIGACION
                                        </option>
                                        <option value="RECONOCE EXPERIENCIA LABORAL">RECONOCE EXPERIENCIA LABORAL
                                        </option>
                                        <option value="P. INTEGRADOR SABERES">P. INTEGRADOR SABERES</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Teléfono:</th>
                                <td>{{ strtoupper($estudiante->celular) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
<br>
<hr>

                <div class="table-responsive-sm">
                    
                    <table class="table2 table table-bordered">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2"> <center>DATOS DE LA PRÁCTICA</center></th>
                    </tr>
                        <tbody>
                            <tr>
                                <th>Estado Académico Actual:</th>
                                <td>
                                    <select id="EstadoAcademico" name="EstadoAcademico" class="form-control input input_select3">
                                        <option value="1">Seleccione un estado académico</option>
                                        <option value="FINALIZANDO ESTUDIOS">FINALIZANDO ESTUDIOS</option>
                                        <option value="CURSANDO ESTUDIOS">CURSANDO ESTUDIOS</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Fecha de inicio de la práctica:</th>
                                <td>
                                    <input type="date" id="FechaInicio" name="FechaInicio" class="form-control input input_select3">
                                </td>
                            </tr>
                            <tr>
                                <th>Fecha de finalización de la práctica:</th>
                                <td>
                                    <input type="date" id="FechaFinalizacion" name="FechaFinalizacion"
                                        class="form-control input input_select3">
                                </td>
                            </tr>
                            <tr>
                                <th>Horas planificadas:</th>
                                <td>
                                    <input type="number" id="HorasPlanificadas" name="HorasPlanificadas"
                                    class="form-control input input_select3" min="80" max="144">
                                </td>
                            </tr>
                            <tr>
                                <th>Horario de entrada:</th>
                                <td>
                                    <input type="time" id="HoraEntrada" name="HoraEntrada" class="form-control input input_select3">
                                </td>
                            </tr>
                            <tr>
                                <th>Horario de salida:</th>
                                <td>
                                    <input type="time" id="HoraSalida" name="HoraSalida" class="form-control input input_select3">
                                </td>
                            </tr>
                            <tr>
                                <th>Área de conocimiento:</th>
                                <td>
                                    <input type="text" id="AreaConocimiento" name="AreaConocimiento"
                                        class="form-control input input_select3">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

<br>

                <button type="button" id="verOpcionesBtn" class="button1 btn3"><i class="fa-regular fa-magnifying-glass-plus"></i> Ver opciones de
                    prácticas</button>
                <br>
                <hr>
                <div class="table-responsive-sm">
                    
                    <table id="opcionesPracticas" class="table2 table table-bordered" style="display: none;">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2"> <center>PRÁCTICA PREPROFESIONAL NO REMUNERADA, PASANTÍA O AYUDA A LA COMUNIDAD </center></th>
                    </tr>
                    <tbody>
                        <tr>
                            <th>Sugiera un docente como tutor académico:</th>
                            <td>
                                <div class="form-group">
                                    <label for="ID_tutorAcademico">
                                    </label>
                                    <select name="ID_tutorAcademico" class="form-control input input_select3" required>
                                        <option value="">Seleccione un tutor académico</option>
                                        @foreach ($profesores as $profesor)
                                            <option value="{{ $profesor->id }}"> {{ $profesor->apellidos }}
                                                {{ $profesor->nombres }}
                                                {{ $profesor->Departamento }} {{ $profesor->Correo }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <th>NRC Practica</th>
                            <td>
                                <div class="form-group">
                                    <select name="nrc" class="form-control input input_select3" required>
                                        <option value="">Seleccionar NRC</option>
                                        @foreach ($nrcpracticas1 as $nrc)
                                            <option value="{{ $nrc->id }}">{{ $nrc->nrc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>Empresa:</th>
                            <td>
                                <select id="Empresa" name="Empresa" class="form-control input input_select4 ">
                                    <option value="1">Seleccione una empresa</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->nombreEmpresa }} -
                                            Requiere: {{ $empresa->actividadesMacro }} </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Cédula del tutor empresarial:</th>
                            <td>
                                <input type="text" id="CedulaTutorEmpresarial" name="CedulaTutorEmpresarial"
                                    class="form-control input input_select3">
                                <div id="errorCedula" style="color: red;"></div>
                            </td>

                        </tr>

                        <tr>
                            <th>Nombre del tutor empresarial:</th>
                            <td>
                                <input type="text" id="NombreTutorEmpresarial" name="NombreTutorEmpresarial" class="form-control input input_select3">
                                <div id="errorNombre" style="color: red;"></div>
                            </td>

                        </tr>

                        <tr>
                            <th>Funcion:</th>
                            <td>
                                <input type="text" id="Funcion" name="Funcion" class="form-control input input_select3">
                            </td>

                        </tr>

                        <tr>
                            <th>Telefono:</th>
                            <td>
                                <input type="text" id="TelefonoTutorEmpresarial" name="TelefonoTutorEmpresarial" class="form-control input input_select3">
                                <div id="errorTelefono" style="color: red;"></div>
                            </td>

                        </tr>

                        <tr>
                            <th>Email:</th>
                            <td>
                                <input type="text" id="EmailTutorEmpresarial" name="EmailTutorEmpresarial" class="form-control input input_select3">
                                <div id="errorEmail" style="color: red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <th>Departamento dentro de la empresa:</th>
                            <td>
                                <input type="text" id="DepartamentoTutorEmpresarial"
                                    name="DepartamentoTutorEmpresarial" class="form-control input input_select3">
                            </td>

                        </tr>



                    </tbody>

                </table>
                </div>
                <br>
                <center><button type="submit" id="iniciarPracticasBtn" class="button1 btn_excel"
                    style="display: none;">Iniciar
                    prácticas</button></center>
            </form>
    @endif
    </div>





@endsection


<script src="{{ asset('js/estudiante/practicas.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var verOpcionesBtn = document.getElementById('verOpcionesBtn');
        var opcionesPracticas = document.getElementById('opcionesPracticas');
        var iniciarPracticasBtn = document.getElementById('iniciarPracticasBtn');

        var opcionesAbiertas = false; // Variable para rastrear el estado de las opciones

        verOpcionesBtn.addEventListener('click', function() {
            if (opcionesAbiertas) {
                opcionesPracticas.style.display = 'none'; // Cierra las opciones
                iniciarPracticasBtn.style.display = 'none'; // Oculta el botón de inicio
            } else {
                opcionesPracticas.style.display = 'table'; // Abre las opciones
                iniciarPracticasBtn.style.display = 'block'; // Muestra el botón de inicio
            }

            // Cambia el estado de las opciones
            opcionesAbiertas = !opcionesAbiertas;
        });

        iniciarPracticasBtn.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para cuando se hace clic en "Iniciar prácticas"
        });
    });
</script>
