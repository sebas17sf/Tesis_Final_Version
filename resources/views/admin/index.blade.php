@extends('layouts.admin')

@section('title', 'Panel de Administrador')

@section('title_component', 'Panel de Administrador')

@section('content')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success ') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('maestro_con_proyectos'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'El Docente tiene proyectos asignados y no se puede eliminar.',
            });
            {
                {
                    session() - > forget('maestro_con_proyectos')
                }
            }
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error ') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
    <style>
        .modal-backdrop {
            display: none !important;
            /* Oculta el fondo oscuro */
        }

        /* Para permitir el movimiento del modal */
        .modal-static {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    @if (session('errorMaestro'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar el docente',
                html: '{{ session('errorMaestro') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
    <br>
    <section class="contenedor_agregar_periodo">
        <section>
            <div class="mat-elevation-z8">
                @if ($profesoresPendientes->isEmpty())
                    <p>No existen usuarios administrativos.</p>
                @else
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaProyectos">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                            <th mat-header-cell *matHeaderCellDef>TIPO</th>
                                            <th mat-header-cell *matHeaderCellDef>USUARIO</th>
                                            <th mat-header-cell *matHeaderCellDef>CORREO</th>
                                            <th mat-header-cell *matHeaderCellDef>ESTADO ACTUAL</th>
                                            <th mat-header-cell *matHeaderCellDef>MODIFICAR</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($profesoresPendientes as $profesor)
                                            <tr>
                                                <td class="table1">{{ strtoupper($profesor->NombreUsuario) }}</td>
                                                <td class="table1">{{ strtoupper($profesor->NombreUsuario) }}</td>
                                                <td class="table1">{{ $profesor->CorreoElectronico }}</td>
                                                <td class="table1">{{ $profesor->Estado }}</td>
                                                <td>
                                                    <!-- Botón de Editar -->
                                                    <center><button type="button" class="button3 efects_button btn_editar3"
                                                            data-toggle="modal" data-target="#editModal{{ $profesor->id }}">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </button></center>
                                                </td>
                                            </tr>

                                            <!-- Modal para Editar Profesor -->
                                            <div class="modal fade" id="editModal{{ $profesor->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $profesor->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST"
                                                            action="{{ route('admin.updateEstado', ['id' => $profesor->UserID]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $profesor->id }}">
                                                                    Editar Profesor</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="NombreUsuario{{ $profesor->id }}">Nombre de
                                                                        Usuario</label>
                                                                    <input type="text" class="form-control"
                                                                        id="NombreUsuario{{ $profesor->id }}"
                                                                        name="NombreUsuario"
                                                                        value="{{ $profesor->NombreUsuario }}" required
                                                                        disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="CorreoElectronico{{ $profesor->id }}">Correo
                                                                        Electrónico</label>
                                                                    <input type="email" class="form-control"
                                                                        id="CorreoElectronico{{ $profesor->id }}"
                                                                        name="CorreoElectronico"
                                                                        value="{{ $profesor->CorreoElectronico }}" required
                                                                        disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Estado{{ $profesor->id }}">Estado</label>
                                                                    <select class="form-control"
                                                                        id="Estado{{ $profesor->id }}" name="Estado"
                                                                        required>
                                                                        <option value="activo"
                                                                            {{ $profesor->Estado == 'Activo' ? 'selected' : '' }}>
                                                                            Activo</option>
                                                                        <option value="inactivo"
                                                                            {{ $profesor->Estado == 'Inactivo' ? 'selected' : '' }}>
                                                                            Inactivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password{{ $profesor->id }}">Cambiar
                                                                        Contraseña</label>
                                                                    <input type="password" class="form-control"
                                                                        id="password{{ $profesor->id }}" name="password"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar
                                                                    Cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                @endif



                @if (session('permisosConcedidos'))
                    <div class="alert alert-success">
                        {{ session('permisosConcedidos') }}
                    </div>
                @endif

            </div>

        </section>



        <br>
        <div class="d-flex  justify-content-center">
            <form action="{{ route('admin.respaldo') }}" method="POST" class="mr-2">
                @csrf
                <button type="submit" class="button1">Respaldar Base de Datos</button>
            </form>
            <button type="button" class="button1 mr-2" data-toggle="modal" data-target="#modalAgregarNRC">
                Agregar NRC
            </button>
            <button type="button" class="button1 mr-2" data-toggle="modal" data-target="#modalAgregarPeriodo">
                Agregar Periodo
            </button>
            <button type="button" class="button1" data-toggle="modal" data-target="#editarPeriodoModal">
                Editar Periodo
            </button>
        </div>
        <br>
        <section>
            <!-- Archivos de notas -->

            <div>
                <span><b>Docentes agregados</b></span>

                <hr>

            </div>
            <!-- Modal para docentes -->

            <div class="modal fade" id="modalAgregarMaestro" tabindex="-1" role="dialog"
                aria-labelledby="modalAgregarMaestroLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="modalAgregarMaestroLabel"><b>Agregar Docentes</b></span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.guardarMaestro') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="nombres"><strong>Ingrese Nombres:</strong></label>
                                        <input type="text" id="nombres" name="nombres" class="form-control input"
                                            placeholder="Ingrese los dos Nombres" required>
                                        <small id="nombresError" class="form-text text-danger"
                                            style="display: none;"></small>

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="apellidos"><strong>Ingrese Apellidos:</strong></label>
                                        <input type="text" id="apellidos" name="apellidos" class="form-control input"
                                            placeholder="Ingrese los dos Apellidos" required>
                                        <small id="apellidosError" class="form-text text-danger"
                                            style="display: none;"></small>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="correo"><strong>Ingrese Correo:</strong></label>
                                        <input type="email" id="correo" name="correo" class="form-control input"
                                            placeholder="Ingrese el Correo Electrónico" required>
                                        <small id="correoError" class="form-text text-danger"
                                            style="display: none;"></small>
                                        @error('correo')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cedula"><strong>Ingrese la Cédula:</strong></label>
                                        <input type="text" id="cedula" name="cedula" class="form-control input"
                                            placeholder="Ingrese Cédula (10 dígitos)" pattern="\d{10}"
                                            title="Debe ingresar exactamente 10 números" required>
                                        <small id="cedulaError" class="form-text text-danger"
                                            style="display: none;"></small>
                                        @error('cedula')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="espe_id"><strong>Ingrese el la ID de la ESPE:</strong></label>
                                        <input type="text" id="espe_id" name="espe_id" class="form-control input"
                                            placeholder="Ingrese la ID de la ESPE" required>
                                        <small id="espeIdError" class="form-text text-danger"
                                            style="display: none;"></small>
                                        @error('espe_id')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="departamento"><strong>Seleccione el departamento al que
                                                pertenece:</strong></label>
                                        <select id="departamento" name="departamento"
                                            class="form-control input_select input" required>
                                            <option value="Ciencias de la Computación">Ciencias de la
                                                Computación</option>
                                            <option value="Ciencias de la Vida">Ciencias de la Vida
                                            </option>
                                            <option value="Ciencias Exactas">Ciencias Exactas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------- -->

            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">

                        <div class="tooltip-container">
                            <span class="tooltip-text">Agregar</span>
                            <button type="button" class="button3 efects_button btn_primary" data-toggle="modal"
                                data-target="#modalAgregarMaestro">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('admin.reportesDocentes') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Copiar -->
                        <!--<div class="tooltip-container">
                                    <span class="tooltip-text">Copiar</span>
                                    <button class="button3 efects_button btn_copy" onclick="copyDataToClipboard(event)"
                                        pTooltip="Copiar" tooltipPosition="top">
                                        <i class="fa-solid fa-copy" id="icon"></i>
                                    </button>

                                </div>-->

                    </div>

                    <!-- Buscador -->
                    <div class="contenedor_buscador">
                        <div>
                            <form id="formBusquedaDocentes">
                                <input type="text" class="input" name="search" value="{{ $search }}"
                                    matInput placeholder="Buscar proyectos...">
                                <i class='bx bx-search-alt'></i>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaProyectos">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">NOMBRE</th>
                                        <th>CORREO</th>
                                        <th>USUARIO</th>
                                        <th>CEDULA</th>
                                        <th class="tamanio1">DEPARTAMENTO</th>
                                        <th>ID ESPE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($profesores->isEmpty())
                                        <tr class="noExisteRegistro ng-star-inserted" style="text-align:center">
                                            <td colspan="6">No se encontraron resultados para la búsqueda.</td>
                                        </tr>
                                    @else
                                        @foreach ($profesores as $profesor)
                                            <tr>
                                                <td style="word-wrap: break-word; text-align: left; padding: 5px 8px;">
                                                    {{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Apellidos)) }}
                                                    {{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Nombres)) }}
                                                </td>
                                                <td>{{ $profesor->Correo }}</td>
                                                <td class="center_size">{{ $profesor->Usuario }}</td>
                                                <td class="center_size">{{ $profesor->Cedula }}</td>
                                                <td class="medium_size">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $profesor->Departamento)) }}
                                                </td>
                                                <td class="center_size">{{ $profesor->espe_id }}</td>
                                                <td>
                                                    <div class="contenedor_botones">
                                                        <div class="btn-group  shadow-1">

                                                            <div class="tooltip-container">
                                                                <button type="button"
                                                                    class="button3 efects_button btn_editar3"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEditarMaestro{{ $profesor->id }}">
                                                                    <i class="bx bx-edit-alt"></i>
                                                                </button>
                                                            </div>

                                                            <!---Modal para editar Docentes--------------------------------------------------->

                                                            <div class="modal fade"
                                                                id="modalEditarMaestro{{ $profesor->id }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="modalEditarMaestroLabel{{ $profesor->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <!-- Añade la clase modal-lg para un modal grande -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <span class="modal-title"
                                                                                id="modalEditarMaestroLabel{{ $profesor->id }}">
                                                                                <b>Editar Docentes</b>
                                                                            </span>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('admin.actualizarMaestro', ['id' => $profesor->id]) }}"
                                                                                method="POST"
                                                                                id="formularioEditarMaestro">
                                                                                @csrf
                                                                                @method('PUT')

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-4">
                                                                                        <label
                                                                                            for="nombresEditarMaestro"><strong>Ingrese
                                                                                                Nombres:</strong></label>
                                                                                        <input type="text"
                                                                                            id="nombresEditarMaestro"
                                                                                            name="nombres"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->Nombres }}"
                                                                                            required>

                                                                                    </div>



                                                                                    <div class="form-group col-md-4">
                                                                                        <label
                                                                                            for="apellidosEditarMaestro"><strong>Ingrese
                                                                                                Apellidos:</strong></label>
                                                                                        <input type="text"
                                                                                            id="apellidosEditarMaestro"
                                                                                            name="apellidos"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->Apellidos }}"
                                                                                            required>


                                                                                    </div>
                                                                                    <div class="form-group col-md-4">
                                                                                        <label
                                                                                            for="correoEditarMaestro"><strong>Ingrese
                                                                                                Correo:</strong></label>
                                                                                        <input type="email"
                                                                                            id="correoEditarMaestro"
                                                                                            name="correo"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->Correo }}"
                                                                                            required>
                                                                                        <small id="emailHelp"
                                                                                            class="form-text text-danger"
                                                                                            style="display: none; c"></small>
                                                                                        @error('correo')
                                                                                            <small
                                                                                                class="form-text text-danger">{{ $message }}</small>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-4">
                                                                                        <label for="Usuario"><strong>Ingrese
                                                                                                el
                                                                                                Usuario:</strong></label>
                                                                                        <input type="text"
                                                                                            id="Usuario" name="Usuario"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->Usuario }}"
                                                                                            required>
                                                                                    </div>
                                                                                    <div class="form-group col-md-4">
                                                                                        <label
                                                                                            for="espeEditarMaestro"><strong>Ingrese
                                                                                                el ESPE
                                                                                                ID:</strong></label>
                                                                                        <input type="text"
                                                                                            id="espeEditarMaestro"
                                                                                            name="espe_id"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->espe_id }}"
                                                                                            required>
                                                                                        <small id="espeHelp"
                                                                                            class="form-text text-danger"
                                                                                            style="display: none;"></small>
                                                                                        @error('espe_id')
                                                                                            <small
                                                                                                class="form-text text-danger">{{ $message }}</small>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group col-md-4">
                                                                                        <label for="cedula"><strong>Ingrese
                                                                                                la
                                                                                                Cedula:</strong></label>
                                                                                        <input type="text"
                                                                                            id="cedulaEditarMaestro"
                                                                                            name="cedula"
                                                                                            class="form-control input"
                                                                                            value="{{ $profesor->Cedula }}"
                                                                                            required>
                                                                                        <small id="cedulaHelp"
                                                                                            class="form-text text-danger"
                                                                                            style="display: none;"></small>


                                                                                        @error('cedula')
                                                                                            <small
                                                                                                class="form-text text-danger">{{ $message }}</small>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-4">
                                                                                        <label for="departamento"><strong>Seleccione
                                                                                                el departamento al que
                                                                                                pertenece:</strong></label>
                                                                                        <select id="departamento"
                                                                                            name="departamento"
                                                                                            class="form-control input"
                                                                                            required>
                                                                                            <option
                                                                                                value="Ciencias de la Computación"
                                                                                                {{ $profesor->Departamento === 'Ciencias de la Computación' ? 'selected' : '' }}>
                                                                                                Departamento de Ciencias
                                                                                                de Computación</option>
                                                                                            <option
                                                                                                value="Ciencias de la Vida"
                                                                                                {{ $profesor->Departamento === 'Ciencias de la Vida' ? 'selected' : '' }}>
                                                                                                Departamento de Ciencias
                                                                                                de la Vida</option>
                                                                                            <option
                                                                                                value="Ciencias Exactas"
                                                                                                {{ $profesor->Departamento === 'Ciencias Exactas' ? 'selected' : '' }}>
                                                                                                Departamento de Ciencias
                                                                                                Exactas</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="button"
                                                                                        data-dismiss="modal">Cerrar</button>
                                                                                    <button type="submit"
                                                                                        class="button">Guardar
                                                                                        Cambios</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-------------------------------------------------------------------------------->
                                                        </div>
                                                        <form class="btn-group shadow-1"
                                                            action="{{ route('admin.eliminarMaestro', ['id' => $profesor->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id"
                                                                value="{{ $profesor->id }}">
                                                            <button type="submit"
                                                                class="button3 efects_button btn_eliminar3"><i
                                                                    class='bx bx-trash'></i></button>

                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="paginator-container">
                        <nav aria-label="...">

                            <ul class="pagination">
                                <li class="page-item mx-3">
                                    <form method="GET" action="{{ route('admin.index') }}">
                                        <select class="form-control page-item" class="input" name="perPage"
                                            id="perPage" onchange="this.form.submit()">
                                            <option value="3" @if ($perPage == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($perPage == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($perPage == 50) selected @endif>
                                                50
                                            </option>
                                            <option value="100" @if ($perPage == 100) selected @endif>
                                                100
                                            </option>
                                        </select>
                                    </form>
                                </li>

                                @if ($profesores->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Anterior</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $profesores->previousPageUrl() }}"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @foreach ($profesores->getUrlRange(1, $profesores->lastPage()) as $page => $url)
                                    @if ($page == $profesores->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($profesores->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $profesores->nextPageUrl() }}"
                                            aria-label="Siguiente">Siguiente</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Siguiente</span>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>



                </div>
            </div>

        </section>

        <section>

            <div class="container">

                <div id="registrarPeriodos" style="display: none;">
                    <div class="modal fade" id="modalAgregarPeriodo" tabindex="-1" role="dialog"
                        aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title" id="modalLabel">
                                        <p>Agregar Periodo</p>
                                    </span>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.guardarPeriodo') }}" method="post">
                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="periodoInicio"><strong>Ingrese el inicio del Periodo
                                                        Académico:</strong></label>
                                                <input type="date" id="periodoInicio" name="periodoInicio"
                                                    class="form-control input" value="{{ old('periodoInicio') }}"
                                                    required>
                                                @error('periodoInicio')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="periodoFin"><strong>Ingrese el fin del Periodo
                                                        Académico:</strong></label>
                                                <input type="date" id="periodoFin" name="periodoFin"
                                                    class="form-control input" value="{{ old('periodoFin') }}" required>
                                                @error('periodoFin')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="numeroPeriodo"><strong>Ingrese el número identificador del
                                                        periodo:</strong></label>
                                                <input type="text" id="numeroPeriodo" name="numeroPeriodo"
                                                    placeholder="Ingrese 6 números" class="form-control input"
                                                    pattern="[0-9]{1,6}"
                                                    title="Ingrese un número no negativo de hasta 6 dígitos"
                                                    value="{{ old('numeroPeriodo') }}" required>
                                                <small id="numeroPeriodoError" class="form-text text-danger"
                                                    style="display: none;"></small>

                                                @error('numeroPeriodo')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="button">Guardar Periodo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalAgregarNRC" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title" id="modalLabel">
                                    <p>Agregar NRC Vinculacion - Practicas preprofesionales</p>
                                </span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="FormularioNRC" action="{{ route('admin.nrcVinculacion') }}" method="post">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="label" for="nrc"><strong>Ingrese el NRC:</strong></label>
                                            <input type="text" id="nrc" name="nrc"
                                                class="form-control input" placeholder="Ingrese 5 números"
                                                value="{{ old('nrc') }}" required>
                                            <small id="nrcError" class="form-text text-danger"
                                                style="display: none;"></small>
                                            @error('nrc')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="periodo"><strong>Seleccione el período:</strong></label>
                                            <select id="periodo" name="periodo" class="form-control input_select input"
                                                required>
                                                <option value="">Seleccione un período</option>
                                                @foreach ($periodos as $periodo)
                                                    <option value="{{ $periodo->id }}"
                                                        {{ old('periodo') == $periodo->id ? 'selected' : '' }}>
                                                        {{ $periodo->numeroPeriodo }} - {{ $periodo->Periodo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('periodo')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="button">Guardar NRC</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ----------------------------------------------------------------------------------- -->
                </button>
                <!-- EDITAR PERIODO -->
                <div class="modal fade" id="editarPeriodoModal" tabindex="-1" role="dialog"
                    aria-labelledby="editarPeriodoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarPeriodoModalLabel">Editar Periodo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-md-12">
                                    <label for="periodo"><strong>Periodos Agregados (Seleccione el periodo a
                                            editar):</strong></label>
                                    <select id="selectPeriodo" class="form-control input input_select ">
                                        <option value="" data-inicio="" data-fin="" data-numero="">Seleccionar
                                            Periodo</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}"
                                                data-inicio="{{ $periodo->PeriodoInicio }}"
                                                data-fin="{{ $periodo->PeriodoFin }}"
                                                data-numero="{{ $periodo->numeroPeriodo }}">
                                                {{ $periodo->numeroPeriodo }} {{ $periodo->Periodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12" hidden>
                                    <div class="form-group col-md-6">
                                        <form id="editarPeriodoForm" method="GET">
                                            @csrf
                                            <button type="submit" class="button">Editar</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12" id="desplegarEditarPeriodo">
                                    <form class="formulario" method="POST"
                                        action="{{ route('admin.actualizarPeriodo', ['id' => $periodo->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="periodoInicio">Fecha de Inicio:</label>
                                            <input type="date" name="periodoInicio" class="form-control input"
                                                value="{{ $periodo->PeriodoInicio }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="periodoFin">Fecha de Fin:</label>
                                            <input type="date" name="periodoFin" class="form-control input"
                                                value="{{ $periodo->PeriodoFin }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numeroPeriodo">Ingrese el numero identificador del periodo:</label>
                                            <input type="text" name="numeroPeriodo" id="numeroPeriodo"
                                                class="form-control input" value="{{ $periodo->numeroPeriodo }}"
                                                required>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="button">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var delayTimer;
        $('#formBusquedaDocentes input[name="search"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.index') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#tablaDocentes').html($(response).find('#tablaDocentes').html());
                    }
                });
            }, 500);
        });
    </script>






    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="js\admin\index.js"></script>

@endsection
