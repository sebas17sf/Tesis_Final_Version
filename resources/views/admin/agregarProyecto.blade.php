@extends('layouts.admin')

@section('title', 'Agregar Proyecto')

@section('title_component', 'Agregar Proyecto')

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@section('content')
    <div class="mat-elevation-z8 contenedor_general">
        <form method="POST" action="{{ route('admin.crearProyecto') }}">
            @csrf



            <div class="form-group">
                <label for="codigoProyecto">Ingrese código del proyecto:</label>
                <input type="text" name="codigoProyecto" class="form-control input"
                    placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
            </div>







            <div class="form-group">
                <label for="NombreProyecto">Nombre del Proyecto:</label>
                <input type="text" name="NombreProyecto" class="form-control input"
                    placeholder="Ingrese el Nombre del Proyecto" required>
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
                    <option value="Ciencias de la Vida y Agricultura">DCVA - Departamento de Ciencias de la Vida y
                        Agricultura</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Estado">Estado:</label>
                <select name="Estado" class="form-control input input_select" required>
                    <option value="Ejecucion">En Ejecución</option>
                    <option value="Terminado">Terminado</option>
                </select>
            </div>
            <button type="submit" class="button">Agregar Proyecto</button>
        </form>
    </div>



@endsection
