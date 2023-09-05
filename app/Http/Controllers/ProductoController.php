<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


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
        $imagen = $request->file('imagen');

        $productos = Producto::find($request->id);
        $productos->nombre = $request->nombre;
        $productos->envase = $request->envase;
        $productos->descripcion = $request->descripcion;
        $productos->total_pay = $request->total_pay;
        
        // Verifica si se cargó una nueva imagen
        if ($imagen) {
            // Elimina la imagen antigua si existe
            if ($productos->image) {
                Storage::disk('public')->delete($productos->image);
            }
    
            // Sube la nueva imagen
            $imagenNueva = $request->file('imagen');
            $nombreImagenNueva = uniqid('imagenInsumar_') . '.' . $imagenNueva->getClientOriginalExtension();
            Storage::disk('public')->put('/images/' . $nombreImagenNueva, file_get_contents($imagenNueva));
    
            $urlImagenNueva = Storage::url('images/' . $nombreImagenNueva);
    
            $productos->image = $urlImagenNueva;
        }
    
        $productos->save();
        
        return $productos;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $productos = Producto::find($request->id);
        $image = $productos->image;
        Storage::disk('public')->delete('/images/'.basename($image));
        $productos->delete();
        
    }

    public function create(Request $request)
    {
        $imagen = $request->file('imagen');

        if ($imagen) {
            // Si se proporciona una imagen, guarda la imagen en el almacenamiento y obtén su URL
            $nombreImagen = uniqid('imagenInsumar_') . '.' . $imagen->getClientOriginalExtension();
    
            Storage::disk('public')->put('/images/' . $nombreImagen, file_get_contents($imagen));
    
            $urlImagen = Storage::url('images/' . $nombreImagen);
        } 


        $productos = Producto::create([
            'nombre' =>request('nombre'),
            'descripcion' =>request('descripcion'),
            'envase'=>request('envase'),
            'total_pay'=>request('precio'),
            'image' => $urlImagen,
            'created_at' => now()
        ]);
    }
}
