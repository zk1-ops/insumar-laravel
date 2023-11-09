<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $data  = Client::all();
        return $data;
        
    }


    public function create(Request $request)
    {

        $client = Client::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "business_name" => $request->business_name,
            "dni" => $request->dni,
            "email" => $request->email,
            "phone" => $request->phone,
            "city" => $request->city,
            "address" =>$request->address

        ]);

    }

    public function update(Request $request)
    {
        $client = Client::find($request->id);

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->business_name = $request->business_name;
        $client->dni = $request->dni;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->city = $request->city;
        $client->address = $request->address;

        $client->save();
        return $client;
    }

    public function destroy(Request $request)
    {

        $client = Client::find($request->id);
        $client->delete();
    
    }

    public function getCountClient() {
        $data  = Client::all();
        
        $dataCount = $data->count();

        return $dataCount;
    }
}
