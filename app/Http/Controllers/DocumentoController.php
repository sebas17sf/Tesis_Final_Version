<?php

namespace App\Http\Controllers;

use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use App\Models\Proyecto;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\NrcVinculacion;
use App\Models\PracticaI;
use Illuminate\Support\Facades\Auth;

use App\Models\ActividadEstudiante;
use App\Models\ProfesUniversidad;


class DocumentoController extends Controller
{

    public function generar()
    {
        // Ruta a la plantilla de Word en la carpeta "public/Plantillas"
        $plantillaPath = public_path('Plantillas/1.2-Acta-Designacion-Estudiantes.docx');

        // Verificar si el archivo de plantilla existe
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        // Cargar la plantilla de Word existente
        $template = new TemplateProcessor($plantillaPath);

        // Obtener el usuario actual (asegúrate de que el usuario esté autenticado)
        $usuario = auth()->user();

        if (!$usuario) {
            // Manejar el caso en que el usuario no esté autenticado
            abort(403, 'No estás autenticado.');
        }

        // Obtener el estudiante asociado al usuario
        $estudiante = $usuario->estudiante;

        if (!$estudiante) {
            // Manejar el caso en que no se encontró el estudiante asociado al usuario
            abort(404, 'No se encontró el estudiante asociado a tu usuario.');
        }

        // Obtener el ProyectoID del modelo AsignacionProyecto del estudiante
        $asignacionProyecto = $estudiante->asignaciones->first();

        if ($asignacionProyecto) {
            $proyectoID = $asignacionProyecto->proyectoId;
        } else {
            return redirect()->route('estudiantes.documentos')->with('error', 'No esta asignado a un proyecto.');
        }

        $datosEstudiantes = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->select(
                'estudiantes.apellidos',
                'estudiantes.nombres',
                'estudiantes.cedula',
                'estudiantes.carrera',
                'estudiantes.provincia',
                'asignacionproyectos.inicioFecha',
                'proyectos.nombreProyecto',
            )
            ->where('asignacionproyectos.proyectoId', $proyectoID)
            ->where('estudiantes.estado', 'Aprobado')
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get();

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $carreraEstudiante = mb_strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['A', 'E', 'I', 'O', 'U'], $primerEstudiante->carrera));
        $provinciaEstudiante = $primerEstudiante->provincia;
        $carreraNormal = $primerEstudiante->carrera;
        $fechaInicioProyecto = $primerEstudiante->inicioFecha;
        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];
        $fechaFormateada = date('d', strtotime($fechaInicioProyecto)) . ' ' . $meses[date('F', strtotime($fechaInicioProyecto))] . ' ' . date('Y', strtotime($fechaInicioProyecto));
        $NombreProyecto = $primerEstudiante->nombreProyecto;
        $horasVinculacionConstante = 96;

        // Clonar las filas en la plantilla
        $template->cloneRow('Nombres', count($datosEstudiantes));

        // Ordenar los datos por apellidos en orden ascendente (A-Z)
        $datosEstudiantes = $datosEstudiantes->sortBy('Apellidos');

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $template->setValue('Apellidos#' . ($index + 1), $estudiante->apellidos);
            $template->setValue('Nombres#' . ($index + 1), $estudiante->nombres);
            $template->setValue('Cedula#' . ($index + 1), $estudiante->cedula);
            $template->setValue('HorasVinculacion#' . ($index + 1), $horasVinculacionConstante);
        }

        // Reemplazar los valores constantes en la plantilla
        $template->setValue('Carrera', $carreraEstudiante);
        $template->setValue('CarreraNormal', $carreraNormal);
        $template->setValue('Provincia', $provinciaEstudiante);
        $template->setValue('FechaInicio', $fechaFormateada);
        $template->setValue('NombreProyecto', $NombreProyecto);



        $nombreArchivo = '1.2-Acta-Designacion-Estudiantes.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }



    ////////////////////////CARTA DE COMPROMISO ESTUDIANTE//////////////////////////
    public function generarCartaCompromiso()
    {
        // Ruta a la plantilla de Word en la carpeta "public/Plantillas"
        $plantillaPath = public_path('Plantillas/1.2.1-Carta-Compromiso-Estudiante.docx');

        // Verificar si el archivo de plantilla existe
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        // Cargar la plantilla de Word existente
        $template = new TemplateProcessor($plantillaPath);

        // Obtener el usuario autenticado
        $usuario = auth()->user();

        // Obtener el estudiante relacionado con el usuario
        $estudiante = $usuario->estudiante;

        // Verificar si se encontró un estudiante relacionado
        if (!$estudiante) {
            // Manejar el caso en que el usuario no tenga un estudiante relacionado
            abort(404, 'No se encontraron datos de estudiante para este usuario.');
        }

        // Obtener las asignaciones de proyectos del estudiante
        $asignaciones = $estudiante->asignaciones;

        if (!$asignaciones->count()) {
            return redirect()->route('estudiantes.documentos')->with('error', 'No está asignado a un proyecto.');
        }


        // Crear una lista para almacenar los nombres de proyectos
        $nombresProyectos = [];
        $apellidosProfesores = [];
        $nombresProfesores = [];
        $apellidosAsignados = [];
        $nombresAsignados = [];
        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];
        // Recorrer las asignaciones y obtener los datos de proyectos y profesores
        foreach ($asignaciones as $asignacion) {
            $proyecto = $asignacion->proyecto;
            if ($proyecto) {
                $nombresProyectos[] = $proyecto->nombreProyecto;
                $apellidosProfesores[] = $proyecto->asignaciones->first()->proyecto->director->apellidos;
                $nombresProfesores[] = $proyecto->asignaciones->first()->proyecto->director->nombres;
                $apellidosAsignados[] = $proyecto->asignaciones->first()->docenteParticipante->apellidos;
                $nombresAsignados[] = $proyecto->asignaciones->first()->docenteParticipante->nombres;

                $fechaInicio = date('d', strtotime($proyecto->asignaciones->first()->inicioFecha)) . ' ' . $meses[date('F', strtotime($proyecto->asignaciones->first()->inicioFecha))] . ' ' . date('Y', strtotime($proyecto->asignaciones->first()->inicioFecha));
                $fechasInicio[] = $fechaInicio;
            }
        }


        // Obtener los datos del estudiante
        $apellidosEstudiante = $estudiante->apellidos;
        $nombresEstudiante = $estudiante->nombres;
        $cedulaEstudiante = $estudiante->cedula;
        $carreraEstudiante = $estudiante->carrera;
        $provinciaEstudiante = $estudiante->provincia;

        // Reemplazar los valores en la plantilla
        $template->setValue('Apellidos', $apellidosEstudiante);
        $template->setValue('Nombres', $nombresEstudiante);
        $template->setValue('Cedula', $cedulaEstudiante);
        $template->setValue('Carrera', $carreraEstudiante);
        $template->setValue('Provincia', $provinciaEstudiante);

        // Reemplazar la lista de proyectos
        $proyectosString = implode(', ', $nombresProyectos);
        $template->setValue('NombreProyecto', $proyectosString);

        // Reemplazar la lista de apellidos de profesores
        $apellidosProfesoresString = implode(', ', $apellidosProfesores);
        $template->setValue('ApellidoProfesor', $apellidosProfesoresString);

        $fechasInicioString = implode(', ', $fechasInicio);
        $template->setValue('FechaInicio', $fechasInicioString);

        // Reemplazar la lista de nombres de profesores
        $nombresProfesoresString = implode(', ', $nombresProfesores);
        $template->setValue('NombreProfesor', $nombresProfesoresString);

        // Reemplazar la lista de apellidos de asignados
        $apellidosAsignadosString = implode(', ', $apellidosAsignados);
        $template->setValue('ApellidoAsignado', $apellidosAsignadosString);

        // Reemplazar la lista de nombres de asignados
        $nombresAsignadosString = implode(', ', $nombresAsignados);
        $template->setValue('NombreAsignado', $nombresAsignadosString);


        //descargar documento

        $nombreArchivo = '1.2.1-Carta-Compromiso-Estudiante.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }




    ///////////////////////////////GENERAR 1.3 NÚMERO HORAS ESTUDIANTES//////////////////////////
    public function generarHorasEstudiante()
    {
        // Ruta a la plantilla XLSX en la carpeta "public/Plantillas"
        $plantillaPath = public_path('Plantillas/1.3-Número-Horas-Estudiantes.xlsx');

        // Verificar si el archivo de plantilla existe
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');

        }

        // Cargar la plantilla XLSX existente
        $spreadsheet = IOFactory::load($plantillaPath);

        // Obtener el usuario actual (asegúrate de que el usuario esté autenticado)
        $usuario = auth()->user();

        if (!$usuario) {
            // Manejar el caso en que el usuario no esté autenticado
            abort(403, 'No estás autenticado.');
        }

        // Obtener el estudiante asociado al usuario
        $estudiante = $usuario->estudiante;

        if (!$estudiante) {
            // Manejar el caso en que no se encontró el estudiante asociado al usuario
            abort(404, 'No se encontró el estudiante asociado a tu usuario.');
        }

        // Obtener el ProyectoID del modelo AsignacionProyecto del estudiante
        $asignacionProyecto = $estudiante->asignaciones->first();

        if ($asignacionProyecto) {
            $proyectoID = $asignacionProyecto->proyectoId;
        } else {
            // Manejar el caso en que no se encontró la asignación de proyecto para el estudiante
            return redirect()->route('estudiantes.documentos')->with('error', 'No esta asignado a un proyecto.');
        }

        // Consulta para obtener los datos de los estudiantes asignados a un proyecto específico
        $datosEstudiantes = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->join('usuarios', 'estudiantes.userId', '=', 'usuarios.userId')
            ->join('profesuniversidad as director', 'proyectos.directorId', '=', 'director.id')
            ->join('profesuniversidad as participante', 'asignacionproyectos.participanteId', '=', 'participante.id')
            ->select(
                'estudiantes.apellidos',
                'estudiantes.nombres',
                'estudiantes.cedula',
                'estudiantes.departamento',
                'estudiantes.celular',
                'estudiantes.carrera',
                'estudiantes.provincia',
                'usuarios.correoElectronico',
                'asignacionproyectos.inicioFecha',
                'asignacionproyectos.finalizacionFecha',
                'proyectos.nombreProyecto',
                'proyectos.departamentoTutor',
                'director.nombres as NombreProfesor',
                'director.apellidos as ApellidoProfesor',
                'participante.nombres as NombreParticipante',
                'participante.apellidos as ApellidoParticipante'
            )
            ->where('proyectos.estado', '=', 'Ejecucion')
            ->where('asignacionproyectos.proyectoId', '=', $proyectoID)
            ->orderBy('estudiantes.apellidos', 'asc')

            ->get();


        // Verificar si se recuperaron datos
        if ($datosEstudiantes->isEmpty()) {
            // Manejar el caso en que no se encontraron datos
            abort(404, 'No se encontraron datos de estudiantes asignados al proyecto activo.');
        }

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $fechaInicioProyecto = $primerEstudiante->inicioFecha;
        $fechaFinProyecto = $primerEstudiante->finalizacionFecha;
        $departamentoProyecto = $primerEstudiante->departamento;
        $departamento = "Departamento de " . $primerEstudiante->departamento;

        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];

        $fechaFormateada = date('d F Y', strtotime($fechaInicioProyecto));

        $fechaFormateada = strtr($fechaFormateada, $meses);


        $NombreProyecto = $primerEstudiante->nombreProyecto;
        $horasVinculacionConstante = 96;
        $matriz = 'Sede Santo Domingo';
        $nombreProfesor = $primerEstudiante->NombreProfesor;
        $apellidoProfesor = $primerEstudiante->ApellidoProfesor;
        $nombreCombinado = "Ing. {$nombreProfesor} {$apellidoProfesor}, Mgtr";



        // Obtener la hoja activa del archivo XLSX
        $sheet = $spreadsheet->getActiveSheet();

        // Clonar filas en la plantilla
        $filaInicio = 5; // La primera fila de datos comienza en la fila 2
        $cantidadFilas = count($datosEstudiantes);
        $proyectoCellStart = 'B5';
        $proyectoN = 'A5';
        $proyectoCellEnd = 'B' . (5 + count($datosEstudiantes) - 1);
        $proyectoNEnd = 'A' . (5 + count($datosEstudiantes) - 1);

        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $apellidoNombre = $estudiante->apellidos . ' ' . $estudiante->nombres;
            $sheet->setCellValue('C' . ($filaInicio + $index), $apellidoNombre);
            $sheet->setCellValue('D' . ($filaInicio + $index), $estudiante->cedula);
            $sheet->setCellValue('E' . ($filaInicio + $index), $estudiante->celular);
            $horasVinculacionConstanteEntero = round($horasVinculacionConstante);
            $sheet->setCellValue('L' . ($filaInicio + $index), $horasVinculacionConstanteEntero);
            $sheet->setCellValue('H' . ($filaInicio + $index), $estudiante->departamento);
            $sheet->setCellValue('I' . ($filaInicio + $index), $estudiante->carrera);
            $sheet->setCellValue('J' . ($filaInicio + $index), $fechaInicioProyecto);
            $sheet->setCellValue('K' . ($filaInicio + $index), $fechaFinProyecto);
            $sheet->setCellValue('G' . ($filaInicio + $index), $matriz);
            $sheet->setCellValue('F' . ($filaInicio + $index), $estudiante->correoElectronico);


        }


        $sheet->mergeCells($proyectoCellStart . ':' . $proyectoCellEnd);
        $sheet->mergeCells($proyectoN . ':' . $proyectoNEnd);
        $sheet->setCellValue('B5', $NombreProyecto);
        $sheet->mergeCells('B18:D18');
        $sheet->mergeCells('B17:D17');
        $sheet->mergeCells('B19:D19');
        $sheet->setCellValue('A5', '1');



        // Reemplazar los valores constantes en la plantilla
        $sheet->setCellValue('C9', $fechaFormateada);
        $style = $sheet->getStyle('C9');
        $style->getFont()->setName('Calibri')->setSize(16);



        $sheet->setCellValue('C2', $departamentoProyecto);

        $sheet->setCellValue('B17', $nombreCombinado);
        $style = $sheet->getStyle('B17');
        $style->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B18', $departamento);
        $style = $sheet->getStyle('B18');
        $style->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B19', 'Director del proyecto');
        $style = $sheet->getStyle('B19');
        $style->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B9', 'Fecha:');
        $style = $sheet->getStyle('B9');
        $style->getFont()->setName('Calibri')->setSize(16)->setBold(true);


        // Descargar el documento generado
        $nombreArchivo = '1.3-Número-Horas-Estudiantes.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }


    ////////////////////////Creacion de infomreeeeeeeeeee///////////////////////////////////
    public function generarInforme(Request $request)
    {
        // Ruta a la plantilla de Word en la carpeta "public/Plantillas"
        $plantillaPath = public_path('Plantillas/1.-Informe-Servicio-Comunitario.docx');

        // Verificar si el archivo de plantilla existe
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $template = new TemplateProcessor($plantillaPath);

        $usuario = auth()->user();

        if (!$usuario) {
            abort(403, 'No estás autenticado.');
        }

        // Obtener el estudiante asociado al usuario
        $estudiante = $usuario->estudiante;

        if (!$estudiante) {
            abort(404, 'No se encontró el estudiante asociado a tu usuario.');
        }

        $asignacionProyecto = $estudiante->asignaciones->first();

        if ($asignacionProyecto) {
            $proyectoID = $asignacionProyecto->proyectoId;
        } else {
            return redirect()->route('estudiantes.documentos')->with('error', 'No esta asignado a un proyecto.');
        }

        $datosEstudiantes = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->join('profesuniversidad as director', 'proyectos.directorId', '=', 'director.id')
            ->join('profesuniversidad as participante', 'asignacionproyectos.participanteId', '=', 'participante.id')
            ->select(
                'estudiantes.Apellidos',
                'estudiantes.nombres',
                'estudiantes.cedula',
                'estudiantes.carrera',
                'estudiantes.departamento',
                'estudiantes.provincia',
                'asignacionproyectos.inicioFecha',
                'asignacionproyectos.finalizacionFecha',
                'proyectos.NombreProyecto',
                'director.nombres as NombreProfesor',
                'director.apellidos as ApellidoProfesor',
                'participante.nombres as NombreAsignado',
                'participante.apellidos as ApellidoAsignado'
            )
            ->where('asignacionproyectos.proyectoId', '=', $proyectoID)
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get();



        $datosEstudiantes2 = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('actividades_estudiante', 'estudiantes.estudianteId', '=', 'actividades_estudiante.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->select(
                'actividades_estudiante.fecha',
                'actividades_estudiante.actividades',
                'actividades_estudiante.numeroHoras',
                'actividades_estudiante.evidencias',
                'actividades_estudiante.nombreActividad',
            )
            ->where('proyectos.Estado', '=', 'Ejecucion')
            ->where('asignacionproyectos.proyectoId', '=', $proyectoID)
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get();



        // Verificar si se recuperaron datos
        if ($datosEstudiantes->isEmpty()) {
            abort(404, 'No se encontraron datos de estudiantes asignados al proyecto activo.');
        }

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $carreraEstudiante = strtoupper($primerEstudiante->carrera);
        $provinciaEstudiante = $primerEstudiante->provincia;
        $departamento = mb_strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['A', 'E', 'I', 'O', 'U'], $primerEstudiante->departamento));
        $fechaInicioProyecto = $primerEstudiante->inicioFecha;
        $fechaFinProyecto = $primerEstudiante->finalizacionFecha;
        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];

        $fechaFormateada2 = date('d ', strtotime($fechaFinProyecto)) . $meses[date('F', strtotime($fechaFinProyecto))] . date(' Y', strtotime($fechaFinProyecto));
        $fechaFormateada = date('d ', strtotime($fechaInicioProyecto)) . $meses[date('F', strtotime($fechaInicioProyecto))] . date(' Y', strtotime($fechaInicioProyecto));
        $NombreProyecto = $primerEstudiante->NombreProyecto;
        $NombreProfesor = $primerEstudiante->NombreProfesor;
        $ApellidoProfesor = $primerEstudiante->ApellidoProfesor;
        $NombreAsignado = $primerEstudiante->NombreAsignado;
        $ApellidoAsignado = $primerEstudiante->ApellidoAsignado;

        $horasVinculacionConstante = 96;

        ///obtener nombre del estudiante
        $usuario = auth()->user();
        $estudiante = $usuario->estudiante;
        $nombreEstudiante = $estudiante->nombres;
        $template->setValue('Nombre', $nombreEstudiante);
        $apelldioEstudiante = $estudiante->apellidos;
        $template->setValue('Apellido', $apelldioEstudiante);

        $template->setValue('departamento', $departamento);

        $template->setValue('NombreProfesor', $NombreProfesor);
        $template->setValue('ApellidoProfesor', $ApellidoProfesor);
        $template->setValue('NombreAsignado', $NombreAsignado);
        $template->setValue('ApellidoAsignado', $ApellidoAsignado);
        $template->setValue('FechaFin', $fechaFormateada2);
        ///obtener Input nombreComunidad
        $nombreComunidad = $request->input('nombreComunidad');
        $provincia = $request->input('provincia');
        $template->setValue('provincia', $provincia);
        $canton = $request->input('canton');
        $template->setValue('canton', $canton);
        $parroquia = $request->input('parroquia');
        $template->setValue('parroquia', $parroquia);
        $direccion = $request->input('direccion');
        $template->setValue('direccion', $direccion);
        $template->setValue('comunidad', $nombreComunidad);

        $razones = $request->input('razones');
        $template->setValue('razones', $razones);

        $razones = $request->input('conclusiones');
        $template->setValue('conclusiones', $razones);

        $razones = $request->input('recomendaciones');
        $template->setValue('recomendaciones', $razones);




        // Clonar las filas en la plantilla
        $template->cloneRow('Nombres', count($datosEstudiantes));
        $template->cloneRow('actividades', count($datosEstudiantes2));



        // Ordenar los datos por apellidos en orden ascendente (A-Z)
        $datosEstudiantes = $datosEstudiantes->sortBy('Apellidos');

        // Bucle para reemplazar los valores en la plantilla
        $contador = 1; // Inicializamos el contador en 1
        foreach ($datosEstudiantes as $index => $estudiante) {
            $template->setValue('Numero#' . ($index + 1), $contador);
            $template->setValue('Apellidos#' . ($index + 1), $estudiante->Apellidos);
            $template->setValue('Nombres#' . ($index + 1), $estudiante->nombres);
            $template->setValue('Cedula#' . ($index + 1), $estudiante->cedula);
            $template->setValue('Carrera#' . ($index + 1), $estudiante->carrera);
            $template->setValue('HorasVinculacion#' . ($index + 1), $horasVinculacionConstante);
            $contador++;
        }
        foreach ($datosEstudiantes2 as $index => $estudiante) {
            $fechaActividades = date('d, F Y', strtotime($estudiante->fecha));
            $template->setValue('fecha#' . ($index + 1), $fechaActividades);
            $template->setValue('actividades#' . ($index + 1), $estudiante->actividades);
            $template->setValue('numero_horas#' . ($index + 1), $estudiante->numeroHoras);

            // Decodificar la imagen base64
            $base64Image = $estudiante->evidencias;
            $imageData = base64_decode($base64Image);

            // Generar una ruta temporal para la imagen
            $tempImagePath = tempnam(sys_get_temp_dir(), 'evidencia_');

            // Guardar la imagen decodificada en la ruta temporal
            file_put_contents($tempImagePath, $imageData);

            // Insertar la imagen en el documento
            $template->setImageValue('evidencias#' . ($index + 1), [
                'path' => $tempImagePath,
                'width' => 150,
                'height' => 150,
                'ratio' => false,
            ]);

            // Eliminar la imagen temporal después de usarla
            unlink($tempImagePath);
        }

        //pasar todas las imagenes en un marcador para isnertarlaras
        $contadorFiguras = 1;
        $template->cloneRow('nombre_actividad', count($datosEstudiantes2));
        foreach ($datosEstudiantes2 as $index => $estudiante) {
            $nombreActividad = $estudiante->nombreActividad;
            $nombreFigura = 'Figura ' . $contadorFiguras . ': ' . $nombreActividad;
            $template->setValue('nombre_actividad#' . ($index + 1), $nombreFigura);

            // Decodificar la imagen base64
            $base64Image = $estudiante->evidencias;
            $imageData = base64_decode($base64Image);

            // Generar una ruta temporal para la imagen
            $tempImagePath = tempnam(sys_get_temp_dir(), 'evidencia_');

            // Guardar la imagen decodificada en la ruta temporal
            file_put_contents($tempImagePath, $imageData);

            // Insertar la imagen en el documento
            $template->setImageValue('evidencias#' . ($index + 1), [
                'path' => $tempImagePath,
                'width' => 250,
                'height' => 250,
                'ratio' => false,
            ]);

            // Eliminar la imagen temporal después de usarla
            unlink($tempImagePath);

            $contadorFiguras++;
        }











        $objetivosEspecificos = $request->input('especificos');
        $alcanzados = $request->input('alcanzados');
        $porcentaje = $request->input('porcentaje');

        $contadorObjetivos = count($objetivosEspecificos);
        $template->cloneRow('especificos', $contadorObjetivos);

        foreach ($objetivosEspecificos as $index => $objetivo) {
            $template->setValue('especificos#' . ($index + 1), $objetivo);
            $template->setValue('alcanzados#' . ($index + 1), $alcanzados[$index]);
            $template->setValue('porcentaje#' . ($index + 1), $porcentaje[$index]);
        }


        // Reemplazar los valores constantes en la plantilla
        $template->setValue('Carrera', $carreraEstudiante);
        $template->setValue('Provincia', $provinciaEstudiante);
        $template->setValue('FechaInicio', $fechaFormateada);
        $template->setValue('NombreProyecto', $NombreProyecto);


        // Guardar el documento generado
        $documentoGeneradoPath = storage_path('app/public/1.-Informe-Servicio-Comunitario.docx');
        $template->saveAs($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);

    }


    ////////////////////////Creacion de reportes estudiantes vinculacion
    public function reportesVinculacion(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Vinculacion-Estudiantes.xlsx');
        $template = new TemplateProcessor($plantillaPath);

        $spreadsheet = IOFactory::load($plantillaPath);

        $datosEstudiantes = DB::table('estudiantesvinculacion')
            ->select(
                'estudiantesvinculacion.cedula_identidad',
                'estudiantesvinculacion.correo_electronico',
                'estudiantesvinculacion.espe_id',
                'estudiantesvinculacion.nombres',
                'estudiantesvinculacion.periodo_ingreso',
                'estudiantesvinculacion.periodo_vinculacion',
                'estudiantesvinculacion.actividades_macro',
                'estudiantesvinculacion.actividades_macro',
                'estudiantesvinculacion.docente_participante',
                'estudiantesvinculacion.fecha_inicio',
                'estudiantesvinculacion.fecha_fin',
                'estudiantesvinculacion.total_horas',
                'estudiantesvinculacion.director_proyecto',
                'estudiantesvinculacion.nombre_proyecto',
            )
            ->orderBy('estudiantesvinculacion.nombres', 'asc')
            ->get();

        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($datosEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $sheet->mergeCells('N9:V9');


        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), $estudiante->nombres);
            $sheet->setCellValue('C' . ($filaInicio + $index), $estudiante->cedula_identidad);
            $sheet->setCellValue('D' . ($filaInicio + $index), $estudiante->correo_electronico);
            $sheet->setCellValue('E' . ($filaInicio + $index), $estudiante->espe_id);
            $sheet->setCellValue('F' . ($filaInicio + $index), $estudiante->periodo_ingreso);
            $sheet->setCellValue('G' . ($filaInicio + $index), $estudiante->periodo_vinculacion);
            $sheet->setCellValue('H' . ($filaInicio + $index), $estudiante->actividades_macro);
            $sheet->setCellValue('I' . ($filaInicio + $index), $estudiante->docente_participante);
            $sheet->setCellValue('J' . ($filaInicio + $index), $estudiante->fecha_inicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $estudiante->fecha_fin);
            $sheet->setCellValue('L' . ($filaInicio + $index), $estudiante->total_horas);
            $sheet->setCellValue('M' . ($filaInicio + $index), $estudiante->director_proyecto);
            $coordenadaInicio = 'N' . ($filaInicio + $index);
            $coordenadaFin = 'V' . ($filaInicio + $index);
            $sheet->mergeCells($coordenadaInicio . ':' . $coordenadaFin);
            $sheet->setCellValue($coordenadaInicio, $estudiante->nombre_proyecto);
            $contador++;

        }
        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-Vinculacion-Estudiantes.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }


    //////reporteria de proyectos///////

    public function reportesProyectos(Request $request)
    {
        try {
            $plantillaPath = public_path('Plantillas/Reporte-Proyectos.xlsx');
            $spreadsheet = IOFactory::load($plantillaPath);
            $estado = $request->input('estado');
            $departamento = $request->input('departamento');

            $query = DB::table('proyectos')
                ->select(
                    'proyectos.nombreProyecto',
                    'proyectos.codigoProyecto',
                    'proyectos.inicioFecha',
                    'proyectos.finFecha',
                    'proyectos.departamentoTutor',
                    'proyectos.estado',
                    'proyectos.descripcionProyecto',
                    'proyectos.directorId'
                )
                ->orderBy('proyectos.nombreProyecto', 'asc');

            if ($estado) {
                $query->where('estado', $estado);
            }

            if ($departamento) {
                $query->where('departamentoTutor', $departamento);
            }

            $datosProyectos = $query->get();
            $sheet = $spreadsheet->getActiveSheet();
            $filaInicio = 9;
            $cantidadFilas = count($datosProyectos);
            $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
            $contador = 1;

            foreach ($datosProyectos as $index => $proyecto) {
                $director = ProfesUniversidad::find($proyecto->directorId);
                $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
                $sheet->setCellValue('B' . ($filaInicio + $index), mb_strtoupper($proyecto->nombreProyecto, 'UTF-8'));
                $sheet->getStyle('B' . ($filaInicio + $index))->getAlignment()->setWrapText(true);
                $sheet->setCellValue('C' . ($filaInicio + $index), $proyecto->codigoProyecto);
                $sheet->setCellValue('E' . ($filaInicio + $index), mb_strtoupper($proyecto->departamentoTutor, 'UTF-8'));
                $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($proyecto->estado, 'UTF-8'));
                $sheet->getStyle('D' . ($filaInicio + $index))->getAlignment()->setWrapText(true);
                $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
                $contador++;
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $nombreArchivo = 'Reporte-Proyectos.xlsx';
            $writer->save($nombreArchivo);

            return response()->download($nombreArchivo)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }





    ////////Reporteria de estudiantes//////////
    public function reportesEstudiantes(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Estudiantes.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);
        $datosEstudiantes = DB::table('Estudiantes')
            ->select(
                'Estudiantes.Nombres',
                'Estudiantes.Apellidos',
                'Estudiantes.espe_id',
                'Estudiantes.celular',
                'Estudiantes.cedula',
                'Estudiantes.Correo',
                'Cohorte.Cohorte',
                'Estudiantes.Carrera',
                'Estudiantes.Departamento',
                'Estudiantes.Estado',
                'Periodo.Periodo',
            )
            ->join('Cohorte', 'Estudiantes.id_cohorte', '=', 'Cohorte.ID_cohorte')
            ->join('Periodo', 'Estudiantes.id_periodo', '=', 'Periodo.id') // Cambiado aquí
            ->orderBy('Estudiantes.Apellidos', 'asc')
            ->get();


        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($datosEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), $estudiante->Apellidos . ' ' . $estudiante->Nombres);
            $sheet->setCellValue('C' . ($filaInicio + $index), $estudiante->espe_id);
            $sheet->setCellValue('D' . ($filaInicio + $index), $estudiante->celular);
            $sheet->setCellValue('E' . ($filaInicio + $index), $estudiante->cedula);
            $sheet->setCellValue('F' . ($filaInicio + $index), $estudiante->Correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $estudiante->Periodo);
            $sheet->setCellValue('I' . ($filaInicio + $index), $estudiante->Carrera);
            $sheet->setCellValue('J' . ($filaInicio + $index), $estudiante->Departamento);

            // Reemplazar el estado según las condiciones
            $estadoReemplazado = $estudiante->Estado;
            if ($estadoReemplazado === 'Aprobado') {
                $estadoReemplazado = 'Vinculación';
            } elseif ($estadoReemplazado === 'Aprobado-practicas') {
                $estadoReemplazado = 'Prácticas';
            }

            $sheet->setCellValue('K' . ($filaInicio + $index), $estadoReemplazado);
            $contador++;
        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-Estudiantes.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }



    ///////Reporteria para las empresas agregadas////////////////////////////////
    public function reportesEmpresas(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Empresas.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $datosEstudiantes = DB::table('empresas')
            ->select(
                'empresas.nombreEmpresa',
                'empresas.rucEmpresa',
                'empresas.provincia',
                'empresas.ciudad',
                'empresas.direccion',
                'empresas.correo',
                'empresas.nombreContacto',
                'empresas.telefonoContacto',
                'empresas.actividadesMacro',
                'empresas.cuposDisponibles',
                'empresas.created_at',
                'empresas.updated_at',

            )
            ->get();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($datosEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), mb_strtoupper($estudiante->nombreEmpresa, 'UTF-8'));
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($estudiante->rucEmpresa, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($estudiante->provincia, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), mb_strtoupper($estudiante->ciudad, 'UTF-8'));
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($estudiante->direccion, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), strtolower($estudiante->correo));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($estudiante->nombreContacto, 'UTF-8'));
            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($estudiante->telefonoContacto, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($estudiante->actividadesMacro, 'UTF-8'));
            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($estudiante->cuposDisponibles, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($estudiante->created_at, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($estudiante->updated_at, 'UTF-8'));

            $contador++;
        }





        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-Empresas.xlsx');

        $writer->save($documentoGeneradoPath);

        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }



    /////////reporteria Practias I////////////////////////////////////////
    public function reportesPracticaI(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaI::all();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica1) {



            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = $practica1->estudiante->apellidos . ' ' . $practica1->estudiante->nombres;
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), $practica1->estudiante->cedula);
            $sheet->setCellValue('D' . ($filaInicio + $index), $practica1->estudiante->espeId);
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica1->estudiante->correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $practica1->estudiante->departamento);
            $sheet->setCellValue('F' . ($filaInicio + $index), $practica1->estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $practica1->estudiante->carrera);

            $sheet->setCellValue('I' . ($filaInicio + $index), $practica1->AreaConocimiento);
            $sheet->setCellValue('J' . ($filaInicio + $index), $practica1->FechaInicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $practica1->FechaFinalizacion);
            $sheet->setCellValue('L' . ($filaInicio + $index), $practica1->HoraEntrada);
            $sheet->setCellValue('M' . ($filaInicio + $index), $practica1->HoraSalida);
            $sheet->setCellValue('N' . ($filaInicio + $index), $practica1->HorasPlanificadas);
            $sheet->setCellValue('O' . ($filaInicio + $index), $practica1->tipoPractica);

            $sheet->setCellValue('P' . ($filaInicio + $index), $practica1->empresa->nombreEmpresa ?? '');
            $sheet->setCellValue('Q' . ($filaInicio + $index), $practica1->empresa->rucEmpresa ?? '');
            $sheet->setCellValue('R' . ($filaInicio + $index), $practica1->empresa->actividadesMacro ?? '');
            $sheet->setCellValue('S' . ($filaInicio + $index), $practica1->empresa->provincia ?? '');
            $sheet->setCellValue('T' . ($filaInicio + $index), $practica1->empresa->ciudad ?? '');
            $sheet->setCellValue('U' . ($filaInicio + $index), $practica1->empresa->direccion ?? '');
            $sheet->setCellValue('V' . ($filaInicio + $index), $practica1->empresa->correo ?? '');
            $sheet->setCellValue('W' . ($filaInicio + $index), $practica1->empresa->nombreContacto ?? '');
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica1->empresa->telefonoContacto ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), $practica1->NombreTutorEmpresarial ?? '');
            $sheet->setCellValue('Z' . ($filaInicio + $index), $practica1->CedulaTutorEmpresarial ?? '');
            $sheet->setCellValue('AA' . ($filaInicio + $index), $practica1->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AB' . ($filaInicio + $index), $practica1->TelefonoTutorEmpresarial ?? '');
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica1->Funcion ?? '');

            $sheet->setCellValue('AD' . ($filaInicio + $index), ($practica1->tutorAcademico->apellidos ?? '') . ' ' . ($practica1->tutorAcademico->Nombres ?? ''));
            $sheet->setCellValue('AE' . ($filaInicio + $index), $practica1->tutorAcademico->cedula ?? '');
            $sheet->setCellValue('AF' . ($filaInicio + $index), $practica1->tutorAcademico->espeId ?? '');
            $sheet->setCellValue('AG' . ($filaInicio + $index), $practica1->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AH' . ($filaInicio + $index), 'Docente de tiempo completo');
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica1->tutorAcademico->departamento ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'Tecnologias de la Informacion');








            $contador++;

        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-PracticasI.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }



    /////////reporteria Practias II////////////////////////////////////////
    public function reportesPracticaII(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaII::all();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica1) {



            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = $practica1->estudiante->apellidos . ' ' . $practica1->estudiante->nombres;
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), $practica1->estudiante->cedula);
            $sheet->setCellValue('D' . ($filaInicio + $index), $practica1->estudiante->espeId);
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica1->estudiante->correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $practica1->estudiante->departamento);
            $sheet->setCellValue('F' . ($filaInicio + $index), $practica1->estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $practica1->estudiante->carrera);

            $sheet->setCellValue('I' . ($filaInicio + $index), $practica1->AreaConocimiento);
            $sheet->setCellValue('J' . ($filaInicio + $index), $practica1->FechaInicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $practica1->FechaFinalizacion);
            $sheet->setCellValue('L' . ($filaInicio + $index), $practica1->HoraEntrada);
            $sheet->setCellValue('M' . ($filaInicio + $index), $practica1->HoraSalida);
            $sheet->setCellValue('N' . ($filaInicio + $index), $practica1->HorasPlanificadas);
            $sheet->setCellValue('O' . ($filaInicio + $index), $practica1->tipoPractica);

            $sheet->setCellValue('P' . ($filaInicio + $index), $practica1->empresa->nombreEmpresa ?? '');
            $sheet->setCellValue('Q' . ($filaInicio + $index), $practica1->empresa->rucEmpresa ?? '');
            $sheet->setCellValue('R' . ($filaInicio + $index), $practica1->empresa->actividadesMacro ?? '');
            $sheet->setCellValue('S' . ($filaInicio + $index), $practica1->empresa->provincia ?? '');
            $sheet->setCellValue('T' . ($filaInicio + $index), $practica1->empresa->ciudad ?? '');
            $sheet->setCellValue('U' . ($filaInicio + $index), $practica1->empresa->direccion ?? '');
            $sheet->setCellValue('V' . ($filaInicio + $index), $practica1->empresa->correo ?? '');
            $sheet->setCellValue('W' . ($filaInicio + $index), $practica1->empresa->nombreContacto ?? '');
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica1->empresa->telefonoContacto ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), $practica1->NombreTutorEmpresarial ?? '');
            $sheet->setCellValue('Z' . ($filaInicio + $index), $practica1->CedulaTutorEmpresarial ?? '');
            $sheet->setCellValue('AA' . ($filaInicio + $index), $practica1->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AB' . ($filaInicio + $index), $practica1->TelefonoTutorEmpresarial ?? '');
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica1->Funcion ?? '');

            $sheet->setCellValue('AD' . ($filaInicio + $index), ($practica1->tutorAcademico->apellidos ?? '') . ' ' . ($practica1->tutorAcademico->Nombres ?? ''));
            $sheet->setCellValue('AE' . ($filaInicio + $index), $practica1->tutorAcademico->cedula ?? '');
            $sheet->setCellValue('AF' . ($filaInicio + $index), $practica1->tutorAcademico->espeId ?? '');
            $sheet->setCellValue('AG' . ($filaInicio + $index), $practica1->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AH' . ($filaInicio + $index), 'Docente de tiempo completo');
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica1->tutorAcademico->departamento ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'Tecnologias de la Informacion');








            $contador++;

        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-PracticasI.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }

    public function reportesPracticaIII(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaIII::all();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica1) {



            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = $practica1->estudiante->apellidos . ' ' . $practica1->estudiante->nombres;
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), $practica1->estudiante->cedula);
            $sheet->setCellValue('D' . ($filaInicio + $index), $practica1->estudiante->espeId);
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica1->estudiante->correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $practica1->estudiante->departamento);
            $sheet->setCellValue('F' . ($filaInicio + $index), $practica1->estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $practica1->estudiante->carrera);

            $sheet->setCellValue('I' . ($filaInicio + $index), $practica1->AreaConocimiento);
            $sheet->setCellValue('J' . ($filaInicio + $index), $practica1->FechaInicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $practica1->FechaFinalizacion);
            $sheet->setCellValue('L' . ($filaInicio + $index), $practica1->HoraEntrada);
            $sheet->setCellValue('M' . ($filaInicio + $index), $practica1->HoraSalida);
            $sheet->setCellValue('N' . ($filaInicio + $index), $practica1->HorasPlanificadas);
            $sheet->setCellValue('O' . ($filaInicio + $index), $practica1->tipoPractica);

            $sheet->setCellValue('P' . ($filaInicio + $index), $practica1->empresa->nombreEmpresa ?? '');
            $sheet->setCellValue('Q' . ($filaInicio + $index), $practica1->empresa->rucEmpresa ?? '');
            $sheet->setCellValue('R' . ($filaInicio + $index), $practica1->empresa->actividadesMacro ?? '');
            $sheet->setCellValue('S' . ($filaInicio + $index), $practica1->empresa->provincia ?? '');
            $sheet->setCellValue('T' . ($filaInicio + $index), $practica1->empresa->ciudad ?? '');
            $sheet->setCellValue('U' . ($filaInicio + $index), $practica1->empresa->direccion ?? '');
            $sheet->setCellValue('V' . ($filaInicio + $index), $practica1->empresa->correo ?? '');
            $sheet->setCellValue('W' . ($filaInicio + $index), $practica1->empresa->nombreContacto ?? '');
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica1->empresa->telefonoContacto ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), $practica1->NombreTutorEmpresarial ?? '');
            $sheet->setCellValue('Z' . ($filaInicio + $index), $practica1->CedulaTutorEmpresarial ?? '');
            $sheet->setCellValue('AA' . ($filaInicio + $index), $practica1->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AB' . ($filaInicio + $index), $practica1->TelefonoTutorEmpresarial ?? '');
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica1->Funcion ?? '');

            $sheet->setCellValue('AD' . ($filaInicio + $index), ($practica1->tutorAcademico->apellidos ?? '') . ' ' . ($practica1->tutorAcademico->Nombres ?? ''));
            $sheet->setCellValue('AE' . ($filaInicio + $index), $practica1->tutorAcademico->cedula ?? '');
            $sheet->setCellValue('AF' . ($filaInicio + $index), $practica1->tutorAcademico->espeId ?? '');
            $sheet->setCellValue('AG' . ($filaInicio + $index), $practica1->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AH' . ($filaInicio + $index), 'Docente de tiempo completo');
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica1->tutorAcademico->departamento ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'Tecnologias de la Informacion');








            $contador++;

        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-PracticasI.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }

    public function reportesPracticaIV(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaIV::all();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica1) {



            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = $practica1->estudiante->apellidos . ' ' . $practica1->estudiante->nombres;
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), $practica1->estudiante->cedula);
            $sheet->setCellValue('D' . ($filaInicio + $index), $practica1->estudiante->espeId);
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica1->estudiante->correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $practica1->estudiante->departamento);
            $sheet->setCellValue('F' . ($filaInicio + $index), $practica1->estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $practica1->estudiante->carrera);

            $sheet->setCellValue('I' . ($filaInicio + $index), $practica1->AreaConocimiento);
            $sheet->setCellValue('J' . ($filaInicio + $index), $practica1->FechaInicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $practica1->FechaFinalizacion);
            $sheet->setCellValue('L' . ($filaInicio + $index), $practica1->HoraEntrada);
            $sheet->setCellValue('M' . ($filaInicio + $index), $practica1->HoraSalida);
            $sheet->setCellValue('N' . ($filaInicio + $index), $practica1->HorasPlanificadas);
            $sheet->setCellValue('O' . ($filaInicio + $index), $practica1->tipoPractica);

            $sheet->setCellValue('P' . ($filaInicio + $index), $practica1->empresa->nombreEmpresa ?? '');
            $sheet->setCellValue('Q' . ($filaInicio + $index), $practica1->empresa->rucEmpresa ?? '');
            $sheet->setCellValue('R' . ($filaInicio + $index), $practica1->empresa->actividadesMacro ?? '');
            $sheet->setCellValue('S' . ($filaInicio + $index), $practica1->empresa->provincia ?? '');
            $sheet->setCellValue('T' . ($filaInicio + $index), $practica1->empresa->ciudad ?? '');
            $sheet->setCellValue('U' . ($filaInicio + $index), $practica1->empresa->direccion ?? '');
            $sheet->setCellValue('V' . ($filaInicio + $index), $practica1->empresa->correo ?? '');
            $sheet->setCellValue('W' . ($filaInicio + $index), $practica1->empresa->nombreContacto ?? '');
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica1->empresa->telefonoContacto ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), $practica1->NombreTutorEmpresarial ?? '');
            $sheet->setCellValue('Z' . ($filaInicio + $index), $practica1->CedulaTutorEmpresarial ?? '');
            $sheet->setCellValue('AA' . ($filaInicio + $index), $practica1->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AB' . ($filaInicio + $index), $practica1->TelefonoTutorEmpresarial ?? '');
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica1->Funcion ?? '');

            $sheet->setCellValue('AD' . ($filaInicio + $index), ($practica1->tutorAcademico->apellidos ?? '') . ' ' . ($practica1->tutorAcademico->Nombres ?? ''));
            $sheet->setCellValue('AE' . ($filaInicio + $index), $practica1->tutorAcademico->cedula ?? '');
            $sheet->setCellValue('AF' . ($filaInicio + $index), $practica1->tutorAcademico->espeId ?? '');
            $sheet->setCellValue('AG' . ($filaInicio + $index), $practica1->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AH' . ($filaInicio + $index), 'Docente de tiempo completo');
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica1->tutorAcademico->departamento ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'Tecnologias de la Informacion');








            $contador++;

        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-PracticasI.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }

    public function reportesPracticaV(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaV::all();
        $sheet = $spreadsheet->getActiveSheet();


        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica1) {



            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = $practica1->estudiante->apellidos . ' ' . $practica1->estudiante->nombres;
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), $practica1->estudiante->cedula);
            $sheet->setCellValue('D' . ($filaInicio + $index), $practica1->estudiante->espeId);
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica1->estudiante->correo);
            $sheet->setCellValue('G' . ($filaInicio + $index), $practica1->estudiante->departamento);
            $sheet->setCellValue('F' . ($filaInicio + $index), $practica1->estudiante->Cohorte);
            $sheet->setCellValue('H' . ($filaInicio + $index), $practica1->estudiante->carrera);

            $sheet->setCellValue('I' . ($filaInicio + $index), $practica1->AreaConocimiento);
            $sheet->setCellValue('J' . ($filaInicio + $index), $practica1->FechaInicio);
            $sheet->setCellValue('K' . ($filaInicio + $index), $practica1->FechaFinalizacion);
            $sheet->setCellValue('L' . ($filaInicio + $index), $practica1->HoraEntrada);
            $sheet->setCellValue('M' . ($filaInicio + $index), $practica1->HoraSalida);
            $sheet->setCellValue('N' . ($filaInicio + $index), $practica1->HorasPlanificadas);
            $sheet->setCellValue('O' . ($filaInicio + $index), $practica1->tipoPractica);

            $sheet->setCellValue('P' . ($filaInicio + $index), $practica1->empresa->nombreEmpresa ?? '');
            $sheet->setCellValue('Q' . ($filaInicio + $index), $practica1->empresa->rucEmpresa ?? '');
            $sheet->setCellValue('R' . ($filaInicio + $index), $practica1->empresa->actividadesMacro ?? '');
            $sheet->setCellValue('S' . ($filaInicio + $index), $practica1->empresa->provincia ?? '');
            $sheet->setCellValue('T' . ($filaInicio + $index), $practica1->empresa->ciudad ?? '');
            $sheet->setCellValue('U' . ($filaInicio + $index), $practica1->empresa->direccion ?? '');
            $sheet->setCellValue('V' . ($filaInicio + $index), $practica1->empresa->correo ?? '');
            $sheet->setCellValue('W' . ($filaInicio + $index), $practica1->empresa->nombreContacto ?? '');
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica1->empresa->telefonoContacto ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), $practica1->NombreTutorEmpresarial ?? '');
            $sheet->setCellValue('Z' . ($filaInicio + $index), $practica1->CedulaTutorEmpresarial ?? '');
            $sheet->setCellValue('AA' . ($filaInicio + $index), $practica1->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AB' . ($filaInicio + $index), $practica1->TelefonoTutorEmpresarial ?? '');
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica1->Funcion ?? '');

            $sheet->setCellValue('AD' . ($filaInicio + $index), ($practica1->tutorAcademico->apellidos ?? '') . ' ' . ($practica1->tutorAcademico->Nombres ?? ''));
            $sheet->setCellValue('AE' . ($filaInicio + $index), $practica1->tutorAcademico->cedula ?? '');
            $sheet->setCellValue('AF' . ($filaInicio + $index), $practica1->tutorAcademico->espeId ?? '');
            $sheet->setCellValue('AG' . ($filaInicio + $index), $practica1->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AH' . ($filaInicio + $index), 'Docente de tiempo completo');
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica1->tutorAcademico->departamento ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'Tecnologias de la Informacion');








            $contador++;

        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Reporte-PracticasI.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }

    /////////////////////reporte de estudiantes con proyectos en vinculacion//////////////////////////
    public function reporteVinculacionProyectos(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Proyectos_Vinculacion.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $datosProyectosYEstudiantes = Proyecto::with([
            'estudiantes' => function ($query) {
                $query->orderBy('Apellidos', 'desc');
            }
        ])->get();

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($datosProyectosYEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosProyectosYEstudiantes as $index => $proyecto) {
            // Información del proyecto
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), $proyecto->NombreProyecto);
            $sheet->setCellValue('C' . ($filaInicio + $index), $proyecto->ApellidoProfesor . ' ' . $proyecto->NombreProfesor);
            $sheet->setCellValue('E' . ($filaInicio + $index), $proyecto->ApellidoAsignado . ' ' . $proyecto->NombreAsignado);
            $sheet->setCellValue('D' . ($filaInicio + $index), $proyecto->DescripcionProyecto);
            $sheet->setCellValue('G' . ($filaInicio + $index), $proyecto->FechaInicio);
            $sheet->setCellValue('H' . ($filaInicio + $index), $proyecto->FechaFinalizacion);
            $sheet->setCellValue('I' . ($filaInicio + $index), $proyecto->DepartamentoTutor);

            // Información de los estudiantes asignados al proyecto
            $estudiantesAsignados = $proyecto->estudiantes;

            // Concatenar los nombres de los estudiantes con saltos de línea
            $nombresEstudiantes = [];
            foreach ($estudiantesAsignados as $estudiante) {
                $nombresEstudiantes[] = $estudiante->Apellidos . ' ' . $estudiante->Nombres;
            }

            $nombresEstudiantes = implode("\n", $nombresEstudiantes);

            // Establecer el estilo de texto para permitir saltos de línea
            $sheet->getStyle('F' . ($filaInicio + $index))->getAlignment()->setWrapText(true);

            $sheet->setCellValue('F' . ($filaInicio + $index), $nombresEstudiantes);

            $contador++;
        }

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documentoGeneradoPath = storage_path('app/public/Proyectos_Vinculacion.xlsx');

        $writer->save($documentoGeneradoPath);

        // Descargar el documento generado
        return response()->download($documentoGeneradoPath)->deleteFileAfterSend(true);
    }


    ////////////////////////reporte de docentes///////////////////////

    public function ReporteProyectos()
    {
        $plantillaPath = public_path('Plantillas/Reporte-Docentes.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        // Obtener todos los docentes ordenados por apellido de manera alfabética
        $docentes = ProfesUniversidad::orderBy('apellidos')->get();

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;

        $cantidadFilas = count($docentes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($docentes as $index => $docente) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCompleto = mb_strtoupper($docente->apellidos . ', ' . $docente->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCompleto);
            $sheet->setCellValue('C' . ($filaInicio + $index), $docente->correo); // No convertir a mayúsculas
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($docente->usuario, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), mb_strtoupper($docente->cedula, 'UTF-8'));
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($docente->departamento, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($docente->espeId, 'UTF-8'));
            $contador++;
        }

        // Guardar el documento generado
        $nombreArchivo = 'Reporte-Docentes.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }




    //////////////////////////////////////////////////////////////////////////////////////DOCUMENTOS PRACTICAS/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function EncuestaEstudiante()
    {
        $plantillaPath = public_path('Plantillas/practicas/EncuestaEstudiantes.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);

        $template->setValue('empresa', $datosEstudiantes->first()->empresa->nombreEmpresa);
        $estudiante = $datosEstudiantes->first();
        if (is_object($estudiante) && is_object($estudiante->nrc) && is_object($estudiante->nrc->periodo)) {
            $template->setValue('periodo', $estudiante->nrc->periodo->numeroPeriodo);
        } else {
            $template->setValue('periodo', 'Default Periodo Value');
        }

        ///////descargar el documento generado
        $nombreArchivo = 'EncuestaEstudiantes.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    public function EncuestaDocentes()
    {
        $plantillaPath = public_path('Plantillas/practicas/EncuestaDocentes.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)->get();

        $template->setValue('Nombre', $datosEstudiantes->first()->tutorAcademico->nombres . ' ' . $datosEstudiantes->first()->tutorAcademico->apellidos);
        $template->setValue('Cedula', $datosEstudiantes->first()->tutorAcademico->c);
        $template->setValue('Departamento', $datosEstudiantes->first()->tutorAcademico->departamento);
        $template->setValue('Correo', $datosEstudiantes->first()->tutorAcademico->correo);
        $estudiante = $datosEstudiantes->first();
        if (is_object($estudiante) && is_object($estudiante->nrc) && is_object($estudiante->nrc->periodo)) {
            $template->setValue('periodo', $estudiante->nrc->periodo->numeroPeriodo);
        } else {
            $template->setValue('periodo', 'Default Periodo Value');
        }
        $nombreArchivo = 'EncuestaDocentes.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }

    public function EvTutorEmpresarial()
    {
        $plantillaPath = public_path('Plantillas/practicas/EvTutorEmpresarial.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $estudiante = $datosEstudiantes->first();
        if (is_object($estudiante) && is_object($estudiante->nrc) && is_object($estudiante->nrc->periodo)) {
            $template->setValue('periodo', $estudiante->nrc->periodo->numeroPeriodo);
        } else {
            $template->setValue('periodo', 'Default Periodo Value');
        }


        $fechaInicio = $datosEstudiantes->first()->FechaInicio;
        $formattedFechaInicio = date('d/m/Y', strtotime($fechaInicio));
        $template->setValue('FechaInicio', $formattedFechaInicio);

        $fechaFinalizacion = $datosEstudiantes->first()->FechaFinalizacion;
        $formattedFechaFinalizacion = date('d/m/Y', strtotime($fechaFinalizacion));
        $template->setValue('FechaFinalizacion', $formattedFechaFinalizacion);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);
        $template->setValue('HoraEntrada', $datosEstudiantes->first()->HoraEntrada);
        $template->setValue('HoraSalida', $datosEstudiantes->first()->HoraSalida);

        $template->setValue('NombresEmpresarial', $datosEstudiantes->first()->NombreTutorEmpresarial);
        $template->setValue('CedulaEmpresarial', $datosEstudiantes->first()->CedulaTutorEmpresarial);


        $nombreArchivo = 'EvTutorEmpresarial.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    public function PlanificacionPPEstudiante()
    {
        $plantillaPath = public_path('Plantillas/practicas/PlanificacionPPEstudiante.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)->get();
         $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->Correo);
        $estudiante = $datosEstudiantes->first();
        if (is_object($estudiante) && is_object($estudiante->nrc) && is_object($estudiante->nrc->periodo)) {
            $template->setValue('periodo', $estudiante->nrc->periodo->numeroPeriodo);
        } else {
            $template->setValue('periodo', 'Default Periodo Value');
        }


        $template->setValue('Empresa', $datosEstudiantes->first()->empresa->nombreEmpresa);
        $template->setValue('Actividades', $datosEstudiantes->first()->empresa->actividadesMacro);
        $template->setValue('Direccion', $datosEstudiantes->first()->empresa->direccion);

        $template->setValue('NombresEmpresarial', $datosEstudiantes->first()->NombreTutorEmpresarial);
        $template->setValue('CedulaEmpresarial', $datosEstudiantes->first()->CedulaTutorEmpresarial);
        $template->setValue('TelefonoEmpresarial', $datosEstudiantes->first()->TelefonoTutorEmpresarial);
        $template->setValue('CorreoEmpresarial', $datosEstudiantes->first()->EmailTutorEmpresarial);
        $template->setValue('Funcion', $datosEstudiantes->first()->Funcion);


        $template->setValue('NombresAcademico', $datosEstudiantes->first()->tutorAcademico->nombres . ' ' . $datosEstudiantes->first()->tutorAcademico->apellidos);
        $template->setValue('CedulaAcademico', $datosEstudiantes->first()->tutorAcademico->cedula);
        $template->setValue('CorreoAcademico', $datosEstudiantes->first()->tutorAcademico->correo);
        $template->setValue('id_espeAcademico', $datosEstudiantes->first()->tutorAcademico->espeId);





        $fechaInicio = $datosEstudiantes->first()->FechaInicio;
        $formattedFechaInicio = date('d/m/Y', strtotime($fechaInicio));
        $template->setValue('FechaInicio', $formattedFechaInicio);

        $fechaFinalizacion = $datosEstudiantes->first()->FechaFinalizacion;
        $formattedFechaFinalizacion = date('d/m/Y', strtotime($fechaFinalizacion));
        $template->setValue('FechaFinalizacion', $formattedFechaFinalizacion);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);
        $template->setValue('HoraEntrada', $datosEstudiantes->first()->HoraEntrada);
        $template->setValue('HoraSalida', $datosEstudiantes->first()->HoraSalida);



        $nombreArchivo = 'PlanificacionPPEstudiante.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }



    ///////////////acta de reunion

    public function actaReunion(Request $request)
    {
        $plantillaPath = public_path('Plantillas/2.-Acta-de-Reunión-2.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $template = new TemplateProcessor($plantillaPath);

        $profesor = Auth::user()->profesorUniversidad;

        ////obtener el proyecto del profesor con estudiantes asignados en estado aprobado
        $proyecto = AsignacionProyecto::where('ParticipanteID', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('Estado', 'Aprobado');
            })->first();

        ////nombre del proyecto
        $template->setValue('nombreProyecto', $proyecto->proyecto->NombreProyecto);

        $template->setValue('lugar', $request->lugar);
        $template->setValue('fecha', $request->fecha);
        $template->setValue('horaInicial', $request->horaInicial);
        $template->setValue('horaFinal', $request->horaFinal);
        $template->setValue('tema', $request->tema);
        $template->setValue('objetivo', $request->objetivo);
        $template->setValue('antecedentes', $request->antecedentes);


        $acciones = $request->input('acciones');
        $responsable = $request->input('responsable');
        $fecha = $request->input('fechaAcciones');

        $contadorObjetivos = count($acciones);
        $template->cloneRow('acciones', $contadorObjetivos); // Clonar filas según la cantidad de acciones

        foreach ($acciones as $index => $objetivo) {
            $numFila = $index + 1; // Obtener el número de fila
            $template->setValue('acciones#' . $numFila, $objetivo); // Asignar valor de acción
            $template->setValue('responsable#' . $numFila, $responsable[$index]); // Asignar valor de responsable
            $template->setValue('fechaAcciones#' . $numFila, $fecha[$index]); // Asignar valor de fecha de acciones
            $template->setValue('contador#' . $numFila, $numFila); // Asignar valor de contador
        }

        $template->setValue('participante', $profesor->Apellidos . ' ' . $profesor->Nombres);
        $template->setValue('Correo', $profesor->Correo);
        $template->setValue('Celular', '0912345678');

        $proyectoID = Proyecto::find($proyecto->ProyectoID);
        $director = ProfesUniversidad::find($proyectoID->DirectorID);
        $template->setValue('director', $director->Apellidos . ' ' . $director->Nombres);
        $template->setValue('correoDirector', $director->Correo);
        $template->setValue('celularDirector', '0912345238');


        /////obtener todos los estudiantes asignados al proyecto del profesor con estado aprobado
        $estudiantes = Estudiante::where('Estado', 'Aprobado')
            ->whereHas('asignaciones', function ($query) use ($profesor) {
                $query->where('ParticipanteID', $profesor->id);
            })->get();

        $contadorEstudiantes = count($estudiantes);
        $template->cloneRow('estudiantes', $contadorEstudiantes);
        foreach ($estudiantes as $index => $estudiante) {
            $numFila = $index + 1;
            $template->setValue('estudiantes#' . $numFila, $estudiante->Apellidos . ' ' . $estudiante->Nombres);
            $template->setValue('entidad#' . $numFila, 'Universidad de las Fuerzas Armadas ESPE Sede Santo Domingo');
            $template->setValue('correoEstudiante#' . $numFila, $estudiante->Correo);
            $template->setValue('celularEstudiante#' . $numFila, $estudiante->celular);
        }


        $nombreArchivo = 'Acta-de-Reunión.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    ///////////////baremos

    public function baremo(Request $request)
    {
        $plantillaPath = public_path('Plantillas/baremos.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $profesor = Auth::user()->profesorUniversidad;

        $proyecto = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })->first();

        $proyectoID = Proyecto::find($proyecto->proyectoId);

        $inicioFecha = $proyecto->inicioFecha;
        $finalizacionFecha = $proyecto->finalizacionFecha;



        ///obtener nombre del proyecto
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('B7', $proyectoID->nombreProyecto);

        ////nombre del director del proyecto
        $director = ProfesUniversidad::find($proyectoID->directorId);
        $sheet->setCellValue('B8', $director->apellidos . ' ' . $director->nombres);

        $sheet->setCellValue('B10', $proyectoID->departamentoTutor);
        $sheet->setCellValue('B11', $proyectoID->first()->asignaciones->first()->inicioFecha);
        $sheet->setCellValue('B12', $proyectoID->first()->asignaciones->first()->finalizacionFecha);

        $sheet->setCellValue('B13', $profesor->apellidos . ' ' . $profesor->nombres);
        $sheet->setCellValue('B14', $profesor->departamento);



        $tabla1 = $request->input('tabla1');
        $tabla2 = $request->input('tabla2');
        $tabla3 = $request->input('tabla3');
        $tabla4 = $request->input('tabla4');

        $sumasTablas = $tabla1 + $tabla2 + $tabla3 + $tabla4;

        ///mandar cada uno a una celda
        $sheet->setCellValue('B22', $tabla1);
        $sheet->setCellValue('F22', $tabla2);
        $sheet->setCellValue('J22', $tabla3);
        $sheet->setCellValue('N22', $tabla4);
        $sheet->setCellValue('R22', $sumasTablas);
        $sheet->setCellValue('B15', $sumasTablas);







        /////descarga del documento
        $nombreArchivo = 'baremo.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }

    /////////entrar a la vista
    public function mostrarFormulario()
    {
        $estudiante = Auth::user()->estudiante;

        // Verificar el estado del estudiante
        if ($estudiante->estado === 'En proceso de revision' || $estudiante->estado === 'Aprobado-practicas') {
            // Redirigir o mostrar un mensaje de error, según tus necesidades
            return redirect()->back()->with('error', 'No tienes acceso a esta página en este momento.');
        }


        // Obtener las actividades registradas si el estado permite el acceso
        $actividadesRegistradas = ActividadEstudiante::where('estudianteId', $estudiante->estudianteId)->get();

        return view('estudiantes.documentos', ['actividadesRegistradas' => $actividadesRegistradas]);
    }


}
