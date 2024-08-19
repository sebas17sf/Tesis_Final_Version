<?php

namespace App\Http\Controllers;

use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use Illuminate\Support\Facades\DB;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Mail\EstudianteAprobado;
use App\Mail\EstudianteNegado;
use App\Models\AsignacionProyecto;
use App\Models\Empresa;
use App\Models\Role;
use App\Models\Departamento;
use App\Models\ActividadEstudiante;
use ZipArchive;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Mail\AsignacionProyectoMailable;








use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

use App\Models\Periodo;

use App\Models\ProfesUniversidad;
use Illuminate\Support\Facades\Mail;
use App\Models\EstudiantesVinculacion;
use App\Models\AsignacionSinEstudiante;
use Illuminate\Support\Facades\Auth;


use App\Models\NrcVinculacion;
use App\Models\UsuariosSession;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $roles = Role::whereIn('tipo', ['Administrador', 'Vinculacion', 'Practicas', 'Director-Departamento'])->get();
        $departamentos = Departamento::all();
        $profesoresVerificar = Usuario::where('estado', 'En verificación')->get();

        $perPage = $request->input('perPage', 10);
        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        if (Auth::check()) {
            $user = Auth::user();
            $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

            if ($role && $role === 'Administrador') {

                $searchTerm = $request->input('search');
                $filtroDepartamento = $request->input('departamentos');

                $query = ProfesUniversidad::query();

                // Filtro de búsqueda general
                if ($searchTerm) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('apellidos', 'like', "%{$searchTerm}%")
                            ->orWhere('nombres', 'like', "%{$searchTerm}%")
                            ->orWhere('correo', 'like', "%{$searchTerm}%")
                            ->orWhere('usuario', 'like', "%{$searchTerm}%")
                            ->orWhere('Cedula', 'like', "%{$searchTerm}%")
                            ->orWhereHas('departamento', function ($query) use ($searchTerm) {
                                $query->where('departamento', 'LIKE', '%' . $searchTerm . '%');
                            });
                    });
                }

                // Filtrado por departamento
                if ($filtroDepartamento) {
                    $query->whereHas('departamento', function ($q) use ($filtroDepartamento) {
                        $q->where('departamento', 'like', "%{$filtroDepartamento}%");
                    });
                }

                // Obtener todos los estados de los profesores con sus usuarios relacionados
                $estadoProfesores = ProfesUniversidad::with('usuarios')->get();

                // Paginación de los profesores
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
                    'profesoresVerificar' => $profesoresVerificar,
                    'estadoProfesores' => $estadoProfesores,
                    'filtroDepartamento' => $filtroDepartamento,
                    'departamentos' => $departamentos,
                    'roles' => $roles,
                ]);
            }
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function getRoleAdministrativo($userId)
    {
        $profesor = ProfesUniversidad::with('usuarios')
            ->where('userId', $userId)
            ->first();

        if ($profesor && $profesor->usuarios->role_id_administrativo) {
            $roleAdministrativo = DB::table('roles')
                ->where('id', $profesor->usuarios->role_id_administrativo)
                ->value('tipo');

            return response()->json([
                'nombres' => $profesor->nombres,
                'apellidos' => $profesor->apellidos,
                'roleAdministrativo' => $roleAdministrativo
            ]);
        } else {
            return response()->json([
                'nombres' => $profesor->nombres,
                'apellidos' => $profesor->apellidos,
                'roleAdministrativo' => null
            ]);
        }
    }

    public function assignRoleAdministrativo(Request $request, $userId)
    {
        try {
            $request->validate([
                'role_id_administrativo' => 'required|exists:roles,id',
            ]);


            $user = Usuario::findOrFail($userId);
            $user->role_id_administrativo = $request->role_id_administrativo;
            $user->save();

            return redirect()->route('admin.index')->with('success', 'Rol administrativo asignado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al asignar el rol administrativo.');
        }
    }

    public function removeRoleAdministrativo($userId)
    {
        try {
            $user = Usuario::findOrFail($userId);
            $user->role_id_administrativo = null;
            $user->save();

            return redirect()->back()->with('success', 'Rol administrativo eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el rol administrativo.');
        }
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

        return redirect()->route('admin.index')->with('success', 'Estado actualizado.');
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

        return redirect()->route('admin.index')->with('success', 'Docente eliminado.');
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

            return redirect()->route('admin.index')->with('success', 'Permiso eliminado.');
        } elseif ($usuario->estado === 'Pendiente') {
            // Si el estado ya es 'Negado', elimina el usuario
            $usuario->delete();

            return redirect()->route('admin.index')->with('success', 'Usuario eliminado.');
        } else {
            return redirect()->route('admin.index')->with('error', 'No se puede eliminar el permiso de este usuario');
        }
    }




    ///////////////Aceptacion de estudiantes para el proceso de vinculacion/////////////////////////////////////
    public function estudiantes(Request $request)
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $periodos = Periodo::orderBy('inicioPeriodo', 'asc')->get();

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
            })
                ->orderBy('apellidos', 'asc');
        }

        if ($request->has('Departamento') && $request->input('Departamento')) {
            $departamento = $request->input('Departamento');
            $queryEstudiantesAprobados->where('departamento', $departamento);
        }

        if ($request->has('periodos') && $request->input('periodos')) {
            $periodo = $request->input('periodos');
            $queryEstudiantesAprobados->where('Cohorte', $periodo);
        }




        $estudiantesAprobados = $queryEstudiantesAprobados->paginate($elementosPorPaginaAprobados); // Cambio de nombre

        // Verificar si no se encontraron resultados para la búsqueda de estudiantes de vinculación

        return view('admin.aceptacionEstudiantes', [
            'estudiantesEnRevision' => $estudiantesEnRevision,
            'estudiantesAprobados' => $estudiantesAprobados,
            'elementosPorPagina' => $elementosPorPagina,
            'elementosPorPaginaAprobados' => $elementosPorPaginaAprobados,
            'search2' => $search2,
            'periodos' => $periodos,
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

        return redirect()->route('admin.estudiantes')->with('success', 'Estado del estudiante actualizado..');
    }







    /////////////////////////////visualizar proyectos

    public function indexProyectos(Request $request)
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $todoslosProfesores = ProfesUniversidad::all();

        $estadoProyecto = $request->input('estado');
        $departamento = $request->input('departamento');
        $profesorId = $request->input('profesor');
        $periodoId = $request->input('periodos');

        $periodos = Periodo::all();


        $nrcs = NrcVinculacion::where('tipo', 'Vinculacion')->get();


        $profesores = ProfesUniversidad::whereDoesntHave('proyectosDirigidos')
            ->orWhereHas('proyectosDirigidos', function ($query) {
                $query->where('estado', 'Terminado');
            })
            ->orderBy('apellidos', 'asc')
            ->get();

        ///obtener los periodos que tengan fecha de inicio y fin con la fecha actual
        $periodoAsignacion = Periodo::where('inicioPeriodo', '<=', now())
            ->where('finPeriodo', '>=', now())
            ->get();


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
                    ->orWhere('codigoProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('director', function ($query) use ($search) {
                        $query->where('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('departamento', function ($query) use ($search) {
                        $query->where('departamento', 'LIKE', '%' . $search . '%');
                    });
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
            'total' => $total,
            'periodoAsignacion' => $periodoAsignacion,
            'todoslosProfesores' => $todoslosProfesores,
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
            'total' => $total,
            'periodoAsignacion' => $periodoAsignacion,
            'todoslosProfesores' => $todoslosProfesores,
        ]);

    }


    ///////////////////////Vista para crear los proyectos////////////////////

    public function crearProyectoForm()
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $profesores = ProfesUniversidad::all();
        $departamentos = Departamento::all();

        return view('admin.agregarProyecto', compact('profesores', 'departamentos'));
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
                'departamentoId' => $validatedData['DepartamentoTutor'],
                'codigoProyecto' => $validatedData['codigoProyecto'],
                'estado' => $validatedData['Estado'],
                'inicioFecha' => $validatedData['FechaInicio'],
                'finFecha' => $validatedData['FechaFinalizacion'],
            ]);

            $this->actualizarUsuarioYRol($validatedData['DirectorProyecto'], 'DirectorVinculacion');

            $proyecto->save();


            return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto agregado.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear el proyecto: ' . $e->getMessage());
        }
    }




    ///////////////editar proyecto
    public function editProyectoForm($ProyectoID)
    {

        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $nrcs = NrcVinculacion::all();

        $profesores = ProfesUniversidad::all();

        $departamentos = Departamento::all();

        $proyecto = Proyecto::findOrFail($ProyectoID);
        return view('admin.editarProyecto', compact('proyecto', 'nrcs', 'profesores', 'departamentos'));
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
        $proyecto->departamentoId = $validatedData['DepartamentoTutor'];
        $proyecto->codigoProyecto = $validatedData['codigoProyecto'];
        $proyecto->inicioFecha = $validatedData['FechaInicio'];
        $proyecto->finFecha = $validatedData['FechaFinalizacion'];
        $proyecto->estado = $validatedData['Estado'];
        $proyecto->save();

        $this->actualizarUsuarioYRol($validatedData['DirectorProyecto'], 'DirectorVinculacion');

        return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto actualizado.');
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



        // Eliminar el proyecto
        $proyecto->delete();

        return redirect()->route('admin.indexProyectos')->with('success', 'Proyecto y asignaciones relacionadas eliminados.');
    }
    ///////asignar proyecto a estudiante/////////////

    public function guardarAsignacion(Request $request)
    {
        // Validación de datos
        $request->validate([
            'proyecto_id' => 'required',
            'estudiante_id' => '',
            'estudiante_id.*' => 'numeric',
            'ProfesorParticipante' => 'required',
            'nrc' => 'required',
            'FechaInicio' => 'required',
            'FechaFinalizacion' => 'required',
        ]);

        $nrc = NrcVinculacion::where('id', $request->nrc)->first();

        if (!empty($request->estudiante_id)) {
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
                    'estado' => 'En ejecucion',
                ]);
            }
        } else {
            AsignacionProyecto::create([
                'proyectoId' => $request->proyecto_id,
                'estudianteId' => null,
                'participanteId' => $request->ProfesorParticipante,
                'asignacionFecha' => now(),
                'idPeriodo' => $nrc->idPeriodo,
                'nrc' => $request->nrc,
                'inicioFecha' => $request->FechaInicio,
                'finalizacionFecha' => $request->FechaFinalizacion,
                'estado' => 'En ejecucion',
            ]);
        }
        $this->actualizarUsuarioYRol($request->ProfesorParticipante, 'ParticipanteVinculacion');

        $proyecto = Proyecto::with('director')->find($request->proyecto_id);
        $directorEmail = $proyecto->director->correo;

        /////obtener los estudiantes asignados al proyecto con estado aprobado
        $estudiantesAsignados = Estudiante::whereIn('estudianteId', $request->estudiante_id)->get();
        if (filter_var($directorEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($directorEmail)->send(new AsignacionProyectoMailable($proyecto, $estudiantesAsignados));
        }


        return redirect()->route('admin.indexProyectos')->with('success', 'Asignación realizada.');

    }



    /////////////////////////////////////////////////asignacion sin estudiantes///////////////////////////////////////////////////////////////////////
    public function guardarDocentesProyectos(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required',
            'ProfesorParticipante' => 'required',
            'periodo' => 'required',
            'FechaInicio' => 'required|date',
            'FechaFinalizacion' => 'required|date|after:FechaInicio',
        ], [
            'FechaFinalizacion.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio',
        ]);

        AsignacionSinEstudiante::create([
            'proyectoId' => $request->proyecto_id,
            'participanteId' => $request->ProfesorParticipante,
            'idPeriodo' => $request->periodo,
            'inicioFecha' => $request->FechaInicio,
            'finalizacionFecha' => $request->FechaFinalizacion,
        ]);

        $this->actualizarUsuarioYRol($request->ProfesorParticipante, 'ParticipanteVinculacion');

        return back()->with('success', 'Asignación realizada.');
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
                'departamentoId' => $request->departamento,
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

            return redirect()->route('admin.index')->with('success', 'Docente eliminado.');
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

                'departamentoId' => $request->departamento,
            ]);

            return redirect()->route('admin.index')->with('success', 'Docente actualizado.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo actualizar el docente. Por favor, verifica los datos e intenta de nuevo.');
        }
    }

    //////////////////////////////guardar periodo
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
            return back()->with('error', 'El período ingresado ya existe.');
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

        return back()->with('success', 'Periodo académico creado.');
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

    /////////////////////////editar periodo////////////////////////

    public function actualizarPeriodo(Request $request, $id)
    {
        $request->validate([
            'periodoInicio' => 'required|date',
            'periodoFin' => 'required|date|after:periodoInicio',
            'numeroPeriodo' => ' required',
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

        if (!$periodo) {
            return back()->with('error', 'El período académico no existe.');
        }

        $periodoExistente = Periodo::where('numeroPeriodo', $request->numeroPeriodo)->first();

        if ($periodoExistente && $periodoExistente->id != $id) {
            return back()->with('error', 'El codigo de período ingresado ya existe.');
        }

        $periodo->periodo = $periodoAcademico;
        $periodo->inicioPeriodo = $fechaInicio;
        $periodo->finPeriodo = $fechaFin;
        $periodo->numeroPeriodo = $request->numeroPeriodo;
        $periodo->save();

        return back()->with('success', 'Período académico actualizado.');
    }



    public function eliminarPeriodo(Request $request, $id)
    {
        $periodo = Periodo::find($id);


        if (!$periodo) {
            return redirect()->route('admin.index')->with('error', 'Periodo académico no encontrado.');
        }

        $periodo->delete();

        return redirect()->route('admin.index')->with('success', 'Periodo académico eliminado.');
    }



    //////guardar empresa////////////////
    public function agregarEmpresa(Request $request)
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

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
                ->route('admin.agregarEmpresa')
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
        try {
            $empresa = Empresa::find($id);

            if (!$empresa) {
                return redirect()->back()->with('error', 'Empresa no encontrada.');
            }

            $empresa->delete();

            return redirect()->route('admin.agregarEmpresa')->with('success', 'Empresa eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se puede eliminar la empresa. ');
        }
    }

    ///editar empresa///////////////////

    public function editarEmpresa($id)
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

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
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $todosLosDocentes = ProfesUniversidad::all();
        $todasLasEmpresas = Empresa::all();
        $todosLosPeriodos = Periodo::orderBy('inicioPeriodo', 'asc')->get();



        $search = $request->input('search');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');
        $search4 = $request->input('search4');






        $perPage1 = $request->input('paginacion1', 10);
        $perPage2 = $request->input('paginacion2', 10);
        $perPage3 = $request->input('paginacion3', 10);
        $perPage4 = $request->input('paginacion4', 10);

        $estudiantesConPracticaI = PracticaI::with(['estudiante', 'tutorAcademico', 'empresa', 'nrc'])
            ->where('Estado', 'PracticaI')
            ->whereNotIn('Estado', ['Reprobado'])
            ->get();




        $estudiantesConPracticaII = PracticaII::with('estudiante')
            ->where('estado', 'PracticaII')
            ->get();



        $docente1 = $request->input('profesor');
        $empresa1 = $request->input('empresa');
        $periodo1 = $request->input('periodos');

        $estudiantesPracticas = PracticaI::with(['estudiante', 'tutorAcademico', 'empresa', 'nrc'])
            ->where(function ($query) use ($search) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado')
                    ->orWhere('Estado', 'Reprobado');
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
            });

        if ($docente1) {
            $estudiantesPracticas->whereHas('tutorAcademico', function ($query) use ($docente1) {
                $query->where('nombres', 'LIKE', '%' . $docente1 . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $docente1 . '%');
            });
        }

        if ($empresa1) {
            $estudiantesPracticas->whereHas('empresa', function ($query) use ($empresa1) {
                $query->where('nombreEmpresa', 'LIKE', '%' . $empresa1 . '%');
            });
        }

        if ($periodo1) {
            $estudiantesPracticas->where('periodoPractica', 'LIKE', '%' . $periodo1 . '%');
        }

        $estudiantesPracticas = $estudiantesPracticas->paginate($perPage1, ['*'], 'page1');




        $docente2 = $request->input('profesor2');
        $empresa2 = $request->input('empresa2');
        $periodo2 = $request->input('periodos2');

        $estudiantesPracticasII = PracticaII::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
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
            });

        if ($docente2) {
            $estudiantesPracticasII->whereHas('tutorAcademico', function ($query) use ($docente2) {
                $query->where('nombres', 'LIKE', '%' . $docente2 . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $docente2 . '%');
            });
        }

        if ($empresa2) {
            $estudiantesPracticasII->whereHas('empresa', function ($query) use ($empresa2) {
                $query->where('nombreEmpresa', 'LIKE', '%' . $empresa2 . '%');
            });
        }

        if ($periodo2) {
            $estudiantesPracticasII->where('periodoPractica', 'LIKE', '%' . $periodo2 . '%');
        }

        $estudiantesPracticasII = $estudiantesPracticasII->paginate($perPage2, ['*'], 'page2');


        $docente3 = $request->input('profesor3');
        $empresa3 = $request->input('empresa3');
        $periodo3 = $request->input('periodos3');


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

            });

        if ($docente3) {
            $estudiantesPracticasIII->whereHas('tutorAcademico', function ($query) use ($docente3) {
                $query->where('nombres', 'LIKE', '%' . $docente3 . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $docente3 . '%');
            });
        }

        if ($empresa3) {
            $estudiantesPracticasIII->whereHas('empresa', function ($query) use ($empresa3) {
                $query->where('nombreEmpresa', 'LIKE', '%' . $empresa3 . '%');
            });
        }

        if ($periodo3) {
            $estudiantesPracticasIII->where('periodoPractica', 'LIKE', '%' . $periodo3 . '%');
        }

        $estudiantesPracticasIII = $estudiantesPracticasIII->paginate($perPage3, ['*'], 'page3');



        $docente4 = $request->input('profesor4');
        $empresa4 = $request->input('empresa4');
        $periodo4 = $request->input('periodos4');



        $estudiantesPracticasIV = PracticaIV::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
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

            });

        if ($docente4) {
            $estudiantesPracticasIV->whereHas('tutorAcademico', function ($query) use ($docente4) {
                $query->where('nombres', 'LIKE', '%' . $docente4 . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $docente4 . '%');
            });
        }

        if ($empresa4) {
            $estudiantesPracticasIV->whereHas('empresa', function ($query) use ($empresa4) {
                $query->where('nombreEmpresa', 'LIKE', '%' . $empresa4 . '%');
            });
        }

        if ($periodo4) {
            $estudiantesPracticasIV->where('periodoPractica', 'LIKE', '%' . $periodo4 . '%');
        }

        $estudiantesPracticasIV = $estudiantesPracticasIV->paginate($perPage4, ['*'], 'page4');


        $estudiantesPracticasV = PracticaV::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
            })
            ->get();

        $nrcs = NrcVinculacion::all();
        $periodos = Periodo::all();


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
                'search4',
                'nrcs',
                'periodos',
                'todosLosDocentes',
                'todasLasEmpresas',
                'todosLosPeriodos'

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

        // Encuentra la práctica del estudiante
        $practica = PracticaI::where('estudianteId', $id)
            ->where('Estado', '!=', 'Reprobado')
            ->first();

        if (!$practica) {
            return back()->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado usando update()
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->update(['Estado' => $nuevoEstado]);

        // Maneja las redirecciones según el estado seleccionado
        if ($nuevoEstado === 'En ejecucion') {
            return back()->with('success', 'Práctica aprobada.');
        } elseif ($nuevoEstado === 'Negado') {
            $practica->delete();
            return back()->with('success', 'Práctica negada y eliminada.');
        } else {
            return back()->with('success', 'Estado de la práctica actualizado.');
        }
    }

    public function actualizarEstadoEstudiante2(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nuevoEstado' => 'required|in:En ejecucion,Negado,Terminado',
        ]);

        $practica = PracticaII::where('estudianteId', $id)->first();

        if (!$practica) {
            return back()->with('error', 'Práctica no encontrada.');
        }

        // Actualiza el estado de la práctica
        $nuevoEstado = $request->input('nuevoEstado');
        $practica->estado = $nuevoEstado;
        $practica->save();

        if ($nuevoEstado === 'En ejecucion') {
            return back()->with('success', 'Práctica II aprobada.');
        }

        if ($nuevoEstado === 'Negado') {
            $practica->delete();
            return back()->with('success', 'Práctica II negada y eliminada.');
        }

        return back()->with('success', 'Estado de la Práctica II actualizado.');
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

        return redirect()->route('admin.aceptarFaseI')->with('success', 'Empresa actualizado..');
    }



    ///////////////////////////////guardar NRC/////////////////////////////
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

        return back()->with('success', 'NRC guardado.');
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
        return redirect()->route('admin.index')->with('success', 'Respaldo de la base de datos creado y enviado por correo electrónico.');
    }


    ////////////////////////////cambiar credenciales
    public function cambiarCredencialesUsuario()
    {
        $user = Auth::user();

        $role = DB::table('roles')->where('id', $user->role_id_administrativo)->value('tipo');

        if (!Auth::check() || $role !== 'Administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }


        $periodos = Periodo::all();

        $usuario = Auth::user();
        $estudiante = $usuario->estudiante;

        $penultimateSession = UsuariosSession::where('userId', $usuario->userId)
            ->latest()
            ->skip(1)
            ->first();

        if ($penultimateSession) {
            $penultimateSession->user_agent = $this->getBrowserFromUserAgent($penultimateSession->user_agent);
            $userSessions = collect([$penultimateSession]);
        } else {
            $userSessions = collect();
        }

        return view('admin.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'estudiante', 'periodos'));
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


    public function aceptarDocente(Request $request, $id)
    {
        $docente = Usuario::find($id);

        if (!$docente) {
            return redirect()->back()->with('error', 'Docente no encontrado.');
        }


        $docente->estado = 'activo';
        $docente->save();

        return redirect()->route('admin.index')->with('success', 'Permisos del docente aceptados correctamente.');
    }

    public function rechazarDocente(Request $request, $id)
    {
        $profesor = ProfesUniversidad::where('userId', $id)->first();
        if ($profesor) {
            $profesor->delete();
        }

        $docente = Usuario::find($id);

        if (!$docente) {
            return redirect()->back()->with('error', 'Docente no encontrado.');
        }

        $docente->delete();




        return redirect()->route('admin.index')->with('success', 'Docente rechazado correctamente.');
    }



    public function revertirAsignacion($proyectoId, $idPeriodo)
    {
        try {
            // Encuentra todas las asignaciones del proyecto con el mismo idPeriodo
            $asignaciones = AsignacionProyecto::where('proyectoId', $proyectoId)
                ->where('idPeriodo', $idPeriodo)
                ->get();

            foreach ($asignaciones as $asignacion) {
                // Encuentra al estudiante asociado a la asignación
                $estudiante = Estudiante::findOrFail($asignacion->estudianteId);

                // Actualiza el estado del estudiante a "Aprobado"
                $estudiante->estado = 'Aprobado';
                $estudiante->save();

                // Actualiza el estado de la asignación a "En ejecucion"
                $asignacion->estado = 'En ejecucion';
                $asignacion->save();
            }

            // Redirige de vuelta con un mensaje de éxito
            return redirect()->back()->with('success', 'El estado de los estudiantes y las asignaciones han sido revertidos exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()->with('error', 'Ocurrió un error al revertir el estado de los estudiantes y las asignaciones: ' . $e->getMessage());
        }
    }


    ///////////////////////////////////departamentos
    public function agregarDepartamento(Request $request)
    {
        $request->validate([
            'departamento' => 'required|string|max:255|unique:departamentos,departamento',
        ]);

        $departamento = new Departamento([
            'departamento' => $request->departamento,
        ]);

        $departamento->save();

        return back()->with('success', 'Departamento guardado exitosamente.')->withInput();
    }

    public function actualizarDepartamento(Request $request, $id)
    {
        $request->validate([
            'departamento' => 'required|string|max:255|unique:departamentos,departamento,' . $id,
        ]);

        $departamento = Departamento::findOrFail($id);
        $departamento->departamento = $request->departamento;
        $departamento->save();

        return back()->with('success', 'Departamento actualizado exitosamente.')->withInput();
    }



    ////////////////descargar evidencias


    public function descargarEvidencias($proyectoId)
    {
        $asignaciones = AsignacionProyecto::where('proyectoId', $proyectoId)
            ->with('estudiante.evidencias', 'periodo', 'proyecto')
            ->get();

        if ($asignaciones->isEmpty()) {
            return back()->with('error', 'No se encontraron asignaciones para este proyecto.');
        }

        $proyectoNombre = $asignaciones->first()->proyecto->nombreProyecto ?? 'sin_nombre';
        $periodoNombre = $asignaciones->first()->periodo->numeroPeriodo ?? 'sin_periodo';
        $fileName = $proyectoNombre . '_' . $periodoNombre . '.zip';
        $zipFilePath = public_path($fileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $evidenciasAgregadas = false;

            foreach ($asignaciones as $asignacion) {
                $estudianteNombre = $asignacion->estudiante->apellidos . '_' . $asignacion->estudiante->nombres;
                $estudianteNombre = preg_replace('/[^A-Za-z0-9_\-]/', '_', $estudianteNombre);  // Sanitiza el nombre

                foreach ($asignacion->estudiante->evidencias as $evidencia) {
                    $decodedData = base64_decode($evidencia->evidencias);
                    if ($decodedData === false) {
                        \Log::error("No se pudo decodificar la evidencia Base64 para el estudiante con ID: {$asignacion->estudianteId}");
                        continue;
                    }

                    $tempFilePath = tempnam(sys_get_temp_dir(), 'evidencia_');
                    file_put_contents($tempFilePath, $decodedData);

                    // Crear una estructura de carpetas dentro del ZIP: Periodo/Estudiante/Evidencia
                    $zip->addFile($tempFilePath, $periodoNombre . '/' . $estudianteNombre . '/evidencia_' . $evidencia->idActividades . '.jpg');
                    $evidenciasAgregadas = true;
                }
            }

            $zip->close();

            if (!$evidenciasAgregadas) {
                if (file_exists($zipFilePath)) {
                    unlink($zipFilePath);
                }
                return back()->with('error', 'No tiene actividades cargadas.');
            }
        } else {
            \Log::error("No se pudo crear el archivo ZIP en la ruta: $zipFilePath.");
            return back()->with('error', 'No se pudo crear el archivo ZIP.');
        }

        if (file_exists($zipFilePath)) {
            // Guardar el mensaje de éxito en la sesión
            session()->flash('success', 'El archivo ZIP se ha generado con éxito.');
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            \Log::error("El archivo ZIP $zipFilePath no existe después de crear.");
            return back()->with('error', 'El archivo ZIP no existe.');
        }
    }

    public function dashboard(Request $request)
    {
        $periodos = Periodo::all();

        $selectedPeriodo = $request->input('periodo');

        // Obtener el número de periodo correspondiente al ID seleccionado
        $numeroPeriodoSeleccionado = Periodo::where('id', $selectedPeriodo)->value('numeroPeriodo');

        // Obtener los proyectos con sus asignaciones filtradas por periodo
        $proyectos = Proyecto::with([
            'asignaciones' => function ($query) use ($selectedPeriodo) {
                if ($selectedPeriodo) {
                    $query->where('idPeriodo', $selectedPeriodo);
                }
            }
        ])->get();

        $chartData = [];
        $categories = [];

        foreach ($proyectos as $proyecto) {
            $categories[] = $proyecto->nombreProyecto;
            $chartData[] = $proyecto->asignaciones->count();
        }

        // Obtener las prácticas por empresa filtradas por numeroPeriodo en periodoPractica
        $practicasPorEmpresa = Empresa::select('empresas.nombreEmpresa')
            ->join('practicasi', 'empresas.id', '=', 'practicasi.idEmpresa')
            ->selectRaw('COUNT(practicasi.estudianteId) as total_estudiantes')
            ->when($numeroPeriodoSeleccionado, function ($query, $numeroPeriodoSeleccionado) {
                $query->where('practicasi.periodoPractica', $numeroPeriodoSeleccionado);
            })
            ->groupBy('empresas.nombreEmpresa')
            ->orderBy('total_estudiantes', 'desc')
            ->get();

        // Extraer los datos para la gráfica de empresas
        $empresas = $practicasPorEmpresa->pluck('nombreEmpresa')->toArray();
        $estudiantesPorEmpresa = $practicasPorEmpresa->pluck('total_estudiantes')->toArray();

        return view('admin.dashboard', compact(
            'chartData',
            'categories',
            'periodos',
            'selectedPeriodo',
            'empresas',
            'estudiantesPorEmpresa'
        ));
    }

    public function filter(Request $request)
    {
        $selectedPeriodo = $request->input('periodo');

        $numeroPeriodoSeleccionado = Periodo::where('id', $selectedPeriodo)->value('numeroPeriodo');

        $proyectos = Proyecto::with([
            'asignaciones' => function ($query) use ($selectedPeriodo) {
                if ($selectedPeriodo) {
                    $query->where('idPeriodo', $selectedPeriodo);
                }
            }
        ])->get();

        $chartData = [];
        $categories = [];

        foreach ($proyectos as $proyecto) {
            $categories[] = $proyecto->nombreProyecto;
            $chartData[] = $proyecto->asignaciones->count();
        }

        $practicasPorEmpresa = Empresa::select('empresas.nombreEmpresa')
            ->join('practicasi', 'empresas.id', '=', 'practicasi.idEmpresa')
            ->selectRaw('COUNT(practicasi.estudianteId) as total_estudiantes')
            ->when($numeroPeriodoSeleccionado, function ($query, $numeroPeriodoSeleccionado) {
                $query->where('practicasi.periodoPractica', $numeroPeriodoSeleccionado);
            })
            ->groupBy('empresas.nombreEmpresa')
            ->orderBy('total_estudiantes', 'desc')
            ->get();

        return response()->json([
            'categories' => $categories,
            'chartData' => $chartData,
            'empresas' => $practicasPorEmpresa->pluck('nombreEmpresa'),
            'estudiantesPorEmpresa' => $practicasPorEmpresa->pluck('total_estudiantes'),
        ]);
    }
















}





