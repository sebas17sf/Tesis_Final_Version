<?php

namespace App\Http\Controllers;

use App\Models\ActividadesPracticas;
use App\Models\Cohorte;
use App\Models\Periodo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\NrcPracticas1;
use App\Models\Estudiante;
use App\Models\AsignacionProyecto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\ProfesUniversidad;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\UsuariosSession;

use App\Models\ActividadEstudiante;
use App\Models\Usuario;
use Intervention\Image\Facades\Image;




class EstudianteController extends Controller
{
    public function create()
    {
         $periodos = Periodo::all();
         if (Auth::check() && Auth::user()->estudiante) {
             return redirect()->route('estudiantes.index')->with('token', Session::get('user_token'));
        }


         return view('estudiantes.create', compact( 'periodos'));
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario antes de intentar crear el estudiante
        $validatedData = $request->validate([
            'Nombres' => '',
            'Apellidos' => '',
            'espe_id' => '',
            'celular' => '',
            'cedula' => '',
            'Cohorte' => '',
            'Periodo' => '',
            'Carrera' => '',
            'Provincia' => '',
            'Departamento' => '',
         ]);


        // Obtén el UserID del usuario autenticado
        $userId = Auth::id();
        $CorreoElectronico = Auth::user()->CorreoElectronico;

        $fechaActual = now();
        $periodoSeleccionado = $validatedData['Periodo'];
        $periodo = Periodo::find($periodoSeleccionado); // Obtener el periodo utilizando su ID

        if (!$periodo) {
            return Redirect::back()->with('error', 'El periodo seleccionado no existe.');
        }

        $fechaFinPeriodo = $periodo->PeriodoFin;

        // Comprueba si la fecha actual es mayor que la fecha de finalización del período
        if ($fechaActual > $fechaFinPeriodo) {
            return Redirect::back()->with('error', 'No puedes registrar un estudiante en un período académico que ya ha finalizado.');
        }

        // Crea un nuevo registro de Estudiante y asocia el UserID
        Estudiante::create([
            'UserID' => $userId,
            'Nombres' => $validatedData['Nombres'],
            'Apellidos' => $validatedData['Apellidos'],
            'espe_id' => $validatedData['espe_id'],
            'celular' => $validatedData['celular'],
            'cedula' => $validatedData['cedula'],
            'Cohorte' => $validatedData['Cohorte'], // Utiliza el ID de cohorte proporcionado en el formulario
            'id_periodo' => $validatedData['Periodo'], // Utiliza el ID de periodo proporcionado en el formulario
            'Carrera' => $validatedData['Carrera'],
            'Correo' => $CorreoElectronico,
            'Departamento' => $validatedData['Departamento'],
            'Provincia' => $validatedData['Provincia'],
             'comentario' => 'Sin comentarios',
            'Estado' => 'En proceso de revisión'
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Datos del Estudiante ingresados correctamente');
    }


    // Controlador Estudiante

    public function index()
    {
        // Verifica si el usuario está autenticado y si es un estudiante
        if (Auth::check() && Auth::user()->estudiante) {
            // Obtén los datos del estudiante relacionado con el usuario
            $estudiante = Auth::user()->estudiante;

            $periodo = Periodo::find($estudiante->id_periodo);

            // Obtén la asignación de proyecto del estudiante (si existe)
            $asignacionProyecto = AsignacionProyecto::where('EstudianteID', $estudiante->EstudianteID)->first();

            return view('estudiantes.index', compact('estudiante', 'asignacionProyecto', 'periodo'));
        }

        return redirect()->route('login')->with('error', 'Solo puede tener abierta una sesión, no dos o más.');
    }









    //////editar estudiante
    public function edit(Estudiante $estudiante)
    {
        $periodos = Periodo::all();
         return view('estudiantes.edit', compact('estudiante', 'periodos'));
    }


    public function update(Request $request, Estudiante $estudiante)
    {
        // Valida los datos del formulario antes de actualizar el estudiante
        $validatedData = $request->validate([
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'espe_id' => 'required|string|max:255',
            'celular' => 'required|string',
            'cedula' => 'required|string|max:11',
            'Cohorte' => 'required',
            'Periodo' => 'required',
            'Carrera' => 'required|string|max:255',
            'Provincia' => 'required|string|max:255',
            'Departamento' => 'required|string|max:255',
        ]);

        // Actualiza los campos del estudiante con los datos validados
        $estudiante->update([
             'Nombres' => $validatedData['Nombres'],
            'Apellidos' => $validatedData['Apellidos'],
            'espe_id' => $validatedData['espe_id'],
            'celular' => $validatedData['celular'],
            'cedula' => $validatedData['cedula'],
            'Cohorte' => $validatedData['Cohorte'], // Utiliza el ID de cohorte proporcionado en el formulario
            'id_periodo' => $validatedData['Periodo'], // Utiliza el ID de periodo proporcionado en el formulario
            'Carrera' => $validatedData['Carrera'],
             'Provincia' => $validatedData['Provincia'],
            'Departamento' => $validatedData['Departamento'],
            'comentario' => 'Sin comentarios',
            'Estado' => 'En proceso de revisión'
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Información del Estudiante actualizada correctamente');
    }


    /////renviar informacion para aceptacion
    public function resend(Request $request, Estudiante $estudiante)
    {
        // Verificar si el estado actual es "Negado"
        if ($estudiante->Estado === 'Negado') {
            // Actualizar el estado a "En proceso de revisión"
            $estudiante->update([
                'Estado' => 'En proceso de revision',
            ]);

            // Redirigir al estudiante a la página de información con un mensaje de éxito
            return redirect()->route('estudiantes.index', ['estudiante' => $estudiante->EstudianteID])->with('success', 'Información reenviada con éxito');
        } else {
            // Si el estado no es "Negado", mostrar un mensaje de error
            return redirect()->route('estudiantes.index', ['estudiante' => $estudiante->EstudianteID])->with('error', 'No puede renviar la informacion. Usted ya tiene un proceso de verificacion en curso.');
        }
    }



    ///vista a practica1.blade.php
    public function practica1()
    {
        $user = Auth::user();
        $profesores = ProfesUniversidad::all();

        $nrcpracticas1 = NrcPracticas1::all();

        $estudiante = $user->estudiante;

         $actividades = ActividadesPracticas::where('EstudianteID', $estudiante->EstudianteID)->get();



        // Verifica si el usuario autenticado es un estudiante y su estado es "Aprobado-practicas"
        if ($estudiante && $estudiante->Estado === 'Aprobado-practicas') {
            $correoEstudiante = $estudiante->Usuario->CorreoElectronico;
            $empresas = Empresa::all();

            $practicaPendiente = PracticaI::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'En ejecucion')->first();
             $totalHoras = $actividades->sum('horas');

             $estadoPractica = PracticaI::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'Terminado')->first();

            if ($estadoPractica) {
                 return redirect()->route('estudiantes.practica2');
            }

            return view('estudiantes.practica1', compact('estudiante', 'correoEstudiante', 'empresas', 'practicaPendiente', 'estadoPractica', 'profesores', 'nrcpracticas1', 'actividades', 'totalHoras'));
        }

        // Si no cumple con los requisitos, muestra un mensaje de alerta y redirige a otra página
        return redirect()->route('estudiantes.index')->with('error', 'No tiene acceso a esta página.');
    }



    public function practica2()
    {
        $user = Auth::user();
        $estudiante = $user->estudiante;

        if ($estudiante && $estudiante->Estado === 'Aprobado-practicas') {
            $correoEstudiante = $estudiante->Usuario->CorreoElectronico;
            $empresas = Empresa::all();

            // Consulta para PracticaI
            $practicaPendienteI = PracticaI::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'Terminado')->first();
            $estadoPracticaI = PracticaI::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'Terminado')->first();
            $horasPlanificadasI = $practicaPendienteI ? $practicaPendienteI->HorasPlanificadas : 0;

            // Consulta para PracticaII
            $practicaPendiente = PracticaII::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'En ejecucion')->first();
            $estadoPractica = PracticaII::where('EstudianteID', $estudiante->EstudianteID)->where('Estado', 'Terminado')->first();

            return view('estudiantes.practica2', compact('estudiante', 'correoEstudiante', 'empresas', 'horasPlanificadasI', 'practicaPendiente', 'estadoPractica'));
        }

        return redirect()->route('estudiantes.index')->with('error', 'No tiene acceso a esta página.');
    }




    ///////guardar practicas
    public function guardarPracticas(Request $request)
    {
         $validatedData = $request->validate([
            'Practicas' => 'required',
            'Empresa' => 'required',
            'ID_tutorAcademico' => 'required',
            'nrc' => 'required',
            'CedulaTutorEmpresarial' => 'required',
            'NombreTutorEmpresarial' => 'required',
            'Funcion' => 'required',
            'TelefonoTutorEmpresarial' => 'required',
            'EmailTutorEmpresarial' => 'required',
            'DepartamentoTutorEmpresarial' => 'required',
            'EstadoAcademico' => 'required',
            'FechaInicio' => 'required',
            'FechaFinalizacion' => 'required',
            'HorasPlanificadas' => 'required',
            'HoraEntrada' => 'required',
            'HoraSalida' => 'required',
            'AreaConocimiento' => 'required',
        ]);


         $userId = Auth::id();

         $estudiante = Estudiante::where('UserID', $userId)->first();

         if ($estudiante) {
            PracticaI::create([
                'EstudianteID' => $estudiante->EstudianteID,
                'tipoPractica' => $validatedData['Practicas'],
                'IDEmpresa' => $validatedData['Empresa'],
                'ID_tutorAcademico' => $validatedData['ID_tutorAcademico'],
                'id_nrc_practicas1' => $validatedData['nrc'],
                'CedulaTutorEmpresarial' => $validatedData['CedulaTutorEmpresarial'],
                'NombreTutorEmpresarial' => $validatedData['NombreTutorEmpresarial'],
                'Funcion' => $validatedData['Funcion'],
                'TelefonoTutorEmpresarial' => $validatedData['TelefonoTutorEmpresarial'],
                'EmailTutorEmpresarial' => $validatedData['EmailTutorEmpresarial'],
                'DepartamentoTutorEmpresarial' => $validatedData['DepartamentoTutorEmpresarial'],
                'EstadoAcademico' => $validatedData['EstadoAcademico'],
                'FechaInicio' => $validatedData['FechaInicio'],
                'FechaFinalizacion' => $validatedData['FechaFinalizacion'],
                'HorasPlanificadas' => $validatedData['HorasPlanificadas'],
                'HoraEntrada' => $validatedData['HoraEntrada'],
                'HoraSalida' => $validatedData['HoraSalida'],
                'AreaConocimiento' => $validatedData['AreaConocimiento'],
                'Estado' => 'PracticaI'
            ]);

            return redirect()->route('estudiantes.index')->with('success', 'Práctica guardada exitosamente');
        }

         return redirect()->route('estudiantes.index')->with('error', 'No se encontró información del estudiante.');
    }

     public function guardarPracticas2(Request $request)
    {
        // Valida los datos del formulario antes de intentar crear la práctica
        $validatedData = $request->validate([
            'Nivel' => 'required|string|max:255',
            'Practicas' => 'required|string|max:255',
            'DocenteTutor' => 'required|string|max:255',
            'Empresa' => 'required|string|max:255',
            'CedulaTutorEmpresarial' => 'required|string|max:255',
            'NombreTutorEmpresarial' => 'required|string|max:255',
            'Funcion' => 'required|string|max:255',
            'TelefonoTutorEmpresarial' => 'required|string|max:10',
            'EmailTutorEmpresarial' => 'required|string|email|max:255',
            'DepartamentoTutorEmpresarial' => 'required|string|max:255',
            'EstadoAcademico' => 'required|string|max:255',
            'FechaInicio' => 'required|date',
            'FechaFinalizacion' => 'required|date',
            'HorasPlanificadas' => 'required|string|max:255',
            'HoraEntrada' => 'required|string|max:255',
            'HoraSalida' => 'required|string|max:255',
            'AreaConocimiento' => 'required|string|max:255',

        ]);

        // Obtén el UserID del usuario autenticado
        $userId = Auth::id();

        // Obtén el modelo Estudiante del usuario autenticado
        $estudiante = Estudiante::where('UserID', $userId)->first();

        // Verifica si se encontró el estudiante
        if ($estudiante) {
            // Crea un nuevo registro de PracticaI y asocia los datos del estudiante
            PracticaII::create([
                'EstudianteID' => $estudiante->EstudianteID,
                'NombreEstudiante' => $estudiante->Nombres,
                'ApellidoEstudiante' => $estudiante->Apellidos,
                'Departamento' => $estudiante->Departamento,
                'Nivel' => $validatedData['Nivel'],
                'Practicas' => $validatedData['Practicas'],
                'DocenteTutor' => $validatedData['DocenteTutor'],
                'Empresa' => $validatedData['Empresa'],
                'CedulaTutorEmpresarial' => $validatedData['CedulaTutorEmpresarial'],
                'NombreTutorEmpresarial' => $validatedData['NombreTutorEmpresarial'],
                'Funcion' => $validatedData['Funcion'],
                'TelefonoTutorEmpresarial' => $validatedData['TelefonoTutorEmpresarial'],
                'EmailTutorEmpresarial' => $validatedData['EmailTutorEmpresarial'],
                'DepartamentoTutorEmpresarial' => $validatedData['DepartamentoTutorEmpresarial'],
                'EstadoAcademico' => $validatedData['EstadoAcademico'],
                'FechaInicio' => $validatedData['FechaInicio'],
                'FechaFinalizacion' => $validatedData['FechaFinalizacion'],
                'HorasPlanificadas' => $validatedData['HorasPlanificadas'],
                'HoraEntrada' => $validatedData['HoraEntrada'],
                'HoraSalida' => $validatedData['HoraSalida'],
                'AreaConocimiento' => $validatedData['AreaConocimiento'],
                'Estado' => 'PracticaII'
            ]);

            return redirect()->route('estudiantes.index')->with('success', 'Práctica guardada exitosamente');
        }

        // Manejo de error si no se encuentra el estudiante
        return redirect()->route('estudiantes.index')->with('error', 'No se encontró información del estudiante.');
    }

    ////////////////////guardar actividades
    public function guardarActividad(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'actividades' => 'required|string',
        'horas' => 'required|integer',
        'evidencias' => 'required|file|mimes:jpeg,jpg,png|max:500000',
        'nombre_actividad' => 'required|string',
    ]);

    $estudiante = Auth::user()->estudiante;
    $asignaciones = $estudiante->asignaciones;

    if (!$asignaciones->count()) {
        return redirect()->route('estudiantes.documentos')->with('error', 'No está asignado a un proyecto.');
    }

    if ($request->hasFile('evidencias')) {
        $evidencia = $request->file('evidencias');

        // Comprimir la imagen y convertirla en base64
        $compressedImage = Image::make($evidencia)->encode('jpg', 75);
        $evidenciaBase64 = base64_encode($compressedImage->encoded);

        $actividadEstudiante = new ActividadEstudiante([
            'EstudianteID' => $estudiante->EstudianteID,
            'fecha' => $request->input('fecha'),
            'actividades' => $request->input('actividades'),
            'numero_horas' => $request->input('horas'),
            'evidencias' => $evidenciaBase64,
            'nombre_actividad' => $request->input('nombre_actividad'),
        ]);

        try {
            $actividadEstudiante->save();

            return redirect()->route('estudiantes.documentos')->with('success', 'Actividad registrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar la actividad: ' . $e->getMessage());
        }
    } else {
        return redirect()->back()->with('error', 'Verifica el ingreso de los datos en la Actividad.');
    }
}


    ////eliminar actividad
    public function eliminarActividad($id)
    {
        $actividad = ActividadEstudiante::findOrFail($id);
        $actividad->delete();

        return redirect()->route('estudiantes.documentos')->with('success', 'Actividad eliminada exitosamente.');
    }

    //////editar actividad
    public function editarActividad($id)
    {
        $actividad = ActividadEstudiante::findOrFail($id);

        return view('estudiantes.documentos', compact('actividad'));
    }

    public function updateActividad(Request $request, $id)
{

    $actividad = ActividadEstudiante::findOrFail($id);

    if ($request->hasFile('evidencias')) {
        $evidencia = $request->file('evidencias');


        $maxFileSize = 500000;
        if ($evidencia->getSize() > $maxFileSize) {
            return redirect()->back()->with('error', 'La imagen es muy pesada. El tamaño máximo permitido es de 500 KB.');
        }

        $evidenciaBase64 = base64_encode(File::get($evidencia));

        $actividad->update([
            'fecha' => $request->input('fecha'),
            'actividades' => $request->input('actividades'),
            'numero_horas' => $request->input('numero_horas'),
            'evidencias' => $evidenciaBase64,
            'nombre_actividad' => $request->input('nombre_actividad'),
        ]);

        return redirect()->route('estudiantes.documentos')->with('success', 'Actividad actualizada exitosamente.');
    } else {
        return redirect()->back()->with('error', 'Verifica el ingreso de los datos en la Actividad.');
    }
}




    public function configuracion()
    {
        return view('estudiantes.configuracion');
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

        return redirect()->route('estudiantes.index')->with('success', 'Perfil actualizado con éxito');
    }


    ////////certificado de matricula estudiante///////////////////

    public function certificadoMatricula()
    {
         $estudiante = Auth::user()->estudiante;

        if ($estudiante) {
             $pdf = PDF::loadView('estudiantes.certificadoMatricula', compact('estudiante'));

             return $pdf->download('certificadoMatricula.pdf');
        } else {
             return redirect()->back()->with('error', 'No se pudo encontrar al estudiante.');
        }
    }



    ////////////////////guardar actividad practica 1
    public function guardarActividadPractica1(Request $request)
    {
        $request->validate([
            'EstudianteID' => 'required',
            'PracticasI' => 'required',
            'Actividad' => 'required',
            'horas' => 'required',
            'observaciones' => 'required',
            'fechaActividad' => 'required',
            'departamento' => 'required',
            'funcion' => 'required',
            'evidencia' => 'required',
        ]);


        $datosActividad = $request->only([
            'EstudianteID',
            'PracticasI',
            'Actividad',
            'horas',
            'observaciones',
            'fechaActividad',
            'departamento',
            'funcion',
        ]);



        $evidencia = $request->file('evidencia');

        try {
            if ($evidencia) {
                $maxFileSize = 500000;
                if ($evidencia->getSize() > $maxFileSize) {
                    return redirect()->back()->with('error', 'La imagen es muy pesada. El tamaño máximo permitido es de 500 KB.');
                }

                 $img = Image::make($evidencia)->encode('jpg', 75);
                $datosActividad['evidencia'] = base64_encode($img->encoded);
            }

            $datosActividad['IDPracticasI'] = $request->PracticasI;

            ActividadesPracticas::create($datosActividad);

            return redirect()->back()->with('success', 'Actividad guardada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar la actividad: ' . $e->getMessage());
        }
    }


    /////////eliminar actividad practica 1
    public function eliminarActividadPracticas1($id)
    {
        $actividad = ActividadesPracticas::findOrFail($id);
        $actividad->delete();

        return redirect()->back()->with('success', 'Actividad eliminada exitosamente.');
    }

    //////editar actividad practica 1
    public function updateActividadPracticas1(Request $request, $id)
    {
        $actividad = ActividadesPracticas::findOrFail($id);

        $request->validate([
            'Actividad' => 'required',
            'horas' => 'required',
            'observaciones' => 'required',
            'fechaActividad' => 'required',
            'departamento' => 'required',
            'funcion' => 'required',
            'evidencia' => 'required',
        ]);

        $datosActividad = $request->only([
            'Actividad',
            'horas',
            'observaciones',
            'fechaActividad',
            'departamento',
            'funcion',
        ]);

        $evidencia = $request->file('evidencia');

        try {
            if ($evidencia) {
                $maxFileSize = 500000;
                if ($evidencia->getSize() > $maxFileSize) {
                    return redirect()->back()->with('error', 'La imagen es muy pesada. El tamaño máximo permitido es de 500 KB.');
                }

                $img = Image::make($evidencia)->encode('jpg', 75);
                $datosActividad['evidencia'] = base64_encode($img->encoded);
            }




            $actividad->update($datosActividad);

            return redirect()->back()->with('success', 'Actividad actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al actualizar la actividad: ' . $e->getMessage());
        }
    }

    public function cambiarCredencialesUsuario()
    {
        $usuario = Auth::user();
        $userSessions = UsuariosSession::where('UserID', $usuario->UserID)->get();

        foreach ($userSessions as $session) {
            $session->browser = $this->getBrowserFromUserAgent($session->user_agent);
        }

        return view('estudiantes.cambiarCredencialesUsuario', compact('usuario', 'userSessions'));
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

        return redirect()->route('estudiantes.index')->with('success', 'Credenciales actualizadas exitosamente');
    }








}
