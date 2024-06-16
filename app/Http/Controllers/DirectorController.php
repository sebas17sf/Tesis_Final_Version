<?php

namespace App\Http\Controllers;

use App\Models\AsignacionProyecto;
use App\Models\Estudiante;
use App\Models\NrcVinculacion;
use App\Models\Periodo;
use App\Models\PracticaI;
use App\Models\PracticaII;
use App\Models\PracticaIII;
use App\Models\PracticaIV;
use App\Models\PracticaV;
use App\Models\ProfesUniversidad;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\estudiantesvinculacion;
use Illuminate\Pagination\LengthAwarePaginator;

class DirectorController extends Controller
{



    public function indexProyectos(Request $request)
    {
        $estadoProyecto = $request->input('estado');
        $departamento = $request->input('departamento');

        $periodos = Periodo::all();
        $nrcs = NrcVinculacion::all();
        $profesores = ProfesUniversidad::whereDoesntHave('proyectosDirigidos')->get();



        $perPage = $request->input('perPage', 10);
        $perPage2 = $request->input('perPage2', 10);
        $page = $request->input('page', 1);
        $page2 = $request->input('page2', 1);
        $search = $request->input('search');
        $search2 = $request->input('search2');


        $validPerPages = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        $query = Proyecto::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombreProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('descripcionProyecto', 'LIKE', '%' . $search . '%')
                    ->orWhere('estado', 'LIKE', '%' . $search . '%')
                    ->orWhere('departamentoTutor', 'LIKE', '%' . $search . '%')
                    ->orWhere('codigoProyecto', 'LIKE', '%' . $search . '%');
            });
        }

        if ($estadoProyecto) {
            $query->where('estado', $estadoProyecto);
        }

        if ($departamento) {
            $query->where('departamentoTutor', $departamento);
        }

        $proyectos = $query->paginate($perPage, ['*'], 'page', $page);



        $proyectosDisponibles = Proyecto::where('estado', 'Ejecucion')->get();
        $estudiantesAprobados = Estudiante::where('estado', 'Aprobado')
            ->whereDoesntHave('asignaciones')
            ->get();

        $profesorId = request('profesor');
        $periodoId = request('periodos');

        $asignacionesAgrupadas = AsignacionProyecto::with('estudiante')
            ->with('proyecto')
            ->with('docenteParticipante')
            ->with('periodo')
            ->when($profesorId, function ($query, $profesorId) {
                return $query->whereHas('docenteParticipante', function ($query) use ($profesorId) {
                    $query->where('id', $profesorId);
                });
            })
            ->when($periodoId, function ($query, $periodoId) {
                return $query->whereHas('periodo', function ($query) use ($periodoId) {
                    $query->where('id', $periodoId);
                });
            })


            ->when($search2, function ($query, $search2) {
                return $query->where(function ($query) use ($search2) {
                    $query->whereHas('estudiante', function ($query) use ($search2) {
                        $query->where('nombres', 'like', "%{$search2}%")
                            ->orWhere('apellidos', 'like', "%{$search2}%")
                            ->orWhere('espeId', 'like', "%{$search2}%")
                            ->orWhere('cedula', 'like', "%{$search2}%");
                    })
                        ->orWhereHas('proyecto', function ($query) use ($search2) {
                            $query->where('nombreProyecto', 'like', "%{$search2}%");
                        })
                        ->orWhereHas('docenteParticipante', function ($query) use ($search2) {
                            $query->where('nombres', 'like', "%{$search2}%")
                                ->orWhere('apellidos', 'like', "%{$search2}%");
                        })
                        ->orWhereHas('periodo', function ($query) use ($search2) {
                            $query->where('numeroPeriodo', 'like', "%{$search2}%");
                        })
                        ->orWhereHas('proyecto.director', function ($query) use ($search2) {
                            $query->where('nombres', 'like', "%{$search2}%")
                                ->orWhere('apellidos', 'like', "%{$search2}%");
                        });
                });
            })

            ->get()
            ->groupBy(function ($item) {
                return $item->proyectoId . '_' . $item->idPeriodo . "_" . $item->participanteId;
            });

        $total = $asignacionesAgrupadas->count();
        $paginatedData = $asignacionesAgrupadas->forPage($page2, $perPage2);
        $paginator = new LengthAwarePaginator(
            $paginatedData,
            $total,
            $perPage2,
            $page2,
            ['path' => route('director.indexProyectos'), 'pageName' => 'page2']
        );
        return view('director.proyectos', [
            'proyectos' => $proyectos,
            'proyectosDisponibles' => $proyectosDisponibles,
            'estudiantesAprobados' => $estudiantesAprobados,
            'perPage' => $perPage,
            'perPage2' => $perPage2,
            'paginator' => $paginator,
            'profesores' => $profesores,
            'nrcs' => $nrcs,
            'asignacionesAgrupadas' => $paginator,
            'periodos' => $periodos,
            'search' => $search,
            'search2' => $search2,
        ]);
        if ($estadoProyecto) {
            $query->where('estado', $estadoProyecto);
        }

        if ($profesorId) {
            $query->whereHas('director', function ($q) use ($profesorId) {
                $q->where('id', $profesorId);
            });
        }

        if ($periodoId) {
            $query->whereHas('periodo', function ($q) use ($periodoId) {
                $q->where('id', $periodoId);
            });
        }

        $proyectos = $query->paginate($perPage, ['*'], 'page', $page);

        if ($request->ajax()) {
            return view('tablaProyectos', compact('proyectos'))->render();
        }

        return view('director.proyectos', compact('proyectos', 'periodos', 'nrcs', 'profesores', 'estadoProyecto', 'search'));

    }


    public function index()
    {
        return view('director.index');
    }



    ////////////////visualizador de practicas//////////////////////

    public function practicas(Request $request)
    {



        $search = $request->input('search');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');
        $search4 = $request->input('search4');



        $perPage1 = $request->input('paginacion1', 10);
        $perPage2 = $request->input('paginacion2', 10);
        $perPage3 = $request->input('paginacion3', 10);
        $perPage4 = $request->input('paginacion4', 10);

        $estudiantesConPracticaI = PracticaI::with('estudiante')
            ->where('estado', 'PracticaI')
            ->get();

        $estudiantesConPracticaII = PracticaII::with('estudiante')
            ->where('estado', 'PracticaII')
            ->get();

        $estudiantesPracticas = PracticaI::with('estudiante')
            ->where(function ($query) use ($search) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
            })
            ->where(function ($query) use ($search) {

                $query->where('estudianteId', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search) {
                        $query->where('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search) {
                        $query->where('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhere('idEmpresa', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('empresa', function ($query) use ($search) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search . '%');
                    });

            })
            ->paginate($perPage1, ['*'], 'page1');

        $estudiantesPracticasII = PracticaII::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })

            ->where(function ($query) use ($search2) {

                $query->where('EstudianteID', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search2) {
                        $query->where('nombres', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search2 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search2) {
                        $query->where('nombres', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search2 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search2 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search2) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search2 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search2 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search2 . '%');
                    });

            })
            ->paginate($perPage2, ['*'], 'page2');

        $estudiantesPracticasIII = PracticaIII::with('estudiante')
            ->where(function ($query) {
                $query->where('Estado', 'En ejecucion')
                    ->orWhere('Estado', 'Finalizado');
            })
            ->where(function ($query) use ($search3) {

                $query->where('EstudianteID', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search3) {
                        $query->where('nombres', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search3 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search3) {
                        $query->where('nombres', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search3 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search3 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search3) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search3 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search3 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search3 . '%');
                    });

            })
            ->paginate($perPage3, ['*'], 'page3');

        $estudiantesPracticasIV = PracticaIV::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })
            ->where(function ($query) use ($search4) {

                $query->where('EstudianteID', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('estudiante', function ($query) use ($search4) {
                        $query->where('nombres', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('carrera', 'LIKE', '%' . $search4 . '%');
                    })
                    ->orWhere('idTutorAcademico', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('tutorAcademico', function ($query) use ($search4) {
                        $query->where('nombres', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search4 . '%');
                    })
                    ->orWhere('IDEmpresa', 'LIKE', '%' . $search4 . '%')
                    ->orWhereHas('empresa', function ($query) use ($search4) {
                        $query->where('nombreEmpresa', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('rucEmpresa', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('provincia', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $search4 . '%')

                            ->orWhere('NombreTutorEmpresarial', 'LIKE', '%' . $search4 . '%')
                            ->orWhere('tipoPractica', 'LIKE', '%' . $search4 . '%');
                    });

            })
            ->paginate($perPage4, ['*'], 'page4');

        $estudiantesPracticasV = PracticaV::with('estudiante')
            ->where(function ($query) {
                $query->where('estado', 'En ejecucion')
                    ->orWhere('estado', 'Finalizado');
            })
            ->get();

        return view(
            'director.practicas',
            compact(
                'estudiantesConPracticaI',
                'estudiantesPracticas',
                'estudiantesConPracticaII',
                'estudiantesPracticasII',
                'estudiantesPracticasIII',
                'estudiantesPracticasIV',
                'estudiantesPracticasV',
                'perPage1',
                'perPage2',
                'perPage3',
                'perPage4',
                'search',
                'search2',
                'search3',
                'search4'

            )
        );
    }


    public function mostrarEstudiantesAprobados(Request $request)
    {
        $elementosPorPagina = $request->input('elementosPorPagina');
        $elementosPorPaginaAprobados = $request->input('elementosPorPaginaAprobados'); // Cambio de nombre

        $search2 = $request->input('search2');

        // Consulta para estudiantes en revisión
        $queryEstudiantesEnRevision = Estudiante::where('Estado', 'En proceso de revisión')
            ->orderBy('Nombres', 'asc');

        // Búsqueda de estudiantes en revisión
        if ($request->has('buscarEstudiantesEnRevision')) {
            $busquedaEstudiantesEnRevision = $request->input('buscarEstudiantesEnRevision');
            $queryEstudiantesEnRevision->where(function ($query) use ($busquedaEstudiantesEnRevision) {
                $query->where('Nombres', 'like', '%' . $busquedaEstudiantesEnRevision . '%')
                    ->orWhere('Apellidos', 'like', '%' . $busquedaEstudiantesEnRevision . '%');
            });
        }

        $estudiantesEnRevision = $queryEstudiantesEnRevision->get();

        // Consulta y paginación para estudiantes aprobados
        $queryEstudiantesAprobados = Estudiante::whereIn('Estado', ['Aprobado', 'Aprobado-prácticas', 'Desactivados']);

        // Búsqueda de estudiantes aprobados
        if ($request->has('search2')) {
            $busquedaEstudiantesAprobados = $request->input('search2');
            $queryEstudiantesAprobados->where(function ($query) use ($busquedaEstudiantesAprobados) {
                $query->where('Nombres', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('Apellidos', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('espe_id', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('celular', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('cedula', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('Cohorte', 'like', '%' . $busquedaEstudiantesAprobados . '%')
                    ->orWhere('Departamento', 'like', '%' . $busquedaEstudiantesAprobados . '%');
            });
        }

        $estudiantesAprobados = $queryEstudiantesAprobados->paginate($elementosPorPaginaAprobados); // Cambio de nombre

        // Verificar si no se encontraron resultados para la búsqueda de estudiantes de vinculación

        return view('director.estudiantesAprobados', [
            'estudiantesEnRevision' => $estudiantesEnRevision,
            'estudiantesAprobados' => $estudiantesAprobados,
            'elementosPorPagina' => $elementosPorPagina,
            'elementosPorPaginaAprobados' => $elementosPorPaginaAprobados,
            'search2' => $search2,
        ]);
    }






}

