<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Product;
use App\Models\Supplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = Product::all();
        return $data;
        
    }


    public function update(Request $request)
    {
        $imagen = $request->file('imagen');

        $product = Product::find($request->id);
        $product->id_supplier = $request->id_supplier;
        $product->name = $request->name;
        $product->container = $request->container;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;

        // Buscamos el proveedor para llevarlo a la interfaz

        $supplier  = Supplier::find($product->id_supplier);
        
        // Verifica si se cargó una nueva imagen
        if ($imagen) {
            // Elimina la imagen antigua si existe
            if ($product->image) {
              // Storage::disk('public')->delete($product->image);
              $nombreArchivo = str_replace('/storage/', '', $product->image);
              Storage::disk('public')->delete($nombreArchivo);
            }
    
            // Sube la nueva imagen
            $imagenNueva = $request->file('imagen');
            $nombreImagenNueva = uniqid('imagenInsumar_') . '.' . $imagenNueva->getClientOriginalExtension();
            Storage::disk('public')->put('/images/product/' . $nombreImagenNueva, file_get_contents($imagenNueva));
    
            $urlImagenNueva = Storage::url('images/product/' . $nombreImagenNueva);
    
            $product->image = $urlImagenNueva;
        }
    
        $product->save();
        
        return $product;
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $image = $product->image;
        Storage::disk('public')->delete('/images/product/'.basename($image));
        $product->delete();
        
    }

    public function create(Request $request)
    {
        $imagen = $request->file('imagen');

        if ($imagen) {
            // Si se proporciona una imagen, guarda la imagen en el almacenamiento y obtén su URL
            $nombreImagen = uniqid('imagenInsumar_') . '.' . $imagen->getClientOriginalExtension();
    
            Storage::disk('public')->put('/images/product/' . $nombreImagen, file_get_contents($imagen));
    
            $urlImagen = Storage::url('images/product/' . $nombreImagen);
        } 


        $productos = Product::create([
            'id_supplier' =>request('id_supplier'),
            'name' =>request('nombre'),
            'description' =>request('description'),
            'container'=>request('container'),
            'stock' => request('stock'),
            'price'=>request('price'),
            'image' => $urlImagen,
            'created_at' => now()
        ]);
    }

    public function saveStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $product = Product::find($id);
        $product->show_product = $status;
        $product->save();
    }


    public function getCountProduct() {
        $data  = Product::all();
        
        $dataCount = $data->count();

        return $dataCount;
    }
}
