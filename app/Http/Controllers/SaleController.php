<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\Item;
use App\Models\Product;

use DB;

class SaleController extends Controller
{
    //


    public function create(Request $request) {
        $valorTotal = 0;

       try {
            $sale = Sale::create([
                'id_client' => $request->id_client,
                'id_employee' => $request->id_employee,
                'codeSale' =>  rand()
            ]);
            
            $productosVendidos = $request->input('productos');

             // Iterar a través de los productos vendidos y asociarlos con la venta
             foreach ($productosVendidos as $producto) {
                $productoId = $producto['selectedProduct'];
                $cantidad = $producto['quantity'];

                $product = Product::find($productoId);

                // Verificamos si hay stock
                if ( $product->stock < $cantidad || $product->stock == 0 ) {
                    Sale::find($sale->id)->delete();
                    return response()->json(['error' => 'Producto no disponible para la venta o stock insuficiente'], 400);
                }else {
                    // Verificar si se encontró el producto antes de intentar acceder a su precio
                    if ($product->price) {
                        $valorProducto = $cantidad * $product->price;
                        $valorTotal += $valorProducto;
                    }

                    // Crear un nuevo item de venta y asociarlo con la venta y el producto
                    $item = Item::create([
                        'id_prod' => $productoId,
                        'id_sale'  => $sale->id,
                        'quantity' => $cantidad,
                        'created_at' => now()
                    ]);

                    // Actualizamos el stock del producto
                    Product::find($productoId)->decrement('stock', $item->quantity);
                    }
                

                // También puedes hacer otras operaciones aquí, como actualizar el stock del producto
                // ...
            }
            // Actualizamos el precio total
            $saleUpdate = Sale::find($sale->id);
            $saleUpdate->total_pay = $valorTotal;
            $saleUpdate->save();

       } catch (\Throwable $th) {
            throw $th;
       }
    }


   public function index() {
        $sales = DB::table('sales')
                 ->join('clients', 'clients.id', '=', 'sales.id_client')
                 ->join('employees', 'employees.id', '=', 'sales.id_employee')
                 ->select('sales.id','sales.codeSale', 'sales.total_pay', 'sales.created_at', 'clients.first_name as name_client', 'clients.last_name as last_client', 'employees.first_name', 'employees.last_name')
                 ->get();

        return $sales;
   }

   public function delete(Request $request) {
      $sale = Sale::find($request->id);
      $sale->delete();
   }

   public function getCountSale() {
    $data  = Sale::all();
    
    $dataCount = $data->count();

    return $dataCount;
}
}
