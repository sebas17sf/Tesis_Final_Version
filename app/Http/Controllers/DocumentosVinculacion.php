<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use Illuminate\Http\Request;
use App\Models\Departamento;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\AsignacionProyecto;
use App\Models\NrcVinculacion;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


use Illuminate\Support\Facades\Http;
use App\Models\Proyecto;
use App\Models\NotasEstudiante;
use App\Models\Empresa;
use App\Models\Periodo;
use App\Models\ActaReunion;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use Illuminate\Support\Facades\DB;


use App\Models\PracticaIV;
use App\Models\PracticaV;
use Illuminate\Support\Facades\Auth;
use App\Models\HoraVinculacion;
use Carbon\Carbon;



use DateTime;
use App\Models\Estudiante;

class DocumentosVinculacion extends Controller
{
    public function documentos()
    {
        $profesor = Auth::user()->profesorUniversidad;

        $proyectos = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->get();

        $proyectosAsignados = $proyectos
            ->unique('proyectoId')
            ->values();

        $inicioFecha = $proyectos->first()->inicioFecha ?? null;
        $finalizacionFecha = $proyectos->first()->finalizacionFecha ?? null;

        $actas = ActaReunion::whereIn('proyectoId', $proyectosAsignados->pluck('proyectoId'))
            ->whereHas('proyecto.estudiantes', function ($query) {
                $query->where('estudiantes.estado', 'Aprobado'); // Especifica la tabla aquí también
            })
            ->get();

        return view('ParticipanteVinculacion.documentos', compact('proyectos', 'inicioFecha', 'finalizacionFecha', 'proyectosAsignados', 'actas'));
    }



    public function generarEvaluacionEstudiante()
    {
        $plantillaPath = public_path('Plantillas/1.4-Evaluación-Estudiantes.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);
        $usuario = auth()->user();
        $correoUsuario = $usuario->correoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('correo', $correoUsuario)->first();
        $asignacionProyecto = AsignacionProyecto::where('participanteId', $participanteVinculacion->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->first();

        if ($asignacionProyecto == null) {
            return redirect()->back()->with('error', 'No tiene proyectos asignados');
        }

        ///obtener la id del director de AsiignacionProyecto
        $proyecto = Proyecto::where('proyectoId', $asignacionProyecto->proyectoId)->first();
        if ($proyecto->estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }

        ////buscar en profesores universidad
        $Director = ProfesUniversidad::where('id', $proyecto->directorId)->first();
        // Obtener los estudiantes asignados a este proyecto
        $estudiantes = AsignacionProyecto::where('proyectoId', $proyecto->proyectoId)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->get();

        if ($estudiantes->isEmpty()) {
            return redirect()->back()->with('error', 'No hay estudiantes asignados a este proyecto.');
        }

        $hojaCalculo = $spreadsheet->getActiveSheet();
        $filaInicio = 4;
        $cantidadFilas = count($estudiantes);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $estudiantes = $estudiantes->sortBy('Estudiante.Apellidos');
        ///Obtener el nombre del participante
        $nombreParticipante = "Ing. " . $participanteVinculacion->apellidos . ' ' . $participanteVinculacion->nombres . ", Mgtr.";
        $nombreDirector = "Ing. " . $Director->apellidos . ' ' . $Director->nombres . ", Mgtr.";
        ///Obtener el departamento del participante
        $departamento = "Departamento de " . $participanteVinculacion->departamento->departamento;
        $departamentoDirector = "Departamento de " . $proyecto->departamento->departamento;

        ///combinar celdas y ajustar el texto
        $hojaCalculo->mergeCells('B12:D12');
        $hojaCalculo->mergeCells('I12:M12'); // Ajuste: combinar celdas para el director del proyecto
        $hojaCalculo->mergeCells('B11:D11');
        $hojaCalculo->mergeCells('B13:D13');
        $hojaCalculo->mergeCells('B14:D14');
        $hojaCalculo->mergeCells('I14:K14');
        $hojaCalculo->mergeCells('I13:K13');

        ///en B14 "DOCENTE PARTICIPANTE"
        $hojaCalculo->setCellValue('B14', 'DOCENTE PARTICIPANTE');
        $hojaCalculo->getStyle("B14")->getFont()->setSize(14);
        $hojaCalculo->getStyle("B14")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("B14")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B14")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        ///en I14 "DIRECTOR DE PROYECTO"
        $hojaCalculo->setCellValue('I14', 'DIRECTOR DE PROYECTO');
        $hojaCalculo->getStyle("I14")->getFont()->setSize(14);
        $hojaCalculo->getStyle("I14")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("I14")->getFont()->setBold(true);
        $hojaCalculo->getStyle("I14")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        ///llenar las celdas
        $hojaCalculo->setCellValue("B12", $nombreParticipante);
        $hojaCalculo->getStyle("B12")->getFont()->setSize(14);
        $hojaCalculo->getStyle("B12")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("B12")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B12")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle('B12')->getAlignment()->setWrapText(true); // Activar ajuste de texto
        $hojaCalculo->getStyle('B12')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        $hojaCalculo->setCellValue("I12", $nombreDirector);
        $hojaCalculo->getStyle("I12")->getFont()->setSize(14);
        $hojaCalculo->getStyle("I12")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("I12")->getFont()->setBold(true);
        $hojaCalculo->getStyle("I12")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle('I12')->getAlignment()->setWrapText(true); // Activar ajuste de texto

        $hojaCalculo->setCellValue("B13", $departamento);
        $hojaCalculo->getStyle("B13")->getFont()->setSize(14);
        $hojaCalculo->getStyle("B13")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("B13")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B13")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle('B13')->getAlignment()->setWrapText(true);
        $hojaCalculo->getStyle('B13')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        $hojaCalculo->setCellValue("I13", $departamentoDirector);
        $hojaCalculo->getStyle("I13")->getFont()->setSize(14);
        $hojaCalculo->getStyle("I13")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("I13")->getFont()->setBold(true);
        $hojaCalculo->getStyle("I13")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle("I13")->getAlignment()->setWrapText(true);
        $hojaCalculo->getStyle("I13")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        foreach ($estudiantes as $index => $estudiante) {
            $notas = NotasEstudiante::where('estudianteId', $estudiante->estudianteId)->first();
            if ($notas == null) {
                return redirect()->back()->with('error', 'No se han ingresado notas para los estudiantes');
            }
        }

        ///crea el foreach para recorrer los estudiantes y obtener Nombres,Apellidos y cedula
        foreach ($estudiantes as $index => $estudiante) {
            $filaActual = $filaInicio + $index;
            $nombreCompleto = $estudiante->Estudiante->apellidos . ' ' . $estudiante->Estudiante->nombres;
            $hojaCalculo->setCellValue("A$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("B$filaActual", $estudiante->Estudiante->cedula);
            $hojaCalculo->setCellValue("C$filaActual", $estudiante->Estudiante->carrera);

            $notas = NotasEstudiante::where('estudianteId', $estudiante->Estudiante->estudianteId)->first();

            $hojaCalculo->setCellValue("D$filaActual", $notas->tareas);
            $hojaCalculo->setCellValue("E$filaActual", $notas->resultadosAlcanzados);
            $hojaCalculo->setCellValue("F$filaActual", $notas->conocimientos);
            $hojaCalculo->setCellValue("G$filaActual", $notas->adaptabilidad);
            $hojaCalculo->setCellValue("H$filaActual", $notas->aplicacion);
            $hojaCalculo->setCellValue("I$filaActual", $notas->CapacidadLiderazgo);
            $hojaCalculo->setCellValue("J$filaActual", $notas->asistencia);
            $hojaCalculo->setCellValue("K$filaActual", $notas->informe);
            $hojaCalculo->setCellValue("L$filaActual", "=SUM(D$filaActual:K$filaActual)");
            $hojaCalculo->setCellValue("M$filaActual", "=L$filaActual*20/100");
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $nombreArchivo = '1.4-Evaluación-Estudiantes.xlsx';
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }





    public function generarHorasDocente(Request $request)
     {
 
        $plantillaPath = public_path('Plantillas/1.3-Número-Horas-Docentes.xlsx');
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

        $proyecto = Proyecto::where('proyectoId', $asignacionProyecto->proyectoId)->first();

        if ($proyecto->estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }
        // Obtener los estudiantes asignados a este proyecto
        $Director = ProfesUniversidad::where('id', $proyecto->directorId)->first();


        $hojaCalculo = $spreadsheet->getActiveSheet();


        ///Obtener el nombre del participante
        $nombreParticipante = "Ing. " . $participanteVinculacion->apellidos . ' ' . $participanteVinculacion->nombres . ", Mgtr.";
        $nombreDirector = $Director->apellidos . ' ' . $Director->nombres;
        ///Obtener el departamento del participante
        $departamento = $participanteVinculacion->departamento;
        $departamentoDirector = $proyecto->departamentoTutor;

        //Obtener datos del director y particpante
        $nombreParticipanteCompleto = $participanteVinculacion->apellidos . ' ' . $participanteVinculacion->nombres;
        $cedulaParticipante = $participanteVinculacion->cedula;
        $cedulaDirector = $Director->cedula;
        $correoParticipante = $participanteVinculacion->correo;
        $correoDirector = $Director->correo;
        $sede = 'Santo Domingo';
        $departamentosParticipante = $participanteVinculacion->departamento->departamento;
        $departamentosDirector = $proyecto->departamento->departamento;
        $fechaInicio = $asignacionProyecto->inicioFecha;
        $fechaFin = $asignacionProyecto->finalizacionFecha;
        $NumeroHoras = $request->input('horas_entre_fechas');
        $nombreProyecto = $proyecto->nombreProyecto;
        $fechaFormateada = date('d F Y', strtotime($fechaFin));
        setlocale(LC_TIME, 'es_ES');
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



        ///combinar celdas

        $hojaCalculo->mergeCells('I13:K13');
        ///llenar las celdas

        /////nomnre del director
        $hojaCalculo->setCellValue("B16", $nombreDirector);
        $hojaCalculo->getStyle("B16")->getFont()->setSize(14);
        $hojaCalculo->getStyle("B16")->getFont()->setBold(true);


        $hojaCalculo->setCellValue("C7", $nombreParticipanteCompleto);
        $hojaCalculo->setCellValue("D7", $cedulaParticipante);

        $hojaCalculo->setCellValue("E7", $correoParticipante);
        $hojaCalculo->setCellValue("F7", $sede);
        $hojaCalculo->setCellValue("G7", $departamentosParticipante);

        /////departamento directo
        $hojaCalculo->setCellValue("C3", $departamentosDirector);

        $hojaCalculo->setCellValue("H7", $fechaInicio);
        $hojaCalculo->setCellValue("I7", $fechaFin);

        $hojaCalculo->setCellValue("J7", $NumeroHoras);


        $hojaCalculo->setCellValue("B7", $nombreProyecto);
        $hojaCalculo->getStyle("B7")->getAlignment()->setWrapText(true);
        $hojaCalculo->getRowDimension(7)->setRowHeight(-1);



        $hojaCalculo->setCellValue("B12", "Fecha: $fechaFormateada");

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "1.3-Número-Horas-Docentes.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }






    ///////////////GENERAR ASISTENCIA DE LOS ESTUDIANTES///////////////////////////////

    public function generarAsistencia(Request $request)
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



    //////////////////////////////////////////////////////MATRIZ VINCULACION/////////////////////////////////////////////////////////////////////////////////


    public function MatrizVinculacion(Request $request)
    {
        mb_internal_encoding('UTF-8');

        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $profesor = $request->input('profesor');
        $periodo = $request->input('periodos');

        $plantillaPath = public_path('Plantillas/Reporte-MatrizVinculacion.xlsx');

        try {
            $spreadsheet = IOFactory::load($plantillaPath);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo cargar la plantilla');
        }

        $hojaCalculo = $spreadsheet->getActiveSheet();

        // Consulta de asignaciones con o sin filtro de fechas
        $query = AsignacionProyecto::query();

        if ($fechaInicio && $fechaFin) {
            $query->whereHas('periodo', function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('inicioPeriodo', '<=', $fechaFin)
                    ->where('finPeriodo', '>=', $fechaInicio);
            });
        }

        if ($profesor) {
            $query->where('participanteId', $profesor);
        }

        if ($periodo) {
            $query->where('idPeriodo', $periodo);
        }

        $asignacionProyecto = $query->with(['estudiante.notas', 'estudiante.horas_vinculacion', 'proyecto.director', 'docenteParticipante', 'periodo', 'nrcVinculacion'])->get();

        if ($asignacionProyecto->isEmpty()) {
            return redirect()->back()->with('error', 'No hay proyectos asignados' . ($fechaInicio && $fechaFin ? ' en el rango de fechas seleccionado' : ''));
        }

        // Obtener todos los datos de la API
        $response = Http::get('http://10.3.1.105:3000/api/v1/academic/information');

        if ($response->successful()) {
            $dataFromApi = collect($response->json('data.academic')); // Acceder directamente al array "academic"

            // Para depurar, imprimimos los primeros registros de la API
            \Log::info('Datos de la API:', $dataFromApi->take(5)->toArray());

        } else {
            return redirect()->back()->with('error', 'No se pudo obtener información de la API');
        }

        // Agrupar las asignaciones por estudiante y ordenarlas por nombre completo
        $asignacionesPorEstudiante = $asignacionProyecto->groupBy('estudianteId')->sortBy(function ($asignaciones) {
            $estudiante = $asignaciones->first()->estudiante;
            return mb_strtoupper(($estudiante->apellidos ?? '') . ' ' . ($estudiante->nombres ?? ''));
        });

        $filaInicio = 9;
        $contador = 1;

        foreach ($asignacionesPorEstudiante as $asignaciones) {
            $estudiante = $asignaciones->first()->estudiante;

            // Depurar espeId
            \Log::info('Buscando espeId:', ['espeId' => $estudiante->espeId]);

            // Buscar el estado del estudiante en los datos de la API
            $estadoEstudiante = $dataFromApi->firstWhere('ID', $estudiante->espeId);

            if ($estadoEstudiante) {
                $estadoEstudiante = $estadoEstudiante['ESTADO_ESTUDIANTE'] ?? 'No Disponible';
            } else {
                $estadoEstudiante = 'No Disponible';
            }

            // Depurar resultado
            \Log::info('Resultado para espeId:', ['espeId' => $estudiante->espeId, 'estadoEstudiante' => $estadoEstudiante]);

            $notas = $estudiante->notas->take(2); // Tomar hasta 2 notas
            $horas = $estudiante->horas_vinculacion->take(2); // Tomar hasta 2 horas de vinculación

            foreach ($asignaciones as $index => $asignacion) {
                $filaActual = $filaInicio;
                $proyecto = $asignacion->proyecto;
                $participante = $asignacion->docenteParticipante;
                $director = $proyecto->director;
                $periodo = $asignacion->periodo;
                $nrc = $asignacion->nrcVinculacion;

                if ($index == 0) {
                    $hojaCalculo->setCellValue("A$filaActual", $contador++);
                    $hojaCalculo->setCellValue("B$filaActual", mb_strtoupper(($estudiante->apellidos ?? '') . ' ' . ($estudiante->nombres ?? '')));
                    $hojaCalculo->setCellValue("C$filaActual", mb_strtoupper($estudiante->espeId ?? ''));
                    $hojaCalculo->setCellValue("D$filaActual", mb_strtoupper($estudiante->cedula ?? ''));
                    $hojaCalculo->setCellValue("E$filaActual", $estudiante->correo ?? '');
                    $hojaCalculo->setCellValue("F$filaActual", mb_strtoupper($estudiante->Cohorte ?? ''));
                    $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($periodo->numeroPeriodo));
                    $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($nrc->nrc ?? 'NO REQUIERE NRC'));
                    $hojaCalculo->setCellValue("I$filaActual", mb_strtoupper($estudiante->departamento->departamento ?? ''));
                    $hojaCalculo->setCellValue("J$filaActual", mb_strtoupper($estudiante->carrera ?? ''));
                    $hojaCalculo->setCellValue("K$filaActual", isset($horas[0]) ? mb_strtoupper($horas[0]->horasVinculacion) : '');
                    $hojaCalculo->setCellValue("L$filaActual", isset($notas[0]) ? mb_strtoupper($notas[0]->notaFinal) : '');
                    $hojaCalculo->setCellValue("M$filaActual", mb_strtoupper($proyecto->nombreProyecto));
                    $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamento->departamento));
                    $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto));
                    $hojaCalculo->setCellValue("P$filaActual", mb_strtoupper($director->apellidos . ' ' . $director->nombres));
                    $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento->departamento));
                    $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres));
                    $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento->departamento));
                    $hojaCalculo->setCellValue("T$filaActual", mb_strtoupper($asignacion->inicioFecha));
                    $hojaCalculo->setCellValue("U$filaActual", mb_strtoupper($asignacion->finalizacionFecha));
                    $hojaCalculo->setCellValue("AH$filaActual", mb_strtoupper($asignacion->estado));
                    $hojaCalculo->setCellValue("AI$filaActual", mb_strtoupper($estadoEstudiante)); // Añadir el estado del estudiante

                    // Copiar el estilo de la fila 9
                    $hojaCalculo->duplicateStyle($hojaCalculo->getStyle('A9:AI9'), 'A' . $filaActual . ':AI' . $filaActual);

                    $filaInicio++;
                } else {
                    $columnaActual = 'W';
                    $hojaCalculo->setCellValue('V' . ($filaActual - 1), mb_strtoupper($periodo->numeroPeriodo ?? ''));
                    $hojaCalculo->setCellValue($columnaActual . ($filaActual - 1), mb_strtoupper($proyecto->nombreProyecto));
                    $hojaCalculo->setCellValue('X' . ($filaActual - 1), mb_strtoupper($proyecto->departamento->departamento));
                    $hojaCalculo->setCellValue('Y' . ($filaActual - 1), mb_strtoupper($director->apellidos . ' ' . $director->nombres));
                    $hojaCalculo->setCellValue('Z' . ($filaActual - 1), mb_strtoupper($director->departamento->departamento));
                    $hojaCalculo->setCellValue('AA' . ($filaActual - 1), mb_strtoupper($participante->apellidos . ' ' . $participante->nombres));
                    $hojaCalculo->setCellValue('AB' . ($filaActual - 1), mb_strtoupper($participante->departamento->departamento));
                    $hojaCalculo->setCellValue('AC' . ($filaActual - 1), mb_strtoupper($proyecto->inicioFecha));
                    $hojaCalculo->setCellValue('AD' . ($filaActual - 1), mb_strtoupper($proyecto->finFecha));
                    $hojaCalculo->setCellValue('AE' . ($filaActual - 1), isset($horas[1]) ? mb_strtoupper($horas[1]->horasVinculacion) : '');
                    $hojaCalculo->setCellValue('AF' . ($filaActual - 1), isset($notas[1]) ? mb_strtoupper($notas[1]->notaFinal) : '');
                    $hojaCalculo->setCellValue('AH' . ($filaActual - 1), mb_strtoupper($asignacion->estado));
                }

                $hojaCalculo->setCellValue("AG" . ($filaActual), "=SUM(K" . ($filaActual) . ",AE" . ($filaActual) . ")");
            }
        }

        $hojaCalculo->getStyle('A9:AI' . ($filaInicio - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_JUSTIFY)->setVertical(Alignment::VERTICAL_CENTER);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Reporte_asignación_proyectos_sociales.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }


    //////////////////////////////////////reporte de docentes participantes/////////////////////////////////////////////////////////////////
    public function historicoParticipante(Request $request)
    {
        $plantillaPath = public_path('Plantillas/HistoricoDocentes.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $hojaCalculo = $spreadsheet->getActiveSheet();

        if ($hojaCalculo == null) {
            return redirect()->back()->with('error', 'No se pudo cargar la plantilla');
        }

        $usuario = auth()->user();
        $correoUsuario = $usuario->correoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('correo', $correoUsuario)->first();
        $asignacionProyecto = AsignacionProyecto::where('participanteId', $participanteVinculacion->id);

        if ($request->has('profesorParticipante') && !empty($request->get('profesorParticipante'))) {
            $asignacionProyecto->whereHas('proyecto.director', function ($query) use ($request) {
                $query->where('apellidos', $request->get('profesorParticipante'));
            });
        }

        if ($request->has('periodoParticipante') && !empty($request->get('periodoParticipante'))) {
            $asignacionProyecto->whereHas('periodo', function ($query) use ($request) {
                $query->where('numeroPeriodo', $request->get('periodoParticipante'));
            });
        }

        $asignacionProyecto = $asignacionProyecto->get();



        if ($asignacionProyecto->isEmpty()) {
            return redirect()->back()->with('error', 'No hay proyectos asignados');
        }

        $filaInicio = 9;
        $cantidadFilas = count($asignacionProyecto);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $asignacionProyecto = $asignacionProyecto->sortBy('proyectoId');

        foreach ($asignacionProyecto as $index => $asignacion) {
            $filaActual = $filaInicio + $index;
            $proyecto = Proyecto::where('proyectoId', $asignacion->proyectoId)->first();
            $participante = ProfesUniversidad::where('id', $asignacion->participanteId)->first();
            $director = ProfesUniversidad::where('id', $proyecto->directorId)->first();
            $periodo = Periodo::where('id', $asignacion->idPeriodo)->first();
            $nrc = NrcVinculacion::where('id', $asignacion->nrc)->first();

            $hojaCalculo->setCellValue("A$filaActual", $index + 1);
            $hojaCalculo->setCellValue("M$filaActual", mb_strtoupper($proyecto->nombreProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("P$filaActual", mb_strtoupper($director->apellidos . ' ' . $director->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento->departamento, 'UTF-8'));

            $hojaCalculo->setCellValue("T$filaActual", $asignacion->inicioFecha);
            $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("U$filaActual", $asignacion->finalizacionFecha);
            $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamento->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("I$filaActual", $periodo->numeroPeriodo);

            $nombreCompleto = mb_strtoupper(($asignacion->estudiante->apellidos ?? '') . ' ' . ($asignacion->estudiante->nombres ?? ''), 'UTF-8');
            $hojaCalculo->setCellValue("C$filaActual", $asignacion->estudiante->espeId ?? '');
            $hojaCalculo->setCellValue("D$filaActual", $asignacion->estudiante->cedula ?? '');
            $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($asignacion->estudiante->carrera, 'UTF-8' ?? ''));
            $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($asignacion->estudiante->departamento->departamento, 'UTF-8' ?? ''));


            $hojaCalculo->setCellValue("J$filaActual", $nrc->nrc ?? 'NO REQUIRE NRC');


            $hojaCalculo->setCellValue("B$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("E$filaActual", $asignacion->estudiante->correo ?? '');
            $hojaCalculo->setCellValue("F$filaActual", $asignacion->estudiante->Cohorte ?? '');

            /////departamento del participante


            // Corrección: Eliminar el uso de first() en una instancia de modelo
            $notaFinal = $asignacion->estudiante->notas->first()->notaFinal ?? '0';
            $hojaCalculo->setCellValue("L$filaActual", $notaFinal);

            ///HORAS REALIZADAS
            $horasRealizadas = $asignacion->estudiante->horas_vinculacion->first()->horasVinculacion ?? '0';
            $hojaCalculo->setCellValue("K$filaActual", $horasRealizadas);

            $hojaCalculo->setCellValue("V$filaActual", mb_strtoupper($asignacion->estado, 'UTF-8' ?? ''));


        }

        ////justificar y centrar
        $hojaCalculo->getStyle('A9:V' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_JUSTIFY)->setVertical(Alignment::VERTICAL_CENTER);

        $nombreParticipante = $participanteVinculacion->apellidos . '_' . $participanteVinculacion->nombres;
        $nombreParticipante = str_replace([' ', '/', '\\'], '_', $nombreParticipante);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Historial_Participante_$nombreParticipante.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }



    /////////////////////////////////////////HISTORIAL DE DIRECTORES DE PROYECTO///////////////////////////////////////////////
    public function historicoDirector(Request $request)
    {
        $plantillaPath = public_path('Plantillas/HistoricoDocentes.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $hojaCalculo = $spreadsheet->getActiveSheet();

        if ($hojaCalculo == null) {
            return redirect()->back()->with('error', 'No se pudo cargar la plantilla');
        }

        $usuario = auth()->user();
        $correoUsuario = $usuario->correoElectronico;
        $director = ProfesUniversidad::where('correo', $correoUsuario)->first();
        $proyecto = Proyecto::where('directorId', $director->id)->first();

        if ($proyecto == null) {
            return redirect()->back()->with('error', 'No tiene proyectos asignados como director');
        }


        $asignacionProyecto = AsignacionProyecto::where('proyectoId', $proyecto->proyectoId);

        if ($request->has('profesor') && !empty($request->get('profesor'))) {
            $asignacionProyecto->whereHas('docenteParticipante', function ($query) use ($request) {
                $query->where('apellidos', $request->get('profesor'));
            });
        }

        if ($request->has('periodo') && !empty($request->get('periodo'))) {
            $asignacionProyecto->whereHas('periodo', function ($query) use ($request) {
                $query->where('numeroPeriodo', $request->get('periodo'));
            });
        }

        $asignacionProyecto = $asignacionProyecto->get();

        if ($asignacionProyecto->isEmpty()) {
            return redirect()->back()->with('error', 'No hay proyectos asignados como director');
        }

        $filaInicio = 9;
        $cantidadFilas = count($asignacionProyecto);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $asignacionProyecto = $asignacionProyecto->sortBy('proyectoId');

        foreach ($asignacionProyecto as $index => $asignacion) {
            $filaActual = $filaInicio + $index;
            $proyecto = Proyecto::where('proyectoId', $asignacion->proyectoId)->first();
            $participante = ProfesUniversidad::where('id', $asignacion->participanteId)->first();
            $director = ProfesUniversidad::where('id', $proyecto->directorId)->first();
            $periodo = Periodo::where('id', $asignacion->idPeriodo)->first();
            $nrc = NrcVinculacion::where('id', $asignacion->nrc)->first();

            $hojaCalculo->setCellValue("A$filaActual", $index + 1);
            $hojaCalculo->setCellValue("M$filaActual", mb_strtoupper($proyecto->nombreProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("P$filaActual", mb_strtoupper($director->apellidos . ' ' . $director->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento->departamento, 'UTF-8'));

            $hojaCalculo->setCellValue("T$filaActual", $asignacion->inicioFecha);
            $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("U$filaActual", $asignacion->finalizacionFecha);
            $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamento->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("I$filaActual", $periodo->numeroPeriodo);

            $nombreCompleto = mb_strtoupper(($asignacion->estudiante->apellidos ?? '') . ' ' . ($asignacion->estudiante->nombres ?? ''), 'UTF-8');
            $hojaCalculo->setCellValue("C$filaActual", $asignacion->estudiante->espeId ?? '');
            $hojaCalculo->setCellValue("D$filaActual", $asignacion->estudiante->cedula ?? '');
            $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($asignacion->estudiante->carrera, 'UTF-8' ?? ''));
            $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($asignacion->estudiante->departamento->departamento, 'UTF-8' ?? ''));


            $hojaCalculo->setCellValue("J$filaActual", $nrc->nrc ?? 'NO REQUIRE NRC');


            $hojaCalculo->setCellValue("B$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("E$filaActual", $asignacion->estudiante->correo ?? '');
            $hojaCalculo->setCellValue("F$filaActual", $asignacion->estudiante->Cohorte ?? '');
            $hojaCalculo->setCellValue("V$filaActual", mb_strtoupper($asignacion->estado, 'UTF-8' ?? ''));

            /////departamento del participante


            // Corrección: Eliminar el uso de first() en una instancia de modelo
            $notaFinal = $asignacion->estudiante->notas->first()->notaFinal ?? '0';
            $hojaCalculo->setCellValue("L$filaActual", $notaFinal);

            ///HORAS REALIZADAS
            $horasRealizadas = $asignacion->estudiante->horas_vinculacion->first()->horasVinculacion ?? '0';
            $hojaCalculo->setCellValue("K$filaActual", $horasRealizadas);
        }

        ////justificar y centrar
        $hojaCalculo->getStyle('A9:V' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $nombreDirector = $director->apellidos . '_' . $director->nombres;
        $nombreDirector = str_replace([' ', '/', '\\'], '_', $nombreDirector);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Historial_Director_$nombreDirector.xlsx";

        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }























    ///////////////////////////////////prueba de carga de matriz para generar datos
    public function previewImport(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 1);

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {
                $estudiante = Estudiante::where('espeId', $row[0])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[6] . '%')->first();


                if ($estudiante) {
                    $newData = [
                        'correo' => $row[2],
                        'apellidos' => $row[3],
                        'cedula' => $row[1],
                        'nombres' => $row[4],
                        'Cohorte' => $row[5],
                        'idPeriodo' => Periodo::where('numeroPeriodo', $row[5])->first()->id ?? null,
                        'carrera' => $row[7],
                        'departamento' => $departamento ? $departamento->departamento : null,
                        'comentario' => 'Importado desde Excel',
                    ];

                    if ($estudiante->only(array_keys($newData)) != $newData) {
                        $updateCount++;
                    }
                } else {
                    $insertCount++;
                }
            }
        }


        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }





    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $dataRows = array_slice($worksheet->toArray(), 1);

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $rowIndex => $row) {
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {
                $periodo = Periodo::where('numeroPeriodo', $row[5])->first();
                $estudiante = Estudiante::where('espeId', $row[0])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[6] . '%')->first();

                $data = [
                    'espeId' => $row[0],
                    'correo' => $row[2],
                    'apellidos' => $row[3],
                    'cedula' => $row[1],
                    'nombres' => $row[4],
                    'Cohorte' => $row[5],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'carrera' => $row[7],
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'comentario' => 'Importado desde Excel',
                    'estado' => (isset($row[19]) && trim($row[19]) === 'Finalizado') ? 'Aprobado-practicas' : 'Aprobado',
                    'activacion' => $estudiante && $estudiante->usuario ? 1 : 0,
                ];

                if ($estudiante && $estudiante->usuario) {
                    $data['activacion'] = true;
                }

                if ($estudiante) {
                    $estudiante->update($data);
                    $updateCount++;
                } else {
                    $data['activacion'] = false;
                    Estudiante::create($data);
                    $insertCount++;
                }

                if ($estudiante) {
                    $estadoExcel = $row[19] ?? null;

                    \Log::info("Estado Excel para estudiante {$estudiante->estudianteId}: {$estadoExcel}");

                    if ($estadoExcel === 'Finalizado') {
                        \Log::info("Actualizando estado a Aprobado-practicas para estudiante {$estudiante->estudianteId}");
                        $estudiante->update(['estado' => 'Aprobado-practicas']);
                    } elseif ($estadoExcel === 'En ejecucion') {
                        \Log::info("Actualizando estado a Aprobado para estudiante {$estudiante->estudianteId}");
                        $estudiante->update(['estado' => 'Aprobado']);
                    }
                }
            }

            // Convert dates for project assignments using dynamic cell addresses
            $fechaInicio = $this->convertExcelDate($worksheet, $rowIndex + 2, 'M'); // Convert date from column "M" (13th column, 1-based index)
            $fechaFinalizacion = $this->convertExcelDate($worksheet, $rowIndex + 2, 'N'); // Convert date from column "N" (14th column, 1-based index)

            // Procesar la primera asignación de proyecto
            if (!empty($row[7]) && !empty($row[8]) && !empty($row[6]) && !empty($row[9]) && !empty($row[10]) && !empty($row[11]) && !empty($row[15])) {
                $estudiante = Estudiante::where('espeId', $row[0])->first();

                $projectName = trim($row[18]);
                $proyecto = Proyecto::where('nombreProyecto', 'like', '%' . $projectName . '%')->first();

                $periodo = Periodo::where('numeroPeriodo', $row[8])->first();

                $nombreCompleto = $row[11];
                $partesNombre = explode(" ", $nombreCompleto);
                if (count($partesNombre) >= 2) {
                    $apellido = trim($partesNombre[0]);
                    $nombre = trim($partesNombre[1]);

                    $participante = ProfesUniversidad::where('nombres', 'like', '%' . $apellido . '%')
                        ->where('apellidos', 'like', '%' . $nombre . '%')
                        ->first();
                }

                $fechaInicio = $this->convertExcelDate($worksheet, $rowIndex + 2, 'M'); // Convert date from column "M"
                $fechaFinalizacion = $this->convertExcelDate($worksheet, $rowIndex + 2, 'N'); // Convert date from column "N"

                $nrc = NrcVinculacion::where('nrc', $row[9])->first();

                $data = [
                    'estudianteId' => $estudiante ? $estudiante->estudianteId : null,
                    'proyectoId' => $proyecto ? $proyecto->proyectoId : null,
                    'participanteId' => $participante ? $participante->id : null,
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'nrc' => $nrc ? $nrc->id : null,
                    'inicioFecha' => $fechaInicio,
                    'finalizacionFecha' => $fechaFinalizacion,
                    'asignacionFecha' => now(),
                    'estado' => $row[19],
                ];

                $existingAssignment = AsignacionProyecto::where([
                    ['estudianteId', $data['estudianteId']],
                    ['proyectoId', $data['proyectoId']],
                    ['participanteId', $data['participanteId']],
                    ['idPeriodo', $data['idPeriodo']],
                    ['nrc', $data['nrc']],
                ])->first();

                if ($existingAssignment) {
                    if ($existingAssignment->only(array_keys($data)) != $data) {
                        $existingAssignment->update($data);
                        $updateCount++;
                    }
                } else {
                    AsignacionProyecto::create($data);
                    $insertCount++;
                }
            }

            // Procesar la segunda asignación de proyecto
            if (!empty($row[20])) {
                $estudiante = Estudiante::where('espeId', $row[0])->first();

                $projectName = trim($row[22]);
                $proyecto = Proyecto::where('nombreProyecto', 'like', '%' . $projectName . '%')->first();
                $periodo = Periodo::where('numeroPeriodo', $row[20])->first();
                $nrc = NrcVinculacion::where('nrc', $row[21])->first();

                $nombreCompleto = $row[23];
                $partesNombre = explode(" ", $nombreCompleto);
                if (count($partesNombre) >= 2) {
                    $apellido = trim($partesNombre[0]);
                    $nombre = trim($partesNombre[1]);

                    $participante = ProfesUniversidad::where('nombres', 'like', '%' . $apellido . '%')
                        ->where('apellidos', 'like', '%' . $nombre . '%')
                        ->first();
                }

                $fechaInicio = $this->convertExcelDate($worksheet, $rowIndex + 2, 'Y'); // Convert date from column "Y"
                $fechaFinalizacion = $this->convertExcelDate($worksheet, $rowIndex + 2, 'Z'); // Convert date from column "Z"

                $data = [
                    'estudianteId' => $estudiante ? $estudiante->estudianteId : null,
                    'proyectoId' => $proyecto ? $proyecto->proyectoId : null,
                    'participanteId' => $participante ? $participante->id : null,
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'nrc' => $nrc ? $nrc->id : null,
                    'inicioFecha' => $fechaInicio,
                    'finalizacionFecha' => $fechaFinalizacion,
                    'asignacionFecha' => now(),
                    'estado' => $row[30],
                ];

                $existingAssignment = AsignacionProyecto::where([
                    ['estudianteId', $data['estudianteId']],
                    ['proyectoId', $data['proyectoId']],
                    ['participanteId', $data['participanteId']],
                    ['idPeriodo', $data['idPeriodo']],
                    ['nrc', $data['nrc']],
                ])->first();

                if ($existingAssignment) {
                    if ($existingAssignment->only(array_keys($data)) != $data) {
                        $existingAssignment->update($data);
                        $updateCount++;
                    }
                } else {
                    AsignacionProyecto::create($data);
                    $insertCount++;
                }
            }

            // Notas del estudiante
            $estudiante = Estudiante::where('espeId', $row[0])->first();

            if ($estudiante) {
                $notaEstudiante = NotasEstudiante::where('estudianteId', $estudiante->estudianteId)
                    ->where('notaFinal', $row[15] ?? '1')
                    ->first();

                if ($notaEstudiante) {
                    if ($notaEstudiante->notaFinal != ($row[15] ?? '1')) {
                        $notaEstudiante->update(['notaFinal' => $row[15] ?? null]);
                    }
                } else {
                    NotasEstudiante::create([
                        'estudianteId' => $estudiante->estudianteId,
                        'notaFinal' => $row[15] ?? null
                    ]);
                }

                if (!empty($row[27])) {
                    $notaEstudiante = NotasEstudiante::where('estudianteId', $estudiante->estudianteId)
                        ->where('notaFinal', $row[27] ?? '1')
                        ->first();

                    if ($notaEstudiante) {
                        if ($notaEstudiante->notaFinal != ($row[27] ?? '1')) {
                            $notaEstudiante->update(['notaFinal' => $row[27] ?? null]);
                        }
                    } else {
                        NotasEstudiante::create([
                            'estudianteId' => $estudiante->estudianteId,
                            'notaFinal' => $row[27] ?? null
                        ]);
                    }
                }
            }

            // Horas de vinculación del estudiante
            if ($estudiante) {
                $horaVinculacion = HoraVinculacion::where('estudianteId', $estudiante->estudianteId)
                    ->where('horasVinculacion', $row[14] ?? '1')
                    ->first();

                if ($horaVinculacion) {
                    if ($horaVinculacion->horasVinculacion != ($row[14] ?? '1')) {
                        $horaVinculacion->update(['horasVinculacion' => $row[14] ?? '1']);
                    }
                } else {
                    HoraVinculacion::create([
                        'estudianteId' => $estudiante->estudianteId,
                        'horasVinculacion' => $row[14] ?? '1'
                    ]);
                }

                if (!empty($row[26])) {
                    $horaVinculacion = HoraVinculacion::where('estudianteId', $estudiante->estudianteId)
                        ->where('horasVinculacion', $row[26] ?? '1')
                        ->first();

                    if ($horaVinculacion) {
                        if ($horaVinculacion->horasVinculacion != ($row[26] ?? '1')) {
                            $horaVinculacion->update(['horasVinculacion' => $row[26] ?? '1']);
                        }
                    } else {
                        HoraVinculacion::create([
                            'estudianteId' => $estudiante->estudianteId,
                            'horasVinculacion' => $row[26] ?? '1'
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', "Datos importados con éxito! Insertados: $insertCount, Actualizados: $updateCount");
    }

    /**
     * Helper function to convert Excel date to Y-m-d format.
     */
    private function convertExcelDate($worksheet, $row, $columnLetter)
    {
        $cellAddress = $columnLetter . $row;
        $cell = $worksheet->getCell($cellAddress);
        $value = $cell->getValue();

        if (Date::isDateTime($cell)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        } else {
            $date = DateTime::createFromFormat('d/m/Y', $value);
            return $date ? $date->format('Y-m-d') : null;
        }
    }










    //////////////////////////////////////////////AGREGAR EMPRESSAS POR EXCEL//////////////////////////////////////

    public function previewImportEmpresas(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 1);

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            $nombre = $row[1] ?? null;

            if ($nombre) {
                $empresa = Empresa::where('nombreEmpresa', $nombre)->first();

                if ($empresa) {
                    // Verificar si los datos son diferentes antes de actualizar
                    $newData = [
                        'rucEmpresa' => $row[2] ?? null,
                        'provincia' => $row[3] ?? null,
                        'ciudad' => $row[4] ?? null,
                        'direccion' => $row[5] ?? null,
                        'correo' => $row[6] ?? null,
                        'nombreContacto' => $row[7] ?? null,
                        'telefonoContacto' => $row[8] ?? null,
                        'actividadesMacro' => $row[9] ?? null,
                    ];

                    // Comparar los datos actuales con los nuevos
                    if ($empresa->only(array_keys($newData)) != $newData) {
                        $updateCount++;
                    }
                } else {
                    $insertCount++;
                }
            }
        }

        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }


    public function importaEmpresas(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 1);

        foreach ($dataRows as $row) {
            $nombre = $row[1] ?? null;

            if ($nombre) {
                $empresa = Empresa::where('nombreEmpresa', $nombre)->first();
                if ($empresa) {
                    $empresa->update([
                        'rucEmpresa' => $row[2] ?? null,
                        'provincia' => $row[3] ?? null,
                        'ciudad' => $row[4] ?? null,
                        'direccion' => $row[5] ?? null,
                        'correo' => $row[6] ?? null,
                        'nombreContacto' => $row[7] ?? null,
                        'telefonoContacto' => $row[8] ?? null,
                        'actividadesMacro' => $row[9] ?? null,
                    ]);
                }
            }
        }

        foreach ($dataRows as $row) {
            $nombre = $row[1] ?? null;

            if ($nombre) {
                $empresa = Empresa::where('nombreEmpresa', $nombre)->first();
                if (!$empresa) {
                    Empresa::create([
                        'nombreEmpresa' => $nombre,
                        'rucEmpresa' => $row[2] ?? null,
                        'provincia' => $row[3] ?? null,
                        'ciudad' => $row[4] ?? null,
                        'direccion' => $row[5] ?? null,
                        'correo' => $row[6] ?? null,
                        'nombreContacto' => $row[7] ?? null,
                        'telefonoContacto' => $row[8] ?? null,
                        'actividadesMacro' => $row[9] ?? null,
                    ]);
                }
            }
        }

        return back()->with('success', 'Datos importados con éxito!');
    }



    ///////////////////////////////IMPORTAR PRACTICAS 1////////////////////////////////////////////////////
    public function previewImportarPracticas1(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 2); // Saltar las filas del encabezado

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            // Trim all data and check if the row is completely empty
            $row = array_map('trim', $row);
            if (empty(array_filter($row))) {
                // Log and continue if the row is empty
                \Log::info('Fila omitida por estar completamente vacía', ['row' => $row]);
                continue;
            }

            // Buscar al estudiante utilizando espeId primero, luego por nombre si no se encuentra
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante && !empty($row[2]) && !empty($row[1])) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            if ($estudiante) {
                // Verificar si ya existe un registro de PracticaI para el estudiante
                $practica1 = PracticaI::where('estudianteId', $estudiante->estudianteId)->first();
                $nrc = NrcVinculacion::where('nrc', $row[6])->first();

                if ($practica1) {
                    // Formatear y analizar las fechas correctamente
                    $fechaInicioFormatted = $this->convertirFecha($row[12]);
                    $fechaFinalizacionFormatted = $this->convertirFecha($row[13]);

                    // Normalizar los nuevos datos para la comparación
                    $newData = [
                        'AreaConocimiento' => $row[11] ?: null,
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'HoraEntrada' => $row[14] ?: null,
                        'nrc' => $nrc ? $nrc->id : null,
                        'HoraSalida' => $row[15] ?: null,
                        'HorasPlanificadas' => $row[16] ?: null,
                        'tipoPractica' => $row[17] ?: null,
                        'nota_final' => $row[18] ?: null,
                        'periodoPractica' => $row[10] ?: null,
                    ];

                    // Normalizar los datos existentes para la comparación
                    $existingData = $practica1->only(array_keys($newData));

                    // Nueva normalización de datos para manejar números
                    $existingDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $existingData);

                    $newDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $newData);

                    // Comparar los datos normalizados
                    if ($existingDataNormalized !== $newDataNormalized) {
                        \Log::info('Diferencia detectada', [
                            'existing' => $existingDataNormalized,
                            'new' => $newDataNormalized,
                            'student_id' => $estudiante->estudianteId // Agrega detalles adicionales como el ID del estudiante para mejor seguimiento
                        ]);
                        $updateCount++;
                    }
                } else {
                    // No se encontró el registro, contar como inserción
                    $insertCount++;
                }
            } else {
                // Log para depuración de estudiantes no encontrados
                \Log::info('Estudiante no encontrado, se requiere nuevo registro', ['student' => $row]);
                $insertCount++;
            }
        }

        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }

    /**
     * Convierte una fecha en formato d/m/Y a Y-m-d, o devuelve null si la fecha no es válida.
     *
     * @param string|null $fecha
     * @return string|null
     */
    private function convertirFecha($fecha)
    {
        if (!empty($fecha)) {
            // Verificar si la fecha tiene el formato d/m/Y (con año de cuatro dígitos)
            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
                $dateTime = DateTime::createFromFormat('d/m/Y', $fecha);
            }
            // Verificar si la fecha tiene el formato d/m/y (con año de dos dígitos)
            elseif (preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $fecha)) {
                $dateTime = DateTime::createFromFormat('d/m/y', $fecha);
            } else {
                // Si la fecha no coincide con ninguno de los formatos esperados, loguea el problema
                \Log::warning('Formato de fecha no válido detectado.', ['fecha' => $fecha]);
                return null;
            }

            // Verificar si $dateTime se ha creado correctamente y devolver la fecha en formato Y-m-d
            if ($dateTime) {
                $year = $dateTime->format('Y');

                // Ajustar el año si se interpreta como un año del siglo 00 (ejemplo: 0020)
                if ($year < 1000) {
                    $year += 2000; // Ajustar el año sumando 2000 para convertir '0020' a '2020'
                    return $dateTime->setDate($year, $dateTime->format('m'), $dateTime->format('d'))->format('Y-m-d');
                }

                return $dateTime->format('Y-m-d');
            }

            return null;
        }

        return null;
    }



    public function previewImportarPracticas2(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 2); // Saltar las filas del encabezado

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            // Trim all data and check if the row is completely empty
            $row = array_map('trim', $row);
            if (empty(array_filter($row))) {
                // Log and continue if the row is empty
                \Log::info('Fila omitida por estar completamente vacía', ['row' => $row]);
                continue;
            }

            // Buscar al estudiante utilizando espeId primero, luego por nombre si no se encuentra
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante && !empty($row[2]) && !empty($row[1])) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            if ($estudiante) {
                // Verificar si ya existe un registro de PracticaI para el estudiante
                $practica1 = PracticaIII::where('estudianteId', $estudiante->estudianteId)->first();
                $nrc = NrcVinculacion::where('nrc', $row[6])->first();

                if ($practica1) {
                    // Formatear y analizar las fechas correctamente
                    $fechaInicioFormatted = $this->convertirFecha($row[12]);
                    $fechaFinalizacionFormatted = $this->convertirFecha($row[13]);

                    // Normalizar los nuevos datos para la comparación
                    $newData = [
                        'AreaConocimiento' => $row[11] ?: null,
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'HoraEntrada' => $row[14] ?: null,
                        'nrc' => $nrc ? $nrc->id : null,
                        'HoraSalida' => $row[15] ?: null,
                        'HorasPlanificadas' => $row[16] ?: null,
                        'tipoPractica' => $row[17] ?: null,
                        'nota_final' => $row[18] ?: null,
                        'periodoPractica' => $row[10] ?: null,
                    ];

                    // Normalizar los datos existentes para la comparación
                    $existingData = $practica1->only(array_keys($newData));

                    // Nueva normalización de datos para manejar números
                    $existingDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $existingData);

                    $newDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $newData);

                    // Comparar los datos normalizados
                    if ($existingDataNormalized !== $newDataNormalized) {
                        \Log::info('Diferencia detectada', [
                            'existing' => $existingDataNormalized,
                            'new' => $newDataNormalized,
                            'student_id' => $estudiante->estudianteId // Agrega detalles adicionales como el ID del estudiante para mejor seguimiento
                        ]);
                        $updateCount++;
                    }
                } else {
                    // No se encontró el registro, contar como inserción
                    $insertCount++;
                }
            } else {
                // Log para depuración de estudiantes no encontrados
                \Log::info('Estudiante no encontrado, se requiere nuevo registro', ['student' => $row]);
                $insertCount++;
            }
        }

        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }


    public function previewImportarPracticas3(Request $request)
    {
        // Cargar el archivo Excel
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Saltar las filas del encabezado
        $dataRows = array_slice($rows, 2);

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            // Eliminar espacios en blanco y verificar si la fila está completamente vacía
            $row = array_map('trim', $row);
            if (empty(array_filter($row))) {
                \Log::info('Fila omitida por estar completamente vacía', ['row' => $row]);
                continue;
            }

            // Validar campos críticos antes de proceder
            if (empty($row[1]) && empty($row[2])) {
                \Log::info('Fila omitida por falta de nombres y apellidos', ['row' => $row]);
                continue;
            }

            // Buscar al estudiante utilizando espeId primero, luego por nombre si no se encuentra
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante && !empty($row[2]) && !empty($row[1])) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            if ($estudiante) {
                // Verificar si ya existe un registro de PracticaIV para el estudiante
                $practica1 = PracticaIV::where('estudianteId', $estudiante->estudianteId)->first();
                $nrc = NrcVinculacion::where('nrc', $row[6])->first();

                if ($practica1) {
                    // Formatear y analizar las fechas correctamente
                    $fechaInicioFormatted = $this->convertirFecha($row[12]);
                    $fechaFinalizacionFormatted = $this->convertirFecha($row[13]);

                    // Normalizar los nuevos datos para la comparación
                    $newData = [
                        'AreaConocimiento' => $row[11] ?: null,
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'HoraEntrada' => $row[14] ?: null,
                        'nrc' => $nrc ? $nrc->id : null,
                        'HoraSalida' => $row[15] ?: null,
                        'HorasPlanificadas' => $row[16] ?: null,
                        'tipoPractica' => $row[17] ?: null,
                        'nota_final' => $row[18] ?: null,
                        'periodoPractica' => $row[10] ?: null,
                    ];

                    // Normalizar los datos existentes para la comparación
                    $existingData = $practica1->only(array_keys($newData));

                    // Nueva normalización de datos para manejar números y valores nulos
                    $existingDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $existingData);

                    $newDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $newData);

                    // Comparar los datos normalizados
                    if ($existingDataNormalized !== $newDataNormalized) {
                        \Log::info('Diferencia detectada', [
                            'existing' => $existingDataNormalized,
                            'new' => $newDataNormalized,
                            'student_id' => $estudiante->estudianteId
                        ]);
                        $updateCount++;
                    }
                } else {
                    // No se encontró el registro, contar como inserción
                    $insertCount++;
                }
            } else {
                // Log para depuración de estudiantes no encontrados
                \Log::info('Estudiante no encontrado, se requiere nuevo registro', ['student' => $row]);
                $insertCount++;
            }
        }

        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }


    public function previewImportarPracticas4(Request $request)
    {
        // Cargar el archivo Excel
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Saltar las filas del encabezado
        $dataRows = array_slice($rows, 2);

        $insertCount = 0;
        $updateCount = 0;

        foreach ($dataRows as $row) {
            // Eliminar espacios en blanco y verificar si la fila está completamente vacía
            $row = array_map('trim', $row);
            if (empty(array_filter($row))) {
                \Log::info('Fila omitida por estar completamente vacía', ['row' => $row]);
                continue;
            }

            // Validar campos críticos antes de proceder
            if (empty($row[1]) && empty($row[2])) {
                \Log::info('Fila omitida por falta de nombres y apellidos', ['row' => $row]);
                continue;
            }

            // Buscar al estudiante utilizando espeId primero, luego por nombre si no se encuentra
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante && !empty($row[2]) && !empty($row[1])) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            if ($estudiante) {
                // Verificar si ya existe un registro de PracticaIV para el estudiante
                $practica1 = PracticaII::where('estudianteId', $estudiante->estudianteId)->first();
                $nrc = NrcVinculacion::where('nrc', $row[6])->first();

                if ($practica1) {
                    // Formatear y analizar las fechas correctamente
                    $fechaInicioFormatted = $this->convertirFecha($row[12]);
                    $fechaFinalizacionFormatted = $this->convertirFecha($row[13]);

                    // Normalizar los nuevos datos para la comparación
                    $newData = [
                        'AreaConocimiento' => $row[11] ?: null,
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'HoraEntrada' => $row[14] ?: null,
                        'nrc' => $nrc ? $nrc->id : null,
                        'HoraSalida' => $row[15] ?: null,
                        'HorasPlanificadas' => $row[16] ?: null,
                        'tipoPractica' => $row[17] ?: null,
                        'nota_final' => $row[18] ?: null,
                        'periodoPractica' => $row[10] ?: null,
                    ];

                    // Normalizar los datos existentes para la comparación
                    $existingData = $practica1->only(array_keys($newData));

                    // Nueva normalización de datos para manejar números y valores nulos
                    $existingDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $existingData);

                    $newDataNormalized = array_map(function ($value) {
                        return is_null($value) ? null : (is_numeric($value) ? (float) $value : trim($value));
                    }, $newData);

                    // Comparar los datos normalizados
                    if ($existingDataNormalized !== $newDataNormalized) {
                        \Log::info('Diferencia detectada', [
                            'existing' => $existingDataNormalized,
                            'new' => $newDataNormalized,
                            'student_id' => $estudiante->estudianteId
                        ]);
                        $updateCount++;
                    }
                } else {
                    // No se encontró el registro, contar como inserción
                    $insertCount++;
                }
            } else {
                // Log para depuración de estudiantes no encontrados
                \Log::info('Estudiante no encontrado, se requiere nuevo registro', ['student' => $row]);
                $insertCount++;
            }
        }

        return response()->json([
            'insertCount' => $insertCount,
            'updateCount' => $updateCount,
        ]);
    }









    public function importarPracticas1(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    DB::beginTransaction(); // Start transaction

    try {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $dataRows = array_slice($rows, 2); // Start from the third row (0-based index)

        foreach ($dataRows as $rowIndex => $row) {
            // Skip rows with missing essential data
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                \Log::warning('Skipping row due to missing data: ' . json_encode($row));
                continue;
            }

            // Date conversion using PHPSpreadsheet's date class
            $fechaInicio = null;
            $fechaFinalizacion = null;

            // Calculate the Excel row number (1-based index)
            $excelRowIndex = $rowIndex + 3;

            // For column "M" (13th column, 1-based index)
            $fechaInicioCell = 'M' . $excelRowIndex;
            $fechaInicioValue = $worksheet->getCell($fechaInicioCell)->getValue();
            if (!empty($fechaInicioValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaInicioCell))) {
                    $fechaInicio = Date::excelToDateTimeObject($fechaInicioValue)->format('Y-m-d');
                } else {
                    $fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicioValue) ? DateTime::createFromFormat('d/m/Y', $fechaInicioValue)->format('Y-m-d') : null;
                }
            }

            // For column "N" (14th column, 1-based index)
            $fechaFinalizacionCell = 'N' . $excelRowIndex;
            $fechaFinalizacionValue = $worksheet->getCell($fechaFinalizacionCell)->getValue();
            if (!empty($fechaFinalizacionValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaFinalizacionCell))) {
                    $fechaFinalizacion = Date::excelToDateTimeObject($fechaFinalizacionValue)->format('Y-m-d');
                } else {
                    $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue) ? DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue)->format('Y-m-d') : null;
                }
            }

            // Find or create the student
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            // If the student doesn't exist, create a new one
            if (!$estudiante) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[8] . '%')->first();
                $estudiante = Estudiante::create([
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'carrera' => 'Tecnologías de la información',
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'correo' => $row[5],
                    'cedula' => $row[3],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'comentario' => null,
                ]);
            } else {
                // Update student fields if necessary
                $updateFields = [
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'correo' => $row[5],
                    'cedula' => $row[3],
                ];

                foreach ($updateFields as $key => $value) {
                    if (is_null($estudiante->$key)) {
                        $estudiante->$key = $value;
                    }
                }

                $estudiante->save();
            }

            // Find the company with LIKE
            $empresa = Empresa::where('nombreEmpresa', 'LIKE', '%' . $row[19] . '%')->first();
            $tutorAcademico = ProfesUniversidad::where('apellidos', $row[34])->first();
            $nombreTutorEmpresarial = $row[28] . ' ' . $row[29];

            $nrc = NrcVinculacion::where('nrc', $row[6])->first();

            // Prepare practice data
            $practicaData = [
                'estudianteId' => $estudiante->estudianteId,
                'AreaConocimiento' => $row[11],
                'FechaInicio' => $fechaInicio,
                'FechaFinalizacion' => $fechaFinalizacion,
                'HoraEntrada' => $row[14],
                'HoraSalida' => $row[15],
                'HorasPlanificadas' => $row[16],
                'tipoPractica' => $row[17],
                'idEmpresa' => $empresa ? $empresa->id : null,
                'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                'CedulaTutorEmpresarial' => $row[30],
                'nrc' => $nrc ? $nrc->id : null,
                'EmailTutorEmpresarial' => $row[31],
                'TelefonoTutorEmpresarial' => $row[32],
                'Funcion' => $row[33],
                'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                'nota_final' => $row[18],
                'periodoPractica' => $row[10],
                'Estado' => 'Finalizado',
                'EstadoAcademico' => 'Cursando estudios',
                'DepartamentoTutorEmpresarial' => 'Programacion',
            ];

            // Create or update the practice
            $practica1 = PracticaI::where('estudianteId', $estudiante->estudianteId)->first();
            if (!$practica1) {
                PracticaI::create($practicaData);
            } else {
                $practica1->update($practicaData);
            }
        }

        DB::commit(); // Commit the transaction

        return redirect()->back()->with('success', 'Estudiantes y prácticas importados correctamente.');

    } catch (\Exception $e) {
        DB::rollback(); // Rollback the transaction if there is an error

        // Log the error message for debugging
        \Log::error('Error importing students and practices: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Hubo un error al importar los estudiantes y prácticas. Por favor, revise el archivo e intente nuevamente.');
    }
}



public function importarPracticas2(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    DB::beginTransaction(); // Start transaction

    try {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $dataRows = array_slice($rows, 2); // Start from the third row (0-based index)

        foreach ($dataRows as $rowIndex => $row) {
            // Skip rows with missing essential data
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                \Log::warning('Skipping row due to missing data: ' . json_encode($row));
                continue;
            }

            // Date conversion using PHPSpreadsheet's date class
            $fechaInicio = null;
            $fechaFinalizacion = null;

            // Calculate the Excel row number (1-based index)
            $excelRowIndex = $rowIndex + 3;

            // For column "M" (13th column, 1-based index)
            $fechaInicioCell = 'M' . $excelRowIndex;
            $fechaInicioValue = $worksheet->getCell($fechaInicioCell)->getValue();
            if (!empty($fechaInicioValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaInicioCell))) {
                    $fechaInicio = Date::excelToDateTimeObject($fechaInicioValue)->format('Y-m-d');
                } else {
                    $fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicioValue) ? DateTime::createFromFormat('d/m/Y', $fechaInicioValue)->format('Y-m-d') : null;
                }
            }

            // For column "N" (14th column, 1-based index)
            $fechaFinalizacionCell = 'N' . $excelRowIndex;
            $fechaFinalizacionValue = $worksheet->getCell($fechaFinalizacionCell)->getValue();
            if (!empty($fechaFinalizacionValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaFinalizacionCell))) {
                    $fechaFinalizacion = Date::excelToDateTimeObject($fechaFinalizacionValue)->format('Y-m-d');
                } else {
                    $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue) ? DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue)->format('Y-m-d') : null;
                }
            }

            // Busca al estudiante por espeId o nombre y apellidos
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            // Si el estudiante no existe, lo crea
            if (!$estudiante) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[8] . '%')->first();
                $estudiante = Estudiante::create([
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'carrera' => 'Tecnologías de la información',
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'correo' => $row[5],
                    'cedula' => $row[3],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'comentario' => null,
                ]);
            } else {
                $updateFields = [
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'correo' => $row[5],
                    'cedula' => $row[3],
                ];

                foreach ($updateFields as $key => $value) {
                    if (is_null($estudiante->$key)) {
                        $estudiante->$key = $value;
                    }
                }

                $estudiante->save();
            }

            // Busca la empresa con LIKE
            $empresa = Empresa::where('nombreEmpresa', 'LIKE', '%' . $row[19] . '%')->first();
            $tutorAcademico = ProfesUniversidad::where('apellidos', $row[34])->first();
            $nombreTutorEmpresarial = $row[28] . ' ' . $row[29];

            $nrc = NrcVinculacion::where('nrc', $row[6])->first();

            $practicaData = [
                'estudianteId' => $estudiante->estudianteId,
                'AreaConocimiento' => $row[11],
                'FechaInicio' => $fechaInicio,
                'FechaFinalizacion' => $fechaFinalizacion,
                'HoraEntrada' => $row[14],
                'HoraSalida' => $row[15],
                'HorasPlanificadas' => $row[16],
                'tipoPractica' => $row[17],
                'idEmpresa' => $empresa ? $empresa->id : null,
                'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                'CedulaTutorEmpresarial' => $row[30],
                'nrc' => $nrc ? $nrc->id : null,
                'EmailTutorEmpresarial' => $row[31],
                'TelefonoTutorEmpresarial' => $row[32],
                'Funcion' => $row[33],
                'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                'nota_final' => $row[18],
                'periodoPractica' => $row[10],
                'Estado' => 'Finalizado',
                'EstadoAcademico' => 'Cursando estudios',
                'DepartamentoTutorEmpresarial' => 'Programacion',
            ];

            // Create or update the practice
            $practica1 = PracticaIII::where('estudianteId', $estudiante->estudianteId)->first();
            if (!$practica1) {
                PracticaIII::create($practicaData);
            } else {
                $practica1->update($practicaData);
            }
        }

        DB::commit(); // Commit the transaction

        return redirect()->back()->with('success', 'Estudiantes y prácticas importados correctamente.');

    } catch (\Exception $e) {
        DB::rollback(); // Rollback the transaction if there is an error

        // Log the error message for debugging
        \Log::error('Error importing students and practices: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Hubo un error al importar los estudiantes y prácticas. Por favor, revise el archivo e intente nuevamente.');
    }
}


public function importarPracticas3(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    DB::beginTransaction(); // Start transaction

    try {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $dataRows = array_slice($rows, 2); // Start from the third row (0-based index)

        foreach ($dataRows as $rowIndex => $row) {
            // Skip rows with missing essential data
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                \Log::warning('Skipping row due to missing data: ' . json_encode($row));
                continue;
            }

            // Date conversion using PHPSpreadsheet's date class
            $fechaInicio = null;
            $fechaFinalizacion = null;

            // Calculate the Excel row number (1-based index)
            $excelRowIndex = $rowIndex + 3;

            // For column "M" (13th column, 1-based index)
            $fechaInicioCell = 'M' . $excelRowIndex;
            $fechaInicioValue = $worksheet->getCell($fechaInicioCell)->getValue();
            if (!empty($fechaInicioValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaInicioCell))) {
                    $fechaInicio = Date::excelToDateTimeObject($fechaInicioValue)->format('Y-m-d');
                } else {
                    $fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicioValue) ? DateTime::createFromFormat('d/m/Y', $fechaInicioValue)->format('Y-m-d') : null;
                }
            }

            // For column "N" (14th column, 1-based index)
            $fechaFinalizacionCell = 'N' . $excelRowIndex;
            $fechaFinalizacionValue = $worksheet->getCell($fechaFinalizacionCell)->getValue();
            if (!empty($fechaFinalizacionValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaFinalizacionCell))) {
                    $fechaFinalizacion = Date::excelToDateTimeObject($fechaFinalizacionValue)->format('Y-m-d');
                } else {
                    $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue) ? DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue)->format('Y-m-d') : null;
                }
            }

            // Busca al estudiante por espeId o nombre y apellidos
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            // Si el estudiante no existe, lo crea
            if (!$estudiante) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[8] . '%')->first();
                $estudiante = Estudiante::create([
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'carrera' => 'Tecnologías de la información',
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'correo' => $row[5],
                    'cedula' => $row[3],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'comentario' => null,
                ]);
            } else {
                $updateFields = [
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'correo' => $row[5],
                    'cedula' => $row[3],
                ];

                foreach ($updateFields as $key => $value) {
                    if (is_null($estudiante->$key)) {
                        $estudiante->$key = $value;
                    }
                }

                $estudiante->save();
            }

            // Busca la empresa con LIKE
            $empresa = Empresa::where('nombreEmpresa', 'LIKE', '%' . $row[19] . '%')->first();
            $tutorAcademico = ProfesUniversidad::where('apellidos', $row[34])->first();
            $nombreTutorEmpresarial = $row[28] . ' ' . $row[29];

            $nrc = NrcVinculacion::where('nrc', $row[6])->first();

            $practicaData = [
                'estudianteId' => $estudiante->estudianteId,
                'AreaConocimiento' => $row[11],
                'FechaInicio' => $fechaInicio,
                'FechaFinalizacion' => $fechaFinalizacion,
                'HoraEntrada' => $row[14],
                'HoraSalida' => $row[15],
                'HorasPlanificadas' => $row[16],
                'tipoPractica' => $row[17],
                'idEmpresa' => $empresa ? $empresa->id : null,
                'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                'CedulaTutorEmpresarial' => $row[30],
                'nrc' => $nrc ? $nrc->id : null,
                'EmailTutorEmpresarial' => $row[31],
                'TelefonoTutorEmpresarial' => $row[32],
                'Funcion' => $row[33],
                'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                'nota_final' => $row[18],
                'periodoPractica' => $row[10],
                'Estado' => 'Finalizado',
                'EstadoAcademico' => 'Cursando estudios',
                'DepartamentoTutorEmpresarial' => 'Programacion',
            ];

            // Create or update the practice
            $practica1 = PracticaIV::where('estudianteId', $estudiante->estudianteId)->first();
            if (!$practica1) {
                PracticaIV::create($practicaData);
            } else {
                $practica1->update($practicaData);
            }
        }

        DB::commit(); // Commit the transaction

        return redirect()->back()->with('success', 'Estudiantes y prácticas importados correctamente.');

    } catch (\Exception $e) {
        DB::rollback(); // Rollback the transaction if there is an error

        // Log the error message for debugging
        \Log::error('Error importing students and practices: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Hubo un error al importar los estudiantes y prácticas. Por favor, revise el archivo e intente nuevamente.');
    }
}


public function importarPracticas4(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    DB::beginTransaction(); // Start transaction

    try {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $dataRows = array_slice($rows, 2); // Start from the third row (0-based index)

        foreach ($dataRows as $rowIndex => $row) {
            // Skip rows with missing essential data
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                \Log::warning('Skipping row due to missing data: ' . json_encode($row));
                continue;
            }

            // Date conversion using PHPSpreadsheet's date class
            $fechaInicio = null;
            $fechaFinalizacion = null;

            // Calculate the Excel row number (1-based index)
            $excelRowIndex = $rowIndex + 3;

            // For column "M" (13th column, 1-based index)
            $fechaInicioCell = 'M' . $excelRowIndex;
            $fechaInicioValue = $worksheet->getCell($fechaInicioCell)->getValue();
            if (!empty($fechaInicioValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaInicioCell))) {
                    $fechaInicio = Date::excelToDateTimeObject($fechaInicioValue)->format('Y-m-d');
                } else {
                    $fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicioValue) ? DateTime::createFromFormat('d/m/Y', $fechaInicioValue)->format('Y-m-d') : null;
                }
            }

            // For column "N" (14th column, 1-based index)
            $fechaFinalizacionCell = 'N' . $excelRowIndex;
            $fechaFinalizacionValue = $worksheet->getCell($fechaFinalizacionCell)->getValue();
            if (!empty($fechaFinalizacionValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaFinalizacionCell))) {
                    $fechaFinalizacion = Date::excelToDateTimeObject($fechaFinalizacionValue)->format('Y-m-d');
                } else {
                    $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue) ? DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue)->format('Y-m-d') : null;
                }
            }

            // Busca al estudiante por espeId o nombre y apellidos
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            // Si el estudiante no existe, lo crea
            if (!$estudiante) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[8] . '%')->first();
                $estudiante = Estudiante::create([
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'carrera' => 'Tecnologías de la información',
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'correo' => $row[5],
                    'cedula' => $row[3],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'comentario' => null,
                ]);
            } else {
                $updateFields = [
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'correo' => $row[5],
                    'cedula' => $row[3],
                ];

                foreach ($updateFields as $key => $value) {
                    if (is_null($estudiante->$key)) {
                        $estudiante->$key = $value;
                    }
                }

                $estudiante->save();
            }

            // Busca la empresa con LIKE
            $empresa = Empresa::where('nombreEmpresa', 'LIKE', '%' . $row[19] . '%')->first();
            $tutorAcademico = ProfesUniversidad::where('apellidos', $row[34])->first();
            $nombreTutorEmpresarial = $row[28] . ' ' . $row[29];

            $nrc = NrcVinculacion::where('nrc', $row[6])->first();

            $practicaData = [
                'estudianteId' => $estudiante->estudianteId,
                'AreaConocimiento' => $row[11],
                'FechaInicio' => $fechaInicio,
                'FechaFinalizacion' => $fechaFinalizacion,
                'HoraEntrada' => $row[14],
                'HoraSalida' => $row[15],
                'HorasPlanificadas' => $row[16],
                'tipoPractica' => $row[17],
                'idEmpresa' => $empresa ? $empresa->id : null,
                'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                'CedulaTutorEmpresarial' => $row[30],
                'nrc' => $nrc ? $nrc->id : null,
                'EmailTutorEmpresarial' => $row[31],
                'TelefonoTutorEmpresarial' => $row[32],
                'Funcion' => $row[33],
                'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                'nota_final' => $row[18],
                'periodoPractica' => $row[10],
                'Estado' => 'Finalizado',
                'EstadoAcademico' => 'Cursando estudios',
                'DepartamentoTutorEmpresarial' => 'Programacion',
            ];

            // Create or update the practice
            $practica1 = PracticaII::where('estudianteId', $estudiante->estudianteId)->first();
            if (!$practica1) {
                PracticaII::create($practicaData);
            } else {
                $practica1->update($practicaData);
            }
        }

        DB::commit(); // Commit the transaction

        return redirect()->back()->with('success', 'Estudiantes y prácticas importados correctamente.');

    } catch (\Exception $e) {
        DB::rollback(); // Rollback the transaction if there is an error

        // Log the error message for debugging
        \Log::error('Error importing students and practices: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Hubo un error al importar los estudiantes y prácticas. Por favor, revise el archivo e intente nuevamente.');
    }
}


public function importarPracticas5(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    DB::beginTransaction(); // Start transaction

    try {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $dataRows = array_slice($rows, 2); // Start from the third row (0-based index)

        foreach ($dataRows as $rowIndex => $row) {
            // Skip rows with missing essential data
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                \Log::warning('Skipping row due to missing data: ' . json_encode($row));
                continue;
            }

            // Date conversion using PHPSpreadsheet's date class
            $fechaInicio = null;
            $fechaFinalizacion = null;

            // Calculate the Excel row number (1-based index)
            $excelRowIndex = $rowIndex + 3;

            // For column "M" (13th column, 1-based index)
            $fechaInicioCell = 'M' . $excelRowIndex;
            $fechaInicioValue = $worksheet->getCell($fechaInicioCell)->getValue();
            if (!empty($fechaInicioValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaInicioCell))) {
                    $fechaInicio = Date::excelToDateTimeObject($fechaInicioValue)->format('Y-m-d');
                } else {
                    $fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicioValue) ? DateTime::createFromFormat('d/m/Y', $fechaInicioValue)->format('Y-m-d') : null;
                }
            }

            // For column "N" (14th column, 1-based index)
            $fechaFinalizacionCell = 'N' . $excelRowIndex;
            $fechaFinalizacionValue = $worksheet->getCell($fechaFinalizacionCell)->getValue();
            if (!empty($fechaFinalizacionValue)) {
                if (Date::isDateTime($worksheet->getCell($fechaFinalizacionCell))) {
                    $fechaFinalizacion = Date::excelToDateTimeObject($fechaFinalizacionValue)->format('Y-m-d');
                } else {
                    $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue) ? DateTime::createFromFormat('d/m/Y', $fechaFinalizacionValue)->format('Y-m-d') : null;
                }
            }

            // Busca al estudiante por espeId o nombre y apellidos
            $estudiante = Estudiante::where('espeId', $row[4])->first();
            if (!$estudiante) {
                $estudiante = Estudiante::where('nombres', $row[2])
                    ->where('apellidos', $row[1])
                    ->first();
            }

            // Si el estudiante no existe, lo crea
            if (!$estudiante) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                $departamento = Departamento::where('departamento', 'LIKE', '%' . $row[8] . '%')->first();
                $estudiante = Estudiante::create([
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'carrera' => 'Tecnologías de la información',
                    'departamentoId' => $departamento ? $departamento->id : null,
                    'correo' => $row[5],
                    'cedula' => $row[3],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'comentario' => null,
                ]);
            } else {
                $updateFields = [
                    'nombres' => $row[2],
                    'apellidos' => $row[1],
                    'espeId' => $row[4],
                    'Cohorte' => $row[7],
                    'correo' => $row[5],
                    'cedula' => $row[3],
                ];

                foreach ($updateFields as $key => $value) {
                    if (is_null($estudiante->$key)) {
                        $estudiante->$key = $value;
                    }
                }

                $estudiante->save();
            }

            // Busca la empresa con LIKE
            $empresa = Empresa::where('nombreEmpresa', 'LIKE', '%' . $row[19] . '%')->first();
            $tutorAcademico = ProfesUniversidad::where('apellidos', $row[34])->first();
            $nombreTutorEmpresarial = $row[28] . ' ' . $row[29];

            $nrc = NrcVinculacion::where('nrc', $row[6])->first();

            $practicaData = [
                'estudianteId' => $estudiante->estudianteId,
                'AreaConocimiento' => $row[11],
                'FechaInicio' => $fechaInicio,
                'FechaFinalizacion' => $fechaFinalizacion,
                'HoraEntrada' => $row[14],
                'HoraSalida' => $row[15],
                'HorasPlanificadas' => $row[16],
                'tipoPractica' => $row[17],
                'idEmpresa' => $empresa ? $empresa->id : null,
                'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                'CedulaTutorEmpresarial' => $row[30],
                'nrc' => $nrc ? $nrc->id : null,
                'EmailTutorEmpresarial' => $row[31],
                'TelefonoTutorEmpresarial' => $row[32],
                'Funcion' => $row[33],
                'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                'nota_final' => $row[18],
                'periodoPractica' => $row[10],
                'Estado' => 'Finalizado',
                'EstadoAcademico' => 'Cursando estudios',
                'DepartamentoTutorEmpresarial' => 'Programacion',
            ];

            // Create or update the practice
            $practica1 = PracticaV::where('estudianteId', $estudiante->estudianteId)->first();
            if (!$practica1) {
                PracticaV::create($practicaData);
            } else {
                $practica1->update($practicaData);
            }
        }

        DB::commit(); // Commit the transaction

        return redirect()->back()->with('success', 'Estudiantes y prácticas importados correctamente.');

    } catch (\Exception $e) {
        DB::rollback(); // Rollback the transaction if there is an error

        // Log the error message for debugging
        \Log::error('Error importing students and practices: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Hubo un error al importar los estudiantes y prácticas. Por favor, revise el archivo e intente nuevamente.');
    }
}


}
