@extends('layouts.admin')

@section('title', 'Agregar Proyecto')

@section('title_component', 'Panel Agregar Proyecto')

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

@section('content')
    <div class="mat-elevation-z8 ">
        <div class="card"
            style="margin: auto; max-width: 800px; box-shadow: 0 6px 10px 0 rgba(64, 69, 108, 0.6); transition: 0.5s;">
            <div class="card-body" style="padding: 1rem; text-align: center;">
                <h4><b>Agrega datos del proyecto</b></h4> <!-- Título agregado aquí -->
                <hr>
                <form method="POST" action="{{ route('admin.crearProyecto') }}"
                    style="display: inline-block; width: 100%; max-width: 600px;">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="codigoProyecto">Ingrese código del proyecto:</label>
                                <input type="text" name="codigoProyecto" class="form-control input"
                                    placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="NombreProyecto">Nombre del Proyecto:</label>
                                <textarea name="NombreProyecto" class="form-control input" placeholder="Ingrese el Nombre del Proyecto" required></textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="DirectorProyecto">Director del Proyecto:</label>
                                <select name="DirectorProyecto" class="form-control input input-select" required>
                                    <option value="" disabled selected>Seleccionar Director</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id }}">
                                            {{ $profesor->apellidos }} {{ $profesor->nombres }} -
                                            {{ $profesor->departamento }} -
                                            {{ $profesor->correo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="DescripcionProyecto">Descripción del Proyecto:</label>
                                <textarea name="DescripcionProyecto" class="form-control input" placeholder="Describa el Proyecto" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="DepartamentoTutor">Departamento:</label>
                                <select id="DepartamentoTutor" name="DepartamentoTutor" class="form-control input_select input">
                                    <option value="">Seleccione un
                                        departamento</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->departamento }}"
                                            data-nombre="{{ $departamento->departamento }}">
                                            {{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FechaInicio">Fecha de Inicio:</label>
                                <input type="date" name="FechaInicio" class="form-control input" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FechaFinalizacion">Fecha de Fin:</label>
                                <input type="date" name="FechaFinalizacion" class="form-control input" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Estado">Estado:</label>
                                <select name="Estado" class="form-control input input_select" required>
                                    <option value="#">Seleccione el estado</option>
                                    <option value="Ejecucion">En Ejecución</option>
                                    <option value="Terminado">Terminado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="button1">Agregar Proyecto</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>


@endsection
