@extends('layouts.admin')

@section('title', 'Panel de Administrador')

@section('title_component', 'Panel de Administrador')

@section('content')
<style>
    .contenedor_alerta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #dff0d8;
        border: 1px solid #d6e9c6;
        color: #3c763d;
        padding: 15px;
        margin: 15px;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .contenedor_alerta .icon_alert {
        margin-right: 10px;
        font-size: 24px;
    }

    .contenedor_alerta .content_alert {
        flex: 1;
    }

    .contenedor_alerta .title {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .contenedor_alerta .icon_remove button {
        background: none;
        border: none;
        color: #3c763d;
        font-size: 24px;
        cursor: pointer;
    }

    .contenedor_alerta .icon_remove button:hover {
        color: #2b542c;
    }

    .contenedor_alerta .body {
        word-wrap: break-word;
    }
</style>


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
                                                <td class="table1">{{ strtoupper($profesor->nombreUsuario) }}</td>
                                                <td class="table1">{{ strtoupper($profesor->nombreUsuario) }}</td>
                                                <td class="table1">{{ $profesor->correoElectronico }}</td>
                                                <td class="table1">{{ $profesor->estado }}</td>
                                                <td>
    <!-- Botón de Editar -->
    <center>
        <button type="button" class="button3 efects_button btn_editar3" onclick="openCard('editCard{{ $profesor->id }}');">
            <i class="bx bx-edit-alt"></i>
        </button>
    </center>
</td>

<!-- Card para Editar Profesor -->
<div class="draggable-card" id="editCard{{ $profesor->id }}" style="display: none;">
    <div class="card-header">
        <span class="card-title">Editar Profesor</span>
        <button type="button" class="close" onclick="document.getElementById('editCard{{ $profesor->id }}').style.display='none'">&times;</button>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.updateEstado', ['id' => $profesor->userid]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="NombreUsuario{{ $profesor->id }}"><b>Nombre de Usuario</b></label>
                <input type="text" class="form-control input" id="NombreUsuario{{ $profesor->id }}" name="NombreUsuario" value="{{ $profesor->nombreUsuario }}" required disabled>
            </div>
            <div class="form-group">
                <label for="CorreoElectronico{{ $profesor->id }}"><b>Correo Electrónico</b></label>
                <input type="email" class="form-control input" id="CorreoElectronico{{ $profesor->id }}" name="CorreoElectronico" value="{{ $profesor->correoElectronico }}" required disabled>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Estado{{ $profesor->id }}"><b>Estado</b></label>
                        <select class="form-control input input_select" id="Estado{{ $profesor->id }}" name="Estado" required>
                            <option value="activo" {{ $profesor->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $profesor->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password{{ $profesor->id }}"><b>Cambiar Contraseña</b></label>
                        <input type="password" class="form-control input" id="password{{ $profesor->id }}" name="password" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="button0" onclick="document.getElementById('editCard{{ $profesor->id }}').style.display='none'">Cerrar</button>
                <button type="submit" class="button0">Guardar Cambios</button>
            </div>
        </form>
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

            <button type="button" class="button1 mr-2" onclick="openCard('draggableCardNRC');">Agregar NRC</button>
            <button type="button" class="button1 mr-2" onclick="openCard('draggableCardPeriodo');">Agregar Periodo</button>
            <button type="button" class="button1 mr-2" onclick="openCard('draggableCardEditarPeriodo');">Editar
                Periodo</button>

        </div>
        <br>
        <section>
            <!-- Archivos de notas -->

            <div>
                <span><b>Docentes agregados</b></span>

                <hr>

            </div>

<!-- Tarjeta movible para Agregar Maestro -->
<div class="draggable-card1_1" id="draggableCardAgregarMaestro">
    <div class="card-header">
        <span class="card-title">Agregar Docentes</span>
        <button type="button" class="close" onclick="document.getElementById('draggableCardAgregarMaestro').style.display='none'">&times;</button>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.guardarMaestro') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombres"><strong>Ingrese Nombres:</strong></label>
                    <input type="text" id="nombres" name="nombres" class="form-control input" placeholder="Ingrese los dos Nombres" required>
                    <small id="nombresError" class="form-text text-danger" style="display: none;"></small>
                </div>
                <div class="form-group col-md-4">
                    <label for="apellidos"><strong>Ingrese Apellidos:</strong></label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control input" placeholder="Ingrese los dos Apellidos" required>
                    <small id="apellidosError" class="form-text text-danger" style="display: none;"></small>
                </div>
                <div class="form-group col-md-4">
                    <label for="correo"><strong>Ingrese Correo:</strong></label>
                    <input type="email" id="correo" name="correo" class="form-control input" placeholder="Ingrese el Correo Electrónico" required>
                    <small id="correoError" class="form-text text-danger" style="display: none;"></small>
                    @error('correo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cedula"><strong>Ingrese la Cédula:</strong></label>
                    <input type="text" id="cedula" name="cedula" class="form-control input" placeholder="Ingrese Cédula (10 dígitos)" pattern="\d{10}" title="Debe ingresar exactamente 10 números" required>
                    <small id="cedulaError" class="form-text text-danger" style="display: none;"></small>
                    @error('cedula')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="espe_id"><strong>Ingrese el la ID de la ESPE:</strong></label>
                    <input type="text" id="espe_id" name="espe_id" class="form-control input" placeholder="Ingrese la ID de la ESPE" required>
                    <small id="espeIdError" class="form-text text-danger" style="display: none;"></small>
                    @error('espe_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="departamento"><strong>Seleccione el departamento al que pertenece:</strong></label>
                    <select id="departamento" name="departamento" class="form-control input_select input" required>
                        <option value="Ciencias de la Computación">Ciencias de la Computación</option>
                        <option value="Ciencias de la Vida">Ciencias de la Vida</option>
                        <option value="Ciencias Exactas">Ciencias Exactas</option>
                    </select>
                </div>
            </div>
            <div class="card-footer1">
                <button type="button" class="button01" onclick="document.getElementById('draggableCardAgregarMaestro').style.display='none'">Cerrar</button>
                <button type="submit" class="button01">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

            <!--------------------------------------- -->

            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">

                        <div class="tooltip-container">
                            <span class="tooltip-text">Agregar</span>

                            <button type="button" class="button3 efects_button btn_primary" onclick="openCard('draggableCardAgregarMaestro');">
                            <i class="fa-solid fa-plus"></i></button>

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
                        <!--filtros
                        <div class="tooltip-container">
                            <span class="tooltip-text">Filtros</span>
                        <button class="button3 efects_button btn_filtro" pTooltip="Filtros" tooltipPosition="top"><i
                                        class="fa-solid fa-filter-list"></i></button>
                                        </div>


<div class="tooltip-container">
    <span class="tooltip-text">Eliminar Filtros</span>
    <button class="button3 efects_button btn_delete_filter" onclick="resetFilters()">
        <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
    </button>
</div>
-->
                    </div>

                    <!-- Buscador -->
                    <div class="contenedor_buscador">
                        <div>
                            <form id="formBusquedaDocentes">
                                <input type="text" class="input" name="search" value="{{ $search }}"
                                    matInput placeholder="Buscar docentes...">
                                <i class='bx bx-search-alt'></i>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
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
                                                <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left; padding: 5px 8px;">
                                                    {{ strtoupper
                                                        ($profesor->apellidos) }}
                                                    {{ strtoupper( $profesor->nombres ?? '' ) }}
                                                </td>
                                                <td>{{ $profesor->correo }}</td>
                                                <td class="center_size">{{ $profesor->usuario }}</td>
                                                <td class="center_size">{{ $profesor->cedula }}</td>
                                                <td class="medium_size" style=" text-transform: uppercase;">
                                                    {{ strtoupper( $profesor->departamento) }}
                                                </td>
                                                <td class="center_size">{{ $profesor->espeId }}</td>
                                                <td>
                                                    <div class="btn-group shadow-1">

                                                        <button type="button" class="button3 efects_button btn_editar3"
                                                            onclick="openCard('draggableCardEditarMaestro{{ $profesor->id }}');">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </button>

                                                        <div class="draggable-card1_1"
                                                            id="draggableCardEditarMaestro{{ $profesor->id }}">
                                                            <div class="card-header">
                                                                <span class="card-title1">Editar Docentes</span>
                                                                <button type="button" class="close"
                                                                    onclick="$('#draggableCardEditarMaestro{{ $profesor->id }}').hide()">&times;</button>
                                                            </div>
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.actualizarMaestro', ['id' => $profesor->id]) }}"
                                                                    method="POST" id="formularioEditarMaestro">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="nombresEditarMaestro"><strong>Ingrese
                                                                                    Nombres:</strong></label>
                                                                            <input type="text"
                                                                                id="nombresEditarMaestro" name="nombres"
                                                                                class="form-control input input_select1 form-text"
                                                                                value="{{ $profesor->nombres }}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="apellidosEditarMaestro"><strong>Ingrese
                                                                                    Apellidos:</strong></label>
                                                                            <input type="text"
                                                                                id="apellidosEditarMaestro"
                                                                                name="apellidos"
                                                                                class="form-control input input_select1"
                                                                                value="{{ $profesor->apellidos }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="correoEditarMaestro"><strong>Ingrese
                                                                                    Correo:</strong></label>
                                                                            <input type="email" id="correoEditarMaestro"
                                                                                name="correo"
                                                                                class="form-control input input_select1"
                                                                                value="{{ $profesor->correo }}" required>
                                                                            <small id="emailHelp"
                                                                                class="form-text text-danger"
                                                                                style="display: none;"></small>
                                                                            @error('correo')
                                                                                <small
                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="Usuario"><strong>Ingrese el
                                                                                    Usuario:</strong></label>
                                                                            <input type="text" id="Usuario"
                                                                                name="Usuario"
                                                                                class="form-control input input_select1"
                                                                                value="{{ $profesor->usuario }}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="espeEditarMaestro"><strong>Ingrese el
                                                                                    ESPE ID:</strong></label>
                                                                            <input type="text" id="espeEditarMaestro"
                                                                                name="espe_id"
                                                                                class="form-control input input_select1"
                                                                                value="{{ $profesor->espeId }}" required>
                                                                            <small id="espeHelp"
                                                                                class="form-text text-danger"
                                                                                style="display: none;"></small>
                                                                            @error('espe_id')
                                                                                <small
                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="label"
                                                                                for="cedulaEditarMaestro"><strong>Ingrese
                                                                                    la Cedula:</strong></label>
                                                                            <input type="text" id="cedulaEditarMaestro"
                                                                                name="cedula"
                                                                                class="form-control input input_select1"
                                                                                value="{{ $profesor->cedula }}" required>
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
                                                                            <label class="label"
                                                                                for="departamento"><strong>Seleccione el
                                                                                    departamento al que
                                                                                    pertenece:</strong></label>
                                                                            <select id="departamento" name="departamento"
                                                                                class="form-control input input_select1"
                                                                                required>
                                                                                <option value="Ciencias de la Computación"
                                                                                    {{ $profesor->departamento === 'Ciencias de la Computación' ? 'selected' : '' }}>
                                                                                    Departamento de Ciencias de Computación
                                                                                </option>
                                                                                <option value="Ciencias de la Vida"
                                                                                    {{ $profesor->departamento === 'Ciencias de la Vida' ? 'selected' : '' }}>
                                                                                    Departamento de Ciencias de la Vida
                                                                                </option>
                                                                                <option value="Ciencias Exactas"
                                                                                    {{ $profesor->departamento === 'Ciencias Exactas' ? 'selected' : '' }}>
                                                                                    Departamento de Ciencias Exactas
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer1 d-flex justify-content-center align-items-center"">

                                                                        <button type="submit"
                                                                            class="button input_select1">Guardar
                                                                            Cambios</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <!-------------------------------------------------------------------------------->
                                                    </div>
                                                    <form class="btn-group shadow-1" id="deleteForm"
                                                        action="{{ route('admin.eliminarMaestro', ['id' => $profesor->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <input type="hidden" name="id"
                                                            value="{{ $profesor->id }}">
                                                        <button type="submit" class="button3 efects_button btn_eliminar3"
                                                            onclick="confirmDelete(event)"><i
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
                                <form method="GET" action="{{ route('admin.index') }}#tablaDocentes">
                                    <select class="form-control page-item" name="perPage" id="perPage" onchange="this.form.submit()">
                                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                                        <option value="20" @if ($perPage == 20) selected @endif>20</option>
                                        <option value="50" @if ($perPage == 50) selected @endif>50</option>
                                        <option value="100" @if ($perPage == 100) selected @endif>100</option>
                                    </select>
                                </form>
                            </li>

                            @if ($profesores->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Anterior</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $profesores->appends(['perPage' => $perPage])->previousPageUrl() }}#tablaDocentes" aria-label="Anterior">Anterior</a>
                            </li>
                            @endif

                            @foreach ($profesores->getUrlRange(1, $profesores->lastPage()) as $page => $url)
                            @if ($page == $profesores->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $profesores->appends(['perPage' => $perPage])->url($page) }}#tablaDocentes">{{ $page }}</a>
                            </li>
                            @endif
                            @endforeach

                            @if ($profesores->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $profesores->appends(['perPage' => $perPage])->nextPageUrl() }}#tablaDocentes" aria-label="Siguiente">Siguiente</a>
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

                <!-- Tarjeta movible para Agregar NRC -->
                <div class="draggable-card" id="draggableCardNRC">
                    <div class="card-header">
                        <span class="card-title">Agregar NRC</span>
                        <button type="button" class="close" onclick="$('#draggableCardNRC').hide()">&times;</button>
                    </div>
                    <div class="card-body">
                        <form class="FormularioNRC" action="{{ route('admin.nrcVinculacion') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="label" for="nrc"><strong>Ingrese el NRC:</strong></label>
                                <input type="text" id="nrc" name="nrc" class="form-control input"
                                    placeholder="Ingrese 5 números" pattern="\d{5}"
                                    title="Ingrese exactamente 5 dígitos" value="{{ old('nrc') }}" required>
                                <small id="nrcError" class="form-text text-danger" style="display: none;"></small>
                                @error('nrc')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="periodo"><strong>Seleccione el período:</strong></label>
                                <select id="periodo" name="periodo" class="form-control input_select input"
                                    required>
                                    <option value="">Seleccione un período</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}"
                                            {{ old('periodo') == $periodo->id ? 'selected' : '' }}>
                                            {{ $periodo->numeroPeriodo }} - {{ $periodo->periodo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('periodo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tipo"><strong>Tipo de proceso:</strong></label>
                                <select id="tipo" name="tipo" class="form-control input_select input" required>
                                    <option value="">Seleccione el proceso</option>
                                    <option value="Vinculación">Vinculación con la Sociedad</option>
                                    <option value="Practicas">Practicas preprofesionales</option>
                                </select>
                                @error('tipo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="card-footer d-flex justify-content-center align-items-center">
                                <button type="submit" class="button01">Guardar NRC</button>
                            </div>
                        </form>
                    </div>
                </div>

                  <!-- Tarjeta movible para Agregar Periodo -->
                            <div class="draggable-card" id="draggableCardPeriodo">
                                <div class="card-header">
                                    <span class="card-title">Agregar Periodo</span>
                                    <button type="button" class="close"
                                        onclick="$('#draggableCardPeriodo').hide()">&times;</button>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.guardarPeriodo') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="periodoInicio"><strong>Ingrese el inicio del Periodo
                                                    Académico:</strong></label>
                                            <input type="date" id="periodoInicio" name="periodoInicio"
                                                class="form-control input" value="{{ old('periodoInicio') }}" required>
                                            @error('periodoInicio')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="periodoFin"><strong>Ingrese el fin del Periodo Académico:</strong></label>
                                            <input type="date" id="periodoFin" name="periodoFin" class="form-control input"
                                                value="{{ old('periodoFin') }}" required>
                                            @error('periodoFin')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="numeroPeriodo"><strong>Ingrese el número identificador del
                                                    periodo:</strong></label>
                                            <input type="text" id="numeroPeriodo" name="numeroPeriodo"
                                                placeholder="Ingrese 6 números" class="form-control input" pattern="[0-9]{1,6}"
                                                title="Ingrese un número no negativo de hasta 6 dígitos"
                                                value="{{ old('numeroPeriodo') }}" required>
                                            <small id="numeroPeriodoError" class="form-text text-danger"
                                                style="display: none;"></small>
                                            @error('numeroPeriodo')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="card-footer1 d-flex justify-content-center align-items-center">
                                            <button type="submit" class="button01">Guardar Periodo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                <!-- ----------------------------------------------------------------------------------- -->

                <!-- Tarjeta movible para Editar Periodo -->
                <div class="draggable-card" id="draggableCardEditarPeriodo">
                    <div class="card-header">
                        <span class="card-title">Editar Periodo</span>
                        <button type="button" class="close"
                            onclick="$('#draggableCardEditarPeriodo').hide()">&times;</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="periodo"><strong>Periodos Agregados (Seleccione el periodo a
                                    editar):</strong></label>
                            <select id="selectPeriodo" class="form-control input input_select ">
                                <option value="" data-inicio="" data-fin="" data-numero="">Seleccionar Periodo
                                </option>
                                @foreach ($periodos as $periodo)
                                    <option value="{{ $periodo->id }}" data-inicio="{{ $periodo->inicioPeriodo }}"
                                        data-fin="{{ $periodo->finPeriodo }}"
                                        data-numero="{{ $periodo->numeroPeriodo }}">
                                        {{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}
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
                                        value="{{ $periodo->inicioPeriodo }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="periodoFin">Fecha de Fin:</label>
                                    <input type="date" name="periodoFin" class="form-control input"
                                        value="{{ $periodo->finPeriodo }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="numeroPeriodo">Ingrese el numero identificador del periodo:</label>
                                    <input type="text" name="numeroPeriodo" id="numeroPeriodo"
                                        class="form-control input" value="{{ $periodo->numeroPeriodo }}" required>
                                </div>
                                <div class="card-footer d-flex justify-content-center align-items-center"">
                                    <center><button type="submit" class="button01">Guardar Cambios</button></center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


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
