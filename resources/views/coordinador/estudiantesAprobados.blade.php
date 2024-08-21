@extends('layouts.coordinador')

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



    <h4><b>Seguimiento Estudiantes</b></h4>
    <hr>
    <section>
        <div class="mat-elevation-z8 contenedor_general">

            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">

                    <div class="tooltip-container">
                        <span class="tooltip-text">Reporte Estudiante</span>
                        <form id="formdatos" action="{{ route('admin.reportesEstudiantes') }}" method="POST">
                            @csrf
                            <input type="hidden" name="Departamento" id="hiddenDepartamento">
                            <input type="hidden" name="periodos" id="hiddenPeriodo">
                            <button type="submit" class="button3 efects_button btn_excel">
                                <i class="fas fa-file-excel"></i>
                            </button>
                        </form>
                    </div>
                    <div class="tooltip-container">
                        <span class="tooltip-text">Filtros</span>
                        <button class="button3 efects_button btn_filtro" onclick="openCard('filtersCardProfesores');">
                            <i class="fa-solid fa-filter-list"></i>
                        </button>
                    </div>

                    <div class="draggable-card1_2" id="filtersCardProfesores" style="display: none;">
                        <div class="card-header">
                            <span class="card-title">Filtros</span>
                            <button type="button" class="close" onclick="closeCard('filtersCardProfesores')"><i
                                    class="fa-thin fa-xmark"></i></button>
                        </div>
                        <div class="card-body">
                            <form id="filterFormProfesores" method="GET" action="{{ route('admin.indexProyectos') }}">
                                <div>
                                    <label for="departament_student">Departamento <span class="requerido">*</span></label>
                                    <select class="form-control input input_select" id="Departamento"
                                        name="Departamento">
                                        <option value="">Seleccione un departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                @if (isset($estudiante->departamentoId) && $estudiante->departamentoId == $departamento->id) selected @endif>
                                                {{ $departamento->departamento }}</option>
                                        @endforeach
                                    </select>
                                    <small id="departamentoError" class="error-message" style="color: red;"></small>
                                </div>
                                <div class="form-group">
                                    <label for="periodos">Períodos</label>
                                    <select name="periodos" id="periodos" class="form-control input input_select">
                                        <option value="">Todos los periodos</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                    <div class="tooltip-container ">
                        <span class="tooltip-text">Eliminar Filtros</span>
                        <button class="button3 efects_button btn_delete_filter" onclick="resetFiltersProfesores()">
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
                                            <td>{{ $estudiantesAprobados->firstItem() + $index }}</td>


                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($estudiante->apellidos . ' ' . $estudiante->nombres) }}
                                            </td>
                                            <td>{{ $estudiante->espeId }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($estudiante->carrera) }}</td>
                                            <td>{{ $estudiante->cedula }}</td>
                                            <td>{{ $estudiante->periodos->numeroPeriodo ?? '' }}</td>
                                            <td>{{ $estudiante->periodos->periodo ?? '' }}</td>
                                            <td style="text-transform: uppercase; ">
                                                {{ strtoupper($estudiante->departamento->departamento) }}</td>
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
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>
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
                    url: '{{ route('coordinador.estudiantesAprobados') }}',
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
            }, 5000); // 2000 milisegundos = 2 segundos
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#Departamento, #periodos').change(function() {
                var departamento = $('#Departamento').val();
                var periodo = $('#periodos').val();

                $.ajax({
                    url: "{{ route('coordinador.estudiantesAprobados') }}",
                    method: 'GET',
                    data: {
                        Departamento: departamento,
                        periodos: periodo
                    },
                    success: function(response) {
                        $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes')
                            .html());
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function resetFiltersProfesores() {
            $('#Departamento').val('');
            $('#periodos').val('');
            $.ajax({
                url: "{{ route('coordinador.estudiantesAprobados') }}",
                method: 'GET',
                data: {
                    Departamento: '',
                    periodos: ''
                },
                success: function(response) {
                    $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes').html());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#Departamento, #periodos').change(function() {
                var departamento = $('#Departamento').val();
                var periodo = $('#periodos').val();

                $.ajax({
                    url: "{{ route('coordinador.estudiantesAprobados') }}",
                    method: 'GET',
                    data: {
                        Departamento: departamento,
                        periodos: periodo
                    },
                    success: function(response) {
                        $('#tablaEstudiantes').html(response.html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>


<script>
    document.getElementById('formdatos').addEventListener('submit', function(event) {
        event.preventDefault();
        var profesor = document.getElementById('Departamento').value;
        var periodo = document.getElementById('periodos').value;
        document.getElementById('hiddenDepartamento').value = profesor;
        document.getElementById('hiddenPeriodo').value = periodo;

        this.submit();
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
        }
    </style>
@endsection
