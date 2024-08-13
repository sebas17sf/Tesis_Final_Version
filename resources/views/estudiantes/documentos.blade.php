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
            <form class="FormularioRegistroHoras" action="{{ route('estudiante.generarAsistenciaEstudiantes') }}"
                method="post" id="formAsistencia">
                @csrf
                <input type="hidden" name="tipoDocumentos" id="tipoDocumentosHidden">
                <div class="form-group">
                    <label class="label" for="fecha"><strong>Fecha de asistencia:</strong></label>
                    <input type="date" id="fecha" name="fecha" class="form-control input" required>
                    <small id="fechaError" class="form-text text-danger" style="display: none;"></small>
                    @error('fecha')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="label" for="lugar"><strong>Lugar de la actividad:</strong></label>
                    <input type="text" id="lugar" name="lugar" class="form-control input"
                        placeholder="Escribir el lugar de la actividad" required>
                    <small id="lugarError" class="form-text text-danger" style="display: none;"></small>
                    @error('lugar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="label" for="actividades"><strong>Actividades a realizar:</strong></label>
                    <textarea id="actividades" name="actividades" class="form-control input" placeholder="Escribir la actividad" required></textarea>
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
                                class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el
                            documento</span>
                        <input type="file" id="evidencias" name="evidencias"
                            accept="image/jpeg, image/jpg, image/png" class="form-control-file input input_file" required
                            onchange="displayFileName(this, 'fileText')">
                        <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre_actividad"><strong>Asigne Nombre de la actividad:</strong></label>
                    <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control input"
                        required>
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
                                    <tr>
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
                                            {{ $actividad->nombreActividad }}
                                        </td>
                                        <td
                                            style="text-transform: uppercase; word-wrap: break-word; text-align: center; font-size: .7em;">
                                            <img src="data:image/png;base64,{{ $actividad->evidencias }}" alt="Evidencia"
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
    <center><button id="toggleFormBtn2" class="button1_1 efects_button">Crear Informe de Servicio a la
            comunidad</button>
    </center>

    <br>
    <div class="contenedor_list_filtros">
        <div id="registroInforme" style="display: none;">


            <div id="formularioContainer">

                <form id="formularioInforme" action="{{ route('estudiantes.generarInforme') }}" method="post">

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
                                        class="button3 efects_button btn_filtro"
                                        onclick="setScrollAndLink('{{ route('estudiantes.recuperarDatos') }}')"> <i
                                            class="fa-solid fa-window-restore"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="tipoInforme"><strong>Generar Informe:</strong></label>
                            <select class="form-control input input_select3" name="tipo" id="tipo">
                                <option value="grupal" {{ old('tipo') == 'grupal' ? 'selected' : '' }}>Grupal</option>
                                <option value="individual" {{ old('tipo') == 'individual' ? 'selected' : '' }}>Individual
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombreComunidad"><strong>Nombre de la Comunidad o Comunidades
                                    Beneficiarias:</strong></label>
                            <input type="text" id="nombreComunidad" name="nombreComunidad" class="form-control input"
                                value="{{ old('nombreComunidad') }}" placeholder="Ingrese el nombre de la comunidad..."
                                required>
                        </div>


                    </div>
                    <div id="dynamicFieldContainer">
                        @if (old('provincia'))
                            @foreach (old('provincia') as $index => $provincia)
                                <div class="form-row dynamic-field">
                                    <div class="form-group col-md-3">
                                        <label for="provincia"><strong>Provincia:</strong></label>
                                        <input type="text" id="provincia" name="provincia[]"
                                            class="form-control input" value="{{ $provincia }}"
                                            placeholder="Ingrese la provincia..." required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="canton"><strong>Cantón:</strong></label>
                                        <input type="text" id="canton" name="canton[]" class="form-control input"
                                            value="{{ old('canton')[$index] }}" placeholder="Ingrese el cantón..."
                                            required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="parroquia"><strong>Parroquia:</strong></label>
                                        <input type="text" id="parroquia" name="parroquia[]"
                                            class="form-control input" value="{{ old('parroquia')[$index] }}"
                                            placeholder="Ingrese la parroquia..." required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="direccion"><strong>Dirección:</strong></label>
                                        <input type="text" id="direccion" name="direccion[]"
                                            class="form-control input" value="{{ old('direccion')[$index] }}"
                                            placeholder="Ingrese la dirección..." required>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row dynamic-field">
                                <div class="form-group col-md-3">
                                    <label for="provincia"><strong>Provincia:</strong></label>
                                    <input type="text" id="provincia" name="provincia[]" class="form-control input"
                                        placeholder="Ingrese la provincia..." required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="canton"><strong>Cantón:</strong></label>
                                    <input type="text" id="canton" name="canton[]" class="form-control input"
                                        placeholder="Ingrese el cantón..." required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="parroquia"><strong>Parroquia:</strong></label>
                                    <input type="text" id="parroquia" name="parroquia[]" class="form-control input"
                                        placeholder="Ingrese la parroquia..." required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="direccion"><strong>Dirección:</strong></label>
                                    <input type="text" id="direccion" name="direccion[]"
                                        placeholder="Ingrese la dirección..." class="form-control input" required>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Los botones siempre estarán visibles -->
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
                    <div id="campos">
                        @if (old('especificos'))
                            @foreach (old('especificos') as $index => $especifico)
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                                        <textarea name="especificos[]" class="form-control input" rows="4" required
                                            placeholder="Ingrese los objetivos específicos...">{{ $especifico }}</textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                                        <textarea name="alcanzados[]" class="form-control input" placeholder="Ingrese que limitaciones tuvo..."
                                            rows="4" required>{{ old('alcanzados')[$index] }}</textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                                        <textarea name="porcentaje[]" class="form-control input" rows="4" required>{{ old('porcentaje')[$index] }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                                    <textarea name="especificos[]" class="form-control input" placeholder="Ingrese los objetivos específicos..."
                                        rows="4" required></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                                    <textarea name="alcanzados[]" class="form-control input" rows="4"
                                        placeholder="Ingrese los resultados alzanzados" required></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                                    <textarea name="porcentaje[]" class="form-control input" rows="4"
                                        placeholder="Ingrese el porcentaje alcanzado..." required></textarea>
                                </div>
                            </div>


                        @endif

                    </div>
                    <div class="d-flex" styele="align-items: center !important;">
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

                    <br>
                    <table class="four-column-table">
                        <tr>
                            <td>
                                <label for="conclusiones1">¿Qué resultados de aprendizaje obtuvo realizando las actividades
                                    de servicio comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones1" placeholder="Ingrese los resultados de aprendizaje..."
                                    class="textarea input input_select2" name="conclusiones1" rows="10">{{ old('conclusiones1') }}</textarea>
                            </td>
                            <td>
                                <label for="conclusiones2">¿Qué limitaciones tuvo para realizar sus actividades de servicio
                                    comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones2" placeholder="Ingrese que limitaciones tuvo..." class="textarea input input_select2"
                                    name="conclusiones2" rows="10">{{ old('conclusiones2') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="razones">Explicar las razones que justifican las actividades
                                    realizadas de servicio comunitario, acorde con su perfil:</label>
                            </td>
                            <td class="textarea-cell" colspan="3">
                                <textarea id="razones" class="textarea input input_select2" placeholder="Ingrese las razones del proyecto..."
                                    name="razones" rows="10" required>{{ old('razones') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conclusiones3">¿Qué éxitos alcanzados se obtuvo cuando realizó sus actividades
                                    de servicio comunitario?</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="conclusiones3" class="textarea input input_select2" placeholder="Ingrese los éxitos alcanzados..."
                                    name="conclusiones3" rows="10">{{ old('conclusiones3') }}</textarea>
                            </td>
                            <td>
                                <label for="recomendaciones">Recomendaciones:</label>
                            </td>
                            <td class="textarea-cell">
                                <textarea id="recomendaciones" class="textarea input input_select2" placeholder="Ingrese las recomendaciones..."
                                    name="recomendaciones" rows="10">{{ old('recomendaciones') }}</textarea>
                            </td>
                        </tr>

                    </table>
                    <center>
                        <button type="submit" class="button1"
                            onclick="setScrollAndAction('{{ route('estudiantes.generarInforme') }}')">Crear
                            Informe</button>
                    </center>

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
                    }, 1000); // 1000 ms = 1 segundo
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


    @endsection
