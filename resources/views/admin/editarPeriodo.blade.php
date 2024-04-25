@extends('layouts.admin') 
@section('title_component', 'Editar Periodo Academico')
@section('content')
<div class="container">


    <form class="formulario" method="POST" action="{{ route('admin.actualizarPeriodo', ['id' => $periodo->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group col-md-4">
            <label for="periodoInicio">Fecha de Inicio:</label>
            <input type="date" name="periodoInicio" class="form-control input" value="{{$periodo->PeriodoInicio}}" required>
        </div>

        <div class="form-group col-md-4">
            <label for="periodoFin">Fecha de Fin:</label>
            <input type="date" name="periodoFin" class="form-control input" value="{{$periodo->PeriodoFin}}" required>
        </div>

        <div class="form-group col-md-4">
            <label for="numeroPeriodo">Ingrese el numero identificador del periodo:</label>
            <input type="text" name="numeroPeriodo" id="numeroPeriodo" class="form-control input" value="{{$periodo->numeroPeriodo}}" required>
            <small id="numeroPeriodoError" class="form-text text-danger"></small>
        </div>

        <button type="submit" class="button">Actualizar</button>
    </form>
</div>
 @endsection
 

