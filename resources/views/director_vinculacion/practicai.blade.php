@extends('layouts.directorVinculacion')
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
                            @foreach ($estudiantes as $practica)
                                <tr>
                                    <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                    <td>{{ $practica->carrera }}</td>
                                    <td>{{ $practica->correo }}</td>
                                    <td>{{ $practica->celular }}</td>
                                    <td>{{ $practica->practicasi->empresa->nombreEmpresa }}</td>
                                    <td>{{ $practica->practicasi->NombreTutorEmpresarial }}</td>
                                    <td>{{ $practica->practicasi->HorasPlanificadas }}</td>
                                    <td>{{ $practica->practicasi->FechaInicio }}</td>
                                    <td>{{ $practica->practicasi->FechaFinalizacion }}</td>
                                    <td>
                                        <button type="button" class="button3 efects_button btn_eliminar3" data-toggle="modal" data-target="#actividadesModal{{ $practica->estudianteId }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <!-- Modal para mostrar actividades -->
                                        <div class="modal fade" id="actividadesModal{{ $practica->estudianteId }}" tabindex="-1" role="dialog" aria-labelledby="actividadesModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="actividadesModalLabel">Actividades del Estudiante</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                <img src="data:image/png;base64,{{ $actividad->evidencia }}" alt="evidencia" width="100" height="100">
                                                                <hr>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

        <form id="cerrarPracticaBtn" action="{{ route('director_vinculacion.cerrarProcesoPracticas1') }}" method="POST">
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
                                <th>ESTUDIANTE</th>
                                <th>CORREO</th>
                                <th>TELÉFONO</th>
                                <th>NOTA PRACTICA</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantesCalificar as $index => $practica)
                                <form action="{{ route('director_vinculacion.guardarNotasPracticas1') }}" method="POST">
                                    @csrf
                                    <tr>
                                        <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td>{{ $practica->correo }}</td>
                                        <td>{{ $practica->celular }}</td>
                                        <input type="hidden" name="estudianteId" value="{{ $practica->estudianteId }}">
                                        <td>
                                            <input type="number" name="notaTutorEmpresarial" id="notaTutorEmpresarial">
                                            <span id="errorMensaje" style="color: red; display: none;"></span>
                                        </td>
                                        <td><button class="button1" type="submit">Guardar</button></td>
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
                                <th>ESTUDIANTE</th>
                                <th>CORREO</th>
                                <th>CARRERA</th>
                                <th>NOTA FINAL</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantesCalificados as $index => $practica)
                                <tr id="row{{ $practica->estudianteId }}">
                                    <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                    <td>{{ $practica->carrera }}</td>
                                    <td>{{ $practica->correo }}</td>
                                    <td>
                                        <input type="number" name="notaTutorEmpresarial" value="{{ $practica->practicasi->nota_final ?? '' }}" min="0" max="10" step="0.01" disabled>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($practica->practicasi->nota_final <= 14)
                                            <span class="badge badge-danger">REPROBADO</span>
                                        @else
                                            <span class="badge badge-success">APROBADO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group shadow-0">
                                            <button class="button3 efects_button btn_editar3" onclick="editRow({{ $practica->estudianteId }})" style="margin-right: 5px;">
                                                <i class="bx bx-edit-alt"></i>
                                            </button>
                                            <button class="button3 efects_button btn_save" onclick="saveRow({{ $practica->estudianteId }})" style="display: none; margin-right: 5px;">
                                                <i class="fa-solid fa-save"></i>
                                            </button>
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
            hiddenForm.action = `/director-vinculacion/${estudianteId}/editar-notas-practicas1`;

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

<script>
    document.getElementById('cerrarPracticaBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Previene el envío del formulario
        Swal.fire({
            title: '¿Está seguro de finalizar a los estudiantes?',
            text: "Debe verificar que todos los estudiantes hayan generado todos sus documentos antes de finalizar el proceso.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cerrar práctica!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cerrarPracticaForm').submit();
            }
        });
    });
</script>
@endsection
