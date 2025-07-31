<?php

use App\Http\Controllers\Config\MenuController;
use App\Http\Controllers\Config\MenuEmpresaController;
use App\Http\Controllers\Config\MenuRolController;
use App\Http\Controllers\Config\RolController;
use App\Http\Controllers\Empresa\AreaController;
use App\Http\Controllers\Empresa\CargoController;
use App\Http\Controllers\Empresa\EmpleadoController;
use App\Http\Controllers\Empresa\EmpresaController;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\IntranetPageController;
use App\Http\Controllers\Proyectos\ComponenteController;
use App\Http\Controllers\Proyectos\HistorialController;
use App\Http\Controllers\Proyectos\ProyectoController;
use App\Http\Controllers\Proyectos\TareaController;
use App\Http\Middleware\AdminEmp;
use App\Http\Middleware\Administrador;
use App\Http\Middleware\AdminSistema;
use App\Http\Middleware\Empleado;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () {return view('welcome');});

Route::controller(ExtranetPageController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');
    Route::get('registro', 'registro')->name('extranet.registro');
    Route::post('registrar', 'registrar')->name('extranet.registrar');
    Route::get('acceso', 'acceso')->name('extranet.acceso');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', [IntranetPageController::class, 'dashboard'])->name('dashboard');
    //Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    //===================================================================================================
    Route::prefix('configuracion_sis')->middleware(AdminSistema::class)->group(function () {
        Route::controller(MenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(RolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(MenuRolController::class)->prefix('permisos_menus_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ----------------------------------------------------------------------------------------
    });
    //===================================================================================================
    Route::prefix('configuracion_sis')->group(function () {
        // ----------------------------------------------------------------------------------------
        Route::middleware(Administrador::class)->group(function () {
            // ----------------------------------------------------------------------------------------
            /* Ruta Administrador del Sistema Menu Rol*/
            Route::controller(MenuEmpresaController::class)->prefix('permisos_menus_empresas')->group(function () {
                Route::get('', 'index')->name('menu.empresa.index');
                Route::post('guardar', 'store')->name('menu.empresa.store');
            });
            // ----------------------------------------------------------------------------------------
        });
        // ----------------------------------------------------------------------------------------
        Route::middleware(AdminEmp::class)->group(function () {
            // ----------------------------------------------------------------------------------------
            /* Ruta Administrador del Sistema Menu Rol*/
            Route::controller(EmpresaController::class)->prefix('empresas')->group(function () {
                Route::get('', 'index')->name('empresa.index');
                Route::get('crear', 'create')->name('empresa.create');
                Route::post('guardar', 'store')->name('empresa.store');
                Route::get('editar/{id}', 'edit')->name('empresa.edit');
                Route::put('actualizar/{id}', 'update')->name('empresa.update');
                Route::delete('eliminar/{id}', 'destroy')->name('empresa.destroy');
                Route::get('getEmpresas', 'getEmpresas')->name('empresa.getEmpresas');
                Route::get('activar/{id}', 'activar')->name('empresa.activar');
            });
            // ----------------------------------------------------------------------------------------
        });
    });
    //===================================================================================================
    Route::prefix('configuracion')->middleware(AdminEmp::class)->group(function () {
        // ----------------------------------------------------------------------------------------
        Route::controller(AreaController::class)->prefix('areas')->group(function () {
            Route::get('', 'index')->name('areas.index');
            Route::get('crear', 'create')->name('areas.create');
            Route::get('editar/{id}', 'edit')->name('areas.edit');
            Route::post('guardar', 'store')->name('areas.store');
            Route::put('actualizar/{id}', 'update')->name('areas.update');
            Route::delete('eliminar/{id}', 'destroy')->name('areas.destroy');
            Route::get('getDependencias/{id}', 'getDependencias')->name('areas.getDependencias');
            Route::get('getAreas', 'getAreas')->name('areas.getAreas');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Cargos
        Route::controller(CargoController::class)->prefix('cargos')->group(function () {
            Route::get('', 'index')->name('cargos.index');
            Route::get('crear', 'create')->name('cargos.create');
            Route::get('editar/{id}', 'edit')->name('cargos.edit');
            Route::post('guardar', 'store')->name('cargos.store');
            Route::put('actualizar/{id}', 'update')->name('cargos.update');
            Route::delete('eliminar/{id}', 'destroy')->name('cargos.destroy');
            Route::get('getCargos', 'getCargos')->name('cargos.getCargos');
            Route::get('getCargosTodos', 'getCargosTodos')->name('cargos.getCargosTodos');
            Route::get('getCargosAreas', 'getCargosAreas')->name('cargos.getCargosAreas');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Cargos
        Route::controller(EmpleadoController::class)->prefix('empleados')->group(function () {
            Route::get('', 'index')->name('empleados.index');
            Route::get('crear', 'create')->name('empleados.create');
            Route::get('editar/{id}', 'edit')->name('empleados.edit');
            Route::post('guardar', 'store')->name('empleados.store');
            Route::put('actualizar/{id}', 'update')->name('empleados.update');
            Route::delete('eliminar/{id}', 'destroy')->name('empleados.destroy');
            Route::get('getEmpleadosEmpresa', 'getEmpleadosEmpresa')->name('empleados.getEmpleadosEmpresa');
            Route::get('getCargosAreas', 'getCargosAreas')->name('empleados.getCargosAreas');
            // ----------------------------------------------------------------------------------------
            Route::get('getTareas', 'getTareas')->name('empleados.getTareas');
            Route::get('getTareasVencidas', 'getTareasVencidas')->name('empleados.getTareasVencidas');
        });
        // ----------------------------------------------------------------------------------------
    });
    //===================================================================================================
    Route::middleware(Empleado::class)->group(function () {
        Route::prefix('proyectos')->group(function () {
            // ----------------------------------------------------------------------------------------
            Route::controller(ProyectoController::class)->group(function () {
                Route::get('', 'index')->name('proyectos.index');
                Route::get('crear', 'create')->name('proyectos.create');
                Route::get('editar/{id}', 'edit')->name('proyectos.edit');
                Route::get('detalle/{id}', 'show')->name('proyectos.detalle');
                Route::post('guardar', 'store')->name('proyectos.store');
                Route::put('actualizar/{id}', 'update')->name('proyectos.update');
                Route::delete('eliminar/{id}', 'destroy')->name('proyectos.destroy');
                // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                Route::get('gestion/{id}/{notificacion_id?}', 'gestion')->name('proyectos.gestion');
                Route::get('expotar_informeproyecto/{id}', 'expotar_informeproyecto')->name('proyectos.expotar_informeproyecto');
                // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                Route::get('getEmpresas', 'getEmpresas')->name('proyectos.getEmpresas');
                Route::get('getEmpleados', 'getEmpleados')->name('proyectos.getEmpleados');

                Route::get('getproyectos/{estado}/{config_empresa_id}', 'getproyectos')->name('proyectos.getproyectos');
            });
            // ----------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------
            Route::controller(ComponenteController::class)->prefix('componentes')->group(function () {
                Route::get('crear/{proyecto_id}', 'create')->name('componentes.create');
                Route::post('guardar/{proyecto_id}', 'store')->name('componentes.store');
                Route::get('editar/{id}', 'edit')->name('componentes.edit');
                Route::put('actualizar/{id}', 'update')->name('componentes.update');
                Route::get('reasignacionComponente', 'reasignacionComponente')->name('componentes.reasignacionComponente');
                Route::get('reasignacionComponenteMasivo', 'reasignacionComponenteMasivo')->name('componentes.reasignacionComponenteMasivo');
                // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            });
            // ------------------------------------------------------------------------------------
            Route::controller(TareaController::class)->prefix('tareas')->group(function () {
                Route::get('gestion/{id}/{notificacion_id?}', 'gestion')->name('tareas.gestion');
                Route::get('crear/{componente_id}', 'create')->name('tareas.create');
                Route::post('guardar/{componente_id}', 'store')->name('tareas.store');
                Route::get('editar/{id}', 'edit')->name('tareas.edit');
                Route::put('actualizar/{id}', 'update')->name('tareas.update');
                // . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                Route::get('getapitareas/{componente_id}/{estado}', 'getapitareas')->name('tareas.getapitareas');
                // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                Route::get('reasignacionTarea', 'reasignacionTarea')->name('tareas.reasignacionTarea');
                Route::get('getTareasEmpleadoGrupos', 'getTareasEmpleadoGrupos')->name('tareas.getTareasEmpleadoGrupos');
                Route::delete('eliminarTareasEmpleadoGrupos/{id}', 'destroyTareasEmpleadoGrupos')->name('tareas.destroyTareasEmpleadoGrupos');
                Route::post('crearEmplGrupoTareas/{empleado_id}', 'createEmplGrupoTareas')->name('tareas.createEmplGrupoTareas');
                Route::get('reasignacionGrupoTarea', 'reasignacionGrupoTarea')->name('tareas.reasignacionGrupoTarea');
            });
            // ------------------------------------------------------------------------------------
            Route::controller(HistorialController::class)->prefix('historiales')->group(function () {
                Route::get('crear/{id}', 'create')->name('historiales.create');
                Route::post('guardar', 'store_subtarea')->name('historiales.store_subtarea');
                Route::post('guardar', 'store')->name('historiales.store_tarea');
                Route::get('gestion/{id}', 'gestion')->name('historiales.gestion');
                Route::post('guardar_doc_hist', 'guardar_doc_hist')->name('historiales.guardar_doc_hist');
            });
            // ----------------------------------------------------------------------------------------
            // Ruta sub-tareas
            // ------------------------------------------------------------------------------------
            Route::controller(TareaController::class)->prefix('subtareas')->group(function () {
                Route::get('crear/{id}', 'subtareas_create')->name('subtareas.create');
                Route::post('guardar/{id}', 'subtareas_store')->name('subtareas.store');
                Route::get('gestion/{id}/{notificacion_id?}', 'subtareas_gestion')->name('subtareas.gestion');
                Route::get('getHistSubTarea', 'getHistSubTarea')->name('subtareas.getHistSubTarea');
            });
            // ----------------------------------------------------------------------------------------
            // ----------------------------------------------------------------------------------------
            // Ruta get-pryectos
            // ------------------------------------------------------------------------------------
            Route::controller(EmpleadoController::class)->prefix('empleados')->group(function () {
                Route::get('getproyectos', 'getproyectos')->name('empleados.getproyectos');
                Route::get('getproyectosLider', 'getproyectosLider')->name('empleados.getproyectosLider');
                Route::get('getTareas', 'getTareas')->name('empleados.getTareas');
                Route::get('getTareasVencidas', 'getTareasVencidas')->name('empleados.getTareasVencidas');
                Route::get('calendar_empleado', 'calendar_empleado')->name('empleados.calendar_empleado');
                Route::get('calendar_empleado_proy', 'calendar_empleado_proy')->name('empleados.calendar_empleado_proy');
                Route::get('getProyectosGraficosLider', 'getProyectosGraficosLider')->name('empleados.getProyectosGraficosLider');
                Route::get('getResponsabilidadesTotal', 'getResponsabilidadesTotal')->name('empleados.getResponsabilidadesTotal');
            });
        });
    });
    //===================================================================================================
});
