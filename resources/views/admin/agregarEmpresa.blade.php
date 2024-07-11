@extends('layouts.admin')
@section('title', 'Panel Empresa')
@section('title_component', 'Panel Empresa')
@section('content')

    <section class="contenedor_agregar_periodo">



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
        <section>


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
                                <span id="error-message-rucEmpresa" style="color: red;"></span>
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
                                <input type="text" class="form-control input" id="nombreContacto"
                                    name="nombreContacto" placeholder="Ingrese el Nombre del contacto de la Empresa"
                                    required>
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

        <h4><b>Listado de Empresas Agregadas</b></h4>
        <hr>
        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">
                    <!-- Botones -->
                    <div class="tooltip-container">
                        <span class="tooltip-text">Excel</span>
                        <form action="{{ route('coordinador.reportesEmpresas') }}" method="post">
                            @csrf
                            <button type="submit" class="button3 efects_button btn_excel">
                                <i class="fas fa-file-excel"></i>
                            </button>
                        </form>
                    </div>


                    <!-- Botón de Importar archivo -->
                    <div class="tooltip-container">
                        <span class="tooltip-text">Importar archivo</span>
                        <button type="button" class="button3 efects_button btn_copy"
                            onclick="openCard('cardImportarArchivo');">
                            <i class="fa fa-upload"></i>
                        </button>
                    </div>

                    <!-- Card de Importar archivo -->
                    <div class="draggable-card1_4" id="cardImportarArchivo" style="display: none;">
                        <div class="card-header">
                            <span class="card-title">Importar archivo</span>
                            <button type="button" class="close" onclick="closeCard('cardImportarArchivo')"><i
                                    class="fa-thin fa-xmark"></i></button>
                        </div>
                        <div class="card-body">
                            <form id="idModalImportar" action="{{ route('import-empresas') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="input_file input">
                                        <span id="fileText2" class="fileText">
                                            <i class="fa fa-upload"></i> Haz clic aquí para subir el documento
                                        </span>
                                        <input type="file" class="form-control-file input input_file" id="file2"
                                            name="file" onchange="displayFileName(this, 'fileText2')" required>
                                        <span title="Eliminar archivo" onclick="removeFile(this)"
                                            class="remove-icon">✖</span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center align-items-center">
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="contenedor_buscador">
                    <div>
                        <form id="formBusquedaEmpresa">
                            <input type="text" class="input" name="search" value="{{ $search }}" matInput
                                placeholder="Buscar empresas...">
                            <i class='bx bx-search-alt'></i>
                        </form>
                    </div>
                </div>
            </div>



            <section>
                @if ($empresas->isEmpty())
                    <p>No hay empresas agregadas.</p>
                @else
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaEmpresas">
                                <table id="tablaEmpresas" class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">NOMBRE DE LA EMPRESA</th>
                                            <th>RUC DE LA EMPRESA</th>
                                            <th class="tamanio3">PROVINCIA</th>
                                            <th class="tamanio3">CIUDAD</th>
                                            <th class="tamanio5">DIRECCIÓN</th>
                                            <th>CORREO DEL CONTACTO</th>
                                            <th class="tamanio5">NOMBRE DEL CONTACTO</th>
                                            <th>TELÉFONO DEL CONTACTO</th>
                                            <th class="tamanio">ACTIVIDADES MACRO</th>
                                            <th>CUPOS DISPONIBLES</th>
                                            <th>DESCARGAR CARTA</th>
                                            <th>DESCARGAR CONVENIO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">

                                        @foreach ($empresas as $index => $empresa)
                                            <tr>
                                                <td>{{ $empresas ->firstItem() + $index }}</td>


                                                 <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->nombreEmpresa)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->rucEmpresa)) }}
                                                </td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->provincia)) }}
                                                </td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->ciudad)) }}
                                                </td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->direccion)) }}
                                                </td>
                                                <td>{{ $empresa->correo }}
                                                </td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->nombreContacto)) }}
                                                </td>
                                                <td>{{ strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['A', 'E', 'I', 'O', 'U', 'U', 'Ñ'], $empresa->telefonoContacto)) }}
                                                </td>
                                                <td style="text-transform: uppercase; text-align: justify;">
                                                    {{ strtoupper($empresa->actividadesMacro) }}
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
                                                        <span class="text-muted">NO DISPONIBLE</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($empresa->convenio)
                                                        <a
                                                            href="{{ route('admin.descargar', ['tipo' => 'convenio', 'id' => $empresa->id]) }}">
                                                            <i class="material-icons">cloud_download</i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">NO DISPONIBLE</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group shadow-1 " role="group">
                                                        <form
                                                            action="{{ route('admin.editarEmpresa', ['id' => $empresa->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('GET')
                                                            <button type="submit"
                                                                class="button3 efects_button btn_editar3"
                                                                style="margin-right: 10px;">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </button>
                                                        </form>
                                                        <form class="btn-group shadow-1"
                                                            action="{{ route('admin.eliminarEmpresa', ['id' => $empresa->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="button3 efects_button btn_eliminar3">
                                                                <i class='bx bx-trash'></i>
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
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Empresas: {{ $empresas->total() }}</div>


                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.agregarEmpresa') }}#tablaEmpresas">

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
                                            <a class="page-link" href="{{ $empresas->previousPageUrl() }}#tablaEmpresas"
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
                                                <a class="page-link"
                                                    href="{{ $url }}#tablaEmpresas">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($empresas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $empresas->nextPageUrl() }}#tablaEmpresas"
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



    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>>
    <script>
        var delayTimer;
        $('#formBusquedaEmpresa input[name="search"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.agregarEmpresa') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#tablaEmpresas').html($(response).find('#tablaEmpresas').html());
                    }
                });
            }, 500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const nrcSelect = document.getElementById('nrc');
            const periodoInput = document.getElementById('periodo');

            nrcSelect.addEventListener('change', function() {
                const selectedOption = nrcSelect.options[nrcSelect.selectedIndex];
                const periodo = selectedOption.getAttribute('data-periodo');
                periodoInput.value = periodo ? periodo : '';
            });
        });



        $('#modalImportar').on('hidden.bs.modal', function() {
            console.log('Modal hidden');
            $('#idModalImportar')[0].reset();
            $('#idModalImportar').find('.form-group').removeClass('has-error');
            $('#idModalImportar').find('.help-block').text('');
            removeFile();
        });


        function displayFileName(input, fileTextId) {
            const fileName = input.files[0].name;
            document.getElementById(fileTextId).textContent = fileName;
            document.querySelector('.remove-icon').style.display = 'inline'; // Mostrar la "X"
        }

        function removeFile(inputId, fileTextId) {
            document.getElementById(inputId).value = ""; // Clear the input
            document.getElementById(fileTextId).innerHTML =
                '<i class="fa fa-upload"></i> Haz clic aquí para subir el documento'; // Reset the text
            document.querySelector('.remove-icon').style.display = 'none'; // Ocultar la "X"
        }
    </script>


@endsection
