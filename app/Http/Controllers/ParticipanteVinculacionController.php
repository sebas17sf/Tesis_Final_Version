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

        $correoParticipante = Auth::user()->CorreoElectronico;
        $participante = ProfesUniversidad::where('Correo', $correoParticipante)->first();
        $proyectosEnEjecucion = null;
        $proyectosTerminados = null;

        if ($participante) {
            $participanteID = $participante->id;

            // Buscar si el docente ha sido un participante adicional

            // Obtener el proyecto asociado al participante en AsignacionProyecto
            $proyectosEnEjecucion = AsignacionProyecto::where('ParticipanteID', $participanteID)
            ->whereHas('proyecto', function ($query) {
                $query->where('Estado', 'Ejecucion');
            })
            ->whereHas('estudiante', function ($query) {
                $query->where('Estado', 'Aprobado');
            })
            ->with(['proyecto', 'estudiante'])
            ->distinct('ProyectoID')
            ->get();

            $proyectosTerminados = AsignacionProyecto::where('ParticipanteID', $participanteID)
            ->whereHas('proyecto', function ($query) {
                $query->where('Estado', 'Terminado');
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
            $correoParticipante = $participante->CorreoElectronico;

            // Obtener el participante (profesor) por su correo electrónico
            $participante = ProfesUniversidad::where('Correo', $correoParticipante)->first();


            if ($participante) {
                // Obtener los proyectos asociados al participante de AsignacionProyecto
                $proyectos = AsignacionProyecto::where('ParticipanteID', $participante->id)
                    ->pluck('ProyectoID');


                // Obtener los estudiantes con estado Aprobado asociados a los proyectos de AsignacionProyecto
                $todosEstudiantes = AsignacionProyecto::whereIn('ParticipanteID', [$participante->id])
                    ->whereHas('estudiante', function ($query) {
                        $query->where('Estado', 'Aprobado');
                    })
                    ->pluck('EstudianteID');


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

            $actividadesEstudiantes = ActividadEstudiante::join('asignacionProyectos', 'actividades_estudiante.EstudianteID', '=', 'asignacionProyectos.EstudianteID')
                ->join('proyectos', 'asignacionProyectos.ProyectoID', '=', 'proyectos.ProyectoID')
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
        $nota->Tareas = $request->input('tareas');
        $nota->Resultados_Alcanzados = $request->input('resultados_alcanzados');
        $nota->Conocimientos = $request->input('conocimientos_area');
        $nota->Adaptabilidad = $request->input('adaptabilidad');
        $nota->Aplicacion = $request->input('Aplicacion');
        $nota->Capacidad_liderazgo = $request->input('capacidad_liderazgo');
        $nota->Asistencia = $request->input('asistencia_puntual');
         $nota->save();

        return redirect()->route('ParticipanteVinculacion.estudiantes')->with('success', 'Notas actualizadas exitosamente.');
    }



    ////////////////////////////cambiar credenciales
    public function cambiarCredencialesUsuario()
    {
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('UserID', $usuario->UserID)->get();

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
