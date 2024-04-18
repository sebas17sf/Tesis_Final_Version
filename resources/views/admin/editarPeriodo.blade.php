@extends('layouts.admin') 
@section('title_component', 'Editar Periodo Academico')
@section('content')
<div class="container">


    <form class="formulario" method="POST" action="{{ route('admin.actualizarPeriodo', ['id' => $periodo->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group col-md-4">
            <label for="periodoInicio">Fecha de Inicio:</label>
            <input type="date" name="periodoInicio" class="form-control input" value="" required>
        </div>

        <div class="form-group col-md-4">
            <label for="periodoFin">Fecha de Fin:</label>
            <input type="date" name="periodoFin" class="form-control input" value="" required>
        </div>

        <button type="submit" class="button">Actualizar</button>
    </form>
</div>
@endsection
