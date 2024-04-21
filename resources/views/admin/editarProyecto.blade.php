@extends('layouts.admin')

@section('title', 'Editar Proyecto')

@section('content')
    <div class="container">
        <h4>Editar Proyecto</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.updateProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="form-group">
                <label for="NombreProyecto">Nombre del Proyecto:</label>
                <input type="text" class="form-control input" id="NombreProyecto" name="NombreProyecto" value="{{ $proyecto->NombreProyecto }}" required>
            </div>

            <div class="form-group">
                <label for="nrc">Vinculacion NRC:</label>
                <select name="nrc" class="form-control input input-select" required>
                    <option value="">Seleccionar NRC</option>
                    @foreach ($nrcs as $nrc)
                        <option value="{{ $nrc->id }}">{{ $nrc->nrc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="codigoProyecto">Ingrese código del proyecto:</label>
                <input type="text" value="{{ $proyecto->codigoProyecto }}" name="codigoProyecto" class="form-control input" placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
            </div>
            
            <div class="form-group">
                <label for="DescripcionProyecto">Descripción del Proyecto:</label>
                <textarea class="form-control input" id="DescripcionProyecto" name="DescripcionProyecto" rows="4" required>{{ $proyecto->DescripcionProyecto }}</textarea>
            </div>
        
            <div class="form-group">
                <label for="DepartamentoTutor">Departamento:</label>
                <select class="form-control input" id="DepartamentoTutor" name="DepartamentoTutor" required>
                    <option value="Ciencias de la Computación" {{ $proyecto->DepartamentoTutor === 'DCCO' ? 'selected' : '' }}>DCCO - Departamento de Computación</option>
                    <option value="Ciencias Exactas" {{ $proyecto->DepartamentoTutor === 'DCEX' ? 'selected' : '' }}>DCEX - Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura" {{ $proyecto->DepartamentoTutor === 'DCVA' ? 'selected' : '' }}>DCVA - Departamento de Ciencias de la Vida y Agricultura</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="cupos">Cupos:</label>
                <input type="number" class="form-control input" id="cupos" name="cupos" value="{{ $proyecto->cupos }}" required>
            </div>
        
            <div class="form-group">
                <label for="FechaInicio">Fecha de Inicio:</label>
                <input type="date" class="form-control input" id="FechaInicio" name="FechaInicio" value="{{ $proyecto->FechaInicio }}" required>
            </div>
        
            <div class="form-group">
                <label for="FechaFinalizacion">Fecha de Finalización:</label>
                <input type="date" class="form-control input" id="FechaFinalizacion" name="FechaFinalizacion" value="{{ $proyecto->FechaFinalizacion }}" required>
            </div>
        
            <div class="form-group">
                <label for="Estado">Estado del Proyecto:</label>
                <select class="form-control input" id="Estado" name="Estado" required>
                    <option value="Ejecucion" {{ $proyecto->Estado === 'Ejecucion' ? 'selected' : '' }}>Ejecucion</option>
                    <option value="Terminado" {{ $proyecto->Estado === 'Terminado' ? 'selected' : '' }}>Terminado</option>
                </select>
            </div>
        
            <button type="submit" class="button">Guardar Cambios</button>
        </form>
        
    </div>
@endsection
