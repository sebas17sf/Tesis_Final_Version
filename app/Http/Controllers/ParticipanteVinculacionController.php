<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Support\Collection;
use App\Models\AsignacionProyecto;
use App\Models\ParticipanteAdicional;
use App\Models\Estudiante;
use App\Models\AsignacionEstudiantesDirector;
use App\Models\NotasEstudiante;

class ParticipanteVinculacionController extends Controller
{

    public function index(Request $request)
{
    $elementosPorPagina = $request->input('elementosPorPagina', 10);

    $correoParticipante = Auth::user()->CorreoElectronico;
    $participante = ProfesUniversidad::where('Correo', $correoParticipante)->first();
    $proyectosEnEjecucion = null;
    $proyectosTerminados = null;

    if ($participante) {
        $participanteID = $participante->id;

        // Buscar si el docente ha sido un participante adicional
        $participanteAdicional = ParticipanteAdicional::where('ParticipanteID', $participanteID)->first();

        // Obtener proyectos terminados en los que el docente participa como principal
        $proyectosTerminadosQuery = Proyecto::where('id_docenteParticipante', $participanteID)
            ->where('Estado', 'Terminado')
            ->orderBy('created_at', 'desc');

        // Si el docente ha sido un participante adicional, agregar sus proyectos terminados
        if ($participanteAdicional) {
            $proyectosTerminadosQuery->orWhereIn('ProyectoID', function ($query) use ($participanteID) {
                $query->select('ProyectoID')->from('participantesAdicionales')->where('ParticipanteID', $participanteID);
            });
        }

        // Obtener proyectos en ejecución en los que el docente participa como principal
        $proyectosEnEjecucionQuery = Proyecto::where('id_docenteParticipante', $participanteID)
            ->where('Estado', 'Ejecucion')
            ->orderBy('created_at', 'desc');

        $proyectosEnEjecucion = $proyectosEnEjecucionQuery->paginate($elementosPorPagina);
        $proyectosTerminados = $proyectosTerminadosQuery->paginate($elementosPorPagina);
    }

    return view('ParticipanteVinculacion.index', compact('proyectosEnEjecucion', 'proyectosTerminados'));
}

    
    







    public function estudiantes()
    {
        $participante = Auth::user();

        $estudiantes = [];
        $estudiantesConNotas = [];

        if ($participante) {
            $correoParticipante = $participante->CorreoElectronico;

            // Obtener el participante (profesor) por su correo electrónico
            $participante = ProfesUniversidad::where('Correo', $correoParticipante)->first();

            if ($participante) {
                // Obtener los proyectos asociados al participante
                $proyectos = Proyecto::where('id_docenteParticipante', $participante->id)->pluck('ProyectoID');

                // Verificar si hay docentes adicionales asociados al proyecto
                $docentesAdicionales = ParticipanteAdicional::whereIn('ProyectoID', $proyectos)->exists();

                if ($docentesAdicionales) {
                    // Si hay docentes adicionales, mostrar los estudiantes asignados a través de AsignacionEstudiantesDirector para cada docente
                    $todosEstudiantes = AsignacionEstudiantesDirector::whereIn('ParticipanteID', function ($query) use ($proyectos) {
                        $query->select('id')->from('participantesAdicionales')->whereIn('ProyectoID', $proyectos);
                    })
                        ->pluck('EstudianteID');

                    // Obtener el estudiante asignado al participante principal a través de AsignacionEstudiantesDirector
                    $estudianteParticipante = AsignacionEstudiantesDirector::where('ParticipanteID', $participante->id)
                        ->pluck('EstudianteID');

                    // Fusionar los estudiantes asignados a todos los participantes
                    $todosEstudiantes = $todosEstudiantes->merge($estudianteParticipante)->unique();
                } else {
                    // Si no hay docentes adicionales, mostrar todos los estudiantes asignados al docente participante
                    $todosEstudiantes = AsignacionEstudiantesDirector::where('ParticipanteID', $participante->id)
                        ->pluck('EstudianteID');
                }

                // Obtener estudiantes con notas y sin notas según la lógica previamente definida
                $estudiantesConNotas = Estudiante::with('notas')
                    ->whereIn('EstudianteID', $todosEstudiantes)
                    ->whereHas('proyectos', function ($query) {
                        $query->where('Estado', 'Ejecucion');
                    })
                    ->get();

                $estudiantes = Estudiante::whereIn('EstudianteID', $todosEstudiantes)
                    ->whereDoesntHave('notas')
                    ->get();
            }
        }


        return view('ParticipanteVinculacion.estudiantes', compact('estudiantes', 'estudiantesConNotas'));
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
            $nota->EstudianteID = $estudianteID;
            $nota->Tareas = $cumpleTareas[$key];
            $nota->Resultados_Alcanzados = $resultadosAlcanzados[$key];
            $nota->Conocimientos = $conocimientosArea[$key];
            $nota->Adaptabilidad = $adaptabilidad[$key];
            $nota->Aplicacion = $Aplicacion[$key];
            $nota->Capacidad_liderazgo = $capacidadLiderazgo[$key];
            $nota->Asistencia = $asistenciaPuntual[$key];
            $nota->Informe = $informeServicio[$key] ?? 'Pendiente';
            $nota->save();
        }

        // Puedes redirigir a una página de éxito o hacer cualquier otra acción necesaria
        return redirect()->route('ParticipanteVinculacion.estudiantes')->with('success', 'Notas guardadas exitosamente.');
    }


    public function configuracion()
    {
        return view('ParticipanteVinculacion.configuracion');
    }

    public function actualizarConfiguracion(Request $request, $id)
    {
        // Obtener el ID del usuario autenticado
        $id = Auth::user()->UserID;


        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'contrasena' => 'required|string|min:6',
        ]);

        // Buscar al usuario por su ID
        $user = Usuario::find($id);


        // Actualizar los datos del usuario
        $user->update([
            'Nombre' => $request->nombre,
            'Apellido' => $request->apellido,
            'Contrasena' => bcrypt($request->contrasena),
        ]);

        return redirect()->route('ParticipanteVinculacion.index')->with('success', 'Perfil actualizado con éxito');
    }





}
