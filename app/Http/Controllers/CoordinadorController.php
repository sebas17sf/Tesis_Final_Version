<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\estudiantesvinculacion;
use App\Models\Estudiante;
use ZipArchive;
use App\Models\ProyectosParticipanteVinculacion;
use Illuminate\Support\Facades\Mail;
use App\Models\Usuario;
use App\Models\ProfesUniversidad;
use Illuminate\Support\Facades\DB;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\DirectorVinculacion;
use App\Models\ParticipanteVincunlacion;
use App\Mail\EstudianteAprobado;
use App\Models\Empresa;
use App\Models\AsignacionProyecto;



class CoordinadorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');

        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        $query = Proyecto::with(['director', 'docenteParticipante']);

        // Aplicar búsqueda si se proporciona un término de búsqueda
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('NombreProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('DescripcionProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('Estado', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('director', function ($directorQuery) use ($search) {
                        $directorQuery->where('Nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('Apellidos', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('docenteParticipante', function ($participanteQuery) use ($search) {
                        $participanteQuery->where('Nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('Apellidos', 'LIKE', '%' . $search . '%');
                    });
            });

        }

        // Obtener proyectos paginados
        $proyectos = $query->paginate($perPage);

        // Obtener otros datos necesarios
        $proyectosDisponibles = Proyecto::where('Estado', 'Ejecucion')->get();

        $estudiantesAprobados = Estudiante::where('Estado', 'Aprobado')
            ->whereNotIn('EstudianteID', AsignacionProyecto::pluck('EstudianteID')->toArray())
            ->get();

        return view('coordinador.index', [
            'proyectos' => $proyectos,
            'proyectosDisponibles' => $proyectosDisponibles,
            'estudiantesAprobados' => $estudiantesAprobados,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }





    public function crearProyectoForm()
    {
        $profesores = ProfesUniversidad::all();
        $proyectosPorDepartamento = Proyecto::paginate(10);



        return view('coordinador.agregarProyecto', [
            'profesores' => $profesores,
            'proyectosPorDepartamento' => $proyectosPorDepartamento

        ]);
    }

    public function crearProyecto(Request $request)
    {
        // Valida los datos del formulario antes de crear el proyecto
        $validatedData = $request->validate([
            'DirectorProyecto' => 'required|integer',
            'ProfesorParticipante' => 'required|integer',
            'NombreProyecto' => 'required|string|max:255',
            'DescripcionProyecto' => 'required|string',
            'DepartamentoTutor' => 'required|string|max:255',
            'FechaInicio' => 'required|date',
            'FechaFinalizacion' => 'required|date',
            'cupos' => 'required|integer',
            'Estado' => 'required|string|max:255',
        ]);

        // Verificar si uno de los profesores ya está asociado a un proyecto en ejecución
        $existingProject = Proyecto::where('Estado', 'Ejecucion')
            ->where(function ($query) use ($validatedData) {
                $query->where('id_directorProyecto', $validatedData['DirectorProyecto'])
                    ->orWhere('id_docenteParticipante', $validatedData['ProfesorParticipante']);
            })
            ->exists();

        if ($existingProject) {
            return redirect()->route('coordinador.index')->with('error', 'El director o profesor participante ya está asociado a un proyecto en ejecución');
        }

        // Buscar el DirectorProyecto y ProfesorParticipante por su id en la tabla ProfesUniversidad
        $director = ProfesUniversidad::findOrFail($validatedData['DirectorProyecto']);
        $participante = ProfesUniversidad::findOrFail($validatedData['ProfesorParticipante']);

        // Verificar si el director ya tiene un usuario creado
        $directorUserExists = Usuario::where('CorreoElectronico', $director->Correo)->exists();

        if (!$directorUserExists) {
            // Crear el usuario del director
            Usuario::create([
                'NombreUsuario' => $director->Usuario,
                'Nombre' => $director->Nombres,
                'Apellido' => $director->Apellidos,
                'CorreoElectronico' => $director->Correo,
                'FechaNacimiento' => now(),
                'Contrasena' => bcrypt('123'),
                'TipoUsuario' => 'Profesor',
                'Estado' => 'DirectorVinculacion',
            ]);
        }

        // Verificar si el profesor participante ya tiene un usuario creado
        $participanteUserExists = Usuario::where('CorreoElectronico', $participante->Correo)->exists();

        if (!$participanteUserExists) {
            // Crear el usuario del profesor participante
            Usuario::create([
                'NombreUsuario' => $participante->Usuario,
                'Nombre' => $participante->Nombres,
                'Apellido' => $participante->Apellidos,
                'CorreoElectronico' => $participante->Correo,
                'FechaNacimiento' => now(),
                'Contrasena' => bcrypt('123'),
                'TipoUsuario' => 'Profesor',
                'Estado' => 'ParticipanteVinculacion',
            ]);
        }

        // Crear el nuevo proyecto
        $proyecto = Proyecto::create([
            'id_directorProyecto' => $director->id,
            'id_docenteParticipante' => $participante->id,
            'NombreProyecto' => $validatedData['NombreProyecto'],
            'DescripcionProyecto' => $validatedData['DescripcionProyecto'],
            'DepartamentoTutor' => $validatedData['DepartamentoTutor'],
            'FechaInicio' => $validatedData['FechaInicio'],
            'FechaFinalizacion' => $validatedData['FechaFinalizacion'],
            'cupos' => $validatedData['cupos'],
            'Estado' => $validatedData['Estado'],
        ]);

        return redirect()->route('coordinador.index')->with('success', 'Proyecto agregado correctamente');
    }




    ////////editar los proyectos agregados
    public function editProyectoForm($ProyectoID)
    {
        $proyecto = Proyecto::findOrFail($ProyectoID);
        return view('coordinador.editarProyecto', compact('proyecto'));
    }

    public function editProyecto(Request $request, $ProyectoID)
    {
        // Valida los datos del formulario de edición antes de actualizar el proyecto
        $validatedData = $request->validate([
            'NombreProfesor' => 'required|string|max:255',
            'ApellidoProfesor' => 'required|string|max:255',
            'NombreAsignado' => 'required|string|max:255',
            'ApellidoAsignado' => 'required|string|max:255',
            'CorreoProfeAsignado' => 'required|email|max:255',
            'NombreProyecto' => 'required|string|max:255',
            'DescripcionProyecto' => 'required|string',
            'CorreoElectronicoTutor' => 'required|email|max:255',
            'DepartamentoTutor' => 'required|string|max:255',
            'FechaInicio' => 'required|date',
            'FechaFinalizacion' => 'required|date',
            'cupos' => 'required|integer',
            'Estado' => 'required|string|max:255',
        ]);

        $proyecto = Proyecto::findOrFail($ProyectoID);
        $proyecto->update($validatedData);

        // Verificar si el estado del proyecto cambió a "Terminado"
        if ($proyecto->Estado === 'Terminado') {
            // Obtener todas las asignaciones relacionadas con el proyecto
            $asignaciones = AsignacionProyecto::where('ProyectoID', $ProyectoID)->get();

            foreach ($asignaciones as $asignacion) {
                $estudiante = $asignacion->estudiante;

                // Actualizar el estado del estudiante en la tabla existente
                $estudiante->update([
                    'Estado' => 'Aprobado-practicas',
                ]);

                // Mover al estudiante a la tabla 'estudiantesvinculacion'
                EstudiantesVinculacion::create([
                    'cedula_identidad' => $estudiante->cedula,
                    'correo_electronico' => $estudiante->Correo,
                    'espe_id' => $estudiante->espe_id,
                    'nombres' => $estudiante->Apellidos . ' ' . $estudiante->Nombres,
                    'periodo_ingreso' => $estudiante->Cohorte,
                    'periodo_vinculacion' => $estudiante->Periodo,
                    'actividades_macro' => $proyecto->DescripcionProyecto,
                    'docente_participante' => $proyecto->NombreAsignado . ' ' . $proyecto->ApellidoAsignado,
                    'fecha_inicio' => $proyecto->FechaInicio,
                    'fecha_fin' => $proyecto->FechaFinalizacion,
                    'total_horas' => '96',
                    'director_proyecto' => $proyecto->NombreProfesor . ' ' . $proyecto->ApellidoProfesor,
                    'nombre_proyecto' => $proyecto->NombreProyecto,
                ]);

            }
            Usuario::where('Nombre', $proyecto->NombreProfesor)->delete();
            Usuario::where('Nombre', $proyecto->NombreAsignado)->delete();
        }

        return redirect()->route('coordinador.index')->with('success', 'Proyecto actualizado correctamente');
    }




    ///eliminar proyecto
    public function deleteProyecto($ProyectoID)
    {
        // Buscar el proyecto por ID
        $proyecto = Proyecto::findOrFail($ProyectoID);

        // Verificar si el Estado del proyecto es "Ejecucion"
        if ($proyecto->Estado === 'Ejecucion') {
            return redirect()->route('coordinador.index')->with('error', 'No puedes eliminar un proyecto en estado de ejecución');
        }

        // Obtener todas las asignaciones relacionadas con el proyecto
        $asignaciones = AsignacionProyecto::where('ProyectoID', $ProyectoID)->get();

        // Eliminar cada asignación relacionada con el proyecto
        foreach ($asignaciones as $asignacion) {
            $asignacion->delete();
        }

        // Eliminar el proyecto
        $proyecto->delete();

        return redirect()->route('coordinador.index')->with('success', 'Proyecto y asignaciones relacionadas eliminados correctamente');
    }




    ///////////////estudiantes ordenados por sus departamentos


    public function mostrarEstudiantesAprobados(Request $request)
    {
        // Obtener todos los estudiantes "Aprobados"
        $estudiantesAprobados = Estudiante::whereIn('Estado', ['Aprobado', 'Aprobado-practicas'])->get();
        $elementosPorPagina = $request->input('elementosPorPagina');
        $elementosPorPaginaDepartamento = $request->input('elementosPorPaginaDepartamento');
        $queryEstudiantesVinculacion = EstudiantesVinculacion::query();
        $queryEstudiantesVinculacion->orderBy('nombres', 'asc');

        $query2Estudiantes = Estudiante::query();
        $query2Estudiantes->orderBy('Nombres', 'asc');

        // Inicializar arreglos para cada departamento
        $estudiantesDCCO = [];
        $estudiantesDCEX = [];
        $estudiantesDCVA = [];

        // Organizar estudiantes en los arreglos según el departamento
        foreach ($estudiantesAprobados as $estudiante) {
            switch ($estudiante->Departamento) {
                case 'Ciencias de la Computación':
                    $estudiantesDCCO[] = $estudiante;
                    break;
                case 'Ciencias Exactas':
                    $estudiantesDCEX[] = $estudiante;
                    break;
                case 'Ciencias de la Vida y Agricultura':
                    $estudiantesDCVA[] = $estudiante;
                    break;
                // Agrega más casos según sea necesario para otros departamentos
            }
        }

        if ($request->has('buscarEstudiantes')) {
            $busqueda = $request->input('buscarEstudiantes');
            $queryEstudiantesVinculacion->where(function ($query) use ($busqueda) {
                $query->where('cedula_identidad', 'like', '%' . $busqueda . '%')
                    ->orWhere('correo_electronico', 'like', '%' . $busqueda . '%')
                    ->orWhere('espe_id', 'like', '%' . $busqueda . '%')
                    ->orWhere('nombres', 'like', '%' . $busqueda . '%')
                    ->orWhere('periodo_ingreso', 'like', '%' . $busqueda . '%')
                    ->orWhere('periodo_vinculacion', 'like', '%' . $busqueda . '%')
                    ->orWhere('actividades_macro', 'like', '%' . $busqueda . '%')
                    ->orWhere('docente_participante', 'like', '%' . $busqueda . '%')
                    ->orWhere('fecha_inicio', 'like', '%' . $busqueda . '%')
                    ->orWhere('fecha_fin', 'like', '%' . $busqueda . '%')
                    ->orWhere('total_horas', 'like', '%' . $busqueda . '%')
                    ->orWhere('director_proyecto', 'like', '%' . $busqueda . '%')
                    ->orWhere('nombre_proyecto', 'like', '%' . $busqueda . '%');
            });
        }

        // Paginar estudiantes de vinculación
        $estudiantesVinculacion = $queryEstudiantesVinculacion->paginate($elementosPorPagina);

        if ($request->has('buscarEstudiantesGeneral')) {
            $busqueda2 = $request->input('buscarEstudiantesGeneral');
            $query2Estudiantes->where(function ($query) use ($busqueda2) {
                $query->where('Nombres', 'like', '%' . $busqueda2 . '%')
                    ->orWhere('Apellidos', 'like', '%' . $busqueda2 . '%')
                    ->orWhere('Correo', 'like', '%' . $busqueda2 . '%')
                    ->orWhere('Carrera', 'like', '%' . $busqueda2 . '%')
                    ->orWhere(
                        'Departamento',
                        'like',
                        '%' . $busqueda2 . '%'
                    );
            });


        }
        $estudiantesAprobados = $query2Estudiantes->paginate($elementosPorPaginaDepartamento);
        $estudiantesAprobadosCollection = collect($estudiantesAprobados->items());

        // Paginar los estudiantes aprobados

        $estudiantesDCCO = $estudiantesAprobadosCollection->where('Departamento', 'Ciencias de la Computación');
$estudiantesDCEX = $estudiantesAprobadosCollection->where('Departamento', 'Ciencias Exactas');
$estudiantesDCVA = $estudiantesAprobadosCollection->where('Departamento', 'Ciencias de la Vida y Agricultura');

        // Retorna la vista con los estudiantes organizados por departamento
        return view('coordinador.estudiantesAprobados', compact('estudiantesDCCO', 'estudiantesDCEX', 'estudiantesDCVA', 'estudiantesVinculacion', 'elementosPorPagina', 'elementosPorPaginaDepartamento'));
    }




    //vistar para asignar proyectos
    public function asignarProyectos()
    {
        // Obtener proyectos disponibles
        $proyectosDisponibles = Proyecto::all();

        // Obtener estudiantes aprobados que no están asignados a proyectos
        $estudiantesAprobados = Estudiante::where('Estado', 'Aprobado')
            ->whereNotIn('EstudianteID', AsignacionProyecto::pluck('EstudianteID')->toArray())
            ->get();

        return view('coordinador.asignarProyectos', [
            'proyectosDisponibles' => $proyectosDisponibles,
            'estudiantesAprobados' => $estudiantesAprobados,
        ]);
    }

    public function guardarAsignacion(Request $request)
    {
        // Validación de datos
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,ProyectoID',
            'estudiante_id' => 'required|exists:estudiantes,EstudianteID',
            'fecha_asignacion' => 'required|date',
        ]);

        // Obtener el proyecto seleccionado
        $proyecto = Proyecto::where('Estado', 'Ejecucion')
            ->find($request->proyecto_id);

        // Verificar si hay cupos disponibles en el proyecto
        if ($proyecto->cupos > 0) {
            $directorID = $proyecto->id_directorProyecto;
            $participanteID = $proyecto->id_docenteParticipante;

            if ($directorID && $participanteID) {
                AsignacionProyecto::create([
                    'EstudianteID' => $request->estudiante_id,
                    'ProyectoID' => $request->proyecto_id,
                    'DirectorID' => $directorID,
                    'ParticipanteID' => $participanteID,
                    'FechaAsignacion' => $request->fecha_asignacion,
                ]);

                $proyecto->decrement('cupos');

                return redirect()->route('coordinador.proyectosEstudiantes')->with('success', 'Asignación realizada con éxito.');
            } else {
                return redirect()->route('coordinador.proyectosEstudiantes')->with('error', 'No hay cupos disponibles en el proyecto seleccionado.');
            }
        }
    }


    public function proyectosEstudiantes()
    {
        ///elementos por pagina
        $elementosPorPagina2 = request('elementosPorPagina2');
        // Obtén todas las asignaciones de proyectos con información de estudiante y proyecto
        $asignaciones = AsignacionProyecto::with('estudiante', 'proyecto')->paginate($elementosPorPagina2); // Cambia 10 por el número de elementos por página que desees

        return view('coordinador.proyectosEstudiantes', compact('asignaciones', 'elementosPorPagina2'));
    }




    /////////////retornar a la vista agregar empresa
    public function agregarEmpresa(Request $request)
    {
        $elementosPorPagina = $request->input('elementosPorPagina');
        $empresas = Empresa::paginate($elementosPorPagina);

        return view('coordinador.agregarEmpresa', compact('empresas', 'elementosPorPagina'));
    }

    public function descargar($tipo, $id)
    {
        $empresa = Empresa::findOrFail($id);

        if ($tipo === 'carta') {
            $archivoNombre = $empresa->cartaCompromiso;
            $nombreArchivo = 'carta_compromiso.pdf';
        } elseif ($tipo === 'convenio') {
            $archivoNombre = $empresa->convenio;
            $nombreArchivo = 'convenio.pdf';
        } else {
            abort(404);
        }

        $archivo = storage_path('app/') . $archivoNombre;

        if (file_exists($archivo)) {
            return response()->file(
                $archivo,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
                ]
            );
        } else {
            abort(404); // Maneja el caso en que el archivo no exista
        }
    }












    public function guardarEmpresa(Request $request)
    {
        try {
            // Valida los datos del formulario antes de guardar
            $validatedData = $request->validate([
                'nombreEmpresa' => 'required|string|max:255',
                'rucEmpresa' => 'required|string|max:255',
                'provincia' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'correo' => 'required|email',
                'nombreContacto' => 'required|string|max:255',
                'telefonoContacto' => 'required|string|max:255',
                'actividadesMacro' => 'required|string',
                'cuposDisponibles' => 'required|integer',
                'cartaCompromiso' => 'file',
                'convenio' => 'file',
            ]);

            // Crea una nueva instancia de Empresa y asigna los datos validados
            $empresa = new Empresa([
                'nombreEmpresa' => $validatedData['nombreEmpresa'],
                'rucEmpresa' => $validatedData['rucEmpresa'],
                'provincia' => $validatedData['provincia'],
                'ciudad' => $validatedData['ciudad'],
                'direccion' => $validatedData['direccion'],
                'correo' => $validatedData['correo'],
                'nombreContacto' => $validatedData['nombreContacto'],
                'telefonoContacto' => $validatedData['telefonoContacto'],
                'actividadesMacro' => $validatedData['actividadesMacro'],
                'cuposDisponibles' => $validatedData['cuposDisponibles'],
            ]);

            // Maneja el archivo de cartaCompromiso
            if ($request->hasFile('cartaCompromiso')) {
                $cartaCompromisoPath = $request->file('cartaCompromiso')->store('archivos');
                $empresa->cartaCompromiso = $cartaCompromisoPath;
            }

            // Maneja el archivo de convenio
            if ($request->hasFile('convenio')) {
                $convenioPath = $request->file('convenio')->store('archivos');
                $empresa->convenio = $convenioPath;
            }

            // Guarda la empresa en la base de datos
            $empresa->save();

            // Redirige de vuelta a la página de agregar empresa con un mensaje de éxito
            return redirect()->route('coordinador.agregarEmpresa')->with('success', 'Empresa guardada exitosamente');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que ocurra durante el proceso y registra el error
            return redirect()
                ->route('coordinador.agregarEmpresa')
                ->with('error', 'Ocurrió un error al guardar la empresa: ' . $e->getMessage());
        }
    }





    ////eliminar empresa

    public function eliminarEmpresa($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return redirect()->back()->with('error', 'Empresa no encontrada.');
        }

        $empresa->delete();

        return redirect()->route('coordinador.agregarEmpresa')->with('success', 'Empresa eliminada exitosamente.');
    }
    /////////editar empresa//////////////
    public function editarEmpresa($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return redirect()->route('coordinador.agregarEmpresa')->with('error', 'Empresa no encontrada.');
        }

        return view('coordinador.editarEmpresa', compact('empresa'));
    }

    public function actualizarEmpresa(Request $request, $id)
    {
        try {
            $empresa = Empresa::find($id);

            if (!$empresa) {
                return redirect()->route('coordinador.agregarEmpresa')->with('error', 'Empresa no encontrada.');
            }

            // Valida los datos del formulario antes de actualizar
            $validatedData = $request->validate([
                'nombreEmpresa' => 'required|string|max:255',
                'rucEmpresa' => 'required|string|max:255',
                'provincia' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'correo' => 'required|email',
                'nombreContacto' => 'required|string|max:255',
                'telefonoContacto' => 'required|string|max:255',
                'actividadesMacro' => 'required|string',
                'cuposDisponibles' => 'required|integer',
                'cartaCompromiso' => 'file',
                'convenio' => 'file',
            ]);

            // Actualiza los datos de la empresa con los nuevos valores validados
            $empresa->nombreEmpresa = $validatedData['nombreEmpresa'];
            $empresa->rucEmpresa = $validatedData['rucEmpresa'];
            $empresa->provincia = $validatedData['provincia'];
            $empresa->ciudad = $validatedData['ciudad'];
            $empresa->direccion = $validatedData['direccion'];
            $empresa->correo = $validatedData['correo'];
            $empresa->nombreContacto = $validatedData['nombreContacto'];
            $empresa->telefonoContacto = $validatedData['telefonoContacto'];
            $empresa->actividadesMacro = $validatedData['actividadesMacro'];
            $empresa->cuposDisponibles = $validatedData['cuposDisponibles'];


            // Maneja la actualización de la cartaCompromiso si se proporciona un nuevo archivo
            if ($request->hasFile('cartaCompromiso')) {
                $cartaCompromisoPath = $request->file('cartaCompromiso')->store('archivos');
                $empresa->cartaCompromiso = $cartaCompromisoPath;
            }

            // Maneja la actualización del convenio si se proporciona un nuevo archivo
            if ($request->hasFile('convenio')) {
                $convenioPath = $request->file('convenio')->store('archivos');
                $empresa->convenio = $convenioPath;
            }

            // Guarda los cambios en la empresa
            $empresa->save();

            // Redirige de vuelta a la página de agregar empresa con un mensaje de éxito
            return redirect()->route('coordinador.agregarEmpresa')->with('success', 'Empresa actualizada exitosamente');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que ocurra durante el proceso y registra el error
            return redirect()
                ->route('coordinador.agregarEmpresa')
                ->with('error', 'Ocurrió un error al actualizar la empresa: ' . $e->getMessage());
        }
    }









    //ir a la vista de practica 1
    public function aceptarFasei()
    {
        $estudiantesConPracticaI = PracticaI::with('estudiante')
            ->where('Estado', 'PracticaI')
            ->get();

        $estudiantesConPracticaII = PracticaII::with('estudiante')
            ->where('Estado', 'PracticaII')
            ->get();


        $estudiantesPracticas = PracticaI::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Terminado');
            })
            ->get();

        $estudiantesPracticasII = PracticaII::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Terminado');
            })
            ->get();


        return view('coordinador.aceptarFaseI', compact('estudiantesConPracticaI', 'estudiantesPracticas', 'estudiantesConPracticaII', 'estudiantesPracticasII'));

    }

    public function actualizarEstadoEstudiante(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);


        $practica = PracticaI::where('EstudianteID', $id)->first();

        if (!$practica) {
            return redirect()->route('coordinador.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->Estado = $nuevoEstado;
        $practica->save();

        if ($nuevoEstado === 'En ejecucion') {
            return redirect()->route('coordinador.aceptarFaseI')->with('success', 'Práctica aprobada correctamente.');
        }

        // Si el nuevo estado es 'Negado', elimina la práctica
        if ($nuevoEstado === 'Negado') {
            $practica->delete();
            return redirect()->route('coordinador.index')->with('success', 'Práctica negada y eliminada correctamente.');
        }

        // Redirecciona de regreso con un mensaje de éxito
        return redirect()->route('coordinador.aceptarFaseI')->with('success', 'Estado de la práctica actualizado correctamente.');
    }

    public function actualizarEstadoEstudiante2(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);

        $practica = PracticaII::where('EstudianteID', $id)->first();

        if (!$practica) {
            return redirect()->route('coordinador.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->Estado = $nuevoEstado;
        $practica->save();

        if ($nuevoEstado === 'En ejecucion') {
            return redirect()->route('coordinador.aceptarFaseI')->with('success', 'Práctica II aprobada correctamente.');
        }

        if ($nuevoEstado === 'Negado') {
            $practica->delete();
            return redirect()->route('coordinador.index')->with('success', 'Práctica II negada y eliminada correctamente.');
        }

        return redirect()->route('coordinador.aceptarFaseI')->with('success', 'Estado de la Práctica II actualizado correctamente.');
    }






    //////editar empresa del estudiante
    public function editarNombreEmpresa($id)
    {
        $estudiante = Estudiante::find($id);
        $empresas = Empresa::all();



        return view('coordinador.editarNombreEmpresa', compact('estudiante', 'empresas'));
    }


    /////////////////////////actualizar la empresa del estudiante
    public function actualizarNombreEmpresa(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoNombreEmpresa' => 'required|string|max:255',
        ]);

        $practicaI = PracticaI::where('EstudianteID', $id)->first();
        $practicaII = PracticaII::where('EstudianteID', $id)->first();

        if (!$practicaI && !$practicaII) {
            return redirect()->route('coordinador.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        $nuevoNombreEmpresa = $request->input('nuevoNombreEmpresa');

        if ($practicaI) {
            // Actualiza el valor "Empresa" en la tabla PracticaI
            $practicaI->Empresa = $nuevoNombreEmpresa;
            $practicaI->save();
        }

        if ($practicaII) {
            // Actualiza el valor "Empresa" en la tabla PracticaII
            $practicaII->Empresa = $nuevoNombreEmpresa;
            $practicaII->save();
        }

        return redirect()->route('coordinador.aceptarFaseI')->with('success', 'Empresa actualizado correctamente.');
    }






    ///////////////Descargar evidencias//////////////////////
    public function descargarEvidencias($ProyectoID)
    {
        $proyecto = Proyecto::find($ProyectoID);

        if (!$proyecto) {
            return back()->with('error', 'Proyecto no encontrado');
        }

        $estudiantesAsignados = $proyecto->estudiantes;

        if ($estudiantesAsignados->isEmpty()) {
            return back()->with('error', 'No se encontraron estudiantes asignados a este proyecto');
        }

        // Crear un directorio para almacenar temporalmente las evidencias
        $tempDirectory = storage_path('app/public/temp');
        if (!file_exists($tempDirectory)) {
            mkdir($tempDirectory, 0755, true); // Asegúrate de que el directorio se cree con permisos de escritura
        }

        // Obtener el nombre del proyecto y las fechas de inicio y fin
        $nombreProyecto = $proyecto->NombreProyecto;
        $fechaInicio = $proyecto->FechaInicio;
        $fechaFin = $proyecto->FechaFin;

        // Obtener el nombre y apellido del director del proyecto
        $directorProyecto = ProfesUniversidad::find($proyecto->id_directorProyecto);
        $nombreDirector = $directorProyecto->Nombres;
        $apellidoDirector = $directorProyecto->Apellidos;

        // Eliminar espacios y caracteres especiales del nombre del proyecto para evitar problemas con el nombre del archivo ZIP
        $nombreProyecto = str_replace(' ', '_', $nombreProyecto);
        $nombreProyecto = preg_replace('/[^A-Za-z0-9\-]/', '', $nombreProyecto);

        // Concatenar el nombre del proyecto, nombre y apellido del director, y las fechas al nombre del archivo ZIP
        $zipFileName = $nombreProyecto . '_' . $nombreDirector . '_' . $apellidoDirector . '_' . $fechaInicio . '_' . $fechaFin . '.zip';

        // Ruta del archivo ZIP
        $zipFilePath = public_path('evidencias/' . $zipFileName);

        // Crear un archivo ZIP para las evidencias
        $zip = new ZipArchive();

        try {
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                throw new \Exception('No se pudo abrir el archivo ZIP');
            }

            foreach ($estudiantesAsignados as $estudiante) {
                $actividades = $estudiante->actividades;

                foreach ($actividades as $actividad) {
                    // Decodificar la evidencia base64
                    $evidenciaDecodificada = base64_decode($actividad->evidencias);

                    // Crear un nombre de archivo único para la evidencia
                    $nombreArchivo = uniqid() . '.png';

                    // Guardar la evidencia en un archivo temporal
                    $tempFilePath = $tempDirectory . '/' . $nombreArchivo;
                    file_put_contents($tempFilePath, $evidenciaDecodificada);

                    // Agregar la evidencia al archivo ZIP
                    $zip->addFile($tempFilePath, $nombreArchivo);
                }
            }
            $zip->close();

            // Eliminar los archivos temporales
            $this->eliminarArchivosTemporales($tempDirectory);

            // Descargar el archivo ZIP con el nombre personalizado
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudieron crear las evidencias, los estudiantes no han cargado evidencias ');
        }
    }



    // Método para eliminar archivos temporales
    private function eliminarArchivosTemporales($directorio)
    {
        $archivos = glob($directorio . '/*');
        foreach ($archivos as $archivo) {
            if (is_file($archivo)) {
                unlink($archivo);
            }
        }
    }



}
