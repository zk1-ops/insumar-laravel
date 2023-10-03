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

use App\Http\Controllers\ProductController;
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

Route::get('/GetProduct', [ProductController::class, 'index']);


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
            // Productos
        Route::post('/agregarProducto', [ProductController::class, 'create']);
        Route::post('/actualizarProductos', [ProductController::class, 'update']);
        Route::post('/eliminarProductos', [ProductController::class, 'destroy']);
        Route::post('admin/product/SaveStatus', [ProductController::class, 'saveStatus']);


        Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // SI EL USUARIO ESTA AUTENTICADO PUEDE CERRAR SESION

    /*****************************************************************************
    *                                                                            *
    *                           Metodos Get                                      *
    *                                                                            *
    ******************************************************************************/
        // Productos
        Route::get('/admin/GetProductos', [ProductController::class, 'index']);
        Route::Get('/admin/countProduct', [ProductController::class, 'getCountProduct']);
            // User
        Route::get('/admin/GetUser', [LoginController::class, 'dataUser']);

        
    /*****************************************************************************
    *                                                                            *
    *                            Rutas de Vistas                                 *
    *                                                                            *
    ******************************************************************************/
        Route::get('/admin/dashboard', function() {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/admin/suppliers', function() {
            return view('dashboard');
        })->name('products');

        Route::get('/admin/products', function() {
            return view('dashboard');
        })->name('suppliers');

    
});
