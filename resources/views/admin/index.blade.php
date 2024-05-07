@extends('layouts.admin')

@section('title', 'Panel de Administrador')

@section('title_component', 'Panel de Administrador')

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
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif


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
    <section class="contenedor_agregar_periodo">
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                @if ($profesoresPendientes->isEmpty())
                    <p>No hay Docentes pendientes.</p>
                @else
                    <!-- Tabla -->
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">
                            <table mat-table [dataSource]="dataSource" class="mat-elevation-z8">
                                <thead>
                                    <tr>
                                        <th mat-header-cell *matHeaderCellDef>ID</th>
                                        <th mat-header-cell *matHeaderCellDef>Nombre</th>
                                        <th mat-header-cell *matHeaderCellDef>Apellido</th>
                                        <th mat-header-cell *matHeaderCellDef>Correo Electrónico</th>
                                        <th mat-header-cell *matHeaderCellDef>Estado Actual</th>
                                        <th mat-header-cell *matHeaderCellDef>Actualizar Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profesoresPendientes as $profesor)
                                        <tr>
                                            <td>{{ $profesor->UserID }}</td>
                                            <td>{{ strtoupper($profesor->Nombre) }}</td>
                                            <td>{{ strtoupper($profesor->Apellido) }}</td>
                                            <td>{{ $profesor->CorreoElectronico }}</td>
                                            <td>{{ $profesor->Estado }}</td>
                                            <td>
                                                <form action="{{ route('admin.updateEstado', ['id' => $profesor->UserID]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="nuevoEstado">
                                                        <option value="Vinculacion">Vinculación</option>
                                                        <option value="Director-Departamento">Director-Departamento</option>
                                                        <option value="Negado">Negado</option>
                                                    </select>
                                                    <button type="submit">Actualizar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if ($profesoresConPermisos->isEmpty())
                    <p>No hay Docentes con permisos concedidos.</p>
                @else
                    <h4>Permisos Concedidos</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo Electrónico</th>
                                <th>Estado Actual</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profesoresConPermisos as $profesor)
                                <tr>
                                    <td>{{ $profesor->UserID }}</td>
                                    <td>{{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Nombre)) }}
                                    </td>
                                    <td>{{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Apellido)) }}
                                    </td>
                                    <td>{{ $profesor->CorreoElectronico }}</td>
                                    <td>{{ $profesor->Estado }}</td>
                                    <td>
                                        <form action="{{ route('admin.deletePermission', ['id' => $profesor->UserID]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"> <i class="material-icons">clear</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif

                @if (session('permisosConcedidos'))
                    <div class="alert alert-success">
                        {{ session('permisosConcedidos') }}
                    </div>
                @endif

            </div>
        </section>
        <br>
        <form action="{{ route('admin.respaldo') }}" method="POST">
            @csrf
            <button type="submit" class="button">Respaldar Base de Datos</button>
        </form>
        <br>
        <section>
            <!-- Archivos de notas -->
            <div class="contenedor_registro_genero ">
                <div>
                    <span><b>Docentes agregados</b></span>
                    <button type="button" class="button" data-toggle="modal" data-target="#modalAgregarMaestro">
                        <i class=""> Agregar Docentes</i>
                    </button>
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
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="apellidos"><strong>Ingrese Apellidos:</strong></label>
                                            <input type="text" id="apellidos" name="apellidos" class="form-control input"
                                                placeholder="Ingrese los dos Apellidos" required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="correo"><strong>Ingrese Correo:</strong></label>
                                            <input type="email" id="correo" name="correo" class="form-control input"
                                                placeholder="Ingrese el Correo Electrónico" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="cedula"><strong>Ingrese la Cédula:</strong></label>
                                            <input type="text" id="cedula" name="cedula" class="form-control input"
                                                placeholder="Ingrese Cédula (10 dígitos)" pattern="\d{10}"
                                                title="Debe ingresar exactamente 10 números" required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="espe_id"><strong>Ingrese el la ID de la ESPE:</strong></label>
                                            <input type="text" id="espe_id" name="espe_id" class="form-control input"
                                                placeholder="Ingrese la ID de la ESPE" required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="departamento"><strong>Seleccione el departamento al que
                                                    pertenece:</strong></label>
                                            <select id="departamento" name="departamento"
                                                class="form-control input_select input" required>
                                                <option value="Ciencias de la Computación">Departamento de Ciencias de
                                                    Computación</option>
                                                <option value="Ciencias de la Vida">Departamento de Ciencias de la Vida
                                                </option>
                                                <option value="Ciencias Exactas">Departamento de Ciencias Exactas</option>
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


                            <form action="{{ route('admin.reportesDocentes') }}" method="POST">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" pTooltip="Excel"
                                    tooltipPosition="top">
                                    <i class="fa-solid fa-file-excel"></i>
                                </button>
                            </form>

                            <button class="button3 efects_button btn_copy" pTooltip="Copiar" tooltipPosition="top"><i
                                    class="fa-solid fa-copy"></i></button>

                            {{-- //DESCOMENTAR PARA ACTIVAR LOS OTROS BOTONES
                <button class="button3 efects_button btn_filtro" pTooltip="Filtros" tooltipPosition="top"><i
                        class="fa-solid fa-filter-list"></i></button>

               
                <button class="button3 efects_button btn_delete_filter" pTooltip="Eliminar filtros" tooltipPosition="top"><i
                        class="fa-sharp fa-solid fa-filter-circle-xmark"></i></button> --}}

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

                            <div id="tablaDocentes">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Usuario</th>
                                            <th>Cédula</th>
                                            <th>Departamento</th>
                                            <th>ID ESPE</th>
                                            <th>Acciones</th>
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
                                                    <td>{{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Apellidos)) }}
                                                        {{ strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'N'], $profesor->Nombres)) }}
                                                    </td>
                                                    <td>{{ $profesor->Correo }}</td>
                                                    <td>{{ $profesor->Usuario }}</td>
                                                    <td>{{ $profesor->Cedula }}</td>
                                                    <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $profesor->Departamento)) }}
                                                    </td>
                                                    <td>{{ $profesor->espe_id }}</td>
                                                    <td>
                                                        <div class="contenedor_botones">
                                                            <div class="btn-group  shadow-0">




                                                                <button type="button"
                                                                    class="button3 efects_button btn_editar3"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEditarMaestro{{ $profesor->id }}">
                                                                    <i class="bx bx-edit-alt"></i>
                                                                </button>



                                                                <!---Modal para editar Docentes--------------------------------------------------->

                                                                <div class="modal fade"
                                                                    id="modalEditarMaestro{{ $profesor->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="modalEditarMaestroLabel{{ $profesor->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <!-- Añade la clase modal-lg para un modal grande -->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <span class="modal-title"
                                                                                    id="modalEditarMaestroLabel{{ $profesor->id }}">
                                                                                    <b>Editar Docentes</b></span>

                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('admin.actualizarMaestro', ['id' => $profesor->id]) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    <div class="form-row">
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="nombres"><strong>Ingrese
                                                                                                    Nombres:</strong></label>
                                                                                            <input type="text"
                                                                                                id="nombres"
                                                                                                name="nombres"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->Nombres }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="apellidos"><strong>Ingrese
                                                                                                    Apellidos:</strong></label>
                                                                                            <input type="text"
                                                                                                id="apellidos"
                                                                                                name="apellidos"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->Apellidos }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="correo"><strong>Ingrese
                                                                                                    Correo:</strong></label>
                                                                                            <input type="email"
                                                                                                id="correo"
                                                                                                name="correo"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->Correo }}"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-row">
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="Usuario"><strong>Ingrese
                                                                                                    el
                                                                                                    Usuario:</strong></label>
                                                                                            <input type="text"
                                                                                                id="Usuario"
                                                                                                name="Usuario"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->Usuario }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="espe_id"><strong>Ingrese
                                                                                                    el ESPE
                                                                                                    ID:</strong></label>
                                                                                            <input type="text"
                                                                                                id="espe_id"
                                                                                                name="espe_id"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->espe_id }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="cedula"><strong>Ingrese
                                                                                                    la
                                                                                                    Cedula:</strong></label>
                                                                                            <input type="text"
                                                                                                id="cedula"
                                                                                                name="cedula"
                                                                                                class="form-control input"
                                                                                                value="{{ $profesor->Cedula }}"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-row">
                                                                                        <div class="form-group col-md-4">
                                                                                            <label
                                                                                                for="departamento"><strong>Seleccione
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
                                                                                        <button type="button"
                                                                                            class="button"
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
                                                            <div class="btn-group shadow-1" <form
                                                                action="{{ route('admin.eliminarMaestro', ['id' => $profesor->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="button3 efects_button btn_eliminar3"><i
                                                                        class='bx bx-trash'></i></button>
                                                                </form>
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

                        <div class="paginator-container">
                            <nav aria-label="...">

                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.index') }}">
                                            <select class="form-control page-item" class="input" name="perPage"
                                                id="perPage" onchange="this.form.submit()">
                                                <option value="10" @if ($perPage == 10) selected @endif>10
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

        </section>


        <br>

        <section>

            <div class="container">
                <button id="toggleFormBtn2" class="btn btn-outline-secondary btn-block">Agregar Cohoerte/Periodo/NRC
                </button>
                <hr>
                <div id="registrarPeriodos" style="display: none;">
                    <form action="{{ route('admin.guardarPeriodo') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">

                                <div class="form-group">
                                    <label for="periodoInicio"><strong>Ingrese el inicio del Periodo
                                            Académico:</strong></label>
                                    <input type="date" id="periodoInicio" name="periodoInicio"
                                        class="form-control input" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="periodoFin"><strong>Ingrese el fin del Periodo Académico:</strong></label>
                                    <input type="date" id="periodoFin" name="periodoFin" class="form-control input"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="numeroPeriodo"><strong>Ingrese el numero identificador del
                                            periodo</strong></label>
                                    <input type="text" id="numeroPeriodo" name="numeroPeriodo"
                                        placeholder="Ingrese 6 números" class="form-control input" pattern="[0-9]{1,6}"
                                        title="Ingrese un número no negativo de hasta 6 dígitos" required>
                                    <small id="errorNumeroPeriodo" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="button efects_button">Guardar Periodo Académico</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <!-- Formulario para agregar NRC Vinculacion -->
                    <h6>NRC Vinculacion</h6>
                    <form class="FormularioNRC" action="{{ route('admin.nrcVinculacion') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">

                                <div class="form-group">
                                    <label for="nrc"><strong>Ingrese el NRC:</strong></label>
                                    <input type="text" id="nrc" name="nrc" class="form-control input"
                                        placeholder="Ingrese 5 números" required>
                                    <small id="errorNRC" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">

                                <div class="form-group">
                                    <label for="periodo"><strong>Seleccione el período:</strong></label>
                                    <select id="periodo" name="periodo" class="form-control input_select input"
                                        required>
                                        <option value="">Seleccione un período</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} -
                                                {{ $periodo->Periodo }}</option>
                                        @endforeach
                                    </select>
                                    <small id="errorPeriodo" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="button efects_button">Guardar NRC</button>
                            </div>
                        </div>

                    </form>
                    <br>
                    <!-- Formulario para agregar NRC Practicas 1 -->

                    <h6>NRC Practicas preprofesinales 1</h6>
                    <form class="FormularioNRCPracticas1" action="{{ route('admin.nrcPracticas1') }}" method="post">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nrc"><strong>Ingrese el NRC:</strong></label>
                                    <input type="text" id="nrc" name="nrc" class="form-control input"
                                        placeholder="Ingrese 5 números" required>
                                    <small id="errorNRC" class="form-text text-danger"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="periodo"><strong>Seleccione el período:</strong></label>
                                    <select id="periodo" name="periodo" class="form-control input_select input"
                                        required>
                                        <option value="">Seleccione un período</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} -
                                                {{ $periodo->Periodo }}</option>
                                        @endforeach
                                    </select>
                                    <small id="errorPeriodo" class="form-text text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button efects_button">Guardar NRC</button>
                    </form>
                    <br>
                    <!-- Elementos agregados (Periodos) -->
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periodo"><strong>Periodos Agregados:</strong></label>
                                <select id="selectPeriodo" class="form-control input_select input">
                                    <option value="">Seleccionar Periodo</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}" data-inicio="{{ $periodo->PeriodoInicio }}"
                                            data-fin="{{ $periodo->PeriodoFin }}"
                                            data-numero="{{ $periodo->numeroPeriodo }}">
                                            {{ $periodo->numeroPeriodo }} {{ $periodo->Periodo }}
                                        </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <form id="editarPeriodoForm" method="GET">
                                    @csrf
                                    <button type="submit" class="button">Editar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal para peridoo-------------------------------- -->

                <div class="modal" tabindex="-1" role="dialog" id="editModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Periodo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="formulario" method="POST"
                                    action="{{ route('admin.actualizarPeriodo', ['id' => $periodo->id]) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group col-md-4">
                                        <label for="periodoInicio">Fecha de Inicio:</label>
                                        <input type="date" name="periodoInicio" class="form-control input"
                                            value="{{ $periodo->PeriodoInicio }}" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="periodoFin">Fecha de Fin:</label>
                                        <input type="date" name="periodoFin" class="form-control input"
                                            value="{{ $periodo->PeriodoFin }}" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="numeroPeriodo">Ingrese el numero identificador del periodo:</label>
                                        <input type="text" name="numeroPeriodo" id="numeroPeriodo"
                                            class="form-control input" value="{{ $periodo->numeroPeriodo }}" required>
                                        <small id="numeroPeriodoError" class="form-text text-danger"></small>
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

                <!---------------------------------- -->


            </div>
        </section>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $("#toggleFormBtn8").click(function() {
                $("#registrarMaestros").toggle();
                if ($("#registrarMaestros").is(":visible")) {
                    $(this).text("Ocultar Registro de Maestros");
                } else {
                    $(this).text("Registrar Maestros");
                }
            });


        });
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

        $(document).ready(function() {
            $('#editarPeriodoForm').submit(function(event) {
                event.preventDefault();

                var periodoId = $('#selectPeriodo').val();

                var inicio = $('#selectPeriodo option:selected').data('inicio');
                var fin = $('#selectPeriodo option:selected').data('fin');
                var numero = $('#selectPeriodo option:selected').data('numero');

                $('#editModal').find('form').attr('action', '/admin/actualizar-periodo/' + periodoId);
                $('#editModal').find('input[name="periodoInicio"]').val(inicio);
                $('#editModal').find('input[name="periodoFin"]').val(fin);
                $('#editModal').find('input[name="numeroPeriodo"]').val(numero);

                $('#editModal').modal('show');
            });
        });
    </script>






@endsection
