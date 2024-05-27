<?php

namespace App\Http\Controllers;

use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Mail\EstudianteAprobado;
use App\Mail\EstudianteNegado;
use App\Models\AsignacionProyecto;
use App\Models\Empresa;
use App\Models\Role;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;




use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

use App\Models\Periodo;

use App\Models\ProfesUniversidad;
use Illuminate\Support\Facades\Mail;
use App\Models\EstudiantesVinculacion;
use Illuminate\Support\Facades\Auth;


use App\Models\NrcVinculacion;
use App\Models\UsuariosSession;
use App\Models\NrcPracticas1;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        if (Auth::check()) {
            $user = Auth::user();
            $role = Role::find($user->role_id);

            if ($role && $role->Tipo === 'Administrador') {

                $searchTerm = $request->input('search');

                $query = ProfesUniversidad::query();

                if ($searchTerm) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('Apellidos', 'like', "%{$searchTerm}%")
                            ->orWhere('Nombres', 'like', "%{$searchTerm}%")
                            ->orWhere('Correo', 'like', "%{$searchTerm}%")
                            ->orWhere('Usuario', 'like', "%{$searchTerm}%")
                            ->orWhere('Cedula', 'like', "%{$searchTerm}%")
                            ->orWhere('Departamento', 'like', "%{$searchTerm}%");
                    });
                }

                $profesores = $query->paginate($perPage);

                $periodos = Periodo::all();
                $profesorRoleId = Role::where('Tipo', 'Vinculacion')->value('id');


                $profesoresPendientes = Usuario::where('role_id', $profesorRoleId)->get();

                // Consulta para obtener los profesores con permisos
                $profesoresConPermisos = Usuario::where('role_id', $profesorRoleId)
                    ->whereIn('Estado', ['Vinculacion', 'Practicas', 'Director-Departamento'])
                    ->get();


                return view('admin.index', [
                    'profesoresPendientes' => $profesoresPendientes,
                    'profesoresConPermisos' => $profesoresConPermisos,
                    'profesores' => $profesores,
                    'periodos' => $periodos,
                    'search' => $searchTerm,
                    'perPage' => $perPage,

                ]);
            }
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }
    ////actualizar permisos
    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'Estado' => 'required',
            'password' => 'required',
        ]);

        $usuario = Usuario::findOrFail($id);

        if (!$usuario) {
            return redirect()->route('admin.index')->with('error', 'Usuario no encontrado');
        }

        $usuario->Estado = $request->input('Estado');
        $usuario->Contrasena = bcrypt($request->input('password'));
        $usuario->save();

        return redirect()->route('admin.index')->with('success', 'Estado actualizado correctamente');
    }





    ////eliminar profesor
    public function deleteProfesor(Request $request, $id)
    {
        // Buscar al profesor por su ID
        $profesor = Usuario::find($id);

        if ($profesor) {
            // Eliminar al profesor de la base de datos
            $profesor->delete();
        }

        return redirect()->route('admin.index')->with('success', 'Profesor eliminado correctamente');
    }


    ///borrar los permisos concedidos
    public function deletePermission(Request $request, $id)
    {
        // Busca al usuario por su ID
        $usuario = Usuario::find($id);

        if (!$usuario) {
            // El usuario no existe, puedes manejar este caso como desees
            return redirect()->route('admin.index')->with('error', 'Usuario no encontrado');
        }

        // Verifica si el usuario tiene un estado que permite eliminar el permiso
        if (in_array($usuario->Estado, ['Vinculacion', 'Director-Departamento', 'Director-Carrera'])) {
            // Cambia el estado del usuario a 'Negado'
            $usuario->Estado = 'Pendiente';
            $usuario->save();

            return redirect()->route('admin.index')->with('success', 'Permiso eliminado correctamente');
        } elseif ($usuario->Estado === 'Pendiente') {
            // Si el estado ya es 'Negado', elimina el usuario
            $usuario->delete();

            return redirect()->route('admin.index')->with('success', 'Usuario eliminado correctamente');
        } else {
            return redirect()->route('admin.index')->with('error', 'No se puede eliminar el permiso de este usuario');
        }
    }




    ///////////////Aceptacion de estudiantes para el proceso de vinculacion/////////////////////////////////////
    public function estudiantes(Request $request)
    {
        $elementosPorPagina = $request->input('elementosPorPagina');
        $elementosPorPaginaAprobados = $request->input('elementosPorPaginaAprobados'); // Cambio de nombre

        // Consulta para estudiantes en revisión
        $queryEstudiantesEnRevision = Estudiante::where('Estado', 'En proceso de revisión')
            ->orderBy('Nombres', 'asc');

        // Búsqueda de estudiantes en revisión
        if ($request->has('buscarEstudiantesEnRevision')) {
            $busquedaEstudiantesEnRevision = $request->input('buscarEstudiantesEnRevision');
            $queryEstudiantesEnRevision->where(function ($query) use ($busquedaEstudiantesEnRevision) {
                $query->where('Nombres', 'like', '%' . $busquedaEstudiantesEnRevision . '%')
                    ->orWhere('Apellidos', 'like', '%' . $busquedaEstudiantesEnRevision . '%');
            });
        }

        $estudiantesEnRevision = $queryEstudiantesEnRevision->get();


        // Consulta para estudiantes de vinculación
        $queryEstudiantesVinculacion = EstudiantesVinculacion::orderBy('nombres', 'asc');

        // Búsqueda de estudiantes de vinculación
        if ($request->has('buscarEstudiantes')) {
            $busquedaEstudiantesVinculacion = $request->input('buscarEstudiantes');
            $queryEstudiantesVinculacion->where(function ($query) use ($busquedaEstudiantesVinculacion) {
                $query->where('cedula_identidad', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('correo_electronico', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('espe_id', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('nombres', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('periodo_ingreso', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('periodo_vinculacion', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('actividades_macro', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('docente_participante', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('fecha_inicio', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('fecha_fin', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('total_horas', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('director_proyecto', 'like', '%' . $busquedaEstudiantesVinculacion . '%')
                    ->orWhere('nombre_proyecto', 'like', '%' . $busquedaEstudiantesVinculacion . '%');
            });
        }

        $estudiantesVinculacion = $queryEstudiantesVinculacion->paginate($elementosPorPagina);

        // Consulta y paginación para estudiantes aprobados
        $queryEstudiantesAprobados = Estudiante::whereIn('Estado', ['Aprobado', 'Aprobado-prácticas']);

        // Búsqueda de estudiantes aprobados
        if ($request->has('buscarEstudiantesAprobados')) {
            $busquedaEstudiantesAprobados = $request->input('buscarEstudiantesAprobados');
            $queryEstudiantesAprobados->where(function ($query) use ($busquedaEstudiantesAprobados) {
                $query->where('Nombres', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('Apellidos', 'like', '%' . $busquedaEstudiantesAprobados . '%');
            });
        }

        $estudiantesAprobados = $queryEstudiantesAprobados->paginate($elementosPorPaginaAprobados); // Cambio de nombre

        // Verificar si no se encontraron resultados para la búsqueda de estudiantes de vinculación
        $noResultadosEstudiantesVinculacion = $estudiantesVinculacion->isEmpty() && $estudiantesVinculacion->total() === 0;

        return view('admin.aceptacionEstudiantes', [
            'estudiantesEnRevision' => $estudiantesEnRevision,
            'estudiantesAprobados' => $estudiantesAprobados,
            'estudiantesVinculacion' => $estudiantesVinculacion,
            'elementosPorPagina' => $elementosPorPagina,
            'elementosPorPaginaAprobados' => $elementosPorPaginaAprobados, // Cambio de nombre
            'noResultadosEstudiantesVinculacion' => $noResultadosEstudiantesVinculacion,
        ]);
    }





    // Actualizar el estado de un estudiante
    public function updateEstudiante(Request $request, $id)
    {
        $request->validate([
            'nuevoEstado' => 'required|in:Aprobado,Negado',
        ]);

        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return redirect()->route('admin.estudiantes')->with('error', 'El estudiante no existe.');
        }

        $nuevoEstado = $request->input('nuevoEstado');
        $estudiante->Estado = $nuevoEstado;
        $estudiante->save();

        // Envía el correo electrónico correspondiente al estado del estudiante
        $usuario = $estudiante->usuario;

        if ($usuario) {
            $email = $usuario->CorreoElectronico;

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($nuevoEstado === 'Aprobado') {
                    Mail::to($email)->queue(new EstudianteAprobado($estudiante));
                } elseif ($nuevoEstado === 'Negado') {
                    // Obtiene el motivo de negación enviado desde el formulario
                    $motivoNegacion = $request->input('motivoNegacion');
                    // Envía el correo con el motivo de negación
                    Mail::to($email)->queue(new EstudianteNegado($estudiante, $motivoNegacion));
                }
            }
        }

        return redirect()->route('admin.estudiantes')->with('success', 'Estado del estudiante actualizado correctamente.');
    }






    /////////////////////////////visualizar proyectos
    public function indexProyectos(Request $request)
    {
        $estadoProyecto = $request->input('estado');

        $periodos = Periodo::all();
        $nrcs = NrcVinculacion::all();

         $profesores = ProfesUniversidad::all();


        $perPage = $request->input('perPage', 10);
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

        // Get paginated projects
        $proyectos = $query->paginate($perPage);

        // Get other necessary data
        $proyectosDisponibles = Proyecto::where('Estado', 'Ejecucion')->get();


        $estudiantesAprobados = Estudiante::where('Estado', 'Aprobado')
            ->whereNotIn('EstudianteID', AsignacionProyecto::pluck('EstudianteID')->toArray())
            ->get();

        ///////////// quiero obtener tods las asignacionesProyectos
        $asignacionesAgrupadas = AsignacionProyecto::with('estudiante')
            ->with('proyecto')
            ->with('docenteParticipante')
            ->with('periodo')
            ->get()
            ->groupBy(function ($item) {
                return $item->ProyectoID . '_' . $item->IdPeriodo;
            });


        return view('admin.indexProyectos', [
            'proyectos' => $proyectos,
            'proyectosDisponibles' => $proyectosDisponibles,
            'estudiantesAprobados' => $estudiantesAprobados,
            'perPage' => $perPage,
            'profesores' => $profesores,
            'nrcs' => $nrcs,
            'asignacionesAgrupadas' => $asignacionesAgrupadas,
            'periodos' => $periodos,
            'search' => $search,
        ]);
    }

    ///////////////////////Vista para crear los proyectos

    public function crearProyectoForm()
    {
        $profesores = ProfesUniversidad::all();

        return view('admin.agregarProyecto', compact('profesores'));
    }


    ///////////////////////guardar proyectos



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


            return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto agregado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear el proyecto: ' . $e->getMessage());
        }
    }




    ///////////////editar proyecto
    public function editProyectoForm($ProyectoID)
    {

        $nrcs = NrcVinculacion::all();

        $profesores = ProfesUniversidad::all();

        $proyecto = Proyecto::findOrFail($ProyectoID);
        return view('admin.editarProyecto', compact('proyecto', 'nrcs', 'profesores'));
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

        return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto actualizado correctamente');
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

    /////eliminar proyecto
    public function deleteProyecto($ProyectoID)
    {
        // Buscar el proyecto por ID
        $proyecto = Proyecto::findOrFail($ProyectoID);

        // Verificar si el Estado del proyecto es "Ejecucion"
        if ($proyecto->Estado === 'Ejecucion') {
            return redirect()->route('admin.indexProyectos')->with('error', 'No puedes eliminar un proyecto en estado de ejecución');
        }

        // Obtener todas las asignaciones relacionadas con el proyecto
        $asignaciones = AsignacionProyecto::where('ProyectoID', $ProyectoID)->get();

        // Eliminar cada asignación relacionada con el proyecto
        foreach ($asignaciones as $asignacion) {
            $asignacion->delete();
        }

        // Eliminar el proyecto
        $proyecto->delete();

        return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto y asignaciones relacionadas eliminados correctamente');
    }
    ///////asignar proyecto a estudiante/////////////

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

        return redirect()->route('admin.indexProyectos')->with('success', 'Estudiante asignado correctamente');

    }


    public function guardarMaestro(Request $request)
    {
        try {
            $request->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'correo' => 'required|email|unique:profesUniversidad,Correo',
                'cedula' => 'required|digits:10|unique:profesUniversidad,Cedula',
                'departamento' => 'required',
                'espe_id' => 'required|unique:profesUniversidad,espe_id',
            ], [
                'correo.unique' => 'El correo electrónico ya está en uso.',
                'cedula.unique' => 'La cédula ya está en uso.',
                'espe_id.unique' => 'El ID de la especialidad ya está en uso.',
            ]);

            $usuario = explode('@', $request->correo)[0];
            ProfesUniversidad::create([
                'Nombres' => $request->nombres,
                'Usuario' => $usuario,
                'Apellidos' => $request->apellidos,
                'Correo' => $request->correo,
                'Cedula' => $request->cedula,
                'Departamento' => $request->departamento,
                'espe_id' => $request->espe_id,
            ]);

            return redirect()->route('admin.index')->with('success', 'Docente creado con éxito');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo crear el Docente. Por favor, verifica los datos e intenta de nuevo.');
        }
    }






    public function eliminarMaestro(Request $request, $id)
    {
        try {
            $maestro = ProfesUniversidad::find($id);

            if (!$maestro) {
                return redirect()->route('admin.index')->with('error', 'Docente no encontrado.');
            }

            $proyectosRelacionados = Proyecto::where('DirectorID', $maestro->id)
                ->orWhere('DirectorID', $maestro->id)
                ->get();

            $participante = AsignacionProyecto::where('ParticipanteID', $maestro->id)->first();

            if ($participante) {
                session(['maestro_con_proyectos' => true]);
                return redirect()->route('admin.index')->with('error', 'El Docente tiene proyectos asignados. No se puede eliminar.');
            }



            if ($proyectosRelacionados->count() > 0) {
                session(['maestro_con_proyectos' => true]);
                return redirect()->route('admin.index')->with('error', 'El Docente tiene proyectos asignados. No se puede eliminar.');
            }

            $maestro->delete();

            return redirect()->route('admin.index')->with('success', 'Docente eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo eliminar el Docente. Por favor, verifica los datos e intenta de nuevo.' . $e->getMessage());
        }
    }

    ///////editar maestro/////////////////
    public function editarDocente($id)
    {

        $maestro = ProfesUniversidad::find($id);

        return view('admin.editarDocente', compact('maestro'));
    }

    public function actualizarMaestro(Request $request, $id)
    {
        try {
            $request->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'correo' => 'required|email|unique:profesUniversidad,Correo,' . $id,
                'cedula' => 'required|digits:10|unique:profesUniversidad,Cedula,' . $id,
                'departamento' => 'required',
                'espe_id' => 'required|unique:profesUniversidad,espe_id,' . $id,
            ], [
                'correo.unique' => 'El correo electrónico ya está en uso.',
                'cedula.unique' => 'La cédula ya está en uso.',
                'espe_id.unique' => 'El ID ya está en uso.',
            ]);

            $maestro = ProfesUniversidad::find($id);

            if (!$maestro) {
                return redirect()->route('admin.index')->with('error', 'Maestro no encontrado.');
            }

            $maestro->update([
                'Nombres' => $request->nombres,
                'Apellidos' => $request->apellidos,
                'Correo' => $request->correo,
                'Cedula' => $request->cedula,
                'Departamento' => $request->departamento,
                'espe_id' => $request->espe_id,
            ]);

            return redirect()->route('admin.index')->with('success', 'Maestro actualizado con éxito.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo actualizar el maestro. Por favor, verifica los datos e intenta de nuevo.');
        }
    }


    public function guardarPeriodo(Request $request)
    {
        $request->validate([
            'periodoInicio' => 'required|date',
            'periodoFin' => 'required|date|after:periodoInicio',
            'numeroPeriodo' => 'unique:periodo|required',
        ], [
            'periodoInicio.required' => 'La fecha de inicio del período es requerida.',
            'periodoFin.required' => 'La fecha de fin del período es requerida.',
            'periodoFin.after' => 'La fecha de fin del período debe ser posterior a la fecha de inicio.',
            'numeroPeriodo.unique' => 'El codigo de período ya existe.',
        ]);



        $periodoExistente = Periodo::where('numeroPeriodo', $request->numeroPeriodo)->first();

        if ($periodoExistente) {
            return redirect()->route('admin.index')->with('error', 'El período ingresado ya existe.');
        }

        $fechaInicio = \Carbon\Carbon::parse($request->periodoInicio);
        $fechaFin = \Carbon\Carbon::parse($request->periodoFin);

        $periodoInicio = strtoupper($fechaInicio->format('M')) . $fechaInicio->format('Y');
        $periodoFin = strtoupper($fechaFin->format('M')) . $fechaFin->format('y');

        $periodoAcademico = $periodoInicio . '-' . $periodoFin;

        Periodo::create([
            'Periodo' => $periodoAcademico,
            'PeriodoInicio' => $fechaInicio,
            'PeriodoFin' => $fechaFin,
            'numeroPeriodo' => $request->numeroPeriodo,
        ]);

        return redirect()->route('admin.index')->with('success', 'Periodo académico creado con éxito.');
    }

    public function editarPeriodo($id)
    {
        // Buscar el período académico por su ID
        $periodo = Periodo::find($id);

        if (!$periodo) {
            return redirect()->route('admin.index')->with('error', 'El período académico no existe.');
        }

        return view('admin.editarPeriodo', compact('periodo'));
    }

    public function actualizarPeriodo(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'periodoInicio' => 'required|date',
            'periodoFin' => 'required|date|after:periodoInicio',
            'numeroPeriodo' => 'unique:periodo|required',
        ], [
            'periodoInicio.required' => 'La fecha de inicio del período es requerida.',
            'periodoFin.required' => 'La fecha de fin del período es requerida.',
            'periodoFin.after' => 'La fecha de fin del período debe ser posterior a la fecha de inicio.',
            'numeroPeriodo.unique' => 'El codigo de período ya existe.',
        ]);

        $fechaInicio = \Carbon\Carbon::parse($request->periodoInicio);
        $fechaFin = \Carbon\Carbon::parse($request->periodoFin);

        $periodoInicio = strtoupper($fechaInicio->format('M')) . $fechaInicio->format('Y');
        $periodoFin = strtoupper($fechaFin->format('M')) . $fechaFin->format('y');

        $periodoAcademico = $periodoInicio . '-' . $periodoFin;

        $periodo = Periodo::find($id);

        $periodoExistente = Periodo::where('numeroPeriodo', $request->numeroPeriodo)->first();

        if ($periodoExistente) {
            return redirect()->route('admin.index')->with('error', 'El codigo de período ingresado ya existe.');
        }

        if (!$periodo) {
            return redirect()->route('admin.index')->with('error', 'El período académico no existe.');
        }

        $periodo->Periodo = $periodoAcademico;
        $periodo->PeriodoInicio = $fechaInicio;
        $periodo->PeriodoFin = $fechaFin;
        $periodo->numeroPeriodo = $request->numeroPeriodo;
        $periodo->save();

        return redirect()->route('admin.index')->with('success', 'Período académico actualizado con éxito.');
    }


    public function eliminarPeriodo(Request $request, $id)
    {
        $periodo = Periodo::find($id);


        if (!$periodo) {
            return redirect()->route('admin.index')->with('error', 'Periodo académico no encontrado.');
        }

        $periodo->delete();

        return redirect()->route('admin.index')->with('success', 'Periodo académico eliminado con éxito.');
    }



    //////guardar empresa////////////////
    public function agregarEmpresa(Request $request)
    {
        $elementosPorPagina = $request->input('elementosPorPagina');
        $empresas = Empresa::paginate($elementosPorPagina);

        return view('admin.agregarEmpresa', compact('empresas', 'elementosPorPagina'));
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
            return redirect()->route('admin.agregarEmpresa')->with('success', 'Empresa guardada exitosamente');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que ocurra durante el proceso y registra el error
            return redirect()
                ->route('coordinador.agregarEmpresa')
                ->with('error', 'Ocurrió un error al guardar la empresa: ' . $e->getMessage());
        }
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

    public function eliminarEmpresa($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return redirect()->back()->with('error', 'Empresa no encontrada.');
        }

        $empresa->delete();

        return redirect()->route('admin.agregarEmpresa')->with('success', 'Empresa eliminada exitosamente.');
    }
    ///editar empresa///////////////////

    public function editarEmpresa($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return redirect()->route('admin.agregarEmpresa')->with('error', 'Empresa no encontrada.');
        }

        return view('admin.editarEmpresa', compact('empresa'));
    }

    public function actualizarEmpresa(Request $request, $id)
    {
        try {
            $empresa = Empresa::find($id);

            if (!$empresa) {
                return redirect()->route('admin.agregarEmpresa')->with('error', 'Empresa no encontrada.');
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
            return redirect()->route('admin.agregarEmpresa')->with('success', 'Empresa actualizada exitosamente');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que ocurra durante el proceso y registra el error
            return redirect()
                ->route('admin.agregarEmpresa')
                ->with('error', 'Ocurrió un error al actualizar la empresa: ' . $e->getMessage());
        }
    }


    //////////////////////////PRACTICAS////////////////////////////////////////
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


        return view('admin.aceptarFaseI', compact('estudiantesConPracticaI', 'estudiantesPracticas', 'estudiantesConPracticaII', 'estudiantesPracticasII'));

    }

    public function actualizarEstadoEstudiante(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);


        $practica = PracticaI::where('EstudianteID', $id)->first();

        if (!$practica) {
            return redirect()->route('admin.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->Estado = $nuevoEstado;
        $practica->save();

        if ($nuevoEstado === 'En ejecucion') {
            return redirect()->route('admin.aceptarFaseI')->with('success', 'Práctica aprobada correctamente.');
        }

        // Si el nuevo estado es 'Negado', elimina la práctica
        if ($nuevoEstado === 'Negado') {
            $practica->delete();
            return redirect()->route('admin.index')->with('success', 'Práctica negada y eliminada correctamente.');
        }

        // Redirecciona de regreso con un mensaje de éxito
        return redirect()->route('admin.aceptarFaseI')->with('success', 'Estado de la práctica actualizado correctamente.');
    }

    public function actualizarEstadoEstudiante2(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);

        $practica = PracticaII::where('EstudianteID', $id)->first();

        if (!$practica) {
            return redirect()->route('admin.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->Estado = $nuevoEstado;
        $practica->save();

        if ($nuevoEstado === 'En ejecucion') {
            return redirect()->route('admin.aceptarFaseI')->with('success', 'Práctica II aprobada correctamente.');
        }

        if ($nuevoEstado === 'Negado') {
            $practica->delete();
            return redirect()->route('admin.index')->with('success', 'Práctica II negada y eliminada correctamente.');
        }

        return redirect()->route('admin.aceptarFaseI')->with('success', 'Estado de la Práctica II actualizado correctamente.');
    }

    /////////////////////////////////EDITAR EMPRESA DEL ESTUDIANTE
    public function editarNombreEmpresa($id)
    {
        $estudiante = Estudiante::find($id);
        $empresas = Empresa::all();



        return view('admin.editarNombreEmpresa', compact('estudiante', 'empresas'));
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
            return redirect()->route('admin.aceptarFaseI')->with('error', 'Práctica no encontrada.');
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

        return redirect()->route('admin.aceptarFaseI')->with('success', 'Empresa actualizado correctamente.');
    }



    ///////agregar nrc
    public function GuardarNRC(Request $request)
    {
        $request->validate([
            'nrc' => 'required|numeric|digits:5|unique:nrc_vinculacion,nrc',
            'periodo' => 'required|exists:periodo,id',
        ], [
            'nrc.required' => 'El NRC es obligatorio.',
            'nrc.numeric' => 'El NRC debe ser un número.',
            'nrc.digits' => 'El NRC debe tener exactamente 5 dígitos.',
            'nrc.unique' => 'El NRC ingresado ya existe.',
            'periodo.required' => 'El período es obligatorio.',
            'periodo.exists' => 'El período seleccionado no es válido.',
        ]);

        NrcVinculacion::create([
            'nrc' => $request->nrc,
            'id_periodo' => $request->periodo,
        ]);

        return redirect()->route('admin.index')->with('success', 'NRC guardado con éxito.');
    }



    ///////////////////////sacar resplado de BD y sistema
    public function backup()
    {
        // Ejecuta el comando de respaldo de la base de datos
        Artisan::call('backup:run');

        // Obtiene el nombre del último archivo de respaldo
        $backupFileName = collect(Storage::disk('local')->files('Laravel'))->last();

        // Verifica si se encontró un archivo de respaldo
        if ($backupFileName && Storage::disk('local')->exists('Laravel/' . $backupFileName)) {
            // Obtiene la ruta completa del archivo de respaldo
            $backupPath = Storage::disk('local')->path('Laravel/' . $backupFileName);

            // Envía el archivo adjunto por correo electrónico
            Mail::send([], [], function ($message) use ($backupPath, $backupFileName) {
                $message->to('sjflores2@espe.edu.ec')
                    ->subject('Archivo de respaldo')
                    ->attach($backupPath, ['as' => $backupFileName]);
            });

            // Elimina el archivo de respaldo temporal después de enviarlo por correo electrónico
            Storage::disk('local')->delete('Laravel/' . $backupFileName);
        } else {
            // Maneja el caso en el que el archivo de respaldo no existe
            // Puedes agregar un mensaje de error o registrar el evento
        }

        // Regresa a la página de inicio con un mensaje de éxito
        return redirect()->route('admin.index')->with('success', 'Respaldo de la base de datos creado y enviado por correo electrónico con éxito.');
    }


    ////////////////////////////cambiar credenciales
    public function cambiarCredencialesUsuario()
    {
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('UserID', $usuario->UserID)->get();

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        return view('admin.cambiarCredencialesUsuario', compact('usuario', 'userSessions'));
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

        return redirect()->route('admin.index')->with('success', 'Credenciales actualizadas exitosamente');
    }





}
