<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Auth\LoginController;


/*****************************************************************************
*                                                                            *
*                            Rutas de Vistas                                 *
*                                                                            *
******************************************************************************/
Route::get('/', function () {
    return view('home');
});
Route::get('/productos', function () {
    return view('home');
});
Route::get('/admin', function() {
    return view('login');
})->name('login');

/*****************************************************************************
*                                                                            *
*                           Get de Cualquier Cosa                            *
*                                                                            *
******************************************************************************/
Route::get('/token', function () {
    return csrf_token(); 
});

Route::get('/GetProduct', [ProductoController::class, 'index']);


/*****************************************************************************
*                                                                            *
*                            Metodos Post                                    *
*                                                                            *
******************************************************************************/
Route::post('/auth', [LoginController::class, 'login'])->name('auth');


/*****************************************************************************
*                                                                            *
*                            Middleware + Rutas                              *
*                                                                            *
******************************************************************************/
Route::group(['middleware'=>['auth']],function(){

    /*****************************************************************************
    *                                                                            *
    *                            Metodos Post                                    *
    *                                                                            *
    ******************************************************************************/
    
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // SI EL USUARIO ESTA AUTENTICADO PUEDE CERRAR SESION

    /*****************************************************************************
    *                                                                            *
    *                            Metodos Get                                     *
    *                                                                            *
    ******************************************************************************/

    /*****************************************************************************
    *                                                                            *
    *                            Rutas de Vistas                                 *
    *                                                                            *
    ******************************************************************************/
        Route::get('/admin/dashboard', function() {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/admin/test', function() {
            return view('dashboard');
        });


    
});
