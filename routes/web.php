<?php
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SeguridadController;
use App\Http\Controllers\PlantillaExcelController;
use App\Http\Controllers\ExportacionExcelController;

Route::get('/', function () {
    return redirect('/login');
});


// admin 
Route::middleware(['auth'])->group(function () {

    Route::middleware(['rol:admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard',[DashboardController::class, 'index']);

        Route::get('/informes/create', [InformeController::class, 'create']);

        Route::post('/informes', [InformeController::class, 'store']);
        
        Route::get('/informes/{informe}', [InformeController::class, 'show']);

        Route::get('/informes/{informe}/pdf', [InformeController::class, 'pdf']);

        Route::get('/informes/{informe}/pdf/download', [InformeController::class, 'downloadPdf']);

        Route::get('/informes', [InformeController::class, 'index']);



        Route::get('/usuarios', [UsuarioController::class, 'index']);

        Route::get('/usuarios/create', [UsuarioController::class, 'create']);

        Route::post('/usuarios', [UsuarioController::class, 'store']);

        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);

        Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy']);

        Route::get('/usuarios/{usuario}/historial', [UsuarioController::class, 'historial']);

        Route::get('/mis-informes', [InformeController::class, 'misInformesAdmin']);

        Route::get('/informes/{informe}/edit', [InformeController::class, 'edit']);

        Route::put('/informes/{informe}', [InformeController::class, 'update']);

    });

    //usuario

    Route::middleware(['rol:usuario'])->prefix('usuario')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'usuarioIndex']);

        Route::get('/informes/create', [InformeController::class, 'create']);

        Route::get('/informes/{informe}', [InformeController::class, 'show']);

        Route::get('/informes/{informe}/pdf', [InformeController::class, 'pdf']);

        Route::get('/informes/{informe}/pdf/download', [InformeController::class, 'downloadPdf']);

        Route::get('/informes/{informe}/edit', [InformeController::class, 'edit']);

        Route::get('/informes', [InformeController::class, 'misInformes']);

        Route::post('/informes', [InformeController::class, 'store']);

        Route::put('/informes/{informe}', [InformeController::class, 'update']);

    });

    // Configuraciones Compartidas
    Route::middleware('auth')->prefix('configuraciones')->name('configuraciones.')->group(function () {
        Route::get('/', [ConfiguracionController::class, 'index'])->name('index');
        
        Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
        Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

        Route::get('/firma', [FirmaController::class, 'edit'])->name('firma.edit');
        Route::put('/firma', [FirmaController::class, 'update'])->name('firma.update');
        Route::post('/firma', [FirmaController::class, 'guardarFirmaPerfil'])->name('firma.store');
        Route::delete('/firma', [FirmaController::class, 'eliminarFirmaPerfil'])->name('firma.destroy');

        Route::get('/seguridad', [SeguridadController::class, 'edit'])->name('seguridad.edit');
        Route::put('/seguridad', [SeguridadController::class, 'update'])->name('seguridad.update');
    });

    // Plantilla Excel (Solo Admin)
    Route::middleware(['auth', 'rol:admin'])->prefix('configuraciones/plantilla')->name('configuraciones.plantilla.')->group(function () {
        Route::get('/', [PlantillaExcelController::class, 'index'])->name('index');
        Route::get('/descargar', [PlantillaExcelController::class, 'download'])->name('download');
        Route::put('/actualizar', [PlantillaExcelController::class, 'update'])->name('update');
    });

    // Exportación
    Route::post('/historial/exportar-excel', [ExportacionExcelController::class, 'exportar'])->middleware('auth')->name('historial.exportar-excel');

});

require __DIR__.'/auth.php';