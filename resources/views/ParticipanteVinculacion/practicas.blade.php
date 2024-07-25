@extends('layouts.participante')
@section('title', 'Practicas')

@section('title_component', 'Panel Prácticas I')
@section('content')

@if (session('success'))
<div class="contenedor_alerta success">
    <div class="icon_alert"><i class="fa-regular fa-circle-check fa-beat"></i></div>
    <div class="content_alert">
      <div class="title">Éxito!</div>
      <div class="body">{{ session('success') }}</div>
    </div>
  </div>
@endif


@if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
    @endif
    
    <h4><b>Finalizar prácticas</b></h4>
    <hr>
    <div class="mat-elevation-z8 ">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">ESTUDIANTE</th>
                                    <th class="tamanio1">CARRERA</th>
                                    <th>CORREO</th>
                                    <th>TELÉFONO</th>
                                    <th>EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th>HORAS DE PRÁCTICAS</th>
                                    <th>FECHA INICIO </th>
                                    <th>FFECHA FIN </th>
                                   <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $practica)
                                    <tr>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->carrera }}</td>
                                        <td style=" word-wrap: break-word; text-align: center;">{{ $practica->correo }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->celular }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->practicasi->empresa->nombreEmpresa }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->practicasi->NombreTutorEmpresarial }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->practicasi->HorasPlanificadas }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->practicasi->FechaInicio }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->practicasi->FechaFinalizacion }}</td>
                                       <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            <center><button type="button" class="button3 efects_button btn_eliminar3" data-toggle="modal"
                                            
                                                data-target="#actividadesModal"> <i class="fa-solid fa-eye"></i>
                                                
                                            </button></center>

                                           
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
<br>
        <form id="cerrarPracticaForm" action="{{ route('ParticipanteVinculacion.cerrarProcesoPracticasI') }}"
            method="POST">
            @csrf
            @method('PUT')
            <button type="button" id="cerrarPracticaBtn" class="button1_1">Cerrar Práctica I estudiantes</button>
        </form>

    <br>

    <h4><b>Estudiantes a calificar</b></h4>
            <hr>
            <div class="mat-elevation-z8 ">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                       <th class="tamanio1">ESTUDIANTE</th>
                                    <th>CORREO</th>
                                    <th>TELÉFONO</th>
                                    <th>NOTA TUTOR EMPRESARIAL 12</th>
                                    <th>NOTA TUTOR ACADÉMICO 8</th>
                                    <th>ACCIONES</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificar as $index => $practica)
                                    <form action="{{ route('ParticipanteVinculacion.guardarNotasPracticasi') }}"
                                        method="POST">
                                        @csrf
                                        <tr>
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                            <td style=" word-wrap: break-word; text-align: center;">{{ $practica->correo }}</td>
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->celular }}</td>
                                            <input type="hidden" name="estudianteId"
                                                value="{{ $practica->estudianteId }}">
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                <input type="number" name="notaTutorEmpresarial" id="notaTutorEmpresarial">
                                                <span id="errorMensaje" style="color: red; display: none;"></span>
                                            </td>
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                <input type="number" name="notaTutorAcademico" id="notaTutorAcademico">
                                                <span id="errorMensajeAcademico" style="color: red; display: none;"></span>
                                            </td>
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;"><button class="button1" type="submit">Guardar</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
   
<br>
    <h4><b>Estudiantes Calificados</b></h4>

    <hr>
    <div class="mat-elevation-z8 ">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>ESTUDIANTE</th>
                                    <th>CORREO</th>
                                    <th>CARRERA</th>
                                    <th>NOTA TUTOR EMPRESARIAL 12</th>
                                    <th>NOTA TUTOR ACADÉMICO 8</th>
                                    <th>NOTA FINAL</th>
                                    <th>ACCIONES</th>
                                      

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificados as $index => $practica)
                                    <tr>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->carrera }}</td>
                                        <td style="word-wrap: break-word; text-align: center;">{{ $practica->correo }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->notas_practicasi->first()->notaTutor }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->notas_practicasi->first()->notaAcademico }}</td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $practica->notas_practicasi->first()->notaTutor + $practica->notas_practicasi->first()->notaAcademico }}
                                        </td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            <button type="button" class="button1" data-toggle="modal"
                                                data-target="#calificacionModal">
                                                Editar calificación
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
                                                            action="{{ route('ParticipanteVinculacion.editarNotasPracticasi', ['id' => $practica->estudianteId]) }}"
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
                                                                            value="{{ $practica->notas_practicasi->first()->notaTutor }}"
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
                                                                            value="{{ $practica->notas_practicasi->first()->notaAcademico }}"
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

    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>


    <script src="{{ asset('js/participante/practicas.js') }}"></script>
    <script src="js\admin\index.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
                    // Selecciona el elemento de la alerta
                    const alertElement = document.querySelector('.contenedor_alerta');
                    // Establece un temporizador para ocultar la alerta después de 2 segundos
                    setTimeout(() => {
                        if (alertElement) {
                            alertElement.style.display = 'none';
                        }
                    }, 1000); // 2000 milisegundos = 2 segundos
                });
                </script>
@endsection
