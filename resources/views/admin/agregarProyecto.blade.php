@extends('layouts.admin')

@section('title', 'Agregar Proyecto')

@section('title_component', 'Panel Agregar Proyecto')

@if (session('success'))
<div class="contenedor_alerta success">
    <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
    <div class="content_alert">
        <div class="title">Éxito!</div>
        <div class="body">{{ session('success') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif

@if (session('error'))
<div class="contenedor_alerta error">
    <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
    <div class="content_alert">
        <div class="title">Error!</div>
        <div class="body">{{ session('error') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif

@section('content')
<div class="mat-elevation-z8 contenedor_general">
    <form method="POST" action="{{ route('admin.crearProyecto') }}">
        @csrf

        <div class="form-group">
            <label for="codigoProyecto">Ingrese código del proyecto:</label>
            <input type="text" name="codigoProyecto" class="form-control input" placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="DirectorProyecto">Director del Proyecto:</label>
                    <select name="DirectorProyecto" class="form-control input input-select" required>
                        <option value="">Seleccionar Director</option>
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

        <div class="form-group">
            <label for="NombreProyecto">Nombre del Proyecto:</label>
            <input type="text" name="NombreProyecto" class="form-control input" placeholder="Ingrese el Nombre del Proyecto" required>
        </div>

        <div class="form-group">
            <label for="DescripcionProyecto">Descripción del Proyecto:</label>
            <textarea name="DescripcionProyecto" class="form-control input" placeholder="Describa el Proyecto" required></textarea>
        </div>

        <div class="form-group">
            <label for="DepartamentoTutor">Departamento:</label>
            <select name="DepartamentoTutor" class="form-control input input_select" required>
                <option value="Ciencias de la Computación">DCCO - Departamento de Computación</option>
                <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                <option value="Ciencias de la Vida y Agricultura">DCVA - Departamento de Ciencias de la Vida y Agricultura</option>
            </select>
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
                        <option value="Ejecucion">En Ejecución</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="button1 efects_button">Agregar Proyecto</button>
        </div>

</form>
</div>


@endsection
