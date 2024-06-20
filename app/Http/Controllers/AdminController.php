<?php

namespace App\Http\Controllers;

use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Mail\EstudianteAprobado;
use App\Mail\EstudianteNegado;
use App\Models\AsignacionProyecto;
use App\Models\Empresa;
use App\Models\Role;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;





use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

use App\Models\Periodo;

use App\Models\ProfesUniversidad;
use Illuminate\Support\Facades\Mail;
use App\Models\EstudiantesVinculacion;
use Illuminate\Support\Facades\Auth;


use App\Models\NrcVinculacion;
use App\Models\UsuariosSession;
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

            if ($role && $role->tipo === 'Administrador') {

                $searchTerm = $request->input('search');

                $query = ProfesUniversidad::query();

                if ($searchTerm) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('apellidos', 'like', "%{$searchTerm}%")
                            ->orWhere('nombres', 'like', "%{$searchTerm}%")
                            ->orWhere('correo', 'like', "%{$searchTerm}%")
                            ->orWhere('usuario', 'like', "%{$searchTerm}%")
                            ->orWhere('Cedula', 'like', "%{$searchTerm}%")
                            ->orWhere('departamento', 'like', "%{$searchTerm}%");
                    });
                }

                $profesores = $query->paginate($perPage);

                $periodos = Periodo::all();
                $profesorRoleId = Role::where('tipo', 'Vinculacion')->value('id');


                $profesoresPendientes = Usuario::where('role_id', $profesorRoleId)->get();

                // Consulta para obtener los profesores con permisos
                $profesoresConPermisos = Usuario::where('role_id', $profesorRoleId)
                    ->whereIn('estado', ['Vinculacion', 'Practicas', 'Director-Departamento'])
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

        $usuario->estado = $request->input('Estado');
        $usuario->contrasena = bcrypt($request->input('password'));
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
        if (in_array($usuario->estado, ['Vinculacion', 'Director-Departamento', 'Director-Carrera'])) {
            // Cambia el estado del usuario a 'Negado'
            $usuario->estado = 'Pendiente';
            $usuario->save();

            return redirect()->route('admin.index')->with('success', 'Permiso eliminado correctamente');
        } elseif ($usuario->estado === 'Pendiente') {
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

        $search2 = $request->input('search2');

        // Consulta para estudiantes en revisión
        $queryEstudiantesEnRevision = Estudiante::where('estado', 'En proceso de revisión')
            ->orderBy('nombres', 'asc');

        // Búsqueda de estudiantes en revisión
        if ($request->has('buscarEstudiantesEnRevision')) {
            $busquedaEstudiantesEnRevision = $request->input('buscarEstudiantesEnRevision');
            $queryEstudiantesEnRevision->where(function ($query) use ($busquedaEstudiantesEnRevision) {
                $query->where('nombres', 'like', '%' . $busquedaEstudiantesEnRevision . '%')
                    ->orWhere('apellidos', 'like', '%' . $busquedaEstudiantesEnRevision . '%');
            });
        }

        $estudiantesEnRevision = $queryEstudiantesEnRevision->get();

        // Consulta y paginación para estudiantes aprobados
        $queryEstudiantesAprobados = Estudiante::whereIn('estado', ['Aprobado', 'Aprobado-prácticas', 'Desactivados']);

        // Búsqueda de estudiantes aprobados
        if ($request->has('search2')) {
            $busquedaEstudiantesAprobados = $request->input('search2');
            $queryEstudiantesAprobados->where(function ($query) use ($busquedaEstudiantesAprobados) {
                $query->where('nombres', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('apellidos', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('espeId', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('celular', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('Cohorte', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('correo', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('departamento', 'like', '%' . $busquedaEstudiantesAprobados . '%');
            });
        }

        $estudiantesAprobados = $queryEstudiantesAprobados->paginate($elementosPorPaginaAprobados); // Cambio de nombre

        // Verificar si no se encontraron resultados para la búsqueda de estudiantes de vinculación

        return view('admin.aceptacionEstudiantes', [
            'estudiantesEnRevision' => $estudiantesEnRevision,
            'estudiantesAprobados' => $estudiantesAprobados,
            'elementosPorPagina' => $elementosPorPagina,
            'elementosPorPaginaAprobados' => $elementosPorPaginaAprobados,
            'search2' => $search2,
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
        $estudiante->estado = $nuevoEstado;
        $estudiante->save();

        // Envía el correo electrónico correspondiente al estado del estudiante
        $usuario = $estudiante->usuario;

        if ($usuario) {
            $email = $usuario->correoElectronico;

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
        $departamento = $request->input('departamento');
        $profesorId = $request->input('profesor');
        $periodoId = $request->input('periodos');

        $periodos = Periodo::all();
        $nrcs = NrcVinculacion::all();
        $profesores = ProfesUniversidad::whereDoesntHave('proyectosDirigidos')->get();



        $perPage = $request->input('perPage', 10);
        $perPage2 = $request->input('perPage2', 10);
        $page = $request->input('page', 1);
        $page2 = $request->input('page2', 1);
        $search = $request->input('search');
        $search2 = $request->input('search2');


        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        $query = Proyecto::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombreProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('descripcionProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('estado', 'LIKE', '%' . $search . '%')
                    ->orWhere('departamentoTutor', 'LIKE', '%' . $search . '%')
                    ->orWhere('codigoProyecto', 'LIKE', '%' . $search . '%');
            });
        }

        if ($estadoProyecto) {
            $query->where('estado', $estadoProyecto);
        }

        if ($departamento) {
            $query->where('departamentoTutor', $departamento);
        }

        $proyectos = $query->paginate($perPage, ['*'], 'page', $page);



        $proyectosDisponibles = Proyecto::where('estado', 'Ejecucion')->get();
        $estudiantesAprobados = Estudiante::where('estado', 'Aprobado')
            ->whereDoesntHave('asignaciones')
            ->get();

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


            ->when($search2, function ($query, $search2) {
                return $query->where(function ($query) use ($search2) {
                    $query->whereHas('estudiante', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                              ->orWhere('apellidos', 'like', "%{$search2}%")
                              ->orWhere('espeId', 'like', "%{$search2}%")
                              ->orWhere('cedula', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('proyecto', function ($query) use ($search2) {
                        $query->where('nombreProyecto', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('docenteParticipante', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                              ->orWhere('apellidos', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('periodo', function ($query) use ($search2) {
                        $query->where('numeroPeriodo', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('proyecto.director', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                              ->orWhere('apellidos', 'like', "%{$search2}%");
                    });
                });
            })

            ->get()
            ->groupBy(function ($item) {
                return $item->proyectoId . '_' . $item->idPeriodo . "_" . $item->participanteId;
            });

        $total = $asignacionesAgrupadas->count();
    $paginatedData = $asignacionesAgrupadas->forPage($request->input('page2', 1), $request->input('perPage2', 10));
    $paginator = new LengthAwarePaginator(
        $paginatedData,
        $total,
        $request->input('perPage2', 10),
        $request->input('page2', 1),
        ['path' => route('admin.indexProyectos'), 'pageName' => 'page2']
    );
        return view('admin.indexProyectos', [
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
            'search2' => $search2,
            'estadoProyecto' => $estadoProyecto,
            'profesorId' => $profesorId,
            'periodoId' => $periodoId,
            'paginatedData' => $paginatedData,
            'total' => $total
        ]);
        if ($estadoProyecto) {
            $query->where('estado', $estadoProyecto);
        }

        if ($profesorId) {
            $query->whereHas('director', function ($q) use ($profesorId) {
                $q->where('id', $profesorId);
            });
        }

        if ($periodoId) {
            $query->whereHas('periodo', function ($q) use ($periodoId) {
                $q->where('id', $periodoId);
            });
        }

        $proyectos = $query->paginate($perPage, ['*'], 'page', $page);

        if ($request->ajax()) {
            if ($request->has('search2')) {
                return response()->json([
                    'html' => view('partials.tablaAsignaciones', compact('asignacionesAgrupadas', 'paginator'))->render()
                ]);
            } else {
                return response()->json([
                    'html' => view('partials.tablaProyectos', compact('proyectos'))->render()
                ]);
            }
        }
    
        return view('admin.indexProyectos', compact('proyectos', 'periodos', 'nrcs', 'profesores', 'asignacionesAgrupadas', 'paginator'));
    }


    ///////////////////////Vista para crear los proyectos////////////////////

    public function crearProyectoForm()
    {
        $profesores = ProfesUniversidad::all();

        return view('admin.agregarProyecto', compact('profesores'));
    }


    /////////////////////////////guardar proyectos//////////////////////////////



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
                'directorId' => $validatedData['DirectorProyecto'],
                'nombreProyecto' => $validatedData['NombreProyecto'],
                'descripcionProyecto' => $validatedData['DescripcionProyecto'],
                'departamentoTutor' => $validatedData['DepartamentoTutor'],
                'codigoProyecto' => $validatedData['codigoProyecto'],
                'estado' => $validatedData['Estado'],
                'inicioFecha' => $validatedData['FechaInicio'],
                'finFecha' => $validatedData['FechaFinalizacion'],
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

        $proyecto->directorId = $validatedData['DirectorProyecto'];
        $proyecto->nombreProyecto = $validatedData['NombreProyecto'];
        $proyecto->descripcionProyecto = $validatedData['DescripcionProyecto'];
        $proyecto->departamentoTutor = $validatedData['DepartamentoTutor'];
        $proyecto->codigoProyecto = $validatedData['codigoProyecto'];
        $proyecto->inicioFecha = $validatedData['FechaInicio'];
        $proyecto->finFecha = $validatedData['FechaFinalizacion'];
        $proyecto->estado = $validatedData['Estado'];
        $proyecto->save();

        $this->actualizarUsuarioYRol($validatedData['DirectorProyecto'], 'DirectorVinculacion');

        return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto actualizado correctamente');
    }

    ////////////////////////va con editar
    private function actualizarUsuarioYRol($profesorId, $tipoRol)
    {
        $profesor = ProfesUniversidad::findOrFail($profesorId);
        $rolId = Role::where('tipo', $tipoRol)->value('id');

        $usuario = Usuario::where('correoElectronico', $profesor->correo)->first();

        if (!$usuario) {
            Usuario::create([
                'nombreUsuario' => $profesor->usuario,
                'correoElectronico' => $profesor->correo,
                'contrasena' => bcrypt('123'),
                'estado' => 'activo',
                'role_id' => $rolId,
            ]);
        } else {
            if ($usuario->role_id != $rolId) {
                $usuario->role_id = $rolId;
                $usuario->save();
            }
        }

        //////actualizar el UserID de ProfesUniversidad con el ID de Usuario creado
        $profesor->userId = Usuario::where('correoElectronico', $profesor->correo)->value('userId');
        $profesor->save();
    }

    /////eliminar proyecto
    public function deleteProyecto($ProyectoID)
    {
        // Buscar el proyecto por ID
        $proyecto = Proyecto::findOrFail($ProyectoID);

        // Verificar si el Estado del proyecto es "Ejecucion"
        if ($proyecto->estado === 'Ejecucion') {
            return redirect()->route('admin.indexProyectos')->with('error', 'No puedes eliminar un proyecto en estado de ejecución');
        }

        // Obtener todas las asignaciones relacionadas con el proyecto
        $asignaciones = AsignacionProyecto::where('proyectoId', $ProyectoID)->get();

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
                'proyectoId' => $request->proyecto_id,
                'estudianteId' => $estudianteID,
                'participanteId' => $request->ProfesorParticipante,
                'asignacionFecha' => now(),
                'idPeriodo' => $nrc->idPeriodo,
                'nrc' => $request->nrc,
                'inicioFecha' => $request->FechaInicio,
                'finalizacionFecha' => $request->FechaFinalizacion,
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
                'correo' => 'required|email|unique:profesuniversidad,correo',
                'cedula' => 'required|digits:10|unique:profesuniversidad,cedula',
                'departamento' => 'required',
                'espe_id' => 'required|unique:profesuniversidad,espeId',
            ], [
                'correo.unique' => 'El correo electrónico ya está en uso.',
                'cedula.unique' => 'La cédula ya está en uso.',
                'espe_id.unique' => 'El ID de la especialidad ya está en uso.',
            ]);

            $usuario = explode('@', $request->correo)[0];
            ProfesUniversidad::create([
                'nombres' => $request->nombres,
                'usuario' => $usuario,
                'apellidos' => $request->apellidos,
                'correo' => $request->correo,
                'cedula' => $request->cedula,
                'departamento' => $request->departamento,
                'espeId' => $request->espe_id,
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

            $proyectosRelacionados = Proyecto::where('directorId', $maestro->id)
                ->orWhere('directorId', $maestro->id)
                ->get();

            $participante = AsignacionProyecto::where('participanteId', $maestro->id)->first();

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
                'departamento' => 'required',

            ]);


            $maestro = ProfesUniversidad::find($id);

            if (!$maestro) {
                return redirect()->route('admin.index')->with('error', 'Maestro no encontrado.');
            }

            $maestro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,

                'departamento' => $request->departamento,
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
            'periodo' => $periodoAcademico,
            'inicioPeriodo' => $fechaInicio,
            'finPeriodo' => $fechaFin,
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

        $periodo->periodo = $periodoAcademico;
        $periodo->inicioPeriodo = $fechaInicio;
        $periodo->finPeriodo = $fechaFin;
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
        $search = $request->input('search');

        $empresas = Empresa::when($search, function ($query, $search) {
            return $query->where('nombreEmpresa', 'like', '%' . $search . '%')
                ->orWhere('rucEmpresa', 'like', '%' . $search . '%')
                ->orWhere('provincia', 'like', '%' . $search . '%')
                ->orWhere('ciudad', 'like', '%' . $search . '%')
                ->orWhere('direccion', 'like', '%' . $search . '%')
                ->orWhere('correo', 'like', '%' . $search . '%')
                ->orWhere('nombreContacto', 'like', '%' . $search . '%')
                ->orWhere('telefonoContacto', 'like', '%' . $search . '%')
                ->orWhere('actividadesMacro', 'like', '%' . $search . '%')
                ->orWhere('cuposDisponibles', 'like', '%' . $search . '%');
        })->paginate($elementosPorPagina);

        return view('admin.agregarEmpresa', compact('empresas', 'elementosPorPagina', 'search'));
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


    public function aceptarFasei(Request $request)
    {

        $search = $request->input('search');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');
        $search4 = $request->input('search4');



        $perPage1 = $request->input('paginacion1', 10);
        $perPage2 = $request->input('paginacion2', 10);
        $perPage3 = $request->input('paginacion3', 10);
        $perPage4 = $request->input('paginacion4', 10);

        $estudiantesConPracticaI = PracticaI::with('estudiante')
            ->where('estado', 'PracticaI')
            ->get();

        $estudiantesConPracticaII = PracticaII::with('estudiante')
            ->where('estado', 'PracticaII')
            ->get();

        $estudiantesPracticas = PracticaI::with('estudiante')
            ->where(function ($query) use ($search) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
            })
            ->where(function ($query) use ($search) {

                $query->where('estudianteId', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search) {
                        $query->where('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search) {
                        $query->where('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhere('idEmpresa', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('empresa', function ($query) use ($search) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search . '%');
                    });

            })
            ->paginate($perPage1, ['*'], 'page1');

        $estudiantesPracticasII = PracticaII::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })

            ->where(function ($query) use ($search2) {

                $query->where('EstudianteID', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search2) {
                        $query->where('nombres', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search2 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search2) {
                        $query->where('nombres', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search2 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search2) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search2 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search2 . '%');
                    });

            })
            ->paginate($perPage2, ['*'], 'page2');

        $estudiantesPracticasIII = PracticaIII::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
            })
            ->where(function ($query) use ($search3) {

                $query->where('EstudianteID', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search3) {
                        $query->where('nombres', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search3 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search3) {
                        $query->where('nombres', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search3 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search3) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search3 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search3 . '%');
                    });

            })
            ->paginate($perPage3, ['*'], 'page3');

        $estudiantesPracticasIV = PracticaIV::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })
            ->where(function ($query) use ($search4) {

                $query->where('EstudianteID', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search4) {
                        $query->where('nombres', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search4 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search4) {
                        $query->where('nombres', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search4 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search4) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search4 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search4 . '%');
                    });

            })
            ->paginate($perPage4, ['*'], 'page4');

        $estudiantesPracticasV = PracticaV::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })
            ->get();

        return view(
            'admin.aceptarFaseI',
            compact(
                'estudiantesConPracticaI',
                'estudiantesPracticas',
                'estudiantesConPracticaII',
                'estudiantesPracticasII',
                'estudiantesPracticasIII',
                'estudiantesPracticasIV',
                'estudiantesPracticasV',
                'perPage1',
                'perPage2',
                'perPage3',
                'perPage4',
                'search',
                'search2',
                'search3',
                'search4'

            )
        );
    }


    //////////////////////////////////PRACTICAS//////////////////////////////////////////


    public function actualizarEstadoEstudiante(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);


        $practica = PracticaI::where('estudianteId', $id)->first();

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

        $practica = PracticaII::where('estudianteId', $id)->first();

        if (!$practica) {
            return redirect()->route('admin.aceptarFaseI')->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->estado = $nuevoEstado;
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
            'nrc' => 'required|numeric|digits:5|unique:nrc,nrc',
            'periodo' => 'required|exists:periodo,id',
            'tipo' => 'required',
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
            'idPeriodo' => $request->periodo,
            'tipo' => $request->tipo,
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
    public function cambiarCredencialesUsuario(Request $request)
    {
        $paginacion = 10;
        $usuario = Auth::user();

        // Obtener las sesiones del usuario paginadas
        $userSessions = UsuariosSession::where('userId', $usuario->userId)->paginate($paginacion);

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        $perPage = $request->input('perPage', 10); // Obtener el valor de perPage del request o usar un valor por defecto

        return view('admin.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'perPage'));
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

        $usuario->correoElectronico = $request->email;
        $usuario->nombreUsuario = $request->nombre;
        $usuario->contrasena = bcrypt($request->password);

        $usuario->save();

        return redirect()->route('admin.index')->with('success', 'Credenciales actualizadas exitosamente');
    }





}
