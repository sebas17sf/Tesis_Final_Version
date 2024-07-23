<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\ProfesUniversidad;
use App\Models\ActividadesPracticasII;
use App\Models\NotasPracticasii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\Periodo;
use App\Models\ActividadesPracticas;
use App\Models\NotasPracticasi;
use Carbon\Carbon;
use App\Models\AsignacionSinEstudiante;
use App\Models\ActividadEstudiante;
use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\NotasEstudiante;
use App\Models\UsuariosSession;

class ParticipanteVinculacionController extends Controller
{

    public function index(Request $request)
    {
        $elementosPorPagina = $request->input('elementosPorPagina', 10);

        $correoParticipante = Auth::user()->correoElectronico;
        $participante = ProfesUniversidad::where('correo', $correoParticipante)->first();
        $proyectosEnEjecucion = null;
        $proyectosTerminados = null;

        if ($participante) {
            $participanteID = $participante->id;

            // Obtener el proyecto asociado al participante en AsignacionProyecto
            $proyectosEnEjecucion = AsignacionProyecto::where('participanteId', $participanteID)
                ->whereHas('proyecto', function ($query) {
                    $query->where('estado', 'Ejecucion');
                })
                ->whereHas('estudiante', function ($query) {
                    $query->where('estado', 'Aprobado');
                })
                ->with(['proyecto', 'estudiante'])
                ->get()
                ->unique('proyectoId'); // Utiliza unique() para filtrar proyectos duplicados basados en proyectoId

            if ($proyectosEnEjecucion->isEmpty()) {
                $fechaActual = Carbon::now()->format('Y-m-d');

                $proyectosEnEjecucion = AsignacionSinEstudiante::where('participanteId', $participanteID)
                    ->where('inicioFecha', '<=', $fechaActual)
                    ->where('finalizacionFecha', '>=', $fechaActual)
                    ->with(['proyecto'])
                    ->get();
            }

            $proyectosTerminados = AsignacionProyecto::where('participanteId', $participanteID)
                ->whereHas('proyecto', function ($query) {
                    $query->where('estado', 'Terminado');
                })
                ->with('proyecto')
                ->get();
        }

        return view('ParticipanteVinculacion.index', compact('proyectosEnEjecucion', 'proyectosTerminados'));
    }









    public function estudiantes()
    {
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
                        $query->where('estado', 'Ejecucion');
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
        $profesor = Auth::user()->profesorUniversidad;

        $proyecto = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->with(['proyecto', 'estudiante'])
            ->first();

        if (!$proyecto) {
            $fechaActual = Carbon::now()->format('Y-m-d');
            $proyecto = AsignacionSinEstudiante::where('participanteId', $profesor->id)
                ->where('inicioFecha', '<=', $fechaActual)
                ->where('finalizacionFecha', '>=', $fechaActual)
                ->with(['proyecto'])
                ->first();

        }



        $inicioFecha = $proyecto->inicioFecha ?? null;
        $finalizacionFecha = $proyecto->finalizacionFecha ?? null;


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
            'tareas' => 'required|numeric|min:1|max:10',
            'resultados_alcanzados' => 'required|numeric|min:1|max:10',
            'conocimientos_area' => 'required|numeric|min:1|max:10',
            'adaptabilidad' => 'required|numeric|min:1|max:10',
            'Aplicacion' => 'required|numeric|min:1|max:10',
            'capacidad_liderazgo' => 'required|numeric|min:1|max:10',
            'asistencia_puntual' => 'required|numeric|min:1|max:10',
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser mayor que :min.',
            'max' => 'El campo :attribute debe ser menor que :max.',
        ];

        $this->validate($request, $rules, $messages);

        $nota = NotasEstudiante::where('EstudianteID', $id)->first();
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

        return view('ParticipanteVinculacion.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'estudiante', 'periodos'));
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

        return redirect()->route('ParticipanteVinculacion.index')->with('success', 'Credenciales actualizadas exitosamente');
    }



    public function practicas()
    {
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

        return view('director_vinculacion.practicaii', compact('estudiantes', 'estudiantesCalificar', 'estudiantesCalificados', 'actividades'));
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




}

