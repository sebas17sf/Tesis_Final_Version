<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\ActividadEstudiante;
use Illuminate\Support\Collection;
use App\Models\AsignacionProyecto;
use App\Models\ParticipanteAdicional;
use App\Models\Estudiante;
use App\Models\AsignacionEstudiantesDirector;
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

            // Buscar si el docente ha sido un participante adicional

            // Obtener el proyecto asociado al participante en AsignacionProyecto
            $proyectosEnEjecucion = AsignacionProyecto::where('participanteId', $participanteID)
            ->whereHas('proyecto', function ($query) {
                $query->where('estado', 'Ejecucion');
            })
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->with(['proyecto', 'estudiante'])
            ->distinct('proyectoId')
            ->get();

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
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('userId', $usuario->userId)->get();

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        return view('ParticipanteVinculacion.cambiarCredencialesUsuario', compact('usuario', 'userSessions'));
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





}
