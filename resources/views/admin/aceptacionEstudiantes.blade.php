@extends('layouts.admin')

@section('title', 'Panel Aceptación ')

@section('title_component', 'Panel Estudiantes')

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


    <section class="contenedor_agregar_periodo">
        <h4><b>Estudiantes en Proceso de Revisión</b></h4>
        <hr>
        <div class="mat-elevation-z8 contenedor_general">

            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <!-- Botones -->
                <div class="contenedor_botones">
                </div>
                <div class="contenedor_buscador">
                    <div>
                        <form action="{{ route('admin.estudiantes') }}" method="GET" id="formBusquedaEstudiantes">
                            @csrf


                            <input type="text" class="form-control input" name="buscarEstudiantesEnRevision"
                                id="buscarEstudiantesEnRevision" matInput placeholder="Buscar estudiantes...">
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
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="tamanio1">ESTUDIANTE</th>
                                    <th class="tamanio2">ID ESPE</th>
                                    <th class="tamanio2">CÉDULA</th>
                                    <th>COHORTE</th>
                                    <th class="tamanio1">DEPARTAMENTO</th>
                                    <th class="tamanio1">ESTADO ACTUAL</th>
                                    <th>OBSERVACIÓN</th>
                                    <th>ESTADO</th>
                                    <th>ACTUALIZAR</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantesEnRevision->isEmpty())
                                    <tr style="text-align:center">
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">No hay
                                            estudiantes en proceso de revisión.</td>
                                    </tr>
                                @else
                                    @foreach ($estudiantesEnRevision as $estudiante)
                                        <tr>

                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($estudiante->apellidos) }}
                                                {{ strtoupper($estudiante->nombres) }}</td>
                                            <td>{{ $estudiante->espeId }}</td>
                                            <td>{{ $estudiante->cedula }}</td>
                                            <td>{{ $estudiante->periodos->numeroPeriodo }}</td>
                                            <td style="text-transform: uppercase;">
                                                {{ strtoupper($estudiante->departamento) }}</td>
                                            <td style="text-transform: uppercase;">{{ strtoupper($estudiante->estado) }}
                                            </td>
                                            @if ($estudiante->comentario !== 'Sin comentarios')
                                                <td>{{ strtoupper($estudiante->comentario) }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td>
                                                <form id="updateEstudianteForm"
                                                    action="{{ route('admin.updateEstudiante', ['id' => $estudiante->estudianteId]) }}"
                                                    method="POST" onsubmit="enviarCorreo(event)">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="motivoNegacion" name="motivoNegacion"
                                                        class="input">
                                                    <select name="nuevoEstado" id="nuevoEstado" onchange="verificarEstado()"
                                                        class="form-control input1 input input_select">
                                                        <option value="Aprobado">Aprobado</option>
                                                        <option value="Negado">Negado</option>
                                                    </select>

                                                </form>
                                            </td>
                                            <td>
                                                <center><button type="submit" form="updateEstudianteForm" class="button3">
                                                        <i class="bx bx-check"></i>
                                                    </button></center>
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
    </section>
    <br>
    <h4><b>Seguimiento Estudiantes</b></h4>
    <hr>
    <section>
        <div class="mat-elevation-z8 contenedor_general">

            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <!-- Botones -->
                <div class="contenedor_botones">

                    <div class="tooltip-container ">
                        <span class="tooltip-text">Reporte Estudiante</span>
                        <form action="{{ route('admin.reportesEstudiantes') }}" method="POST">
                            @csrf
                            <button type="submit" class="button3 efects_button btn_excel">
                                <i class="fas fa-file-excel"></i>
                            </button>
                        </form>
                    </div>

                 <!-- Botón de Filtros para Profesores y Periodos -->
<div class="tooltip-container">
                                    <span class="tooltip-text">Filtros</span>
                                    <button class="button3 efects_button btn_filtro"
                                        onclick="openCard('filtersCardProfesores');">
                                        <i class="fa-solid fa-filter-list"></i>
                                    </button>
                                </div>

                                <!-- Card de Filtros para Profesores y Periodos -->
                                <div class="draggable-card1_2" id="filtersCardProfesores" style="display: none;">
                                    <div class="card-header">
                                        <span class="card-title">Filtros Profesores y Periodos</span>
                                        <button type="button" class="close"
                                            onclick="closeCard('filtersCardProfesores')"><i
                                                class="fa-thin fa-xmark"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <form id="filterFormProfesores" method="GET"
                                            action="{{ route('admin.indexProyectos') }}">
                                            <div class="form-group">
                                                <label for="profesor">Profesor</label>
                                                <select name="profesor" id="profesor"
                                                    class="form-control input input_select">
                                                    <option value="">Todos los docentes</option>
                                                   
                                                        <option value="#">
                                                         
                                                        </option>
                                                 
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="periodos">Períodos</label>
                                                <select name="periodos" id="periodos"
                                                    class="form-control input input_select">
                                                    <option value="">Todos los periodos</option>
                                                   
                                                        <option value="#">
                                                           
                                                        </option>
                                                
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="fechaInicio">Fecha inicio</label>
                                                <input type="date" class="input" name="fechaInicio"
                                                    id="fechaInicio">
                                            </div>

                                            <div class="form-group">
                                                <label for="fechaFin">Fecha Fin</label>
                                                <input type="date" class="input" name="fechaFin" id="fechaFin">
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                                <div class="tooltip-container ">
                                    <span class="tooltip-text">Eliminar Filtros</span>
                                    <button class="button3 efects_button btn_delete_filter"
                                        onclick="resetFiltersProfesores()">
                                        <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                    </button>
                                </div>
                            </div>
                <div class="contenedor_buscador">
                    <div>





                        <form id="formBusquedaEstudiantes">
                            <input type="text" class="input" name="search2" value="{{ $search2 }}" matInput
                                placeholder="Buscar estudiantes...">
                            <i class='bx bx-search-alt'></i>
                        </form>

                    </div>
                </div>
            </div>


            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaEstudiantes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>N°</th>
                                    <th class="tamanio1">ESTUDIANTE</th>
                                    <th>ID ESPE</th>
                                    <th class="tamanio3">CARRERA</th>
                                    <th>CÉDULA</th>
                                    <th>COHORTE</th>
                                    <th>PERIODO</th>
                                    <th class="tamanio2">DEPARTAMENTO</th>
                                    <th>ESTADO</th>

                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantesAprobados->isEmpty())
                                    <tr style="text-align:center">
                                        <td colspan="9">No hay estudiantes en proceso de revisión.</td>
                                    </tr>
                                @else
                                    @foreach ($estudiantesAprobados as $index => $estudiante)
                                        <tr>
                                            <td>{{ $estudiantesAprobados ->firstItem() + $index }}</td>


                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($estudiante->apellidos . ' ' . $estudiante->nombres) }}
                                            </td>
                                            <td>{{ $estudiante->espeId }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($estudiante->carrera) }}</td>
                                            <td>{{ $estudiante->cedula }}</td>
                                            <td>{{ $estudiante->periodos->numeroPeriodo ?? '' }}</td>
                                            <td>{{ $estudiante->periodos->periodo ?? ''}}</td>
                                            <td style="text-transform: uppercase; ">
                                                {{ strtoupper($estudiante->departamento) }}</td>
                                            <td style="text-transform: uppercase;">
                                                @if ($estudiante->estado == 'Aprobado')
                                                    {{ strtoupper('Vinculación') }}
                                                @elseif ($estudiante->estado == 'Aprobado-prácticas')
                                                    {{ strtoupper('Prácticas') }}
                                                @else
                                                    {{ strtoupper($estudiante->estado) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>


                <div class="paginator-container">
                    <nav aria-label="..."
                        style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                        <div id="totalRows">Estudiantes: {{ $estudiantesAprobados->total() }}</div>


                        <ul class="pagination">
                            <li class="page-item mx-3">
                                <form method="GET" action="{{ route('admin.estudiantes') }}#tablaEstudiantes">
                                    <select class="form-control page-item" name="elementosPorPaginaAprobados"
                                        id="elementosPorPaginaAprobados" onchange="this.form.submit()">
                                        <option value="10" @if ($elementosPorPaginaAprobados == 10) selected @endif>10
                                        </option>
                                        <option value="20" @if ($elementosPorPaginaAprobados == 20) selected @endif>20
                                        </option>
                                        <option value="50" @if ($elementosPorPaginaAprobados == 50) selected @endif>50
                                        </option>
                                        <option value="100" @if ($elementosPorPaginaAprobados == 100) selected @endif>100
                                        </option>
                                    </select>
                                </form>
                            </li>

                            @if ($estudiantesAprobados->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->previousPageUrl() }}#tablaEstudiantes"
                                        aria-label="Anterior">Anterior</a>
                                </li>
                            @endif

                            @if ($estudiantesAprobados->lastPage() > 1)
                                @for ($page = 1; $page <= $estudiantesAprobados->lastPage(); $page++)
                                    @if (
                                        $page == 1 ||
                                            $page == $estudiantesAprobados->lastPage() ||
                                            ($page >= $estudiantesAprobados->currentPage() - 2 && $page <= $estudiantesAprobados->currentPage() + 2))
                                        @if ($page == $estudiantesAprobados->currentPage())
                                            <li class="page-item active"><span
                                                    class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->url($page) }}#tablaEstudiantes">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @elseif ($page == 2 || $page == $estudiantesAprobados->lastPage() - 1)
                                        <li class="page-item"><span class="page-link">...</span></li>
                                    @endif
                                @endfor
                            @endif

                            @if ($estudiantesAprobados->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->nextPageUrl() }}#tablaEstudiantes"
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



    <br>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
        function enviarFormulario(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Enviando correo...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Envío del formulario usando AJAX
                    $.ajax({
                        url: '/admin/actualizar-estudiante/{{ $estudiante->estudianteId }}',
                        type: 'PUT',
                        data: $('#updateEstudianteForm').serialize(),
                        success: function(response) {
                            Swal.close();
                            // Maneja el éxito de la operación aquí
                            Swal.fire('¡Correo enviado!', '', 'success');
                        },
                        error: function(xhr, status, error) {
                            Swal.close();
                            // Maneja el error aquí
                            Swal.fire('Error al enviar el correo', '', 'error');
                        }
                    });
                }
            });
        }
    </script>
    <script>
        var delayTimer;
        $('#formBusquedaEstudiantes input[name="search2"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.estudiantes') }}',
                    type: 'GET',
                    data: {
                        search2: query
                    },
                    success: function(response) {
                        $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes')
                        .html());
                    }
                });
            }, 500);
        });
    </script>
    <script>
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

        .contenedor_tabla .table-container table th {
            position: sticky;
            font-size: .8em !important;
    </style>
@endsection
