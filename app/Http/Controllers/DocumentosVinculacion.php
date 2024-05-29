<?php

namespace App\Http\Controllers;

use App\Models\ProfesUniversidad;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ParticipanteVincunlacion;
use App\Models\AsignacionProyecto;
use App\Models\Proyecto;
use App\Models\NotasEstudiante;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\RichText\TextRun;
use App\Models\DirectorVinculacion;
use App\Models\AsignacionEstudiantesDirector;
use App\Models\Periodo;
use Mpdf\Mpdf;

use DateTime;
use App\Models\Estudiante;

class DocumentosVinculacion extends Controller
{
    public function documentos()
    {
        return view('ParticipanteVinculacion.documentos');
    }

    public function generarEvaluacionEstudiante()
    {
        $plantillaPath = public_path('Plantillas/1.4-Evaluación-Estudiantes.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);
        $usuario = auth()->user();
        $correoUsuario = $usuario->CorreoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('Correo', $correoUsuario)->first();
        // Obtener la relación AsignacionEstudiantesDirector para este ParticipanteVinculacion
        $asignacionProyecto = AsignacionProyecto::where('ParticipanteID', $participanteVinculacion->id)
        ->whereHas('estudiante', function ($query) {
            $query->where('Estado', 'Aprobado');
        })
        ->first();



        ///obtener la id del director de AsiignacionProyecto
        $proyecto = Proyecto::where('ProyectoID', $asignacionProyecto->ProyectoID)->first();
         if ($proyecto->Estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }

        ////buscar en profesores universidad
        $Director = ProfesUniversidad::where('id', $proyecto->DirectorID)->first();
        // Obtener los estudiantes asignados a este proyecto

        $estudiantes = AsignacionProyecto::where('ProyectoID', $proyecto->ProyectoID)
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
        $nombreParticipante = "Ing. " . $participanteVinculacion->Apellidos . ' ' . $participanteVinculacion->Nombres . ", Mgtr.";
        $nombreDirector = "Ing. " . $Director->Apellidos . ' ' . $Director->Nombres . ", Mgtr.";
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
            $notas = NotasEstudiante::where('EstudianteID', $estudiante->EstudianteID)->first();
            if ($notas == null) {
                return redirect()->back()->with('error', 'No se han ingresado notas para los estudiantes');
            }
        }

        ///crea el foreach para recorrer los estudiantes y obtener Nombres,Apellidos y cedula
        foreach ($estudiantes as $index => $estudiante) {
            $filaActual = $filaInicio + $index;
            $nombreCompleto = $estudiante->Estudiante->Apellidos . ' ' . $estudiante->Estudiante->Nombres;
            $hojaCalculo->setCellValue("A$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("B$filaActual", $estudiante->Estudiante->cedula);
            $hojaCalculo->setCellValue("C$filaActual", $estudiante->Estudiante->Carrera);

            $notas = NotasEstudiante::where('EstudianteID', $estudiante->Estudiante->EstudianteID)->first();

            $hojaCalculo->setCellValue("D$filaActual", $notas->Tareas);
            $hojaCalculo->setCellValue("E$filaActual", $notas->Resultados_Alcanzados);
            $hojaCalculo->setCellValue("F$filaActual", $notas->Conocimientos);
            $hojaCalculo->setCellValue("G$filaActual", $notas->Adaptabilidad);
            $hojaCalculo->setCellValue("H$filaActual", $notas->Aplicacion);
            $hojaCalculo->setCellValue("I$filaActual", $notas->Capacidad_liderazgo);
            $hojaCalculo->setCellValue("J$filaActual", $notas->Asistencia);
            $hojaCalculo->setCellValue("K$filaActual", $notas->Informe);
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
        $correoUsuario = $usuario->CorreoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('Correo', $correoUsuario)->first();
        // Obtener la relación AsignacionProyecto para este ParticipanteVinculacion
        $asignacionProyecto = AsignacionProyecto::where('ParticipanteID', $participanteVinculacion->id)
        ->whereHas('estudiante', function ($query) {
            $query->where('Estado', 'Aprobado');
        })
        ->first();

        $proyecto = Proyecto::where('ProyectoID', $asignacionProyecto->ProyectoID)->first();

        if ($proyecto->Estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }
        // Obtener los estudiantes asignados a este proyecto
        $Director = ProfesUniversidad::where('id', $proyecto->DirectorID)->first();


        $hojaCalculo = $spreadsheet->getActiveSheet();


        ///Obtener el nombre del participante
        $nombreParticipante = "Ing. " . $participanteVinculacion->Apellidos . ' ' . $participanteVinculacion->Nombres . ", Mgtr.";
        $nombreDirector = "Ing. " . $Director->Apellidos . ' ' . $Director->Nombres . ", Mgtr.";
        ///Obtener el departamento del participante
        $departamento = $participanteVinculacion->Departamento;
        $departamentoDirector = $proyecto->DepartamentoTutor;

        //Obtener datos del director y particpante
        $nombreParticipanteCompleto = $participanteVinculacion->Apellidos . ' ' . $participanteVinculacion->Nombres;
         $cedulaParticipante = $participanteVinculacion->Cedula;
        $cedulaDirector = $Director->Cedula;
        $correoParticipante = $participanteVinculacion->Correo;
        $correoDirector = $Director->Correo;
        $sede = 'Santo Domingo';
        $departamentosParticipante = $participanteVinculacion->Departamento;
        $departamentosDirector = $proyecto->DepartamentoTutor;
        $fechaInicio = $proyecto->FechaInicio;
        $fechaFin = $proyecto->FechaFinalizacion;
        $NumeroHoras = '96';
        $nombreProyecto = $proyecto->NombreProyecto;
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
        $correoUsuario = $usuario->CorreoElectronico;
        $participanteVinculacion = ProfesUniversidad::where('Correo', $correoUsuario)->first();
        // Obtener la relación AsignacionProyecto para este ParticipanteVinculacion
        $asignacionProyecto = AsignacionProyecto::where('ParticipanteID', $participanteVinculacion->id)
        ->whereHas('estudiante', function ($query) {
            $query->where('Estado', 'Aprobado');
        })
        ->first();

        ///obtener la id del director de AsiignacionProyecto
        $proyecto = Proyecto::where('ProyectoID', $asignacionProyecto->ProyectoID)->first();

        if ($proyecto->Estado != 'Ejecucion') {
            return redirect()->back()->with('error', 'No tiene Proyectos en ejecucion.');
        }
        // Obtener los estudiantes asignados a este proyecto
        $estudiantes = AsignacionProyecto::where('ProyectoID', $proyecto->ProyectoID)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'Aprobado');
            })
            ->get();
        if ($estudiantes->isEmpty()) {
            return redirect()->back()->with('error', 'No hay estudiantes asignados a este proyecto.');
        }
        $Director = ProfesUniversidad::where('id', $proyecto->DirectorID)->first();


        $hojaCalculo = $spreadsheet->getActiveSheet();
        $filaInicio = 9;
        $cantidadFilas = count($estudiantes);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $estudiantes = $estudiantes->sortBy('Estudiante.Apellidos');
        ///Obtener el nombre del participante
        $nombreParticipante = "Ing. " . $participanteVinculacion->Apellidos . ' ' . $participanteVinculacion->Nombres . ", Mgtr.";
        $nombreDirector = "Ing. " . $Director->Apellidos . ' ' . $Director->Nombres . ", Mgtr.";
        ///Obtener el departamento del participante
        $departamento = "Departamento de " . $participanteVinculacion->Departamento;
        $departamentoDirector = "Departamento de " . $proyecto->DepartamentoTutor;
        $nombreProyecto = "Nombre del Proyecto: " . $proyecto->NombreProyecto;
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
            $nombreCompleto = $estudiante->Estudiante->Apellidos . ' ' . $estudiante->Estudiante->Nombres;
            $hojaCalculo->setCellValue("B$filaActual", $nombreCompleto);
            $hojaCalculo->setCellValue("C$filaActual", $estudiante->Estudiante->cedula);
            $hojaCalculo->setCellValue("D$filaActual", $estudiante->Estudiante->Carrera);
            $hojaCalculo->setCellValue("E$filaActual", $estudiante->Estudiante->celular);
            $hojaCalculo->setCellValue("F$filaActual", $estudiante->Estudiante->Correo);




        }


        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "1.1-Registro-de-Estudiantes.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);




    }



    //////////////////////////////////////////////////////MATRIZ VINCULACION/////////////////////////////////////////////////////////////////////////////////

    public function MatrizVinculacion()
    {

        $plantillaPath = public_path('Plantillas/Reporte-MatrizVinculacion.xlsx');
        $spreadsheet = IOFactory::load($plantillaPath);

        $hojaCalculo = $spreadsheet->getActiveSheet();

        if ($hojaCalculo == null) {
            return redirect()->back()->with('error', 'No se pudo cargar la plantilla');
        }

        $asignacionProyecto = AsignacionProyecto::all();
        if ($asignacionProyecto->isEmpty()) {
            return redirect()->back()->with('error', 'No hay proyectos asignados');
        }

        $filaInicio = 9;
        $cantidadFilas = count($asignacionProyecto);
        $hojaCalculo->insertNewRowBefore($filaInicio + 1, $cantidadFilas - 1);
        $asignacionProyecto = $asignacionProyecto->sortBy('ProyectoID');

        foreach ($asignacionProyecto as $index => $asignacion) {
            $filaActual = $filaInicio + $index;
            $proyecto = Proyecto::where('ProyectoID', $asignacion->ProyectoID)->first();
            $participante = ProfesUniversidad::where('id', $asignacion->ParticipanteID)->first();
            $director = ProfesUniversidad::where('id', $proyecto->DirectorID)->first();





            $periodo = Periodo::where('id', $asignacion->IdPeriodo)->first();




            $hojaCalculo->getColumnDimension('I')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('O')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('J')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('K')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('L')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('M')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('N')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('O')->setAutoSize(true);
            $hojaCalculo->getColumnDimension('A')->setAutoSize(true);


            $hojaCalculo->setCellValue("I$filaActual", $proyecto->NombreProyecto);
            $hojaCalculo->setCellValue("K$filaActual", $director->Apellidos . ' ' . $director->Nombres);
            $hojaCalculo->setCellValue("L$filaActual", $participante->Apellidos . ' ' . $participante->Nombres);
            $hojaCalculo->setCellValue("M$filaActual", $proyecto->FechaInicio);
            $hojaCalculo->setCellValue("J$filaActual", $proyecto->DescripcionProyecto);
            $hojaCalculo->setCellValue("N$filaActual", $proyecto->FechaFinalizacion);
            $hojaCalculo->setCellValue("O$filaActual", $proyecto->DepartamentoTutor);
            $hojaCalculo->setCellValue("F$filaActual", $periodo->numeroPeriodo);

            $hojaCalculo->setCellValue("A$filaActual", $asignacion->estudiante->Apellidos . ' ' . $asignacion->estudiante->Nombres);
            $hojaCalculo->setCellValue("C$filaActual", $asignacion->estudiante->cedula);
            $hojaCalculo->setCellValue("B$filaActual", $asignacion->estudiante->espe_id);
            $hojaCalculo->setCellValue("D$filaActual", $asignacion->estudiante->usuario->CorreoElectronico);
            $hojaCalculo->setCellValue("E$filaActual", $asignacion->estudiante->Cohorte);


        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $nombreArchivo = "Reporte-MatrizVinculacion.xlsx";
        $writer->save($nombreArchivo);
        return response()->download($nombreArchivo)->deleteFileAfterSend(true);

    }






















    ///////////////////////////////////prueba de carga de matriz para generar datos

    public function import(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $dataRows = array_slice($rows, 1);

        foreach ($dataRows as $row) {
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();

                Estudiante::updateOrCreate(
                    [
                        'espe_id' => $row[0],
                        'cedula' => $row[1],
                    ],
                    [
                        'Correo' => $row[2],
                        'Apellidos' => $row[4],
                        'Nombres' => $row[3],
                        'Cohorte' => $row[5],
                        'id_periodo' => $periodo ? $periodo->id : null,
                        'Carrera' => 'Ingeniería en Tecnologías de la información',
                        'Departamento' => 'Ciencias de la Computación',
                        'comentario' => 'Importado desde Excel',
                    ]
                );
            }
        }

        foreach ($dataRows as $row) {

            $participante = null;
            if (!empty($row[7]) && !empty($row[8]) && !empty($row[6]) && !empty($row[9]) && !empty($row[10]) && !empty($row[11]) && !empty($row[21])) {
                $estudiante = Estudiante::where('espe_id', $row[0])->first();
                $proyecto = Proyecto::where('NombreProyecto', $row[24])->first();
                $periodo = Periodo::where('numeroPeriodo', $row[6])->first();

                $nombreCompleto = $row[8];
                $partesNombre = explode(" ", $nombreCompleto);
                if (count($partesNombre) >= 2) {
                    $apellido = trim($partesNombre[0]);
                    $nombre = trim($partesNombre[1]);

                    $participante = ProfesUniversidad::where('Apellidos', 'like', '%' . $nombre . '%')
                        ->where('Nombres', 'like', '%' . $apellido . '%')
                        ->first();
                }
                $fechaInicio = DateTime::createFromFormat('d/m/Y', $row[9]);
                if ($fechaInicio) {
                    $fechaInicioFormatted = $fechaInicio->format('Y-m-d');
                } else {
                    $fechaInicioFormatted = null;
                }
                $fechaFinalizacion = DateTime::createFromFormat('d/m/Y', $row[10]);
                if ($fechaFinalizacion) {
                    $fechaFinalizacionFormatted = $fechaFinalizacion->format('Y-m-d');
                } else {
                    $fechaFinalizacionFormatted = null;
                }

                 $asignacionExistente = AsignacionProyecto::where('EstudianteID', $estudiante ? $estudiante->EstudianteID : null)
                    ->where('ProyectoID', $proyecto ? $proyecto->ProyectoID : null)
                    ->where('ParticipanteID', $participante ? $participante->id : null)
                    ->where('IdPeriodo', $periodo ? $periodo->id : null)
                    ->first();

                if ($asignacionExistente) {
                     $asignacionExistente->update([
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'FechaAsignacion' => now(),
                    ]);
                } else {
                     AsignacionProyecto::create([
                        'EstudianteID' => $estudiante ? $estudiante->EstudianteID : null,
                        'ProyectoID' => $proyecto ? $proyecto->ProyectoID : null,
                        'ParticipanteID' => $participante ? $participante->id : null,
                        'IdPeriodo' => $periodo->id,
                        'FechaInicio' => $fechaInicioFormatted,
                        'FechaFinalizacion' => $fechaFinalizacionFormatted,
                        'FechaAsignacion' => now(),
                    ]);
                }
            }
        }


        return back()->with('success', 'Datos importados con éxito!');
    }














}
