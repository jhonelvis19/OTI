<?php
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;

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

        Route::get('/configuracion', function () {
            return view('admin.configuracion.index');
        });

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

        Route::get('/dashboard', function () {
            return view('usuario.dashboard');
        });

        Route::get('/informes/{informe}', [InformeController::class, 'show']);

        Route::get('/informes/create', [InformeController::class, 'create']);

        Route::get('/informes', [InformeController::class, 'misInformes']);

        Route::get('/perfil', function () {
            return view('usuario.perfil.index');
        });

        Route::get('/informes/{informe}/pdf', [InformeController::class, 'pdf']);

        Route::post('/informes', [InformeController::class, 'store']);
        Route::get('/informes/{informe}/pdf/download', [InformeController::class, 'downloadPdf']);
        Route::put('/informes/{informe}', [InformeController::class, 'update']);

        Route::get('/informes/{informe}/edit', [InformeController::class, 'edit']);
        });

});

require __DIR__.'/auth.php';