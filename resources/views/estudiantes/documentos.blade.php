@extends('layouts.app')
@section('title', 'Documentacion')
@section('title_component', 'Generar Documentos')
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    <div class="container mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title flex-grow-1"><i>Generar Acta de Designación de Estudiantes</i></h4>
                            <hr>
                            <form action="{{ route('generar-documento') }}" method="post"
                                class="d-flex justify-content-center">
                                @csrf
                                <button type="submit" class="button1 btn_word efects_button ">
                                    <i class="fa-solid fa-file-word"></i> Generar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card mb-4 w-100">
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
                    <div class="card mb-4 w-100">
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


        <!-- Button to trigger modal -->
        <div class="contenedor_list_filtros">


            <!-- Modal -->
            <div class="modal fade" id="registroActividadesModal" tabindex="-1" role="dialog"
                aria-labelledby="registroActividadesModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroActividadesModalLabel">Registro de Actividades</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('estudiantes.guardarActividad') }}" method="post"
                                enctype="multipart/form-data">
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
                                    <label for="evidencias"><strong>Resultados de la actividad
                                            (evidencias):</strong></label>
                                    <div class="input-group input_file">
                                        <span id="fileText" class="fileText input input_file"><i
                                                class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el
                                            documento</span>
                                        <input type="file" id="evidencias" name="evidencias"
                                            accept="image/jpeg, image/jpg, image/png"
                                            class="form-control-file input input_file" required
                                            onchange="displayFileName(this)">
                                        <span title="Eliminar archivo" onclick="removeFile(this)"
                                            class="remove-icon">✖</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_actividad"><strong>Asigne Nombre de la actividad:</strong></label>
                                    <input type="text" id="nombre_actividad" name="nombre_actividad"
                                        class="form-control input" required>
                                </div>
                                <center><button type="submit" class="button1">Guardar Actividad</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">

            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">

                    <div class="contenedor_botones ">

                        <h4><b>Actividades Registradas</b></h4>
                        <!-- Botones -->
                        <div class="tooltip-container">
                            <button id="toggleFormBtn" class="button1 efects_button" data-toggle="modal"
                                data-target="#registroActividadesModal"><i class="fa-solid fa-plus"></i> Registrar
                                actividad</button>

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
                                    <th>ACTIVIDADES</th>
                                    <th>NÚMERO DE HORAS</th>
                                    <th>NOMBRE DE ACTIVIDAD</th>
                                    <th>EVIDENCIAS</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($actividadesRegistradas->isEmpty())


                                    <tr class="noExisteRegistro ng-star-inserted text-center">
                                        <td colspan="6">No se encontraron resultados para la búsqueda.</td>
                                    </tr>
                                @else
                                    @foreach ($actividadesRegistradas as $actividad)
                                        <tr>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $actividad->fecha }}</td>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">{{ $actividad->actividades }}</td>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $actividad->numeroHoras }}</td>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $actividad->nombreActividad }}</td>
                                            <td><img src="data:image/png;base64,{{ $actividad->evidencias }}"
                                                    alt="Evidencia" width="100" height="100"></td>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            <div class="btn-group shadow-1">
                                                <form
                                                    action="{{ route('eliminarActividad', $actividad->idActividades) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button3 efects_button btn_eliminar3"
                                                            onclick="confirmDelete(event)"><i
                                                                class='bx bx-trash'></i></button>
                                                </form>
</div>
<div class="btn-group shadow-1">
                                                <button type="button" class="button3 efects_button btn_editar3" data-toggle="modal"
                                                    data-target="#editModal{{ $actividad->idActividades }}">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>
</div>
                                                <!-- Modal para editar la actividad -->
                                                <div class="modal fade" id="editModal{{ $actividad->idActividades }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Editar
                                                                    Actividad</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('updateActividad', ['id' => $actividad->idActividades]) }}"
                                                                enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="fecha">Fecha</label>
                                                                        <input type="date" class="form-control input"
                                                                            id="fecha" name="fecha"
                                                                            value="{{ $actividad->fecha }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="actividades">Actividades</label>
                                                                        <textarea class="form-control input textarea" id="actividades" name="actividades">{{ $actividad->actividades }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="numero_horas">Número de Horas</label>
                                                                        <input type="number" class="form-control input"
                                                                            id="numero_horas" name="numero_horas"
                                                                            value="{{ $actividad->numeroHoras }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="evidencias">Evidencias</label>
                                                                        <input type="file" id="evidencias"
                                                                            name="evidencias"
                                                                            accept="image/jpeg, image/jpg, image/png"
                                                                            class="form-control-file" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nombre_actividad">Nombre de la
                                                                            Actividad</label>
                                                                        <input type="text" class="form-control input"
                                                                            id="nombre_actividad" name="nombre_actividad"
                                                                            value="{{ $actividad->nombreActividad }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar
                                                                        cambios</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fin del modal -->


                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <br>
    <center><button id="toggleFormBtn2" class="button1_1 efects_button">Crear Informe de Servicio a la comunidad</button>
    </center>
    <br>

    <div id="registroInforme" style="display: none;">
        <form action="{{ route('estudiantes.generarInforme') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nombreComunidad"><strong>Nombre de la Comunidad o Comunidades
                        Beneficiarias:</strong></label>
                <input type="text" id="nombreComunidad" name="nombreComunidad" class="form-control input" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="provincia"><strong>Provincia:</strong></label>
                    <input type="text" id="provincia" name="provincia" class="form-control input" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="canton"><strong>Canton:</strong></label>
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
                        <i class="fa-solid fa-plus"></i></button>
                </div>
                <div class="tooltip-container">
                    <span class="tooltip-text">Eliminar</span>
                    <button type="button" class="button3 efects_button btn_eliminar1" onclick="eliminarCampo()"><i
                            class='bx bx-trash'></i></button>
                </div>
            </div>
            <br>
            <table>
                <tr>
                    <td>
                        <label for="razones"><strong>Explicar las razones que justifican las actividades
                                realizadas:</strong></label>
                    </td>
                    <td>
                        <textarea id="razones" class=" textarea input" name="razones" rows="10" cols="100"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="conclusiones"><strong>Conclusiones:</strong></label>
                    </td>
                    <td>
                        <textarea id="conclusiones" class=" textarea input" name="conclusiones" rows="10" cols="100"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="recomendaciones"><strong>Recomendaciones:</strong></label>
                    </td>
                    <td>
                        <textarea id="recomendaciones" class=" textarea input" name="recomendaciones" rows="10" cols="100"></textarea>
                    </td>
                </tr>
            </table>

            <button type="submit" class="button1">Crear Informe</button>
        </form>

    </div>



    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/documentosEstudiantes.js') }}"></script>
    <script scr="{{asset('js/admin/acciones.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('#registroActividadesModal .modal-dialog').draggable({
                handle: ".modal-header"
            });

            $('#registroActividadesModal').modal({
                backdrop: false
            });
        });
    </script>
@endsection
