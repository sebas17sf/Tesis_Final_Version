<?php

namespace App\Http\Controllers;

use App\Models\ActividadesPracticasII;
use App\Models\DirectorVinculacion;
use App\Models\NotasPracticasi;
use App\Models\NotasPracticasii;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\UsuariosSession;
use App\Models\ActividadEstudiante;

use App\Models\AsignacionEstudiantesDirector;
use App\Models\ProfesUniversidad;
use App\Models\ActividadesPracticas;
use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\NotasEstudiante;


class DirectorVinculacionController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $search2 = $request->input('search2');


        $profesor = Auth::user()->profesorUniversidad;
        $proyectos = Proyecto::where('directorId', $profesor->id)->pluck('proyectoId');
        $asignacionesProyectos = AsignacionProyecto::whereIn('proyectoId', $proyectos)
        ->where(function ($query) use ($search) {
            $query->whereHas('proyecto.director', function ($query) use ($search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('departamento', 'like', "%{$search}%");
            })
            ->orWhereHas('proyecto', function ($query) use ($search) {
                $query->where('nombreProyecto', 'like', "%{$search}%");
            })
            ->orWhereHas('estudiante', function ($query) use ($search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('carrera', 'like', "%{$search}%")
                    ->orWhere('departamento', 'like', "%{$search}%");

            })
            ->orWhereHas('periodo', function ($query) use ($search) {
                $query->where('numeroPeriodo', 'like', "%{$search}%");
            })

            ->orWhereHas('docenteParticipante', function ($query) use ($search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('departamento', 'like', "%{$search}%");
            });






        })
        ->get();

        $asignacionParticipante = AsignacionProyecto::where('participanteId', $profesor->id)
        ->where(function ($query) use ($search2) {
            $query->whereHas('proyecto.director', function ($query) use ($search2) {
                $query->where('nombres', 'like', "%{$search2}%")
                    ->orWhere('apellidos', 'like', "%{$search2}%")
                    ->orWhere('departamento', 'like', "%{$search2}%");
            })
            ->orWhereHas('proyecto', function ($query) use ($search2) {
                $query->where('nombreProyecto', 'like', "%{$search2}%");
            })
            ->orWhereHas('estudiante', function ($query) use ($search2) {
                $query->where('nombres', 'like', "%{$search2}%")
                    ->orWhere('apellidos', 'like', "%{$search2}%")
                    ->orWhere('carrera', 'like', "%{$search2}%")
                    ->orWhere('departamento', 'like', "%{$search2}%");
            })
            ->orWhereHas('periodo', function ($query) use ($search2) {
                $query->where('numeroPeriodo', 'like', "%{$search2}%");
            })
            ->orWhereHas('docenteParticipante', function ($query) use ($search2) {
                $query->where('nombres', 'like', "%{$search2}%")
                    ->orWhere('apellidos', 'like', "%{$search2}%")
                    ->orWhere('departamento', 'like', "%{$search2}%");
            });
        })
        ->get();



        return view('director_vinculacion.index', compact('proyectos', 'asignacionesProyectos', 'asignacionParticipante', 'search', 'search2'));

    }

    //////////////////buscar


    ////////////funcion para repartir los estudiantes
    public function repartoEstudiantes()
    {
        $correoAutenticado = Auth::user()->correoElectronico;

        $directorProyecto = ProfesUniversidad::where('correo', $correoAutenticado)->first();

        // Obtener el proyecto del director en asignaciionProyectos
        $proyectoEjecucion = Proyecto::where('directorId', $directorProyecto->id)
            ->where('estado', 'Ejecucion')
            ->first();


        // Obtener los estudiantes asignados al proyecto en ejecución que no estén en AsignacionEstudiantesDirector
        $estudiantesAsignados = collect([]);
        if ($proyectoEjecucion) {
            $estudiantesAsignados = AsignacionProyecto::where('proyectoId', $proyectoEjecucion->ProyectoID)
                ->get();
            $estudiantesAsignados->load('estudiante');

            // Filtrar estudiantes asignados que no estén en AsignacionProyecto
            $estudiantesAsignados = $estudiantesAsignados->filter(function ($asignacion) {
                return !AsignacionProyecto::where('estudianteId', $asignacion->EstudianteID)->exists();
            });
        }

        $asignacionesEstudiantesDirector = collect([]);
        if ($proyectoEjecucion) {
            $asignacionesEstudiantesDirector = Proyecto::with([
                'asignaciones' => function ($query) {
                    $query->whereHas('estudiante', function ($query) {
                        $query->where('estado', 'Aprobado');
                    });
                }
            ])
                ->where('directorId', $directorProyecto->id)
                ->get()
                ->flatMap(function ($proyecto) {
                    return $proyecto->asignaciones;
                });

        }

        $actividadesEstudiantes = ActividadEstudiante::join('asignacionproyectos', 'asignacionproyectos.estudianteId', '=', 'actividades_estudiante.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->select('actividades_estudiante.*')
            ->where('proyectos.directorId', $directorProyecto->id)
            ->where('proyectos.estado', 'Ejecucion')
            ->get();





        return view('director_vinculacion.repartoEstudiantes', compact('directorProyecto', 'estudiantesAsignados', 'asignacionesEstudiantesDirector', 'actividadesEstudiantes'));
    }





    /////////designar estudiante

    public function eliminarEstudiante(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required',
        ]);

        $estudianteId = $request->input('estudiante_id');
        $motivoNegacion = $request->input('motivo_negacion');

        AsignacionProyecto::where('estudianteId', $estudianteId)->delete();

        $estudiante = Estudiante::find($estudianteId);
        $estudiante->comentario = $motivoNegacion;
        $estudiante->estado = 'Negado';


        $estudiante->save();

        return redirect()->route('director.repartoEstudiantes')->with('success', 'Se ha eliminado el estudiante.');
    }

    public function estudiantes()
    {
        $RepartoEstudiantes = AsignacionProyecto::all();

        $correoDirector = Auth::user()->correoElectronico;
        $director = ProfesUniversidad::where('correo', $correoDirector)->first();

        $estudiantesConNotasPendientes = [];
        $estudiantesCalificados = [];

        if ($director) {
            $proyectos = Proyecto::where('directorId', $director->id)->with('asignaciones')->get();
            $estudiantesAsignados = $proyectos->flatMap(function ($proyecto) {
                return $proyecto->asignaciones->pluck('estudianteId');
            })->toArray();

            // Obtener estudiantes con notas pendientes en proyectos en ejecución
            $estudiantesConNotasPendientesIds = NotasEstudiante::whereIn('estudianteId', $estudiantesAsignados)
                ->where('informe', 'Pendiente')
                ->pluck('estudianteId')
                ->toArray();

            // Filtrar solo los estudiantes con notas pendientes que tengan el Estado Aprobado
            $estudiantesConNotasPendientes = Estudiante::whereIn('estudianteId', $estudiantesConNotasPendientesIds)
                ->where('estado', 'Aprobado')
                ->get();

            // Obtener estudiantes calificados en estado Aprobado
            $estudiantesCalificados = Estudiante::whereIn('estudianteId', $estudiantesAsignados)
                ->where('estado', 'Aprobado')
                ->get();





        }

        return view('director_vinculacion.estudiantes', compact('estudiantesConNotasPendientes', 'estudiantesCalificados'));
    }




    /////cerrar activiades de los estudiantes
    public function cerrarProcesoEstudiantes()
    {
        $correoDirector = Auth::user()->correoElectronico;
        $director = ProfesUniversidad::where('correo', $correoDirector)->first();

        $proyectos = Proyecto::where('directorId', $director->id)->get();

        $estudiantes = Estudiante::whereHas('proyectos', function ($query) use ($director) {
            $query->where('directorId', $director->id);
        })->get();

        foreach ($estudiantes as $estudiante) {
            $estudiante->estado = 'Aprobado-practicas';
            $estudiante->save();
        }

        return redirect()->route('director.repartoEstudiantes')->with('success', 'Se han cerrado las actividades de los estudiantes.');
    }






    public function actualizarInforme(Request $request)
    {
        $request->validate([
            'informe_servicio.*' => 'required|string',
            'estudiante_id.*' => 'required|numeric',
        ]);
        ///actualiza el informe de los estudiantes de NotasEstudiante
        foreach ($request->estudiante_id as $key => $estudianteID) {
            $notas = NotasEstudiante::where('EstudianteID', $estudianteID)->first();
            $notas->Informe = $request->informe_servicio[$key];
            $notas->save();
        }


        return redirect()->route('director_vinculacion.estudiantes')->with('success', 'Se han actualizado los informes de los estudiantes.');
    }



    ///////actualizar nota informe_servicio de los estudiantes
    public function actualizarNota(Request $request, $id)
    {
        $request->validate([
            'nota_servicio' => 'required',
            'estudiante_id' => 'required',
        ]);

        // Buscar el estudiante por su ID y actualizar su nota
        $notas = NotasEstudiante::where('EstudianteID', $request->estudiante_id)->first();

        if ($notas) {
            $notas->Informe = $request->nota_servicio;
            $notas->save();

            return redirect()->route('director_vinculacion.estudiantes')->with('success', 'Se ha actualizado la nota del estudiante.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el estudiante.');
        }
    }












    ///////////////////Creacion de los documentos//////////////////////////////////////////////////////////////

    public function documentosDirector()
    {

        return view('director_vinculacion.documentacion');
    }

    //////////////////////////GENERACION DE DOCUMENTOS///////////////////////////////////////////////

    public function generarInformeDirector(Request $request)
    {

        $plantillaPath = public_path('Plantillas/1.-Informe-Docente-Colaborador.docx');
        $plantilla = new \PhpOffice\PhpWord\TemplateProcessor($plantillaPath);

        // Obtener el usuario autenticado que tenga el estado DirectorVinculación
        $Director = Auth::user();
        $correoDirector = $Director->correoElectronico;
        $Director = ProfesUniversidad::where('correo', $correoDirector)->first();
        // Obtener la relación AsignacionProyecto para este DirectorVinculación
        $asignacion = AsignacionProyecto::where('participanteId', $Director->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->first();
        $proyecto = Proyecto::find($asignacion->proyectoId);

        $plantilla->setValue('NombreProyecto', $proyecto->nombreProyecto);
        $plantilla->setValue('Objetivos', $request->input('Objetivos'));
        $plantilla->setValue('ParticipanteApellido', $proyecto->asignaciones->first()->docenteParticipante->apellidos);

        $plantilla->setValue('ParticipanteNombre', $proyecto->asignaciones->first()->docenteParticipante->nombres);
        $plantilla->setValue('DepartamentoTutor', $proyecto->departamentoTutor);
        $plantilla->setValue('intervencion', $request->input('intervencion'));
        $plantilla->setValue('FechaInicio', $asignacion->inicioFecha);
        $plantilla->setValue('FechaFinalizacion', $asignacion->finalizacionFecha);

        $plantilla->setValue('NombreDirector', $proyecto->director->apellidos . "" . $proyecto->director->nombres);
        $plantilla->setValue('NombreParticipante', $proyecto->asignaciones->first()->docenteParticipante->apellidos . "" . $proyecto->asignaciones->first()->docenteParticipante->nombres);


        $planificadas = $request->input('planificadas');
        $alcanzados = $request->input('alcanzados');
        $porcentaje = $request->input('porcentaje');
        $contadorObjetivos = count($planificadas);

        $plantilla->setValue('alcanzados', $alcanzados[0]);
        $plantilla->setValue('porcentaje', $porcentaje[0]);

        $plantilla->cloneRow('planificadas', $contadorObjetivos);

        foreach ($planificadas as $index => $objetivo) {
            $plantilla->setValue('planificadas#' . ($index + 1), $objetivo);
            $plantilla->setValue('alcanzados#' . ($index + 1), $alcanzados[$index]);
            $plantilla->setValue('porcentaje#' . ($index + 1), $porcentaje[$index]);
        }

        ///obtener los estudiantes que estan asignados al proyecto del DirectorVinculacion
        $estudiantes = DB::table('asignacionproyectos')
            ->join('estudiantes', 'asignacionproyectos.estudianteId', '=', 'estudiantes.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->select('estudiantes.*')
            ->where('estudiantes.estado', 'Aprobado')
            ->get();


        $plantilla->cloneRow('estudiante', count($estudiantes));

        foreach ($estudiantes as $index => $estudiante) {
            $plantilla->setValue('estudiante#' . ($index + 1), $estudiante->apellidos . ' ' . $estudiante->nombres);
            $plantilla->setValue('Carrera#' . ($index + 1), $estudiante->carrera);
            $plantilla->setValue('FechaInicio#' . ($index + 1), $asignacion->inicioFecha);
            $plantilla->setValue('FechaFinalizacion#' . ($index + 1), $asignacion->finalizacionFecha);
            $plantilla->setValue('Observaciones#' . ($index + 1), 'Sin ninguna observacion');

        }

        $plantilla->setValue('Hombres', $request->input('Hombres'));
        $plantilla->setValue('Mujeres', $request->input('Mujeres'));
        $plantilla->setValue('Niños', $request->input('Niños'));
        $plantilla->setValue('capacidad', $request->input('capacidad'));

        $suma = $request->input('Hombres') + $request->input('Mujeres') + $request->input('Niños') + $request->input('capacidad');
        $plantilla->setValue('total', $suma);

        $plantilla->setValue('Observaciones1', $request->input('Observaciones1'));
        $plantilla->setValue('Observaciones2', $request->input('Observaciones2'));
        $plantilla->setValue('Observaciones3', $request->input('Observaciones3'));
        $plantilla->setValue('Observaciones4', $request->input('Observaciones4'));

        $plantilla->setValue('Conclusiones', $request->input('Conclusiones'));
        $plantilla->setValue('Recomendaciones', $request->input('Recomendaciones'));


        ///obtener ActividadesEstudiante las "evidencias" de los estudiantes que estan asignados al proyecto del DirectorVinculacion
        $actividades = DB::table('asignacionproyectos')
            ->join('estudiantes', 'asignacionproyectos.estudianteId', '=', 'estudiantes.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->join('actividades_estudiante', 'asignacionproyectos.estudianteId', '=', 'actividades_estudiante.estudianteId')
            ->select('actividades_estudiante.*')
            ->where('estudiantes.estado', 'Aprobado')
            ->orderBy('actividades_estudiante.fecha', 'asc')
            ->get();

        $plantilla->cloneRow('nombre_actividad', count($actividades));
        $contadorFiguras = 1;


        foreach ($actividades as $index => $actividad) {
            $nombreActividad = $actividad->nombreActividad;
            $nombreFigura = 'Figura ' . $contadorFiguras . ': ' . $nombreActividad;
            $plantilla->setValue('nombre_actividad#' . ($index + 1), $nombreFigura);

            $imagenBase64 = $actividad->evidencias;
            if ($imagenBase64) {
                // Decodifica la imagen en base64
                $imagenDecodificada = base64_decode($imagenBase64);

                // Crea un archivo temporal para la imagen
                $rutaImagen = tempnam(sys_get_temp_dir(), 'img');
                file_put_contents($rutaImagen, $imagenDecodificada);

                // Agrega la imagen a la plantilla
                $plantilla->setImageValue('evidencias#' . ($index + 1), [
                    'path' => $rutaImagen,
                    'width' => 250,
                    'height' => 250,
                    'ratio' => false,
                ]);
            }
            $contadorFiguras++;
        }







        // Descargar el documento generado
        $documentoGeneradoPath = storage_path('app/public/1.-Informe-Docente-Colaborador.docx');
        $plantilla->saveAs($documentoGeneradoPath);

        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
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

        return view('director_vinculacion.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'estudiante', 'periodos'));
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

        return redirect()->route('director_vinculacion.index')->with('success', 'Credenciales actualizadas exitosamente');
    }


    public function baremo(Request $request)
    {
        $profesor = Auth::user()->profesorUniversidad;

        ////encontrar el proyectoId del director
        $proyectos = Proyecto::where('directorId', $profesor->id)->first();



        $inicioFecha = $proyectos->inicioFecha;
        $finalizacionFecha = $proyectos->finFecha;

        return view('director_vinculacion.baremo', compact('proyectos', 'inicioFecha', 'finalizacionFecha'));
    }




    //////////////////////////practicas 1
    public function practicas1()
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


        return view('director_vinculacion.practicai', compact('estudiantes', 'estudiantesCalificar', 'estudiantesCalificados', 'actividades'));
    }



    ////////////guardar notas practicasi
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
            return redirect()->route('director_vinculacion.practicas1')->with('success', 'Notas guardadas exitosamente.');
        } else {
            return redirect()->route('director_vinculacion.practicas1')->with('error', 'Práctica no encontrada.');
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
            return redirect()->route('director_vinculacion.practicas1')->with('success', 'Notas actualizadas exitosamente.');
        } else {
            return redirect()->route('director_vinculacion.practicas1')->with('error', 'Práctica no encontrada.');
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

        return redirect()->route('director_vinculacion.practicas1')->with('success', 'Práctica cerrada exitosamente.');
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
            return redirect()->route('director_vinculacion.practicas2')->with('success', 'Notas guardadas exitosamente.');
        } else {
            return redirect()->route('director_vinculacion.practicas2')->with('error', 'Práctica no encontrada.');
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
            return redirect()->route('director_vinculacion.practicas2')->with('success', 'Notas actualizadas exitosamente.');
        } else {
            return redirect()->route('director_vinculacion.practicas2')->with('error', 'Práctica no encontrada.');
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

        return redirect()->route('director_vinculacion.practicas2')->with('success', 'Práctica cerrada exitosamente.');
    }






































}
