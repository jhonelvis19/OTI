<?php
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['rol:admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });

        Route::get('/informes/create', [InformeController::class, 'create']);

        Route::post('/informes', [InformeController::class, 'store']);
        
        Route::get('/admin/informes/{informe}', [InformeController::class, 'show']);

        Route::get('/informes', [InformeController::class, 'index']);

        Route::get('/usuarios', function () {
            return view('admin.usuarios.index');
        });

        Route::get('/configuracion', function () {
            return view('admin.configuracion.index');
        });

    });


    /*
    |--------------------------------------------------------------------------
    | USUARIO
    |--------------------------------------------------------------------------
    */

    Route::middleware(['rol:usuario'])->prefix('usuario')->group(function () {

        Route::get('/dashboard', function () {
            return view('usuario.dashboard');
        });

        Route::get('/informes/create', [InformeController::class, 'create']);

        Route::get('/informes', function () {
            return view('usuario.informes.index');
        });

        Route::get('/perfil', function () {
            return view('usuario.perfil.index');
        });

    });

});

require __DIR__.'/auth.php';