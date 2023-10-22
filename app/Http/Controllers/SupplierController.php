<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    
    public function index() {
        $data = Supplier::all();

        return $data;
    }

    public function create(Request $request) 
    {
        $supplier = Supplier::create ([
            'business_name' => $request->business_name,
            'dni' => $request->dni,
            'contact_person' => $request->contact_person,
            'contact_mail' => $request->contact_mail,
            'contact_phone' => $request->contact_phone,
            'city' => $request->city,
            'address' => $request->address,
            'created_at' => now()

        ]);


    }

    public function update(Request $request) 
    {
        
        $supplier = Supplier::find($request->id);
        
        $supplier->business_name = $request->business_name;
        $supplier->dni = $request->dni;
        $supplier->contact_person = $request->contact_person;
        $supplier->contact_mail = $request->contact_mail;
        $supplier->contact_phone = $request->contact_phone;
        $supplier->city = $request->city;
        $supplier->address = $request->address;

        $supplier->save();
        return $supplier;
    }

    public function destroy(Request $request)
    {
       try {
            $supplier = Supplier::find($request->id);
            $supplier->delete();
       } catch (\Throwable $th) {
        return response()->json(['error' => 'No se puede eliminar el proveedor debido a las restricciones de integridad.'], 500);
       }
    }

    public function getCountSuppliers() {
        $data  = Supplier::all();
        
        $dataCount = $data->count();

        return $dataCount;
    }
}
