@extends('layouts.admin')

@section('title', 'Editar Proyecto')

@section('title_component', 'Panel Editar Proyecto')

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
<div class="mat-elevation-z8">
    <div class="card" style="margin: auto; max-width: 800px; box-shadow: 0 6px 10px 0 rgba(64, 69, 108, 0.6); transition: 0.5s;">
        <div class="card-body" style="padding: 1rem; text-align: center;">
            <h4><b>Editar Proyecto</b></h4>
            <hr>
            <form action="{{ route('admin.updateProyecto', ['ProyectoID' => $proyecto->proyectoId]) }}" method="POST" style="display: inline-block; width: 100%; max-width: 600px;">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigoProyecto">Ingrese código del proyecto:</label>
                            <input type="text" value="{{ $proyecto->codigoProyecto }}" name="codigoProyecto" class="form-control input" placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="NombreProyecto">Nombre del Proyecto:</label>
                            <textarea type="text" class="form-control input" id="NombreProyecto" rows="4" name="NombreProyecto" required> {{ $proyecto->nombreProyecto }} </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="DirectorProyecto">Director del Proyecto:</label>
                            <select name="DirectorProyecto" class="form-control input input-select" required>
                                <option value="">Seleccionar Director</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}" {{ $proyecto->directorId === $profesor->id ? 'selected' : '' }}>
                                        {{ $profesor->apellidos }} {{ $profesor->nombres }} - {{ $profesor->departamento }} - {{ $profesor->correo }}
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
                            <textarea class="form-control input" id="DescripcionProyecto" name="DescripcionProyecto" rows="4" required>{{ $proyecto->descripcionProyecto }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DepartamentoTutor">Departamento:</label>
                            <select class="form-control input input-select" id="DepartamentoTutor" name="DepartamentoTutor" required>
                                <option value="DCCO" {{ $proyecto->departamentoTutor === 'DCCO' ? 'selected' : '' }}>DCCO - Departamento de Computación</option>
                                <option value="DCEX" {{ $proyecto->departamentoTutor === 'DCEX' ? 'selected' : '' }}>DCEX - Ciencias Exactas</option>
                                <option value="DCVA" {{ $proyecto->departamentoTutor === 'DCVA' ? 'selected' : '' }}>DCVA - Departamento de Ciencias de la Vida y Agricultura</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control input" id="FechaInicio" name="FechaInicio" value="{{ $proyecto->inicioFecha }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaFinalizacion">Fecha de Finalización:</label>
                            <input type="date" class="form-control input" id="FechaFinalizacion" name="FechaFinalizacion" value="{{ $proyecto->finFecha }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Estado">Estado:</label>
                            <select class="form-control input input-select" id="Estado" name="Estado" required>
                                <option value="Ejecucion" {{ $proyecto->estado === 'Ejecucion' ? 'selected' : '' }}>Ejecución</option>
                                <option value="Terminado" {{ $proyecto->estado === 'Terminado' ? 'selected' : '' }}>Terminado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="button1">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>
@endsection
