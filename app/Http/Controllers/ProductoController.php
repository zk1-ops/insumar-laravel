<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = Producto::all();
        return $data;
        
    }

    
    
    public function update(Request $request)
    {
        $productos = Producto::find($request->id);
        $productos->nombre = $request->nombre;
        $productos->envase = $request->envase;
        $productos->descripcion = $request->descripcion;
        $productos->total_pay = $request->total_pay;

        $productos->save();
        
        return $productos;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $productos = Producto::find($request->id);
        $productos->delete();
        
    }

    public function create(Request $request)
    {
        $productos = Producto::create([
            'nombre' =>request('nombre'),
            'descripcion' =>request('descripcion'),
            'envase'=>request('envase'),
            'total_pay'=>request('precio'),
        ]);
    }
}
