<?php

namespace App\Http\Controllers;

use App\Models\DirectorVinculacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\UsuariosSession;
use App\Models\ActividadEstudiante;

use App\Models\AsignacionEstudiantesDirector;
use App\Models\ProfesUniversidad;
use App\Models\ParticipanteAdicional;
use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\NotasEstudiante;


class DirectorVinculacionController extends Controller
{
    public function index(Request $request)
    {
        $correoDirector = Auth::user()->correoElectronico;
        $Director = ProfesUniversidad::where('correo', $correoDirector)->first();
        $proyectosEjecucion = null;
        $proyectosTerminados = null;

        $elementosPorPaginaTerminados = $request->input('elementosPorPaginaTerminados', 10);

        if ($Director) {
            $DirectorID = $Director->id;

            // Obtener proyectos de asignación del director en ejecución

            $proyectosEjecucion = Proyecto::where('DirectorID', $DirectorID)
                ->where('estado', 'Ejecucion')
                ->get();

            // Obtener proyectos terminados con paginación
            $proyectosTerminados = Proyecto::where('directorId', $DirectorID)
                ->paginate($elementosPorPaginaTerminados);
        }

        return view('director_vinculacion.index', compact('proyectosEjecucion', 'proyectosTerminados', 'elementosPorPaginaTerminados'));
    }


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

        return redirect()->route('director.repartoEstudiantes')->with('success', 'Se ha eliminado el estudiante correctamente.');
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

            // Obtener estudiantes calificados en proyectos en ejecución
            $estudiantesCalificadosIds = NotasEstudiante::whereIn('estudianteId', $estudiantesAsignados)
                ->where('informe', '!=', 'Pendiente')
                ->pluck('estudianteId')
                ->toArray();

            // Filtrar solo los estudiantes calificados que estén asignados a proyectos en ejecución
            $estudiantesCalificados = Estudiante::whereIn('estudianteId', $estudiantesCalificadosIds)
                ->whereHas('proyectos', function ($query) use ($director) {
                    $query->where('directorId', $director->id)
                    ->where('estado', 'Aprobado');
                })
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

            return redirect()->route('director_vinculacion.estudiantes')->with('success', 'Se ha actualizado la nota del estudiante correctamente.');
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
        $plantilla->setValue('FechaInicio', $proyecto->first()->asignaciones->first()->inicioFecha);
        $plantilla->setValue('FechaFinalizacion', $proyecto->first()->asignaciones->first()->finalizacionFecha);

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
            ->where('proyectos.directorId', $Director->id)
            ->get();

        $plantilla->cloneRow('estudiante', count($estudiantes));

        foreach ($estudiantes as $index => $estudiante) {
            $plantilla->setValue('estudiante#' . ($index + 1), $estudiante->Apellidos . ' ' . $estudiante->Nombres);
            $plantilla->setValue('Carrera#' . ($index + 1), $estudiante->Carrera);
            $plantilla->setValue('FechaInicio#' . ($index + 1), $proyecto->asignaciones->inicioFecha);
            $plantilla->setValue('FechaFinalizacion#' . ($index + 1), $proyecto->asignaciones->finalizacionFecha);
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
            ->where('proyectos.directorId', $Director->id)
            ->select('actividades_estudiante.*')
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
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('userId', $usuario->userId)->get();

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        return view('director_vinculacion.cambiarCredencialesUsuario', compact('usuario', 'userSessions'));
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
















































}
