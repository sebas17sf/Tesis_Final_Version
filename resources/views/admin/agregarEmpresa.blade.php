@extends('layouts.admin')
@section('title_component', 'Agregar Empresa')
@section('content')
    {{--    <div class="container"> --}}

    <section class="contenedor_agregar_periodo">

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
        <section>
            <h6><b>Agregar nueva empresa</b></h6>

            <div class="container">
                <form action="{{ route('admin.guardarEmpresa') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nombreEmpresa">Nombre de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreEmpresa" name="nombreEmpresa"
                                    placeholder="Ingrese el Nombre de la Empresa" required pattern="[A-Za-zÁ-úñÑ\s]+"
                                    title="Ingrese solo letras (sin caracteres numéricos)">
                                <span id="error-message-nombre" style="color: red; display: none;">Debe ingresar solo
                                    caracteres</span>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rucEmpresa">RUC de la Empresa:</label>
                                <input type="text" class="form-control input" id="rucEmpresa" name="rucEmpresa"
                                    placeholder="Ingrese RUC (13 dígitos)" required pattern="[0-9]{13}"
                                    title="Ingrese 13 dígitos numéricos">
                                <span id="error-message-ruc" style="color: red; display: none;">RUC no válido</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia">Provincia:</label>
                                <select class="form-control input input-select" id="provincia" name="provincia" required>
                                    <option value="" disabled selected>Selecciona una provincia</option>
                                    <option value="" disabled selected>Selecciona una provincia</option>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input class="form-control input" id="ciudad" name="ciudad"
                                    placeholder="Ingrese la Ciudad" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input class="form-control input" id="direccion" name="direccion"
                                    placeholder="Ingrese la Direccion" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo">Correo de contacto de la Empresa:</label>
                                <input type="email" class="form-control input" id="correo" name="correo"
                                    placeholder="Ingrese el Correo de la Empresa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreContacto">Nombre del contacto de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreContacto" name="nombreContacto"
                                    placeholder="Ingrese el Nombre del contacto de la Empresa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefonoContacto">Teléfono del contacto de la Empresa:</label>
                                <input type="text" class="form-control input" id="telefonoContacto"
                                    name="telefonoContacto" placeholder="Ingrese el celular de la Empresa (10 dígitos)"
                                    required pattern="09[0-9]{8}" title="Ingrese 10 dígitos numéricos">
                                <span id="error-message-telefono" style="color: red; display: none;">Número de teléfono no
                                    válido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="actividadesMacro">Actividades Macro requeridas:</label>
                                <textarea class="form-control input" id="actividadesMacro" name="actividadesMacro" rows="4"
                                    placeholder="Ingrese las actividades macro requeridas" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cuposDisponibles">Cupos Disponibles:</label>
                                <input type="text" class="form-control input" id="cuposDisponibles"
                                    name="cuposDisponibles" placeholder="Ingrese los cupos disponibles para la Empresa"
                                    required pattern="[0-9]*" title="Solo se permiten números">
                            </div>
                        </div>
                        <div class="col-md-6">

                            {{--  <div>
                                <label for="input_file">Archivo del período <span class="requerido">*</span></label>
                                <div class="input input_file">
                                  <span id="fileText"><i class="fa-solid fa-arrow-up-from-bracket"></i> {{fileText}}</span>
                                  <span class="remove-icon"
                                    title="Eliminar archivo">✖</span>
                                </div>
                                <input style="display: none;" formControlName="filePeriodo"  id="input_file" type="file"
                                 >

                                <div class="contenedor_campo_requerido">

                                  <div>
                                    El archivo del período es requerido.
                                  </div>

                                </div>

                              </div> --}}

                            <div class="form-group">
                                <label for="cartaCompromiso">Carta Compromiso (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i
                                            class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el
                                        documento</span>
                                    <input type="file" class="form-control-file input input_file" id="cartaCompromiso"
                                        name="cartaCompromiso" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)"
                                        class="remove-icon">✖</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="convenio">Convenio (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i
                                            class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí
                                        para
                                        subirel documento</span>
                                    <input type="file" class="form-control-file input input_file" id="convenio"
                                        name="convenio" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)"
                                        class="remove-icon">✖</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="button1 efects_button">Guardar Empresa</button>
                            </div>

                        </div>

                </form>
            </div>
        </section>
        <br>
        <h6><b>Listado de Empresas Agregadas</b></h6>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                @if ($empresas->isEmpty())
                    <p>No hay empresas agregadas.</p>
                @else
                    <div class="contenedor_acciones_tabla">
                        {{--   <form action="{{ route('coordinador.reportesVinculacion') }}" method="post">
                        @csrf
                        <button type="submit" class="button3 efects_button btn_excel">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form> --}}
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form action="{{ route('coordinador.reportesEmpresas') }}" method="post">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </form>
                        </div>

                        {{-- <form action="{{ route('admin.estudiantes') }}" method="GET">
                            @csrf
                            <div class="form-group d-flex align-items-center">
                                <input type="text" name="buscarEstudiantes" id="buscarEstudiantes"
                                    class="form-control input"
                                    placeholder="Buscar estudiantes de vinculación a la sociedad">

                            </div>
                        </form> --}}
                    </div>


                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaDocentes">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>Nombre de la Empresa</th>
                                            <th>RUC de la Empresa</th>
                                            <th>Provincia</th>
                                            <th>Ciudad</th>
                                            <th>Dirección</th>
                                            <th>Correo de Contacto</th>
                                            <th>Nombre del Contacto</th>
                                            <th>Teléfono del Contacto</th>
                                            <th>Actividades Macro</th>
                                            <th>Cupos Disponibles</th>
                                            <th>Descargar Carta</th>
                                            <th>Descargar Convenio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">

                                        @foreach ($empresas as $empresa)
                                            <tr>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->nombreEmpresa)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->rucEmpresa)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->provincia)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->ciudad)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->direccion)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->correo)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->nombreContacto)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->telefonoContacto)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->actividadesMacro)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->cuposDisponibles)) }}
                                                </td>
                                                <td>
                                                    @if ($empresa->cartaCompromiso)
                                                        <a
                                                            href="{{ route('admin.descargar', ['tipo' => 'carta', 'id' => $empresa->id]) }}">
                                                            <i class="material-icons">cloud_download</i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">No disponible</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($empresa->convenio)
                                                        <a
                                                            href="{{ route('admin.descargar', ['tipo' => 'convenio', 'id' => $empresa->id]) }}">
                                                            <i class="material-icons">cloud_download</i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">No disponible</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <form
                                                            action="{{ route('admin.eliminarEmpresa', ['id' => $empresa->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="material-icons text-muted"
                                                                    style="font-size: 1.5em;">delete</i>
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('admin.editarEmpresa', ['id' => $empresa->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('GET')
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="material-icons text-muted"
                                                                    style="font-size: 1.5em;">edit</i>
                                                            </button>
                                                        </form>
                                                    </div>


                                                </td>





                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="paginator-container">
                            <nav aria-label="...">

                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.agregarEmpresa') }}">

                                            <select name="elementosPorPagina"
                                                class="form-control page-item"id="elementosPorPagina"
                                                onchange="this.form.submit()">
                                                <option value="10" @if (request('elementosPorPagina', $elementosPorPagina) == 10) selected @endif>10
                                                </option>
                                                <option value="20" @if (request('elementosPorPagina', $elementosPorPagina) == 20) selected @endif>20
                                                </option>
                                                <option value="50" @if (request('elementosPorPagina', $elementosPorPagina) == 50) selected @endif>50
                                                </option>
                                                <option value="100" @if (request('elementosPorPagina', $elementosPorPagina) == 100) selected @endif>
                                                    100
                                                </option>
                                            </select>

                                        </form>
                                    </li>

                                    @if ($empresas->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $empresas->previousPageUrl() }}"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @foreach ($empresas->getUrlRange(1, $empresas->lastPage()) as $page => $url)
                                        @if ($page == $empresas->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($empresas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $empresas->nextPageUrl() }}"
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
                @endif
            </div>
        </section>

    </section>








    {{--  </div> --}}


@endsection




{{-- <style>
    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    table,
    th,
    td {
        font-size: 0.8rem;
    }


    th,
    td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
 --}}
