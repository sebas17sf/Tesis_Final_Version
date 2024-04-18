<?php

namespace App\Http\Controllers;

use App\Models\DirectorVinculacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\ProfesUniversidad;
use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\ParticipanteVincunlacion;
use App\Models\NotasEstudiante;


class DirectorVinculacionController extends Controller
{
    public function index(Request $request)
    {
        $correoDirector = Auth::user()->CorreoElectronico;
        $Director = ProfesUniversidad::where('Correo', $correoDirector)->first();
        $proyectosEjecucion = null;
        $proyectosTerminados = null;
    
        $elementosPorPaginaTerminados = $request->input('elementosPorPaginaTerminados', 10);
    
        if ($Director) {
            $DirectorID = $Director->id;
    
            // Obtener proyectos en ejecución sin paginación
            $proyectosEjecucion = Proyecto::where('id_directorProyecto', $DirectorID)
                ->where('Estado', 'Ejecucion')
                ->get();
    
            // Obtener proyectos terminados con paginación
            $proyectosTerminados = Proyecto::where('id_directorProyecto', $DirectorID)
                ->where('Estado', 'Terminado')
                ->paginate($elementosPorPaginaTerminados);
        }
    
        return view('director_vinculacion.index', compact('proyectosEjecucion', 'proyectosTerminados', 'elementosPorPaginaTerminados'));
    }
    





    public function estudiantes()
    {
        $correoDirector = Auth::user()->CorreoElectronico;
        $director = ProfesUniversidad::where('Correo', $correoDirector)->first();

        $estudiantesConNotasPendientes = [];
        $estudiantesCalificados = [];

        if ($director) {
            $asignaciones = AsignacionProyecto::where('DirectorID', $director->id)->get();
            $estudiantesAsignados = $asignaciones->pluck('EstudianteID')->toArray();

            // Obtener estudiantes con notas pendientes en proyectos en ejecución
            $estudiantesConNotasPendientesIds = NotasEstudiante::whereIn('EstudianteID', $estudiantesAsignados)
                ->where('Informe', 'Pendiente')
                ->pluck('EstudianteID')
                ->toArray();

            // Filtrar solo los estudiantes con notas pendientes que estén asignados a proyectos en ejecución
            $estudiantesConNotasPendientes = Estudiante::whereIn('EstudianteID', $estudiantesConNotasPendientesIds)
                ->whereHas('proyectos', function ($query) use ($director) {
                    $query->where('id_directorProyecto', $director->id)
                        ->where('Estado', 'Ejecucion');
                })
                ->get();

            // Obtener estudiantes calificados en proyectos en ejecución
            $estudiantesCalificadosIds = NotasEstudiante::whereIn('EstudianteID', $estudiantesAsignados)
                ->where('Informe', '!=', 'Pendiente')
                ->pluck('EstudianteID')
                ->toArray();

            // Filtrar solo los estudiantes calificados que estén asignados a proyectos en ejecución
            $estudiantesCalificados = Estudiante::whereIn('EstudianteID', $estudiantesCalificadosIds)
                ->whereHas('proyectos', function ($query) use ($director) {
                    $query->where('id_directorProyecto', $director->id)
                        ->where('Estado', 'Ejecucion');
                })
                ->get();
        }

        return view('director_vinculacion.estudiantes', compact('estudiantesConNotasPendientes', 'estudiantesCalificados'));
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
        $correoDirector = $Director->CorreoElectronico;
        $Director = ProfesUniversidad::where('Correo', $correoDirector)->first();

        // Obtener la relación AsignacionProyecto para este DirectorVinculación
        $asignacion = AsignacionProyecto::where('DirectorID', $Director->id)->first();

        // Obtener el proyecto de la asignación
        $proyecto = Proyecto::find($asignacion->ProyectoID);

        $plantilla->setValue('NombreProyecto', $proyecto->NombreProyecto);
        $plantilla->setValue('Objetivos', $request->input('Objetivos'));
        $plantilla->setValue('ParticipanteApellido', $proyecto->ApellidoAsignado);
        $plantilla->setValue('ParticipanteNombre', $proyecto->NombreAsignado);
        $plantilla->setValue('DepartamentoTutor', $proyecto->DepartamentoTutor);
        $plantilla->setValue('intervencion', $request->input('intervencion'));
        $plantilla->setValue('FechaInicio', $proyecto->FechaInicio);
        $plantilla->setValue('FechaFinalizacion', $proyecto->FechaFinalizacion);

        $plantilla->setValue('NombreDirector', $proyecto->ApellidoProfesor . "" . $proyecto->NombreProfesor);
        $plantilla->setValue('NombreParticipante', $proyecto->ApellidoAsignado . "" . $proyecto->NombreAsignado);


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
        $estudiantes = DB::table('AsignacionProyectos')
            ->join('Estudiantes', 'AsignacionProyectos.EstudianteID', '=', 'Estudiantes.EstudianteID')
            ->join('Proyectos', 'AsignacionProyectos.ProyectoID', '=', 'Proyectos.ProyectoID')
            ->where('Proyectos.CorreoElectronicoTutor', $correoDirector)
            ->select('Estudiantes.*')
            ->get();

        $plantilla->cloneRow('estudiante', count($estudiantes));

        foreach ($estudiantes as $index => $estudiante) {
            $plantilla->setValue('estudiante#' . ($index + 1), $estudiante->Apellidos . ' ' . $estudiante->Nombres);
            $plantilla->setValue('Carrera#' . ($index + 1), $estudiante->Carrera);
            $plantilla->setValue('FechaInicio#' . ($index + 1), $proyecto->FechaInicio);
            $plantilla->setValue('FechaFinalizacion#' . ($index + 1), $proyecto->FechaFinalizacion);
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
        $actividades = DB::table('AsignacionProyectos')
            ->join('Estudiantes', 'AsignacionProyectos.EstudianteID', '=', 'Estudiantes.EstudianteID')
            ->join('Proyectos', 'AsignacionProyectos.ProyectoID', '=', 'Proyectos.ProyectoID')
            ->join('actividades_estudiante', 'AsignacionProyectos.EstudianteID', '=', 'actividades_estudiante.EstudianteID')
            ->where('Proyectos.CorreoElectronicoTutor', $correoDirector)
            ->select('actividades_estudiante.*')
            ->get();

        $plantilla->cloneRow('nombre_actividad', count($actividades));
        $contadorFiguras = 1;

        foreach ($actividades as $index => $actividad) {
            $nombreActividad = $actividad->nombre_actividad;
            $nombreFigura = 'Figura ' . $contadorFiguras . ': ' . $nombreActividad;
            $plantilla->setValue('nombre_actividad#' . ($index + 1), $nombreFigura);

            $rutaImagenDB = $actividad->evidencias;
            if (strpos($rutaImagenDB, 'public/') === 0) {
                $rutaImagenDB = substr($rutaImagenDB, 7);
            }
            $rutaImagen = storage_path('app/public/' . $rutaImagenDB);
            if (file_exists($rutaImagen)) {
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


















































}
