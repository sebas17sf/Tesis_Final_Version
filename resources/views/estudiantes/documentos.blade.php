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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('errorHoras'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Precaución',
                    text: '{{ session('errorHoras') }}',
                    confirmButtonText: 'Entendido',
                    background: '#f8f9fa',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-button'
                    }
                });
            @endif
        });
    </script>




    <div class="title_icon_info" style="text-align:left !important;">
        <b>Documentación</b>
    </div>

    <section class="content_recent_courses">
        <div class="container_cources_cards">
            <hr>
            <div class="container_cources scroll_element">
                <div class="cards">
                    <div class="form-group">
                        <label for="tipoInforme"><strong>Generar Documentación:</strong></label>
                        <select class="form-control input input_select3" name="tipoDocumentos" id="tipoInforme">
                            <option value="grupal">Grupal</option>
                            <option value="individual">Individual</option>
                        </select>
                    </div>
                </div>


                <div class="cards">

                    <form action="{{ route('generar-documento') }}" method="post">
                        @csrf
                        <input type="hidden" name="tipoDocumentos" id="tipoDocumentos1">
                        <button type="submit" class="card-button">
                            <span><b>ACTA DE DESIGNACIÓN DE ESTUDIANTES</b></span>
                            <i class="fa-solid fa-file-word"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar-documento-cartaCompromiso') }}" method="post">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>CARTA DE COMPROMISO DE ESTUDIANTE</b></span>
                            <i class="fa-solid fa-file-word"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar-documento-numeroHoras') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tipoDocumentos" id="tipoDocumentos2">
                        <button type="submit" class="card-button">
                            <span><b>NÚMERO DE HORAS DE ESTUDIANTES</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <button type="button" class="card-button" onclick="$('#draggableCardRegistroHoras').show()">
                        <span><b>REGISTRO DE ESTUDIANTES</b></span>
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Tarjeta movible para Registro de Horas -->
    <div class="draggable-card" id="draggableCardRegistroHoras" style="display:none;">
        <div class="card-header">
            <span class="card-title">Registro de estudiantes</span>
            <button type="button" class="close" onclick="$('#draggableCardRegistroHoras').hide()">
                <i class="fa-thin fa-xmark"></i>
            </button>
        </div>
        <div class="card-body">
            <form class="FormularioAsistenciaEstudiantes" action="{{ route('estudiante.generarAsistenciaEstudiantes') }}"
                method="post" id="formAsistencia">
                @csrf
                <input type="hidden" name="tipoDocumentos" id="tipoDocumentosHidden">

                <div class="form-group">
                    <label class="label" for="fecha"><strong>Fecha de asistencia:</strong></label>
                    <input type="date" id="fecha" name="fecha" class="form-control input">
                    <small id="fechaError" class="form-text text-danger" style="display: none;"></small>
                    @error('fecha')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label" for="lugar"><strong>Lugar de la actividad:</strong></label>
                    <input type="text" id="lugar" name="lugar" class="form-control input"
                        placeholder="Escribir el lugar de la actividad">
                    <small id="lugarError" class="form-text text-danger" style="display: none;"></small>
                    @error('lugar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label" for="actividades"><strong>Actividades a realizar:</strong></label>
                    <textarea id="actividades" name="actividades" class="form-control input" placeholder="Escribir la actividad"></textarea>
                    <small id="actividadesError" class="form-text text-danger" style="display: none;"></small>
                    @error('actividades')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="card-footer1 d-flex justify-content-center align-items-center">
                    <button type="submit" class="button1 input_select1">
                        <span>Generar</span>
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>


    <!-- Card de Registro de Actividades -->
    <div class="draggable-card1_4" id="cardRegistroActividades" style="display: none;">
        <div class="card-header">
            <span class="card-title">Registro de Actividades</span>
            <button type="button" class="close" onclick="closeCard('cardRegistroActividades')"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form action="{{ route('estudiantes.guardarActividad') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="fecha"><strong>Fecha:</strong></label>
                    <input type="date" id="fecha" name="fecha" class="form-control input" required value="{{ old('fecha') }}">
                </div>
                <div class="form-group">
                    <label for="actividades"><strong>Actividades a realizar:</strong></label>
                    <textarea id="actividades" name="actividades" class="form-control input" rows="4" required>{{ old('actividades') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="horas"><strong>Número de horas:</strong></label>
                    <input type="number" id="horas" name="horas" class="form-control input" required value="{{ old('horas') }}">
                </div>
                <div class="form-group">
                    <label for="evidencias"><strong>Resultados de la actividad (evidencias):</strong></label>
                    <div class="input-group input_file">
                        <span id="fileText" class="fileText input input_file"><i
                                class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el
                            documento</span>
                        <input type="file" id="evidencias" name="evidencias"
                            accept="image/jpeg, image/jpg, image/png" class="form-control-file input input_file"
                            onchange="displayFileName(this, 'fileText')">
                        <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre_actividad"><strong>Asigne Nombre de la actividad:</strong></label>
                    <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control input"
                         value="{{ old('nombre_actividad') }}">
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
                                <th class="tamanio">ACTIVIDADES</th>
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
                                    <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            {{ $actividad->fecha }}
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify; font-size: .7em;">
                                            {{ $actividad->actividades }}
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            {{ $actividad->numeroHoras }}
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: left; font-size: .7em;">
                                            {{ $actividad->nombreActividad ?? 'NO REQUIERE' }}
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            <img src="data:image/png;base64,{{ $actividad->evidencias ?? 'NO REQUIERE' }}" alt="Evidencia"
                                                width="100" height="100">
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            <div class="btn-group shadow-1">
                                                <form action="{{ route('eliminarActividad', $actividad->idActividades) }}"
                                                    method="POST" id="delete-form-{{ $actividad->idActividades }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="button3 efects_button btn_eliminar3"
                                                        onclick="confirmDeleteEstudiante({{ $actividad->idActividades }})">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
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
                                                            onclick="closeCard('cardEditActividad{{ $actividad->idActividades }}')"><i
                                                                class="fa-thin fa-xmark"></i></button>
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
                                                                    for="nombre_actividad{{ $actividad->idActividades }}"><b>Nombre
                                                                        de la Actividad</b></label>
                                                                <input type="text"
                                                                    class="form-control input input_select1"
                                                                    id="nombre_actividad{{ $actividad->idActividades }}"
                                                                    name="nombre_actividad"
                                                                    value="{{ $actividad->nombreActividad }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label"
                                                                    for="evidencias{{ $actividad->idActividades }}"><b>Evidencias</b></label>
                                                                <div>
                                                                    <img src="data:image/png;base64,{{ $actividad->evidencias }}"
                                                                        alt="Evidencia" width="100" height="100">
                                                                </div>
                                                                <div class="input-group input_file mt-2">
                                                                    <span id="fileText{{ $actividad->idActividades }}"
                                                                        class="fileText input input_file input_select1"><i
                                                                            class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                        Haz clic aquí para subir una nueva imagen</span>
                                                                    <input type="file"
                                                                        id="evidencias{{ $actividad->idActividades }}"
                                                                        name="evidencias"
                                                                        accept="image/jpeg, image/jpg, image/png"
                                                                        class="form-control-file input input_file"
                                                                        onchange="displayFileName(this, 'fileText{{ $actividad->idActividades }}')">
                                                                    <span title="Eliminar archivo"
                                                                        onclick="removeFile(this)"
                                                                        class="remove-icon">✖</span>
                                                                </div>
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
                        <tfoot>
                            <tr>
                                <td colspan="8" align="left"><strong>Total horas realizadas:</strong>
                                    {{ $totalHoras }} / 96</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>







            </div>
        </div>
    </div>

    <br>
    <hr>
    <center><button id="toggleFormBtn2" class="button1_1 efects_button">Mostar formulario para Informe de Servicio a la
            comunidad</button>
    </center>

    <br>
    <div class="contenedor_list_filtros">
        <div id="registroInforme" style="display: none;">


            <div id="formularioContainer">

                <form id="formularioInforme" action="{{ route('estudiantes.generarInforme') }}" method="post">
                    @csrf
                    <div class="mat-elevation-z8 contenedor_general">
                        <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                            <div class="contenedor_botones">
                                <div class="tooltip-container">
                                    <span class="tooltip-text">Guardar Datos</span>
                                    <button type="submit" class="button3 efects_button btn_primary"
                                        onclick="setScrollAndAction('{{ route('estudiantes.guardarDatos') }}')"><i
                                            class="fa-regular fa-floppy-disk"></i></button>
                                </div>
                                <div class="tooltip-container">
                                    <a href="{{ route('estudiantes.recuperarDatos') }}"
                                        class="button3 efects_button btn_filtro colorr"
                                        onclick="setScrollAndLink('{{ route('estudiantes.recuperarDatos') }}')"> <i
                                            class="fa-solid fa-window-restore"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="tipoInforme"><strong>Generar Informe:</strong></label>
                            <select class="form-control input input_select3" name="tipo" id="tipo">
                                <option value="#" disabled selected>Seleccione una opción</option>
                                <option value="grupal" {{ old('tipo') == 'grupal' ? 'selected' : '' }}>Grupal</option>
                                <option value="individual" {{ old('tipo') == 'individual' ? 'selected' : '' }}>Individual
                                </option>
                            </select>
                            <small id="tipoInformeError" class="error-message" style="color: red;"></small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombreComunidad"><strong>Nombre de la Comunidad o Comunidades
                                    Beneficiarias:</strong></label>
                            <input type="text" id="nombreComunidad" name="nombreComunidad" class="form-control input"
                                value="{{ old('nombreComunidad') }}" placeholder="Ingrese el nombre de la comunidad...">
                            <small id="nombreComunidadError" class="error-message" style="color: red;"></small>
                        </div>

                        @php
                            $proyectoComunidad = $proyecto->proyecto->comunidad ?? 'Datos no ingresados';
                            $proyectoProvincia = $proyecto->proyecto->provincia ?? 'Datos no ingresados';
                            $proyectoCanton = $proyecto->proyecto->canton ?? 'Datos no ingresados';
                            $proyectoParroquia = $proyecto->proyecto->parroquia ?? 'Datos no ingresados';
                            $proyectoDireccion = $proyecto->proyecto->direccion ?? 'Datos no ingresados';

                            $proyectoInfo = "Comunidad: {$proyectoComunidad}, Provincia: {$proyectoProvincia}, Cantón: {$proyectoCanton}, Parroquia: {$proyectoParroquia}, Dirección: {$proyectoDireccion}";
                        @endphp

                        <div class="form-group col-md-6">
                            <label for="proyecto"><strong>Información del proyecto - Datos cargados:</strong></label>
                            <input type="text" class="form-control input" id="proyecto" name="proyecto"
                                value="{{ $proyectoInfo }}" readonly>

                            <input type="hidden" name="proyecto_comunidad" value="{{ $proyectoComunidad }}">
                            <input type="hidden" name="proyecto_provincia" value="{{ $proyectoProvincia }}">
                            <input type="hidden" name="proyecto_canton" value="{{ $proyectoCanton }}">
                            <input type="hidden" name="proyecto_parroquia" value="{{ $proyectoParroquia }}">
                            <input type="hidden" name="proyecto_direccion" value="{{ $proyectoDireccion }}">
                        </div>
                    </div>
                    <div id="dynamicFieldContainer">
                        @if (old('provincia'))
                            @foreach (old('provincia') as $index => $provincia)
                                <div class="form-row dynamic-field">
                                    <div class="form-group col-md-3">
                                        <label for="provincia"><strong>Provincia:</strong></label>
                                        <select id="provincia" name="provincia[]" class="form-control input">
                                            <option value="" disabled>Seleccione una provincia...</option>
                                            <option value="Azuay" {{ $provincia == 'Azuay' ? 'selected' : '' }}>Azuay</option>
                                            <option value="Bolívar" {{ $provincia == 'Bolívar' ? 'selected' : '' }}>Bolívar</option>
                                            <option value="Cañar" {{ $provincia == 'Cañar' ? 'selected' : '' }}>Cañar</option>
                                            <option value="Carchi" {{ $provincia == 'Carchi' ? 'selected' : '' }}>Carchi</option>
                                            <option value="Chimborazo" {{ $provincia == 'Chimborazo' ? 'selected' : '' }}>Chimborazo</option>
                                            <option value="Cotopaxi" {{ $provincia == 'Cotopaxi' ? 'selected' : '' }}>Cotopaxi</option>
                                            <option value="El Oro" {{ $provincia == 'El Oro' ? 'selected' : '' }}>El Oro</option>
                                            <option value="Esmeraldas" {{ $provincia == 'Esmeraldas' ? 'selected' : '' }}>Esmeraldas</option>
                                            <option value="Galápagos" {{ $provincia == 'Galápagos' ? 'selected' : '' }}>Galápagos</option>
                                            <option value="Guayas" {{ $provincia == 'Guayas' ? 'selected' : '' }}>Guayas</option>
                                            <option value="Imbabura" {{ $provincia == 'Imbabura' ? 'selected' : '' }}>Imbabura</option>
                                            <option value="Loja" {{ $provincia == 'Loja' ? 'selected' : '' }}>Loja</option>
                                            <option value="Los Ríos" {{ $provincia == 'Los Ríos' ? 'selected' : '' }}>Los Ríos</option>
                                            <option value="Manabí" {{ $provincia == 'Manabí' ? 'selected' : '' }}>Manabí</option>
                                            <option value="Morona Santiago" {{ $provincia == 'Morona Santiago' ? 'selected' : '' }}>Morona Santiago</option>
                                            <option value="Napo" {{ $provincia == 'Napo' ? 'selected' : '' }}>Napo</option>
                                            <option value="Orellana" {{ $provincia == 'Orellana' ? 'selected' : '' }}>Orellana</option>
                                            <option value="Pastaza" {{ $provincia == 'Pastaza' ? 'selected' : '' }}>Pastaza</option>
                                            <option value="Pichincha" {{ $provincia == 'Pichincha' ? 'selected' : '' }}>Pichincha</option>
                                            <option value="Santa Elena" {{ $provincia == 'Santa Elena' ? 'selected' : '' }}>Santa Elena</option>
                                            <option value="Santo Domingo de los Tsáchilas" {{ $provincia == 'Santo Domingo de los Tsáchilas' ? 'selected' : '' }}>Santo Domingo de los Tsáchilas</option>
                                            <option value="Sucumbíos" {{ $provincia == 'Sucumbíos' ? 'selected' : '' }}>Sucumbíos</option>
                                            <option value="Tungurahua" {{ $provincia == 'Tungurahua' ? 'selected' : '' }}>Tungurahua</option>
                                            <option value="Zamora Chinchipe" {{ $provincia == 'Zamora Chinchipe' ? 'selected' : '' }}>Zamora Chinchipe</option>
                                        </select>
                                        <small id="provinciaError" class="error-message" style="color: red;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="canton"><strong>Cantón:</strong></label>
                                        <input type="text" id="canton" name="canton[]" class="form-control input"
                                            value="{{ old('canton')[$index] }}" placeholder="Ingrese el cantón...">
                                        <small id="cantonError" class="error-message" style="color: red;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="parroquia"><strong>Parroquia:</strong></label>
                                        <input type="text" id="parroquia" name="parroquia[]" class="form-control input"
                                            value="{{ old('parroquia')[$index] }}" placeholder="Ingrese la parroquia...">
                                        <small id="parroquiaError" class="error-message" style="color: red;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="direccion"><strong>Dirección:</strong></label>
                                        <input type="text" id="direccion" name="direccion[]" class="form-control input"
                                            value="{{ old('direccion')[$index] }}" placeholder="Ingrese la dirección...">
                                        <small id="direccionError" class="error-message" style="color: red;"></small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row dynamic-field">
                                <div class="form-group col-md-3">
                                    <label for="provincia"><strong>Provincia:</strong></label>
                                    <select id="provincia" name="provincia[]" class="form-control input">
                                        <option value="" disabled selected>Seleccione una provincia...</option>
                                        <option value="Azuay">Azuay</option>
                                        <option value="Bolívar">Bolívar</option>
                                        <option value="Cañar">Cañar</option>
                                        <option value="Carchi">Carchi</option>
                                        <option value="Chimborazo">Chimborazo</option>
                                        <option value="Cotopaxi">Cotopaxi</option>
                                        <option value="El Oro">El Oro</option>
                                        <option value="Esmeraldas">Esmeraldas</option>
                                        <option value="Galápagos">Galápagos</option>
                                        <option value="Guayas">Guayas</option>
                                        <option value="Imbabura">Imbabura</option>
                                        <option value="Loja">Loja</option>
                                        <option value="Los Ríos">Los Ríos</option>
                                        <option value="Manabí">Manabí</option>
                                        <option value="Morona Santiago">Morona Santiago</option>
                                        <option value="Napo">Napo</option>
                                        <option value="Orellana">Orellana</option>
                                        <option value="Pastaza">Pastaza</option>
                                        <option value="Pichincha">Pichincha</option>
                                        <option value="Santa Elena">Santa Elena</option>
                                        <option value="Santo Domingo de los Tsáchilas">Santo Domingo de los Tsáchilas</option>
                                        <option value="Sucumbíos">Sucumbíos</option>
                                        <option value="Tungurahua">Tungurahua</option>
                                        <option value="Zamora Chinchipe">Zamora Chinchipe</option>
                                    </select>
                                    <small id="provinciaError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="canton"><strong>Cantón:</strong></label>
                                    <input type="text" id="canton" name="canton[]" class="form-control input"
                                        placeholder="Ingrese el cantón...">
                                    <small id="cantonError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="parroquia"><strong>Parroquia:</strong></label>
                                    <input type="text" id="parroquia" name="parroquia[]" class="form-control input"
                                        placeholder="Ingrese la parroquia...">
                                    <small id="parroquiaError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="direccion"><strong>Dirección:</strong></label>
                                    <input type="text" id="direccion" name="direccion[]" placeholder="Ingrese la dirección..."
                                        class="form-control input">
                                    <small id="direccionError" class="error-message" style="color: red;"></small>
                                </div>
                            </div>
                        @endif
                    </div>


                    <!-- Botones para agregar y eliminar filas -->
                    <div class="d-flex">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Agregar</span>
                            <button type="button" class="button3 efects_button btn_nuevo3 mr-2" onclick="agregarFila()">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="tooltip-container">
                            <span class="tooltip-text">Eliminar</span>
                            <button type="button" class="button3 efects_button btn_eliminar3" onclick="eliminarFila()">
                                <i class='bx bx-trash'></i>
                            </button>
                        </div>
                    </div>
<br>
                    <!-- Validación de objetivos específicos y resultados -->
                    <div id="campos">
                        @if (old('especificos'))
                            @foreach (old('especificos') as $index => $especifico)
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                                        <textarea name="especificos[]" class="form-control input" rows="4"
                                            placeholder="Ingrese los objetivos específicos...">{{ $especifico }}</textarea>
                                        <small id="especificosError" class="error-message" style="color: red;"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                                        <textarea name="alcanzados[]" class="form-control input" placeholder="Ingrese que limitaciones tuvo..."
                                            rows="4">{{ old('alcanzados')[$index] }}</textarea>
                                        <small id="alcanzadosError" class="error-message" style="color: red;"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                                        <textarea name="porcentaje[]" class="form-control input" rows="4"
                                            placeholder="Ingrese el porcentaje alcanzado...">{{ old('porcentaje')[$index] }}</textarea>
                                        <small id="porcentajeError" class="error-message" style="color: red;"></small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                                    <textarea name="especificos[]" class="form-control input" placeholder="Ingrese los objetivos específicos..."
                                        rows="4"></textarea>
                                    <small id="especificosError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                                    <textarea name="alcanzados[]" class="form-control input" rows="4"
                                        placeholder="Ingrese los resultados alcanzados..."></textarea>
                                    <small id="alcanzadosError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                                    <textarea name="porcentaje[]" class="form-control input" rows="4"
                                        placeholder="Ingrese el porcentaje alcanzado..."></textarea>
                                    <small id="porcentajeError" class="error-message" style="color: red;"></small>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Botones para agregar y eliminar campos -->
                    <div class="d-flex">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Agregar</span>
                            <button type="button" class="button3 efects_button btn_nuevo3 mr-2"
                                onclick="agregarCampo()">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="tooltip-container">
                            <span class="tooltip-text">Eliminar</span>
                            <button type="button" class="button3 efects_button btn_eliminar3" onclick="eliminarCampo()">
                                <i class='bx bx-trash'></i>
                            </button>
                        </div>
                    </div>

                    <!-- Conclusiones y recomendaciones -->
                    <table class="four-column-table">
                        <tr>
                            <td>
                                <label for="conclusiones1">¿Qué resultados de aprendizaje obtuvo realizando las actividades
                                    de servicio comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones1" placeholder="Ingrese los resultados de aprendizaje..."
                                    class="form-control textarea input input_select2" name="conclusiones1" rows="4">{{ old('conclusiones1') }}</textarea>
                                <small id="conclusiones1Error" class="error-message" style="color: red;"></small>
                            </td>
                            <td>
                                <label for="conclusiones2">¿Qué limitaciones tuvo para realizar sus actividades de servicio
                                    comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones2" placeholder="Ingrese que limitaciones tuvo..."
                                    class="form-control textarea input input_select2" name="conclusiones2" rows="4">{{ old('conclusiones2') }}</textarea>
                                <small id="conclusiones2Error" class="error-message" style="color: red;"></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="razones">Explicar las razones que justifican las actividades
                                    realizadas de servicio comunitario, acorde con su perfil:</label>
                            </td>
                            <td class="textarea-cell" colspan="3">
                                <textarea id="razones" class="form-control textarea input input_select2"
                                    placeholder="Ingrese las razones del proyecto..." name="razones" rows="4">{{ old('razones') }}</textarea>
                                <small id="razonesError" class="error-message" style="color: red;"></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conclusiones3">¿Qué éxitos alcanzados se obtuvo cuando realizó sus actividades
                                    de servicio comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones3" class="form-control textarea input input_select2"
                                    placeholder="Ingrese los éxitos alcanzados..." name="conclusiones3" rows="4">{{ old('conclusiones3') }}</textarea>
                                <small id="conclusiones3Error" class="error-message" style="color: red;"></small>
                            </td>
                            <td>
                                <label for="recomendaciones">Recomendaciones:</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="recomendaciones" class="form-control textarea input input_select2"
                                    placeholder="Ingrese las recomendaciones..." name="recomendaciones" rows="4">{{ old('recomendaciones') }}</textarea>
                                <small id="recomendacionesError" class="error-message" style="color: red;"></small>
                            </td>
                        </tr>
                    </table>

                    <center>
                        <button type="submit" class="button1">Crear Informe</button>
                    </center>
                </form>


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
            document.addEventListener('DOMContentLoaded', function() {
                // Configurar el arrastre de modales y tarjetas
                $('#registroActividadesModal .modal-dialog').draggable({
                    handle: ".modal-header"
                });

                $('#registroActividadesModal').modal({
                    backdrop: false
                });

                $('.draggable-card').draggable({
                    handle: ".card-header",
                    containment: "window"
                });

                $('.draggable-card1_4').draggable({
                    handle: ".card-header",
                    containment: "window"
                });

                // Control de despliegue de formularios con scroll
                if (sessionStorage.getItem('scrollToForm') === 'true') {
                    const element = document.getElementById('formularioContainer');
                    if (element) {
                        window.scrollTo({
                            top: element.offsetTop,
                            behavior: 'smooth'
                        });
                        document.getElementById('registroInforme').style.display = 'block';
                    }
                    sessionStorage.removeItem('scrollToForm');
                }

                // Sincronizar el tipo de documento con los selectores
                const tipoInformeSelect = document.getElementById('tipoInforme');
                const tipoDocumentos1 = document.getElementById('tipoDocumentos1');
                const tipoDocumentos2 = document.getElementById('tipoDocumentos2');

                tipoInformeSelect.addEventListener('change', function() {
                    tipoDocumentos1.value = this.value;
                    tipoDocumentos2.value = this.value;
                });

                // Inicialmente establecer el valor al cargar la página
                tipoDocumentos1.value = tipoInformeSelect.value;
                tipoDocumentos2.value = tipoInformeSelect.value;

                // Configurar auto-cierre de alertas
                const alertElement = document.querySelector('.contenedor_alerta');
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.style.display = 'none';
                    }, 5000); // 1000 ms = 1 segundo
                }

                // Configurar el formAsistencia para sincronizar el tipo de informe
                document.getElementById('formAsistencia').addEventListener('submit', function() {
                    var tipoInforme = document.getElementById('tipoInforme').value;
                    document.getElementById('tipoDocumentosHidden').value = tipoInforme;
                });
            });

            // Función para abrir y cerrar tarjetas modales
            function openCard(cardId) {
                document.getElementById(cardId).style.display = 'block';
            }

            function closeCard(cardId) {
                document.getElementById(cardId).style.display = 'none';
            }

            // Funciones para manejar el archivo subido
            function displayFileName(input, fileTextId) {
                const fileName = input.files[0].name;
                document.getElementById(fileTextId).textContent = fileName;
            }

            function removeFile(element) {
                const input = element.previousElementSibling;
                const fileText = element.previousElementSibling.previousElementSibling;
                input.value = ""; // Limpiar el input
                fileText.textContent =
                    '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir una nueva imagen';
                element.style.display = 'none'; // Ocultar el botón de eliminar
            }

            // Función para confirmar la eliminación de un estudiante
            function confirmDeleteEstudiante(id) {
                Swal.fire({
                    title: '¿Estás seguro de eliminar la actividad?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7066e0',
                    cancelButtonColor: '#808080',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        container: 'my-swal',
                        popup: 'my-swal-popup',
                        header: 'my-swal-header',
                        title: 'my-swal-title',
                        closeButton: 'my-swal-close-button',
                        icon: 'my-swal-icon',
                        image: 'my-swal-image',
                        content: 'my-swal-content',
                        input: 'my-swal-input',
                        actions: 'my-swal-actions',
                        confirmButton: 'my-swal-confirm-button',
                        cancelButton: 'my-swal-cancel-button',
                        footer: 'my-swal-footer'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

            // Funciones para agregar y eliminar filas dinámicas en el formulario
            function agregarFila() {
                var container = document.getElementById('dynamicFieldContainer');
                var newField = document.querySelector('.dynamic-field').cloneNode(true);
                newField.querySelectorAll('input').forEach(input => input.value = '');
                container.appendChild(newField);
            }

            function eliminarFila() {
                var container = document.getElementById('dynamicFieldContainer');
                var fields = container.querySelectorAll('.dynamic-field');
                if (fields.length > 1) {
                    container.removeChild(fields[fields.length - 1]);
                }
            }

            // Funciones para agregar y eliminar campos dinámicos en el formulario
            function agregarCampo() {
                const camposContainer = document.getElementById('campos');
                const nuevoCampo = document.createElement('div');
                nuevoCampo.classList.add('form-row');
                nuevoCampo.innerHTML = `
        <div class="form-group col-md-4">
            <label for="especificos"><strong>Objetivos Específicos:</strong></label>
            <textarea name="especificos[]" class="form-control input" placeholder="Ingrese los objetivos específicos..." rows="4" required></textarea>
        </div>
        <div class="form-group col-md-4">
            <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
            <textarea name="alcanzados[]" class="form-control input" placeholder="Ingrese los resultados alcanzados..." rows="4" required></textarea>
        </div>
        <div class="form-group col-md-4">
            <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
            <textarea name="porcentaje[]" class="form-control input" placeholder="Ingrese el porcentaje alcanzado..." rows="4" required></textarea>
        </div>
    `;
                camposContainer.appendChild(nuevoCampo);
            }

            function eliminarCampo() {
                const camposContainer = document.getElementById('campos');
                if (camposContainer.children.length > 1) {
                    camposContainer.removeChild(camposContainer.lastElementChild);
                }
            }

            // Función para configurar la acción del formulario con scroll
            function setScrollAndAction(actionUrl) {
                sessionStorage.setItem('scrollToForm', 'true');
                document.getElementById('formularioInforme').action = actionUrl;
            }

            // Función para configurar un enlace con scroll
            function setScrollAndLink(linkUrl) {
                sessionStorage.setItem('scrollToForm', 'true');
                window.location.href = linkUrl;
            }
        </script>






        <script>
            function agregarCampo() {
                const camposContainer = document.getElementById('campos');
                const nuevoCampo = document.createElement('div');
                nuevoCampo.classList.add('form-row');
                nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                <textarea name="especificos[]" class="form-control input" placeholder="Ingrese los objetivos específicos..." rows="4" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                <textarea name="alcanzados[]" class="form-control input" placeholder="Ingrese los resultado alcanzados..." rows="4" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                <textarea name="porcentaje[]" class="form-control input" placeholder="Ingrese el porcentaje alcanzado..." rows="4" required></textarea>
            </div>
        `;
                camposContainer.appendChild(nuevoCampo);
            }

            function eliminarCampo() {
                const camposContainer = document.getElementById('campos');
                if (camposContainer.children.length > 1) {
                    camposContainer.removeChild(camposContainer.lastElementChild);
                }
            }
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

            .form-row .form-group.col-md-4 {
                flex: 0 0 33.333%;
                /* Esto asegura que cada columna ocupe un tercio del ancho del contenedor */
                max-width: 33.333%;
            }

            .form-row .form-group.col-md-4 textarea {
                width: 100%;
                /* Asegura que el textarea ocupe todo el ancho disponible dentro de su columna */
                box-sizing: border-box;
                /* Asegura que el padding se incluya dentro del ancho */
            }
        </style>

        <style>
            .textarea.form-control {
                height: none !important;
            }

            .four-column-table {
                width: 100%;
                table-layout: fixed;
                /* Las columnas tendrán el mismo ancho */
                border-collapse: separate;
                border-spacing: 10px;
                /* Espaciado entre celdas */
            }

            .four-column-table td {
                width: 25%;
                /* Cada columna ocupará el 25% del ancho total */
                vertical-align: top;
            }

            .four-column-table .textarea-cell {
                padding: 5px;
            }

            .four-column-table textarea {
                width: 100%;
                box-sizing: border-box;
                /* Asegura que el padding no expanda el ancho del textarea */
            }

            .colorr {
                color: #ffffff !important;
            }
        </style>


        <script>
            document.getElementById('formularioInforme').addEventListener('submit', function(event) {
                // Limpiar mensajes de error previos
                document.getElementById('nombreComunidadError').textContent = '';
                document.getElementById('tipoInformeError').textContent = '';
                document.getElementById('provinciaError').textContent = '';
                document.getElementById('cantonError').textContent = '';
                document.getElementById('parroquiaError').textContent = '';
                document.getElementById('direccionError').textContent = '';
                document.getElementById('especificosError').textContent = '';
                document.getElementById('alcanzadosError').textContent = '';
                document.getElementById('porcentajeError').textContent = '';
                document.getElementById('conclusiones1Error').textContent = '';
                document.getElementById('conclusiones2Error').textContent = '';
                document.getElementById('razonesError').textContent = '';
                document.getElementById('conclusiones3Error').textContent = '';
                document.getElementById('recomendacionesError').textContent = '';

                let formIsValid = true;

                // Validar 'nombreComunidad'
                const nombreComunidad = document.getElementById('nombreComunidad').value.trim();
                if (nombreComunidad === "") {
                    document.getElementById('nombreComunidadError').textContent =
                        'El nombre de la comunidad es requerido.';
                    formIsValid = false;
                }

                // Validar 'tipoInforme'
                const tipoInforme = document.getElementById('tipo').value.trim();
                if (tipoInforme === "#") {
                    document.getElementById('tipoInformeError').textContent = 'Debe seleccionar un tipo de informe.';
                    formIsValid = false;
                }



                // Validar 'especificos'
                const especificos = document.querySelectorAll('textarea[name="especificos[]"]');
                especificos.forEach(function(especifico, index) {
                    if (especifico.value.trim() === "") {
                        document.getElementById('especificosError').textContent =
                            'Los objetivos específicos son requeridos.';
                        formIsValid = false;
                    }
                });

                // Validar 'alcanzados'
                const alcanzados = document.querySelectorAll('textarea[name="alcanzados[]"]');
                alcanzados.forEach(function(alcanzado, index) {
                    if (alcanzado.value.trim() === "") {
                        document.getElementById('alcanzadosError').textContent =
                            'Los resultados alcanzados son requeridos.';
                        formIsValid = false;
                    }
                });

                // Validar 'porcentaje'
                const porcentajes = document.querySelectorAll('textarea[name="porcentaje[]"]');
                porcentajes.forEach(function(porcentaje, index) {
                    if (porcentaje.value.trim() === "") {
                        document.getElementById('porcentajeError').textContent =
                            'El porcentaje alcanzado es requerido.';
                        formIsValid = false;
                    }
                });

                // Validar 'conclusiones1'
                const conclusiones1 = document.getElementById('conclusiones1').value.trim();
                if (conclusiones1 === "") {
                    document.getElementById('conclusiones1Error').textContent = 'Este campo es requerido.';
                    formIsValid = false;
                }

                // Validar 'conclusiones2'
                const conclusiones2 = document.getElementById('conclusiones2').value.trim();
                if (conclusiones2 === "") {
                    document.getElementById('conclusiones2Error').textContent = 'Este campo es requerido.';
                    formIsValid = false;
                }

                // Validar 'razones'
                const razones = document.getElementById('razones').value.trim();
                if (razones === "") {
                    document.getElementById('razonesError').textContent = 'Este campo es requerido.';
                    formIsValid = false;
                }

                // Validar 'conclusiones3'
                const conclusiones3 = document.getElementById('conclusiones3').value.trim();
                if (conclusiones3 === "") {
                    document.getElementById('conclusiones3Error').textContent = 'Este campo es requerido.';
                    formIsValid = false;
                }

                // Validar 'recomendaciones'
                const recomendaciones = document.getElementById('recomendaciones').value.trim();
                if (recomendaciones === "") {
                    document.getElementById('recomendacionesError').textContent = 'Este campo es requerido.';
                    formIsValid = false;
                }

                // Si el formulario no es válido, evitar el envío
                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            // Eliminar mensaje de error al escribir
            document.getElementById('nombreComunidad').addEventListener('input', function() {
                document.getElementById('nombreComunidadError').textContent = '';
            });

            document.getElementById('tipo').addEventListener('change', function() {
                document.getElementById('tipoInformeError').textContent = '';
            });

            document.getElementById('provincia').addEventListener('input', function() {
                document.getElementById('provinciaError').textContent = '';
            });

            document.getElementById('canton').addEventListener('input', function() {
                document.getElementById('cantonError').textContent = '';
            });

            document.getElementById('parroquia').addEventListener('input', function() {
                document.getElementById('parroquiaError').textContent = '';
            });

            document.getElementById('direccion').addEventListener('input', function() {
                document.getElementById('direccionError').textContent = '';
            });

            document.querySelectorAll('textarea[name="especificos[]"]').forEach(function(element) {
                element.addEventListener('input', function() {
                    document.getElementById('especificosError').textContent = '';
                });
            });

            document.querySelectorAll('textarea[name="alcanzados[]"]').forEach(function(element) {
                element.addEventListener('input', function() {
                    document.getElementById('alcanzadosError').textContent = '';
                });
            });

            document.querySelectorAll('textarea[name="porcentaje[]"]').forEach(function(element) {
                element.addEventListener('input', function() {
                    document.getElementById('porcentajeError').textContent = '';
                });
            });

            document.getElementById('conclusiones1').addEventListener('input', function() {
                document.getElementById('conclusiones1Error').textContent = '';
            });

            document.getElementById('conclusiones2').addEventListener('input', function() {
                document.getElementById('conclusiones2Error').textContent = '';
            });

            document.getElementById('razones').addEventListener('input', function() {
                document.getElementById('razonesError').textContent = '';
            });

            document.getElementById('conclusiones3').addEventListener('input', function() {
                document.getElementById('conclusiones3Error').textContent = '';
            });

            document.getElementById('recomendaciones').addEventListener('input', function() {
                document.getElementById('recomendacionesError').textContent = '';
            });
        </script>

        <script>
            document.getElementById('formAsistencia').addEventListener('submit', function(event) {
                // Limpiar mensajes de error previos
                document.getElementById('fechaError').style.display = 'none';
                document.getElementById('lugarError').style.display = 'none';
                document.getElementById('actividadesError').style.display = 'none';

                let formIsValid = true;

                // Validar 'fecha'
                const fecha = document.getElementById('fecha').value.trim();
                if (fecha === "") {
                    document.getElementById('fechaError').textContent = 'La fecha de asistencia es requerida.';
                    document.getElementById('fechaError').style.display = 'block';
                    formIsValid = false;
                }

                // Validar 'lugar'
                const lugar = document.getElementById('lugar').value.trim();
                if (lugar === "") {
                    document.getElementById('lugarError').textContent = 'El lugar de la actividad es requerido.';
                    document.getElementById('lugarError').style.display = 'block';
                    formIsValid = false;
                }

                // Validar 'actividades'
                const actividades = document.getElementById('actividades').value.trim();
                if (actividades === "") {
                    document.getElementById('actividadesError').textContent =
                        'Las actividades a realizar son requeridas.';
                    document.getElementById('actividadesError').style.display = 'block';
                    formIsValid = false;
                }

                // Si el formulario no es válido, evitar el envío
                if (!formIsValid) {
                    event.preventDefault();
                }
            });

            // Eliminar mensaje de error al escribir
            document.querySelectorAll('#formAsistencia input, #formAsistencia textarea').forEach(function(element) {
                element.addEventListener('input', function() {
                    const errorElement = document.getElementById(element.id + 'Error');
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                });
            });
        </script>


    @endsection
