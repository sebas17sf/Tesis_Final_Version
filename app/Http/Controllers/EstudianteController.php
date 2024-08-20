<?php

namespace App\Http\Controllers;

use App\Models\ActividadesPracticas;
use App\Models\Cohorte;
use App\Models\NrcVinculacion;
use App\Models\InformePracticai;
use App\Models\Periodo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\NrcPracticas1;
use App\Models\ActividadesPracticasII;
use App\Models\Estudiante;
use App\Models\AsignacionProyecto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\ProfesUniversidad;
use App\Models\PracticaI;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use App\Models\PracticaIII;

use App\Models\Usuarios;
use App\Models\PracticaII;
use App\Models\Role;
use App\Models\UsuariosSession;

use App\Models\ActividadEstudiante;
use App\Models\Usuario;
use Intervention\Image\Facades\Image;
use App\Models\InformeVinculacionEstudiante;




class EstudianteController extends Controller
{
    public function create()
    {
        $periodos = Periodo::orderBy('inicioPeriodo', 'desc')->get();
        if (Auth::check() && Auth::user()->estudiante) {
            return redirect()->route('estudiantes.index')->with('token', Session::get('user_token'));
        }


        return view('estudiantes.create', compact('periodos'));
    }
    public function store(Request $request)
    {
        // Validar los campos de la solicitud
        $validatedData = $request->validate([
            'Nombres' => 'required',
            'Apellidos' => 'required',
            'espe_id' => 'required',
            'celular' => 'required',
            'cedula' => 'required',
            'Cohorte' => 'required',
            'Periodo' => 'required',
            'Carrera' => 'required',
            'correo' => 'required',
            'departamento' => 'required',
        ], [
            'Nombres.required' => 'El campo Nombres es obligatorio',
            'Apellidos.required' => 'El campo Apellidos es obligatorio',
            'espe_id.required' => 'El campo Especialidad es obligatorio',
            'celular.required' => 'El campo Celular es obligatorio',
            'cedula.required' => 'El campo Cédula es obligatorio',
            'Cohorte.required' => 'El campo Cohorte es obligatorio',
            'Periodo.required' => 'El campo Periodo es obligatorio',
            'Carrera.required' => 'El campo Carrera es obligatorio',
            'correo.required' => 'El campo Correo Electrónico es obligatorio',
            'departamento.required' => 'El campo Departamento es obligatorio',
        ]);

        // Convertir las dos primeras letras de cada palabra en mayúscula
        $validatedData['Nombres'] = ucwords(strtolower($validatedData['Nombres']));
        $validatedData['Apellidos'] = ucwords(strtolower($validatedData['Apellidos']));

        $correoElectronico = explode('@', $validatedData['correo'])[0];

        $role = Role::where('tipo', 'Estudiante')->first();

        $estudiante = Estudiante::updateOrCreate(
            ['cedula' => $validatedData['cedula']],
            [
                'nombres' => $validatedData['Nombres'],
                'apellidos' => $validatedData['Apellidos'],
                'espeId' => $validatedData['espe_id'],
                'celular' => $validatedData['celular'],
                'cedula' => $validatedData['cedula'],
                'Cohorte' => $validatedData['Cohorte'],
                'idPeriodo' => $validatedData['Periodo'],
                'carrera' => $validatedData['Carrera'],
                'departamentoId' => $validatedData['departamento'],
                'comentario' => 'Sin comentarios',
                'estado' => 'En proceso de revisión',
                'activacion' => true,
                'correo' => $validatedData['correo'],
            ]
        );

        $user = Usuario::updateOrCreate(
            ['nombreUsuario' => $correoElectronico],
            [
                'correoElectronico' => $validatedData['correo'],
                'contrasena' => bcrypt($validatedData['cedula']),
                'role_id' => $role->id,
                'estado' => 'Aprobado',
            ]
        );

        $estudiante->update(['userId' => $user->userId]);

        $asignacionProyecto = AsignacionProyecto::where('estudianteId', $estudiante->estudianteId)->first();

        if ($asignacionProyecto) {
            if ($asignacionProyecto->estado === 'En ejecucion') {
                $estudiante->update(['estado' => 'Aprobado']);
            } elseif ($asignacionProyecto->estado === 'Finalizado') {
                $estudiante->update(['estado' => 'Aprobado-practicas']);
            }
        }

        $practicaI = PracticaI::where('estudianteId', $estudiante->estudianteId)->first();
        if ($practicaI) {
            if ($practicaI->Estado === 'Finalizado' || $practicaI->Estado === 'En ejecucion') {
                $estudiante->update(['estado' => 'Aprobado-practicas']);
            }
        }

        $practicaII = PracticaII::where('estudianteId', $estudiante->estudianteId)->first();
        if ($practicaII) {
            if ($practicaII->Estado === 'Finalizado' || $practicaII->Estado === 'En ejecucion') {
                $estudiante->update(['estado' => 'Aprobado-practicas']);
            }
        }

        $mensaje = $estudiante->wasRecentlyCreated ? 'Estudiante creado correctamente' : 'Datos del estudiante actualizados correctamente';

        return redirect()->route('login')->with('success', $mensaje);
    }





    public function index()
    {

        // Verifica si el usuario está autenticado y si es un estudiante
        if (Auth::check() && Auth::user()->estudiante) {
            // Obtén los datos del estudiante relacionado con el usuario
            $estudiante = Auth::user()->estudiante;

            $periodo = Periodo::find($estudiante->idPeriodo);

            // Obtén la asignación de proyecto del estudiante (si existe)
            $asignacionProyecto = AsignacionProyecto::where('estudianteId', $estudiante->estudianteId)->first();

            $practica1 = PracticaI::where('estudianteId', $estudiante->estudianteId)->first();
            $practica2 = PracticaII::where('estudianteId', $estudiante->estudianteId)->first();
            $practica3 = PracticaIII::where('estudianteId', $estudiante->estudianteId)->first();
            $practica4 = PracticaIV::where('estudianteId', $estudiante->estudianteId)->first();
            $practica5 = PracticaV::where('estudianteId', $estudiante->estudianteId)->first();

            return view('estudiantes.index', compact('estudiante', 'asignacionProyecto', 'periodo', 'practica1', 'practica2', 'practica3', 'practica4', 'practica5'));
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
            'Nombres' => 'required',
            'Apellidos' => 'required',
            'espe_id' => 'required',
            'celular' => 'required',
            'cedula' => 'required',
            'Cohorte' => 'required',
            'Periodo' => 'required',
            'Carrera' => 'required',
            'Provincia' => 'required',
            'Departamento' => 'required',
        ]);

        try {
            // Depuración: Verificar que los datos validados sean correctos
            \Log::info('Datos validados:', $validatedData);

            // Actualiza los campos del estudiante con los datos validados
            $estudiante->update([
                'nombres' => $validatedData['Nombres'],
                'apellidos' => $validatedData['Apellidos'],
                'espeId' => $validatedData['espe_id'],
                'celular' => $validatedData['celular'],
                'cedula' => $validatedData['cedula'],
                'Cohorte' => $validatedData['Cohorte'],
                'idPeriodo' => $validatedData['Periodo'],
                'carrera' => $validatedData['Carrera'],
                'provincia' => $validatedData['Provincia'],
                'departamento' => $validatedData['Departamento'],
                'comentario' => 'Sin comentarios',
                'estado' => 'En proceso de revisión'
            ]);

            \Log::info('Estudiante actualizado:', $estudiante->toArray());

            return redirect()->route('estudiantes.index')->with('success', 'Información del Estudiante actualizada.');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar el estudiante:', ['error' => $e->getMessage()]);
            return redirect()->route('estudiantes.index')->with('error', 'Hubo un problema al actualizar la información del estudiante.');
        }
    }



    /////renviar informacion para aceptacion
    public function resend(Request $request, Estudiante $estudiante)
    {
        // Verificar si el estado actual es "Negado"
        if ($estudiante->estado === 'Negado' || $estudiante->estado === 'negado') {
            // Actualizar el estado a "En proceso de revisión"
            $estudiante->update([
                'estado' => 'En proceso de revision',
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

        $profesores = ProfesUniversidad::orderBy('apellidos', 'asc')->get();

        $nrcpracticas1 = NrcVinculacion::where('tipo', 'Practicas')->get();

        $estudiante = $user->estudiante;

        $actividades = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)->get();



        // Verifica si el usuario autenticado es un estudiante y su estado es "Aprobado-practicas"
        if ($estudiante && ($estudiante->estado === 'Aprobado-practicas' || $estudiante->estado === 'Reprobado PracticaI')) {
            $correoEstudiante = $estudiante->Usuario->correoElectronico;
            $empresas = Empresa::all();

            $practicaPendiente = PracticaI::where('estudianteId', $estudiante->estudianteId)
                ->whereIn('estado', ['En ejecucion', 'Finalizado'])
                ->first();
            $totalHoras = $actividades->sum('horas');


            return view('estudiantes.practica1', compact('estudiante', 'correoEstudiante', 'empresas', 'practicaPendiente', 'profesores', 'nrcpracticas1', 'actividades', 'totalHoras'));
        }

        // Si no cumple con los requisitos, muestra un mensaje de alerta y redirige a otra página
        return redirect()->route('estudiantes.index')->with('error', 'No tiene acceso a esta página.');
    }



    public function practica2()
    {
        $user = Auth::user();

        $profesores = ProfesUniversidad::orderBy('apellidos', 'asc')->get();

        $nrcpracticas1 = NrcVinculacion::where('tipo', 'Practicas')->get();



        $estudiante = $user->estudiante;

        $actividades = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)->get();



        if ($estudiante && $estudiante->estado === 'Aprobado-practicas') {
            $correoEstudiante = $estudiante->Usuario->correoElectronico;
            $empresas = Empresa::all();

            // Consulta para PracticaI
            $practicaPendienteI = PracticaI::where('estudianteId', $estudiante->estudianteId)->where('estado', 'Finalizado')->first();
            $estadoPracticaI = PracticaI::where('estudianteId', $estudiante->estudianteId)->where('estado', 'Finalizado')->first();
            $horasPlanificadasI = $practicaPendienteI ? $practicaPendienteI->HorasPlanificadas : 0;

            ////si el estudiante no tiene practica 1 debe mandar un mensaje de error
            if (!$practicaPendienteI) {
                return redirect()->route('estudiantes.index')->with('error', 'No tiene acceso a esta página.');
            }



            $practicaPendiente = PracticaII::where('estudianteId', $estudiante->estudianteId)->where('estado', 'En ejecucion')->first();
            $totalHoras = $actividades->sum('horas');

            // Consulta para PracticaII
            $practicaPendiente = PracticaII::where('estudianteId', $estudiante->estudianteId)
                ->whereIn('estado', ['En ejecucion', 'Finalizado'])
                ->first();
            $estadoPractica = PracticaII::where('estudianteId', $estudiante->estudianteId)->where('estado', 'Finalizado')->first();

            return view('estudiantes.practica2', compact('estudiante', 'correoEstudiante', 'empresas', 'horasPlanificadasI', 'practicaPendiente', 'estadoPractica', 'profesores', 'nrcpracticas1', 'actividades', 'totalHoras'));
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

        $estudiante = Estudiante::where('userId', $userId)->first();

        $nrc = NrcVinculacion::where('id', $validatedData['nrc'])->first();
        $periodo = Periodo::where('id', $nrc->idPeriodo)->first();
        $numeroPeriodo = $periodo->numeroPeriodo;



        if ($estudiante) {
            PracticaI::create([
                'estudianteId' => $estudiante->estudianteId,
                'tipoPractica' => $validatedData['Practicas'],
                'idEmpresa' => $validatedData['Empresa'],
                'idTutorAcademico' => $validatedData['ID_tutorAcademico'],
                'nrc' => $validatedData['nrc'],
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
                'periodoPractica' => $numeroPeriodo,
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


        // Obtén el UserID del usuario autenticado
        $userId = Auth::id();

        // Obtén el modelo Estudiante del usuario autenticado
        $estudiante = Estudiante::where('userId', $userId)->first();

        $nrc = NrcVinculacion::where('id', $validatedData['nrc'])->first();
        $periodo = Periodo::where('id', $nrc->idPeriodo)->first();
        $numeroPeriodo = $periodo->numeroPeriodo;


        // Verifica si se encontró el estudiante
        if ($estudiante) {
            // Crea un nuevo registro de PracticaI y asocia los datos del estudiante
            PracticaII::create([
                'estudianteId' => $estudiante->estudianteId,
                'tipoPractica' => $validatedData['Practicas'],
                'idEmpresa' => $validatedData['Empresa'],
                'idTutorAcademico' => $validatedData['ID_tutorAcademico'],
                'nrc' => $validatedData['nrc'],
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
                'periodoPractica' => $numeroPeriodo,
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
            'nombre_actividad' => 'required|string',
        ]);

        $estudiante = Auth::user()->estudiante;
        $asignaciones = $estudiante->asignaciones;

        if (!$asignaciones->count()) {
            return redirect()->route('estudiantes.documentos')->with('error', 'No está asignado a un proyecto.');
        }

        // Verificar si ya existe una actividad con la misma fecha para el estudiante
        $actividadExistente = ActividadEstudiante::where('estudianteId', $estudiante->estudianteId)
            ->where('fecha', $request->input('fecha'))
            ->exists();

        if ($actividadExistente) {
            return redirect()->back()->with('error', 'Ya existe una actividad registrada para esa fecha.')->withInput();
        }

        // Calcular el total de horas registradas por el estudiante
        $totalHoras = ActividadEstudiante::where('estudianteId', $estudiante->estudianteId)->sum('numeroHoras');

        // Verificar si la suma de las horas actuales y las nuevas horas supera el límite permitido
        $nuevasHoras = $request->input('horas');
        if ($totalHoras + $nuevasHoras > 96) {
            return redirect()->route('estudiantes.documentos')->with('error', 'Registrar esta actividad supera el límite de 96 horas.');
        }

        if ($request->hasFile('evidencias')) {
            $evidencia = $request->file('evidencias');

            // Comprimir la imagen y convertirla en base64
            $compressedImage = Image::make($evidencia)->encode('jpg', 75);
            $evidenciaBase64 = base64_encode($compressedImage->encoded);

            $actividadEstudiante = new ActividadEstudiante([
                'estudianteId' => $estudiante->estudianteId,
                'fecha' => $request->input('fecha'),
                'actividades' => $request->input('actividades'),
                'numeroHoras' => $nuevasHoras,
                'evidencias' => $evidenciaBase64,
                'nombreActividad' => $request->input('nombre_actividad'),
            ]);

            try {
                $actividadEstudiante->save();

                return redirect()->route('estudiantes.documentos')->with('success', 'Actividad registrada exitosamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar la actividad: ' . $e->getMessage())->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Verifica el ingreso de los datos en la Actividad.')->withInput();
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

        $estudiante = Auth::user()->estudiante;
        $asignaciones = $estudiante->asignaciones;

        // Verificar si ya existe otra actividad con la misma fecha para el estudiante
        $actividadExistente = ActividadEstudiante::where('estudianteId', $estudiante->estudianteId)
            ->where('fecha', $request->input('fecha'))
            ->exists();

        if ($actividadExistente) {
            return redirect()->back()->with('error', 'Ya existe otra actividad registrada para esa fecha.')->withInput();
        }

        if ($request->hasFile('evidencias')) {
            $evidencia = $request->file('evidencias');

            $maxFileSize = 500000; // 500 KB
            if ($evidencia->getSize() > $maxFileSize) {
                return redirect()->back()->with('error', 'La imagen es muy pesada. El tamaño máximo permitido es de 500 KB.')->withInput();
            }

            $evidenciaBase64 = base64_encode(File::get($evidencia));
            $actividad->evidencias = $evidenciaBase64;
        }

        $actividad->fecha = $request->input('fecha');
        $actividad->actividades = $request->input('actividades');
        $actividad->numeroHoras = $request->input('numero_horas');
        $actividad->nombreActividad = $request->input('nombre_actividad');

        try {
            $actividad->save();
            return redirect()->route('estudiantes.documentos')->with('success', 'Actividad actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la actividad: ' . $e->getMessage())->withInput();
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
            $asignaciones = $estudiante->asignaciones;
            $practicasi = $estudiante->practicasi()->with('empresa', 'tutorAcademico')->get();
            $practicasii = $estudiante->practicasii()->with('empresa', 'tutorAcademico')->get();
            $practicasiii = $estudiante->practicasiii()->with('empresa', 'tutorAcademico')->get();
            $practicasiv = $estudiante->practicasiv()->with('empresa', 'tutorAcademico')->get();
            $practicasv = $estudiante->practicasv()->with('empresa', 'tutorAcademico')->get();

            $asignacionesCompletadas = $asignaciones->where('estado', 'Finalizado')->count();
            $practicasCompletadas = $practicasi->where('Estado', 'Finalizado')->count() +
                $practicasii->where('Estado', 'Finalizado')->count() +
                $practicasiii->where('Estado', 'Finalizado')->count() +
                $practicasiv->where('Estado', 'Finalizado')->count() +
                $practicasv->where('Estado', 'Finalizado')->count();

            // Ajuste de la lógica
            $finalizadoProcesos = $practicasCompletadas >= 5 || $practicasCompletadas >= 2;

            $pdf = PDF::loadView('estudiantes.certificadoMatricula', compact('estudiante', 'asignaciones', 'practicasi', 'practicasii', 'practicasiii', 'practicasiv', 'practicasv', 'finalizadoProcesos'));

            $filename = 'Historial-Practicas-vinculacion-' . $estudiante->apellidos . '-' . $estudiante->nombres . '.pdf';
            return $pdf->download($filename);
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
            'horas' => 'required|integer',
            'observaciones' => 'required|string',
            'fechaActividad' => 'required|date',
            'departamento' => 'required|string',
            'funcion' => 'required|string',
        ]);

        $datosActividad = $request->only([
            'horas',
            'observaciones',
            'fechaActividad',
            'departamento',
            'funcion',
        ]);

        try {
            $evidencia = $request->file('evidencia');
            if ($evidencia) {
                $img = Image::make($evidencia)->encode('jpg', 75);
                $datosActividad['evidencia'] = base64_encode($img->encoded);
            } else {
                $datosActividad['evidencia'] = null;
            }

            $datosActividad['estudianteId'] = $request->EstudianteID;
            $datosActividad['idPracticasi'] = $request->PracticasI;
            $datosActividad['actividad'] = $request->Actividad;

            ActividadesPracticas::create($datosActividad);

            return redirect()->back()->with('success', 'Actividad guardada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar la actividad: ' . $e->getMessage());
        }
    }



    ////////////////////guardar actividad practica 2
    public function guardarActividadPractica2(Request $request)
    {
        $request->validate([
            'EstudianteID' => 'required',
            'PracticasII' => 'required',
            'Actividad' => 'required',
            'horas' => 'required',
            'observaciones' => 'required',
            'fechaActividad' => 'required',
            'departamento' => 'required',
            'funcion' => 'required',
        ]);



        $datosActividad = $request->only([
            'horas',
            'observaciones',
            'fechaActividad',
            'departamento',
            'funcion',
        ]);

        try {
            $evidencia = $request->file('evidencia');
            if ($evidencia) {
                $img = Image::make($evidencia)->encode('jpg', 75);
                $datosActividad['evidencia'] = base64_encode($img->encoded);
            }

            $datosActividad['estudianteId'] = $request->EstudianteID;
            $datosActividad['idPracticasi'] = $request->PracticasII;
            $datosActividad['actividad'] = $request->Actividad;

            ActividadesPracticasII::create($datosActividad);

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

    /////////eliminar actividad practica 2
    public function eliminarActividadPracticas2($id)
    {
        $actividad = ActividadesPracticasII::findOrFail($id);
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
        ]);


        $datosActividad = $request->only([
            'actividad',
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

    //////editar actividad practica 2
    public function updateActividadPracticas2(Request $request, $id)
    {
        $actividad = ActividadesPracticasII::findOrFail($id);

        $request->validate([
            'Actividad' => 'required',
            'horas' => 'required',
            'observaciones' => 'required',
            'fechaActividad' => 'required',
            'departamento' => 'required',
            'funcion' => 'required',
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
        $periodos = Periodo::all();

        $departamentos = Departamento::all();

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

        return view('estudiantes.cambiarCredencialesUsuario', compact('usuario', 'userSessions', 'estudiante', 'periodos', 'departamentos'));
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
        if ($usuario->estudiante) {
            $usuario->estudiante->actualizacion = true;

            // Guardar los cambios en el modelo `profesorUniversidad`
            if ($usuario->estudiante->save()) {
                // Guardar los cambios en el modelo `Usuario`
                $usuario->save();
                return redirect()->back()->with('success', 'Credenciales actualizadas exitosamente');
            } else {
                return redirect()->back()->with('error', 'No se pudo actualizar el campo de actualización');
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró la relación con estudiante');
        }
    }



    public function verificarPrimerasClaves(Request $request)
    {
        $user = auth()->user()->estudiante;

        if ($user->actualizacion == 0) {
            return redirect()->route('estudiantes.cambiarCredencialesUsuario');
        }

    }

    public function actualizarDatosEstudiantesCredenciales(Request $request, $estudianteId)
    {
        // Validar los datos del formulario
        $request->validate([
            'firstname_student' => 'required',
            'lastname_student' => 'required',
            'Cohorte' => 'required',
            'Periodo' => 'required',
            'Carrera' => 'required',
            'Departamento' => 'required',
        ]);


         $estudiante = Estudiante::findOrFail($estudianteId);

        // Actualizar los datos del estudiante
        $estudiante->nombres = $request->input('firstname_student');
        $estudiante->apellidos = $request->input('lastname_student');
        $estudiante->Cohorte = $request->input('Cohorte');
        $estudiante->idPeriodo = $request->input('Periodo');
        $estudiante->carrera = $request->input('Carrera');
        $estudiante->departamentoId = $request->input('Departamento');

         $estudiante->save();

         return redirect()->back()->with('success', 'Datos del estudiante actualizados.');
    }


    public function guardarDatos(Request $request)
    {
        $data = $request->validate([
            'nombreComunidad' => 'required|string',
            'provincia' => 'required|array',
            'provincia.*' => 'required|string',
            'canton' => 'required|array',
            'canton.*' => 'required|string',
            'razones' => 'required',
            'parroquia' => 'required|array',
            'parroquia.*' => 'required|string',
            'direccion' => 'required|array',
            'direccion.*' => 'required|string',
            'especificos' => 'required|array',
            'especificos.*' => 'required|string',
            'alcanzados' => 'required|array',
            'alcanzados.*' => 'required|string',
            'porcentaje' => 'required|array',
            'porcentaje.*' => 'required|string',
            'conclusiones1' => 'required|string',
            'conclusiones2' => 'required|string',
            'conclusiones3' => 'required|string',
            'recomendaciones' => 'required|string'
        ]);

        $estudianteId = auth()->user()->estudiante->estudianteId;

        $asignacionProyecto = AsignacionProyecto::where('estudianteId', $estudianteId)->first();

        if (!$asignacionProyecto) {
            return redirect()->back()->withInput()->with(['error' => 'El estudiante no tiene una asignación de proyecto.']);
        }

        $informe = InformeVinculacionEstudiante::updateOrCreate(
            ['estudianteId' => $estudianteId],
            [
                'nombre_comunidad' => $data['nombreComunidad'],
                'provincias' => json_encode($data['provincia']),
                'cantones' => json_encode($data['canton']),
                'parroquias' => json_encode($data['parroquia']),
                'direcciones' => json_encode($data['direccion']),
                'especificos' => json_encode($data['especificos']),
                'alcanzados' => json_encode($data['alcanzados']),
                'porcentajes' => json_encode($data['porcentaje']),
                'conclusiones1' => $data['conclusiones1'],
                'razones' => $data['razones'],
                'conclusiones2' => $data['conclusiones2'],
                'conclusiones3' => $data['conclusiones3'],
                'recomendaciones' => $data['recomendaciones']
            ]
        );

        return redirect()->back()->withInput()->with('success', 'Datos guardados exitosamente.');
    }



    public function recuperarDatos(Request $request)
    {
        $estudianteId = auth()->user()->estudiante->estudianteId;

        // Verificar si el estudiante tiene una asignación de proyectos
        $asignacionProyecto = AsignacionProyecto::where('estudianteId', $estudianteId)->first();

        if (!$asignacionProyecto) {
            return redirect()->back()->with('error', 'El estudiante no tiene una asignación de proyectos.');
        }

        // Buscar el último informe del estudiante
        $informe = InformeVinculacionEstudiante::where('estudianteId', $estudianteId)->latest()->first();

        if (!$informe) {
            return redirect()->back()->with('error', 'No se encontraron datos previos.');
        }

        $data = [
            'tipo' => $informe->tipo,
            'nombreComunidad' => $informe->nombre_comunidad,
            'provincia' => json_decode($informe->provincias, true),
            'canton' => json_decode($informe->cantones, true),
            'parroquia' => json_decode($informe->parroquias, true),
            'direccion' => json_decode($informe->direcciones, true),
            'especificos' => json_decode($informe->especificos, true),
            'alcanzados' => json_decode($informe->alcanzados, true),
            'porcentaje' => json_decode($informe->porcentajes, true),
            'razones' => $informe->razones,
            'conclusiones1' => $informe->conclusiones1,
            'conclusiones2' => $informe->conclusiones2,
            'conclusiones3' => $informe->conclusiones3,
            'recomendaciones' => $informe->recomendaciones,
        ];

        return redirect()->back()->withInput($data)->with('success', 'La información se ha recuperado correctamente.');
    }


    public function guardarDatosPracticasi(Request $request)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'introduccion' => 'nullable|string',
            'conclusion' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        // Obtener el estudiante_id del usuario autenticado
        $estudianteId = Auth::user()->estudiante->estudianteId;

        // Usando updateOrCreate para guardar o actualizar el registro
        $informe = InformePracticai::updateOrCreate(
            ['estudianteId' => $estudianteId], // Condición de búsqueda
            [
                'introduccion' => $validatedData['introduccion'],
                'conclusion' => $validatedData['conclusion'],
                'recomendaciones' => $validatedData['recomendaciones'],
            ] // Datos a actualizar o crear
        );

        return redirect()->back()->with('success', 'Datos guardados correctamente.');
    }

    /**
     * Recupera los datos guardados del informe de práctica para un estudiante.
     */
    public function recuperarDatosPracticasi(Request $request)
    {
        // Obtener el estudiante_id del usuario autenticado
        $estudianteId = Auth::user()->estudiante->estudianteId;

        // Buscar el informe relacionado con el estudiante
        $informe = InformePracticai::where('estudianteId', $estudianteId)->first();

        if ($informe) {
            // Redirigir de vuelta al formulario con los datos del informe y un mensaje de éxito
            return redirect()->back()->withInput($informe->toArray())->with('success', 'Datos recuperados exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontraron datos para el estudiante.');
        }
    }






}
