<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\ProfesUniversidad;
use App\Models\ActividadesPracticasII;
use App\Models\NotasPracticasii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Departamento;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\Periodo;
use App\Models\ActividadesPracticas;
use App\Models\NotasPracticasi;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Proyecto;
use App\Models\AsignacionSinEstudiante;
use App\Models\ActividadEstudiante;
use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\NotasEstudiante;
use App\Models\InformeParticipanteVinculacion;
use App\Models\UsuariosSession;

class ParticipanteVinculacionController extends Controller
{

    public function index(Request $request)
    {
        // Verificar si el usuario está autenticado y tiene el rol de Estudiante
        if (Auth::check() && Auth::user()->role->tipo !== 'ParticipanteVinculacion') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        // Lógica del método continua aquí
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        $perPage2 = $request->input('perPage2', 10);

        $search2 = $request->input('search2');

        $profesorFiltro = $request->input('profesor');
        $periodoFiltro = $request->input('periodo');

        $profesorFiltro2 = $request->input('profesorParticipante');
        $periodoFiltro2 = $request->input('periodoParticipante');

        $profesTodos = ProfesUniversidad::all();
        $obtenerPeriodo = Periodo::orderBy('inicioPeriodo', 'asc')->get();

        $profesor = Auth::user()->profesorUniversidad;
        $proyectos = Proyecto::where('directorId', $profesor->id)->pluck('proyectoId');

        $asignacionesProyectos = AsignacionProyecto::whereIn('proyectoId', $proyectos)
            ->where(function ($query) use ($search) {
                $query->whereHas('proyecto.director', function ($query) use ($search) {
                    $query->where('nombres', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhereHas('departamento', function ($query) use ($search) {
                            $query->where('departamento', 'like', "%{$search}%");
                        });
                })
                    ->orWhereHas('proyecto', function ($query) use ($search) {
                        $query->where('nombreProyecto', 'like', "%{$search}%");
                    })
                    ->orWhereHas('estudiante', function ($query) use ($search) {
                        $query->where('nombres', 'like', "%{$search}%")
                            ->orWhere('apellidos', 'like', "%{$search}%")
                            ->orWhere('carrera', 'like', "%{$search}%")
                            ->orWhereHas('departamento', function ($query) use ($search) {
                                $query->where('departamento', 'like', "%{$search}%");
                            });
                    })
                    ->orWhereHas('periodo', function ($query) use ($search) {
                        $query->where('numeroPeriodo', 'like', "%{$search}%");
                    })
                    ->orWhereHas('docenteParticipante', function ($query) use ($search) {
                        $query->where('nombres', 'like', "%{$search}%")
                            ->orWhere('apellidos', 'like', "%{$search}%")
                            ->orWhereHas('departamento', function ($query) use ($search) {
                                $query->where('departamento', 'like', "%{$search}%");
                            });
                    });
            })
            ->when($profesorFiltro, function ($query) use ($profesorFiltro) {
                $query->whereHas('docenteParticipante', function ($query) use ($profesorFiltro) {
                    $query->where('apellidos', 'like', "%{$profesorFiltro}%");
                });
            })
            ->when($periodoFiltro, function ($query) use ($periodoFiltro) {
                $query->whereHas('periodo', function ($query) use ($periodoFiltro) {
                    $query->where('numeroPeriodo', 'like', "%{$periodoFiltro}%");
                });
            })
            ->paginate($perPage, ['*'], 'proyectosPage');

        $asignacionParticipante = AsignacionProyecto::where('participanteId', $profesor->id)
            ->where(function ($query) use ($search2) {
                $query->whereHas('proyecto.director', function ($query) use ($search2) {
                    $query->where('nombres', 'like', "%{$search2}%")
                        ->orWhere('apellidos', 'like', "%{$search2}%")
                        ->orWhereHas('departamento', function ($query) use ($search2) {
                            $query->where('departamento', 'like', "%{$search2}%");
                        });
                })
                    ->orWhereHas('proyecto', function ($query) use ($search2) {
                        $query->where('nombreProyecto', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('estudiante', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                            ->orWhere('apellidos', 'like', "%{$search2}%")
                            ->orWhere('carrera', 'like', "%{$search2}%")
                            ->orWhereHas('departamento', function ($query) use ($search2) {
                                $query->where('departamento', 'like', "%{$search2}%");
                            });
                    })
                    ->orWhereHas('periodo', function ($query) use ($search2) {
                        $query->where('numeroPeriodo', 'like', "%{$search2}%");
                    })
                    ->orWhereHas('docenteParticipante', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                            ->orWhere('apellidos', 'like', "%{$search2}%")
                            ->orWhereHas('departamento', function ($query) use ($search2) {
                                $query->where('departamento', 'like', "%{$search2}%");
                            });
                    });
            })
            ->when($profesorFiltro2, function ($query) use ($profesorFiltro2) {
                $query->whereHas('proyecto.director', function ($query) use ($profesorFiltro2) {
                    $query->where('apellidos', 'like', "%{$profesorFiltro2}%");
                });
            })
            ->when($periodoFiltro2, function ($query) use ($periodoFiltro2) {
                $query->whereHas('periodo', function ($query) use ($periodoFiltro2) {
                    $query->where('numeroPeriodo', 'like', "%{$periodoFiltro2}%");
                });
            })
            ->paginate($perPage2, ['*'], 'participantesPage');


        return view('ParticipanteVinculacion.index', compact(
            'proyectos',
            'asignacionesProyectos',
            'asignacionParticipante',
            'search',
            'search2',
            'profesTodos',
            'obtenerPeriodo',
            'profesorFiltro',
            'periodoFiltro',
            'profesorFiltro2',
            'periodoFiltro2',
            'perPage',
            'perPage2'
        ));
    }










    public function estudiantes()
    {
        if (Auth::check() && Auth::user()->role->tipo !== 'ParticipanteVinculacion') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $participante = Auth::user();

        $estudiantes = [];
        $estudiantesConNotas = [];

        if ($participante) {
            $correoParticipante = $participante->correoElectronico;

            // Obtener el participante (profesor) por su correo electrónico
            $participante = ProfesUniversidad::where('correo', $correoParticipante)->first();


            if ($participante) {
                // Obtener los proyectos asociados al participante de AsignacionProyecto
                $proyectos = AsignacionProyecto::where('participanteId', $participante->id)
                    ->pluck('proyectoId');


                // Obtener los estudiantes con estado Aprobado asociados a los proyectos de AsignacionProyecto
                $todosEstudiantes = AsignacionProyecto::whereIn('participanteId', [$participante->id])
                    ->whereHas('estudiante', function ($query) {
                        $query->where('estado', 'Aprobado');
                    })
                    ->pluck('estudianteId');


                // Obtener estudiantes con notas y sin notas según la lógica previamente definida
                $estudiantesConNotas = Estudiante::with('notas')
                    ->whereIn('estudianteId', $todosEstudiantes)
                    ->whereHas('proyectos', function ($query) {
                        $query->where('proyectos.estado', 'Ejecucion');
                    })
                    ->get();

                $estudiantes = Estudiante::whereIn('estudianteId', $todosEstudiantes)
                    ->whereDoesntHave('notas')
                    ->get();




            }

            $actividadesEstudiantes = ActividadEstudiante::join('asignacionproyectos', 'actividades_estudiante.estudianteId', '=', 'asignacionproyectos.estudianteId')
                ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
                ->select('actividades_estudiante.*')
                ->get();


        }




        return view('ParticipanteVinculacion.estudiantes', compact('estudiantes', 'estudiantesConNotas', 'actividadesEstudiantes'));
    }



    ///////////////baremos

    public function baremo(Request $request)
    {
        if (Auth::check() && Auth::user()->role->tipo !== 'ParticipanteVinculacion') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $profesor = Auth::user()->profesorUniversidad;

        $proyecto = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->with([
                'proyecto',
                'estudiante',
                'nrcVinculacion.periodo'
            ])
            ->first();

        $inicioFecha = null;
        $finalizacionFecha = null;

        if ($proyecto) {
            $inicioFecha = $proyecto->nrcVinculacion->periodo->inicioPeriodo ?? null;
            $finalizacionFecha = $proyecto->nrcVinculacion->periodo->finPeriodo ?? null;
        } else {
            $fechaActual = Carbon::now()->format('Y-m-d');
            $proyecto = AsignacionSinEstudiante::where('participanteId', $profesor->id)
                ->where('inicioFecha', '<=', $fechaActual)
                ->where('finalizacionFecha', '>=', $fechaActual)
                ->with(['proyecto'])
                ->first();

            if ($proyecto) {
                $inicioFecha = $proyecto->inicioFecha ?? null;
                $finalizacionFecha = $proyecto->finalizacionFecha ?? null;
            }
        }

        return view('ParticipanteVinculacion.baremo', compact('inicioFecha', 'finalizacionFecha'));
    }












    ///////////notas estudiante
    public function guardarNotas(Request $request)
    {
        // Define las reglas de validación
        $rules = [
            'cumple_tareas' => 'required',
            'resultados_alcanzados' => 'required',
            'conocimientos_area' => 'required',
            'adaptabilidad' => 'required',
            'Aplicacion' => 'required',
            'capacidad_liderazgo' => 'required',
            'asistencia_puntual' => 'required',
        ];

        // Define los mensajes de error personalizados
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
        ];

        // Valida los datos del formulario
        $this->validate($request, $rules, $messages);

        // Obtén los datos del formulario
        $cumpleTareas = $request->input('cumple_tareas');
        $resultadosAlcanzados = $request->input('resultados_alcanzados');
        $conocimientosArea = $request->input('conocimientos_area');
        $adaptabilidad = $request->input('adaptabilidad');
        $Aplicacion = $request->input('Aplicacion');
        $capacidadLiderazgo = $request->input('capacidad_liderazgo');
        $asistenciaPuntual = $request->input('asistencia_puntual');
        $informeServicio = $request->input('informe_servicio');
        $estudianteIDs = $request->input('estudiante_id');

        // Guarda las notas en la base de datos
        foreach ($estudianteIDs as $key => $estudianteID) {
            $nota = new NotasEstudiante();
            $nota->estudianteId = $estudianteID;
            $nota->tareas = $cumpleTareas[$key];
            $nota->resultadosAlcanzados = $resultadosAlcanzados[$key];
            $nota->conocimientos = $conocimientosArea[$key];
            $nota->adaptabilidad = $adaptabilidad[$key];
            $nota->aplicacion = $Aplicacion[$key];
            $nota->CapacidadLiderazgo = $capacidadLiderazgo[$key];
            $nota->asistencia = $asistenciaPuntual[$key];
            $nota->informe = $informeServicio[$key] ?? 'Pendiente';
            $nota->save();
        }

        // Puedes redirigir a una página de éxito o hacer cualquier otra acción necesaria
        return redirect()->route('ParticipanteVinculacion.estudiantes')->with('success', 'Notas guardadas exitosamente.');
    }

    //////editar notas
    public function editarNotas(Request $request, $id)
    {
        $rules = [
            'tareas' => 'required',
            'resultados_alcanzados' => 'required',
            'conocimientos_area' => 'required',
            'adaptabilidad' => 'required',
            'Aplicacion' => 'required',
            'capacidad_liderazgo' => 'required',
            'asistencia_puntual' => 'required',

        ];

        $nota = NotasEstudiante::where('estudianteId', $id)->first();
        $nota->tareas = $request->input('tareas');
        $nota->resultadosAlcanzados = $request->input('resultados_alcanzados');
        $nota->conocimientos = $request->input('conocimientos_area');
        $nota->adaptabilidad = $request->input('adaptabilidad');
        $nota->aplicacion = $request->input('Aplicacion');
        $nota->CapacidadLiderazgo = $request->input('capacidad_liderazgo');
        $nota->asistencia = $request->input('asistencia_puntual');
        $nota->save();

        return redirect()->route('ParticipanteVinculacion.estudiantes')->with('success', 'Notas actualizadas exitosamente.');
    }



    ////////////////////////////cambiar credenciales
    public function cambiarCredencialesUsuario()
    {
        if (Auth::check() && in_array(Auth::user()->role->tipo, ['Estudiante'])) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $departamentos = Departamento::all();

        $periodos = Periodo::all();

        $usuario = Auth::user();
        $estudiante = $usuario->profesorUniversidad;

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

        return view('ParticipanteVinculacion.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'estudiante', 'periodos', 'departamentos'));
    }


    public function actualizarDatosParticipanterCredenciales(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'firstname_student' => 'required',
            'lastname_student' => 'required',
            'Departamento' => 'required',
        ]);

        $estudiante = ProfesUniversidad::findOrFail($id);

        // Actualizar los datos del estudiante
        $estudiante->nombres = $request->input('firstname_student');
        $estudiante->apellidos = $request->input('lastname_student');
        $estudiante->departamentoId = $request->input('Departamento');

        // Guardar los cambios
        $estudiante->save();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Datos del estudiante actualizados.');
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
        // Validar los campos de la solicitud
        $request->validate([
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);


        // Obtener el usuario autenticado
        $usuario = Auth::user();
          // Actualizar la contraseña del usuario
        $usuario->Contrasena = bcrypt($request->password);

        // Verificar si el usuario tiene relación con profesorUniversidad
        if ($usuario->profesorUniversidad) {
            $usuario->profesorUniversidad->actualizacion = true;
            $usuario->profesorUniversidad->save();
        }

        // Guardar los cambios en el modelo `Usuario`
        $usuario->save();

        // Redirigir a la ruta deseada con un mensaje de éxito
        return back()->with('success', 'Credenciales actualizadas exitosamente');
    }




    public function practicas()
    {
        if (Auth::check() && Auth::user()->role->tipo !== 'ParticipanteVinculacion') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $participante = Auth::user()->profesorUniversidad;

        // Obtener el ID del tutor académico (ajusta esta línea según cómo obtienes este ID)
        $idTutorAcademico = $participante->id;

        // Obtener los estudiantes con 'practicasi' en ejecución del participante y con el idTutorAcademico
        $estudiantes = Estudiante::whereHas('practicasi', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico);
        })->with([
                    'practicasi' => function ($query) {
                        $query->where('Estado', 'En ejecucion');
                    }
                ])->get();

        // Estudiantes a calificar que no tienen nota_final en practicai
        $estudiantesCalificar = Estudiante::whereHas('practicasi', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico)
                ->whereNull('nota_final');
        })->get();

        // Estudiantes calificados con el idTutorAcademico
        $estudiantesCalificados = Estudiante::whereHas('practicasi', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico)
                ->whereNotNull('nota_final')
                ->where('Estado', '!=', 'Reprobado'); // Excluye las prácticas con estado "Reprobado"
        })->with([
                    'practicasi' => function ($query) use ($idTutorAcademico) {
                        $query->where('Estado', 'En ejecucion')
                            ->where('idTutorAcademico', $idTutorAcademico)
                            ->whereNotNull('nota_final')
                            ->where('Estado', '!=', 'Reprobado'); // Asegura cargar solo prácticas que no están reprobadas
                    }
                ])->get();


        // Obtener las actividades de los estudiantes de ActividadesPracticas con el idTutorAcademico
        $actividades = ActividadesPracticas::whereHas('estudiante.practicasi', function ($query) use ($idTutorAcademico) {
            $query->where('idTutorAcademico', $idTutorAcademico);
        })->get();


        return view('ParticipanteVinculacion.practicas', compact('estudiantes', 'estudiantesCalificar', 'estudiantesCalificados', 'actividades'));
    }




    ///////////////guardar notas practicasi
    public function guardarNotasPracticasi(Request $request)
    {
        $request->validate([
            'notaTutorEmpresarial' => 'required',
        ]);

        $notaTutor = $request->input('notaTutorEmpresarial');
        $estudianteId = $request->input('estudianteId');

        // Asegúrate de seleccionar la práctica que está en ejecución para el estudiante.
        $practicasi = PracticaI::where('estudianteId', $estudianteId)
            ->where('Estado', 'En ejecucion') // Asegúrate de que es la práctica en ejecución.
            ->first();

        if ($practicasi) {
            $practicasi->nota_final = $notaTutor;
            $practicasi->save();
            return redirect()->route('ParticipanteVinculacion.practicas')->with('success', 'Notas guardadas exitosamente.');
        } else {
            return redirect()->route('ParticipanteVinculacion.practicas')->with('error', 'No se pudo guardar las notas. La práctica no está en ejecución.');
        }
    }




    ///////////////editar notas practicasi

    public function editarNotasPracticasi(Request $request, $id)
    {
        $request->validate([
            'notaTutorEmpresarial' => 'required',
        ]);

        $notaTutor = $request->input('notaTutorEmpresarial');

        $practicasi = PracticaI::where('estudianteId', $id)
            ->where('Estado', 'En ejecucion')
            ->first();

        if ($practicasi) {
            $practicasi->nota_final = $notaTutor;
            $practicasi->save();
            return redirect()->route('ParticipanteVinculacion.practicas')->with('success', 'Notas actualizadas exitosamente.');
        } else {
            return redirect()->route('ParticipanteVinculacion.practicas')->with('error', 'No se pudo actualizar las notas. La práctica no está en ejecución.');
        }
    }




    ///////////////cerrar practicasi
    public function cerrarPracticasi()
    {
        $participante = Auth::user()->profesorUniversidad;

        $idTutorAcademico = $participante->id;

        $estudiantes = Estudiante::whereHas('practicasi', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico);
        })->get();

        foreach ($estudiantes as $estudiante) {
            $practicasi = PracticaI::where('estudianteId', $estudiante->estudianteId)
                ->where('idTutorAcademico', $idTutorAcademico)
                ->where('Estado', '!=', 'Reprobado')
                ->first();

            if ($practicasi) {
                if ($practicasi->nota_final < 16) {
                    $practicasi->Estado = 'Reprobado';
                    $estudiante->save();

                    ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)->delete();
                } else {
                    $practicasi->Estado = 'Finalizado';
                }
                $practicasi->save();
            }
        }

        return redirect()->route('ParticipanteVinculacion.practicas')->with('success', 'Práctica cerrada exitosamente.');
    }









    /////////////////////////practicas 2
    public function practicasii()
    {
        if (Auth::check() && Auth::user()->role->tipo !== 'ParticipanteVinculacion') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $participante = Auth::user()->profesorUniversidad;

        // Obtener el ID del tutor académico (ajusta esta línea según cómo obtienes este ID)
        $idTutorAcademico = $participante->id;

        // Obtener los estudiantes con 'practicasi' en ejecución del participante y con el idTutorAcademico
        $estudiantes = Estudiante::whereHas('practicasii', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico);
        })->with([
                    'practicasii' => function ($query) {
                        $query->where('Estado', 'En ejecucion');
                    }
                ])->get();

        // Estudiantes a calificar que no tienen nota en NotasPracticasii y con el idTutorAcademico
        $estudiantesCalificar = Estudiante::whereHas('practicasii', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico)
                ->whereNull('nota_final');
        })->get();

        // Estudiantes calificados con el idTutorAcademico
        $estudiantesCalificados = Estudiante::whereHas('practicasii', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico)
                ->whereNotNull('nota_final');
        })->with([
                    'practicasii' => function ($query) use ($idTutorAcademico) {
                        $query->where('Estado', 'En ejecucion')
                            ->where('idTutorAcademico', $idTutorAcademico)
                            ->whereNotNull('nota_final');
                    }
                ])->get();
        // Obtener las actividades de los estudiantes de ActividadesPracticas con el idTutorAcademico
        $actividades = ActividadesPracticasII::whereHas('estudiante.practicasii', function ($query) use ($idTutorAcademico) {
            $query->where('idTutorAcademico', $idTutorAcademico);
        })->get();

        return view('ParticipanteVinculacion.practicasii', compact('estudiantes', 'estudiantesCalificar', 'estudiantesCalificados', 'actividades'));
    }





    ///////////////guardar notas practicasii
    public function guardarNotasPracticasii(Request $request)
    {
        $request->validate([
            'notaTutorEmpresarial' => 'required',
        ]);

        $notaTutor = $request->input('notaTutorEmpresarial');
        $estudianteId = $request->input('estudianteId');

        $practicasi = PracticaII::where('estudianteId', $estudianteId)
            ->where('Estado', 'En ejecucion')
            ->first();

        if ($practicasi) {
            $practicasi->nota_final = $notaTutor;
            $practicasi->save();
            return redirect()->route('ParticipanteVinculacion.practicasii')->with('success', 'Notas guardadas exitosamente.');
        } else {
            return redirect()->route('ParticipanteVinculacion.practicasii')->with('error', 'No se pudo guardar las notas. La práctica no está en ejecución.');
        }
    }






    ///////////////editar notas practicasii
    public function editarNotasPracticasii(Request $request, $id)
    {
        $request->validate([
            'notaTutorEmpresarial' => 'required',
        ]);

        $notaTutor = $request->input('notaTutorEmpresarial');

        $practicasi = PracticaII::where('estudianteId', $id)
            ->where('Estado', 'En ejecucion')
            ->first();

        if ($practicasi) {
            $practicasi->nota_final = $notaTutor;
            $practicasi->save();
            return redirect()->route('ParticipanteVinculacion.practicasii')->with('success', 'Notas actualizadas exitosamente.');
        } else {
            return redirect()->route('ParticipanteVinculacion.practicasii')->with('error', 'No se pudo actualizar las notas. La práctica no está en ejecución.');
        }
    }




    ///////////////cerrar practicasii
    public function cerrarPracticasii()
    {
        $participante = Auth::user()->profesorUniversidad;

        $idTutorAcademico = $participante->id;

        $estudiantes = Estudiante::whereHas('practicasii', function ($query) use ($idTutorAcademico) {
            $query->where('Estado', 'En ejecucion')
                ->where('idTutorAcademico', $idTutorAcademico);
        })->get();

        foreach ($estudiantes as $estudiante) {
            $practicasi = PracticaII::where('estudianteId', $estudiante->estudianteId)
                ->where('idTutorAcademico', $idTutorAcademico)
                ->where('Estado', '!=', 'Reprobado')
                ->first();

            if ($practicasi) {
                if ($practicasi->nota_final < 16) {
                    $practicasi->Estado = 'Reprobado';
                    $estudiante->save();

                    ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)->delete();
                } else {
                    $practicasi->Estado = 'Finalizado';
                }
                $practicasi->save();
            }
        }

        return redirect()->route('ParticipanteVinculacion.practicasii')->with('success', 'Práctica cerrada exitosamente.');
    }


    public function guardarDatos(Request $request)
    {
        $data = $request->validate([
            'Objetivos' => 'required',
            'intervencion' => 'required',
            'planificadas' => 'required',
            'planificadas.*' => 'required',
            'alcanzados' => 'required',
            'alcanzados.*' => 'required',
            'porcentaje' => 'required',
            'porcentaje.*' => 'required',
            'Hombres' => 'required',
            'Mujeres' => 'required',
            'Niños' => 'required',
            'capacidad' => 'required',
            'Observaciones1' => 'required',
            'Observaciones2' => 'required',
            'Observaciones3' => 'required',
            'Observaciones4' => 'required',
            'Conclusiones' => 'required',
            'Recomendaciones' => 'required',
        ]);

        $userId = auth()->user()->userId;
        $userId = ProfesUniversidad::where('userId', $userId)->first()->id;
        $informe = InformeParticipanteVinculacion::where('participanteId', $userId)->first();

        if ($informe) {
            $informe->update([
                'objetivos' => $data['Objetivos'],
                'intervencion' => $data['intervencion'],
                'actividadesPlanificadas' => json_encode($data['planificadas']),
                'resultadosAlcanzados' => json_encode($data['alcanzados']),
                'porcentajesAlcanzados' => json_encode($data['porcentaje']),
                'hombres' => $data['Hombres'],
                'mujeres' => $data['Mujeres'],
                'niños' => $data['Niños'],
                'personasConDiscapacidad' => $data['capacidad'],
                'observacionesHombres' => $data['Observaciones1'],
                'observacionesMujeres' => $data['Observaciones2'],
                'observacionesNiños' => $data['Observaciones3'],
                'observacionesPersonasConCapacidad' => $data['Observaciones4'],
                'conclusiones' => $data['Conclusiones'],
                'recomendaciones' => $data['Recomendaciones']
            ]);
        } else {
            InformeParticipanteVinculacion::create([
                'participanteId' => $userId,
                'objetivos' => $data['Objetivos'],
                'intervencion' => $data['intervencion'],
                'actividadesPlanificadas' => json_encode($data['planificadas']),
                'resultadosAlcanzados' => json_encode($data['alcanzados']),
                'porcentajesAlcanzados' => json_encode($data['porcentaje']),
                'hombres' => $data['Hombres'],
                'mujeres' => $data['Mujeres'],
                'niños' => $data['Niños'],
                'personasConDiscapacidad' => $data['capacidad'],
                'observacionesHombres' => $data['Observaciones1'],
                'observacionesMujeres' => $data['Observaciones2'],
                'observacionesNiños' => $data['Observaciones3'],
                'observacionesPersonasConCapacidad' => $data['Observaciones4'],
                'conclusiones' => $data['Conclusiones'],
                'recomendaciones' => $data['Recomendaciones']
            ]);
        }

        return redirect()->back()->with('success', 'Datos guardados exitosamente.')->withInput();
    }

    public function recuperarDatos()
    {
        $participanteId = ProfesUniversidad::where('userId', auth()->user()->userId)->first()->id;
        $informe = InformeParticipanteVinculacion::where('participanteId', $participanteId)->first();

        if (!$informe) {
            return redirect()->back()->with('error', 'No se encontraron datos previos.');
        }

        $data = [
            'Objetivos' => $informe->objetivos,
            'intervencion' => $informe->intervencion,
            'planificadas' => json_decode($informe->actividadesPlanificadas, true),
            'alcanzados' => json_decode($informe->resultadosAlcanzados, true),
            'porcentaje' => json_decode($informe->porcentajesAlcanzados, true),
            'Hombres' => $informe->hombres,
            'Mujeres' => $informe->mujeres,
            'Niños' => $informe->niños,
            'capacidad' => $informe->personasConDiscapacidad,
            'Observaciones1' => $informe->observacionesHombres,
            'Observaciones2' => $informe->observacionesMujeres,
            'Observaciones3' => $informe->observacionesNiños,
            'Observaciones4' => $informe->observacionesPersonasConCapacidad,
            'Conclusiones' => $informe->conclusiones,
            'Recomendaciones' => $informe->recomendaciones,
        ];

        return redirect()->back()->withInput($data);
    }






}

