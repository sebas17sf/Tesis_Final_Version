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

        <button id="toggleFormBtn" class="btn btn-outline-secondary btn-block">Agregar Maestros</button>
        <div id="registrarMaestros" style="display: none;">
            <hr>
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
                            placeholder="Ingrese el Correo Electronico" required>
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
                        <label for="departamento"><strong>Seleccione el departamento al que pertenece:</strong></label>
                        <select id="departamento" name="departamento" class="form-control input_select input" required>
                            <option value="Ciencias de la Computación">Departamento de Ciencias de Computación</option>
                            <option value="Ciencias de la Vida">Departamento de Ciencias de la Vida</option>
                            <option value="Ciencias Exactas">Departamento de Ciencias Exactas</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-block">Guardar Docente</button>
            </form>
        </div>

        <hr>
        <h4>Docentes agregados</h4>
        <div class="d-flex">
            <form method="GET" action="{{ route('admin.index') }}">
                <label for="perPage">Docentes a visualizar:</label>
                <select class="input" name="perPage" id="perPage" onchange="this.form.submit()">
                    <option value="10" @if ($perPage == 10) selected @endif>10</option>
                    <option value="20" @if ($perPage == 20) selected @endif>20</option>
                    <option value="50" @if ($perPage == 50) selected @endif>50</option>
                    <option value="100" @if ($perPage == 100) selected @endif>100</option>
                </select>
            </form>

            <div class="mb-3">
                <form id="formBusquedaDocentes" class="d-flex">
                    <input type="text" name="search" value="{{ $search }}" class="input"
                        placeholder="Buscar proyectos...">
                </form>
            </div>



        </div>

        <div id="tablaDocentes">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Cédula</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($profesores->isEmpty())
                        <tr>
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
                                <td>
                                    <form action="{{ route('admin.eliminarMaestro', ['id' => $profesor->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button8"> <i
                                                class="material-icons">delete</i></button>
                                    </form>

                                    <form action="{{ route('admin.editarDocente', ['id' => $profesor->id]) }}"
                                        method="GET">
                                        @csrf
                                        <button type="submit" class="button3"> <i class="material-icons">edit</i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>




        <div class="d-flex justify-content-center paginator-container">
            <ul class="pagination">
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
        </div>


        <form action="{{ route('admin.reportesDocentes') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-secondary">
                <i class="fas fa-file-excel"></i> Reporte Docentes
            </button>
        </form>




        <button id="toggleFormBtn2" class="btn btn-outline-secondary btn-block">Agregar Cohoerte/Periodo/NRC
        </button>
        <div id="registrarPeriodos" style="display: none;">

            <!-- Formulario para agregar cohorte -->
            <form action="{{ route('admin.guardarCohorte') }}" method="post">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cohorte"><strong>Ingrese la Cohorte:</strong></label>
                            <input type="text" id="cohorte" name="cohorte" class="form-control input"
                                placeholder="Ingrese 6 números" pattern="\d{6}"
                                title="Debe ingresar exactamente 6 números" required>
                            <small id="errorCohorte" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="button">Guardar Cohorte</button>
                    </div>
                </div>
            </form>

            <!-- Formulario para agregar período académico -->
            <form action="{{ route('admin.guardarPeriodo') }}" method="post">
                @csrf
                <div class="row align-items-center">
                    <div class=" col-md-3">
                        <div class="form-group">
                            <label for="periodoInicio"><strong>Ingrese el inicio del Periodo Académico:</strong></label>
                            <input type="date" id="periodoInicio" name="periodoInicio" class="form-control input"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="periodoFin"><strong>Ingrese el fin del Periodo Académico:</strong></label>
                            <input type="date" id="periodoFin" name="periodoFin" class="form-control input" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="numeroPeriodo"><strong>Ingrese el numero identificador del periodo</strong></label>
                            <input type="text" id="numeroPeriodo" name="numeroPeriodo"
                                placeholder="Ingrese 6 números" class="form-control input" pattern="[0-9]{1,6}"
                                title="Ingrese un número no negativo de hasta 6 dígitos" required>
                            <small id="errorNumeroPeriodo" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="button">Guardar Periodo Académico</button>
                    </div>
                </div>
            </form>

            <!-- Formulario para agregar NRC Vinculacion -->
            <h4>NRC Vinculacion</h4>
            <form action="{{ route('admin.nrcVinculacion') }}" method="post">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nrc"><strong>Ingrese el NRC:</strong></label>
                            <input type="text" id="nrc" name="nrc" class="form-control input"
                                placeholder="Ingrese 5 números" pattern="\d{5}"
                                title="Debe ingresar exactamente 5 números" required>
                            <small id="errorNRC" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="periodo"><strong>Seleccione el período:</strong></label>
                            <select id="periodo" name="periodo" class="form-select me-2 input input_select " required>
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
                <button type="submit" class="button">Guardar NRC</button>
            </form>



            <!-- Elementos agregados (Periodos y Cohortes) -->
            <div class="row">
                <div class="col-md-6">
                    <h4>Periodos Agregados</h4>
                    <div class="d-flex align-items-center">
                        <select id="selectPeriodo" class="form-select me-2 input input_select ">
                            <option value="">Seleccionar Periodo</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }}
                                    {{ $periodo->Periodo }}
                                </option>
                            @endforeach
                        </select>

                        @if (!empty($periodo))
                            <form action="{{ route('admin.editarPeriodo', ['id' => $periodo->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="button">Editar</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Cohortes Agregadas</h4>
                    <div class="d-flex align-items-center">
                        <select id="selectCohorte" class="form-select me-2 input input_select ">
                            <option value="">Seleccionar Cohorte</option>
                            @foreach ($cohortes as $cohorte)
                                <option value="{{ $cohorte->ID_cohorte }}">{{ $cohorte->Cohorte }}</option>
                            @endforeach
                        </select>

                        @if (!empty($cohorte))
                            <form action="{{ route('admin.editarCohorte', ['id' => $cohorte->ID_cohorte]) }}"
                                method="GET">
                                @csrf
                                <button type="submit" class="button">Editar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

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

@endsection
