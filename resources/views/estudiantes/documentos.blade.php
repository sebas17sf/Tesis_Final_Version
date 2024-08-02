@extends('layouts.app')
@section('title', 'Documentacion')
@section('title_component', 'Generar Documentos')
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

    <div class="container mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="card custom-card mb-4 w-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title flex-grow-1"><i>Generar Acta de Designación de Estudiantes</i></h4>
                            <hr>
                            <form action="{{ route('generar-documento') }}" method="post"
                                class="d-flex justify-content-center">
                                @csrf
                                <button type="submit" class="button1 btn_word efects_button">
                                    <i class="fa-solid fa-file-word"></i> Generar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card custom-card mb-4 w-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title flex-grow-1"><i>Generar Carta de Compromiso de Estudiante</i></h4>
                            <hr>
                            <form action="{{ route('generar-documento-cartaCompromiso') }}" method="post"
                                class="d-flex justify-content-center">
                                @csrf
                                <button type="submit" class="button1 btn_word efects_button">
                                    <i class="fa-solid fa-file-word"></i> Generar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card custom-card mb-4 w-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title flex-grow-1"><i>Generar Número de Horas de Estudiantes</i></h4>
                            <hr>
                            <form action="{{ route('generar-documento-numeroHoras') }}" method="POST"
                                class="d-flex justify-content-center">
                                @csrf
                                <button type="submit" class="button1 btn_excel efects_button">
                                    <i class="fas fa-file-excel"></i> Generar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Card de Registro de Actividades -->
    <div class="draggable-card1_4" id="cardRegistroActividades" style="display: none;">
        <div class="card-header">
            <span class="card-title">Registro de Actividades</span>
            <button type="button" class="close" onclick="closeCard('cardRegistroActividades')">&times;</button>
        </div>
        <div class="card-body">
            <form action="{{ route('estudiantes.guardarActividad') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="fecha"><strong>Fecha:</strong></label>
                    <input type="date" id="fecha" name="fecha" class="form-control input" required>
                </div>
                <div class="form-group">
                    <label for="actividades"><strong>Actividades a realizar:</strong></label>
                    <textarea id="actividades" name="actividades" class="form-control input" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="horas"><strong>Número de horas:</strong></label>
                    <input type="number" id="horas" name="horas" class="form-control input" required>
                </div>
                <div class="form-group">
                    <label for="evidencias"><strong>Resultados de la actividad (evidencias):</strong></label>
                    <div class="input-group input_file">
                        <span id="fileText" class="fileText input input_file"><i
                                class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento</span>
                        <input type="file" id="evidencias" name="evidencias" accept="image/jpeg, image/jpg, image/png"
                            class="form-control-file input input_file" required
                            onchange="displayFileName(this, 'fileText')">
                        <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre_actividad"><strong>Asigne Nombre de la actividad:</strong></label>
                    <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control input" required>
                </div>
                <center><button type="submit" class="button1">Guardar Actividad</button></center>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h4><b>Actividades Registradas</b></h4>
        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">
                    <!-- Botones -->
                    <div class="tooltip-container">
                        <span class="tooltip-text">Registrar Actividades</span>
                        <button type="button3" class="button3 efects_button btn_primary"
                            onclick="openCard('cardRegistroActividades');">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                <th>FECHA</th>
                                <th style="width: 161px !important; min-width:200px !important;">ACTIVIDADES</th>
                                <th>NÚMERO DE HORAS</th>
                                <th>NOMBRE DE ACTIVIDAD</th>
                                <th>EVIDENCIAS</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            @if ($actividadesRegistradas->isEmpty())
                                <tr style="text-align:center">
                                    <td class="noExisteRegistro1" style="font-size: 16px !important;" colspan="10">No
                                        hay actividades en este momento.</td>
                                </tr>
                            @else
                                @foreach ($actividadesRegistradas as $actividad)
                                    <tr>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            {{ $actividad->fecha }}</td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify; font-size: .7em;">
                                            {{ $actividad->actividades }}</td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            {{ $actividad->numeroHoras }}</td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            {{ $actividad->nombreActividad }}</td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            <img src="data:image/png;base64,{{ $actividad->evidencias }}" alt="Evidencia"
                                                width="100" height="100">
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            <div class="btn-group shadow-1">
                                                <form action="{{ route('eliminarActividad', $actividad->idActividades) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button3 efects_button btn_eliminar3"
                                                        onclick="confirmDeleteEstudiante(event)"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                            </div>
                                            <div class="btn-group shadow-1">
                                                <!-- Botón para abrir el card de editar actividad -->
                                                <div class="tooltip-container mx-1">
                                                    <span class="tooltip-text">Editar Actividad</span>
                                                    <button type="button" class="button3 efects_button btn_editar3"
                                                        onclick="openCard('cardEditActividad{{ $actividad->idActividades }}');">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </button>
                                                </div>

                                                <!-- Card para editar la actividad -->
                                                <div class="draggable-card1_4"
                                                    id="cardEditActividad{{ $actividad->idActividades }}"
                                                    style="display: none;">
                                                    <div class="card-header">
                                                        <span class="card-title input_select1">Editar Actividad</span>
                                                        <button type="button" class="close"
                                                            onclick="closeCard('cardEditActividad{{ $actividad->idActividades }}')">&times;</button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form
                                                            action="{{ route('updateActividad', ['id' => $actividad->idActividades]) }}"
                                                            enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="fecha{{ $actividad->idActividades }}"><b>Fecha</b></label>
                                                                <input type="date"
                                                                    class="form-control input input_select1"
                                                                    id="fecha{{ $actividad->idActividades }}"
                                                                    name="fecha" value="{{ $actividad->fecha }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="actividades{{ $actividad->idActividades }}"><b>Actividades</b></label>
                                                                <textarea class="form-control input textarea input_select1" id="actividades{{ $actividad->idActividades }}"
                                                                    name="actividades">{{ $actividad->actividades }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="numero_horas{{ $actividad->idActividades }}"><b>Número
                                                                        de Horas</b></label>
                                                                <input type="number"
                                                                    class="form-control input input_select1"
                                                                    id="numero_horas{{ $actividad->idActividades }}"
                                                                    name="numero_horas"
                                                                    value="{{ $actividad->numeroHoras }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="evidencias{{ $actividad->idActividades }}"><b>Evidencias</b></label>
                                                                <div class="input-group input_file">
                                                                    <span id="fileText{{ $actividad->idActividades }}"
                                                                        class="fileText input input_file input_select1"><i
                                                                            class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                        Haz clic aquí para subir el documento</span>
                                                                    <input type="file"
                                                                        id="evidencias{{ $actividad->idActividades }}"
                                                                        name="evidencias"
                                                                        accept="image/jpeg, image/jpg, image/png"
                                                                        class="form-control-file input input_file" required
                                                                        onchange="displayFileName(this, 'fileText{{ $actividad->idActividades }}')">
                                                                    <span title="Eliminar archivo"
                                                                        onclick="removeFile(this)"
                                                                        class="remove-icon">✖</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="nombre_actividad{{ $actividad->idActividades }}"><b>Nombre
                                                                        de la Actividad</b></label>
                                                                <input type="text"
                                                                    class="form-control input input_select1"
                                                                    id="nombre_actividad{{ $actividad->idActividades }}"
                                                                    name="nombre_actividad"
                                                                    value="{{ $actividad->nombreActividad }}">
                                                            </div>
                                                            <div
                                                                class="card-footer d-flex justify-content-center align-items-center">
                                                                <button type="submit"
                                                                    class="button input_select1">Guardar cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    <hr>
    <center><button id="toggleFormBtn2" class="button1_1 efects_button">Crear Informe de Servicio a la comunidad</button>
    </center>
    <hr>


    <div class="contenedor_list_filtros">
        <div id="registroInforme" style="display: none;">
            <form action="{{ route('estudiantes.generarInforme') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="tipoInforme"><strong>Generar Informe:</strong></label>
                        <select class="form-control input input_select3" name="tipo" id="tipo">
                            <option value="grupal">Grupal</option>
                            <option value="individual">Individual</option>
                        </select>
                    </div>
              

                <div class="form-group col-md-10">
                    <label for="nombreComunidad"><strong>Nombre de la Comunidad o Comunidades Beneficiarias:</strong></label>
                    <input type="text" id="nombreComunidad" name="nombreComunidad" class="form-control input" required>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="provincia"><strong>Provincia:</strong></label>
                        <input type="text" id="provincia" name="provincia" class="form-control input" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="canton"><strong>Cantón:</strong></label>
                        <input type="text" id="canton" name="canton" class="form-control input" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="parroquia"><strong>Parroquia:</strong></label>
                        <input type="text" id="parroquia" name="parroquia" class="form-control input" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="direccion"><strong>Dirección:</strong></label>
                        <input type="text" id="direccion" name="direccion" class="form-control input" required>
                    </div>
                </div>

                <div id="campos">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                            <textarea name="especificos[]" class="form-control input" rows="4" required></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                            <textarea name="alcanzados[]" class="form-control input" rows="4" required></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                            <textarea name="porcentaje[]" class="form-control input" rows="4" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="tooltip-container">
                        <span class="tooltip-text">Agregar</span>
                        <button type="button" class="button3 efects_button btn_primary mr-2" onclick="agregarCampo()">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <div class="tooltip-container">
                        <span class="tooltip-text">Eliminar</span>
                        <button type="button" class="button3 efects_button btn_eliminar1" onclick="eliminarCampo()">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
                <br>
                <table class="four-column-table">
    <tr>
        <td>
            <label for="razones">Explicar las razones que justifican las actividades realizadas:</label>
        </td>
        <td class="textarea-cell">
            <textarea id="razones" class="textarea input" name="razones" rows="10"></textarea>
        </td>
        <td>
            <label for="conclusiones">Conclusiones:</label>
        </td>
        <td class="textarea-cell">
            <textarea id="conclusiones" class="textarea input" name="conclusiones" rows="10"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label for="conclusiones1">¿Qué resultados de aprendizaje obtuvo realizando las actividades de servicio comunitario?</label>
        </td>
        <td class="textarea-cell">
            <textarea id="conclusiones1" class="textarea input" name="conclusiones1" rows="10"></textarea>
        </td>
        <td>
            <label for="conclusiones2">¿Qué limitaciones tuvo para realizar sus actividades de servicio comunitario?</label>
        </td>
        <td class="textarea-cell">
            <textarea id="conclusiones2" class="textarea input" name="conclusiones2" rows="10"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label for="conclusiones3">¿Qué éxitos alcanzados se obtuvo cuando realizó sus actividades de servicio comunitario?</label>
        </td>
        <td class="textarea-cell">
            <textarea id="conclusiones3" class="textarea input" name="conclusiones3" rows="10"></textarea>
        </td>
        <td>
            <label for="recomendaciones">Recomendaciones:</label>
        </td>
        <td class="textarea-cell">
            <textarea id="recomendaciones" class="textarea input" name="recomendaciones" rows="10"></textarea>
        </td>
    </tr>
</table>
                <center>
                    <button type="submit" class="button1">Crear Informe</button>
                </center>
            </form>

        </div>
    </div>
    </div>



    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/documentosEstudiantes.js') }}"></script>
    <script scr="{{ asset('js/admin/acciones.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#registroActividadesModal .modal-dialog').draggable({
                handle: ".modal-header"
            });

            $('#registroActividadesModal').modal({
                backdrop: false
            });

            // Hacer que los cards sean draggable
            $('.draggable-card1_4').draggable({
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

        function displayFileName(input, fileTextId) {
            const fileName = input.files[0].name;
            document.getElementById(fileTextId).textContent = fileName;
            input.nextElementSibling.style.display = 'inline'; // Mostrar la "X"
        }

        function removeFile(element) {
            const input = element.previousElementSibling;
            const fileTextId = input.id.replace('file', 'fileText');
            input.value = ""; // Clear the input
            document.getElementById(fileTextId).innerHTML =
                '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento'; // Reset the text
            element.style.display = 'none'; // Ocultar la "X"
        }
    </script>
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
    <style>
        .contenedor_tabla .table-container table td {
            width: 200px;
            min-width: 150px;
            font-size: 11px !important;
            padding: .5rem !important;

        }
    
    .four-column-table {
        width: 100%;
        border-collapse: collapse;
    }

    .four-column-table td {
        padding: 10px;
        vertical-align: top;
    }

    .four-column-table label {
        display: block;
        font-weight: bold;
    }

    .four-column-table textarea {
        width: 95%;
        box-sizing: border-box;
        font-size: 14px;
    }

    .four-column-table .textarea-cell {
        width: 30%;
    }


    </style>
@endsection
