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
use App\Models\AsignacionSinEstudiante;
use Carbon\Carbon;
use App\Models\ActividadesPracticasII;
use App\Models\UsuariosSession;
use App\Models\ActividadesPracticas;
use App\Models\NrcVinculacion;

use App\Models\PracticaI;
use App\Models\Periodo;
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

        ////obtener el periodov de la asignacion
        $idPeriodo = $asignacionProyecto->idPeriodo;

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
                'asignacionproyectos.inicioFecha',
                'proyectos.nombreProyecto',
            )
            ->where('asignacionproyectos.proyectoId', $proyectoID)
            ->where('asignacionproyectos.idPeriodo', $asignacionProyecto->idPeriodo)
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get();

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $carreraEstudiante = mb_strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['A', 'E', 'I', 'O', 'U'], $primerEstudiante->carrera));
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
        $provinciaEstudiante = 'Santo Domingo';

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
            $idPeriodo = $asignacionProyecto->idPeriodo;
        } else {
            return redirect()->route('estudiantes.documentos')->with('error', 'No está asignado a un proyecto.');
        }

        $proyecto = Proyecto::find($proyectoID);
        $departamentoProyecto = $proyecto->departamentoTutor;

        // Consulta para obtener los datos de los estudiantes asignados a un proyecto específico
        $datosEstudiantes = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->join('profesuniversidad as director', 'proyectos.directorId', '=', 'director.id')
            ->join('profesuniversidad as participante', 'asignacionproyectos.participanteId', '=', 'participante.id')
            ->select(
                'estudiantes.apellidos',
                'estudiantes.nombres',
                'estudiantes.cedula',
                'estudiantes.departamento',
                'estudiantes.celular',
                'estudiantes.carrera',
                'estudiantes.correo',
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
            ->where('asignacionproyectos.idPeriodo', $asignacionProyecto->idPeriodo)
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
        $departamento = "Departamento de " . $departamentoProyecto;

        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];

        $fechaFormateada = date('d F Y', strtotime($fechaInicioProyecto));
        $fechaFormateada = strtr($fechaFormateada, $meses);

        $NombreProyecto = $primerEstudiante->nombreProyecto;
        $horasVinculacionConstante = 96;
        $matriz = 'Sede Santo Domingo';
        $nombreProfesor = $primerEstudiante->NombreProfesor;
        $apellidoProfesor = $primerEstudiante->ApellidoProfesor;
        $nombreCombinado = "{$nombreProfesor} {$apellidoProfesor}";

        // Obtener la hoja activa del archivo XLSX
        $sheet = $spreadsheet->getActiveSheet();

        // Clonar filas en la plantilla
        $filaInicio = 5; // La primera fila de datos comienza en la fila 5
        $cantidadFilas = count($datosEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $filaActual = $filaInicio + $index;
            $apellidoNombre = $estudiante->apellidos . ' ' . $estudiante->nombres;
            $sheet->setCellValue('C' . $filaActual, $apellidoNombre);
            $sheet->setCellValue('D' . $filaActual, $estudiante->cedula);
            $sheet->setCellValue('E' . $filaActual, $estudiante->celular);
            $horasVinculacionConstanteEntero = round($horasVinculacionConstante);
            $sheet->setCellValue('L' . $filaActual, $horasVinculacionConstanteEntero);
            $sheet->setCellValue('H' . $filaActual, $estudiante->departamento);
            $sheet->setCellValue('I' . $filaActual, $estudiante->carrera);
            $sheet->setCellValue('J' . $filaActual, $fechaInicioProyecto);
            $sheet->setCellValue('K' . $filaActual, $fechaFinProyecto);
            $sheet->setCellValue('G' . $filaActual, $matriz);
            $sheet->setCellValue('F' . $filaActual, $estudiante->correo);
        }

        // Unir celdas para los encabezados y el proyecto
        $sheet->mergeCells("B5:B" . (5 + $cantidadFilas - 1));
        $sheet->mergeCells("A5:A" . (5 + $cantidadFilas - 1));
        $sheet->setCellValue('B5', $NombreProyecto);
        $sheet->setCellValue('A5', '1');


        $sheet->mergeCells('B18:D18');
        $sheet->mergeCells('B17:D17');
        $sheet->mergeCells('B19:D19');

        $sheet->setCellValue('C2', $departamento);

        $sheet->getStyle('B28')->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $sheet->getStyle('B28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B28')->getAlignment()->setWrapText(true);

        //////contadores para mostrar los nombres despues de la interaccion
        $filaFinal = $filaInicio + count($datosEstudiantes) + 2;
        $sheet->setCellValue('B' . $filaFinal, 'Fecha:');

        $nombreCompleto = $filaInicio + count($datosEstudiantes) + 12;
        $sheet->setCellValue('B' . $nombreCompleto, $nombreCombinado);
        $rangoCeldas = 'B' . $nombreCompleto . ':D' . $nombreCompleto;
        $sheet->getStyle($rangoCeldas)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('B' . $nombreCompleto)->getFont()->setBold(true);

        $departamentoProyecto = $filaInicio + count($datosEstudiantes) + 13;
        $sheet->setCellValue('B' . $departamentoProyecto, $departamento);

        $marcoDirectorProyecto = $filaInicio + count($datosEstudiantes) + 14;
        $sheet->setCellValue('B' . $marcoDirectorProyecto, 'Director de Proyecto');

        ///////////////////////interacion Coordinadoir
        $nombreCoordinador = $filaInicio + count($datosEstudiantes) + 12;
        $sheet->setCellValue('F' . $nombreCoordinador, 'Verónica Isabel Martinez Cepeda');
        $rangoCeldas = 'F' . $nombreCoordinador . ':G' . $nombreCoordinador;
        $sheet->getStyle($rangoCeldas)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('F' . $nombreCoordinador)->getFont()->setBold(true);
        $sheet->getStyle('F' . $nombreCoordinador)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('F' . $nombreCoordinador . ':G' . $nombreCoordinador);
        $sheet->getStyle('F' . $nombreCoordinador)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $departamentoCoordinador = $filaInicio + count($datosEstudiantes) + 13;
        $sheet->setCellValue('F' . $departamentoCoordinador, 'Departamento de Ciencias de la Computación');
        $rangoCeldas = 'F' . $departamentoCoordinador . ':G' . $departamentoCoordinador;
        $sheet->getStyle('F' . $departamentoCoordinador)->getFont()->setBold(true);
        $sheet->getStyle('F' . $departamentoCoordinador)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('F' . $departamentoCoordinador . ':G' . $departamentoCoordinador);
        $sheet->getStyle('F' . $departamentoCoordinador)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $marcoCoordinador = $filaInicio + count($datosEstudiantes) + 14;
        $sheet->setCellValue('F' . $marcoCoordinador, 'Coordinador de Vinculación con la Sociedad');
        $rangoCeldas = 'F' . $marcoCoordinador . ':G' . $marcoCoordinador;
        $sheet->getStyle('F' . $marcoCoordinador)->getFont()->setBold(true);
        $sheet->getStyle('F' . $marcoCoordinador)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('F' . $marcoCoordinador . ':G' . $marcoCoordinador);
        $sheet->getStyle('F' . $marcoCoordinador)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        ////////////////interaccion director de carrera
        $nombreDirectorCarrera = $filaInicio + count($datosEstudiantes) + 12;
        $sheet->setCellValue('I' . $nombreDirectorCarrera, 'Christian Alfredo Coronel Guerrero');
        $rangoCeldas = 'I' . $nombreDirectorCarrera . ':J' . $nombreDirectorCarrera;
        $sheet->getStyle($rangoCeldas)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('I' . $nombreDirectorCarrera)->getFont()->setBold(true);
        $sheet->getStyle('I' . $nombreDirectorCarrera)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('I' . $nombreDirectorCarrera . ':J' . $nombreDirectorCarrera);
        $sheet->getStyle('I' . $nombreDirectorCarrera)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $departamentoDirectorCarrera = $filaInicio + count($datosEstudiantes) + 13;
        $sheet->setCellValue('I' . $departamentoDirectorCarrera, 'Director de Carrera');
        $rangoCeldas = 'I' . $departamentoDirectorCarrera . ':J' . $departamentoDirectorCarrera;
        $sheet->getStyle('I' . $departamentoDirectorCarrera)->getFont()->setBold(true);
        $sheet->getStyle('I' . $departamentoDirectorCarrera)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('I' . $departamentoDirectorCarrera . ':J' . $departamentoDirectorCarrera);
        $sheet->getStyle('I' . $departamentoDirectorCarrera)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $marcoDirectorCarrera = $filaInicio + count($datosEstudiantes) + 14;
        $sheet->setCellValue('I' . $marcoDirectorCarrera, 'Tecnologías de la Información');
        $rangoCeldas = 'I' . $marcoDirectorCarrera . ':J' . $marcoDirectorCarrera;
        $sheet->getStyle('I' . $marcoDirectorCarrera)->getFont()->setBold(true);
        $sheet->getStyle('I' . $marcoDirectorCarrera)->getFont()->setName('Calibri')->setSize(16);
        $sheet->mergeCells('I' . $marcoDirectorCarrera . ':J' . $marcoDirectorCarrera);
        $sheet->getStyle('I' . $marcoDirectorCarrera)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);








        ///agrega estilos a la celda
        $sheet->getStyle('B' . $filaFinal)->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $sheet->getStyle('C' . $filaFinal)->getFont()->setName('Calibri')->setSize(16);
        $sheet->getStyle('C' . $filaFinal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C' . $filaFinal)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('C' . $filaFinal, $fechaFormateada);


        // Formatear celdas
        $sheet->getStyle('C9')->getFont()->setName('Calibri')->setSize(16);
        $sheet->getStyle('B17')->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $sheet->getStyle('B17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B18')->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $sheet->getStyle('B18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B19')->getFont()->setName('Calibri')->setSize(16)->setBold(true);
        $sheet->getStyle('B19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B9')->getFont()->setName('Calibri')->setSize(16)->setBold(true);


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
                'asignacionproyectos.inicioFecha',
                'asignacionproyectos.finalizacionFecha',
                'proyectos.NombreProyecto',
                'director.nombres as NombreProfesor',
                'director.apellidos as ApellidoProfesor',
                'participante.nombres as NombreAsignado',
                'participante.apellidos as ApellidoAsignado'
            )
            ->where('asignacionproyectos.proyectoId', '=', $proyectoID)
            ->where('asignacionproyectos.idPeriodo', $asignacionProyecto->idPeriodo)
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
                'actividades_estudiante.nombreActividad'
            )
            ->where('proyectos.Estado', '=', 'Ejecucion')
            ->where('asignacionproyectos.proyectoId', '=', $proyectoID)
            ->orderBy('estudiantes.apellidos', 'asc')
            ->orderBy('actividades_estudiante.fecha', 'asc') // Ordena por fecha de manera ascendente
            ->get();



        // Verificar si se recuperaron datos
        if ($datosEstudiantes->isEmpty()) {
            abort(404, 'No se encontraron datos de estudiantes asignados al proyecto activo.');
        }

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $carreraEstudiante = strtoupper($primerEstudiante->carrera);
        $provinciaEstudiante = 'Santo Domingo';
        $departamento = mb_strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['A', 'E', 'I', 'O', 'U'], $primerEstudiante->departamento));
        $fechaInicioProyecto = $primerEstudiante->inicioFecha;
        $fechaFinProyecto = $primerEstudiante->finalizacionFecha;
        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
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
            $fechaActividades = date('d ', strtotime($estudiante->fecha)) . $meses[date('F', strtotime($estudiante->fecha))] . date(' Y', strtotime($estudiante->fecha));
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

    ///////////////////////////////reporte de asistencia del estudiante//////////////////////////////////
    public function generarAsistenciaEstudiante(Request $request)
    {
        $plantillaPath = public_path('Plantillas/1.1-Registro-de-Estudiantes.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);
        $usuario = auth()->user();
        $correoUsuario = $usuario->correoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('correo', $correoUsuario)->first();
        // Obtener la relación AsignacionProyecto para este ParticipanteVinculacion
        $asignacionProyecto = AsignacionProyecto::where('participanteId', $participanteVinculacion->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->first();

        //////verificar si esta asignado a un proyecto
        if ($asignacionProyecto == null) {
            return redirect()->back()->with('error', 'No tiene proyectos asignados');
        }

        ///obtener la id del director de AsiignacionProyecto
        $proyecto = Proyecto::where('proyectoId', $asignacionProyecto->proyectoId)->first();


        if ($proyecto->estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }
        // Obtener los estudiantes asignados a este proyecto
        $estudiantes = AsignacionProyecto::where('proyectoId', $proyecto->proyectoId)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->get();
        if ($estudiantes->isEmpty()) {
            return redirect()->back()->with('error', 'No hay estudiantes asignados a este proyecto.');
        }
        $Director = ProfesUniversidad::where('id', $proyecto->directorId)->first();


        $hojaCalculo = $spreadsheet->getActiveSheet();
        $filaInicio = 9;
        $cantidadFilas = count($estudiantes);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $estudiantes = $estudiantes->sortBy('Estudiante.Apellidos');
        ///Obtener el nombre del participante
        $nombreParticipante = "Ing. " . $participanteVinculacion->apellidos . ' ' . $participanteVinculacion->nombres . ", Mgtr.";
        $nombreDirector = "Ing. " . $Director->apellidos . ' ' . $Director->nombres . ", Mgtr.";
        ///Obtener el departamento del participante
        $departamento = "Departamento de " . $participanteVinculacion->departamento;
        $departamentoDirector = "Departamento de " . $proyecto->departamentoTutor;
        $nombreProyecto = "Nombre del Proyecto: " . $proyecto->nombreProyecto;
        $firma1 = 'DOCENTE PARTICIPANTE';
        $firma2 = 'DIRECTOR DE PROYECTO';
        ///Obtener del input
        $fechaInput = $request->input('fecha');
        $fechaFormateada = date('d F Y', strtotime($fechaInput));
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
        $fechaFormateada = strtr($fechaFormateada, $meses);


        $lugarInput = $request->input('lugar');
        $lugar = "Lugar: " . $lugarInput;

        $actividadesInput = $request->input('actividades');
        $hojaCalculo->getCell("A5")->setValue("Actividad(es):\n$actividadesInput");


        ///combinar celdas
        $hojaCalculo->mergeCells('B18:C18');
        $hojaCalculo->mergeCells('E18:F18');
        $hojaCalculo->mergeCells('B19:C19');
        $hojaCalculo->mergeCells('E19:F19');
        $hojaCalculo->mergeCells('B20:C20');
        $hojaCalculo->mergeCells('E20:F20');




        ///llenar las celdas
        $hojaCalculo->setCellValue("B18", $nombreParticipante);
        $hojaCalculo->getStyle("B18")->getFont()->setSize(11);
        $hojaCalculo->getStyle("B18")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("B18")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B18")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $hojaCalculo->setCellValue("E18", $nombreDirector);
        $hojaCalculo->getStyle("E18")->getFont()->setSize(11);
        $hojaCalculo->getStyle("E18")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("E18")->getFont()->setBold(true);
        $hojaCalculo->getStyle("E18")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $hojaCalculo->setCellValue("B19", $departamento);
        $hojaCalculo->getStyle("B19")->getFont()->setSize(11);
        $hojaCalculo->getStyle("B19")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("B19")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B19")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $hojaCalculo->setCellValue("E19", $departamentoDirector);
        $hojaCalculo->getStyle("E19")->getFont()->setSize(11);
        $hojaCalculo->getStyle("E19")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("E19")->getFont()->setBold(true);
        $hojaCalculo->getStyle("E19")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $hojaCalculo->setCellValue("A4", $nombreProyecto);

        $nombreResponsable = "Nombre del Responsable:\n$nombreDirector\n$nombreParticipante";
        $hojaCalculo->setCellValue("G5", $nombreResponsable);
        $hojaCalculo->getStyle("G5")->getAlignment()->setWrapText(true);



        $hojaCalculo->setCellValue("B20", $firma1);
        $hojaCalculo->getStyle("B20")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("B20")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B20")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $hojaCalculo->setCellValue("E20", $firma2);
        $hojaCalculo->getStyle("E20")->getFont()->setName("Arial Narrow");
        $hojaCalculo->getStyle("E20")->getFont()->setBold(true);
        $hojaCalculo->getStyle("E20")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        //mostra datos del input
        $hojaCalculo->setCellValue("E6", "Fecha: $fechaFormateada");
        $hojaCalculo->setCellValue("A6", $lugar);
        $contador = 1;
        ///crea el foreach para recorrer los estudiantes y obtener Nombres,Apellidos y cedula
        foreach ($estudiantes as $index => $estudiante) {
            $filaActual = $filaInicio + $index;
            $hojaCalculo->setCellValue("A$filaActual", $contador);
            $nombreCompleto = $estudiante->Estudiante->apellidos . ' ' . $estudiante->Estudiante->nombres;
            $hojaCalculo->setCellValue("B$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("C$filaActual", $estudiante->Estudiante->cedula);
            $hojaCalculo->setCellValue("D$filaActual", $estudiante->Estudiante->carrera);
            $hojaCalculo->setCellValue("E$filaActual", $estudiante->Estudiante->celular);
            $hojaCalculo->setCellValue("F$filaActual", $estudiante->Estudiante->correo);




        }


        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "1.1-Registro-de-Estudiantes.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);




    }

    //////////////////////////////////////////Reporte estudiantes///////////////////////

    public function ReporteEstudiantes(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Estudiantes.xlsx');

        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $spreadsheet = IOFactory::load($plantillaPath);
        $sheet = $spreadsheet->getActiveSheet();

        $departamento = $request->input('Departamento');
        $periodo = $request->input('periodos');

        // Construir la consulta con los filtros
        $queryEstudiantes = Estudiante::query();

        if ($departamento) {
            $queryEstudiantes->where('departamento', $departamento);
        }

        if ($periodo) {
            $queryEstudiantes->where('Cohorte', $periodo);
        }

        $estudiantes = $queryEstudiantes->orderBy('apellidos', 'asc')->get();

        $filaInicio = 9;
        $cantidadFilas = count($estudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($estudiantes as $index => $estudiante) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), mb_strtoupper($estudiante->apellidos . ' ' . $estudiante->nombres, 'UTF-8'));
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($estudiante->celular, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), mb_strtoupper($estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('F' . ($filaInicio + $index), ($estudiante->correo));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($estudiante->carrera, 'UTF-8'));
            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($estudiante->departamento, 'UTF-8'));

            $contador++;
        }

        $sheet->getStyle('A9:J' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte_estudiantes.xlsx';
        $writer->save($nombreArchivo);

        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }

    ////////////////////////Reporte de sesiones////////////////////////
    public function reporteSessiones()
    {
        $plantillaPath = public_path('Plantillas/Reporte-Sesiones.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $template = new TemplateProcessor($plantillaPath);

        $sesiones = UsuariosSession::orderBy('start_time', 'asc')->get();

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($sesiones);

        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($sesiones as $index => $sesion) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $sheet->setCellValue('B' . ($filaInicio + $index), $sesion->usuario->nombreUsuario);
            $sheet->setCellValue('C' . ($filaInicio + $index), $sesion->usuario->correoElectronico);
            $sheet->setCellValue('D' . ($filaInicio + $index), $sesion->start_time);
            $sheet->setCellValue('E' . ($filaInicio + $index), $sesion->end_time ?? 'Sesión activa');
            $sheet->setCellValue('F' . ($filaInicio + $index), $sesion->locality);


            $contador++;
        }

        $sheet->getStyle('A9:H' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte_Sesiones.xlsx';
        $writer->save($nombreArchivo);

        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

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
                    'proyectos.directorId',
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
                $currentRow = $filaInicio + $index;

                $sheet->setCellValue('A' . $currentRow, $contador);
                $sheet->setCellValue('B' . $currentRow, mb_strtoupper($proyecto->nombreProyecto, 'UTF-8'));
                $sheet->getStyle('B' . $currentRow)->getAlignment()->setWrapText(true)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->setCellValue('D' . $currentRow, $proyecto->codigoProyecto);
                $sheet->setCellValue('F' . $currentRow, mb_strtoupper($proyecto->departamentoTutor, 'UTF-8'));
                $sheet->setCellValue('I' . $currentRow, mb_strtoupper($proyecto->estado, 'UTF-8'));
                /////fecha inicio
                $fechaInicio = date('d/m/Y', strtotime($proyecto->inicioFecha));
                $sheet->setCellValue('G' . $currentRow, $fechaInicio);
                /////fecha fin
                $fechaFin = date('d/m/Y', strtotime($proyecto->finFecha));
                $sheet->setCellValue('H' . $currentRow, $fechaFin);
                $sheet->getStyle('D' . $currentRow)->getAlignment()->setWrapText(true)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->setCellValue('E' . $currentRow, mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
                ////OBTENER NOMBRE DEK DIRECTOR EN MAYUSCULAS
                $nombreDirector = mb_strtoupper($director->nombres . ' ' . $director->apellidos, 'UTF-8');
                $sheet->setCellValue('C' . $currentRow, $nombreDirector);

                // Ajuste automático de altura de fila para la fila actual
                $sheet->getRowDimension($currentRow)->setRowHeight(-1);

                $contador++;
            }


            ////justificar y centrar
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            ////QUE TODAS LAS CEDLAS SE AJUSTEN AL TEXTO para que no se vea mal
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setWrapText(true);
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setShrinkToFit(true);
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);

            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setShrinkToFit(true);
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A9:I' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);


            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $nombreArchivo = 'Reporte_proyectos_sociales.xlsx';
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
                'empresas.updated_at'
            )
            ->get();

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($datosEstudiantes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($datosEstudiantes as $index => $estudiante) {
            $currentRow = $filaInicio + $index;

            $sheet->setCellValue('A' . $currentRow, $contador);
            $sheet->setCellValue('B' . $currentRow, mb_strtoupper($estudiante->nombreEmpresa, 'UTF-8'));
            $sheet->setCellValue('C' . $currentRow, mb_strtoupper($estudiante->rucEmpresa, 'UTF-8'));
            $sheet->setCellValue('D' . $currentRow, mb_strtoupper($estudiante->provincia, 'UTF-8'));
            $sheet->setCellValue('E' . $currentRow, mb_strtoupper($estudiante->ciudad, 'UTF-8'));
            $sheet->setCellValue('F' . $currentRow, mb_strtoupper($estudiante->direccion, 'UTF-8'));
            $sheet->setCellValue('G' . $currentRow, strtolower($estudiante->correo));
            $sheet->setCellValue('H' . $currentRow, mb_strtoupper($estudiante->nombreContacto, 'UTF-8'));
            $sheet->setCellValue('I' . $currentRow, mb_strtoupper($estudiante->telefonoContacto, 'UTF-8'));
            $sheet->setCellValue('J' . $currentRow, mb_strtoupper($estudiante->actividadesMacro, 'UTF-8'));
            $sheet->setCellValue('K' . $currentRow, mb_strtoupper($estudiante->cuposDisponibles, 'UTF-8'));
            $sheet->setCellValue('L' . $currentRow, mb_strtoupper($estudiante->created_at, 'UTF-8'));
            $sheet->setCellValue('M' . $currentRow, mb_strtoupper($estudiante->updated_at, 'UTF-8'));

            // Ajustar estilo de las celdas
            $sheet->getStyle('A' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('D' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('E' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('F' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('G' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('H' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('I' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('J' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('K' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('L' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('M' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

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
        $profesor = $request->input('profesor');
        $empresa = $request->input('empresa');
        $periodos = $request->input('periodos');

        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaI::join('estudiantes', 'practicasi.estudianteId', '=', 'estudiantes.estudianteId')
            ->when($profesor, function ($query, $profesor) {
                return $query->whereHas('tutorAcademico', function ($query) use ($profesor) {
                    $query->where('nombres', 'LIKE', '%' . $profesor . '%');
                });
            })
            ->when($empresa, function ($query, $empresa) {
                return $query->whereHas('empresa', function ($query) use ($empresa) {
                    $query->where('nombreEmpresa', 'LIKE', '%' . $empresa . '%');
                });
            })
            ->when($periodos, function ($query, $periodos) {
                return $query->where('periodoPractica', 'LIKE', '%' . $periodos . '%');
            })
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get(['practicasi.*']);



        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = mb_strtoupper($practica->estudiante->apellidos . ' ' . $practica->estudiante->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica->estudiante->correo);
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($practica->periodoPractica, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($practica->nota_final, 'UTF-8'));

            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->departamento, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->carrera, 'UTF-8'));

            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($practica->AreaConocimiento, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($practica->FechaInicio, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($practica->FechaFinalizacion, 'UTF-8'));
            $sheet->setCellValue('N' . ($filaInicio + $index), mb_strtoupper($practica->HoraEntrada, 'UTF-8'));
            $sheet->setCellValue('O' . ($filaInicio + $index), mb_strtoupper($practica->HoraSalida, 'UTF-8'));
            $sheet->setCellValue('P' . ($filaInicio + $index), mb_strtoupper($practica->HorasPlanificadas, 'UTF-8'));
            $sheet->setCellValue('Q' . ($filaInicio + $index), mb_strtoupper($practica->tipoPractica, 'UTF-8'));

            $sheet->setCellValue('R' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('S' . ($filaInicio + $index), mb_strtoupper($practica->empresa->rucEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('T' . ($filaInicio + $index), mb_strtoupper($practica->empresa->actividadesMacro ?? '', 'UTF-8'));
            $sheet->setCellValue('U' . ($filaInicio + $index), mb_strtoupper($practica->empresa->provincia ?? '', 'UTF-8'));
            $sheet->setCellValue('V' . ($filaInicio + $index), mb_strtoupper($practica->empresa->ciudad ?? '', 'UTF-8'));
            $sheet->setCellValue('W' . ($filaInicio + $index), mb_strtoupper($practica->empresa->direccion ?? '', 'UTF-8'));
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica->empresa->correo ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('Z' . ($filaInicio + $index), mb_strtoupper($practica->empresa->telefonoContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('AA' . ($filaInicio + $index), mb_strtoupper($practica->NombreTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AB' . ($filaInicio + $index), mb_strtoupper($practica->CedulaTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AD' . ($filaInicio + $index), mb_strtoupper($practica->TelefonoTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AE' . ($filaInicio + $index), mb_strtoupper($practica->Funcion ?? '', 'UTF-8'));

            $sheet->setCellValue('AF' . ($filaInicio + $index), mb_strtoupper(($practica->tutorAcademico->apellidos ?? '') . ' ' . ($practica->tutorAcademico->nombres ?? ''), 'UTF-8'));
            $sheet->setCellValue('AG' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->cedula ?? '', 'UTF-8'));
            $sheet->setCellValue('AH' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->espeId ?? '', 'UTF-8'));
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'DOCENTE DE TIEMPO COMPLETO');
            $sheet->setCellValue('AK' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->departamento ?? '', 'UTF-8'));
            $sheet->setCellValue('AL' . ($filaInicio + $index), 'TECNOLOGÍAS DE LA INFORMACIÓN');

            $sheet->setCellValue('AM' . ($filaInicio + $index), mb_strtoupper($practica->Estado ?? '', 'UTF-8'));



            $contador++;
        }

        // Estilos para justificar y centrar
        $sheet->getStyle('A9:AL' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('S9:S' . ($filaInicio + $cantidadFilas))->getNumberFormat()->setFormatCode('0000000000001');

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte_estudiantes_practica_1.xlsx';
        $writer->save($nombreArchivo);

        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }




    /////////reporteria Practias II////////////////////////////////////////
    public function reportesPracticaII(Request $request)
    {
        $profesor = $request->input('profesor2');
        $empresa = $request->input('empresa2');
        $periodos = $request->input('periodos2');


        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaII::join('estudiantes', 'practicasii.estudianteId', '=', 'estudiantes.estudianteId')
            ->when($profesor, function ($query, $profesor) {
                return $query->whereHas('tutorAcademico', function ($query) use ($profesor) {
                    $query->where('nombres', 'LIKE', '%' . $profesor . '%');
                });
            })
            ->when($empresa, function ($query, $empresa) {
                return $query->whereHas('empresa', function ($query) use ($empresa) {
                    $query->where('nombreEmpresa', 'LIKE', '%' . $empresa . '%');
                });
            })
            ->when($periodos, function ($query, $periodos) {
                return $query->where('periodoPractica', 'LIKE', '%' . $periodos . '%');
            })
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get(['practicasii.*']);

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = mb_strtoupper($practica->estudiante->apellidos . ' ' . $practica->estudiante->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica->estudiante->correo);
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($practica->periodoPractica, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($practica->nota_final, 'UTF-8'));

            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->departamento, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->carrera, 'UTF-8'));

            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($practica->AreaConocimiento, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($practica->FechaInicio, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($practica->FechaFinalizacion, 'UTF-8'));
            $sheet->setCellValue('N' . ($filaInicio + $index), mb_strtoupper($practica->HoraEntrada, 'UTF-8'));
            $sheet->setCellValue('O' . ($filaInicio + $index), mb_strtoupper($practica->HoraSalida, 'UTF-8'));
            $sheet->setCellValue('P' . ($filaInicio + $index), mb_strtoupper($practica->HorasPlanificadas, 'UTF-8'));
            $sheet->setCellValue('Q' . ($filaInicio + $index), mb_strtoupper($practica->tipoPractica, 'UTF-8'));

            $sheet->setCellValue('R' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('S' . ($filaInicio + $index), mb_strtoupper($practica->empresa->rucEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('T' . ($filaInicio + $index), mb_strtoupper($practica->empresa->actividadesMacro ?? '', 'UTF-8'));
            $sheet->setCellValue('U' . ($filaInicio + $index), mb_strtoupper($practica->empresa->provincia ?? '', 'UTF-8'));
            $sheet->setCellValue('V' . ($filaInicio + $index), mb_strtoupper($practica->empresa->ciudad ?? '', 'UTF-8'));
            $sheet->setCellValue('W' . ($filaInicio + $index), mb_strtoupper($practica->empresa->direccion ?? '', 'UTF-8'));
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica->empresa->correo ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('Z' . ($filaInicio + $index), mb_strtoupper($practica->empresa->telefonoContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('AA' . ($filaInicio + $index), mb_strtoupper($practica->NombreTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AB' . ($filaInicio + $index), mb_strtoupper($practica->CedulaTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AD' . ($filaInicio + $index), mb_strtoupper($practica->TelefonoTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AE' . ($filaInicio + $index), mb_strtoupper($practica->Funcion ?? '', 'UTF-8'));

            $sheet->setCellValue('AF' . ($filaInicio + $index), mb_strtoupper(($practica->tutorAcademico->apellidos ?? '') . ' ' . ($practica->tutorAcademico->nombres ?? ''), 'UTF-8'));
            $sheet->setCellValue('AG' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->cedula ?? '', 'UTF-8'));
            $sheet->setCellValue('AH' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->espeId ?? '', 'UTF-8'));
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'DOCENTE DE TIEMPO COMPLETO');
            $sheet->setCellValue('AK' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->departamento ?? '', 'UTF-8'));
            $sheet->setCellValue('AL' . ($filaInicio + $index), 'TECNOLOGÍAS DE LA INFORMACIÓN');

            $sheet->setCellValue('AM' . ($filaInicio + $index), mb_strtoupper($practica->Estado ?? '', 'UTF-8'));



            $contador++;
        }

        // Estilos para justificar y centrar
        $sheet->getStyle('A9:AL' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('S9:S' . ($filaInicio + $cantidadFilas))->getNumberFormat()->setFormatCode('0000000000001');

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte_estudiantes_practica_2.xlsx';
        $writer->save($nombreArchivo);

        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }




    public function reportesPracticaIII(Request $request)
    {
        $profesor = $request->input('profesor3');
        $empresa = $request->input('empresa3');
        $periodos = $request->input('periodos3');

        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $practica3 = PracticaIII::join('estudiantes', 'practicasiii.estudianteId', '=', 'estudiantes.estudianteId')
            ->when($profesor, function ($query, $profesor) {
                return $query->whereHas('tutorAcademico', function ($query) use ($profesor) {
                    $query->where('nombres', 'LIKE', '%' . $profesor . '%');
                });
            })
            ->when($empresa, function ($query, $empresa) {
                return $query->whereHas('empresa', function ($query) use ($empresa) {
                    $query->where('nombreEmpresa', 'LIKE', '%' . $empresa . '%');
                });
            })
            ->when($periodos, function ($query, $periodos) {
                return $query->where('periodoPractica', 'LIKE', '%' . $periodos . '%');
            })
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get(['practicasiii.*']);


        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($practica3);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica3 as $index => $practica) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = mb_strtoupper($practica->estudiante->apellidos . ' ' . $practica->estudiante->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica->estudiante->correo);
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($practica->periodoPractica, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($practica->nota_final, 'UTF-8'));

            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->departamento, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->carrera, 'UTF-8'));

            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($practica->AreaConocimiento, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($practica->FechaInicio, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($practica->FechaFinalizacion, 'UTF-8'));
            $sheet->setCellValue('N' . ($filaInicio + $index), mb_strtoupper($practica->HoraEntrada, 'UTF-8'));
            $sheet->setCellValue('O' . ($filaInicio + $index), mb_strtoupper($practica->HoraSalida, 'UTF-8'));
            $sheet->setCellValue('P' . ($filaInicio + $index), mb_strtoupper($practica->HorasPlanificadas, 'UTF-8'));
            $sheet->setCellValue('Q' . ($filaInicio + $index), mb_strtoupper($practica->tipoPractica, 'UTF-8'));

            $sheet->setCellValue('R' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('S' . ($filaInicio + $index), mb_strtoupper($practica->empresa->rucEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('T' . ($filaInicio + $index), mb_strtoupper($practica->empresa->actividadesMacro ?? '', 'UTF-8'));
            $sheet->setCellValue('U' . ($filaInicio + $index), mb_strtoupper($practica->empresa->provincia ?? '', 'UTF-8'));
            $sheet->setCellValue('V' . ($filaInicio + $index), mb_strtoupper($practica->empresa->ciudad ?? '', 'UTF-8'));
            $sheet->setCellValue('W' . ($filaInicio + $index), mb_strtoupper($practica->empresa->direccion ?? '', 'UTF-8'));
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica->empresa->correo ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('Z' . ($filaInicio + $index), mb_strtoupper($practica->empresa->telefonoContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('AA' . ($filaInicio + $index), mb_strtoupper($practica->NombreTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AB' . ($filaInicio + $index), mb_strtoupper($practica->CedulaTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AD' . ($filaInicio + $index), mb_strtoupper($practica->TelefonoTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AE' . ($filaInicio + $index), mb_strtoupper($practica->Funcion ?? '', 'UTF-8'));

            $sheet->setCellValue('AF' . ($filaInicio + $index), mb_strtoupper(($practica->tutorAcademico->apellidos ?? '') . ' ' . ($practica->tutorAcademico->nombres ?? ''), 'UTF-8'));
            $sheet->setCellValue('AG' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->cedula ?? '', 'UTF-8'));
            $sheet->setCellValue('AH' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->espeId ?? '', 'UTF-8'));
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'DOCENTE DE TIEMPO COMPLETO');
            $sheet->setCellValue('AK' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->departamento ?? '', 'UTF-8'));
            $sheet->setCellValue('AL' . ($filaInicio + $index), 'TECNOLOGÍAS DE LA INFORMACIÓN');

            $sheet->setCellValue('AM' . ($filaInicio + $index), mb_strtoupper($practica->Estado ?? '', 'UTF-8'));



            $contador++;
        }

        // Estilos para justificar y centrar
        $sheet->getStyle('A9:AL' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('S9:S' . ($filaInicio + $cantidadFilas))->getNumberFormat()->setFormatCode('0000000000001');

        // Guardar el documento generado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte_estudiantes_practica_1.2.xlsx';
        $writer->save($nombreArchivo);

        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }


    public function reportesPracticaIV(Request $request)
    {
        $profesor = $request->input('profesor4');
        $empresa = $request->input('empresa4');
        $periodos = $request->input('periodos4');


        // Define the path to the Excel template
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.3.xlsx');

        // Load the Excel template
        $spreadsheet = IOFactory::load($plantillaPath);

        // Retrieve all records from PracticaIV
        $practicaIV = PracticaIV::join('estudiantes', 'practicasiv.estudianteId', '=', 'estudiantes.estudianteId')
            ->when($profesor, function ($query, $profesor) {
                return $query->whereHas('tutorAcademico', function ($query) use ($profesor) {
                    $query->where('nombres', 'LIKE', '%' . $profesor . '%');
                });
            })
            ->when($empresa, function ($query, $empresa) {
                return $query->whereHas('empresa', function ($query) use ($empresa) {
                    $query->where('nombreEmpresa', 'LIKE', '%' . $empresa . '%');
                });
            })
            ->when($periodos, function ($query, $periodos) {
                return $query->where('periodoPractica', 'LIKE', '%' . $periodos . '%');
            })
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get(['practicasiv.*']);


        $sheet = $spreadsheet->getActiveSheet();

        // Determine the starting row for data and the number of records
        $filaInicio = 9;
        $cantidadFilas = count($practicaIV);

        // Insert the necessary number of rows
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        // Initialize a counter for numbering the rows
        $contador = 1;

        // Loop through each record in PracticaIV and populate the sheet
        foreach ($practicaIV as $index => $practica) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = mb_strtoupper($practica->estudiante->apellidos . ' ' . $practica->estudiante->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica->estudiante->correo);
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($practica->periodoPractica, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($practica->nota_final, 'UTF-8'));

            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->departamento, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->carrera, 'UTF-8'));

            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($practica->AreaConocimiento, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($practica->FechaInicio, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($practica->FechaFinalizacion, 'UTF-8'));
            $sheet->setCellValue('N' . ($filaInicio + $index), mb_strtoupper($practica->HoraEntrada, 'UTF-8'));
            $sheet->setCellValue('O' . ($filaInicio + $index), mb_strtoupper($practica->HoraSalida, 'UTF-8'));
            $sheet->setCellValue('P' . ($filaInicio + $index), mb_strtoupper($practica->HorasPlanificadas, 'UTF-8'));
            $sheet->setCellValue('Q' . ($filaInicio + $index), mb_strtoupper($practica->tipoPractica, 'UTF-8'));

            $sheet->setCellValue('R' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('S' . ($filaInicio + $index), mb_strtoupper($practica->empresa->rucEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('T' . ($filaInicio + $index), mb_strtoupper($practica->empresa->actividadesMacro ?? '', 'UTF-8'));
            $sheet->setCellValue('U' . ($filaInicio + $index), mb_strtoupper($practica->empresa->provincia ?? '', 'UTF-8'));
            $sheet->setCellValue('V' . ($filaInicio + $index), mb_strtoupper($practica->empresa->ciudad ?? '', 'UTF-8'));
            $sheet->setCellValue('W' . ($filaInicio + $index), mb_strtoupper($practica->empresa->direccion ?? '', 'UTF-8'));
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica->empresa->correo ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('Z' . ($filaInicio + $index), mb_strtoupper($practica->empresa->telefonoContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('AA' . ($filaInicio + $index), mb_strtoupper($practica->NombreTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AB' . ($filaInicio + $index), mb_strtoupper($practica->CedulaTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AD' . ($filaInicio + $index), mb_strtoupper($practica->TelefonoTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AE' . ($filaInicio + $index), mb_strtoupper($practica->Funcion ?? '', 'UTF-8'));

            $sheet->setCellValue('AF' . ($filaInicio + $index), mb_strtoupper(($practica->tutorAcademico->apellidos ?? '') . ' ' . ($practica->tutorAcademico->nombres ?? ''), 'UTF-8'));
            $sheet->setCellValue('AG' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->cedula ?? '', 'UTF-8'));
            $sheet->setCellValue('AH' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->espeId ?? '', 'UTF-8'));
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'DOCENTE DE TIEMPO COMPLETO');
            $sheet->setCellValue('AK' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->departamento ?? '', 'UTF-8'));
            $sheet->setCellValue('AL' . ($filaInicio + $index), 'TECNOLOGÍAS DE LA INFORMACIÓN');

            $sheet->setCellValue('AM' . ($filaInicio + $index), mb_strtoupper($practica->Estado ?? '', 'UTF-8'));



            $contador++;
        }

        // Estilos para justificar y centrar
        $sheet->getStyle('A9:AL' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('S9:S' . ($filaInicio + $cantidadFilas))->getNumberFormat()->setFormatCode('0000000000001');


        // Save the generated document
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte-estudiantes_practica_1.3.xlsx';
        $writer->save($nombreArchivo);

        // Return the generated file as a downloadable response
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }




    public function reportesPracticaV(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Practicas1.2.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $practica1 = PracticaV::join('estudiantes', 'practicasv.estudianteId', '=', 'estudiantes.estudianteId')
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get(['practicasv.*']);

        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;
        $cantidadFilas = count($practica1);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        foreach ($practica1 as $index => $practica) {
            $sheet->setCellValue('A' . ($filaInicio + $index), $contador);
            $nombreCombinado = mb_strtoupper($practica->estudiante->apellidos . ' ' . $practica->estudiante->nombres, 'UTF-8');
            $sheet->setCellValue('B' . ($filaInicio + $index), $nombreCombinado);
            $sheet->setCellValue('C' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->cedula, 'UTF-8'));
            $sheet->setCellValue('D' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->espeId, 'UTF-8'));
            $sheet->setCellValue('E' . ($filaInicio + $index), $practica->estudiante->correo);
            $sheet->setCellValue('F' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->Cohorte, 'UTF-8'));
            $sheet->setCellValue('G' . ($filaInicio + $index), mb_strtoupper($practica->periodoPractica, 'UTF-8'));
            $sheet->setCellValue('H' . ($filaInicio + $index), mb_strtoupper($practica->nota_final, 'UTF-8'));

            $sheet->setCellValue('I' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->departamento, 'UTF-8'));
            $sheet->setCellValue('J' . ($filaInicio + $index), mb_strtoupper($practica->estudiante->carrera, 'UTF-8'));

            $sheet->setCellValue('K' . ($filaInicio + $index), mb_strtoupper($practica->AreaConocimiento, 'UTF-8'));
            $sheet->setCellValue('L' . ($filaInicio + $index), mb_strtoupper($practica->FechaInicio, 'UTF-8'));
            $sheet->setCellValue('M' . ($filaInicio + $index), mb_strtoupper($practica->FechaFinalizacion, 'UTF-8'));
            $sheet->setCellValue('N' . ($filaInicio + $index), mb_strtoupper($practica->HoraEntrada, 'UTF-8'));
            $sheet->setCellValue('O' . ($filaInicio + $index), mb_strtoupper($practica->HoraSalida, 'UTF-8'));
            $sheet->setCellValue('P' . ($filaInicio + $index), mb_strtoupper($practica->HorasPlanificadas, 'UTF-8'));
            $sheet->setCellValue('Q' . ($filaInicio + $index), mb_strtoupper($practica->tipoPractica, 'UTF-8'));

            $sheet->setCellValue('R' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('S' . ($filaInicio + $index), mb_strtoupper($practica->empresa->rucEmpresa ?? '', 'UTF-8'));
            $sheet->setCellValue('T' . ($filaInicio + $index), mb_strtoupper($practica->empresa->actividadesMacro ?? '', 'UTF-8'));
            $sheet->setCellValue('U' . ($filaInicio + $index), mb_strtoupper($practica->empresa->provincia ?? '', 'UTF-8'));
            $sheet->setCellValue('V' . ($filaInicio + $index), mb_strtoupper($practica->empresa->ciudad ?? '', 'UTF-8'));
            $sheet->setCellValue('W' . ($filaInicio + $index), mb_strtoupper($practica->empresa->direccion ?? '', 'UTF-8'));
            $sheet->setCellValue('X' . ($filaInicio + $index), $practica->empresa->correo ?? '');
            $sheet->setCellValue('Y' . ($filaInicio + $index), mb_strtoupper($practica->empresa->nombreContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('Z' . ($filaInicio + $index), mb_strtoupper($practica->empresa->telefonoContacto ?? '', 'UTF-8'));
            $sheet->setCellValue('AA' . ($filaInicio + $index), mb_strtoupper($practica->NombreTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AB' . ($filaInicio + $index), mb_strtoupper($practica->CedulaTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AC' . ($filaInicio + $index), $practica->EmailTutorEmpresarial ?? '');
            $sheet->setCellValue('AD' . ($filaInicio + $index), mb_strtoupper($practica->TelefonoTutorEmpresarial ?? '', 'UTF-8'));
            $sheet->setCellValue('AE' . ($filaInicio + $index), mb_strtoupper($practica->Funcion ?? '', 'UTF-8'));

            $sheet->setCellValue('AF' . ($filaInicio + $index), mb_strtoupper(($practica->tutorAcademico->apellidos ?? '') . ' ' . ($practica->tutorAcademico->nombres ?? ''), 'UTF-8'));
            $sheet->setCellValue('AG' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->cedula ?? '', 'UTF-8'));
            $sheet->setCellValue('AH' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->espeId ?? '', 'UTF-8'));
            $sheet->setCellValue('AI' . ($filaInicio + $index), $practica->tutorAcademico->correo ?? '');
            $sheet->setCellValue('AJ' . ($filaInicio + $index), 'DOCENTE DE TIEMPO COMPLETO');
            $sheet->setCellValue('AK' . ($filaInicio + $index), mb_strtoupper($practica->tutorAcademico->departamento ?? '', 'UTF-8'));
            $sheet->setCellValue('AL' . ($filaInicio + $index), 'TECNOLOGÍAS DE LA INFORMACIÓN');

            $sheet->setCellValue('AM' . ($filaInicio + $index), mb_strtoupper($practica->Estado ?? '', 'UTF-8'));



            $contador++;
        }

        // Estilos para justificar y centrar
        $sheet->getStyle('A9:AL' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('S9:S' . ($filaInicio + $cantidadFilas))->getNumberFormat()->setFormatCode('0000000000001');


        // Save the generated document
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = 'Reporte-estudiantes_practica_2.2.xlsx';
        $writer->save($nombreArchivo);

        // Return the generated file as a downloadable response
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
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
        $nombreArchivo = 'Reporte_proyectos_sociales.xlsx';
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
        // Descargar el documento generado
    }


    ////////////////////////reporte de docentes///////////////////////

    public function ReporteProyectos(Request $request)
    {
        $plantillaPath = public_path('Plantillas/Reporte-Docentes.xlsx');

        $spreadsheet = IOFactory::load($plantillaPath);

        $departamento = $request->input('departamentos');
 

         $docentes = ProfesUniversidad::orderBy('apellidos');

         if ($departamento) {
            $docentes->where('departamento', 'LIKE', '%' . $departamento . '%');
        }

        $docentes = $docentes->get();



        $sheet = $spreadsheet->getActiveSheet();

        $filaInicio = 9;

        $cantidadFilas = count($docentes);
        $sheet->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);

        $contador = 1;

        // Bucle para reemplazar los valores en la plantilla
        foreach ($docentes as $index => $docente) {
            $currentRow = $filaInicio + $index;

            $sheet->setCellValue('A' . $currentRow, $contador);
            $nombreCompleto = mb_strtoupper($docente->apellidos . ', ' . $docente->nombres, 'UTF-8');
            $sheet->setCellValue('B' . $currentRow, $nombreCompleto);
            $sheet->setCellValue('C' . $currentRow, $docente->correo); // No convertir a mayúsculas
            $sheet->setCellValue('D' . $currentRow, mb_strtoupper($docente->usuario, 'UTF-8'));
            $sheet->setCellValue('E' . $currentRow, mb_strtoupper($docente->cedula, 'UTF-8'));
            $sheet->setCellValue('F' . $currentRow, mb_strtoupper($docente->departamento, 'UTF-8'));
            $sheet->setCellValue('G' . $currentRow, mb_strtoupper($docente->espeId, 'UTF-8'));

            // Ajustar estilo de las celdas
            $sheet->getStyle('A' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('D' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('E' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('F' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('G' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $contador++;
        }

        // Guardar el documento generado
        $nombreArchivo = 'Reporte_docentes_participantes_y_directores.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }




    //////////////////////acta desginacion estudaintes para el director
    public function generarActaDirector()
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

        $director = $usuario->profesorUniversidad;


        if (!$director) {
            abort(404, 'No se encontró el director asociado a tu usuario.');
        }

        ///obtener el proyecto del director de Proyecto
        $proyecto = Proyecto::where('directorId', $director->id)->first();

        if (!$proyecto) {
            return redirect()->route('director.repartoEstudiantes')->with('error', 'No esta asignado a un proyecto.');
        }

        // Obtener los estudiantes asignados al proyecto
        $asignacionProyecto = AsignacionProyecto::where('proyectoId', $proyecto->proyectoId)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->first();

        if (!$asignacionProyecto) {
            return redirect()->route('director.repartoEstudiantes')->with('error', 'No esta asignado a un proyecto.');
        }




        if ($asignacionProyecto) {
            $proyectoID = $asignacionProyecto->proyectoId;
            $periodo = $asignacionProyecto->idPeriodo;
        } else {
            return redirect()->route('director.repartoEstudiantes')->with('error', 'No esta asignado a un proyecto.');
        }

        $datosEstudiantes = DB::table('estudiantes')
            ->join('asignacionproyectos', 'estudiantes.estudianteId', '=', 'asignacionproyectos.estudianteId')
            ->join('proyectos', 'asignacionproyectos.proyectoId', '=', 'proyectos.proyectoId')
            ->select(
                'estudiantes.apellidos',
                'estudiantes.nombres',
                'estudiantes.cedula',
                'estudiantes.carrera',
                'asignacionproyectos.inicioFecha',
                'proyectos.nombreProyecto',
            )
            ->where('asignacionproyectos.proyectoId', $proyectoID)
            ->where('asignacionproyectos.idPeriodo', $periodo)
            ->where('estudiantes.estado', 'Aprobado')
            ->orderBy('estudiantes.apellidos', 'asc')
            ->get();

        if ($datosEstudiantes->isEmpty()) {
            return redirect()->route('director.repartoEstudiantes')->with('error', 'No hay estudiantes asignados al proyecto.');
        }

        // Obtener Carrera, Provincia y FechaInicio del primer estudiante asignado al proyecto
        $primerEstudiante = $datosEstudiantes->first();
        $carreraEstudiante = mb_strtoupper(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['A', 'E', 'I', 'O', 'U'], $primerEstudiante->carrera));
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
        $template->setValue('FechaInicio', $fechaFormateada);
        $template->setValue('NombreProyecto', $NombreProyecto);

        $nombreArchivo = '1.2-Acta-Designacion-Estudiantes.docx';
        $template->saveAs($nombreArchivo);
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

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);

        $template->setValue('empresa', $datosEstudiantes->first()->empresa->nombreEmpresa);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);

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

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('Nombre', $datosEstudiantes->first()->tutorAcademico->nombres . ' ' . $datosEstudiantes->first()->tutorAcademico->apellidos);
        $template->setValue('Cedula', $datosEstudiantes->first()->tutorAcademico->cedula);
        $template->setValue('Departamento', $datosEstudiantes->first()->tutorAcademico->departamento);
        $template->setValue('Correo', $datosEstudiantes->first()->tutorAcademico->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);

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

        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


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
        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);




        ///foreach para clonar las filas de actividades
        $template->cloneRow('departamento', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('departamento#' . $contador, $actividad->departamento);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('contador#' . $contador, $contador);
            $contador++;
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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'PlanificacionPPEstudiante.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function ControlAvanceActividades()
    {
        $plantillaPath = public_path('Plantillas/practicas/ControlAvanceActividades.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', $estudiante->carrera);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);




        ///foreach para clonar las filas de actividades
        $template->cloneRow('fechaActividad', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('fechaActividad#' . $contador, $actividad->fechaActividad);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('horas#' . $contador, $actividad->horas);
            $template->setValue('observaciones#' . $contador, $actividad->observaciones);
            $contador++;
        }


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'ControlAvanceActividades.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function EvTutorAcademico()
    {
        $plantillaPath = public_path('Plantillas/practicas/EvTutorAcademico.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', $estudiante->carrera);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'EvTutorAcademico.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function InformPractica(Request $request)
    {
        $plantillaPath = public_path('Plantillas/practicas/Informe.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaI::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();


        $actividadesPracticas = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $Evidencias = ActividadesPracticas::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();


        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', mb_strtoupper($estudiante->carrera, 'UTF-8'));
        $template->setValue('departamento', mb_strtoupper($estudiante->departamento, 'UTF-8'));

        ///foreach para clonar las filas de actividades
        $template->cloneRow('fechaActividad', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('fechaActividad#' . $contador, $actividad->fechaActividad);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('horas#' . $contador, $actividad->horas);

            $contador++;
        }

        ////insertar las evidencias en base64 de las actividade
        $contadorFiguras = 1;
        $template->cloneRow('actividad', count($Evidencias));
        foreach ($Evidencias as $index => $estudiante) {
            $nombreActividad = $estudiante->actividad;
            $nombreFigura = 'Figura ' . $contadorFiguras . ': ' . $nombreActividad;
            $template->setValue('actividad#' . ($index + 1), $nombreFigura);

            // Decodificar la imagen base64
            $base64Image = $estudiante->evidencia;
            $imageData = base64_decode($base64Image);

            // Generar una ruta temporal para la imagen
            $tempImagePath = tempnam(sys_get_temp_dir(), 'evidencia_');

            // Guardar la imagen decodificada en la ruta temporal
            file_put_contents($tempImagePath, $imageData);

            // Insertar la imagen en el documento
            $template->setImageValue('evidencia#' . ($index + 1), [
                'path' => $tempImagePath,
                'width' => 250,
                'height' => 250,
                'ratio' => false,
            ]);

            // Eliminar la imagen temporal después de usarla
            unlink($tempImagePath);

            $contadorFiguras++;
        }






        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);

        $template->setValue('introduccion', $request->introduccion);
        $template->setValue('conclusion', $request->conclusion);
        $template->setValue('recomendaciones', $request->recomendaciones);


        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'Informe.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    ///////////////////////////////////DOCUEMNTOS PRACTICAS2/////////////////////////////////////////

    public function EncuestaEstudiante2()
    {
        $plantillaPath = public_path('Plantillas/practicas/EncuestaEstudiantes.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }

        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);

        $template->setValue('empresa', $datosEstudiantes->first()->empresa->nombreEmpresa);

        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


        ///////descargar el documento generado
        $nombreArchivo = 'EncuestaEstudiantes.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    public function EncuestaDocentes2()
    {
        $plantillaPath = public_path('Plantillas/practicas/EncuestaDocentes.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('Nombre', $datosEstudiantes->first()->tutorAcademico->nombres . ' ' . $datosEstudiantes->first()->tutorAcademico->apellidos);
        $template->setValue('Cedula', $datosEstudiantes->first()->tutorAcademico->cedula);
        $template->setValue('Departamento', $datosEstudiantes->first()->tutorAcademico->departamento);
        $template->setValue('Correo', $datosEstudiantes->first()->tutorAcademico->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);
        $nombreArchivo = 'EncuestaDocentes.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }

    public function EvTutorEmpresarial2()
    {
        $plantillaPath = public_path('Plantillas/practicas/EvTutorEmpresarial.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;

        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


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


    public function PlanificacionPPEstudiante2()
    {
        $plantillaPath = public_path('Plantillas/practicas/PlanificacionPPEstudiante.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);




        ///foreach para clonar las filas de actividades
        $template->cloneRow('departamento', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('departamento#' . $contador, $actividad->departamento);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('contador#' . $contador, $contador);
            $contador++;
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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'PlanificacionPPEstudiante.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function ControlAvanceActividades2()
    {
        $plantillaPath = public_path('Plantillas/practicas/ControlAvanceActividades.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', $estudiante->carrera);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);




        ///foreach para clonar las filas de actividades
        $template->cloneRow('fechaActividad', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('fechaActividad#' . $contador, $actividad->fechaActividad);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('horas#' . $contador, $actividad->horas);
            $template->setValue('observaciones#' . $contador, $actividad->observaciones);
            $contador++;
        }


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'ControlAvanceActividades.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function EvTutorAcademico2()
    {
        $plantillaPath = public_path('Plantillas/practicas/EvTutorAcademico.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();

        $actividadesPracticas = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', $estudiante->carrera);
        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'EvTutorAcademico.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }

    public function InformPractica2(Request $request)
    {
        $plantillaPath = public_path('Plantillas/practicas/Informe.docx');
        if (!file_exists($plantillaPath)) {
            abort(404, 'El archivo de plantilla no existe.');
        }
        $template = new TemplateProcessor($plantillaPath);

        $estudiante = Auth::user()->estudiante;
        $datosEstudiantes = PracticaII::where('estudianteId', $estudiante->estudianteId)
            ->where('Estado', '!=', 'Reprobado')
            ->get();


        $actividadesPracticas = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();

        $Evidencias = ActividadesPracticasII::where('estudianteId', $estudiante->estudianteId)
            ->orderBy('fechaActividad', 'asc')
            ->get();


        $template->setValue('estudiante', $estudiante->nombres . ' ' . $estudiante->apellidos);
        $template->setValue('cedula', $estudiante->cedula);
        $template->setValue('espe_id', $estudiante->espeId);
        $template->setValue('celular', $estudiante->celular);
        $template->setValue('correo', $estudiante->correo);
        $template->setValue('carrera', mb_strtoupper($estudiante->carrera, 'UTF-8'));
        $template->setValue('departamento', mb_strtoupper($estudiante->departamento, 'UTF-8'));

        ///foreach para clonar las filas de actividades
        $template->cloneRow('fechaActividad', count($actividadesPracticas));

        $contador = 1;
        foreach ($actividadesPracticas as $index => $actividad) {
            $template->setValue('fechaActividad#' . $contador, $actividad->fechaActividad);
            $template->setValue('actividad#' . $contador, $actividad->actividad);
            $template->setValue('horas#' . $contador, $actividad->horas);

            $contador++;
        }

        ////insertar las evidencias en base64 de las actividade
        $contadorFiguras = 1;
        $template->cloneRow('actividad', count($Evidencias));
        foreach ($Evidencias as $index => $estudiante) {
            $nombreActividad = $estudiante->actividad;
            $nombreFigura = 'Figura ' . $contadorFiguras . ': ' . $nombreActividad;
            $template->setValue('actividad#' . ($index + 1), $nombreFigura);

            // Decodificar la imagen base64
            $base64Image = $estudiante->evidencia;
            $imageData = base64_decode($base64Image);

            // Generar una ruta temporal para la imagen
            $tempImagePath = tempnam(sys_get_temp_dir(), 'evidencia_');

            // Guardar la imagen decodificada en la ruta temporal
            file_put_contents($tempImagePath, $imageData);

            // Insertar la imagen en el documento
            $template->setImageValue('evidencia#' . ($index + 1), [
                'path' => $tempImagePath,
                'width' => 250,
                'height' => 250,
                'ratio' => false,
            ]);

            // Eliminar la imagen temporal después de usarla
            unlink($tempImagePath);

            $contadorFiguras++;
        }






        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);

        $template->setValue('introduccion', $request->introduccion);
        $template->setValue('conclusion', $request->conclusion);
        $template->setValue('recomendaciones', $request->recomendaciones);


        $estudianteNrc = $datosEstudiantes->first()->nrc;
        $periodo = Periodo::find($estudianteNrc);
        $numeroPeriodo = $periodo ? $periodo->numeroPeriodo : null;

        $estudiante = $numeroPeriodo;
        $template->setValue('periodo', $estudiante);


        $template->setValue('HorasPlanificadas', $datosEstudiantes->first()->HorasPlanificadas);


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

        $template->setValue('AreaConocimiento', $datosEstudiantes->first()->AreaConocimiento);

        $nombreArchivo = 'Informe.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }





















    //////////////////////////////////////////FIN DOCUMENTOS PRACTICAS2/////////////////////////////////////////










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
        $template->setValue('nombreProyecto', $proyecto->proyecto->nombreProyecto);

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

        $template->setValue('participante', $profesor->apellidos . ' ' . $profesor->nombres);
        $template->setValue('Correo', $profesor->correo);
        $template->setValue('Celular', '0912345678');

        $proyectoID = Proyecto::find($proyecto->proyectoId);
        $director = ProfesUniversidad::find($proyectoID->directorId);
        $template->setValue('director', $director->apellidos . ' ' . $director->nombres);
        $template->setValue('correoDirector', $director->correo);
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
            $template->setValue('estudiantes#' . $numFila, $estudiante->apellidos . ' ' . $estudiante->nombres);
            $template->setValue('entidad#' . $numFila, 'Universidad de las Fuerzas Armadas ESPE Sede Santo Domingo');
            $template->setValue('correoEstudiante#' . $numFila, $estudiante->correo);
            $template->setValue('celularEstudiante#' . $numFila, $estudiante->celular);
        }


        $nombreArchivo = 'Acta-de-Reunión.docx';
        $template->saveAs($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);


    }


    ///////////////baremo

    public function baremo(Request $request)
    {
        $plantillaPath = public_path('Plantillas/baremos.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $profesor = Auth::user()->profesorUniversidad;

        $proyecto = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->first();

        if (!$proyecto) {
            $fechaActual = Carbon::now()->format('Y-m-d');
            $proyecto = AsignacionSinEstudiante::where('participanteId', $profesor->id)
                ->where('inicioFecha', '<=', $fechaActual)
                ->where('finalizacionFecha', '>=', $fechaActual)
                ->with(['proyecto'])
                ->first();

        }

        if (!$proyecto) {
            return redirect()->back()->with('error', 'No tienes un proyecto asignado.');
        }

        $sheet = $spreadsheet->getActiveSheet();

        // Obtener y asignar valores a celdas específicas
        $sheet->setCellValue('B7', $proyecto->proyecto->nombreProyecto);
        $director = ProfesUniversidad::find($proyecto->proyecto->directorId);
        $nombreDirector = $director->apellidos . ' ' . $director->nombres;
        $sheet->setCellValue('B8', $nombreDirector);
        $sheet->setCellValue('B10', $proyecto->proyecto->departamentoTutor);
        $sheet->setCellValue('B11', $proyecto->inicioFecha);
        $sheet->setCellValue('B12', $proyecto->finalizacionFecha);
        $sheet->setCellValue('B13', $profesor->apellidos . ' ' . $profesor->nombres);
        $sheet->setCellValue('B14', $profesor->departamento);

        $tabla1 = $request->input('puntaje_proyecto1');
        $tabla2 = $request->input('puntaje_proyecto2');
        $tabla3 = $request->input('puntaje_proyecto3');
        $tabla4 = $request->input('puntaje_proyecto4');
        $texto1 = $request->input('comentarios_proyecto1');
        $texto2 = $request->input('comentarios_proyecto2');
        $texto3 = $request->input('comentarios_proyecto3');
        $texto4 = $request->input('comentarios_proyecto4');
        $sumasTablas = $tabla1 + $tabla2 + $tabla3 + $tabla4;

        $sheet->setCellValue('B22', $tabla1);
        $sheet->setCellValue('F22', $tabla2);
        $sheet->setCellValue('J22', $tabla3);
        $sheet->setCellValue('N22', $tabla4);
        $sheet->setCellValue('R22', $sumasTablas);
        $sheet->setCellValue('B15', $sumasTablas);
        $sheet->setCellValue('B23', $texto1);
        $sheet->setCellValue('F23', $texto2);
        $sheet->setCellValue('J23', $texto3);
        $sheet->setCellValue('N23', $texto4);

        $sheet->setCellValue('B26', $nombreDirector . "\n" . 'DIRECTOR DEL PROYECTO');
        $sheet->getStyle('B26')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B26')->getFont()->setSize(11);


        // Descargar el archivo
        $nombreArchivo = 'baremo.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }

    //////////////////////////////////////baremo director vincualion//////////////////////////////////
    public function baremoDirector(Request $request)
    {
        $plantillaPath = public_path('Plantillas/baremo-director.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $profesor = Auth::user()->profesorUniversidad;

        //////encontrar el proyecto del docente director en estado Ejecucion
        $proyecto = Proyecto::where('directorId', $profesor->id)
            ->where('estado', 'Ejecucion')
            ->first();

        if (!$proyecto) {
            return redirect()->back()->with('error', 'No tienes un proyecto asignado.');
        }

        $sheet = $spreadsheet->getActiveSheet();

        // Obtener y asignar valores a celdas específicas
        $sheet->setCellValue('B7', $proyecto->nombreProyecto);
        $director = ProfesUniversidad::find($proyecto->directorId);
        $nombreDirector = $director->apellidos . ' ' . $director->nombres;
        $sheet->setCellValue('B8', $nombreDirector);
        $sheet->setCellValue('B10', $proyecto->departamentoTutor);
        $sheet->setCellValue('B11', $proyecto->inicioFecha);
        $sheet->setCellValue('B12', $proyecto->finFecha);

        $tabla1 = $request->input('puntaje_proyecto1');
        $tabla2 = $request->input('puntaje_proyecto2');
        $tabla3 = $request->input('puntaje_proyecto3');
        $tabla4 = $request->input('puntaje_proyecto4');
        $tabla5 = $request->input('puntaje_proyecto5');
        $tabla6 = $request->input('puntaje_proyecto6');
        $tabla7 = $request->input('puntaje_proyecto7');



        $texto1 = $request->input('comentarios_proyecto1');
        $texto2 = $request->input('comentarios_proyecto2');
        $texto3 = $request->input('comentarios_proyecto3');
        $texto4 = $request->input('comentarios_proyecto4');
        $texto5 = $request->input('comentarios_proyecto5');
        $texto6 = $request->input('comentarios_proyecto6');
        $texto7 = $request->input('comentarios_proyecto7');
        $sumasTablas = $tabla1 + $tabla2 + $tabla3 + $tabla4 + $tabla5 + $tabla6 + $tabla7;

        $sheet->setCellValue('B19', $tabla1);
        $sheet->setCellValue('F19', $tabla2);
        $sheet->setCellValue('J19', $tabla3);
        $sheet->setCellValue('N19', $tabla4);
        $sheet->setCellValue('R19', $tabla5);
        $sheet->setCellValue('V19', $tabla6);
        $sheet->setCellValue('Z19', $tabla7);


        $sheet->setCellValue('AD19', $sumasTablas);
        $sheet->setCellValue('B13', $sumasTablas);

        $sheet->setCellValue('B20', $texto1);
        $sheet->setCellValue('F20', $texto2);
        $sheet->setCellValue('J20', $texto3);
        $sheet->setCellValue('N20', $texto4);
        $sheet->setCellValue('R20', $texto5);
        $sheet->setCellValue('V20', $texto6);
        $sheet->setCellValue('Z20', $texto7);

        $sheet->setCellValue('B26', $nombreDirector . "\n" . 'DIRECTOR DEL PROYECTO');
        $sheet->getStyle('B26')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B26')->getFont()->setSize(11);


        // Descargar el archivo
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
        if ($estudiante->estado === 'En proceso de revision') {
            // Redirigir o mostrar un mensaje de error, según tus necesidades
            return redirect()->back()->with('error', 'No tienes acceso a esta página en este momento.');
        }


        // Obtener las actividades registradas si el estado permite el acceso
        $actividadesRegistradas = ActividadEstudiante::where('estudianteId', $estudiante->estudianteId)->get();

        return view('estudiantes.documentos', ['actividadesRegistradas' => $actividadesRegistradas]);
    }


}
