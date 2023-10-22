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
            'contact_mail' => $request->contact_email,
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
        $supplier->contact_mail = $request->contact_mail;
        $supplier->contact_phone = $request->contact_phone;
        $supplier->city = $request->city;
        $supplier->address = $request->address;

        $supplier->save();
        return $supplier;
    }

    public function destroy(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->delete();
    }
}
