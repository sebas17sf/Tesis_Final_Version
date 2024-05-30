<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\estudiantesvinculacion;
use App\Models\Estudiante;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use App\Models\Periodo;

use App\Models\Usuario;
use App\Models\ProfesUniversidad;
use App\Models\AsignacionEstudiantesDirector;
use App\Models\Role;
use App\Models\NrcVinculacion;
use Illuminate\Support\Facades\DB;
use App\Models\ParticipanteAdicional;
use App\Models\PracticaI;
use App\Models\PracticaII;

use Illuminate\Support\Facades\Auth;
use App\Models\UsuariosSession;
use App\Models\Empresa;

use App\Models\AsignacionProyecto;

use ZipStream\ZipStream;
use ZipStream\Option\Archive;



class CoordinadorController extends Controller
{
    public function index(Request $request)
    {
        $estadoProyecto = $request->input('estado');

        $periodos = Periodo::all();
        $nrcs = NrcVinculacion::all();
        $profesores = ProfesUniversidad::all();

        $perPage = $request->input('perPage', 10);
        $perPage2 = $request->input('perPage2', 10);
        $page = $request->input('page', 1); // Page for the first pagination
        $page2 = $request->input('page2', 1); // Page for the second pagination
        $search = $request->input('search');

        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        $query = Proyecto::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('NombreProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('DescripcionProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('Estado', 'LIKE', '%' . $search . '%')
                    ->orWhere('DepartamentoTutor', 'LIKE', '%' . $search . '%')
                    ->orWhere('codigoProyecto', 'LIKE', '%' . $search . '%');
            });
        }

        if ($estadoProyecto) {
            $query->where('Estado', $estadoProyecto);
        }

        // First pagination
        $proyectos = $query->paginate($perPage, ['*'], 'page', $page);

        // Obtener otros datos necesarios
        $proyectosDisponibles = Proyecto::where('Estado', 'Ejecucion')->get();
        $estudiantesAprobados = Estudiante::where('Estado', 'Aprobado')
            ->whereDoesntHave('asignaciones')
            ->get();

        ///////////// Obtener todas las asignacionesProyectos

        $profesorId = request('profesor');
        $periodoId = request('periodos');

        $asignacionesAgrupadas = AsignacionProyecto::with('estudiante')
            ->with('proyecto')
            ->with('docenteParticipante')
            ->with('periodo')
            ->when($profesorId, function ($query, $profesorId) {
                return $query->whereHas('docenteParticipante', function ($query) use ($profesorId) {
                    $query->where('id', $profesorId);
                });
            })
            ->when($periodoId, function ($query, $periodoId) {
                return $query->whereHas('periodo', function ($query) use ($periodoId) {
                    $query->where('id', $periodoId);
                });
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->ProyectoID . '_' . $item->IdPeriodo . "_" . $item->ParticipanteID;
            });




        // Second pagination
        $total = $asignacionesAgrupadas->count();
        $paginatedData = $asignacionesAgrupadas->forPage($page2, $perPage);
        $paginator = new LengthAwarePaginator(
            $paginatedData,
            $total,
            $perPage,
            $page2,
            ['path' => route('coordinador.index'), 'pageName' => 'page2']
        );

        return view('coordinador.index', [
            'proyectos' => $proyectos,
            'proyectosDisponibles' => $proyectosDisponibles,
            'estudiantesAprobados' => $estudiantesAprobados,
            'perPage' => $perPage,
            'perPage2' => $perPage2,
            'paginator' => $paginator,
            'profesores' => $profesores,
            'nrcs' => $nrcs,
            'asignacionesAgrupadas' => $paginator,
            'periodos' => $periodos,
            'search' => $search,
        ]);
    }





    public function crearProyectoForm()
    {

        $profesores = ProfesUniversidad::all();

        return view('coordinador.agregarProyecto', compact('profesores' ));
    }

    public function crearProyecto(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NombreProyecto' => 'required',
                'DirectorProyecto' => 'required',
                'DescripcionProyecto' => 'required|string',
                'DepartamentoTutor' => 'required',
                'codigoProyecto' => 'required',
                'FechaInicio' => 'required',
                'FechaFinalizacion' => 'required|after:FechaInicio',
                'Estado' => 'required',
            ], [
                'FechaFinalizacion.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio',
            ]);

            $proyecto = Proyecto::create([
                'DirectorID' => $validatedData['DirectorProyecto'],
                'NombreProyecto' => $validatedData['NombreProyecto'],
                'DescripcionProyecto' => $validatedData['DescripcionProyecto'],
                'DepartamentoTutor' => $validatedData['DepartamentoTutor'],
                'codigoProyecto' => $validatedData['codigoProyecto'],
                'Estado' => $validatedData['Estado'],
                'FechaInicio' => $validatedData['FechaInicio'],
                'FechaFinalizacion' => $validatedData['FechaFinalizacion'],
            ]);

            $this->actualizarUsuarioYRol($validatedData['DirectorProyecto'], 'DirectorVinculacion');

            $proyecto->save();


            return redirect()->route('coordinador.index')->with('success', 'Proyecto agregado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear el proyecto: ' . $e->getMessage());
        }
    }




    ////////editar los proyectos agregados
    ///////////////editar proyecto
    public function editProyectoForm($ProyectoID)
    {

        $nrcs = NrcVinculacion::all();

        $profesores = ProfesUniversidad::all();

        $proyecto = Proyecto::findOrFail($ProyectoID);
        return view('coordinador.editarProyecto', compact('proyecto', 'nrcs', 'profesores'));
    }


    public function editProyecto(Request $request, $ProyectoID)
    {
        $validatedData = $request->validate([
            'DirectorProyecto' => 'required',
            'NombreProyecto' => 'required',
            'codigoProyecto' => 'required',
            'DescripcionProyecto' => 'required|string',
            'DepartamentoTutor' => 'required',
            'FechaInicio' => 'required',
            'FechaFinalizacion' => 'required|after:FechaInicio',
            'Estado' => 'required',
        ], [
            'FechaFinalizacion.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio',
        ]);

        $proyecto = Proyecto::findOrFail($ProyectoID);

        $proyecto->DirectorID = $validatedData['DirectorProyecto'];
        $proyecto->NombreProyecto = $validatedData['NombreProyecto'];
        $proyecto->DescripcionProyecto = $validatedData['DescripcionProyecto'];
        $proyecto->DepartamentoTutor = $validatedData['DepartamentoTutor'];
        $proyecto->codigoProyecto = $validatedData['codigoProyecto'];
        $proyecto->FechaInicio = $validatedData['FechaInicio'];
        $proyecto->FechaFinalizacion = $validatedData['FechaFinalizacion'];
        $proyecto->Estado = $validatedData['Estado'];
        $proyecto->save();

        $this->actualizarUsuarioYRol($validatedData['DirectorProyecto'], 'DirectorVinculacion');

        return redirect()->route('coordinador.index')->with('success', 'Proyecto actualizado correctamente');
    }

    ////////////////////////va con editar
    private function actualizarUsuarioYRol($profesorId, $tipoRol)
    {
        $profesor = ProfesUniversidad::findOrFail($profesorId);
        $rolId = Role::where('Tipo', $tipoRol)->value('id');

        $usuario = Usuario::where('CorreoElectronico', $profesor->Correo)->first();

        if (!$usuario) {
            Usuario::create([
                'NombreUsuario' => $profesor->Usuario,
                'Nombre' => $profesor->Nombres,
                'Apellido' => $profesor->Apellidos,
                'CorreoElectronico' => $profesor->Correo,
                'FechaNacimiento' => now(),
                'Contrasena' => bcrypt('123'),
                'Estado' => 'activo',
                'role_id' => $rolId,
            ]);
        } else {
            if ($usuario->role_id != $rolId) {
                $usuario->role_id = $rolId;
                $usuario->save();
            }
        }

        //////actualizar el UserID de ProfesUniversidad con el ID de Usuario creado
        $profesor->UserID = Usuario::where('CorreoElectronico', $profesor->Correo)->value('UserID');
        $profesor->save();
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
    public function guardarAsignacion(Request $request)
    {
        // Validación de datos
        $request->validate([
            'proyecto_id' => 'required',
            'estudiante_id' => 'required|array',
            'estudiante_id.*' => 'numeric',
            'ProfesorParticipante' => 'required',
            'nrc' => 'required',
            'FechaInicio' => 'required',
            'FechaFinalizacion' => 'required',
        ]);


        $nrc = NrcVinculacion::where('id', $request->nrc)->first();

        foreach ($request->estudiante_id as $estudianteID) {
            AsignacionProyecto::create([
                'ProyectoID' => $request->proyecto_id,
                'EstudianteID' => $estudianteID,
                'ParticipanteID' => $request->ProfesorParticipante,
                'FechaAsignacion' => now(),
                'IdPeriodo' => $nrc->id_periodo,
                'id_nrc_vinculacion' => $request->nrc,
                'FechaInicio' => $request->FechaInicio,
                'FechaFinalizacion' => $request->FechaFinalizacion,
            ]);
        }
        $this->actualizarUsuarioYRol($request->ProfesorParticipante, 'ParticipanteVinculacion');

        return redirect()->route('coordinador.index')->with('success', 'Estudiante asignado correctamente');

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

        // Obtener los estudiantes asignados al proyecto
        $estudiantesAsignados = $proyecto->asignacionesEstudiantesDirectores
            ->where('IDProyecto', $ProyectoID)
            ->pluck('EstudianteID')
            ->toArray();

        $estudiantesAsignados = Estudiante::whereIn('EstudianteID', $estudiantesAsignados)->get();

        // Inicializar el objeto ZipStream
        $zip = new ZipStream();

        try {
            // Iterar sobre los estudiantes y sus actividades
            foreach ($estudiantesAsignados as $estudiante) {
                if ($estudiante->actividades()->exists()) {
                    foreach ($estudiante->actividades as $actividad) {
                        if ($actividad->evidencias) {
                            $decodedEvidencia = base64_decode($actividad->evidencias);
                            $tempFileName = 'evidencia_' . $estudiante->EstudianteID . '_' . $actividad->ID_Actividades . '.png';

                            // Agregar el archivo al ZIP
                            $zip->addFile($decodedEvidencia, $tempFileName);
                        }
                    }
                }
            }

            // Finalizar el ZIP y enviar como descarga
            $zip->finish();

        } catch (\Exception $e) {
            // Manejar errores
            \Log::error('Error al crear o descargar las evidencias: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al descargar las evidencias: ' . $e->getMessage());
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

    public function cambiarCredencialesUsuario()
    {
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('UserID', $usuario->UserID)->get();

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        return view('coordinador.cambiarCredencialesUsuario', compact('usuario', 'userSessions'));
    }
    private function getBrowserFromUserAgent($userAgent)
    {
        if (strpos($userAgent, 'OPR') !== false) {
            return 'Opera';
        } elseif (strpos($userAgent, 'Edg') !== false) {
            return 'Microsoft Edge';
        } elseif (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'MSIE') !== false) {
            return 'Internet Explorer';
        } else {
            return 'Desconocido';
        }
    }





    public function actualizarCredenciales(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'nombre' => 'required',
        ]);

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden')->withInput();
        }

        //////las credenciales deben ser minimo de 6 caracteres
        if (strlen($request->password) < 6) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 6 caracteres')->withInput();
        }

        $usuario = Auth::user();

        $usuario->CorreoElectronico = $request->email;
        $usuario->NombreUsuario = $request->nombre;
        $usuario->Contrasena = bcrypt($request->password);

        $usuario->save();

        return redirect()->route('coordinador.index')->with('success', 'Credenciales actualizadas exitosamente');
    }




}
