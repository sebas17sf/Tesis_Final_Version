@extends('layouts.participante')
@section('title_component', 'Lista de Proyectos')

@section('title', 'Proyectos')
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

<div class="container" style="overflow-x: auto;">
    <br>
    <h4><b>Proyecto en Ejecución</b></h4>
    <div class="mat-elevation-z8 contenedor_general">
        <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
            <!-- Botones -->
            <div class="contenedor_botones">
                <form method="POST" action="{{ route('reporte.director') }}"
                    class="form-inline d-flex align-items-center">
                    @csrf
                    <div class="tooltip-container">

                        <button type="submit" class="button1 btn_excel efects_button">
                            <i class="fas fa-file-excel"></i> Historial Director
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('reporte.historicoParticipante') }}"
                    class="form-inline d-flex align-items-center">
                    @csrf
                    <div class="tooltip-container">

                        <button type="submit" class="button1 btn_excel efects_button">
                            <i class="fas fa-file-excel"></i> Historial participante
                        </button>
                    </div>
                </form>
            <!-- Botón para abrir el card de filtros -->
            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro" onclick="openCard('filtersCard');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros -->
                            <div class="draggable-card1_2" id="filtersCard" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros</span>
                                    <button type="button" class="close" onclick="closeCard('filtersCard')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="filtersForm" method="GET" action="{{ route('admin.indexProyectos') }}">
                                        <div class="form-group">
                                            <label for="estado" class="mr-2">Estado del Proyecto:</label>
                                            <select name="estado" id="estado"
                                                class="form-control input input_select">
                                                <option value="">Todos</option>
                                                <option value="Ejecucion"
                                                    {{ request('estado') == 'Ejecucion' ? 'selected' : '' }}>En Ejecución
                                                </option>
                                                <option value="Terminado"
                                                    {{ request('estado') == 'Terminado' ? 'selected' : '' }}>Terminado
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="departamento" class="mr-2">Departamento:</label>
                                            <select name="departamento" id="departamento"
                                                class="form-control input input_select">
                                                <option value="">Todos</option>
                                                <option value="Ciencias de la Computación"
                                                    {{ request('departamento') == 'Ciencias de la Computación' ? 'selected' : '' }}>
                                                    Ciencias de la Computación</option>
                                                <option value="Ciencias Exactas"
                                                    {{ request('departamento') == 'Ciencias Exactas' ? 'selected' : '' }}>
                                                    Ciencias Exactas</option>
                                                <option value="Ciencias de la Vida y Agricultura"
                                                    {{ request('departamento') == 'Ciencias de la Vida y Agricultura' ? 'selected' : '' }}>
                                                    Ciencias de la Vida y Agricultura</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Botón de Eliminar Filtros -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter" onclick="resetFilters()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    
        
        <div class="contenedor_buscador">
                        <div>
                            <form id="">
                                <input type="text" class="input" name="search" value=""
                                    matInput placeholder="Buscar ...">
                                <i class='bx bx-search-alt'></i>
                            </form>

                        </div>
                    </div>
                </div>
    <br>
    
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">

            <table class="mat-mdc-table">
                <thead class="ng-star-inserted">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                        <th>DIRECTOR</th>
                        <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                        <th>CORREO TUTOR</th>
                        <th class="tamanio3">DEPARTAMENTO</th>
                        <th>FECHA INICIO INTERVENCIÓN</th>
                        <th>FECHA FIN INTERVENCIÓN</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody class="mdc-data-table__content ng-star-inserted">
                    @if ($proyectosEnEjecucion && $proyectosEnEjecucion==null)
                    yhjgjgjghj
                    @else
                    @foreach ($proyectosEnEjecucion as $proyecto)
                    <tr>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                            {{ $proyecto->proyecto->nombreProyecto }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                            {{ strtoupper($proyecto->proyecto->director->apellidos ?? 'No asignado') }}
                            {{ strtoupper($proyecto->proyecto->director->nombres ?? 'No asignado') }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                            {{ $proyecto->proyecto->descripcionProyecto }}</td>
                        <td>{{ $proyecto->proyecto->director->correo }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                            {{ $proyecto->proyecto->departamentoTutor }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                            {{ $proyecto->inicioFecha }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                            {{ $proyecto->finalizacionFecha }}</td>
                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                            {{ $proyecto->proyecto->estado }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>


        </div>

        <br>
    </div>

</div>

<script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
<script src="js\admin\acciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<style>
.contenedor_tabla .table-container table td {
    width: 200px;
    min-width: 150px;
    font-size: 11px !important;
    padding: .5rem !important;
}
</style>

@endsection