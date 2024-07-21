<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\AsignacionProyecto;
use App\Models\NrcVinculacion;
use App\Models\Proyecto;
use App\Models\NotasEstudiante;
use App\Models\Empresa;
use App\Models\Periodo;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use Illuminate\Support\Facades\Auth;
use App\Models\HoraVinculacion;



use DateTime;
use App\Models\Estudiante;

class DocumentosVinculacion extends Controller
{
    public function documentos()
    {
        $profesor = Auth::user()->profesorUniversidad;

        $proyecto = AsignacionProyecto::where('participanteId', $profesor->id)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })->first();


        $inicioFecha = $proyecto->inicioFecha ?? null;
        $finalizacionFecha = $proyecto->finalizacionFecha ?? null;




        return view('ParticipanteVinculacion.documentos', compact('inicioFecha', 'finalizacionFecha'));
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
        $departamento = "Departamento de " . $participanteVinculacion->Departamento;
        $departamentoDirector = "Departamento de " . $proyecto->DepartamentoTutor;
        ///combinar celdas
        $hojaCalculo->mergeCells('B12:D12');
        $hojaCalculo->mergeCells('I12:K12');
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

        $hojaCalculo->setCellValue("I12", $nombreDirector);
        $hojaCalculo->getStyle("I12")->getFont()->setSize(14);
        $hojaCalculo->getStyle("I12")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("I12")->getFont()->setBold(true);
        $hojaCalculo->getStyle("I12")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $hojaCalculo->setCellValue("B13", $departamento);
        $hojaCalculo->getStyle("B13")->getFont()->setSize(14);
        $hojaCalculo->getStyle("B13")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("B13")->getFont()->setBold(true);
        $hojaCalculo->getStyle("B13")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle("B13")->getAlignment()->setWrapText(true);

        $hojaCalculo->setCellValue("I13", $departamentoDirector);
        $hojaCalculo->getStyle("I13")->getFont()->setSize(14);
        $hojaCalculo->getStyle("I13")->getFont()->setName("Calibri");
        $hojaCalculo->getStyle("I13")->getFont()->setBold(true);
        $hojaCalculo->getStyle("I13")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $hojaCalculo->getStyle("I13")->getAlignment()->setWrapText(true);

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




    public function generarHorasDocente()
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
        $departamentosParticipante = $participanteVinculacion->departamento;
        $departamentosDirector = $proyecto->departamentoTutor;
        $fechaInicio = $asignacionProyecto->inicioFecha;
        $fechaFin = $asignacionProyecto->finalizacionFecha;
        $NumeroHoras = '96';
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

        // Agrupar las asignaciones por estudiante y ordenarlas por nombre completo
        $asignacionesPorEstudiante = $asignacionProyecto->groupBy('estudianteId')->sortBy(function ($asignaciones) {
            $estudiante = $asignaciones->first()->estudiante;
            return mb_strtoupper(($estudiante->apellidos ?? '') . ' ' . ($estudiante->nombres ?? ''));
        });

        $filaInicio = 9;
        $contador = 1;

        foreach ($asignacionesPorEstudiante as $asignaciones) {
            $estudiante = $asignaciones->first()->estudiante;

            $notas = $estudiante->notas->take(2); // Tomar hasta 2 notas
            $horas = $estudiante->horas_vinculacion->take(2); // Tomar hasta 2 horas de vinculación

            foreach ($asignaciones as $index => $asignacion) {
                $filaActual = $filaInicio;
                $proyecto = $asignacion->proyecto;
                $participante = $asignacion->docenteParticipante;
                $director = $proyecto->director;
                $periodo = $asignacion->periodo;
                $nrc = $asignacion->nrcVinculacion;

                if ($index == 0) { // La primera asignación se maneja normalmente
                    $hojaCalculo->setCellValue("A$filaActual", $contador++); // Contador de asignación
                    $hojaCalculo->setCellValue("B$filaActual", mb_strtoupper(($estudiante->apellidos ?? '') . ' ' . ($estudiante->nombres ?? ''))); // Nombre completo
                    $hojaCalculo->setCellValue("C$filaActual", mb_strtoupper($estudiante->espeId ?? '')); // ID de la ESPE
                    $hojaCalculo->setCellValue("D$filaActual", mb_strtoupper($estudiante->cedula ?? '')); // Cédula
                    $hojaCalculo->setCellValue("E$filaActual", $estudiante->correo ?? ''); // Correo
                    $hojaCalculo->setCellValue("F$filaActual", mb_strtoupper($estudiante->Cohorte ?? '')); // Cohorte
                    $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($periodo->numeroPeriodo)); // Número de período
                    $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($nrc->nrc ?? 'NO REQUIERE NRC')); // NRC
                    $hojaCalculo->setCellValue("I$filaActual", mb_strtoupper($estudiante->departamento ?? '')); // Departamento
                    $hojaCalculo->setCellValue("J$filaActual", mb_strtoupper($estudiante->carrera ?? '')); // Carrera
                    $hojaCalculo->setCellValue("K$filaActual", isset($horas[0]) ? mb_strtoupper($horas[0]->horasVinculacion) : ''); // Primera hora de vinculación
                    $hojaCalculo->setCellValue("L$filaActual", isset($notas[0]) ? mb_strtoupper($notas[0]->notaFinal) : ''); // Primera nota final
                    $hojaCalculo->setCellValue("M$filaActual", mb_strtoupper($proyecto->nombreProyecto)); // Nombre del proyecto
                    $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamentoTutor)); // Departamento tutor
                    $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto)); // Descripción del proyecto
                    $hojaCalculo->setCellValue("P$filaActual", mb_strtoupper($director->apellidos . ' ' . $director->nombres)); // Nombre del director
                    $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento));
                    $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres)); // Nombre del participante
                    $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento));
                    $hojaCalculo->setCellValue("T$filaActual", mb_strtoupper($asignacion->inicioFecha));
                    $hojaCalculo->setCellValue("U$filaActual", mb_strtoupper($asignacion->finalizacionFecha));

                    // Copiar el estilo de la fila 9
                    $hojaCalculo->duplicateStyle($hojaCalculo->getStyle('A9:AG9'), 'A' . $filaActual . ':AG' . $filaActual);

                    $filaInicio++;
                } else { // Las asignaciones adicionales se colocan en las columnas a partir de S
                    $columnaActual = 'W';
                    $hojaCalculo->setCellValue('V' . ($filaActual - 1), mb_strtoupper($periodo->numeroPeriodo)); // Número de período adicional
                    $hojaCalculo->setCellValue($columnaActual . ($filaActual - 1), mb_strtoupper($proyecto->nombreProyecto)); // Nombre del proyecto adicional
                    $hojaCalculo->setCellValue('X' . ($filaActual - 1), mb_strtoupper($proyecto->departamentoTutor)); // Departamento tutor adicional
                    $hojaCalculo->setCellValue('Y' . ($filaActual - 1), mb_strtoupper($director->apellidos . ' ' . $director->nombres)); // Nombre del director adicional
                    $hojaCalculo->setCellValue('Z' . ($filaActual - 1), mb_strtoupper($director->departamento));
                    $hojaCalculo->setCellValue('AA' . ($filaActual - 1), mb_strtoupper($participante->apellidos . ' ' . $participante->nombres)); // Nombre del participante adicional
                    $hojaCalculo->setCellValue('AB' . ($filaActual - 1), mb_strtoupper($participante->departamento));
                    $hojaCalculo->setCellValue('AC' . ($filaActual - 1), mb_strtoupper($proyecto->inicioFecha)); // Fecha de inicio adicional
                    $hojaCalculo->setCellValue('AD' . ($filaActual - 1), mb_strtoupper($proyecto->finFecha)); // Fecha de finalización adicional
                    $hojaCalculo->setCellValue('AF' . ($filaActual - 1), isset($notas[1]) ? mb_strtoupper($notas[1]->notaFinal) : ''); // Segunda nota final
                    $hojaCalculo->setCellValue('AE' . ($filaActual - 1), isset($horas[1]) ? mb_strtoupper($horas[1]->horasVinculacion) : ''); // Segunda hora de vinculación
                    $columnaActual++;
                }

                // Suma de las horas de vinculación del estudiante
                $hojaCalculo->setCellValue("AG" . ($filaActual), "=SUM(K" . ($filaActual) . ",AE" . ($filaActual) . ")");
            }
        }

        $hojaCalculo->getStyle('A9:AG' . ($filaInicio - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_JUSTIFY)->setVertical(Alignment::VERTICAL_CENTER);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Reporte_asignación_proyectos_sociales.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }









    //////////////////////////////////////reporte de docentes participantes/////////////////////////////////////////////////////////////////
    public function historicoParticipante()
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
        $asignacionProyecto = AsignacionProyecto::where('participanteId', $participanteVinculacion->id)
            ->get();

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
            $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento, 'UTF-8'));

            $hojaCalculo->setCellValue("T$filaActual", $asignacion->inicioFecha);
            $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("U$filaActual", $asignacion->finalizacionFecha);
            $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamentoTutor, 'UTF-8'));
            $hojaCalculo->setCellValue("I$filaActual", $periodo->numeroPeriodo);

            $nombreCompleto = mb_strtoupper(($asignacion->estudiante->apellidos ?? '') . ' ' . ($asignacion->estudiante->nombres ?? ''), 'UTF-8');
            $hojaCalculo->setCellValue("C$filaActual", $asignacion->estudiante->espeId ?? '');
            $hojaCalculo->setCellValue("D$filaActual", $asignacion->estudiante->cedula ?? '');
            $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($asignacion->estudiante->carrera, 'UTF-8' ?? ''));
            $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($asignacion->estudiante->departamento, 'UTF-8' ?? ''));


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


        }

        ////justificar y centrar
        $hojaCalculo->getStyle('A9:U' . ($filaInicio + $cantidadFilas - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_JUSTIFY)->setVertical(Alignment::VERTICAL_CENTER);

        $nombreParticipante = $participanteVinculacion->apellidos . '_' . $participanteVinculacion->nombres;
        $nombreParticipante = str_replace([' ', '/', '\\'], '_', $nombreParticipante);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Historial_Participante_$nombreParticipante.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }



    /////////////////////////////////////////HISTORIAL DE DIRECTORES DE PROYECTO///////////////////////////////////////////////
    public function historicoDirector()
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

        /////valida si el director tiene proyectos asignados
        if ($proyecto == null) {
            return redirect()->back()->with('error', 'No tiene proyectos asignados como director');
        }


        $asignacionProyecto = AsignacionProyecto::where('proyectoId', $proyecto->proyectoId)
            ->get();

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
            $hojaCalculo->setCellValue("Q$filaActual", mb_strtoupper($director->departamento, 'UTF-8'));
            $hojaCalculo->setCellValue("R$filaActual", mb_strtoupper($participante->apellidos . ' ' . $participante->nombres, 'UTF-8'));
            $hojaCalculo->setCellValue("S$filaActual", mb_strtoupper($participante->departamento, 'UTF-8'));

            $hojaCalculo->setCellValue("T$filaActual", $asignacion->inicioFecha);
            $hojaCalculo->setCellValue("O$filaActual", mb_strtoupper($proyecto->descripcionProyecto, 'UTF-8'));
            $hojaCalculo->setCellValue("U$filaActual", $asignacion->finalizacionFecha);
            $hojaCalculo->setCellValue("N$filaActual", mb_strtoupper($proyecto->departamentoTutor, 'UTF-8'));
            $hojaCalculo->setCellValue("I$filaActual", $periodo->numeroPeriodo);

            $nombreCompleto = mb_strtoupper(($asignacion->estudiante->apellidos ?? '') . ' ' . ($asignacion->estudiante->nombres ?? ''), 'UTF-8');
            $hojaCalculo->setCellValue("C$filaActual", $asignacion->estudiante->espeId ?? '');
            $hojaCalculo->setCellValue("D$filaActual", $asignacion->estudiante->cedula ?? '');
            $hojaCalculo->setCellValue("H$filaActual", mb_strtoupper($asignacion->estudiante->carrera, 'UTF-8' ?? ''));
            $hojaCalculo->setCellValue("G$filaActual", mb_strtoupper($asignacion->estudiante->departamento, 'UTF-8' ?? ''));


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
        }

        ////justificar y centrar
        $hojaCalculo->getStyle('A9:U' . ($filaInicio + $cantidadFilas))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $nombreDirector = $director->apellidos . '_' . $director->nombres;
        $nombreDirector = str_replace([' ', '/', '\\'], '_', $nombreDirector);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Historial_Director_$nombreDirector.xlsx";

        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);
    }























    ///////////////////////////////////prueba de carga de matriz para generar datos

    function getFecha($fecha)
    {
        $fecha = DateTime::createFromFormat('d/m/Y', $fecha);
        return $fecha ? $fecha->format('Y-m-d') : null;
    }


    public function import(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Skip the header row
        $dataRows = array_slice($rows, 1);

        // Process each row for Estudiantes
        foreach ($dataRows as $row) {
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {
                $periodo = Periodo::where('numeroPeriodo', $row[5])->first();
                $estudiante = Estudiante::where('espeId', $row[0])->first();

                $data = [
                    'espeId' => $row[0],
                    'correo' => $row[2],
                    'apellidos' => $row[3],
                    'cedula' => $row[1],
                    'nombres' => $row[4],
                    'Cohorte' => $row[5],
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'carrera' => $row[7],
                    'departamento' => $row[6],
                    'comentario' => 'Importado desde Excel',
                    'estado' => 'Desactivados',
                    'activacion' => true,
                ];

                if ($estudiante) {
                    $estudiante->update($data);
                } else {
                    $estudiante = Estudiante::create($data);
                }
            }
        }

        // Process each row for AsignacionProyecto and ProfesUniversidad
        foreach ($dataRows as $row) {
            if (!empty($row[7]) && !empty($row[8]) && !empty($row[6]) && !empty($row[9]) && !empty($row[10]) && !empty($row[11]) && !empty($row[15])) {
                $estudiante = Estudiante::where('espeId', $row[0])->first();

                // Trim any leading or trailing whitespace from the project name
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



                $asignacion = AsignacionProyecto::where('estudianteId', $estudiante ? $estudiante->estudianteId : null)
                    ->where('proyectoId', $proyecto ? $proyecto->proyectoId : null)
                    ->where('idPeriodo', $periodo ? $periodo->id : null)
                    ->first();

                $fechaInicio = $this->getFecha($row[12]);
                $fechaFinalizacion = $this->getFecha($row[13]);


                $nrc = NrcVinculacion::where('nrc', $row[9])->first();
                if ($nrc == null) {
                    $nrc = null;
                }
                $data = [
                    'estudianteId' => $estudiante ? $estudiante->estudianteId : null,
                    'proyectoId' => $proyecto ? $proyecto->proyectoId : null,
                    'participanteId' => $participante ? $participante->id : null,
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'nrc' => $nrc ? $nrc->id : null,
                    'inicioFecha' => $fechaInicio,
                    'finalizacionFecha' => $fechaFinalizacion,
                    'asignacionFecha' => now(),
                ];

                if ($asignacion) {
                    $asignacion->update($data);
                } else {
                    AsignacionProyecto::create($data);
                }
            }

            // Procesar segundas asignaciones
            if (!empty($row[19])) {
                $projectName = trim($row[21]);
                $proyecto = Proyecto::where('nombreProyecto', 'like', '%' . $projectName . '%')->first();
                $periodo = Periodo::where('numeroPeriodo', $row[19])->first();

                $nombreCompleto = $row[22];
                $partesNombre = explode(" ", $nombreCompleto);
                if (count($partesNombre) >= 2) {
                    $apellido = trim($partesNombre[0]);
                    $nombre = trim($partesNombre[1]);

                    $participante = ProfesUniversidad::where('nombres', 'like', '%' . $apellido . '%')
                        ->where('apellidos', 'like', '%' . $nombre . '%')
                        ->first();
                }

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[23]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[24]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $asignacion = AsignacionProyecto::where('estudianteId', $estudiante ? $estudiante->estudianteId : null)
                    ->where('proyectoId', $proyecto ? $proyecto->proyectoId : null)
                    ->where('idPeriodo', $periodo ? $periodo->id : null)
                    ->first();

                $nrc = NrcVinculacion::where('nrc', $row[20])->first();

                $data = [
                    'estudianteId' => $estudiante ? $estudiante->estudianteId : null,
                    'proyectoId' => $proyecto ? $proyecto->proyectoId : null,
                    'participanteId' => $participante ? $participante->id : null,
                    'idPeriodo' => $periodo ? $periodo->id : null,
                    'nrc' => $nrc ? $nrc->id : null,
                    'inicioFecha' => $fechaInicioFormatted,
                    'finalizacionFecha' => $fechaFinalizacionFormatted,
                    'asignacionFecha' => now(),
                ];

                if ($asignacion) {
                    $asignacion->update($data);
                } else {
                    AsignacionProyecto::create($data);
                }
            }
        }

        // Process each row for NotasEstudiante
        foreach ($dataRows as $row) {
            $estudiante = Estudiante::where('espeId', $row[0])->first();

            // Crear o actualizar la primera nota
            NotasEstudiante::updateOrCreate(
                ['estudianteId' => $estudiante ? $estudiante->estudianteId : null, 'notaFinal' => $row[15] ?? '0']
            );

            // Crear o actualizar la segunda nota si existe
            if (!empty($row[26])) {
                NotasEstudiante::updateOrCreate(
                    ['estudianteId' => $estudiante ? $estudiante->estudianteId : null, 'notaFinal' => $row[26] ?? '0']
                );
            }
        }

        // Process each row for HoraVinculacion
        foreach ($dataRows as $row) {
            $estudiante = Estudiante::where('espeId', $row[0])->first();

            // Crear o actualizar la primera hora de vinculación
            HoraVinculacion::updateOrCreate(
                ['estudianteId' => $estudiante ? $estudiante->estudianteId : null, 'horasVinculacion' => $row[14] ?? '0']
            );

            // Crear o actualizar la segunda hora de vinculación si existe
            if (!empty($row[25])) {
                HoraVinculacion::updateOrCreate(
                    ['estudianteId' => $estudiante ? $estudiante->estudianteId : null, 'horasVinculacion' => $row[25] ?? '0']
                );
            }
        }

        return back()->with('success', 'Datos importados con éxito!');
    }





    //////////////////////////////////////////////AGREGAR EMPRESSAS POR EXCEL//////////////////////////////////////

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
    public function importarPracticas1(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $dataRows = array_slice($rows, 2);

            foreach ($dataRows as $row) {
                $estudiante = Estudiante::where('espeId', $row[4])->first();
                if (!$estudiante) {
                    $estudiante = Estudiante::where('nombres', $row[2])
                        ->where('apellidos', $row[1])
                        ->first();
                }

                if (!$estudiante) {
                    $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                    $estudiante = Estudiante::create([
                        'nombres' => $row[2],
                        'apellidos' => $row[1],
                        'espeId' => $row[4],
                        'Cohorte' => $row[6],
                        'carrera' => 'Tecnologías de la información',
                        'departamento' => 'Ciencias de la Computación',
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
                        'Cohorte' => $row[6],
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

                // Importar prácticas
                $practica1 = PracticaI::where('estudianteId', $estudiante->estudianteId)->first();
                $empresa = Empresa::where('nombreEmpresa', $row[18])->first();
                $tutorAcademico = ProfesUniversidad::where('apellidos', $row[33])->first();
                $nombreTutorEmpresarial = $row[27] . ' ' . $row[28];

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[11]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[12]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $practicaData = [
                    'estudianteId' => $estudiante->estudianteId,
                    'AreaConocimiento' => $row[10],
                    'FechaInicio' => $fechaInicioFormatted,
                    'FechaFinalizacion' => $fechaFinalizacionFormatted,
                    'HoraEntrada' => $row[13],
                    'HoraSalida' => $row[14],
                    'HorasPlanificadas' => $row[15],
                    'tipoPractica' => $row[16],
                    'idEmpresa' => $empresa ? $empresa->id : null,
                    'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                    'CedulaTutorEmpresarial' => $row[29],
                    'nrc' => null,
                    'EmailTutorEmpresarial' => $row[30],
                    'TelefonoTutorEmpresarial' => $row[31],
                    'Funcion' => $row[32],
                    'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                    'nota_final' => $row[17],
                    'periodoPractica' => $row[9],
                    'Estado' => 'Finalizado',
                    'EstadoAcademico' => 'Cursando estudios',
                    'DepartamentoTutorEmpresarial' => null
                ];

                if (!$practica1) {
                    PracticaI::create($practicaData);
                } else {
                    $practica1->update($practicaData);
                }
            }

            return redirect()->back()->with('success', 'Estudiantes importados.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Estudiantes importados.');
        }
    }




    public function importarPracticas2(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $dataRows = array_slice($rows, 2);

            foreach ($dataRows as $row) {
                $estudiante = Estudiante::where('espeId', $row[4])->first();
                if (!$estudiante) {
                    $estudiante = Estudiante::where('nombres', $row[2])
                        ->where('apellidos', $row[1])
                        ->first();
                }


                if (!$estudiante) {
                    $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                    $estudiante = Estudiante::create([
                        'nombres' => $row[2],
                        'apellidos' => $row[1],
                        'espeId' => $row[4],
                        'Cohorte' => $row[6],
                        'carrera' => 'Tecnologías de la información',
                        'departamento' => 'Ciencias de la Computación',
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
                        'Cohorte' => $row[6],
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

                // Importar prácticas
                $practica1 = PracticaIII::where('estudianteId', $estudiante->estudianteId)->first();
                $empresa = Empresa::where('nombreEmpresa', $row[18])
                    ->orWhere(function ($query) use ($row) {
                        $query->where('rucEmpresa', $row[19]);
                    })
                    ->first();
                $tutorAcademico = ProfesUniversidad::where('apellidos', $row[33])->first();
                $nombreTutorEmpresarial = $row[27] . ' ' . $row[28];

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[11]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[12]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $practicaData = [
                    'estudianteId' => $estudiante->estudianteId,
                    'AreaConocimiento' => $row[10],
                    'FechaInicio' => $fechaInicioFormatted,
                    'FechaFinalizacion' => $fechaFinalizacionFormatted,
                    'HoraEntrada' => $row[13],
                    'HoraSalida' => $row[14],
                    'HorasPlanificadas' => $row[15],
                    'tipoPractica' => $row[16],
                    'idEmpresa' => $empresa->id,
                    'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                    'CedulaTutorEmpresarial' => $row[29],
                    'nrc' => null,
                    'EmailTutorEmpresarial' => $row[30],
                    'TelefonoTutorEmpresarial' => $row[31],
                    'Funcion' => $row[32],
                    'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                    'nota_final' => $row[17],
                    'periodoPractica' => $row[9],
                    'Estado' => 'Finalizado',
                    'EstadoAcademico' => 'Cursando estudios',
                    'DepartamentoTutorEmpresarial' => null
                ];

                if (!$practica1) {
                    PracticaIII::create($practicaData);
                } else {
                    $practica1->update($practicaData);
                }
            }

            return redirect()->back()->with('success', 'Estudiantes importados.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Estudiantes importados.');
        }
    }


    public function importarPracticas3(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $dataRows = array_slice($rows, 2);

            foreach ($dataRows as $row) {
                $estudiante = Estudiante::where('espeId', $row[4])->first();
                if (!$estudiante) {
                    $estudiante = Estudiante::where('nombres', $row[2])
                        ->where('apellidos', $row[1])
                        ->first();
                }


                if (!$estudiante) {
                    $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                    $estudiante = Estudiante::create([
                        'nombres' => $row[2],
                        'apellidos' => $row[1],
                        'espeId' => $row[4],
                        'Cohorte' => $row[6],
                        'carrera' => 'Ingeniería en Tecnologías de la información',
                        'departamento' => 'Ciencias de la Computación',
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
                        'Cohorte' => $row[6],
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

                // Importar prácticas
                $practica1 = PracticaIV::where('estudianteId', $estudiante->estudianteId)->first();
                $empresa = Empresa::where('nombreEmpresa', $row[18])
                    ->orWhere(function ($query) use ($row) {
                        $query->where('rucEmpresa', $row[19]);
                    })
                    ->first();
                $tutorAcademico = ProfesUniversidad::where('apellidos', $row[33])->first();
                $nombreTutorEmpresarial = $row[27] . ' ' . $row[28];

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[11]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[12]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $practicaData = [
                    'estudianteId' => $estudiante->estudianteId,
                    'AreaConocimiento' => $row[10],
                    'FechaInicio' => $fechaInicioFormatted,
                    'FechaFinalizacion' => $fechaFinalizacionFormatted,
                    'HoraEntrada' => $row[13],
                    'HoraSalida' => $row[14],
                    'HorasPlanificadas' => $row[15],
                    'tipoPractica' => $row[16],
                    'idEmpresa' => $empresa->id,
                    'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                    'CedulaTutorEmpresarial' => $row[29],
                    'nrc' => null,
                    'EmailTutorEmpresarial' => $row[30],
                    'TelefonoTutorEmpresarial' => $row[31],
                    'Funcion' => $row[32],
                    'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                    'nota_final' => $row[17],
                    'periodoPractica' => $row[9],
                    'Estado' => 'Finalizado',
                    'EstadoAcademico' => 'Cursando estudios',
                    'DepartamentoTutorEmpresarial' => null
                ];

                if (!$practica1) {
                    PracticaIV::create($practicaData);
                } else {
                    $practica1->update($practicaData);
                }
            }

            return redirect()->back()->with('success', 'Estudiantes importados.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Estudiantes importados.');
        }
    }


    public function importarPracticas4(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $dataRows = array_slice($rows, 2);

            foreach ($dataRows as $row) {
                $estudiante = Estudiante::where('espeId', $row[4])->first();
                if (!$estudiante) {
                    $estudiante = Estudiante::where('nombres', $row[2])
                        ->where('apellidos', $row[1])
                        ->first();
                }

                if (!$estudiante) {
                    $periodo = Periodo::where('numeroPeriodo', $row[6])->first();

                    $estudiante = Estudiante::create([
                        'nombres' => $row[2],
                        'apellidos' => $row[1],
                        'espeId' => $row[4],
                        'Cohorte' => $row[6],
                        'carrera' => 'Tecnologías de la información',
                        'departamento' => 'Ciencias de la Computación',
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
                        'Cohorte' => $row[6],
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

                // Importar prácticas
                $practica1 = PracticaII::where('estudianteId', $estudiante->estudianteId)->first();
                $empresa = Empresa::where('nombreEmpresa', $row[18])
                    ->orWhere(function ($query) use ($row) {
                        $query->where('rucEmpresa', $row[19]);
                    })
                    ->first();
                $tutorAcademico = ProfesUniversidad::where('apellidos', $row[33])->first();
                $nombreTutorEmpresarial = $row[27] . ' ' . $row[28];

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[11]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[12]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $practicaData = [
                    'estudianteId' => $estudiante->estudianteId,
                    'AreaConocimiento' => $row[10],
                    'FechaInicio' => $fechaInicioFormatted,
                    'FechaFinalizacion' => $fechaFinalizacionFormatted,
                    'HoraEntrada' => $row[13],
                    'HoraSalida' => $row[14],
                    'HorasPlanificadas' => $row[15],
                    'tipoPractica' => $row[16],
                    'idEmpresa' => $empresa->id,
                    'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                    'CedulaTutorEmpresarial' => $row[29],
                    'nrc' => null,
                    'EmailTutorEmpresarial' => $row[30],
                    'TelefonoTutorEmpresarial' => $row[31],
                    'Funcion' => $row[32],
                    'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                    'nota_final' => $row[17],
                    'periodoPractica' => $row[9],
                    'Estado' => 'Finalizado',
                    'EstadoAcademico' => 'Cursando estudios',
                    'DepartamentoTutorEmpresarial' => null
                ];

                if (!$practica1) {
                    PracticaII::create($practicaData);
                } else {
                    $practica1->update($practicaData);
                }
            }

            return redirect()->back()->with('success', 'Estudiantes importados.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Estudiantes importados.');
        }
    }


    public function importarPracticas5(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $dataRows = array_slice($rows, 2);

            foreach ($dataRows as $row) {
                $estudiante = Estudiante::where('espeId', $row[4])->first();
                if (!$estudiante) {
                    $estudiante = Estudiante::where('nombres', $row[2])
                        ->where('apellidos', $row[1])
                        ->first();
                }


                if (!$estudiante) {
                    $periodo = Periodo::where('numeroPeriodo', $row[6])->first();
                    $estudiante = Estudiante::create([
                        'nombres' => $row[2],
                        'apellidos' => $row[1],
                        'espeId' => $row[4],
                        'Cohorte' => $row[6],
                        'carrera' => 'Ingeniería en Tecnologías de la información',
                        'departamento' => 'Ciencias de la Computación',
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
                        'Cohorte' => $row[6],
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

                // Importar prácticas
                $practica1 = PracticaV::where('estudianteId', $estudiante->estudianteId)->first();
                $empresa = Empresa::where('nombreEmpresa', $row[18])->first();
                $tutorAcademico = ProfesUniversidad::where('apellidos', $row[33])->first();
                $nombreTutorEmpresarial = $row[27] . ' ' . $row[28];

                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[11]);
                $fechaInicioFormatted = $fechaInicio ? $fechaInicio->format('Y-m-d') : null;

                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[12]);
                $fechaFinalizacionFormatted = $fechaFinalizacion ? $fechaFinalizacion->format('Y-m-d') : null;

                $practicaData = [
                    'estudianteId' => $estudiante->estudianteId,
                    'AreaConocimiento' => $row[10],
                    'FechaInicio' => $fechaInicioFormatted,
                    'FechaFinalizacion' => $fechaFinalizacionFormatted,
                    'HoraEntrada' => $row[13],
                    'HoraSalida' => $row[14],
                    'HorasPlanificadas' => $row[15],
                    'tipoPractica' => $row[16],
                    'idEmpresa' => $empresa ? $empresa->id : null,
                    'NombreTutorEmpresarial' => $nombreTutorEmpresarial,
                    'CedulaTutorEmpresarial' => $row[29],
                    'nrc' => null,
                    'EmailTutorEmpresarial' => $row[30],
                    'TelefonoTutorEmpresarial' => $row[31],
                    'Funcion' => $row[32],
                    'idTutorAcademico' => $tutorAcademico ? $tutorAcademico->id : null,
                    'nota_final' => $row[17],
                    'periodoPractica' => $row[9],
                    'Estado' => 'Finalizado',
                    'EstadoAcademico' => 'Cursando estudios',
                    'DepartamentoTutorEmpresarial' => null
                ];

                if (!$practica1) {
                    PracticaV::create($practicaData);
                } else {
                    $practica1->update($practicaData);
                }
            }

            return redirect()->back()->with('success', 'Estudiantes importados.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Estudiantes importados.');
        }
    }


}
