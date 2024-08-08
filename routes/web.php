<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DirectorVinculacionController;
use App\Http\Controllers\ParticipanteVinculacionController;
use App\Http\Controllers\DocumentosVinculacion;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\GraficaController;
use Laravel\Socialite\Facades\Socialite;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/keep-alive', [SessionController::class, 'keepAlive']);
Route::get('/check-session-status', [SessionController::class, 'checkSessionStatus']);
Route::post('/keep-alive', [SessionController::class, 'keepAlive'])->name('keep-alive');
Route::post('/update-token-expiration', [SessionController::class, 'updateTokenExpiration'])->name('update-token-expiration');

// Ruta para procesar el inicio de sesión (POST)
Route::post('/', [LoginController::class, 'login']);

// Ruta para mostrar el formulario de registro (GET)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Ruta para procesar el registro de usuarios (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::put('/register', [EstudianteController::class, 'store'])->name('estudiantes.store');

//////ruta para la vista de recuperar contraseña
Route::get('/forgot-password', [LoginController::class, 'recuperarContrasena'])->name('recuperar-contrasena');

////ruta para enviar correo de recuperacion
Route::post('/forgot-password', [LoginController::class, 'enviarEnlaceRestablecimiento'])->name('enviar-correo-recuperacion');

/// Ruta para mostrar el formulario de restablecimiento
Route::get('/reset-password/{token}', [LoginController::class, 'mostrarFormularioRestablecimiento'])
    ->name('mostrar-formulario-restablecimiento');

// Ruta para ingresar la nueva contraseña
Route::post('/reset-password/{correoElectronico}', [LoginController::class, 'cambiarContrasenaUsuario'])
    ->name('restablecer-contrasena');
///funcion para cerrar la sesion del usuario
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/toggle-menu', [MenuController::class, 'toggleMenuState'])->name('toggle-menu');

Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');

Route::get('/docente/registro', [AuthController::class, 'mostrarRegistroDocente'])->name('ParticipanteVinculacion.create');

Route::post('/docente/create', [AuthController::class, 'registerDocente'])->name('ParticipanteVinculacion.comprobar');

Route::post('/docente/envio-registro', [AuthController::class, 'guadarRegistroDocente'])->name('ParticipanteVinculacion.register');



//////Protecion para los accesos importantes

Route::middleware(['auth'])->group(function () {

    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');

    // Ruta para mostrar el formulario de edición de datos del Estudiante
    Route::get('/estudiantes/{estudiante}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    // Ruta para procesar y actualizar los datos del Estudiante
    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    ///Renviar informacion de aceptacion estudiante
    Route::post('/estudiantes/{estudiante}/resend', [EstudianteController::class, 'resend'])->name('estudiantes.resend');
    ///guardarActividad
    Route::post('/estudiantes/guardar-actividad', [EstudianteController::class, 'guardarActividad'])->name('estudiantes.guardarActividad');
    /////eliminarActividad
    Route::delete('/estudiantes/{id}/eliminar-actividad', [EstudianteController::class, 'eliminarActividad'])->name('eliminarActividad');
    /////editar actvidiad
    Route::get('/estudiantes/{id}/editar-actividad', [EstudianteController::class, 'editarActividad'])->name('editarActividad');
    ////actualizarActividad
    Route::put('/estudiantes/{id}/actualizar-actividad', [EstudianteController::class, 'updateActividad'])->name('updateActividad');



    //ruta para el administrador
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    ////Actualziar estado del usuario profesor
    Route::put('/admin/usuario{id}', [AdminController::class, 'updateEstado'])->name('admin.updateEstado');
    ///borrar los permisos concedidos
    Route::delete('/admin/{id}/deletePermission', [AdminController::class, 'deletePermission'])->name('admin.deletePermission');

    ////ReporteEstudiantes
    Route::post('/admin/reportes-estudiantes', [DocumentoController::class, 'ReporteEstudiantes'])->name('admin.reportesEstudiantes');

    /////rutas para verificar el estudiante-admin
    Route::get('/admin/estudiantes', [AdminController::class, 'estudiantes'])->name('admin.estudiantes');
    Route::put('/admin/actualizar-estudiante/{id}', [AdminController::class, 'updateEstudiante'])->name('admin.updateEstudiante');

    ///ruta para visualizar los proyectos agregados por el admin
    Route::get('/admin/proyectos', [AdminController::class, 'indexProyectos'])->name('admin.indexProyectos');
    ///ruta para crear un proyecto
    Route::get('/admin/agregar-proyecto', [AdminController::class, 'crearProyectoForm'])->name('admin.agregarProyecto');
    Route::post('/admin/agregar-proyecto', [AdminController::class, 'crearProyecto'])->name('admin.crearProyecto');
    Route::put('/admin/docente/aceptar/{id}', [AdminController::class, 'aceptarDocente'])->name('admin.aceptarDocente');
    Route::put('/admin/docente/rechazar/{id}', [AdminController::class, 'rechazarDocente'])->name('admin.rechazarDocente');
    ///editar proyecto
// Rutas para editar proyectos y eliminar
    Route::get('/admin/proyectos/{ProyectoID}/edit', [AdminController::class, 'editProyectoForm'])->name('admin.editarProyecto');
    Route::put('/admin/proyectos/{ProyectoID}', [AdminController::class, 'editProyecto'])->name('admin.updateProyecto');
    Route::delete('/admin/proyectos/{ProyectoID}', [AdminController::class, 'deleteProyecto'])->name('admin.deleteProyecto');
    //guardarCohorte
    Route::post('/admin/guardar-cohorte', [AdminController::class, 'guardarCohorte'])->name('admin.guardarCohorte');
    ///guardarPeriodo
    Route::post('/admin/guardar-periodo', [AdminController::class, 'guardarPeriodo'])->name('admin.guardarPeriodo');
    ///eliminarPeriodo
    Route::delete('/admin/{id}/eliminar-periodo', [AdminController::class, 'eliminarPeriodo'])->name('admin.eliminarPeriodo');
    ////eliminarCohorte
    Route::delete('/admin/{id}/eliminar-cohorte', [AdminController::class, 'eliminarCohorte'])->name('admin.eliminarCohorte');

    ///guardarDocentesProyectos
    Route::post('/admin/guardar-docentes-proyectos', [AdminController::class, 'guardarDocentesProyectos'])->name('admin.guardarDocentesProyectos');

    ///ruta cordinador index
    Route::get('/coordinador', [CoordinadorController::class, 'index'])->name('coordinador.index');
    ///ruta para agregar proyecto coordinador
    Route::get('/coordinador/agregar-proyecto', [CoordinadorController::class, 'crearProyectoForm'])->name('coordinador.agregarProyecto');
    Route::post('/coordinador/agregar-proyecto', [CoordinadorController::class, 'crearProyecto'])->name('coordinador.crearProyecto');
    ///editar proyecto
// Rutas para editar proyectos y eliminar
    Route::get('/coordinador/proyectos/{proyectoId}/edit', [CoordinadorController::class, 'editProyectoForm'])->name('coordinador.editarProyecto');
    Route::put('/coordinador/proyectos/{proyectoId}', [CoordinadorController::class, 'editProyecto'])->name('coordinador.updateProyecto');
    Route::delete('/coordinador/proyectos/{proyectoId}', [CoordinadorController::class, 'deleteProyecto'])->name('coordinador.deleteProyecto');
    ///mostrar los estudiantes aprobados
    Route::get('/coordinador/estudiantes-aprobados', [CoordinadorController::class, 'mostrarEstudiantesAprobados'])->name('coordinador.estudiantesAprobados');

    ///ruta para asignar proyecto
    Route::get('/coordinador/asignar-proyecto', [CoordinadorController::class, 'asignarProyectos'])->name('coordinador.asignarProyecto');
    //guardar asignacion
    Route::post('/coordinador/guardar-asignacion', [CoordinadorController::class, 'guardarAsignacion'])->name('coordinador.guardarAsignacion');
    //mostrar los proyectos asignados a los estudiantes
    Route::get('/coordinador/proyectos-estudiantes', [CoordinadorController::class, 'proyectosEstudiantes'])->name('coordinador.proyectosEstudiantes');


    //ruta para las practicas 1 y 2 del estudiante
    Route::get('/estudiantes/practica1', [EstudianteController::class, 'practica1'])->name('estudiantes.practica1');
    Route::get('/estudiantes/practica2', [EstudianteController::class, 'practica2'])->name('estudiantes.practica2');

    ////ruta para visular la vista agregarEmpresa del coordinador
    Route::get('/coordinador/agregar-empresa', [CoordinadorController::class, 'agregarEmpresa'])->name('coordinador.agregarEmpresa');
    ///ruta para guardar la empresa del coordinador
    Route::post('/coordinador/guardar-empresa', [CoordinadorController::class, 'guardarEmpresa'])->name('coordinador.guardarEmpresa');
    ///ruta para eliminar la empresa del coordinador
    Route::delete('/coordinador/eliminar-empresa/{id}', [CoordinadorController::class, 'eliminarEmpresa'])->name('coordinador.eliminarEmpresa');

    ////rutas para el director
    Route::get('/director', [DirectorController::class, 'index'])->name('director.index');
    ///ruta para mostrar los estudiantes aprobados
    Route::get('/director/estudiantes-aprobados', [DirectorController::class, 'mostrarEstudiantesAprobados'])->name('director.estudiantesAprobados');
    ///ruta para mostrar los proyectos
    Route::get('/director/proyectos', [DirectorController::class, 'indexProyectos'])->name('director.indexProyectos');

    Route::patch('/admin/revertir-asignacion/{proyectoId}/{idPeriodo}', [AdminController::class, 'revertirAsignacion'])->name('admin.revertirAsignacion');
    ///////////agregarDepartamento
    Route::post('/admin/guardar-departamento', [AdminController::class, 'agregarDepartamento'])->name('admin.agregarDepartamento');
    Route::post('/admin/actualizarDepartamento/{id}', [AdminController::class, 'actualizarDepartamento'])->name('admin.actualizarDepartamento');


    ///ruta para guardar guardarPracticas del estudiante
    Route::post('/estudiantes/guardar-practicas', [EstudianteController::class, 'guardarPracticas'])->name('guardarPracticas');

    ///ruta para mostrar la vista de aceptarFaseI del coordinador
    Route::get('/coordinador/aceptar-faseI', [CoordinadorController::class, 'aceptarFaseI'])->name('coordinador.aceptarFaseI');

    ///ruta para actualizar el estado del estudiante
    Route::put('/coordinador/actualizar-estado-estudiante/{id}', [CoordinadorController::class, 'actualizarEstadoEstudiante'])->name('coordinador.actualizarEstadoEstudiante');

    ////ruta para gener el documento del DocumetoController
    Route::get('/estudiantes/documentos', [DocumentoController::class, 'mostrarFormulario'])->name('estudiantes.documentos');
    Route::post('/estudiantes/generar-documento', [DocumentoController::class, 'generar'])->name('generar-documento');
    Route::post('/estudiantes/generar-documento-cartaCompromiso', [DocumentoController::class, 'generarCartaCompromiso'])->name('generar-documento-cartaCompromiso');
    Route::post('/estudiantes/generar-documento-numeroHoras', [DocumentoController::class, 'generarHorasEstudiante'])->name('generar-documento-numeroHoras');
    Route::post('/estudiantes/generar-informe', [DocumentoController::class, 'generarInforme'])->name('estudiantes.generarInforme');
    Route::post('/estudiantes/guardar-datos', [EstudianteController::class, 'guardarDatos'])->name('estudiantes.guardarDatos');
    Route::get('/estudiantes/recuperar-datos', [EstudianteController::class, 'recuperarDatos'])->name('estudiantes.recuperarDatos');

    ////rutas del participante vinculacion
    Route::get('/participante-vinculacion', [ParticipanteVinculacionController::class, 'index'])->name('ParticipanteVinculacion.index');
    Route::get('/participante-vinculacion/estudiantes', [ParticipanteVinculacionController::class, 'estudiantes'])->name('ParticipanteVinculacion.estudiantes');
    Route::get('/participante-vinculacion/baremo', [ParticipanteVinculacionController::class, 'baremo'])->name('ParticipanteVinculacion.baremo');

    Route::get('/director-vinculacion/baremo', [DirectorVinculacionController::class, 'baremo'])->name('director.baremo');
    /////////cerrarProcesoEstudianteIndividual
    Route::post('/director-vinculacion/cerrar-proceso-estudiante-individual/{estudianteId}', [DirectorVinculacionController::class, 'cerrarProcesoEstudianteIndividual'])->name('director.cerrarEstudianteIndividual');
    ///rutas para guardar las notas del estudiante, participante
    Route::post('/participante-vinculacion/guardar-notas', [ParticipanteVinculacionController::class, 'guardarNotas'])->name('guardar-notas');
    ///ruta para actualizar las notas del estudiante
    Route::put('/participante-vinculacion/{id}/actualizar-notas', [ParticipanteVinculacionController::class, 'editarNotas'])->name('actualizar-notas');




    ////////////practticas
    Route::get('/participante-vinculacion/practicas', [ParticipanteVinculacionController::class, 'practicas'])->name('ParticipanteVinculacion.practicas');
    //////guardarNotasPracticasi
    Route::post('/participante-vinculacion/guardar-notas-practicasi', [ParticipanteVinculacionController::class, 'guardarNotasPracticasi'])->name('ParticipanteVinculacion.guardarNotasPracticasi');
    ////editarNotasPracticasi
    Route::put('/participante-vinculacion/{id}/editar-notas-practicasi', [ParticipanteVinculacionController::class, 'editarNotasPracticasi'])->name('ParticipanteVinculacion.editarNotasPracticasi');
    ////cerar proceso de practicasI
    Route::put('/participante-vinculacion/cerrar-proceso-practicasI', [ParticipanteVinculacionController::class, 'cerrarPracticasi'])->name('ParticipanteVinculacion.cerrarProcesoPracticasI');


    ///////////////////practica ii
    Route::get('/participante-vinculacion/practicas2', [ParticipanteVinculacionController::class, 'practicasii'])->name('ParticipanteVinculacion.practicasii');
    ///guardarNotasPracticasii
    Route::post('/participante-vinculacion/guardar-notas-practicasii', [ParticipanteVinculacionController::class, 'guardarNotasPracticasii'])->name('ParticipanteVinculacion.guardarNotasPracticasii');
    ///editarNotasPracticasii
    Route::put('/participante-vinculacion/{id}/editar-notas-practicasii', [ParticipanteVinculacionController::class, 'editarNotasPracticasii'])->name('ParticipanteVinculacion.editarNotasPracticasii');
    ///cerrarProcesoPracticasii
    Route::put('/participante-vinculacion/cerrar-proceso-practicasii', [ParticipanteVinculacionController::class, 'cerrarPracticasii'])->name('ParticipanteVinculacion.cerrarProcesoPracticasii');
    Route::post('/participante-vinculacion/guardar-datos-informe', [ParticipanteVinculacionController::class, 'guardarDatos'])->name('participante.guardarDatos');
    Route::get('/participante-vinculacion/recuperar-datos-informe', [ParticipanteVinculacionController::class, 'recuperarDatos'])->name('participante.recuperarDatos');








    ///acta de reunion
    Route::post('/participante-vinculacion/generar-acta-reunion', [DocumentoController::class, 'actaReunion'])->name('ParticipanteVinculacion.generarActaReunion');

    ////baremos
    Route::post('/participante-vinculacion/generar-baremo', [DocumentoController::class, 'baremo'])->name('ParticipanteVinculacion.generarBaremo');
    Route::post('/director-vinculacion/generar-baremo', [DocumentoController::class, 'baremoDirector'])->name('director.generarBaremo');

    //////////matriz vinculacion de DocumentosVinculacion
    Route::post('/reporte/matriz-vinculacion', [DocumentosVinculacion::class, 'matrizVinculacion'])->name('reporte.matrizVinculacion');

    Route::post('/reporte/historico-participante', [DocumentosVinculacion::class, 'historicoParticipante'])->name('reporte.historicoParticipante');

    Route::post('/reporte/historico-director', [DocumentosVinculacion::class, 'historicoDirector'])->name('reporte.director');


    //////////////importar de matriz de excel para los datos
    Route::post('/import', [DocumentosVinculacion::class, 'import'])->name('import');
    /////////////////importar de las empresas
    Route::post('/import-empresas', [DocumentosVinculacion::class, 'importaEmpresas'])->name('import-empresas');
    /////////////////////importar practcias 1
    Route::post('/import-practicas1', [DocumentosVinculacion::class, 'importarPracticas1'])->name('import-practicas1');
    ///////////////importar practicas 2
    Route::post('/import-practicas2', [DocumentosVinculacion::class, 'importarPracticas2'])->name('import-practicas2');
    ///////////////importar practicas 3
    Route::post('/import-practicas3', [DocumentosVinculacion::class, 'importarPracticas3'])->name('import-practicas3');
    ///////////////importar practicas 4
    Route::post('/import-practicas4', [DocumentosVinculacion::class, 'importarPracticas4'])->name('import-practicas4');
    ///////////////importar practicas 5
    Route::post('/import-practicas5', [DocumentosVinculacion::class, 'importarPracticas5'])->name('import-practicas5');


    ///ruta para los documentos del participante
    Route::get('/participante-vinculacion/documentos', [DocumentosVinculacion::class, 'documentos'])->name('ParticipanteVinculacion.documentos');

    ///ruta para generarEvaluacionEstudiante
    Route::post('/participante-vinculacion/generar-evaluacion-estudiante', [DocumentosVinculacion::class, 'generarEvaluacionEstudiante'])->name('ParticipanteVinculacion.generarEvaluacionEstudiante');

    ///ruta para generarHorasDocente
    Route::post('/participante-vinculacion/generar-horas-docente', [DocumentosVinculacion::class, 'generarHorasDocente'])->name('ParticipanteVinculacion.generarHorasDocente');

    ///ruta para generarAsistencia
    Route::post('/participante-vinculacion/generar-asistencia', [DocumentosVinculacion::class, 'generarAsistencia'])->name('ParticipanteVinculacion.generarAsistencia');

    Route::post('/estudiante/generar-asistencia', [DocumentoController::class, 'generarAsistenciaEstudiantes'])->name('estudiante.generarAsistenciaEstudiantes');


    //configuracion estudiantes
    Route::get('/estudiantes/configuracion', [EstudianteController::class, 'configuracion'])->name('estudiantes.configuracion');
    Route::put('/estudiantes/actualizar-configuracion/{id}', [EstudianteController::class, 'actualizarConfiguracion'])->name('estudiantes.actualizarConfiguracion');

    ///agregar guardarMaestro
    Route::post('/admin/guardar-maestro', [AdminController::class, 'guardarMaestro'])->name('admin.guardarMaestro');
    ///eliminar maestro
    Route::delete('/admin/{id}/eliminar-maestro', [AdminController::class, 'eliminarMaestro'])->name('admin.eliminarMaestro');
    //descargar coordinador
    Route::get('/coordinador/descargar/{tipo}/{id}', [CoordinadorController::class, 'descargar'])
        ->name('coordinador.descargar');


    ////participante vinculacion configuracion
    Route::get('/participante-vinculacion/configuracion', [ParticipanteVinculacionController::class, 'configuracion'])->name('ParticipanteVinculacion.configuracion');
    ///actualizar configuracion
    Route::put('/participante-vinculacion/actualizar-configuracion/{ID_Participante}', [ParticipanteVinculacionController::class, 'actualizarConfiguracion'])->name('ParticipanteVinculacion.actualizarConfiguracion');

    ///reporte reportesVinculacion del coordinador en DocumentoController
    Route::post('/coordinador/reportes-vinculacion', [DocumentoController::class, 'reportesVinculacion'])->name('coordinador.reportesVinculacion');
    //////acta de designacin estudiants
    Route::post('/director/generar-documento', [DocumentoController::class, 'generarActaDirector'])->name('generar-actaEstudiante');




    ///DirectorVinculacion
    Route::get('/director-vinculacion', [DirectorVinculacionController::class, 'index'])->name('director_vinculacion.index');
    ///estudiantes
    Route::get('/director-vinculacion/estudiantes', [DirectorVinculacionController::class, 'estudiantes'])->name('director_vinculacion.estudiantes');

    ///actualizarInforme del director
    Route::post('/director-vinculacion/actualizar-informe', [DirectorVinculacionController::class, 'actualizarInforme'])->name('director_vinculacion.actualizarInforme');
    /////actualizarNota de estudiante update
    Route::put('/director-vinculacion/actualizar-nota/{id}', [DirectorVinculacionController::class, 'actualizarNota'])->name('director_vinculacion.actualizarNota');

    ////descargarEvidencias del coordinador
    Route::get('/coordinador/descargar-evidencias/{ProyectoID}', [CoordinadorController::class, 'descargarEvidencias'])->name('coordinador.descargarEvidencias');

    ///documentosDirector del director vinculacion
    Route::get('/director-vinculacion/documentos', [DirectorVinculacionController::class, 'documentosDirector'])->name('director_vinculacion.documentos');

    //generarInformeDirector
    Route::post('/director-vinculacion/generar-informe-director', [DirectorVinculacionController::class, 'generarInformeDirector'])->name('director_vinculacion.generarInformeDirector');

    route::get('/director/estudiantes-repartidos', [DirectorVinculacionController::class, 'repartoEstudiantes'])->name('director.repartoEstudiantes');

    /////cerrarProcesoEstudiantes
    Route::post('/director-vinculacion/cerrar-proceso-estudiantes', [DirectorVinculacionController::class, 'cerrarProcesoEstudiantes'])->name('director_vinculacion.cerrarProcesoEstudiantes');

    //////asignarEstudiantes del director vinculacion
    Route::post('/director-vinculacion/asignar-estudiantes', [DirectorVinculacionController::class, 'asignarEstudiantes'])->name('director_vinculacion.asignarEstudiantes');
    ///////desigmarEstudiantes del director vinculacion
    Route::delete('/director-vinculacion/desasignar-estudiantes/{EstudianteID}', [DirectorVinculacionController::class, 'designarEstudiante'])->name('director_vinculacion.desasignarEstudiantes');

    Route::delete('/director-vinculacion/eliminar-estudiantes/{EstudianteID}', [DirectorVinculacionController::class, 'eliminarEstudiante'])->name('director_vinculacion.eliminarEstudiante');




    ////////director vinculacion practicas 1
    Route::get('/director-vinculacion/practicas1', [DirectorVinculacionController::class, 'practicas1'])->name('director_vinculacion.practicas1');
    ///guardarNotasPracticas1
    Route::post('/director-vinculacion/guardar-notas-practicas1', [DirectorVinculacionController::class, 'guardarNotasPracticasi'])->name('director_vinculacion.guardarNotasPracticas1');
    ///editarNotasPracticas1
    Route::put('/director-vinculacion/{id}/editar-notas-practicas1', [DirectorVinculacionController::class, 'editarNotasPracticasi'])->name('director_vinculacion.editarNotasPracticas1');
    ///cerrarProcesoPracticas1
    Route::put('/director-vinculacion/cerrar-proceso-practicas1', [DirectorVinculacionController::class, 'cerrarPracticasi'])->name('director_vinculacion.cerrarProcesoPracticas1');
    Route::put('/proyecto/{id}', [DirectorVinculacionController::class, 'updateDatosProyectos'])->name('proyecto.update');


    ////////director vinculacion practicas 2
    Route::get('/director-vinculacion/practicas2', [DirectorVinculacionController::class, 'practicasii'])->name('director_vinculacion.practicas2');
    ///guardarNotasPracticas2
    Route::post('/director-vinculacion/guardar-notas-practicas2', [DirectorVinculacionController::class, 'guardarNotasPracticasii'])->name('director_vinculacion.guardarNotasPracticas2');
    ///editarNotasPracticas2
    Route::put('/director-vinculacion/{id}/editar-notas-practicas2', [DirectorVinculacionController::class, 'editarNotasPracticasii'])->name('director_vinculacion.editarNotasPracticas2');
    ///cerrarProcesoPracticas2
    Route::put('/director-vinculacion/cerrar-proceso-practicas2', [DirectorVinculacionController::class, 'cerrarPracticasii'])->name('director_vinculacion.cerrarProcesoPracticas2');




    ////agregarEmpresa del admin
    Route::get('/admin/agregar-empresa', [AdminController::class, 'agregarEmpresa'])->name('admin.agregarEmpresa');
    ///guardarEmpresa del admin
    Route::post('/admin/guardar-empresa', [AdminController::class, 'guardarEmpresa'])->name('admin.guardarEmpresa');
    ///descargar del admin
    Route::get('/admin/descargar/{tipo}/{id}', [AdminController::class, 'descargar'])
        ->name('admin.descargar');
    ///eliminarEmpresa del admin
    Route::delete('/admin/eliminar-empresa/{id}', [AdminController::class, 'eliminarEmpresa'])->name('admin.eliminarEmpresa');
    //editarEmpresa del admin
    Route::get('/admin/empresa/{id}/edit', [AdminController::class, 'editarEmpresa'])->name('admin.editarEmpresa');
    ////actualizarEmpresa del admin
    Route::put('/admin/actualizar-empresa/{id}', [AdminController::class, 'actualizarEmpresa'])->name('admin.actualizarEmpresa');
    ///editarDocente ir a la vista
    Route::get('/admin/docente/{id}/edit', [AdminController::class, 'editarDocente'])->name('admin.editarDocente');
    //////actualizarMaestro del admin
    Route::put('/admin/actualizar-maestro/{id}', [AdminController::class, 'actualizarMaestro'])->name('admin.actualizarMaestro');
    ///guardarPracticas2 del estudiante
    Route::post('/estudiantes/guardar-practicas2', [EstudianteController::class, 'guardarPracticas2'])->name('guardarPracticas2');
    ////actualizarEstadoEstudiante2 del coordinador
    Route::put('/coordinador/actualizar-estado-estudiante2/{id}', [CoordinadorController::class, 'actualizarEstadoEstudiante2'])->name('coordinador.actualizarEstadoEstudiante2');

    ///editarPeriodo del admin
    Route::get('/admin/periodo/{id}/edit', [AdminController::class, 'editarPeriodo'])->name('admin.editarPeriodo');
    //actualizarPeriodo del admin
    Route::put('/admin/actualizar-periodo/{id}', [AdminController::class, 'actualizarPeriodo'])->name('admin.actualizarPeriodo');

    ///reporteSessiones del admin
    Route::post('/admin/reportes-sesiones', [DocumentoController::class, 'reporteSessiones'])->name('admin.reportesSesiones');

    ////editarNombreEmpresa del coordinador
    Route::get('/coordinador/estudiante/{id}/edit', [CoordinadorController::class, 'editarNombreEmpresa'])->name('coordinador.editarNombreEmpresa');
    ///actualizarNombreEmpresa del coordinador
    Route::put('/coordinador/actualizar-nombre-empresa/{id}', [CoordinadorController::class, 'actualizarNombreEmpresa'])->name('coordinador.actualizarNombreEmpresa');
    ///guardarAsignacion del admin
    Route::post('/admin/guardar-asignacion', [AdminController::class, 'guardarAsignacion'])->name('admin.guardarAsignacion');

    ////PRACTICASSSSSSSSSSSSSSSSSSSS
    Route::get('/admin/aceptar-practicas', [AdminController::class, 'aceptarFasei'])->name('admin.aceptarFaseI');




    ///actualizarEstadoEstudiante del admin
    Route::put('/admin/actualizar-estado-estudiante/{id}', [AdminController::class, 'actualizarEstadoEstudiante'])->name('admin.actualizarEstadoEstudiante');
    ////actualizarEstadoEstudiante2 del admin
    Route::put('/admin/actualizar-estado-estudiante2/{id}', [AdminController::class, 'actualizarEstadoEstudiante2'])->name('admin.actualizarEstadoEstudiante2');
    ////editarNombreEmpresa del admin
    Route::get('/admin/estudiante/{id}/edit', [AdminController::class, 'editarNombreEmpresa'])->name('admin.editarNombreEmpresa');
    ////actualizarNombreEmpresa del admin
    Route::put('/admin/actualizar-nombre-empresa/{id}', [AdminController::class, 'actualizarNombreEmpresa'])->name('admin.actualizarNombreEmpresa');
    ////practicas del director
    Route::get('/director/practicas', [DirectorController::class, 'practicas'])->name('director.practicas');
    /////editarEmpresa de coordinador
    Route::get('/coordinador/empresa/{id}/edit', [CoordinadorController::class, 'editarEmpresa'])->name('coordinador.editarEmpresa');
    ////actualizarEmpresa de coordinador
    Route::put('/coordinador/actualizar-empresa/{id}', [CoordinadorController::class, 'actualizarEmpresa'])->name('coordinador.actualizarEmpresa');
    ////certificadoMatricula del estudiante
    Route::get('/estudiantes/certificado-matricula', [EstudianteController::class, 'certificadoMatricula'])->name('estudiantes.certificadoMatricula');

    ////reportesProyectos de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-proyectos', [DocumentoController::class, 'reportesProyectos'])->name('coordinador.reportesProyectos');



    //////reportesEstudiantes de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-estudiantes', [DocumentoController::class, 'reportesEstudiantes'])->name('coordinador.reportesEstudiantes');
    /////reportesEmpresas de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-empresas', [DocumentoController::class, 'reportesEmpresas'])->name('coordinador.reportesEmpresas');

    ////reportesPracticaI de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-practicaI', [DocumentoController::class, 'reportesPracticaI'])->name('coordinador.reportesPracticaI');
    ////reportesPracticaII de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-practicaII', [DocumentoController::class, 'reportesPracticaII'])->name('coordinador.reportesPracticaII');
    ////reportesPracticaIII de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-practicaIII', [DocumentoController::class, 'reportesPracticaIII'])->name('coordinador.reportesPracticaIII');
    ////reportesPracticaIV de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-practicaIV', [DocumentoController::class, 'reportesPracticaIV'])->name('coordinador.reportesPracticaIV');
    ////reportesPracticaV de DocumentoController para admin y coordinador
    Route::post('/coordinador/reportes-practicaV', [DocumentoController::class, 'reportesPracticaV'])->name('coordinador.reportesPracticaV');


    ////reporteVinculacionProyectos
    Route::post('/coordinador/reportes-vinculacion-proyectos', [DocumentoController::class, 'reporteVinculacionProyectos'])->name('coordinador.reporteVinculacionProyectos');
    ////////////Reporte Docentes de admin
    Route::post('/admin/reportes-docentes', [DocumentoController::class, 'ReporteProyectos'])->name('admin.reportesDocentes');


    ////////////////NRC Vincluacion de admin
    Route::post('/admin/nrc-vinculacion', [AdminController::class, 'GuardarNRC'])->name('admin.nrcVinculacion');
    /////////NRC PRACTICAS 1
    Route::post('/admin/nrc-practicas1', [AdminController::class, 'GuardarNRCPracticas1'])->name('admin.nrcPracticas1');


    ////////////////////////Docuemntos de practicas
    Route::post('/estudiantes/documentos-practicas', [DocumentoController::class, 'EncuestaEstudiante'])->name('generar.EncuestaEstudiante');
    Route::post('/estudiantes/documentos-EncuestaEstudiante', [DocumentoController::class, 'EncuestaDocentes'])->name('generar.EncuestaDocentes');
    Route::post('/estudiantes/documentos-EvTutorEmpresarial', [DocumentoController::class, 'EvTutorEmpresarial'])->name('generar.EvTutorEmpresarial');
    Route::post('/estudiantes/documentos-PlanificacionPPEstudiante', [DocumentoController::class, 'PlanificacionPPEstudiante'])->name('generar.PlanificacionPPEstudiante');
    Route::post('/estudiantes/documentos-ControlAvanceActividades', [DocumentoController::class, 'ControlAvanceActividades'])->name('generar.ControlAvanceActividades');
    Route::post('/estudiantes/documentos-EvTutorAcademico', [DocumentoController::class, 'EvTutorAcademico'])->name('generar.EvTutorAcademico');
    Route::post('/estudiantes/documentos-Informe', [DocumentoController::class, 'InformPractica'])->name('generar.InformPractica');



    Route::post('/estudiantes/documentos-practicas2', [DocumentoController::class, 'EncuestaEstudiante2'])->name('generar.EncuestaEstudiante2');
    Route::post('/estudiantes/documentos-EncuestaEstudiante2', [DocumentoController::class, 'EncuestaDocentes2'])->name('generar.EncuestaDocentes2');
    Route::post('/estudiantes/documentos-EvTutorEmpresarial2', [DocumentoController::class, 'EvTutorEmpresarial2'])->name('generar.EvTutorEmpresarial2');
    Route::post('/estudiantes/documentos-PlanificacionPPEstudiante2', [DocumentoController::class, 'PlanificacionPPEstudiante2'])->name('generar.PlanificacionPPEstudiante2');
    Route::post('/estudiantes/documentos-ControlAvanceActividades2', [DocumentoController::class, 'ControlAvanceActividades2'])->name('generar.ControlAvanceActividades2');
    Route::post('/estudiantes/documentos-EvTutorAcademico2', [DocumentoController::class, 'EvTutorAcademico2'])->name('generar.EvTutorAcademico2');
    Route::post('/estudiantes/documentos-Informe2', [DocumentoController::class, 'InformPractica2'])->name('generar.InformPractica2');






    ///////////////////guardar actividades del estudiantes de practicas 1
    Route::post('/estudiantes/guardar-actividades-practicas1', [EstudianteController::class, 'guardarActividadPractica1'])->name('estudiantes.guardarActividadesPracticas1');
    //////////////////eliminar actividades del estudiantes de practicas 1
    Route::delete('/estudiantes/{id}/eliminar-actividad-practicas1', [EstudianteController::class, 'eliminarActividadPracticas1'])->name('estudiantes.eliminarActividadPracticas1');
    //////////////////editar actividades del estudiantes de practicas 1
    Route::put('/estudiantes/{id}/editar-actividad-practicas1', [EstudianteController::class, 'updateActividadPracticas1'])->name('estudiantes.actualizarActividadPracticas1');

    ///////////////////guardar actividades del estudiantes de practicas 2
    Route::post('/estudiantes/guardar-actividades-practicas2', [EstudianteController::class, 'guardarActividadPractica2'])->name('estudiantes.guardarActividadesPracticas2');
    //////////////////eliminar actividades del estudiantes de practicas 2
    Route::delete('/estudiantes/{id}/eliminar-actividad-practicas2', [EstudianteController::class, 'eliminarActividadPracticas2'])->name('estudiantes.eliminarActividadPracticas2');
    //////////////////editar actividades del estudiantes de practicas 2
    Route::put('/estudiantes/{id}/editar-actividad-practicas2', [EstudianteController::class, 'updateActividadPracticas2'])->name('estudiantes.actualizarActividadPracticas2');

    //////////////////////////////cambio de credenciales
    Route::get('/admin/credenciales', [AdminController::class, 'cambiarCredencialesUsuario'])->name('admin.cambio-credenciales');
    Route::put('/admin/credenciales', [AdminController::class, 'actualizarCredenciales'])->name('admin.updateCredenciales');

    Route::get('/director-vinculacion/cambio-credenciales', [DirectorVinculacionController::class, 'cambiarCredencialesUsuario'])->name('director_vinculacion.cambio-credenciales');
    Route::put('/director-vinculacion/cambio-credenciales', [DirectorVinculacionController::class, 'actualizarCredenciales'])->name('director_vinculacion.updateCredenciales');

    Route::get('/participante-vinculacion/cambio-credenciales', [ParticipanteVinculacionController::class, 'cambiarCredencialesUsuario'])->name('participante-vinculacion.cambio-credenciales');
    Route::put('/participante-vinculacion/cambio-credenciales', [ParticipanteVinculacionController::class, 'actualizarCredenciales'])->name('participante-vinculacion.updateCredenciales');

    Route::get('/estudiantes/cambio-credenciales', [EstudianteController::class, 'cambiarCredencialesUsuario'])->name('estudiantes.cambio-credenciales');
    Route::put('/estudiantes/cambio-credenciales/{userId}', [EstudianteController::class, 'actualizarCredenciales'])->name('estudiantes.actualizarCredenciales');
    Route::put('/estudiantes/cambio-datos/{estudianteId}', [EstudianteController::class, 'actualizarDatosEstudiantesCredenciales'])->name('estudiantes.updateDatos');



    Route::get('/coordinador/cambio-credenciales', [CoordinadorController::class, 'cambiarCredencialesUsuario'])->name('coordinador.cambio-credenciales');
    Route::put('/coordinador/cambio-credenciales', [CoordinadorController::class, 'actualizarCredenciales'])->name('coordinador.updateCredenciales');

    //////////////////////////respaldo
    Route::post('/respaldo', [AdminController::class, 'backup'])->name('admin.respaldo');





    Route::get('/conectar-modulos', [LoginController::class, 'conectarModulos'])->name('conectarModulos');
    Route::post('/modulo1', [LoginController::class, 'Modulo1'])->name('modulo1');

    Route::get('/{any}', function () {
        return file_get_contents(public_path('gestion-academica/index.html'));
    })->where('any', '.*');

    Route::get('/gestion-academica', [LoginController::class, 'Modulo2'])->name('modulo2')->middleware('auth');



















});

//////////////////////////////////////////////////ruta github


Route::get('/auth/github/redirect', [LoginController::class, 'githubRedirect'])->name('github.redirect');


Route::get('auth/github/callback', [LoginController::class, 'githubCallback'])->name('github.callback');


Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect'])->name('google.redirect');

Route::get('/auth/google/callback', [LoginController::class, 'googleCallback'])->name('google.callback');


