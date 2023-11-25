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
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ContactMailController;

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



Route::post('/xxxx', [ LoginController::class, 'test' ]); // Ejemplo !!! 
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
Route::post('/enviarForm', [ ContactMailController::class, 'enviar' ]);



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

        // Proveedores
        Route::post('/agregarProveedor', [SupplierController::class, 'create']);
        Route::post('/actualizarProveedor', [SupplierController::class, 'update']);
        Route::post('/eliminarProveedor', [SupplierController::class, 'destroy']);

        // Empleados
        Route::post('/crearEmpleado', [EmployeeController::class, 'create']);
        Route::post('/actualizarEmpleado', [EmployeeController::class, 'update']);
        Route::post('/eliminarEmpleado', [EmployeeController::class, 'destroy']);

        // Clientes
        Route::post('/crearCliente', [ClientController::class, 'create']);
        Route::post('/editarCliente', [ClientController::class, 'update']);
        Route::post('/eliminarCliente', [ClientController::class, 'destroy']);

        // Ventas
        Route::post('/crearVenta', [ SaleController::class, 'create'] );
        Route::post('/eliminarVenta', [ SaleController::class, 'delete' ]);

        // Mail Statuws
        Route::post('/mail/updateStatus', [ContactMailController::class, 'updateStatus' ]);
        Route::post('/mail/deleteMail', [ContactMailController::class, 'deleteMail' ]);



        Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // SI EL USUARIO ESTA AUTENTICADO PUEDE CERRAR SESION

    /*****************************************************************************
    *                                                                            *
    *                           Metodos Get                                      *
    *                                                                            *
    ******************************************************************************/
        // Productos
        Route::get('/admin/GetProductos', [ProductController::class, 'index']);
        Route::get('/admin/countProduct', [ProductController::class, 'getCountProduct']);
        
        // Proveedores
        Route::get('/admin/GetSuppliers', [SupplierController::class, 'index']);
        Route::get('/admin/countSupplier', [SupplierController::class, 'getCountSuppliers']);
        // Empleados
        Route::get('/admin/getEmployees', [EmployeeController::class, 'getEmployee']);

        // Role
        Route::get('/admin/Role', [EmployeeController::class, 'getRole']);

        // User
        Route::get('/admin/GetUser', [LoginController::class, 'dataUser']);
        // Cliente
        Route::get('/admin/GetClients', [ ClientController::class, 'index' ]);
        Route::get('/admin/countClient', [ ClientController::class, 'getCountClient' ]);

        // Ventas
        Route::get('/getSales', [ SaleController::class, 'index' ]);
        Route::get('/admin/countSale', [ SaleController::class, 'getCountSale' ]);
        Route::get('/getItems/{id}', [ SaleController::class, 'viewItem' ]);

        // Mail 

        Route::get('/email/GetMail', [ ContactMailController::class, 'getEmail' ]);



        
    /*****************************************************************************
    *                                                                            *
    *                            Rutas de Vistas                                 *
    *                                                                            *
    ******************************************************************************/
        Route::get('/admin/dashboard', function() {
            return view('admin/app');
        })->name('admin/app');

        Route::get('/admin/suppliers', function() {
            return view('admin/app');
        })->name('products');

        Route::get('/admin/products', function() {
            return view('admin/app');
        })->name('suppliers');

        Route::get('/admin/sales', function() {
            return view('admin/app');
        })->name('sales');

        Route::get('/admin/employees', function() {
            return view('admin/app');
        })->name('sales');

        Route::get('/admin/users', function() {
            return view('admin/app');
        })->name('sales');
    
});
