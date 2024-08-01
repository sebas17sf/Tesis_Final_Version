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

    <h4><b>Estudiantes en prácticas</b></h4>
    <hr>
    <div class="mat-elevation-z8">
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaDocentes">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>N°</th>
                                <th>ESTUDIANTE</th>
                                <th>CARRERA</th>
                                <th>CORREO</th>
                                <th>TELÉFONO</th>
                                <th>EMPRESA</th>
                                <th>TUTOR EMPRESARIAL</th>
                                <th>HORAS DE PRÁCTICAS</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($estudiantes) == 0)
                                <tr>
                                    <td colspan="10" class="noExisteRegistro1" style="font-size: 16px !important;">No hay estudiantes en prácticas</td>
                                </tr>
                            @endif
                            @foreach ($estudiantes as $practica)
                                <tr>
                                    <td style="min-width: 30px !important; text-transform: uppercase; font-size:.7em; ">{{ $loop->iteration }}</td>
                                    <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                    <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->carrera }}</td>
                                    <td style="min-width: 170px !important; font-size:.7em; ">{{ $practica->correo }}</td>
                                    <td style="min-width: 130px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->celular }}</td>
                                    <td style="min-width: 220px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->practicasi->empresa->nombreEmpresa }}</td>
                                    <td style="min-width: 170px !important; text-transform: uppercase; text-align:center; font-size:.7em; ">{{ $practica->practicasi->NombreTutorEmpresarial }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; text-align:center; font-size:.7em; ">{{ $practica->practicasi->HorasPlanificadas }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; text-align:center; font-size:.7em; ">{{ $practica->practicasi->FechaInicio }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; text-align:center; font-size:.7em; ">{{ $practica->practicasi->FechaFinalizacion }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; font-size:.7em; ">
                                        <center><button type="button" class="button3 efects_button btn_eliminar3" data-toggle="modal" <td>
    <center>
        <button type="button" class="card-button" data-toggle="modal" data-target="#actividadesModal{{ $practica->estudianteId }}">
            <span><b>VER ACTIVIDADES</b></span>
            <i class="fa-solid fa-eye"></i>
        </button>
    </center>

    <!-- Modal para mostrar actividades -->
    <div class="draggable-card1_3" id="actividadesModal{{ $practica->estudianteId }}" tabindex="-1" role="dialog" aria-labelledby="actividadesModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="card-header">
                <span class="card-title1" id="actividadesModalLabel">Actividades del Estudiante</span>
                <button type="button" class="close" onclick="$('#actividadesModal{{ $practica->estudianteId }}').hide()">
                    <i class="fa-thin fa-xmark"></i>
                </button>
            </div>
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div id="tablaActivida">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>FECHA</th>
                                    <th>ACTIVIDADES</th>
                                    <th>HORA</th>
                                    <th>NOMBRE DE LA ACTIVIDAD</th>
                                    <th>EVIDENCIA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividades as $actividad)
                                    <tr>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $actividad->fechaActividad }}
                                        </td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                            {{ $actividad->actividad }}
                                        </td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $actividad->horas }}
                                        </td>
                                        <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $actividad->nombreActividad }}
                                        </td>
                                        <td>
                                            <img width="100px" src="data:image/png;base64,{{ $actividad->evidencia }}" alt="Evidencia" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="card-button" onclick="$('#actividadesModal{{ $practica->estudianteId }}').hide()">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</td>
>
                                            <i class="fa-solid fa-eye"></i>
                                        </button></center>

                                       <!-- Modal para mostrar actividades -->
    <div class="draggable-card1_3" id="actividadesModal{{ $practica->estudianteId }}" >
        
            <div class="card-header">
                <span class="card-title1" id="actividadesModalLabel">Actividades del Estudiante</span>
                <button type="button" class="close" onclick="$('#actividadesModal{{ $practica->estudianteId }}').hide()">
                    <i class="fa-thin fa-xmark"></i>
                </button>
            </div>
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div id="tablaActivida">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>FECHA</th>
                                    <th>ACTIVIDADES</th>
                                    <th>HORA</th>
                                    <th>NOMBRE DE LA ACTIVIDAD</th>
                                    <th>EVIDENCIA</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($actividades as $actividad)
                                                                <p>Actividad: {{ $actividad->actividad }}</p>
                                                                <p>Horas: {{ $actividad->horas }}</p>
                                                                <p>Fecha: {{ $actividad->fechaActividad }}</p>
                                                                <p>Departamento: {{ $actividad->departamento }}</p>
                                                                <p>Función: {{ $actividad->funcion }}</p>
                                                                <p>Evidencias: </p>
                                                                <img src="data:image/png;base64,{{ $actividad->evidencia }}" alt="evidencia" width="100" height="100">
                                                                <hr>
                                                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
        <br>

        <form id="cerrarPracticaForm" action="{{ route('ParticipanteVinculacion.cerrarProcesoPracticasI') }}" method="POST">
            @csrf
            @method('PUT')
            <button type="button" id="cerrarPracticaBtn" class="button1_1">Cerrar Práctica I estudiantes</button>
        </form>
    </div>

    <br>
    <h4><b>Estudiantes a calificar</b></h4>
    <hr>
    <div class="mat-elevation-z8">
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaDocentes">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th style="min-width: 30px !important; text-transform: uppercase; font-size:.76em;" >N°</th>
                                <th>ESTUDIANTE</th>
                                
                                <th>CARRERA</th>
                                <th>CORREO</th>
                                <th>TELÉFONO</th>
                                <th>HORAS DE PRÁCTICAS</th>
                                <th>NOTA PRÁCTICA</th>
                                <!--<th>ESTADO</th>-->
                                <th>ACCIONES</th>
                             </tr>
                        </thead>
                        <tbody>
                            @if (count($estudiantesCalificar) == 0)
                                <tr>
                                    <td colspan="7" class="noExisteRegistro1" style="font-size: 16px !important;">No hay estudiantes para calificar</td>
                                </tr>
                            @endif
                            @foreach ($estudiantesCalificar as $index => $practica)
                                <form action="{{ route('ParticipanteVinculacion.guardarNotasPracticasi') }}" method="POST">
                                    @csrf
                                    <tr>
                                        <td style="min-width: 30px !important; text-transform: uppercase; font-size:.7em; text-align:center;  ">{{ $loop->iteration }}</td>
                                        <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->carrera }}</td>
                                        <td style="min-width: 170px !important; font-size:.7em; ">{{ $practica->correo }}</td>
                                        <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->celular }}</td>
                                        <td style="min-width: 100px !important; text-align:center; text-transform: uppercase; font-size:.7em; ">{{ $practica->practicasi->HorasPlanificadas }}</td>
                                        <input type="hidden" name="estudianteId" value="{{ $practica->estudianteId }}">
                                        <td style="font-size: .7em; text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            <input style="text-align:center;  " type="number" name="notaTutorEmpresarial" class="input input_select_4" placeholder="0" id="notaTutorEmpresarial" p >
                                            <span id="errorMensaje" style="color: red; display: none;"></span>
                                        </td>
                                        <td><center><button class="button3 efects_button btn_save" type="submit"><i class="fa-solid fa-save"></i></button></td>
</center>
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
    <h4><b>Estudiantes calificados</b></h4>
    <hr>
    <div class="mat-elevation-z8">
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaDocentes">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>N°</th>
                                <th>ESTUDIANTE</th>
                                <th>CARRERA</th>
                                <th>CORREO</th>
                                
                                <th>TELÉFONO</th>
                                <th>HORAS DE PRÁCTICAS</th>
                                <th>NOTA FINAL</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($estudiantesCalificados) == 0)
                                <tr>
                                    <td colspan="7" class="noExisteRegistro1" style="font-size: 16px !important;">No hay estudiantes calificados</td>
                                </tr>
                            @endif
                            @foreach ($estudiantesCalificados as $index => $practica)
                                <tr id="row{{ $practica->estudianteId }}">
                                    <td style="min-width: 30px !important; text-transform: uppercase; font-size:.7em; ">{{ $loop->iteration }}</td>
                                    <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                    <td style="min-width: 170px !important; text-transform: uppercase; font-size:.7em;" >{{ $practica->carrera }}</td>
                                    <td style="min-width: 170px !important; font-size:.7em; ">{{ $practica->correo }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; font-size:.7em; ">{{ $practica->celular }}</td>
                                    <td style="min-width: 100px !important; text-align:center; text-transform: uppercase; font-size:.7em; ">{{ $practica->practicasi->HorasPlanificadas }}</td>
                                    <td style="min-width: 100px !important; text-transform: uppercase; font-size:.7em; ">
                                        <center><input type="number" name="notaTutorEmpresarial"  value="{{ $practica->practicasi->nota_final ?? '' }}" min="0" max="10" step="0.01" disabled></center>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($practica->practicasi->nota_final <= 14)
                                            <span class="badge badge-danger">REPROBADO</span>
                                        @else
                                            <span class="badge badge-success">APROBADO</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;">
                                        <div class="btn-group shadow-0">
                                            <center><button class="button3 efects_button btn_editar3" onclick="editRow({{ $practica->estudianteId }})" style="margin-right: 5px;">
                                                <i class="bx bx-edit-alt"></i>
                                            </button></center>
                                            <center><button class="button3 efects_button btn_save" onclick="saveRow({{ $practica->estudianteId }})" style="display: none; margin-right: 5px;">
                                                <i class="fa-solid fa-save"></i>
                                            </button></center>
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

    <!-- Formulario oculto para editar notas -->
    <form id="hidden-form" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="notaTutorEmpresarial" id="hidden-notaTutorEmpresarial">
    </form>

    <script src="{{ asset('js/participante/practicas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
                    // Hacer que los cards sean draggable
                    $('.draggable-card1_3').draggable({
                        handle: ".card-header",
                        containment: "window"
                    });
                });
        function openCard(cardId) {
            document.getElementById(cardId).style.display = 'block';
        }

        function closeCard(cardId) {
            document.getElementById(cardId).style.display = 'none';
        }

        function editRow(estudianteId) {
            let row = document.getElementById('row' + estudianteId);
            let inputs = row.getElementsByTagName('input');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
            row.querySelector('.btn_editar3').style.display = 'none';
            row.querySelector('.btn_save').style.display = 'inline';
        }

        function saveRow(estudianteId) {
            let row = document.getElementById('row' + estudianteId);
            let inputs = row.getElementsByTagName('input');
            let hiddenForm = document.getElementById('hidden-form');

            // Establecer la acción del formulario con el ID del estudiante
            hiddenForm.action = `/participante-vinculacion/${estudianteId}/editar-notas-practicasi`;

            for (let i = 0; i < inputs.length; i++) {
                let inputName = inputs[i].name;
                let inputValue = inputs[i].value;
                let hiddenInput = document.getElementById('hidden-' + inputName);

                if (hiddenInput) {
                    hiddenInput.value = inputValue;
                } else {
                    // Crear un nuevo input oculto si no existe
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = inputName;
                    hiddenInput.id = 'hidden-' + inputName;
                    hiddenInput.value = inputValue;
                    hiddenForm.appendChild(hiddenInput);
                }

                inputs[i].disabled = true;
            }

            hiddenForm.submit();

            row.querySelector('.btn_editar3').style.display = 'inline';
            row.querySelector('.btn_save').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            // Selecciona el elemento de la alerta
            const alertElement = document.querySelector('.contenedor_alerta');
            // Establece un temporizador para ocultar la alerta después de 2 segundos
            setTimeout(() => {
                if (alertElement) {
                    alertElement.style.display = 'none';
                }
            }, 2000); // 2000 milisegundos = 2 segundos
        });
    </script>
@endsection
